<?php

namespace App\Http\Controllers;

use App\Models\Permiso;
use App\Models\Trabajador;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Throwable;

class PermisoController extends Controller
{
    public function create(
        Trabajador $trabajador
    ): View {

        return view(
            'permisos.create',
            compact('trabajador')
        );
    }

    public function store(
        Request $request,
        Trabajador $trabajador
    ): RedirectResponse {

        $datos = $this->validarDatos(
            $request
        );

        $datos = $this->prepararHorario(
            $datos
        );

        $datos['trabajador_id'] =
            $trabajador->id;

        $permiso =
            Permiso::create($datos);

        $this->enviarNotificacion(
            $trabajador,
            $permiso,
            'registrado'
        );

        return redirect()
            ->route(
                'trabajadores.show',
                $trabajador
            )
            ->with(
                'success',
                'Permiso registrado correctamente.'
            );
    }

    public function edit(
        Trabajador $trabajador,
        Permiso $permiso
    ): View {

        $this->validarTrabajador(
            $trabajador,
            $permiso
        );

        return view(
            'permisos.edit',
            compact(
                'trabajador',
                'permiso'
            )
        );
    }

    public function update(
        Request $request,
        Trabajador $trabajador,
        Permiso $permiso
    ): RedirectResponse {

        $this->validarTrabajador(
            $trabajador,
            $permiso
        );

        $datos = $this->validarDatos(
            $request
        );

        $datos = $this->prepararHorario(
            $datos
        );

        $permiso->update($datos);

        $permiso->refresh();

        $this->enviarNotificacion(
            $trabajador,
            $permiso,
            'actualizado'
        );

        return redirect()
            ->route(
                'trabajadores.show',
                $trabajador
            )
            ->with(
                'success',
                'Permiso actualizado correctamente.'
            );
    }

    public function destroy(
        Trabajador $trabajador,
        Permiso $permiso
    ): RedirectResponse {

        $this->validarTrabajador(
            $trabajador,
            $permiso
        );

        if ($permiso->documentos()->exists()) {

            return redirect()
                ->route(
                    'trabajadores.show',
                    $trabajador
                )
                ->with(
                    'error',
                    'No se puede eliminar el permiso porque tiene documentos asociados.'
                );
        }

        $permiso->delete();

        return redirect()
            ->route(
                'trabajadores.show',
                $trabajador
            )
            ->with(
                'success',
                'Permiso eliminado correctamente.'
            );
    }

