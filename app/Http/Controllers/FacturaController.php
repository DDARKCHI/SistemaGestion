<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\Operacion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class FacturaController extends Controller
{
    public function index(): View
    {
        $facturas = Factura::query()
            ->with([
                'operacion.cliente',
                'facturaReemplazada',
            ])
            ->orderByDesc('fecha_emision')
            ->orderByDesc('id')
            ->get();

        return view(
            'facturas.index',
            compact('facturas')
        );
    }

    public function create(): View
    {
        $operaciones = Operacion::query()
            ->with('cliente')
            ->orderByDesc('fecha_operacion')
            ->orderByDesc('id')
            ->get();

        $facturas = Factura::query()
            ->with('operacion.cliente')
            ->where('estado', 'vigente')
            ->orderByDesc('fecha_emision')
            ->orderByDesc('id')
            ->get();

        return view(
            'facturas.create',
            compact(
                'operaciones',
                'facturas'
            )
        );
    }

    public function store(Request $request): RedirectResponse
    {
        $datos = $this->validarDatos($request);

        $datos = $this->calcularMontos($datos);

        $factura = Factura::create($datos);

        return redirect()
            ->route('facturas.show', $factura)
            ->with(
                'success',
                'Factura registrada correctamente.'
            );
    }

    public function show(Factura $factura): View
    {
        $factura->load([
            'operacion.cliente',
            'facturaReemplazada.operacion.cliente',
            'reemplazos.operacion.cliente',
            'notasCredito',
            'factorings',
            'morasOrigen',
            'morasDestino',
        ]);

        return view(
            'facturas.show',
            compact('factura')
        );
    }

    public function edit(Factura $factura): View
    {
        $operaciones = Operacion::query()
            ->with('cliente')
            ->orderByDesc('fecha_operacion')
            ->orderByDesc('id')
            ->get();

        $facturas = Factura::query()
            ->with('operacion.cliente')
            ->where('id', '!=', $factura->id)
            ->where('estado', 'vigente')
            ->orderByDesc('fecha_emision')
            ->orderByDesc('id')
            ->get();

        $factura->load([
            'operacion.cliente',
            'facturaReemplazada',
        ]);

        return view(
            'facturas.edit',
            compact(
                'factura',
                'operaciones',
                'facturas'
            )
        );
    }

    public function update(
        Request $request,
        Factura $factura
    ): RedirectResponse {
        $datos = $this->validarDatos(
            $request,
            $factura
        );

        $datos = $this->calcularMontos($datos);

        $factura->update($datos);

        return redirect()
            ->route('facturas.show', $factura)
            ->with(
                'success',
                'Factura actualizada correctamente.'
            );
    }

    public function destroy(
        Factura $factura
    ): RedirectResponse {
        if (
            $factura->notasCredito()->exists() ||
            $factura->factorings()->exists() ||
            $factura->morasOrigen()->exists() ||
            $factura->morasDestino()->exists() ||
            $factura->reemplazos()->exists()
        ) {
            return redirect()
                ->route('facturas.show', $factura)
                ->with(
                    'error',
                    'No se puede eliminar esta factura porque tiene registros asociados.'
                );
        }

        $factura->delete();

        return redirect()
            ->route('facturas.index')
            ->with(
                'success',
                'Factura eliminada correctamente.'
            );
    }

    private function validarDatos(
        Request $request,
        ?Factura $factura = null
    ): array {
        $facturaId = $factura?->id;

        return $request->validate(
            [
                'operacion_id' => [
                    'required',
                    'integer',
                    'exists:operaciones,id',
                ],

                'numero_factura' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique(
                        'facturas',
                        'numero_factura'
                    )->ignore($facturaId),
                ],

                'factura_reemplazada_id' => [
                    'nullable',
                    'integer',
                    'exists:facturas,id',
                    function (
                        $attribute,
                        $value,
                        $fail
                    ) use ($factura) {

                        if (
                            $factura &&
                            (int) $value === (int) $factura->id
                        ) {
                            $fail(
                                'Una factura no puede reemplazarse a sí misma.'
                            );
                        }
                    },
                ],

                'fecha_emision' => [
                    'nullable',
                    'date',
                ],

                'fecha_vencimiento' => [
                    'nullable',
                    'date',
                    'after_or_equal:fecha_emision',
                ],

                'neto' => [
                    'required',
                    'integer',
                    'min:0',
                ],

                'estado' => [
                    'required',
                    Rule::in([
                        'vigente',
                        'anulada',
                        'reemplazada',
                    ]),
                ],

                'estado_mora' => [
                    'required',
                    Rule::in([
                        'sin_mora',
                        'con_mora',
                    ]),
                ],

                'fecha_pago' => [
                    'nullable',
                    'date',
                ],

                'fecha_cierre' => [
                    'nullable',
                    'date',
                ],

                'observaciones' => [
                    'nullable',
                    'string',
                ],
            ],
            [
                'operacion_id.required' =>
                    'Debe seleccionar una operación.',

                'operacion_id.integer' =>
                    'La operación seleccionada no es válida.',

                'operacion_id.exists' =>
                    'La operación seleccionada no existe.',

                'numero_factura.required' =>
                    'El número de factura es obligatorio.',

                'numero_factura.string' =>
                    'El número de factura no es válido.',

                'numero_factura.max' =>
                    'El número de factura no puede superar los 255 caracteres.',

                'numero_factura.unique' =>
                    'Ya existe una factura registrada con este número.',

                'factura_reemplazada_id.integer' =>
                    'La factura seleccionada para reemplazo no es válida.',

                'factura_reemplazada_id.exists' =>
                    'La factura seleccionada para reemplazo no existe.',

                'fecha_emision.date' =>
                    'La fecha de emisión no es válida.',

                'fecha_vencimiento.date' =>
                    'La fecha de vencimiento no es válida.',

                'fecha_vencimiento.after_or_equal' =>
                    'La fecha de vencimiento no puede ser anterior a la fecha de emisión.',

                'neto.required' =>
                    'El monto neto es obligatorio.',

                'neto.integer' =>
                    'El monto neto debe ser un valor entero, sin decimales.',

                'neto.min' =>
                    'El monto neto no puede ser negativo.',

                'estado.required' =>
                    'El estado de la factura es obligatorio.',

                'estado.in' =>
                    'El estado seleccionado no es válido.',

                'estado_mora.required' =>
                    'El estado de mora es obligatorio.',

                'estado_mora.in' =>
                    'El estado de mora seleccionado no es válido.',

                'fecha_pago.date' =>
                    'La fecha de pago no es válida.',

                'fecha_cierre.date' =>
                    'La fecha de cierre no es válida.',

                'observaciones.string' =>
                    'Las observaciones ingresadas no son válidas.',
            ]
        );
    }

    private function calcularMontos(
        array $datos
    ): array {
        $neto = (int) $datos['neto'];

        $iva = (int) round(
            $neto * 0.19
        );

        $total = $neto + $iva;

        return array_merge(
            $datos,
            [
                'neto' => $neto,
                'iva' => $iva,
                'total' => $total,
            ]
        );
    }
}