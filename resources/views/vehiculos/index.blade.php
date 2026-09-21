@extends('layouts.app')

@section('title', 'Vehículos')

@section('topbar_title', 'Gestión de vehículos')

@push('styles')

<style>

    /* =========================================================
       HEADER
    ========================================================== */

    .carriers-header {

        display: flex;

        align-items: flex-start;

        justify-content: space-between;

        gap: 20px;

        margin-bottom: 24px;

    }


    .carriers-title {

        margin: 0;

        color: #172033;

        font-size: 27px;

        line-height: 1.2;

        font-weight: 700;

        letter-spacing: -.025em;

    }


    .carriers-subtitle {

        margin: 7px 0 0;

        color: #667085;

        font-size: 13px;

    }


    .carriers-header-actions {

        display: flex;

        align-items: center;

        gap: 9px;

        flex-shrink: 0;

    }


    /* =========================================================
       BOTÓN PRINCIPAL
    ========================================================== */

    .carriers-header-actions .btn-primary {

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


    .carriers-header-actions .btn-primary:hover {

        background: #124d7d;

        border-color: #124d7d;

        color: #ffffff;

    }


    /* =========================================================
       RESUMEN
    ========================================================== */

    .carriers-summary {

        display: grid;

        grid-template-columns:
            repeat(3, 1fr);

        gap: 14px;

        margin-bottom: 20px;

    }


    .carriers-summary-card {

        background: #ffffff;

        border:
            1px solid #e2e8f0;

        border-radius: 9px;

        padding: 17px 19px;

        box-shadow:
            0 2px 7px rgba(16,47,80,.04);

    }


    .carriers-summary-label {

        color: #667085;

        font-size: 10px;

        font-weight: 600;

        text-transform: uppercase;

        letter-spacing: .03em;

    }


    .carriers-summary-value {

        margin-top: 7px;

        color: #172033;

        font-size: 23px;

        line-height: 1;

        font-weight: 700;

    }


    .carriers-summary-description {

        margin-top: 6px;

        color: #98a2b3;

        font-size: 9px;

    }


    /* =========================================================
       CARD PRINCIPAL
    ========================================================== */

    .carriers-card {

        background: #ffffff;

        border:
            1px solid #e2e8f0;

        border-radius: 10px;

        box-shadow:
            0 2px 8px rgba(16,47,80,.05);

        overflow: hidden;

    }


    .carriers-card-header {

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


    .carriers-card-heading {

        min-width: 0;

    }


    .carriers-card-title {

        margin: 0;

        color: #172033;

        font-size: 14px;

        font-weight: 700;

    }


    .carriers-card-description {

        margin: 4px 0 0;

        color: #98a2b3;

        font-size: 10px;

    }


    /* =========================================================
       BUSCADOR
    ========================================================== */

    .carriers-search {

        position: relative;

        width: 260px;

        flex-shrink: 0;

    }


    .carriers-search input {

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


    .carriers-search input::placeholder {

        color: #a1aab7;

    }


    .carriers-search input:focus {

        border-color: #155a91;

        box-shadow:
            0 0 0 3px rgba(21,90,145,.08);

    }


    .carriers-search-icon {

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

    .carriers-table-wrapper {

        width: 100%;

        overflow-x: auto;

    }


    .carriers-table {

        width: 100%;

        border-collapse: collapse;

        min-width: 980px;

    }


    .carriers-table th {

        padding:
            12px 18px;

        background: #f8fafc;

        border-bottom:
            1px solid #e2e8f0;

        color: #667085;

        text-align: left;

        font-size: 10px;

        font-weight: 700;

        text-transform: uppercase;

        letter-spacing: .035em;

        white-space: nowrap;

    }


    .carriers-table td {

        padding:
            14px 18px;

        border-bottom:
            1px solid #edf1f5;

        color: #344054;

        font-size: 11px;

        vertical-align: middle;

    }


    .carriers-table tbody tr {

        transition:
            background .12s ease;

    }


    .carriers-table tbody tr:hover {

        background: #fbfcfe;

    }


    .carriers-table tbody tr:last-child td {

        border-bottom: none;

    }


    /* =========================================================
       DATOS DEL TRANSPORTISTA
    ========================================================== */

    .carrier-name {

        color: #172033;

        font-size: 12px;

        font-weight: 600;

    }


    .carrier-rut {

        display: inline-flex;

        align-items: center;

        padding:
            4px 7px;

        border-radius: 5px;

        background: #f1f4f7;

        color: #667085;

        font-size: 10px;

        font-weight: 600;

    }


    .carrier-contact {

        color: #667085;

        font-size: 10px;

    }


    .carrier-contact strong {

        display: block;

        color: #344054;

        font-size: 11px;

        font-weight: 500;

    }


    .carrier-contact span {

        display: block;

        margin-top: 2px;

        color: #98a2b3;

        font-size: 10px;

    }


    .carrier-count {

        display: inline-flex;

        align-items: center;

        justify-content: center;

        min-width: 26px;

        min-height: 25px;

        padding:
            3px 7px;

        border-radius: 6px;

        background: #eef4f8;

        color: #155a91;

        font-size: 10px;

        font-weight: 700;

    }


    .carrier-count-warning {

        background: #fff5e8;

        color: #a15c00;

    }


    .carrier-empty-value {

        color: #a1aab7;

    }


    /* =========================================================
       ACCIONES
    ========================================================== */

    .carrier-actions {

        display: flex;

        align-items: center;

        gap: 6px;

        white-space: nowrap;

    }


    .carrier-action {

        display: inline-flex;

        align-items: center;

        justify-content: center;

        min-height: 32px;

        padding:
            6px 10px;

        border:
            1px solid #dce3eb;

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


    .carrier-action:hover {

        background: #f5f8fb;

        border-color: #cbd7e3;

        color: #155a91;

    }


    .carrier-action-primary {

        background: #eaf3fa;

        border-color: #d4e5f2;

        color: #155a91;

    }


    .carrier-action-primary:hover {

        background: #dfeef8;

        border-color: #c3dbea;

        color: #124d7d;

    }


    /* =========================================================
       PIE
    ========================================================== */

    .carriers-card-footer {

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


    .carriers-count {

        color: #98a2b3;

        font-size: 10px;

    }


    .carriers-count strong {

        color: #667085;

        font-weight: 600;

    }


    /* =========================================================
       MENSAJES
    ========================================================== */

    .carriers-alert {

        margin-bottom: 18px;

        padding:
            11px 14px;

        border-radius: 7px;

        font-size: 11px;

    }


    .carriers-success {

        border:
            1px solid #cfe5d7;

        background: #f1faf4;

        color: #287443;

    }


    .carriers-error {

        border:
            1px solid #e9c1bc;

        background: #fff5f3;

        color: #a52f26;

    }


    /* =========================================================
       ESTADO VACÍO
    ========================================================== */

    .carriers-empty {

        padding:
            55px 25px;

        text-align: center;

    }


    .carriers-empty-icon {

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


    .carriers-empty-title {

        margin: 0;

        color: #344054;

        font-size: 14px;

        font-weight: 700;

    }


    .carriers-empty-text {

        max-width: 390px;

        margin:
            6px auto 17px;

        color: #98a2b3;

        font-size: 11px;

        line-height: 1.5;

    }


    /* =========================================================
       RESPONSIVE
    ========================================================== */

    @media (max-width: 1000px) {

        .carriers-summary {

            grid-template-columns:
                repeat(2, 1fr);

        }

    }


    @media (max-width: 700px) {

        .carriers-header {

            flex-direction: column;

        }


        .carriers-header-actions {

            width: 100%;

        }


        .carriers-header-actions .btn {

            width: 100%;

        }


        .carriers-summary {

            grid-template-columns: 1fr;

        }


        .carriers-card-header {

            align-items: stretch;

            flex-direction: column;

        }


        .carriers-search {

            width: 100%;

        }

    }

</style>

@endpush


@section('content')

    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="carriers-header">

        <div>

            <h1 class="carriers-title">
                Vehículos
            </h1>

            <p class="carriers-subtitle">
                Administración de vehículos asociados a los transportistas.
            </p>

        </div>


        <div class="carriers-header-actions">

            <a
                href="{{ route('vehiculos.create') }}"
                class="btn btn-primary"
            >
                + Nuevo vehículo
            </a>

        </div>

    </div>


    {{-- =====================================================
         MENSAJES
    ====================================================== --}}

    @if(session('success'))

        <div class="carriers-alert carriers-success">
            {{ session('success') }}
        </div>

    @endif


    @if(session('error'))

        <div class="carriers-alert carriers-error">
            {{ session('error') }}
        </div>

    @endif


    {{-- =====================================================
         RESUMEN
    ====================================================== --}}

    <div class="carriers-summary">

        <div class="carriers-summary-card">

            <div class="carriers-summary-label">
                Total vehículos
            </div>

            <div class="carriers-summary-value">
                {{ $vehiculos->count() }}
            </div>

            <div class="carriers-summary-description">
                Vehículos registrados
            </div>

        </div>


        <div class="carriers-summary-card">

            <div class="carriers-summary-label">
                Con servicios
            </div>

            <div class="carriers-summary-value">
                {{ $vehiculos->where('servicios_transporte_count', '>', 0)->count() }}
            </div>

            <div class="carriers-summary-description">
                Vehículos con servicios registrados
            </div>

        </div>


        <div class="carriers-summary-card">

            <div class="carriers-summary-label">
                Sin servicios
            </div>

            <div class="carriers-summary-value">
                {{ $vehiculos->where('servicios_transporte_count', 0)->count() }}
            </div>

            <div class="carriers-summary-description">
                Vehículos aún sin servicios
            </div>

        </div>

    </div>


    {{-- =====================================================
         LISTADO
    ====================================================== --}}

    <section class="carriers-card">

        <div class="carriers-card-header">

            <div class="carriers-card-heading">

                <h2 class="carriers-card-title">
                    Registro de vehículos
                </h2>

                <p class="carriers-card-description">
                    Consulta y administra los vehículos registrados.
                </p>

            </div>


            <div class="carriers-search">

                <span class="carriers-search-icon">
                    ⌕
                </span>

                <input
                    type="text"
                    id="vehicleTableSearch"
                    placeholder="Buscar patente, marca o transportista..."
                    autocomplete="off"
                >

            </div>

        </div>


        @if($vehiculos->count())

            <div class="carriers-table-wrapper">

                <table
                    class="carriers-table"
                    id="vehiclesTable"
                >

                    <thead>

                        <tr>

                            <th>Patente</th>
                            <th>Transportista</th>
                            <th>Tipo</th>
                            <th>Marca / Modelo</th>
                            <th>Año</th>
                            <th>Servicios</th>
                            <th>Acciones</th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($vehiculos as $vehiculo)

                            <tr
                                data-vehicle-row
                                data-search="
                                    {{ strtolower(
                                        $vehiculo->patente . ' ' .
                                        ($vehiculo->transportista?->nombre ?? '') . ' ' .
                                        ($vehiculo->transportista?->rut ?? '') . ' ' .
                                        ($vehiculo->tipo ?? '') . ' ' .
                                        ($vehiculo->marca ?? '') . ' ' .
                                        ($vehiculo->modelo ?? '') . ' ' .
                                        ($vehiculo->anio ?? '')
                                    ) }}
                                "
                            >

                                <td>
                                    <span class="carrier-rut">
                                        {{ $vehiculo->patente }}
                                    </span>
                                </td>


                                <td>

                                    @if($vehiculo->transportista)

                                        <div class="carrier-name">
                                            {{ $vehiculo->transportista->nombre }}
                                        </div>

                                        <div class="carrier-contact">
                                            <span>
                                                {{ $vehiculo->transportista->rut }}
                                            </span>
                                        </div>

                                    @else

                                        <span class="carrier-empty-value">
                                            Sin transportista
                                        </span>

                                    @endif

                                </td>


                                <td>

                                    @if($vehiculo->tipo)

                                        {{ $vehiculo->tipo }}

                                    @else

                                        <span class="carrier-empty-value">
                                            —
                                        </span>

                                    @endif

                                </td>


                                <td>

                                    @if($vehiculo->marca || $vehiculo->modelo)

                                        <div class="carrier-contact">

                                            @if($vehiculo->marca)

                                                <strong>
                                                    {{ $vehiculo->marca }}
                                                </strong>

                                            @endif

                                            @if($vehiculo->modelo)

                                                <span>
                                                    {{ $vehiculo->modelo }}
                                                </span>

                                            @endif

                                        </div>

                                    @else

                                        <span class="carrier-empty-value">
                                            —
                                        </span>

                                    @endif

                                </td>


                                <td>

                                    @if($vehiculo->anio)

                                        {{ $vehiculo->anio }}

                                    @else

                                        <span class="carrier-empty-value">
                                            —
                                        </span>

                                    @endif

                                </td>


                                <td>

                                    <span class="carrier-count">
                                        {{ $vehiculo->servicios_transporte_count }}
                                    </span>

                                </td>


                                <td>

                                    <div class="carrier-actions">

                                        <a
                                            href="{{ route('vehiculos.show', $vehiculo) }}"
                                            class="carrier-action carrier-action-primary"
                                        >
                                            Ver
                                        </a>


                                        <a
                                            href="{{ route('vehiculos.edit', $vehiculo) }}"
                                            class="carrier-action"
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


            <div class="carriers-card-footer">

                <div class="carriers-count">

                    Mostrando

                    <strong id="visibleVehicleCount">
                        {{ $vehiculos->count() }}
                    </strong>

                    de

                    <strong>
                        {{ $vehiculos->count() }}
                    </strong>

                    vehículos

                </div>

            </div>


        @else

            <div class="carriers-empty">

                <div class="carriers-empty-icon">
                    ◉
                </div>

                <h3 class="carriers-empty-title">
                    No hay vehículos registrados
                </h3>

                <p class="carriers-empty-text">
                    Registra el primer vehículo para asociarlo a un transportista y utilizarlo en los servicios de transporte.
                </p>

                <a
                    href="{{ route('vehiculos.create') }}"
                    class="btn btn-primary"
                >
                    + Crear primer vehículo
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
                    'vehicleTableSearch'
                );


            const rows =
                document.querySelectorAll(
                    '[data-vehicle-row]'
                );


            const visibleCount =
                document.getElementById(
                    'visibleVehicleCount'
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
