<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProveedorController extends Controller
{
    /**
     * Lista de proveedores.
     */
    public function index(): View
    {
        $proveedores = Proveedor::query()
            ->withCount([
                'bodegas',
                'ejecutivos',
                'notasCredito as notas_credito_pendientes_count' => function ($query) {
                    $query->where('estado', 'pendiente');
                },
            ])
            ->orderBy('nombre')
            ->get();

        return view('proveedores.index', compact('proveedores'));
    }

    /**
     * Formulario para crear un proveedor.
     */
    public function create(): View
    {
        return view('proveedores.create');
    }

    /**
     * Guarda un nuevo proveedor.
     */
    public function store(Request $request): RedirectResponse
    {
        $datos = $this->validarDatos($request);

        $proveedor = Proveedor::create($datos);

        return redirect()
            ->route('proveedores.show', $proveedor)
            ->with('success', 'Proveedor registrado correctamente.');
    }

    /**
     * Muestra la ficha completa del proveedor.
     */
    public function show(Proveedor $proveedor): View
    {
        $proveedor->load([
            'bodegas' => function ($query) {
                $query->orderBy('nombre');
            },
            'ejecutivos' => function ($query) {
                $query->orderBy('nombre');
            },
            'notasCredito' => function ($query) {
                $query->orderByDesc('fecha')
                    ->orderByDesc('id');
            },
        ]);

        return view('proveedores.show', compact('proveedor'));
    }

    /**
     * Formulario para editar un proveedor.
     */
    public function edit(Proveedor $proveedor): View
    {
        return view('proveedores.edit', compact('proveedor'));
    }

    /**
     * Actualiza un proveedor.
     */
    public function update(Request $request, Proveedor $proveedor): RedirectResponse
    {
        $datos = $this->validarDatos($request, $proveedor);

        $proveedor->update($datos);

        return redirect()
            ->route('proveedores.show', $proveedor)
            ->with('success', 'Proveedor actualizado correctamente.');
    }

    /**
     * Elimina un proveedor.
     */
    public function destroy(Proveedor $proveedor): RedirectResponse
    {
        if (
            $proveedor->bodegas()->exists() ||
            $proveedor->ejecutivos()->exists() ||
            $proveedor->notasCredito()->exists()
        ) {
            return redirect()
                ->route('proveedores.show', $proveedor)
                ->with(
                    'error',
                    'No se puede eliminar este proveedor porque tiene bodegas, ejecutivos o notas de crédito asociadas.'
                );
        }

        $proveedor->delete();

        return redirect()
            ->route('proveedores.index')
            ->with('success', 'Proveedor eliminado correctamente.');
    }

    /**
     * Validación centralizada de proveedores.
     */
    private function validarDatos(
        Request $request,
        ?Proveedor $proveedor = null
    ): array {
        $proveedorId = $proveedor?->id;

        return $request->validate(
            [
                'nombre' => [
                    'required',
                    'string',
                    'max:150',
                ],

                'rut' => [
                    'required',
                    'string',
                    'max:20',
                    'unique:proveedores,rut,' . $proveedorId,
                ],

                'localidad' => [
                    'nullable',
                    'string',
                    'max:100',
                ],

                'cuenta' => [
                    'nullable',
                    'string',
                    'max:100',
                ],

                'direccion' => [
                    'nullable',
                    'string',
                    'max:255',
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
                'nombre.required' => 'El nombre del proveedor es obligatorio.',
                'nombre.string' => 'El nombre del proveedor no es válido.',
                'nombre.max' => 'El nombre del proveedor no puede superar los 150 caracteres.',

                'rut.required' => 'El RUT del proveedor es obligatorio.',
                'rut.string' => 'El RUT ingresado no es válido.',
                'rut.max' => 'El RUT no puede superar los 20 caracteres.',
                'rut.unique' => 'Ya existe un proveedor registrado con este RUT.',

                'localidad.string' => 'La localidad ingresada no es válida.',
                'localidad.max' => 'La localidad no puede superar los 100 caracteres.',

                'cuenta.string' => 'La cuenta ingresada no es válida.',
                'cuenta.max' => 'La cuenta no puede superar los 100 caracteres.',

                'direccion.string' => 'La dirección ingresada no es válida.',
                'direccion.max' => 'La dirección no puede superar los 255 caracteres.',

                'correo.email' => 'El correo electrónico ingresado no es válido.',
                'correo.max' => 'El correo no puede superar los 150 caracteres.',

                'telefono.string' => 'El teléfono ingresado no es válido.',
                'telefono.max' => 'El teléfono no puede superar los 50 caracteres.',

                'observaciones.string' => 'Las observaciones ingresadas no son válidas.',
            ]
        );
    }
}