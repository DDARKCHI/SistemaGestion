@extends('layouts.app')

@section('title', 'Ficha del trabajador')

@section('topbar_title', 'Ficha del trabajador')

@push('styles')

<style>

    .worker-detail-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 24px;
    }

    .worker-detail-title {
        margin: 0;
        color: #172033;
        font-size: 27px;
        line-height: 1.2;
        font-weight: 700;
        letter-spacing: -.025em;
    }

    .worker-detail-subtitle {
        margin: 7px 0 0;
        color: #667085;
        font-size: 13px;
    }

    .worker-detail-actions {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-shrink: 0;
    }

    .worker-detail-action {
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
    }

    .worker-detail-action:hover {
        background: #f5f8fb;
        border-color: #cbd7e3;
        color: #155a91;
    }

    .worker-detail-action-primary {
        background: #eaf3fa;
        border-color: #d4e5f2;
        color: #155a91;
    }

    .worker-detail-action-primary:hover {
        background: #dfeef8;
        border-color: #c3dbea;
        color: #124d7d;
    }

    .worker-detail-success {
        margin-bottom: 18px;
        padding: 11px 14px;
        border: 1px solid #cfe5d7;
        border-radius: 7px;
        background: #f1faf4;
        color: #287443;
        font-size: 11px;
    }

    .worker-profile-card,
    .worker-section {
        margin-bottom: 20px;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(16,47,80,.05);
        overflow: hidden;
    }

    .worker-profile-top {
        display: flex;
        align-items: center;
        gap: 17px;
        padding: 20px;
    }

    .worker-avatar {
        width: 54px;
        height: 54px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: #eaf3fa;
        color: #155a91;
        font-size: 18px;
        font-weight: 700;
    }

    .worker-profile-name {
        margin: 0;
        color: #172033;
        font-size: 18px;
        font-weight: 700;
    }

    .worker-profile-rut {
        margin-top: 5px;
        color: #667085;
        font-size: 11px;
    }

    .worker-profile-status {
        display: inline-flex;
        align-items: center;
        margin-top: 8px;
        padding: 4px 8px;
        border-radius: 5px;
        background: #f1faf4;
        color: #287443;
        font-size: 9px;
        font-weight: 600;
    }

    .worker-profile-data {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        border-top: 1px solid #edf1f5;
    }

    .worker-profile-data-item {
        min-width: 0;
        padding: 14px 18px;
        border-right: 1px solid #edf1f5;
    }

    .worker-profile-data-item:last-child {
        border-right: none;
    }

    .worker-profile-label {
        color: #98a2b3;
        font-size: 9px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .03em;
    }

    .worker-profile-value {
        margin-top: 5px;
        color: #344054;
        font-size: 11px;
        font-weight: 500;
        overflow-wrap: anywhere;
    }

    .worker-section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        min-height: 61px;
        padding: 14px 20px;
        border-bottom: 1px solid #edf1f5;
    }

    .worker-section-heading {
        min-width: 0;
    }

    .worker-section-title {
        margin: 0;
        color: #172033;
        font-size: 14px;
        font-weight: 700;
    }

    .worker-section-description {
        margin: 4px 0 0;
        color: #98a2b3;
        font-size: 10px;
    }

    .worker-section-header-actions {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-shrink: 0;
    }

    .worker-section-add {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 30px;
        padding: 6px 11px;
        border: 1px solid #d4e5f2;
        border-radius: 6px;
        background: #eaf3fa;
        color: #155a91;
        font-family: inherit;
        font-size: 10px;
        font-weight: 600;
        text-decoration: none;
        white-space: nowrap;
    }

    .worker-section-add:hover {
        background: #dfeef8;
        border-color: #c3dbea;
        color: #124d7d;
    }

    .worker-section-count {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 25px;
        height: 25px;
        padding: 0 7px;
        border-radius: 6px;
        background: #f1f4f7;
        color: #667085;
        font-size: 10px;
        font-weight: 700;
    }

    .worker-table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    .worker-table {
        width: 100%;
        min-width: 700px;
        border-collapse: collapse;
    }

    .worker-table th {
        padding: 11px 18px;
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
        color: #667085;
        text-align: left;
        font-size: 9px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .035em;
        white-space: nowrap;
    }

    .worker-table td {
        padding: 13px 18px;
        border-bottom: 1px solid #edf1f5;
        color: #344054;
        font-size: 10px;
        vertical-align: middle;
    }

    .worker-table tbody tr:last-child td {
        border-bottom: none;
    }

    .worker-table tbody tr:hover {
        background: #fbfcfe;
    }

    .worker-table strong {
        color: #172033;
        font-weight: 600;
    }

    .worker-badge {
        display: inline-flex;
        align-items: center;
        padding: 4px 7px;
        border-radius: 5px;
        background: #f1f4f7;
        color: #667085;
        font-size: 9px;
        font-weight: 600;
        white-space: nowrap;
    }

    .worker-badge-success {
        background: #f1faf4;
        color: #287443;
    }

    .worker-badge-warning {
        background: #fff8eb;
        color: #946200;
    }

    .worker-badge-danger {
        background: #fff5f3;
        color: #b9382e;
    }

    .worker-action-list {
        display: flex;
        align-items: center;
        gap: 5px;
        flex-wrap: wrap;
    }

    .worker-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 27px;
        padding: 5px 8px;
        border: 1px solid #dce3eb;
        border-radius: 5px;
        background: #ffffff;
        color: #155a91;
        font-family: inherit;
        font-size: 9px;
        font-weight: 600;
        text-decoration: none;
        white-space: nowrap;
        cursor: pointer;
    }

    .worker-action:hover {
        background: #f5f8fb;
        border-color: #cbd7e3;
    }

    .worker-action-danger {
        border-color: #efc9c5;
        background: #fff5f3;
        color: #b9382e;
    }

    .worker-action-danger:hover {
        background: #feecea;
        border-color: #eab8b2;
    }

    .worker-document-list {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        margin-top: 7px;
    }

    .worker-document {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 27px;
        padding: 5px 9px;
        border: 1px solid #dce3eb;
        border-radius: 5px;
        background: #ffffff;
        color: #155a91;
        font-size: 9px;
        font-weight: 600;
        text-decoration: none;
        white-space: nowrap;
    }

    .worker-document:hover {
        background: #f5f8fb;
        border-color: #cbd7e3;
        color: #124d7d;
    }

    .worker-document-label {
        color: #98a2b3;
        font-size: 8px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .035em;
    }

    .worker-empty {
        padding: 32px 20px;
        text-align: center;
    }

    .worker-empty-icon {
        width: 38px;
        height: 38px;
        margin: 0 auto 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 9px;
        background: #eef4f8;
        color: #155a91;
        font-size: 15px;
    }

    .worker-empty-title {
        margin: 0;
        color: #344054;
        font-size: 12px;
        font-weight: 700;
    }

    .worker-empty-text {
        max-width: 390px;
        margin: 5px auto 0;
        color: #98a2b3;
        font-size: 10px;
        line-height: 1.5;
    }

    .worker-observations {
        padding: 17px 20px;
        color: #667085;
        font-size: 11px;
        line-height: 1.6;
    }

    /* =========================================================
       CONTRATOS
    ========================================================== */

    .contract-block {
        border-bottom: 1px solid #edf1f5;
    }

    .contract-block:last-child {
        border-bottom: none;
    }

    .contract-summary {
        display: grid;
        grid-template-columns: 1.2fr 1fr 1fr 1fr auto;
        gap: 16px;
        align-items: center;
        padding: 16px 20px;
    }

    .contract-summary-item {
        min-width: 0;
    }

    .contract-summary-label {
        margin-bottom: 5px;
        color: #98a2b3;
        font-size: 8px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .035em;
    }

    .contract-summary-value {
        color: #344054;
        font-size: 10px;
    }

    .contract-summary-value strong {
        color: #172033;
    }

    .contract-actions {
        display: flex;
        justify-content: flex-end;
    }

    .contract-modification-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 30px;
        padding: 6px 10px;
        border: 1px solid #d4e5f2;
        border-radius: 6px;
        background: #eaf3fa;
        color: #155a91;
        font-size: 9px;
        font-weight: 600;
        text-decoration: none;
        white-space: nowrap;
    }

    .contract-modification-button:hover {
        background: #dfeef8;
        color: #124d7d;
    }

    .contract-history {
        margin: 0 20px 18px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        overflow: hidden;
    }

    .contract-history-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 11px 14px;
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
    }

    .contract-history-title {
        margin: 0;
        color: #344054;
        font-size: 10px;
        font-weight: 700;
    }

    .contract-history-count {
        color: #98a2b3;
        font-size: 9px;
    }

    .contract-history-item {
        display: grid;
        grid-template-columns: 85px 180px 1fr auto;
        gap: 15px;
        align-items: start;
        padding: 13px 14px;
        border-bottom: 1px solid #edf1f5;
    }

    .contract-history-item:last-child {
        border-bottom: none;
    }

    .contract-history-date {
        color: #667085;
        font-size: 9px;
    }

    .contract-history-type {
        color: #172033;
        font-size: 10px;
        font-weight: 700;
    }

    .contract-history-description {
        color: #667085;
        font-size: 9px;
        line-height: 1.5;
    }

    .contract-history-values {
        margin-top: 5px;
        color: #98a2b3;
        font-size: 9px;
    }

    .contract-document {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 27px;
        padding: 5px 9px;
        border: 1px solid #dce3eb;
        border-radius: 5px;
        background: #ffffff;
        color: #155a91;
        font-size: 9px;
        font-weight: 600;
        text-decoration: none;
        white-space: nowrap;
    }

    .contract-document:hover {
        background: #f5f8fb;
        border-color: #cbd7e3;
    }

    .contract-no-history {
        padding: 14px;
        color: #98a2b3;
        font-size: 9px;
        text-align: center;
    }

    .contract-original-documents {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        margin: 0 20px 18px;
    }

    .contract-original-document-label {
        width: 100%;
        color: #98a2b3;
        font-size: 8px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .035em;
    }

    @media (max-width: 1000px) {

        .contract-summary {
            grid-template-columns: repeat(2, 1fr);
        }

        .contract-actions {
            justify-content: flex-start;
        }

        .contract-history-item {
            grid-template-columns: 80px 1fr auto;
        }

        .contract-history-description {
            grid-column: 2 / 3;
        }

    }

    @media (max-width: 900px) {

        .worker-profile-data {
            grid-template-columns: repeat(2, 1fr);
        }

        .worker-profile-data-item:nth-child(2) {
            border-right: none;
        }

    }

    @media (max-width: 700px) {

        .worker-detail-header {
            flex-direction: column;
        }

        .worker-detail-actions {
            width: 100%;
        }

        .worker-detail-actions .worker-detail-action {
            flex: 1;
        }

        .worker-profile-top {
            align-items: flex-start;
        }

        .worker-profile-data {
            grid-template-columns: 1fr;
        }

        .worker-profile-data-item {
            border-right: none;
            border-bottom: 1px solid #edf1f5;
        }

        .worker-profile-data-item:last-child {
            border-bottom: none;
        }

        .worker-section-header {
            align-items: flex-start;
        }

        .worker-section-header-actions {
            flex-wrap: wrap;
            justify-content: flex-end;
        }

        .contract-summary {
            grid-template-columns: 1fr;
        }

        .contract-history-item {
            grid-template-columns: 1fr;
            gap: 7px;
        }

        .contract-history-description {
            grid-column: auto;
        }

        .contract-actions {
            justify-content: flex-start;
        }

    }

