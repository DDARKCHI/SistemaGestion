@extends('layouts.app')

@section('title', 'Empresas de Factoring')

@section('topbar_title', 'Gestión de empresas de factoring')

@push('styles')

<style>

    /* =========================================================
       HEADER
    ========================================================== */

    .factoring-header {

        display: flex;

        align-items: flex-start;

        justify-content: space-between;

        gap: 20px;

        margin-bottom: 24px;

    }


    .factoring-title {

        margin: 0;

        color: #172033;

        font-size: 27px;

        line-height: 1.2;

        font-weight: 700;

        letter-spacing: -.025em;

    }


    .factoring-subtitle {

        margin: 7px 0 0;

        color: #667085;

        font-size: 13px;

    }


    .factoring-header-actions {

        display: flex;

        align-items: center;

        gap: 9px;

        flex-shrink: 0;

    }


    /* =========================================================
       RESUMEN
    ========================================================== */

    .factoring-summary {

        display: grid;

        grid-template-columns:
            repeat(3, 1fr);

        gap: 14px;

        margin-bottom: 20px;

    }


    .factoring-summary-card {

        background: #ffffff;

        border:
            1px solid #e2e8f0;

        border-radius: 9px;

        padding: 17px 19px;

        box-shadow:
            0 2px 7px rgba(16,47,80,.04);

    }


    .factoring-summary-label {

        color: #667085;

        font-size: 10px;

        font-weight: 600;

        text-transform: uppercase;

        letter-spacing: .03em;

    }


    .factoring-summary-value {

        margin-top: 7px;

        color: #172033;

        font-size: 23px;

        line-height: 1;

        font-weight: 700;

    }


    .factoring-summary-description {

        margin-top: 6px;

        color: #98a2b3;

        font-size: 9px;

    }


    /* =========================================================
       CARD TABLA
    ========================================================== */

    .factoring-card {

        background: #ffffff;

        border:
            1px solid #e2e8f0;

        border-radius: 10px;

        box-shadow:
            0 2px 8px rgba(16,47,80,.05);

        overflow: hidden;

    }


    .factoring-card-header {

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


    .factoring-card-heading {

        min-width: 0;

    }


    .factoring-card-title {

        margin: 0;

        color: #172033;

        font-size: 14px;

        font-weight: 700;

    }


    .factoring-card-description {

        margin: 4px 0 0;

        color: #98a2b3;

        font-size: 10px;

    }


    /* =========================================================
       BUSCADOR
    ========================================================== */

    .factoring-search {

        position: relative;

        width: 280px;

        flex-shrink: 0;

    }


    .factoring-search input {

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


    .factoring-search input::placeholder {

        color: #a1aab7;

    }


    .factoring-search input:focus {

        border-color: #155a91;

        box-shadow:
            0 0 0 3px rgba(21,90,145,.08);

    }


    .factoring-search-icon {

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

    .factoring-table-wrapper {

        width: 100%;

        overflow-x: auto;

    }


    .factoring-table {

        width: 100%;

        border-collapse: collapse;

        min-width: 900px;

    }


    .factoring-table th {

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


    .factoring-table td {

        padding:
            14px 18px;

        border-bottom:
            1px solid #edf1f5;

        color: #344054;

        font-size: 11px;

        vertical-align: middle;

    }


    .factoring-table tbody tr {

        transition:
            background .12s ease;

    }


    .factoring-table tbody tr:hover {

        background: #fbfcfe;

    }


    .factoring-table tbody tr:last-child td {

        border-bottom: none;

    }


    .factoring-name {

        color: #172033;

        font-size: 12px;

        font-weight: 600;

    }


    .factoring-rut {

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


    .factoring-contact {

        color: #667085;

        font-size: 10px;

    }


    .factoring-contact strong {

        display: block;

        color: #344054;

        font-size: 11px;

        font-weight: 500;

    }


    .factoring-contact span {

        display: block;

        margin-top: 2px;

        color: #98a2b3;

    }


    .factoring-executive {

        color: #344054;

        font-size: 11px;

    }


    .factoring-executive-empty {

        color: #98a2b3;

        font-size: 10px;

    }


    /* =========================================================
       ESTADO
    ========================================================== */

    .factoring-status {

        display: inline-flex;

        align-items: center;

        padding:
            4px 8px;

        border-radius: 5px;

        font-size: 9px;

        font-weight: 700;

        text-transform: uppercase;

        letter-spacing: .025em;

    }


    .factoring-status-active {

        background: #edf8f1;

        color: #287443;

        border:
            1px solid #d3ebdb;

    }


    .factoring-status-inactive {

        background: #f5f6f7;

        color: #667085;

        border:
            1px solid #e2e5e8;

    }


    /* =========================================================
       OPERACIONES
    ========================================================== */

    .factoring-operations {

        color: #155a91;

        font-size: 12px;

        font-weight: 700;

    }


    .factoring-operations-label {

        margin-left: 3px;

        color: #98a2b3;

        font-size: 9px;

        font-weight: 400;

    }


    /* =========================================================
       ACCIONES
    ========================================================== */

    .factoring-actions {

        display: flex;

        align-items: center;

        gap: 6px;

        white-space: nowrap;

    }


    .factoring-action {

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


    .factoring-action:hover {

        background: #f5f8fb;

        border-color: #cbd7e3;

        color: #155a91;

    }


    .factoring-action-primary {

        background: #eaf3fa;

        border-color: #d4e5f2;

        color: #155a91;

    }


    .factoring-action-primary:hover {

        background: #dfeef8;

        border-color: #c3dbea;

        color: #124d7d;

    }


    .factoring-action-danger {

        color: #b9382e;

        border-color: #f0d3cf;

        background: #ffffff;

    }


    .factoring-action-danger:hover {

        background: #fff5f3;

        border-color: #e9c1bc;

        color: #a52f26;

    }


    /* =========================================================
       EMPTY STATE
    ========================================================== */

    .factoring-empty {

        padding:
            55px 25px;

        text-align: center;

    }


    .factoring-empty-icon {

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


    .factoring-empty-title {

        margin: 0;

        color: #344054;

        font-size: 14px;

        font-weight: 700;

    }


    .factoring-empty-text {

        max-width: 390px;

        margin:
            6px auto 17px;

        color: #98a2b3;

        font-size: 11px;

        line-height: 1.5;

    }


    /* =========================================================
       PIE
    ========================================================== */

    .factoring-card-footer {

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


    .factoring-count {

        color: #98a2b3;

        font-size: 10px;

    }


    .factoring-count strong {

        color: #667085;

        font-weight: 600;

    }


    /* =========================================================
       ALERTAS
    ========================================================== */

    .factoring-success {

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


    .factoring-error {

        margin-bottom: 18px;

        padding:
            11px 14px;

        border:
            1px solid #f0d3cf;

        border-radius: 7px;

        background: #fff5f3;

        color: #b9382e;

        font-size: 11px;

    }


    /* =========================================================
       RESPONSIVE
    ========================================================== */

    @media (max-width: 1000px) {

        .factoring-summary {

            grid-template-columns:
                repeat(2, 1fr);

        }

    }


    @media (max-width: 700px) {

        .factoring-header {

            flex-direction: column;

        }


        .factoring-header-actions {

            width: 100%;

        }


        .factoring-header-actions .btn {

            flex: 1;

        }


        .factoring-summary {

            grid-template-columns: 1fr;

        }


        .factoring-card-header {

            align-items: stretch;

            flex-direction: column;

        }


        .factoring-search {

            width: 100%;

        }

    }

</style>

@endpush


@section('content')

    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="factoring-header">

        <div>

            <h1 class="factoring-title">
                Empresas de Factoring
            </h1>

            <p class="factoring-subtitle">
                Administración de empresas de factoring y sus antecedentes.
            </p>

        </div>


        <div class="factoring-header-actions">

            <a
                href="{{ route('empresas-factoring.create') }}"
                class="btn btn-primary"
            >
                + Nueva empresa
            </a>

        </div>

    </div>


    {{-- =====================================================
         MENSAJES
    ====================================================== --}}

    @if(session('success'))

        <div class="factoring-success">

            {{ session('success') }}

        </div>

    @endif


    @if(session('error'))

        <div class="factoring-error">

            {{ session('error') }}

        </div>

    @endif


    {{-- =====================================================
         RESUMEN
    ====================================================== --}}

    <div class="factoring-summary">

        <div class="factoring-summary-card">

            <div class="factoring-summary-label">
                Total empresas
            </div>

            <div class="factoring-summary-value">
                {{ $empresasFactoring->count() }}
            </div>

            <div class="factoring-summary-description">
                Empresas de factoring registradas
            </div>

        </div>


        <div class="factoring-summary-card">

            <div class="factoring-summary-label">
                Empresas activas
            </div>

            <div class="factoring-summary-value">
                {{ $empresasFactoring->where('estado', 'activo')->count() }}
            </div>

            <div class="factoring-summary-description">
                Empresas disponibles para nuevas operaciones
            </div>

        </div>


        <div class="factoring-summary-card">

            <div class="factoring-summary-label">
                Operaciones asociadas
            </div>

            <div class="factoring-summary-value">
                {{ $empresasFactoring->sum('factorings_count') }}
            </div>

            <div class="factoring-summary-description">
                Operaciones de factoring registradas
            </div>

        </div>

    </div>


    {{-- =====================================================
         LISTADO
    ====================================================== --}}

    <section class="factoring-card">

        <div class="factoring-card-header">

            <div class="factoring-card-heading">

                <h2 class="factoring-card-title">
                    Registro de empresas
                </h2>

                <p class="factoring-card-description">
                    Consulta y administra las empresas de factoring registradas.
                </p>

            </div>


            <div class="factoring-search">

                <span class="factoring-search-icon">
                    ⌕
                </span>

                <input
                    type="text"
                    id="factoringTableSearch"
                    placeholder="Buscar empresa, RUT o ejecutivo..."
                    autocomplete="off"
                >

            </div>

        </div>


        @if($empresasFactoring->count())

            <div class="factoring-table-wrapper">

                <table
                    class="factoring-table"
                    id="factoringTable"
                >

                    <thead>

                        <tr>

                            <th>
                                Empresa
                            </th>

                            <th>
                                RUT
                            </th>

                            <th>
                                Ejecutivo
                            </th>

                            <th>
                                Contacto
                            </th>

                            <th>
                                Estado
                            </th>

                            <th>
                                Operaciones
                            </th>

                            <th>
                                Acciones
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($empresasFactoring as $empresa)

                            <tr
                                data-factoring-row
                                data-search="
                                    {{ strtolower(
                                        $empresa->nombre . ' ' .
                                        $empresa->rut . ' ' .
                                        ($empresa->ejecutivo ?? '') . ' ' .
                                        ($empresa->correo ?? '') . ' ' .
                                        ($empresa->telefono ?? '')
                                    ) }}
                                "
                            >

                                <td>

                                    <div class="factoring-name">
                                        {{ $empresa->nombre }}
                                    </div>

                                </td>


                                <td>

                                    <span class="factoring-rut">
                                        {{ $empresa->rut }}
                                    </span>

                                </td>


                                <td>

                                    @if($empresa->ejecutivo)

                                        <div class="factoring-executive">
                                            {{ $empresa->ejecutivo }}
                                        </div>

                                    @else

                                        <span class="factoring-executive-empty">
                                            Sin ejecutivo registrado
                                        </span>

                                    @endif

                                </td>


                                <td>

                                    <div class="factoring-contact">

                                        @if($empresa->telefono)

                                            <strong>
                                                {{ $empresa->telefono }}
                                            </strong>

                                        @endif


                                        @if($empresa->correo)

                                            <span>
                                                {{ $empresa->correo }}
                                            </span>

                                        @endif


                                        @if(!$empresa->telefono && !$empresa->correo)

                                            <span>
                                                Sin contacto registrado
                                            </span>

                                        @endif

                                    </div>

                                </td>


                                <td>

                                    @if($empresa->estado === 'activo')

                                        <span class="factoring-status factoring-status-active">
                                            Activo
                                        </span>

                                    @else

                                        <span class="factoring-status factoring-status-inactive">
                                            Inactivo
                                        </span>

                                    @endif

                                </td>


                                <td>

                                    <span class="factoring-operations">
                                        {{ $empresa->factorings_count }}
                                    </span>

                                    <span class="factoring-operations-label">
                                        {{ $empresa->factorings_count === 1 ? 'operación' : 'operaciones' }}
                                    </span>

                                </td>


                                <td>

                                    <div class="factoring-actions">

                                        <a
                                            href="{{ route('empresas-factoring.show', $empresa) }}"
                                            class="factoring-action factoring-action-primary"
                                        >
                                            Ver
                                        </a>


                                        <a
                                            href="{{ route('empresas-factoring.edit', $empresa) }}"
                                            class="factoring-action"
                                        >
                                            Editar
                                        </a>


                                        @if($empresa->factorings_count === 0)

                                            <form
                                                action="{{ route('empresas-factoring.destroy', $empresa) }}"
                                                method="POST"
                                                style="display:inline;"
                                                onsubmit="return confirm('¿Estás seguro de eliminar esta empresa de factoring?');"
                                            >

                                                @csrf

                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="factoring-action factoring-action-danger"
                                                >
                                                    Eliminar
                                                </button>

                                            </form>

                                        @endif

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>


            <div class="factoring-card-footer">

                <div class="factoring-count">

                    Mostrando

                    <strong id="visibleFactoringCount">
                        {{ $empresasFactoring->count() }}
                    </strong>

                    de

                    <strong>
                        {{ $empresasFactoring->count() }}
                    </strong>

                    empresas

                </div>

            </div>


        @else

            <div class="factoring-empty">

                <div class="factoring-empty-icon">
                    ◉
                </div>

                <h3 class="factoring-empty-title">
                    No hay empresas de factoring registradas
                </h3>

                <p class="factoring-empty-text">
                    Comienza registrando la primera empresa de factoring para poder asociarla posteriormente a las operaciones correspondientes.
                </p>

                <a
                    href="{{ route('empresas-factoring.create') }}"
                    class="btn btn-primary"
                >
                    + Registrar primera empresa
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
                    'factoringTableSearch'
                );


            const rows =
                document.querySelectorAll(
                    '[data-factoring-row]'
                );


            const visibleCount =
                document.getElementById(
                    'visibleFactoringCount'
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