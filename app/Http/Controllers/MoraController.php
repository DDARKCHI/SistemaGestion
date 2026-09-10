<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\Mora;
use App\Models\Operacion;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MoraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $moras = Mora::query()
            ->with([
                'facturaOrigen',
                'operacionOrigen.cliente',
                'facturaDestino',
                'operacionDestino.cliente',
            ])
            ->orderByDesc('fecha')
            ->orderByDesc('id')
            ->get();

        return view(
            'moras.index',
            compact('moras')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $operaciones = Operacion::query()
            ->with([
                'cliente',
                'facturas' => function ($query) {
                    $query
                        ->where('estado', '!=', 'anulada')
                        ->orderByDesc('fecha_emision')
                        ->orderByDesc('id');
                },
            ])
            ->orderByDesc('fecha_operacion')
            ->orderByDesc('id')
            ->get();

        return view(
            'moras.create',
            compact('operaciones')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $datos = $this->validarDatos($request);

        $facturaOrigen = Factura::query()
            ->with('operacion')
            ->findOrFail(
                $datos['factura_origen_id']
            );

        $operacionOrigen = Operacion::findOrFail(
            $datos['operacion_origen_id']
        );

        /*
         * La factura de origen debe pertenecer
         * a la operación seleccionada.
         */
        if (
            (int) $facturaOrigen->operacion_id !==
            (int) $operacionOrigen->id
        ) {
            return back()
                ->withInput()
                ->withErrors([
                    'factura_origen_id' =>
                        'La factura de origen no pertenece a la operación de origen seleccionada.',
                ]);
        }

        /*
         * La factura de origen no puede estar anulada.
         */
        if (
            strtolower((string) $facturaOrigen->estado) ===
            'anulada'
        ) {
            return back()
                ->withInput()
                ->withErrors([
                    'factura_origen_id' =>
                        'No se puede generar una mora desde una factura anulada.',
                ]);
        }

        $errorDestino = $this->validarDestino(
            $datos,
            $facturaOrigen
        );

        if ($errorDestino !== null) {
            return back()
                ->withInput()
                ->withErrors([
                    'factura_destino_id' => $errorDestino,
                ]);
        }

        /*
         * El IVA se calcula siempre en servidor.
         * Nunca se utiliza un valor enviado desde el navegador.
         */
        $datos['iva_mora'] = $this->calcularIva(
            $datos['valor_mora']
        );

        $mora = Mora::create($datos);

        /*
         * Sincronizar el estado de mora de las
         * facturas involucradas.
         */
        $this->sincronizarEstadosMora([
            $mora->factura_origen_id,
            $mora->factura_destino_id,
        ]);

        return redirect()
            ->route('moras.show', $mora)
            ->with(
                'success',
                'Mora registrada correctamente.'
            );
    }

    /**
     * Display the specified resource.
     */
    public function show(Mora $mora): View
    {
        $mora->load([
            'facturaOrigen.operacion.cliente',
            'operacionOrigen.cliente',
            'facturaDestino.operacion.cliente',
            'operacionDestino.cliente',
        ]);

        return view(
            'moras.show',
            compact('mora')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mora $mora): View
    {
        $operaciones = Operacion::query()
            ->with([
                'cliente',
                'facturas' => function ($query) use ($mora) {
                    $query
                        ->where(function ($subQuery) use ($mora) {
                            $subQuery
                                ->where(
                                    'estado',
                                    '!=',
                                    'anulada'
                                )
                                ->orWhere(
                                    'id',
                                    $mora->factura_origen_id
                                )
                                ->orWhere(
                                    'id',
                                    $mora->factura_destino_id
                                );
                        })
                        ->orderByDesc('fecha_emision')
                        ->orderByDesc('id');
                },
            ])
            ->orderByDesc('fecha_operacion')
            ->orderByDesc('id')
            ->get();

        $mora->load([
            'facturaOrigen',
            'operacionOrigen',
            'facturaDestino',
            'operacionDestino',
        ]);

        return view(
            'moras.edit',
            compact(
                'mora',
                'operaciones'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        Request $request,
        Mora $mora
    ): RedirectResponse {
        /*
         * Guardamos las facturas que estaban relacionadas
         * antes de realizar la modificación.
         *
         * Esto permite actualizar correctamente el estado
         * de una factura si la mora cambia de origen o destino.
         */
        $facturasAnteriores = [
            $mora->factura_origen_id,
            $mora->factura_destino_id,
        ];

        $datos = $this->validarDatos($request);

        $facturaOrigen = Factura::query()
            ->with('operacion')
            ->findOrFail(
                $datos['factura_origen_id']
            );

        $operacionOrigen = Operacion::findOrFail(
            $datos['operacion_origen_id']
        );

        /*
         * La factura de origen debe pertenecer
         * a la operación seleccionada.
         */
        if (
            (int) $facturaOrigen->operacion_id !==
            (int) $operacionOrigen->id
        ) {
            return back()
                ->withInput()
                ->withErrors([
                    'factura_origen_id' =>
                        'La factura de origen no pertenece a la operación de origen seleccionada.',
                ]);
        }

        /*
         * Una factura anulada no puede quedar
         * como origen de la mora.
         */
        if (
            strtolower((string) $facturaOrigen->estado) ===
            'anulada'
        ) {
            return back()
                ->withInput()
                ->withErrors([
                    'factura_origen_id' =>
                        'No se puede utilizar una factura anulada como origen de una mora.',
                ]);
        }

        $errorDestino = $this->validarDestino(
            $datos,
            $facturaOrigen
        );

        if ($errorDestino !== null) {
            return back()
                ->withInput()
                ->withErrors([
                    'factura_destino_id' => $errorDestino,
                ]);
        }

        /*
         * Recalcular siempre el IVA en servidor.
         */
        $datos['iva_mora'] = $this->calcularIva(
            $datos['valor_mora']
        );

        $mora->update($datos);

        /*
         * Sincronizamos tanto las facturas anteriores
         * como las nuevas.
         */
        $this->sincronizarEstadosMora([
            ...$facturasAnteriores,
            $mora->factura_origen_id,
            $mora->factura_destino_id,
        ]);

        return redirect()
            ->route('moras.show', $mora)
            ->with(
                'success',
                'Mora actualizada correctamente.'
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mora $mora): RedirectResponse
    {
        /*
         * Guardamos las facturas relacionadas antes
         * de eliminar la mora.
         */
        $facturasRelacionadas = [
            $mora->factura_origen_id,
            $mora->factura_destino_id,
        ];

        try {
            $mora->delete();
        } catch (QueryException $exception) {
            return redirect()
                ->route('moras.show', $mora)
                ->with(
                    'error',
                    'No se puede eliminar esta mora porque tiene registros asociados.'
                );
        }

        /*
         * Después de eliminar la mora, recalculamos
         * el estado real de las facturas relacionadas.
         */
        $this->sincronizarEstadosMora(
            $facturasRelacionadas
        );

        return redirect()
            ->route('moras.index')
            ->with(
                'success',
                'Mora eliminada correctamente.'
            );
    }

    /**
     * Validate the data received from the form.
     */
    private function validarDatos(
        Request $request
    ): array {
        return $request->validate(
            [
                'factura_origen_id' => [
                    'required',
                    'integer',
                    'exists:facturas,id',
                ],

                'operacion_origen_id' => [
                    'required',
                    'integer',
                    'exists:operaciones,id',
                ],

                'factura_destino_id' => [
                    'nullable',
                    'integer',
                    'exists:facturas,id',
                ],

                'operacion_destino_id' => [
                    'nullable',
                    'integer',
                    'exists:operaciones,id',
                ],

                'dias_atraso' => [
                    'required',
                    'integer',
                    'min:0',
                ],

                'valor_mora' => [
                    'required',
                    'numeric',
                    'min:0',
                ],

                'fecha' => [
                    'nullable',
                    'date',
                ],

                'observacion' => [
                    'nullable',
                    'string',
                ],
            ],
            [
                'factura_origen_id.required' =>
                    'La factura de origen es obligatoria.',

                'factura_origen_id.exists' =>
                    'La factura de origen seleccionada no existe.',

                'operacion_origen_id.required' =>
                    'La operación de origen es obligatoria.',

                'operacion_origen_id.exists' =>
                    'La operación de origen seleccionada no existe.',

                'factura_destino_id.exists' =>
                    'La factura de destino seleccionada no existe.',

                'operacion_destino_id.exists' =>
                    'La operación de destino seleccionada no existe.',

                'dias_atraso.required' =>
                    'Los días de atraso son obligatorios.',

                'dias_atraso.integer' =>
                    'Los días de atraso deben ser un número entero.',

                'dias_atraso.min' =>
                    'Los días de atraso no pueden ser negativos.',

                'valor_mora.required' =>
                    'El valor de la mora es obligatorio.',

                'valor_mora.numeric' =>
                    'El valor de la mora debe ser numérico.',

                'valor_mora.min' =>
                    'El valor de la mora no puede ser negativo.',

                'fecha.date' =>
                    'La fecha ingresada no es válida.',
            ]
        );
    }

    /**
     * Validate that destination invoice and operation correspond.
     *
     * Returns null when the destination is valid.
     * Returns an error message when it is not.
     */
    private function validarDestino(
        array $datos,
        Factura $facturaOrigen
    ): ?string {
        $facturaDestinoId =
            $datos['factura_destino_id'] ?? null;

        $operacionDestinoId =
            $datos['operacion_destino_id'] ?? null;

        /*
         * Si no existe destino, ambos campos
         * deben quedar vacíos.
         */
        if (
            $facturaDestinoId === null &&
            $operacionDestinoId === null
        ) {
            return null;
        }

        /*
         * Si se selecciona uno de los dos,
         * ambos son obligatorios.
         */
        if (
            $facturaDestinoId === null ||
            $operacionDestinoId === null
        ) {
            return 'La factura de destino y la operación de destino deben seleccionarse conjuntamente.';
        }

        $facturaDestino = Factura::findOrFail(
            $facturaDestinoId
        );

        /*
         * La factura de destino debe pertenecer
         * realmente a la operación seleccionada.
         */
        if (
            (int) $facturaDestino->operacion_id !==
            (int) $operacionDestinoId
        ) {
            return 'La factura de destino no pertenece a la operación de destino seleccionada.';
        }

        /*
         * La factura de destino no puede ser
         * la misma factura que originó la mora.
         */
        if (
            (int) $facturaDestino->id ===
            (int) $facturaOrigen->id
        ) {
            return 'La factura de destino no puede ser la misma factura que originó la mora.';
        }

        /*
         * No permitimos utilizar una factura anulada
         * como destino.
         */
        if (
            strtolower((string) $facturaDestino->estado) ===
            'anulada'
        ) {
            return 'No se puede trasladar la mora a una factura anulada.';
        }

        return null;
    }

    /**
     * Calculate VAT for the mora.
     */
    private function calcularIva(
        $valorMora
    ): float {
        return round(
            (float) $valorMora * 0.19,
            2
        );
    }

    /**
     * Synchronize the mora status of the affected invoices.
     *
     * A factura has "con_mora" when it has at least one
     * mora either as origin or as destination.
     *
     * Otherwise it remains "sin_mora".
     */
    private function sincronizarEstadosMora(
        array $facturaIds
    ): void {
        $facturaIds = collect($facturaIds)
            ->filter(
                fn ($id) => $id !== null
            )
            ->map(
                fn ($id) => (int) $id
            )
            ->unique()
            ->values();

        if ($facturaIds->isEmpty()) {
            return;
        }

        foreach ($facturaIds as $facturaId) {
            $tieneMora = Mora::query()
                ->where(function ($query) use ($facturaId) {
                    $query
                        ->where(
                            'factura_origen_id',
                            $facturaId
                        )
                        ->orWhere(
                            'factura_destino_id',
                            $facturaId
                        );
                })
                ->exists();

            Factura::query()
                ->whereKey($facturaId)
                ->update([
                    'estado_mora' => $tieneMora
                        ? 'con_mora'
                        : 'sin_mora',
                ]);
        }
    }
}