</style>

@endpush


@section('content')

    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="worker-detail-header">

        <div>

            <h1 class="worker-detail-title">
                Ficha del trabajador
            </h1>

            <p class="worker-detail-subtitle">
                Consulta y administra los antecedentes laborales del trabajador.
            </p>

        </div>

        <div class="worker-detail-actions">

            <a
                href="{{ route('trabajadores.index') }}"
                class="worker-detail-action"
            >
                ← Volver
            </a>

            <a
                href="{{ route('trabajadores.edit', $trabajador) }}"
                class="worker-detail-action worker-detail-action-primary"
            >
                Editar trabajador
            </a>

        </div>

    </div>


    {{-- =====================================================
         MENSAJE
    ====================================================== --}}

    @if(session('success'))

        <div class="worker-detail-success">
            {{ session('success') }}
        </div>

    @endif


    {{-- =====================================================
         PERFIL
    ====================================================== --}}

    <section class="worker-profile-card">

        <div class="worker-profile-top">

            <div class="worker-avatar">

                {{ strtoupper(
                    substr(
                        $trabajador->nombre,
                        0,
                        1
                    )
                ) }}

            </div>

            <div>

                <h2 class="worker-profile-name">
                    {{ $trabajador->nombre }}
                </h2>

                <div class="worker-profile-rut">
                    RUT {{ $trabajador->rut }}
                </div>

                <span class="worker-profile-status">
                    Trabajador registrado
                </span>

            </div>

        </div>


        <div class="worker-profile-data">

            <div class="worker-profile-data-item">

                <div class="worker-profile-label">
                    Teléfono
                </div>

                <div class="worker-profile-value">
                    {{ $trabajador->telefono ?: 'No registrado' }}
                </div>

            </div>

            <div class="worker-profile-data-item">

                <div class="worker-profile-label">
                    Correo
                </div>

                <div class="worker-profile-value">
                    {{ $trabajador->correo ?: 'No registrado' }}
                </div>

            </div>

            <div class="worker-profile-data-item">

                <div class="worker-profile-label">
                    Fecha de ingreso
                </div>

                <div class="worker-profile-value">

                    {{ $trabajador->fecha_ingreso
                        ? $trabajador->fecha_ingreso->format('d/m/Y')
                        : 'No registrada'
                    }}

                </div>

            </div>

            <div class="worker-profile-data-item">

                <div class="worker-profile-label">
                    Remuneración acordada
                </div>

                <div class="worker-profile-value">

                    @if($trabajador->remuneracion_acordada !== null)

                        ${{ number_format(
                            (float) $trabajador->remuneracion_acordada,
                            0,
                            ',',
                            '.'
                        ) }}

                    @else

                        No registrada

                    @endif

                </div>

            </div>

        </div>


        @if($trabajador->direccion)

            <div class="worker-profile-data">

                <div
                    class="worker-profile-data-item"
                    style="grid-column: 1 / -1; border-right: none;"
                >

                    <div class="worker-profile-label">
                        Dirección
                    </div>

                    <div class="worker-profile-value">
                        {{ $trabajador->direccion }}
                    </div>

                </div>

            </div>

        @endif

    </section>


    {{-- =====================================================
         OBSERVACIONES
    ====================================================== --}}

    @if($trabajador->observaciones)

        <section class="worker-section">

            <div class="worker-section-header">

                <div class="worker-section-heading">

                    <h2 class="worker-section-title">
                        Observaciones
                    </h2>

                    <p class="worker-section-description">
                        Información adicional registrada para el trabajador.
                    </p>

                </div>

            </div>

            <div class="worker-observations">
                {{ $trabajador->observaciones }}
            </div>

        </section>

    @endif


    {{-- =====================================================
         CONTRATOS
    ====================================================== --}}

    <section class="worker-section">

        <div class="worker-section-header">

            <div class="worker-section-heading">

                <h2 class="worker-section-title">
                    Contratos
                </h2>

                <p class="worker-section-description">
                    Contratos vigentes e históricos del trabajador.
                </p>

            </div>

            <div class="worker-section-header-actions">

                <a
                    href="{{ route(
                        'trabajadores.contratos.create',
                        $trabajador
                    ) }}"
                    class="worker-section-add"
                >
                    + Nuevo contrato
                </a>

                <span class="worker-section-count">
                    {{ $trabajador->contratos->count() }}
                </span>

            </div>

        </div>


        @if($trabajador->contratos->count())

            @foreach($trabajador->contratos as $contrato)

                <div class="contract-block">

                    <div class="contract-summary">

                        <div class="contract-summary-item">

                            <div class="contract-summary-label">
                                Tipo
                            </div>

                            <div class="contract-summary-value">

                                <strong>
                                    {{ $contrato->tipo }}
                                </strong>

                            </div>

                        </div>


                        <div class="contract-summary-item">

                            <div class="contract-summary-label">
                                Vigencia
                            </div>

                            <div class="contract-summary-value">

                                {{ $contrato->fecha_inicio
                                    ? $contrato->fecha_inicio->format('d/m/Y')
                                    : '—'
                                }}

                                →

                                {{ $contrato->fecha_termino
                                    ? $contrato->fecha_termino->format('d/m/Y')
                                    : 'Indefinido'
                                }}

                            </div>

                        </div>


                        <div class="contract-summary-item">

                            <div class="contract-summary-label">
                                Remuneración
                            </div>

                            <div class="contract-summary-value">

                                @if($contrato->remuneracion !== null)

                                    ${{ number_format(
                                        (float) $contrato->remuneracion,
                                        0,
                                        ',',
                                        '.'
                                    ) }}

                                @else

                                    —

                                @endif

                            </div>

                        </div>


                        <div class="contract-summary-item">

                            <div class="contract-summary-label">
                                Estado
                            </div>

                            <div class="contract-summary-value">

                                <span class="worker-badge">
                                    {{ $contrato->estado }}
                                </span>

                            </div>

                        </div>


                        <div class="contract-actions">

                            <a
                                href="{{ route(
                                    'trabajadores.contratos.modificaciones.create',
                                    [
                                        'trabajador' => $trabajador,
                                        'contrato' => $contrato,
                                    ]
                                ) }}"
                                class="contract-modification-button"
                            >
                                + Agregar modificación
                            </a>

                        </div>

                    </div>


                    @if($contrato->documentos->count())

                        <div class="contract-original-documents">

                            <div class="contract-original-document-label">
                                Documentos del contrato
                            </div>

                            @foreach($contrato->documentos as $documento)

                                <a
                                    href="{{ asset(
                                        'storage/' . $documento->ruta
                                    ) }}"
                                    target="_blank"
                                    class="contract-document"
                                >
                                    Ver {{ $documento->nombre }}
                                </a>

                            @endforeach

                        </div>

                    @endif


                    <div class="contract-history">

                        <div class="contract-history-header">

                            <h3 class="contract-history-title">
                                Historial de modificaciones y anexos
                            </h3>

                            <span class="contract-history-count">

                                {{ $contrato->modificaciones->count() }}

                                {{ $contrato->modificaciones->count() === 1
                                    ? 'registro'
                                    : 'registros'
                                }}

                            </span>

                        </div>


                        @if($contrato->modificaciones->count())

                            @foreach($contrato->modificaciones as $modificacion)

                                <div class="contract-history-item">

                                    <div class="contract-history-date">

                                        {{ $modificacion->fecha
                                            ? $modificacion->fecha->format('d/m/Y')
                                            : '—'
                                        }}

                                    </div>


                                    <div>

                                        <div class="contract-history-type">
                                            {{ $modificacion->tipo }}
                                        </div>

                                    </div>


                                    <div class="contract-history-description">

                                        {{ $modificacion->descripcion }}

                                        @if(
                                            $modificacion->nueva_remuneracion !== null
                                            ||
                                            $modificacion->nuevo_bono !== null
                                        )

                                            <div class="contract-history-values">

                                                @if(
                                                    $modificacion->nueva_remuneracion !== null
                                                )

                                                    Nueva remuneración:
                                                    ${{ number_format(
                                                        (float) $modificacion->nueva_remuneracion,
                                                        0,
                                                        ',',
                                                        '.'
                                                    ) }}

                                                @endif


                                                @if(
                                                    $modificacion->nuevo_bono !== null
                                                )

                                                    @if(
                                                        $modificacion->nueva_remuneracion !== null
                                                    )
                                                        ·
                                                    @endif

                                                    Nuevo bono:
                                                    ${{ number_format(
                                                        (float) $modificacion->nuevo_bono,
                                                        0,
                                                        ',',
                                                        '.'
                                                    ) }}

                                                @endif

                                            </div>

                                        @endif

                                    </div>


                                    <div>

                                        @if($modificacion->documentos->count())

                                            @foreach(
                                                $modificacion->documentos
                                                as $documento
                                            )

                                                <a
                                                    href="{{ asset(
                                                        'storage/' .
                                                        $documento->ruta
                                                    ) }}"
                                                    target="_blank"
                                                    class="contract-document"
                                                >
                                                    Ver documento
                                                </a>

                                            @endforeach

                                        @else

                                            <span class="worker-badge">
                                                Sin documento
                                            </span>

                                        @endif

                                    </div>

                                </div>

                            @endforeach

                        @else

                            <div class="contract-no-history">

                                Todavía no existen modificaciones o anexos
                                asociados a este contrato.

                            </div>

                        @endif

                    </div>

                </div>

            @endforeach

        @else

            <div class="worker-empty">

                <div class="worker-empty-icon">
                    ◉
                </div>

                <h3 class="worker-empty-title">
                    No hay contratos registrados
                </h3>

                <p class="worker-empty-text">
                    Los contratos y sus modificaciones históricas se administrarán desde esta sección.
                </p>

            </div>

        @endif

    </section>


    {{-- =====================================================
         HORARIOS
    ====================================================== --}}

    <section class="worker-section">

        <div class="worker-section-header">

            <div class="worker-section-heading">

                <h2 class="worker-section-title">
                    Horarios
                </h2>

                <p class="worker-section-description">
                    Horarios laborales registrados para el trabajador.
                </p>

            </div>

            <div class="worker-section-header-actions">

                <a
                    href="{{ route(
                        'trabajadores.horarios.create',
                        $trabajador
                    ) }}"
                    class="worker-section-add"
                >
                    + Nuevo horario
                </a>

                <span class="worker-section-count">
                    {{ $trabajador->horarios->count() }}
                </span>

            </div>

        </div>


        @if($trabajador->horarios->count())

            <div class="worker-table-wrapper">

                <table class="worker-table">

                    <thead>

                        <tr>

                            <th>Tipo</th>
                            <th>Día</th>
                            <th>Entrada</th>
                            <th>Salida</th>
                            <th>Horas diarias</th>
                            <th>Horas semanales</th>
                            <th>Horas mensuales</th>
                            <th>Estado</th>
                            <th>Acciones</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($trabajador->horarios as $horario)

                            <tr>

                                <td>

                                    <strong>
                                        {{ $horario->tipo }}
                                    </strong>

                                </td>

                                <td>
                                    {{ $horario->dia }}
                                </td>

                                <td>
                                    {{ $horario->hora_inicio ?: '—' }}
                                </td>

                                <td>
                                    {{ $horario->hora_termino ?: '—' }}
                                </td>

                                <td>
                                    {{ $horario->horas_diarias !== null
                                        ? $horario->horas_diarias
                                        : '—'
                                    }}
                                </td>

                                <td>
                                    {{ $horario->horas_semanales !== null
                                        ? $horario->horas_semanales
                                        : '—'
                                    }}
                                </td>

                                <td>
                                    {{ $horario->horas_mensuales !== null
                                        ? $horario->horas_mensuales
                                        : '—'
                                    }}
                                </td>

                                <td>

                                    @if($horario->estado === 'vigente')

                                        <span class="worker-badge worker-badge-success">
                                            Vigente
                                        </span>

                                    @elseif($horario->estado === 'inactivo')

                                        <span class="worker-badge worker-badge-danger">
                                            Inactivo
                                        </span>

                                    @else

                                        <span class="worker-badge">
                                            {{ $horario->estado }}
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    <div class="worker-action-list">

                                        <a
                                            href="{{ route(
                                                'trabajadores.horarios.edit',
                                                [
                                                    'trabajador' => $trabajador,
                                                    'horario' => $horario,
                                                ]
                                            ) }}"
                                            class="worker-action"
                                        >
                                            Editar
                                        </a>


                                        <form
                                            action="{{ route(
                                                'trabajadores.horarios.destroy',
                                                [
                                                    'trabajador' => $trabajador,
                                                    'horario' => $horario,
                                                ]
                                            ) }}"
                                            method="POST"
                                            onsubmit="return confirm('¿Estás seguro de eliminar este horario? Esta acción no se puede deshacer.');"
                                            style="display:inline;"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="worker-action worker-action-danger"
                                            >
                                                Eliminar
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <div class="worker-empty">

                <div class="worker-empty-icon">
                    ◷
                </div>

                <h3 class="worker-empty-title">
                    No hay horarios registrados
                </h3>

                <p class="worker-empty-text">
                    Registra aquí la jornada laboral, días, horarios y cantidad de horas correspondientes al trabajador.
                </p>

            </div>

        @endif

    </section>


    {{-- =====================================================
         REMUNERACIONES
    ====================================================== --}}

    <section class="worker-section">

        <div class="worker-section-header">

            <div class="worker-section-heading">

                <h2 class="worker-section-title">
                    Remuneraciones
                </h2>

                <p class="worker-section-description">
                    Historial mensual de remuneraciones y pagos.
                </p>

            </div>

            <div class="worker-section-header-actions">

                <a
                    href="{{ route(
                        'trabajadores.remuneraciones.create',
                        $trabajador
                    ) }}"
                    class="worker-section-add"
                >
                    + Nueva remuneración
                </a>

                <span class="worker-section-count">
                    {{ $trabajador->remuneraciones->count() }}
                </span>

            </div>

        </div>


        @if($trabajador->remuneraciones->count())

            <div class="worker-table-wrapper">

                <table class="worker-table">

                    <thead>

                        <tr>

                            <th>Período</th>
                            <th>Sueldo base</th>
                            <th>Bonificaciones</th>
                            <th>Descuentos</th>
                            <th>Líquido</th>
                            <th>Pagado</th>
                            <th>Saldo</th>
                            <th>Fecha de pago</th>
                            <th>Estado</th>
                            <th>Documentos</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($trabajador->remuneraciones as $remuneracion)

                            <tr>

                                <td>
                                    <strong>
                                        {{ $remuneracion->periodo }}
                                    </strong>
                                </td>

                                <td>
                                    ${{ number_format(
                                        (float) $remuneracion->sueldo_base,
                                        0,
                                        ',',
                                        '.'
                                    ) }}
                                </td>

                                <td>
                                    ${{ number_format(
                                        (float) $remuneracion->bonificaciones,
                                        0,
                                        ',',
                                        '.'
                                    ) }}
                                </td>

                                <td>
                                    ${{ number_format(
                                        (float) $remuneracion->descuentos,
                                        0,
                                        ',',
                                        '.'
                                    ) }}
                                </td>

                                <td>

                                    <strong>
                                        ${{ number_format(
                                            (float) $remuneracion->total_liquido,
                                            0,
                                            ',',
                                            '.'
                                        ) }}
                                    </strong>

                                </td>

                                <td>
                                    ${{ number_format(
                                        (float) $remuneracion->monto_pagado,
                                        0,
                                        ',',
                                        '.'
                                    ) }}
                                </td>

                                <td>

                                    @if(
                                        (float) $remuneracion->saldo_a_pagar > 0
                                    )

                                        <span class="worker-badge worker-badge-warning">

                                            ${{ number_format(
                                                (float) $remuneracion->saldo_a_pagar,
                                                0,
                                                ',',
                                                '.'
                                            ) }}

                                        </span>

                                    @else

                                        <span class="worker-badge worker-badge-success">
                                            Pagado
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    {{ $remuneracion->fecha_pago
                                        ? $remuneracion->fecha_pago->format('d/m/Y')
                                        : 'No registrado'
                                    }}

                                </td>

                                <td>

                                    @if($remuneracion->estado === 'pagada')

                                        <span class="worker-badge worker-badge-success">
                                            Pagada
                                        </span>

                                    @elseif(
                                        $remuneracion->estado === 'parcialmente_pagada'
                                    )

                                        <span class="worker-badge worker-badge-warning">
                                            Pago parcial
                                        </span>

                                    @else

                                        <span class="worker-badge">
                                            Pendiente
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    @if($remuneracion->documentos->count())

                                        <div class="worker-document-list">

                                            @foreach(
                                                $remuneracion->documentos
                                                as $documento
                                            )

                                                <a
                                                    href="{{ asset(
                                                        'storage/' .
                                                        $documento->ruta
                                                    ) }}"
                                                    target="_blank"
                                                    class="worker-document"
                                                    title="{{ $documento->nombre }}"
                                                >
                                                    Ver documento
                                                </a>

                                            @endforeach

                                        </div>

                                    @else

                                        <span class="worker-badge">
                                            Sin documento
                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <div class="worker-empty">

                <div class="worker-empty-icon">
                    $
                </div>

                <h3 class="worker-empty-title">
                    No hay remuneraciones registradas
                </h3>

                <p class="worker-empty-text">
                    Aquí se registrarán las remuneraciones mensuales, montos pagados, fechas reales de pago, saldos y documentos de liquidación.
                </p>

            </div>

        @endif

    </section>


    {{-- =====================================================
         VACACIONES
    ====================================================== --}}

    <section class="worker-section">

        <div class="worker-section-header">

            <div class="worker-section-heading">

                <h2 class="worker-section-title">
                    Vacaciones
                </h2>

                <p class="worker-section-description">
                    Períodos, días utilizados, reservados y pendientes.
                </p>

            </div>

            <span class="worker-section-count">
                {{ $trabajador->vacaciones->count() }}
            </span>

        </div>


        @if($trabajador->vacaciones->count())

            <div class="worker-table-wrapper">

                <table class="worker-table">

                    <thead>

                        <tr>

                            <th>Período</th>
                            <th>Días correspondientes</th>
                            <th>Días tomados</th>
                            <th>Días reservados</th>
                            <th>Días restantes</th>
                            <th>Estado</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($trabajador->vacaciones as $vacacion)

                            <tr>

                                <td>
                                    <strong>
                                        {{ $vacacion->periodo }}
                                    </strong>
                                </td>

                                <td>
                                    {{ $vacacion->dias_correspondientes }}
                                </td>

                                <td>
                                    {{ $vacacion->dias_tomados }}
                                </td>

                                <td>
                                    {{ $vacacion->dias_reservados }}
                                </td>

                                <td>
                                    {{ $vacacion->dias_restantes }}
                                </td>

                                <td>

                                    <span class="worker-badge">
                                        {{ $vacacion->estado }}
                                    </span>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <div class="worker-empty">

                <div class="worker-empty-icon">
                    ◷
                </div>

                <h3 class="worker-empty-title">
                    No hay períodos de vacaciones registrados
                </h3>

                <p class="worker-empty-text">
                    Los períodos y sus detalles de vacaciones se administrarán desde esta sección.
                </p>

            </div>

        @endif

    </section>


    {{-- =====================================================
         AUSENCIAS
    ====================================================== --}}

    <section class="worker-section">

        <div class="worker-section-header">

            <div class="worker-section-heading">

                <h2 class="worker-section-title">
                    Ausencias
                </h2>

                <p class="worker-section-description">
                    Registro histórico de ausencias del trabajador.
                </p>

            </div>

            <span class="worker-section-count">
                {{ $trabajador->ausencias->count() }}
            </span>

        </div>


        @if($trabajador->ausencias->count())

            <div class="worker-table-wrapper">

                <table class="worker-table">

                    <thead>

                        <tr>

                            <th>Desde</th>
                            <th>Hasta</th>
                            <th>Días</th>
                            <th>Tipo</th>
                            <th>Estado</th>
                            <th>Justificación</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($trabajador->ausencias as $ausencia)

                            <tr>

                                <td>
                                    {{ $ausencia->fecha_inicio
                                        ? $ausencia->fecha_inicio->format('d/m/Y')
                                        : '—'
                                    }}
                                </td>

                                <td>
                                    {{ $ausencia->fecha_termino
                                        ? $ausencia->fecha_termino->format('d/m/Y')
                                        : '—'
                                    }}
                                </td>

                                <td>
                                    {{ $ausencia->dias }}
                                </td>

                                <td>
                                    {{ $ausencia->tipo }}
                                </td>

                                <td>
                                    <span class="worker-badge">
                                        {{ $ausencia->estado }}
                                    </span>
                                </td>

                                <td>
                                    {{ $ausencia->justificacion ?: 'Sin registro' }}
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <div class="worker-empty">

                <div class="worker-empty-icon">
                    —
                </div>

                <h3 class="worker-empty-title">
                    No hay ausencias registradas
                </h3>

                <p class="worker-empty-text">
                    Las ausencias justificadas o no justificadas quedarán registradas aquí.
                </p>

            </div>

        @endif

    </section>


    {{-- =====================================================
         PERMISOS
    ====================================================== --}}

    <section class="worker-section">

        <div class="worker-section-header">

            <div class="worker-section-heading">

                <h2 class="worker-section-title">
                    Permisos
                </h2>

                <p class="worker-section-description">
                    Permisos por jornada completa o por horas, con su justificación.
                </p>

            </div>

            <span class="worker-section-count">
                {{ $trabajador->permisos->count() }}
            </span>

        </div>


        @if($trabajador->permisos->count())

            <div class="worker-table-wrapper">

                <table class="worker-table">

                    <thead>

                        <tr>

                            <th>Tipo</th>
                            <th>Desde</th>
                            <th>Hasta</th>
                            <th>Horas</th>
                            <th>Estado</th>
                            <th>Motivo</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($trabajador->permisos as $permiso)

                            <tr>

                                <td>
                                    <strong>
                                        {{ $permiso->tipo }}
                                    </strong>
                                </td>

                                <td>
                                    {{ $permiso->fecha_inicio
                                        ? $permiso->fecha_inicio->format('d/m/Y')
                                        : '—'
                                    }}
                                </td>

                                <td>
                                    {{ $permiso->fecha_termino
                                        ? $permiso->fecha_termino->format('d/m/Y')
                                        : '—'
                                    }}
                                </td>

                                <td>
                                    {{ $permiso->horas ?? '—' }}
                                </td>

                                <td>
                                    <span class="worker-badge">
                                        {{ $permiso->estado }}
                                    </span>
                                </td>

                                <td>
                                    {{ $permiso->motivo ?: 'Sin registro' }}
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <div class="worker-empty">

                <div class="worker-empty-icon">
                    +
                </div>

                <h3 class="worker-empty-title">
                    No hay permisos registrados
                </h3>

                <p class="worker-empty-text">
                    Aquí se administrarán los permisos de jornada completa o por horas, junto con sus justificaciones y documentos.
                </p>

            </div>

        @endif

    </section>


    {{-- =====================================================
         FALTAS
    ====================================================== --}}

    <section class="worker-section">

        <div class="worker-section-header">

            <div class="worker-section-heading">

                <h2 class="worker-section-title">
                    Faltas
                </h2>

                <p class="worker-section-description">
                    Registro de faltas, estados y sanciones.
                </p>

            </div>

            <span class="worker-section-count">
                {{ $trabajador->faltas->count() }}
            </span>

        </div>


        @if($trabajador->faltas->count())

            <div class="worker-table-wrapper">

                <table class="worker-table">

                    <thead>

                        <tr>

                            <th>Fecha</th>
                            <th>Tipo</th>
                            <th>Descripción</th>
                            <th>Estado</th>
                            <th>Sanción</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($trabajador->faltas as $falta)

                            <tr>

                                <td>
                                    {{ $falta->fecha
                                        ? $falta->fecha->format('d/m/Y')
                                        : '—'
                                    }}
                                </td>

                                <td>
                                    {{ $falta->tipo }}
                                </td>

                                <td>
                                    {{ $falta->descripcion ?: '—' }}
                                </td>

                                <td>
                                    <span class="worker-badge">
                                        {{ $falta->estado }}
                                    </span>
                                </td>

                                <td>
                                    {{ $falta->sancion ?: 'Sin sanción' }}
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <div class="worker-empty">

                <div class="worker-empty-icon">
                    !
                </div>

                <h3 class="worker-empty-title">
                    No hay faltas registradas
                </h3>

                <p class="worker-empty-text">
                    Las faltas y sus eventuales sanciones quedarán registradas en esta sección.
                </p>

            </div>

        @endif

    </section>


    {{-- =====================================================
         CUADRATURAS
    ====================================================== --}}

    <section class="worker-section">

        <div class="worker-section-header">

            <div class="worker-section-heading">

                <h2 class="worker-section-title">
                    Cuadraturas
                </h2>

                <p class="worker-section-description">
                    Resumen de horas, ingresos, gastos y saldos por operación.
                </p>

            </div>

            <span class="worker-section-count">
                {{ $trabajador->cuadraturas->count() }}
            </span>

        </div>


        @if($trabajador->cuadraturas->count())

            <div class="worker-table-wrapper">

                <table class="worker-table">

                    <thead>

                        <tr>

                            <th>Operación</th>
                            <th>Período</th>
                            <th>Horas</th>
                            <th>Gastos</th>
                            <th>Saldo a favor</th>
                            <th>Saldo en contra</th>
                            <th>Estado</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($trabajador->cuadraturas as $cuadratura)

                            <tr>

                                <td>

                                    <strong>

                                        {{ $cuadratura->operacion
                                            ? $cuadratura->operacion->numero_operacion
                                            : '—'
                                        }}

                                    </strong>

                                </td>

                                <td>
                                    {{ $cuadratura->periodo }}
                                </td>

                                <td>
                                    {{ $cuadratura->total_horas }}
                                </td>

                                <td>
                                    ${{ number_format(
                                        (float) $cuadratura->total_gastos,
                                        0,
                                        ',',
                                        '.'
                                    ) }}
                                </td>

                                <td>
                                    ${{ number_format(
                                        (float) $cuadratura->saldo_a_favor,
                                        0,
                                        ',',
                                        '.'
                                    ) }}
                                </td>

                                <td>
                                    ${{ number_format(
                                        (float) $cuadratura->saldo_en_contra,
                                        0,
                                        ',',
                                        '.'
                                    ) }}
                                </td>

                                <td>

                                    <span class="worker-badge">
                                        {{ $cuadratura->estado }}
                                    </span>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <div class="worker-empty">

                <div class="worker-empty-icon">
                    =
                </div>

                <h3 class="worker-empty-title">
                    No hay cuadraturas registradas
                </h3>

                <p class="worker-empty-text">
                    Las cuadraturas se relacionarán con las operaciones y permitirán controlar ingresos, gastos y saldos a favor o en contra.
                </p>

            </div>

        @endif

    </section>


    {{-- =====================================================
         DOCUMENTOS DEL TRABAJADOR
    ====================================================== --}}

    <section class="worker-section">

        <div class="worker-section-header">

            <div class="worker-section-heading">

                <h2 class="worker-section-title">
                    Documentos
                </h2>

                <p class="worker-section-description">
                    Documentación asociada directamente al trabajador.
                </p>

            </div>

            <span class="worker-section-count">
                {{ $trabajador->documentos->count() }}
            </span>

        </div>


        @if($trabajador->documentos->count())

            <div class="worker-table-wrapper">

                <table class="worker-table">

                    <thead>

                        <tr>

                            <th>Documento</th>
                            <th>Tipo</th>
                            <th>Archivo</th>
                            <th>Descripción</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($trabajador->documentos as $documento)

                            <tr>

                                <td>
                                    <strong>
                                        {{ $documento->nombre }}
                                    </strong>
                                </td>

                                <td>
                                    {{ $documento->tipo ?: '—' }}
                                </td>

                                <td>
                                    {{ $documento->mime_type ?: '—' }}
                                </td>

                                <td>
                                    {{ $documento->descripcion ?: 'Sin descripción' }}
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <div class="worker-empty">

                <div class="worker-empty-icon">
                    □
                </div>

                <h3 class="worker-empty-title">
                    No hay documentos asociados
                </h3>

                <p class="worker-empty-text">
                    Aquí podremos almacenar contratos, anexos, liquidaciones firmadas y demás documentación histórica del trabajador.
                </p>

            </div>

        @endif

    </section>

@endsection