<?php

namespace App\Http\Controllers;

use App\Models\Remuneracion;
use App\Models\Trabajador;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RemuneracionController extends Controller
{
    public function create(Trabajador $trabajador): View
    {
        return view(
            'trabajadores.remuneraciones.create',
            compact('trabajador')
        );
    }

    public function store(
        Request $request,
        Trabajador $trabajador
    ): RedirectResponse {
        $datos = $request->validate(
            [
                'periodo' => [
                    'required',
                    'string',
                    'max:20',
                ],

                'sueldo_base' => [
                    'required',
                    'numeric',
                    'min:0',
                ],

                'bonificaciones' => [
                    'nullable',
                    'numeric',
                    'min:0',
                ],

                'descuentos' => [
                    'nullable',
                    'numeric',
                    'min:0',
                ],

                'total_liquido' => [
                    'required',
                    'numeric',
                    'min:0',
                ],

                'monto_pagado' => [
                    'nullable',
                    'numeric',
                    'min:0',
                ],

                'fecha_pago' => [
                    'nullable',
                    'date',
                ],

                'estado' => [
                    'required',
                    'string',
                    'max:50',
                ],

                'observaciones' => [
                    'nullable',
                    'string',
                ],

                'documento' => [
                    'nullable',
                    'file',
                    'max:20480',
                    'mimes:pdf,jpg,jpeg,png,doc,docx,xls,xlsx',
                ],
            ],
            [
                'periodo.required' =>
                    'El período de la remuneración es obligatorio.',

                'periodo.max' =>
                    'El período no puede superar los 20 caracteres.',

                'sueldo_base.required' =>
                    'El sueldo base es obligatorio.',

                'sueldo_base.numeric' =>
                    'El sueldo base debe ser numérico.',

                'sueldo_base.min' =>
                    'El sueldo base no puede ser negativo.',

                'bonificaciones.numeric' =>
                    'Las bonificaciones deben ser numéricas.',

                'bonificaciones.min' =>
                    'Las bonificaciones no pueden ser negativas.',

                'descuentos.numeric' =>
                    'Los descuentos deben ser numéricos.',

                'descuentos.min' =>
                    'Los descuentos no pueden ser negativos.',

                'total_liquido.required' =>
                    'El total líquido es obligatorio.',

                'total_liquido.numeric' =>
                    'El total líquido debe ser numérico.',

                'total_liquido.min' =>
                    'El total líquido no puede ser negativo.',

                'monto_pagado.numeric' =>
                    'El monto pagado debe ser numérico.',

                'monto_pagado.min' =>
                    'El monto pagado no puede ser negativo.',

                'fecha_pago.date' =>
                    'La fecha de pago no es válida.',

                'estado.required' =>
                    'El estado de la remuneración es obligatorio.',

                'estado.max' =>
                    'El estado no puede superar los 50 caracteres.',

                'observaciones.string' =>
                    'Las observaciones ingresadas no son válidas.',

                'documento.file' =>
                    'El archivo seleccionado no es válido.',

                'documento.max' =>
                    'El archivo no puede superar los 20 MB.',

                'documento.mimes' =>
                    'El documento debe ser PDF, imagen, Word o Excel.',
            ]
        );

        $datos['trabajador_id'] = $trabajador->id;

        $datos['bonificaciones'] =
            $datos['bonificaciones'] ?? 0;

        $datos['descuentos'] =
            $datos['descuentos'] ?? 0;

        $datos['monto_pagado'] =
            $datos['monto_pagado'] ?? 0;

        $datos['saldo_a_pagar'] = max(
            0,
            (float) $datos['total_liquido']
                - (float) $datos['monto_pagado']
        );

        if ($datos['saldo_a_pagar'] <= 0) {

            $datos['estado'] = 'pagada';

        } elseif ((float) $datos['monto_pagado'] > 0) {

            $datos['estado'] = 'parcialmente_pagada';

        } else {

            $datos['estado'] = 'pendiente';
        }

        $remuneracion = Remuneracion::create($datos);

        if ($request->hasFile('documento')) {

            $archivo = $request->file('documento');

            $ruta = $archivo->store(
                'remuneraciones',
                'public'
            );

            $remuneracion->documentos()->create([
                'nombre' =>
                    $archivo->getClientOriginalName(),

                'tipo' =>
                    'Liquidación / documento de remuneración',

                'ruta' =>
                    $ruta,

                'mime_type' =>
                    $archivo->getClientMimeType(),

                'tamano' =>
                    $archivo->getSize(),

                'descripcion' =>
                    'Documento asociado a la remuneración mensual.',
            ]);
        }

        return redirect()
            ->route(
                'trabajadores.show',
                $trabajador
            )
            ->with(
                'success',
                'Remuneración registrada correctamente.'
                . (
                    $request->hasFile('documento')
                        ? ' El documento quedó asociado a la remuneración.'
                        : ''
                )
            );
    }
}