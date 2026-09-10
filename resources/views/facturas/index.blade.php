@extends('layouts.app')

@section('title', 'Facturas')

@section('content')

<style>
    .facturas-page {
        width: 100%;
    }

    .facturas-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 24px;
    }

    .facturas-header h1 {
        margin: 0;
        color: #172033;
        font-size: 28px;
        font-weight: 700;
    }

    .facturas-header p {
        margin: 6px 0 0;
        color: #667085;
        font-size: 14px;
    }

    .btn-primary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 38px;
        padding: 0 15px;
        border-radius: 6px;
        background: #155a91;
        border: 1px solid #155a91;
        color: #ffffff;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        transition: .18s ease;
    }

    .btn-primary:hover {
        background: #124d7c;
        border-color: #124d7c;
        color: #ffffff;
    }

    .facturas-resumen {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 16px;
        margin-bottom: 22px;
    }

    .factura-resumen-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 17px 18px;
    }

    .factura-resumen-label {
        color: #667085;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .4px;
    }

    .factura-resumen-value {
        margin-top: 7px;
        color: #172033;
        font-size: 24px;
        font-weight: 700;
    }

    .facturas-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        overflow: hidden;
    }

    .facturas-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        padding: 17px 18px;
        border-bottom: 1px solid #e2e8f0;
    }

    .facturas-card-title {
        margin: 0;
        color: #172033;
        font-size: 15px;
        font-weight: 700;
    }

    .facturas-card-subtitle {
        margin: 4px 0 0;
        color: #667085;
        font-size: 12px;
    }

    .facturas-buscador {
        width: 280px;
        height: 36px;
        padding: 0 11px;
        border: 1px solid #dce3eb;
        border-radius: 6px;
        background: #ffffff;
        color: #172033;
        font-size: 12px;
        outline: none;
    }

    .facturas-buscador:focus {
        border-color: #155a91;
        box-shadow: 0 0 0 2px rgba(21, 90, 145, .08);
    }

    .facturas-table-wrapper {
        overflow-x: auto;
    }

    .facturas-table {
        width: 100%;
        min-width: 1150px;
        border-collapse: collapse;
    }

    .facturas-table th {
        padding: 11px 14px;
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
        color: #667085;
        font-size: 10px;
        font-weight: 700;
        text-align: left;
        text-transform: uppercase;
        letter-spacing: .35px;
        white-space: nowrap;
    }

    .facturas-table td {
        padding: 13px 14px;
        border-bottom: 1px solid #edf1f5;
        color: #475467;
        font-size: 12px;
        vertical-align: middle;
    }

    .facturas-table tbody tr:last-child td {
        border-bottom: none;
    }

    .facturas-table tbody tr:hover {
        background: #fafbfc;
    }

    .factura-numero {
        color: #155a91;
        font-weight: 700;
        text-decoration: none;
    }

    .factura-numero:hover {
        color: #124d7c;
        text-decoration: underline;
    }

    .factura-operacion {
        color: #344054;
        font-weight: 600;
    }

    .factura-cliente {
        max-width: 210px;
        color: #475467;
    }

    .factura-fecha {
        color: #667085;
        white-space: nowrap;
    }

    .factura-monto {
        color: #344054;
        font-weight: 600;
        white-space: nowrap;
    }

    .factura-total {
        color: #172033;
        font-weight: 700;
        white-space: nowrap;
    }

    .factura-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 23px;
        padding: 3px 8px;
        border-radius: 5px;
        font-size: 10px;
        font-weight: 700;
        white-space: nowrap;
    }

    .factura-badge-vigente {
        background: #eef5fb;
        color: #155a91;
    }

    .factura-badge-anulada {
        background: #fdf0f0;
        color: #a13d3d;
    }

    .factura-badge-reemplazada {
        background: #f1f3f5;
        color: #667085;
    }

    .factura-badge-mora {
        background: #fff5e6;
        color: #996515;
    }

    .factura-badge-sin-mora {
        background: #f2f4f7;
        color: #667085;
    }

    .factura-badge-pagada {
        background: #edf7f0;
        color: #36714a;
    }

    .factura-badge-pendiente {
        background: #fff7e8;
        color: #8a641e;
    }

    .factura-reemplazo {
        display: block;
        margin-top: 4px;
        color: #8a641e;
        font-size: 10px;
        font-weight: 600;
    }

    .factura-acciones {
        display: flex;
        align-items: center;
        gap: 6px;
        white-space: nowrap;
    }

    .btn-secundario {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 31px;
        padding: 0 10px;
        border-radius: 5px;
        background: #ffffff;
        border: 1px solid #dce3eb;
        color: #475467;
        font-size: 11px;
        font-weight: 600;
        text-decoration: none;
        transition: .18s ease;
    }

    .btn-secundario:hover {
        background: #f8fafc;
        border-color: #b9c3d0;
        color: #172033;
    }

    .btn-ver {
        border-color: #155a91;
        color: #155a91;
    }

    .btn-ver:hover {
        background: #155a91;
        border-color: #155a91;
        color: #ffffff;
    }

    .facturas-vacio {
        padding: 50px 20px;
        text-align: center;
    }

    .facturas-vacio h3 {
        margin: 0;
        color: #344054;
        font-size: 15px;
        font-weight: 700;
    }

    .facturas-vacio p {
        margin: 6px 0 18px;
        color: #667085;
        font-size: 12px;
    }

    .facturas-sin-resultados {
        display: none;
        padding: 35px 20px;
        text-align: center;
        color: #667085;
        font-size: 12px;
    }

    @media (max-width: 1100px) {
        .facturas-resumen {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 700px) {
        .facturas-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .facturas-resumen {
            grid-template-columns: 1fr;
        }

        .facturas-card-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .facturas-buscador {
            width: 100%;
        }
    }
</style>

@php
    $totalFacturas = $facturas->count();

    $facturasVigentes = $facturas
        ->where('estado', 'vigente')
        ->count();

    $facturasConMora = $facturas
        ->where('estado_mora', 'con_mora')
        ->count();

    $facturasPagadasOCerradas = $facturas
        ->filter(function ($factura) {
            return !is_null($factura->fecha_pago)
                || !is_null($factura->fecha_cierre);
        })
        ->count();
@endphp

<div class="facturas-page">

    {{-- ENCABEZADO --}}
    <div class="facturas-header">

        <div>
            <h1>Facturas</h1>

            <p>
                Gestión y seguimiento de facturas asociadas a las operaciones.
            </p>
        </div>

        <a
            href="{{ route('facturas.create') }}"
            class="btn-primary"
        >
            + Nueva factura
        </a>

    </div>


    {{-- RESUMEN --}}
    <div class="facturas-resumen">

        <div class="factura-resumen-card">
            <div class="factura-resumen-label">
                Total facturas
            </div>

            <div class="factura-resumen-value">
                {{ $totalFacturas }}
            </div>
        </div>


        <div class="factura-resumen-card">
            <div class="factura-resumen-label">
                Vigentes
            </div>

            <div class="factura-resumen-value">
                {{ $facturasVigentes }}
            </div>
        </div>


        <div class="factura-resumen-card">
            <div class="factura-resumen-label">
                Con mora
            </div>

            <div class="factura-resumen-value">
                {{ $facturasConMora }}
            </div>
        </div>


        <div class="factura-resumen-card">
            <div class="factura-resumen-label">
                Pagadas / cerradas
            </div>

            <div class="factura-resumen-value">
                {{ $facturasPagadasOCerradas }}
            </div>
        </div>

    </div>


    {{-- TABLA PRINCIPAL --}}
    <div class="facturas-card">

        <div class="facturas-card-header">

            <div>
                <h2 class="facturas-card-title">
                    Registro de facturas
                </h2>

                <p class="facturas-card-subtitle">
                    Facturas vinculadas directamente con cada operación.
                </p>
            </div>

            <input
                type="text"
                id="buscarFactura"
                class="facturas-buscador"
                placeholder="Buscar factura, operación o cliente..."
                autocomplete="off"
            >

        </div>


        @if($facturas->count())

            <div class="facturas-table-wrapper">

                <table class="facturas-table">

                    <thead>
                        <tr>
                            <th>Factura</th>
                            <th>Operación</th>
                            <th>Cliente</th>
                            <th>Emisión</th>
                            <th>Vencimiento</th>
                            <th>Neto</th>
                            <th>IVA</th>
                            <th>Total</th>
                            <th>Estado</th>
                            <th>Mora</th>
                            <th>Pago / cierre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody id="facturasTableBody">

                        @foreach($facturas as $factura)

                            @php

                                $estadoFactura = match ($factura->estado) {

                                    'vigente' => [
                                        'texto' => 'Vigente',
                                        'clase' => 'factura-badge-vigente',
                                    ],

                                    'anulada' => [
                                        'texto' => 'Anulada',
                                        'clase' => 'factura-badge-anulada',
                                    ],

                                    'reemplazada' => [
                                        'texto' => 'Reemplazada',
                                        'clase' => 'factura-badge-reemplazada',
                                    ],

                                    default => [
                                        'texto' => ucfirst(
                                            $factura->estado ?? 'Sin estado'
                                        ),
                                        'clase' => 'factura-badge-reemplazada',
                                    ],
                                };


                                $estadoMora = $factura->estado_mora === 'con_mora'
                                    ? [
                                        'texto' => 'Con mora',
                                        'clase' => 'factura-badge-mora',
                                    ]
                                    : [
                                        'texto' => 'Sin mora',
                                        'clase' => 'factura-badge-sin-mora',
                                    ];


                                if ($factura->fecha_cierre) {

                                    $estadoPago = [
                                        'texto' => 'Cerrada',
                                        'clase' => 'factura-badge-pagada',
                                    ];

                                } elseif ($factura->fecha_pago) {

                                    $estadoPago = [
                                        'texto' => 'Pagada',
                                        'clase' => 'factura-badge-pagada',
                                    ];

                                } else {

                                    $estadoPago = [
                                        'texto' => 'Pendiente',
                                        'clase' => 'factura-badge-pendiente',
                                    ];

                                }

                            @endphp


                            <tr
                                class="factura-row"
                                data-search="{{ strtolower(
                                    ($factura->numero_factura ?? '') . ' ' .
                                    ($factura->operacion?->numero_operacion ?? '') . ' ' .
                                    ($factura->operacion?->cliente?->nombre ?? '') . ' ' .
                                    ($factura->estado ?? '') . ' ' .
                                    ($factura->estado_mora ?? '')
                                ) }}"
                            >

                                {{-- FACTURA --}}
                                <td>

                                    <a
                                        href="{{ route('facturas.show', $factura) }}"
                                        class="factura-numero"
                                    >
                                        {{ $factura->numero_factura }}
                                    </a>

                                    @if($factura->facturaReemplazada)

                                        <span class="factura-reemplazo">
                                            Reemplaza factura
                                            {{ $factura->facturaReemplazada->numero_factura }}
                                        </span>

                                    @endif

                                </td>


                                {{-- OPERACIÓN --}}
                                <td>

                                    @if($factura->operacion)

                                        <span class="factura-operacion">
                                            {{ $factura->operacion->numero_operacion }}
                                        </span>

                                    @else
                                        -
                                    @endif

                                </td>


                                {{-- CLIENTE --}}
                                <td>

                                    <div class="factura-cliente">
                                        {{ $factura->operacion?->cliente?->nombre ?? '-' }}
                                    </div>

                                </td>


                                {{-- FECHA EMISIÓN --}}
                                <td class="factura-fecha">

                                    {{ $factura->fecha_emision?->format('d/m/Y') ?? '-' }}

                                </td>


                                {{-- FECHA VENCIMIENTO --}}
                                <td class="factura-fecha">

                                    {{ $factura->fecha_vencimiento?->format('d/m/Y') ?? '-' }}

                                </td>


                                {{-- NETO --}}
                                <td class="factura-monto">

                                    ${{ number_format(
                                        (float) $factura->neto,
                                        0,
                                        ',',
                                        '.'
                                    ) }}

                                </td>


                                {{-- IVA --}}
                                <td class="factura-monto">

                                    ${{ number_format(
                                        (float) $factura->iva,
                                        0,
                                        ',',
                                        '.'
                                    ) }}

                                </td>


                                {{-- TOTAL --}}
                                <td class="factura-total">

                                    ${{ number_format(
                                        (float) $factura->total,
                                        0,
                                        ',',
                                        '.'
                                    ) }}

                                </td>


                                {{-- ESTADO --}}
                                <td>

                                    <span
                                        class="factura-badge {{ $estadoFactura['clase'] }}"
                                    >
                                        {{ $estadoFactura['texto'] }}
                                    </span>

                                </td>


                                {{-- MORA --}}
                                <td>

                                    <span
                                        class="factura-badge {{ $estadoMora['clase'] }}"
                                    >
                                        {{ $estadoMora['texto'] }}
                                    </span>

                                </td>


                                {{-- PAGO / CIERRE --}}
                                <td>

                                    <span
                                        class="factura-badge {{ $estadoPago['clase'] }}"
                                    >
                                        {{ $estadoPago['texto'] }}
                                    </span>

                                </td>


                                {{-- ACCIONES --}}
                                <td>

                                    <div class="factura-acciones">

                                        <a
                                            href="{{ route('facturas.show', $factura) }}"
                                            class="btn-secundario btn-ver"
                                        >
                                            Ver
                                        </a>

                                        <a
                                            href="{{ route('facturas.edit', $factura) }}"
                                            class="btn-secundario"
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


            <div
                id="facturasSinResultados"
                class="facturas-sin-resultados"
            >
                No se encontraron facturas que coincidan con la búsqueda.
            </div>

        @else

            <div class="facturas-vacio">

                <h3>
                    No hay facturas registradas
                </h3>

                <p>
                    Comienza registrando la primera factura asociada a una operación.
                </p>

                <a
                    href="{{ route('facturas.create') }}"
                    class="btn-primary"
                >
                    + Registrar primera factura
                </a>

            </div>

        @endif

    </div>

</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {

        const buscador = document.getElementById('buscarFactura');

        const filas = document.querySelectorAll('.factura-row');

        const mensajeSinResultados =
            document.getElementById('facturasSinResultados');


        if (!buscador || !filas.length) {
            return;
        }


        buscador.addEventListener('input', function () {

            const termino = this.value
                .toLowerCase()
                .trim();

            let visibles = 0;


            filas.forEach(function (fila) {

                const contenido =
                    fila.dataset.search || '';

                const coincide =
                    contenido.includes(termino);


                fila.style.display =
                    coincide ? '' : 'none';


                if (coincide) {
                    visibles++;
                }

            });


            if (mensajeSinResultados) {

                mensajeSinResultados.style.display =
                    visibles === 0
                        ? 'block'
                        : 'none';

            }

        });

    });
</script>

@endsection