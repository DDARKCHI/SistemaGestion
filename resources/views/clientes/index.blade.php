@extends('layouts.app')

@section('title', 'Clientes')

@section('topbar_title', 'Gestión de clientes')

@push('styles')

<style>

    /* =========================================================
       HEADER
    ========================================================== */

    .clients-header {

        display: flex;

        align-items: flex-start;

        justify-content: space-between;

        gap: 20px;

        margin-bottom: 24px;

    }


    .clients-title {

        margin: 0;

        color: #172033;

        font-size: 27px;

        line-height: 1.2;

        font-weight: 700;

        letter-spacing: -.025em;

    }


    .clients-subtitle {

        margin: 7px 0 0;

        color: #667085;

        font-size: 13px;

    }


    .clients-header-actions {

        display: flex;

        align-items: center;

        gap: 9px;

        flex-shrink: 0;

    }


    /* =========================================================
       RESUMEN
    ========================================================== */

    .clients-summary {

        display: grid;

        grid-template-columns:
            repeat(3, 1fr);

        gap: 14px;

        margin-bottom: 20px;

    }


    .clients-summary-card {

        background: #ffffff;

        border:
            1px solid #e2e8f0;

        border-radius: 9px;

        padding: 17px 19px;

        box-shadow:
            0 2px 7px rgba(16,47,80,.04);

    }


    .clients-summary-label {

        color: #667085;

        font-size: 10px;

        font-weight: 600;

        text-transform: uppercase;

        letter-spacing: .03em;

    }


    .clients-summary-value {

        margin-top: 7px;

        color: #172033;

        font-size: 23px;

        line-height: 1;

        font-weight: 700;

    }


    .clients-summary-description {

        margin-top: 6px;

        color: #98a2b3;

        font-size: 9px;

    }


    /* =========================================================
       CARD TABLA
    ========================================================== */

    .clients-card {

        background: #ffffff;

        border:
            1px solid #e2e8f0;

        border-radius: 10px;

        box-shadow:
            0 2px 8px rgba(16,47,80,.05);

        overflow: hidden;

    }


    .clients-card-header {

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


    .clients-card-heading {

        min-width: 0;

    }


    .clients-card-title {

        margin: 0;

        color: #172033;

        font-size: 14px;

        font-weight: 700;

    }


    .clients-card-description {

        margin: 4px 0 0;

        color: #98a2b3;

        font-size: 10px;

    }


    /* =========================================================
       BUSCADOR
    ========================================================== */

    .clients-search {

        position: relative;

        width: 260px;

        flex-shrink: 0;

    }


    .clients-search input {

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


    .clients-search input::placeholder {

        color: #a1aab7;

    }


    .clients-search input:focus {

        border-color: #155a91;

        box-shadow:
            0 0 0 3px rgba(21,90,145,.08);

    }


    .clients-search-icon {

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

    .clients-table-wrapper {

        width: 100%;

        overflow-x: auto;

    }


    .clients-table {

        width: 100%;

        border-collapse: collapse;

        min-width: 780px;

    }


    .clients-table th {

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


    .clients-table td {

        padding:
            14px 18px;

        border-bottom:
            1px solid #edf1f5;

        color: #344054;

        font-size: 11px;

        vertical-align: middle;

    }


    .clients-table tbody tr {

        transition:
            background .12s ease;

    }


    .clients-table tbody tr:hover {

        background: #fbfcfe;

    }


    .clients-table tbody tr:last-child td {

        border-bottom: none;

    }


    .client-name {

        color: #172033;

        font-size: 12px;

        font-weight: 600;

    }


    .client-rut {

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


    .client-contact {

        color: #667085;

        font-size: 10px;

    }


    .client-contact strong {

        display: block;

        color: #344054;

        font-size: 11px;

        font-weight: 500;

    }


    .client-contact span {

        display: block;

        margin-top: 2px;

        color: #98a2b3;

    }


    /* =========================================================
       ACCIONES
    ========================================================== */

    .client-actions {

        display: flex;

        align-items: center;

        gap: 6px;

        white-space: nowrap;

    }


    .client-action {

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


    .client-action:hover {

        background: #f5f8fb;

        border-color: #cbd7e3;

        color: #155a91;

    }


    .client-action-primary {

        background: #eaf3fa;

        border-color: #d4e5f2;

        color: #155a91;

    }


    .client-action-primary:hover {

        background: #dfeef8;

        border-color: #c3dbea;

        color: #124d7d;

    }


    .client-action-danger {

        color: #b9382e;

        border-color: #f0d3cf;

        background: #ffffff;

    }


    .client-action-danger:hover {

        background: #fff5f3;

        border-color: #e9c1bc;

        color: #a52f26;

    }


    /* =========================================================
       EMPTY STATE
    ========================================================== */

    .clients-empty {

        padding:
            55px 25px;

        text-align: center;

    }


    .clients-empty-icon {

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


    .clients-empty-title {

        margin: 0;

        color: #344054;

        font-size: 14px;

        font-weight: 700;

    }


    .clients-empty-text {

        max-width: 360px;

        margin:
            6px auto 17px;

        color: #98a2b3;

        font-size: 11px;

        line-height: 1.5;

    }


    /* =========================================================
       PAGINACIÓN / PIE
    ========================================================== */

    .clients-card-footer {

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


    .clients-count {

        color: #98a2b3;

        font-size: 10px;

    }


    .clients-count strong {

        color: #667085;

        font-weight: 600;

    }


    /* =========================================================
       ALERTA
    ========================================================== */

    .clients-success {

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

        .clients-summary {

            grid-template-columns:
                repeat(2, 1fr);

        }

    }


    @media (max-width: 700px) {

        .clients-header {

            flex-direction: column;

        }


        .clients-header-actions {

            width: 100%;

        }


        .clients-header-actions .btn {

            flex: 1;

        }


        .clients-summary {

            grid-template-columns: 1fr;

        }


        .clients-card-header {

            align-items: stretch;

            flex-direction: column;

        }


        .clients-search {

            width: 100%;

        }

    }

</style>

@endpush


@section('content')

    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="clients-header">

        <div>

            <h1 class="clients-title">
                Clientes
            </h1>

            <p class="clients-subtitle">
                Administración de clientes y sus antecedentes.
            </p>

        </div>


        <div class="clients-header-actions">

            <a
                href="{{ route('clientes.create') }}"
                class="btn btn-primary"
            >
                + Nuevo cliente
            </a>

        </div>

    </div>


    {{-- =====================================================
         MENSAJE
    ====================================================== --}}

    @if(session('success'))

        <div class="clients-success">

            {{ session('success') }}

        </div>

    @endif


    {{-- =====================================================
         RESUMEN
    ====================================================== --}}

    <div class="clients-summary">

        <div class="clients-summary-card">

            <div class="clients-summary-label">
                Total clientes
            </div>

            <div class="clients-summary-value">
                {{ $clientes->count() }}
            </div>

            <div class="clients-summary-description">
                Registros disponibles
            </div>

        </div>


        <div class="clients-summary-card">

            <div class="clients-summary-label">
                Con teléfono
            </div>

            <div class="clients-summary-value">
                {{ $clientes->whereNotNull('telefono')->where('telefono', '!=', '')->count() }}
            </div>

            <div class="clients-summary-description">
                Clientes con contacto telefónico
            </div>

        </div>


        <div class="clients-summary-card">

            <div class="clients-summary-label">
                Con correo
            </div>

            <div class="clients-summary-value">
                {{ $clientes->whereNotNull('correo')->where('correo', '!=', '')->count() }}
            </div>

            <div class="clients-summary-description">
                Clientes con correo registrado
            </div>

        </div>

    </div>


    {{-- =====================================================
         LISTADO
    ====================================================== --}}

    <section class="clients-card">

        <div class="clients-card-header">

            <div class="clients-card-heading">

                <h2 class="clients-card-title">
                    Registro de clientes
                </h2>

                <p class="clients-card-description">
                    Consulta y administra los clientes registrados.
                </p>

            </div>


            <div class="clients-search">

                <span class="clients-search-icon">
                    ⌕
                </span>

                <input
                    type="text"
                    id="clientTableSearch"
                    placeholder="Buscar cliente o RUT..."
                    autocomplete="off"
                >

            </div>

        </div>


        @if($clientes->count())

            <div class="clients-table-wrapper">

                <table
                    class="clients-table"
                    id="clientsTable"
                >

                    <thead>

                        <tr>

                            <th>
                                Cliente
                            </th>

                            <th>
                                RUT
                            </th>

                            <th>
                                Comuna
                            </th>

                            <th>
                                Contacto
                            </th>

                            <th>
                                Dirección
                            </th>

                            <th>
                                Acciones
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($clientes as $cliente)

                            <tr
                                data-client-row
                                data-search="
                                    {{ strtolower(
                                        $cliente->razon_social . ' ' .
                                        $cliente->rut . ' ' .
                                        ($cliente->comuna ?? '') . ' ' .
                                        ($cliente->telefono ?? '') . ' ' .
                                        ($cliente->correo ?? '')
                                    ) }}
                                "
                            >

                                <td>

                                    <div class="client-name">
                                        {{ $cliente->razon_social }}
                                    </div>

                                </td>


                                <td>

                                    <span class="client-rut">
                                        {{ $cliente->rut }}
                                    </span>

                                </td>


                                <td>

                                    {{ $cliente->comuna ?: '—' }}

                                </td>


                                <td>

                                    <div class="client-contact">

                                        @if($cliente->telefono)

                                            <strong>
                                                {{ $cliente->telefono }}
                                            </strong>

                                        @endif


                                        @if($cliente->correo)

                                            <span>
                                                {{ $cliente->correo }}
                                            </span>

                                        @endif


                                        @if(!$cliente->telefono && !$cliente->correo)

                                            <span>
                                                Sin contacto registrado
                                            </span>

                                        @endif

                                    </div>

                                </td>


                                <td>

                                    {{ $cliente->direccion ?: '—' }}

                                </td>


                                <td>

                                    <div class="client-actions">

                                        <a
                                            href="{{ route('clientes.show', $cliente) }}"
                                            class="client-action client-action-primary"
                                        >
                                            Ver
                                        </a>


                                        <a
                                            href="{{ route('clientes.edit', $cliente) }}"
                                            class="client-action"
                                        >
                                            Editar
                                        </a>


                                        <form
                                            action="{{ route('clientes.destroy', $cliente) }}"
                                            method="POST"
                                            style="display:inline;"
                                            onsubmit="return confirm('¿Estás seguro de eliminar este cliente?');"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="client-action client-action-danger"
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


            <div class="clients-card-footer">

                <div class="clients-count">

                    Mostrando

                    <strong id="visibleClientCount">
                        {{ $clientes->count() }}
                    </strong>

                    de

                    <strong>
                        {{ $clientes->count() }}
                    </strong>

                    clientes

                </div>

            </div>


        @else

            <div class="clients-empty">

                <div class="clients-empty-icon">
                    ◉
                </div>

                <h3 class="clients-empty-title">
                    No hay clientes registrados
                </h3>

                <p class="clients-empty-text">
                    Comienza registrando el primer cliente para poder asociarlo a operaciones y otros procesos del sistema.
                </p>

                <a
                    href="{{ route('clientes.create') }}"
                    class="btn btn-primary"
                >
                    + Crear primer cliente
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
                    'clientTableSearch'
                );


            const rows =
                document.querySelectorAll(
                    '[data-client-row]'
                );


            const visibleCount =
                document.getElementById(
                    'visibleClientCount'
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