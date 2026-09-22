<?php

namespace App\Http\Controllers;

use App\Models\Falta;
use App\Models\Trabajador;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FaltaController extends Controller
{
    public function create(Trabajador $trabajador): View
    {
        return view('faltas.create', compact('trabajador'));
    }

    public function store(
        Request $request,
        Trabajador $trabajador
    ): RedirectResponse {

        $datos = $request->validate(
            [
                'fecha' => [
                    'required',
                    'date',
                ],
                'tipo' => [
                    'nullable',
                    'string',
                    'max:255',
                ],
                'descripcion' => [
                    'nullable',
                    'string',
                ],
                'estado' => [
                    'required',
                    'in:pendiente,registrada,sancionada,cerrada',
                ],
                'sancion' => [
                    'nullable',
                    'string',
                ],
                'observaciones' => [
                    'nullable',
                    'string',
                ],
            ],
            [
                'fecha.required' =>
                    'La fecha es obligatoria.',

                'fecha.date' =>
                    'La fecha ingresada no es válida.',

                'tipo.max' =>
                    'El tipo de falta no puede superar los 255 caracteres.',

                'estado.required' =>
                    'El estado es obligatorio.',

                'estado.in' =>
                    'El estado seleccionado no es válido.',
            ]
        );

        $datos['trabajador_id'] = $trabajador->id;

        Falta::create($datos);

        return redirect()
            ->route('trabajadores.show', $trabajador)
            ->with(
                'success',
                'Falta registrada correctamente.'
            );
    }

    public function edit(
        Trabajador $trabajador,
        Falta $falta
    ): View {

        $this->validarTrabajador(
            $trabajador,
            $falta
        );

        return view(
            'faltas.edit',
            compact(
                'trabajador',
                'falta'
            )
        );
    }

    public function update(
        Request $request,
        Trabajador $trabajador,
        Falta $falta
    ): RedirectResponse {

        $this->validarTrabajador(
            $trabajador,
            $falta
        );

        $datos = $request->validate(
            [
                'fecha' => [
                    'required',
                    'date',
                ],
                'tipo' => [
                    'nullable',
                    'string',
                    'max:255',
                ],
                'descripcion' => [
                    'nullable',
                    'string',
                ],
                'estado' => [
                    'required',
                    'in:pendiente,registrada,sancionada,cerrada',
                ],
                'sancion' => [
                    'nullable',
                    'string',
                ],
                'observaciones' => [
                    'nullable',
                    'string',
                ],
            ],
            [
                'fecha.required' =>
                    'La fecha es obligatoria.',

                'fecha.date' =>
                    'La fecha ingresada no es válida.',

                'tipo.max' =>
                    'El tipo de falta no puede superar los 255 caracteres.',

                'estado.required' =>
                    'El estado es obligatorio.',

                'estado.in' =>
                    'El estado seleccionado no es válido.',
            ]
        );

        $falta->update($datos);

        return redirect()
            ->route('trabajadores.show', $trabajador)
            ->with(
                'success',
                'Falta actualizada correctamente.'
            );
    }

    public function destroy(
        Trabajador $trabajador,
        Falta $falta
    ): RedirectResponse {

        $this->validarTrabajador(
            $trabajador,
            $falta
        );

        $falta->delete();

        return redirect()
            ->route('trabajadores.show', $trabajador)
            ->with(
                'success',
                'Falta eliminada correctamente.'
            );
    }

    private function validarTrabajador(
        Trabajador $trabajador,
        Falta $falta
    ): void {

        abort_unless(
            (int) $falta->trabajador_id ===
            (int) $trabajador->id,
            404
        );
    }
}