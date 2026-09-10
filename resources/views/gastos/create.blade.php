@extends('layouts.app')

@section('title', 'Nuevo gasto')

@section('topbar_title', 'Gestión de gastos')

@push('styles')

<style>

    /* =========================================================
       BREADCRUMB
    ========================================================== */

    .gasto-create-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 18px;
        color: #8a94a6;
        font-size: 12px;
    }

    .gasto-create-breadcrumb a {
        color: #667085;
        text-decoration: none;
    }

    .gasto-create-breadcrumb a:hover {
        color: #155a91;
    }

    .gasto-create-breadcrumb-current {
        color: #344054;
    }


    /* =========================================================
       HEADER
    ========================================================== */

    .gasto-create-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 25px;
    }

    .gasto-create-title {
        margin: 0;
        color: #172033;
        font-size: 27px;
        line-height: 1.2;
        font-weight: 700;
        letter-spacing: -.025em;
    }

    .gasto-create-subtitle {
        margin: 7px 0 0;
        color: #667085;
        font-size: 13px;
    }


    /* =========================================================
       CARD
    ========================================================== */

    .gasto-create-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(16,47,80,.05);
        margin-bottom: 20px;
        overflow: hidden;
    }

    .gasto-create-card-header {
        min-height: 67px;
        padding: 17px 21px;
        border-bottom: 1px solid #edf1f5;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
    }

    .gasto-create-card-title {
        margin: 0;
        color: #172033;
        font-size: 15px;
        font-weight: 700;
    }

    .gasto-create-card-description {
        margin: 4px 0 0;
        color: #98a2b3;
        font-size: 11px;
    }

    .gasto-create-card-body {
        padding: 22px;
    }


    /* =========================================================
       FORMULARIO
    ========================================================== */

    .gasto-form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 17px;
    }

    .gasto-form-group {
        min-width: 0;
    }

    .gasto-form-group-full {
        grid-column: 1 / -1;
    }

    .gasto-form-label {
        display: block;
        margin-bottom: 7px;
        color: #344054;
        font-size: 11px;
        font-weight: 600;
    }

    .gasto-form-required {
        color: #c0392b;
    }

    .gasto-form-control {
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

    .gasto-form-control::placeholder {
        color: #a1aab7;
    }

    .gasto-form-control:focus {
        border-color: #155a91;
        box-shadow: 0 0 0 3px rgba(21,90,145,.08);
    }

    .gasto-form-control:read-only {
        background: #f8fafc;
        color: #667085;
    }

    textarea.gasto-form-control {
        min-height: 110px;
        resize: vertical;
        line-height: 1.5;
    }

    .gasto-form-help {
        margin-top: 5px;
        color: #98a2b3;
        font-size: 10px;
        line-height: 1.4;
    }


    /* =========================================================
       INFORMACIÓN
    ========================================================== */

    .gasto-info-box {
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

    .gasto-info-icon {
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

    .gasto-info-box strong {
        color: #344054;
    }


    /* =========================================================
       ASOCIACIÓN
    ========================================================== */

    .gasto-association-box {
        margin-top: 20px;
        padding: 16px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        background: #fafbfc;
    }

    .gasto-association-title {
        margin: 0 0 4px;
        color: #344054;
        font-size: 12px;
        font-weight: 700;
    }

    .gasto-association-description {
        margin: 0 0 15px;
        color: #98a2b3;
        font-size: 10px;
        line-height: 1.4;
    }

    .gasto-operation-status {
        display: none;
        margin-top: 8px;
        padding: 8px 10px;
        border-radius: 6px;
        background: #f2f4f7;
        color: #667085;
        font-size: 10px;
        line-height: 1.4;
    }

    .gasto-operation-status.active {
        display: block;
    }


    /* =========================================================
       RESUMEN
    ========================================================== */

    .gasto-calculation-box {
        margin-top: 20px;
        padding: 15px 17px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        background: #fafbfc;
    }

    .gasto-calculation-title {
        margin: 0 0 11px;
        color: #344054;
        font-size: 12px;
        font-weight: 700;
    }

    .gasto-calculation-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        padding: 5px 0;
        color: #667085;
        font-size: 11px;
    }

    .gasto-calculation-row strong {
        color: #344054;
        font-weight: 600;
    }

    .gasto-calculation-total {
        margin-top: 7px;
        padding-top: 10px;
        border-top: 1px solid #e2e8f0;
    }

    .gasto-calculation-total span {
        color: #344054;
        font-size: 11px;
        font-weight: 700;
    }

    .gasto-calculation-total strong {
        color: #155a91;
        font-size: 14px;
        font-weight: 700;
    }


    /* =========================================================
       FOOTER
    ========================================================== */

    .gasto-form-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        padding: 18px 22px;
        background: #f8fafc;
        border-top: 1px solid #edf1f5;
    }

    .gasto-form-footer-note {
        color: #98a2b3;
        font-size: 10px;
    }

    .gasto-form-footer-actions {
        display: flex;
        gap: 9px;
    }


    /* =========================================================
       ERRORES
    ========================================================== */

    .gasto-validation-alert {
        margin-bottom: 20px;
        padding: 13px 16px;
        border: 1px solid #f1ceca;
        border-radius: 7px;
        background: #fff5f3;
        color: #a63228;
        font-size: 11px;
    }

    .gasto-validation-alert strong {
        display: block;
        margin-bottom: 6px;
        font-size: 12px;
    }

    .gasto-validation-alert ul {
        margin: 0;
        padding-left: 18px;
    }

    .gasto-validation-alert li {
        margin-bottom: 3px;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================== */

    @media (max-width: 900px) {

        .gasto-form-grid {
            grid-template-columns: 1fr;
        }

        .gasto-form-group-full {
            grid-column: auto;
        }

    }


    @media (max-width: 700px) {

        .gasto-create-header {
            flex-direction: column;
        }

        .gasto-create-header .btn {
            width: 100%;
        }

        .gasto-create-card-body {
            padding: 17px;
        }

        .gasto-form-footer {
            align-items: stretch;
            flex-direction: column;
        }

        .gasto-form-footer-actions {
            width: 100%;
        }

        .gasto-form-footer-actions .btn {
            flex: 1;
        }

    }

</style>

@endpush


@section('content')

    {{-- =====================================================
         BREADCRUMB
    ====================================================== --}}

    <div class="gasto-create-breadcrumb">

        <a href="{{ route('gastos.index') }}">
            Gastos
        </a>

        <span>›</span>

        <span class="gasto-create-breadcrumb-current">
            Nuevo gasto
        </span>

    </div>


    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="gasto-create-header">

        <div>

            <h1 class="gasto-create-title">
                Nuevo gasto
            </h1>

            <p class="gasto-create-subtitle">
                Registra un gasto, define su naturaleza y establece sus asociaciones.
            </p>

        </div>


        <a
            href="{{ route('gastos.index') }}"
            class="btn"
        >
            ← Volver a gastos
        </a>

    </div>


    {{-- =====================================================
         ERRORES
    ====================================================== --}}

    @if($errors->any())

        <div class="gasto-validation-alert">

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
        action="{{ route('gastos.store') }}"
        method="POST"
        id="gastoCreateForm"
    >

        @csrf


        {{-- =================================================
             TIPO DE GASTO
        ================================================== --}}

        <section class="gasto-create-card">

            <div class="gasto-create-card-header">

                <div>

                    <h2 class="gasto-create-card-title">
                        Clasificación del gasto
                    </h2>

                    <p class="gasto-create-card-description">
                        Define la naturaleza del registro que estás ingresando.
                    </p>

                </div>

            </div>


            <div class="gasto-create-card-body">

                <div class="gasto-info-box">

                    <div class="gasto-info-icon">
                        i
                    </div>

                    <div>

                        <strong>
                            Concepto libre
                        </strong>

                        <br>

                        El sistema no limita los gastos a una lista fija. Puedes registrar bencina, hospedaje, peajes, alimentación, fletes, mantenimiento o cualquier otro concepto que corresponda.

                    </div>

                </div>


                <div class="gasto-form-grid">


                    {{-- TIPO --}}

                    <div class="gasto-form-group">

                        <label
                            class="gasto-form-label"
                            for="tipo"
                        >

                            Tipo de gasto

                            <span class="gasto-form-required">
                                *
                            </span>

                        </label>


                        <select
                            id="tipo"
                            name="tipo"
                            class="gasto-form-control"
                            required
                        >

                            <option value="">
                                Selecciona un tipo
                            </option>

                            <option
                                value="Con boleta"
                                {{ old('tipo') === 'Con boleta' ? 'selected' : '' }}
                            >
                                Con boleta
                            </option>

                            <option
                                value="Sin boleta / factura / comprobante"
                                {{ old('tipo') === 'Sin boleta / factura / comprobante' ? 'selected' : '' }}
                            >
                                Sin boleta / factura / comprobante
                            </option>

                            <option
                                value="Egreso general"
                                {{ old('tipo') === 'Egreso general' ? 'selected' : '' }}
                            >
                                Egreso general
                            </option>

                        </select>


                        <div class="gasto-form-help">
                            Define la naturaleza general del egreso.
                        </div>

                    </div>


                    {{-- CONCEPTO --}}

                    <div class="gasto-form-group">

                        <label
                            class="gasto-form-label"
                            for="descripcion"
                        >

                            Concepto

                            <span class="gasto-form-required">
                                *
                            </span>

                        </label>


                        <input
                            type="text"
                            id="descripcion"
                            name="descripcion"
                            class="gasto-form-control"
                            value="{{ old('descripcion') }}"
                            placeholder="Ej. Bencina, hospedaje, peaje..."
                            maxlength="255"
                            required
                        >


                        <div class="gasto-form-help">
                            Escribe libremente el concepto específico del gasto.
                        </div>

                    </div>

                </div>

            </div>

        </section>


        {{-- =================================================
             ASOCIACIÓN
        ================================================== --}}

        <section class="gasto-create-card">

            <div class="gasto-create-card-header">

                <div>

                    <h2 class="gasto-create-card-title">
                        Asociación del gasto
                    </h2>

                    <p class="gasto-create-card-description">
                        Define dónde quedará registrado el gasto dentro del sistema.
                    </p>

                </div>

            </div>


            <div class="gasto-create-card-body">

                <div class="gasto-info-box">

                    <div class="gasto-info-icon">
                        i
                    </div>

                    <div>

                        <strong>
                            Registro único
                        </strong>

                        <br>

                        El gasto se registra una sola vez. Cuando corresponde, puede quedar asociado a una operación y a un transportista sin duplicar el registro.

                    </div>

                </div>


                <div class="gasto-form-grid">


                    {{-- OPERACIÓN --}}

                    <div
                        class="gasto-form-group"
                        id="operacionGroup"
                    >

                        <label
                            class="gasto-form-label"
                            for="operacion_id"
                        >

                            Operación

                            <span
                                class="gasto-form-required"
                                id="operacionRequired"
                            >
                                *
                            </span>

                        </label>


                        <select
                            id="operacion_id"
                            name="operacion_id"
                            class="gasto-form-control"
                        >

                            <option value="">
                                Sin operación
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


                        <div
                            class="gasto-form-help"
                            id="operacionHelp"
                        >
                            Selecciona la operación a la que corresponde este gasto.
                        </div>


                        <div
                            class="gasto-operation-status"
                            id="operacionStatus"
                        >
                            Los egresos generales no requieren una operación.
                        </div>

                    </div>


                    {{-- TRANSPORTISTA --}}

                    <div class="gasto-form-group">

                        <label
                            class="gasto-form-label"
                            for="transportista_id"
                        >

                            Transportista

                        </label>


                        <select
                            id="transportista_id"
                            name="transportista_id"
                            class="gasto-form-control"
                        >

                            <option value="">
                                Sin transportista
                            </option>

                            @foreach($transportistas as $transportista)

                                <option
                                    value="{{ $transportista->id }}"
                                    {{ old('transportista_id') == $transportista->id ? 'selected' : '' }}
                                >

                                    {{ $transportista->nombre }}

                                    @if($transportista->rut)

                                        — {{ $transportista->rut }}

                                    @endif

                                </option>

                            @endforeach

                        </select>


                        <div class="gasto-form-help">
                            Opcional. Selecciónalo cuando el gasto corresponda a un transportista.
                        </div>

                    </div>

                </div>

            </div>

        </section>


        {{-- =================================================
             DATOS DEL GASTO
        ================================================== --}}

        <section class="gasto-create-card">

            <div class="gasto-create-card-header">

                <div>

                    <h2 class="gasto-create-card-title">
                        Datos del gasto
                    </h2>

                    <p class="gasto-create-card-description">
                        Registra la fecha y el monto correspondiente.
                    </p>

                </div>

            </div>


            <div class="gasto-create-card-body">

                <div class="gasto-form-grid">


                    {{-- FECHA --}}

                    <div class="gasto-form-group">

                        <label
                            class="gasto-form-label"
                            for="fecha"
                        >
                            Fecha
                        </label>


                        <input
                            type="date"
                            id="fecha"
                            name="fecha"
                            class="gasto-form-control"
                            value="{{ old('fecha', now()->format('Y-m-d')) }}"
                        >


                        <div class="gasto-form-help">
                            Fecha en que se realizó o registró el gasto.
                        </div>

                    </div>


                    {{-- MONTO --}}

                    <div class="gasto-form-group">

                        <label
                            class="gasto-form-label"
                            for="monto"
                        >

                            Monto

                            <span class="gasto-form-required">
                                *
                            </span>

                        </label>


                        <input
                            type="number"
                            id="monto"
                            name="monto"
                            class="gasto-form-control"
                            value="{{ old('monto', 0) }}"
                            min="0"
                            step="1"
                            required
                        >


                        <div class="gasto-form-help">
                            Monto total del gasto. Los montos se manejan sin decimales.
                        </div>

                    </div>


                    {{-- TOTAL FORMATEADO --}}

                    <div class="gasto-form-group">

                        <label class="gasto-form-label">
                            Total registrado
                        </label>


                        <input
                            type="text"
                            id="montoFormateado"
                            class="gasto-form-control"
                            value="$0"
                            readonly
                        >


                        <div class="gasto-form-help">
                            Representación del monto en formato monetario del sistema.
                        </div>

                    </div>

                </div>


                {{-- RESUMEN --}}

                <div class="gasto-calculation-box">

                    <h3 class="gasto-calculation-title">
                        Resumen del gasto
                    </h3>


                    <div class="gasto-calculation-row">

                        <span>
                            Tipo
                        </span>

                        <strong id="resumenTipo">
                            Sin seleccionar
                        </strong>

                    </div>


                    <div class="gasto-calculation-row">

                        <span>
                            Concepto
                        </span>

                        <strong id="resumenConcepto">
                            Sin ingresar
                        </strong>

                    </div>


                    <div class="gasto-calculation-row">

                        <span>
                            Operación
                        </span>

                        <strong id="resumenOperacion">
                            Sin seleccionar
                        </strong>

                    </div>


                    <div class="gasto-calculation-row gasto-calculation-total">

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
             OBSERVACIONES
        ================================================== --}}

        <section class="gasto-create-card">

            <div class="gasto-create-card-header">

                <div>

                    <h2 class="gasto-create-card-title">
                        Observaciones
                    </h2>

                    <p class="gasto-create-card-description">
                        Registra información adicional relacionada con el gasto.
                    </p>

                </div>

            </div>


            <div class="gasto-create-card-body">

                <div class="gasto-form-group">

                    <label
                        class="gasto-form-label"
                        for="observaciones"
                    >
                        Observaciones
                    </label>


                    <textarea
                        id="observaciones"
                        name="observaciones"
                        class="gasto-form-control"
                        placeholder="Información adicional relacionada con el gasto..."
                    >{{ old('observaciones') }}</textarea>

                </div>

            </div>

        </section>


        {{-- =================================================
             FOOTER
        ================================================== --}}

        <div class="gasto-create-card">

            <div class="gasto-form-footer">

                <div class="gasto-form-footer-note">

                    <span class="gasto-form-required">
                        *
                    </span>

                    Campos obligatorios.

                </div>


                <div class="gasto-form-footer-actions">

                    <a
                        href="{{ route('gastos.index') }}"
                        class="btn"
                    >
                        Cancelar
                    </a>


                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Registrar gasto
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
                'gastoCreateForm'
            );


        const tipoSelect =
            document.getElementById(
                'tipo'
            );


        const descripcionInput =
            document.getElementById(
                'descripcion'
            );


        const operacionSelect =
            document.getElementById(
                'operacion_id'
            );


        const operacionRequired =
            document.getElementById(
                'operacionRequired'
            );


        const operacionHelp =
            document.getElementById(
                'operacionHelp'
            );


        const operacionStatus =
            document.getElementById(
                'operacionStatus'
            );


        const montoInput =
            document.getElementById(
                'monto'
            );


        const montoFormateado =
            document.getElementById(
                'montoFormateado'
            );


        const resumenTipo =
            document.getElementById(
                'resumenTipo'
            );


        const resumenConcepto =
            document.getElementById(
                'resumenConcepto'
            );


        const resumenOperacion =
            document.getElementById(
                'resumenOperacion'
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


        function actualizarOperacion() {

            const esEgresoGeneral =
                tipoSelect.value ===
                'Egreso general';


            if (esEgresoGeneral) {

                operacionSelect.removeAttribute(
                    'required'
                );

                operacionRequired.style.display =
                    'none';

                operacionHelp.textContent =
                    'Opcional. Un egreso general puede registrarse sin una operación específica.';

                operacionStatus.classList.add(
                    'active'
                );

            } else {

                operacionSelect.setAttribute(
                    'required',
                    'required'
                );

                operacionRequired.style.display =
                    'inline';

                operacionHelp.textContent =
                    'Selecciona la operación a la que corresponde este gasto.';

                operacionStatus.classList.remove(
                    'active'
                );

            }


            actualizarResumen();

        }


        function actualizarResumen() {

            const tipo =
                tipoSelect.value.trim();


            const concepto =
                descripcionInput.value.trim();


            const monto =
                Math.round(
                    Number(
                        montoInput.value
                    ) || 0
                );


            resumenTipo.textContent =
                tipo ||
                'Sin seleccionar';


            resumenConcepto.textContent =
                concepto ||
                'Sin ingresar';


            if (
                operacionSelect.value
            ) {

                resumenOperacion.textContent =
                    operacionSelect.options[
                        operacionSelect.selectedIndex
                    ].text.trim();

            } else {

                resumenOperacion.textContent =
                    tipo === 'Egreso general'
                        ? 'Sin operación'
                        : 'Sin seleccionar';

            }


            montoFormateado.value =
                formatearMonto(
                    monto
                );


            resumenMonto.textContent =
                formatearMonto(
                    monto
                );

        }


        tipoSelect.addEventListener(
            'change',
            actualizarOperacion
        );


        descripcionInput.addEventListener(
            'input',
            actualizarResumen
        );


        operacionSelect.addEventListener(
            'change',
            actualizarResumen
        );


        montoInput.addEventListener(
            'input',
            actualizarResumen
        );


        form.addEventListener(
            'submit',
            function (event) {

                if (
                    tipoSelect.value !==
                    'Egreso general' &&
                    !operacionSelect.value
                ) {

                    event.preventDefault();

                    operacionSelect.focus();

                    alert(
                        'Debes seleccionar una operación para este tipo de gasto.'
                    );

                }

            }
        );


        actualizarOperacion();

    }
);

</script>

@endpush