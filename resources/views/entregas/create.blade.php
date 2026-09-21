@extends('layouts.app')

@section('title', 'Nueva entrega')

@section('topbar_title', 'Gestión de entregas')

@push('styles')

<style>

    /* =========================================================
       HEADER
    ========================================================== */

    .delivery-form-header {

        display: flex;

        align-items: flex-start;

        justify-content: space-between;

        gap: 20px;

        margin-bottom: 24px;

    }

    .delivery-form-title {

        margin: 0;

        color: #172033;

        font-size: 27px;

        line-height: 1.2;

        font-weight: 700;

        letter-spacing: -.025em;

    }

    .delivery-form-subtitle {

        margin: 7px 0 0;

        color: #667085;

        font-size: 13px;

    }

    .delivery-form-back {

        display: inline-flex;

        align-items: center;

        justify-content: center;

        min-height: 37px;

        padding: 8px 14px;

        border: 1px solid #dce3eb;

        border-radius: 6px;

        background: #ffffff;

        color: #344054;

        font-size: 10px;

        font-weight: 600;

        text-decoration: none;

        transition:
            background .12s ease,
            border-color .12s ease,
            color .12s ease;

    }

    .delivery-form-back:hover {

        background: #f5f8fb;

        border-color: #cbd7e3;

        color: #155a91;

    }


    /* =========================================================
       CARD
    ========================================================== */

    .delivery-form-card {

        background: #ffffff;

        border: 1px solid #e2e8f0;

        border-radius: 10px;

        box-shadow:
            0 2px 8px rgba(16,47,80,.05);

        overflow: hidden;

    }

    .delivery-form-section {

        padding: 22px 20px;

        border-bottom: 1px solid #edf1f5;

    }

    .delivery-form-section:last-of-type {

        border-bottom: none;

    }

    .delivery-form-section-title {

        margin: 0;

        color: #172033;

        font-size: 14px;

        font-weight: 700;

    }

    .delivery-form-section-description {

        margin: 4px 0 18px;

        color: #98a2b3;

        font-size: 10px;

    }


    /* =========================================================
       ERRORES
    ========================================================== */

    .delivery-form-alert {

        margin-bottom: 18px;

        padding: 12px 14px;

        border: 1px solid #e9c1bc;

        border-radius: 7px;

        background: #fff5f3;

        color: #a52f26;

        font-size: 11px;

    }

    .delivery-form-alert strong {

        display: block;

        margin-bottom: 5px;

    }

    .delivery-form-alert ul {

        margin: 6px 0 0;

        padding-left: 18px;

    }


    /* =========================================================
       SIN OPERACIONES
    ========================================================== */

    .delivery-no-operations {

        padding: 15px 17px;

        border: 1px solid #f0d9aa;

        border-radius: 8px;

        background: #fffaf2;

        color: #8a5600;

        font-size: 11px;

        line-height: 1.5;

    }

    .delivery-no-operations strong {

        display: block;

        margin-bottom: 4px;

        color: #a15c00;

    }


    /* =========================================================
       FORMULARIO
    ========================================================== */

    .delivery-form-grid {

        display: grid;

        grid-template-columns:
            repeat(2, minmax(0, 1fr));

        gap: 18px 22px;

    }

    .delivery-form-group {

        min-width: 0;

    }

    .delivery-form-group-full {

        grid-column: 1 / -1;

    }

    .delivery-form-label {

        display: block;

        margin-bottom: 7px;

        color: #344054;

        font-size: 10px;

        font-weight: 600;

    }

    .delivery-form-required {

        color: #c0392b;

    }

    .delivery-form-control {

        width: 100%;

        min-height: 39px;

        padding: 9px 11px;

        box-sizing: border-box;

        border: 1px solid #d8e0e8;

        border-radius: 7px;

        background: #ffffff;

        color: #344054;

        font-family: inherit;

        font-size: 11px;

        outline: none;

        transition:
            border-color .12s ease,
            box-shadow .12s ease;

    }

    .delivery-form-control:focus {

        border-color: #155a91;

        box-shadow:
            0 0 0 3px rgba(21,90,145,.08);

    }

    textarea.delivery-form-control {

        min-height: 100px;

        resize: vertical;

    }

    .delivery-form-help {

        margin-top: 5px;

        color: #98a2b3;

        font-size: 9px;

        line-height: 1.4;

    }

    .delivery-form-error {

        margin-top: 5px;

        color: #a52f26;

        font-size: 9px;

    }


    /* =========================================================
       BUSCADOR OPERACIÓN
    ========================================================== */

    .delivery-operation-search {

        position: relative;

    }

    .delivery-operation-search-icon {

        position: absolute;

        right: 12px;

        top: 50%;

        transform: translateY(-50%);

        color: #98a2b3;

        font-size: 14px;

        pointer-events: none;

    }

    .delivery-operation-search input {

        padding-right: 36px;

    }

    .delivery-operation-results {

        position: absolute;

        z-index: 50;

        top: calc(100% + 5px);

        left: 0;

        right: 0;

        max-height: 260px;

        overflow-y: auto;

        display: none;

        border: 1px solid #d8e0e8;

        border-radius: 7px;

        background: #ffffff;

        box-shadow:
            0 8px 20px rgba(16,47,80,.10);

    }

    .delivery-operation-result {

        width: 100%;

        padding: 11px 13px;

        border: none;

        border-bottom: 1px solid #edf1f5;

        background: #ffffff;

        text-align: left;

        cursor: pointer;

        font-family: inherit;

    }

    .delivery-operation-result:last-child {

        border-bottom: none;

    }

    .delivery-operation-result:hover {

        background: #f7fafc;

    }

    .delivery-operation-number {

        display: block;

        color: #172033;

        font-size: 11px;

        font-weight: 700;

    }

    .delivery-operation-client {

        display: block;

        margin-top: 3px;

        color: #667085;

        font-size: 9px;

    }

    .delivery-operation-empty {

        padding: 12px 13px;

        color: #98a2b3;

        font-size: 10px;

    }

    .delivery-operation-selected {

        display: none;

        margin-top: 8px;

        padding: 10px 12px;

        border: 1px solid #d4e5f2;

        border-radius: 7px;

        background: #f7fbfe;

        color: #344054;

        font-size: 10px;

    }

    .delivery-operation-selected strong {

        color: #155a91;

    }

    .delivery-operation-change {

        margin-left: 7px;

        padding: 0;

        border: none;

        background: transparent;

        color: #155a91;

        font-family: inherit;

        font-size: 9px;

        font-weight: 600;

        cursor: pointer;

    }

    .delivery-operation-change:hover {

        text-decoration: underline;

    }


    /* =========================================================
       FOOTER
    ========================================================== */

    .delivery-form-footer {

        min-height: 68px;

        padding: 13px 20px;

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 15px;

        border-top: 1px solid #edf1f5;

        background: #fbfcfd;

    }

    .delivery-form-footer-note {

        color: #98a2b3;

        font-size: 9px;

    }

    .delivery-form-footer-actions {

        display: flex;

        align-items: center;

        gap: 8px;

    }

    .delivery-form-button {

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

    .delivery-form-button-secondary {

        border: 1px solid #dce3eb;

        background: #ffffff;

        color: #344054;

    }

    .delivery-form-button-secondary:hover {

        background: #f5f8fb;

        border-color: #cbd7e3;

        color: #155a91;

    }

    .delivery-form-button-primary {

        border: 1px solid #155a91;

        background: #155a91;

        color: #ffffff;

    }

    .delivery-form-button-primary:hover {

        background: #124d7d;

        border-color: #124d7d;

        color: #ffffff;

    }


    /* =========================================================
       RESPONSIVE
    ========================================================== */

    @media (max-width: 800px) {

        .delivery-form-header {

            flex-direction: column;

        }

        .delivery-form-back {

            width: 100%;

        }

        .delivery-form-grid {

            grid-template-columns: 1fr;

        }

        .delivery-form-group-full {

            grid-column: auto;

        }

        .delivery-form-footer {

            align-items: stretch;

            flex-direction: column;

        }

        .delivery-form-footer-actions {

            width: 100%;

            flex-direction: column-reverse;

        }

        .delivery-form-footer-actions a,
        .delivery-form-footer-actions button {

            width: 100%;

        }

    }

</style>

@endpush


@section('content')

    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="delivery-form-header">

        <div>

            <h1 class="delivery-form-title">
                Nueva entrega
            </h1>

            <p class="delivery-form-subtitle">
                Registra una entrega asociada a una operación.
            </p>

        </div>

        <a
            href="{{ route('entregas.index') }}"
            class="delivery-form-back"
        >
            ← Volver a entregas
        </a>

    </div>


    {{-- =====================================================
         ERRORES
    ====================================================== --}}

    @if($errors->any())

        <div class="delivery-form-alert">

            <strong>
                No se pudo guardar la entrega.
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
         SIN OPERACIONES
    ====================================================== --}}

    @if($operaciones->count() === 0)

        <div class="delivery-form-card">

            <section class="delivery-form-section">

                <div class="delivery-no-operations">

                    <strong>
                        No hay operaciones registradas.
                    </strong>

                    Para crear una entrega primero debes registrar una operación.

                </div>

            </section>


            <div class="delivery-form-footer">

                <div class="delivery-form-footer-note">
                    Registra una operación antes de continuar.
                </div>

                <div class="delivery-form-footer-actions">

                    <a
                        href="{{ route('entregas.index') }}"
                        class="delivery-form-button delivery-form-button-secondary"
                    >
                        Volver
                    </a>

                    <a
                        href="{{ route('operaciones.create') }}"
                        class="delivery-form-button delivery-form-button-primary"
                    >
                        Registrar operación
                    </a>

                </div>

            </div>

        </div>

    @else


        {{-- =====================================================
             FORMULARIO
        ====================================================== --}}

        <form
            action="{{ route('entregas.store') }}"
            method="POST"
            id="deliveryCreateForm"
        >

            @csrf


            <div class="delivery-form-card">


                {{-- =================================================
                     OPERACIÓN
                ================================================== --}}

                <section class="delivery-form-section">

                    <h2 class="delivery-form-section-title">
                        Operación asociada
                    </h2>

                    <p class="delivery-form-section-description">
                        Selecciona la operación a la que pertenece esta entrega.
                    </p>


                    <div class="delivery-form-grid">

                        <div class="delivery-form-group delivery-form-group-full">

                            <label
                                for="busqueda_operacion"
                                class="delivery-form-label"
                            >
                                Operación
                                <span class="delivery-form-required">*</span>
                            </label>


                            <div class="delivery-operation-search">

                                <input
                                    type="text"
                                    id="busqueda_operacion"
                                    class="delivery-form-control"
                                    placeholder="Buscar por número de operación o cliente..."
                                    autocomplete="off"
                                >

                                <span class="delivery-operation-search-icon">
                                    ⌕
                                </span>


                                <div
                                    id="resultados_operaciones"
                                    class="delivery-operation-results"
                                >

                                    @foreach($operaciones as $operacion)

                                        <button
                                            type="button"
                                            class="delivery-operation-result"
                                            data-id="{{ $operacion->id }}"
                                            data-numero="{{ $operacion->numero_operacion }}"
                                            data-cliente="{{ $operacion->cliente?->razon_social ?? 'Sin cliente' }}"
                                        >

                                            <span class="delivery-operation-number">
                                                {{ $operacion->numero_operacion }}
                                            </span>

                                            <span class="delivery-operation-client">

                                                {{ $operacion->cliente?->razon_social ?? 'Sin cliente' }}

                                                @if($operacion->fecha_curse)

                                                    · Curse:
                                                    {{ $operacion->fecha_curse->format('d/m/Y') }}

                                                @endif

                                            </span>

                                        </button>

                                    @endforeach

                                </div>

                            </div>


                            <input
                                type="hidden"
                                id="operacion_id"
                                name="operacion_id"
                                value="{{ old('operacion_id') }}"
                                required
                            >


                            <div
                                id="operacion_seleccionada"
                                class="delivery-operation-selected"
                            >

                                <strong>
                                    Operación seleccionada:
                                </strong>

                                <span id="texto_operacion_seleccionada"></span>

                                <button
                                    type="button"
                                    id="limpiar_operacion"
                                    class="delivery-operation-change"
                                >
                                    Cambiar
                                </button>

                            </div>


                            <div class="delivery-form-help">
                                Busca por número de operación o nombre del cliente.
                            </div>


                            @error('operacion_id')

                                <div class="delivery-form-error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                    </div>

                </section>


                {{-- =================================================
                     DATOS DE LA ENTREGA
                ================================================== --}}

                <section class="delivery-form-section">

                    <h2 class="delivery-form-section-title">
                        Información de la entrega
                    </h2>

                    <p class="delivery-form-section-description">
                        Ingresa los datos principales de la entrega.
                    </p>


                    <div class="delivery-form-grid">


                        {{-- NÚMERO --}}

                        <div class="delivery-form-group">

                            <label
                                for="numero_entrega"
                                class="delivery-form-label"
                            >
                                Número de entrega
                                <span class="delivery-form-required">*</span>
                            </label>

                            <input
                                type="text"
                                id="numero_entrega"
                                name="numero_entrega"
                                class="delivery-form-control"
                                value="{{ old('numero_entrega') }}"
                                maxlength="255"
                                required
                                placeholder="Ej. ENT-001"
                            >

                            @error('numero_entrega')

                                <div class="delivery-form-error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- FECHA --}}

                        <div class="delivery-form-group">

                            <label
                                for="fecha_entrega"
                                class="delivery-form-label"
                            >
                                Fecha de entrega
                            </label>

                            <input
                                type="date"
                                id="fecha_entrega"
                                name="fecha_entrega"
                                class="delivery-form-control"
                                value="{{ old('fecha_entrega') }}"
                            >

                            @error('fecha_entrega')

                                <div class="delivery-form-error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- ESTADO --}}

                        <div class="delivery-form-group">

                            <label
                                for="estado"
                                class="delivery-form-label"
                            >
                                Estado
                                <span class="delivery-form-required">*</span>
                            </label>

                            <select
                                id="estado"
                                name="estado"
                                class="delivery-form-control"
                                required
                            >

                                <option
                                    value="pendiente"
                                    {{ old('estado', 'pendiente') === 'pendiente' ? 'selected' : '' }}
                                >
                                    Pendiente
                                </option>

                                <option
                                    value="en_transito"
                                    {{ old('estado') === 'en_transito' ? 'selected' : '' }}
                                >
                                    En tránsito
                                </option>

                                <option
                                    value="entregada"
                                    {{ old('estado') === 'entregada' ? 'selected' : '' }}
                                >
                                    Entregada
                                </option>

                                <option
                                    value="rechazada"
                                    {{ old('estado') === 'rechazada' ? 'selected' : '' }}
                                >
                                    Rechazada
                                </option>

                            </select>

                            @error('estado')

                                <div class="delivery-form-error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- DESCRIPCIÓN --}}

                        <div class="delivery-form-group delivery-form-group-full">

                            <label
                                for="descripcion"
                                class="delivery-form-label"
                            >
                                Descripción
                            </label>

                            <textarea
                                id="descripcion"
                                name="descripcion"
                                class="delivery-form-control"
                                placeholder="Descripción de la entrega..."
                            >{{ old('descripcion') }}</textarea>

                            @error('descripcion')

                                <div class="delivery-form-error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- OBSERVACIONES --}}

                        <div class="delivery-form-group delivery-form-group-full">

                            <label
                                for="observaciones"
                                class="delivery-form-label"
                            >
                                Observaciones
                            </label>

                            <textarea
                                id="observaciones"
                                name="observaciones"
                                class="delivery-form-control"
                                placeholder="Observaciones adicionales..."
                            >{{ old('observaciones') }}</textarea>

                            @error('observaciones')

                                <div class="delivery-form-error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                    </div>

                </section>


                {{-- =================================================
                     FOOTER
                ================================================== --}}

                <div class="delivery-form-footer">

                    <div class="delivery-form-footer-note">
                        Los campos marcados con * son obligatorios.
                    </div>

                    <div class="delivery-form-footer-actions">

                        <a
                            href="{{ route('entregas.index') }}"
                            class="delivery-form-button delivery-form-button-secondary"
                        >
                            Cancelar
                        </a>

                        <button
                            type="submit"
                            class="delivery-form-button delivery-form-button-primary"
                        >
                            Guardar entrega
                        </button>

                    </div>

                </div>

            </div>

        </form>

    @endif

