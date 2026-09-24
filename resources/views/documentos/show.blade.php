@extends('layouts.app')

@section('title', 'Detalle del documento')

@section('topbar_title', 'Documentos')

@push('styles')
<style>
    .document-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 18px;
        color: #8a94a6;
        font-size: 12px;
    }

    .document-breadcrumb a {
        color: #667085;
        text-decoration: none;
    }

    .document-breadcrumb a:hover {
        color: #155a91;
    }

    .document-breadcrumb-current {
        color: #344054;
    }

    .document-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 20px;
        margin-bottom: 25px;
    }

    .document-header-left {
        min-width: 0;
    }

    .document-title {
        margin: 0;
        color: #172033;
        font-size: 27px;
        line-height: 1.2;
        font-weight: 700;
        letter-spacing: -.025em;
    }

    .document-subtitle {
        margin: 7px 0 0;
        color: #667085;
        font-size: 13px;
    }

    .document-actions {
        display: flex;
        gap: 9px;
        flex-shrink: 0;
    }

    .document-detail-grid {
        display: grid;
        grid-template-columns:
            minmax(0, 1.4fr)
            minmax(320px, .8fr);
        gap: 20px;
        margin-bottom: 20px;
    }

    .document-card {
        margin-bottom: 20px;
        overflow: hidden;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(16, 47, 80, .05);
    }

    .document-card-header {
        min-height: 65px;
        padding: 17px 21px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        border-bottom: 1px solid #edf1f5;
    }

    .document-card-title {
        margin: 0;
        color: #172033;
        font-size: 15px;
        font-weight: 700;
    }

    .document-card-description {
        margin: 4px 0 0;
        color: #98a2b3;
        font-size: 11px;
    }

    .document-card-body {
        padding: 21px;
    }

    .document-data-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        overflow: hidden;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
    }

    .document-data-item {
        min-height: 78px;
        padding: 16px 17px;
        border-right: 1px solid #e2e8f0;
        border-bottom: 1px solid #e2e8f0;
    }

    .document-data-item:nth-child(2n) {
        border-right: none;
    }

    .document-data-item:nth-last-child(-n+2) {
        border-bottom: none;
    }

    .document-data-label {
        margin-bottom: 7px;
        color: #8a94a6;
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: .03em;
        font-weight: 700;
    }

    .document-data-value {
        color: #344054;
        font-size: 13px;
        font-weight: 500;
        line-height: 1.5;
        word-break: break-word;
    }

    .document-text-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
        margin-top: 14px;
    }

    .document-text-box {
        min-height: 90px;
        padding: 15px 17px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
    }

    .document-text-label {
        margin-bottom: 8px;
        color: #8a94a6;
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: .03em;
        font-weight: 700;
    }

    .document-text-value {
        color: #475467;
        font-size: 13px;
        line-height: 1.6;
        white-space: pre-line;
    }

    .document-empty-text {
        color: #98a2b3;
        font-style: italic;
    }

    .linked-record {
        display: flex;
        align-items: flex-start;
        gap: 13px;
        padding: 15px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        background: #f8fafc;
    }

    .linked-icon {
        width: 39px;
        height: 39px;
        flex: 0 0 39px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 7px;
        background: #eaf3fa;
        color: #155a91;
        font-size: 8px;
        font-weight: 800;
        letter-spacing: .03em;
    }

    .linked-content {
        width: 100%;
        min-width: 0;
    }

    .linked-type {
        color: #8a94a6;
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: .04em;
        font-weight: 700;
    }

    .linked-title {
        margin: 6px 0 3px;
        color: #172033;
        font-size: 13px;
        line-height: 1.35;
        font-weight: 700;
    }

    .linked-description {
        margin: 0;
        color: #667085;
        font-size: 11px;
        line-height: 1.5;
    }

    .linked-details {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 10px;
        margin: 14px 0;
        padding-top: 12px;
        border-top: 1px solid #e2e8f0;
    }

    .linked-detail {
        display: flex;
        flex-direction: column;
        gap: 3px;
    }

    .linked-detail-label {
        color: #8a94a6;
        font-size: 9px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .03em;
    }

    .linked-detail-value {
        color: #344054;
        font-size: 11px;
        font-weight: 600;
        word-break: break-word;
    }

    .linked-record-link {
        display: inline-block;
        margin-top: 13px;
        color: #155a91;
        font-size: 11px;
        font-weight: 600;
        text-decoration: none;
    }

    .linked-record-link:hover {
        text-decoration: underline;
    }

    .document-file {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 15px 16px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        background: #f8fafc;
    }

    .document-file-icon {
        width: 39px;
        height: 39px;
        flex: 0 0 39px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 7px;
        background: #eaf3fa;
        color: #155a91;
        font-size: 8px;
        font-weight: 800;
    }

    .document-file-info {
        flex: 1;
        min-width: 0;
    }

    .document-file-name {
        overflow: hidden;
        color: #344054;
        font-size: 12px;
        font-weight: 600;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .document-file-meta {
        margin-top: 4px;
        color: #98a2b3;
        font-size: 10px;
        line-height: 1.45;
        word-break: break-word;
    }

    .document-empty-state {
        padding: 38px 20px;
        border: 1px dashed #d7dfe8;
        border-radius: 8px;
        text-align: center;
    }

    .document-empty-state strong {
        display: block;
        color: #475467;
        font-size: 12px;
    }

    .document-empty-state p {
        margin: 5px 0 0;
        color: #98a2b3;
        font-size: 11px;
    }

    @media (max-width: 900px) {
        .document-detail-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 700px) {
        .document-header {
            flex-direction: column;
        }

        .document-actions {
            width: 100%;
        }

        .document-actions .btn {
            flex: 1;
        }

        .document-data-grid {
            grid-template-columns: 1fr;
        }

        .document-data-item {
            border-right: none !important;
            border-bottom: 1px solid #e2e8f0 !important;
        }

        .document-data-item:last-child {
            border-bottom: none !important;
        }

        .document-text-grid,
        .linked-details {
            grid-template-columns: 1fr;
        }

        .document-file {
            align-items: flex-start;
            flex-wrap: wrap;
        }

        .document-file .btn {
            width: 100%;
        }
    }
</style>
@endpush


@section('content')

<div class="document-breadcrumb">

    <a href="{{ route('documentos.index') }}">
        Documentos
    </a>

    <span>›</span>

    <span class="document-breadcrumb-current">
        {{ $documento->nombre }}
    </span>

</div>


<div class="document-header">

    <div class="document-header-left">

        <h1 class="document-title">
            Detalle del documento
        </h1>

        <p class="document-subtitle">
            Información, registro asociado y archivo almacenado.
        </p>

    </div>


    <div class="document-actions">

        <a
            href="{{ route('documentos.index') }}"
            class="btn"
        >
            ← Volver
        </a>

        <a
            href="{{ route('documentos.edit', $documento) }}"
            class="btn btn-primary"
        >
            ✎ Editar documento
        </a>

    </div>

</div>


<div class="document-detail-grid">


    {{-- =========================================================
         INFORMACIÓN
    ========================================================== --}}

    <section class="document-card">

        <div class="document-card-header">

            <div>

                <h2 class="document-card-title">
                    Información del documento
                </h2>

                <p class="document-card-description">
                    Datos principales y antecedentes del archivo
                </p>

            </div>

        </div>


        <div class="document-card-body">


            <div class="document-data-grid">


                <div class="document-data-item">

                    <div class="document-data-label">
                        Nombre
                    </div>

                    <div class="document-data-value">
                        {{ $documento->nombre }}
                    </div>

                </div>


                <div class="document-data-item">

                    <div class="document-data-label">
                        Tipo
                    </div>

                    <div class="document-data-value">
                        {{ $documento->tipo
                            ? ucfirst(str_replace('_', ' ', $documento->tipo))
                            : 'Sin especificar'
                        }}
                    </div>

                </div>


                <div class="document-data-item">

                    <div class="document-data-label">
                        Formato
                    </div>

                    <div class="document-data-value">
                        {{ $documento->mime_type ?: 'No disponible' }}
                    </div>

                </div>


                <div class="document-data-item">

                    <div class="document-data-label">
                        Tamaño
                    </div>

                    <div class="document-data-value">

                        @if($documento->tamano)

                            {{ number_format(
                                $documento->tamano / 1024,
                                1,
                                ',',
                                '.'
                            ) }}
                            KB

                        @else

                            No disponible

                        @endif

                    </div>

                </div>


                <div class="document-data-item">

                    <div class="document-data-label">
                        Fecha de carga
                    </div>

                    <div class="document-data-value">
                        {{ $documento->created_at?->format('d/m/Y H:i') ?? '—' }}
                    </div>

                </div>


                <div class="document-data-item">

                    <div class="document-data-label">
                        Última modificación
                    </div>

                    <div class="document-data-value">
                        {{ $documento->updated_at?->format('d/m/Y H:i') ?? '—' }}
                    </div>

                </div>


            </div>


            <div class="document-text-grid">


                <div class="document-text-box">

                    <div class="document-text-label">
                        Descripción
                    </div>

                    <div class="document-text-value">

                        @if($documento->descripcion)

                            {{ $documento->descripcion }}

                        @else

                            <span class="document-empty-text">
                                Sin descripción registrada.
                            </span>

                        @endif

                    </div>

                </div>


                <div class="document-text-box">

                    <div class="document-text-label">
                        Observaciones
                    </div>

                    <div class="document-text-value">

                        @if($documento->observaciones)

                            {{ $documento->observaciones }}

                        @else

                            <span class="document-empty-text">
                                Sin observaciones registradas.
                            </span>

                        @endif

                    </div>

                </div>


            </div>


        </div>

    </section>



    {{-- =========================================================
         REGISTRO ASOCIADO
    ========================================================== --}}

    <section class="document-card">

        <div class="document-card-header">

            <div>

                <h2 class="document-card-title">
                    Registro asociado
                </h2>

                <p class="document-card-description">
                    Registro al que pertenece este documento
                </p>

            </div>

        </div>


        <div class="document-card-body">


            @if($documento->documentable)

                @php
                    $registro =
                        $documento->documentable;

                    $tipoRegistro =
                        class_basename($registro);
                @endphp


                <div class="linked-record">

                    <div class="linked-icon">

                        @if($tipoRegistro === 'Operacion')
                            OP
                        @elseif($tipoRegistro === 'Gasto')
                            GST
                        @elseif($tipoRegistro === 'Trabajador')
                            TRB
                        @elseif($tipoRegistro === 'Entrega')
                            ENT
                        @else
                            DOC
                        @endif

                    </div>


                    <div class="linked-content">


                        {{-- OPERACIÓN --}}

                        @if($tipoRegistro === 'Operacion')

                            <div class="linked-type">
                                Operación
                            </div>

                            <h3 class="linked-title">
                                Operación {{ $registro->numero_operacion }}
                            </h3>

                            <p class="linked-description">
                                {{ $registro->cliente?->razon_social
                                    ?? 'Sin cliente asociado'
                                }}
                            </p>


                            <div class="linked-details">

                                <div class="linked-detail">

                                    <span class="linked-detail-label">
                                        Número
                                    </span>

                                    <span class="linked-detail-value">
                                        {{ $registro->numero_operacion }}
                                    </span>

                                </div>


                                <div class="linked-detail">

                                    <span class="linked-detail-label">
                                        Cliente
                                    </span>

                                    <span class="linked-detail-value">
                                        {{ $registro->cliente?->razon_social ?? '—' }}
                                    </span>

                                </div>

                            </div>


                            <a
                                href="{{ route('operaciones.show', $registro) }}"
                                class="linked-record-link"
                            >
                                Ver operación →
                            </a>



                        {{-- GASTO --}}

                        @elseif($tipoRegistro === 'Gasto')

                            <div class="linked-type">
                                Gasto
                            </div>

                            <h3 class="linked-title">
                                Gasto #{{ $registro->id }}
                            </h3>

                            <p class="linked-description">
                                {{ $registro->descripcion ?: 'Sin descripción' }}
                            </p>


                            <div class="linked-details">

                                <div class="linked-detail">

                                    <span class="linked-detail-label">
                                        Tipo
                                    </span>

                                    <span class="linked-detail-value">
                                        {{ $registro->tipo ?: 'Sin especificar' }}
                                    </span>

                                </div>


                                <div class="linked-detail">

                                    <span class="linked-detail-label">
                                        Monto
                                    </span>

                                    <span class="linked-detail-value">
                                        ${{ number_format(
                                            (float) $registro->monto,
                                            0,
                                            ',',
                                            '.'
                                        ) }}
                                    </span>

                                </div>


                                <div class="linked-detail">

                                    <span class="linked-detail-label">
                                        Operación
                                    </span>

                                    <span class="linked-detail-value">
                                        {{ $registro->operacion?->numero_operacion ?? '—' }}
                                    </span>

                                </div>


                                <div class="linked-detail">

                                    <span class="linked-detail-label">
                                        Transportista
                                    </span>

                                    <span class="linked-detail-value">
                                        {{ $registro->transportista?->nombre ?? '—' }}
                                    </span>

                                </div>

                            </div>


                            <a
                                href="{{ route('gastos.show', $registro) }}"
                                class="linked-record-link"
                            >
                                Ver gasto →
                            </a>



                        {{-- TRABAJADOR --}}

                        @elseif($tipoRegistro === 'Trabajador')

                            <div class="linked-type">
                                Trabajador
                            </div>

                            <h3 class="linked-title">
                                {{ $registro->nombre ?: 'Trabajador #' . $registro->id }}
                            </h3>

                            <p class="linked-description">
                                {{ $registro->rut
                                    ? 'RUT ' . $registro->rut
                                    : 'Sin RUT registrado'
                                }}
                            </p>


                            <div class="linked-details">

                                <div class="linked-detail">

                                    <span class="linked-detail-label">
                                        Nombre
                                    </span>

                                    <span class="linked-detail-value">
                                        {{ $registro->nombre ?: '—' }}
                                    </span>

                                </div>


                                <div class="linked-detail">

                                    <span class="linked-detail-label">
                                        RUT
                                    </span>

                                    <span class="linked-detail-value">
                                        {{ $registro->rut ?: '—' }}
                                    </span>

                                </div>


                                @if($registro->correo)

                                    <div class="linked-detail">

                                        <span class="linked-detail-label">
                                            Correo
                                        </span>

                                        <span class="linked-detail-value">
                                            {{ $registro->correo }}
                                        </span>

                                    </div>

                                @endif


                                @if($registro->telefono)

                                    <div class="linked-detail">

                                        <span class="linked-detail-label">
                                            Teléfono
                                        </span>

                                        <span class="linked-detail-value">
                                            {{ $registro->telefono }}
                                        </span>

                                    </div>

                                @endif

                            </div>


                            <a
                                href="{{ route('trabajadores.show', $registro) }}"
                                class="linked-record-link"
                            >
                                Ver trabajador →
                            </a>



                        {{-- ENTREGA --}}

                        @elseif($tipoRegistro === 'Entrega')

                            <div class="linked-type">
                                Entrega
                            </div>

                            <h3 class="linked-title">
                                Entrega {{ $registro->numero_entrega }}
                            </h3>

                            <p class="linked-description">
                                {{ $registro->descripcion ?: 'Sin descripción' }}
                            </p>


                            <a
                                href="{{ route('entregas.show', $registro) }}"
                                class="linked-record-link"
                            >
                                Ver entrega →
                            </a>



                        {{-- OTROS --}}

                        @else

                            <div class="linked-type">
                                {{ $tipoRegistro }}
                            </div>

                            <h3 class="linked-title">
                                Registro asociado
                            </h3>

                            <p class="linked-description">
                                El documento se encuentra vinculado a este registro.
                            </p>

                        @endif


                    </div>

                </div>


            @else

                <div class="document-empty-state">

                    <strong>
                        Sin registro asociado
                    </strong>

                    <p>
                        Este documento no tiene actualmente un registro relacionado.
                    </p>

                </div>

            @endif


        </div>

    </section>


</div>



{{-- =========================================================
     ARCHIVO
========================================================== --}}

<section class="document-card">

    <div class="document-card-header">

        <div>

            <h2 class="document-card-title">
                Archivo almacenado
            </h2>

            <p class="document-card-description">
                Archivo físico asociado a este documento
            </p>

        </div>

    </div>


    <div class="document-card-body">


        <div class="document-file">

            <div class="document-file-icon">
                FILE
            </div>


            <div class="document-file-info">

                <div class="document-file-name">
                    {{ $documento->nombre }}
                </div>

                <div class="document-file-meta">

                    {{ $documento->mime_type ?: 'Archivo' }}

                    @if($documento->tamano)

                        ·

                        {{ number_format(
                            $documento->tamano / 1024,
                            1,
                            ',',
                            '.'
                        ) }}

                        KB

                    @endif

                </div>

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


    </div>

</section>

@endsection