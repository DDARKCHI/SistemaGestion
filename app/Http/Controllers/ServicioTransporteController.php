<?php

namespace App\Http\Controllers;

use App\Models\Operacion;
use App\Models\ServicioTransporte;
use App\Models\Transportista;
use App\Models\Vehiculo;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServicioTransporteController extends Controller
{
    /**
     * Mostrar listado de servicios de transporte.
     */
    public function index(): View
    {
        $servicios = ServicioTransporte::query()
            ->with([
                'operacion.cliente',
                'transportista',
                'vehiculo',
            ])
            ->orderByDesc('fecha_servicio')
            ->orderByDesc('id')
            ->get();

        return view(
            'servicios-transporte.index',
            compact('servicios')
        );
    }

    /**
     * Mostrar formulario de creación.
     */
    public function create(Request $request): View
    {
        $operaciones = Operacion::query()
            ->with('cliente')
            ->orderByDesc('fecha_operacion')
            ->orderByDesc('id')
            ->get();

        $transportistas = Transportista::query()
            ->orderBy('nombre')
            ->orderBy('id')
            ->get();

        $vehiculos = Vehiculo::query()
            ->orderBy('id')
            ->get();

        $operacionSeleccionada = null;
        $transportistaSeleccionado = null;
        $vehiculoSeleccionado = null;

        if ($request->filled('operacion_id')) {
            $operacionSeleccionada = Operacion::query()
                ->with('cliente')
                ->find($request->integer('operacion_id'));
        }

        if ($request->filled('transportista_id')) {
            $transportistaSeleccionado = Transportista::query()
                ->find($request->integer('transportista_id'));
        }

        if ($request->filled('vehiculo_id')) {
            $vehiculoSeleccionado = Vehiculo::query()
                ->find($request->integer('vehiculo_id'));
        }

        return view(
            'servicios-transporte.create',
            compact(
                'operaciones',
                'transportistas',
                'vehiculos',
                'operacionSeleccionada',
                'transportistaSeleccionado',
                'vehiculoSeleccionado'
            )
        );
    }

    /**
     * Registrar un nuevo servicio.
     */
    public function store(Request $request): RedirectResponse
    {
        $datos = $this->validarDatos($request);

        $datos = $this->normalizarDatosFacturacion($datos);

        $servicio = ServicioTransporte::create($datos);

        return redirect()
            ->route(
                'servicios-transporte.show',
                $servicio
            )
            ->with(
                'success',
                'Servicio de transporte registrado correctamente.'
            );
    }

    /**
     * Mostrar ficha del servicio.
     */
    public function show(
        ServicioTransporte $servicioTransporte
    ): View {
        $servicioTransporte->load([
            'operacion.cliente',
            'transportista',
            'vehiculo',
        ]);

        return view(
            'servicios-transporte.show',
            [
                'servicio' => $servicioTransporte,
            ]
        );
    }

    /**
     * Mostrar formulario de edición.
     */
    public function edit(
        ServicioTransporte $servicioTransporte
    ): View {
        $operaciones = Operacion::query()
            ->with('cliente')
            ->orderByDesc('fecha_operacion')
            ->orderByDesc('id')
            ->get();

        $transportistas = Transportista::query()
            ->orderBy('nombre')
            ->orderBy('id')
            ->get();

        $vehiculos = Vehiculo::query()
            ->orderBy('id')
            ->get();

        $servicioTransporte->load([
            'operacion.cliente',
            'transportista',
            'vehiculo',
        ]);

        return view(
            'servicios-transporte.edit',
            [
                'servicio' => $servicioTransporte,
                'operaciones' => $operaciones,
                'transportistas' => $transportistas,
                'vehiculos' => $vehiculos,
            ]
        );
    }

    /**
     * Actualizar servicio.
     */
    public function update(
        Request $request,
        ServicioTransporte $servicioTransporte
    ): RedirectResponse {
        $datos = $this->validarDatos($request);

        $datos = $this->normalizarDatosFacturacion($datos);

        $servicioTransporte->update($datos);

        return redirect()
            ->route(
                'servicios-transporte.show',
                $servicioTransporte
            )
            ->with(
                'success',
                'Servicio de transporte actualizado correctamente.'
            );
    }

    /**
     * Eliminar servicio.
     */
    public function destroy(
        ServicioTransporte $servicioTransporte
    ): RedirectResponse {
        try {
            $servicioTransporte->delete();
        } catch (QueryException $exception) {
            return redirect()
                ->route(
                    'servicios-transporte.show',
                    $servicioTransporte
                )
                ->with(
                    'error',
                    'No se puede eliminar este servicio porque tiene registros asociados.'
                );
        }

        return redirect()
            ->route('servicios-transporte.index')
            ->with(
                'success',
                'Servicio de transporte eliminado correctamente.'
            );
    }

    /**
     * Validar datos del servicio.
     */
    private function validarDatos(Request $request): array
    {
        $datos = $request->validate(
            [
                'operacion_id' => [
                    'required',
                    'integer',
                    'exists:operaciones,id',
                ],

                'transportista_id' => [
                    'required',
                    'integer',
                    'exists:transportistas,id',
                ],

                'vehiculo_id' => [
                    'required',
                    'integer',
                    'exists:vehiculos,id',
                ],

                'fecha_servicio' => [
                    'nullable',
                    'date',
                ],

                'tipo_servicio' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'monto' => [
                    'required',
                    'numeric',
                    'min:0',
                ],

                'emite_factura' => [
                    'required',
                    'boolean',
                ],

                'estado_facturacion' => [
                    'required',
                    'in:Pendiente,Recibida',
                ],

                'numero_factura' => [
                    'nullable',
                    'string',
                    'max:50',
                ],

                'fecha_factura' => [
                    'nullable',
                    'date',
                ],

                'observaciones' => [
                    'nullable',
                    'string',
                ],
            ],
            [
                'operacion_id.required' =>
                    'La operación es obligatoria.',

                'operacion_id.integer' =>
                    'La operación seleccionada no es válida.',

                'operacion_id.exists' =>
                    'La operación seleccionada no existe.',

                'transportista_id.required' =>
                    'El transportista es obligatorio.',

                'transportista_id.integer' =>
                    'El transportista seleccionado no es válido.',

                'transportista_id.exists' =>
                    'El transportista seleccionado no existe.',

                'vehiculo_id.required' =>
                    'El vehículo es obligatorio.',

                'vehiculo_id.integer' =>
                    'El vehículo seleccionado no es válido.',

                'vehiculo_id.exists' =>
                    'El vehículo seleccionado no existe.',

                'fecha_servicio.date' =>
                    'La fecha del servicio no es válida.',

                'tipo_servicio.string' =>
                    'El tipo de servicio no es válido.',

                'tipo_servicio.max' =>
                    'El tipo de servicio no puede superar los 255 caracteres.',

                'monto.required' =>
                    'El monto del servicio es obligatorio.',

                'monto.numeric' =>
                    'El monto del servicio debe ser numérico.',

                'monto.min' =>
                    'El monto del servicio no puede ser negativo.',

                'emite_factura.required' =>
                    'Debe indicar si el transportista emite factura.',

                'emite_factura.boolean' =>
                    'El valor de emisión de factura no es válido.',

                'estado_facturacion.required' =>
                    'El estado de facturación es obligatorio.',

                'estado_facturacion.in' =>
                    'El estado de facturación seleccionado no es válido.',

                'numero_factura.string' =>
                    'El número de factura no es válido.',

                'numero_factura.max' =>
                    'El número de factura no puede superar los 50 caracteres.',

                'fecha_factura.date' =>
                    'La fecha de factura no es válida.',
            ]
        );

        return $datos;
    }

    /**
     * Aplicar reglas de negocio de facturación.
     *
     * Si el servicio no emite factura:
     * - No puede quedar como factura recibida.
     * - No debe conservar número de factura.
     * - No debe conservar fecha de factura.
     */
    private function normalizarDatosFacturacion(array $datos): array
    {
        $emiteFactura = (bool) $datos['emite_factura'];

        if (!$emiteFactura) {
            $datos['estado_facturacion'] = 'Pendiente';
            $datos['numero_factura'] = null;
            $datos['fecha_factura'] = null;
        }

        if (
            $emiteFactura &&
            $datos['estado_facturacion'] === 'Pendiente'
        ) {
            $datos['numero_factura'] = null;
            $datos['fecha_factura'] = null;
        }

        if (
            $emiteFactura &&
            $datos['estado_facturacion'] === 'Recibida'
        ) {
            if (
                empty($datos['numero_factura']) ||
                empty($datos['fecha_factura'])
            ) {
                abort(
                    422,
                    'Una factura recibida debe tener número y fecha de factura.'
                );
            }
        }

        $datos['monto'] = $this->normalizarMonto(
            $datos['monto']
        );

        return $datos;
    }

    /**
     * Normalizar monto monetario.
     */
    private function normalizarMonto($monto): int
    {
        return (int) round(
            (float) $monto
        );
    }
}