@extends('layouts.app')

@section('title', 'Detalle entrega')

@section('topbar_title', 'Gestión de entregas')

@push('styles')

<style>

    /* =========================================================
       HEADER
    ========================================================== */

    .delivery-show-header {

        display: flex;

        align-items: flex-start;

        justify-content: space-between;

        gap: 20px;

        margin-bottom: 24px;

    }

    .delivery-show-title {

        margin: 0;

        color: #172033;

        font-size: 27px;

        line-height: 1.2;

        font-weight: 700;

        letter-spacing: -.025em;

    }

    .delivery-show-subtitle {

        margin: 7px 0 0;

        color: #667085;

        font-size: 13px;

    }

    .delivery-show-actions {

        display: flex;

        align-items: center;

        gap: 8px;

        flex-shrink: 0;

    }

    .delivery-show-button {

        display: inline-flex;

        align-items: center;

        justify-content: center;

        min-height: 37px;

        padding: 8px 14px;

        border-radius: 6px;

        font-family: inherit;

        font-size: 10px;

        font-weight: 600;

        text-decoration: none;

        cursor: pointer;

        transition:
            background .12s ease,
            border-color .12s ease,
            color .12s ease;

    }

    .delivery-show-button-primary {

        border: 1px solid #155a91;

        background: #155a91;

        color: #ffffff;

    }

    .delivery-show-button-primary:hover {

        background: #124d7d;

        border-color: #124d7d;

        color: #ffffff;

    }

    .delivery-show-button-secondary {

        border: 1px solid #dce3eb;

        background: #ffffff;

        color: #344054;

    }

    .delivery-show-button-secondary:hover {

        background: #f5f8fb;

        border-color: #cbd7e3;

        color: #155a91;

    }


    /* =========================================================
       MENSAJES
    ========================================================== */

    .delivery-show-alert {

        margin-bottom: 18px;

        padding: 11px 14px;

        border-radius: 7px;

        font-size: 11px;

    }

    .delivery-show-success {

        border: 1px solid #cfe5d7;

        background: #f1faf4;

        color: #287443;

    }

    .delivery-show-error {

        border: 1px solid #e9c1bc;

        background: #fff5f3;

        color: #a52f26;

    }


    /* =========================================================
       RESUMEN
    ========================================================== */

    .delivery-show-summary {

        display: grid;

        grid-template-columns: repeat(3, 1fr);

        gap: 14px;

        margin-bottom: 20px;

    }

    .delivery-show-summary-card {

        background: #ffffff;

        border: 1px solid #e2e8f0;

        border-radius: 9px;

        padding: 17px 19px;

        box-shadow:
            0 2px 7px rgba(16,47,80,.04);

    }

    .delivery-show-summary-label {

        color: #667085;

        font-size: 10px;

        font-weight: 600;

        text-transform: uppercase;

        letter-spacing: .03em;

    }

    .delivery-show-summary-value {

        margin-top: 7px;

        color: #172033;

        font-size: 22px;

        line-height: 1.1;

        font-weight: 700;

    }

    .delivery-show-summary-description {

        margin-top: 6px;

        color: #98a2b3;

        font-size: 9px;

    }


    /* =========================================================
       ESTADOS
    ========================================================== */

    .delivery-show-status {

        display: inline-flex;

        align-items: center;

        min-height: 25px;

        padding: 4px 8px;

        border-radius: 6px;

        background: #f1f4f7;

        color: #475467;

        font-size: 10px;

        font-weight: 700;

        text-transform: capitalize;

    }

    .delivery-show-status.pendiente {

        background: #fff5e8;

        color: #a15c00;

    }

    .delivery-show-status.en_transito {

        background: #eef4ff;

        color: #3157a4;

    }

    .delivery-show-status.entregada {

        background: #f1faf4;

        color: #287443;

    }

    .delivery-show-status.rechazada {

        background: #fff5f3;

        color: #a52f26;

    }


    /* =========================================================
       CARD
    ========================================================== */

    .delivery-show-card {

        margin-bottom: 20px;

        background: #ffffff;

        border: 1px solid #e2e8f0;

        border-radius: 10px;

        box-shadow:
            0 2px 8px rgba(16,47,80,.05);

        overflow: hidden;

    }

    .delivery-show-card-header {

        min-height: 66px;

        padding: 15px 20px;

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 15px;

        border-bottom: 1px solid #edf1f5;

    }

    .delivery-show-card-title {

        margin: 0;

        color: #172033;

        font-size: 14px;

        font-weight: 700;

    }

    .delivery-show-card-description {

        margin: 4px 0 0;

        color: #98a2b3;

        font-size: 10px;

    }

    .delivery-show-card-body {

        padding: 22px 20px;

    }


    /* =========================================================
       DATOS
    ========================================================== */

    .delivery-show-grid {

        display: grid;

        grid-template-columns: repeat(2, minmax(0, 1fr));

        gap: 0 30px;

    }

    .delivery-show-field {

        min-height: 70px;

        padding: 13px 0;

        border-bottom: 1px solid #edf1f5;

    }

    .delivery-show-field-full {

        grid-column: 1 / -1;

    }

    .delivery-show-field-label {

        margin-bottom: 5px;

        color: #98a2b3;

        font-size: 9px;

        font-weight: 600;

        text-transform: uppercase;

        letter-spacing: .03em;

    }

    .delivery-show-field-value {

        color: #344054;

        font-size: 11px;

        line-height: 1.5;

    }

    .delivery-show-field-value.strong {

        color: #172033;

        font-weight: 600;

    }

    .delivery-show-empty {

        color: #98a2b3;

        font-style: italic;

    }


    /* =========================================================
       RELACIÓN
    ========================================================== */

    .delivery-show-relation {

        display: grid;

        grid-template-columns: repeat(2, minmax(0, 1fr));

        gap: 14px;

    }

    .delivery-show-relation-item {

        padding: 15px 17px;

        border: 1px solid #d4e5f2;

        border-radius: 8px;

        background: #f7fbfe;

    }

    .delivery-show-relation-label {

        margin-bottom: 5px;

        color: #98a2b3;

        font-size: 9px;

        font-weight: 600;

        text-transform: uppercase;

        letter-spacing: .03em;

    }

    .delivery-show-relation-value {

        color: #344054;

        font-size: 11px;

        line-height: 1.5;

    }

    .delivery-show-link {

        color: #155a91;

        font-size: 12px;

        font-weight: 700;

        text-decoration: none;

    }

    .delivery-show-link:hover {

        color: #124d7d;

        text-decoration: underline;

    }


    /* =========================================================
       FOOTER
    ========================================================== */

    .delivery-show-footer {

        min-height: 60px;

        padding: 12px 20px;

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 15px;

        border-top: 1px solid #edf1f5;

        background: #fbfcfd;

    }

    .delivery-show-footer-text {

        margin: 0;

        color: #98a2b3;

        font-size: 10px;

    }


    /* =========================================================
       RESPONSIVE
    ========================================================== */

    @media (max-width: 900px) {

        .delivery-show-summary {

            grid-template-columns: 1fr;

        }

    }

    @media (max-width: 800px) {

        .delivery-show-header {

            flex-direction: column;

        }

        .delivery-show-actions {

            width: 100%;

        }

        .delivery-show-actions a {

            flex: 1;

        }

        .delivery-show-grid,
        .delivery-show-relation {

            grid-template-columns: 1fr;

        }

        .delivery-show-field-full {

            grid-column: auto;

        }

        .delivery-show-footer {

            align-items: flex-start;

            flex-direction: column;

        }

    }

