@extends('layouts.app')

@section('title', 'Nueva operación de factoring')

@section('topbar_title', 'Gestión de operaciones de factoring')

@push('styles')

<style>

    /* =========================================================
       BREADCRUMB
    ========================================================== */

    .factoring-create-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 18px;
        color: #8a94a6;
        font-size: 12px;
    }

    .factoring-create-breadcrumb a {
        color: #667085;
        text-decoration: none;
    }

    .factoring-create-breadcrumb a:hover {
        color: #155a91;
    }

    .factoring-create-breadcrumb-current {
        color: #344054;
    }


    /* =========================================================
       HEADER
    ========================================================== */

    .factoring-create-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 25px;
    }

    .factoring-create-title {
        margin: 0;
        color: #172033;
        font-size: 27px;
        line-height: 1.2;
        font-weight: 700;
        letter-spacing: -.025em;
    }

    .factoring-create-subtitle {
        margin: 7px 0 0;
        color: #667085;
        font-size: 13px;
    }


    /* =========================================================
       CARD
    ========================================================== */

    .factoring-create-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(16,47,80,.05);
        margin-bottom: 20px;
        overflow: hidden;
    }

    .factoring-create-card-header {
        min-height: 67px;
        padding: 17px 21px;
        border-bottom: 1px solid #edf1f5;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
    }

    .factoring-create-card-title {
        margin: 0;
        color: #172033;
        font-size: 15px;
        font-weight: 700;
    }

    .factoring-create-card-description {
        margin: 4px 0 0;
        color: #98a2b3;
        font-size: 11px;
    }

    .factoring-create-card-body {
        padding: 22px;
    }


    /* =========================================================
       FORMULARIO
    ========================================================== */

    .factoring-form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 17px;
    }

    .factoring-form-group {
        min-width: 0;
    }

    .factoring-form-group-full {
        grid-column: 1 / -1;
    }

    .factoring-form-label {
        display: block;
        margin-bottom: 7px;
        color: #344054;
        font-size: 11px;
        font-weight: 600;
    }

    .factoring-form-required {
        color: #c0392b;
    }

    .factoring-form-control {
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

    .factoring-form-control::placeholder {
        color: #a1aab7;
    }

    .factoring-form-control:focus {
        border-color: #155a91;
        box-shadow: 0 0 0 3px rgba(21,90,145,.08);
    }

    .factoring-form-control:disabled {
        background: #f8fafc;
        color: #667085;
        cursor: not-allowed;
    }

    textarea.factoring-form-control {
        min-height: 110px;
        resize: vertical;
        line-height: 1.5;
    }

    .factoring-form-help {
        margin-top: 5px;
        color: #98a2b3;
        font-size: 10px;
        line-height: 1.4;
    }


    /* =========================================================
       SELECT
    ========================================================== */

    select.factoring-form-control {
        cursor: pointer;
    }


    /* =========================================================
       INFORMACIÓN
    ========================================================== */

    .factoring-info-box {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin-bottom: 20px;
        padding: 13px 15px;
        border: 1px solid #dce9f3;
        border-radius: 7px;
        background: #f4f8fb;
        color: #667085;
        font-size: 11px;
        line-height: 1.5;
    }

    .factoring-info-icon {
        flex-shrink: 0;
        width: 22px;
        height: 22px;
        border-radius: 6px;
        background: #e2eef6;
        color: #155a91;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 700;
    }

    .factoring-info-box strong {
        color: #155a91;
    }


    /* =========================================================
       MONTO AUTOMÁTICO
    ========================================================== */

    .factoring-automatic-field {
        background: #f8fafc;
    }

    .factoring-automatic-label {
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .factoring-automatic-badge {
        display: inline-flex;
        align-items: center;
        padding: 3px 6px;
        border-radius: 4px;
        background: #eef4f8;
        color: #155a91;
        font-size: 8px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .025em;
    }

    .factoring-calculation-box {
        margin-top: 17px;
        padding: 14px 16px;
        border: 1px solid #e2e8f0;
        border-radius: 7px;
        background: #fbfcfd;
    }

    .factoring-calculation-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        padding: 5px 0;
        color: #667085;
        font-size: 11px;
    }

    .factoring-calculation-row strong {
        color: #344054;
        font-weight: 600;
    }

    .factoring-calculation-total {
        margin-top: 7px;
        padding-top: 10px;
        border-top: 1px solid #e2e8f0;
    }

    .factoring-calculation-total span {
        color: #344054;
        font-size: 11px;
        font-weight: 700;
    }

    .factoring-calculation-total strong {
        color: #155a91;
        font-size: 14px;
        font-weight: 700;
    }


    /* =========================================================
       FOOTER
    ========================================================== */

    .factoring-form-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        padding: 18px 22px;
        background: #f8fafc;
        border-top: 1px solid #edf1f5;
    }

    .factoring-form-footer-note {
        color: #98a2b3;
        font-size: 10px;
    }

    .factoring-form-footer-actions {
        display: flex;
        gap: 9px;
    }


    /* =========================================================
       ERRORES
    ========================================================== */

    .factoring-validation-alert {
        margin-bottom: 20px;
        padding: 13px 16px;
        border: 1px solid #f1ceca;
        border-radius: 7px;
        background: #fff5f3;
        color: #a63228;
        font-size: 11px;
    }

    .factoring-validation-alert strong {
        display: block;
        margin-bottom: 6px;
        font-size: 12px;
    }

    .factoring-validation-alert ul {
        margin: 0;
        padding-left: 18px;
    }

    .factoring-validation-alert li {
        margin-bottom: 3px;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================== */

    @media (max-width: 900px) {

        .factoring-form-grid {
            grid-template-columns: 1fr;
        }

        .factoring-form-group-full {
            grid-column: auto;
        }

    }


    @media (max-width: 700px) {

        .factoring-create-header {
            flex-direction: column;
        }

        .factoring-create-header .btn {
            width: 100%;
        }

        .factoring-create-card-body {
            padding: 17px;
        }

        .factoring-form-footer {
            align-items: stretch;
            flex-direction: column;
        }

        .factoring-form-footer-actions {
            width: 100%;
        }

        .factoring-form-footer-actions .btn {
            flex: 1;
        }

    }

</style>

@endpush


@section('content')

    {{-- =====================================================
         BREADCRUMB
    ====================================================== --}}

    <div class="factoring-create-breadcrumb">

        <a href="{{ route('factorings.index') }}">
            Operaciones de Factoring
        </a>

        <span>›</span>

        <span class="factoring-create-breadcrumb-current">
            Nueva operación
        </span>

    </div>


    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="factoring-create-header">

        <div>

            <h1 class="factoring-create-title">
                Nueva operación de factoring
            </h1>

            <p class="factoring-create-subtitle">
                Registra y asocia una factura a una operación de factoring.
            </p>

        </div>


        <a
            href="{{ route('factorings.index') }}"
            class="btn"
        >
            ← Volver a operaciones
        </a>

    </div>


    {{-- =====================================================
         ERRORES
    ====================================================== --}}

    @if($errors->any())

        <div class="factoring-validation-alert">

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
        action="{{ route('factorings.store') }}"
        method="POST"
        id="factoringCreateForm"
    >

        @csrf


        {{-- =================================================
             INFORMACIÓN DE LA OPERACIÓN
        ================================================== --}}

        <section class="factoring-create-card">

            <div class="factoring-create-card-header">

                <div>

                    <h2 class="factoring-create-card-title">
                        Información de la operación
                    </h2>

                    <p class="factoring-create-card-description">
                        Selecciona la empresa de factoring, operación y factura que serán asociadas.
                    </p>

                </div>

            </div>


            <div class="factoring-create-card-body">

                <div class="factoring-info-box">

                    <div class="factoring-info-icon">
                        i
                    </div>

                    <div>

                        <strong>
                            Asociación automática
                        </strong>

                        <br>

                        Primero selecciona la operación. Luego podrás seleccionar una de sus facturas vigentes. El monto de la factura se obtendrá automáticamente desde el registro de la factura.

                    </div>

                </div>


                <div class="factoring-form-grid">


                    {{-- EMPRESA FACTORING --}}

                    <div class="factoring-form-group">

                        <label
                            class="factoring-form-label"
                            for="empresa_factoring_id"
                        >

                            Empresa de factoring

                            <span class="factoring-form-required">
                                *
                            </span>

                        </label>


                        <select
                            id="empresa_factoring_id"
                            name="empresa_factoring_id"
                            class="factoring-form-control"
                            required
                        >

                            <option value="">
                                Selecciona una empresa
                            </option>

                            @foreach($empresasFactoring as $empresa)

                                <option
                                    value="{{ $empresa->id }}"
                                    {{ old('empresa_factoring_id') == $empresa->id ? 'selected' : '' }}
                                >

                                    {{ $empresa->nombre }}
                                    — {{ $empresa->rut }}

                                </option>

                            @endforeach

                        </select>


                        <div class="factoring-form-help">
                            Solo se muestran empresas de factoring activas.
                        </div>

                    </div>


                    {{-- FECHA DE CURSE --}}

                    <div class="factoring-form-group">

                        <label
                            class="factoring-form-label"
                            for="fecha_curse"
                        >

                            Fecha de curse

                            <span class="factoring-form-required">
                                *
                            </span>

                        </label>


                        <input
                            type="date"
                            id="fecha_curse"
                            name="fecha_curse"
                            class="factoring-form-control"
                            value="{{ old('fecha_curse') }}"
                            required
                        >


                        <div class="factoring-form-help">
                            Fecha en que se cursa la operación con la empresa de factoring.
                        </div>

                    </div>


                    {{-- OPERACIÓN --}}

                    <div class="factoring-form-group">

                        <label
                            class="factoring-form-label"
                            for="operacion_id"
                        >

                            Operación

                            <span class="factoring-form-required">
                                *
                            </span>

                        </label>


                        <select
                            id="operacion_id"
                            name="operacion_id"
                            class="factoring-form-control"
                            required
                        >

                            <option value="">
                                Selecciona una operación
                            </option>

                            @foreach($operaciones as $operacion)

                                <option
                                    value="{{ $operacion->id }}"
                                    {{ old('operacion_id') == $operacion->id ? 'selected' : '' }}
                                >

                                    {{ $operacion->numero_operacion }}

                                    @if($operacion->cliente)
                                        — {{ $operacion->cliente->nombre }}
                                    @endif

                                </option>

                            @endforeach

                        </select>


                        <div class="factoring-form-help">
                            Selecciona la operación a la que pertenece la factura.
                        </div>

                    </div>


                    {{-- FACTURA --}}

                    <div class="factoring-form-group">

                        <label
                            class="factoring-form-label"
                            for="factura_id"
                        >

                            Factura

                            <span class="factoring-form-required">
                                *
                            </span>

                        </label>


                        <select
                            id="factura_id"
                            name="factura_id"
                            class="factoring-form-control"
                            required
                            disabled
                        >

                            <option value="">
                                Selecciona primero una operación
                            </option>

                        </select>


                        <div class="factoring-form-help">
                            Se cargarán las facturas vigentes de la operación seleccionada.
                        </div>

                    </div>


                    {{-- ESTADO --}}

                    <div class="factoring-form-group">

                        <label
                            class="factoring-form-label"
                            for="estado"
                        >

                            Estado

                            <span class="factoring-form-required">
                                *
                            </span>

                        </label>


                        <select
                            id="estado"
                            name="estado"
                            class="factoring-form-control"
                            required
                        >

                            <option
                                value="pendiente"
                                {{ old('estado', 'pendiente') === 'pendiente' ? 'selected' : '' }}
                            >
                                Pendiente
                            </option>

                            <option
                                value="cursado"
                                {{ old('estado') === 'cursado' ? 'selected' : '' }}
                            >
                                Cursado
                            </option>

                            <option
                                value="liquidado"
                                {{ old('estado') === 'liquidado' ? 'selected' : '' }}
                            >
                                Liquidado
                            </option>

                            <option
                                value="anulado"
                                {{ old('estado') === 'anulado' ? 'selected' : '' }}
                            >
                                Anulado
                            </option>

                        </select>


                        <div class="factoring-form-help">
                            Estado actual de la operación de factoring.
                        </div>

                    </div>


                </div>

            </div>

        </section>


        {{-- =================================================
             INFORMACIÓN FINANCIERA
        ================================================== --}}

        <section class="factoring-create-card">

            <div class="factoring-create-card-header">

                <div>

                    <h2 class="factoring-create-card-title">
                        Información financiera
                    </h2>

                    <p class="factoring-create-card-description">
                        Registra los montos asociados a la operación de factoring.
                    </p>

                </div>

            </div>


            <div class="factoring-create-card-body">

                <div class="factoring-form-grid">


                    {{-- MONTO FACTURA --}}

                    <div class="factoring-form-group">

                        <label
                            class="factoring-form-label factoring-automatic-label"
                            for="monto_factura"
                        >

                            Monto de la factura

                            <span class="factoring-automatic-badge">
                                Automático
                            </span>

                        </label>


                        <input
                            type="text"
                            id="monto_factura"
                            class="factoring-form-control factoring-automatic-field"
                            value=""
                            placeholder="Se obtiene de la factura"
                            readonly
                            tabindex="-1"
                        >


                        <div class="factoring-form-help">
                            Este monto corresponde al total de la factura seleccionada y no se ingresa manualmente.
                        </div>

                    </div>


                    {{-- ANTICIPO --}}

                    <div class="factoring-form-group">

                        <label
                            class="factoring-form-label"
                            for="monto_anticipo"
                        >

                            Monto de anticipo

                            <span class="factoring-form-required">
                                *
                            </span>

                        </label>


                        <input
                            type="number"
                            id="monto_anticipo"
                            name="monto_anticipo"
                            class="factoring-form-control"
                            value="{{ old('monto_anticipo', 0) }}"
                            min="0"
                            step="1"
                            inputmode="numeric"
                            required
                        >


                        <div class="factoring-form-help">
                            Monto anticipado por la empresa de factoring.
                        </div>

                    </div>


                    {{-- COMISIÓN --}}

                    <div class="factoring-form-group">

                        <label
                            class="factoring-form-label"
                            for="comision"
                        >
                            Comisión
                        </label>


                        <input
                            type="number"
                            id="comision"
                            name="comision"
                            class="factoring-form-control"
                            value="{{ old('comision', 0) }}"
                            min="0"
                            step="1"
                            inputmode="numeric"
                        >


                        <div class="factoring-form-help">
                            Comisión cobrada por la empresa de factoring.
                        </div>

                    </div>


                    {{-- INTERÉS --}}

                    <div class="factoring-form-group">

                        <label
                            class="factoring-form-label"
                            for="interes"
                        >
                            Interés
                        </label>


                        <input
                            type="number"
                            id="interes"
                            name="interes"
                            class="factoring-form-control"
                            value="{{ old('interes', 0) }}"
                            min="0"
                            step="1"
                            inputmode="numeric"
                        >


                        <div class="factoring-form-help">
                            Interés asociado a la operación de factoring.
                        </div>

                    </div>


                </div>


                {{-- CÁLCULO --}}

                <div class="factoring-calculation-box">

                    <div class="factoring-calculation-row">

                        <span>
                            Monto de factura
                        </span>

                        <strong id="calculoMontoFactura">
                            $0
                        </strong>

                    </div>


                    <div class="factoring-calculation-row">

                        <span>
                            Anticipo
                        </span>

                        <strong id="calculoAnticipo">
                            $0
                        </strong>

                    </div>


                    <div class="factoring-calculation-row">

                        <span>
                            Comisión
                        </span>

                        <strong id="calculoComision">
                            $0
                        </strong>

                    </div>


                    <div class="factoring-calculation-row">

                        <span>
                            Interés
                        </span>

                        <strong id="calculoInteres">
                            $0
                        </strong>

                    </div>


                    <div class="factoring-calculation-row factoring-calculation-total">

                        <span>
                            Monto liquidado
                        </span>

                        <strong id="calculoLiquidado">
                            $0
                        </strong>

                    </div>

                </div>


                <div class="factoring-form-help" style="margin-top: 9px;">
                    El monto liquidado se calcula automáticamente como anticipo menos comisión e interés. El servidor volverá a calcular estos valores al guardar.
                </div>

            </div>

        </section>


        {{-- =================================================
             OBSERVACIONES
        ================================================== --}}

        <section class="factoring-create-card">

            <div class="factoring-create-card-header">

                <div>

                    <h2 class="factoring-create-card-title">
                        Observaciones
                    </h2>

                    <p class="factoring-create-card-description">
                        Registra información adicional relacionada con la operación.
                    </p>

                </div>

            </div>


            <div class="factoring-create-card-body">

                <div class="factoring-form-group">

                    <label
                        class="factoring-form-label"
                        for="observaciones"
                    >
                        Observaciones
                    </label>


                    <textarea
                        id="observaciones"
                        name="observaciones"
                        class="factoring-form-control"
                        placeholder="Información adicional de la operación..."
                    >{{ old('observaciones') }}</textarea>

                </div>

            </div>

        </section>


        {{-- =================================================
             FOOTER
        ================================================== --}}

        <div class="factoring-create-card">

            <div class="factoring-form-footer">

                <div class="factoring-form-footer-note">

                    <span class="factoring-form-required">
                        *
                    </span>

                    Campos obligatorios.

                </div>


                <div class="factoring-form-footer-actions">

                    <a
                        href="{{ route('factorings.index') }}"
                        class="btn"
                    >
                        Cancelar
                    </a>


                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Guardar operación
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


        const operacionSelect =
            document.getElementById(
                'operacion_id'
            );


        const facturaSelect =
            document.getElementById(
                'factura_id'
            );


        const montoFacturaInput =
            document.getElementById(
                'monto_factura'
            );


        const montoAnticipoInput =
            document.getElementById(
                'monto_anticipo'
            );


        const comisionInput =
            document.getElementById(
                'comision'
            );


        const interesInput =
            document.getElementById(
                'interes'
            );


        const calculoMontoFactura =
            document.getElementById(
                'calculoMontoFactura'
            );


        const calculoAnticipo =
            document.getElementById(
                'calculoAnticipo'
            );


        const calculoComision =
            document.getElementById(
                'calculoComision'
            );


        const calculoInteres =
            document.getElementById(
                'calculoInteres'
            );


        const calculoLiquidado =
            document.getElementById(
                'calculoLiquidado'
            );


        const facturaSeleccionada =
            "{{ old('factura_id') }}";


        function formatoMoneda(valor) {

            return '$' +
                Math.round(
                    Number(valor) || 0
                ).toLocaleString(
                    'es-CL'
                );

        }


        function obtenerOperacion(id) {

            return operaciones.find(
                function (operacion) {

                    return String(
                        operacion.id
                    ) === String(id);

                }
            );

        }


        function actualizarFacturas() {

            const operacion =
                obtenerOperacion(
                    operacionSelect.value
                );


            facturaSelect.innerHTML = '';


            if (!operacion) {

                facturaSelect.disabled = true;

                const option =
                    document.createElement(
                        'option'
                    );

                option.value = '';

                option.textContent =
                    'Selecciona primero una operación';

                facturaSelect.appendChild(
                    option
                );

                actualizarMontos();

                return;

            }


            facturaSelect.disabled = false;


            const optionInicial =
                document.createElement(
                    'option'
                );

            optionInicial.value = '';

            optionInicial.textContent =
                'Selecciona una factura';

            facturaSelect.appendChild(
                optionInicial
            );


            if (
                !operacion.facturas ||
                !operacion.facturas.length
            ) {

                const option =
                    document.createElement(
                        'option'
                    );

                option.value = '';

                option.textContent =
                    'No hay facturas vigentes';

                option.disabled = true;

                facturaSelect.appendChild(
                    option
                );

                actualizarMontos();

                return;

            }


            operacion.facturas.forEach(
                function (factura) {

                    const option =
                        document.createElement(
                            'option'
                        );


                    option.value =
                        factura.id;


                    option.dataset.total =
                        factura.total;


                    let texto =
                        'N.º ' +
                        factura.numero;


                    if (
                        factura.fecha_emision
                    ) {

                        texto +=
                            ' — ' +
                            factura.fecha_emision;

                    }


                    texto +=
                        ' — ' +
                        formatoMoneda(
                            factura.total
                        );


                    option.textContent =
                        texto;


                    if (
                        String(
                            factura.id
                        ) === String(
                            facturaSeleccionada
                        )
                    ) {

                        option.selected =
                            true;

                    }


                    facturaSelect.appendChild(
                        option
                    );

                }
            );


            actualizarMontos();

        }


        function actualizarMontos() {

            let montoFactura = 0;


            const option =
                facturaSelect.options[
                    facturaSelect.selectedIndex
                ];


            if (
                option &&
                option.dataset &&
                option.dataset.total
            ) {

                montoFactura =
                    Number(
                        option.dataset.total
                    ) || 0;

            }


            const anticipo =
                Number(
                    montoAnticipoInput.value
                ) || 0;


            const comision =
                Number(
                    comisionInput.value
                ) || 0;


            const interes =
                Number(
                    interesInput.value
                ) || 0;


            const liquidado =
                Math.max(
                    0,
                    anticipo -
                    comision -
                    interes
                );


            montoFacturaInput.value =
                montoFactura > 0
                    ? formatoMoneda(
                        montoFactura
                    )
                    : '';


            calculoMontoFactura.textContent =
                formatoMoneda(
                    montoFactura
                );


            calculoAnticipo.textContent =
                formatoMoneda(
                    anticipo
                );


            calculoComision.textContent =
                formatoMoneda(
                    comision
                );


            calculoInteres.textContent =
                formatoMoneda(
                    interes
                );


            calculoLiquidado.textContent =
                formatoMoneda(
                    liquidado
                );

        }


        operacionSelect.addEventListener(
            'change',
            function () {

                actualizarFacturas();

            }
        );


        facturaSelect.addEventListener(
            'change',
            function () {

                actualizarMontos();

            }
        );


        [
            montoAnticipoInput,
            comisionInput,
            interesInput
        ].forEach(
            function (input) {

                input.addEventListener(
                    'input',
                    function () {

                        actualizarMontos();

                    }
                );

            }
        );


        actualizarFacturas();

    }
);

</script>

@endpush