@endsection


@push('scripts')

<script>

    document.addEventListener(
        'DOMContentLoaded',
        function () {

            const buscador =
                document.getElementById(
                    'busqueda_operacion'
                );

            const resultados =
                document.getElementById(
                    'resultados_operaciones'
                );

            const operacionId =
                document.getElementById(
                    'operacion_id'
                );

            const operacionSeleccionada =
                document.getElementById(
                    'operacion_seleccionada'
                );

            const textoSeleccionada =
                document.getElementById(
                    'texto_operacion_seleccionada'
                );

            const limpiar =
                document.getElementById(
                    'limpiar_operacion'
                );

            const opciones =
                document.querySelectorAll(
                    '.delivery-operation-result'
                );

            const formulario =
                document.getElementById(
                    'deliveryCreateForm'
                );


            if (
                !buscador ||
                !resultados ||
                !operacionId
            ) {

                return;

            }


            function mostrarResultados() {

                const texto =
                    buscador.value
                        .toLowerCase()
                        .trim();


                let cantidad = 0;


                opciones.forEach(
                    function (opcion) {

                        const numero =
                            (
                                opcion.dataset.numero ||
                                ''
                            ).toLowerCase();

                        const cliente =
                            (
                                opcion.dataset.cliente ||
                                ''
                            ).toLowerCase();


                        const coincide =
                            numero.includes(texto) ||
                            cliente.includes(texto);


                        opcion.style.display =
                            coincide
                                ? 'block'
                                : 'none';


                        if (coincide) {

                            cantidad++;

                        }

                    }
                );


                const anterior =
                    resultados.querySelector(
                        '.delivery-operation-empty'
                    );


                if (anterior) {

                    anterior.remove();

                }


                if (cantidad === 0) {

                    const sinResultados =
                        document.createElement(
                            'div'
                        );


                    sinResultados.className =
                        'delivery-operation-empty';


                    sinResultados.textContent =
                        'No se encontraron operaciones.';


                    resultados.appendChild(
                        sinResultados
                    );

                }


                resultados.style.display =
                    'block';

            }


            buscador.addEventListener(
                'focus',
                function () {

                    mostrarResultados();

                }
            );


            buscador.addEventListener(
                'input',
                function () {

                    operacionId.value = '';

                    if (operacionSeleccionada) {

                        operacionSeleccionada.style.display =
                            'none';

                    }

                    mostrarResultados();

                }
            );


            opciones.forEach(
                function (opcion) {

                    opcion.addEventListener(
                        'click',
                        function () {

                            const id =
                                opcion.dataset.id;

                            const numero =
                                opcion.dataset.numero;

                            const cliente =
                                opcion.dataset.cliente;


                            operacionId.value =
                                id;


                            buscador.value =
                                numero +
                                ' - ' +
                                cliente;


                            if (
                                textoSeleccionada &&
                                operacionSeleccionada
                            ) {

                                textoSeleccionada.textContent =
                                    numero +
                                    ' - ' +
                                    cliente;


                                operacionSeleccionada.style.display =
                                    'block';

                            }


                            resultados.style.display =
                                'none';

                        }
                    );

                }
            );


            if (limpiar) {

                limpiar.addEventListener(
                    'click',
                    function () {

                        operacionId.value = '';

                        buscador.value = '';


                        if (operacionSeleccionada) {

                            operacionSeleccionada.style.display =
                                'none';

                        }


                        buscador.focus();

                        mostrarResultados();

                    }
                );

            }


            document.addEventListener(
                'click',
                function (evento) {

                    if (
                        !buscador.contains(evento.target) &&
                        !resultados.contains(evento.target)
                    ) {

                        resultados.style.display =
                            'none';

                    }

                }
            );


            /*
             * Recuperar operación después
             * de una validación fallida.
             */

            const valorAnterior =
                operacionId.value;


            if (valorAnterior) {

                const opcionAnterior =
                    document.querySelector(
                        '.delivery-operation-result[data-id="' +
                        valorAnterior +
                        '"]'
                    );


                if (opcionAnterior) {

                    const numero =
                        opcionAnterior.dataset.numero;

                    const cliente =
                        opcionAnterior.dataset.cliente;


                    buscador.value =
                        numero +
                        ' - ' +
                        cliente;


                    if (
                        textoSeleccionada &&
                        operacionSeleccionada
                    ) {

                        textoSeleccionada.textContent =
                            numero +
                            ' - ' +
                            cliente;


                        operacionSeleccionada.style.display =
                            'block';

                    }

                }

            }


            /*
             * Evitar guardar sin operación.
             */

            if (formulario) {

                formulario.addEventListener(
                    'submit',
                    function (evento) {

                        if (!operacionId.value) {

                            evento.preventDefault();


                            alert(
                                'Debes seleccionar una operación.'
                            );


                            buscador.focus();

                        }

                    }
                );

            }

        }
    );

</script>

@endpush