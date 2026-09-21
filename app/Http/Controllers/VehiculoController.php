<?php

namespace App\Http\Controllers;

use App\Models\Transportista;
use App\Models\Vehiculo;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VehiculoController extends Controller
{
    /**
     * Mostrar listado de vehículos.
     */
    public function index(): View
    {
        $vehiculos = Vehiculo::query()
            ->with('transportista')
            ->withCount('serviciosTransporte')
            ->orderBy('patente')
            ->orderBy('id')
            ->get();

        return view(
            'vehiculos.index',
            compact('vehiculos')
        );
    }

    /**
     * Mostrar formulario para registrar vehículo.
     */
    public function create(Request $request): View
    {
        $transportistas = Transportista::query()
            ->orderBy('nombre')
            ->orderBy('id')
            ->get();

        $transportistaSeleccionado = null;

        if ($request->filled('transportista_id')) {
            $transportistaSeleccionado = Transportista::query()
                ->find($request->integer('transportista_id'));
        }

        return view(
            'vehiculos.create',
            compact(
                'transportistas',
                'transportistaSeleccionado'
            )
        );
    }

    /**
     * Guardar nuevo vehículo.
     */
    public function store(Request $request): RedirectResponse
    {
        $datos = $this->validarDatos($request);

        $vehiculo = Vehiculo::create($datos);

        return redirect()
            ->route('vehiculos.show', $vehiculo)
            ->with(
                'success',
                'Vehículo registrado correctamente.'
            );
    }

    /**
     * Mostrar detalle del vehículo.
     */
    public function show(Vehiculo $vehiculo): View
    {
        $vehiculo->load([
            'transportista',
            'serviciosTransporte.operacion.cliente',
        ]);

        return view(
            'vehiculos.show',
            compact('vehiculo')
        );
    }

    /**
     * Mostrar formulario de edición.
     */
    public function edit(Vehiculo $vehiculo): View
    {
        $transportistas = Transportista::query()
            ->orderBy('nombre')
            ->orderBy('id')
            ->get();

        $vehiculo->load('transportista');

        return view(
            'vehiculos.edit',
            compact(
                'vehiculo',
                'transportistas'
            )
        );
    }

    /**
     * Actualizar vehículo.
     */
    public function update(
        Request $request,
        Vehiculo $vehiculo
    ): RedirectResponse {
        $datos = $this->validarDatos(
            $request,
            $vehiculo
        );

        $vehiculo->update($datos);

        return redirect()
            ->route('vehiculos.show', $vehiculo)
            ->with(
                'success',
                'Vehículo actualizado correctamente.'
            );
    }

    /**
     * Eliminar vehículo.
     */
    public function destroy(Vehiculo $vehiculo): RedirectResponse
    {
        try {
            $vehiculo->delete();
        } catch (QueryException $exception) {
            return redirect()
                ->route('vehiculos.show', $vehiculo)
                ->with(
                    'error',
                    'No se puede eliminar este vehículo porque tiene servicios de transporte asociados.'
                );
        }

        return redirect()
            ->route('vehiculos.index')
            ->with(
                'success',
                'Vehículo eliminado correctamente.'
            );
    }

    /**
     * Validar datos del vehículo.
     */
    private function validarDatos(
        Request $request,
        ?Vehiculo $vehiculo = null
    ): array {
        $patenteRule = [
            'required',
            'string',
            'max:20',
            'unique:vehiculos,patente',
        ];

        if ($vehiculo) {
            $patenteRule = [
                'required',
                'string',
                'max:20',
                'unique:vehiculos,patente,' . $vehiculo->id,
            ];
        }

        return $request->validate(
            [
                'transportista_id' => [
                    'required',
                    'integer',
                    'exists:transportistas,id',
                ],

                'patente' => $patenteRule,

                'tipo' => [
                    'nullable',
                    'string',
                    'max:100',
                ],

                'marca' => [
                    'nullable',
                    'string',
                    'max:100',
                ],

                'modelo' => [
                    'nullable',
                    'string',
                    'max:100',
                ],

                'anio' => [
                    'nullable',
                    'integer',
                    'min:1900',
                    'max:' . (date('Y') + 1),
                ],

                'observaciones' => [
                    'nullable',
                    'string',
                ],
            ],
            [
                'transportista_id.required' =>
                    'El transportista es obligatorio.',

                'transportista_id.integer' =>
                    'El transportista seleccionado no es válido.',

                'transportista_id.exists' =>
                    'El transportista seleccionado no existe.',

                'patente.required' =>
                    'La patente del vehículo es obligatoria.',

                'patente.string' =>
                    'La patente ingresada no es válida.',

                'patente.max' =>
                    'La patente no puede superar los 20 caracteres.',

                'patente.unique' =>
                    'Ya existe un vehículo registrado con esta patente.',

                'tipo.string' =>
                    'El tipo de vehículo no es válido.',

                'tipo.max' =>
                    'El tipo de vehículo no puede superar los 100 caracteres.',

                'marca.string' =>
                    'La marca ingresada no es válida.',

                'marca.max' =>
                    'La marca no puede superar los 100 caracteres.',

                'modelo.string' =>
                    'El modelo ingresado no es válido.',

                'modelo.max' =>
                    'El modelo no puede superar los 100 caracteres.',

                'anio.integer' =>
                    'El año debe ser un número entero.',

                'anio.min' =>
                    'El año ingresado no es válido.',

                'anio.max' =>
                    'El año ingresado no es válido.',
            ]
        );
    }
}