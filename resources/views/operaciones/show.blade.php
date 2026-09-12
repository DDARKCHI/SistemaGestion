@extends('layouts.app')

@section('title', 'Operación ' . $operacion->numero_operacion)

@section('topbar_title', 'Gestión de operaciones')

@push('styles')

<style>

    /* =========================================================
       ENCABEZADO
    ========================================================== */

    .operation-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #8a94a6;
        font-size: 12px;
        margin-bottom: 18px;
    }

    .operation-breadcrumb a {
        color: #667085;
    }

    .operation-breadcrumb a:hover {
        color: #155a91;
    }

    .operation-breadcrumb-current {
        color: #344054;
    }


    .operation-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 20px;
        margin-bottom: 25px;
    }

    .operation-header-left {
        min-width: 0;
    }

    .operation-title {
        margin: 0;
        color: #172033;
        font-size: 27px;
        line-height: 1.2;
        font-weight: 700;
        letter-spacing: -.025em;
    }

    .operation-subtitle {
        margin: 7px 0 0;
        color: #667085;
        font-size: 13px;
    }

    .operation-actions {
        display: flex;
        gap: 9px;
        flex-shrink: 0;
    }


    /* =========================================================
       RESUMEN
    ========================================================== */

    .operation-summary {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 14px;
        margin-bottom: 22px;
    }

    .summary-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 18px;
        box-shadow: 0 2px 8px rgba(16, 47, 80, .05);
    }

    .summary-label {
        color: #8a94a6;
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: .05em;
        font-weight: 700;
    }

    .summary-value {
        margin-top: 7px;
        color: #172033;
        font-size: 23px;
        line-height: 1;
        font-weight: 700;
    }

    .summary-description {
        margin-top: 6px;
        color: #98a2b3;
        font-size: 11px;
    }


    /* =========================================================
       CARDS
    ========================================================== */

    .operation-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(16, 47, 80, .05);
        margin-bottom: 20px;
        overflow: hidden;
    }

    .operation-card-header {
        min-height: 65px;
        padding: 17px 21px;
        border-bottom: 1px solid #edf1f5;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
    }

    .operation-card-title {
        margin: 0;
        color: #172033;
        font-size: 15px;
        font-weight: 700;
    }

    .operation-card-description {
        margin: 4px 0 0;
        color: #98a2b3;
        font-size: 11px;
    }

    .operation-card-body {
        padding: 21px;
    }


    /* =========================================================
       INFORMACIÓN
    ========================================================== */

    .operation-data-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        overflow: hidden;
    }

    .operation-data-item {
        min-height: 78px;
        padding: 16px 17px;
        border-right: 1px solid #e2e8f0;
        border-bottom: 1px solid #e2e8f0;
    }

    .operation-data-item:nth-child(3n) {
        border-right: none;
    }

    .operation-data-item:nth-last-child(-n+3) {
        border-bottom: none;
    }

    .operation-data-label {
        margin-bottom: 7px;
        color: #8a94a6;
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: .03em;
        font-weight: 700;
    }

    .operation-data-value {
        color: #344054;
        font-size: 13px;
        font-weight: 500;
        word-break: break-word;
    }


    .operation-text-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
        margin-top: 14px;
    }

    .operation-text-box {
        min-height: 90px;
        padding: 15px 17px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
    }

    .operation-text-label {
        margin-bottom: 8px;
        color: #8a94a6;
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: .03em;
        font-weight: 700;
    }

    .operation-text-value {
        color: #475467;
        font-size: 13px;
        line-height: 1.6;
        white-space: pre-line;
    }

    .operation-empty-text {
        color: #98a2b3;
        font-style: italic;
    }


    /* =========================================================
       DOCUMENTOS
    ========================================================== */

    .document-upload-box {
        padding: 18px;
        margin-bottom: 18px;
        background: #f6f9fc;
        border: 1px solid #e1e8ef;
        border-radius: 8px;
    }

    .document-upload-title {
        margin-bottom: 14px;
        color: #344054;
        font-size: 12px;
        font-weight: 700;
    }

    .document-form-grid {
        display: grid;
        grid-template-columns: 1.2fr .8fr;
        gap: 12px;
    }

    .document-form-group {
        margin-bottom: 12px;
    }

    .document-form-label {
        display: block;
        margin-bottom: 6px;
        color: #475467;
        font-size: 11px;
        font-weight: 600;
    }

    .document-form-control {
        width: 100%;
        min-height: 38px;
        padding: 8px 10px;
        border: 1px solid #d7dee7;
        border-radius: 6px;
        background: #ffffff;
        color: #344054;
        font-size: 12px;
        outline: none;
    }

    .document-form-control:focus {
        border-color: #155a91;
        box-shadow: 0 0 0 2px rgba(21, 90, 145, .08);
    }

    .document-form-help {
        margin-top: 5px;
        color: #98a2b3;
        font-size: 10px;
    }

    .document-form-actions {
        display: flex;
        justify-content: flex-end;
        margin-top: 3px;
    }


    .document-list {
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        overflow: hidden;
    }

    .document-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        padding: 14px 16px;
        border-bottom: 1px solid #edf1f5;
    }

    .document-row:last-child {
        border-bottom: none;
    }

    .document-main {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 0;
    }

    .document-icon {
        width: 39px;
        height: 39px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 7px;
        background: #eaf3fa;
        color: #155a91;
        font-size: 16px;
    }

    .document-info {
        min-width: 0;
    }

    .document-name {
        max-width: 550px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        color: #344054;
        font-size: 12px;
        font-weight: 600;
    }

    .document-meta {
        margin-top: 4px;
        color: #98a2b3;
        font-size: 10px;
    }

    .document-actions {
        display: flex;
        align-items: center;
        gap: 7px;
        flex-shrink: 0;
    }


    /* =========================================================
       ESTADO
    ========================================================== */

    .operation-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 9px;
        border-radius: 5px;
        background: #eaf3fa;
        color: #155a91;
        font-size: 11px;
        font-weight: 600;
    }

    .operation-status-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
    }


    /* =========================================================
       TABLAS
    ========================================================== */

    .operation-table-wrapper {
        overflow-x: auto;
    }

    .operation-table {
        width: 100%;
        border-collapse: collapse;
    }

    .operation-table th {
        padding: 11px 15px;
        background: #f6f9fc;
        border-bottom: 1px solid #e2e8f0;
        color: #8a94a6;
        font-size: 10px;
        text-align: left;
        text-transform: uppercase;
        letter-spacing: .03em;
        font-weight: 700;
    }

    .operation-table td {
        padding: 14px 15px;
        border-bottom: 1px solid #edf1f5;
        color: #475467;
        font-size: 12px;
    }

    .operation-table tr:last-child td {
        border-bottom: none;
    }

    .operation-table-number {
        color: #344054;
        font-weight: 600;
    }

    .operation-table-link {
        color: #155a91;
        font-weight: 600;
    }

    .operation-table-link:hover {
        text-decoration: underline;
    }

    .operation-table-amount {
        color: #172033;
        font-weight: 700;
        white-space: nowrap;
    }


    /* =========================================================
       EMPTY STATE
    ========================================================== */

    .operation-empty-state {
        padding: 38px 20px;
        border: 1px dashed #d7dfe8;
        border-radius: 8px;
        text-align: center;
    }

    .operation-empty-icon {
        margin-bottom: 9px;
        color: #a8b1bd;
        font-size: 25px;
    }

    .operation-empty-state strong {
        display: block;
        color: #475467;
        font-size: 12px;
    }

    .operation-empty-state p {
        margin: 5px 0 0;
        color: #98a2b3;
        font-size: 11px;
    }


    /* =========================================================
       ALERTAS
    ========================================================== */

    .operation-alert {
        padding: 12px 15px;
        margin-bottom: 20px;
        border-radius: 7px;
        font-size: 12px;
    }

    .operation-alert-success {
        background: #edf8f2;
        border: 1px solid #cce8d5;
        color: #287044;
    }

    .operation-alert-error {
        background: #fff7ed;
        border: 1px solid #fed7aa;
        color: #9a3412;
    }

    .operation-error-list {
        margin: 7px 0 0;
        padding-left: 18px;
    }


    /* =========================================================
       GESTIÓN RELACIONADA
    ========================================================== */

    .related-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 14px;
    }

    .related-card {
        padding: 17px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        background: #ffffff;
    }

    .related-label {
        color: #8a94a6;
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: .04em;
        font-weight: 700;
    }

    .related-value {
        margin-top: 7px;
        color: #172033;
        font-size: 21px;
        font-weight: 700;
    }

    .related-description {
        margin-top: 4px;
        color: #98a2b3;
        font-size: 10px;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================== */

    @media (max-width: 1100px) {

        .operation-summary {
            grid-template-columns: repeat(2, 1fr);
        }

        .related-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .operation-data-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .operation-data-item:nth-child(3n) {
            border-right: 1px solid #e2e8f0;
        }

        .operation-data-item:nth-child(2n) {
            border-right: none;
        }

        .operation-data-item:nth-last-child(-n+3) {
            border-bottom: 1px solid #e2e8f0;
        }

        .operation-data-item:nth-last-child(-n+2) {
            border-bottom: none;
        }

    }


    @media (max-width: 800px) {

        .operation-header {
            flex-direction: column;
        }

        .operation-actions {
            width: 100%;
        }

        .operation-actions .btn {
            flex: 1;
        }

        .operation-summary,
        .related-grid,
        .operation-data-grid,
        .operation-text-grid,
        .document-form-grid {
            grid-template-columns: 1fr;
        }

        .operation-data-item {
            border-right: none !important;
            border-bottom: 1px solid #e2e8f0 !important;
        }

        .operation-data-item:last-child {
            border-bottom: none !important;
        }

        .document-row {
            align-items: flex-start;
            flex-direction: column;
        }

        .document-actions {
            width: 100%;
        }

        .document-actions .btn {
            flex: 1;
        }

    }

</style>

@endpush


@section('content')

    {{-- =========================================================
         BREADCRUMB
    ========================================================== --}}

    <div class="operation-breadcrumb">

        <a href="{{ route('operaciones.index') }}">
            Operaciones
        </a>

        <span>›</span>

        <span class="operation-breadcrumb-current">
            {{ $operacion->numero_operacion }}
        </span>

    </div>


    {{-- =========================================================
         HEADER
    ========================================================== --}}

    <div class="operation-header">

        <div class="operation-header-left">

            <h1 class="operation-title">
                Operación {{ $operacion->numero_operacion }}
            </h1>

            <p class="operation-subtitle">
                {{ $operacion->cliente?->razon_social ?? 'Sin cliente asociado' }}
            </p>

        </div>


        <div class="operation-actions">

            <a
                href="{{ route('operaciones.index') }}"
                class="btn"
            >
                ← Volver
            </a>

            <a
                href="{{ route('operaciones.edit', $operacion) }}"
                class="btn btn-primary"
            >
                ✎ Editar operación
            </a>

        </div>

    </div>


    {{-- =========================================================
         ALERTA ÉXITO
    ========================================================== --}}

    @if(session('success'))

        <div class="operation-alert operation-alert-success">
            {{ session('success') }}
        </div>

    @endif


    {{-- =========================================================
         ERRORES
    ========================================================== --}}

    @if($errors->any())

        <div class="operation-alert operation-alert-error">

            <strong>
                No se pudo completar la acción.
            </strong>

            <ul class="operation-error-list">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- =========================================================
         RESUMEN
    ========================================================== --}}

    <div class="operation-summary">

        <div class="summary-card">

            <div class="summary-label">
                Entregas
            </div>

            <div class="summary-value">
                {{ $operacion->entregas->count() }}
            </div>

            <div class="summary-description">
                Entregas asociadas
            </div>

        </div>


        <div class="summary-card">

            <div class="summary-label">
                Documentos
            </div>

            <div class="summary-value">
                {{ $operacion->documentos->count() }}
            </div>

            <div class="summary-description">
                Documentos asociados
            </div>

        </div>


        <div class="summary-card">

            <div class="summary-label">
                Facturas
            </div>

            <div class="summary-value">
                {{ $operacion->facturas->count() }}
            </div>

            <div class="summary-description">
                Facturas asociadas
            </div>

        </div>


        <div class="summary-card">

            <div class="summary-label">
                Factoring
            </div>

            <div class="summary-value">
                {{ $operacion->factorings->count() }}
            </div>

            <div class="summary-description">
                Registros de factoring
            </div>

        </div>

    </div>


    {{-- =========================================================
         INFORMACIÓN DE LA OPERACIÓN
    ========================================================== --}}

    <section class="operation-card">

        <div class="operation-card-header">

            <div>

                <h2 class="operation-card-title">
                    Información de la operación
                </h2>

                <p class="operation-card-description">
                    Datos principales y estado actual
                </p>

            </div>

        </div>


        <div class="operation-card-body">

            <div class="operation-data-grid">

                <div class="operation-data-item">

                    <div class="operation-data-label">
                        Número de operación
                    </div>

                    <div class="operation-data-value">
                        {{ $operacion->numero_operacion }}
                    </div>

                </div>


                <div class="operation-data-item">

                    <div class="operation-data-label">
                        Cliente
                    </div>

                    <div class="operation-data-value">
                        {{ $operacion->cliente?->razon_social ?? '—' }}
                    </div>

                </div>


                <div class="operation-data-item">

                    <div class="operation-data-label">
                        RUT cliente
                    </div>

                    <div class="operation-data-value">
                        {{ $operacion->cliente?->rut ?? '—' }}
                    </div>

                </div>


                <div class="operation-data-item">

                    <div class="operation-data-label">
                        Tipo
                    </div>

                    <div class="operation-data-value">
                        {{ $operacion->tipo ?: '—' }}
                    </div>

                </div>


                <div class="operation-data-item">

                    <div class="operation-data-label">
                        Fecha de operación
                    </div>

                    <div class="operation-data-value">
                        {{ $operacion->fecha_operacion?->format('d/m/Y') ?? '—' }}
                    </div>

                </div>


                <div class="operation-data-item">

                    <div class="operation-data-label">
                        Fecha de curse
                    </div>

                    <div class="operation-data-value">
                        {{ $operacion->fecha_curse?->format('d/m/Y') ?? '—' }}
                    </div>

                </div>


                <div class="operation-data-item">

                    <div class="operation-data-label">
                        Estado
                    </div>

                    <div class="operation-data-value">

                        <span class="operation-status">

                            <span class="operation-status-dot"></span>

                            {{ ucfirst($operacion->estado) }}

                        </span>

                    </div>

                </div>


                <div class="operation-data-item">

                    <div class="operation-data-label">
                        Creada
                    </div>

                    <div class="operation-data-value">
                        {{ $operacion->created_at?->format('d/m/Y H:i') ?? '—' }}
                    </div>

                </div>


                <div class="operation-data-item">

                    <div class="operation-data-label">
                        Última modificación
                    </div>

                    <div class="operation-data-value">
                        {{ $operacion->updated_at?->format('d/m/Y H:i') ?? '—' }}
                    </div>

                </div>

            </div>


            <div class="operation-text-grid">

                <div class="operation-text-box">

                    <div class="operation-text-label">
                        Descripción
                    </div>

                    <div class="operation-text-value">

                        @if($operacion->descripcion)

                            {{ $operacion->descripcion }}

                        @else

                            <span class="operation-empty-text">
                                Sin descripción registrada.
                            </span>

                        @endif

                    </div>

                </div>


                <div class="operation-text-box">

                    <div class="operation-text-label">
                        Observaciones
                    </div>

                    <div class="operation-text-value">

                        @if($operacion->observaciones)

                            {{ $operacion->observaciones }}

                        @else

                            <span class="operation-empty-text">
                                Sin observaciones registradas.
                            </span>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- =========================================================
         DOCUMENTOS
    ========================================================== --}}

    <section class="operation-card">

        <div class="operation-card-header">

            <div>

                <h2 class="operation-card-title">
                    Documentos
                </h2>

                <p class="operation-card-description">
                    Archivos asociados directamente a esta operación
                </p>

            </div>


            <span class="status status-neutral">

                {{ $operacion->documentos->count() }}

                {{ $operacion->documentos->count() === 1 ? 'archivo' : 'archivos' }}

            </span>

        </div>


        <div class="operation-card-body">


            <div class="document-upload-box">

                <div class="document-upload-title">
                    Adjuntar nuevo documento
                </div>


                <form
                    action="{{ route('operaciones.documentos.store', $operacion) }}"
                    method="POST"
                    enctype="multipart/form-data"
                >

                    @csrf


                    <div class="document-form-grid">

                        <div class="document-form-group">

                            <label class="document-form-label">
                                Archivo *
                            </label>

                            <input
                                type="file"
                                name="archivo"
                                class="document-form-control"
                                required
                            >

                            <div class="document-form-help">
                                Tamaño máximo permitido: 10 MB.
                            </div>

                        </div>


                        <div class="document-form-group">

                            <label class="document-form-label">
                                Tipo de documento
                            </label>

                            <select
                                name="tipo"
                                class="document-form-control"
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


                        <div class="document-form-group">

                            <label class="document-form-label">
                                Descripción
                            </label>

                            <input
                                type="text"
                                name="descripcion"
                                class="document-form-control"
                                placeholder="Descripción del documento"
                            >

                        </div>


                        <div class="document-form-group">

                            <label class="document-form-label">
                                Observaciones
                            </label>

                            <input
                                type="text"
                                name="observaciones"
                                class="document-form-control"
                                placeholder="Observaciones"
                            >

                        </div>

                    </div>


                    <div class="document-form-actions">

                        <button
                            type="submit"
                            class="btn btn-primary"
                        >
                            + Adjuntar documento
                        </button>

                    </div>

                </form>

            </div>


            @if($operacion->documentos->count())

                <div class="document-list">

                    @foreach($operacion->documentos as $documento)

                        <div class="document-row">

                            <div class="document-main">

                                <div class="document-icon">
                                    ▧
                                </div>


                                <div class="document-info">

                                    <div class="document-name">
                                        {{ $documento->nombre }}
                                    </div>


                                    <div class="document-meta">

                                        {{ $documento->tipo ?: 'Documento' }}

                                        @if($documento->tamano)

                                            ·

                                            {{ number_format($documento->tamano / 1024, 0, ',', '.') }}

                                            KB

                                        @endif

                                        ·

                                        {{ $documento->created_at?->format('d/m/Y H:i') }}

                                    </div>

                                </div>

                            </div>


                            <div class="document-actions">

                                @if($documento->ruta)

                                    <a
                                        href="{{ asset('storage/' . $documento->ruta) }}"
                                        target="_blank"
                                        class="btn"
                                    >
                                        Ver
                                    </a>

                                @endif


                                <form
                                    action="{{ route('operaciones.documentos.destroy', [$operacion, $documento]) }}"
                                    method="POST"
                                    onsubmit="return confirm('¿Eliminar este documento?');"
                                >

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-danger"
                                    >
                                        Eliminar
                                    </button>

                                </form>

                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                <div class="operation-empty-state">

                    <div class="operation-empty-icon">
                        ▧
                    </div>

                    <strong>
                        No hay documentos asociados
                    </strong>

                    <p>
                        Los documentos de esta operación aparecerán aquí.
                    </p>

                </div>

            @endif

        </div>

    </section>


    {{-- =========================================================
         ENTREGAS
    ========================================================== --}}

    <section class="operation-card">

        <div class="operation-card-header">

            <div>

                <h2 class="operation-card-title">
                    Entregas
                </h2>

                <p class="operation-card-description">
                    Entregas asociadas a esta operación
                </p>

            </div>


            <a
                href="{{ route('entregas.create') }}"
                class="btn btn-primary"
            >
                + Nueva entrega
            </a>

        </div>


        <div class="operation-card-body">

            @if($operacion->entregas->count())

                <div class="operation-table-wrapper">

                    <table class="operation-table">

                        <thead>

                            <tr>

                                <th>
                                    Nº entrega
                                </th>

                                <th>
                                    Fecha
                                </th>

                                <th>
                                    Estado
                                </th>

                                <th>
                                    Descripción
                                </th>

                                <th>
                                    Acción
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($operacion->entregas as $entrega)

                                <tr>

                                    <td>

                                        <span class="operation-table-number">
                                            {{ $entrega->numero_entrega }}
                                        </span>

                                    </td>


                                    <td>
                                        {{ $entrega->fecha_entrega?->format('d/m/Y') ?? '—' }}
                                    </td>


                                    <td>

                                        <span class="status status-neutral">

                                            <span class="status-dot"></span>

                                            {{ ucfirst($entrega->estado) }}

                                        </span>

                                    </td>


                                    <td>
                                        {{ $entrega->descripcion ?: '—' }}
                                    </td>


                                    <td>

                                        <a
                                            href="{{ route('entregas.show', $entrega) }}"
                                            class="operation-table-link"
                                        >
                                            Ver detalle
                                        </a>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="operation-empty-state">

                    <div class="operation-empty-icon">
                        ▤
                    </div>

                    <strong>
                        No hay entregas registradas
                    </strong>

                    <p>
                        Las entregas relacionadas con esta operación aparecerán aquí.
                    </p>

                </div>

            @endif

        </div>

    </section>


    {{-- =========================================================
         GASTOS
    ========================================================== --}}

    <section class="operation-card">

        <div class="operation-card-header">

            <div>

                <h2 class="operation-card-title">
                    Gastos asociados
                </h2>

                <p class="operation-card-description">
                    Gastos registrados directamente en esta operación
                </p>

            </div>


            <a
                href="{{ route('gastos.create', ['operacion_id' => $operacion->id]) }}"
                class="btn btn-primary"
            >
                + Nuevo gasto
            </a>

        </div>


        <div class="operation-card-body">

            @if($operacion->gastos->count())

                <div class="operation-table-wrapper">

                    <table class="operation-table">

                        <thead>

                            <tr>

                                <th>
                                    Fecha
                                </th>

                                <th>
                                    Tipo
                                </th>

                                <th>
                                    Concepto
                                </th>

                                <th>
                                    Transportista
                                </th>

                                <th>
                                    Monto
                                </th>

                                <th>
                                    Acción
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($operacion->gastos as $gasto)

                                <tr>

                                    <td>
                                        {{ $gasto->fecha?->format('d/m/Y') ?? '—' }}
                                    </td>


                                    <td>

                                        <span class="status status-neutral">
                                            {{ $gasto->tipo ?: 'Sin especificar' }}
                                        </span>

                                    </td>


                                    <td>

                                        <span class="operation-table-number">
                                            {{ $gasto->descripcion ?: 'Sin descripción' }}
                                        </span>

                                    </td>


                                    <td>
                                        {{ $gasto->transportista?->nombre ?? '—' }}
                                    </td>


                                    <td>

                                        <span class="operation-table-amount">
                                            ${{ number_format(
                                                (float) $gasto->monto,
                                                0,
                                                ',',
                                                '.'
                                            ) }}
                                        </span>

                                    </td>


                                    <td>

                                        <a
                                            href="{{ route('gastos.show', $gasto) }}"
                                            class="operation-table-link"
                                        >
                                            Ver detalle
                                        </a>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="operation-empty-state">

                    <div class="operation-empty-icon">
                        $
                    </div>

                    <strong>
                        No hay gastos registrados
                    </strong>

                    <p>
                        Los gastos asociados a esta operación aparecerán aquí.
                    </p>

                </div>

            @endif

        </div>

    </section>


    {{-- =========================================================
         GESTIÓN RELACIONADA
    ========================================================== --}}

    <section class="operation-card">

        <div class="operation-card-header">

            <div>

                <h2 class="operation-card-title">
                    Gestión relacionada
                </h2>

                <p class="operation-card-description">
                    Información vinculada a esta operación
                </p>

            </div>

        </div>


        <div class="operation-card-body">

            <div class="related-grid">

                <div class="related-card">

                    <div class="related-label">
                        Moras
                    </div>

                    <div class="related-value">
                        {{ $operacion->morasOrigen->count() + $operacion->morasDestino->count() }}
                    </div>

                    <div class="related-description">
                        Moras relacionadas
                    </div>

                </div>


                <div class="related-card">

                    <div class="related-label">
                        Gastos
                    </div>

                    <div class="related-value">
                        {{ $operacion->gastos->count() }}
                    </div>

                    <div class="related-description">
                        Gastos registrados
                    </div>

                </div>


                <div class="related-card">

                    <div class="related-label">
                        Reclamos
                    </div>

                    <div class="related-value">
                        {{ $operacion->reclamos->count() }}
                    </div>

                    <div class="related-description">
                        Reclamos asociados
                    </div>

                </div>


                <div class="related-card">

                    <div class="related-label">
                        Juicios
                    </div>

                    <div class="related-value">
                        {{ $operacion->juicios->count() }}
                    </div>

                    <div class="related-description">
                        Juicios asociados
                    </div>

                </div>

            </div>

        </div>

    </section>

@endsection