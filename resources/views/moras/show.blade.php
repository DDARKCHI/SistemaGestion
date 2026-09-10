@extends('layouts.app')

@section('title', 'Detalle de mora')

@section('topbar_title', 'Gestión de moras')

@push('styles')

<style>

    /* =========================================================
       BREADCRUMB
    ========================================================== */

    .mora-show-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 18px;
        color: #8a94a6;
        font-size: 12px;
    }

    .mora-show-breadcrumb a {
        color: #667085;
        text-decoration: none;
    }

    .mora-show-breadcrumb a:hover {
        color: #155a91;
    }

    .mora-show-breadcrumb-current {
        color: #344054;
    }


    /* =========================================================
       HEADER
    ========================================================== */

    .mora-show-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 25px;
    }

    .mora-show-title {
        margin: 0;
        color: #172033;
        font-size: 27px;
        line-height: 1.2;
        font-weight: 700;
        letter-spacing: -.025em;
    }

    .mora-show-subtitle {
        margin: 7px 0 0;
        color: #667085;
        font-size: 13px;
    }

    .mora-show-header-actions {
        display: flex;
        gap: 9px;
        flex-wrap: wrap;
    }


    /* =========================================================
       CARD
    ========================================================== */

    .mora-show-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(16,47,80,.05);
        margin-bottom: 20px;
        overflow: hidden;
    }

    .mora-show-card-header {
        min-height: 67px;
        padding: 17px 21px;
        border-bottom: 1px solid #edf1f5;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
    }

    .mora-show-card-title {
        margin: 0;
        color: #172033;
        font-size: 15px;
        font-weight: 700;
    }

    .mora-show-card-description {
        margin: 4px 0 0;
        color: #98a2b3;
        font-size: 11px;
    }

    .mora-show-card-body {
        padding: 22px;
    }


    /* =========================================================
       ESTADO
    ========================================================== */

    .mora-status {
        display: inline-flex;
        align-items: center;
        min-height: 24px;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 10px;
        font-weight: 700;
        white-space: nowrap;
    }

    .mora-status-pendiente {
        background: #fff7e6;
        color: #9a6700;
    }

    .mora-status-trasladada {
        background: #edf6ff;
        color: #155a91;
    }


    /* =========================================================
       ALERTA INFORMATIVA
    ========================================================== */

    .mora-origin-alert {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin-bottom: 20px;
        padding: 14px 16px;
        border: 1px solid #dce9f3;
        border-radius: 8px;
        background: #f7fbff;
        color: #526579;
        font-size: 11px;
        line-height: 1.55;
    }

    .mora-origin-alert-icon {
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

    .mora-origin-alert strong {
        color: #344054;
    }


    /* =========================================================
       GRID DATOS
    ========================================================== */

    .mora-detail-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 0;
        border-top: 1px solid #edf1f5;
        border-left: 1px solid #edf1f5;
    }

    .mora-detail-item {
        min-width: 0;
        padding: 15px 17px;
        border-right: 1px solid #edf1f5;
        border-bottom: 1px solid #edf1f5;
    }

    .mora-detail-label {
        margin-bottom: 6px;
        color: #98a2b3;
        font-size: 10px;
        font-weight: 600;
    }

    .mora-detail-value {
        color: #344054;
        font-size: 12px;
        font-weight: 600;
        word-break: break-word;
    }

    .mora-detail-value-muted {
        color: #98a2b3;
        font-weight: 400;
    }

    .mora-detail-value a {
        color: #155a91;
        text-decoration: none;
    }

    .mora-detail-value a:hover {
        text-decoration: underline;
    }


    /* =========================================================
       BLOQUES ORIGEN / DESTINO
    ========================================================== */

    .mora-relation-grid {
        display: grid;
        grid-template-columns: 1fr 60px 1fr;
        align-items: stretch;
        gap: 12px;
    }

    .mora-relation-box {
        padding: 17px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        background: #fafbfc;
    }

    .mora-relation-box-origin {
        border-left: 3px solid #667085;
    }

    .mora-relation-box-destination {
        border-left: 3px solid #155a91;
    }

    .mora-relation-heading {
        margin: 0 0 4px;
        color: #344054;
        font-size: 12px;
        font-weight: 700;
    }

    .mora-relation-description {
        margin: 0 0 14px;
        color: #98a2b3;
        font-size: 10px;
        line-height: 1.4;
    }

    .mora-relation-data {
        display: grid;
        gap: 10px;
    }

    .mora-relation-data-row {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 15px;
        padding-bottom: 9px;
        border-bottom: 1px solid #edf1f5;
    }

    .mora-relation-data-row:last-child {
        padding-bottom: 0;
        border-bottom: none;
    }

    .mora-relation-data-label {
        color: #98a2b3;
        font-size: 10px;
    }

    .mora-relation-data-value {
        color: #344054;
        font-size: 11px;
        font-weight: 600;
        text-align: right;
    }

    .mora-relation-data-value a {
        color: #155a91;
        text-decoration: none;
    }

    .mora-relation-data-value a:hover {
        text-decoration: underline;
    }

    .mora-relation-arrow {
        display: flex;
        align-items: center;
        justify-content: center;
        color: #98a2b3;
        font-size: 20px;
    }


    /* =========================================================
       CÁLCULO
    ========================================================== */

    .mora-summary-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
    }

    .mora-summary-item {
        padding: 16px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        background: #fafbfc;
    }

    .mora-summary-label {
        margin-bottom: 7px;
        color: #98a2b3;
        font-size: 10px;
        font-weight: 600;
    }

    .mora-summary-value {
        color: #344054;
        font-size: 17px;
        font-weight: 700;
    }

    .mora-summary-value-primary {
        color: #155a91;
    }


    /* =========================================================
       OBSERVACIÓN
    ========================================================== */

    .mora-observation {
        padding: 15px 17px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        background: #fafbfc;
        color: #526579;
        font-size: 11px;
        line-height: 1.6;
        white-space: pre-wrap;
    }


    /* =========================================================
       FOOTER
    ========================================================== */

    .mora-show-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        padding: 18px 22px;
        background: #f8fafc;
        border-top: 1px solid #edf1f5;
    }

    .mora-show-footer-note {
        color: #98a2b3;
        font-size: 10px;
    }

    .mora-show-footer-actions {
        display: flex;
        gap: 9px;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================== */

    @media (max-width: 900px) {

        .mora-relation-grid {
            grid-template-columns: 1fr;
        }

        .mora-relation-arrow {
            transform: rotate(90deg);
            height: 25px;
        }

        .mora-summary-grid {
            grid-template-columns: 1fr;
        }

    }


    @media (max-width: 700px) {

        .mora-show-header {
            flex-direction: column;
        }

        .mora-show-header-actions {
            width: 100%;
        }

        .mora-show-header-actions .btn {
            flex: 1;
        }

        .mora-detail-grid {
            grid-template-columns: 1fr;
        }

        .mora-show-card-body {
            padding: 17px;
        }

        .mora-show-footer {
            align-items: stretch;
            flex-direction: column;
        }

        .mora-show-footer-actions {
            width: 100%;
        }

        .mora-show-footer-actions .btn {
            flex: 1;
        }

    }

</style>

@endpush


@section('content')

    {{-- =====================================================
         BREADCRUMB
    ====================================================== --}}

    <div class="mora-show-breadcrumb">

        <a href="{{ route('moras.index') }}">
            Moras
        </a>

        <span>›</span>

        <span class="mora-show-breadcrumb-current">
            Detalle
        </span>

    </div>


    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="mora-show-header">

        <div>

            <h1 class="mora-show-title">
                Detalle de mora
            </h1>

            <p class="mora-show-subtitle">
                Información completa y trazabilidad del registro de mora.
            </p>

        </div>


        <div class="mora-show-header-actions">

            <a
                href="{{ route('moras.edit', $mora) }}"
                class="btn"
            >
                Editar
            </a>

            <a
                href="{{ route('moras.index') }}"
                class="btn"
            >
                ← Volver
            </a>

        </div>

    </div>


    {{-- =====================================================
         MENSAJES
    ====================================================== --}}

    @if(session('success'))

        <div class="mora-origin-alert">

            <div class="mora-origin-alert-icon">
                ✓
            </div>

            <div>
                <strong>
                    Operación realizada correctamente.
                </strong>

                <br>

                {{ session('success') }}
            </div>

        </div>

    @endif


    @if(session('error'))

        <div
            class="mora-origin-alert"
            style="border-color:#f1ceca;background:#fff5f3;color:#a63228;"
        >

            <div
                class="mora-origin-alert-icon"
                style="background:#a63228;"
            >
                !
            </div>

            <div>
                <strong>
                    No fue posible completar la operación.
                </strong>

                <br>

                {{ session('error') }}
            </div>

        </div>

    @endif


    {{-- =====================================================
         ESTADO Y DATOS GENERALES
    ====================================================== --}}

    <section class="mora-show-card">

        <div class="mora-show-card-header">

            <div>

                <h2 class="mora-show-card-title">
                    Información general
                </h2>

                <p class="mora-show-card-description">
                    Datos principales del registro.
                </p>

            </div>


            @if($mora->factura_destino_id)

                <span class="mora-status mora-status-trasladada">
                    Mora trasladada
                </span>

            @else

                <span class="mora-status mora-status-pendiente">
                    Pendiente de traslado
                </span>

            @endif

        </div>


        <div class="mora-show-card-body">

            <div class="mora-detail-grid">


                <div class="mora-detail-item">

                    <div class="mora-detail-label">
                        ID del registro
                    </div>

                    <div class="mora-detail-value">
                        #{{ $mora->id }}
                    </div>

                </div>


                <div class="mora-detail-item">

                    <div class="mora-detail-label">
                        Fecha
                    </div>

                    <div class="mora-detail-value">

                        {{ $mora->fecha
                            ? $mora->fecha->format('d/m/Y')
                            : '—'
                        }}

                    </div>

                </div>


                <div class="mora-detail-item">

                    <div class="mora-detail-label">
                        Días de atraso
                    </div>

                    <div class="mora-detail-value">
                        {{ number_format($mora->dias_atraso, 0, ',', '.') }}
                    </div>

                </div>


                <div class="mora-detail-item">

                    <div class="mora-detail-label">
                        Valor mora
                    </div>

                    <div class="mora-detail-value">

                        ${{ number_format(
                            (float) $mora->valor_mora,
                            0,
                            ',',
                            '.'
                        ) }}

                    </div>

                </div>


                <div class="mora-detail-item">

                    <div class="mora-detail-label">
                        IVA mora
                    </div>

                    <div class="mora-detail-value">

                        ${{ number_format(
                            (float) $mora->iva_mora,
                            0,
                            ',',
                            '.'
                        ) }}

                    </div>

                </div>


                <div class="mora-detail-item">

                    <div class="mora-detail-label">
                        Total mora
                    </div>

                    <div class="mora-detail-value">

                        ${{ number_format(
                            (
                                (float) $mora->valor_mora +
                                (float) $mora->iva_mora
                            ),
                            0,
                            ',',
                            '.'
                        ) }}

                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- =====================================================
         TRAZABILIDAD
    ====================================================== --}}

    <section class="mora-show-card">

        <div class="mora-show-card-header">

            <div>

                <h2 class="mora-show-card-title">
                    Trazabilidad de la mora
                </h2>

                <p class="mora-show-card-description">
                    Relación entre la factura que originó la mora y la factura que la recibe.
                </p>

            </div>

        </div>


        <div class="mora-show-card-body">


            <div class="mora-origin-alert">

                <div class="mora-origin-alert-icon">
                    i
                </div>

                <div>

                    <strong>
                        Relación real entre registros
                    </strong>

                    <br>

                    La mora está vinculada directamente a su factura y operación de origen. Si fue trasladada, también mantiene la relación con la factura y operación de destino.

                </div>

            </div>


            <div class="mora-relation-grid">


                {{-- ORIGEN --}}

                <div class="mora-relation-box mora-relation-box-origin">

                    <h3 class="mora-relation-heading">
                        Origen
                    </h3>

                    <p class="mora-relation-description">
                        Registro donde se generó el atraso.
                    </p>


                    <div class="mora-relation-data">


                        <div class="mora-relation-data-row">

                            <span class="mora-relation-data-label">
                                Operación
                            </span>

                            <span class="mora-relation-data-value">

                                @if($mora->operacionOrigen)

                                    <a
                                        href="{{ route(
                                            'operaciones.show',
                                            $mora->operacionOrigen
                                        ) }}"
                                    >
                                        {{ $mora->operacionOrigen->numero_operacion }}
                                    </a>

                                @else

                                    —

                                @endif

                            </span>

                        </div>


                        <div class="mora-relation-data-row">

                            <span class="mora-relation-data-label">
                                Cliente
                            </span>

                            <span class="mora-relation-data-value">

                                @if(
                                    $mora->operacionOrigen &&
                                    $mora->operacionOrigen->cliente
                                )

                                    {{ $mora->operacionOrigen->cliente->nombre }}

                                @else

                                    —

                                @endif

                            </span>

                        </div>


                        <div class="mora-relation-data-row">

                            <span class="mora-relation-data-label">
                                Factura
                            </span>

                            <span class="mora-relation-data-value">

                                @if($mora->facturaOrigen)

                                    <a
                                        href="{{ route(
                                            'facturas.show',
                                            $mora->facturaOrigen
                                        ) }}"
                                    >
                                        {{ $mora->facturaOrigen->numero_factura }}
                                    </a>

                                @else

                                    —

                                @endif

                            </span>

                        </div>


                        <div class="mora-relation-data-row">

                            <span class="mora-relation-data-label">
                                Total factura
                            </span>

                            <span class="mora-relation-data-value">

                                @if($mora->facturaOrigen)

                                    ${{ number_format(
                                        (float) $mora->facturaOrigen->total,
                                        0,
                                        ',',
                                        '.'
                                    ) }}

                                @else

                                    —

                                @endif

                            </span>

                        </div>

                    </div>

                </div>


                {{-- FLECHA --}}

                <div class="mora-relation-arrow">
                    →
                </div>


                {{-- DESTINO --}}

                <div class="mora-relation-box mora-relation-box-destination">

                    <h3 class="mora-relation-heading">
                        Destino
                    </h3>

                    <p class="mora-relation-description">
                        Registro que recibe la mora posteriormente.
                    </p>


                    @if($mora->facturaDestino)

                        <div class="mora-relation-data">


                            <div class="mora-relation-data-row">

                                <span class="mora-relation-data-label">
                                    Operación
                                </span>

                                <span class="mora-relation-data-value">

                                    @if($mora->operacionDestino)

                                        <a
                                            href="{{ route(
                                                'operaciones.show',
                                                $mora->operacionDestino
                                            ) }}"
                                        >
                                            {{ $mora->operacionDestino->numero_operacion }}
                                        </a>

                                    @else

                                        —

                                    @endif

                                </span>

                            </div>


                            <div class="mora-relation-data-row">

                                <span class="mora-relation-data-label">
                                    Cliente
                                </span>

                                <span class="mora-relation-data-value">

                                    @if(
                                        $mora->operacionDestino &&
                                        $mora->operacionDestino->cliente
                                    )

                                        {{ $mora->operacionDestino->cliente->nombre }}

                                    @else

                                        —

                                    @endif

                                </span>

                            </div>


                            <div class="mora-relation-data-row">

                                <span class="mora-relation-data-label">
                                    Factura
                                </span>

                                <span class="mora-relation-data-value">

                                    <a
                                        href="{{ route(
                                            'facturas.show',
                                            $mora->facturaDestino
                                        ) }}"
                                    >
                                        {{ $mora->facturaDestino->numero_factura }}
                                    </a>

                                </span>

                            </div>


                            <div class="mora-relation-data-row">

                                <span class="mora-relation-data-label">
                                    Total factura
                                </span>

                                <span class="mora-relation-data-value">

                                    ${{ number_format(
                                        (float) $mora->facturaDestino->total,
                                        0,
                                        ',',
                                        '.'
                                    ) }}

                                </span>

                            </div>

                        </div>

                    @else

                        <div class="mora-detail-value mora-detail-value-muted">

                            Esta mora todavía no ha sido trasladada a otra factura.

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </section>


    {{-- =====================================================
         RESUMEN ECONÓMICO
    ====================================================== --}}

    <section class="mora-show-card">

        <div class="mora-show-card-header">

            <div>

                <h2 class="mora-show-card-title">
                    Resumen económico
                </h2>

                <p class="mora-show-card-description">
                    Valores calculados asociados a la mora.
                </p>

            </div>

        </div>


        <div class="mora-show-card-body">

            <div class="mora-summary-grid">


                <div class="mora-summary-item">

                    <div class="mora-summary-label">
                        Valor neto mora
                    </div>

                    <div class="mora-summary-value">

                        ${{ number_format(
                            (float) $mora->valor_mora,
                            0,
                            ',',
                            '.'
                        ) }}

                    </div>

                </div>


                <div class="mora-summary-item">

                    <div class="mora-summary-label">
                        IVA 19 %
                    </div>

                    <div class="mora-summary-value">

                        ${{ number_format(
                            (float) $mora->iva_mora,
                            0,
                            ',',
                            '.'
                        ) }}

                    </div>

                </div>


                <div class="mora-summary-item">

                    <div class="mora-summary-label">
                        Total mora
                    </div>

                    <div class="mora-summary-value mora-summary-value-primary">

                        ${{ number_format(
                            (
                                (float) $mora->valor_mora +
                                (float) $mora->iva_mora
                            ),
                            0,
                            ',',
                            '.'
                        ) }}

                    </div>

                </div>


            </div>

        </div>

    </section>


    {{-- =====================================================
         OBSERVACIONES
    ====================================================== --}}

    @if($mora->observacion)

        <section class="mora-show-card">

            <div class="mora-show-card-header">

                <div>

                    <h2 class="mora-show-card-title">
                        Observaciones
                    </h2>

                    <p class="mora-show-card-description">
                        Información adicional registrada.
                    </p>

                </div>

            </div>


            <div class="mora-show-card-body">

                <div class="mora-observation">
                    {{ $mora->observacion }}
                </div>

            </div>

        </section>

    @endif


    {{-- =====================================================
         FOOTER
    ====================================================== --}}

    <div class="mora-show-card">

        <div class="mora-show-footer">

            <div class="mora-show-footer-note">

                Registro de mora #{{ $mora->id }}

            </div>


            <div class="mora-show-footer-actions">

                <a
                    href="{{ route('moras.index') }}"
                    class="btn"
                >
                    Volver
                </a>


                <a
                    href="{{ route('moras.edit', $mora) }}"
                    class="btn btn-primary"
                >
                    Editar mora
                </a>

            </div>

        </div>

    </div>

@endsection