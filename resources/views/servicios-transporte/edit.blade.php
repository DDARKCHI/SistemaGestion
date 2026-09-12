@extends('layouts.app')

@section('title', 'Editar servicio de transporte #' . $servicio->id)

@section('topbar_title', 'Gestión de servicios de transporte')

@push('styles')

<style>

    /* =========================================================
       BREADCRUMB
    ========================================================== */

    .transport-service-edit-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 18px;
        color: #8a94a6;
        font-size: 12px;
    }

    .transport-service-edit-breadcrumb a {
        color: #667085;
        text-decoration: none;
    }

    .transport-service-edit-breadcrumb a:hover {
        color: #155a91;
    }

    .transport-service-edit-breadcrumb-current {
        color: #344054;
    }


    /* =========================================================
       HEADER
    ========================================================== */

    .transport-service-edit-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 25px;
    }

    .transport-service-edit-title {
        margin: 0;
        color: #172033;
        font-size: 27px;
        line-height: 1.2;
        font-weight: 700;
        letter-spacing: -.025em;
    }

    .transport-service-edit-subtitle {
        margin: 7px 0 0;
        color: #667085;
        font-size: 13px;
    }


    /* =========================================================
       CARD
    ========================================================== */

    .transport-service-edit-card {
        width: 100%;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(16,47,80,.05);
        margin-bottom: 20px;
        overflow: hidden;
    }

    .transport-service-edit-card-header {
        min-height: 67px;
        padding: 17px 21px;
        border-bottom: 1px solid #edf1f5;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
    }

    .transport-service-edit-card-title {
        margin: 0;
        color: #172033;
        font-size: 15px;
        font-weight: 700;
    }

    .transport-service-edit-card-description {
        margin: 4px 0 0;
        color: #98a2b3;
        font-size: 11px;
    }

    .transport-service-edit-card-body {
        padding: 22px;
    }


    /* =========================================================
       FORMULARIO
    ========================================================== */

    .transport-service-edit-form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 17px;
    }

    .transport-service-edit-form-group {
        min-width: 0;
    }

    .transport-service-edit-form-group-full {
        grid-column: 1 / -1;
    }

    .transport-service-edit-form-label {
        display: block;
        margin-bottom: 7px;
        color: #344054;
        font-size: 11px;
        font-weight: 600;
    }

    .transport-service-edit-form-required {
        color: #c0392b;
    }

    .transport-service-edit-form-control {
        width: 100%;
        min-height: 40px;
        padding: 9px 11px;
        box-sizing: border-box;
        border: 1px solid #d8e0e8;
        border-radius: 7px;
        background: #ffffff;
        color: #344054;
        font-family: inherit;
        font-size: 12px;
        outline: none;
        transition:
            border-color .15s ease,
            box-shadow .15s ease;
    }

    .transport-service-edit-form-control::placeholder {
        color: #a1aab7;
    }

    .transport-service-edit-form-control:focus {
        border-color: #155a91;
        box-shadow: 0 0 0 3px rgba(21,90,145,.08);
    }

    textarea.transport-service-edit-form-control {
        min-height: 110px;
        resize: vertical;
        line-height: 1.5;
    }

    .transport-service-edit-form-help {
        margin-top: 5px;
        color: #98a2b3;
        font-size: 10px;
        line-height: 1.4;
    }


    /* =========================================================
       INFO
    ========================================================== */

    .transport-service-edit-info-box {
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

    .transport-service-edit-info-icon {
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

    .transport-service-edit-info-box strong {
        color: #344054;
    }


    /* =========================================================
       FACTURACIÓN
    ========================================================== */

    .transport-service-edit-billing-box {
        padding: 16px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        background: #fafbfc;
    }

    .transport-service-edit-billing-title {
        margin: 0 0 4px;
        color: #344054;
        font-size: 12px;
        font-weight: 700;
    }

    .transport-service-edit-billing-description {
        margin: 0 0 15px;
        color: #98a2b3;
        font-size: 10px;
        line-height: 1.4;
    }

    .transport-service-edit-billing-fields {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 17px;
    }

    .transport-service-edit-billing-disabled {
        opacity: .55;
    }

    .transport-service-edit-billing-disabled .transport-service-edit-form-control {
        background: #f1f4f7;
        cursor: not-allowed;
    }

    .transport-service-edit-billing-notice {
        display: none;
        margin-top: 15px;
        padding: 10px 12px;
        border-radius: 7px;
        background: #f2f4f7;
        color: #667085;
        font-size: 10px;
        line-height: 1.5;
    }

    .transport-service-edit-billing-notice.active {
        display: block;
    }


    /* =========================================================
       RESUMEN
    ========================================================== */

    .transport-service-edit-summary-box {
        margin-top: 20px;
        padding: 15px 17px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        background: #fafbfc;
    }

    .transport-service-edit-summary-title {
        margin: 0 0 11px;
        color: #344054;
        font-size: 12px;
        font-weight: 700;
    }

    .transport-service-edit-summary-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        padding: 5px 0;
        color: #667085;
        font-size: 11px;
    }

    .transport-service-edit-summary-row strong {
        color: #344054;
        font-weight: 600;
        text-align: right;
    }

    .transport-service-edit-summary-total {
        margin-top: 7px;
        padding-top: 10px;
        border-top: 1px solid #e2e8f0;
    }

    .transport-service-edit-summary-total span {
        color: #344054;
        font-size: 11px;
        font-weight: 700;
    }

    .transport-service-edit-summary-total strong {
        color: #155a91;
        font-size: 14px;
        font-weight: 700;
    }


    /* =========================================================
       ALERTA
    ========================================================== */

    .transport-service-edit-validation-alert {
        margin-bottom: 20px;
        padding: 13px 16px;
        border: 1px solid #f1ceca;
        border-radius: 7px;
        background: #fff5f3;
        color: #a63228;
        font-size: 11px;
    }

    .transport-service-edit-validation-alert strong {
        display: block;
        margin-bottom: 6px;
        font-size: 12px;
    }

    .transport-service-edit-validation-alert ul {
        margin: 0;
        padding-left: 18px;
    }

    .transport-service-edit-validation-alert li {
        margin-bottom: 3px;
    }


    /* =========================================================
       FOOTER
    ========================================================== */

    .transport-service-edit-form-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        padding: 18px 22px;
        background: #f8fafc;
        border-top: 1px solid #edf1f5;
    }

    .transport-service-edit-form-footer-note {
        color: #98a2b3;
        font-size: 10px;
    }

    .transport-service-edit-form-footer-actions {
        display: flex;
        gap: 9px;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================== */

    @media (max-width: 900px) {

        .transport-service-edit-form-grid,
        .transport-service-edit-billing-fields {
            grid-template-columns: 1fr;
        }

        .transport-service-edit-form-group-full {
            grid-column: auto;
        }

    }

    @media (max-width: 700px) {

        .transport-service-edit-header {
            flex-direction: column;
        }

        .transport-service-edit-header .btn {
            width: 100%;
        }

        .transport-service-edit-card-body {
            padding: 17px;
        }

        .transport-service-edit-form-footer {
            align-items: stretch;
            flex-direction: column;
        }

        .transport-service-edit-form-footer-actions {
            width: 100%;
        }

        .transport-service-edit-form-footer-actions .btn {
            flex: 1;
        }

    }

</style>

@endpush


@section('content')

    {{-- =====================================================
         BREADCRUMB
    ====================================================== --}}

    <div class="transport-service-edit-breadcrumb">

        <a href="{{ route('servicios-transporte.index') }}">
            Servicios de transporte
        </a>

        <span>›</span>

        <a href="{{ route('servicios-transporte.show', $servicio) }}">
            Servicio #{{ $servicio->id }}
        </a>

        <span>›</span>

        <span class="transport-service-edit-breadcrumb-current">
            Editar
        </span>

    </div>


    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="transport-service-edit-header">

        <div>

            <h1 class="transport-service-edit-title">
                Editar servicio de transporte
            </h1>

            <p class="transport-service-edit-subtitle">
                Modifica la información registrada del servicio #{{ $servicio->id }}.
            </p>

        </div>


        <a
            href="{{ route('servicios-transporte.show', $servicio) }}"
            class="btn"
        >
            ← Volver al servicio
        </a>

    </div>


    {{-- =====================================================
         ERRORES
    ====================================================== --}}

    @if($errors->any())

        <div class="transport-service-edit-validation-alert">

            <strong>
                Revisa la información ingresada
            </strong>

            <ul>

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- =====================================================
         FORMULARIO
    ====================================================== --}}

    <form
        action="{{ route('servicios-transporte.update', $servicio) }}"
        method="POST"
        id="transportServiceEditForm"
    >

        @csrf

        @method('PUT')


        {{-- =================================================
             DATOS DEL SERVICIO
        ================================================== --}}

        <section class="transport-service-edit-card">

            <div class="transport-service-edit-card-header">

                <div>

                    <h2 class="transport-service-edit-card-title">
                        Datos del servicio
                    </h2>

                    <p class="transport-service-edit-card-description">
                        Actualiza la operación, transportista, vehículo y características del servicio.
                    </p>

                </div>

            </div>


            <div class="transport-service-edit-card-body">

                <div class="transport-service-edit-info-box">

                    <div class="transport-service-edit-info-icon">
                        i
                    </div>

                    <div>

                        <strong>
                            Servicio #{{ $servicio->id }}
                        </strong>

                        <br>

                        Los cambios realizados actualizarán el registro central del servicio de transporte.

                    </div>

                </div>


                <div class="transport-service-edit-form-grid">


                    {{-- OPERACIÓN --}}

                    <div class="transport-service-edit-form-group">

                        <label
                            class="transport-service-edit-form-label"
                            for="operacion_id"
                        >

                            Operación

                            <span class="transport-service-edit-form-required">
                                *
                            </span>

                        </label>


                        <select
                            id="operacion_id"
                            name="operacion_id"
                            class="transport-service-edit-form-control"
                            required
                        >

                            <option value="">
                                Selecciona una operación
                            </option>


                            @foreach($operaciones as $operacion)

                                <option
                                    value="{{ $operacion->id }}"
                                    {{ old(
                                        'operacion_id',
                                        $servicio->operacion_id
                                    ) == $operacion->id ? 'selected' : '' }}
                                >

                                    {{ $operacion->numero_operacion }}

                                    @if($operacion->cliente)

                                        — {{ $operacion->cliente->nombre }}

                                    @endif

                                </option>

                            @endforeach

                        </select>


                        <div class="transport-service-edit-form-help">
                            Operación a la que corresponde el servicio.
                        </div>

                    </div>


                    {{-- TRANSPORTISTA --}}

                    <div class="transport-service-edit-form-group">

                        <label
                            class="transport-service-edit-form-label"
                            for="transportista_id"
                        >

                            Transportista

                            <span class="transport-service-edit-form-required">
                                *
                            </span>

                        </label>


                        <select
                            id="transportista_id"
                            name="transportista_id"
                            class="transport-service-edit-form-control"
                            required
                        >

                            <option value="">
                                Selecciona un transportista
                            </option>


                            @foreach($transportistas as $transportista)

                                <option
                                    value="{{ $transportista->id }}"
                                    {{ old(
                                        'transportista_id',
                                        $servicio->transportista_id
                                    ) == $transportista->id ? 'selected' : '' }}
                                >

                                    {{ $transportista->nombre }}

                                    @if($transportista->rut)

                                        — {{ $transportista->rut }}

                                    @endif

                                </option>

                            @endforeach

                        </select>


                        <div class="transport-service-edit-form-help">
                            Transportista que realizó el servicio.
                        </div>

                    </div>


                    {{-- VEHÍCULO --}}

                    <div class="transport-service-edit-form-group">

                        <label
                            class="transport-service-edit-form-label"
                            for="vehiculo_id"
                        >

                            Vehículo

                            <span class="transport-service-edit-form-required">
                                *
                            </span>

                        </label>


                        <select
                            id="vehiculo_id"
                            name="vehiculo_id"
                            class="transport-service-edit-form-control"
                            required
                        >

                            <option value="">
                                Selecciona un vehículo
                            </option>


                            @foreach($vehiculos as $vehiculo)

                                <option
                                    value="{{ $vehiculo->id }}"
                                    {{ old(
                                        'vehiculo_id',
                                        $servicio->vehiculo_id
                                    ) == $vehiculo->id ? 'selected' : '' }}
                                >

                                    Vehículo #{{ $vehiculo->id }}

                                    @if($vehiculo->patente)

                                        — {{ $vehiculo->patente }}

                                    @endif

                                    @if($vehiculo->marca || $vehiculo->modelo)

                                        — {{ trim(
                                            ($vehiculo->marca ?? '') .
                                            ' ' .
                                            ($vehiculo->modelo ?? '')
                                        ) }}

                                    @endif

                                </option>

                            @endforeach

                        </select>


                        <div class="transport-service-edit-form-help">
                            Vehículo utilizado para realizar el servicio.
                        </div>

                    </div>


                    {{-- FECHA --}}

                    <div class="transport-service-edit-form-group">

                        <label
                            class="transport-service-edit-form-label"
                            for="fecha_servicio"
                        >
                            Fecha del servicio
                        </label>


                        <input
                            type="date"
                            id="fecha_servicio"
                            name="fecha_servicio"
                            class="transport-service-edit-form-control"
                            value="{{ old(
                                'fecha_servicio',
                                $servicio->fecha_servicio
                                    ? $servicio->fecha_servicio->format('Y-m-d')
                                    : ''
                            ) }}"
                        >


                        <div class="transport-service-edit-form-help">
                            Fecha en que se realizó el servicio.
                        </div>

                    </div>


                    {{-- TIPO --}}

                    <div class="transport-service-edit-form-group">

                        <label
                            class="transport-service-edit-form-label"
                            for="tipo_servicio"
                        >
                            Tipo de servicio
                        </label>


                        <input
                            type="text"
                            id="tipo_servicio"
                            name="tipo_servicio"
                            class="transport-service-edit-form-control"
                            value="{{ old(
                                'tipo_servicio',
                                $servicio->tipo_servicio
                            ) }}"
                            maxlength="255"
                            placeholder="Ej. Flete, traslado, retiro..."
                        >


                        <div class="transport-service-edit-form-help">
                            Tipo o descripción breve del servicio realizado.
                        </div>

                    </div>


                    {{-- MONTO --}}

                    <div class="transport-service-edit-form-group">

                        <label
                            class="transport-service-edit-form-label"
                            for="monto"
                        >

                            Monto del servicio

                            <span class="transport-service-edit-form-required">
                                *
                            </span>

                        </label>


                        <input
                            type="number"
                            id="monto"
                            name="monto"
                            class="transport-service-edit-form-control"
                            value="{{ old(
                                'monto',
                                (int) round((float) $servicio->monto)
                            ) }}"
                            min="0"
                            step="1"
                            required
                        >


                        <div class="transport-service-edit-form-help">
                            Monto total acordado por el servicio.
                        </div>

                    </div>

                </div>


                {{-- RESUMEN --}}

                <div class="transport-service-edit-summary-box">

                    <h3 class="transport-service-edit-summary-title">
                        Resumen del servicio
                    </h3>


                    <div class="transport-service-edit-summary-row">

                        <span>
                            Operación
                        </span>

                        <strong id="resumenOperacion">
                            Sin seleccionar
                        </strong>

                    </div>


                    <div class="transport-service-edit-summary-row">

                        <span>
                            Transportista
                        </span>

                        <strong id="resumenTransportista">
                            Sin seleccionar
                        </strong>

                    </div>


                    <div class="transport-service-edit-summary-row">

                        <span>
                            Tipo de servicio
                        </span>

                        <strong id="resumenTipo">
                            Sin especificar
                        </strong>

                    </div>


                    <div class="transport-service-edit-summary-row transport-service-edit-summary-total">

                        <span>
                            Monto
                        </span>

                        <strong id="resumenMonto">
                            $0
                        </strong>

                    </div>

                </div>

            </div>

        </section>


        {{-- =================================================
             FACTURACIÓN
        ================================================== --}}

        <section class="transport-service-edit-card">

            <div class="transport-service-edit-card-header">

                <div>

                    <h2 class="transport-service-edit-card-title">
                        Facturación
                    </h2>

                    <p class="transport-service-edit-card-description">
                        Actualiza la situación de facturación del servicio.
                    </p>

                </div>

            </div>


            <div class="transport-service-edit-card-body">

                <div class="transport-service-edit-info-box">

                    <div class="transport-service-edit-info-icon">
                        i
                    </div>

                    <div>

                        <strong>
                            Control de factura
                        </strong>

                        <br>

                        Si el servicio no emite factura, el sistema eliminará automáticamente los datos de factura registrados.

                    </div>

                </div>


                <div class="transport-service-edit-billing-box">

                    <h3 class="transport-service-edit-billing-title">
                        Situación de facturación
                    </h3>

                    <p class="transport-service-edit-billing-description">
                        Modifica si el transportista factura y si la factura ya fue recibida.
                    </p>


                    <div class="transport-service-edit-billing-fields">


                        {{-- EMITE FACTURA --}}

                        <div class="transport-service-edit-form-group">

                            <label
                                class="transport-service-edit-form-label"
                                for="emite_factura"
                            >

                                ¿Emite factura?

                                <span class="transport-service-edit-form-required">
                                    *
                                </span>

                            </label>


                            <select
                                id="emite_factura"
                                name="emite_factura"
                                class="transport-service-edit-form-control"
                                required
                            >

                                <option
                                    value="1"
                                    {{ old(
                                        'emite_factura',
                                        $servicio->emite_factura ? '1' : '0'
                                    ) == '1' ? 'selected' : '' }}
                                >
                                    Sí
                                </option>

                                <option
                                    value="0"
                                    {{ old(
                                        'emite_factura',
                                        $servicio->emite_factura ? '1' : '0'
                                    ) === '0' ? 'selected' : '' }}
                                >
                                    No
                                </option>

                            </select>


                            <div class="transport-service-edit-form-help">
                                Define si este servicio requiere factura.
                            </div>

                        </div>


                        {{-- ESTADO --}}

                        <div
                            class="transport-service-edit-form-group"
                            id="estadoFacturacionGroup"
                        >

                            <label
                                class="transport-service-edit-form-label"
                                for="estado_facturacion"
                            >

                                Estado de facturación

                                <span class="transport-service-edit-form-required">
                                    *
                                </span>

                            </label>


                            <select
                                id="estado_facturacion"
                                name="estado_facturacion"
                                class="transport-service-edit-form-control"
                                required
                            >

                                <option
                                    value="Pendiente"
                                    {{ old(
                                        'estado_facturacion',
                                        $servicio->estado_facturacion
                                    ) === 'Pendiente' ? 'selected' : '' }}
                                >
                                    Pendiente
                                </option>

                                <option
                                    value="Recibida"
                                    {{ old(
                                        'estado_facturacion',
                                        $servicio->estado_facturacion
                                    ) === 'Recibida' ? 'selected' : '' }}
                                >
                                    Recibida
                                </option>

                            </select>


                            <div class="transport-service-edit-form-help">
                                Indica si la factura está pendiente o ya fue recibida.
                            </div>

                        </div>


                        {{-- NÚMERO --}}

                        <div
                            class="transport-service-edit-form-group"
                            id="numeroFacturaGroup"
                        >

                            <label
                                class="transport-service-edit-form-label"
                                for="numero_factura"
                            >
                                Número de factura
                            </label>


                            <input
                                type="text"
                                id="numero_factura"
                                name="numero_factura"
                                class="transport-service-edit-form-control"
                                value="{{ old(
                                    'numero_factura',
                                    $servicio->numero_factura
                                ) }}"
                                maxlength="50"
                                placeholder="Ej. 12345"
                            >


                            <div class="transport-service-edit-form-help">
                                Número indicado en la factura recibida.
                            </div>

                        </div>


                        {{-- FECHA FACTURA --}}

                        <div
                            class="transport-service-edit-form-group"
                            id="fechaFacturaGroup"
                        >

                            <label
                                class="transport-service-edit-form-label"
                                for="fecha_factura"
                            >
                                Fecha de factura
                            </label>


                            <input
                                type="date"
                                id="fecha_factura"
                                name="fecha_factura"
                                class="transport-service-edit-form-control"
                                value="{{ old(
                                    'fecha_factura',
                                    $servicio->fecha_factura
                                        ? $servicio->fecha_factura->format('Y-m-d')
                                        : ''
                                ) }}"
                            >


                            <div class="transport-service-edit-form-help">
                                Fecha indicada en la factura recibida.
                            </div>

                        </div>

                    </div>


                    <div
                        class="transport-service-edit-billing-notice"
                        id="billingNotice"
                    >
                        Este transportista no emite factura. Los datos de factura se limpiarán automáticamente al guardar.
                    </div>

                </div>

            </div>

        </section>


        {{-- =================================================
             OBSERVACIONES
        ================================================== --}}

        <section class="transport-service-edit-card">

            <div class="transport-service-edit-card-header">

                <div>

                    <h2 class="transport-service-edit-card-title">
                        Observaciones
                    </h2>

                    <p class="transport-service-edit-card-description">
                        Actualiza la información adicional del servicio.
                    </p>

                </div>

            </div>


            <div class="transport-service-edit-card-body">

                <div class="transport-service-edit-form-group">

                    <label
                        class="transport-service-edit-form-label"
                        for="observaciones"
                    >
                        Observaciones
                    </label>


                    <textarea
                        id="observaciones"
                        name="observaciones"
                        class="transport-service-edit-form-control"
                        placeholder="Información adicional relacionada con el servicio..."
                    >{{ old(
                        'observaciones',
                        $servicio->observaciones
                    ) }}</textarea>

                </div>

            </div>

        </section>


        {{-- =================================================
             FOOTER
        ================================================== --}}

        <div class="transport-service-edit-card">

            <div class="transport-service-edit-form-footer">

                <div class="transport-service-edit-form-footer-note">

                    <span class="transport-service-edit-form-required">
                        *
                    </span>

                    Campos obligatorios.

                </div>


                <div class="transport-service-edit-form-footer-actions">

                    <a
                        href="{{ route(
                            'servicios-transporte.show',
                            $servicio
                        ) }}"
                        class="btn"
                    >
                        Cancelar
                    </a>


                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Guardar cambios
                    </button>

                </div>

            </div>

        </div>

    </form>

