@extends('layouts.app')

@section('title', 'Ficha de operación de factoring')

@section('topbar_title', 'Gestión de operaciones de factoring')

@push('styles')

<style>

    /* =========================================================
       BREADCRUMB
    ========================================================== */

    .factoring-detail-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 18px;
        color: #8a94a6;
        font-size: 12px;
    }

    .factoring-detail-breadcrumb a {
        color: #667085;
        text-decoration: none;
    }

    .factoring-detail-breadcrumb a:hover {
        color: #155a91;
    }

    .factoring-detail-breadcrumb-current {
        color: #344054;
    }


    /* =========================================================
       HEADER
    ========================================================== */

    .factoring-detail-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 22px;
    }

    .factoring-detail-header-left {
        display: flex;
        align-items: center;
        gap: 14px;
        min-width: 0;
    }

    .factoring-detail-avatar {
        width: 52px;
        height: 52px;
        min-width: 52px;
        border-radius: 10px;
        background: #155a91;
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 17px;
        font-weight: 700;
        box-shadow:
            0 4px 10px rgba(21,90,145,.16);
    }

    .factoring-detail-title {
        margin: 0;
        color: #172033;
        font-size: 25px;
        line-height: 1.2;
        font-weight: 700;
        letter-spacing: -.025em;
    }

    .factoring-detail-subtitle {
        margin: 5px 0 0;
        color: #667085;
        font-size: 12px;
    }

    .factoring-detail-actions {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-shrink: 0;
    }


    /* =========================================================
       INFORMACIÓN PRINCIPAL
    ========================================================== */

    .factoring-detail-main {
        display: grid;
        grid-template-columns:
            minmax(0, 1.7fr)
            minmax(240px, .8fr);
        gap: 18px;
        margin-bottom: 18px;
    }

    .factoring-detail-card {
        background: #ffffff;
        border:
            1px solid #e2e8f0;
        border-radius: 10px;
        box-shadow:
            0 2px 8px rgba(16,47,80,.05);
        overflow: hidden;
    }

    .factoring-detail-card-header {
        min-height: 62px;
        padding:
            15px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        border-bottom:
            1px solid #edf1f5;
    }

    .factoring-detail-card-title {
        margin: 0;
        color: #172033;
        font-size: 14px;
        font-weight: 700;
    }

    .factoring-detail-card-description {
        margin: 4px 0 0;
        color: #98a2b3;
        font-size: 10px;
    }

    .factoring-detail-card-body {
        padding: 20px;
    }


    /* =========================================================
       DATOS
    ========================================================== */

    .factoring-data-grid {
        display: grid;
        grid-template-columns:
            repeat(2, 1fr);
        gap: 0;
    }

    .factoring-data-item {
        padding:
            15px 17px;
        border-bottom:
            1px solid #edf1f5;
    }

    .factoring-data-item:nth-child(odd) {
        border-right:
            1px solid #edf1f5;
    }

    .factoring-data-item:nth-last-child(-n+2) {
        border-bottom: none;
    }

    .factoring-data-label {
        margin-bottom: 6px;
        color: #8a94a6;
        font-size: 9px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .04em;
    }

    .factoring-data-value {
        color: #344054;
        font-size: 12px;
        font-weight: 500;
        word-break: break-word;
    }

    .factoring-data-value-primary {
        color: #172033;
        font-weight: 600;
    }

    .factoring-rut-badge {
        display: inline-flex;
        align-items: center;
        padding:
            5px 8px;
        border-radius: 5px;
        background: #f1f4f7;
        color: #667085;
        font-size: 10px;
        font-weight: 600;
    }

    .factoring-empty-value {
        color: #a1aab7;
        font-size: 11px;
    }


    /* =========================================================
       ESTADOS
    ========================================================== */

    .factoring-status {
        display: inline-flex;
        align-items: center;
        padding:
            5px 9px;
        border-radius: 20px;
        font-size: 9px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .025em;
    }

    .factoring-status-pendiente {
        background: #fff8e8;
        color: #956b00;
        border:
            1px solid #f0dfae;
    }

    .factoring-status-cursado {
        background: #edf5fb;
        color: #155a91;
        border:
            1px solid #d4e5f2;
    }

    .factoring-status-liquidado {
        background: #edf8f1;
        color: #287443;
        border:
            1px solid #d3ebdb;
    }

    .factoring-status-anulado {
        background: #fff1ef;
        color: #b9382e;
        border:
            1px solid #f0d3cf;
    }


    /* =========================================================
       RESUMEN FINANCIERO
    ========================================================== */

    .factoring-relations-grid {
        display: grid;
        grid-template-columns:
            repeat(2, 1fr);
        gap: 10px;
    }

    .factoring-relation {
        min-height: 80px;
        padding:
            13px;
        border:
            1px solid #e3e9ef;
        border-radius: 8px;
        background: #fbfcfd;
    }

    .factoring-relation-label {
        color: #667085;
        font-size: 9px;
        font-weight: 600;
    }

    .factoring-relation-value {
        margin-top: 7px;
        color: #172033;
        font-size: 19px;
        line-height: 1;
        font-weight: 700;
    }

    .factoring-relation-description {
        margin-top: 5px;
        color: #98a2b3;
        font-size: 9px;
    }


    /* =========================================================
       SECCIONES
    ========================================================== */

    .factoring-section {
        margin-bottom: 18px;
    }

    .factoring-section:last-child {
        margin-bottom: 0;
    }

    .factoring-section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 10px;
    }

    .factoring-section-title {
        margin: 0;
        color: #172033;
        font-size: 15px;
        font-weight: 700;
    }

    .factoring-section-description {
        margin: 4px 0 0;
        color: #98a2b3;
        font-size: 10px;
    }


    /* =========================================================
       RELACIONES
    ========================================================== */

    .factoring-related-card {
        background: #ffffff;
        border:
            1px solid #e2e8f0;
        border-radius: 10px;
        box-shadow:
            0 2px 8px rgba(16,47,80,.05);
        overflow: hidden;
    }

    .factoring-related-table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    .factoring-related-table {
        width: 100%;
        min-width: 850px;
        border-collapse: collapse;
    }

    .factoring-related-table th {
        padding:
            11px 17px;
        background: #f8fafc;
        border-bottom:
            1px solid #e2e8f0;
        color: #667085;
        text-align: left;
        font-size: 9px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .035em;
        white-space: nowrap;
    }

    .factoring-related-table td {
        padding:
            13px 17px;
        border-bottom:
            1px solid #edf1f5;
        color: #344054;
        font-size: 10px;
        vertical-align: middle;
    }

    .factoring-related-table tbody tr:last-child td {
        border-bottom: none;
    }

    .factoring-related-table tbody tr:hover {
        background: #fbfcfe;
    }


    /* =========================================================
       ACCIONES RELACIONADAS
    ========================================================== */

    .factoring-related-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 29px;
        padding:
            5px 9px;
        border:
            1px solid #dce3eb;
        border-radius: 6px;
        background: #ffffff;
        color: #344054;
        text-decoration: none;
        font-size: 9px;
        font-weight: 600;
        transition:
            background .12s ease,
            color .12s ease;
    }

    .factoring-related-action:hover {
        background: #eaf3fa;
        color: #155a91;
    }


    /* =========================================================
       ALERTAS
    ========================================================== */

    .factoring-success {
        margin-bottom: 18px;
        padding:
            11px 14px;
        border:
            1px solid #cfe5d7;
        border-radius: 7px;
        background: #f1faf4;
        color: #287443;
        font-size: 11px;
    }

    .factoring-error {
        margin-bottom: 18px;
        padding:
            11px 14px;
        border:
            1px solid #f0d3cf;
        border-radius: 7px;
        background: #fff5f3;
        color: #b9382e;
        font-size: 11px;
    }


    /* =========================================================
       OBSERVACIONES
    ========================================================== */

    .factoring-observations {
        color: #667085;
        font-size: 11px;
        line-height: 1.6;
        white-space: pre-line;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================== */

    @media (max-width: 950px) {

        .factoring-detail-main {
            grid-template-columns: 1fr;
        }

    }


    @media (max-width: 700px) {

        .factoring-detail-header {
            align-items: stretch;
            flex-direction: column;
        }

        .factoring-detail-actions {
            width: 100%;
        }

        .factoring-detail-actions .btn {
            flex: 1;
        }

        .factoring-data-grid {
            grid-template-columns: 1fr;
        }

        .factoring-data-item:nth-child(odd) {
            border-right: none;
        }

        .factoring-data-item:nth-last-child(-n+2) {
            border-bottom:
                1px solid #edf1f5;
        }

        .factoring-data-item:last-child {
            border-bottom: none;
        }

        .factoring-relations-grid {
            grid-template-columns: 1fr 1fr;
        }

    }

</style>

@endpush


@section('content')

    {{-- =====================================================
         MENSAJES
    ====================================================== --}}

    @if(session('success'))

        <div class="factoring-success">
            {{ session('success') }}
        </div>

    @endif


    @if(session('error'))

        <div class="factoring-error">
            {{ session('error') }}
        </div>

    @endif


    {{-- =====================================================
         BREADCRUMB
    ====================================================== --}}

    <div class="factoring-detail-breadcrumb">

        <a href="{{ route('factorings.index') }}">
            Operaciones de Factoring
        </a>

        <span>›</span>

        <span class="factoring-detail-breadcrumb-current">
            Ficha de operación
        </span>

    </div>


    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="factoring-detail-header">

        <div class="factoring-detail-header-left">

            <div class="factoring-detail-avatar">

                {{ strtoupper(
                    substr(
                        $factoring->operacion->numero_operacion ?? 'FA',
                        0,
                        2
                    )
                ) }}

            </div>


            <div>

                <h1 class="factoring-detail-title">

                    Operación de factoring

                    @if($factoring->operacion)

                        — {{ $factoring->operacion->numero_operacion }}

                    @endif

                </h1>


                <p class="factoring-detail-subtitle">
                    Ficha y antecedentes de la operación de factoring
                </p>

            </div>

        </div>


        <div class="factoring-detail-actions">

            <a
                href="{{ route('factorings.index') }}"
                class="btn"
            >
                ← Volver
            </a>


            <a
                href="{{ route('factorings.edit', $factoring) }}"
                class="btn btn-primary"
            >
                Editar operación
            </a>

        </div>

    </div>


    {{-- =====================================================
         INFORMACIÓN + RESUMEN
    ====================================================== --}}

    <div class="factoring-detail-main">


        {{-- =================================================
             INFORMACIÓN
        ================================================== --}}

        <section class="factoring-detail-card">

            <div class="factoring-detail-card-header">

                <div>

                    <h2 class="factoring-detail-card-title">
                        Información de la operación
                    </h2>

                    <p class="factoring-detail-card-description">
                        Antecedentes registrados del factoring.
                    </p>

                </div>

            </div>


            <div class="factoring-detail-card-body">

                <div class="factoring-data-grid">


                    {{-- EMPRESA FACTORING --}}

                    <div class="factoring-data-item">

                        <div class="factoring-data-label">
                            Empresa de factoring
                        </div>

                        <div class="factoring-data-value factoring-data-value-primary">

                            @if($factoring->empresaFactoring)

                                <a
                                    href="{{ route(
                                        'empresas-factoring.show',
                                        $factoring->empresaFactoring
                                    ) }}"
                                    style="
                                        color:#155a91;
                                        text-decoration:none;
                                    "
                                >
                                    {{ $factoring->empresaFactoring->nombre }}
                                </a>

                            @else

                                <span class="factoring-empty-value">
                                    Sin empresa asociada
                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- RUT FACTORING --}}

                    <div class="factoring-data-item">

                        <div class="factoring-data-label">
                            RUT empresa factoring
                        </div>

                        <div class="factoring-data-value">

                            @if($factoring->empresaFactoring)

                                <span class="factoring-rut-badge">
                                    {{ $factoring->empresaFactoring->rut }}
                                </span>

                            @else

                                <span class="factoring-empty-value">
                                    No registrado
                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- OPERACIÓN --}}

                    <div class="factoring-data-item">

                        <div class="factoring-data-label">
                            Operación
                        </div>

                        <div class="factoring-data-value factoring-data-value-primary">

                            @if($factoring->operacion)

                                <a
                                    href="{{ route(
                                        'operaciones.show',
                                        $factoring->operacion
                                    ) }}"
                                    style="
                                        color:#155a91;
                                        text-decoration:none;
                                    "
                                >
                                    {{ $factoring->operacion->numero_operacion }}
                                </a>

                            @else

                                <span class="factoring-empty-value">
                                    Sin operación asociada
                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- CLIENTE --}}

                    <div class="factoring-data-item">

                        <div class="factoring-data-label">
                            Cliente
                        </div>

                        <div class="factoring-data-value">

                            @if(
                                $factoring->operacion &&
                                $factoring->operacion->cliente
                            )

                                {{ $factoring->operacion->cliente->razon_social }}

                            @else

                                <span class="factoring-empty-value">
                                    Sin cliente
                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- FACTURA --}}

                    <div class="factoring-data-item">

                        <div class="factoring-data-label">
                            Factura
                        </div>

                        <div class="factoring-data-value factoring-data-value-primary">

                            @if($factoring->factura)

                                <a
                                    href="{{ route(
                                        'facturas.show',
                                        $factoring->factura
                                    ) }}"
                                    style="
                                        color:#155a91;
                                        text-decoration:none;
                                    "
                                >
                                    N.º {{ $factoring->factura->numero_factura }}
                                </a>

                            @else

                                <span class="factoring-empty-value">
                                    Sin factura asociada
                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- FECHA CURSE --}}

                    <div class="factoring-data-item">

                        <div class="factoring-data-label">
                            Fecha de curse
                        </div>

                        <div class="factoring-data-value">

                            @if($factoring->fecha_curse)

                                {{ $factoring->fecha_curse->format('d/m/Y') }}

                            @else

                                <span class="factoring-empty-value">
                                    No registrada
                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- ESTADO --}}

                    <div class="factoring-data-item">

                        <div class="factoring-data-label">
                            Estado
                        </div>

                        <div class="factoring-data-value">

                            @php

                                $estadoClase = match($factoring->estado) {

                                    'pendiente' => 'factoring-status-pendiente',

                                    'cursado' => 'factoring-status-cursado',

                                    'liquidado' => 'factoring-status-liquidado',

                                    'anulado' => 'factoring-status-anulado',

                                    default => 'factoring-status-cursado',

                                };

                                $estadoTexto = ucfirst(
                                    str_replace(
                                        '_',
                                        ' ',
                                        $factoring->estado
                                    )
                                );

                            @endphp


                            <span class="factoring-status {{ $estadoClase }}">

                                {{ $estadoTexto }}

                            </span>

                        </div>

                    </div>


                    {{-- FECHA EMISIÓN FACTURA --}}

                    <div class="factoring-data-item">

                        <div class="factoring-data-label">
                            Fecha emisión factura
                        </div>

                        <div class="factoring-data-value">

                            @if(
                                $factoring->factura &&
                                $factoring->factura->fecha_emision
                            )

                                {{ $factoring->factura->fecha_emision->format('d/m/Y') }}

                            @else

                                <span class="factoring-empty-value">
                                    No registrada
                                </span>

                            @endif

                        </div>

                    </div>

                </div>

            </div>

        </section>


        {{-- =================================================
             RESUMEN FINANCIERO
        ================================================== --}}

        <section class="factoring-detail-card">

            <div class="factoring-detail-card-header">

                <div>

                    <h2 class="factoring-detail-card-title">
                        Resumen financiero
                    </h2>

                    <p class="factoring-detail-card-description">
                        Montos registrados en la operación.
                    </p>

                </div>

            </div>


            <div class="factoring-detail-card-body">

                <div class="factoring-relations-grid">


                    {{-- MONTO FACTURA --}}

                    <div class="factoring-relation">

                        <div class="factoring-relation-label">
                            Monto factura
                        </div>

                        <div class="factoring-relation-value">

                            ${{ number_format(
                                (float) $factoring->monto_factura,
                                0,
                                ',',
                                '.'
                            ) }}

                        </div>

                        <div class="factoring-relation-description">
                            Total de la factura
                        </div>

                    </div>


                    {{-- ANTICIPO --}}

                    <div class="factoring-relation">

                        <div class="factoring-relation-label">
                            Anticipo
                        </div>

                        <div class="factoring-relation-value">

                            ${{ number_format(
                                (float) $factoring->monto_anticipo,
                                0,
                                ',',
                                '.'
                            ) }}

                        </div>

                        <div class="factoring-relation-description">
                            Monto anticipado
                        </div>

                    </div>


                    {{-- COMISIÓN --}}

                    <div class="factoring-relation">

                        <div class="factoring-relation-label">
                            Comisión
                        </div>

                        <div class="factoring-relation-value">

                            ${{ number_format(
                                (float) $factoring->comision,
                                0,
                                ',',
                                '.'
                            ) }}

                        </div>

                        <div class="factoring-relation-description">
                            Comisión aplicada
                        </div>

                    </div>


                    {{-- INTERÉS --}}

                    <div class="factoring-relation">

                        <div class="factoring-relation-label">
                            Interés
                        </div>

                        <div class="factoring-relation-value">

                            ${{ number_format(
                                (float) $factoring->interes,
                                0,
                                ',',
                                '.'
                            ) }}

                        </div>

                        <div class="factoring-relation-description">
                            Interés aplicado
                        </div>

                    </div>


                    {{-- LIQUIDADO --}}

                    <div
                        class="factoring-relation"
                        style="grid-column:1 / -1;"
                    >

                        <div class="factoring-relation-label">
                            Monto liquidado
                        </div>

                        <div
                            class="factoring-relation-value"
                            style="
                                color:#155a91;
                                font-size:24px;
                            "
                        >

                            ${{ number_format(
                                (float) $factoring->monto_liquidado,
                                0,
                                ',',
                                '.'
                            ) }}

                        </div>

                        <div class="factoring-relation-description">
                            Anticipo menos comisión e interés
                        </div>

                    </div>


                </div>

            </div>

        </section>

    </div>


    {{-- =====================================================
         DATOS DE LA FACTURA
    ====================================================== --}}

    @if($factoring->factura)

        <section class="factoring-section">

            <div class="factoring-section-header">

                <div>

                    <h2 class="factoring-section-title">
                        Factura asociada
                    </h2>

                    <p class="factoring-section-description">
                        Información de la factura vinculada directamente a esta operación de factoring.
                    </p>

                </div>

            </div>


            <div class="factoring-related-card">

                <div class="factoring-detail-card-body">

                    <div class="factoring-data-grid">


                        {{-- NÚMERO --}}

                        <div class="factoring-data-item">

                            <div class="factoring-data-label">
                                Número de factura
                            </div>

                            <div class="factoring-data-value factoring-data-value-primary">

                                N.º {{ $factoring->factura->numero_factura }}

                            </div>

                        </div>


                        {{-- ESTADO FACTURA --}}

                        <div class="factoring-data-item">

                            <div class="factoring-data-label">
                                Estado factura
                            </div>

                            <div class="factoring-data-value">

                                {{ ucfirst(
                                    str_replace(
                                        '_',
                                        ' ',
                                        $factoring->factura->estado
                                    )
                                ) }}

                            </div>

                        </div>


                        {{-- FECHA VENCIMIENTO --}}

                        <div class="factoring-data-item">

                            <div class="factoring-data-label">
                                Fecha de vencimiento
                            </div>

                            <div class="factoring-data-value">

                                @if($factoring->factura->fecha_vencimiento)

                                    {{ $factoring->factura->fecha_vencimiento->format('d/m/Y') }}

                                @else

                                    <span class="factoring-empty-value">
                                        No registrada
                                    </span>

                                @endif

                            </div>

                        </div>


                        {{-- ESTADO MORA --}}

                        <div class="factoring-data-item">

                            <div class="factoring-data-label">
                                Estado de mora
                            </div>

                            <div class="factoring-data-value">

                                {{ $factoring->factura->estado_mora === 'con_mora'
                                    ? 'Con mora'
                                    : 'Sin mora' }}

                            </div>

                        </div>


                    </div>

                </div>

            </div>

        </section>

    @endif


    {{-- =====================================================
         OBSERVACIONES
    ====================================================== --}}

    <section class="factoring-section">

        <div class="factoring-section-header">

            <div>

                <h2 class="factoring-section-title">
                    Observaciones
                </h2>

                <p class="factoring-section-description">
                    Información adicional registrada para esta operación.
                </p>

            </div>

        </div>


        <div class="factoring-related-card">

            <div class="factoring-detail-card-body">

                @if($factoring->observaciones)

                    <div class="factoring-observations">
                        {{ $factoring->observaciones }}
                    </div>

                @else

                    <span class="factoring-empty-value">
                        No existen observaciones registradas.
                    </span>

                @endif

            </div>

        </div>

    </section>

@endsection