</style>

@endpush


@section('content')

    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="delivery-show-header">

        <div>

            <h1 class="delivery-show-title">
                {{ $entrega->numero_entrega }}
            </h1>

            <p class="delivery-show-subtitle">
                Detalle de la entrega.
            </p>

        </div>


        <div class="delivery-show-actions">

            <a
                href="{{ route('entregas.index') }}"
                class="delivery-show-button delivery-show-button-secondary"
            >
                Volver
            </a>

            <a
                href="{{ route('entregas.edit', $entrega) }}"
                class="delivery-show-button delivery-show-button-primary"
            >
                Editar entrega
            </a>

        </div>

    </div>


    {{-- =====================================================
         MENSAJES
    ====================================================== --}}

    @if(session('success'))

        <div class="delivery-show-alert delivery-show-success">
            {{ session('success') }}
        </div>

    @endif


    @if(session('error'))

        <div class="delivery-show-alert delivery-show-error">
            {{ session('error') }}
        </div>

    @endif


    {{-- =====================================================
         RESUMEN
    ====================================================== --}}

    <div class="delivery-show-summary">

        <div class="delivery-show-summary-card">

            <div class="delivery-show-summary-label">
                N.º entrega
            </div>

            <div class="delivery-show-summary-value">
                {{ $entrega->numero_entrega }}
            </div>

            <div class="delivery-show-summary-description">
                Identificador de la entrega
            </div>

        </div>


        <div class="delivery-show-summary-card">

            <div class="delivery-show-summary-label">
                Estado
            </div>

            <div class="delivery-show-summary-value">

                <span
                    class="delivery-show-status {{ strtolower($entrega->estado ?? '') }}"
                >
                    {{ str_replace('_', ' ', $entrega->estado) }}
                </span>

            </div>

            <div class="delivery-show-summary-description">
                Estado actual
            </div>

        </div>


        <div class="delivery-show-summary-card">

            <div class="delivery-show-summary-label">
                Fecha de entrega
            </div>

            <div class="delivery-show-summary-value">

                @if($entrega->fecha_entrega)

                    {{ $entrega->fecha_entrega->format('d/m/Y') }}

                @else

                    —

                @endif

            </div>

            <div class="delivery-show-summary-description">
                Fecha registrada
            </div>

        </div>

    </div>


    {{-- =====================================================
         INFORMACIÓN
    ====================================================== --}}

    <section class="delivery-show-card">

        <div class="delivery-show-card-header">

            <div>

                <h2 class="delivery-show-card-title">
                    Información de la entrega
                </h2>

                <p class="delivery-show-card-description">
                    Datos principales registrados.
                </p>

            </div>

        </div>


        <div class="delivery-show-card-body">

            <div class="delivery-show-grid">

                <div class="delivery-show-field">

                    <div class="delivery-show-field-label">
                        Número de entrega
                    </div>

                    <div class="delivery-show-field-value strong">
                        {{ $entrega->numero_entrega }}
                    </div>

                </div>


                <div class="delivery-show-field">

                    <div class="delivery-show-field-label">
                        Estado
                    </div>

                    <div class="delivery-show-field-value">

                        <span
                            class="delivery-show-status {{ strtolower($entrega->estado ?? '') }}"
                        >
                            {{ str_replace('_', ' ', $entrega->estado) }}
                        </span>

                    </div>

                </div>


                <div class="delivery-show-field">

                    <div class="delivery-show-field-label">
                        Fecha de entrega
                    </div>

                    <div class="delivery-show-field-value">

                        @if($entrega->fecha_entrega)

                            {{ $entrega->fecha_entrega->format('d/m/Y') }}

                        @else

                            <span class="delivery-show-empty">
                                No registrada
                            </span>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- =====================================================
         OPERACIÓN ASOCIADA
    ====================================================== --}}

    <section class="delivery-show-card">

        <div class="delivery-show-card-header">

            <div>

                <h2 class="delivery-show-card-title">
                    Operación asociada
                </h2>

                <p class="delivery-show-card-description">
                    Relación de esta entrega con su operación y cliente.
                </p>

            </div>

        </div>


        <div class="delivery-show-card-body">

            <div class="delivery-show-relation">

                <div class="delivery-show-relation-item">

                    <div class="delivery-show-relation-label">
                        Operación
                    </div>

                    <div class="delivery-show-relation-value">

                        @if($entrega->operacion)

                            <a
                                href="{{ route('operaciones.show', $entrega->operacion) }}"
                                class="delivery-show-link"
                            >
                                {{ $entrega->operacion->numero_operacion }}
                            </a>

                        @else

                            <span class="delivery-show-empty">
                                Sin operación asociada
                            </span>

                        @endif

                    </div>

                </div>


                <div class="delivery-show-relation-item">

                    <div class="delivery-show-relation-label">
                        Cliente
                    </div>

                    <div class="delivery-show-relation-value strong">

                        {{
                            $entrega->operacion?->cliente?->razon_social
                            ?? 'Sin cliente'
                        }}

                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- =====================================================
         DESCRIPCIÓN Y OBSERVACIONES
    ====================================================== --}}

    <section class="delivery-show-card">

        <div class="delivery-show-card-header">

            <div>

                <h2 class="delivery-show-card-title">
                    Descripción y observaciones
                </h2>

                <p class="delivery-show-card-description">
                    Información adicional registrada para la entrega.
                </p>

            </div>

        </div>


        <div class="delivery-show-card-body">

            <div class="delivery-show-grid">

                <div class="delivery-show-field delivery-show-field-full">

                    <div class="delivery-show-field-label">
                        Descripción
                    </div>

                    <div class="delivery-show-field-value">

                        @if($entrega->descripcion)

                            {{ $entrega->descripcion }}

                        @else

                            <span class="delivery-show-empty">
                                Sin descripción
                            </span>

                        @endif

                    </div>

                </div>


                <div class="delivery-show-field delivery-show-field-full">

                    <div class="delivery-show-field-label">
                        Observaciones
                    </div>

                    <div class="delivery-show-field-value">

                        @if($entrega->observaciones)

                            {{ $entrega->observaciones }}

                        @else

                            <span class="delivery-show-empty">
                                Sin observaciones
                            </span>

                        @endif

                    </div>

                </div>

            </div>

        </div>


        <div class="delivery-show-footer">

            <p class="delivery-show-footer-text">

                Esta entrega permanece asociada a la operación
                {{ $entrega->operacion?->numero_operacion ?? 'sin operación' }}.

            </p>

        </div>

    </section>

@endsection