<?php

namespace App\Http\Controllers;

use App\Models\Transportista;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TransportistaController extends Controller
{
    /**
     * Mostrar listado de transportistas.
     */
    public function index(): View
    {
        $transportistas = Transportista::query()
            ->withCount([
                'vehiculos',
                'serviciosTransporte',
                'gastos',
            ])
            ->orderBy('nombre')
            ->orderBy('id')
            ->get();

        return view(
            'transportistas.index',
            compact('transportistas')
        );
    }

    /**
     * Mostrar formulario de creación.
     */
    public function create(): View
    {
        return view('transportistas.create');
    }

    /**
     * Registrar un nuevo transportista.
     */
    public function store(Request $request): RedirectResponse
    {
        $datos = $this->validarDatos($request);

        $transportista = Transportista::create($datos);

        return redirect()
            ->route(
                'transportistas.show',
                $transportista
            )
            ->with(
                'success',
                'Transportista registrado correctamente.'
            );
    }

    /**
     * Mostrar ficha del transportista.
     */
    public function show(Transportista $transportista): View
    {
        $transportista->load([
            'vehiculos',
            'serviciosTransporte',
            'gastos.operacion.cliente',
        ]);

        return view(
            'transportistas.show',
            compact('transportista')
        );
    }

    /**
     * Mostrar formulario de edición.
     */
    public function edit(Transportista $transportista): View
    {
        return view(
            'transportistas.edit',
            compact('transportista')
        );
    }

    /**
     * Actualizar transportista.
     */
    public function update(
        Request $request,
        Transportista $transportista
    ): RedirectResponse {
        $datos = $this->validarDatos(
            $request,
            $transportista
        );

        $transportista->update($datos);

        return redirect()
            ->route(
                'transportistas.show',
                $transportista
            )
            ->with(
                'success',
                'Transportista actualizado correctamente.'
            );
    }

    /**
     * Eliminar transportista.
     */
    public function destroy(
        Transportista $transportista
    ): RedirectResponse {
        try {
            $transportista->delete();
        } catch (QueryException $exception) {
            return redirect()
                ->route(
                    'transportistas.show',
                    $transportista
                )
                ->with(
                    'error',
                    'No se puede eliminar este transportista porque tiene registros asociados.'
                );
        }

        return redirect()
            ->route('transportistas.index')
            ->with(
                'success',
                'Transportista eliminado correctamente.'
            );
    }

    /**
     * Validar datos del transportista.
     */
    private function validarDatos(
        Request $request,
        ?Transportista $transportista = null
    ): array {
        $rutRule = [
            'required',
            'string',
            'max:20',
            'unique:transportistas,rut',
        ];

        if ($transportista) {
            $rutRule = [
                'required',
                'string',
                'max:20',
                'unique:transportistas,rut,' .
                    $transportista->id,
            ];
        }

        return $request->validate(
            [
                'nombre' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'rut' => $rutRule,

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
                'nombre.required' =>
                    'El nombre del transportista es obligatorio.',

                'nombre.string' =>
                    'El nombre del transportista no es válido.',

                'nombre.max' =>
                    'El nombre del transportista no puede superar los 255 caracteres.',

                'rut.required' =>
                    'El RUT del transportista es obligatorio.',

                'rut.string' =>
                    'El RUT ingresado no es válido.',

                'rut.max' =>
                    'El RUT no puede superar los 20 caracteres.',

                'rut.unique' =>
                    'Ya existe un transportista registrado con este RUT.',

                'telefono.string' =>
                    'El teléfono ingresado no es válido.',

                'telefono.max' =>
                    'El teléfono no puede superar los 30 caracteres.',

                'correo.email' =>
                    'El correo electrónico ingresado no es válido.',

                'correo.max' =>
                    'El correo electrónico no puede superar los 255 caracteres.',

                'direccion.string' =>
                    'La dirección ingresada no es válida.',

                'direccion.max' =>
                    'La dirección no puede superar los 255 caracteres.',
            ]
        );
    }
}