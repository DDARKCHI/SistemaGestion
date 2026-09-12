@extends('layouts.app')

@section('title', 'Transportista')

@section('topbar_title', 'Gestión de transportistas')

@push('styles')

<style>

    /* =========================================================
       HEADER
    ========================================================== */

    .carrier-show-header {

        display: flex;

        align-items: flex-start;

        justify-content: space-between;

        gap: 20px;

        margin-bottom: 22px;

    }


    .carrier-show-heading {

        min-width: 0;

    }


    .carrier-show-title {

        margin: 0;

        color: #172033;

        font-size: 27px;

        line-height: 1.2;

        font-weight: 700;

        letter-spacing: -.025em;

    }


    .carrier-show-subtitle {

        margin: 7px 0 0;

        color: #667085;

        font-size: 13px;

    }


    .carrier-show-rut {

        display: inline-flex;

        align-items: center;

        margin-top: 10px;

        padding: 5px 9px;

        border-radius: 6px;

        background: #eef4f8;

        color: #155a91;

        font-size: 10px;

        font-weight: 700;

    }


    .carrier-show-actions {

        display: flex;

        align-items: center;

        gap: 8px;

        flex-shrink: 0;

    }


    .carrier-show-action {

        display: inline-flex;

        align-items: center;

        justify-content: center;

        min-height: 36px;

        padding: 8px 13px;

        border: 1px solid #dce3eb;

        border-radius: 6px;

        background: #ffffff;

        color: #344054;

        font-size: 11px;

        font-weight: 600;

        text-decoration: none;

        cursor: pointer;

    }


    .carrier-show-action:hover {

        background: #f7f9fb;

        border-color: #cbd7e3;

        color: #155a91;

    }


    .carrier-show-action-primary {

        background: #155a91;

        border-color: #155a91;

        color: #ffffff;

    }


    .carrier-show-action-primary:hover {

        background: #124d7d;

        border-color: #124d7d;

        color: #ffffff;

    }


    /* =========================================================
       ALERTAS
    ========================================================== */

    .carrier-show-alert {

        margin-bottom: 18px;

        padding: 11px 14px;

        border-radius: 7px;

        font-size: 11px;

    }


    .carrier-show-alert-success {

        border: 1px solid #cfe5d7;

        background: #f1faf4;

        color: #287443;

    }


    .carrier-show-alert-error {

        border: 1px solid #e9c1bc;

        background: #fff5f3;

        color: #a52f26;

    }


    /* =========================================================
       RESUMEN
    ========================================================== */

    .carrier-show-summary {

        display: grid;

        grid-template-columns: repeat(3, 1fr);

        gap: 14px;

        margin-bottom: 18px;

    }


    .carrier-show-summary-card {

        background: #ffffff;

        border: 1px solid #e2e8f0;

        border-radius: 9px;

        padding: 16px 18px;

        box-shadow: 0 2px 7px rgba(16,47,80,.04);

    }


    .carrier-show-summary-label {

        color: #667085;

        font-size: 10px;

        font-weight: 600;

        text-transform: uppercase;

        letter-spacing: .03em;

    }


    .carrier-show-summary-value {

        margin-top: 7px;

        color: #172033;

        font-size: 22px;

        line-height: 1;

        font-weight: 700;

    }


    .carrier-show-summary-description {

        margin-top: 6px;

        color: #98a2b3;

        font-size: 9px;

    }


    /* =========================================================
       TARJETAS
    ========================================================== */

    .carrier-show-card {

        margin-bottom: 18px;

        background: #ffffff;

        border: 1px solid #e2e8f0;

        border-radius: 10px;

        box-shadow: 0 2px 8px rgba(16,47,80,.05);

        overflow: hidden;

    }


    .carrier-show-card:last-child {

        margin-bottom: 0;

    }


    .carrier-show-card-header {

        min-height: 62px;

        padding: 14px 20px;

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 15px;

        border-bottom: 1px solid #edf1f5;

    }


    .carrier-show-card-title {

        margin: 0;

        color: #172033;

        font-size: 14px;

        font-weight: 700;

    }


    .carrier-show-card-description {

        margin: 4px 0 0;

        color: #98a2b3;

        font-size: 10px;

    }


    .carrier-show-card-body {

        padding: 20px;

    }


    /* =========================================================
       INFORMACIÓN
    ========================================================== */

    .carrier-info-grid {

        display: grid;

        grid-template-columns: repeat(3, minmax(0, 1fr));

        gap: 18px 25px;

    }


    .carrier-info-item {

        min-width: 0;

    }


    .carrier-info-label {

        margin-bottom: 5px;

        color: #98a2b3;

        font-size: 9px;

        font-weight: 600;

        text-transform: uppercase;

        letter-spacing: .03em;

    }


    .carrier-info-value {

        color: #344054;

        font-size: 11px;

        line-height: 1.45;

        word-break: break-word;

    }


    .carrier-info-value-empty {

        color: #a1aab7;

    }


    .carrier-info-full {

        grid-column: 1 / -1;

    }


    /* =========================================================
       TABLAS
    ========================================================== */

    .carrier-show-table-wrapper {

        width: 100%;

        overflow-x: auto;

    }


    .carrier-show-table {

        width: 100%;

        border-collapse: collapse;

        min-width: 700px;

    }


    .carrier-show-table th {

        padding: 11px 18px;

        background: #f8fafc;

        border-bottom: 1px solid #e2e8f0;

        color: #667085;

        text-align: left;

        font-size: 9px;

        font-weight: 700;

        text-transform: uppercase;

        letter-spacing: .035em;

        white-space: nowrap;

    }


    .carrier-show-table td {

        padding: 13px 18px;

        border-bottom: 1px solid #edf1f5;

        color: #344054;

        font-size: 10px;

        vertical-align: middle;

    }


    .carrier-show-table tbody tr:last-child td {

        border-bottom: none;

    }


    .carrier-show-table tbody tr:hover {

        background: #fbfcfe;

    }


    .carrier-table-primary {

        color: #172033;

        font-size: 11px;

        font-weight: 600;

    }


    .carrier-table-secondary {

        margin-top: 3px;

        color: #98a2b3;

        font-size: 9px;

    }


    /* =========================================================
       ESTADOS
    ========================================================== */

    .carrier-status {

        display: inline-flex;

        align-items: center;

        padding: 4px 8px;

        border-radius: 5px;

        background: #eef4f8;

        color: #155a91;

        font-size: 9px;

        font-weight: 600;

    }


    .carrier-status-empty {

        background: #f1f4f7;

        color: #667085;

    }


    /* =========================================================
       ESTADO VACÍO
    ========================================================== */

    .carrier-section-empty {

        padding: 32px 20px;

        text-align: center;

    }


    .carrier-section-empty-title {

        margin: 0;

        color: #667085;

        font-size: 11px;

        font-weight: 600;

    }


    .carrier-section-empty-text {

        margin: 5px auto 0;

        color: #98a2b3;

        font-size: 9px;

    }


    /* =========================================================
       PIE
    ========================================================== */

    .carrier-show-footer {

        display: flex;

        align-items: center;

        justify-content: space-between;

        padding: 13px 20px;

        background: #fbfcfd;

        border-top: 1px solid #edf1f5;

    }


    .carrier-show-footer-text {

        color: #98a2b3;

        font-size: 9px;

    }


    /* =========================================================
       RESPONSIVE
    ========================================================== */

    @media (max-width: 900px) {

        .carrier-info-grid {

            grid-template-columns: repeat(2, 1fr);

        }

    }


    @media (max-width: 700px) {

        .carrier-show-header {

            flex-direction: column;

        }


        .carrier-show-actions {

            width: 100%;

        }


        .carrier-show-action {

            flex: 1;

        }


        .carrier-show-summary {

            grid-template-columns: 1fr;

        }


        .carrier-info-grid {

            grid-template-columns: 1fr;

        }


        .carrier-info-full {

            grid-column: auto;

        }

    }

