<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClienteController extends Controller
{
    /**
     * Listado de clientes.
     */
    public function index(): View
    {
        $clientes = Cliente::orderBy('razon_social')->get();

        return view('clientes.index', compact('clientes'));
    }


    /**
     * Formulario para crear cliente.
     */
    public function create(): View
    {
        return view('clientes.create');
    }


    /**
     * Guardar nuevo cliente.
     */
    public function store(Request $request): RedirectResponse
    {
        $datos = $request->validate(
            [
                'razon_social' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'rut' => [
                    'required',
                    'string',
                    'max:20',
                    'unique:clientes,rut',
                ],

                'comuna' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'telefono' => [
                    'nullable',
                    'string',
                    'max:30',
                ],

                'correo' => [
                    'nullable',
                    'email',
                    'max:255',
                ],

                'direccion' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'observaciones' => [
                    'nullable',
                    'string',
                ],
            ],
            [
                'razon_social.required' =>
                    'La razón social es obligatoria.',

                'razon_social.string' =>
                    'La razón social debe ser un texto válido.',

                'razon_social.max' =>
                    'La razón social no puede superar los 255 caracteres.',


                'rut.required' =>
                    'El RUT es obligatorio.',

                'rut.string' =>
                    'El RUT debe ser un texto válido.',

                'rut.max' =>
                    'El RUT no puede superar los 20 caracteres.',

                'rut.unique' =>
                    'El RUT ingresado ya está registrado.',


                'comuna.string' =>
                    'La comuna debe ser un texto válido.',

                'comuna.max' =>
                    'La comuna no puede superar los 255 caracteres.',


                'telefono.string' =>
                    'El teléfono debe ser un texto válido.',

                'telefono.max' =>
                    'El teléfono no puede superar los 30 caracteres.',


                'correo.email' =>
                    'El correo electrónico ingresado no es válido.',

                'correo.max' =>
                    'El correo electrónico no puede superar los 255 caracteres.',


                'direccion.string' =>
                    'La dirección debe ser un texto válido.',

                'direccion.max' =>
                    'La dirección no puede superar los 255 caracteres.',


                'observaciones.string' =>
                    'Las observaciones deben ser un texto válido.',
            ]
        );


        Cliente::create($datos);


        return redirect()
            ->route('clientes.index')
            ->with(
                'success',
                'Cliente creado correctamente.'
            );
    }


    /**
     * Mostrar detalle del cliente.
     */
    public function show(Cliente $cliente): View
    {
        $cliente->load([
            'operaciones',
            'reclamos',
            'juicios',
            'contratosSuministro',
        ]);

        return view(
            'clientes.show',
            compact('cliente')
        );
    }


    /**
     * Formulario para editar cliente.
     */
    public function edit(Cliente $cliente): View
    {
        return view(
            'clientes.edit',
            compact('cliente')
        );
    }


    /**
     * Actualizar cliente.
     */
    public function update(
        Request $request,
        Cliente $cliente
    ): RedirectResponse {

        $datos = $request->validate(
            [
                'razon_social' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'rut' => [
                    'required',
                    'string',
                    'max:20',
                    'unique:clientes,rut,' . $cliente->id,
                ],

                'comuna' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'telefono' => [
                    'nullable',
                    'string',
                    'max:30',
                ],

                'correo' => [
                    'nullable',
                    'email',
                    'max:255',
                ],

                'direccion' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'observaciones' => [
                    'nullable',
                    'string',
                ],
            ],
            [
                'razon_social.required' =>
                    'La razón social es obligatoria.',

                'razon_social.string' =>
                    'La razón social debe ser un texto válido.',

                'razon_social.max' =>
                    'La razón social no puede superar los 255 caracteres.',


                'rut.required' =>
                    'El RUT es obligatorio.',

                'rut.string' =>
                    'El RUT debe ser un texto válido.',

                'rut.max' =>
                    'El RUT no puede superar los 20 caracteres.',

                'rut.unique' =>
                    'El RUT ingresado ya está registrado por otro cliente.',


                'comuna.string' =>
                    'La comuna debe ser un texto válido.',

                'comuna.max' =>
                    'La comuna no puede superar los 255 caracteres.',


                'telefono.string' =>
                    'El teléfono debe ser un texto válido.',

                'telefono.max' =>
                    'El teléfono no puede superar los 30 caracteres.',


                'correo.email' =>
                    'El correo electrónico ingresado no es válido.',

                'correo.max' =>
                    'El correo electrónico no puede superar los 255 caracteres.',


                'direccion.string' =>
                    'La dirección debe ser un texto válido.',

                'direccion.max' =>
                    'La dirección no puede superar los 255 caracteres.',


                'observaciones.string' =>
                    'Las observaciones deben ser un texto válido.',
            ]
        );


        $cliente->update($datos);


        return redirect()
            ->route('clientes.index')
            ->with(
                'success',
                'Cliente actualizado correctamente.'
            );
    }


    /**
     * Eliminar cliente.
     */
    public function destroy(
        Cliente $cliente
    ): RedirectResponse {

        $cliente->delete();


        return redirect()
            ->route('clientes.index')
            ->with(
                'success',
                'Cliente eliminado correctamente.'
            );
    }
}