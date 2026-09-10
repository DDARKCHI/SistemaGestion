@extends('layouts.app')

@section('title', 'Factura ' . $factura->numero_factura)

@section('content')

<style>
    .factura-show-page {
        width: 100%;
    }

    .factura-show-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 24px;
    }

    .factura-show-header h1 {
        margin: 0;
        color: #172033;
        font-size: 28px;
        font-weight: 700;
    }

    .factura-show-header p {
        margin: 6px 0 0;
        color: #667085;
        font-size: 14px;
    }

    .factura-show-actions {
        display: flex;
        align-items: center;
        gap: 8px;
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

    .btn-secondary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 38px;
        padding: 0 15px;
        border-radius: 6px;
        background: #ffffff;
        border: 1px solid #dce3eb;
        color: #475467;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        transition: .18s ease;
    }

    .btn-secondary:hover {
        background: #f8fafc;
        border-color: #b9c3d0;
        color: #172033;
    }

    .factura-show-grid {
        display: grid;
        grid-template-columns: minmax(0, 2fr) minmax(280px, 1fr);
        gap: 18px;
    }

    .factura-show-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        overflow: hidden;
        margin-bottom: 18px;
    }

    .factura-show-card:last-child {
        margin-bottom: 0;
    }

    .factura-show-card-header {
        padding: 16px 18px;
        border-bottom: 1px solid #e2e8f0;
    }

    .factura-show-card-header h2 {
        margin: 0;
        color: #172033;
        font-size: 15px;
        font-weight: 700;
    }

    .factura-show-card-header p {
        margin: 4px 0 0;
        color: #667085;
        font-size: 12px;
    }

    .factura-show-card-body {
        padding: 18px;
    }

    .factura-info-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px 24px;
    }

    .factura-info-item {
        min-width: 0;
    }

    .factura-info-label {
        margin-bottom: 5px;
        color: #667085;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .35px;
    }

    .factura-info-value {
        color: #344054;
        font-size: 13px;
        font-weight: 600;
        word-break: break-word;
    }

    .factura-info-value a {
        color: #155a91;
        text-decoration: none;
    }

    .factura-info-value a:hover {
        color: #124d7c;
        text-decoration: underline;
    }

    .factura-montos {
        display: flex;
        flex-direction: column;
        gap: 0;
    }

    .factura-monto-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        padding: 10px 0;
        border-bottom: 1px solid #edf1f5;
        color: #475467;
        font-size: 13px;
    }

    .factura-monto-row:last-child {
        border-bottom: none;
    }

    .factura-monto-row strong {
        color: #172033;
        font-weight: 700;
        white-space: nowrap;
    }

    .factura-monto-total {
        padding-top: 14px;
        font-size: 15px;
        font-weight: 700;
    }

    .factura-monto-total strong {
        color: #155a91;
        font-size: 18px;
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

    .factura-estado-principal {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 22px 18px;
        border-bottom: 1px solid #e2e8f0;
    }

    .factura-estado-principal .factura-badge {
        min-height: 28px;
        padding: 5px 12px;
        font-size: 11px;
    }

    .factura-seguimiento {
        display: flex;
        flex-direction: column;
    }

    .factura-seguimiento-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        padding: 12px 0;
        border-bottom: 1px solid #edf1f5;
    }

    .factura-seguimiento-row:last-child {
        border-bottom: none;
    }

    .factura-seguimiento-label {
        color: #667085;
        font-size: 12px;
    }

    .factura-seguimiento-value {
        color: #344054;
        font-size: 12px;
        font-weight: 600;
        text-align: right;
    }

    .factura-relacion {
        padding: 12px 13px;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        background: #f8fafc;
        margin-bottom: 9px;
    }

    .factura-relacion:last-child {
        margin-bottom: 0;
    }

    .factura-relacion-label {
        margin-bottom: 4px;
        color: #667085;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .3px;
    }

    .factura-relacion-value {
        color: #344054;
        font-size: 12px;
        font-weight: 600;
    }

    .factura-relacion-value a {
        color: #155a91;
        text-decoration: none;
    }

    .factura-relacion-value a:hover {
        color: #124d7c;
        text-decoration: underline;
    }

    .factura-lista {
        display: flex;
        flex-direction: column;
    }

    .factura-lista-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        padding: 12px 0;
        border-bottom: 1px solid #edf1f5;
    }

    .factura-lista-item:last-child {
        border-bottom: none;
    }

    .factura-lista-principal {
        min-width: 0;
    }

    .factura-lista-titulo {
        color: #344054;
        font-size: 12px;
        font-weight: 700;
    }

    .factura-lista-titulo a {
        color: #155a91;
        text-decoration: none;
    }

    .factura-lista-titulo a:hover {
        color: #124d7c;
        text-decoration: underline;
    }

    .factura-lista-detalle {
        margin-top: 3px;
        color: #667085;
        font-size: 11px;
    }

    .factura-lista-valor {
        color: #172033;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
    }

    .factura-vacio-relacion {
        padding: 8px 0;
        color: #98a2b3;
        font-size: 12px;
    }

    .factura-observaciones {
        color: #475467;
        font-size: 13px;
        line-height: 1.6;
        white-space: pre-line;
    }

    .factura-alerta {
        margin-bottom: 18px;
        padding: 11px 13px;
        border-radius: 6px;
        font-size: 12px;
    }

    .factura-alerta-success {
        background: #edf7f0;
        border: 1px solid #cce8d3;
        color: #36714a;
    }

    .factura-alerta-error {
        background: #fdf0f0;
        border: 1px solid #f1c5c5;
        color: #a13d3d;
    }

    @media (max-width: 950px) {
        .factura-show-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 700px) {
        .factura-show-header {
            flex-direction: column;
        }

        .factura-show-actions {
            width: 100%;
        }

        .factura-show-actions a {
            flex: 1;
        }

        .factura-info-grid {
            grid-template-columns: 1fr;
        }
    }
