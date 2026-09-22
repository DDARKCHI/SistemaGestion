<?php

namespace App\Http\Controllers;

use App\Models\Permiso;
use App\Models\Trabajador;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

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

        $datos = $request->validate(
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
                    'after:hora_inicio',
                ],

                'cantidad_horas' => [
                    'nullable',
                    'required_if:tipo,horas',
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

                'hora_termino.after' =>
                    'La hora de término debe ser posterior a la hora de inicio.',

                'cantidad_horas.required_if' =>
                    'Debes indicar la cantidad de horas del permiso.',

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

        if ($datos['tipo'] === 'dia_completo') {
            $datos['hora_inicio'] = null;
            $datos['hora_termino'] = null;
            $datos['cantidad_horas'] = null;
        }

        $datos['trabajador_id'] =
            $trabajador->id;

        Permiso::create($datos);

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

        $datos = $request->validate(
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
                    'after:hora_inicio',
                ],

                'cantidad_horas' => [
                    'nullable',
                    'required_if:tipo,horas',
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

                'hora_termino.after' =>
                    'La hora de término debe ser posterior a la hora de inicio.',

                'cantidad_horas.required_if' =>
                    'Debes indicar la cantidad de horas del permiso.',

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

        if ($datos['tipo'] === 'dia_completo') {
            $datos['hora_inicio'] = null;
            $datos['hora_termino'] = null;
            $datos['cantidad_horas'] = null;
        }

        $permiso->update($datos);

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
}