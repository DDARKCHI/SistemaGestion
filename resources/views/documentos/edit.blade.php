@extends('layouts.app')

@section('title', 'Editar documento')

@section('content')

@php
    $operacionActual = null;

    if ($documento->documentable instanceof \App\Models\Operacion) {
        $operacionActual = $documento->documentable;
    }

    $operacionesJson = $operaciones->map(
        fn ($operacion) => [
            'id' => $operacion->id,
            'numero' => $operacion->numero_operacion,
            'cliente' => $operacion->cliente?->razon_social ?? '',
        ]
    )->values()->toJson();
@endphp


<div class="page-header">

    <div class="header-info">

        <span class="page-kicker">
            DOCUMENTOS
        </span>

        <h1>Editar documento</h1>

        <p>
            Modifica la información o reemplaza el archivo asociado.
        </p>

    </div>


    <a
        href="{{ route('documentos.show', $documento) }}"
        class="btn btn-secondary"
    >
        <span class="btn-icon">←</span>
        Volver
    </a>

</div>


@if($errors->any())

    <div class="alert alert-error">

        <div class="alert-title">
            No se pudo actualizar el documento
        </div>

        <ul>

            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach

        </ul>

    </div>

@endif


<form
    action="{{ route('documentos.update', $documento) }}"
    method="POST"
    enctype="multipart/form-data"
>

    @csrf
    @method('PUT')


    {{-- INFORMACIÓN PRINCIPAL --}}

    <div class="main-grid">


        {{-- ASOCIACIÓN --}}

        <section class="panel association-panel">

            <div class="panel-header">

                <div>

                    <span class="panel-kicker">
                        ASOCIACIÓN
                    </span>

                    <h2>Registro asociado</h2>

                </div>

            </div>


            <div class="field">

                <label for="operacion_busqueda">
                    Operación
                    <span class="required">*</span>
                </label>


                <div class="search-select">

                    <div class="input-wrapper">

                        <input
                            type="text"
                            id="operacion_busqueda"
                            class="form-control"
                            placeholder="Buscar operación o cliente..."
                            autocomplete="off"
                            value="{{ $operacionActual
                                ? $operacionActual->numero_operacion
                                    . ' — '
                                    . ($operacionActual->cliente?->razon_social ?? '')
                                : ''
                            }}"
                        >

                        <span class="search-icon">
                            ⌕
                        </span>

                    </div>


                    <input
                        type="hidden"
                        name="operacion_id"
                        id="operacion_id"
                        value="{{ old(
                            'operacion_id',
                            $operacionActual?->id
                        ) }}"
                    >


                    <div
                        id="operaciones_resultados"
                        class="search-results"
                    ></div>

                </div>


                @error('operacion_id')

                    <div class="field-error">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            @if($operacionActual)

                <div class="selected-operation">

                    <div class="selected-icon">
                        OP
                    </div>


                    <div class="selected-info">

                        <span class="selected-label">
                            OPERACIÓN ACTUAL
                        </span>

                        <strong>
                            #{{ $operacionActual->numero_operacion }}
                        </strong>

                        <span class="selected-client">
                            {{ $operacionActual->cliente?->razon_social ?? 'Sin cliente' }}
                        </span>

                    </div>

                </div>

            @else

                <div class="no-operation">

                    <span class="no-operation-icon">
                        !
                    </span>

                    <div>
                        <strong>
                            Sin operación asociada
                        </strong>

                        <span>
                            Selecciona una operación para continuar.
                        </span>
                    </div>

                </div>

            @endif

        </section>


        {{-- INFORMACIÓN --}}

        <section class="panel information-panel">

            <div class="panel-header">

                <div>

                    <span class="panel-kicker">
                        INFORMACIÓN
                    </span>

                    <h2>Datos del documento</h2>

                </div>

            </div>


            <div class="field">

                <label for="tipo">
                    Tipo de documento
                </label>

                <input
                    type="text"
                    name="tipo"
                    id="tipo"
                    class="form-control"
                    value="{{ old('tipo', $documento->tipo) }}"
                    placeholder="Ej: Factura, contrato, respaldo..."
                >

                @error('tipo')

                    <div class="field-error">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            <div class="field">

                <label for="descripcion">
                    Descripción
                </label>

                <textarea
                    name="descripcion"
                    id="descripcion"
                    class="form-control textarea"
                    rows="3"
                    placeholder="Describe brevemente el documento..."
                >{{ old('descripcion', $documento->descripcion) }}</textarea>

                @error('descripcion')

                    <div class="field-error">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            <div class="field field-last">

                <label for="observaciones">
                    Observaciones
                </label>

                <textarea
                    name="observaciones"
                    id="observaciones"
                    class="form-control textarea"
                    rows="3"
                    placeholder="Observaciones adicionales..."
                >{{ old('observaciones', $documento->observaciones) }}</textarea>

                @error('observaciones')

                    <div class="field-error">
                        {{ $message }}
                    </div>

                @enderror

            </div>

        </section>

    </div>


    {{-- ARCHIVO --}}

    <section class="panel file-panel">

        <div class="panel-header file-header">

            <div>

                <span class="panel-kicker">
                    ARCHIVO
                </span>

                <h2>Archivo almacenado</h2>

            </div>

        </div>


        <div class="current-file">

            <div class="file-icon">
                FILE
            </div>


            <div class="file-information">

                <strong>
                    {{ $documento->nombre }}
                </strong>

                <span>

                    {{ $documento->mime_type ?: 'Archivo' }}

                    @if($documento->tamano)

                        <span class="separator">·</span>

                        {{ number_format(
                            $documento->tamano / 1024,
                            1,
                            ',',
                            '.'
                        ) }}
                        KB

                    @endif

                </span>

            </div>


            @if($documento->ruta)

                <a
                    href="{{ asset('storage/' . $documento->ruta) }}"
                    target="_blank"
                    class="file-link"
                >
                    Abrir archivo
                </a>

            @endif

        </div>


        <div class="replace-file">

            <div class="replace-title">

                <label for="archivo">
                    Reemplazar archivo
                </label>

                <span>
                    Opcional
                </span>

            </div>


            <input
                type="file"
                name="archivo"
                id="archivo"
                class="file-input"
            >


            <small>
                Déjalo vacío para conservar el archivo actual.
                Tamaño máximo: 10 MB.
            </small>


            @error('archivo')

                <div class="field-error">
                    {{ $message }}
                </div>

            @enderror

        </div>

    </section>


    {{-- ACCIONES --}}

    <div class="form-actions">

        <a
            href="{{ route('documentos.show', $documento) }}"
            class="btn btn-secondary"
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

