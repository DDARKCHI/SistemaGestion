<?php

namespace App\Http\Controllers;

use App\Models\EmpresaFactoring;
use App\Models\Factura;
use App\Models\Factoring;
use App\Models\Operacion;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class FactoringController extends Controller
{
    /**
     * Listado general de operaciones de factoring.
     */
    public function index(): View
    {
        $factorings = Factoring::query()
            ->with([
                'empresaFactoring',
                'operacion.cliente',
                'factura',
            ])
            ->orderByDesc('fecha_curse')
            ->orderByDesc('id')
            ->get();

        return view(
            'factorings.index',
            compact('factorings')
        );
    }

    /**
     * Formulario para registrar una operación de factoring.
     */
    public function create(): View
    {
        $empresasFactoring = EmpresaFactoring::query()
            ->where('estado', 'activo')
            ->orderBy('nombre')
            ->get();

        $operaciones = Operacion::query()
            ->with([
                'cliente',
                'facturas' => function ($query) {
                    $query
                        ->where('estado', 'vigente')
                        ->orderByDesc('fecha_emision')
                        ->orderByDesc('id');
                },
            ])
            ->orderByDesc('fecha_operacion')
            ->orderByDesc('id')
            ->get();

        return view(
            'factorings.create',
            compact(
                'empresasFactoring',
                'operaciones'
            )
        );
    }

    /**
     * Registra una nueva operación de factoring.
     */
    public function store(Request $request): RedirectResponse
    {
        $datos = $this->validarDatos($request);

        $factura = Factura::query()
            ->with('operacion')
            ->findOrFail($datos['factura_id']);

        /*
         * La factura seleccionada debe pertenecer a la operación
         * seleccionada. Nunca confiamos solamente en el formulario.
         */
        if ((int) $factura->operacion_id !== (int) $datos['operacion_id']) {
            return back()
                ->withInput()
                ->withErrors([
                    'factura_id' =>
                        'La factura seleccionada no pertenece a la operación indicada.',
                ]);
        }

        /*
         * El monto de la factura se obtiene desde la factura real.
         * El usuario no debe poder alterar este valor manualmente.
         */
        $datos['monto_factura'] = $factura->total;

        /*
         * El monto liquidado corresponde al anticipo menos comisión
         * e interés, sin permitir resultados negativos.
         */
        $datos['monto_liquidado'] = max(
            0,
            (float) $datos['monto_anticipo']
            - (float) $datos['comision']
            - (float) $datos['interes']
        );

        /*
         * Una misma factura no debe quedar asociada a dos operaciones
         * de factoring simultáneas.
         */
        if (
            Factoring::query()
                ->where('factura_id', $factura->id)
                ->exists()
        ) {
            return back()
                ->withInput()
                ->withErrors([
                    'factura_id' =>
                        'La factura seleccionada ya tiene una operación de factoring registrada.',
                ]);
        }

        $factoring = Factoring::create($datos);

        return redirect()
            ->route('factorings.show', $factoring)
            ->with(
                'success',
                'Operación de factoring registrada correctamente.'
            );
    }

    /**
     * Muestra una operación de factoring.
     */
    public function show(Factoring $factoring): View
    {
        $factoring->load([
            'empresaFactoring',
            'operacion.cliente',
            'factura',
        ]);

        return view(
            'factorings.show',
            compact('factoring')
        );
    }

    /**
     * Formulario de edición.
     */
    public function edit(Factoring $factoring): View
    {
        $factoring->load([
            'empresaFactoring',
            'operacion.cliente',
            'factura',
        ]);

        $empresasFactoring = EmpresaFactoring::query()
            ->where(function ($query) use ($factoring) {
                $query
                    ->where('estado', 'activo')
                    ->orWhere('id', $factoring->empresa_factoring_id);
            })
            ->orderBy('nombre')
            ->get();

        $operaciones = Operacion::query()
            ->with([
                'cliente',
                'facturas' => function ($query) use ($factoring) {
                    $query
                        ->where(function ($subQuery) use ($factoring) {
                            $subQuery
                                ->where('estado', 'vigente')
                                ->orWhere('id', $factoring->factura_id);
                        })
                        ->orderByDesc('fecha_emision')
                        ->orderByDesc('id');
                },
            ])
            ->orderByDesc('fecha_operacion')
            ->orderByDesc('id')
            ->get();

        return view(
            'factorings.edit',
            compact(
                'factoring',
                'empresasFactoring',
                'operaciones'
            )
        );
    }

    /**
     * Actualiza una operación de factoring.
     */
    public function update(
        Request $request,
        Factoring $factoring
    ): RedirectResponse {
        $datos = $this->validarDatos(
            $request,
            $factoring
        );

        $factura = Factura::query()
            ->with('operacion')
            ->findOrFail($datos['factura_id']);

        if ((int) $factura->operacion_id !== (int) $datos['operacion_id']) {
            return back()
                ->withInput()
                ->withErrors([
                    'factura_id' =>
                        'La factura seleccionada no pertenece a la operación indicada.',
                ]);
        }

        /*
         * No permitimos que la factura quede duplicada en otro factoring.
         */
        $factoringExistente = Factoring::query()
            ->where('factura_id', $factura->id)
            ->where('id', '!=', $factoring->id)
            ->exists();

        if ($factoringExistente) {
            return back()
                ->withInput()
                ->withErrors([
                    'factura_id' =>
                        'La factura seleccionada ya tiene otra operación de factoring registrada.',
                ]);
        }

        $datos['monto_factura'] = $factura->total;

        $datos['monto_liquidado'] = max(
            0,
            (float) $datos['monto_anticipo']
            - (float) $datos['comision']
            - (float) $datos['interes']
        );

        $factoring->update($datos);

        return redirect()
            ->route('factorings.show', $factoring)
            ->with(
                'success',
                'Operación de factoring actualizada correctamente.'
            );
    }

    /**
     * Elimina una operación de factoring.
     */
    public function destroy(
        Factoring $factoring
    ): RedirectResponse {
        try {
            $factoring->delete();
        } catch (QueryException $exception) {
            return redirect()
                ->route('factorings.show', $factoring)
                ->with(
                    'error',
                    'No se puede eliminar esta operación de factoring porque tiene registros asociados.'
                );
        }

        return redirect()
            ->route('factorings.index')
            ->with(
                'success',
                'Operación de factoring eliminada correctamente.'
            );
    }

    /**
     * Valida los datos recibidos desde el formulario.
     */
    private function validarDatos(
        Request $request,
        ?Factoring $factoring = null
    ): array {
        $factoringId = $factoring?->id;

        return $request->validate(
            [
                'empresa_factoring_id' => [
                    'required',
                    'integer',
                    'exists:empresas_factoring,id',
                ],

                'operacion_id' => [
                    'required',
                    'integer',
                    'exists:operaciones,id',
                ],

                'factura_id' => [
                    'required',
                    'integer',
                    'exists:facturas,id',
                ],

                'fecha_curse' => [
                    'nullable',
                    'date',
                ],

                'estado' => [
                    'required',
                    Rule::in([
                        'pendiente',
                        'cursado',
                        'liquidado',
                        'anulado',
                    ]),
                ],

                'monto_anticipo' => [
                    'required',
                    'numeric',
                    'min:0',
                ],

                'comision' => [
                    'required',
                    'numeric',
                    'min:0',
                ],

                'interes' => [
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
                'empresa_factoring_id.required' =>
                    'Debe seleccionar una empresa de factoring.',

                'empresa_factoring_id.exists' =>
                    'La empresa de factoring seleccionada no existe.',

                'operacion_id.required' =>
                    'Debe seleccionar una operación.',

                'operacion_id.exists' =>
                    'La operación seleccionada no existe.',

                'factura_id.required' =>
                    'Debe seleccionar una factura.',

                'factura_id.exists' =>
                    'La factura seleccionada no existe.',

                'fecha_curse.date' =>
                    'La fecha de curse no es válida.',

                'estado.required' =>
                    'Debe seleccionar un estado.',

                'estado.in' =>
                    'El estado seleccionado no es válido.',

                'monto_anticipo.required' =>
                    'El monto del anticipo es obligatorio.',

                'monto_anticipo.numeric' =>
                    'El monto del anticipo debe ser numérico.',

                'monto_anticipo.min' =>
                    'El monto del anticipo no puede ser negativo.',

                'comision.required' =>
                    'La comisión es obligatoria.',

                'comision.numeric' =>
                    'La comisión debe ser numérica.',

                'comision.min' =>
                    'La comisión no puede ser negativa.',

                'interes.required' =>
                    'El interés es obligatorio.',

                'interes.numeric' =>
                    'El interés debe ser numérico.',

                'interes.min' =>
                    'El interés no puede ser negativo.',
            ]
        );
    }
}