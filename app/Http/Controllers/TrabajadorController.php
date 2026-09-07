<?php

namespace App\Http\Controllers;

use App\Models\Trabajador;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TrabajadorController extends Controller
{
    /**
     * Mostrar listado de trabajadores.
     */
    public function index(): View
    {
        $trabajadores = Trabajador::query()
            ->orderBy('nombre')
            ->get();

        return view(
            'trabajadores.index',
            compact('trabajadores')
        );
    }

    /**
     * Mostrar formulario para crear trabajador.
     */
    public function create(): View
    {
        return view('trabajadores.create');
    }

    /**
     * Guardar trabajador.
     */
    public function store(Request $request): RedirectResponse
    {
        $datos = $request->validate(
            [
                'nombre' => [
                    'required',
                    'string',
                    'max:255',
                ],
                'rut' => [
                    'required',
                    'string',
                    'max:20',
                    'unique:trabajadores,rut',
                ],
                'direccion' => [
                    'nullable',
                    'string',
                    'max:255',
                ],
                'telefono' => [
                    'nullable',
                    'string',
                    'max:50',
                ],
                'correo' => [
                    'nullable',
                    'email',
                    'max:255',
                ],
                'fecha_ingreso' => [
                    'nullable',
                    'date',
                ],
                'remuneracion_acordada' => [
                    'nullable',
                    'numeric',
                    'min:0',
                ],
                'observaciones' => [
                    'nullable',
                    'string',
                ],
            ],
            [
                'nombre.required' =>
                    'El nombre del trabajador es obligatorio.',
                'nombre.string' =>
                    'El nombre del trabajador no es válido.',
                'nombre.max' =>
                    'El nombre no puede superar los 255 caracteres.',

                'rut.required' =>
                    'El RUT del trabajador es obligatorio.',
                'rut.string' =>
                    'El RUT ingresado no es válido.',
                'rut.max' =>
                    'El RUT no puede superar los 20 caracteres.',
                'rut.unique' =>
                    'Ya existe un trabajador registrado con este RUT.',

                'direccion.string' =>
                    'La dirección ingresada no es válida.',
                'direccion.max' =>
                    'La dirección no puede superar los 255 caracteres.',

                'telefono.string' =>
                    'El teléfono ingresado no es válido.',
                'telefono.max' =>
                    'El teléfono no puede superar los 50 caracteres.',

                'correo.email' =>
                    'El correo electrónico ingresado no es válido.',
                'correo.max' =>
                    'El correo no puede superar los 255 caracteres.',

                'fecha_ingreso.date' =>
                    'La fecha de ingreso no es válida.',

                'remuneracion_acordada.numeric' =>
                    'La remuneración acordada debe ser numérica.',
                'remuneracion_acordada.min' =>
                    'La remuneración acordada no puede ser negativa.',

                'observaciones.string' =>
                    'Las observaciones ingresadas no son válidas.',
            ]
        );

        Trabajador::create($datos);

        return redirect()
            ->route('trabajadores.index')
            ->with(
                'success',
                'Trabajador creado correctamente.'
            );
    }

    /**
     * Mostrar información del trabajador.
     */
    public function show(Trabajador $trabajador): View
    {
        $trabajador->load([
            'contratos.documentos',
            'contratos.modificaciones.documentos',
            'documentos',
            'horarios',
            'remuneraciones.documentos',
            'vacaciones',
            'ausencias',
            'faltas',
            'permisos',
            'cuadraturas',
        ]);

        return view(
            'trabajadores.show',
            compact('trabajador')
        );
    }

    /**
     * Mostrar formulario de edición.
     */
    public function edit(Trabajador $trabajador): View
    {
        return view(
            'trabajadores.edit',
            compact('trabajador')
        );
    }

    /**
     * Actualizar trabajador.
     */
    public function update(
        Request $request,
        Trabajador $trabajador
    ): RedirectResponse {
        $datos = $request->validate(
            [
                'nombre' => [
                    'required',
                    'string',
                    'max:255',
                ],
                'rut' => [
                    'required',
                    'string',
                    'max:20',
                    'unique:trabajadores,rut,' . $trabajador->id,
                ],
                'direccion' => [
                    'nullable',
                    'string',
                    'max:255',
                ],
                'telefono' => [
                    'nullable',
                    'string',
                    'max:50',
                ],
                'correo' => [
                    'nullable',
                    'email',
                    'max:255',
                ],
                'fecha_ingreso' => [
                    'nullable',
                    'date',
                ],
                'remuneracion_acordada' => [
                    'nullable',
                    'numeric',
                    'min:0',
                ],
                'observaciones' => [
                    'nullable',
                    'string',
                ],
            ],
            [
                'nombre.required' =>
                    'El nombre del trabajador es obligatorio.',
                'nombre.string' =>
                    'El nombre del trabajador no es válido.',
                'nombre.max' =>
                    'El nombre no puede superar los 255 caracteres.',

                'rut.required' =>
                    'El RUT del trabajador es obligatorio.',
                'rut.string' =>
                    'El RUT ingresado no es válido.',
                'rut.max' =>
                    'El RUT no puede superar los 20 caracteres.',
                'rut.unique' =>
                    'Ya existe otro trabajador registrado con este RUT.',

                'direccion.string' =>
                    'La dirección ingresada no es válida.',
                'direccion.max' =>
                    'La dirección no puede superar los 255 caracteres.',

                'telefono.string' =>
                    'El teléfono ingresado no es válido.',
                'telefono.max' =>
                    'El teléfono no puede superar los 50 caracteres.',

                'correo.email' =>
                    'El correo electrónico ingresado no es válido.',
                'correo.max' =>
                    'El correo no puede superar los 255 caracteres.',

                'fecha_ingreso.date' =>
                    'La fecha de ingreso no es válida.',

                'remuneracion_acordada.numeric' =>
                    'La remuneración acordada debe ser numérica.',
                'remuneracion_acordada.min' =>
                    'La remuneración acordada no puede ser negativa.',

                'observaciones.string' =>
                    'Las observaciones ingresadas no son válidas.',
            ]
        );

        $trabajador->update($datos);

        return redirect()
            ->route(
                'trabajadores.show',
                $trabajador
            )
            ->with(
                'success',
                'Trabajador actualizado correctamente.'
            );
    }

    /**
     * Eliminar trabajador.
     */
    public function destroy(
        Trabajador $trabajador
    ): RedirectResponse {
        $trabajador->delete();

        return redirect()
            ->route('trabajadores.index')
            ->with(
                'success',
                'Trabajador eliminado correctamente.'
            );
    }
}