</style>


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


<div class="factura-show-page">

    {{-- MENSAJES --}}
    @if(session('success'))

        <div class="factura-alerta factura-alerta-success">
            {{ session('success') }}
        </div>

    @endif


    @if(session('error'))

        <div class="factura-alerta factura-alerta-error">
            {{ session('error') }}
        </div>

    @endif


    {{-- ENCABEZADO --}}
    <div class="factura-show-header">

        <div>

            <h1>
                Factura {{ $factura->numero_factura }}
            </h1>

            <p>
                Detalle y seguimiento de la factura.
            </p>

        </div>


        <div class="factura-show-actions">

            <a
                href="{{ route('facturas.index') }}"
                class="btn-secondary"
            >
                Volver
            </a>

            <a
                href="{{ route('facturas.edit', $factura) }}"
                class="btn-primary"
            >
                Editar factura
            </a>

        </div>

    </div>


    <div class="factura-show-grid">

        {{-- COLUMNA PRINCIPAL --}}
        <div>

            {{-- INFORMACIÓN GENERAL --}}
            <div class="factura-show-card">

                <div class="factura-show-card-header">

                    <h2>
                        Información de la factura
                    </h2>

                    <p>
                        Datos principales y asociación con la operación.
                    </p>

                </div>


                <div class="factura-show-card-body">

                    <div class="factura-info-grid">

                        <div class="factura-info-item">

                            <div class="factura-info-label">
                                Número de factura
                            </div>

                            <div class="factura-info-value">
                                {{ $factura->numero_factura }}
                            </div>

                        </div>


                        <div class="factura-info-item">

                            <div class="factura-info-label">
                                Operación
                            </div>

                            <div class="factura-info-value">

                                @if($factura->operacion)

                                    <a
                                        href="{{ route('operaciones.show', $factura->operacion) }}"
                                    >
                                        {{ $factura->operacion->numero_operacion }}
                                    </a>

                                @else
                                    -
                                @endif

                            </div>

                        </div>


                        <div class="factura-info-item">

                            <div class="factura-info-label">
                                Cliente
                            </div>

                            <div class="factura-info-value">

                                {{ $factura->operacion?->cliente?->nombre ?? '-' }}

                            </div>

                        </div>


                        <div class="factura-info-item">

                            <div class="factura-info-label">
                                Fecha de emisión
                            </div>

                            <div class="factura-info-value">

                                {{ $factura->fecha_emision?->format('d/m/Y') ?? '-' }}

                            </div>

                        </div>


                        <div class="factura-info-item">

                            <div class="factura-info-label">
                                Fecha de vencimiento
                            </div>

                            <div class="factura-info-value">

                                {{ $factura->fecha_vencimiento?->format('d/m/Y') ?? '-' }}

                            </div>

                        </div>


                        <div class="factura-info-item">

                            <div class="factura-info-label">
                                Fecha de pago
                            </div>

                            <div class="factura-info-value">

                                {{ $factura->fecha_pago?->format('d/m/Y') ?? '-' }}

                            </div>

                        </div>


                        <div class="factura-info-item">

                            <div class="factura-info-label">
                                Fecha de cierre
                            </div>

                            <div class="factura-info-value">

                                {{ $factura->fecha_cierre?->format('d/m/Y') ?? '-' }}

                            </div>

                        </div>


                        <div class="factura-info-item">

                            <div class="factura-info-label">
                                Fecha de registro
                            </div>

                            <div class="factura-info-value">

                                {{ $factura->created_at?->format('d/m/Y H:i') ?? '-' }}

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- MONTOS --}}
            <div class="factura-show-card">

                <div class="factura-show-card-header">

                    <h2>
                        Montos
                    </h2>

                    <p>
                        Valores calculados de la factura.
                    </p>

                </div>


                <div class="factura-show-card-body">

                    <div class="factura-montos">

                        <div class="factura-monto-row">

                            <span>
                                Neto
                            </span>

                            <strong>
                                ${{ number_format(
                                    (float) $factura->neto,
                                    0,
                                    ',',
                                    '.'
                                ) }}
                            </strong>

                        </div>


                        <div class="factura-monto-row">

                            <span>
                                IVA 19%
                            </span>

                            <strong>
                                ${{ number_format(
                                    (float) $factura->iva,
                                    0,
                                    ',',
                                    '.'
                                ) }}
                            </strong>

                        </div>


                        <div class="factura-monto-row factura-monto-total">

                            <span>
                                Total factura
                            </span>

                            <strong>
                                ${{ number_format(
                                    (float) $factura->total,
                                    0,
                                    ',',
                                    '.'
                                ) }}
                            </strong>

                        </div>

                    </div>

                </div>

            </div>


            {{-- FACTURA REEMPLAZADA --}}
            @if($factura->facturaReemplazada)

                <div class="factura-show-card">

                    <div class="factura-show-card-header">

                        <h2>
                            Factura reemplazada
                        </h2>

                        <p>
                            Factura anterior que fue reemplazada por esta.
                        </p>

                    </div>


                    <div class="factura-show-card-body">

                        <div class="factura-relacion">

                            <div class="factura-relacion-label">
                                Factura anterior
                            </div>

                            <div class="factura-relacion-value">

                                <a
                                    href="{{ route(
                                        'facturas.show',
                                        $factura->facturaReemplazada
                                    ) }}"
                                >
                                    {{ $factura->facturaReemplazada->numero_factura }}
                                </a>

                            </div>

                        </div>


                        @if($factura->facturaReemplazada->operacion)

                            <div class="factura-relacion">

                                <div class="factura-relacion-label">
                                    Operación de la factura anterior
                                </div>

                                <div class="factura-relacion-value">

                                    <a
                                        href="{{ route(
                                            'operaciones.show',
                                            $factura->facturaReemplazada->operacion
                                        ) }}"
                                    >
                                        {{ $factura->facturaReemplazada->operacion->numero_operacion }}
                                    </a>

                                </div>

                            </div>

                        @endif

                    </div>

                </div>

            @endif


            {{-- REEMPLAZOS --}}
            @if($factura->reemplazos->count())

                <div class="factura-show-card">

                    <div class="factura-show-card-header">

                        <h2>
                            Facturas que reemplazan a esta
                        </h2>

                        <p>
                            Facturas posteriores relacionadas con este registro.
                        </p>

                    </div>


                    <div class="factura-show-card-body">

                        <div class="factura-lista">

                            @foreach($factura->reemplazos as $reemplazo)

                                <div class="factura-lista-item">

                                    <div class="factura-lista-principal">

                                        <div class="factura-lista-titulo">

                                            <a
                                                href="{{ route(
                                                    'facturas.show',
                                                    $reemplazo
                                                ) }}"
                                            >
                                                Factura
                                                {{ $reemplazo->numero_factura }}
                                            </a>

                                        </div>

                                        <div class="factura-lista-detalle">

                                            {{ $reemplazo->estado === 'reemplazada'
                                                ? 'Factura posteriormente reemplazada'
                                                : 'Factura vigente' }}

                                        </div>

                                    </div>

                                    <a
                                        href="{{ route(
                                            'facturas.show',
                                            $reemplazo
                                        ) }}"
                                        class="btn-secondary"
                                    >
                                        Ver
                                    </a>

                                </div>

                            @endforeach

                        </div>

                    </div>

                </div>

            @endif


            {{-- NOTAS DE CRÉDITO --}}
            <div class="factura-show-card">

                <div class="factura-show-card-header">

                    <h2>
                        Notas de crédito
                    </h2>

                    <p>
                        Notas de crédito asociadas directamente a esta factura.
                    </p>

                </div>


                <div class="factura-show-card-body">

                    @if($factura->notasCredito->count())

                        <div class="factura-lista">

                            @foreach($factura->notasCredito as $nota)

                                <div class="factura-lista-item">

                                    <div class="factura-lista-principal">

                                        <div class="factura-lista-titulo">
                                            Nota de crédito
                                            {{ $nota->numero_nota }}
                                        </div>

                                        <div class="factura-lista-detalle">

                                            {{ $nota->fecha_emision?->format('d/m/Y') ?? '-' }}

                                            @if($nota->motivo)
                                                · {{ $nota->motivo }}
                                            @endif

                                        </div>

                                    </div>


                                    <div class="factura-lista-valor">

                                        ${{ number_format(
                                            (float) $nota->total,
                                            0,
                                            ',',
                                            '.'
                                        ) }}

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    @else

                        <div class="factura-vacio-relacion">
                            No existen notas de crédito asociadas.
                        </div>

                    @endif

                </div>

            </div>


            {{-- FACTORING --}}
            <div class="factura-show-card">

                <div class="factura-show-card-header">

                    <h2>
                        Factoring
                    </h2>

                    <p>
                        Registros de factoring asociados a esta factura.
                    </p>

                </div>


                <div class="factura-show-card-body">

                    @if($factura->factorings->count())

                        <div class="factura-lista">

                            @foreach($factura->factorings as $factoring)

                                <div class="factura-lista-item">

                                    <div class="factura-lista-principal">

                                        <div class="factura-lista-titulo">
                                            Factoring
                                        </div>

                                        <div class="factura-lista-detalle">

                                            @if($factoring->fecha_curse)
                                                Curse:
                                                {{ $factoring->fecha_curse->format('d/m/Y') }}
                                            @endif

                                            @if($factoring->estado)
                                                · {{ ucfirst($factoring->estado) }}
                                            @endif

                                        </div>

                                    </div>


                                    <div class="factura-lista-valor">

                                        ${{ number_format(
                                            (float) (
                                                $factoring->monto_liquidado
                                                ?? $factoring->monto_factura
                                                ?? 0
                                            ),
                                            0,
                                            ',',
                                            '.'
                                        ) }}

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    @else

                        <div class="factura-vacio-relacion">
                            No existen registros de factoring asociados.
                        </div>

                    @endif

                </div>

            </div>


            {{-- MORA ORIGEN --}}
            <div class="factura-show-card">

                <div class="factura-show-card-header">

                    <h2>
                        Mora generada
                    </h2>

                    <p>
                        Mora originada por el atraso asociado a esta factura.
                    </p>

                </div>


                <div class="factura-show-card-body">

                    @if($factura->morasOrigen->count())

                        <div class="factura-lista">

                            @foreach($factura->morasOrigen as $mora)

                                <div class="factura-lista-item">

                                    <div class="factura-lista-principal">

                                        <div class="factura-lista-titulo">

                                            {{ $mora->dias_atraso }}
                                            {{ $mora->dias_atraso == 1 ? 'día' : 'días' }}
                                            de atraso

                                        </div>

                                        <div class="factura-lista-detalle">

                                            Fecha:
                                            {{ $mora->fecha?->format('d/m/Y') ?? '-' }}

                                            @if($mora->factura_destino_id)
                                                · Mora trasladada a otra factura
                                            @else
                                                · Mora pendiente de traslado
                                            @endif

                                        </div>

                                    </div>


                                    <div class="factura-lista-valor">

                                        ${{ number_format(
                                            (float) $mora->valor_mora,
                                            0,
                                            ',',
                                            '.'
                                        ) }}

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    @else

                        <div class="factura-vacio-relacion">
                            Esta factura no tiene mora generada registrada.
                        </div>

                    @endif

                </div>

            </div>


            {{-- MORA RECIBIDA --}}
            <div class="factura-show-card">

                <div class="factura-show-card-header">

                    <h2>
                        Mora recibida de otra operación
                    </h2>

                    <p>
                        Mora proveniente de una operación o factura anterior.
                    </p>

                </div>


                <div class="factura-show-card-body">

                    @if($factura->morasDestino->count())

                        <div class="factura-lista">

                            @foreach($factura->morasDestino as $mora)

                                <div class="factura-lista-item">

                                    <div class="factura-lista-principal">

                                        <div class="factura-lista-titulo">

                                            Mora de otra operación

                                        </div>

                                        <div class="factura-lista-detalle">

                                            {{ $mora->dias_atraso }}
                                            {{ $mora->dias_atraso == 1 ? 'día' : 'días' }}
                                            de atraso

                                            @if($mora->facturaOrigen)

                                                · Factura origen:

                                                <a
                                                    href="{{ route(
                                                        'facturas.show',
                                                        $mora->facturaOrigen
                                                    ) }}"
                                                >
                                                    {{ $mora->facturaOrigen->numero_factura }}
                                                </a>

                                            @endif

                                        </div>

                                    </div>


                                    <div class="factura-lista-valor">

                                        ${{ number_format(
                                            (float) $mora->valor_mora,
                                            0,
                                            ',',
                                            '.'
                                        ) }}

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    @else

                        <div class="factura-vacio-relacion">
                            Esta factura no tiene mora recibida de otra operación.
                        </div>

                    @endif

                </div>

            </div>

        </div>


        {{-- COLUMNA LATERAL --}}
        <div>

            {{-- ESTADO --}}
            <div class="factura-show-card">

                <div class="factura-estado-principal">

                    <span
                        class="factura-badge {{ $estadoFactura['clase'] }}"
                    >
                        {{ $estadoFactura['texto'] }}
                    </span>

                </div>


                <div class="factura-show-card-body">

                    <div class="factura-seguimiento">

                        <div class="factura-seguimiento-row">

                            <span class="factura-seguimiento-label">
                                Estado de mora
                            </span>

                            <span class="factura-seguimiento-value">

                                <span
                                    class="factura-badge {{ $estadoMora['clase'] }}"
                                >
                                    {{ $estadoMora['texto'] }}
                                </span>

                            </span>

                        </div>


                        <div class="factura-seguimiento-row">

                            <span class="factura-seguimiento-label">
                                Pago / cierre
                            </span>

                            <span class="factura-seguimiento-value">

                                <span
                                    class="factura-badge {{ $estadoPago['clase'] }}"
                                >
                                    {{ $estadoPago['texto'] }}
                                </span>

                            </span>

                        </div>


                        <div class="factura-seguimiento-row">

                            <span class="factura-seguimiento-label">
                                Fecha de pago
                            </span>

                            <span class="factura-seguimiento-value">
                                {{ $factura->fecha_pago?->format('d/m/Y') ?? '-' }}
                            </span>

                        </div>


                        <div class="factura-seguimiento-row">

                            <span class="factura-seguimiento-label">
                                Fecha de cierre
                            </span>

                            <span class="factura-seguimiento-value">
                                {{ $factura->fecha_cierre?->format('d/m/Y') ?? '-' }}
                            </span>

                        </div>

                    </div>

                </div>

            </div>


            {{-- OPERACIÓN --}}
            <div class="factura-show-card">

                <div class="factura-show-card-header">

                    <h2>
                        Operación asociada
                    </h2>

                    <p>
                        Registro principal relacionado.
                    </p>

                </div>


                <div class="factura-show-card-body">

                    @if($factura->operacion)

                        <div class="factura-relacion">

                            <div class="factura-relacion-label">
                                Número de operación
                            </div>

                            <div class="factura-relacion-value">

                                <a
                                    href="{{ route(
                                        'operaciones.show',
                                        $factura->operacion
                                    ) }}"
                                >
                                    {{ $factura->operacion->numero_operacion }}
                                </a>

                            </div>

                        </div>


                        <div class="factura-relacion">

                            <div class="factura-relacion-label">
                                Tipo
                            </div>

                            <div class="factura-relacion-value">
                                {{ $factura->operacion->tipo ?? '-' }}
                            </div>

                        </div>


                        <div class="factura-relacion">

                            <div class="factura-relacion-label">
                                Estado operación
                            </div>

                            <div class="factura-relacion-value">
                                {{ ucfirst(
                                    $factura->operacion->estado ?? '-'
                                ) }}
                            </div>

                        </div>

                    @else

                        <div class="factura-vacio-relacion">
                            No existe una operación asociada.
                        </div>

                    @endif

                </div>

            </div>


            {{-- OBSERVACIONES --}}
            <div class="factura-show-card">

                <div class="factura-show-card-header">

                    <h2>
                        Observaciones
                    </h2>

                </div>


                <div class="factura-show-card-body">

                    @if($factura->observaciones)

                        <div class="factura-observaciones">
                            {{ $factura->observaciones }}
                        </div>

                    @else

                        <div class="factura-vacio-relacion">
                            No existen observaciones registradas.
                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>

@endsection