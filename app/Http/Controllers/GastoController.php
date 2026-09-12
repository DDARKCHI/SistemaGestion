<?php

namespace App\Http\Controllers;

use App\Models\Gasto;
use App\Models\Operacion;
use App\Models\Transportista;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GastoController extends Controller
{
    /**
     * Mostrar listado general de gastos.
     */
    public function index(): View
    {
        $gastos = Gasto::query()
            ->with([
                'operacion.cliente',
                'transportista',
            ])
            ->orderByDesc('fecha')
            ->orderByDesc('id')
            ->get();

        return view('gastos.index', compact('gastos'));
    }

    /**
     * Mostrar formulario para crear un gasto.
     */
    public function create(Request $request): View
    {
        $operaciones = Operacion::query()
            ->with('cliente')
            ->orderByDesc('fecha_operacion')
            ->orderByDesc('id')
            ->get();

        $transportistas = Transportista::query()
            ->orderBy('nombre')
            ->orderBy('id')
            ->get();

        $operacionSeleccionada = null;

        if ($request->filled('operacion_id')) {

            $operacionSeleccionada = Operacion::query()
                ->with('cliente')
                ->find($request->integer('operacion_id'));

        }

        return view(
            'gastos.create',
            compact(
                'operaciones',
                'transportistas',
                'operacionSeleccionada'
            )
        );
    }

    /**
     * Registrar un nuevo gasto.
     */
    public function store(Request $request): RedirectResponse
    {
        $datos = $this->validarDatos($request);

        $datos['monto'] = $this->normalizarMonto(
            $datos['monto']
        );

        $gasto = Gasto::create($datos);

        return redirect()
            ->route('gastos.show', $gasto)
            ->with(
                'success',
                'Gasto registrado correctamente.'
            );
    }

    /**
     * Mostrar detalle del gasto.
     */
    public function show(Gasto $gasto): View
    {
        $gasto->load([
            'operacion.cliente',
            'transportista',
            'documentos',
        ]);

        return view(
            'gastos.show',
            compact('gasto')
        );
    }

    /**
     * Mostrar formulario de edición.
     */
    public function edit(Gasto $gasto): View
    {
        $operaciones = Operacion::query()
            ->with('cliente')
            ->orderByDesc('fecha_operacion')
            ->orderByDesc('id')
            ->get();

        $transportistas = Transportista::query()
            ->orderBy('nombre')
            ->orderBy('id')
            ->get();

        $gasto->load([
            'operacion.cliente',
            'transportista',
        ]);

        return view(
            'gastos.edit',
            compact(
                'gasto',
                'operaciones',
                'transportistas'
            )
        );
    }

    /**
     * Actualizar un gasto.
     */
    public function update(
        Request $request,
        Gasto $gasto
    ): RedirectResponse {
        $datos = $this->validarDatos($request);

        $datos['monto'] = $this->normalizarMonto(
            $datos['monto']
        );

        $gasto->update($datos);

        return redirect()
            ->route('gastos.show', $gasto)
            ->with(
                'success',
                'Gasto actualizado correctamente.'
            );
    }

    /**
     * Eliminar un gasto.
     */
    public function destroy(Gasto $gasto): RedirectResponse
    {
        try {

            $gasto->delete();

        } catch (QueryException $exception) {

            return redirect()
                ->route('gastos.show', $gasto)
                ->with(
                    'error',
                    'No se puede eliminar este gasto porque tiene registros asociados.'
                );

        }

        return redirect()
            ->route('gastos.index')
            ->with(
                'success',
                'Gasto eliminado correctamente.'
            );
    }

    /**
     * Validar datos del gasto.
     */
    private function validarDatos(Request $request): array
    {
        $datos = $request->validate(
            [
                'operacion_id' => [
                    'nullable',
                    'integer',
                    'exists:operaciones,id',
                ],

                'transportista_id' => [
                    'nullable',
                    'integer',
                    'exists:transportistas,id',
                ],

                'fecha' => [
                    'nullable',
                    'date',
                ],

                'tipo' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'descripcion' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'monto' => [
                    'required',
                    'numeric',
                    'min:0',
                ],

                'observaciones' => [
                    'nullable',
                    'string',
                ],
            ],
            [
                'operacion_id.integer' =>
                    'La operación seleccionada no es válida.',

                'operacion_id.exists' =>
                    'La operación seleccionada no existe.',

                'transportista_id.integer' =>
                    'El transportista seleccionado no es válido.',

                'transportista_id.exists' =>
                    'El transportista seleccionado no existe.',

                'fecha.date' =>
                    'La fecha ingresada no es válida.',

                'tipo.required' =>
                    'El tipo de gasto es obligatorio.',

                'tipo.string' =>
                    'El tipo de gasto no es válido.',

                'tipo.max' =>
                    'El tipo de gasto no puede superar los 255 caracteres.',

                'descripcion.required' =>
                    'El concepto del gasto es obligatorio.',

                'descripcion.string' =>
                    'El concepto del gasto no es válido.',

                'descripcion.max' =>
                    'El concepto no puede superar los 255 caracteres.',

                'monto.required' =>
                    'El monto del gasto es obligatorio.',

                'monto.numeric' =>
                    'El monto del gasto debe ser numérico.',

                'monto.min' =>
                    'El monto del gasto no puede ser negativo.',
            ]
        );

        /*
         * Los egresos generales no necesitan estar
         * asociados a una operación.
         *
         * El resto de los tipos sí deben tener
         * una operación asociada.
         */
        if (
            ($datos['tipo'] ?? null) !== 'Egreso general' &&
            empty($datos['operacion_id'])
        ) {
            return redirect()
                ->back()
                ->withErrors([
                    'operacion_id' =>
                        'Debe seleccionar una operación para este tipo de gasto.',
                ])
                ->withInput()
                ->throwResponse();
        }

        return $datos;
    }

    /**
     * Normalizar el monto antes de guardarlo.
     */
    private function normalizarMonto($monto): int
    {
        return (int) round(
            (float) $monto
        );
    }
}