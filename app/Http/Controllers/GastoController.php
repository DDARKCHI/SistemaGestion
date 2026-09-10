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
    public function create(): View
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

        return view(
            'gastos.create',
            compact('operaciones', 'transportistas')
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
        /*
         * Actualmente el gasto no tiene relaciones secundarias
         * que impidan su eliminación.
         *
         * Se mantiene el manejo de QueryException para proteger
         * el registro ante futuras relaciones que puedan agregarse.
         */
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
        return $request->validate(
            [
                /*
                 * La operación ahora es opcional.
                 *
                 * Esto permite registrar egresos generales
                 * y otros gastos que no pertenezcan a una
                 * operación específica.
                 */
                'operacion_id' => [
                    'nullable',
                    'integer',
                    'exists:operaciones,id',
                ],

                /*
                 * El transportista también es opcional.
                 *
                 * Cuando corresponda, el mismo gasto podrá
                 * quedar asociado al transportista sin duplicar
                 * el registro del gasto.
                 */
                'transportista_id' => [
                    'nullable',
                    'integer',
                    'exists:transportistas,id',
                ],

                'fecha' => [
                    'nullable',
                    'date',
                ],

                /*
                 * El tipo representa la naturaleza general
                 * del gasto.
                 */
                'tipo' => [
                    'required',
                    'string',
                    'max:255',
                ],

                /*
                 * La descripción/concepto es libre.
                 *
                 * No se limita a una lista fija de conceptos.
                 *
                 * Ejemplos:
                 * Bencina
                 * Hospedaje
                 * Peaje
                 * Alimentación
                 * Flete
                 * Mantenimiento
                 * Estacionamiento
                 * Etc.
                 */
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

                'observaciones.string' =>
                    'Las observaciones ingresadas no son válidas.',
            ]
        );
    }

    /**
     * Normalizar el monto antes de almacenarlo.
     *
     * Los montos del sistema se manejarán sin decimales.
     */
    private function normalizarMonto($monto): int
    {
        return (int) round(
            (float) $monto
        );
    }
}