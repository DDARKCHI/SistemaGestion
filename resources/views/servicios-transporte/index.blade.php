@extends('layouts.app')

@section('title', 'Servicios de transporte')

@section('topbar_title', 'Gestión de servicios de transporte')

@push('styles')

<style>

    /* =========================================================
       BREADCRUMB
    ========================================================== */

    .transport-service-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 18px;
        color: #8a94a6;
        font-size: 12px;
    }

    .transport-service-breadcrumb a {
        color: #667085;
        text-decoration: none;
    }

    .transport-service-breadcrumb a:hover {
        color: #155a91;
    }

    .transport-service-breadcrumb-current {
        color: #344054;
    }


    /* =========================================================
       HEADER
    ========================================================== */

    .transport-service-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 25px;
    }

    .transport-service-header-left {
        display: flex;
        align-items: center;
        gap: 13px;
        min-width: 0;
    }

    .transport-service-avatar {
        width: 45px;
        height: 45px;
        min-width: 45px;
        border-radius: 9px;
        background: #155a91;
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: 700;
    }

    .transport-service-title {
        margin: 0;
        color: #172033;
        font-size: 26px;
        line-height: 1.2;
        font-weight: 700;
        letter-spacing: -.025em;
    }

    .transport-service-subtitle {
        margin: 6px 0 0;
        color: #667085;
        font-size: 12px;
    }


    /* =========================================================
       SUMMARY
    ========================================================== */

    .transport-service-summary {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 14px;
        margin-bottom: 20px;
    }

    .transport-service-summary-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 9px;
        padding: 15px 17px;
        box-shadow: 0 2px 8px rgba(16,47,80,.04);
    }

    .transport-service-summary-label {
        color: #98a2b3;
        font-size: 10px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .03em;
    }

    .transport-service-summary-value {
        margin-top: 7px;
        color: #172033;
        font-size: 21px;
        line-height: 1;
        font-weight: 700;
    }


    /* =========================================================
       CARD
    ========================================================== */

    .transport-service-card {
        width: 100%;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(16,47,80,.05);
        overflow: hidden;
    }

    .transport-service-card-header {
        min-height: 67px;
        padding: 17px 21px;
        border-bottom: 1px solid #edf1f5;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
    }

    .transport-service-card-title {
        margin: 0;
        color: #172033;
        font-size: 15px;
        font-weight: 700;
    }

    .transport-service-card-description {
        margin: 4px 0 0;
        color: #98a2b3;
        font-size: 11px;
    }


    /* =========================================================
       SEARCH
    ========================================================== */

    .transport-service-search {
        position: relative;
        width: 270px;
    }

    .transport-service-search input {
        width: 100%;
        min-height: 37px;
        padding: 8px 11px 8px 32px;
        box-sizing: border-box;
        border: 1px solid #d8e0e8;
        border-radius: 7px;
        background: #ffffff;
        color: #344054;
        font-family: inherit;
        font-size: 11px;
        outline: none;
    }

    .transport-service-search input:focus {
        border-color: #155a91;
        box-shadow: 0 0 0 3px rgba(21,90,145,.08);
    }

    .transport-service-search-icon {
        position: absolute;
        left: 11px;
        top: 50%;
        transform: translateY(-50%);
        color: #98a2b3;
        font-size: 12px;
        pointer-events: none;
    }


    /* =========================================================
       TABLE
    ========================================================== */

    .transport-service-table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    .transport-service-table {
        width: 100%;
        min-width: 1050px;
        border-collapse: collapse;
    }

    .transport-service-table th {
        padding: 12px 14px;
        background: #f8fafc;
        border-bottom: 1px solid #e8edf2;
        color: #667085;
        font-size: 9px;
        font-weight: 700;
        text-align: left;
        text-transform: uppercase;
        letter-spacing: .035em;
        white-space: nowrap;
    }

    .transport-service-table td {
        padding: 13px 14px;
        border-bottom: 1px solid #edf1f5;
        color: #344054;
        font-size: 11px;
        vertical-align: middle;
    }

    .transport-service-table tbody tr:hover {
        background: #fbfcfd;
    }

    .transport-service-table tbody tr:last-child td {
        border-bottom: none;
    }


    /* =========================================================
       IDENTIFICACIÓN
    ========================================================== */

    .transport-service-id {
        color: #155a91;
        font-weight: 700;
    }

    .transport-service-primary {
        color: #172033;
        font-weight: 600;
    }

    .transport-service-secondary {
        margin-top: 3px;
        color: #98a2b3;
        font-size: 9px;
    }


    /* =========================================================
       BADGES
    ========================================================== */

    .transport-service-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 4px 7px;
        border-radius: 5px;
        font-size: 9px;
        font-weight: 700;
        white-space: nowrap;
    }

    .transport-service-badge-pending {
        background: #fff6e6;
        color: #a86600;
    }

    .transport-service-badge-received {
        background: #edf8f1;
        color: #287548;
    }

    .transport-service-badge-no-invoice {
        background: #f1f4f7;
        color: #667085;
    }

    .transport-service-badge-invoice {
        background: #eef5fb;
        color: #155a91;
    }


    /* =========================================================
       AMOUNT
    ========================================================== */

    .transport-service-amount {
        color: #172033;
        font-weight: 700;
        white-space: nowrap;
    }


    /* =========================================================
       ACTIONS
    ========================================================== */

    .transport-service-actions {
        display: flex;
        align-items: center;
        gap: 6px;
        white-space: nowrap;
    }

    .transport-service-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 30px;
        padding: 5px 8px;
        border: 1px solid #d8e0e8;
        border-radius: 6px;
        background: #ffffff;
        color: #667085;
        text-decoration: none;
        font-size: 9px;
        font-weight: 600;
    }

    .transport-service-action:hover {
        border-color: #155a91;
        color: #155a91;
    }

    .transport-service-action-primary {
        border-color: #155a91;
        background: #155a91;
        color: #ffffff;
    }

    .transport-service-action-primary:hover {
        background: #104b79;
        color: #ffffff;
    }


    /* =========================================================
       EMPTY
    ========================================================== */

    .transport-service-empty {
        padding: 50px 20px;
        text-align: center;
    }

    .transport-service-empty-icon {
        width: 42px;
        height: 42px;
        margin: 0 auto 12px;
        border-radius: 9px;
        background: #f1f4f7;
        color: #98a2b3;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        font-weight: 700;
    }

    .transport-service-empty-title {
        margin: 0;
        color: #344054;
        font-size: 13px;
        font-weight: 700;
    }

    .transport-service-empty-text {
        margin: 6px 0 17px;
        color: #98a2b3;
        font-size: 11px;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================== */

    @media (max-width: 900px) {

        .transport-service-summary {
            grid-template-columns: repeat(2, 1fr);
        }

        .transport-service-card-header {
            align-items: stretch;
            flex-direction: column;
        }

        .transport-service-search {
            width: 100%;
        }

    }

    @media (max-width: 600px) {

        .transport-service-header {
            align-items: stretch;
            flex-direction: column;
        }

        .transport-service-header .btn {
            width: 100%;
        }

        .transport-service-summary {
            grid-template-columns: 1fr;
        }

    }

</style>

@endpush


@section('content')

    {{-- =====================================================
         BREADCRUMB
    ====================================================== --}}

    <div class="transport-service-breadcrumb">

        <a href="{{ route('transportistas.index') }}">
            Transportistas
        </a>

        <span>›</span>

        <span class="transport-service-breadcrumb-current">
            Servicios de transporte
        </span>

    </div>


    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="transport-service-header">

        <div class="transport-service-header-left">

            <div class="transport-service-avatar">
                ST
            </div>

            <div>

                <h1 class="transport-service-title">
                    Servicios de transporte
                </h1>

                <p class="transport-service-subtitle">
                    Registro y control de los servicios realizados por los transportistas.
                </p>

            </div>

        </div>


        <a
            href="{{ route('servicios-transporte.create') }}"
            class="btn btn-primary"
        >
            + Nuevo servicio
        </a>

    </div>


    {{-- =====================================================
         RESUMEN
    ====================================================== --}}

    @php

        $totalServicios = $servicios->count();

        $serviciosConFactura = $servicios
            ->where('emite_factura', true)
            ->count();

        $facturasPendientes = $servicios
            ->where('emite_factura', true)
            ->where('estado_facturacion', 'Pendiente')
            ->count();

        $totalFletes = $servicios->sum(
            fn ($servicio) => (float) $servicio->monto
        );

    @endphp


    <div class="transport-service-summary">

        <div class="transport-service-summary-card">

            <div class="transport-service-summary-label">
                Total servicios
            </div>

            <div
                class="transport-service-summary-value"
                data-summary="total"
            >
                {{ $totalServicios }}
            </div>

        </div>


        <div class="transport-service-summary-card">

            <div class="transport-service-summary-label">
                Servicios con factura
            </div>

            <div
                class="transport-service-summary-value"
                data-summary="factura"
            >
                {{ $serviciosConFactura }}
            </div>

        </div>


        <div class="transport-service-summary-card">

            <div class="transport-service-summary-label">
                Facturación pendiente
            </div>

            <div
                class="transport-service-summary-value"
                data-summary="pendientes"
            >
                {{ $facturasPendientes }}
            </div>

        </div>


        <div class="transport-service-summary-card">

            <div class="transport-service-summary-label">
                Total fletes
            </div>

            <div
                class="transport-service-summary-value"
                data-summary="monto"
            >
                ${{ number_format($totalFletes, 0, ',', '.') }}
            </div>

        </div>

    </div>


    {{-- =====================================================
         LISTADO
    ====================================================== --}}

    <section class="transport-service-card">

        <div class="transport-service-card-header">

            <div>

                <h2 class="transport-service-card-title">
                    Servicios registrados
                </h2>

                <p class="transport-service-card-description">
                    Consulta los servicios, transportistas y estado de facturación.
                </p>

            </div>


            <div class="transport-service-search">

                <span class="transport-service-search-icon">
                    ⌕
                </span>

                <input
                    type="text"
                    id="transportServiceSearch"
                    placeholder="Buscar servicio..."
                    autocomplete="off"
                >

            </div>

        </div>


        @if($servicios->count())

            <div class="transport-service-table-wrapper">

                <table
                    class="transport-service-table"
                    id="transportServiceTable"
                >

                    <thead>

                        <tr>

                            <th>
                                Servicio
                            </th>

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
                                Vehículo
                            </th>

                            <th>
                                Tipo
                            </th>

                            <th>
                                Monto
                            </th>

                            <th>
                                Facturación
                            </th>

                            <th>
                                Factura
                            </th>

                            <th>
                                Acciones
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($servicios as $servicio)

                            <tr
                                data-search="{{ strtolower(
                                    implode(' ', [
                                        $servicio->id,
                                        optional($servicio->transportista)->nombre,
                                        optional($servicio->transportista)->rut,
                                        optional($servicio->operacion)->id,
                                        optional(optional($servicio->operacion)->cliente)->nombre,
                                        optional($servicio->vehiculo)->id,
                                        $servicio->tipo_servicio,
                                        $servicio->numero_factura,
                                        $servicio->estado_facturacion,
                                    ])
                                ) }}"
                            >

                                <td>

                                    <div class="transport-service-id">
                                        #{{ $servicio->id }}
                                    </div>

                                </td>


                                <td>

                                    <div class="transport-service-primary">

                                        {{ $servicio->fecha_servicio
                                            ? $servicio->fecha_servicio->format('d/m/Y')
                                            : 'Sin fecha'
                                        }}

                                    </div>

                                </td>


                                <td>

                                    @if($servicio->operacion)

                                        <div class="transport-service-primary">
                                            Operación #{{ $servicio->operacion->id }}
                                        </div>

                                        @if($servicio->operacion->cliente)

                                            <div class="transport-service-secondary">
                                                {{ $servicio->operacion->cliente->nombre }}
                                            </div>

                                        @endif

                                    @else

                                        <span class="transport-service-secondary">
                                            Sin operación
                                        </span>

                                    @endif

                                </td>


                                <td>

                                    @if($servicio->transportista)

                                        <div class="transport-service-primary">
                                            {{ $servicio->transportista->nombre }}
                                        </div>

                                        <div class="transport-service-secondary">
                                            {{ $servicio->transportista->rut }}
                                        </div>

                                    @else

                                        <span class="transport-service-secondary">
                                            Sin transportista
                                        </span>

                                    @endif

                                </td>


                                <td>

                                    @if($servicio->vehiculo)

                                        <div class="transport-service-primary">
                                            Vehículo #{{ $servicio->vehiculo->id }}
                                        </div>

                                    @else

                                        <span class="transport-service-secondary">
                                            Sin vehículo
                                        </span>

                                    @endif

                                </td>


                                <td>

                                    {{ $servicio->tipo_servicio ?: 'Sin especificar' }}

                                </td>


                                <td>

                                    <div class="transport-service-amount">

                                        ${{ number_format(
                                            (float) $servicio->monto,
                                            0,
                                            ',',
                                            '.'
                                        ) }}

                                    </div>

                                </td>


                                <td>

                                    @if($servicio->emite_factura)

                                        @if($servicio->estado_facturacion === 'Recibida')

                                            <span class="transport-service-badge transport-service-badge-received">
                                                Recibida
                                            </span>

                                        @else

                                            <span class="transport-service-badge transport-service-badge-pending">
                                                Pendiente
                                            </span>

                                        @endif

                                    @else

                                        <span class="transport-service-badge transport-service-badge-no-invoice">
                                            No factura
                                        </span>

                                    @endif

                                </td>


                                <td>

                                    @if($servicio->numero_factura)

                                        <span class="transport-service-badge transport-service-badge-invoice">
                                            N° {{ $servicio->numero_factura }}
                                        </span>

                                    @else

                                        <span class="transport-service-secondary">
                                            Sin factura
                                        </span>

                                    @endif

                                </td>


                                <td>

                                    <div class="transport-service-actions">

                                        <a
                                            href="{{ route(
                                                'servicios-transporte.show',
                                                $servicio
                                            ) }}"
                                            class="transport-service-action transport-service-action-primary"
                                        >
                                            Ver
                                        </a>


                                        <a
                                            href="{{ route(
                                                'servicios-transporte.edit',
                                                $servicio
                                            ) }}"
                                            class="transport-service-action"
                                        >
                                            Editar
                                        </a>

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <div class="transport-service-empty">

                <div class="transport-service-empty-icon">
                    ST
                </div>

                <h3 class="transport-service-empty-title">
                    No hay servicios registrados
                </h3>

                <p class="transport-service-empty-text">
                    Comienza registrando el primer servicio de transporte.
                </p>

                <a
                    href="{{ route('servicios-transporte.create') }}"
                    class="btn btn-primary"
                >
                    + Nuevo servicio
                </a>

            </div>

        @endif

    </section>


    {{-- =====================================================
         BUSCADOR
    ====================================================== --}}

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const searchInput =
                document.getElementById('transportServiceSearch');

            const table =
                document.getElementById('transportServiceTable');

            if (!searchInput || !table) {
                return;
            }

            const rows =
                table.querySelectorAll('tbody tr');

            searchInput.addEventListener('input', function () {

                const search =
                    this.value
                        .toLowerCase()
                        .trim();

                rows.forEach(function (row) {

                    const content =
                        row.dataset.search || '';

                    row.style.display =
                        content.includes(search)
                            ? ''
                            : 'none';

                });

            });

        });

    </script>

@endsection