</style>

@endpush


@section('content')

    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="carrier-show-header">

        <div class="carrier-show-heading">

            <h1 class="carrier-show-title">
                {{ $transportista->nombre }}
            </h1>

            <p class="carrier-show-subtitle">
                Ficha y antecedentes del transportista.
            </p>

            <span class="carrier-show-rut">
                RUT {{ $transportista->rut }}
            </span>

        </div>


        <div class="carrier-show-actions">

            <a
                href="{{ route('transportistas.index') }}"
                class="carrier-show-action"
            >
                ← Volver
            </a>

            <a
                href="{{ route('transportistas.edit', $transportista) }}"
                class="carrier-show-action carrier-show-action-primary"
            >
                Editar transportista
            </a>

        </div>

    </div>


    {{-- =====================================================
         MENSAJES
    ====================================================== --}}

    @if(session('success'))

        <div class="carrier-show-alert carrier-show-alert-success">
            {{ session('success') }}
        </div>

    @endif


    @if(session('error'))

        <div class="carrier-show-alert carrier-show-alert-error">
            {{ session('error') }}
        </div>

    @endif


    {{-- =====================================================
         RESUMEN
    ====================================================== --}}

    <div class="carrier-show-summary">

        <div class="carrier-show-summary-card">

            <div class="carrier-show-summary-label">
                Vehículos
            </div>

            <div class="carrier-show-summary-value">
                {{ $transportista->vehiculos->count() }}
            </div>

            <div class="carrier-show-summary-description">
                Vehículos registrados
            </div>

        </div>


        <div class="carrier-show-summary-card">

            <div class="carrier-show-summary-label">
                Servicios
            </div>

            <div class="carrier-show-summary-value">
                {{ $transportista->serviciosTransporte->count() }}
            </div>

            <div class="carrier-show-summary-description">
                Servicios de transporte registrados
            </div>

        </div>


        <div class="carrier-show-summary-card">

            <div class="carrier-show-summary-label">
                Gastos
            </div>

            <div class="carrier-show-summary-value">
                {{ $transportista->gastos->count() }}
            </div>

            <div class="carrier-show-summary-description">
                Gastos asociados al transportista
            </div>

        </div>

    </div>


    {{-- =====================================================
         INFORMACIÓN GENERAL
    ====================================================== --}}

    <section class="carrier-show-card">

        <div class="carrier-show-card-header">

            <div>

                <h2 class="carrier-show-card-title">
                    Información general
                </h2>

                <p class="carrier-show-card-description">
                    Datos principales registrados del transportista.
                </p>

            </div>

        </div>


        <div class="carrier-show-card-body">

            <div class="carrier-info-grid">

                <div class="carrier-info-item">

                    <div class="carrier-info-label">
                        Nombre
                    </div>

                    <div class="carrier-info-value">
                        {{ $transportista->nombre }}
                    </div>

                </div>


                <div class="carrier-info-item">

                    <div class="carrier-info-label">
                        RUT
                    </div>

                    <div class="carrier-info-value">
                        {{ $transportista->rut }}
                    </div>

                </div>


                <div class="carrier-info-item">

                    <div class="carrier-info-label">
                        Teléfono
                    </div>

                    <div class="carrier-info-value
                        {{ !$transportista->telefono ? 'carrier-info-value-empty' : '' }}"
                    >
                        {{ $transportista->telefono ?: 'No registrado' }}
                    </div>

                </div>


                <div class="carrier-info-item">

                    <div class="carrier-info-label">
                        Correo
                    </div>

                    <div class="carrier-info-value
                        {{ !$transportista->correo ? 'carrier-info-value-empty' : '' }}"
                    >
                        {{ $transportista->correo ?: 'No registrado' }}
                    </div>

                </div>


                <div class="carrier-info-item carrier-info-full">

                    <div class="carrier-info-label">
                        Dirección
                    </div>

                    <div class="carrier-info-value
                        {{ !$transportista->direccion ? 'carrier-info-value-empty' : '' }}"
                    >
                        {{ $transportista->direccion ?: 'No registrada' }}
                    </div>

                </div>


                <div class="carrier-info-item carrier-info-full">

                    <div class="carrier-info-label">
                        Observaciones
                    </div>

                    <div class="carrier-info-value
                        {{ !$transportista->observaciones ? 'carrier-info-value-empty' : '' }}"
                    >
                        {{ $transportista->observaciones ?: 'Sin observaciones' }}
                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- =====================================================
         VEHÍCULOS
    ====================================================== --}}

    <section class="carrier-show-card">

        <div class="carrier-show-card-header">

            <div>

                <h2 class="carrier-show-card-title">
                    Vehículos
                </h2>

                <p class="carrier-show-card-description">
                    Vehículos asociados a este transportista.
                </p>

            </div>

        </div>


        @if($transportista->vehiculos->count())

            <div class="carrier-show-table-wrapper">

                <table class="carrier-show-table">

                    <thead>

                        <tr>

                            <th>
                                Registro
                            </th>

                            <th>
                                Información
                            </th>

                            <th>
                                Estado
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($transportista->vehiculos as $vehiculo)

                            <tr>

                                <td>

                                    <div class="carrier-table-primary">
                                        Vehículo #{{ $vehiculo->id }}
                                    </div>

                                </td>


                                <td>

                                    <div class="carrier-table-secondary">
                                        Registro asociado al transportista
                                    </div>

                                </td>


                                <td>

                                    <span class="carrier-status">
                                        Registrado
                                    </span>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <div class="carrier-section-empty">

                <h3 class="carrier-section-empty-title">
                    No hay vehículos registrados
                </h3>

                <p class="carrier-section-empty-text">
                    Los vehículos asociados al transportista aparecerán aquí cuando sean registrados.
                </p>

            </div>

        @endif

    </section>


    {{-- =====================================================
         SERVICIOS DE TRANSPORTE
    ====================================================== --}}

    <section class="carrier-show-card">

        <div class="carrier-show-card-header">

            <div>

                <h2 class="carrier-show-card-title">
                    Servicios de transporte
                </h2>

                <p class="carrier-show-card-description">
                    Servicios de transporte asociados a este transportista.
                </p>

            </div>

        </div>


        @if($transportista->serviciosTransporte->count())

            <div class="carrier-show-table-wrapper">

                <table class="carrier-show-table">

                    <thead>

                        <tr>

                            <th>
                                Registro
                            </th>

                            <th>
                                Información
                            </th>

                            <th>
                                Estado
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($transportista->serviciosTransporte as $servicio)

                            <tr>

                                <td>

                                    <div class="carrier-table-primary">
                                        Servicio #{{ $servicio->id }}
                                    </div>

                                </td>


                                <td>

                                    <div class="carrier-table-secondary">
                                        Servicio asociado al transportista
                                    </div>

                                </td>


                                <td>

                                    <span class="carrier-status">
                                        Registrado
                                    </span>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <div class="carrier-section-empty">

                <h3 class="carrier-section-empty-title">
                    No hay servicios registrados
                </h3>

                <p class="carrier-section-empty-text">
                    Los servicios de transporte asociados aparecerán aquí cuando sean registrados.
                </p>

            </div>

        @endif

    </section>


    {{-- =====================================================
         GASTOS
    ====================================================== --}}

    <section class="carrier-show-card">

        <div class="carrier-show-card-header">

            <div>

                <h2 class="carrier-show-card-title">
                    Gastos asociados
                </h2>

                <p class="carrier-show-card-description">
                    Gastos registrados directamente asociados a este transportista.
                </p>

            </div>


            <a
                href="{{ route(
                    'gastos.create',
                    ['transportista_id' => $transportista->id]
                ) }}"
                class="carrier-show-action carrier-show-action-primary"
            >
                + Nuevo gasto
            </a>

        </div>


        @if($transportista->gastos->count())

            <div class="carrier-show-table-wrapper">

                <table class="carrier-show-table">

                    <thead>

                        <tr>

                            <th>
                                Fecha
                            </th>

                            <th>
                                Tipo
                            </th>

                            <th>
                                Concepto
                            </th>

                            <th>
                                Operación
                            </th>

                            <th>
                                Monto
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($transportista->gastos as $gasto)

                            <tr>

                                <td>
                                    {{ $gasto->fecha?->format('d/m/Y') ?: '—' }}
                                </td>


                                <td>
                                    {{ $gasto->tipo }}
                                </td>


                                <td>

                                    <div class="carrier-table-primary">
                                        {{ $gasto->descripcion }}
                                    </div>

                                    @if($gasto->observaciones)

                                        <div class="carrier-table-secondary">
                                            {{ $gasto->observaciones }}
                                        </div>

                                    @endif

                                </td>


                                <td>

                                    @if($gasto->operacion)

                                        <div class="carrier-table-primary">
                                            Operación #{{ $gasto->operacion->id }}
                                        </div>

                                        @if($gasto->operacion->cliente)

                                            <div class="carrier-table-secondary">
                                                {{ $gasto->operacion->cliente->nombre }}
                                            </div>

                                        @endif

                                    @else

                                        <span class="carrier-info-value-empty">
                                            Sin operación
                                        </span>

                                    @endif

                                </td>


                                <td>

                                    <div class="carrier-table-primary">
                                        ${{ number_format(
                                            (float) $gasto->monto,
                                            0,
                                            ',',
                                            '.'
                                        ) }}
                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>


            <div class="carrier-show-footer">

                <div class="carrier-show-footer-text">

                    Total de gastos:

                    <strong>
                        {{ $transportista->gastos->count() }}
                    </strong>

                </div>


                <div class="carrier-show-footer-text">

                    Monto total:

                    <strong>
                        ${{ number_format(
                            (float) $transportista->gastos->sum('monto'),
                            0,
                            ',',
                            '.'
                        ) }}
                    </strong>

                </div>

            </div>

        @else

            <div class="carrier-section-empty">

                <h3 class="carrier-section-empty-title">
                    No hay gastos asociados
                </h3>

                <p class="carrier-section-empty-text">
                    Los gastos asociados a este transportista aparecerán aquí.
                </p>

            </div>

        @endif

    </section>

@endsection