</form>


<script>

    const operaciones = {!! $operacionesJson !!};

    const inputBusqueda =
        document.getElementById('operacion_busqueda');

    const inputOperacion =
        document.getElementById('operacion_id');

    const resultados =
        document.getElementById('operaciones_resultados');


    function mostrarOperaciones(texto = '') {

        const busqueda =
            texto.trim().toLowerCase();


        const filtradas =
            operaciones
                .filter(function (operacion) {

                    const numero =
                        String(
                            operacion.numero || ''
                        ).toLowerCase();


                    const cliente =
                        String(
                            operacion.cliente || ''
                        ).toLowerCase();


                    return (
                        numero.includes(busqueda) ||
                        cliente.includes(busqueda)
                    );

                })
                .slice(0, 10);


        resultados.innerHTML = '';


        if (filtradas.length === 0) {

            resultados.innerHTML = `
                <div class="no-results">
                    No se encontraron operaciones.
                </div>
            `;

            resultados.classList.add('visible');

            return;
        }


        filtradas.forEach(function (operacion) {

            const item =
                document.createElement('button');


            item.type = 'button';

            item.className =
                'search-result-item';


            item.innerHTML = `
                <span class="result-number">
                    ${escapeHtml(
                        operacion.numero || ''
                    )}
                </span>

                <span class="result-client">
                    ${escapeHtml(
                        operacion.cliente || 'Sin cliente'
                    )}
                </span>
            `;


            item.addEventListener(
                'click',
                function () {

                    inputOperacion.value =
                        operacion.id;


                    inputBusqueda.value =
                        `${operacion.numero} — ${operacion.cliente}`;


                    resultados.classList.remove(
                        'visible'
                    );

                }
            );


            resultados.appendChild(item);

        });


        resultados.classList.add('visible');

    }


    inputBusqueda.addEventListener(
        'focus',
        function () {

            mostrarOperaciones(
                inputBusqueda.value
            );

        }
    );


    inputBusqueda.addEventListener(
        'input',
        function () {

            inputOperacion.value = '';

            mostrarOperaciones(
                inputBusqueda.value
            );

        }
    );


    document.addEventListener(
        'click',
        function (event) {

            if (
                !event.target.closest(
                    '.search-select'
                )
            ) {

                resultados.classList.remove(
                    'visible'
                );

            }

        }
    );


    function escapeHtml(value) {

        return String(value)
            .replaceAll('&', '&amp;')
            .replaceAll('<', '&lt;')
            .replaceAll('>', '&gt;')
            .replaceAll('"', '&quot;')
            .replaceAll("'", '&#039;');

    }

