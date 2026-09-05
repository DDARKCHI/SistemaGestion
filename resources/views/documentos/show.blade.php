@extends('layouts.app')

@section('title', 'Detalle del documento')

@section('content')

<div class="page-header">
    <div>
        <div class="page-kicker">DOCUMENTOS</div>
        <h1>Detalle del documento</h1>
        <p>Información y archivo asociado al registro.</p>
    </div>

    <div class="page-actions">
        <a href="{{ route('documentos.index') }}" class="btn btn-secondary">
            ← Volver
        </a>

        <a href="{{ route('documentos.edit', $documento) }}" class="btn btn-primary">
            Editar documento
        </a>
    </div>
</div>

<div class="document-detail-grid">

    <section class="panel">
        <div class="panel-header">
            <div>
                <span class="panel-kicker">INFORMACIÓN</span>
                <h2>Datos del documento</h2>
            </div>
        </div>

        <div class="info-grid">

            <div class="info-item">
                <span class="info-label">Nombre</span>
                <span class="info-value">
                    {{ $documento->nombre }}
                </span>
            </div>

            <div class="info-item">
                <span class="info-label">Tipo</span>
                <span class="info-value">
                    {{ $documento->tipo ?: 'Sin especificar' }}
                </span>
            </div>

            <div class="info-item">
                <span class="info-label">Formato</span>
                <span class="info-value">
                    {{ $documento->mime_type ?: 'No disponible' }}
                </span>
            </div>

            <div class="info-item">
                <span class="info-label">Tamaño</span>
                <span class="info-value">
                    @if($documento->tamano)
                        {{ number_format($documento->tamano / 1024, 1, ',', '.') }} KB
                    @else
                        No disponible
                    @endif
                </span>
            </div>

            <div class="info-item">
                <span class="info-label">Fecha de carga</span>
                <span class="info-value">
                    {{ $documento->created_at?->format('d/m/Y H:i') }}
                </span>
            </div>

            <div class="info-item">
                <span class="info-label">Última actualización</span>
                <span class="info-value">
                    {{ $documento->updated_at?->format('d/m/Y H:i') }}
                </span>
            </div>

        </div>

        @if($documento->descripcion)
            <div class="text-section">
                <span class="info-label">Descripción</span>
                <p>{{ $documento->descripcion }}</p>
            </div>
        @endif

        @if($documento->observaciones)
            <div class="text-section">
                <span class="info-label">Observaciones</span>
                <p>{{ $documento->observaciones }}</p>
            </div>
        @endif
    </section>


    <section class="panel">
        <div class="panel-header">
            <div>
                <span class="panel-kicker">REGISTRO ASOCIADO</span>
                <h2>Documento vinculado</h2>
            </div>
        </div>

        @if($documento->documentable)

            @php
                $registro = $documento->documentable;
                $tipoRegistro = class_basename($registro);
            @endphp

            <div class="linked-record">

                <div class="linked-icon">
                    DOC
                </div>

                <div class="linked-content">

                    @if($tipoRegistro === 'Operacion')

                        <span class="linked-type">OPERACIÓN</span>

                        <h3>
                            Operación #{{ $registro->numero_operacion }}
                        </h3>

                        <p>
                            {{ $registro->cliente?->razon_social ?? 'Cliente no disponible' }}
                        </p>

                        <a
                            href="{{ route('operaciones.show', $registro) }}"
                            class="record-link"
                        >
                            Ver operación →
                        </a>

                    @elseif($tipoRegistro === 'Entrega')

                        <span class="linked-type">ENTREGA</span>

                        <h3>
                            Entrega #{{ $registro->numero_entrega }}
                        </h3>

                        <p>
                            {{ $registro->descripcion ?: 'Sin descripción' }}
                        </p>

                        <a
                            href="{{ route('entregas.show', $registro) }}"
                            class="record-link"
                        >
                            Ver entrega →
                        </a>

                    @else

                        <span class="linked-type">
                            {{ strtoupper($tipoRegistro) }}
                        </span>

                        <h3>
                            Registro asociado
                        </h3>

                        <p>
                            El documento se encuentra vinculado a este registro.
                        </p>

                    @endif

                </div>

            </div>

        @else

            <div class="empty-state">
                <div class="empty-icon">!</div>

                <h3>Sin registro asociado</h3>

                <p>
                    Este documento no tiene actualmente un registro relacionado.
                </p>
            </div>

        @endif
    </section>

</div>


