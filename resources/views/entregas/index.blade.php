@extends('layouts.app')

@section('title', 'Entregas')

@section('topbar_title', 'Gestión de entregas')

@push('styles')

<style>

    /* =========================================================
       HEADER
    ========================================================== */

    .deliveries-header {

        display: flex;

        align-items: flex-start;

        justify-content: space-between;

        gap: 20px;

        margin-bottom: 24px;

    }

    .deliveries-title {

        margin: 0;

        color: #172033;

        font-size: 27px;

        line-height: 1.2;

        font-weight: 700;

        letter-spacing: -.025em;

    }

    .deliveries-subtitle {

        margin: 7px 0 0;

        color: #667085;

        font-size: 13px;

    }

    .deliveries-header-actions {

        display: flex;

        align-items: center;

        gap: 9px;

        flex-shrink: 0;

    }


    /* =========================================================
       BOTONES
    ========================================================== */

    .deliveries-button {

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

    .deliveries-button-primary {

        border: 1px solid #155a91;

        background: #155a91;

        color: #ffffff;

    }

    .deliveries-button-primary:hover {

        background: #124d7d;

        border-color: #124d7d;

        color: #ffffff;

    }

    .deliveries-button-secondary {

        border: 1px solid #dce3eb;

        background: #ffffff;

        color: #344054;

    }

    .deliveries-button-secondary:hover {

        background: #f5f8fb;

        border-color: #cbd7e3;

        color: #155a91;

    }


    /* =========================================================
       MENSAJES
    ========================================================== */

    .deliveries-alert {

        margin-bottom: 18px;

        padding: 11px 14px;

        border-radius: 7px;

        font-size: 11px;

    }

    .deliveries-success {

        border: 1px solid #cfe5d7;

        background: #f1faf4;

        color: #287443;

    }

    .deliveries-error {

        border: 1px solid #e9c1bc;

        background: #fff5f3;

        color: #a52f26;

    }


    /* =========================================================
       RESUMEN
    ========================================================== */

    .deliveries-summary {

        display: grid;

        grid-template-columns: repeat(3, 1fr);

        gap: 14px;

        margin-bottom: 20px;

    }

    .deliveries-summary-card {

        background: #ffffff;

        border: 1px solid #e2e8f0;

        border-radius: 9px;

        padding: 17px 19px;

        box-shadow:
            0 2px 7px rgba(16,47,80,.04);

    }

    .deliveries-summary-label {

        color: #667085;

        font-size: 10px;

        font-weight: 600;

        text-transform: uppercase;

        letter-spacing: .03em;

    }

    .deliveries-summary-value {

        margin-top: 7px;

        color: #172033;

        font-size: 23px;

        line-height: 1;

        font-weight: 700;

    }

    .deliveries-summary-description {

        margin-top: 6px;

        color: #98a2b3;

        font-size: 9px;

    }


    /* =========================================================
       CARD
    ========================================================== */

    .deliveries-card {

        background: #ffffff;

        border: 1px solid #e2e8f0;

        border-radius: 10px;

        box-shadow:
            0 2px 8px rgba(16,47,80,.05);

        overflow: hidden;

    }

    .deliveries-card-header {

        min-height: 66px;

        padding: 15px 20px;

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 15px;

        border-bottom: 1px solid #edf1f5;

    }

    .deliveries-card-heading {

        min-width: 0;

    }

    .deliveries-card-title {

        margin: 0;

        color: #172033;

        font-size: 14px;

        font-weight: 700;

    }

    .deliveries-card-description {

        margin: 4px 0 0;

        color: #98a2b3;

        font-size: 10px;

    }


    /* =========================================================
       BUSCADOR
    ========================================================== */

    .deliveries-search {

        position: relative;

        width: 270px;

        flex-shrink: 0;

    }

    .deliveries-search input {

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

    .deliveries-search input::placeholder {

        color: #a1aab7;

    }

    .deliveries-search input:focus {

        border-color: #155a91;

        box-shadow:
            0 0 0 3px rgba(21,90,145,.08);

    }

    .deliveries-search-icon {

        position: absolute;

        left: 11px;

        top: 50%;

        transform: translateY(-50%);

        color: #98a2b3;

        font-size: 14px;

        pointer-events: none;

    }


    /* =========================================================
       TABLA
    ========================================================== */

    .deliveries-table-wrapper {

        width: 100%;

        overflow-x: auto;

    }

    .deliveries-table {

        width: 100%;

        border-collapse: collapse;

        min-width: 980px;

    }

    .deliveries-table th {

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

    .deliveries-table td {

        padding: 14px 18px;

        border-bottom: 1px solid #edf1f5;

        color: #344054;

        font-size: 11px;

        vertical-align: middle;

    }

    .deliveries-table tbody tr {

        transition:
            background .12s ease;

    }

    .deliveries-table tbody tr:hover {

        background: #fbfcfe;

    }

    .deliveries-table tbody tr:last-child td {

        border-bottom: none;

    }


    /* =========================================================
       DATOS
    ========================================================== */

    .delivery-number {

        color: #172033;

        font-size: 12px;

        font-weight: 700;

    }

    .delivery-operation {

        color: #155a91;

        font-size: 11px;

        font-weight: 600;

        text-decoration: none;

    }

    .delivery-operation:hover {

        color: #124d7d;

        text-decoration: underline;

    }

    .delivery-client {

        color: #344054;

        font-size: 11px;

    }

    .delivery-date {

        color: #667085;

        white-space: nowrap;

    }


    /* =========================================================
       ESTADO
    ========================================================== */

    .delivery-status {

        display: inline-flex;

        align-items: center;

        min-height: 25px;

        padding: 4px 8px;

        border-radius: 6px;

        background: #f1f4f7;

        color: #475467;

        font-size: 10px;

        font-weight: 700;

        white-space: nowrap;

        text-transform: capitalize;

    }

    .delivery-status.entregada {

        background: #f1faf4;

        color: #287443;

    }

    .delivery-status.pendiente {

        background: #fff5e8;

        color: #a15c00;

    }

    .delivery-status.cancelada {

        background: #fff5f3;

        color: #a52f26;

    }


    /* =========================================================
       ACCIONES
    ========================================================== */

    .deliveries-actions {

        display: flex;

        align-items: center;

        gap: 6px;

        white-space: nowrap;

    }

    .deliveries-actions form {

        margin: 0;

    }

    .delivery-action {

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

    .delivery-action:hover {

        background: #f5f8fb;

        border-color: #cbd7e3;

        color: #155a91;

    }

    .delivery-action-primary {

        background: #eaf3fa;

        border-color: #d4e5f2;

        color: #155a91;

    }

    .delivery-action-primary:hover {

        background: #dfeef8;

        border-color: #c3dbea;

        color: #124d7d;

    }

    .delivery-action-danger {

        color: #a52f26;

    }

    .delivery-action-danger:hover {

        background: #fff5f3;

        border-color: #e9c1bc;

        color: #8f251e;

    }


    /* =========================================================
       FOOTER
    ========================================================== */

    .deliveries-card-footer {

        min-height: 48px;

        padding: 0 20px;

        display: flex;

        align-items: center;

        justify-content: space-between;

        border-top: 1px solid #edf1f5;

        background: #fbfcfd;

    }

    .deliveries-count {

        color: #98a2b3;

        font-size: 10px;

    }

    .deliveries-count strong {

        color: #667085;

        font-weight: 600;

    }

    .deliveries-footer-description {

        color: #98a2b3;

        font-size: 10px;

    }


    /* =========================================================
       ESTADO VACÍO
    ========================================================== */

    .deliveries-empty {

        padding: 55px 25px;

        text-align: center;

    }

    .deliveries-empty-icon {

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

    .deliveries-empty-title {

        margin: 0;

        color: #344054;

        font-size: 14px;

        font-weight: 700;

    }

    .deliveries-empty-text {

        max-width: 390px;

        margin: 6px auto 17px;

        color: #98a2b3;

        font-size: 11px;

        line-height: 1.5;

    }


    /* =========================================================
       RESPONSIVE
    ========================================================== */

    @media (max-width: 1000px) {

        .deliveries-summary {

            grid-template-columns: repeat(2, 1fr);

        }

        .deliveries-card-header {

            align-items: stretch;

            flex-direction: column;

        }

        .deliveries-search {

            width: 100%;

        }

    }

    @media (max-width: 700px) {

        .deliveries-header {

            flex-direction: column;

        }

        .deliveries-header-actions {

            width: 100%;

            flex-direction: column;

        }

        .deliveries-header-actions a {

            width: 100%;

        }

        .deliveries-summary {

            grid-template-columns: 1fr;

        }

        .deliveries-card-footer {

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

    <div class="deliveries-header">

        <div>

            <h1 class="deliveries-title">
                Entregas
            </h1>

            <p class="deliveries-subtitle">
                Gestión de entregas asociadas a las operaciones.
            </p>

        </div>


        <div class="deliveries-header-actions">

            <a
                href="{{ route('operaciones.index') }}"
                class="deliveries-button deliveries-button-secondary"
            >
                Operaciones
            </a>

            <a
                href="{{ route('entregas.create') }}"
                class="deliveries-button deliveries-button-primary"
            >
                + Nueva entrega
            </a>

        </div>

    </div>


    {{-- =====================================================
         MENSAJES
    ====================================================== --}}

    @if(session('success'))

        <div class="deliveries-alert deliveries-success">

            {{ session('success') }}

        </div>

    @endif


    @if(session('error'))

        <div class="deliveries-alert deliveries-error">

            {{ session('error') }}

        </div>

    @endif


    {{-- =====================================================
         RESUMEN
    ====================================================== --}}

    <div class="deliveries-summary">

        <div class="deliveries-summary-card">

            <div class="deliveries-summary-label">
                Total entregas
            </div>

            <div class="deliveries-summary-value">
                {{ $entregas->count() }}
            </div>

            <div class="deliveries-summary-description">
                Entregas registradas
            </div>

        </div>


        <div class="deliveries-summary-card">

            <div class="deliveries-summary-label">
                Entregadas
            </div>

            <div class="deliveries-summary-value">
                {{ $entregas->where('estado', 'entregada')->count() }}
            </div>

            <div class="deliveries-summary-description">
                Entregas completadas
            </div>

        </div>


        <div class="deliveries-summary-card">

            <div class="deliveries-summary-label">
                Pendientes
            </div>

            <div class="deliveries-summary-value">
                {{ $entregas->where('estado', 'pendiente')->count() }}
            </div>

            <div class="deliveries-summary-description">
                Entregas aún pendientes
            </div>

        </div>

    </div>


    {{-- =====================================================
         LISTADO
    ====================================================== --}}

    <section class="deliveries-card">

        <div class="deliveries-card-header">

            <div class="deliveries-card-heading">

                <h2 class="deliveries-card-title">
                    Registro de entregas
                </h2>

                <p class="deliveries-card-description">
                    Consulta y administra las entregas asociadas a las operaciones.
                </p>

            </div>


            <div class="deliveries-search">

                <span class="deliveries-search-icon">
                    ⌕
                </span>

                <input
                    type="text"
                    id="deliveryTableSearch"
                    placeholder="Buscar entrega, operación o cliente..."
                    autocomplete="off"
                >

            </div>

        </div>


        @if($entregas->count())

            <div class="deliveries-table-wrapper">

                <table
                    class="deliveries-table"
                    id="deliveriesTable"
                >

                    <thead>

                        <tr>

                            <th>
                                N.º entrega
                            </th>

                            <th>
                                Operación
                            </th>

                            <th>
                                Cliente
                            </th>

                            <th>
                                Fecha entrega
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

                        @foreach($entregas as $entrega)

                            <tr
                                data-delivery-row
                                data-search="
                                    {{
                                        strtolower(
                                            ($entrega->numero_entrega ?? '') . ' ' .
                                            ($entrega->operacion?->numero_operacion ?? '') . ' ' .
                                            ($entrega->operacion?->cliente?->razon_social ?? '') . ' ' .
                                            ($entrega->estado ?? '')
                                        )
                                    }}
                                "
                            >

                                {{-- NÚMERO --}}

                                <td>

                                    <span class="delivery-number">
                                        {{ $entrega->numero_entrega }}
                                    </span>

                                </td>


                                {{-- OPERACIÓN --}}

                                <td>

                                    @if($entrega->operacion)

                                        <a
                                            href="{{ route('operaciones.show', $entrega->operacion) }}"
                                            class="delivery-operation"
                                        >
                                            {{ $entrega->operacion->numero_operacion }}
                                        </a>

                                    @else

                                        —

                                    @endif

                                </td>


                                {{-- CLIENTE --}}

                                <td>

                                    <span class="delivery-client">

                                        {{
                                            $entrega->operacion?->cliente?->razon_social
                                            ?? 'Sin cliente'
                                        }}

                                    </span>

                                </td>


                                {{-- FECHA --}}

                                <td class="delivery-date">

                                    @if($entrega->fecha_entrega)

                                        {{ $entrega->fecha_entrega->format('d/m/Y') }}

                                    @else

                                        —

                                    @endif

                                </td>


                                {{-- ESTADO --}}

                                <td>

                                    <span
                                        class="delivery-status {{ strtolower($entrega->estado ?? '') }}"
                                    >
                                        {{ $entrega->estado }}
                                    </span>

                                </td>


                                {{-- ACCIONES --}}

                                <td>

                                    <div class="deliveries-actions">

                                        <a
                                            href="{{ route('entregas.show', $entrega) }}"
                                            class="delivery-action delivery-action-primary"
                                        >
                                            Ver
                                        </a>


                                        <a
                                            href="{{ route('entregas.edit', $entrega) }}"
                                            class="delivery-action"
                                        >
                                            Editar
                                        </a>


                                        <form
                                            action="{{ route('entregas.destroy', $entrega) }}"
                                            method="POST"
                                            onsubmit="return confirm('¿Está seguro de eliminar esta entrega?');"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="delivery-action delivery-action-danger"
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
                 FOOTER
            ================================================== --}}

            <div class="deliveries-card-footer">

                <div class="deliveries-count">

                    Mostrando

                    <strong id="visibleDeliveryCount">
                        {{ $entregas->count() }}
                    </strong>

                    de

                    <strong>
                        {{ $entregas->count() }}
                    </strong>

                    {{ $entregas->count() === 1 ? 'entrega' : 'entregas' }}

                </div>


                <div class="deliveries-footer-description">

                    Las entregas permanecen asociadas a sus operaciones.

                </div>

            </div>


        @else

            {{-- =================================================
                 ESTADO VACÍO
            ================================================== --}}

            <div class="deliveries-empty">

                <div class="deliveries-empty-icon">
                    ▤
                </div>

                <h3 class="deliveries-empty-title">
                    No hay entregas registradas
                </h3>

                <p class="deliveries-empty-text">
                    Registra la primera entrega para comenzar a controlar
                    las entregas asociadas a las operaciones.
                </p>

                <a
                    href="{{ route('entregas.create') }}"
                    class="deliveries-button deliveries-button-primary"
                >
                    + Registrar entrega
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
                    'deliveryTableSearch'
                );


            const rows =
                document.querySelectorAll(
                    '[data-delivery-row]'
                );


            const visibleCount =
                document.getElementById(
                    'visibleDeliveryCount'
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