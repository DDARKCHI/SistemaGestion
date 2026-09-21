@extends('layouts.app')

@section('title', 'Vehículo')

@section('topbar_title', 'Gestión de vehículos')

@push('styles')

<style>

    /* =========================================================
       HEADER
    ========================================================== */

    .carrier-show-header {

        display: flex;

        align-items: flex-start;

        justify-content: space-between;

        gap: 20px;

        margin-bottom: 22px;

    }


    .carrier-show-heading {

        min-width: 0;

    }


    .carrier-show-title {

        margin: 0;

        color: #172033;

        font-size: 27px;

        line-height: 1.2;

        font-weight: 700;

        letter-spacing: -.025em;

    }


    .carrier-show-subtitle {

        margin: 7px 0 0;

        color: #667085;

        font-size: 13px;

    }


    .carrier-show-rut {

        display: inline-flex;

        align-items: center;

        margin-top: 10px;

        padding: 5px 9px;

        border-radius: 6px;

        background: #eef4f8;

        color: #155a91;

        font-size: 10px;

        font-weight: 700;

    }


    .carrier-show-actions {

        display: flex;

        align-items: center;

        gap: 8px;

        flex-shrink: 0;

    }


    .carrier-show-action {

        display: inline-flex;

        align-items: center;

        justify-content: center;

        min-height: 36px;

        padding: 8px 13px;

        border: 1px solid #dce3eb;

        border-radius: 6px;

        background: #ffffff;

        color: #344054;

        font-size: 11px;

        font-weight: 600;

        text-decoration: none;

        cursor: pointer;

    }


    .carrier-show-action:hover {

        background: #f7f9fb;

        border-color: #cbd7e3;

        color: #155a91;

    }


    .carrier-show-action-primary {

        background: #155a91;

        border-color: #155a91;

        color: #ffffff;

    }


    .carrier-show-action-primary:hover {

        background: #124d7d;

        border-color: #124d7d;

        color: #ffffff;

    }


    /* =========================================================
       ALERTAS
    ========================================================== */

    .carrier-show-alert {

        margin-bottom: 18px;

        padding: 11px 14px;

        border-radius: 7px;

        font-size: 11px;

    }


    .carrier-show-alert-success {

        border: 1px solid #cfe5d7;

        background: #f1faf4;

        color: #287443;

    }


    .carrier-show-alert-error {

        border: 1px solid #e9c1bc;

        background: #fff5f3;

        color: #a52f26;

    }


    /* =========================================================
       RESUMEN
    ========================================================== */

    .carrier-show-summary {

        display: grid;

        grid-template-columns: repeat(3, 1fr);

        gap: 14px;

        margin-bottom: 18px;

    }


    .carrier-show-summary-card {

        background: #ffffff;

        border: 1px solid #e2e8f0;

        border-radius: 9px;

        padding: 16px 18px;

        box-shadow: 0 2px 7px rgba(16,47,80,.04);

    }


    .carrier-show-summary-label {

        color: #667085;

        font-size: 10px;

        font-weight: 600;

        text-transform: uppercase;

        letter-spacing: .03em;

    }


    .carrier-show-summary-value {

        margin-top: 7px;

        color: #172033;

        font-size: 22px;

        line-height: 1;

        font-weight: 700;

    }


    .carrier-show-summary-description {

        margin-top: 6px;

        color: #98a2b3;

        font-size: 9px;

    }


    /* =========================================================
       TARJETAS
    ========================================================== */

    .carrier-show-card {

        margin-bottom: 18px;

        background: #ffffff;

        border: 1px solid #e2e8f0;

        border-radius: 10px;

        box-shadow: 0 2px 8px rgba(16,47,80,.05);

        overflow: hidden;

    }


    .carrier-show-card:last-child {

        margin-bottom: 0;

    }


    .carrier-show-card-header {

        min-height: 62px;

        padding: 14px 20px;

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 15px;

        border-bottom: 1px solid #edf1f5;

    }


    .carrier-show-card-title {

        margin: 0;

        color: #172033;

        font-size: 14px;

        font-weight: 700;

    }


    .carrier-show-card-description {

        margin: 4px 0 0;

        color: #98a2b3;

        font-size: 10px;

    }


    .carrier-show-card-body {

        padding: 20px;

    }


    /* =========================================================
       INFORMACIÓN
    ========================================================== */

    .carrier-info-grid {

        display: grid;

        grid-template-columns: repeat(3, minmax(0, 1fr));

        gap: 18px 25px;

    }


    .carrier-info-item {

        min-width: 0;

    }


    .carrier-info-label {

        margin-bottom: 5px;

        color: #98a2b3;

        font-size: 9px;

        font-weight: 600;

        text-transform: uppercase;

        letter-spacing: .03em;

    }


    .carrier-info-value {

        color: #344054;

        font-size: 11px;

        line-height: 1.45;

        word-break: break-word;

    }


    .carrier-info-value-empty {

        color: #a1aab7;

    }


    .carrier-info-full {

        grid-column: 1 / -1;

    }


    /* =========================================================
       TABLAS
    ========================================================== */

    .carrier-show-table-wrapper {

        width: 100%;

        overflow-x: auto;

    }


    .carrier-show-table {

        width: 100%;

        border-collapse: collapse;

        min-width: 700px;

    }


    .carrier-show-table th {

        padding: 11px 18px;

        background: #f8fafc;

        border-bottom: 1px solid #e2e8f0;

        color: #667085;

        text-align: left;

        font-size: 9px;

        font-weight: 700;

        text-transform: uppercase;

        letter-spacing: .035em;

        white-space: nowrap;

    }


    .carrier-show-table td {

        padding: 13px 18px;

        border-bottom: 1px solid #edf1f5;

        color: #344054;

        font-size: 10px;

        vertical-align: middle;

    }


    .carrier-show-table tbody tr:last-child td {

        border-bottom: none;

    }


    .carrier-show-table tbody tr:hover {

        background: #fbfcfe;

    }


    .carrier-table-primary {

        color: #172033;

        font-size: 11px;

        font-weight: 600;

    }


    .carrier-table-secondary {

        margin-top: 3px;

        color: #98a2b3;

        font-size: 9px;

    }


    /* =========================================================
       ESTADOS
    ========================================================== */

    .carrier-status {

        display: inline-flex;

        align-items: center;

        padding: 4px 8px;

        border-radius: 5px;

        background: #eef4f8;

        color: #155a91;

        font-size: 9px;

        font-weight: 600;

    }


    .carrier-status-empty {

        background: #f1f4f7;

        color: #667085;

    }


    /* =========================================================
       ESTADO VACÍO
    ========================================================== */

    .carrier-section-empty {

        padding: 32px 20px;

        text-align: center;

    }


    .carrier-section-empty-title {

        margin: 0;

        color: #667085;

        font-size: 11px;

        font-weight: 600;

    }


    .carrier-section-empty-text {

        margin: 5px auto 0;

        color: #98a2b3;

        font-size: 9px;

    }


    /* =========================================================
       PIE
    ========================================================== */

    .carrier-show-footer {

        display: flex;

        align-items: center;

        justify-content: space-between;

        padding: 13px 20px;

        background: #fbfcfd;

        border-top: 1px solid #edf1f5;

    }


    .carrier-show-footer-text {

        color: #98a2b3;

        font-size: 9px;

    }


    /* =========================================================
       RESPONSIVE
    ========================================================== */

    @media (max-width: 900px) {

        .carrier-info-grid {

            grid-template-columns: repeat(2, 1fr);

        }

    }


    @media (max-width: 700px) {

        .carrier-show-header {

            flex-direction: column;

        }


        .carrier-show-actions {

            width: 100%;

        }


        .carrier-show-action {

            flex: 1;

        }


        .carrier-show-summary {

            grid-template-columns: 1fr;

        }


        .carrier-info-grid {

            grid-template-columns: 1fr;

        }


        .carrier-info-full {

            grid-column: auto;

        }

    }

