<?php

namespace App\Http\Controllers;

use App\Models\Ausencia;
use App\Models\Trabajador;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Throwable;

class AusenciaController extends Controller
{
    public function create(Trabajador $trabajador): View
    {
        return view(
            'ausencias.create',
            compact('trabajador')
        );
    }

    public function store(
        Request $request,
        Trabajador $trabajador
    ): RedirectResponse {

        $datos = $request->validate(
            [
                'fecha_inicio' => [
                    'required',
                    'date',
                ],
                'fecha_termino' => [
                    'nullable',
                    'date',
                    'after_or_equal:fecha_inicio',
                ],
                'dias' => [
                    'required',
                    'numeric',
                    'min:0.5',
                ],
                'tipo' => [
                    'nullable',
                    'string',
                    'max:255',
                ],
                'estado' => [
                    'required',
                    'in:pendiente,justificada,injustificada',
                ],
                'justificacion' => [
                    'nullable',
                    'string',
                ],
                'observaciones' => [
                    'nullable',
                    'string',
                ],
            ],
            [
                'fecha_inicio.required' =>
                    'La fecha de inicio es obligatoria.',

                'fecha_inicio.date' =>
                    'La fecha de inicio no es válida.',

                'fecha_termino.date' =>
                    'La fecha de término no es válida.',

                'fecha_termino.after_or_equal' =>
                    'La fecha de término debe ser igual o posterior a la fecha de inicio.',

                'dias.required' =>
                    'La cantidad de días es obligatoria.',

                'dias.numeric' =>
                    'La cantidad de días debe ser un número.',

                'dias.min' =>
                    'La cantidad de días debe ser al menos 0.5.',

                'tipo.max' =>
                    'El tipo de ausencia no puede superar los 255 caracteres.',

                'estado.required' =>
                    'El estado es obligatorio.',

                'estado.in' =>
                    'El estado seleccionado no es válido.',
            ]
        );

        $datos['trabajador_id'] =
            $trabajador->id;

        $ausencia =
            Ausencia::create($datos);

        $this->enviarNotificacion(
            $trabajador,
            $ausencia,
            'registrada'
        );

        return redirect()
            ->route(
                'trabajadores.show',
                $trabajador
            )
            ->with(
                'success',
                'Ausencia registrada correctamente.'
            );
    }

    public function edit(
        Trabajador $trabajador,
        Ausencia $ausencia
    ): View {

        $this->validarTrabajador(
            $trabajador,
            $ausencia
        );

        return view(
            'ausencias.edit',
            compact(
                'trabajador',
                'ausencia'
            )
        );
    }

    public function update(
        Request $request,
        Trabajador $trabajador,
        Ausencia $ausencia
    ): RedirectResponse {

        $this->validarTrabajador(
            $trabajador,
            $ausencia
        );

        $datos = $request->validate(
            [
                'fecha_inicio' => [
                    'required',
                    'date',
                ],
                'fecha_termino' => [
                    'nullable',
                    'date',
                    'after_or_equal:fecha_inicio',
                ],
                'dias' => [
                    'required',
                    'numeric',
                    'min:0.5',
                ],
                'tipo' => [
                    'nullable',
                    'string',
                    'max:255',
                ],
                'estado' => [
                    'required',
                    'in:pendiente,justificada,injustificada',
                ],
                'justificacion' => [
                    'nullable',
                    'string',
                ],
                'observaciones' => [
                    'nullable',
                    'string',
                ],
            ],
            [
                'fecha_inicio.required' =>
                    'La fecha de inicio es obligatoria.',

                'fecha_inicio.date' =>
                    'La fecha de inicio no es válida.',

                'fecha_termino.date' =>
                    'La fecha de término no es válida.',

                'fecha_termino.after_or_equal' =>
                    'La fecha de término debe ser igual o posterior a la fecha de inicio.',

                'dias.required' =>
                    'La cantidad de días es obligatoria.',

                'dias.numeric' =>
                    'La cantidad de días debe ser un número.',

                'dias.min' =>
                    'La cantidad de días debe ser al menos 0.5.',

                'tipo.max' =>
                    'El tipo de ausencia no puede superar los 255 caracteres.',

                'estado.required' =>
                    'El estado es obligatorio.',

                'estado.in' =>
                    'El estado seleccionado no es válido.',
            ]
        );

        $ausencia->update($datos);

        $ausencia->refresh();

        $this->enviarNotificacion(
            $trabajador,
            $ausencia,
            'actualizada'
        );

        return redirect()
            ->route(
                'trabajadores.show',
                $trabajador
            )
            ->with(
                'success',
                'Ausencia actualizada correctamente.'
            );
    }

    public function destroy(
        Trabajador $trabajador,
        Ausencia $ausencia
    ): RedirectResponse {

        $this->validarTrabajador(
            $trabajador,
            $ausencia
        );

        $ausencia->delete();

        return redirect()
            ->route(
                'trabajadores.show',
                $trabajador
            )
            ->with(
                'success',
                'Ausencia eliminada correctamente.'
            );
    }

    private function validarTrabajador(
        Trabajador $trabajador,
        Ausencia $ausencia
    ): void {

        abort_unless(
            (int) $ausencia->trabajador_id ===
            (int) $trabajador->id,
            404
        );
    }

    private function enviarNotificacion(
        Trabajador $trabajador,
        Ausencia $ausencia,
        string $accion
    ): void {

        if (!$trabajador->correo) {
            return;
        }

        try {
            $estado = match ($ausencia->estado) {
                'justificada' =>
                    'Justificada',

                'injustificada' =>
                    'Injustificada',

                default =>
                    'Pendiente',
            };

            $fechaInicio =
                $ausencia->fecha_inicio
                    ? Carbon::parse(
                        $ausencia->fecha_inicio
                    )->format('d/m/Y')
                    : 'Sin fecha';

            $fechaTermino =
                $ausencia->fecha_termino
                    ? Carbon::parse(
                        $ausencia->fecha_termino
                    )->format('d/m/Y')
                    : $fechaInicio;

            $accionMensaje =
                $accion === 'registrada'
                    ? 'registrado'
                    : 'actualizado';

            $mensaje =
                "Hola {$trabajador->nombre},\n\n" .
                "Se ha {$accionMensaje} una ausencia asociada a tu registro.\n\n" .
                "Desde: {$fechaInicio}\n" .
                "Hasta: {$fechaTermino}\n" .
                "Días: {$ausencia->dias}\n" .
                "Estado: {$estado}\n";

            if ($ausencia->tipo) {
                $mensaje .=
                    "Tipo: {$ausencia->tipo}\n";
            }

            if ($ausencia->justificacion) {
                $mensaje .=
                    "Justificación: {$ausencia->justificacion}\n";
            }

            if ($ausencia->observaciones) {
                $mensaje .=
                    "Observaciones: {$ausencia->observaciones}\n";
            }

            $mensaje .=
                "\nEste correo fue generado automáticamente por el sistema.";

            Mail::raw(
                $mensaje,
                function ($mail) use (
                    $trabajador,
                    $accion
                ) {
                    $mail->to(
                        $trabajador->correo,
                        $trabajador->nombre
                    );

                    $mail->subject(
                        'Ausencia ' .
                        $accion .
                        ' - Sistema de Gestión'
                    );
                }
            );
        } catch (Throwable $e) {
            report($e);
        }
    }
}