    private function validarDatos(
        Request $request
    ): array {

        return $request->validate(
            [
                'tipo' => [
                    'required',
                    'in:dia_completo,horas',
                ],

                'fecha_inicio' => [
                    'required',
                    'date',
                ],

                'fecha_termino' => [
                    'nullable',
                    'date',
                    'after_or_equal:fecha_inicio',
                ],

                'hora_inicio' => [
                    'nullable',
                    'required_if:tipo,horas',
                    'date_format:H:i',
                ],

                'hora_termino' => [
                    'nullable',
                    'required_if:tipo,horas',
                    'date_format:H:i',
                ],

                'cantidad_horas' => [
                    'nullable',
                    'numeric',
                    'min:0.01',
                ],

                'estado' => [
                    'required',
                    'in:pendiente,justificado,injustificado',
                ],

                'motivo' => [
                    'nullable',
                    'string',
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
                'tipo.required' =>
                    'Debes seleccionar el tipo de permiso.',

                'tipo.in' =>
                    'El tipo de permiso seleccionado no es válido.',

                'fecha_inicio.required' =>
                    'La fecha de inicio es obligatoria.',

                'fecha_inicio.date' =>
                    'La fecha de inicio no es válida.',

                'fecha_termino.date' =>
                    'La fecha de término no es válida.',

                'fecha_termino.after_or_equal' =>
                    'La fecha de término no puede ser anterior a la fecha de inicio.',

                'hora_inicio.required_if' =>
                    'La hora de inicio es obligatoria para permisos por horas.',

                'hora_inicio.date_format' =>
                    'La hora de inicio no es válida.',

                'hora_termino.required_if' =>
                    'La hora de término es obligatoria para permisos por horas.',

                'hora_termino.date_format' =>
                    'La hora de término no es válida.',

                'cantidad_horas.numeric' =>
                    'La cantidad de horas debe ser numérica.',

                'cantidad_horas.min' =>
                    'La cantidad de horas debe ser mayor a cero.',

                'estado.required' =>
                    'Debes seleccionar el estado del permiso.',

                'estado.in' =>
                    'El estado seleccionado no es válido.',
            ]
        );
    }

    private function prepararHorario(
        array $datos
    ): array {

        if ($datos['tipo'] === 'dia_completo') {

            $datos['hora_inicio'] = null;
            $datos['hora_termino'] = null;
            $datos['cantidad_horas'] = null;

            return $datos;
        }

        $fechaTermino =
            $datos['fecha_termino']
                ?: $datos['fecha_inicio'];

        $inicio = Carbon::createFromFormat(
            'Y-m-d H:i',
            $datos['fecha_inicio'] .
            ' ' .
            $datos['hora_inicio']
        );

        $termino = Carbon::createFromFormat(
            'Y-m-d H:i',
            $fechaTermino .
            ' ' .
            $datos['hora_termino']
        );

        if ($termino->lessThanOrEqualTo($inicio)) {

            throw ValidationException::withMessages([
                'hora_termino' =>
                    'La fecha y hora de término deben ser posteriores a la fecha y hora de inicio.',
            ]);
        }

        $minutos =
            $inicio->diffInMinutes(
                $termino
            );

        $datos['cantidad_horas'] =
            round(
                $minutos / 60,
                2
            );

        return $datos;
    }

    private function validarTrabajador(
        Trabajador $trabajador,
        Permiso $permiso
    ): void {

        abort_unless(
            (int) $permiso->trabajador_id ===
            (int) $trabajador->id,
            404
        );
    }

    private function enviarNotificacion(
        Trabajador $trabajador,
        Permiso $permiso,
        string $accion
    ): void {

        if (!$trabajador->correo) {
            return;
        }

        try {
            $tipo =
                $permiso->tipo === 'dia_completo'
                    ? 'Día completo'
                    : 'Por horas';

            $estado = match ($permiso->estado) {
                'justificado' =>
                    'Justificado',

                'injustificado' =>
                    'Injustificado',

                default =>
                    'Pendiente',
            };

            $fechaInicio =
                $permiso->fecha_inicio
                    ? $permiso->fecha_inicio->format('d/m/Y')
                    : 'Sin fecha';

            $fechaTermino =
                $permiso->fecha_termino
                    ? $permiso->fecha_termino->format('d/m/Y')
                    : $fechaInicio;

            $horaInicio =
                $permiso->hora_inicio
                    ? substr(
                        $permiso->hora_inicio,
                        0,
                        5
                    )
                    : '—';

            $horaTermino =
                $permiso->hora_termino
                    ? substr(
                        $permiso->hora_termino,
                        0,
                        5
                    )
                    : '—';

            Mail::send(
                'emails.permiso',
                [
                    'titulo' =>
                        'Permiso ' . $accion,

                    'trabajador' =>
                        $trabajador,

                    'permiso' =>
                        $permiso,

                    'accion' =>
                        $accion,

                    'tipo' =>
                        $tipo,

                    'estado' =>
                        $estado,

                    'fechaInicio' =>
                        $fechaInicio,

                    'fechaTermino' =>
                        $fechaTermino,

                    'horaInicio' =>
                        $horaInicio,

                    'horaTermino' =>
                        $horaTermino,
                ],
                function ($mail) use (
                    $trabajador,
                    $accion
                ) {
                    $mail->to(
                        $trabajador->correo,
                        $trabajador->nombre
                    );

                    $mail->subject(
                        'Permiso ' .
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