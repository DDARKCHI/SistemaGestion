@extends('layouts.app')

@section('title', 'Editar operación')

@section('topbar_title', 'Gestión de operaciones')

@push('styles')

<style>

    /* =========================================================
       BREADCRUMB
    ========================================================== */

    .operation-edit-breadcrumb {

        display: flex;
        align-items: center;
        gap: 8px;

        margin-bottom: 18px;

        color: #8a94a6;
        font-size: 12px;
    }

    .operation-edit-breadcrumb a {
        color: #667085;
    }

    .operation-edit-breadcrumb a:hover {
        color: #155a91;
    }

    .operation-edit-breadcrumb-current {
        color: #344054;
    }


    /* =========================================================
       HEADER
    ========================================================== */

    .operation-edit-header {

        display: flex;
        align-items: flex-start;
        justify-content: space-between;

        gap: 20px;

        margin-bottom: 25px;
    }

    .operation-edit-title {

        margin: 0;

        color: #172033;

        font-size: 27px;
        line-height: 1.2;

        font-weight: 700;

        letter-spacing: -.025em;
    }

    .operation-edit-subtitle {

        margin: 7px 0 0;

        color: #667085;

        font-size: 13px;
    }


    /* =========================================================
       CARD
    ========================================================== */

    .operation-edit-card {

        background: #ffffff;

        border: 1px solid #e2e8f0;

        border-radius: 10px;

        box-shadow:
            0 2px 8px rgba(16,47,80,.05);

        margin-bottom: 20px;

        overflow: hidden;
    }


    .operation-edit-card-header {

        min-height: 67px;

        padding: 17px 21px;

        border-bottom:
            1px solid #edf1f5;

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 15px;
    }


    .operation-edit-card-title {

        margin: 0;

        color: #172033;

        font-size: 15px;

        font-weight: 700;
    }


    .operation-edit-card-description {

        margin: 4px 0 0;

        color: #98a2b3;

        font-size: 11px;
    }


    .operation-edit-card-body {

        padding: 22px;
    }


    /* =========================================================
       IDENTIFICADOR
    ========================================================== */

    .operation-reference {

        display: inline-flex;

        align-items: center;

        gap: 7px;

        padding:
            6px 10px;

        border-radius: 6px;

        background: #eaf3fa;

        color: #155a91;

        font-size: 10px;

        font-weight: 700;
    }


    .operation-reference-dot {

        width: 6px;

        height: 6px;

        border-radius: 50%;

        background: #155a91;
    }


    /* =========================================================
       FORMULARIO
    ========================================================== */

    .operation-form-grid {

        display: grid;

        grid-template-columns:
            repeat(2, 1fr);

        gap: 17px;
    }


    .operation-form-group {

        min-width: 0;
    }


    .operation-form-group-full {

        grid-column: 1 / -1;
    }


    .operation-form-label {

        display: block;

        margin-bottom: 7px;

        color: #344054;

        font-size: 11px;

        font-weight: 600;
    }


    .operation-form-required {

        color: #c0392b;
    }


    .operation-form-control {

        width: 100%;

        min-height: 40px;

        padding:
            9px 11px;

        border:
            1px solid #d8e0e8;

        border-radius: 7px;

        background: #ffffff;

        color: #344054;

        font-family: inherit;

        font-size: 12px;

        outline: none;

        box-sizing: border-box;

        transition:
            border-color .15s ease,
            box-shadow .15s ease;
    }


    .operation-form-control::placeholder {

        color: #a1aab7;
    }


    .operation-form-control:focus {

        border-color: #155a91;

        box-shadow:
            0 0 0 3px rgba(21,90,145,.08);
    }


    textarea.operation-form-control {

        min-height: 100px;

        resize: vertical;

        line-height: 1.5;
    }


    select.operation-form-control {

        cursor: pointer;
    }


    .operation-form-help {

        margin-top: 5px;

        color: #98a2b3;

        font-size: 10px;

        line-height: 1.4;
    }


    /* =========================================================
       CLIENTE
    ========================================================== */

    .client-picker {

        position: relative;
    }


    .client-picker-input {

        position: relative;
    }


    .client-search-input {

        padding-right: 35px;
    }


    .client-search-icon {

        position: absolute;

        right: 12px;

        top: 50%;

        transform:
            translateY(-50%);

        color: #98a2b3;

        font-size: 14px;

        pointer-events: none;
    }


    .client-results {

        position: absolute;

        left: 0;
        right: 0;

        top: calc(100% + 5px);

        z-index: 100;

        max-height: 250px;

        overflow-y: auto;

        background: #ffffff;

        border:
            1px solid #dce3eb;

        border-radius: 8px;

        box-shadow:
            0 8px 25px rgba(16,47,80,.13);

        display: none;
    }


    .client-results.show {

        display: block;
    }


    .client-result {

        padding:
            11px 13px;

        border-bottom:
            1px solid #edf1f5;

        cursor: pointer;

        transition:
            background .12s ease;
    }


    .client-result:last-child {

        border-bottom: none;
    }


    .client-result:hover {

        background: #f6f9fc;
    }


    .client-result-name {

        color: #344054;

        font-size: 12px;

        font-weight: 600;
    }


    .client-result-rut {

        margin-top: 3px;

        color: #98a2b3;

        font-size: 10px;
    }


    .client-no-results {

        padding: 15px;

        color: #98a2b3;

        text-align: center;

        font-size: 11px;
    }


    .selected-client {

        display: none;

        align-items: center;

        justify-content: space-between;

        gap: 12px;

        margin-top: 8px;

        padding:
            9px 11px;

        background: #f0f6fb;

        border:
            1px solid #d6e6f2;

        border-radius: 7px;
    }


    .selected-client.show {

        display: flex;
    }


    .selected-client-info {

        min-width: 0;
    }


    .selected-client-name {

        color: #155a91;

        font-size: 11px;

        font-weight: 700;
    }


    .selected-client-rut {

        margin-top: 2px;

        color: #667085;

        font-size: 10px;
    }


    .selected-client-remove {

        flex-shrink: 0;

        border: none;

        background: transparent;

        color: #155a91;

        font-size: 10px;

        font-weight: 600;

        cursor: pointer;
    }


    /* =========================================================
       AVISO DE DOCUMENTOS
    ========================================================== */

    .documents-notice {

        display: flex;

        align-items: flex-start;

        gap: 10px;

        padding:
            13px 15px;

        margin-bottom: 16px;

        border:
            1px solid #dce9f3;

        border-radius: 7px;

        background: #f4f8fb;

        color: #667085;

        font-size: 11px;

        line-height: 1.5;
    }


    .documents-notice-icon {

        flex-shrink: 0;

        color: #155a91;

        font-size: 15px;
    }


    .documents-notice strong {

        color: #155a91;
    }


    /* =========================================================
       FOOTER
    ========================================================== */

    .operation-form-footer {

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 15px;

        padding:
            18px 22px;

        background: #f8fafc;

        border-top:
            1px solid #edf1f5;
    }


    .operation-form-footer-note {

        color: #98a2b3;

        font-size: 10px;
    }


    .operation-form-footer-actions {

        display: flex;

        gap: 9px;
    }


    /* =========================================================
       ALERTA
    ========================================================== */

    .operation-validation-alert {

        margin-bottom: 20px;

        padding:
            13px 16px;

        border:
            1px solid #f1ceca;

        border-radius: 7px;

        background: #fff5f3;

        color: #a63228;

        font-size: 11px;
    }


    .operation-validation-alert strong {

        display: block;

        margin-bottom: 6px;

        font-size: 12px;
    }


    .operation-validation-alert ul {

        margin: 0;

        padding-left: 18px;
    }


    .operation-validation-alert li {

        margin-bottom: 3px;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================== */

    @media (max-width: 900px) {

        .operation-form-grid {

            grid-template-columns: 1fr;
        }


        .operation-form-group-full {

            grid-column: auto;
        }

    }


    @media (max-width: 700px) {

        .operation-edit-header {

            flex-direction: column;
        }


        .operation-edit-header .btn {

            width: 100%;
        }


        .operation-edit-card-body {

            padding: 17px;
        }


        .operation-form-footer {

            align-items: stretch;

            flex-direction: column;
        }


        .operation-form-footer-actions {

            width: 100%;
        }


        .operation-form-footer-actions .btn {

            flex: 1;
        }

    }

</style>

@endpush


@section('content')

    {{-- =====================================================
         BREADCRUMB
    ====================================================== --}}

    <div class="operation-edit-breadcrumb">

        <a href="{{ route('operaciones.index') }}">
            Operaciones
        </a>

        <span>›</span>

        <a href="{{ route('operaciones.show', $operacion) }}">
            {{ $operacion->numero_operacion }}
        </a>

        <span>›</span>

        <span class="operation-edit-breadcrumb-current">
            Editar
        </span>

    </div>


    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="operation-edit-header">

        <div>

            <h1 class="operation-edit-title">
                Editar operación
            </h1>

            <p class="operation-edit-subtitle">
                Modifica la información registrada de esta operación.
            </p>

        </div>


        <div>

            <span class="operation-reference">

                <span class="operation-reference-dot"></span>

                {{ $operacion->numero_operacion }}

            </span>

        </div>

    </div>


    {{-- =====================================================
         ERRORES
    ====================================================== --}}

    @if($errors->any())

        <div class="operation-validation-alert">

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
        action="{{ route('operaciones.update', $operacion) }}"
        method="POST"
        id="operationEditForm"
    >

        @csrf

        @method('PUT')


        {{-- =================================================
             INFORMACIÓN GENERAL
        ================================================== --}}

        <section class="operation-edit-card">

            <div class="operation-edit-card-header">

                <div>

                    <h2 class="operation-edit-card-title">
                        Información de la operación
                    </h2>

                    <p class="operation-edit-card-description">
                        Actualiza los datos principales de la operación.
                    </p>

                </div>

            </div>


            <div class="operation-edit-card-body">

                <div class="operation-form-grid">


                    {{-- CLIENTE --}}

                    <div class="operation-form-group operation-form-group-full">

                        <label
                            class="operation-form-label"
                            for="clientSearch"
                        >

                            Cliente

                            <span class="operation-form-required">
                                *
                            </span>

                        </label>


                        <div class="client-picker">

                            <div class="client-picker-input">

                                <input
                                    type="text"
                                    id="clientSearch"
                                    class="operation-form-control client-search-input"
                                    placeholder="Buscar por razón social o RUT..."
                                    autocomplete="off"
                                    value="{{ $operacion->cliente?->razon_social }}"
                                >

                                <span class="client-search-icon">
                                    ⌕
                                </span>

                            </div>


                            <input
                                type="hidden"
                                name="cliente_id"
                                id="cliente_id"
                                value="{{ old('cliente_id', $operacion->cliente_id) }}"
                            >


                            <div
                                class="client-results"
                                id="clientResults"
                            >

                                @foreach($clientes as $cliente)

                                    <div
                                        class="client-result"
                                        data-id="{{ $cliente->id }}"
                                        data-name="{{ $cliente->razon_social }}"
                                        data-rut="{{ $cliente->rut }}"
                                    >

                                        <div class="client-result-name">
                                            {{ $cliente->razon_social }}
                                        </div>

                                        <div class="client-result-rut">
                                            RUT: {{ $cliente->rut }}
                                        </div>

                                    </div>

                                @endforeach

                            </div>


                            <div
                                class="selected-client show"
                                id="selectedClient"
                            >

                                <div class="selected-client-info">

                                    <div
                                        class="selected-client-name"
                                        id="selectedClientName"
                                    >
                                        {{ $operacion->cliente?->razon_social ?? 'Sin cliente' }}
                                    </div>

                                    <div
                                        class="selected-client-rut"
                                        id="selectedClientRut"
                                    >
                                        @if($operacion->cliente)
                                            RUT: {{ $operacion->cliente->rut }}
                                        @endif
                                    </div>

                                </div>


                                <button
                                    type="button"
                                    class="selected-client-remove"
                                    id="removeClient"
                                >
                                    Cambiar
                                </button>

                            </div>

                        </div>


                        <div class="operation-form-help">
                            Selecciona el cliente asociado a esta operación.
                        </div>

                    </div>


                    {{-- NÚMERO --}}

                    <div class="operation-form-group">

                        <label
                            class="operation-form-label"
                            for="numero_operacion"
                        >

                            Número de operación

                            <span class="operation-form-required">
                                *
                            </span>

                        </label>


                        <input
                            type="text"
                            id="numero_operacion"
                            name="numero_operacion"
                            class="operation-form-control"
                            value="{{ old('numero_operacion', $operacion->numero_operacion) }}"
                            required
                        >

                    </div>


                    {{-- TIPO --}}

                    <div class="operation-form-group">

                        <label
                            class="operation-form-label"
                            for="tipo"
                        >
                            Tipo de operación
                        </label>


                        <input
                            type="text"
                            id="tipo"
                            name="tipo"
                            class="operation-form-control"
                            value="{{ old('tipo', $operacion->tipo) }}"
                            placeholder="Ej. Orden de compra"
                        >

                    </div>


                    {{-- FECHA OPERACIÓN --}}

                    <div class="operation-form-group">

                        <label
                            class="operation-form-label"
                            for="fecha_operacion"
                        >
                            Fecha de operación
                        </label>


                        <input
                            type="date"
                            id="fecha_operacion"
                            name="fecha_operacion"
                            class="operation-form-control"
                            value="{{ old(
                                'fecha_operacion',
                                $operacion->fecha_operacion?->format('Y-m-d')
                            ) }}"
                        >

                    </div>


                    {{-- FECHA CURSE --}}

                    <div class="operation-form-group">

                        <label
                            class="operation-form-label"
                            for="fecha_curse"
                        >
                            Fecha de curse
                        </label>


                        <input
                            type="date"
                            id="fecha_curse"
                            name="fecha_curse"
                            class="operation-form-control"
                            value="{{ old(
                                'fecha_curse',
                                $operacion->fecha_curse?->format('Y-m-d')
                            ) }}"
                        >

                    </div>


                    {{-- ESTADO --}}

                    <div class="operation-form-group">

                        <label
                            class="operation-form-label"
                            for="estado"
                        >

                            Estado

                            <span class="operation-form-required">
                                *
                            </span>

                        </label>


                        <select
                            id="estado"
                            name="estado"
                            class="operation-form-control"
                            required
                        >

                            <option value="">
                                Seleccionar estado
                            </option>

                            <option
                                value="pendiente"
                                {{ old('estado', $operacion->estado) === 'pendiente' ? 'selected' : '' }}
                            >
                                Pendiente
                            </option>

                            <option
                                value="en_proceso"
                                {{ old('estado', $operacion->estado) === 'en_proceso' ? 'selected' : '' }}
                            >
                                En proceso
                            </option>

                            <option
                                value="completada"
                                {{ old('estado', $operacion->estado) === 'completada' ? 'selected' : '' }}
                            >
                                Completada
                            </option>

                            <option
                                value="anulada"
                                {{ old('estado', $operacion->estado) === 'anulada' ? 'selected' : '' }}
                            >
                                Anulada
                            </option>

                        </select>

                    </div>


                    {{-- DESCRIPCIÓN --}}

                    <div class="operation-form-group">

                        <label
                            class="operation-form-label"
                            for="descripcion"
                        >
                            Descripción
                        </label>


                        <textarea
                            id="descripcion"
                            name="descripcion"
                            class="operation-form-control"
                            placeholder="Descripción general de la operación..."
                        >{{ old('descripcion', $operacion->descripcion) }}</textarea>

                    </div>


                    {{-- OBSERVACIONES --}}

                    <div class="operation-form-group">

                        <label
                            class="operation-form-label"
                            for="observaciones"
                        >
                            Observaciones
                        </label>


                        <textarea
                            id="observaciones"
                            name="observaciones"
                            class="operation-form-control"
                            placeholder="Observaciones adicionales..."
                        >{{ old('observaciones', $operacion->observaciones) }}</textarea>

                    </div>

                </div>

            </div>

        </section>


        {{-- =================================================
             DOCUMENTOS
        ================================================== --}}

        <section class="operation-edit-card">

            <div class="operation-edit-card-header">

                <div>

                    <h2 class="operation-edit-card-title">
                        Documentos asociados
                    </h2>

                    <p class="operation-edit-card-description">
                        Los documentos se administran desde el detalle de la operación.
                    </p>

                </div>


                <a
                    href="{{ route('operaciones.show', $operacion) }}"
                    class="btn"
                >
                    Ver documentos
                </a>

            </div>


            <div class="operation-edit-card-body">

                <div class="documents-notice">

                    <div class="documents-notice-icon">
                        ▧
                    </div>

                    <div>

                        <strong>
                            Documentos de la operación
                        </strong>

                        <br>

                        Para evitar modificar accidentalmente archivos asociados, la carga y eliminación de documentos se realiza desde la ficha de la operación.

                    </div>

                </div>

            </div>

        </section>


        {{-- =================================================
             FOOTER
        ================================================== --}}

        <div class="operation-edit-card">

            <div class="operation-form-footer">

                <div class="operation-form-footer-note">

                    <span class="operation-form-required">
                        *
                    </span>

                    Campos obligatorios.

                </div>


                <div class="operation-form-footer-actions">

                    <a
                        href="{{ route('operaciones.show', $operacion) }}"
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

            /* =================================================
               CLIENTE
            ================================================== */

            const clientSearch =
                document.getElementById(
                    'clientSearch'
                );


            const clientResults =
                document.getElementById(
                    'clientResults'
                );


            const clienteId =
                document.getElementById(
                    'cliente_id'
                );


            const selectedClient =
                document.getElementById(
                    'selectedClient'
                );


            const selectedClientName =
                document.getElementById(
                    'selectedClientName'
                );


            const selectedClientRut =
                document.getElementById(
                    'selectedClientRut'
                );


            const removeClient =
                document.getElementById(
                    'removeClient'
                );


            const clientItems =
                document.querySelectorAll(
                    '.client-result'
                );


            function showClientResults() {

                clientResults.classList.add(
                    'show'
                );

            }


            function hideClientResults() {

                clientResults.classList.remove(
                    'show'
                );

            }


            function selectClient(
                id,
                name,
                rut
            ) {

                clienteId.value = id;

                clientSearch.value = name;

                selectedClientName.textContent =
                    name;

                selectedClientRut.textContent =
                    'RUT: ' + rut;

                selectedClient.classList.add(
                    'show'
                );

                hideClientResults();

            }


            function clearClient() {

                clienteId.value = '';

                clientSearch.value = '';

                selectedClientName.textContent =
                    '';

                selectedClientRut.textContent =
                    '';

                selectedClient.classList.remove(
                    'show'
                );

                clientSearch.focus();

                showClientResults();

            }


            if (clientSearch) {

                clientSearch.addEventListener(
                    'focus',
                    function () {

                        showClientResults();

                    }
                );


                clientSearch.addEventListener(
                    'input',
                    function () {

                        const search =
                            this.value
                                .toLowerCase()
                                .trim();


                        let visible = 0;


                        clientItems.forEach(
                            function (item) {

                                const name =
                                    (
                                        item.dataset.name ||
                                        ''
                                    ).toLowerCase();


                                const rut =
                                    (
                                        item.dataset.rut ||
                                        ''
                                    ).toLowerCase();


                                const matches =
                                    name.includes(search) ||
                                    rut.includes(search);


                                item.style.display =
                                    matches
                                        ? ''
                                        : 'none';


                                if (matches) {

                                    visible++;

                                }

                            }
                        );


                        clientResults.classList.add(
                            'show'
                        );


                        let noResults =
                            clientResults.querySelector(
                                '.client-no-results'
                            );


                        if (
                            visible === 0
                        ) {

                            if (!noResults) {

                                noResults =
                                    document.createElement(
                                        'div'
                                    );

                                noResults.className =
                                    'client-no-results';

                                noResults.textContent =
                                    'No se encontraron clientes.';

                                clientResults.appendChild(
                                    noResults
                                );

                            }

                        } else {

                            if (noResults) {

                                noResults.remove();

                            }

                        }

                    }
                );

            }


            clientItems.forEach(
                function (item) {

                    item.addEventListener(
                        'click',
                        function () {

                            selectClient(
                                this.dataset.id,
                                this.dataset.name,
                                this.dataset.rut
                            );

                        }
                    );

                }
            );


            if (removeClient) {

                removeClient.addEventListener(
                    'click',
                    function () {

                        clearClient();

                    }
                );

            }


            document.addEventListener(
                'click',
                function (event) {

                    if (
                        !event.target.closest(
                            '.client-picker'
                        )
                    ) {

                        hideClientResults();

                    }

                }
            );


            /* =================================================
               VALIDACIÓN
            ================================================== */

            const operationEditForm =
                document.getElementById(
                    'operationEditForm'
                );


            if (operationEditForm) {

                operationEditForm.addEventListener(
                    'submit',
                    function (event) {

                        if (
                            !clienteId.value
                        ) {

                            event.preventDefault();

                            alert(
                                'Debes seleccionar un cliente para la operación.'
                            );

                            clientSearch.focus();

                        }

                    }
                );

            }

        }
    );

</script>

@endpush