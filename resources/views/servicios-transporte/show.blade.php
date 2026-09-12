@extends('layouts.app')

@section('title', 'Servicio de transporte #' . $servicio->id)

@section('topbar_title', 'Gestión de servicios de transporte')

@push('styles')

<style>

    /* =========================================================
       BREADCRUMB
    ========================================================== */

    .transport-service-show-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 18px;
        color: #8a94a6;
        font-size: 12px;
    }

    .transport-service-show-breadcrumb a {
        color: #667085;
        text-decoration: none;
    }

    .transport-service-show-breadcrumb a:hover {
        color: #155a91;
    }

    .transport-service-show-breadcrumb-current {
        color: #344054;
    }


    /* =========================================================
       HEADER
    ========================================================== */

    .transport-service-show-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 25px;
    }

    .transport-service-show-header-left {
        display: flex;
        align-items: center;
        gap: 13px;
        min-width: 0;
    }

    .transport-service-show-avatar {
        width: 45px;
        height: 45px;
        min-width: 45px;
        border-radius: 9px;
        background: #155a91;
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: 700;
    }

    .transport-service-show-title {
        margin: 0;
        color: #172033;
        font-size: 26px;
        line-height: 1.2;
        font-weight: 700;
        letter-spacing: -.025em;
    }

    .transport-service-show-subtitle {
        margin: 6px 0 0;
        color: #667085;
        font-size: 12px;
    }

    .transport-service-show-header-actions {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }


    /* =========================================================
       ALERTAS
    ========================================================== */

    .transport-service-show-alert {
        margin-bottom: 20px;
        padding: 13px 16px;
        border-radius: 7px;
        font-size: 11px;
    }

    .transport-service-show-alert-success {
        border: 1px solid #cce8d5;
        background: #f2fbf5;
        color: #287548;
    }

    .transport-service-show-alert-error {
        border: 1px solid #f1ceca;
        background: #fff5f3;
        color: #a63228;
    }


    /* =========================================================
       SUMMARY
    ========================================================== */

    .transport-service-show-summary {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 14px;
        margin-bottom: 20px;
    }

    .transport-service-show-summary-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 9px;
        padding: 15px 17px;
        box-shadow: 0 2px 8px rgba(16,47,80,.04);
    }

    .transport-service-show-summary-label {
        color: #98a2b3;
        font-size: 10px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .03em;
    }

    .transport-service-show-summary-value {
        margin-top: 7px;
        color: #172033;
        font-size: 19px;
        line-height: 1.2;
        font-weight: 700;
    }

    .transport-service-show-summary-value-amount {
        color: #155a91;
    }


    /* =========================================================
       CARDS
    ========================================================== */

    .transport-service-show-card {
        width: 100%;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(16,47,80,.05);
        margin-bottom: 20px;
        overflow: hidden;
    }

    .transport-service-show-card-header {
        min-height: 67px;
        padding: 17px 21px;
        border-bottom: 1px solid #edf1f5;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
    }

    .transport-service-show-card-title {
        margin: 0;
        color: #172033;
        font-size: 15px;
        font-weight: 700;
    }

    .transport-service-show-card-description {
        margin: 4px 0 0;
        color: #98a2b3;
        font-size: 11px;
    }

    .transport-service-show-card-body {
        padding: 22px;
    }


    /* =========================================================
       DETAIL GRID
    ========================================================== */

    .transport-service-show-detail-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 0;
    }

    .transport-service-show-detail-item {
        padding: 15px 17px;
        border-bottom: 1px solid #edf1f5;
    }

    .transport-service-show-detail-item:nth-child(odd) {
        border-right: 1px solid #edf1f5;
    }

    .transport-service-show-detail-item:nth-last-child(-n+2) {
        border-bottom: none;
    }

    .transport-service-show-detail-label {
        margin-bottom: 6px;
        color: #98a2b3;
        font-size: 10px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .025em;
    }

    .transport-service-show-detail-value {
        color: #344054;
        font-size: 12px;
        font-weight: 600;
        line-height: 1.45;
    }

    .transport-service-show-detail-value-primary {
        color: #172033;
    }

    .transport-service-show-detail-secondary {
        margin-top: 3px;
        color: #98a2b3;
        font-size: 10px;
        font-weight: 400;
    }


    /* =========================================================
       LINKS
    ========================================================== */

    .transport-service-show-link {
        color: #155a91;
        text-decoration: none;
        font-weight: 700;
    }

    .transport-service-show-link:hover {
        text-decoration: underline;
    }


    /* =========================================================
       BADGES
    ========================================================== */

    .transport-service-show-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 5px 8px;
        border-radius: 5px;
        font-size: 9px;
        font-weight: 700;
        white-space: nowrap;
    }

    .transport-service-show-badge-pending {
        background: #fff6e6;
        color: #a86600;
    }

    .transport-service-show-badge-received {
        background: #edf8f1;
        color: #287548;
    }

    .transport-service-show-badge-no-invoice {
        background: #f1f4f7;
        color: #667085;
    }

    .transport-service-show-badge-invoice {
        background: #eef5fb;
        color: #155a91;
    }


    /* =========================================================
       INFO BOX
    ========================================================== */

    .transport-service-show-info-box {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin-bottom: 20px;
        padding: 13px 15px;
        border: 1px solid #dce9f3;
        border-radius: 7px;
        background: #f7fbff;
        color: #526579;
        font-size: 11px;
        line-height: 1.5;
    }

    .transport-service-show-info-icon {
        flex: 0 0 21px;
        width: 21px;
        height: 21px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #155a91;
        color: #ffffff;
        font-size: 11px;
        font-weight: 700;
    }

    .transport-service-show-info-box strong {
        color: #344054;
    }


    /* =========================================================
       AMOUNT
    ========================================================== */

    .transport-service-show-amount {
        color: #155a91;
        font-size: 20px;
        font-weight: 700;
    }


    /* =========================================================
       OBSERVACIONES
    ========================================================== */

    .transport-service-show-observations {
        min-height: 70px;
        color: #526579;
        font-size: 11px;
        line-height: 1.6;
        white-space: pre-line;
    }

    .transport-service-show-empty {
        color: #98a2b3;
        font-size: 11px;
    }


    /* =========================================================
       FOOTER
    ========================================================== */

    .transport-service-show-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        padding: 18px 22px;
        background: #f8fafc;
        border-top: 1px solid #edf1f5;
    }

    .transport-service-show-footer-note {
        color: #98a2b3;
        font-size: 10px;
    }

    .transport-service-show-footer-actions {
        display: flex;
        gap: 9px;
    }

    .transport-service-show-delete-form {
        margin: 0;
    }

    .transport-service-show-delete-button {
        min-height: 34px;
        padding: 7px 11px;
        border: 1px solid #e3b8b4;
        border-radius: 6px;
        background: #ffffff;
        color: #a63228;
        font-family: inherit;
        font-size: 10px;
        font-weight: 600;
        cursor: pointer;
    }

    .transport-service-show-delete-button:hover {
        border-color: #a63228;
        background: #fff5f3;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================== */

    @media (max-width: 900px) {

        .transport-service-show-summary {
            grid-template-columns: repeat(2, 1fr);
        }

        .transport-service-show-detail-grid {
            grid-template-columns: 1fr;
        }

        .transport-service-show-detail-item:nth-child(odd) {
            border-right: none;
        }

        .transport-service-show-detail-item:nth-last-child(-n+2) {
            border-bottom: 1px solid #edf1f5;
        }

        .transport-service-show-detail-item:last-child {
            border-bottom: none;
        }

    }

    @media (max-width: 700px) {

        .transport-service-show-header {
            align-items: stretch;
            flex-direction: column;
        }

        .transport-service-show-header-actions {
            width: 100%;
        }

        .transport-service-show-header-actions .btn {
            flex: 1;
        }

        .transport-service-show-summary {
            grid-template-columns: 1fr;
        }

        .transport-service-show-card-body {
            padding: 17px;
        }

        .transport-service-show-footer {
            align-items: stretch;
            flex-direction: column;
        }

        .transport-service-show-footer-actions {
            width: 100%;
            flex-wrap: wrap;
        }

    }

</style>

@endpush


@section('content')

    {{-- =====================================================
         BREADCRUMB
    ====================================================== --}}

    <div class="transport-service-show-breadcrumb">

        <a href="{{ route('servicios-transporte.index') }}">
            Servicios de transporte
        </a>

        <span>›</span>

        <span class="transport-service-show-breadcrumb-current">
            Servicio #{{ $servicio->id }}
        </span>

    </div>


    {{-- =====================================================
         ALERTAS
    ====================================================== --}}

    @if(session('success'))

        <div class="transport-service-show-alert transport-service-show-alert-success">

            {{ session('success') }}

        </div>

    @endif


    @if(session('error'))

        <div class="transport-service-show-alert transport-service-show-alert-error">

            {{ session('error') }}

        </div>

    @endif


    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="transport-service-show-header">

        <div class="transport-service-show-header-left">

            <div class="transport-service-show-avatar">
                ST
            </div>

            <div>

                <h1 class="transport-service-show-title">
                    Servicio de transporte #{{ $servicio->id }}
                </h1>

                <p class="transport-service-show-subtitle">
                    Detalle y trazabilidad del servicio registrado.
                </p>

            </div>

        </div>


        <div class="transport-service-show-header-actions">

            <a
                href="{{ route('servicios-transporte.index') }}"
                class="btn"
            >
                ← Volver
            </a>


            <a
                href="{{ route(
                    'servicios-transporte.edit',
                    $servicio
                ) }}"
                class="btn btn-primary"
            >
                Editar servicio
            </a>

        </div>

    </div>


    {{-- =====================================================
         RESUMEN
    ====================================================== --}}

    <div class="transport-service-show-summary">


        {{-- MONTO --}}

        <div class="transport-service-show-summary-card">

            <div class="transport-service-show-summary-label">
                Monto del servicio
            </div>

            <div class="transport-service-show-summary-value transport-service-show-summary-value-amount">

                ${{ number_format(
                    (float) $servicio->monto,
                    0,
                    ',',
                    '.'
                ) }}

            </div>

        </div>


        {{-- TRANSPORTISTA --}}

        <div class="transport-service-show-summary-card">

            <div class="transport-service-show-summary-label">
                Transportista
            </div>

            <div class="transport-service-show-summary-value">

                {{ $servicio->transportista?->nombre ?? 'Sin transportista' }}

            </div>

        </div>


        {{-- FACTURACIÓN --}}

        <div class="transport-service-show-summary-card">

            <div class="transport-service-show-summary-label">
                Facturación
            </div>

            <div class="transport-service-show-summary-value">

                @if($servicio->emite_factura)

                    @if($servicio->estado_facturacion === 'Recibida')

                        <span class="transport-service-show-badge transport-service-show-badge-received">
                            Recibida
                        </span>

                    @else

                        <span class="transport-service-show-badge transport-service-show-badge-pending">
                            Pendiente
                        </span>

                    @endif

                @else

                    <span class="transport-service-show-badge transport-service-show-badge-no-invoice">
                        No factura
                    </span>

                @endif

            </div>

        </div>


        {{-- OPERACIÓN --}}

        <div class="transport-service-show-summary-card">

            <div class="transport-service-show-summary-label">
                Operación
            </div>

            <div class="transport-service-show-summary-value">

                @if($servicio->operacion)

                    #{{ $servicio->operacion->id }}

                @else

                    Sin operación

                @endif

            </div>

        </div>

    </div>


    {{-- =====================================================
         INFORMACIÓN DEL SERVICIO
    ====================================================== --}}

    <section class="transport-service-show-card">

        <div class="transport-service-show-card-header">

            <div>

                <h2 class="transport-service-show-card-title">
                    Información del servicio
                </h2>

                <p class="transport-service-show-card-description">
                    Datos principales registrados para este servicio.
                </p>

            </div>

        </div>


        <div class="transport-service-show-card-body">

            <div class="transport-service-show-detail-grid">


                {{-- ID --}}

                <div class="transport-service-show-detail-item">

                    <div class="transport-service-show-detail-label">
                        Identificador
                    </div>

                    <div class="transport-service-show-detail-value transport-service-show-detail-value-primary">
                        Servicio #{{ $servicio->id }}
                    </div>

                </div>


                {{-- FECHA --}}

                <div class="transport-service-show-detail-item">

                    <div class="transport-service-show-detail-label">
                        Fecha del servicio
                    </div>

                    <div class="transport-service-show-detail-value">

                        {{ $servicio->fecha_servicio
                            ? $servicio->fecha_servicio->format('d/m/Y')
                            : 'Sin fecha'
                        }}

                    </div>

                </div>


                {{-- OPERACIÓN --}}

                <div class="transport-service-show-detail-item">

                    <div class="transport-service-show-detail-label">
                        Operación
                    </div>

                    <div class="transport-service-show-detail-value">

                        @if($servicio->operacion)

                            <a
                                href="{{ route(
                                    'operaciones.show',
                                    $servicio->operacion
                                ) }}"
                                class="transport-service-show-link"
                            >
                                Operación #{{ $servicio->operacion->id }}
                            </a>

                            @if($servicio->operacion->cliente)

                                <div class="transport-service-show-detail-secondary">

                                    Cliente:
                                    {{ $servicio->operacion->cliente->nombre }}

                                </div>

                            @endif

                        @else

                            <span class="transport-service-show-empty">
                                Sin operación
                            </span>

                        @endif

                    </div>

                </div>


                {{-- TIPO --}}

                <div class="transport-service-show-detail-item">

                    <div class="transport-service-show-detail-label">
                        Tipo de servicio
                    </div>

                    <div class="transport-service-show-detail-value">

                        {{ $servicio->tipo_servicio ?: 'Sin especificar' }}

                    </div>

                </div>


                {{-- TRANSPORTISTA --}}

                <div class="transport-service-show-detail-item">

                    <div class="transport-service-show-detail-label">
                        Transportista
                    </div>

                    <div class="transport-service-show-detail-value">

                        @if($servicio->transportista)

                            <a
                                href="{{ route(
                                    'transportistas.show',
                                    $servicio->transportista
                                ) }}"
                                class="transport-service-show-link"
                            >
                                {{ $servicio->transportista->nombre }}
                            </a>

                            <div class="transport-service-show-detail-secondary">

                                RUT:
                                {{ $servicio->transportista->rut }}

                            </div>

                        @else

                            <span class="transport-service-show-empty">
                                Sin transportista
                            </span>

                        @endif

                    </div>

                </div>


                {{-- MONTO --}}

                <div class="transport-service-show-detail-item">

                    <div class="transport-service-show-detail-label">
                        Monto
                    </div>

                    <div class="transport-service-show-detail-value">

                        <span class="transport-service-show-amount">

                            ${{ number_format(
                                (float) $servicio->monto,
                                0,
                                ',',
                                '.'
                            ) }}

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- =====================================================
         VEHÍCULO
    ====================================================== --}}

    <section class="transport-service-show-card">

        <div class="transport-service-show-card-header">

            <div>

                <h2 class="transport-service-show-card-title">
                    Vehículo utilizado
                </h2>

                <p class="transport-service-show-card-description">
                    Información del vehículo asociado al servicio.
                </p>

            </div>

        </div>


        <div class="transport-service-show-card-body">

            @if($servicio->vehiculo)

                <div class="transport-service-show-info-box">

                    <div class="transport-service-show-info-icon">
                        V
                    </div>

                    <div>

                        <strong>
                            Vehículo #{{ $servicio->vehiculo->id }}
                        </strong>

                        <br>

                        {{ $servicio->vehiculo->patente ?: 'Sin patente registrada' }}

                        @if($servicio->vehiculo->tipo)

                            · {{ $servicio->vehiculo->tipo }}

                        @endif

                    </div>

                </div>


                <div class="transport-service-show-detail-grid">


                    {{-- PATENTE --}}

                    <div class="transport-service-show-detail-item">

                        <div class="transport-service-show-detail-label">
                            Patente
                        </div>

                        <div class="transport-service-show-detail-value">

                            {{ $servicio->vehiculo->patente ?: 'Sin patente' }}

                        </div>

                    </div>


                    {{-- TIPO --}}

                    <div class="transport-service-show-detail-item">

                        <div class="transport-service-show-detail-label">
                            Tipo
                        </div>

                        <div class="transport-service-show-detail-value">

                            {{ $servicio->vehiculo->tipo ?: 'Sin especificar' }}

                        </div>

                    </div>


                    {{-- MARCA --}}

                    <div class="transport-service-show-detail-item">

                        <div class="transport-service-show-detail-label">
                            Marca
                        </div>

                        <div class="transport-service-show-detail-value">

                            {{ $servicio->vehiculo->marca ?: 'Sin especificar' }}

                        </div>

                    </div>


                    {{-- MODELO --}}

                    <div class="transport-service-show-detail-item">

                        <div class="transport-service-show-detail-label">
                            Modelo
                        </div>

                        <div class="transport-service-show-detail-value">

                            {{ $servicio->vehiculo->modelo ?: 'Sin especificar' }}

                        </div>

                    </div>


                    {{-- AÑO --}}

                    <div class="transport-service-show-detail-item">

                        <div class="transport-service-show-detail-label">
                            Año
                        </div>

                        <div class="transport-service-show-detail-value">

                            {{ $servicio->vehiculo->anio ?: 'Sin especificar' }}

                        </div>

                    </div>


                    {{-- TRANSPORTISTA DEL VEHÍCULO --}}

                    <div class="transport-service-show-detail-item">

                        <div class="transport-service-show-detail-label">
                            Transportista del vehículo
                        </div>

                        <div class="transport-service-show-detail-value">

                            @if($servicio->vehiculo->transportista)

                                {{ $servicio->vehiculo->transportista->nombre }}

                            @else

                                Sin transportista

                            @endif

                        </div>

                    </div>

                </div>

            @else

                <div class="transport-service-show-empty">
                    No hay un vehículo asociado a este servicio.
                </div>

            @endif

        </div>

    </section>


    {{-- =====================================================
         FACTURACIÓN
    ====================================================== --}}

    <section class="transport-service-show-card">

        <div class="transport-service-show-card-header">

            <div>

                <h2 class="transport-service-show-card-title">
                    Información de facturación
                </h2>

                <p class="transport-service-show-card-description">
                    Estado y antecedentes de la factura asociada al servicio.
                </p>

            </div>

        </div>


        <div class="transport-service-show-card-body">

            <div class="transport-service-show-detail-grid">


                {{-- EMITE FACTURA --}}

                <div class="transport-service-show-detail-item">

                    <div class="transport-service-show-detail-label">
                        Emite factura
                    </div>

                    <div class="transport-service-show-detail-value">

                        @if($servicio->emite_factura)

                            <span class="transport-service-show-badge transport-service-show-badge-invoice">
                                Sí
                            </span>

                        @else

                            <span class="transport-service-show-badge transport-service-show-badge-no-invoice">
                                No
                            </span>

                        @endif

                    </div>

                </div>


                {{-- ESTADO --}}

                <div class="transport-service-show-detail-item">

                    <div class="transport-service-show-detail-label">
                        Estado de facturación
                    </div>

                    <div class="transport-service-show-detail-value">

                        @if(!$servicio->emite_factura)

                            <span class="transport-service-show-badge transport-service-show-badge-no-invoice">
                                No factura
                            </span>

                        @elseif($servicio->estado_facturacion === 'Recibida')

                            <span class="transport-service-show-badge transport-service-show-badge-received">
                                Recibida
                            </span>

                        @else

                            <span class="transport-service-show-badge transport-service-show-badge-pending">
                                Pendiente
                            </span>

                        @endif

                    </div>

                </div>


                {{-- NÚMERO FACTURA --}}

                <div class="transport-service-show-detail-item">

                    <div class="transport-service-show-detail-label">
                        Número de factura
                    </div>

                    <div class="transport-service-show-detail-value">

                        @if($servicio->numero_factura)

                            <span class="transport-service-show-badge transport-service-show-badge-invoice">
                                N° {{ $servicio->numero_factura }}
                            </span>

                        @else

                            <span class="transport-service-show-empty">
                                Sin factura registrada
                            </span>

                        @endif

                    </div>

                </div>


                {{-- FECHA FACTURA --}}

                <div class="transport-service-show-detail-item">

                    <div class="transport-service-show-detail-label">
                        Fecha de factura
                    </div>

                    <div class="transport-service-show-detail-value">

                        {{ $servicio->fecha_factura
                            ? $servicio->fecha_factura->format('d/m/Y')
                            : 'Sin fecha de factura'
                        }}

                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- =====================================================
         OBSERVACIONES
    ====================================================== --}}

    <section class="transport-service-show-card">

        <div class="transport-service-show-card-header">

            <div>

                <h2 class="transport-service-show-card-title">
                    Observaciones
                </h2>

                <p class="transport-service-show-card-description">
                    Información adicional registrada para este servicio.
                </p>

            </div>

        </div>


        <div class="transport-service-show-card-body">

            @if($servicio->observaciones)

                <div class="transport-service-show-observations">
                    {{ $servicio->observaciones }}
                </div>

            @else

                <div class="transport-service-show-empty">
                    No hay observaciones registradas.
                </div>

            @endif

        </div>

    </section>


    {{-- =====================================================
         FOOTER
    ====================================================== --}}

    <div class="transport-service-show-card">

        <div class="transport-service-show-footer">

            <div class="transport-service-show-footer-note">

                Servicio registrado:

                {{ $servicio->created_at
                    ? $servicio->created_at->format('d/m/Y H:i')
                    : 'Sin fecha'
                }}

            </div>


            <div class="transport-service-show-footer-actions">

                <a
                    href="{{ route(
                        'servicios-transporte.index'
                    ) }}"
                    class="btn"
                >
                    Volver al listado
                </a>


                <a
                    href="{{ route(
                        'servicios-transporte.edit',
                        $servicio
                    ) }}"
                    class="btn btn-primary"
                >
                    Editar servicio
                </a>


                <form
                    action="{{ route(
                        'servicios-transporte.destroy',
                        $servicio
                    ) }}"
                    method="POST"
                    class="transport-service-show-delete-form"
                    onsubmit="return confirm('¿Estás seguro de que deseas eliminar este servicio de transporte?');"
                >

                    @csrf

                    @method('DELETE')

                    <button
                        type="submit"
                        class="transport-service-show-delete-button"
                    >
                        Eliminar
                    </button>

                </form>

            </div>

        </div>

    </div>

@endsection