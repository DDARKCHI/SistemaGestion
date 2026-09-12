@extends('layouts.app')

@section('title', 'Transportistas')

@section('topbar_title', 'Gestión de transportistas')

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
                Transportistas
            </h1>

            <p class="carriers-subtitle">
                Administración de transportistas y sus servicios asociados.
            </p>

        </div>


        <div class="carriers-header-actions">

            <a
                href="{{ route('transportistas.create') }}"
                class="btn btn-primary"
            >
                + Nuevo transportista
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
                Total transportistas
            </div>

            <div class="carriers-summary-value">
                {{ $transportistas->count() }}
            </div>

            <div class="carriers-summary-description">
                Registros disponibles
            </div>

        </div>


        <div class="carriers-summary-card">

            <div class="carriers-summary-label">
                Con vehículos
            </div>

            <div class="carriers-summary-value">
                {{ $transportistas->where('vehiculos_count', '>', 0)->count() }}
            </div>

            <div class="carriers-summary-description">
                Transportistas con vehículos registrados
            </div>

        </div>


        <div class="carriers-summary-card">

            <div class="carriers-summary-label">
                Con servicios
            </div>

            <div class="carriers-summary-value">
                {{ $transportistas->where('servicios_transporte_count', '>', 0)->count() }}
            </div>

            <div class="carriers-summary-description">
                Transportistas con servicios registrados
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
                    Registro de transportistas
                </h2>

                <p class="carriers-card-description">
                    Consulta y administra los transportistas registrados.
                </p>

            </div>


            <div class="carriers-search">

                <span class="carriers-search-icon">
                    ⌕
                </span>

                <input
                    type="text"
                    id="carrierTableSearch"
                    placeholder="Buscar transportista o RUT..."
                    autocomplete="off"
                >

            </div>

        </div>


        @if($transportistas->count())

            <div class="carriers-table-wrapper">

                <table
                    class="carriers-table"
                    id="carriersTable"
                >

                    <thead>

                        <tr>

                            <th>
                                Transportista
                            </th>

                            <th>
                                RUT
                            </th>

                            <th>
                                Contacto
                            </th>

                            <th>
                                Dirección
                            </th>

                            <th>
                                Vehículos
                            </th>

                            <th>
                                Servicios
                            </th>

                            <th>
                                Gastos
                            </th>

                            <th>
                                Acciones
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($transportistas as $transportista)

                            <tr
                                data-carrier-row
                                data-search="
                                    {{ strtolower(
                                        $transportista->nombre . ' ' .
                                        $transportista->rut . ' ' .
                                        ($transportista->telefono ?? '') . ' ' .
                                        ($transportista->correo ?? '') . ' ' .
                                        ($transportista->direccion ?? '')
                                    ) }}
                                "
                            >

                                {{-- TRANSPORTISTA --}}

                                <td>

                                    <div class="carrier-name">
                                        {{ $transportista->nombre }}
                                    </div>

                                </td>


                                {{-- RUT --}}

                                <td>

                                    <span class="carrier-rut">
                                        {{ $transportista->rut }}
                                    </span>

                                </td>


                                {{-- CONTACTO --}}

                                <td>

                                    <div class="carrier-contact">

                                        @if($transportista->telefono)

                                            <strong>
                                                {{ $transportista->telefono }}
                                            </strong>

                                        @endif


                                        @if($transportista->correo)

                                            <span>
                                                {{ $transportista->correo }}
                                            </span>

                                        @endif


                                        @if(
                                            !$transportista->telefono &&
                                            !$transportista->correo
                                        )

                                            <span>
                                                Sin contacto registrado
                                            </span>

                                        @endif

                                    </div>

                                </td>


                                {{-- DIRECCIÓN --}}

                                <td>

                                    @if($transportista->direccion)

                                        {{ $transportista->direccion }}

                                    @else

                                        <span class="carrier-empty-value">
                                            —
                                        </span>

                                    @endif

                                </td>


                                {{-- VEHÍCULOS --}}

                                <td>

                                    <span class="carrier-count">
                                        {{ $transportista->vehiculos_count }}
                                    </span>

                                </td>


                                {{-- SERVICIOS --}}

                                <td>

                                    <span class="carrier-count">
                                        {{ $transportista->servicios_transporte_count }}
                                    </span>

                                </td>


                                {{-- GASTOS --}}

                                <td>

                                    @if($transportista->gastos_count > 0)

                                        <span class="carrier-count carrier-count-warning">
                                            {{ $transportista->gastos_count }}
                                        </span>

                                    @else

                                        <span class="carrier-empty-value">
                                            0
                                        </span>

                                    @endif

                                </td>


                                {{-- ACCIONES --}}

                                <td>

                                    <div class="carrier-actions">

                                        <a
                                            href="{{ route('transportistas.show', $transportista) }}"
                                            class="carrier-action carrier-action-primary"
                                        >
                                            Ver
                                        </a>


                                        <a
                                            href="{{ route('transportistas.edit', $transportista) }}"
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

                    <strong id="visibleCarrierCount">
                        {{ $transportistas->count() }}
                    </strong>

                    de

                    <strong>
                        {{ $transportistas->count() }}
                    </strong>

                    transportistas

                </div>

            </div>


        @else

            <div class="carriers-empty">

                <div class="carriers-empty-icon">
                    ◉
                </div>

                <h3 class="carriers-empty-title">
                    No hay transportistas registrados
                </h3>

                <p class="carriers-empty-text">
                    Comienza registrando el primer transportista para poder administrar sus datos, vehículos, servicios y gastos asociados.
                </p>

                <a
                    href="{{ route('transportistas.create') }}"
                    class="btn btn-primary"
                >
                    + Crear primer transportista
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
                    'carrierTableSearch'
                );


            const rows =
                document.querySelectorAll(
                    '[data-carrier-row]'
                );


            const visibleCount =
                document.getElementById(
                    'visibleCarrierCount'
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