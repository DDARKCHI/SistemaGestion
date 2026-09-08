@extends('layouts.app')

@section('title', 'Detalle nota de crédito')

@section('topbar_title', 'Detalle de nota de crédito')

@push('styles')

<style>

    /* =========================================================
       HEADER
    ========================================================== */

    .credit-note-detail-header {

        display: flex;

        align-items: flex-start;

        justify-content: space-between;

        gap: 20px;

        margin-bottom: 24px;

    }



    .credit-note-detail-breadcrumb {

        display: flex;

        align-items: center;

        gap: 7px;

        margin-bottom: 14px;

        color: #98a2b3;

        font-size: 10px;

    }



    .credit-note-detail-breadcrumb a {

        color: #155a91;

        text-decoration: none;

        font-weight: 600;

    }



    .credit-note-detail-breadcrumb a:hover {

        color: #124d7d;

        text-decoration: underline;

    }



    .credit-note-detail-title {

        margin: 0;

        color: #172033;

        font-size: 27px;

        line-height: 1.2;

        font-weight: 700;

        letter-spacing: -.025em;

    }



    .credit-note-detail-subtitle {

        margin: 7px 0 0;

        color: #667085;

        font-size: 13px;

    }



    .credit-note-detail-actions {

        display: flex;

        align-items: center;

        gap: 8px;

        flex-shrink: 0;

    }



    /* =========================================================
       BOTONES
    ========================================================== */

    .credit-note-detail-button {

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



    .credit-note-detail-button-primary {

        border: 1px solid #155a91;

        background: #155a91;

        color: #ffffff;

    }



    .credit-note-detail-button-primary:hover {

        background: #124d7d;

        border-color: #124d7d;

        color: #ffffff;

    }



    .credit-note-detail-button-secondary {

        border: 1px solid #dce3eb;

        background: #ffffff;

        color: #344054;

    }



    .credit-note-detail-button-secondary:hover {

        background: #f5f8fb;

        border-color: #cbd7e3;

        color: #155a91;

    }



    /* =========================================================
       ALERTAS
    ========================================================== */

    .credit-note-detail-alert {

        margin-bottom: 18px;

        padding: 11px 14px;

        border-radius: 7px;

        font-size: 11px;

    }



    .credit-note-detail-success {

        border: 1px solid #cfe5d7;

        background: #f1faf4;

        color: #287443;

    }



    .credit-note-detail-error {

        border: 1px solid #e9c1bc;

        background: #fff5f3;

        color: #a52f26;

    }



    /* =========================================================
       RESUMEN
    ========================================================== */

    .credit-note-detail-summary {

        display: grid;

        grid-template-columns: repeat(3, 1fr);

        gap: 14px;

        margin-bottom: 20px;

    }



    .credit-note-detail-summary-card {

        background: #ffffff;

        border: 1px solid #e2e8f0;

        border-radius: 9px;

        padding: 17px 19px;

        box-shadow:
            0 2px 7px rgba(16,47,80,.04);

    }



    .credit-note-detail-summary-label {

        color: #667085;

        font-size: 10px;

        font-weight: 600;

        text-transform: uppercase;

        letter-spacing: .03em;

    }



    .credit-note-detail-summary-value {

        margin-top: 7px;

        color: #172033;

        font-size: 22px;

        line-height: 1.1;

        font-weight: 700;

    }



    .credit-note-detail-summary-description {

        margin-top: 6px;

        color: #98a2b3;

        font-size: 9px;

    }



    .credit-note-detail-summary-card.amount {

        border-color: #d4e5f2;

        background: #f7fbfe;

    }



    .credit-note-detail-summary-card.amount
    .credit-note-detail-summary-value {

        color: #155a91;

    }



    .credit-note-detail-summary-card.pending {

        border-color: #f0d9aa;

        background: #fffaf2;

    }



    .credit-note-detail-summary-card.pending
    .credit-note-detail-summary-value {

        color: #a15c00;

    }



    .credit-note-detail-summary-card.recovered {

        border-color: #cfe5d7;

        background: #f1faf4;

    }



    .credit-note-detail-summary-card.recovered
    .credit-note-detail-summary-value {

        color: #287443;

    }



    /* =========================================================
       CARD
    ========================================================== */

    .credit-note-detail-card {

        background: #ffffff;

        border: 1px solid #e2e8f0;

        border-radius: 10px;

        box-shadow:
            0 2px 8px rgba(16,47,80,.05);

        overflow: hidden;

    }



    .credit-note-detail-card-header {

        min-height: 66px;

        padding: 15px 20px;

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 15px;

        border-bottom: 1px solid #edf1f5;

    }



    .credit-note-detail-card-title {

        margin: 0;

        color: #172033;

        font-size: 14px;

        font-weight: 700;

    }



    .credit-note-detail-card-description {

        margin: 4px 0 0;

        color: #98a2b3;

        font-size: 10px;

    }



    .credit-note-detail-body {

        padding: 22px 20px;

    }



    /* =========================================================
       PROVEEDOR
    ========================================================== */

    .credit-note-detail-provider {

        margin-bottom: 22px;

        padding: 15px 17px;

        border: 1px solid #d4e5f2;

        border-radius: 8px;

        background: #f7fbfe;

    }



    .credit-note-detail-provider-label {

        margin-bottom: 5px;

        color: #98a2b3;

        font-size: 9px;

        font-weight: 600;

        text-transform: uppercase;

        letter-spacing: .03em;

    }



    .credit-note-detail-provider-name {

        color: #155a91;

        font-size: 14px;

        font-weight: 700;

    }



    .credit-note-detail-provider-rut {

        margin-top: 4px;

        color: #667085;

        font-size: 10px;

    }



    .credit-note-detail-provider-rut strong {

        color: #344054;

        font-weight: 600;

    }



    /* =========================================================
       DATOS
    ========================================================== */

    .credit-note-detail-grid {

        display: grid;

        grid-template-columns: repeat(2, minmax(0, 1fr));

        gap: 0 30px;

    }



    .credit-note-detail-field {

        min-height: 70px;

        padding: 13px 0;

        border-bottom: 1px solid #edf1f5;

    }



    .credit-note-detail-field-label {

        margin-bottom: 5px;

        color: #98a2b3;

        font-size: 9px;

        font-weight: 600;

        text-transform: uppercase;

        letter-spacing: .03em;

    }



    .credit-note-detail-field-value {

        color: #344054;

        font-size: 11px;

        line-height: 1.5;

    }



    .credit-note-detail-field-value.strong {

        color: #172033;

        font-weight: 600;

    }



    .credit-note-detail-field-value.amount {

        color: #155a91;

        font-size: 13px;

        font-weight: 700;

    }



    .credit-note-detail-field-full {

        grid-column: 1 / -1;

    }



    /* =========================================================
       ESTADO
    ========================================================== */

    .credit-note-detail-status {

        display: inline-flex;

        align-items: center;

        min-height: 25px;

        padding: 4px 8px;

        border-radius: 6px;

        font-size: 10px;

        font-weight: 700;

    }



    .credit-note-detail-status-pending {

        background: #fff5e8;

        color: #a15c00;

    }



    .credit-note-detail-status-recovered {

        background: #f1faf4;

        color: #287443;

    }



    /* =========================================================
       FOOTER
    ========================================================== */

    .credit-note-detail-footer {

        min-height: 65px;

        padding: 12px 20px;

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 15px;

        border-top: 1px solid #edf1f5;

        background: #fbfcfd;

    }



    .credit-note-detail-footer-text {

        margin: 0;

        color: #98a2b3;

        font-size: 10px;

        line-height: 1.4;

    }



    .credit-note-detail-delete-form {

        margin: 0;

    }



    .credit-note-detail-delete-button {

        min-height: 32px;

        padding: 6px 10px;

        border: 1px solid #e9c1bc;

        border-radius: 6px;

        background: #ffffff;

        color: #a52f26;

        font-family: inherit;

        font-size: 10px;

        font-weight: 600;

        cursor: pointer;

    }



    .credit-note-detail-delete-button:hover {

        background: #fff5f3;

        color: #8f251e;

    }



    /* =========================================================
       RESPONSIVE
    ========================================================== */

    @media (max-width: 800px) {

        .credit-note-detail-header {

            flex-direction: column;

        }



        .credit-note-detail-actions {

            width: 100%;

        }



        .credit-note-detail-actions a {

            flex: 1;

        }



        .credit-note-detail-summary {

            grid-template-columns: 1fr;

        }



        .credit-note-detail-grid {

            grid-template-columns: 1fr;

        }



        .credit-note-detail-field-full {

            grid-column: auto;

        }



        .credit-note-detail-footer {

            align-items: flex-start;

            flex-direction: column;

        }

    }

</style>

@endpush


@section('content')

    {{-- =====================================================
         MIGAS DE PAN
    ====================================================== --}}

    <div class="credit-note-detail-breadcrumb">

        <a href="{{ route('proveedores.index') }}">
            Proveedores
        </a>

        <span>›</span>

        <a href="{{ route('notas-credito-proveedores.index') }}">
            Notas de crédito
        </a>

        <span>›</span>

        <span>
            {{ $notaCreditoProveedor->numero_nota }}
        </span>

    </div>


    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="credit-note-detail-header">

        <div>

            <h1 class="credit-note-detail-title">
                Nota de crédito {{ $notaCreditoProveedor->numero_nota }}
            </h1>

            <p class="credit-note-detail-subtitle">
                Detalle de la nota de crédito pendiente de recuperar del proveedor.
            </p>

        </div>


        <div class="credit-note-detail-actions">

            <a
                href="{{ route('notas-credito-proveedores.index') }}"
                class="credit-note-detail-button credit-note-detail-button-secondary"
            >
                Volver
            </a>


            <a
                href="{{ route('notas-credito-proveedores.edit', $notaCreditoProveedor) }}"
                class="credit-note-detail-button credit-note-detail-button-primary"
            >
                Editar
            </a>

        </div>

    </div>


    {{-- =====================================================
         MENSAJES
    ====================================================== --}}

    @if(session('success'))

        <div class="credit-note-detail-alert credit-note-detail-success">
            {{ session('success') }}
        </div>

    @endif


    @if(session('error'))

        <div class="credit-note-detail-alert credit-note-detail-error">
            {{ session('error') }}
        </div>

    @endif


    {{-- =====================================================
         RESUMEN
    ====================================================== --}}

    <div class="credit-note-detail-summary">

        <div class="credit-note-detail-summary-card amount">

            <div class="credit-note-detail-summary-label">
                Monto
            </div>

            <div class="credit-note-detail-summary-value">
                ${{ number_format((float) $notaCreditoProveedor->monto, 0, ',', '.') }}
            </div>

            <div class="credit-note-detail-summary-description">
                Valor de la nota de crédito
            </div>

        </div>


        <div class="credit-note-detail-summary-card
            {{ $notaCreditoProveedor->estado === 'pendiente' ? 'pending' : 'recovered' }}"
        >

            <div class="credit-note-detail-summary-label">
                Estado
            </div>

            <div class="credit-note-detail-summary-value">

                @if($notaCreditoProveedor->estado === 'pendiente')
                    Pendiente
                @else
                    Recuperada
                @endif

            </div>

            <div class="credit-note-detail-summary-description">
                Estado actual de recuperación
            </div>

        </div>


        <div class="credit-note-detail-summary-card">

            <div class="credit-note-detail-summary-label">
                Fecha
            </div>

            <div class="credit-note-detail-summary-value">
                {{ $notaCreditoProveedor->fecha?->format('d/m/Y') ?? '—' }}
            </div>

            <div class="credit-note-detail-summary-description">
                Fecha registrada
            </div>

        </div>

    </div>


    {{-- =====================================================
         DETALLE
    ====================================================== --}}

    <section class="credit-note-detail-card">

        <div class="credit-note-detail-card-header">

            <div>

                <h2 class="credit-note-detail-card-title">
                    Información de la nota
                </h2>

                <p class="credit-note-detail-card-description">
                    Antecedentes registrados para el control de recuperación.
                </p>

            </div>

        </div>


        <div class="credit-note-detail-body">

            {{-- =================================================
                 PROVEEDOR
            ================================================== --}}

            <div class="credit-note-detail-provider">

                <div class="credit-note-detail-provider-label">
                    Proveedor asociado
                </div>

                <div class="credit-note-detail-provider-name">
                    {{ $notaCreditoProveedor->proveedor->nombre }}
                </div>

                <div class="credit-note-detail-provider-rut">

                    RUT:

                    <strong>
                        {{ $notaCreditoProveedor->proveedor->rut }}
                    </strong>

                </div>

            </div>


            {{-- =================================================
                 CAMPOS
            ================================================== --}}

            <div class="credit-note-detail-grid">

                {{-- NÚMERO --}}

                <div class="credit-note-detail-field">

                    <div class="credit-note-detail-field-label">
                        Número de nota
                    </div>

                    <div class="credit-note-detail-field-value strong">
                        {{ $notaCreditoProveedor->numero_nota }}
                    </div>

                </div>


                {{-- FECHA --}}

                <div class="credit-note-detail-field">

                    <div class="credit-note-detail-field-label">
                        Fecha
                    </div>

                    <div class="credit-note-detail-field-value">
                        {{ $notaCreditoProveedor->fecha?->format('d/m/Y') ?? '—' }}
                    </div>

                </div>


                {{-- MONTO --}}

                <div class="credit-note-detail-field">

                    <div class="credit-note-detail-field-label">
                        Monto
                    </div>

                    <div class="credit-note-detail-field-value amount">
                        ${{ number_format((float) $notaCreditoProveedor->monto, 0, ',', '.') }}
                    </div>

                </div>


                {{-- ESTADO --}}

                <div class="credit-note-detail-field">

                    <div class="credit-note-detail-field-label">
                        Estado
                    </div>

                    <div class="credit-note-detail-field-value">

                        @if($notaCreditoProveedor->estado === 'pendiente')

                            <span class="credit-note-detail-status credit-note-detail-status-pending">
                                Pendiente de recuperar
                            </span>

                        @else

                            <span class="credit-note-detail-status credit-note-detail-status-recovered">
                                Recuperada
                            </span>

                        @endif

                    </div>

                </div>


                {{-- MOTIVO --}}

                <div class="credit-note-detail-field credit-note-detail-field-full">

                    <div class="credit-note-detail-field-label">
                        Motivo
                    </div>

                    <div class="credit-note-detail-field-value">

                        {{ $notaCreditoProveedor->motivo ?: 'Sin motivo registrado.' }}

                    </div>

                </div>


                {{-- OBSERVACIONES --}}

                <div class="credit-note-detail-field credit-note-detail-field-full">

                    <div class="credit-note-detail-field-label">
                        Observaciones
                    </div>

                    <div class="credit-note-detail-field-value">

                        {{ $notaCreditoProveedor->observaciones ?: 'Sin observaciones registradas.' }}

                    </div>

                </div>

            </div>

        </div>


        {{-- =================================================
             FOOTER
        ================================================== --}}

        <div class="credit-note-detail-footer">

            <p class="credit-note-detail-footer-text">

                Esta nota permanece vinculada directamente al proveedor
                {{ $notaCreditoProveedor->proveedor->nombre }}.

            </p>


            <form
                action="{{ route('notas-credito-proveedores.destroy', $notaCreditoProveedor) }}"
                method="POST"
                class="credit-note-detail-delete-form"
                onsubmit="return confirm('¿Está seguro de eliminar esta nota de crédito?');"
            >

                @csrf

                @method('DELETE')

                <button
                    type="submit"
                    class="credit-note-detail-delete-button"
                >
                    Eliminar nota
                </button>

            </form>

        </div>

    </section>

@endsection