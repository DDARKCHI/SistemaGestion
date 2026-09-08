@extends('layouts.app')

@section('title', 'Operaciones')

@section('topbar_title', 'Gestión de operaciones')

@push('styles')

<style>

    /* =========================================================
       HEADER
    ========================================================== */

    .operations-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 20px;

        margin-bottom: 25px;
    }


    .operations-title {
        margin: 0;

        color: #172033;

        font-size: 27px;
        line-height: 1.2;

        font-weight: 700;

        letter-spacing: -.025em;
    }


    .operations-subtitle {
        margin: 7px 0 0;

        color: #667085;

        font-size: 13px;
    }


    .operations-actions {
        display: flex;
        align-items: center;
        gap: 9px;
    }


    /* =========================================================
       RESUMEN
    ========================================================== */

    .operations-summary {
        display: grid;

        grid-template-columns:
            repeat(4, 1fr);

        gap: 14px;

        margin-bottom: 22px;
    }


    .operations-summary-card {
        background: #ffffff;

        border: 1px solid #e2e8f0;

        border-radius: 10px;

        padding: 18px;

        box-shadow:
            0 2px 8px rgba(16, 47, 80, .05);
    }


    .operations-summary-label {
        color: #8a94a6;

        font-size: 10px;

        text-transform: uppercase;

        letter-spacing: .05em;

        font-weight: 700;
    }


    .operations-summary-value {
        margin-top: 7px;

        color: #172033;

        font-size: 24px;

        line-height: 1;

        font-weight: 700;
    }


    .operations-summary-description {
        margin-top: 6px;

        color: #98a2b3;

        font-size: 11px;
    }


    /* =========================================================
       MAIN CARD
    ========================================================== */

    .operations-card {
        background: #ffffff;

        border: 1px solid #e2e8f0;

        border-radius: 10px;

        box-shadow:
            0 2px 8px rgba(16, 47, 80, .05);

        overflow: hidden;
    }


    .operations-card-header {
        min-height: 68px;

        padding: 16px 21px;

        border-bottom: 1px solid #edf1f5;

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 20px;
    }


    .operations-card-title {
        margin: 0;

        color: #172033;

        font-size: 15px;

        font-weight: 700;
    }


    .operations-card-description {
        margin: 4px 0 0;

        color: #98a2b3;

        font-size: 11px;
    }


    /* =========================================================
       SEARCH
    ========================================================== */

    .operations-search {
        position: relative;

        width: 280px;
    }


    .operations-search input {
        width: 100%;

        height: 37px;

        padding:
            0 12px 0 35px;

        border:
            1px solid #dce3eb;

        border-radius: 7px;

        background: #ffffff;

        color: #344054;

        font-size: 11px;

        outline: none;
    }


    .operations-search input:focus {
        border-color: #155a91;

        box-shadow:
            0 0 0 2px rgba(21, 90, 145, .08);
    }


    .operations-search-icon {
        position: absolute;

        left: 12px;

        top: 50%;

        transform:
            translateY(-50%);

        color: #98a2b3;

        font-size: 14px;

        pointer-events: none;
    }


    /* =========================================================
       TABLE
    ========================================================== */

    .operations-table-wrapper {
        overflow-x: auto;
    }


    .operations-table {
        width: 100%;

        border-collapse: collapse;
    }


    .operations-table th {
        padding:
            12px 16px;

        background: #f6f9fc;

        border-bottom:
            1px solid #e2e8f0;

        color: #7d8797;

        font-size: 10px;

        text-align: left;

        text-transform: uppercase;

        letter-spacing: .035em;

        font-weight: 700;

        white-space: nowrap;
    }


    .operations-table td {
        padding:
            15px 16px;

        border-bottom:
            1px solid #edf1f5;

        color: #475467;

        font-size: 12px;

        vertical-align: middle;
    }


    .operations-table tr:last-child td {
        border-bottom: none;
    }


    .operations-table tr:hover td {
        background: #fbfcfd;
    }


    .operation-number {
        color: #155a91;

        font-weight: 700;
    }


    .operation-client {
        color: #344054;

        font-weight: 500;
    }


    .operation-type {
        color: #667085;
    }


    .operation-date {
        color: #475467;

        white-space: nowrap;
    }


    /* =========================================================
       STATUS
    ========================================================== */

    .operation-status {
        display: inline-flex;

        align-items: center;

        gap: 6px;

        padding:
            5px 9px;

        border-radius: 5px;

        font-size: 10px;

        font-weight: 600;

        white-space: nowrap;
    }


    .operation-status-dot {
        width: 6px;

        height: 6px;

        border-radius: 50%;

        background: currentColor;
    }


    .operation-status-process {
        background: #eaf3fa;

        color: #155a91;
    }


    .operation-status-pending {
        background: #fff8e8;

        color: #a56b13;
    }


    .operation-status-complete {
        background: #edf8f2;

        color: #16804a;
    }


    .operation-status-danger {
        background: #fff1ef;

        color: #c0392b;
    }


    .operation-status-neutral {
        background: #f1f4f7;

        color: #667085;
    }


    /* =========================================================
       ACTIONS
    ========================================================== */

    .operation-actions {
        display: flex;

        align-items: center;

        gap: 6px;
    }


    .operation-action {
        min-height: 34px;

        padding:
            7px 11px;

        border:
            1px solid #dce3eb;

        border-radius: 6px;

        background: #ffffff;

        color: #475467;

        font-size: 11px;

        font-weight: 600;

        transition:
            .15s ease;
    }


    .operation-action:hover {
        background: #f6f9fc;

        border-color: #cbd5e1;

        color: #155a91;
    }


    .operation-action-primary {
        background: #155a91;

        border-color: #155a91;

        color: #ffffff;
    }


    .operation-action-primary:hover {
        background: #124d7c;

        border-color: #124d7c;

        color: #ffffff;
    }


    .operation-action-danger {
        color: #c0392b;

        border-color: #f1ceca;

        background: #ffffff;
    }


    .operation-action-danger:hover {
        background: #fff1ef;

        color: #b52f23;
    }


    .operation-action form {
        margin: 0;
    }


    /* =========================================================
       ALERT
    ========================================================== */

    .operations-alert {
        margin-bottom: 20px;

        padding:
            12px 15px;

        border-radius: 7px;

        background: #edf8f2;

        border:
            1px solid #cce8d5;

        color: #287044;

        font-size: 12px;
    }


    /* =========================================================
       EMPTY
    ========================================================== */

    .operations-empty {
        padding:
            55px 20px;

        text-align: center;
    }


    .operations-empty-icon {
        width: 48px;

        height: 48px;

        margin:
            0 auto 13px;

        border-radius: 10px;

        background: #eaf3fa;

        color: #155a91;

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 20px;
    }


    .operations-empty strong {
        display: block;

        color: #344054;

        font-size: 13px;
    }


    .operations-empty p {
        margin:
            6px 0 0;

        color: #98a2b3;

        font-size: 11px;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================== */

    @media (max-width: 1150px) {

        .operations-summary {
            grid-template-columns:
                repeat(2, 1fr);
        }

        .operations-card-header {
            align-items: flex-start;

            flex-direction: column;
        }

        .operations-search {
            width: 100%;
        }

    }


    @media (max-width: 800px) {

        .operations-header {
            flex-direction: column;
        }

        .operations-actions {
            width: 100%;
        }

        .operations-actions .btn {
            flex: 1;
        }

        .operations-summary {
            grid-template-columns: 1fr;
        }

        .operations-table {
            min-width: 900px;
        }

    }

</style>

@endpush


@section('content')


    {{-- =========================================================
         HEADER
    ========================================================== --}}

    <div class="operations-header">

        <div>

            <h1 class="operations-title">
                Operaciones
            </h1>

            <p class="operations-subtitle">
                Gestión de operaciones y órdenes de compra
            </p>

        </div>


        <div class="operations-actions">

            <a
                href="{{ route('clientes.index') }}"
                class="btn"
            >
                Clientes
            </a>


            <a
                href="{{ route('operaciones.create') }}"
                class="btn btn-primary"
            >
                + Nueva operación
            </a>

        </div>

    </div>


    {{-- =========================================================
         ALERT
    ========================================================== --}}

    @if(session('success'))

        <div class="operations-alert">

            {{ session('success') }}

        </div>

    @endif


    {{-- =========================================================
         SUMMARY
    ========================================================== --}}

    <div class="operations-summary">

        <div class="operations-summary-card">

            <div class="operations-summary-label">
                Total
            </div>

            <div class="operations-summary-value">
                {{ $operaciones->count() }}
            </div>

            <div class="operations-summary-description">
                Operaciones registradas
            </div>

        </div>


        <div class="operations-summary-card">

            <div class="operations-summary-label">
                En proceso
            </div>

            <div class="operations-summary-value">

                {{ $operaciones->where('estado', 'en_proceso')->count() }}

            </div>

            <div class="operations-summary-description">
                Operaciones actualmente en proceso
            </div>

        </div>


        <div class="operations-summary-card">

            <div class="operations-summary-label">
                Pendientes
            </div>

            <div class="operations-summary-value">

                {{ $operaciones->where('estado', 'pendiente')->count() }}

            </div>

            <div class="operations-summary-description">
                Operaciones pendientes
            </div>

        </div>


        <div class="operations-summary-card">

            <div class="operations-summary-label">
                Clientes
            </div>

            <div class="operations-summary-value">

                {{ $operaciones->pluck('cliente_id')->unique()->count() }}

            </div>

            <div class="operations-summary-description">
                Clientes con operaciones
            </div>

        </div>

    </div>


    {{-- =========================================================
         TABLE CARD
    ========================================================== --}}

    <section class="operations-card">

        <div class="operations-card-header">

            <div>

                <h2 class="operations-card-title">
                    Registro de operaciones
                </h2>

                <p class="operations-card-description">
                    Consulta y administración de las operaciones registradas
                </p>

            </div>


            <div class="operations-search">

                <span class="operations-search-icon">
                    ⌕
                </span>

                <input
                    type="text"
                    id="operationSearch"
                    placeholder="Buscar operación o cliente..."
                >

            </div>

        </div>


        {{-- =====================================================
             TABLE
        ====================================================== --}}

        @if($operaciones->count())

            <div class="operations-table-wrapper">

                <table
                    class="operations-table"
                    id="operationsTable"
                >

                    <thead>

                        <tr>

                            <th>
                                Nº operación
                            </th>

                            <th>
                                Cliente
                            </th>

                            <th>
                                Tipo
                            </th>

                            <th>
                                Fecha operación
                            </th>

                            <th>
                                Fecha curse
                            </th>

                            <th>
                                Estado
                            </th>

                            <th>
                                Acciones
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($operaciones as $operacion)

                            <tr>

                                <td>

                                    <span class="operation-number">

                                        {{ $operacion->numero_operacion }}

                                    </span>

                                </td>


                                <td>

                                    <span class="operation-client">

                                        {{ $operacion->cliente?->razon_social ?? 'Sin cliente' }}

                                    </span>

                                </td>


                                <td>

                                    <span class="operation-type">

                                        {{ $operacion->tipo ?: '—' }}

                                    </span>

                                </td>


                                <td>

                                    <span class="operation-date">

                                        {{ $operacion->fecha_operacion?->format('d/m/Y') ?? '—' }}

                                    </span>

                                </td>


                                <td>

                                    <span class="operation-date">

                                        {{ $operacion->fecha_curse?->format('d/m/Y') ?? '—' }}

                                    </span>

                                </td>


                                <td>

                                    @php

                                        $estado = strtolower(
                                            trim($operacion->estado ?? '')
                                        );

                                        $estadoClase = match($estado) {

                                            'en_proceso',
                                            'en proceso' =>
                                                'operation-status-process',

                                            'pendiente' =>
                                                'operation-status-pending',

                                            'completada',
                                            'completado',
                                            'finalizada',
                                            'finalizado' =>
                                                'operation-status-complete',

                                            'anulada',
                                            'cancelada',
                                            'cancelado' =>
                                                'operation-status-danger',

                                            default =>
                                                'operation-status-neutral',

                                        };

                                    @endphp


                                    <span
                                        class="operation-status {{ $estadoClase }}"
                                    >

                                        <span class="operation-status-dot"></span>

                                        {{ ucfirst(str_replace('_', ' ', $operacion->estado)) }}

                                    </span>

                                </td>


                                <td>

                                    <div class="operation-actions">

                                        <a
                                            href="{{ route('operaciones.show', $operacion) }}"
                                            class="operation-action operation-action-primary"
                                        >
                                            Ver
                                        </a>


                                        <a
                                            href="{{ route('operaciones.edit', $operacion) }}"
                                            class="operation-action"
                                        >
                                            Editar
                                        </a>


                                        <form
                                            action="{{ route('operaciones.destroy', $operacion) }}"
                                            method="POST"
                                            onsubmit="return confirm('¿Eliminar esta operación?');"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="operation-action operation-action-danger"
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

            <div class="operations-empty">

                <div class="operations-empty-icon">
                    ▣
                </div>

                <strong>
                    No hay operaciones registradas
                </strong>

                <p>
                    Cuando registres una operación aparecerá en este listado.
                </p>

            </div>

        @endif

    </section>

@endsection


@push('scripts')

<script>

    const searchInput =
        document.getElementById('operationSearch');

    const table =
        document.getElementById('operationsTable');


    if (searchInput && table) {

        searchInput.addEventListener(
            'input',
            function () {

                const search =
                    this.value
                        .toLowerCase()
                        .trim();


                const rows =
                    table.querySelectorAll('tbody tr');


                rows.forEach(function (row) {

                    const text =
                        row.textContent
                            .toLowerCase();


                    row.style.display =
                        text.includes(search)
                            ? ''
                            : 'none';

                });

            }
        );

    }

</script>

@endpush