@extends('layouts.app')

@section('title', 'Nueva mora')

@section('topbar_title', 'Gestión de moras')

@push('styles')

<style>

    /* =========================================================
       BREADCRUMB
    ========================================================== */

    .mora-create-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 18px;
        color: #8a94a6;
        font-size: 12px;
    }

    .mora-create-breadcrumb a {
        color: #667085;
        text-decoration: none;
    }

    .mora-create-breadcrumb a:hover {
        color: #155a91;
    }

    .mora-create-breadcrumb-current {
        color: #344054;
    }


    /* =========================================================
       HEADER
    ========================================================== */

    .mora-create-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 25px;
    }

    .mora-create-title {
        margin: 0;
        color: #172033;
        font-size: 27px;
        line-height: 1.2;
        font-weight: 700;
        letter-spacing: -.025em;
    }

    .mora-create-subtitle {
        margin: 7px 0 0;
        color: #667085;
        font-size: 13px;
    }


    /* =========================================================
       CARD
    ========================================================== */

    .mora-create-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(16,47,80,.05);
        margin-bottom: 20px;
        overflow: hidden;
    }

    .mora-create-card-header {
        min-height: 67px;
        padding: 17px 21px;
        border-bottom: 1px solid #edf1f5;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
    }

    .mora-create-card-title {
        margin: 0;
        color: #172033;
        font-size: 15px;
        font-weight: 700;
    }

    .mora-create-card-description {
        margin: 4px 0 0;
        color: #98a2b3;
        font-size: 11px;
    }

    .mora-create-card-body {
        padding: 22px;
    }


    /* =========================================================
       FORMULARIO
    ========================================================== */

    .mora-form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 17px;
    }

    .mora-form-group {
        min-width: 0;
    }

    .mora-form-group-full {
        grid-column: 1 / -1;
    }

    .mora-form-label {
        display: block;
        margin-bottom: 7px;
        color: #344054;
        font-size: 11px;
        font-weight: 600;
    }

    .mora-form-required {
        color: #c0392b;
    }

    .mora-form-control {
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

    .mora-form-control::placeholder {
        color: #a1aab7;
    }

    .mora-form-control:focus {
        border-color: #155a91;
        box-shadow: 0 0 0 3px rgba(21,90,145,.08);
    }

    .mora-form-control:disabled {
        background: #f8fafc;
        color: #667085;
        cursor: not-allowed;
    }

    .mora-form-control:read-only {
        background: #f8fafc;
        color: #667085;
    }

    textarea.mora-form-control {
        min-height: 110px;
        resize: vertical;
        line-height: 1.5;
    }

    .mora-form-help {
        margin-top: 5px;
        color: #98a2b3;
        font-size: 10px;
        line-height: 1.4;
    }


    /* =========================================================
       SELECT
    ========================================================== */

    select.mora-form-control {
        cursor: pointer;
    }


    /* =========================================================
       INFORMACIÓN
    ========================================================== */

    .mora-info-box {
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

    .mora-info-icon {
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

    .mora-info-box strong {
        color: #344054;
    }


    /* =========================================================
       DESTINO
    ========================================================== */

    .mora-destino-box {
        margin-top: 20px;
        padding: 16px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        background: #fafbfc;
    }

    .mora-destino-title {
        margin: 0 0 4px;
        color: #344054;
        font-size: 12px;
        font-weight: 700;
    }

    .mora-destino-description {
        margin: 0 0 15px;
        color: #98a2b3;
        font-size: 10px;
        line-height: 1.4;
    }


    /* =========================================================
       BADGES AUTOMÁTICOS
    ========================================================== */

    .mora-automatic-label {
        display: flex;
        align-items: center;
        gap: 7px;
    }

    .mora-automatic-badge {
        display: inline-flex;
        align-items: center;
        min-height: 18px;
        padding: 2px 7px;
        border-radius: 20px;
        background: #edf6ff;
        color: #155a91;
        font-size: 9px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .02em;
    }


    /* =========================================================
       CÁLCULO
    ========================================================== */

    .mora-calculation-box {
        margin-top: 20px;
        padding: 15px 17px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        background: #fafbfc;
    }

    .mora-calculation-title {
        margin: 0 0 11px;
        color: #344054;
        font-size: 12px;
        font-weight: 700;
    }

    .mora-calculation-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        padding: 5px 0;
        color: #667085;
        font-size: 11px;
    }

    .mora-calculation-row strong {
        color: #344054;
        font-weight: 600;
    }

    .mora-calculation-total {
        margin-top: 7px;
        padding-top: 10px;
        border-top: 1px solid #e2e8f0;
    }

    .mora-calculation-total span {
        color: #344054;
        font-size: 11px;
        font-weight: 700;
    }

    .mora-calculation-total strong {
        color: #155a91;
        font-size: 14px;
        font-weight: 700;
    }


    /* =========================================================
       ESTADO DESTINO
    ========================================================== */

    .mora-destino-status {
        display: none;
        margin-top: 15px;
        padding: 11px 13px;
        border-radius: 7px;
        background: #f7fbff;
        border: 1px solid #dce9f3;
        color: #526579;
        font-size: 10px;
        line-height: 1.5;
    }

    .mora-destino-status strong {
        color: #155a91;
    }


    /* =========================================================
       FOOTER
    ========================================================== */

    .mora-form-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        padding: 18px 22px;
        background: #f8fafc;
        border-top: 1px solid #edf1f5;
    }

    .mora-form-footer-note {
        color: #98a2b3;
        font-size: 10px;
    }

    .mora-form-footer-actions {
        display: flex;
        gap: 9px;
    }


    /* =========================================================
       ERRORES
    ========================================================== */

    .mora-validation-alert {
        margin-bottom: 20px;
        padding: 13px 16px;
        border: 1px solid #f1ceca;
        border-radius: 7px;
        background: #fff5f3;
        color: #a63228;
        font-size: 11px;
    }

    .mora-validation-alert strong {
        display: block;
        margin-bottom: 6px;
        font-size: 12px;
    }

    .mora-validation-alert ul {
        margin: 0;
        padding-left: 18px;
    }

    .mora-validation-alert li {
        margin-bottom: 3px;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================== */

    @media (max-width: 900px) {

        .mora-form-grid {
            grid-template-columns: 1fr;
        }

        .mora-form-group-full {
            grid-column: auto;
        }

    }


    @media (max-width: 700px) {

        .mora-create-header {
            flex-direction: column;
        }

        .mora-create-header .btn {
            width: 100%;
        }

        .mora-create-card-body {
            padding: 17px;
        }

        .mora-form-footer {
            align-items: stretch;
            flex-direction: column;
        }

        .mora-form-footer-actions {
            width: 100%;
        }

        .mora-form-footer-actions .btn {
            flex: 1;
        }

    }

</style>

@endpush


@section('content')

    {{-- =====================================================
         BREADCRUMB
    ====================================================== --}}

    <div class="mora-create-breadcrumb">

        <a href="{{ route('moras.index') }}">
            Moras
        </a>

        <span>›</span>

        <span class="mora-create-breadcrumb-current">
            Nueva mora
        </span>

    </div>


    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="mora-create-header">

        <div>

            <h1 class="mora-create-title">
                Nueva mora
            </h1>

            <p class="mora-create-subtitle">
                Registra el atraso generado por una factura y, si corresponde, su traslado a otra operación.
            </p>

        </div>


        <a
            href="{{ route('moras.index') }}"
            class="btn"
        >
            ← Volver a moras
        </a>

    </div>


    {{-- =====================================================
         ERRORES
    ====================================================== --}}

    @if($errors->any())

        <div class="mora-validation-alert">

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
        action="{{ route('moras.store') }}"
        method="POST"
        id="moraCreateForm"
    >

        @csrf


        {{-- =================================================
             ORIGEN
        ================================================== --}}

        <section class="mora-create-card">

            <div class="mora-create-card-header">

                <div>

                    <h2 class="mora-create-card-title">
                        Origen de la mora
                    </h2>

                    <p class="mora-create-card-description">
                        Identifica la operación y factura que originaron el atraso.
                    </p>

                </div>

            </div>


            <div class="mora-create-card-body">

                <div class="mora-info-box">

                    <div class="mora-info-icon">
                        i
                    </div>

                    <div>

                        <strong>
                            Asociación automática
                        </strong>

                        <br>

                        Primero selecciona la operación de origen. Luego selecciona una de sus facturas vigentes. La relación se almacenará directamente con los registros correspondientes.

                    </div>

                </div>


                <div class="mora-form-grid">


                    {{-- OPERACIÓN ORIGEN --}}

                    <div class="mora-form-group">

                        <label
                            class="mora-form-label"
                            for="operacion_origen_id"
                        >

                            Operación de origen

                            <span class="mora-form-required">
                                *
                            </span>

                        </label>


                        <select
                            id="operacion_origen_id"
                            name="operacion_origen_id"
                            class="mora-form-control"
                            required
                        >

                            <option value="">
                                Selecciona una operación
                            </option>

                            @foreach($operaciones as $operacion)

                                <option
                                    value="{{ $operacion->id }}"
                                    {{ old('operacion_origen_id') == $operacion->id ? 'selected' : '' }}
                                >

                                    {{ $operacion->numero_operacion }}

                                    @if($operacion->cliente)
                                        — {{ $operacion->cliente->nombre }}
                                    @endif

                                </option>

                            @endforeach

                        </select>


                        <div class="mora-form-help">
                            Operación donde se generó originalmente la mora.
                        </div>

                    </div>


                    {{-- FACTURA ORIGEN --}}

                    <div class="mora-form-group">

                        <label
                            class="mora-form-label"
                            for="factura_origen_id"
                        >

                            Factura de origen

                            <span class="mora-form-required">
                                *
                            </span>

                        </label>


                        <select
                            id="factura_origen_id"
                            name="factura_origen_id"
                            class="mora-form-control"
                            required
                            disabled
                        >

                            <option value="">
                                Selecciona primero una operación
                            </option>

                        </select>


                        <div class="mora-form-help">
                            Solo se muestran facturas vigentes pertenecientes a la operación seleccionada.
                        </div>

                    </div>

                </div>

            </div>

        </section>


        {{-- =================================================
             DESTINO
        ================================================== --}}

        <section class="mora-create-card">

            <div class="mora-create-card-header">

                <div>

                    <h2 class="mora-create-card-title">
                        Traslado de la mora
                    </h2>

                    <p class="mora-create-card-description">
                        Opcionalmente asocia la mora a una factura de otra operación.
                    </p>

                </div>

            </div>


            <div class="mora-create-card-body">

                <div class="mora-info-box">

                    <div class="mora-info-icon">
                        i
                    </div>

                    <div>

                        <strong>
                            Mora de otra operación
                        </strong>

                        <br>

                        Si la mora se cobra posteriormente en otra factura, selecciona aquí la operación y factura de destino. La nueva factura podrá identificar que contiene una mora proveniente de otra operación.

                    </div>

                </div>


                <div class="mora-destino-box">

                    <h3 class="mora-destino-title">
                        Factura que recibirá la mora
                    </h3>

                    <p class="mora-destino-description">
                        Estos campos son opcionales. Si completas uno, deberás completar ambos.
                    </p>


                    <div class="mora-form-grid">


                        {{-- OPERACIÓN DESTINO --}}

                        <div class="mora-form-group">

                            <label
                                class="mora-form-label"
                                for="operacion_destino_id"
                            >

                                Operación de destino

                            </label>


                            <select
                                id="operacion_destino_id"
                                name="operacion_destino_id"
                                class="mora-form-control"
                            >

                                <option value="">
                                    Sin operación de destino
                                </option>

                                @foreach($operaciones as $operacion)

                                    <option
                                        value="{{ $operacion->id }}"
                                        {{ old('operacion_destino_id') == $operacion->id ? 'selected' : '' }}
                                    >

                                        {{ $operacion->numero_operacion }}

                                        @if($operacion->cliente)
                                            — {{ $operacion->cliente->nombre }}
                                        @endif

                                    </option>

                                @endforeach

                            </select>


                            <div class="mora-form-help">
                                Operación donde se cobrará posteriormente la mora.
                            </div>

                        </div>


                        {{-- FACTURA DESTINO --}}

                        <div class="mora-form-group">

                            <label
                                class="mora-form-label"
                                for="factura_destino_id"
                            >

                                Factura de destino

                            </label>


                            <select
                                id="factura_destino_id"
                                name="factura_destino_id"
                                class="mora-form-control"
                                disabled
                            >

                                <option value="">
                                    Sin factura de destino
                                </option>

                            </select>


                            <div class="mora-form-help">
                                Selecciona una factura distinta a la que originó la mora.
                            </div>

                        </div>


                    </div>


                    <div
                        id="moraDestinoStatus"
                        class="mora-destino-status"
                    >
                        <strong>
                            Traslado activo:
                        </strong>

                        La mora quedará vinculada a la factura de destino seleccionada.
                    </div>

                </div>

            </div>

        </section>


        {{-- =================================================
             DATOS DE LA MORA
        ================================================== --}}

        <section class="mora-create-card">

            <div class="mora-create-card-header">

                <div>

                    <h2 class="mora-create-card-title">
                        Datos de la mora
                    </h2>

                    <p class="mora-create-card-description">
                        Registra el atraso y el valor correspondiente.
                    </p>

                </div>

            </div>


            <div class="mora-create-card-body">

                <div class="mora-form-grid">


                    {{-- DÍAS ATRASO --}}

                    <div class="mora-form-group">

                        <label
                            class="mora-form-label"
                            for="dias_atraso"
                        >

                            Días de atraso

                            <span class="mora-form-required">
                                *
                            </span>

                        </label>


                        <input
                            type="number"
                            id="dias_atraso"
                            name="dias_atraso"
                            class="mora-form-control"
                            value="{{ old('dias_atraso', 0) }}"
                            min="0"
                            step="1"
                            required
                        >


                        <div class="mora-form-help">
                            Cantidad de días utilizados para determinar el atraso de la operación.
                        </div>

                    </div>


                    {{-- FECHA --}}

                    <div class="mora-form-group">

                        <label
                            class="mora-form-label"
                            for="fecha"
                        >
                            Fecha
                        </label>


                        <input
                            type="date"
                            id="fecha"
                            name="fecha"
                            class="mora-form-control"
                            value="{{ old('fecha', now()->format('Y-m-d')) }}"
                        >


                        <div class="mora-form-help">
                            Fecha asociada al registro de la mora.
                        </div>

                    </div>


                    {{-- VALOR MORA --}}

                    <div class="mora-form-group">

                        <label
                            class="mora-form-label"
                            for="valor_mora"
                        >

                            Valor de la mora

                            <span class="mora-form-required">
                                *
                            </span>

                        </label>


                        <input
                            type="number"
                            id="valor_mora"
                            name="valor_mora"
                            class="mora-form-control"
                            value="{{ old('valor_mora', 0) }}"
                            min="0"
                            step="0.01"
                            required
                        >


                        <div class="mora-form-help">
                            Valor neto correspondiente a la mora, antes de IVA.
                        </div>

                    </div>


                    {{-- IVA MORA --}}

                    <div class="mora-form-group">

                        <label
                            class="mora-form-label mora-automatic-label"
                            for="iva_mora"
                        >

                            IVA de la mora

                            <span class="mora-automatic-badge">
                                Automático
                            </span>

                        </label>


                        <input
                            type="text"
                            id="iva_mora"
                            class="mora-form-control"
                            value="$0"
                            readonly
                        >


                        <div class="mora-form-help">
                            Se calcula automáticamente aplicando IVA de 19 % sobre el valor de la mora.
                        </div>

                    </div>

                </div>


                {{-- CÁLCULO --}}

                <div class="mora-calculation-box">

                    <h3 class="mora-calculation-title">
                        Resumen del cálculo
                    </h3>


                    <div class="mora-calculation-row">

                        <span>
                            Valor mora
                        </span>

                        <strong id="calculoValorMora">
                            $0
                        </strong>

                    </div>


                    <div class="mora-calculation-row">

                        <span>
                            IVA 19 %
                        </span>

                        <strong id="calculoIvaMora">
                            $0
                        </strong>

                    </div>


                    <div class="mora-calculation-row mora-calculation-total">

                        <span>
                            Total mora
                        </span>

                        <strong id="calculoTotalMora">
                            $0
                        </strong>

                    </div>

                </div>


                <div class="mora-form-help" style="margin-top: 9px;">
                    El IVA y el total se calculan automáticamente en pantalla. El servidor volverá a calcular el IVA antes de guardar el registro.
                </div>

            </div>

        </section>


        {{-- =================================================
             OBSERVACIONES
        ================================================== --}}

        <section class="mora-create-card">

            <div class="mora-create-card-header">

                <div>

                    <h2 class="mora-create-card-title">
                        Observaciones
                    </h2>

                    <p class="mora-create-card-description">
                        Registra información adicional relacionada con la mora.
                    </p>

                </div>

            </div>


            <div class="mora-create-card-body">

                <div class="mora-form-group">

                    <label
                        class="mora-form-label"
                        for="observacion"
                    >
                        Observación
                    </label>


                    <textarea
                        id="observacion"
                        name="observacion"
                        class="mora-form-control"
                        placeholder="Información adicional relacionada con la mora..."
                    >{{ old('observacion') }}</textarea>

                </div>

            </div>

        </section>


        {{-- =================================================
             FOOTER
        ================================================== --}}

        <div class="mora-create-card">

            <div class="mora-form-footer">

                <div class="mora-form-footer-note">

                    <span class="mora-form-required">
                        *
                    </span>

                    Campos obligatorios.

                </div>


                <div class="mora-form-footer-actions">

                    <a
                        href="{{ route('moras.index') }}"
                        class="btn"
                    >
                        Cancelar
                    </a>


                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Registrar mora
                    </button>

                </div>

            </div>

        </div>

    </form>

@endsection


@push('scripts')

@php

    $operacionesParaJavascript = $operaciones->map(
        function ($operacion) {

            return [
                'id' => $operacion->id,

                'facturas' => $operacion->facturas
                    ->where('estado', 'vigente')
                    ->map(
                        function ($factura) {

                            return [
                                'id' => $factura->id,
                                'numero' => $factura->numero_factura,
                                'total' => (float) $factura->total,
                                'fecha_emision' => $factura->fecha_emision
                                    ? $factura->fecha_emision->format('d/m/Y')
                                    : null,
                            ];

                        }
                    )
                    ->values()
                    ->all(),
            ];

        }
    )
    ->values()
    ->all();

@endphp


<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {

        const operaciones =
            @json($operacionesParaJavascript);


        const operacionOrigenSelect =
            document.getElementById(
                'operacion_origen_id'
            );


        const facturaOrigenSelect =
            document.getElementById(
                'factura_origen_id'
            );


        const operacionDestinoSelect =
            document.getElementById(
                'operacion_destino_id'
            );


        const facturaDestinoSelect =
            document.getElementById(
                'factura_destino_id'
            );


        const destinoStatus =
            document.getElementById(
                'moraDestinoStatus'
            );


        const valorMoraInput =
            document.getElementById(
                'valor_mora'
            );


        const ivaMoraInput =
            document.getElementById(
                'iva_mora'
            );


        const calculoValorMora =
            document.getElementById(
                'calculoValorMora'
            );


        const calculoIvaMora =
            document.getElementById(
                'calculoIvaMora'
            );


        const calculoTotalMora =
            document.getElementById(
                'calculoTotalMora'
            );


        const oldFacturaOrigen =
            @json(old('factura_origen_id'));


        const oldFacturaDestino =
            @json(old('factura_destino_id'));


        function obtenerOperacion(id) {

            return operaciones.find(
                function (operacion) {
                    return String(operacion.id) === String(id);
                }
            );

        }


        function limpiarSelect(
            select,
            texto
        ) {

            select.innerHTML = '';

            const option =
                document.createElement('option');

            option.value = '';
            option.textContent = texto;

            select.appendChild(option);

        }


        function formatearMonto(valor) {

            const numero =
                Math.round(
                    Number(valor) || 0
                );

            return numero.toLocaleString(
                'es-CL',
                {
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0
                }
            );

        }


        function cargarFacturas(
            operacionId,
            facturaSelect,
            facturaSeleccionada = null,
            permitirOrigen = false
        ) {

            limpiarSelect(
                facturaSelect,
                'Selecciona una factura'
            );


            facturaSelect.disabled =
                !operacionId;


            if (!operacionId) {

                return;

            }


            const operacion =
                obtenerOperacion(
                    operacionId
                );


            if (
                !operacion ||
                !operacion.facturas ||
                operacion.facturas.length === 0
            ) {

                limpiarSelect(
                    facturaSelect,
                    'No hay facturas vigentes'
                );

                facturaSelect.disabled = true;

                return;

            }


            operacion.facturas.forEach(
                function (factura) {

                    const option =
                        document.createElement('option');

                    option.value =
                        factura.id;

                    let texto =
                        'Factura ' +
                        factura.numero;

                    if (factura.fecha_emision) {

                        texto +=
                            ' — ' +
                            factura.fecha_emision;

                    }

                    if (factura.total !== null) {

                        texto +=
                            ' — $' +
                            formatearMonto(
                                factura.total
                            );

                    }

                    option.textContent =
                        texto;


                    if (
                        facturaSeleccionada !== null &&
                        String(factura.id) ===
                        String(facturaSeleccionada)
                    ) {

                        option.selected = true;

                    }


                    facturaSelect.appendChild(
                        option
                    );

                }
            );


            facturaSelect.disabled = false;

        }


        function actualizarDestino() {

            const operacionDestino =
                operacionDestinoSelect.value;

            cargarFacturas(
                operacionDestino,
                facturaDestinoSelect,
                oldFacturaDestino
            );


            if (
                operacionDestino &&
                facturaDestinoSelect.value
            ) {

                destinoStatus.style.display =
                    'block';

            } else {

                destinoStatus.style.display =
                    'none';

            }

        }


        function actualizarCalculos() {

            const valor =
                parseFloat(
                    valorMoraInput.value
                ) || 0;


            const iva =
                Math.round(
                    valor * 0.19
                );


            const total =
                Math.round(
                    valor + iva
                );


            ivaMoraInput.value =
                '$' +
                formatearMonto(
                    iva
                );


            calculoValorMora.textContent =
                '$' +
                formatearMonto(
                    valor
                );


            calculoIvaMora.textContent =
                '$' +
                formatearMonto(
                    iva
                );


            calculoTotalMora.textContent =
                '$' +
                formatearMonto(
                    total
                );

        }


        operacionOrigenSelect.addEventListener(
            'change',
            function () {

                cargarFacturas(
                    this.value,
                    facturaOrigenSelect,
                    null
                );

            }
        );


        operacionDestinoSelect.addEventListener(
            'change',
            function () {

                cargarFacturas(
                    this.value,
                    facturaDestinoSelect,
                    null
                );


                destinoStatus.style.display =
                    this.value
                    ? 'block'
                    : 'none';

            }
        );


        facturaDestinoSelect.addEventListener(
            'change',
            function () {

                destinoStatus.style.display =
                    this.value
                    ? 'block'
                    : 'none';

            }
        );


        valorMoraInput.addEventListener(
            'input',
            actualizarCalculos
        );


        if (operacionOrigenSelect.value) {

            cargarFacturas(
                operacionOrigenSelect.value,
                facturaOrigenSelect,
                oldFacturaOrigen
            );

        }


        if (operacionDestinoSelect.value) {

            actualizarDestino();

        }


        actualizarCalculos();

    }
);

</script>

@endpush