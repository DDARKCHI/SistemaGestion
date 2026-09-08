<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use App\Models\ProveedorBodega;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProveedorBodegaController extends Controller
{
    /**
     * Mostrar formulario para crear una bodega.
     */
    public function create(Proveedor $proveedor): View
    {
        return view('proveedores.bodegas.create', compact('proveedor'));
    }

    /**
     * Guardar una nueva bodega.
     */
    public function store(
        Request $request,
        Proveedor $proveedor
    ): RedirectResponse {
        $datos = $this->validarDatos($request);

        $proveedor->bodegas()->create($datos);

        return redirect()
            ->route('proveedores.show', $proveedor)
            ->with('success', 'Bodega registrada correctamente.');
    }

    /**
     * Mostrar formulario para editar una bodega.
     */
    public function edit(
        Proveedor $proveedor,
        ProveedorBodega $bodega
    ): View {
        $this->verificarBodegaPerteneceAlProveedor(
            $proveedor,
            $bodega
        );

        return view(
            'proveedores.bodegas.edit',
            compact('proveedor', 'bodega')
        );
    }

    /**
     * Actualizar una bodega existente.
     */
    public function update(
        Request $request,
        Proveedor $proveedor,
        ProveedorBodega $bodega
    ): RedirectResponse {
        $this->verificarBodegaPerteneceAlProveedor(
            $proveedor,
            $bodega
        );

        $datos = $this->validarDatos($request);

        $bodega->update($datos);

        return redirect()
            ->route('proveedores.show', $proveedor)
            ->with('success', 'Bodega actualizada correctamente.');
    }

    /**
     * Eliminar una bodega.
     */
    public function destroy(
        Proveedor $proveedor,
        ProveedorBodega $bodega
    ): RedirectResponse {
        $this->verificarBodegaPerteneceAlProveedor(
            $proveedor,
            $bodega
        );

        $bodega->delete();

        return redirect()
            ->route('proveedores.show', $proveedor)
            ->with('success', 'Bodega eliminada correctamente.');
    }

    /**
     * Validar los datos de la bodega.
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
                'direccion' => [
                    'required',
                    'string',
                    'max:255',
                ],
                'localidad' => [
                    'nullable',
                    'string',
                    'max:100',
                ],
                'observaciones' => [
                    'nullable',
                    'string',
                ],
            ],
            [
                'nombre.required' =>
                    'El nombre de la bodega es obligatorio.',
                'nombre.string' =>
                    'El nombre de la bodega no es válido.',
                'nombre.max' =>
                    'El nombre de la bodega no puede superar los 150 caracteres.',

                'direccion.required' =>
                    'La dirección de la bodega es obligatoria.',
                'direccion.string' =>
                    'La dirección ingresada no es válida.',
                'direccion.max' =>
                    'La dirección no puede superar los 255 caracteres.',

                'localidad.string' =>
                    'La localidad ingresada no es válida.',
                'localidad.max' =>
                    'La localidad no puede superar los 100 caracteres.',

                'observaciones.string' =>
                    'Las observaciones ingresadas no son válidas.',
            ]
        );
    }

    /**
     * Verificar que la bodega pertenezca al proveedor indicado
     * antes de permitir editarla o eliminarla.
     */
    private function verificarBodegaPerteneceAlProveedor(
        Proveedor $proveedor,
        ProveedorBodega $bodega
    ): void {
        abort_unless(
            $bodega->proveedor_id === $proveedor->id,
            404
        );
    }
}