<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use App\Models\ProveedorEjecutivo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProveedorEjecutivoController extends Controller
{
    /**
     * Mostrar formulario para crear un ejecutivo.
     */
    public function create(Proveedor $proveedor): View
    {
        return view(
            'proveedores.ejecutivos.create',
            compact('proveedor')
        );
    }

    /**
     * Guardar un nuevo ejecutivo.
     */
    public function store(
        Request $request,
        Proveedor $proveedor
    ): RedirectResponse {
        $datos = $this->validarDatos($request);

        $proveedor->ejecutivos()->create($datos);

        return redirect()
            ->route('proveedores.show', $proveedor)
            ->with('success', 'Ejecutivo registrado correctamente.');
    }

    /**
     * Mostrar formulario para editar un ejecutivo.
     */
    public function edit(
        Proveedor $proveedor,
        ProveedorEjecutivo $ejecutivo
    ): View {
        $this->verificarEjecutivoPerteneceAlProveedor(
            $proveedor,
            $ejecutivo
        );

        return view(
            'proveedores.ejecutivos.edit',
            compact('proveedor', 'ejecutivo')
        );
    }

    /**
     * Actualizar un ejecutivo existente.
     */
    public function update(
        Request $request,
        Proveedor $proveedor,
        ProveedorEjecutivo $ejecutivo
    ): RedirectResponse {
        $this->verificarEjecutivoPerteneceAlProveedor(
            $proveedor,
            $ejecutivo
        );

        $datos = $this->validarDatos($request);

        $ejecutivo->update($datos);

        return redirect()
            ->route('proveedores.show', $proveedor)
            ->with('success', 'Ejecutivo actualizado correctamente.');
    }

    /**
     * Eliminar un ejecutivo.
     */
    public function destroy(
        Proveedor $proveedor,
        ProveedorEjecutivo $ejecutivo
    ): RedirectResponse {
        $this->verificarEjecutivoPerteneceAlProveedor(
            $proveedor,
            $ejecutivo
        );

        $ejecutivo->delete();

        return redirect()
            ->route('proveedores.show', $proveedor)
            ->with('success', 'Ejecutivo eliminado correctamente.');
    }

    /**
     * Validar los datos del ejecutivo.
     */
    private function validarDatos(Request $request): array
    {
        return $request->validate(
            [
                'nombre' => [
                    'required',
                    'string',
                    'max:150',
                ],
                'cargo' => [
                    'nullable',
                    'string',
                    'max:100',
                ],
                'correo' => [
                    'nullable',
                    'email',
                    'max:150',
                ],
                'telefono' => [
                    'nullable',
                    'string',
                    'max:50',
                ],
                'observaciones' => [
                    'nullable',
                    'string',
                ],
            ],
            [
                'nombre.required' =>
                    'El nombre del ejecutivo es obligatorio.',
                'nombre.string' =>
                    'El nombre del ejecutivo no es válido.',
                'nombre.max' =>
                    'El nombre del ejecutivo no puede superar los 150 caracteres.',

                'cargo.string' =>
                    'El cargo ingresado no es válido.',
                'cargo.max' =>
                    'El cargo no puede superar los 100 caracteres.',

                'correo.email' =>
                    'El correo electrónico ingresado no es válido.',
                'correo.max' =>
                    'El correo no puede superar los 150 caracteres.',

                'telefono.string' =>
                    'El teléfono ingresado no es válido.',
                'telefono.max' =>
                    'El teléfono no puede superar los 50 caracteres.',

                'observaciones.string' =>
                    'Las observaciones ingresadas no son válidas.',
            ]
        );
    }

    /**
     * Verificar que el ejecutivo pertenezca al proveedor indicado.
     */
    private function verificarEjecutivoPerteneceAlProveedor(
        Proveedor $proveedor,
        ProveedorEjecutivo $ejecutivo
    ): void {
        abort_unless(
            $ejecutivo->proveedor_id === $proveedor->id,
            404
        );
    }
}