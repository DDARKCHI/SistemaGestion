@extends('layouts.app')

@section('title', 'Proveedores')

@section('topbar_title', 'Gestión de proveedores')

@push('styles')

<style>

    /* =========================================================
       HEADER
    ========================================================== */

    .suppliers-header {

        display: flex;

        align-items: flex-start;

        justify-content: space-between;

        gap: 20px;

        margin-bottom: 24px;

    }


    .suppliers-title {

        margin: 0;

        color: #172033;

        font-size: 27px;

        line-height: 1.2;

        font-weight: 700;

        letter-spacing: -.025em;

    }


    .suppliers-subtitle {

        margin: 7px 0 0;

        color: #667085;

        font-size: 13px;

    }


    .suppliers-header-actions {

        display: flex;

        align-items: center;

        gap: 9px;

        flex-shrink: 0;

    }


    /* =========================================================
       BOTÓN PRINCIPAL
    ========================================================== */

    .suppliers-header-actions .btn-primary {

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


    .suppliers-header-actions .btn-primary:hover {

        background: #124d7d;

        border-color: #124d7d;

        color: #ffffff;

    }


    /* =========================================================
       RESUMEN
    ========================================================== */

    .suppliers-summary {

        display: grid;

        grid-template-columns:
            repeat(3, 1fr);

        gap: 14px;

        margin-bottom: 20px;

    }


    .suppliers-summary-card {

        background: #ffffff;

        border:
            1px solid #e2e8f0;

        border-radius: 9px;

        padding: 17px 19px;

        box-shadow:
            0 2px 7px rgba(16,47,80,.04);

    }


    .suppliers-summary-label {

        color: #667085;

        font-size: 10px;

        font-weight: 600;

        text-transform: uppercase;

        letter-spacing: .03em;

    }


    .suppliers-summary-value {

        margin-top: 7px;

        color: #172033;

        font-size: 23px;

        line-height: 1;

        font-weight: 700;

    }


    .suppliers-summary-description {

        margin-top: 6px;

        color: #98a2b3;

        font-size: 9px;

    }


    /* =========================================================
       CARD PRINCIPAL
    ========================================================== */

    .suppliers-card {

        background: #ffffff;

        border:
            1px solid #e2e8f0;

        border-radius: 10px;

        box-shadow:
            0 2px 8px rgba(16,47,80,.05);

        overflow: hidden;

    }


    .suppliers-card-header {

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


    .suppliers-card-heading {

        min-width: 0;

    }


    .suppliers-card-title {

        margin: 0;

        color: #172033;

        font-size: 14px;

        font-weight: 700;

    }


    .suppliers-card-description {

        margin: 4px 0 0;

        color: #98a2b3;

        font-size: 10px;

    }


    /* =========================================================
       BUSCADOR
    ========================================================== */

    .suppliers-search {

        position: relative;

        width: 260px;

        flex-shrink: 0;

    }


    .suppliers-search input {

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


    .suppliers-search input::placeholder {

        color: #a1aab7;

    }


    .suppliers-search input:focus {

        border-color: #155a91;

        box-shadow:
            0 0 0 3px rgba(21,90,145,.08);

    }


    .suppliers-search-icon {

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

    .suppliers-table-wrapper {

        width: 100%;

        overflow-x: auto;

    }


    .suppliers-table {

        width: 100%;

        border-collapse: collapse;

        min-width: 980px;

    }


    .suppliers-table th {

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


    .suppliers-table td {

        padding:
            14px 18px;

        border-bottom:
            1px solid #edf1f5;

        color: #344054;

        font-size: 11px;

        vertical-align: middle;

    }


    .suppliers-table tbody tr {

        transition:
            background .12s ease;

    }


    .suppliers-table tbody tr:hover {

        background: #fbfcfe;

    }


    .suppliers-table tbody tr:last-child td {

        border-bottom: none;

    }


    /* =========================================================
       DATOS DEL PROVEEDOR
    ========================================================== */

    .supplier-name {

        color: #172033;

        font-size: 12px;

        font-weight: 600;

    }


    .supplier-rut {

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


    .supplier-contact {

        color: #667085;

        font-size: 10px;

    }


    .supplier-contact strong {

        display: block;

        color: #344054;

        font-size: 11px;

        font-weight: 500;

    }


    .supplier-contact span {

        display: block;

        margin-top: 2px;

        color: #98a2b3;

        font-size: 10px;

    }


    .supplier-count {

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


    .supplier-count-warning {

        background: #fff5e8;

        color: #a15c00;

    }


    .supplier-empty-value {

        color: #a1aab7;

    }


    /* =========================================================
       ACCIONES
    ========================================================== */

    .supplier-actions {

        display: flex;

        align-items: center;

        gap: 6px;

        white-space: nowrap;

    }


    .supplier-action {

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


    .supplier-action:hover {

        background: #f5f8fb;

        border-color: #cbd7e3;

        color: #155a91;

    }


    .supplier-action-primary {

        background: #eaf3fa;

        border-color: #d4e5f2;

        color: #155a91;

    }


    .supplier-action-primary:hover {

        background: #dfeef8;

        border-color: #c3dbea;

        color: #124d7d;

    }


    /* =========================================================
       PIE
    ========================================================== */

    .suppliers-card-footer {

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


    .suppliers-count {

        color: #98a2b3;

        font-size: 10px;

    }


    .suppliers-count strong {

        color: #667085;

        font-weight: 600;

    }


    /* =========================================================
       MENSAJES
    ========================================================== */

    .suppliers-alert {

        margin-bottom: 18px;

        padding:
            11px 14px;

        border-radius: 7px;

        font-size: 11px;

    }


    .suppliers-success {

        border:
            1px solid #cfe5d7;

        background: #f1faf4;

        color: #287443;

    }


    .suppliers-error {

        border:
            1px solid #e9c1bc;

        background: #fff5f3;

        color: #a52f26;

    }


    /* =========================================================
       ESTADO VACÍO
    ========================================================== */

    .suppliers-empty {

        padding:
            55px 25px;

        text-align: center;

    }


    .suppliers-empty-icon {

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


    .suppliers-empty-title {

        margin: 0;

        color: #344054;

        font-size: 14px;

        font-weight: 700;

    }


    .suppliers-empty-text {

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

        .suppliers-summary {

            grid-template-columns:
                repeat(2, 1fr);

        }

    }


    @media (max-width: 700px) {

        .suppliers-header {

            flex-direction: column;

        }


        .suppliers-header-actions {

            width: 100%;

        }


        .suppliers-header-actions .btn {

            width: 100%;

        }


        .suppliers-summary {

            grid-template-columns: 1fr;

        }


        .suppliers-card-header {

            align-items: stretch;

            flex-direction: column;

        }


        .suppliers-search {

            width: 100%;

        }

    }

</style>

@endpush


@section('content')

    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="suppliers-header">

        <div>

            <h1 class="suppliers-title">
                Proveedores
            </h1>

            <p class="suppliers-subtitle">
                Administración de proveedores y sus antecedentes.
            </p>

        </div>


        <div class="suppliers-header-actions">

            <a
                href="{{ route('proveedores.create') }}"
                class="btn btn-primary"
            >
                + Nuevo proveedor
            </a>

        </div>

    </div>


    {{-- =====================================================
         MENSAJES
    ====================================================== --}}

    @if(session('success'))

        <div class="suppliers-alert suppliers-success">

            {{ session('success') }}

        </div>

    @endif


    @if(session('error'))

        <div class="suppliers-alert suppliers-error">

            {{ session('error') }}

        </div>

    @endif


    {{-- =====================================================
         RESUMEN
    ====================================================== --}}

    <div class="suppliers-summary">

        <div class="suppliers-summary-card">

            <div class="suppliers-summary-label">
                Total proveedores
            </div>

            <div class="suppliers-summary-value">
                {{ $proveedores->count() }}
            </div>

            <div class="suppliers-summary-description">
                Registros disponibles
            </div>

        </div>


        <div class="suppliers-summary-card">

            <div class="suppliers-summary-label">
                Con bodegas
            </div>

            <div class="suppliers-summary-value">
                {{ $proveedores->where('bodegas_count', '>', 0)->count() }}
            </div>

            <div class="suppliers-summary-description">
                Proveedores con bodegas registradas
            </div>

        </div>


        <div class="suppliers-summary-card">

            <div class="suppliers-summary-label">
                NC pendientes
            </div>

            <div class="suppliers-summary-value">
                {{ $proveedores->sum('notas_credito_pendientes_count') }}
            </div>

            <div class="suppliers-summary-description">
                Notas de crédito pendientes de recuperar
            </div>

        </div>

    </div>


    {{-- =====================================================
         LISTADO
    ====================================================== --}}

    <section class="suppliers-card">

        <div class="suppliers-card-header">

            <div class="suppliers-card-heading">

                <h2 class="suppliers-card-title">
                    Registro de proveedores
                </h2>

                <p class="suppliers-card-description">
                    Consulta y administra los proveedores registrados.
                </p>

            </div>


            <div class="suppliers-search">

                <span class="suppliers-search-icon">
                    ⌕
                </span>

                <input
                    type="text"
                    id="supplierTableSearch"
                    placeholder="Buscar proveedor o RUT..."
                    autocomplete="off"
                >

            </div>

        </div>


        @if($proveedores->count())

            <div class="suppliers-table-wrapper">

                <table
                    class="suppliers-table"
                    id="suppliersTable"
                >

                    <thead>

                        <tr>

                            <th>
                                Proveedor
                            </th>

                            <th>
                                RUT
                            </th>

                            <th>
                                Localidad
                            </th>

                            <th>
                                Contacto
                            </th>

                            <th>
                                Bodegas
                            </th>

                            <th>
                                Ejecutivos
                            </th>

                            <th>
                                NC pendientes
                            </th>

                            <th>
                                Acciones
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($proveedores as $proveedor)

                            <tr
                                data-supplier-row
                                data-search="
                                    {{ strtolower(
                                        $proveedor->nombre . ' ' .
                                        $proveedor->rut . ' ' .
                                        ($proveedor->localidad ?? '') . ' ' .
                                        ($proveedor->cuenta ?? '') . ' ' .
                                        ($proveedor->telefono ?? '') . ' ' .
                                        ($proveedor->correo ?? '')
                                    ) }}
                                "
                            >

                                {{-- PROVEEDOR --}}

                                <td>

                                    <div class="supplier-name">
                                        {{ $proveedor->nombre }}
                                    </div>

                                </td>


                                {{-- RUT --}}

                                <td>

                                    <span class="supplier-rut">
                                        {{ $proveedor->rut }}
                                    </span>

                                </td>


                                {{-- LOCALIDAD --}}

                                <td>

                                    @if($proveedor->localidad)

                                        {{ $proveedor->localidad }}

                                    @else

                                        <span class="supplier-empty-value">
                                            —
                                        </span>

                                    @endif

                                </td>


                                {{-- CONTACTO --}}

                                <td>

                                    <div class="supplier-contact">

                                        @if($proveedor->telefono)

                                            <strong>
                                                {{ $proveedor->telefono }}
                                            </strong>

                                        @endif


                                        @if($proveedor->correo)

                                            <span>
                                                {{ $proveedor->correo }}
                                            </span>

                                        @endif


                                        @if(!$proveedor->telefono && !$proveedor->correo)

                                            <span>
                                                Sin contacto registrado
                                            </span>

                                        @endif

                                    </div>

                                </td>


                                {{-- BODEGAS --}}

                                <td>

                                    <span class="supplier-count">
                                        {{ $proveedor->bodegas_count }}
                                    </span>

                                </td>


                                {{-- EJECUTIVOS --}}

                                <td>

                                    <span class="supplier-count">
                                        {{ $proveedor->ejecutivos_count }}
                                    </span>

                                </td>


                                {{-- NOTAS DE CRÉDITO --}}

                                <td>

                                    @if($proveedor->notas_credito_pendientes_count > 0)

                                        <span class="supplier-count supplier-count-warning">
                                            {{ $proveedor->notas_credito_pendientes_count }}
                                        </span>

                                    @else

                                        <span class="supplier-empty-value">
                                            0
                                        </span>

                                    @endif

                                </td>


                                {{-- ACCIONES --}}

                                <td>

                                    <div class="supplier-actions">

                                        <a
                                            href="{{ route('proveedores.show', $proveedor) }}"
                                            class="supplier-action supplier-action-primary"
                                        >
                                            Ver
                                        </a>


                                        <a
                                            href="{{ route('proveedores.edit', $proveedor) }}"
                                            class="supplier-action"
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


            <div class="suppliers-card-footer">

                <div class="suppliers-count">

                    Mostrando

                    <strong id="visibleSupplierCount">
                        {{ $proveedores->count() }}
                    </strong>

                    de

                    <strong>
                        {{ $proveedores->count() }}
                    </strong>

                    proveedores

                </div>

            </div>


        @else

            <div class="suppliers-empty">

                <div class="suppliers-empty-icon">
                    ◉
                </div>

                <h3 class="suppliers-empty-title">
                    No hay proveedores registrados
                </h3>

                <p class="suppliers-empty-text">
                    Comienza registrando el primer proveedor para poder administrar sus datos, bodegas, ejecutivos y notas de crédito pendientes.
                </p>

                <a
                    href="{{ route('proveedores.create') }}"
                    class="btn btn-primary"
                >
                    + Crear primer proveedor
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
                    'supplierTableSearch'
                );


            const rows =
                document.querySelectorAll(
                    '[data-supplier-row]'
                );


            const visibleCount =
                document.getElementById(
                    'visibleSupplierCount'
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