</script>


<style>

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        gap: 20px;
        margin-bottom: 22px;
    }


    .header-info {
        min-width: 0;
    }


    .page-kicker,
    .panel-kicker {
        display: block;
        color: #55718c;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: .09em;
    }


    .page-header h1 {
        margin: 4px 0 4px;
        color: #172033;
        font-size: 25px;
        font-weight: 700;
        line-height: 1.2;
    }


    .page-header p {
        margin: 0;
        color: #64748b;
        font-size: 13px;
    }


    .main-grid {
        display: grid;
        grid-template-columns: minmax(300px, .82fr) minmax(0, 1.18fr);
        gap: 18px;
        align-items: start;
    }


    .panel {
        background: #ffffff;
        border: 1px solid #dfe6ed;
        border-radius: 9px;
        padding: 20px;
        box-shadow: 0 2px 9px rgba(15, 23, 42, .035);
    }


    .association-panel,
    .information-panel {
        min-height: 0;
    }


    .panel-header {
        display: flex;
        align-items: center;
        padding-bottom: 13px;
        margin-bottom: 16px;
        border-bottom: 1px solid #e8edf2;
    }


    .panel-header h2 {
        margin: 3px 0 0;
        color: #172033;
        font-size: 16px;
        font-weight: 700;
    }


    .field {
        margin-bottom: 15px;
    }


    .field-last {
        margin-bottom: 0;
    }


    .field label,
    .replace-title label {
        display: block;
        margin-bottom: 6px;
        color: #334155;
        font-size: 12px;
        font-weight: 700;
    }


    .required {
        color: #dc2626;
    }


    .input-wrapper {
        position: relative;
    }


    .form-control {
        width: 100%;
        box-sizing: border-box;
        border: 1px solid #d5dee7;
        border-radius: 7px;
        padding: 10px 38px 10px 11px;
        background: #ffffff;
        color: #273449;
        font-family: inherit;
        font-size: 13px;
        outline: none;
        transition: border-color .18s ease,
                    box-shadow .18s ease;
    }


    .form-control::placeholder {
        color: #9aa8b7;
    }


    .form-control:focus {
        border-color: #4d82a7;
        box-shadow: 0 0 0 3px rgba(21, 90, 145, .07);
    }


    .textarea {
        min-height: 76px;
        resize: vertical;
        line-height: 1.45;
        padding-right: 11px;
    }


    .search-icon {
        position: absolute;
        top: 50%;
        right: 12px;
        transform: translateY(-50%);
        color: #8293a4;
        font-size: 19px;
        pointer-events: none;
    }


    .search-select {
        position: relative;
    }


    .search-results {
        display: none;
        position: absolute;
        z-index: 50;
        top: calc(100% + 5px);
        left: 0;
        right: 0;
        max-height: 220px;
        overflow-y: auto;
        background: #ffffff;
        border: 1px solid #d8e0e8;
        border-radius: 7px;
        box-shadow: 0 8px 22px rgba(15, 23, 42, .12);
    }


    .search-results.visible {
        display: block;
    }


    .search-result-item {
        width: 100%;
        display: flex;
        flex-direction: column;
        gap: 2px;
        padding: 10px 12px;
        border: 0;
        border-bottom: 1px solid #edf1f4;
        background: #ffffff;
        text-align: left;
        cursor: pointer;
    }


    .search-result-item:last-child {
        border-bottom: 0;
    }


    .search-result-item:hover {
        background: #f5f8fb;
    }


    .result-number {
        color: #172033;
        font-size: 12px;
        font-weight: 700;
    }


    .result-client {
        color: #718096;
        font-size: 11px;
    }


    .no-results {
        padding: 14px;
        color: #94a3b8;
        font-size: 12px;
        text-align: center;
    }


    .selected-operation {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-top: 17px;
        padding: 12px;
        background: #f5f8fb;
        border: 1px solid #e2e9ef;
        border-radius: 7px;
    }


    .selected-icon {
        width: 38px;
        height: 38px;
        flex: 0 0 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 7px;
        background: #e5eef5;
        color: #155a91;
        font-size: 9px;
        font-weight: 800;
        letter-spacing: .04em;
    }


    .selected-info {
        display: flex;
        flex-direction: column;
        gap: 2px;
        min-width: 0;
    }


    .selected-label {
        color: #91a1b1;
        font-size: 8px;
        font-weight: 800;
        letter-spacing: .07em;
    }


    .selected-info strong {
        color: #1f3045;
        font-size: 13px;
    }


    .selected-client {
        color: #718096;
        font-size: 11px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }


    .no-operation {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: 17px;
        padding: 11px;
        background: #fafbfc;
        border: 1px solid #e5eaf0;
        border-radius: 7px;
    }


    .no-operation-icon {
        width: 30px;
        height: 30px;
        flex: 0 0 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #fff4e8;
        color: #c26a20;
        font-size: 11px;
        font-weight: 800;
    }


    .no-operation div {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }


    .no-operation strong {
        color: #475569;
        font-size: 12px;
    }


    .no-operation span:not(.no-operation-icon) {
        color: #94a3b8;
        font-size: 10px;
    }


    .field-error {
        margin-top: 5px;
        color: #dc2626;
        font-size: 11px;
    }


    .file-panel {
        margin-top: 18px;
    }


    .file-header {
        margin-bottom: 14px;
    }


    .current-file {
        display: flex;
        align-items: center;
        gap: 13px;
        padding: 12px;
        background: #f7f9fb;
        border: 1px solid #e3e9ef;
        border-radius: 7px;
    }


    .file-icon {
        width: 40px;
        height: 40px;
        flex: 0 0 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 7px;
        background: #e5eef5;
        color: #155a91;
        font-size: 9px;
        font-weight: 800;
        letter-spacing: .04em;
    }


    .file-information {
        flex: 1;
        min-width: 0;
        display: flex;
        flex-direction: column;
        gap: 3px;
    }


    .file-information strong {
        overflow: hidden;
        color: #273449;
        font-size: 12px;
        font-weight: 700;
        text-overflow: ellipsis;
        white-space: nowrap;
    }


    .file-information span {
        color: #94a3b8;
        font-size: 10px;
    }


    .separator {
        margin: 0 3px;
    }


    .file-link {
        flex-shrink: 0;
        color: #155a91;
        text-decoration: none;
        font-size: 11px;
        font-weight: 700;
    }


    .file-link:hover {
        text-decoration: underline;
    }


    .replace-file {
        margin-top: 14px;
        padding-top: 14px;
        border-top: 1px solid #e8edf2;
    }


    .replace-title {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }


    .replace-title label {
        margin-bottom: 6px;
    }


    .replace-title > span {
        color: #94a3b8;
        font-size: 9px;
        text-transform: uppercase;
        letter-spacing: .05em;
        font-weight: 700;
    }


    .file-input {
        display: block;
        width: 100%;
        box-sizing: border-box;
        padding: 8px;
        border: 1px dashed #cbd5e1;
        border-radius: 6px;
        background: #fafbfc;
        color: #475569;
        font-family: inherit;
        font-size: 11px;
    }


    .replace-file small {
        display: block;
        margin-top: 5px;
        color: #94a3b8;
        font-size: 10px;
    }


    .alert {
        margin-bottom: 18px;
        padding: 12px 14px;
        border-radius: 7px;
        font-size: 12px;
    }


    .alert-error {
        background: #fef2f2;
        border: 1px solid #fecaca;
        color: #991b1b;
    }


    .alert-title {
        margin-bottom: 4px;
        font-weight: 700;
    }


    .alert ul {
        margin: 4px 0 0;
        padding-left: 17px;
    }


    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 9px;
        margin-top: 17px;
    }


    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        min-height: 39px;
        padding: 0 15px;
        border-radius: 7px;
        border: 1px solid transparent;
        font-family: inherit;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
        transition: .18s ease;
    }


    .btn-icon {
        font-size: 14px;
        line-height: 1;
    }


    .btn-primary {
        background: #155a91;
        color: #ffffff;
    }


    .btn-primary:hover {
        background: #104b79;
    }


    .btn-secondary {
        background: #ffffff;
        border-color: #d7e0e8;
        color: #334155;
    }


    .btn-secondary:hover {
        background: #f5f7f9;
        border-color: #cbd5df;
    }


    @media (max-width: 850px) {

        .main-grid {
            grid-template-columns: 1fr;
        }

    }


    @media (max-width: 600px) {

        .page-header {
            align-items: flex-start;
            flex-direction: column;
        }


        .page-header > .btn {
            width: 100%;
        }


        .panel {
            padding: 17px;
        }


        .current-file {
            align-items: flex-start;
            flex-wrap: wrap;
        }


        .file-information {
            width: calc(100% - 53px);
        }


        .file-link {
            width: 100%;
            padding-left: 53px;
        }


        .form-actions {
            flex-direction: column-reverse;
        }


        .form-actions .btn {
            width: 100%;
        }

    }

</style>

@endsection