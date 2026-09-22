<?php

namespace App\Http\Controllers;

use App\Models\Trabajador;
use App\Models\Vacacion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class VacacionController extends Controller
{
    public function create(
        Trabajador $trabajador
    ): View {

        return view(
            'vacaciones.create',
            compact('trabajador')
        );
    }

    public function store(
        Request $request,
        Trabajador $trabajador
    ): RedirectResponse {

        $datos = $request->validate([
            'periodo' => [
                'required',
                'string',
                'max:255',
                Rule::unique('vacaciones', 'periodo')
                    ->where(
                        fn ($query) =>
                        $query->where(
                            'trabajador_id',
                            $trabajador->id
                        )
                    ),
            ],

            'dias_correspondientes' => [
                'required',
                'numeric',
                'min:0',
            ],

            'observaciones' => [
                'nullable',
                'string',
            ],
        ]);

        $diasCorrespondientes =
            (float) $datos['dias_correspondientes'];

        $vacacion = new Vacacion();

        $vacacion->trabajador_id =
            $trabajador->id;

        $vacacion->periodo =
            $datos['periodo'];

        $vacacion->dias_correspondientes =
            $diasCorrespondientes;

        $vacacion->dias_tomados = 0;

        $vacacion->dias_reservados = 0;

        $vacacion->dias_restantes =
            $diasCorrespondientes;

        $vacacion->estado =
            'no_tomadas';

        $vacacion->observaciones =
            $datos['observaciones'] ?? null;

        $vacacion->save();

        return redirect()
            ->route(
                'trabajadores.show',
                $trabajador
            )
            ->with(
                'success',
                'Período de vacaciones registrado correctamente.'
            );
    }

    public function edit(
        Trabajador $trabajador,
        Vacacion $vacacion
    ): View {

        $this->validarTrabajador(
            $trabajador,
            $vacacion
        );

        return view(
            'vacaciones.edit',
            compact(
                'trabajador',
                'vacacion'
            )
        );
    }

    public function update(
        Request $request,
        Trabajador $trabajador,
        Vacacion $vacacion
    ): RedirectResponse {

        $this->validarTrabajador(
            $trabajador,
            $vacacion
        );

        $datos = $request->validate([
            'periodo' => [
                'required',
                'string',
                'max:255',
                Rule::unique(
                    'vacaciones',
                    'periodo'
                )
                    ->where(
                        fn ($query) =>
                        $query->where(
                            'trabajador_id',
                            $trabajador->id
                        )
                    )
                    ->ignore($vacacion->id),
            ],

            'dias_correspondientes' => [
                'required',
                'numeric',
                'min:0',
            ],

            'observaciones' => [
                'nullable',
                'string',
            ],
        ]);

        $diasCorrespondientes =
            (float) $datos['dias_correspondientes'];

        $diasTomados =
            (float) $vacacion->dias_tomados;

        $diasReservados =
            (float) $vacacion->dias_reservados;

        $diasRestantes =
            $diasCorrespondientes
            - $diasTomados
            - $diasReservados;

        if ($diasRestantes < 0) {
            return back()
                ->withInput()
                ->withErrors([
                    'dias_correspondientes' =>
                        'Los días correspondientes no pueden ser menores que los días ya tomados o reservados.',
                ]);
        }

        $vacacion->periodo =
            $datos['periodo'];

        $vacacion->dias_correspondientes =
            $diasCorrespondientes;

        $vacacion->dias_restantes =
            $diasRestantes;

        $vacacion->estado =
            $this->calcularEstado(
                $diasCorrespondientes,
                $diasTomados,
                $diasReservados
            );

        $vacacion->observaciones =
            $datos['observaciones'] ?? null;

        $vacacion->save();

        return redirect()
            ->route(
                'trabajadores.show',
                $trabajador
            )
            ->with(
                'success',
                'Período de vacaciones actualizado correctamente.'
            );
    }

    public function destroy(
        Trabajador $trabajador,
        Vacacion $vacacion
    ): RedirectResponse {

        $this->validarTrabajador(
            $trabajador,
            $vacacion
        );

        DB::transaction(function () use ($vacacion) {

            $vacacion->detalles()->delete();

            $vacacion->delete();
        });

        return redirect()
            ->route(
                'trabajadores.show',
                $trabajador
            )
            ->with(
                'success',
                'Período de vacaciones eliminado correctamente.'
            );
    }

    private function validarTrabajador(
        Trabajador $trabajador,
        Vacacion $vacacion
    ): void {

        abort_unless(
            (int) $vacacion->trabajador_id ===
            (int) $trabajador->id,
            404
        );
    }

    private function calcularEstado(
        float $diasCorrespondientes,
        float $diasTomados,
        float $diasReservados
    ): string {

        if (
            $diasCorrespondientes > 0
            &&
            $diasTomados >=
            $diasCorrespondientes
        ) {
            return 'tomadas';
        }

        if (
            $diasTomados > 0
            ||
            $diasReservados > 0
        ) {
            return 'parcialmente_tomadas';
        }

        return 'no_tomadas';
    }
}