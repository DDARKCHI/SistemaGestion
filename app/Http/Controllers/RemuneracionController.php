<?php

namespace App\Http\Controllers;

use App\Models\Remuneracion;
use App\Models\Trabajador;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
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

                'monto_pagado' => [
                    'nullable',
                    'numeric',
                    'min:0',
                ],

                'fecha_pago' => [
                    'nullable',
                    'date',
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

                'monto_pagado.numeric' =>
                    'El monto pagado debe ser numérico.',

                'monto_pagado.min' =>
                    'El monto pagado no puede ser negativo.',

                'fecha_pago.date' =>
                    'La fecha de pago no es válida.',

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

        /*
        |--------------------------------------------------------------------------
        | Valores por defecto
        |--------------------------------------------------------------------------
        */

        $datos['trabajador_id'] = $trabajador->id;

        $datos['bonificaciones'] =
            $datos['bonificaciones'] ?? 0;

        $datos['descuentos'] =
            $datos['descuentos'] ?? 0;

        $datos['monto_pagado'] =
            $datos['monto_pagado'] ?? 0;

        /*
        |--------------------------------------------------------------------------
        | Cálculo automático del total líquido
        |--------------------------------------------------------------------------
        */

        $sueldoBase = (float) $datos['sueldo_base'];
        $bonificaciones = (float) $datos['bonificaciones'];
        $descuentos = (float) $datos['descuentos'];

        $totalLiquido =
            $sueldoBase
            + $bonificaciones
            - $descuentos;

        if ($totalLiquido < 0) {
            throw ValidationException::withMessages([
                'descuentos' =>
                    'Los descuentos no pueden superar el total de sueldo base más bonificaciones.',
            ]);
        }

        $totalLiquido = round($totalLiquido, 2);

        /*
        |--------------------------------------------------------------------------
        | Cálculo automático del saldo
        |--------------------------------------------------------------------------
        */

        $montoPagado = (float) $datos['monto_pagado'];

        if ($montoPagado > $totalLiquido) {
            throw ValidationException::withMessages([
                'monto_pagado' =>
                    'El monto pagado no puede ser superior al total líquido de la remuneración.',
            ]);
        }

        $saldoAPagar =
            round(
                $totalLiquido - $montoPagado,
                2
            );

        /*
        |--------------------------------------------------------------------------
        | Estado automático
        |--------------------------------------------------------------------------
        */

        if ($montoPagado <= 0) {

            $estado = 'pendiente';

        } elseif ($montoPagado < $totalLiquido) {

            $estado = 'parcialmente_pagada';

        } else {

            $estado = 'pagada';
        }

        /*
        |--------------------------------------------------------------------------
        | Fecha de pago
        |--------------------------------------------------------------------------
        |
        | Si no existe ningún pago, no corresponde registrar una fecha real
        | de pago.
        |
        */

        if ($montoPagado <= 0) {
            $datos['fecha_pago'] = null;
        }

        /*
        |--------------------------------------------------------------------------
        | Valores calculados
        |--------------------------------------------------------------------------
        */

        $datos['total_liquido'] = $totalLiquido;
        $datos['saldo_a_pagar'] = $saldoAPagar;
        $datos['estado'] = $estado;

        /*
        |--------------------------------------------------------------------------
        | Evitar remuneraciones duplicadas
        |--------------------------------------------------------------------------
        */

        $remuneracionExistente = Remuneracion::query()
            ->where('trabajador_id', $trabajador->id)
            ->where('periodo', $datos['periodo'])
            ->exists();

        if ($remuneracionExistente) {
            throw ValidationException::withMessages([
                'periodo' =>
                    'Ya existe una remuneración registrada para este trabajador en el período indicado.',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Guardar remuneración y documento
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use (
            $datos,
            $request
        ) {
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
        });

        /*
        |--------------------------------------------------------------------------
        | Mensaje final
        |--------------------------------------------------------------------------
        */

        $mensaje =
            'Remuneración registrada correctamente.';

        if ($request->hasFile('documento')) {
            $mensaje .=
                ' El documento quedó asociado a la remuneración.';
        }

        return redirect()
            ->route(
                'trabajadores.show',
                $trabajador
            )
            ->with(
                'success',
                $mensaje
            );
    }
}