@extends('layouts.app')

@section('title', 'Documentos')

@section('topbar_title', 'Gestión documental')

@push('styles')

<style>

    /* =========================================================
       HEADER
    ========================================================== */

    .documents-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 24px;
    }

    .documents-title {
        margin: 0;
        color: #172033;
        font-size: 27px;
        line-height: 1.2;
        font-weight: 700;
        letter-spacing: -.025em;
    }

    .documents-subtitle {
        margin: 7px 0 0;
        color: #667085;
        font-size: 13px;
    }

    .documents-header-actions {
        display: flex;
        gap: 8px;
    }

    /* =========================================================
       RESUMEN
    ========================================================== */

    .documents-summary {
        display: grid;
        grid-template-columns:
            repeat(3, 1fr);
        gap: 14px;
        margin-bottom: 20px;
    }

    .documents-summary-card {
        background: #ffffff;
        border:
            1px solid #e2e8f0;
        border-radius: 9px;
        padding: 17px 19px;
        box-shadow:
            0 2px 7px rgba(16,47,80,.04);
    }

    .documents-summary-label {
        color: #667085;
        font-size: 10px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .03em;
    }

    .documents-summary-value {
        margin-top: 7px;
        color: #172033;
        font-size: 23px;
        line-height: 1;
        font-weight: 700;
    }

    .documents-summary-description {
        margin-top: 6px;
        color: #98a2b3;
        font-size: 9px;
    }

    /* =========================================================
       CARD PRINCIPAL
    ========================================================== */

    .documents-card {
        background: #ffffff;
        border:
            1px solid #e2e8f0;
        border-radius: 10px;
        box-shadow:
            0 2px 8px rgba(16,47,80,.05);
        overflow: hidden;
    }

    .documents-card-header {
        min-height: 66px;
        padding:
            15px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        border-bottom:
            1px solid #edf1f5;
    }

    .documents-card-heading {
        min-width: 0;
    }

    .documents-card-title {
        margin: 0;
        color: #172033;
        font-size: 14px;
        font-weight: 700;
    }

    .documents-card-description {
        margin: 4px 0 0;
        color: #98a2b3;
        font-size: 10px;
    }

    /* =========================================================
       BUSCADOR
    ========================================================== */

    .documents-search {
        position: relative;
        width: 270px;
        flex-shrink: 0;
    }

    .documents-search input {
        width: 100%;
        height: 37px;
        padding:
            0 11px 0 34px;
        box-sizing: border-box;
        border:
            1px solid #d8e0e8;
        border-radius: 7px;
        background: #ffffff;
        color: #344054;
        font-family: inherit;
        font-size: 11px;
        outline: none;
    }

    .documents-search input::placeholder {
        color: #a1aab7;
    }

    .documents-search input:focus {
        border-color: #155a91;
        box-shadow:
            0 0 0 3px rgba(21,90,145,.08);
    }

    .documents-search-icon {
        position: absolute;
        left: 11px;
        top: 50%;
        transform:
            translateY(-50%);
        color: #98a2b3;
        font-size: 14px;
        pointer-events: none;
    }

    /* =========================================================
       TABLA
    ========================================================== */

    .documents-table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    .documents-table {
        width: 100%;
        min-width: 850px;
        border-collapse: collapse;
    }

    .documents-table th {
        padding:
            12px 17px;
        background: #f8fafc;
        border-bottom:
            1px solid #e2e8f0;
        color: #667085;
        text-align: left;
        font-size: 9px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .035em;
        white-space: nowrap;
    }

    .documents-table td {
        padding:
            14px 17px;
        border-bottom:
            1px solid #edf1f5;
        color: #344054;
        font-size: 10px;
        vertical-align: middle;
    }

    .documents-table tbody tr {
        transition:
            background .12s ease;
    }

    .documents-table tbody tr:hover {
        background: #fbfcfe;
    }

    .documents-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* =========================================================
       DOCUMENTO
    ========================================================== */

    .document-name {
        display: flex;
        align-items: center;
        gap: 9px;
        min-width: 200px;
    }

    .document-icon {
        width: 30px;
        height: 30px;
        min-width: 30px;
        border-radius: 7px;
        background: #eef4f8;
        color: #155a91;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 700;
    }

    .document-name-text {
        min-width: 0;
    }

    .document-name-main {
        max-width: 260px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        color: #172033;
        font-size: 11px;
        font-weight: 600;
    }

    .document-name-sub {
        margin-top: 3px;
        color: #98a2b3;
        font-size: 9px;
    }

    /* =========================================================
       TIPO
    ========================================================== */

    .document-type {
        display: inline-flex;
        align-items: center;
        padding:
            4px 7px;
        border-radius: 5px;
        background: #f1f4f7;
        color: #667085;
        font-size: 9px;
        font-weight: 600;
    }

    /* =========================================================
       REGISTRO ASOCIADO
    ========================================================== */

    .document-record {
        min-width: 160px;
    }

    .document-record-type {
        color: #98a2b3;
        font-size: 8px;
        text-transform: uppercase;
        letter-spacing: .03em;
    }

    .document-record-name {
        margin-top: 3px;
        color: #155a91;
        font-size: 10px;
        font-weight: 600;
    }

    .document-record-name a {
        color: inherit;
        text-decoration: none;
    }

    .document-record-name a:hover {
        text-decoration: underline;
    }

    .document-record-secondary {
        margin-top: 2px;
        color: #98a2b3;
        font-size: 9px;
    }

    /* =========================================================
       TAMAÑO / FECHA
    ========================================================== */

    .document-meta {
        color: #667085;
        font-size: 10px;
    }

    .document-meta-secondary {
        margin-top: 3px;
        color: #98a2b3;
        font-size: 9px;
    }

    /* =========================================================
       ACCIONES
    ========================================================== */

    .document-actions {
        display: flex;
        align-items: center;
        gap: 6px;
        white-space: nowrap;
    }

    .document-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 30px;
        padding:
            5px 9px;
        border:
            1px solid #dce3eb;
        border-radius: 6px;
        background: #ffffff;
        color: #344054;
        text-decoration: none;
        font-family: inherit;
        font-size: 9px;
        font-weight: 600;
        cursor: pointer;
        transition:
            background .12s ease,
            color .12s ease,
            border-color .12s ease;
    }

    .document-action:hover {
        background: #f5f8fb;
        border-color: #cbd7e3;
        color: #155a91;
    }

    .document-action-primary {
        background: #eaf3fa;
        border-color: #d4e5f2;
        color: #155a91;
    }

    .document-action-primary:hover {
        background: #dfeef8;
        color: #124d7d;
    }

    .document-action-danger {
        color: #b9382e;
        border-color: #f0d3cf;
    }

    .document-action-danger:hover {
        background: #fff5f3;
        color: #a52f26;
    }

    /* =========================================================
       EMPTY
    ========================================================== */

    .documents-empty {
        padding:
            55px 25px;
        text-align: center;
    }

    .documents-empty-icon {
        width: 46px;
        height: 46px;
        margin:
            0 auto 13px;
        border-radius: 10px;
        background: #eef4f8;
        color: #155a91;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 19px;
    }

    .documents-empty-title {
        margin: 0;
        color: #344054;
        font-size: 14px;
        font-weight: 700;
    }

    .documents-empty-text {
        max-width: 390px;
        margin:
            6px auto 17px;
        color: #98a2b3;
        font-size: 11px;
        line-height: 1.5;
    }

    /* =========================================================
       FOOTER
    ========================================================== */

    .documents-card-footer {
        min-height: 48px;
        padding:
            0 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-top:
            1px solid #edf1f5;
        background: #fbfcfd;
    }

    .documents-count {
        color: #98a2b3;
        font-size: 10px;
    }

    .documents-count strong {
        color: #667085;
        font-weight: 600;
    }

    /* =========================================================
       SUCCESS
    ========================================================== */

    .documents-success {
        margin-bottom: 18px;
        padding:
            11px 14px;
        border:
            1px solid #cfe5d7;
        border-radius: 7px;
        background: #f1faf4;
        color: #287443;
        font-size: 11px;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================== */

    @media (max-width: 900px) {
        .documents-summary {
            grid-template-columns:
                repeat(2, 1fr);
        }
    }

    @media (max-width: 700px) {
        .documents-header {
            flex-direction: column;
        }

        .documents-header-actions {
            width: 100%;
        }

        .documents-header-actions .btn {
            flex: 1;
        }

        .documents-summary {
            grid-template-columns: 1fr;
        }

        .documents-card-header {
            align-items: stretch;
            flex-direction: column;
        }

        .documents-search {
            width: 100%;
        }
    }

</style>

@endpush

@section('content')

    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="documents-header">

        <div>

            <h1 class="documents-title">
                Documentos
            </h1>

            <p class="documents-subtitle">
                Repositorio central de documentación del sistema.
            </p>

        </div>

        <div class="documents-header-actions">

            <a
                href="{{ route('documentos.create') }}"
                class="btn btn-primary"
            >
                + Subir documento
            </a>

        </div>

    </div>

    {{-- =====================================================
         MENSAJE
    ====================================================== --}}

    @if(session('success'))

        <div class="documents-success">
            {{ session('success') }}
        </div>

    @endif

    {{-- =====================================================
         RESUMEN
    ====================================================== --}}

    <div class="documents-summary">

        <div class="documents-summary-card">

            <div class="documents-summary-label">
                Total documentos
            </div>

            <div class="documents-summary-value">
                {{ $documentos->count() }}
            </div>

            <div class="documents-summary-description">
                Archivos almacenados
            </div>

        </div>

        <div class="documents-summary-card">

            <div class="documents-summary-label">
                Asociados
            </div>

            <div class="documents-summary-value">
                {{ $documentos->whereNotNull('documentable_id')->count() }}
            </div>

            <div class="documents-summary-description">
                Documentos vinculados a registros
            </div>

        </div>

        <div class="documents-summary-card">

            <div class="documents-summary-label">
                Últimos archivos
            </div>

            <div class="documents-summary-value">
                {{ $documentos->where('created_at', '>=', now()->subDays(30))->count() }}
            </div>

            <div class="documents-summary-description">
                Cargados durante los últimos 30 días
            </div>

        </div>

    </div>

    {{-- =====================================================
         REPOSITORIO
    ====================================================== --}}

    <section class="documents-card">

        <div class="documents-card-header">

            <div class="documents-card-heading">

                <h2 class="documents-card-title">
                    Repositorio documental
                </h2>

                <p class="documents-card-description">
                    Consulta los documentos almacenados y sus registros asociados.
                </p>

            </div>

            <div class="documents-search">

                <span class="documents-search-icon">
                    ⌕
                </span>

                <input
                    type="text"
                    id="documentSearch"
                    placeholder="Buscar documento..."
                    autocomplete="off"
                >

            </div>

        </div>

        @if($documentos->count())

            <div class="documents-table-wrapper">

                <table
                    class="documents-table"
                    id="documentsTable"
                >

                    <thead>

                        <tr>

                            <th>
                                Documento
                            </th>

                            <th>
                                Registro asociado
                            </th>

                            <th>
                                Tipo
                            </th>

                            <th>
                                Tamaño
                            </th>

                            <th>
                                Fecha
                            </th>

                            <th>
                                Acciones
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($documentos as $documento)

                            @php

                                $registro =
                                    $documento->documentable;

                                $tipoRegistro = 'Registro';

                                $nombreRegistro = 'Sin asociación';

                                $registroSecundario = null;

                                $registroUrl = null;

                                if ($registro) {

                                    if (
                                        $documento->documentable_type
                                        === \App\Models\Operacion::class
                                    ) {

                                        $tipoRegistro = 'Operación';

                                        $nombreRegistro =
                                            $registro->numero_operacion
                                            ?? 'Sin número';

                                        $registroSecundario =
                                            $registro->cliente?->razon_social;

                                        $registroUrl =
                                            route(
                                                'operaciones.show',
                                                $registro
                                            );

                                    }

                                    elseif (
                                        $documento->documentable_type
                                        === \App\Models\Entrega::class
                                    ) {

                                        $tipoRegistro = 'Entrega';

                                        $nombreRegistro =
                                            $registro->numero_entrega
                                            ?? 'Sin número';

                                        $registroUrl =
                                            route(
                                                'entregas.show',
                                                $registro
                                            );

                                    }

                                    elseif (
                                        $documento->documentable_type
                                        === \App\Models\Gasto::class
                                    ) {

                                        $tipoRegistro = 'Gasto';

                                        $nombreRegistro =
                                            $registro->descripcion
                                            ?? 'Sin concepto';

                                        $registroSecundario =
                                            'Monto: $' .
                                            number_format(
                                                $registro->monto ?? 0,
                                                0,
                                                ',',
                                                '.'
                                            );

                                        $registroUrl =
                                            route(
                                                'gastos.show',
                                                $registro
                                            );

                                    }

                                    elseif (
    $documento->documentable_type
    === \App\Models\Trabajador::class
) {

    $tipoRegistro = 'Trabajador';

    $nombreRegistro =
        $registro->nombre
        ?? 'Sin nombre';

    $registroSecundario =
        $registro->rut
            ? 'RUT: ' . $registro->rut
            : null;

    $registroUrl =
        route(
            'trabajadores.show',
            $registro
        );

}

                                    elseif (
                                        $documento->documentable_type
                                        === \App\Models\Contrato::class
                                    ) {

                                        $tipoRegistro = 'Contrato';

                                        $nombreRegistro =
                                            'Contrato #' .
                                            $registro->id;

                                    }

                                    elseif (
                                        $documento->documentable_type
                                        === \App\Models\ModificacionContrato::class
                                    ) {

                                        $tipoRegistro = 'Modificación';

                                        $nombreRegistro =
                                            'Modificación #' .
                                            $registro->id;

                                    }

                                    elseif (
                                        $documento->documentable_type
                                        === \App\Models\Permiso::class
                                    ) {

                                        $tipoRegistro = 'Permiso';

                                        $nombreRegistro =
                                            'Permiso #' .
                                            $registro->id;

                                    }

                                }

                                $tipoDocumento =
                                    $documento->tipo
                                    ? str_replace(
                                        '_',
                                        ' ',
                                        $documento->tipo
                                    )
                                    : 'Sin tipo';

                                $extension =
                                    pathinfo(
                                        $documento->nombre,
                                        PATHINFO_EXTENSION
                                    );

                            @endphp

                            <tr
                                data-document-row
                                data-search="
                                    {{ strtolower(
                                        $documento->nombre . ' ' .
                                        ($documento->tipo ?? '') . ' ' .
                                        $tipoRegistro . ' ' .
                                        $nombreRegistro . ' ' .
                                        ($registroSecundario ?? '')
                                    ) }}
                                "
                            >

                                {{-- DOCUMENTO --}}

                                <td>

                                    <div class="document-name">

                                        <div class="document-icon">

                                            {{ strtoupper(
                                                $extension ?: 'DOC'
                                            ) }}

                                        </div>

                                        <div class="document-name-text">

                                            <div class="document-name-main">
                                                {{ $documento->nombre }}
                                            </div>

                                            <div class="document-name-sub">
                                                {{ $documento->mime_type ?: 'Archivo' }}
                                            </div>

                                        </div>

                                    </div>

                                </td>

                                {{-- REGISTRO --}}

                                <td>

                                    <div class="document-record">

                                        <div class="document-record-type">
                                            {{ $tipoRegistro }}
                                        </div>

                                        <div class="document-record-name">

                                            @if($registroUrl)

                                                <a href="{{ $registroUrl }}">
                                                    {{ $nombreRegistro }}
                                                </a>

                                            @else

                                                {{ $nombreRegistro }}

                                            @endif

                                        </div>

                                        @if($registroSecundario)

                                            <div class="document-record-secondary">
                                                {{ $registroSecundario }}
                                            </div>

                                        @endif

                                    </div>

                                </td>

                                {{-- TIPO --}}

                                <td>

                                    <span class="document-type">
                                        {{ ucfirst($tipoDocumento) }}
                                    </span>

                                </td>

                                {{-- TAMAÑO --}}

                                <td>

                                    <div class="document-meta">

                                        @if($documento->tamano)

                                            {{ number_format(
                                                $documento->tamano / 1024,
                                                1
                                            ) }}
                                            KB

                                        @else

                                            —

                                        @endif

                                    </div>

                                </td>

                                {{-- FECHA --}}

                                <td>

                                    <div class="document-meta">

                                        {{ $documento->created_at->format('d/m/Y') }}

                                    </div>

                                    <div class="document-meta-secondary">

                                        {{ $documento->created_at->format('H:i') }}

                                    </div>

                                </td>

                                {{-- ACCIONES --}}

                                <td>

                                    <div class="document-actions">

                                        <a
                                            href="{{ route('documentos.show', $documento) }}"
                                            class="document-action document-action-primary"
                                        >
                                            Ver
                                        </a>

                                        <a
                                            href="{{ route('documentos.edit', $documento) }}"
                                            class="document-action"
                                        >
                                            Editar
                                        </a>

                                        <form
                                            action="{{ route('documentos.destroy', $documento) }}"
                                            method="POST"
                                            style="display:inline;"
                                            onsubmit="return confirm('¿Estás seguro de eliminar este documento?');"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="document-action document-action-danger"
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

            <div class="documents-card-footer">

                <div class="documents-count">

                    Mostrando

                    <strong id="visibleDocumentCount">
                        {{ $documentos->count() }}
                    </strong>

                    de

                    <strong>
                        {{ $documentos->count() }}
                    </strong>

                    documentos

                </div>

            </div>

        @else

            <div class="documents-empty">

                <div class="documents-empty-icon">
                    ▧
                </div>

                <h3 class="documents-empty-title">
                    No hay documentos registrados
                </h3>

                <p class="documents-empty-text">
                    Desde aquí podrás consultar la documentación almacenada en el sistema o cargar un documento asociado a un registro.
                </p>

                <a
                    href="{{ route('documentos.create') }}"
                    class="btn btn-primary"
                >
                    + Subir documento
                </a>

            </div>

        @endif

    </section>

@endsection

@push('scripts')

<script>

    document.addEventListener(
        'DOMContentLoaded',
        function () {

            const searchInput =
                document.getElementById(
                    'documentSearch'
                );

            const rows =
                document.querySelectorAll(
                    '[data-document-row]'
                );

            const visibleCount =
                document.getElementById(
                    'visibleDocumentCount'
                );

            if (
                !searchInput ||
                !rows.length
            ) {
                return;
            }

            searchInput.addEventListener(
                'input',
                function () {

                    const search =
                        this.value
                            .toLowerCase()
                            .trim();

                    let visible = 0;

                    rows.forEach(
                        function (row) {

                            const content =
                                (
                                    row.dataset.search ||
                                    ''
                                ).toLowerCase();

                            const matches =
                                content.includes(
                                    search
                                );

                            row.style.display =
                                matches
                                    ? ''
                                    : 'none';

                            if (matches) {
                                visible++;
                            }

                        }
                    );

                    if (visibleCount) {

                        visibleCount.textContent =
                            visible;

                    }

                }
            );

        }
    );

</script>

@endpush