@extends('layouts.app')

@section('title', 'Trabajadores')

@section('topbar_title', 'Gestión de trabajadores')

@push('styles')

<style>

    /* =========================================================
       HEADER
    ========================================================== */

    .workers-header {

        display: flex;

        align-items: flex-start;

        justify-content: space-between;

        gap: 20px;

        margin-bottom: 24px;

    }


    .workers-title {

        margin: 0;

        color: #172033;

        font-size: 27px;

        line-height: 1.2;

        font-weight: 700;

        letter-spacing: -.025em;

    }


    .workers-subtitle {

        margin: 7px 0 0;

        color: #667085;

        font-size: 13px;

    }


    .workers-header-actions {

        display: flex;

        align-items: center;

        gap: 9px;

        flex-shrink: 0;

    }


    /* =========================================================
       RESUMEN
    ========================================================== */

    .workers-summary {

        display: grid;

        grid-template-columns:
            repeat(3, 1fr);

        gap: 14px;

        margin-bottom: 20px;

    }


    .workers-summary-card {

        background: #ffffff;

        border:
            1px solid #e2e8f0;

        border-radius: 9px;

        padding: 17px 19px;

        box-shadow:
            0 2px 7px rgba(16,47,80,.04);

    }


    .workers-summary-label {

        color: #667085;

        font-size: 10px;

        font-weight: 600;

        text-transform: uppercase;

        letter-spacing: .03em;

    }


    .workers-summary-value {

        margin-top: 7px;

        color: #172033;

        font-size: 23px;

        line-height: 1;

        font-weight: 700;

    }


    .workers-summary-description {

        margin-top: 6px;

        color: #98a2b3;

        font-size: 9px;

    }


    /* =========================================================
       CARD TABLA
    ========================================================== */

    .workers-card {

        background: #ffffff;

        border:
            1px solid #e2e8f0;

        border-radius: 10px;

        box-shadow:
            0 2px 8px rgba(16,47,80,.05);

        overflow: hidden;

    }


    .workers-card-header {

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


    .workers-card-heading {

        min-width: 0;

    }


    .workers-card-title {

        margin: 0;

        color: #172033;

        font-size: 14px;

        font-weight: 700;

    }


    .workers-card-description {

        margin: 4px 0 0;

        color: #98a2b3;

        font-size: 10px;

    }


    /* =========================================================
       BUSCADOR
    ========================================================== */

    .workers-search {

        position: relative;

        width: 260px;

        flex-shrink: 0;

    }


    .workers-search input {

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


    .workers-search input::placeholder {

        color: #a1aab7;

    }


    .workers-search input:focus {

        border-color: #155a91;

        box-shadow:
            0 0 0 3px rgba(21,90,145,.08);

    }


    .workers-search-icon {

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

    .workers-table-wrapper {

        width: 100%;

        overflow-x: auto;

    }


    .workers-table {

        width: 100%;

        border-collapse: collapse;

        min-width: 850px;

    }


    .workers-table th {

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


    .workers-table td {

        padding:
            14px 18px;

        border-bottom:
            1px solid #edf1f5;

        color: #344054;

        font-size: 11px;

        vertical-align: middle;

    }


    .workers-table tbody tr {

        transition:
            background .12s ease;

    }


    .workers-table tbody tr:hover {

        background: #fbfcfe;

    }


    .workers-table tbody tr:last-child td {

        border-bottom: none;

    }


    .worker-name {

        color: #172033;

        font-size: 12px;

        font-weight: 600;

    }


    .worker-rut {

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


    .worker-contact {

        color: #667085;

        font-size: 10px;

    }


    .worker-contact strong {

        display: block;

        color: #344054;

        font-size: 11px;

        font-weight: 500;

    }


    .worker-contact span {

        display: block;

        margin-top: 2px;

        color: #98a2b3;

    }


    .worker-remuneration {

        color: #344054;

        font-size: 11px;

        font-weight: 600;

        white-space: nowrap;

    }


    .worker-date {

        color: #667085;

        font-size: 10px;

        white-space: nowrap;

    }


    /* =========================================================
       ACCIONES
    ========================================================== */

    .worker-actions {

        display: flex;

        align-items: center;

        gap: 6px;

        white-space: nowrap;

    }


    .worker-action {

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


    .worker-action:hover {

        background: #f5f8fb;

        border-color: #cbd7e3;

        color: #155a91;

    }


    .worker-action-primary {

        background: #eaf3fa;

        border-color: #d4e5f2;

        color: #155a91;

    }


    .worker-action-primary:hover {

        background: #dfeef8;

        border-color: #c3dbea;

        color: #124d7d;

    }


    .worker-action-danger {

        color: #b9382e;

        border-color: #f0d3cf;

        background: #ffffff;

    }


    .worker-action-danger:hover {

        background: #fff5f3;

        border-color: #e9c1bc;

        color: #a52f26;

    }


    /* =========================================================
       EMPTY STATE
    ========================================================== */

    .workers-empty {

        padding:
            55px 25px;

        text-align: center;

    }


    .workers-empty-icon {

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


    .workers-empty-title {

        margin: 0;

        color: #344054;

        font-size: 14px;

        font-weight: 700;

    }


    .workers-empty-text {

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

    .workers-card-footer {

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


    .workers-count {

        color: #98a2b3;

        font-size: 10px;

    }


    .workers-count strong {

        color: #667085;

        font-weight: 600;

    }


    /* =========================================================
       ALERTA
    ========================================================== */

    .workers-success {

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

        .workers-summary {

            grid-template-columns:
                repeat(2, 1fr);

        }

    }


    @media (max-width: 700px) {

        .workers-header {

            flex-direction: column;

        }


        .workers-header-actions {

            width: 100%;

        }


        .workers-header-actions .btn {

            flex: 1;

        }


        .workers-summary {

            grid-template-columns: 1fr;

        }


        .workers-card-header {

            align-items: stretch;

            flex-direction: column;

        }


        .workers-search {

            width: 100%;

        }

    }

</style>

@endpush


@section('content')

    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="workers-header">

        <div>

            <h1 class="workers-title">
                Trabajadores
            </h1>

            <p class="workers-subtitle">
                Administración de trabajadores y sus antecedentes laborales.
            </p>

        </div>


        <div class="workers-header-actions">

            <a
                href="{{ route('trabajadores.create') }}"
                class="btn btn-primary"
            >
                + Nuevo trabajador
            </a>

        </div>

    </div>


    {{-- =====================================================
         MENSAJE
    ====================================================== --}}

    @if(session('success'))

        <div class="workers-success">

            {{ session('success') }}

        </div>

    @endif


    {{-- =====================================================
         RESUMEN
    ====================================================== --}}

    <div class="workers-summary">

        <div class="workers-summary-card">

            <div class="workers-summary-label">
                Total trabajadores
            </div>

            <div class="workers-summary-value">
                {{ $trabajadores->count() }}
            </div>

            <div class="workers-summary-description">
                Registros disponibles
            </div>

        </div>


        <div class="workers-summary-card">

            <div class="workers-summary-label">
                Con remuneración
            </div>

            <div class="workers-summary-value">
                {{ $trabajadores->whereNotNull('remuneracion_acordada')->where('remuneracion_acordada', '>', 0)->count() }}
            </div>

            <div class="workers-summary-description">
                Trabajadores con remuneración acordada
            </div>

        </div>


        <div class="workers-summary-card">

            <div class="workers-summary-label">
                Con correo
            </div>

            <div class="workers-summary-value">
                {{ $trabajadores->whereNotNull('correo')->where('correo', '!=', '')->count() }}
            </div>

            <div class="workers-summary-description">
                Trabajadores con correo registrado
            </div>

        </div>

    </div>


    {{-- =====================================================
         LISTADO
    ====================================================== --}}

    <section class="workers-card">

        <div class="workers-card-header">

            <div class="workers-card-heading">

                <h2 class="workers-card-title">
                    Registro de trabajadores
                </h2>

                <p class="workers-card-description">
                    Consulta y administra los trabajadores registrados.
                </p>

            </div>


            <div class="workers-search">

                <span class="workers-search-icon">
                    ⌕
                </span>

                <input
                    type="text"
                    id="workerTableSearch"
                    placeholder="Buscar trabajador o RUT..."
                    autocomplete="off"
                >

            </div>

        </div>


        @if($trabajadores->count())

            <div class="workers-table-wrapper">

                <table
                    class="workers-table"
                    id="workersTable"
                >

                    <thead>

                        <tr>

                            <th>
                                Trabajador
                            </th>

                            <th>
                                RUT
                            </th>

                            <th>
                                Contacto
                            </th>

                            <th>
                                Fecha ingreso
                            </th>

                            <th>
                                Remuneración acordada
                            </th>

                            <th>
                                Acciones
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($trabajadores as $trabajador)

                            <tr
                                data-worker-row
                                data-search="{{ strtolower(
                                    $trabajador->nombre . ' ' .
                                    $trabajador->rut . ' ' .
                                    ($trabajador->telefono ?? '') . ' ' .
                                    ($trabajador->correo ?? '') . ' ' .
                                    ($trabajador->direccion ?? '')
                                ) }}"
                            >

                                <td>

                                    <div class="worker-name">
                                        {{ $trabajador->nombre }}
                                    </div>

                                </td>


                                <td>

                                    <span class="worker-rut">
                                        {{ $trabajador->rut }}
                                    </span>

                                </td>


                                <td>

                                    <div class="worker-contact">

                                        @if($trabajador->telefono)

                                            <strong>
                                                {{ $trabajador->telefono }}
                                            </strong>

                                        @endif


                                        @if($trabajador->correo)

                                            <span>
                                                {{ $trabajador->correo }}
                                            </span>

                                        @endif


                                        @if(!$trabajador->telefono && !$trabajador->correo)

                                            <span>
                                                Sin contacto registrado
                                            </span>

                                        @endif

                                    </div>

                                </td>


                                <td>

                                    <div class="worker-date">

                                        {{ $trabajador->fecha_ingreso
                                            ? $trabajador->fecha_ingreso->format('d/m/Y')
                                            : '—'
                                        }}

                                    </div>

                                </td>


                                <td>

                                    <div class="worker-remuneration">

                                        @if($trabajador->remuneracion_acordada !== null)

                                            ${{ number_format(
                                                (float) $trabajador->remuneracion_acordada,
                                                0,
                                                ',',
                                                '.'
                                            ) }}

                                        @else

                                            —

                                        @endif

                                    </div>

                                </td>


                                <td>

                                    <div class="worker-actions">

                                        <a
                                            href="{{ route('trabajadores.show', $trabajador) }}"
                                            class="worker-action worker-action-primary"
                                        >
                                            Ver
                                        </a>


                                        <a
                                            href="{{ route('trabajadores.edit', $trabajador) }}"
                                            class="worker-action"
                                        >
                                            Editar
                                        </a>


                                        <form
                                            action="{{ route('trabajadores.destroy', $trabajador) }}"
                                            method="POST"
                                            style="display:inline;"
                                            onsubmit="return confirm('¿Estás seguro de eliminar este trabajador?');"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="worker-action worker-action-danger"
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


            <div class="workers-card-footer">

                <div class="workers-count">

                    Mostrando

                    <strong id="visibleWorkerCount">
                        {{ $trabajadores->count() }}
                    </strong>

                    de

                    <strong>
                        {{ $trabajadores->count() }}
                    </strong>

                    trabajadores

                </div>

            </div>


        @else

            <div class="workers-empty">

                <div class="workers-empty-icon">
                    ◉
                </div>

                <h3 class="workers-empty-title">
                    No hay trabajadores registrados
                </h3>

                <p class="workers-empty-text">
                    Comienza registrando el primer trabajador para administrar sus contratos, remuneraciones, vacaciones, permisos y demás antecedentes laborales.
                </p>

                <a
                    href="{{ route('trabajadores.create') }}"
                    class="btn btn-primary"
                >
                    + Crear primer trabajador
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
                    'workerTableSearch'
                );


            const rows =
                document.querySelectorAll(
                    '[data-worker-row]'
                );


            const visibleCount =
                document.getElementById(
                    'visibleWorkerCount'
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