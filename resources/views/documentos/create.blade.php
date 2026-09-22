@extends('layouts.app')

@section('title', 'Subir documento')

@section('topbar_title', 'Documentos')

@push('styles')
<style>
    .document-form-header {
        margin-bottom: 24px;
    }

    .document-form-title {
        margin: 0;
        color: #172033;
        font-size: 27px;
        line-height: 1.2;
        font-weight: 700;
        letter-spacing: -.025em;
    }

    .document-form-subtitle {
        margin: 7px 0 0;
        color: #667085;
        font-size: 13px;
    }

    .document-form-alert {
        margin-bottom: 18px;
        padding: 11px 14px;
        border: 1px solid #f0d3cf;
        border-radius: 7px;
        background: #fff7f5;
        color: #a52f26;
        font-size: 11px;
    }

    .document-form-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(16, 47, 80, .05);
        overflow: visible;
    }

    .document-form-card-header {
        padding: 17px 20px;
        border-bottom: 1px solid #edf1f5;
    }

    .document-form-card-title {
        margin: 0;
        color: #172033;
        font-size: 14px;
        font-weight: 700;
    }

    .document-form-card-description {
        margin: 4px 0 0;
        color: #98a2b3;
        font-size: 10px;
    }

    .document-form-body {
        padding: 22px 20px;
    }

    .document-section + .document-section {
        margin-top: 25px;
        padding-top: 22px;
        border-top: 1px solid #edf1f5;
    }

    .document-section-header {
        margin-bottom: 15px;
    }

    .document-section-number {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 22px;
        height: 22px;
        margin-right: 7px;
        border-radius: 6px;
        background: #edf6fc;
        color: #155a91;
        font-size: 9px;
        font-weight: 700;
        vertical-align: middle;
    }

    .document-section-title {
        display: inline;
        margin: 0;
        color: #344054;
        font-size: 12px;
        font-weight: 700;
    }

    .document-section-description {
        margin: 5px 0 0 31px;
        color: #98a2b3;
        font-size: 9px;
        line-height: 1.4;
    }

    .document-form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
    }

    .document-form-group {
        min-width: 0;
    }

    .document-form-group-full {
        grid-column: 1 / -1;
    }

    .document-form-label {
        display: block;
        margin-bottom: 7px;
        color: #344054;
        font-size: 11px;
        font-weight: 600;
    }

    .document-form-required {
        color: #b9382e;
    }

    .document-form-input {
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

    .document-form-input::placeholder {
        color: #a1aab7;
    }

    .document-form-input:focus {
        border-color: #155a91;
        box-shadow: 0 0 0 3px rgba(21, 90, 145, .08);
    }

    .document-form-input:disabled {
        background: #f8fafc;
        color: #98a2b3;
        cursor: not-allowed;
    }

    textarea.document-form-input {
        min-height: 88px;
        resize: vertical;
        line-height: 1.5;
    }

    .document-form-help {
        margin-top: 5px;
        color: #98a2b3;
        font-size: 9px;
        line-height: 1.4;
    }

    .document-form-error {
        margin-top: 5px;
        color: #b9382e;
        font-size: 9px;
    }

    .document-search {
        position: relative;
    }

    .document-search-results {
        display: none;
        position: absolute;
        z-index: 100;
        top: calc(100% + 5px);
        left: 0;
        right: 0;
        max-height: 245px;
        overflow-y: auto;
        background: #ffffff;
        border: 1px solid #d8e0e8;
        border-radius: 7px;
        box-shadow: 0 10px 24px rgba(15, 23, 42, .12);
    }

    .document-search-results.visible {
        display: block;
    }

    .document-search-item {
        width: 100%;
        display: flex;
        flex-direction: column;
        gap: 3px;
        padding: 10px 11px;
        border: 0;
        border-bottom: 1px solid #edf1f5;
        background: #ffffff;
        text-align: left;
        cursor: pointer;
        font-family: inherit;
    }

    .document-search-item:last-child {
        border-bottom: 0;
    }

    .document-search-item:hover {
        background: #f7fafc;
    }

    .document-search-main {
        color: #344054;
        font-size: 10px;
        font-weight: 700;
    }

    .document-search-secondary {
        color: #98a2b3;
        font-size: 9px;
        line-height: 1.4;
    }

    .document-search-empty {
        padding: 12px;
        color: #98a2b3;
        font-size: 9px;
        text-align: center;
    }

    .document-selected {
        display: none;
        align-items: center;
        gap: 11px;
        padding: 12px 14px;
        border: 1px solid #d4e5f2;
        border-radius: 8px;
        background: #f7fbfe;
    }

    .document-selected-icon {
        width: 36px;
        height: 36px;
        flex: 0 0 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 7px;
        background: #e8f3fa;
        color: #155a91;
        font-size: 8px;
        font-weight: 800;
    }

    .document-selected-content {
        min-width: 0;
    }

    .document-selected-label {
        color: #98a2b3;
        font-size: 8px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .03em;
    }

    .document-selected-title {
        margin-top: 3px;
        color: #155a91;
        font-size: 11px;
        font-weight: 700;
        word-break: break-word;
    }

    .document-selected-secondary {
        margin-top: 2px;
        color: #667085;
        font-size: 9px;
        line-height: 1.4;
    }

    .document-file-box {
        padding: 15px;
        border: 1px dashed #cbd5e1;
        border-radius: 8px;
        background: #fbfcfd;
    }

    .document-file-heading {
        margin-bottom: 10px;
    }

    .document-file-title {
        color: #344054;
        font-size: 11px;
        font-weight: 600;
    }

    .document-file-description {
        margin-top: 3px;
        color: #98a2b3;
        font-size: 9px;
    }

    .document-file-info {
        display: none;
        margin-top: 9px;
        padding: 9px 11px;
        border: 1px solid #d4e5f2;
        border-radius: 6px;
        background: #f7fbfe;
        color: #667085;
        font-size: 9px;
        word-break: break-word;
    }

    .document-info-box {
        margin-top: 20px;
        padding: 12px 14px;
        border: 1px solid #e2e8f0;
        border-radius: 7px;
        background: #fbfcfd;
        color: #667085;
        font-size: 9px;
        line-height: 1.5;
    }

    .document-info-box strong {
        color: #344054;
    }

    .document-form-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 15px 20px;
        border-top: 1px solid #edf1f5;
        background: #fbfcfd;
    }

    .document-form-footer-actions {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .document-form-cancel {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 35px;
        padding: 7px 13px;
        border: 1px solid #dce3eb;
        border-radius: 6px;
        background: #ffffff;
        color: #344054;
        font-family: inherit;
        font-size: 10px;
        font-weight: 600;
        text-decoration: none;
        transition:
            background .12s ease,
            border-color .12s ease;
    }

    .document-form-cancel:hover {
        background: #f5f8fb;
        border-color: #cbd7e3;
    }

    @media (max-width: 700px) {
        .document-form-grid {
            grid-template-columns: 1fr;
        }

        .document-form-group-full {
            grid-column: auto;
        }

        .document-form-footer {
            align-items: stretch;
            flex-direction: column;
        }

        .document-form-footer-actions {
            width: 100%;
        }

        .document-form-footer-actions .btn,
        .document-form-footer-actions .document-form-cancel {
            flex: 1;
        }
    }
</style>
@endpush

@section('content')

@php
    $operacionesJson = $operaciones->map(
        fn ($operacion) => [
            'id' => $operacion->id,
            'numero' => $operacion->numero_operacion,
            'cliente' => $operacion->cliente?->razon_social ?? '',
        ]
    )->values();

    $gastosJson = $gastos->map(
        fn ($gasto) => [
            'id' => $gasto->id,
            'fecha' => $gasto->fecha?->format('d/m/Y') ?? '',
            'tipo' => $gasto->tipo ?? '',
            'descripcion' => $gasto->descripcion ?? '',
            'monto' => number_format(
                (float) $gasto->monto,
                0,
                ',',
                '.'
            ),
            'operacion' => $gasto->operacion?->numero_operacion ?? '',
            'cliente' => $gasto->operacion?->cliente?->razon_social ?? '',
            'transportista' => $gasto->transportista?->nombre ?? '',
        ]
    )->values();

    $trabajadoresJson = $trabajadores->map(
        fn ($trabajador) => [
            'id' => $trabajador->id,
            'nombre' => $trabajador->nombre ?? '',
            'rut' => $trabajador->rut ?? '',
            'correo' => $trabajador->correo ?? '',
        ]
    )->values();
@endphp

<div class="document-form-header">
    <h1 class="document-form-title">
        Subir documento
    </h1>

    <p class="document-form-subtitle">
        Asocia un archivo a un registro del sistema para mantener toda su información relacionada.
    </p>
</div>

@if($errors->any())
    <div class="document-form-alert">
        Revisa los datos ingresados. Hay información que necesita corrección antes de subir el documento.
    </div>
@endif

<section class="document-form-card">

    <div class="document-form-card-header">
        <h2 class="document-form-card-title">
            Nuevo documento
        </h2>

        <p class="document-form-card-description">
            Completa los datos del documento y selecciona el registro al que pertenece.
        </p>
    </div>

    <form
        action="{{ route('documentos.store') }}"
        method="POST"
        enctype="multipart/form-data"
        id="documentForm"
    >
        @csrf

        <div class="document-form-body">

            <div class="document-section">

                <div class="document-section-header">
                    <span class="document-section-number">
                        1
                    </span>

                    <h3 class="document-section-title">
                        Registro asociado
                    </h3>

                    <p class="document-section-description">
                        Primero indica a qué registro pertenece el documento.
                    </p>
                </div>

                <div class="document-form-grid">

                    <div class="document-form-group">
                        <label
                            for="registro_tipo"
                            class="document-form-label"
                        >
                            Tipo de registro
                            <span class="document-form-required">*</span>
                        </label>

                        <select
                            name="registro_tipo"
                            id="registro_tipo"
                            class="document-form-input"
                            required
                        >
                            <option value="">
                                Seleccionar registro
                            </option>

                            <option
                                value="operacion"
                                {{ old('registro_tipo', request('registro_tipo')) === 'operacion' ? 'selected' : '' }}
                            >
                                Operación
                            </option>

                            <option
                                value="gasto"
                                {{ old('registro_tipo', request('registro_tipo')) === 'gasto' ? 'selected' : '' }}
                            >
                                Gasto
                            </option>

                            <option
                                value="trabajador"
                                {{ old('registro_tipo', request('registro_tipo')) === 'trabajador' ? 'selected' : '' }}
                            >
                                Trabajador
                            </option>
                        </select>

                        @error('registro_tipo')
                            <div class="document-form-error">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="document-form-group">
                        <label
                            for="registro_busqueda"
                            class="document-form-label"
                        >
                            <span id="label_busqueda">
                                Buscar registro
                            </span>

                            <span class="document-form-required">*</span>
                        </label>

                        <div class="document-search">

                            <input
                                type="text"
                                id="registro_busqueda"
                                class="document-form-input"
                                placeholder="Primero selecciona el tipo de registro..."
                                autocomplete="off"
                                disabled
                            >

                            <input
                                type="hidden"
                                name="registro_id"
                                id="registro_id"
                                value="{{ old('registro_id', request('registro_id')) }}"
                            >

                            <div
                                id="registros_resultados"
                                class="document-search-results"
                            ></div>

                        </div>

                        @error('registro_id')
                            <div class="document-form-error">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="document-form-group document-form-group-full">

                        <div
                            id="registro_seleccionado"
                            class="document-selected"
                        >
                            <div
                                id="seleccionado_icono"
                                class="document-selected-icon"
                            >
                                DOC
                            </div>

                            <div class="document-selected-content">
                                <div
                                    id="seleccionado_label"
                                    class="document-selected-label"
                                >
                                    REGISTRO SELECCIONADO
                                </div>

                                <div
                                    id="seleccionado_titulo"
                                    class="document-selected-title"
                                ></div>

                                <div
                                    id="seleccionado_secundario"
                                    class="document-selected-secondary"
                                ></div>
                            </div>
                        </div>

                        <div class="document-form-help">
                            El documento debe quedar asociado a una operación, gasto o trabajador.
                        </div>

                    </div>

                </div>

            </div>

            <div class="document-section">

                <div class="document-section-header">
                    <span class="document-section-number">
                        2
                    </span>

                    <h3 class="document-section-title">
                        Datos del documento
                    </h3>

                    <p class="document-section-description">
                        Agrega la información que permita identificar fácilmente el archivo.
                    </p>
                </div>

                <div class="document-form-grid">

                    <div class="document-form-group">
                        <label
                            for="tipo"
                            class="document-form-label"
                        >
                            Tipo de documento
                        </label>

                        <select
                            name="tipo"
                            id="tipo"
                            class="document-form-input"
                        >
                            <option value="">
                                Seleccionar tipo
                            </option>

                            <option
                                value="factura"
                                {{ old('tipo') === 'factura' ? 'selected' : '' }}
                            >
                                Factura
                            </option>

                            <option
                                value="guia_despacho"
                                {{ old('tipo') === 'guia_despacho' ? 'selected' : '' }}
                            >
                                Guía de despacho
                            </option>

                            <option
                                value="contrato"
                                {{ old('tipo') === 'contrato' ? 'selected' : '' }}
                            >
                                Contrato
                            </option>

                            <option
                                value="orden_compra"
                                {{ old('tipo') === 'orden_compra' ? 'selected' : '' }}
                            >
                                Orden de compra
                            </option>

                            <option
                                value="boleta"
                                {{ old('tipo') === 'boleta' ? 'selected' : '' }}
                            >
                                Boleta
                            </option>

                            <option
                                value="comprobante"
                                {{ old('tipo') === 'comprobante' ? 'selected' : '' }}
                            >
                                Comprobante
                            </option>

                            <option
                                value="respaldo"
                                {{ old('tipo') === 'respaldo' ? 'selected' : '' }}
                            >
                                Respaldo
                            </option>

                            <option
                                value="otro"
                                {{ old('tipo') === 'otro' ? 'selected' : '' }}
                            >
                                Otro
                            </option>
                        </select>

                        @error('tipo')
                            <div class="document-form-error">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="document-form-group document-form-group-full">
                        <label
                            for="descripcion"
                            class="document-form-label"
                        >
                            Descripción
                        </label>

                        <textarea
                            name="descripcion"
                            id="descripcion"
                            class="document-form-input"
                            maxlength="2000"
                            placeholder="Describe brevemente el documento..."
                        >{{ old('descripcion') }}</textarea>

                        @error('descripcion')
                            <div class="document-form-error">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="document-form-group document-form-group-full">
                        <label
                            for="observaciones"
                            class="document-form-label"
                        >
                            Observaciones
                        </label>

                        <textarea
                            name="observaciones"
                            id="observaciones"
                            class="document-form-input"
                            maxlength="2000"
                            placeholder="Información adicional, si corresponde..."
                        >{{ old('observaciones') }}</textarea>

                        @error('observaciones')
                            <div class="document-form-error">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                </div>

            </div>

            <div class="document-section">

                <div class="document-section-header">
                    <span class="document-section-number">
                        3
                    </span>

                    <h3 class="document-section-title">
                        Archivo
                    </h3>

                    <p class="document-section-description">
                        Selecciona el archivo que quedará almacenado en el sistema.
                    </p>
                </div>

                <div class="document-file-box">

                    <div class="document-file-heading">
                        <div class="document-file-title">
                            Seleccionar archivo
                            <span class="document-form-required">*</span>
                        </div>

                        <div class="document-file-description">
                            PDF, imágenes, documentos u otros archivos. Máximo 10 MB.
                        </div>
                    </div>

                    <input
                        type="file"
                        name="archivo"
                        id="archivo"
                        class="document-form-input"
                        required
                    >

                    <div
                        id="archivo_info"
                        class="document-file-info"
                    ></div>

                    @error('archivo')
                        <div class="document-form-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

            </div>

            <div class="document-info-box">
                <strong>Importante:</strong>
                cada documento queda relacionado con el registro seleccionado para mantener su trazabilidad dentro del sistema.
            </div>

        </div>

        <div class="document-form-footer">

            <div>
                <span class="document-form-help">
                    Los campos marcados con * son obligatorios.
                </span>
            </div>

            <div class="document-form-footer-actions">

                <a
                    href="{{ route('documentos.index') }}"
                    class="document-form-cancel"
                >
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Subir documento
                </button>

            </div>

        </div>

    </form>

</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const operaciones = @json($operacionesJson);
        const gastos = @json($gastosJson);
        const trabajadores = @json($trabajadoresJson);

        const tipoRegistro =
            document.getElementById('registro_tipo');

        const inputBusqueda =
            document.getElementById('registro_busqueda');

        const inputRegistro =
            document.getElementById('registro_id');

        const resultados =
            document.getElementById('registros_resultados');

        const labelBusqueda =
            document.getElementById('label_busqueda');

        const registroSeleccionado =
            document.getElementById('registro_seleccionado');

        const seleccionadoIcono =
            document.getElementById('seleccionado_icono');

        const seleccionadoLabel =
            document.getElementById('seleccionado_label');

        const seleccionadoTitulo =
            document.getElementById('seleccionado_titulo');

        const seleccionadoSecundario =
            document.getElementById('seleccionado_secundario');

        const archivo =
            document.getElementById('archivo');

        const archivoInfo =
            document.getElementById('archivo_info');

        const formulario =
            document.getElementById('documentForm');

        let registrosActuales = [];


        function escapeHtml(value) {
            return String(value)
                .replaceAll('&', '&amp;')
                .replaceAll('<', '&lt;')
                .replaceAll('>', '&gt;')
                .replaceAll('"', '&quot;')
                .replaceAll("'", '&#039;');
        }


        function textoGasto(gasto) {

            let texto =
                'Gasto #' + gasto.id;

            if (gasto.descripcion) {
                texto +=
                    ' — ' +
                    gasto.descripcion;
            }

            return texto;
        }


        function actualizarTipoRegistro() {

            const tipo =
                tipoRegistro.value;

            inputBusqueda.value = '';

            inputRegistro.value = '';

            resultados.innerHTML = '';

            resultados.classList.remove(
                'visible'
            );

            registroSeleccionado.style.display =
                'none';

            if (!tipo) {

                inputBusqueda.disabled =
                    true;

                inputBusqueda.placeholder =
                    'Primero selecciona el tipo de registro...';

                labelBusqueda.textContent =
                    'Buscar registro';

                registrosActuales = [];

                return;
            }

            inputBusqueda.disabled =
                false;

            if (tipo === 'operacion') {

                registrosActuales =
                    operaciones;

                labelBusqueda.textContent =
                    'Buscar operación';

                inputBusqueda.placeholder =
                    'Buscar por número de operación o cliente...';

                seleccionadoIcono.textContent =
                    'OP';
            }

            if (tipo === 'gasto') {

                registrosActuales =
                    gastos;

                labelBusqueda.textContent =
                    'Buscar gasto';

                inputBusqueda.placeholder =
                    'Buscar por concepto, operación o transportista...';

                seleccionadoIcono.textContent =
                    'GST';
            }

            if (tipo === 'trabajador') {

                registrosActuales =
                    trabajadores;

                labelBusqueda.textContent =
                    'Buscar trabajador';

                inputBusqueda.placeholder =
                    'Buscar por nombre o RUT...';

                seleccionadoIcono.textContent =
                    'TRB';
            }
        }


        function mostrarResultados() {

            const busqueda =
                inputBusqueda.value
                    .trim()
                    .toLowerCase();

            const filtrados =
                registrosActuales
                    .filter(function (registro) {

                        if (
                            tipoRegistro.value ===
                            'operacion'
                        ) {

                            const numero =
                                String(
                                    registro.numero || ''
                                ).toLowerCase();

                            const cliente =
                                String(
                                    registro.cliente || ''
                                ).toLowerCase();

                            return (
                                numero.includes(busqueda) ||
                                cliente.includes(busqueda)
                            );
                        }

                        if (
                            tipoRegistro.value ===
                            'gasto'
                        ) {

                            const contenido = [
                                registro.id,
                                registro.fecha,
                                registro.tipo,
                                registro.descripcion,
                                registro.operacion,
                                registro.cliente,
                                registro.transportista,
                                registro.monto,
                            ]
                                .join(' ')
                                .toLowerCase();

                            return contenido.includes(
                                busqueda
                            );
                        }

                        if (
                            tipoRegistro.value ===
                            'trabajador'
                        ) {

                            const contenido = [
                                registro.id,
                                registro.nombre,
                                registro.rut,
                                registro.correo,
                            ]
                                .join(' ')
                                .toLowerCase();

                            return contenido.includes(
                                busqueda
                            );
                        }

                        return false;
                    })
                    .slice(0, 15);

            resultados.innerHTML = '';

            if (!filtrados.length) {

                resultados.innerHTML = `
                    <div class="document-search-empty">
                        No se encontraron registros.
                    </div>
                `;

                resultados.classList.add(
                    'visible'
                );

                return;
            }

            filtrados.forEach(function (registro) {

                const item =
                    document.createElement(
                        'button'
                    );

                item.type = 'button';

                item.className =
                    'document-search-item';


                if (
                    tipoRegistro.value ===
                    'operacion'
                ) {

                    item.innerHTML = `
                        <span class="document-search-main">
                            ${escapeHtml(
                                registro.numero || ''
                            )}
                        </span>

                        <span class="document-search-secondary">
                            ${escapeHtml(
                                registro.cliente ||
                                'Sin cliente'
                            )}
                        </span>
                    `;
                }


                if (
                    tipoRegistro.value ===
                    'gasto'
                ) {

                    let detalle = '';

                    if (registro.tipo) {
                        detalle += registro.tipo;
                    }

                    if (registro.fecha) {
                        detalle +=
                            (
                                detalle
                                    ? ' · '
                                    : ''
                            ) +
                            registro.fecha;
                    }

                    if (registro.monto) {
                        detalle +=
                            (
                                detalle
                                    ? ' · '
                                    : ''
                            ) +
                            '$' +
                            registro.monto;
                    }

                    let relacion = '';

                    if (registro.operacion) {
                        relacion +=
                            'Operación ' +
                            registro.operacion;
                    }

                    if (registro.transportista) {
                        relacion +=
                            (
                                relacion
                                    ? ' · '
                                    : ''
                            ) +
                            registro.transportista;
                    }

                    item.innerHTML = `
                        <span class="document-search-main">
                            ${escapeHtml(
                                textoGasto(registro)
                            )}
                        </span>

                        <span class="document-search-secondary">
                            ${escapeHtml(
                                detalle ||
                                'Sin información adicional'
                            )}
                        </span>

                        ${
                            relacion
                                ? `
                                    <span class="document-search-secondary">
                                        ${escapeHtml(relacion)}
                                    </span>
                                `
                                : ''
                        }
                    `;
                }


                if (
                    tipoRegistro.value ===
                    'trabajador'
                ) {

                    let detalle = '';

                    if (registro.rut) {
                        detalle +=
                            'RUT: ' +
                            registro.rut;
                    }

                    if (registro.correo) {
                        detalle +=
                            (
                                detalle
                                    ? ' · '
                                    : ''
                            ) +
                            registro.correo;
                    }

                    item.innerHTML = `
                        <span class="document-search-main">
                            ${escapeHtml(
                                registro.nombre ||
                                'Trabajador #' +
                                registro.id
                            )}
                        </span>

                        <span class="document-search-secondary">
                            ${escapeHtml(
                                detalle ||
                                'Sin información adicional'
                            )}
                        </span>
                    `;
                }


                item.addEventListener(
                    'click',
                    function () {

                        seleccionarRegistro(
                            registro
                        );
                    }
                );

                resultados.appendChild(
                    item
                );
            });

            resultados.classList.add(
                'visible'
            );
        }


        function seleccionarRegistro(registro) {

            inputRegistro.value =
                registro.id;


            if (
                tipoRegistro.value ===
                'operacion'
            ) {

                inputBusqueda.value =
                    registro.numero +
                    ' — ' +
                    (
                        registro.cliente ||
                        'Sin cliente'
                    );

                seleccionadoIcono.textContent =
                    'OP';

                seleccionadoLabel.textContent =
                    'OPERACIÓN SELECCIONADA';

                seleccionadoTitulo.textContent =
                    registro.numero;

                seleccionadoSecundario.textContent =
                    registro.cliente ||
                    'Sin cliente';
            }


            if (
                tipoRegistro.value ===
                'gasto'
            ) {

                inputBusqueda.value =
                    textoGasto(
                        registro
                    );

                seleccionadoIcono.textContent =
                    'GST';

                seleccionadoLabel.textContent =
                    'GASTO SELECCIONADO';

                seleccionadoTitulo.textContent =
                    textoGasto(
                        registro
                    );

                let secundario = '';

                if (registro.fecha) {
                    secundario +=
                        registro.fecha;
                }

                if (registro.monto) {
                    secundario +=
                        (
                            secundario
                                ? ' · '
                                : ''
                        ) +
                        '$' +
                        registro.monto;
                }

                if (registro.operacion) {
                    secundario +=
                        (
                            secundario
                                ? ' · '
                                : ''
                        ) +
                        'Operación ' +
                        registro.operacion;
                }

                if (registro.transportista) {
                    secundario +=
                        (
                            secundario
                                ? ' · '
                                : ''
                        ) +
                        registro.transportista;
                }

                seleccionadoSecundario.textContent =
                    secundario ||
                    'Sin información adicional';
            }


            if (
                tipoRegistro.value ===
                'trabajador'
            ) {

                inputBusqueda.value =
                    registro.nombre +
                    (
                        registro.rut
                            ? ' — ' +
                              registro.rut
                            : ''
                    );

                seleccionadoIcono.textContent =
                    'TRB';

                seleccionadoLabel.textContent =
                    'TRABAJADOR SELECCIONADO';

                seleccionadoTitulo.textContent =
                    registro.nombre ||
                    'Trabajador #' +
                    registro.id;

                let secundario = '';

                if (registro.rut) {
                    secundario +=
                        'RUT: ' +
                        registro.rut;
                }

                if (registro.correo) {
                    secundario +=
                        (
                            secundario
                                ? ' · '
                                : ''
                        ) +
                        registro.correo;
                }

                seleccionadoSecundario.textContent =
                    secundario ||
                    'Sin información adicional';
            }


            registroSeleccionado.style.display =
                'flex';

            resultados.classList.remove(
                'visible'
            );
        }


        tipoRegistro.addEventListener(
            'change',
            actualizarTipoRegistro
        );


        inputBusqueda.addEventListener(
            'focus',
            function () {

                if (!inputBusqueda.disabled) {
                    mostrarResultados();
                }
            }
        );


        inputBusqueda.addEventListener(
            'input',
            function () {

                inputRegistro.value = '';

                registroSeleccionado.style.display =
                    'none';

                mostrarResultados();
            }
        );


        document.addEventListener(
            'click',
            function (event) {

                if (
                    !event.target.closest(
                        '.document-search'
                    )
                ) {
                    resultados.classList.remove(
                        'visible'
                    );
                }
            }
        );


        archivo.addEventListener(
            'change',
            function () {

                if (!archivo.files.length) {

                    archivoInfo.style.display =
                        'none';

                    archivoInfo.textContent =
                        '';

                    return;
                }

                const archivoSeleccionado =
                    archivo.files[0];

                const tamanoMB =
                    (
                        archivoSeleccionado.size /
                        (1024 * 1024)
                    ).toFixed(2);

                archivoInfo.textContent =
                    'Archivo seleccionado: ' +
                    archivoSeleccionado.name +
                    ' · ' +
                    tamanoMB +
                    ' MB';

                archivoInfo.style.display =
                    'block';
            }
        );


        formulario.addEventListener(
            'submit',
            function (evento) {

                if (!tipoRegistro.value) {

                    evento.preventDefault();

                    alert(
                        'Debes seleccionar el tipo de registro.'
                    );

                    tipoRegistro.focus();

                    return;
                }

                if (!inputRegistro.value) {

                    evento.preventDefault();

                    alert(
                        'Debes seleccionar un registro.'
                    );

                    inputBusqueda.focus();

                    return;
                }

                if (!archivo.files.length) {

                    evento.preventDefault();

                    alert(
                        'Debes seleccionar un archivo.'
                    );

                    archivo.focus();
                }
            }
        );


        const tipoAnterior =
            tipoRegistro.value;

        const idAnterior =
            inputRegistro.value;


        if (
            tipoAnterior &&
            idAnterior
        ) {

            actualizarTipoRegistro();

            inputRegistro.value =
                idAnterior;

            const registroAnterior =
                registrosActuales.find(
                    function (registro) {

                        return String(
                            registro.id
                        ) === String(
                            idAnterior
                        );
                    }
                );

            if (registroAnterior) {
                seleccionarRegistro(
                    registroAnterior
                );
            }
        }

    });
</script>

@endsection