@endsection


@push('scripts')

<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {

        const form =
            document.getElementById(
                'transportServiceEditForm'
            );


        const operacionSelect =
            document.getElementById(
                'operacion_id'
            );


        const transportistaSelect =
            document.getElementById(
                'transportista_id'
            );


        const tipoInput =
            document.getElementById(
                'tipo_servicio'
            );


        const montoInput =
            document.getElementById(
                'monto'
            );


        const emiteFacturaSelect =
            document.getElementById(
                'emite_factura'
            );


        const estadoFacturacionSelect =
            document.getElementById(
                'estado_facturacion'
            );


        const numeroFacturaInput =
            document.getElementById(
                'numero_factura'
            );


        const fechaFacturaInput =
            document.getElementById(
                'fecha_factura'
            );


        const estadoFacturacionGroup =
            document.getElementById(
                'estadoFacturacionGroup'
            );


        const numeroFacturaGroup =
            document.getElementById(
                'numeroFacturaGroup'
            );


        const fechaFacturaGroup =
            document.getElementById(
                'fechaFacturaGroup'
            );


        const billingNotice =
            document.getElementById(
                'billingNotice'
            );


        const resumenOperacion =
            document.getElementById(
                'resumenOperacion'
            );


        const resumenTransportista =
            document.getElementById(
                'resumenTransportista'
            );


        const resumenTipo =
            document.getElementById(
                'resumenTipo'
            );


        const resumenMonto =
            document.getElementById(
                'resumenMonto'
            );


        function formatearMonto(valor) {

            const numero =
                Math.round(
                    Number(valor) || 0
                );


            return '$' +
                numero.toLocaleString(
                    'es-CL',
                    {
                        minimumFractionDigits: 0,
                        maximumFractionDigits: 0
                    }
                );

        }


        function actualizarFacturacion() {

            const emiteFactura =
                emiteFacturaSelect.value === '1';


            if (!emiteFactura) {

                estadoFacturacionSelect.value =
                    'Pendiente';

                numeroFacturaInput.value =
                    '';

                fechaFacturaInput.value =
                    '';


                estadoFacturacionSelect.disabled =
                    true;

                numeroFacturaInput.disabled =
                    true;

                fechaFacturaInput.disabled =
                    true;


                estadoFacturacionGroup.classList.add(
                    'transport-service-edit-billing-disabled'
                );

                numeroFacturaGroup.classList.add(
                    'transport-service-edit-billing-disabled'
                );

                fechaFacturaGroup.classList.add(
                    'transport-service-edit-billing-disabled'
                );

                billingNotice.classList.add(
                    'active'
                );

            } else {

                estadoFacturacionSelect.disabled =
                    false;

                numeroFacturaInput.disabled =
                    false;

                fechaFacturaInput.disabled =
                    false;


                estadoFacturacionGroup.classList.remove(
                    'transport-service-edit-billing-disabled'
                );

                numeroFacturaGroup.classList.remove(
                    'transport-service-edit-billing-disabled'
                );

                fechaFacturaGroup.classList.remove(
                    'transport-service-edit-billing-disabled'
                );

                billingNotice.classList.remove(
                    'active'
                );

            }

        }


        function actualizarFacturaRecibida() {

            const recibida =
                estadoFacturacionSelect.value ===
                'Recibida';


            numeroFacturaInput.required =
                recibida;

            fechaFacturaInput.required =
                recibida;

        }


        function actualizarResumen() {

            if (operacionSelect.value) {

                resumenOperacion.textContent =
                    operacionSelect.options[
                        operacionSelect.selectedIndex
                    ].text.trim();

            } else {

                resumenOperacion.textContent =
                    'Sin seleccionar';

            }


            if (transportistaSelect.value) {

                resumenTransportista.textContent =
                    transportistaSelect.options[
                        transportistaSelect.selectedIndex
                    ].text.trim();

            } else {

                resumenTransportista.textContent =
                    'Sin seleccionar';

            }


            resumenTipo.textContent =
                tipoInput.value.trim() ||
                'Sin especificar';


            resumenMonto.textContent =
                formatearMonto(
                    montoInput.value
                );

        }


        emiteFacturaSelect.addEventListener(
            'change',
            function () {

                actualizarFacturacion();

                actualizarFacturaRecibida();

            }
        );


        estadoFacturacionSelect.addEventListener(
            'change',
            actualizarFacturaRecibida
        );


        operacionSelect.addEventListener(
            'change',
            actualizarResumen
        );


        transportistaSelect.addEventListener(
            'change',
            actualizarResumen
        );


        tipoInput.addEventListener(
            'input',
            actualizarResumen
        );


        montoInput.addEventListener(
            'input',
            actualizarResumen
        );


        form.addEventListener(
            'submit',
            function (event) {

                const emiteFactura =
                    emiteFacturaSelect.value === '1';


                const recibida =
                    estadoFacturacionSelect.value ===
                    'Recibida';


                if (
                    emiteFactura &&
                    recibida &&
                    (
                        !numeroFacturaInput.value.trim() ||
                        !fechaFacturaInput.value
                    )
                ) {

                    event.preventDefault();

                    alert(
                        'Una factura recibida debe tener número y fecha.'
                    );


                    if (
                        !numeroFacturaInput.value.trim()
                    ) {

                        numeroFacturaInput.focus();

                    } else {

                        fechaFacturaInput.focus();

                    }

                    return;

                }

            }
        );


        actualizarFacturacion();

        actualizarFacturaRecibida();

        actualizarResumen();

    }

);

</script>

@endpush
