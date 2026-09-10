@extends('layouts.app')

@section('title', 'Moras')

@section('topbar_title', 'Gestión de moras')

@push('styles')

<style>

    /* =========================================================
       HEADER
    ========================================================== */

    .mora-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 24px;
    }

    .mora-title {
        margin: 0;
        color: #172033;
        font-size: 27px;
        line-height: 1.2;
        font-weight: 700;
        letter-spacing: -.025em;
    }

    .mora-subtitle {
        margin: 7px 0 0;
        color: #667085;
        font-size: 13px;
    }

    .mora-header-actions {
        display: flex;
        align-items: center;
        gap: 9px;
        flex-shrink: 0;
    }


    /* =========================================================
       RESUMEN
    ========================================================== */

    .mora-summary {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 14px;
        margin-bottom: 20px;
    }

    .mora-summary-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 9px;
        padding: 17px 19px;
        box-shadow: 0 2px 7px rgba(16,47,80,.04);
    }

    .mora-summary-label {
        color: #667085;
        font-size: 10px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .03em;
    }

    .mora-summary-value {
        margin-top: 7px;
        color: #172033;
        font-size: 23px;
        line-height: 1;
        font-weight: 700;
    }

    .mora-summary-description {
        margin-top: 6px;
        color: #98a2b3;
        font-size: 9px;
    }


    /* =========================================================
       CARD
    ========================================================== */

    .mora-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(16,47,80,.05);
        overflow: hidden;
    }

    .mora-card-header {
        min-height: 66px;
        padding: 15px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        border-bottom: 1px solid #edf1f5;
    }

    .mora-card-heading {
        min-width: 0;
    }

    .mora-card-title {
        margin: 0;
        color: #172033;
        font-size: 14px;
        font-weight: 700;
    }

    .mora-card-description {
        margin: 4px 0 0;
        color: #98a2b3;
        font-size: 10px;
    }


    /* =========================================================
       BUSCADOR
    ========================================================== */

    .mora-search {
        position: relative;
        width: 300px;
        flex-shrink: 0;
    }

    .mora-search input {
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

    .mora-search input::placeholder {
        color: #a1aab7;
    }

    .mora-search input:focus {
        border-color: #155a91;
        box-shadow: 0 0 0 3px rgba(21,90,145,.08);
    }

    .mora-search-icon {
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

    .mora-table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    .mora-table {
        width: 100%;
        min-width: 1100px;
        border-collapse: collapse;
    }

    .mora-table th {
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

    .mora-table td {
        padding: 14px 18px;
        border-bottom: 1px solid #edf1f5;
        color: #344054;
        font-size: 11px;
        vertical-align: middle;
    }

    .mora-table tbody tr {
        transition: background .12s ease;
    }

    .mora-table tbody tr:hover {
        background: #fbfcfe;
    }

    .mora-table tbody tr:last-child td {
        border-bottom: none;
    }


    /* =========================================================
       INFORMACIÓN
    ========================================================== */

    .mora-primary {
        color: #172033;
        font-size: 12px;
        font-weight: 600;
    }

    .mora-secondary {
        display: block;
        margin-top: 3px;
        color: #98a2b3;
        font-size: 10px;
    }

    .mora-operation {
        color: #155a91;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
    }

    .mora-operation:hover {
        color: #124d7d;
        text-decoration: underline;
    }

    .mora-invoice {
        display: inline-flex;
        align-items: center;
        padding: 4px 7px;
        border-radius: 5px;
        background: #f1f4f7;
        color: #667085;
        font-size: 10px;
        font-weight: 600;
    }

    .mora-date {
        color: #344054;
        font-size: 11px;
    }

    .mora-days {
        color: #172033;
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
    }

    .mora-amount {
        color: #172033;
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
    }


    /* =========================================================
       TIPO DE MORA
    ========================================================== */

    .mora-type {
        display: inline-flex;
        align-items: center;
        padding: 4px 8px;
        border-radius: 5px;
        font-size: 9px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .025em;
        white-space: nowrap;
    }

    .mora-type-own {
        background: #eaf3fa;
        color: #155a91;
        border: 1px solid #d4e5f2;
    }

    .mora-type-received {
        background: #fff7e6;
        color: #9a6700;
        border: 1px solid #f0dfb7;
    }

    .mora-type-pending {
        background: #f5f6f7;
        color: #667085;
        border: 1px solid #e2e5e8;
    }


    /* =========================================================
       ACCIONES
    ========================================================== */

    .mora-actions {
        display: flex;
        align-items: center;
        gap: 6px;
        white-space: nowrap;
    }

    .mora-action {
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

    .mora-action:hover {
        background: #f5f8fb;
        border-color: #cbd7e3;
        color: #155a91;
    }

    .mora-action-primary {
        background: #eaf3fa;
        border-color: #d4e5f2;
        color: #155a91;
    }

    .mora-action-primary:hover {
        background: #dfeef8;
        border-color: #c3dbea;
        color: #124d7d;
    }

    .mora-action-danger {
        color: #b9382e;
        border-color: #f0d3cf;
        background: #ffffff;
    }

    .mora-action-danger:hover {
        background: #fff5f3;
        border-color: #e9c1bc;
        color: #a52f26;
    }


    /* =========================================================
       EMPTY
    ========================================================== */

    .mora-empty {
        padding: 55px 25px;
        text-align: center;
    }

    .mora-empty-icon {
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

    .mora-empty-title {
        margin: 0;
        color: #344054;
        font-size: 14px;
        font-weight: 700;
    }

    .mora-empty-text {
        max-width: 410px;
        margin: 6px auto 17px;
        color: #98a2b3;
        font-size: 11px;
        line-height: 1.5;
    }


    /* =========================================================
       FOOTER
    ========================================================== */

    .mora-card-footer {
        min-height: 48px;
        padding: 0 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-top: 1px solid #edf1f5;
        background: #fbfcfd;
    }

    .mora-count {
        color: #98a2b3;
        font-size: 10px;
    }

    .mora-count strong {
        color: #667085;
        font-weight: 600;
    }


    /* =========================================================
       ALERTAS
    ========================================================== */

    .mora-success {
        margin-bottom: 18px;
        padding: 11px 14px;
        border: 1px solid #cfe5d7;
        border-radius: 7px;
        background: #f1faf4;
        color: #287443;
        font-size: 11px;
    }

    .mora-error {
        margin-bottom: 18px;
        padding: 11px 14px;
        border: 1px solid #f0d3cf;
        border-radius: 7px;
        background: #fff5f3;
        color: #b9382e;
        font-size: 11px;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================== */

    @media (max-width: 1100px) {

        .mora-summary {
            grid-template-columns: repeat(2, 1fr);
        }

    }

    @media (max-width: 700px) {

        .mora-header {
            flex-direction: column;
        }

        .mora-header-actions {
            width: 100%;
        }

        .mora-header-actions .btn {
            flex: 1;
        }

        .mora-summary {
            grid-template-columns: 1fr;
        }

        .mora-card-header {
            align-items: stretch;
            flex-direction: column;
        }

        .mora-search {
            width: 100%;
        }

    }

</style>

@endpush


@section('content')

    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="mora-header">

        <div>

            <h1 class="mora-title">
                Gestión de Moras
            </h1>

            <p class="mora-subtitle">
                Registro y seguimiento de moras generadas por atrasos y cargadas posteriormente a facturas.
            </p>

        </div>


        <div class="mora-header-actions">

            <a
                href="{{ route('moras.create') }}"
                class="btn btn-primary"
            >
                + Nueva mora
            </a>

        </div>

    </div>


    {{-- =====================================================
         MENSAJES
    ====================================================== --}}

    @if(session('success'))

        <div class="mora-success">
            {{ session('success') }}
        </div>

    @endif


    @if(session('error'))

        <div class="mora-error">
            {{ session('error') }}
        </div>

    @endif


    {{-- =====================================================
         RESUMEN
    ====================================================== --}}

    @php

        $totalMoras = $moras->count();

        $morasPendientes = $moras
            ->filter(
                function ($mora) {
                    return !$mora->factura_destino_id;
                }
            )
            ->count();

        $morasTrasladadas = $moras
            ->filter(
                function ($mora) {
                    return (bool) $mora->factura_destino_id;
                }
            )
            ->count();

        $totalValorMora = $moras->sum(
            function ($mora) {
                return (float) $mora->valor_mora;
            }
        );

    @endphp


    <div class="mora-summary">

        <div class="mora-summary-card">

            <div class="mora-summary-label">
                Total moras
            </div>

            <div class="mora-summary-value">
                {{ $totalMoras }}
            </div>

            <div class="mora-summary-description">
                Registros de mora existentes
            </div>

        </div>


        <div class="mora-summary-card">

            <div class="mora-summary-label">
                Pendientes
            </div>

            <div class="mora-summary-value">
                {{ $morasPendientes }}
            </div>

            <div class="mora-summary-description">
                Moras sin factura destino
            </div>

        </div>


        <div class="mora-summary-card">

            <div class="mora-summary-label">
                Trasladadas
            </div>

            <div class="mora-summary-value">
                {{ $morasTrasladadas }}
            </div>

            <div class="mora-summary-description">
                Moras cargadas a otra factura
            </div>

        </div>


        <div class="mora-summary-card">

            <div class="mora-summary-label">
                Valor mora
            </div>

            <div class="mora-summary-value">
                ${{ number_format(
                    $totalValorMora,
                    0,
                    ',',
                    '.'
                ) }}
            </div>

            <div class="mora-summary-description">
                Valor acumulado de las moras
            </div>

        </div>

    </div>


    {{-- =====================================================
         LISTADO
    ====================================================== --}}

    <section class="mora-card">

        <div class="mora-card-header">

            <div class="mora-card-heading">

                <h2 class="mora-card-title">
                    Registro de moras
                </h2>

                <p class="mora-card-description">
                    Consulta el origen, destino, atraso y valor de cada mora registrada.
                </p>

            </div>


            <div class="mora-search">

                <span class="mora-search-icon">
                    ⌕
                </span>

                <input
                    type="text"
                    id="moraTableSearch"
                    placeholder="Buscar operación, factura o cliente..."
                    autocomplete="off"
                >

            </div>

        </div>


        @if($moras->count())

            <div class="mora-table-wrapper">

                <table
                    class="mora-table"
                    id="moraTable"
                >

                    <thead>

                        <tr>

                            <th>
                                Fecha
                            </th>

                            <th>
                                Tipo
                            </th>

                            <th>
                                Operación origen
                            </th>

                            <th>
                                Factura origen
                            </th>

                            <th>
                                Operación destino
                            </th>

                            <th>
                                Factura destino
                            </th>

                            <th>
                                Días atraso
                            </th>

                            <th>
                                Valor mora
                            </th>

                            <th>
                                Acciones
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($moras as $mora)

                            @php

                                $esTrasladada =
                                    $mora->factura_destino_id !== null;

                                $textoBusqueda = strtolower(
                                    ($mora->operacionOrigen->numero_operacion ?? '') . ' ' .
                                    ($mora->operacionOrigen->cliente->nombre ?? '') . ' ' .
                                    ($mora->facturaOrigen->numero_factura ?? '') . ' ' .
                                    ($mora->operacionDestino->numero_operacion ?? '') . ' ' .
                                    ($mora->operacionDestino->cliente->nombre ?? '') . ' ' .
                                    ($mora->facturaDestino->numero_factura ?? '') . ' ' .
                                    ($mora->observacion ?? '')
                                );

                            @endphp


                            <tr
                                data-mora-row
                                data-search="{{ $textoBusqueda }}"
                            >

                                {{-- FECHA --}}

                                <td>

                                    @if($mora->fecha)

                                        <div class="mora-date">
                                            {{ $mora->fecha->format('d/m/Y') }}
                                        </div>

                                    @else

                                        <span class="mora-secondary">
                                            Sin fecha
                                        </span>

                                    @endif

                                </td>


                                {{-- TIPO --}}

                                <td>

                                    @if($esTrasladada)

                                        <span class="mora-type mora-type-received">
                                            Trasladada
                                        </span>

                                    @else

                                        <span class="mora-type mora-type-own">
                                            Pendiente
                                        </span>

                                    @endif

                                </td>


                                {{-- OPERACIÓN ORIGEN --}}

                                <td>

                                    @if($mora->operacionOrigen)

                                        <a
                                            href="{{ route(
                                                'operaciones.show',
                                                $mora->operacionOrigen
                                            ) }}"
                                            class="mora-operation"
                                        >
                                            {{ $mora->operacionOrigen->numero_operacion }}
                                        </a>

                                        @if($mora->operacionOrigen->cliente)

                                            <span class="mora-secondary">
                                                {{ $mora->operacionOrigen->cliente->nombre }}
                                            </span>

                                        @endif

                                    @else

                                        <span class="mora-secondary">
                                            Sin operación
                                        </span>

                                    @endif

                                </td>


                                {{-- FACTURA ORIGEN --}}

                                <td>

                                    @if($mora->facturaOrigen)

                                        <a
                                            href="{{ route(
                                                'facturas.show',
                                                $mora->facturaOrigen
                                            ) }}"
                                            class="mora-invoice"
                                            style="
                                                text-decoration:none;
                                            "
                                        >
                                            N.º {{ $mora->facturaOrigen->numero_factura }}
                                        </a>

                                    @else

                                        <span class="mora-secondary">
                                            Sin factura
                                        </span>

                                    @endif

                                </td>


                                {{-- OPERACIÓN DESTINO --}}

                                <td>

                                    @if($mora->operacionDestino)

                                        <a
                                            href="{{ route(
                                                'operaciones.show',
                                                $mora->operacionDestino
                                            ) }}"
                                            class="mora-operation"
                                        >
                                            {{ $mora->operacionDestino->numero_operacion }}
                                        </a>

                                        @if($mora->operacionDestino->cliente)

                                            <span class="mora-secondary">
                                                {{ $mora->operacionDestino->cliente->nombre }}
                                            </span>

                                        @endif

                                    @else

                                        <span class="mora-secondary">
                                            Sin destino
                                        </span>

                                    @endif

                                </td>


                                {{-- FACTURA DESTINO --}}

                                <td>

                                    @if($mora->facturaDestino)

                                        <a
                                            href="{{ route(
                                                'facturas.show',
                                                $mora->facturaDestino
                                            ) }}"
                                            class="mora-invoice"
                                            style="
                                                text-decoration:none;
                                            "
                                        >
                                            N.º {{ $mora->facturaDestino->numero_factura }}
                                        </a>

                                    @else

                                        <span class="mora-secondary">
                                            Sin destino
                                        </span>

                                    @endif

                                </td>


                                {{-- DÍAS --}}

                                <td>

                                    <span class="mora-days">

                                        {{ number_format(
                                            $mora->dias_atraso,
                                            0,
                                            ',',
                                            '.'
                                        ) }}

                                        {{ $mora->dias_atraso == 1 ? 'día' : 'días' }}

                                    </span>

                                </td>


                                {{-- VALOR --}}

                                <td>

                                    <span class="mora-amount">

                                        ${{ number_format(
                                            (float) $mora->valor_mora,
                                            0,
                                            ',',
                                            '.'
                                        ) }}

                                    </span>

                                </td>


                                {{-- ACCIONES --}}

                                <td>

                                    <div class="mora-actions">

                                        <a
                                            href="{{ route(
                                                'moras.show',
                                                $mora
                                            ) }}"
                                            class="mora-action mora-action-primary"
                                        >
                                            Ver
                                        </a>


                                        <a
                                            href="{{ route(
                                                'moras.edit',
                                                $mora
                                            ) }}"
                                            class="mora-action"
                                        >
                                            Editar
                                        </a>


                                        <form
                                            action="{{ route(
                                                'moras.destroy',
                                                $mora
                                            ) }}"
                                            method="POST"
                                            style="display:inline;"
                                            onsubmit="return confirm('¿Estás seguro de eliminar esta mora?');"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="mora-action mora-action-danger"
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


            <div class="mora-card-footer">

                <div class="mora-count">

                    Mostrando

                    <strong id="visibleMoraCount">
                        {{ $moras->count() }}
                    </strong>

                    de

                    <strong>
                        {{ $moras->count() }}
                    </strong>

                    moras

                </div>

            </div>


        @else

            <div class="mora-empty">

                <div class="mora-empty-icon">
                    ◉
                </div>

                <h3 class="mora-empty-title">
                    No hay moras registradas
                </h3>

                <p class="mora-empty-text">
                    Comienza registrando una mora asociada a la factura y operación que originaron el atraso.
                </p>

                <a
                    href="{{ route('moras.create') }}"
                    class="btn btn-primary"
                >
                    + Registrar primera mora
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
                'moraTableSearch'
            );


        const rows =
            document.querySelectorAll(
                '[data-mora-row]'
            );


        const visibleCount =
            document.getElementById(
                'visibleMoraCount'
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