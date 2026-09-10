@extends('layouts.app')

@section('title', 'Ficha de empresa de factoring')

@section('topbar_title', 'Gestión de empresas de factoring')

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
       ESTADO
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


    .factoring-status-active {

        background: #edf8f1;

        color: #287443;

        border:
            1px solid #d3ebdb;

    }


    .factoring-status-inactive {

        background: #f5f6f7;

        color: #667085;

        border:
            1px solid #e2e5e8;

    }


    /* =========================================================
       RESUMEN
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

        font-size: 21px;

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
       TABLA DE OPERACIONES
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

        min-width: 950px;

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


    .factoring-operation-number {

        color: #155a91;

        font-weight: 700;

    }


    .factoring-invoice-number {

        color: #344054;

        font-weight: 600;

    }


    .factoring-date {

        color: #667085;

        white-space: nowrap;

    }


    .factoring-amount {

        color: #172033;

        font-weight: 600;

        white-space: nowrap;

    }


    .factoring-operation-status {

        display: inline-flex;

        align-items: center;

        padding:
            4px 8px;

        border-radius: 20px;

        background: #f1f4f7;

        color: #667085;

        font-size: 9px;

        font-weight: 600;

    }


    .factoring-operation-status-dot {

        width: 5px;

        height: 5px;

        margin-right: 5px;

        border-radius: 50%;

        background: #98a2b3;

    }


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
       EMPTY STATE
    ========================================================== */

    .factoring-related-empty {

        padding:
            40px 20px;

        text-align: center;

    }


    .factoring-related-empty-icon {

        width: 40px;

        height: 40px;

        margin:
            0 auto 10px;

        border-radius: 8px;

        background: #eef4f8;

        color: #155a91;

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 16px;

    }


    .factoring-related-empty-title {

        margin: 0;

        color: #344054;

        font-size: 12px;

        font-weight: 700;

    }


    .factoring-related-empty-text {

        margin:
            5px auto 0;

        max-width: 390px;

        color: #98a2b3;

        font-size: 10px;

        line-height: 1.5;

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

        <a href="{{ route('empresas-factoring.index') }}">
            Empresas de Factoring
        </a>

        <span>›</span>

        <span class="factoring-detail-breadcrumb-current">
            Ficha de empresa
        </span>

    </div>


    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="factoring-detail-header">

        <div class="factoring-detail-header-left">

            <div class="factoring-detail-avatar">

                {{ strtoupper(
                    substr($empresaFactoring->nombre, 0, 2)
                ) }}

            </div>


            <div>

                <h1 class="factoring-detail-title">
                    {{ $empresaFactoring->nombre }}
                </h1>

                <p class="factoring-detail-subtitle">
                    Ficha y antecedentes de la empresa de factoring
                </p>

            </div>

        </div>


        <div class="factoring-detail-actions">

            <a
                href="{{ route('empresas-factoring.index') }}"
                class="btn"
            >
                ← Volver
            </a>


            <a
                href="{{ route('empresas-factoring.edit', $empresaFactoring) }}"
                class="btn btn-primary"
            >
                Editar empresa
            </a>

        </div>

    </div>


    {{-- =====================================================
         INFORMACIÓN + RESUMEN
    ====================================================== --}}

    <div class="factoring-detail-main">


        {{-- INFORMACIÓN --}}

        <section class="factoring-detail-card">

            <div class="factoring-detail-card-header">

                <div>

                    <h2 class="factoring-detail-card-title">
                        Información de la empresa
                    </h2>

                    <p class="factoring-detail-card-description">
                        Antecedentes registrados.
                    </p>

                </div>

            </div>


            <div class="factoring-detail-card-body">

                <div class="factoring-data-grid">


                    {{-- NOMBRE --}}

                    <div class="factoring-data-item">

                        <div class="factoring-data-label">
                            Nombre / razón social
                        </div>

                        <div class="factoring-data-value factoring-data-value-primary">
                            {{ $empresaFactoring->nombre }}
                        </div>

                    </div>


                    {{-- RUT --}}

                    <div class="factoring-data-item">

                        <div class="factoring-data-label">
                            RUT
                        </div>

                        <div class="factoring-data-value">

                            <span class="factoring-rut-badge">
                                {{ $empresaFactoring->rut }}
                            </span>

                        </div>

                    </div>


                    {{-- ESTADO --}}

                    <div class="factoring-data-item">

                        <div class="factoring-data-label">
                            Estado
                        </div>

                        <div class="factoring-data-value">

                            @if($empresaFactoring->estado === 'activo')

                                <span class="factoring-status factoring-status-active">
                                    Activo
                                </span>

                            @else

                                <span class="factoring-status factoring-status-inactive">
                                    Inactivo
                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- CORREO --}}

                    <div class="factoring-data-item">

                        <div class="factoring-data-label">
                            Correo electrónico
                        </div>

                        <div class="factoring-data-value">

                            @if($empresaFactoring->correo)

                                {{ $empresaFactoring->correo }}

                            @else

                                <span class="factoring-empty-value">
                                    No registrado
                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- TELÉFONO --}}

                    <div class="factoring-data-item">

                        <div class="factoring-data-label">
                            Teléfono
                        </div>

                        <div class="factoring-data-value">

                            @if($empresaFactoring->telefono)

                                {{ $empresaFactoring->telefono }}

                            @else

                                <span class="factoring-empty-value">
                                    No registrado
                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- EJECUTIVO --}}

                    <div class="factoring-data-item">

                        <div class="factoring-data-label">
                            Ejecutivo
                        </div>

                        <div class="factoring-data-value">

                            @if($empresaFactoring->ejecutivo)

                                {{ $empresaFactoring->ejecutivo }}

                            @else

                                <span class="factoring-empty-value">
                                    No registrado
                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- TELÉFONO EJECUTIVO --}}

                    <div class="factoring-data-item">

                        <div class="factoring-data-label">
                            Teléfono del ejecutivo
                        </div>

                        <div class="factoring-data-value">

                            @if($empresaFactoring->telefono_ejecutivo)

                                {{ $empresaFactoring->telefono_ejecutivo }}

                            @else

                                <span class="factoring-empty-value">
                                    No registrado
                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- CUENTA BANCARIA --}}

                    <div class="factoring-data-item">

                        <div class="factoring-data-label">
                            Cuenta bancaria
                        </div>

                        <div class="factoring-data-value">

                            @if($empresaFactoring->cuenta_bancaria)

                                {{ $empresaFactoring->cuenta_bancaria }}

                            @else

                                <span class="factoring-empty-value">
                                    No registrada
                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- OTROS DATOS --}}

                    <div
                        class="factoring-data-item"
                        style="grid-column: 1 / -1;"
                    >

                        <div class="factoring-data-label">
                            Otros datos
                        </div>

                        <div class="factoring-data-value">

                            @if($empresaFactoring->otros_datos)

                                {{ $empresaFactoring->otros_datos }}

                            @else

                                <span class="factoring-empty-value">
                                    Sin información adicional
                                </span>

                            @endif

                        </div>

                    </div>

                </div>

            </div>

        </section>


        {{-- RESUMEN --}}

        <section class="factoring-detail-card">

            <div class="factoring-detail-card-header">

                <div>

                    <h2 class="factoring-detail-card-title">
                        Resumen
                    </h2>

                    <p class="factoring-detail-card-description">
                        Relaciones de la empresa.
                    </p>

                </div>

            </div>


            <div class="factoring-detail-card-body">

                <div class="factoring-relations-grid">


                    <div class="factoring-relation">

                        <div class="factoring-relation-label">
                            Operaciones
                        </div>

                        <div class="factoring-relation-value">
                            {{ $empresaFactoring->factorings->count() }}
                        </div>

                        <div class="factoring-relation-description">
                            Operaciones de factoring
                        </div>

                    </div>


                    <div class="factoring-relation">

                        <div class="factoring-relation-label">
                            Estado
                        </div>

                        <div class="factoring-relation-value"
                             style="font-size: 15px; margin-top: 10px;">

                            {{ $empresaFactoring->estado === 'activo'
                                ? 'Activo'
                                : 'Inactivo' }}

                        </div>

                        <div class="factoring-relation-description">
                            Estado actual
                        </div>

                    </div>

                </div>

            </div>

        </section>

    </div>


    {{-- =====================================================
         OPERACIONES DE FACTORING
    ====================================================== --}}

    <section class="factoring-section">

        <div class="factoring-section-header">

            <div>

                <h2 class="factoring-section-title">
                    Operaciones de factoring
                </h2>

                <p class="factoring-section-description">
                    Operaciones asociadas a esta empresa, ordenadas por fecha de curse.
                </p>

            </div>

        </div>


        <div class="factoring-related-card">

            @if($empresaFactoring->factorings->count())

                <div class="factoring-related-table-wrapper">

                    <table class="factoring-related-table">

                        <thead>

                            <tr>

                                <th>
                                    N.º operación
                                </th>

                                <th>
                                    Cliente
                                </th>

                                <th>
                                    Factura
                                </th>

                                <th>
                                    Fecha de curse
                                </th>

                                <th>
                                    Monto factura
                                </th>

                                <th>
                                    Estado
                                </th>

                                <th>
                                    Acciones
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($empresaFactoring->factorings as $factoring)

                                <tr>

                                    <td>

                                        @if($factoring->operacion)

                                            <span class="factoring-operation-number">
                                                {{ $factoring->operacion->numero_operacion }}
                                            </span>

                                        @else

                                            <span class="factoring-empty-value">
                                                Sin operación
                                            </span>

                                        @endif

                                    </td>


                                    <td>

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

                                    </td>


                                    <td>

                                        @if($factoring->factura)

                                            <span class="factoring-invoice-number">
                                                N.º {{ $factoring->factura->numero_factura }}
                                            </span>

                                        @else

                                            <span class="factoring-empty-value">
                                                Sin factura
                                            </span>

                                        @endif

                                    </td>


                                    <td>

                                        @if($factoring->fecha_curse)

                                            <span class="factoring-date">
                                                {{ $factoring->fecha_curse->format('d/m/Y') }}
                                            </span>

                                        @else

                                            <span class="factoring-empty-value">
                                                —
                                            </span>

                                        @endif

                                    </td>


                                    <td>

                                        <span class="factoring-amount">

                                            ${{ number_format(
                                                (float) $factoring->monto_factura,
                                                0,
                                                ',',
                                                '.'
                                            ) }}

                                        </span>

                                    </td>


                                    <td>

                                        <span class="factoring-operation-status">

                                            <span class="factoring-operation-status-dot">
                                            </span>

                                            {{ ucfirst(
                                                str_replace(
                                                    '_',
                                                    ' ',
                                                    $factoring->estado
                                                )
                                            ) }}

                                        </span>

                                    </td>


                                    <td>

                                        <div style="display:flex; gap:6px;">

                                            @if($factoring->operacion)

                                                <a
                                                    href="{{ route('operaciones.show', $factoring->operacion) }}"
                                                    class="factoring-related-action"
                                                >
                                                    Ver operación
                                                </a>

                                            @endif


                                            @if($factoring->factura)

                                                <a
                                                    href="{{ route('facturas.show', $factoring->factura) }}"
                                                    class="factoring-related-action"
                                                >
                                                    Ver factura
                                                </a>

                                            @endif

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="factoring-related-empty">

                    <div class="factoring-related-empty-icon">
                        ▣
                    </div>

                    <h3 class="factoring-related-empty-title">
                        No hay operaciones de factoring asociadas
                    </h3>

                    <p class="factoring-related-empty-text">
                        Esta empresa todavía no tiene operaciones de factoring asociadas.
                    </p>

                </div>

            @endif

        </div>

    </section>

@endsection