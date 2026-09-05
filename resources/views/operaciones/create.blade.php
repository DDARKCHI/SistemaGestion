@extends('layouts.app')

@section('title', 'Nueva operación')

@section('topbar_title', 'Gestión de operaciones')

@push('styles')

<style>

    /* =========================================================
       BREADCRUMB
    ========================================================== */

    .operation-create-breadcrumb {

        display: flex;

        align-items: center;

        gap: 8px;

        margin-bottom: 18px;

        color: #8a94a6;

        font-size: 12px;

    }


    .operation-create-breadcrumb a {

        color: #667085;

    }


    .operation-create-breadcrumb a:hover {

        color: #155a91;

    }


    .operation-create-breadcrumb-current {

        color: #344054;

    }


    /* =========================================================
       HEADER
    ========================================================== */

    .operation-create-header {

        display: flex;

        align-items: flex-start;

        justify-content: space-between;

        gap: 20px;

        margin-bottom: 25px;

    }


    .operation-create-title {

        margin: 0;

        color: #172033;

        font-size: 27px;

        line-height: 1.2;

        font-weight: 700;

        letter-spacing: -.025em;

    }


    .operation-create-subtitle {

        margin: 7px 0 0;

        color: #667085;

        font-size: 13px;

    }


    /* =========================================================
       CARD PRINCIPAL
    ========================================================== */

    .operation-create-card {

        background: #ffffff;

        border: 1px solid #e2e8f0;

        border-radius: 10px;

        box-shadow:
            0 2px 8px rgba(16,47,80,.05);

        margin-bottom: 20px;

        overflow: hidden;

    }


    .operation-create-card-header {

        min-height: 67px;

        padding: 17px 21px;

        border-bottom:
            1px solid #edf1f5;

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 15px;

    }


    .operation-create-card-title {

        margin: 0;

        color: #172033;

        font-size: 15px;

        font-weight: 700;

    }


    .operation-create-card-description {

        margin: 4px 0 0;

        color: #98a2b3;

        font-size: 11px;

    }


    .operation-create-card-body {

        padding: 22px;

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

        transition:
            border-color .15s ease,
            box-shadow .15s ease;

        box-sizing: border-box;

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

        min-height: 95px;

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

        color: #c0392b;

        font-size: 11px;

        font-weight: 600;

        cursor: pointer;

    }


    /* =========================================================
       DOCUMENTOS
    ========================================================== */

    .documents-intro {

        margin-bottom: 16px;

        padding:
            13px 15px;

        border:
            1px solid #dce9f3;

        border-radius: 7px;

        background: #f4f8fb;

        color: #667085;

        font-size: 11px;

        line-height: 1.5;

    }


    .documents-intro strong {

        color: #155a91;

    }


    .documents-list {

        display: flex;

        flex-direction: column;

        gap: 12px;

    }


    .document-item {

        position: relative;

        padding:
            17px;

        border:
            1px solid #e0e6ed;

        border-radius: 8px;

        background: #fbfcfd;

    }


    .document-item-header {

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 15px;

        margin-bottom: 14px;

    }


    .document-item-title {

        display: flex;

        align-items: center;

        gap: 9px;

        color: #344054;

        font-size: 12px;

        font-weight: 700;

    }


    .document-item-number {

        width: 25px;

        height: 25px;

        border-radius: 6px;

        background: #eaf3fa;

        color: #155a91;

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 10px;

        font-weight: 700;

    }


    .document-remove {

        min-height: 30px;

        padding:
            6px 9px;

        border:
            1px solid #f0cfcb;

        border-radius: 6px;

        background: #ffffff;

        color: #c0392b;

        font-size: 10px;

        font-weight: 600;

        cursor: pointer;

    }


    .document-remove:hover {

        background: #fff4f2;

    }


    .document-grid {

        display: grid;

        grid-template-columns:
            1.3fr .7fr;

        gap: 12px;

    }


    .document-grid-bottom {

        display: grid;

        grid-template-columns:
            1fr 1fr;

        gap: 12px;

        margin-top: 12px;

    }


    .document-file {

        width: 100%;

        min-height: 40px;

        padding:
            8px 10px;

        border:
            1px solid #d8e0e8;

        border-radius: 7px;

        background: #ffffff;

        color: #475467;

        font-size: 11px;

        box-sizing: border-box;

    }


    .documents-empty {

        padding:
            25px;

        border:
            1px dashed #d7dfe8;

        border-radius: 8px;

        text-align: center;

        color: #98a2b3;

        font-size: 11px;

    }


    /* =========================================================
       FORM FOOTER
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
       ERRORES
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


        .document-grid {

            grid-template-columns: 1fr;

        }


        .document-grid-bottom {

            grid-template-columns: 1fr;

        }

    }


    @media (max-width: 700px) {

        .operation-create-header {

            flex-direction: column;

        }


        .operation-create-header .btn {

            width: 100%;

        }


        .operation-create-card-body {

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

    <div class="operation-create-breadcrumb">

        <a href="{{ route('operaciones.index') }}">
            Operaciones
        </a>

        <span>›</span>

        <span class="operation-create-breadcrumb-current">
            Nueva operación
        </span>

    </div>


    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="operation-create-header">

        <div>

            <h1 class="operation-create-title">
                Nueva operación
            </h1>

            <p class="operation-create-subtitle">
                Registra una nueva operación y su información asociada.
            </p>

        </div>


        <a
            href="{{ route('operaciones.index') }}"
            class="btn"
        >
            ← Volver a operaciones
        </a>

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
        action="{{ route('operaciones.store') }}"
        method="POST"
        enctype="multipart/form-data"
        id="operationForm"
    >

        @csrf


        {{-- =================================================
             INFORMACIÓN GENERAL
        ================================================== --}}

        <section class="operation-create-card">

            <div class="operation-create-card-header">

                <div>

                    <h2 class="operation-create-card-title">
                        Información de la operación
                    </h2>

                    <p class="operation-create-card-description">
                        Datos principales de la operación
                    </p>

                </div>

            </div>


            <div class="operation-create-card-body">

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
                                >

                                <span class="client-search-icon">
                                    ⌕
                                </span>

                            </div>


                            <input
                                type="hidden"
                                name="cliente_id"
                                id="cliente_id"
                                value="{{ old('cliente_id') }}"
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

                                            RUT:
                                            {{ $cliente->rut }}

                                        </div>

                                    </div>

                                @endforeach

                            </div>


                            <div
                                class="selected-client"
                                id="selectedClient"
                            >

                                <div class="selected-client-info">

                                    <div
                                        class="selected-client-name"
                                        id="selectedClientName"
                                    ></div>

                                    <div
                                        class="selected-client-rut"
                                        id="selectedClientRut"
                                    ></div>

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
                            value="{{ old('numero_operacion') }}"
                            placeholder="Ej. OP-00125"
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
                            value="{{ old('tipo') }}"
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
                            value="{{ old('fecha_operacion') }}"
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
                            value="{{ old('fecha_curse') }}"
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
                                {{ old('estado') === 'pendiente' ? 'selected' : '' }}
                            >
                                Pendiente
                            </option>

                            <option
                                value="en_proceso"
                                {{ old('estado') === 'en_proceso' ? 'selected' : '' }}
                            >
                                En proceso
                            </option>

                            <option
                                value="completada"
                                {{ old('estado') === 'completada' ? 'selected' : '' }}
                            >
                                Completada
                            </option>

                            <option
                                value="anulada"
                                {{ old('estado') === 'anulada' ? 'selected' : '' }}
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
                        >{{ old('descripcion') }}</textarea>

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
                        >{{ old('observaciones') }}</textarea>

                    </div>

                </div>

            </div>

        </section>


        {{-- =================================================
             DOCUMENTOS
        ================================================== --}}

        <section class="operation-create-card">

            <div class="operation-create-card-header">

                <div>

                    <h2 class="operation-create-card-title">
                        Documentos asociados
                    </h2>

                    <p class="operation-create-card-description">
                        Puedes adjuntar documentación directamente a esta operación.
                    </p>

                </div>


                <button
                    type="button"
                    class="btn btn-primary"
                    id="addDocument"
                >
                    + Agregar documento
                </button>

            </div>


            <div class="operation-create-card-body">

                <div class="documents-intro">

                    <strong>
                        Documentos opcionales.
                    </strong>

                    Puedes crear la operación sin adjuntar archivos o agregar uno o varios documentos ahora.

                    Todos los documentos quedarán asociados automáticamente a esta operación.

                </div>


                <div
                    class="documents-list"
                    id="documentsList"
                >

                    <div
                        class="documents-empty"
                        id="documentsEmpty"
                    >
                        No se han agregado documentos.
                    </div>

                </div>

            </div>

        </section>


        {{-- =================================================
             FOOTER
        ================================================== --}}

        <div class="operation-create-card">

            <div class="operation-form-footer">

                <div class="operation-form-footer-note">

                    <span class="operation-form-required">
                        *
                    </span>

                    Campos obligatorios.

                </div>


                <div class="operation-form-footer-actions">

                    <a
                        href="{{ route('operaciones.index') }}"
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

                if (
                    clienteId.value
                ) {

                    return;

                }


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

                clientSearch.value = '';

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

                        if (!clienteId.value) {

                            showClientResults();

                        }

                    }
                );


                clientSearch.addEventListener(
                    'input',
                    function () {

                        const search =
                            this.value
                                .toLowerCase()
                                .trim();


                        let visible =
                            0;


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


                        if (
                            !clienteId.value
                        ) {

                            clientResults.classList.add(
                                'show'
                            );

                        }


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
               RESTAURAR CLIENTE DESPUÉS DE VALIDACIÓN
            ================================================== */

            const oldClientId =
                clienteId.value;


            if (oldClientId) {

                const oldClient =
                    Array.from(
                        clientItems
                    ).find(
                        function (item) {

                            return (
                                item.dataset.id ===
                                oldClientId
                            );

                        }
                    );


                if (oldClient) {

                    selectClient(
                        oldClient.dataset.id,
                        oldClient.dataset.name,
                        oldClient.dataset.rut
                    );

                }

            }


            /* =================================================
               DOCUMENTOS
            ================================================== */

            const addDocument =
                document.getElementById(
                    'addDocument'
                );


            const documentsList =
                document.getElementById(
                    'documentsList'
                );


            const documentsEmpty =
                document.getElementById(
                    'documentsEmpty'
                );


            let documentIndex = 0;


            function updateEmptyState() {

                const items =
                    documentsList.querySelectorAll(
                        '.document-item'
                    );


                if (
                    items.length === 0
                ) {

                    documentsEmpty.style.display =
                        'block';

                } else {

                    documentsEmpty.style.display =
                        'none';

                }

            }


            function renumberDocuments() {

                const items =
                    documentsList.querySelectorAll(
                        '.document-item'
                    );


                items.forEach(
                    function (item, index) {

                        const number =
                            item.querySelector(
                                '.document-item-number'
                            );


                        if (number) {

                            number.textContent =
                                index + 1;

                        }

                    }
                );

            }


            function createDocument() {

                const index =
                    documentIndex++;


                const wrapper =
                    document.createElement(
                        'div'
                    );


                wrapper.className =
                    'document-item';


                wrapper.dataset.index =
                    index;


                wrapper.innerHTML = `

                    <div class="document-item-header">

                        <div class="document-item-title">

                            <span class="document-item-number">
                                1
                            </span>

                            Documento

                        </div>


                        <button
                            type="button"
                            class="document-remove"
                        >
                            Eliminar
                        </button>

                    </div>


                    <div class="document-grid">

                        <div class="operation-form-group">

                            <label class="operation-form-label">
                                Archivo
                                <span class="operation-form-required">*</span>
                            </label>

                            <input
                                type="file"
                                name="documentos[${index}][archivo]"
                                class="document-file"
                                required
                            >

                            <div class="operation-form-help">
                                Tamaño máximo: 10 MB.
                            </div>

                        </div>


                        <div class="operation-form-group">

                            <label class="operation-form-label">
                                Tipo de documento
                            </label>

                            <select
                                name="documentos[${index}][tipo]"
                                class="operation-form-control"
                            >

                                <option value="">
                                    Seleccionar tipo
                                </option>

                                <option value="factura">
                                    Factura
                                </option>

                                <option value="guia_despacho">
                                    Guía de despacho
                                </option>

                                <option value="contrato">
                                    Contrato
                                </option>

                                <option value="orden_compra">
                                    Orden de compra
                                </option>

                                <option value="respaldo">
                                    Respaldo
                                </option>

                                <option value="otro">
                                    Otro
                                </option>

                            </select>

                        </div>

                    </div>


                    <div class="document-grid-bottom">

                        <div class="operation-form-group">

                            <label class="operation-form-label">
                                Descripción
                            </label>

                            <input
                                type="text"
                                name="documentos[${index}][descripcion]"
                                class="operation-form-control"
                                placeholder="Descripción del documento"
                            >

                        </div>


                        <div class="operation-form-group">

                            <label class="operation-form-label">
                                Observaciones
                            </label>

                            <input
                                type="text"
                                name="documentos[${index}][observaciones]"
                                class="operation-form-control"
                                placeholder="Observaciones"
                            >

                        </div>

                    </div>

                `;


                documentsList.appendChild(
                    wrapper
                );


                const removeButton =
                    wrapper.querySelector(
                        '.document-remove'
                    );


                removeButton.addEventListener(
                    'click',
                    function () {

                        wrapper.remove();

                        renumberDocuments();

                        updateEmptyState();

                    }
                );


                updateEmptyState();

                renumberDocuments();

            }


            if (addDocument) {

                addDocument.addEventListener(
                    'click',
                    function () {

                        createDocument();

                    }
                );

            }


            updateEmptyState();


            /* =================================================
               VALIDACIÓN CLIENTE
            ================================================== */

            const operationForm =
                document.getElementById(
                    'operationForm'
                );


            if (operationForm) {

                operationForm.addEventListener(
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

                            return;

                        }


                        const documentItems =
                            documentsList.querySelectorAll(
                                '.document-item'
                            );


                        let invalidDocument =
                            false;


                        documentItems.forEach(
                            function (item) {

                                const file =
                                    item.querySelector(
                                        'input[type="file"]'
                                    );


                                if (
                                    !file ||
                                    !file.files.length
                                ) {

                                    invalidDocument =
                                        true;

                                }

                            }
                        );


                        if (
                            invalidDocument
                        ) {

                            event.preventDefault();

                            alert(
                                'Cada documento agregado debe tener un archivo seleccionado.'
                            );

                        }

                    }
                );

            }

        }
    );

</script>

@endpush