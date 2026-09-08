@extends('layouts.app')

@section('title', 'Notas de crédito pendientes')

@section('topbar_title', 'Notas de crédito pendientes de recuperar')

@push('styles')

<style>

    /* =========================================================
       HEADER
    ========================================================== */

    .credit-notes-header {

        display: flex;

        align-items: flex-start;

        justify-content: space-between;

        gap: 20px;

        margin-bottom: 24px;

    }



    .credit-notes-title {

        margin: 0;

        color: #172033;

        font-size: 27px;

        line-height: 1.2;

        font-weight: 700;

        letter-spacing: -.025em;

    }



    .credit-notes-subtitle {

        margin: 7px 0 0;

        color: #667085;

        font-size: 13px;

    }



    .credit-notes-header-actions {

        display: flex;

        align-items: center;

        gap: 9px;

        flex-shrink: 0;

    }



    /* =========================================================
       BOTÓN PRINCIPAL
    ========================================================== */

    .credit-notes-header-actions .btn-primary {

        display: inline-flex;

        align-items: center;

        justify-content: center;

        min-height: 37px;

        padding: 8px 14px;

        border: 1px solid #155a91;

        border-radius: 6px;

        background: #155a91;

        color: #ffffff;

        font-family: inherit;

        font-size: 11px;

        font-weight: 600;

        text-decoration: none;

        transition:
            background .12s ease,
            border-color .12s ease;

    }



    .credit-notes-header-actions .btn-primary:hover {

        background: #124d7d;

        border-color: #124d7d;

        color: #ffffff;

    }



    /* =========================================================
       MENSAJES
    ========================================================== */

    .credit-notes-alert {

        margin-bottom: 18px;

        padding: 11px 14px;

        border-radius: 7px;

        font-size: 11px;

    }



    .credit-notes-success {

        border: 1px solid #cfe5d7;

        background: #f1faf4;

        color: #287443;

    }



    .credit-notes-error {

        border: 1px solid #e9c1bc;

        background: #fff5f3;

        color: #a52f26;

    }



    /* =========================================================
       RESUMEN
    ========================================================== */

    .credit-notes-summary {

        display: grid;

        grid-template-columns: repeat(4, 1fr);

        gap: 14px;

        margin-bottom: 20px;

    }



    .credit-notes-summary-card {

        background: #ffffff;

        border: 1px solid #e2e8f0;

        border-radius: 9px;

        padding: 17px 19px;

        box-shadow:
            0 2px 7px rgba(16,47,80,.04);

    }



    .credit-notes-summary-label {

        color: #667085;

        font-size: 10px;

        font-weight: 600;

        text-transform: uppercase;

        letter-spacing: .03em;

    }



    .credit-notes-summary-value {

        margin-top: 7px;

        color: #172033;

        font-size: 23px;

        line-height: 1;

        font-weight: 700;

    }



    .credit-notes-summary-description {

        margin-top: 6px;

        color: #98a2b3;

        font-size: 9px;

    }



    .credit-notes-summary-card.pending {

        border-color: #f0d9aa;

        background: #fffaf2;

    }



    .credit-notes-summary-card.pending .credit-notes-summary-value {

        color: #a15c00;

    }



    .credit-notes-summary-card.recovered {

        border-color: #cfe5d7;

        background: #f1faf4;

    }



    .credit-notes-summary-card.recovered .credit-notes-summary-value {

        color: #287443;

    }



    .credit-notes-summary-card.amount {

        border-color: #d4e5f2;

        background: #f7fbfe;

    }



    .credit-notes-summary-card.amount .credit-notes-summary-value {

        color: #155a91;

    }



    /* =========================================================
       CARD PRINCIPAL
    ========================================================== */

    .credit-notes-card {

        background: #ffffff;

        border: 1px solid #e2e8f0;

        border-radius: 10px;

        box-shadow:
            0 2px 8px rgba(16,47,80,.05);

        overflow: hidden;

    }



    .credit-notes-card-header {

        min-height: 66px;

        padding: 15px 20px;

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 15px;

        border-bottom: 1px solid #edf1f5;

    }



    .credit-notes-card-heading {

        min-width: 0;

    }



    .credit-notes-card-title {

        margin: 0;

        color: #172033;

        font-size: 14px;

        font-weight: 700;

    }



    .credit-notes-card-description {

        margin: 4px 0 0;

        color: #98a2b3;

        font-size: 10px;

    }



    /* =========================================================
       FILTROS
    ========================================================== */

    .credit-notes-filters {

        display: flex;

        align-items: center;

        gap: 8px;

        flex-shrink: 0;

    }



    .credit-notes-search {

        position: relative;

        width: 260px;

    }



    .credit-notes-search input {

        width: 100%;

        height: 37px;

        padding: 0 11px 0 34px;

        box-sizing: border-box;

        border: 1px solid #d8e0e8;

        border-radius: 7px;

        background: #ffffff;

        color: #344054;

        font-family: inherit;

        font-size: 11px;

        outline: none;

    }



    .credit-notes-search input::placeholder {

        color: #a1aab7;

    }



    .credit-notes-search input:focus {

        border-color: #155a91;

        box-shadow:
            0 0 0 3px rgba(21,90,145,.08);

    }



    .credit-notes-search-icon {

        position: absolute;

        left: 11px;

        top: 50%;

        transform: translateY(-50%);

        color: #98a2b3;

        font-size: 14px;

        pointer-events: none;

    }



    .credit-notes-select {

        height: 37px;

        padding: 0 28px 0 10px;

        border: 1px solid #d8e0e8;

        border-radius: 7px;

        background: #ffffff;

        color: #344054;

        font-family: inherit;

        font-size: 11px;

        outline: none;

        cursor: pointer;

    }



    .credit-notes-select:focus {

        border-color: #155a91;

        box-shadow:
            0 0 0 3px rgba(21,90,145,.08);

    }



    .credit-notes-filter-button {

        min-height: 37px;

        padding: 8px 13px;

        border: 1px solid #dce3eb;

        border-radius: 6px;

        background: #ffffff;

        color: #344054;

        font-family: inherit;

        font-size: 10px;

        font-weight: 600;

        cursor: pointer;

        transition:
            background .12s ease,
            border-color .12s ease,
            color .12s ease;

    }



    .credit-notes-filter-button:hover {

        background: #f5f8fb;

        border-color: #cbd7e3;

        color: #155a91;

    }



    /* =========================================================
       TABLA
    ========================================================== */

    .credit-notes-table-wrapper {

        width: 100%;

        overflow-x: auto;

    }



    .credit-notes-table {

        width: 100%;

        border-collapse: collapse;

        min-width: 1050px;

    }



    .credit-notes-table th {

        padding: 12px 18px;

        background: #f8fafc;

        border-bottom: 1px solid #e2e8f0;

        color: #667085;

        text-align: left;

        font-size: 10px;

        font-weight: 700;

        text-transform: uppercase;

        letter-spacing: .035em;

        white-space: nowrap;

    }



    .credit-notes-table td {

        padding: 14px 18px;

        border-bottom: 1px solid #edf1f5;

        color: #344054;

        font-size: 11px;

        vertical-align: middle;

    }



    .credit-notes-table tbody tr {

        transition: background .12s ease;

    }



    .credit-notes-table tbody tr:hover {

        background: #fbfcfe;

    }



    .credit-notes-table tbody tr:last-child td {

        border-bottom: none;

    }



    /* =========================================================
       PROVEEDOR
    ========================================================== */

    .credit-notes-provider-name {

        color: #172033;

        font-size: 12px;

        font-weight: 600;

    }



    .credit-notes-provider-rut {

        display: inline-flex;

        align-items: center;

        margin-top: 4px;

        padding: 4px 7px;

        border-radius: 5px;

        background: #f1f4f7;

        color: #667085;

        font-size: 10px;

        font-weight: 600;

    }



    /* =========================================================
       NÚMERO Y DATOS
    ========================================================== */

    .credit-notes-number {

        color: #155a91;

        font-size: 11px;

        font-weight: 600;

        text-decoration: none;

    }



    .credit-notes-number:hover {

        color: #124d7d;

        text-decoration: underline;

    }



    .credit-notes-date {

        color: #667085;

        white-space: nowrap;

    }



    .credit-notes-amount {

        color: #172033;

        font-size: 12px;

        font-weight: 700;

        white-space: nowrap;

    }



    .credit-notes-reason {

        max-width: 230px;

        color: #667085;

        font-size: 10px;

        line-height: 1.4;

    }



    /* =========================================================
       ESTADOS
    ========================================================== */

    .credit-notes-status {

        display: inline-flex;

        align-items: center;

        justify-content: center;

        min-height: 25px;

        padding: 4px 8px;

        border-radius: 6px;

        font-size: 10px;

        font-weight: 700;

        white-space: nowrap;

    }



    .credit-notes-status-pending {

        background: #fff5e8;

        color: #a15c00;

    }



    .credit-notes-status-recovered {

        background: #f1faf4;

        color: #287443;

    }



    /* =========================================================
       ACCIONES
    ========================================================== */

    .credit-notes-actions {

        display: flex;

        align-items: center;

        gap: 6px;

        white-space: nowrap;

    }



    .credit-notes-action {

        display: inline-flex;

        align-items: center;

        justify-content: center;

        min-height: 32px;

        padding: 6px 10px;

        border: 1px solid #dce3eb;

        border-radius: 6px;

        background: #ffffff;

        color: #344054;

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



    .credit-notes-action:hover {

        background: #f5f8fb;

        border-color: #cbd7e3;

        color: #155a91;

    }



    .credit-notes-action-primary {

        background: #eaf3fa;

        border-color: #d4e5f2;

        color: #155a91;

    }



    .credit-notes-action-primary:hover {

        background: #dfeef8;

        border-color: #c3dbea;

        color: #124d7d;

    }



    .credit-notes-action-danger {

        color: #a52f26;

    }



    .credit-notes-action-danger:hover {

        background: #fff5f3;

        border-color: #e9c1bc;

        color: #8f251e;

    }



    /* =========================================================
       PIE
    ========================================================== */

    .credit-notes-card-footer {

        min-height: 48px;

        padding: 0 20px;

        display: flex;

        align-items: center;

        justify-content: space-between;

        border-top: 1px solid #edf1f5;

        background: #fbfcfd;

    }



    .credit-notes-count {

        color: #98a2b3;

        font-size: 10px;

    }



    .credit-notes-count strong {

        color: #667085;

        font-weight: 600;

    }



    .credit-notes-footer-description {

        color: #98a2b3;

        font-size: 10px;

    }



    /* =========================================================
       ESTADO VACÍO
    ========================================================== */

    .credit-notes-empty {

        padding: 55px 25px;

        text-align: center;

    }



    .credit-notes-empty-icon {

        width: 46px;

        height: 46px;

        margin: 0 auto 13px;

        border-radius: 10px;

        background: #eef4f8;

        color: #155a91;

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 19px;

    }



    .credit-notes-empty-title {

        margin: 0;

        color: #344054;

        font-size: 14px;

        font-weight: 700;

    }



    .credit-notes-empty-text {

        max-width: 390px;

        margin: 6px auto 17px;

        color: #98a2b3;

        font-size: 11px;

        line-height: 1.5;

    }



    .credit-notes-empty .btn-primary {

        display: inline-flex;

        align-items: center;

        justify-content: center;

        min-height: 37px;

        padding: 8px 14px;

        border: 1px solid #155a91;

        border-radius: 6px;

        background: #155a91;

        color: #ffffff;

        font-family: inherit;

        font-size: 11px;

        font-weight: 600;

        text-decoration: none;

    }



    .credit-notes-empty .btn-primary:hover {

        background: #124d7d;

        border-color: #124d7d;

        color: #ffffff;

    }



    /* =========================================================
       RESPONSIVE
    ========================================================== */

    @media (max-width: 1150px) {

        .credit-notes-summary {

            grid-template-columns: repeat(2, 1fr);

        }



        .credit-notes-card-header {

            align-items: stretch;

            flex-direction: column;

        }



        .credit-notes-filters {

            width: 100%;

        }



        .credit-notes-search {

            flex: 1;

            width: auto;

        }

    }



    @media (max-width: 700px) {

        .credit-notes-header {

            flex-direction: column;

        }



        .credit-notes-header-actions {

            width: 100%;

        }



        .credit-notes-header-actions .btn {

            width: 100%;

        }



        .credit-notes-summary {

            grid-template-columns: 1fr;

        }



        .credit-notes-filters {

            align-items: stretch;

            flex-direction: column;

        }



        .credit-notes-search,

        .credit-notes-select,

        .credit-notes-filter-button {

            width: 100%;

        }



        .credit-notes-card-footer {

            align-items: flex-start;

            flex-direction: column;

            justify-content: center;

            gap: 5px;

            padding-top: 10px;

            padding-bottom: 10px;

        }

    }

</style>

@endpush


@section('content')

    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="credit-notes-header">

        <div>

            <h1 class="credit-notes-title">
                Notas de crédito pendientes de recuperar
            </h1>

            <p class="credit-notes-subtitle">
                Control y seguimiento de las notas de crédito emitidas por proveedores
                que aún deben ser recuperadas.
            </p>

        </div>


        <div class="credit-notes-header-actions">

            <a
                href="{{ route('notas-credito-proveedores.create') }}"
                class="btn btn-primary"
            >
                + Nueva nota de crédito
            </a>

        </div>

    </div>


    {{-- =====================================================
         MENSAJES
    ====================================================== --}}

    @if(session('success'))

        <div class="credit-notes-alert credit-notes-success">

            {{ session('success') }}

        </div>

    @endif


    @if(session('error'))

        <div class="credit-notes-alert credit-notes-error">

            {{ session('error') }}

        </div>

    @endif


    {{-- =====================================================
         RESUMEN
    ====================================================== --}}

    <div class="credit-notes-summary">

        <div class="credit-notes-summary-card pending">

            <div class="credit-notes-summary-label">
                Pendientes
            </div>

            <div class="credit-notes-summary-value">
                {{ $cantidadPendientes }}
            </div>

            <div class="credit-notes-summary-description">
                Notas aún no recuperadas
            </div>

        </div>


        <div class="credit-notes-summary-card amount">

            <div class="credit-notes-summary-label">
                Monto pendiente
            </div>

            <div class="credit-notes-summary-value">
                ${{ number_format((float) $totalPendiente, 0, ',', '.') }}
            </div>

            <div class="credit-notes-summary-description">
                Valor total por recuperar
            </div>

        </div>


        <div class="credit-notes-summary-card recovered">

            <div class="credit-notes-summary-label">
                Recuperadas
            </div>

            <div class="credit-notes-summary-value">
                {{ $cantidadRecuperadas }}
            </div>

            <div class="credit-notes-summary-description">
                Notas ya recuperadas
            </div>

        </div>


        <div class="credit-notes-summary-card">

            <div class="credit-notes-summary-label">
                Monto recuperado
            </div>

            <div class="credit-notes-summary-value">
                ${{ number_format((float) $totalRecuperado, 0, ',', '.') }}
            </div>

            <div class="credit-notes-summary-description">
                Valor total recuperado
            </div>

        </div>

    </div>


    {{-- =====================================================
         LISTADO
    ====================================================== --}}

    <section class="credit-notes-card">

        <div class="credit-notes-card-header">

            <div class="credit-notes-card-heading">

                <h2 class="credit-notes-card-title">
                    Registro de notas de crédito
                </h2>

                <p class="credit-notes-card-description">
                    Consulta y administra las notas de crédito de proveedores.
                </p>

            </div>


            <form
                action="{{ route('notas-credito-proveedores.index') }}"
                method="GET"
                class="credit-notes-filters"
            >

                <div class="credit-notes-search">

                    <span class="credit-notes-search-icon">
                        ⌕
                    </span>

                    <input
                        type="text"
                        name="buscar"
                        value="{{ $buscar }}"
                        placeholder="Buscar proveedor, RUT o número..."
                        autocomplete="off"
                    >

                </div>


                <select
                    name="estado"
                    class="credit-notes-select"
                >

                    <option
                        value="pendiente"
                        {{ $estado === 'pendiente' ? 'selected' : '' }}
                    >
                        Pendientes
                    </option>

                    <option
                        value="recuperada"
                        {{ $estado === 'recuperada' ? 'selected' : '' }}
                    >
                        Recuperadas
                    </option>

                    <option
                        value="todos"
                        {{ $estado === 'todos' ? 'selected' : '' }}
                    >
                        Todas
                    </option>

                </select>


                <button
                    type="submit"
                    class="credit-notes-filter-button"
                >
                    Filtrar
                </button>

            </form>

        </div>


        @if($notasCredito->count())

            <div class="credit-notes-table-wrapper">

                <table class="credit-notes-table">

                    <thead>

                        <tr>

                            <th>
                                Proveedor
                            </th>

                            <th>
                                N.º nota
                            </th>

                            <th>
                                Fecha
                            </th>

                            <th>
                                Monto
                            </th>

                            <th>
                                Motivo
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

                        @foreach($notasCredito as $notaCredito)

                            <tr>

                                {{-- PROVEEDOR --}}

                                <td>

                                    <div class="credit-notes-provider-name">
                                        {{ $notaCredito->proveedor->nombre }}
                                    </div>

                                    <span class="credit-notes-provider-rut">
                                        {{ $notaCredito->proveedor->rut }}
                                    </span>

                                </td>


                                {{-- NÚMERO --}}

                                <td>

                                    <a
                                        href="{{ route('notas-credito-proveedores.show', $notaCredito) }}"
                                        class="credit-notes-number"
                                    >
                                        {{ $notaCredito->numero_nota }}
                                    </a>

                                </td>


                                {{-- FECHA --}}

                                <td class="credit-notes-date">

                                    {{ $notaCredito->fecha?->format('d/m/Y') ?? '—' }}

                                </td>


                                {{-- MONTO --}}

                                <td class="credit-notes-amount">

                                    ${{ number_format((float) $notaCredito->monto, 0, ',', '.') }}

                                </td>


                                {{-- MOTIVO --}}

                                <td class="credit-notes-reason">

                                    {{ $notaCredito->motivo ?: 'Sin motivo registrado' }}

                                </td>


                                {{-- ESTADO --}}

                                <td>

                                    @if($notaCredito->estado === 'pendiente')

                                        <span class="credit-notes-status credit-notes-status-pending">
                                            Pendiente
                                        </span>

                                    @else

                                        <span class="credit-notes-status credit-notes-status-recovered">
                                            Recuperada
                                        </span>

                                    @endif

                                </td>


                                {{-- ACCIONES --}}

                                <td>

                                    <div class="credit-notes-actions">

                                        <a
                                            href="{{ route('notas-credito-proveedores.show', $notaCredito) }}"
                                            class="credit-notes-action credit-notes-action-primary"
                                        >
                                            Ver
                                        </a>


                                        <a
                                            href="{{ route('notas-credito-proveedores.edit', $notaCredito) }}"
                                            class="credit-notes-action"
                                        >
                                            Editar
                                        </a>


                                        <form
                                            action="{{ route('notas-credito-proveedores.destroy', $notaCredito) }}"
                                            method="POST"
                                            onsubmit="return confirm('¿Está seguro de eliminar esta nota de crédito?');"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="credit-notes-action credit-notes-action-danger"
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


            {{-- =================================================
                 PIE
            ================================================== --}}

            <div class="credit-notes-card-footer">

                <div class="credit-notes-count">

                    Mostrando

                    <strong>
                        {{ $notasCredito->count() }}
                    </strong>

                    {{ $notasCredito->count() === 1 ? 'registro' : 'registros' }}

                </div>


                <div class="credit-notes-footer-description">

                    Las notas permanecen asociadas directamente a su proveedor.

                </div>

            </div>


        @else

            {{-- =================================================
                 ESTADO VACÍO
            ================================================== --}}

            <div class="credit-notes-empty">

                <div class="credit-notes-empty-icon">
                    ◉
                </div>


                <h3 class="credit-notes-empty-title">
                    No hay notas de crédito para mostrar
                </h3>


                <p class="credit-notes-empty-text">

                    No existen registros que coincidan con los filtros seleccionados.
                    Puede registrar una nueva nota de crédito utilizando el botón superior.

                </p>


                <a
                    href="{{ route('notas-credito-proveedores.create') }}"
                    class="btn btn-primary"
                >
                    + Registrar nota de crédito
                </a>

            </div>

        @endif

    </section>

@endsection