</style>

@endpush


@section('content')

    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="carrier-show-header">

        <div class="carrier-show-heading">

            <h1 class="carrier-show-title">
                {{ $vehiculo->patente }}
            </h1>

            <p class="carrier-show-subtitle">
                Ficha y antecedentes del vehículo.
            </p>

            <span class="carrier-show-rut">

                @if($vehiculo->transportista)

                    {{ $vehiculo->transportista->nombre }}

                @else

                    Sin transportista

                @endif

            </span>

        </div>


        <div class="carrier-show-actions">

            <a
                href="{{ route('vehiculos.index') }}"
                class="carrier-show-action"
            >
                ← Volver
            </a>

            <a
                href="{{ route('vehiculos.edit', $vehiculo) }}"
                class="carrier-show-action carrier-show-action-primary"
            >
                Editar vehículo
            </a>

        </div>

    </div>


    {{-- =====================================================
         MENSAJES
    ====================================================== --}}

    @if(session('success'))

        <div class="carrier-show-alert carrier-show-alert-success">
            {{ session('success') }}
        </div>

    @endif


    @if(session('error'))

        <div class="carrier-show-alert carrier-show-alert-error">
            {{ session('error') }}
        </div>

    @endif


    {{-- =====================================================
         RESUMEN
    ====================================================== --}}

    <div class="carrier-show-summary">

        <div class="carrier-show-summary-card">

            <div class="carrier-show-summary-label">
                Servicios
            </div>

            <div class="carrier-show-summary-value">
                {{ $vehiculo->serviciosTransporte->count() }}
            </div>

            <div class="carrier-show-summary-description">
                Servicios de transporte registrados
            </div>

        </div>


        <div class="carrier-show-summary-card">

            <div class="carrier-show-summary-label">
                Transportista
            </div>

            <div class="carrier-show-summary-value" style="font-size: 16px;">
                {{ $vehiculo->transportista?->nombre ?: '—' }}
            </div>

            <div class="carrier-show-summary-description">

                @if($vehiculo->transportista?->rut)

                    RUT {{ $vehiculo->transportista->rut }}

                @else

                    Sin transportista asociado

                @endif

            </div>

        </div>


        <div class="carrier-show-summary-card">

            <div class="carrier-show-summary-label">
                Año
            </div>

            <div class="carrier-show-summary-value">
                {{ $vehiculo->anio ?: '—' }}
            </div>

            <div class="carrier-show-summary-description">
                Año registrado del vehículo
            </div>

        </div>

    </div>


    {{-- =====================================================
         INFORMACIÓN GENERAL
    ====================================================== --}}

    <section class="carrier-show-card">

        <div class="carrier-show-card-header">

            <div>

                <h2 class="carrier-show-card-title">
                    Información general
                </h2>

                <p class="carrier-show-card-description">
                    Datos principales registrados del vehículo.
                </p>

            </div>

        </div>


        <div class="carrier-show-card-body">

            <div class="carrier-info-grid">

                <div class="carrier-info-item">

                    <div class="carrier-info-label">
                        Patente
                    </div>

                    <div class="carrier-info-value">
                        {{ $vehiculo->patente }}
                    </div>

                </div>


                <div class="carrier-info-item">

                    <div class="carrier-info-label">
                        Transportista
                    </div>

                    <div class="carrier-info-value
                        {{ !$vehiculo->transportista ? 'carrier-info-value-empty' : '' }}"
                    >

                        @if($vehiculo->transportista)

                            <a
                                href="{{ route('transportistas.show', $vehiculo->transportista) }}"
                                style="color: inherit; text-decoration: none;"
                            >
                                {{ $vehiculo->transportista->nombre }}
                            </a>

                        @else

                            No registrado

                        @endif

                    </div>

                </div>


                <div class="carrier-info-item">

                    <div class="carrier-info-label">
                        Tipo
                    </div>

                    <div class="carrier-info-value
                        {{ !$vehiculo->tipo ? 'carrier-info-value-empty' : '' }}"
                    >
                        {{ $vehiculo->tipo ?: 'No registrado' }}
                    </div>

                </div>


                <div class="carrier-info-item">

                    <div class="carrier-info-label">
                        Marca
                    </div>

                    <div class="carrier-info-value
                        {{ !$vehiculo->marca ? 'carrier-info-value-empty' : '' }}"
                    >
                        {{ $vehiculo->marca ?: 'No registrada' }}
                    </div>

                </div>


                <div class="carrier-info-item">

                    <div class="carrier-info-label">
                        Modelo
                    </div>

                    <div class="carrier-info-value
                        {{ !$vehiculo->modelo ? 'carrier-info-value-empty' : '' }}"
                    >
                        {{ $vehiculo->modelo ?: 'No registrado' }}
                    </div>

                </div>


                <div class="carrier-info-item">

                    <div class="carrier-info-label">
                        Año
                    </div>

                    <div class="carrier-info-value
                        {{ !$vehiculo->anio ? 'carrier-info-value-empty' : '' }}"
                    >
                        {{ $vehiculo->anio ?: 'No registrado' }}
                    </div>

                </div>


                <div class="carrier-info-item carrier-info-full">

                    <div class="carrier-info-label">
                        Observaciones
                    </div>

                    <div class="carrier-info-value
                        {{ !$vehiculo->observaciones ? 'carrier-info-value-empty' : '' }}"
                    >
                        {{ $vehiculo->observaciones ?: 'Sin observaciones' }}
                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- =====================================================
         SERVICIOS DE TRANSPORTE
    ====================================================== --}}

    <section class="carrier-show-card">

        <div class="carrier-show-card-header">

            <div>

                <h2 class="carrier-show-card-title">
                    Servicios de transporte
                </h2>

                <p class="carrier-show-card-description">
                    Servicios realizados con este vehículo.
                </p>

            </div>


            @if($vehiculo->transportista)

                <a
                    href="{{ route(
                        'servicios-transporte.create',
                        [
                            'transportista_id' => $vehiculo->transportista_id,
                            'vehiculo_id' => $vehiculo->id,
                        ]
                    ) }}"
                    class="carrier-show-action carrier-show-action-primary"
                >
                    + Nuevo servicio
                </a>

            @endif

        </div>


        @if($vehiculo->serviciosTransporte->count())

            <div class="carrier-show-table-wrapper">

                <table class="carrier-show-table">

                    <thead>

                        <tr>

                            <th>
                                Fecha
                            </th>

                            <th>
                                Operación
                            </th>

                            <th>
                                Tipo
                            </th>

                            <th>
                                Monto
                            </th>

                            <th>
                                Facturación
                            </th>

                            <th>
                                Acciones
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($vehiculo->serviciosTransporte as $servicio)

                            <tr>

                                <td>
                                    {{ $servicio->fecha_servicio?->format('d/m/Y') ?: '—' }}
                                </td>


                                <td>

                                    @if($servicio->operacion)

                                        <div class="carrier-table-primary">
                                            {{ $servicio->operacion->numero_operacion ?? 'Operación #' . $servicio->operacion->id }}
                                        </div>

                                        @if($servicio->operacion->cliente)

                                            <div class="carrier-table-secondary">
                                                {{ $servicio->operacion->cliente->razon_social ?? $servicio->operacion->cliente->nombre ?? 'Cliente' }}
                                            </div>

                                        @endif

                                    @else

                                        <span class="carrier-info-value-empty">
                                            Sin operación
                                        </span>

                                    @endif

                                </td>


                                <td>

                                    <div class="carrier-table-primary">
                                        {{ $servicio->tipo_servicio ?: '—' }}
                                    </div>

                                </td>


                                <td>

                                    <div class="carrier-table-primary">
                                        ${{ number_format(
                                            (float) $servicio->monto,
                                            0,
                                            ',',
                                            '.'
                                        ) }}
                                    </div>

                                </td>


                                <td>

                                    @if(!$servicio->emite_factura)

                                        <span class="carrier-status">
                                            Sin factura
                                        </span>

                                    @elseif($servicio->estado_facturacion === 'Recibida')

                                        <span class="carrier-status">
                                            Recibida
                                        </span>

                                        @if($servicio->numero_factura)

                                            <div class="carrier-table-secondary">
                                                Factura {{ $servicio->numero_factura }}
                                            </div>

                                        @endif

                                    @else

                                        <span class="carrier-status">
                                            Pendiente
                                        </span>

                                    @endif

                                </td>


                                <td>

                                    <a
                                        href="{{ route('servicios-transporte.show', $servicio) }}"
                                        class="carrier-show-action"
                                    >
                                        Ver
                                    </a>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>


            <div class="carrier-show-footer">

                <div class="carrier-show-footer-text">

                    Total de servicios:

                    <strong>
                        {{ $vehiculo->serviciosTransporte->count() }}
                    </strong>

                </div>


                <div class="carrier-show-footer-text">

                    Monto total:

                    <strong>
                        ${{ number_format(
                            (float) $vehiculo->serviciosTransporte->sum('monto'),
                            0,
                            ',',
                            '.'
                        ) }}
                    </strong>

                </div>

            </div>

        @else

            <div class="carrier-section-empty">

                <h3 class="carrier-section-empty-title">
                    No hay servicios registrados
                </h3>

                <p class="carrier-section-empty-text">
                    Los servicios realizados con este vehículo aparecerán aquí.
                </p>

                @if($vehiculo->transportista)

                    <div style="margin-top: 14px;">

                        <a
                            href="{{ route(
                                'servicios-transporte.create',
                                [
                                    'transportista_id' => $vehiculo->transportista_id,
                                    'vehiculo_id' => $vehiculo->id,
                                ]
                            ) }}"
                            class="carrier-show-action carrier-show-action-primary"
                        >
                            + Registrar primer servicio
                        </a>

                    </div>

                @endif

            </div>

        @endif

    </section>

@endsection