<section class="panel file-panel">

    <div class="panel-header">
        <div>
            <span class="panel-kicker">ARCHIVO</span>
            <h2>Archivo almacenado</h2>
        </div>
    </div>

    <div class="file-preview">

        <div class="file-icon">
            FILE
        </div>

        <div class="file-information">
            <strong>{{ $documento->nombre }}</strong>

            <span>
                {{ $documento->mime_type ?: 'Archivo' }}
                @if($documento->tamano)
                    · {{ number_format($documento->tamano / 1024, 1, ',', '.') }} KB
                @endif
            </span>
        </div>

        @if($documento->ruta)
            <a
                href="{{ asset('storage/' . $documento->ruta) }}"
                target="_blank"
                class="btn btn-primary"
            >
                Abrir archivo
            </a>
        @endif

    </div>

</section>


<style>

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        gap: 20px;
        margin-bottom: 24px;
    }

    .page-kicker,
    .panel-kicker,
    .linked-type {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .08em;
        color: #64748b;
    }

    .page-header h1 {
        margin: 5px 0 4px;
        font-size: 26px;
        font-weight: 700;
        color: #172033;
    }

    .page-header p {
        margin: 0;
        color: #64748b;
        font-size: 13px;
    }

    .page-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 40px;
        padding: 0 16px;
        border-radius: 7px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        border: 1px solid transparent;
        transition: .2s ease;
    }

    .btn-primary {
        background: #155a91;
        color: white;
    }

    .btn-primary:hover {
        background: #0f4672;
    }

    .btn-secondary {
        background: white;
        border-color: #d9e0e7;
        color: #334155;
    }

    .btn-secondary:hover {
        background: #f4f6f8;
    }

    .document-detail-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.4fr) minmax(320px, .8fr);
        gap: 20px;
        margin-bottom: 20px;
    }

    .panel {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 22px;
        box-shadow: 0 3px 12px rgba(15, 23, 42, .04);
    }

    .panel-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-bottom: 17px;
        margin-bottom: 18px;
        border-bottom: 1px solid #edf1f5;
    }

    .panel-header h2 {
        margin: 4px 0 0;
        font-size: 17px;
        color: #172033;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
    }

    .info-item {
        display: flex;
        flex-direction: column;
        gap: 5px;
        min-width: 0;
    }

    .info-label {
        font-size: 10px;
        font-weight: 700;
        letter-spacing: .06em;
        text-transform: uppercase;
        color: #94a3b8;
    }

    .info-value {
        color: #273449;
        font-size: 13px;
        font-weight: 500;
        word-break: break-word;
    }

    .text-section {
        margin-top: 22px;
        padding-top: 18px;
        border-top: 1px solid #edf1f5;
    }

    .text-section p {
        margin: 7px 0 0;
        color: #475569;
        font-size: 13px;
        line-height: 1.6;
        white-space: pre-line;
    }

    .linked-record {
        display: flex;
        align-items: flex-start;
        gap: 15px;
        padding: 15px;
        background: #f7f9fb;
        border: 1px solid #e7edf3;
        border-radius: 8px;
    }

    .linked-icon,
    .file-icon {
        width: 46px;
        height: 46px;
        flex: 0 0 46px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        background: #e8f1f8;
        color: #155a91;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: .04em;
    }

    .linked-content {
        min-width: 0;
    }

    .linked-content h3 {
        margin: 4px 0 3px;
        color: #172033;
        font-size: 15px;
    }

    .linked-content p {
        margin: 0 0 12px;
        color: #64748b;
        font-size: 12px;
    }

    .record-link {
        color: #155a91;
        text-decoration: none;
        font-size: 12px;
        font-weight: 700;
    }

    .record-link:hover {
        text-decoration: underline;
    }

    .empty-state {
        text-align: center;
        padding: 25px 10px;
    }

    .empty-icon {
        width: 42px;
        height: 42px;
        margin: 0 auto 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #fff7ed;
        color: #c2410c;
        font-weight: 800;
    }

    .empty-state h3 {
        margin: 0 0 5px;
        font-size: 14px;
        color: #334155;
    }

    .empty-state p {
        margin: 0;
        color: #94a3b8;
        font-size: 12px;
    }

    .file-panel {
        margin-bottom: 20px;
    }

    .file-preview {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 14px;
        border: 1px solid #e7edf3;
        border-radius: 8px;
        background: #f8fafc;
    }

    .file-information {
        flex: 1;
        min-width: 0;
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .file-information strong {
        color: #273449;
        font-size: 13px;
        word-break: break-word;
    }

    .file-information span {
        color: #94a3b8;
        font-size: 11px;
    }

    @media (max-width: 900px) {

        .document-detail-grid {
            grid-template-columns: 1fr;
        }

    }

    @media (max-width: 640px) {

        .page-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .page-actions {
            width: 100%;
        }

        .page-actions .btn {
            flex: 1;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }

        .panel {
            padding: 17px;
        }

        .file-preview {
            align-items: flex-start;
            flex-wrap: wrap;
        }

        .file-information {
            width: calc(100% - 61px);
        }

        .file-preview .btn {
            width: 100%;
        }

    }

</style>

@endsection