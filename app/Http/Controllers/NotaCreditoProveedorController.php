<?php

namespace App\Http\Controllers;

use App\Models\NotaCreditoProveedor;
use App\Models\Proveedor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NotaCreditoProveedorController extends Controller
{
    /**
     * Listado de notas de crédito pendientes de recuperar.
     */
    public function index(Request $request): View
    {
        $estado = $request->input('estado', 'pendiente');
        $buscar = trim($request->input('buscar', ''));

        $query = NotaCreditoProveedor::query()
            ->with('proveedor')
            ->when(
                $estado !== 'todos',
                function ($query) use ($estado) {
                    $query->where('estado', $estado);
                }
            )
            ->when(
                $buscar !== '',
                function ($query) use ($buscar) {
                    $query->where(function ($query) use ($buscar) {
                        $query->where('numero_nota', 'like', '%' . $buscar . '%')
                            ->orWhere('motivo', 'like', '%' . $buscar . '%')
                            ->orWhereHas('proveedor', function ($query) use ($buscar) {
                                $query->where('nombre', 'like', '%' . $buscar . '%')
                                    ->orWhere('rut', 'like', '%' . $buscar . '%');
                            });
                    });
                }
            )
            ->orderByDesc('fecha')
            ->orderByDesc('id');

        $notasCredito = $query->get();

        $totalPendiente = NotaCreditoProveedor::query()
            ->where('estado', 'pendiente')
            ->sum('monto');

        $totalRecuperado = NotaCreditoProveedor::query()
            ->where('estado', 'recuperada')
            ->sum('monto');

        $cantidadPendientes = NotaCreditoProveedor::query()
            ->where('estado', 'pendiente')
            ->count();

        $cantidadRecuperadas = NotaCreditoProveedor::query()
            ->where('estado', 'recuperada')
            ->count();

        return view(
            'notas_credito_proveedores.index',
            compact(
                'notasCredito',
                'estado',
                'buscar',
                'totalPendiente',
                'totalRecuperado',
                'cantidadPendientes',
                'cantidadRecuperadas'
            )
        );
    }

    /**
     * Formulario para registrar una nueva nota de crédito.
     */
    public function create(): View
    {
        $proveedores = Proveedor::query()
            ->orderBy('nombre')
            ->get([
                'id',
                'nombre',
                'rut',
            ]);

        return view(
            'notas_credito_proveedores.create',
            compact('proveedores')
        );
    }

    /**
     * Registrar una nueva nota de crédito.
     */
    public function store(Request $request): RedirectResponse
    {
        $datos = $this->validarDatos($request);

        $notaCredito = NotaCreditoProveedor::create($datos);

        return redirect()
            ->route('notas-credito-proveedores.show', $notaCredito)
            ->with(
                'success',
                'Nota de crédito registrada correctamente.'
            );
    }

    /**
     * Mostrar el detalle de una nota de crédito.
     */
    public function show(
        NotaCreditoProveedor $notaCreditoProveedor
    ): View {
        $notaCreditoProveedor->load('proveedor');

        return view(
            'notas_credito_proveedores.show',
            compact('notaCreditoProveedor')
        );
    }

    /**
     * Formulario para editar una nota de crédito.
     */
    public function edit(
        NotaCreditoProveedor $notaCreditoProveedor
    ): View {
        $proveedores = Proveedor::query()
            ->orderBy('nombre')
            ->get([
                'id',
                'nombre',
                'rut',
            ]);

        $notaCreditoProveedor->load('proveedor');

        return view(
            'notas_credito_proveedores.edit',
            compact(
                'notaCreditoProveedor',
                'proveedores'
            )
        );
    }

    /**
     * Actualizar una nota de crédito.
     */
    public function update(
        Request $request,
        NotaCreditoProveedor $notaCreditoProveedor
    ): RedirectResponse {
        $datos = $this->validarDatos(
            $request,
            $notaCreditoProveedor
        );

        $notaCreditoProveedor->update($datos);

        return redirect()
            ->route(
                'notas-credito-proveedores.show',
                $notaCreditoProveedor
            )
            ->with(
                'success',
                'Nota de crédito actualizada correctamente.'
            );
    }

    /**
     * Eliminar una nota de crédito.
     */
    public function destroy(
        NotaCreditoProveedor $notaCreditoProveedor
    ): RedirectResponse {
        $notaCreditoProveedor->delete();

        return redirect()
            ->route('notas-credito-proveedores.index')
            ->with(
                'success',
                'Nota de crédito eliminada correctamente.'
            );
    }

    /**
     * Validar los datos de la nota de crédito.
     */
    private function validarDatos(
        Request $request,
        ?NotaCreditoProveedor $notaCreditoProveedor = null
    ): array {
        $notaId = $notaCreditoProveedor?->id;

        return $request->validate(
            [
                'proveedor_id' => [
                    'required',
                    'integer',
                    'exists:proveedores,id',
                ],

                'numero_nota' => [
                    'required',
                    'string',
                    'max:50',
                    'unique:nota_credito_proveedores,numero_nota,' . $notaId . ',id,proveedor_id,' . $request->input('proveedor_id'),
                ],

                'fecha' => [
                    'required',
                    'date',
                ],

                'monto' => [
                    'required',
                    'numeric',
                    'min:0',
                ],

                'motivo' => [
                    'nullable',
                    'string',
                    'max:500',
                ],

                'estado' => [
                    'required',
                    'in:pendiente,recuperada',
                ],

                'observaciones' => [
                    'nullable',
                    'string',
                ],
            ],
            [
                'proveedor_id.required' => 'Debe seleccionar un proveedor.',
                'proveedor_id.integer' => 'El proveedor seleccionado no es válido.',
                'proveedor_id.exists' => 'El proveedor seleccionado no existe.',

                'numero_nota.required' => 'El número de la nota de crédito es obligatorio.',
                'numero_nota.string' => 'El número de la nota de crédito no es válido.',
                'numero_nota.max' => 'El número de la nota de crédito no puede superar los 50 caracteres.',
                'numero_nota.unique' => 'Este número de nota de crédito ya está registrado para el proveedor seleccionado.',

                'fecha.required' => 'La fecha de la nota de crédito es obligatoria.',
                'fecha.date' => 'La fecha ingresada no es válida.',

                'monto.required' => 'El monto de la nota de crédito es obligatorio.',
                'monto.numeric' => 'El monto ingresado no es válido.',
                'monto.min' => 'El monto no puede ser negativo.',

                'motivo.string' => 'El motivo ingresado no es válido.',
                'motivo.max' => 'El motivo no puede superar los 500 caracteres.',

                'estado.required' => 'El estado de la nota de crédito es obligatorio.',
                'estado.in' => 'El estado seleccionado no es válido.',

                'observaciones.string' => 'Las observaciones ingresadas no son válidas.',
            ]
        );
    }
}