<?php

namespace App\Http\Controllers;

use App\Models\DetalleVacacion;
use App\Models\Trabajador;
use App\Models\Vacacion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DetalleVacacionController extends Controller
{
    public function create(
        Trabajador $trabajador,
        Vacacion $vacacion
    ): View {

        $this->validarVacacion(
            $trabajador,
            $vacacion
        );

        return view(
            'vacaciones.detalles.create',
            compact(
                'trabajador',
                'vacacion'
            )
        );
    }

    public function store(
        Request $request,
        Trabajador $trabajador,
        Vacacion $vacacion
    ): RedirectResponse {

        $this->validarVacacion(
            $trabajador,
            $vacacion
        );

        $datos = $request->validate([
            'fecha_inicio' => [
                'required',
                'date',
            ],

            'fecha_termino' => [
                'required',
                'date',
                'after_or_equal:fecha_inicio',
            ],

            'dias' => [
                'required',
                'numeric',
                'min:0.5',
            ],

            'tipo' => [
                'required',
                'in:tomada,reservada',
            ],

            'observaciones' => [
                'nullable',
                'string',
            ],
        ]);

        $dias = (float) $datos['dias'];

        $diasDisponibles =
            (float) $vacacion->dias_restantes;

        if ($dias > $diasDisponibles) {
            return back()
                ->withInput()
                ->withErrors([
                    'dias' =>
                        'La cantidad de días no puede superar los días disponibles del período.',
                ]);
        }

        DetalleVacacion::create([
            'vacacion_id' => $vacacion->id,
            'fecha_inicio' => $datos['fecha_inicio'],
            'fecha_termino' => $datos['fecha_termino'],
            'dias' => $dias,
            'tipo' => $datos['tipo'],
            'observaciones' =>
                $datos['observaciones'] ?? null,
        ]);

        $this->recalcularVacacion($vacacion);

        return redirect()
            ->route(
                'trabajadores.show',
                $trabajador
            )
            ->with(
                'success',
                'Detalle de vacaciones registrado correctamente.'
            );
    }

    public function edit(
        Trabajador $trabajador,
        Vacacion $vacacion,
        DetalleVacacion $detalleVacacion
    ): View {

        $this->validarDetalle(
            $trabajador,
            $vacacion,
            $detalleVacacion
        );

        return view(
            'vacaciones.detalles.edit',
            compact(
                'trabajador',
                'vacacion',
                'detalleVacacion'
            )
        );
    }

    public function update(
        Request $request,
        Trabajador $trabajador,
        Vacacion $vacacion,
        DetalleVacacion $detalleVacacion
    ): RedirectResponse {

        $this->validarDetalle(
            $trabajador,
            $vacacion,
            $detalleVacacion
        );

        $datos = $request->validate([
            'fecha_inicio' => [
                'required',
                'date',
            ],

            'fecha_termino' => [
                'required',
                'date',
                'after_or_equal:fecha_inicio',
            ],

            'dias' => [
                'required',
                'numeric',
                'min:0.5',
            ],

            'tipo' => [
                'required',
                'in:tomada,reservada',
            ],

            'observaciones' => [
                'nullable',
                'string',
            ],
        ]);

        $dias = (float) $datos['dias'];

        $otrosDiasTomados =
            (float) $vacacion->detalles()
                ->where('id', '!=', $detalleVacacion->id)
                ->where('tipo', 'tomada')
                ->sum('dias');

        $otrosDiasReservados =
            (float) $vacacion->detalles()
                ->where('id', '!=', $detalleVacacion->id)
                ->where('tipo', 'reservada')
                ->sum('dias');

        $diasOcupados =
            $otrosDiasTomados
            + $otrosDiasReservados;

        $diasDisponibles =
            (float) $vacacion->dias_correspondientes
            - $diasOcupados;

        if ($dias > $diasDisponibles) {
            return back()
                ->withInput()
                ->withErrors([
                    'dias' =>
                        'La cantidad de días no puede superar los días disponibles del período.',
                ]);
        }

        $detalleVacacion->update([
            'fecha_inicio' => $datos['fecha_inicio'],
            'fecha_termino' => $datos['fecha_termino'],
            'dias' => $dias,
            'tipo' => $datos['tipo'],
            'observaciones' =>
                $datos['observaciones'] ?? null,
        ]);

        $this->recalcularVacacion($vacacion);

        return redirect()
            ->route(
                'trabajadores.show',
                $trabajador
            )
            ->with(
                'success',
                'Detalle de vacaciones actualizado correctamente.'
            );
    }

    public function destroy(
        Trabajador $trabajador,
        Vacacion $vacacion,
        DetalleVacacion $detalleVacacion
    ): RedirectResponse {

        $this->validarDetalle(
            $trabajador,
            $vacacion,
            $detalleVacacion
        );

        $detalleVacacion->delete();

        $this->recalcularVacacion($vacacion);

        return redirect()
            ->route(
                'trabajadores.show',
                $trabajador
            )
            ->with(
                'success',
                'Detalle de vacaciones eliminado correctamente.'
            );
    }

    private function validarVacacion(
        Trabajador $trabajador,
        Vacacion $vacacion
    ): void {

        abort_unless(
            $vacacion->trabajador_id === $trabajador->id,
            404
        );
    }

    private function validarDetalle(
        Trabajador $trabajador,
        Vacacion $vacacion,
        DetalleVacacion $detalleVacacion
    ): void {

        $this->validarVacacion(
            $trabajador,
            $vacacion
        );

        abort_unless(
            $detalleVacacion->vacacion_id === $vacacion->id,
            404
        );
    }

    private function recalcularVacacion(
        Vacacion $vacacion
    ): void {

        $diasTomados =
            (float) $vacacion->detalles()
                ->where('tipo', 'tomada')
                ->sum('dias');

        $diasReservados =
            (float) $vacacion->detalles()
                ->where('tipo', 'reservada')
                ->sum('dias');

        $diasCorrespondientes =
            (float) $vacacion->dias_correspondientes;

        $diasRestantes =
            $diasCorrespondientes
            - $diasTomados
            - $diasReservados;

        if ($diasRestantes < 0) {
            $diasRestantes = 0;
        }

        if (
            $diasCorrespondientes > 0
            && $diasTomados >= $diasCorrespondientes
        ) {
            $estado = 'tomadas';
        } elseif (
            $diasTomados > 0
            || $diasReservados > 0
        ) {
            $estado = 'parcialmente_tomadas';
        } else {
            $estado = 'no_tomadas';
        }

        $vacacion->update([
            'dias_tomados' => $diasTomados,
            'dias_reservados' => $diasReservados,
            'dias_restantes' => $diasRestantes,
            'estado' => $estado,
        ]);
    }
}