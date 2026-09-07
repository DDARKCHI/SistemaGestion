<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use App\Models\Trabajador;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HorarioController extends Controller
{
    /**
     * Mostrar formulario para crear un horario.
     */
    public function create(Trabajador $trabajador): View
    {
        return view(
            'trabajadores.horarios.create',
            compact('trabajador')
        );
    }

    /**
     * Guardar un nuevo horario.
     */
    public function store(
        Request $request,
        Trabajador $trabajador
    ): RedirectResponse {
        $datos = $this->validarDatos($request);

        $datos['trabajador_id'] = $trabajador->id;

        $datos = $this->calcularHoras($datos);

        Horario::create($datos);

        return redirect()
            ->route('trabajadores.show', $trabajador)
            ->with(
                'success',
                'Horario registrado correctamente.'
            );
    }

    /**
     * Mostrar formulario para editar un horario.
     */
    public function edit(
        Trabajador $trabajador,
        Horario $horario
    ): View {
        abort_unless(
            $horario->trabajador_id === $trabajador->id,
            404
        );

        return view(
            'trabajadores.horarios.edit',
            compact('trabajador', 'horario')
        );
    }

    /**
     * Actualizar un horario.
     */
    public function update(
        Request $request,
        Trabajador $trabajador,
        Horario $horario
    ): RedirectResponse {
        abort_unless(
            $horario->trabajador_id === $trabajador->id,
            404
        );

        $datos = $this->validarDatos($request);

        $datos = $this->calcularHoras($datos);

        $horario->update($datos);

        return redirect()
            ->route('trabajadores.show', $trabajador)
            ->with(
                'success',
                'Horario actualizado correctamente.'
            );
    }

    /**
     * Eliminar un horario.
     */
    public function destroy(
        Trabajador $trabajador,
        Horario $horario
    ): RedirectResponse {
        abort_unless(
            $horario->trabajador_id === $trabajador->id,
            404
        );

        $horario->delete();

        return redirect()
            ->route('trabajadores.show', $trabajador)
            ->with(
                'success',
                'Horario eliminado correctamente.'
            );
    }

    /**
     * Validar los datos recibidos desde el formulario.
     */
    private function validarDatos(Request $request): array
    {
        return $request->validate(
            [
                'tipo' => [
                    'required',
                    'string',
                    'max:100',
                ],

                'dia' => [
                    'required',
                    'string',
                    'max:50',
                ],

                'hora_inicio' => [
                    'nullable',
                    'date_format:H:i',
                ],

                'hora_termino' => [
                    'nullable',
                    'date_format:H:i',
                    'after:hora_inicio',
                ],

                'horas_diarias' => [
                    'nullable',
                    'numeric',
                    'min:0',
                    'max:24',
                ],

                'horas_semanales' => [
                    'nullable',
                    'numeric',
                    'min:0',
                    'max:168',
                ],

                'horas_mensuales' => [
                    'nullable',
                    'numeric',
                    'min:0',
                    'max:744',
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
            ],
            [
                'tipo.required' =>
                    'El tipo de horario es obligatorio.',

                'tipo.string' =>
                    'El tipo de horario no es válido.',

                'tipo.max' =>
                    'El tipo de horario no puede superar los 100 caracteres.',

                'dia.required' =>
                    'El día es obligatorio.',

                'dia.string' =>
                    'El día ingresado no es válido.',

                'dia.max' =>
                    'El día no puede superar los 50 caracteres.',

                'hora_inicio.date_format' =>
                    'La hora de inicio debe tener un formato válido.',

                'hora_termino.date_format' =>
                    'La hora de término debe tener un formato válido.',

                'hora_termino.after' =>
                    'La hora de término debe ser posterior a la hora de inicio.',

                'horas_diarias.numeric' =>
                    'Las horas diarias deben ser numéricas.',

                'horas_diarias.min' =>
                    'Las horas diarias no pueden ser negativas.',

                'horas_diarias.max' =>
                    'Las horas diarias no pueden superar las 24 horas.',

                'horas_semanales.numeric' =>
                    'Las horas semanales deben ser numéricas.',

                'horas_semanales.min' =>
                    'Las horas semanales no pueden ser negativas.',

                'horas_semanales.max' =>
                    'Las horas semanales no pueden superar las 168 horas.',

                'horas_mensuales.numeric' =>
                    'Las horas mensuales deben ser numéricas.',

                'horas_mensuales.min' =>
                    'Las horas mensuales no pueden ser negativas.',

                'horas_mensuales.max' =>
                    'Las horas mensuales no pueden superar las 744 horas.',

                'estado.required' =>
                    'El estado del horario es obligatorio.',

                'estado.max' =>
                    'El estado no puede superar los 50 caracteres.',

                'observaciones.string' =>
                    'Las observaciones ingresadas no son válidas.',
            ]
        );
    }

    /**
     * Calcular automáticamente las horas del horario.
     *
     * Lunes a viernes = 5 días.
     * Lunes a sábado = 6 días.
     *
     * Las horas mensuales se calculan como:
     *
     * horas semanales × 52 ÷ 12
     *
     * Todos los resultados se almacenan con un máximo
     * de un decimal.
     */
    private function calcularHoras(array $datos): array
    {
        $diasAutomaticos = [
            'Lunes a viernes' => 5,
            'Lunes a sábado' => 6,
        ];

        $esJornadaAutomatica = array_key_exists(
            $datos['dia'],
            $diasAutomaticos
        );

        /*
         * Si existen hora de inicio y término,
         * calcular las horas diarias automáticamente.
         */
        if (
            !empty($datos['hora_inicio']) &&
            !empty($datos['hora_termino'])
        ) {
            $inicio = strtotime($datos['hora_inicio']);
            $termino = strtotime($datos['hora_termino']);

            $minutos = ($termino - $inicio) / 60;

            $datos['horas_diarias'] = round(
                $minutos / 60,
                1
            );
        } elseif (isset($datos['horas_diarias'])) {
            $datos['horas_diarias'] = round(
                (float) $datos['horas_diarias'],
                1
            );
        }

        /*
         * Para lunes a viernes o lunes a sábado,
         * calcular automáticamente las horas semanales
         * y mensuales.
         */
        if ($esJornadaAutomatica) {

            $dias = $diasAutomaticos[$datos['dia']];

            $horasDiarias = (float) (
                $datos['horas_diarias'] ?? 0
            );

            $horasSemanales = $horasDiarias * $dias;

            $datos['horas_semanales'] = round(
                $horasSemanales,
                1
            );

            $datos['horas_mensuales'] = round(
                $horasSemanales * 52 / 12,
                1
            );
        } else {

            /*
             * Si se selecciona un día individual,
             * las horas semanales y mensuales pueden
             * ingresarse manualmente, pero se almacenan
             * con máximo un decimal.
             */
            if (isset($datos['horas_semanales'])) {
                $datos['horas_semanales'] = round(
                    (float) $datos['horas_semanales'],
                    1
                );
            }

            if (isset($datos['horas_mensuales'])) {
                $datos['horas_mensuales'] = round(
                    (float) $datos['horas_mensuales'],
                    1
                );
            }
        }

        return $datos;
    }
}