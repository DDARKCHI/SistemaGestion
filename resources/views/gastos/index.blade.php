@extends('layouts.app')

@section('title', 'Gastos')

@section('topbar_title', 'Gestión de gastos')

@push('styles')

<style>

    /* =========================================================
       BREADCRUMB
    ========================================================== */

    .gastos-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 18px;
        color: #8a94a6;
        font-size: 12px;
    }

    .gastos-breadcrumb a {
        color: #667085;
        text-decoration: none;
    }

    .gastos-breadcrumb a:hover {
        color: #155a91;
    }

    .gastos-breadcrumb-current {
        color: #344054;
    }


    /* =========================================================
       HEADER
    ========================================================== */

    .gastos-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 25px;
    }

    .gastos-title {
        margin: 0;
        color: #172033;
        font-size: 27px;
        line-height: 1.2;
        font-weight: 700;
        letter-spacing: -.025em;
    }

    .gastos-subtitle {
        margin: 7px 0 0;
        color: #667085;
        font-size: 13px;
    }


    /* =========================================================
       RESUMEN
    ========================================================== */

    .gastos-summary-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 14px;
        margin-bottom: 20px;
    }

    .gastos-summary-card {
        padding: 17px 18px;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 9px;
        box-shadow: 0 2px 8px rgba(16,47,80,.04);
    }

    .gastos-summary-label {
        margin-bottom: 7px;
        color: #98a2b3;
        font-size: 10px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .035em;
    }

    .gastos-summary-value {
        color: #172033;
        font-size: 21px;
        line-height: 1.2;
        font-weight: 700;
    }

    .gastos-summary-value-primary {
        color: #155a91;
    }


    /* =========================================================
       CARD PRINCIPAL
    ========================================================== */

    .gastos-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(16,47,80,.05);
        overflow: hidden;
    }

    .gastos-card-header {
        min-height: 67px;
        padding: 17px 21px;
        border-bottom: 1px solid #edf1f5;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
    }

    .gastos-card-title {
        margin: 0;
        color: #172033;
        font-size: 15px;
        font-weight: 700;
    }

    .gastos-card-description {
        margin: 4px 0 0;
        color: #98a2b3;
        font-size: 11px;
    }


    /* =========================================================
       BUSCADOR
    ========================================================== */

    .gastos-search {
        width: 250px;
        min-height: 36px;
        padding: 8px 11px;
        box-sizing: border-box;
        border: 1px solid #d8e0e8;
        border-radius: 7px;
        background: #ffffff;
        color: #344054;
        font-family: inherit;
        font-size: 11px;
        outline: none;
    }

    .gastos-search:focus {
        border-color: #155a91;
        box-shadow: 0 0 0 3px rgba(21,90,145,.08);
    }

    .gastos-search::placeholder {
        color: #a1aab7;
    }


    /* =========================================================
       TABLA
    ========================================================== */

    .gastos-table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    .gastos-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 1050px;
    }

    .gastos-table th {
        padding: 11px 14px;
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
        color: #667085;
        font-size: 9px;
        font-weight: 700;
        text-align: left;
        text-transform: uppercase;
        letter-spacing: .035em;
        white-space: nowrap;
    }

    .gastos-table td {
        padding: 13px 14px;
        border-bottom: 1px solid #edf1f5;
        color: #344054;
        font-size: 11px;
        vertical-align: middle;
    }

    .gastos-table tbody tr:last-child td {
        border-bottom: none;
    }

    .gastos-table tbody tr:hover {
        background: #fafcff;
    }


    /* =========================================================
       DATOS
    ========================================================== */

    .gastos-date {
        color: #667085;
        white-space: nowrap;
    }

    .gastos-operation {
        font-weight: 700;
        color: #344054;
    }

    .gastos-operation a {
        color: #155a91;
        text-decoration: none;
    }

    .gastos-operation a:hover {
        text-decoration: underline;
    }

    .gastos-client {
        margin-top: 3px;
        color: #98a2b3;
        font-size: 10px;
    }

    .gastos-transportista {
        color: #344054;
        font-weight: 600;
    }

    .gastos-transportista-empty {
        color: #98a2b3;
        font-style: italic;
    }

    .gastos-description {
        max-width: 230px;
        color: #667085;
        line-height: 1.4;
    }

    .gastos-amount {
        color: #172033;
        font-weight: 700;
        white-space: nowrap;
        text-align: right;
    }


    /* =========================================================
       BADGE TIPO
    ========================================================== */

    .gastos-type-badge {
        display: inline-flex;
        align-items: center;
        min-height: 21px;
        padding: 3px 8px;
        border-radius: 20px;
        background: #f2f4f7;
        color: #475467;
        font-size: 9px;
        font-weight: 700;
        white-space: nowrap;
    }


    /* =========================================================
       ACCIONES
    ========================================================== */

    .gastos-actions {
        display: flex;
        align-items: center;
        gap: 6px;
        white-space: nowrap;
    }

    .gastos-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 29px;
        padding: 5px 9px;
        border: 1px solid #d8e0e8;
        border-radius: 6px;
        background: #ffffff;
        color: #475467;
        font-size: 10px;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
    }

    .gastos-action:hover {
        border-color: #b8c5d2;
        background: #f8fafc;
    }

    .gastos-action-primary {
        border-color: #d4e5f2;
        color: #155a91;
    }

    .gastos-action-danger {
        border-color: #f1ceca;
        color: #a63228;
        background: #fffafa;
    }


    /* =========================================================
       ESTADO VACÍO
    ========================================================== */

    .gastos-empty {
        padding: 50px 25px;
        text-align: center;
    }

    .gastos-empty-title {
        margin: 0 0 6px;
        color: #344054;
        font-size: 14px;
        font-weight: 700;
    }

    .gastos-empty-description {
        margin: 0;
        color: #98a2b3;
        font-size: 11px;
    }


    /* =========================================================
       FOOTER
    ========================================================== */

    .gastos-card-footer {
        padding: 14px 21px;
        border-top: 1px solid #edf1f5;
        background: #f8fafc;
        color: #98a2b3;
        font-size: 10px;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================== */

    @media (max-width: 900px) {

        .gastos-summary-grid {
            grid-template-columns: 1fr;
        }

        .gastos-card-header {
            align-items: stretch;
            flex-direction: column;
        }

        .gastos-search {
            width: 100%;
        }

    }


    @media (max-width: 700px) {

        .gastos-header {
            flex-direction: column;
        }

        .gastos-header .btn {
            width: 100%;
        }

    }

</style>

@endpush


@section('content')

    {{-- =====================================================
         BREADCRUMB
    ====================================================== --}}

    <div class="gastos-breadcrumb">

        <span class="gastos-breadcrumb-current">
            Gastos
        </span>

    </div>


    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="gastos-header">

        <div>

            <h1 class="gastos-title">
                Gastos
            </h1>

            <p class="gastos-subtitle">
                Registra y controla los gastos asociados a las operaciones y transportistas.
            </p>

        </div>


        <a
            href="{{ route('gastos.create') }}"
            class="btn btn-primary"
        >
            + Nuevo gasto
        </a>

    </div>


    {{-- =====================================================
         RESUMEN
    ====================================================== --}}

    @php

        $totalGastos = $gastos->count();

        $montoTotal = $gastos->sum(
            function ($gasto) {
                return (float) $gasto->monto;
            }
        );

        $gastosConTransportista = $gastos->filter(
            function ($gasto) {
                return $gasto->transportista_id !== null;
            }
        )->count();

    @endphp


    <div class="gastos-summary-grid">

        <div class="gastos-summary-card">

            <div class="gastos-summary-label">
                Registros
            </div>

            <div class="gastos-summary-value">
                {{ number_format($totalGastos, 0, ',', '.') }}
            </div>

        </div>


        <div class="gastos-summary-card">

            <div class="gastos-summary-label">
                Total gastos
            </div>

            <div class="gastos-summary-value gastos-summary-value-primary">
                ${{ number_format($montoTotal, 0, ',', '.') }}
            </div>

        </div>


        <div class="gastos-summary-card">

            <div class="gastos-summary-label">
                Asociados a transportista
            </div>

            <div class="gastos-summary-value">
                {{ number_format($gastosConTransportista, 0, ',', '.') }}
            </div>

        </div>

    </div>


    {{-- =====================================================
         LISTADO
    ====================================================== --}}

    <section class="gastos-card">

        <div class="gastos-card-header">

            <div>

                <h2 class="gastos-card-title">
                    Listado de gastos
                </h2>

                <p class="gastos-card-description">
                    Cada gasto se registra una sola vez y mantiene su relación con la operación correspondiente.
                </p>

            </div>


            <input
                type="search"
                id="gastosSearch"
                class="gastos-search"
                placeholder="Buscar gasto..."
                autocomplete="off"
            >

        </div>


        @if($gastos->isEmpty())

            <div class="gastos-empty">

                <h3 class="gastos-empty-title">
                    No hay gastos registrados
                </h3>

                <p class="gastos-empty-description">
                    Cuando registres un gasto aparecerá en este listado.
                </p>

            </div>

        @else

            <div class="gastos-table-wrapper">

                <table
                    class="gastos-table"
                    id="gastosTable"
                >

                    <thead>

                        <tr>

                            <th>
                                Fecha
                            </th>

                            <th>
                                Operación
                            </th>

                            <th>
                                Transportista
                            </th>

                            <th>
                                Tipo
                            </th>

                            <th>
                                Descripción
                            </th>

                            <th style="text-align: right;">
                                Monto
                            </th>

                            <th>
                                Acciones
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($gastos as $gasto)

                            <tr>

                                <td class="gastos-date">

                                    {{ $gasto->fecha
                                        ? $gasto->fecha->format('d/m/Y')
                                        : '—'
                                    }}

                                </td>


                                <td>

                                    @if($gasto->operacion)

                                        <div class="gastos-operation">

                                            <a
                                                href="{{ route('operaciones.show', $gasto->operacion) }}"
                                            >
                                                {{ $gasto->operacion->numero_operacion }}
                                            </a>

                                        </div>


                                        @if($gasto->operacion->cliente)

                                            <div class="gastos-client">

                                                {{ $gasto->operacion->cliente->nombre }}

                                            </div>

                                        @endif

                                    @else

                                        <span class="gastos-transportista-empty">
                                            Sin operación
                                        </span>

                                    @endif

                                </td>


                                <td>

                                    @if($gasto->transportista)

                                        <div class="gastos-transportista">

                                            {{ $gasto->transportista->nombre }}

                                        </div>

                                        @if($gasto->transportista->rut)

                                            <div class="gastos-client">

                                                {{ $gasto->transportista->rut }}

                                            </div>

                                        @endif

                                    @else

                                        <span class="gastos-transportista-empty">
                                            Sin transportista
                                        </span>

                                    @endif

                                </td>


                                <td>

                                    <span class="gastos-type-badge">

                                        {{ $gasto->tipo }}

                                    </span>

                                </td>


                                <td>

                                    <div class="gastos-description">

                                        {{ $gasto->descripcion }}

                                    </div>

                                </td>


                                <td class="gastos-amount">

                                    ${{ number_format(
                                        (float) $gasto->monto,
                                        0,
                                        ',',
                                        '.'
                                    ) }}

                                </td>


                                <td>

                                    <div class="gastos-actions">

                                        <a
                                            href="{{ route('gastos.show', $gasto) }}"
                                            class="gastos-action gastos-action-primary"
                                        >
                                            Ver
                                        </a>


                                        <a
                                            href="{{ route('gastos.edit', $gasto) }}"
                                            class="gastos-action"
                                        >
                                            Editar
                                        </a>


                                        <form
                                            action="{{ route('gastos.destroy', $gasto) }}"
                                            method="POST"
                                            onsubmit="return confirm('¿Seguro que deseas eliminar este gasto?');"
                                            style="display: inline;"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="gastos-action gastos-action-danger"
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


            <div class="gastos-card-footer">

                Mostrando
                <strong id="gastosVisibleCount">
                    {{ $gastos->count() }}
                </strong>
                de
                {{ $gastos->count() }}
                gastos registrados.

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
                'gastosSearch'
            );


        const table =
            document.getElementById(
                'gastosTable'
            );


        const visibleCount =
            document.getElementById(
                'gastosVisibleCount'
            );


        if (
            !searchInput ||
            !table
        ) {

            return;

        }


        const rows =
            Array.from(
                table.querySelectorAll(
                    'tbody tr'
                )
            );


        searchInput.addEventListener(
            'input',
            function () {

                const search =
                    this.value
                        .toLowerCase()
                        .trim();


                let count = 0;


                rows.forEach(
                    function (row) {

                        const text =
                            row.textContent
                                .toLowerCase();


                        const visible =
                            text.includes(
                                search
                            );


                        row.style.display =
                            visible
                            ? ''
                            : 'none';


                        if (visible) {

                            count++;

                        }

                    }
                );


                if (visibleCount) {

                    visibleCount.textContent =
                        count;

                }

            }
        );

    }
);

</script>

@endpush