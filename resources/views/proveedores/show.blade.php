@extends('layouts.app')

@section('title', 'Proveedor')

@section('topbar_title', 'Gestión de proveedores')

@push('styles')

<style>

    /* =========================================================
       HEADER
    ========================================================== */

    .provider-show-header {

        display: flex;

        align-items: flex-start;

        justify-content: space-between;

        gap: 20px;

        margin-bottom: 22px;

    }


    .provider-show-heading {

        min-width: 0;

    }


    .provider-show-title {

        margin: 0;

        color: #172033;

        font-size: 27px;

        line-height: 1.2;

        font-weight: 700;

        letter-spacing: -.025em;

    }


    .provider-show-subtitle {

        margin: 7px 0 0;

        color: #667085;

        font-size: 13px;

    }


    .provider-show-rut {

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


    .provider-show-actions {

        display: flex;

        align-items: center;

        gap: 8px;

        flex-shrink: 0;

    }


    .provider-show-action {

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


    .provider-show-action:hover {

        background: #f7f9fb;

        border-color: #cbd7e3;

        color: #155a91;

    }


    .provider-show-action-primary {

        background: #155a91;

        border-color: #155a91;

        color: #ffffff;

    }


    .provider-show-action-primary:hover {

        background: #124d7d;

        border-color: #124d7d;

        color: #ffffff;

    }


    /* =========================================================
       ALERTAS
    ========================================================== */

    .provider-show-alert {

        margin-bottom: 18px;

        padding: 11px 14px;

        border-radius: 7px;

        font-size: 11px;

    }


    .provider-show-alert-success {

        border: 1px solid #cfe5d7;

        background: #f1faf4;

        color: #287443;

    }


    .provider-show-alert-error {

        border: 1px solid #e9c1bc;

        background: #fff5f3;

        color: #a52f26;

    }


    /* =========================================================
       RESUMEN
    ========================================================== */

    .provider-show-summary {

        display: grid;

        grid-template-columns: repeat(3, 1fr);

        gap: 14px;

        margin-bottom: 18px;

    }


    .provider-show-summary-card {

        background: #ffffff;

        border: 1px solid #e2e8f0;

        border-radius: 9px;

        padding: 16px 18px;

        box-shadow: 0 2px 7px rgba(16,47,80,.04);

    }


    .provider-show-summary-label {

        color: #667085;

        font-size: 10px;

        font-weight: 600;

        text-transform: uppercase;

        letter-spacing: .03em;

    }


    .provider-show-summary-value {

        margin-top: 7px;

        color: #172033;

        font-size: 22px;

        line-height: 1;

        font-weight: 700;

    }


    .provider-show-summary-description {

        margin-top: 6px;

        color: #98a2b3;

        font-size: 9px;

    }


    /* =========================================================
       TARJETAS
    ========================================================== */

    .provider-show-card {

        margin-bottom: 18px;

        background: #ffffff;

        border: 1px solid #e2e8f0;

        border-radius: 10px;

        box-shadow: 0 2px 8px rgba(16,47,80,.05);

        overflow: hidden;

    }


    .provider-show-card:last-child {

        margin-bottom: 0;

    }


    .provider-show-card-header {

        min-height: 62px;

        padding: 14px 20px;

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 15px;

        border-bottom: 1px solid #edf1f5;

    }


    .provider-show-card-title {

        margin: 0;

        color: #172033;

        font-size: 14px;

        font-weight: 700;

    }


    .provider-show-card-description {

        margin: 4px 0 0;

        color: #98a2b3;

        font-size: 10px;

    }


    .provider-show-card-body {

        padding: 20px;

    }


    /* =========================================================
       INFORMACIÓN
    ========================================================== */

    .provider-info-grid {

        display: grid;

        grid-template-columns: repeat(3, minmax(0, 1fr));

        gap: 18px 25px;

    }


    .provider-info-item {

        min-width: 0;

    }


    .provider-info-label {

        margin-bottom: 5px;

        color: #98a2b3;

        font-size: 9px;

        font-weight: 600;

        text-transform: uppercase;

        letter-spacing: .03em;

    }


    .provider-info-value {

        color: #344054;

        font-size: 11px;

        line-height: 1.45;

        word-break: break-word;

    }


    .provider-info-value-empty {

        color: #a1aab7;

    }


    .provider-info-full {

        grid-column: 1 / -1;

    }


    /* =========================================================
       TABLAS
    ========================================================== */

    .provider-show-table-wrapper {

        width: 100%;

        overflow-x: auto;

    }


    .provider-show-table {

        width: 100%;

        border-collapse: collapse;

        min-width: 700px;

    }


    .provider-show-table th {

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


    .provider-show-table td {

        padding: 13px 18px;

        border-bottom: 1px solid #edf1f5;

        color: #344054;

        font-size: 10px;

        vertical-align: middle;

    }


    .provider-show-table tbody tr:last-child td {

        border-bottom: none;

    }


    .provider-show-table tbody tr:hover {

        background: #fbfcfe;

    }


    .provider-table-primary {

        color: #172033;

        font-size: 11px;

        font-weight: 600;

    }


    .provider-table-secondary {

        margin-top: 3px;

        color: #98a2b3;

        font-size: 9px;

    }


    /* =========================================================
       ACCIONES DE TABLA
    ========================================================== */

    .provider-table-actions {

        display: flex;

        align-items: center;

        gap: 6px;

        white-space: nowrap;

    }


    .provider-table-action {

        display: inline-flex;

        align-items: center;

        justify-content: center;

        min-height: 28px;

        padding: 5px 9px;

        border: 1px solid #dce3eb;

        border-radius: 5px;

        background: #ffffff;

        color: #344054;

        font-family: inherit;

        font-size: 9px;

        font-weight: 600;

        text-decoration: none;

        cursor: pointer;

    }


    .provider-table-action:hover {

        background: #f7f9fb;

        color: #155a91;

        border-color: #cbd7e3;

    }


    .provider-table-action-danger {

        color: #a52f26;

    }


    .provider-table-action-danger:hover {

        color: #a52f26;

        background: #fff5f3;

        border-color: #e9c1bc;

    }


    /* =========================================================
       ESTADOS
    ========================================================== */

    .provider-status {

        display: inline-flex;

        align-items: center;

        padding: 4px 8px;

        border-radius: 5px;

        background: #f1f4f7;

        color: #667085;

        font-size: 9px;

        font-weight: 600;

    }


    .provider-status-pending {

        background: #fff5e8;

        color: #a15c00;

    }


    .provider-status-recovered {

        background: #eef8f1;

        color: #287443;

    }


    /* =========================================================
       ESTADO VACÍO
    ========================================================== */

    .provider-section-empty {

        padding: 32px 20px;

        text-align: center;

    }


    .provider-section-empty-title {

        margin: 0;

        color: #667085;

        font-size: 11px;

        font-weight: 600;

    }


    .provider-section-empty-text {

        margin: 5px auto 0;

        color: #98a2b3;

        font-size: 9px;

    }


    /* =========================================================
       PIE
    ========================================================== */

    .provider-show-footer {

        display: flex;

        align-items: center;

        justify-content: space-between;

        padding: 13px 20px;

        background: #fbfcfd;

        border-top: 1px solid #edf1f5;

    }


    .provider-show-footer-text {

        color: #98a2b3;

        font-size: 9px;

    }


    /* =========================================================
       RESPONSIVE
    ========================================================== */

    @media (max-width: 900px) {

        .provider-info-grid {

            grid-template-columns: repeat(2, 1fr);

        }

    }


    @media (max-width: 700px) {

        .provider-show-header {

            flex-direction: column;

        }


        .provider-show-actions {

            width: 100%;

        }


        .provider-show-action {

            flex: 1;

        }


        .provider-show-summary {

            grid-template-columns: 1fr;

        }


        .provider-info-grid {

            grid-template-columns: 1fr;

        }


        .provider-info-full {

            grid-column: auto;

        }

    }

</style>

@endpush


@section('content')

    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="provider-show-header">

        <div class="provider-show-heading">

            <h1 class="provider-show-title">
                {{ $proveedor->nombre }}
            </h1>

            <p class="provider-show-subtitle">
                Ficha y antecedentes del proveedor.
            </p>

            <span class="provider-show-rut">
                RUT {{ $proveedor->rut }}
            </span>

        </div>


        <div class="provider-show-actions">

            <a
                href="{{ route('proveedores.index') }}"
                class="provider-show-action"
            >
                ← Volver
            </a>

            <a
                href="{{ route('proveedores.edit', $proveedor) }}"
                class="provider-show-action provider-show-action-primary"
            >
                Editar proveedor
            </a>

        </div>

    </div>


    {{-- =====================================================
         MENSAJES
    ====================================================== --}}

    @if(session('success'))

        <div class="provider-show-alert provider-show-alert-success">
            {{ session('success') }}
        </div>

    @endif


    @if(session('error'))

        <div class="provider-show-alert provider-show-alert-error">
            {{ session('error') }}
        </div>

    @endif


    {{-- =====================================================
         RESUMEN
    ====================================================== --}}

    <div class="provider-show-summary">

        <div class="provider-show-summary-card">

            <div class="provider-show-summary-label">
                Bodegas
            </div>

            <div class="provider-show-summary-value">
                {{ $proveedor->bodegas->count() }}
            </div>

            <div class="provider-show-summary-description">
                Bodegas registradas
            </div>

        </div>


        <div class="provider-show-summary-card">

            <div class="provider-show-summary-label">
                Ejecutivos
            </div>

            <div class="provider-show-summary-value">
                {{ $proveedor->ejecutivos->count() }}
            </div>

            <div class="provider-show-summary-description">
                Ejecutivos comerciales
            </div>

        </div>


        <div class="provider-show-summary-card">

            <div class="provider-show-summary-label">
                NC pendientes
            </div>

            <div class="provider-show-summary-value">
                {{ $proveedor->notasCredito->where('estado', 'pendiente')->count() }}
            </div>

            <div class="provider-show-summary-description">
                Notas por recuperar
            </div>

        </div>

    </div>


    {{-- =====================================================
         INFORMACIÓN GENERAL
    ====================================================== --}}

    <section class="provider-show-card">

        <div class="provider-show-card-header">

            <div>

                <h2 class="provider-show-card-title">
                    Información general
                </h2>

                <p class="provider-show-card-description">
                    Datos principales registrados del proveedor.
                </p>

            </div>

        </div>


        <div class="provider-show-card-body">

            <div class="provider-info-grid">

                <div class="provider-info-item">

                    <div class="provider-info-label">
                        Nombre
                    </div>

                    <div class="provider-info-value">
                        {{ $proveedor->nombre }}
                    </div>

                </div>


                <div class="provider-info-item">

                    <div class="provider-info-label">
                        RUT
                    </div>

                    <div class="provider-info-value">
                        {{ $proveedor->rut }}
                    </div>

                </div>


                <div class="provider-info-item">

                    <div class="provider-info-label">
                        Localidad
                    </div>

                    <div class="provider-info-value
                        {{ !$proveedor->localidad ? 'provider-info-value-empty' : '' }}"
                    >
                        {{ $proveedor->localidad ?: 'No registrada' }}
                    </div>

                </div>


                <div class="provider-info-item">

                    <div class="provider-info-label">
                        Cuenta
                    </div>

                    <div class="provider-info-value
                        {{ !$proveedor->cuenta ? 'provider-info-value-empty' : '' }}"
                    >
                        {{ $proveedor->cuenta ?: 'No registrada' }}
                    </div>

                </div>


                <div class="provider-info-item">

                    <div class="provider-info-label">
                        Teléfono
                    </div>

                    <div class="provider-info-value
                        {{ !$proveedor->telefono ? 'provider-info-value-empty' : '' }}"
                    >
                        {{ $proveedor->telefono ?: 'No registrado' }}
                    </div>

                </div>


                <div class="provider-info-item">

                    <div class="provider-info-label">
                        Correo
                    </div>

                    <div class="provider-info-value
                        {{ !$proveedor->correo ? 'provider-info-value-empty' : '' }}"
                    >
                        {{ $proveedor->correo ?: 'No registrado' }}
                    </div>

                </div>


                <div class="provider-info-item provider-info-full">

                    <div class="provider-info-label">
                        Dirección
                    </div>

                    <div class="provider-info-value
                        {{ !$proveedor->direccion ? 'provider-info-value-empty' : '' }}"
                    >
                        {{ $proveedor->direccion ?: 'No registrada' }}
                    </div>

                </div>


                <div class="provider-info-item provider-info-full">

                    <div class="provider-info-label">
                        Observaciones
                    </div>

                    <div class="provider-info-value
                        {{ !$proveedor->observaciones ? 'provider-info-value-empty' : '' }}"
                    >
                        {{ $proveedor->observaciones ?: 'Sin observaciones' }}
                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- =====================================================
         BODEGAS
    ====================================================== --}}

    <section class="provider-show-card">

        <div class="provider-show-card-header">

            <div>

                <h2 class="provider-show-card-title">
                    Bodegas
                </h2>

                <p class="provider-show-card-description">
                    Direcciones de las bodegas asociadas al proveedor.
                </p>

            </div>


            <a
                href="{{ route('proveedores.bodegas.create', $proveedor) }}"
                class="provider-show-action provider-show-action-primary"
            >
                + Nueva bodega
            </a>

        </div>


        @if($proveedor->bodegas->count())

            <div class="provider-show-table-wrapper">

                <table class="provider-show-table">

                    <thead>

                        <tr>

                            <th>
                                Bodega
                            </th>

                            <th>
                                Dirección
                            </th>

                            <th>
                                Localidad
                            </th>

                            <th>
                                Observaciones
                            </th>

                            <th>
                                Acciones
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($proveedor->bodegas as $bodega)

                            <tr>

                                <td>

                                    <div class="provider-table-primary">
                                        {{ $bodega->nombre }}
                                    </div>

                                </td>


                                <td>
                                    {{ $bodega->direccion }}
                                </td>


                                <td>
                                    {{ $bodega->localidad ?: '—' }}
                                </td>


                                <td>
                                    {{ $bodega->observaciones ?: '—' }}
                                </td>


                                <td>

                                    <div class="provider-table-actions">

                                        <a
                                            href="{{ route(
                                                'proveedores.bodegas.edit',
                                                [
                                                    'proveedor' => $proveedor,
                                                    'bodega' => $bodega
                                                ]
                                            ) }}"
                                            class="provider-table-action"
                                        >
                                            Editar
                                        </a>


                                        <form
                                            action="{{ route(
                                                'proveedores.bodegas.destroy',
                                                [
                                                    'proveedor' => $proveedor,
                                                    'bodega' => $bodega
                                                ]
                                            ) }}"
                                            method="POST"
                                            style="display: inline;"
                                            onsubmit="return confirm('¿Estás seguro de eliminar esta bodega? Esta acción no se puede deshacer.');"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="provider-table-action provider-table-action-danger"
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

        @else

            <div class="provider-section-empty">

                <h3 class="provider-section-empty-title">
                    No hay bodegas registradas
                </h3>

                <p class="provider-section-empty-text">
                    Registra la primera bodega utilizando el botón
                    <strong>+ Nueva bodega</strong>.
                </p>

            </div>

        @endif

    </section>


    {{-- =====================================================
         EJECUTIVOS
    ====================================================== --}}

    <section class="provider-show-card">

        <div class="provider-show-card-header">

            <div>

                <h2 class="provider-show-card-title">
                    Ejecutivos
                </h2>

                <p class="provider-show-card-description">
                    Ejecutivos comerciales que mantienen relación con la empresa.
                </p>

            </div>


            <a
                href="{{ route('proveedores.ejecutivos.create', $proveedor) }}"
                class="provider-show-action provider-show-action-primary"
            >
                + Nuevo ejecutivo
            </a>

        </div>


        @if($proveedor->ejecutivos->count())

            <div class="provider-show-table-wrapper">

                <table class="provider-show-table">

                    <thead>

                        <tr>

                            <th>
                                Nombre
                            </th>

                            <th>
                                Cargo
                            </th>

                            <th>
                                Correo
                            </th>

                            <th>
                                Teléfono
                            </th>

                            <th>
                                Observaciones
                            </th>

                            <th>
                                Acciones
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($proveedor->ejecutivos as $ejecutivo)

                            <tr>

                                <td>

                                    <div class="provider-table-primary">
                                        {{ $ejecutivo->nombre }}
                                    </div>

                                </td>


                                <td>
                                    {{ $ejecutivo->cargo ?: '—' }}
                                </td>


                                <td>
                                    {{ $ejecutivo->correo ?: '—' }}
                                </td>


                                <td>
                                    {{ $ejecutivo->telefono ?: '—' }}
                                </td>


                                <td>
                                    {{ $ejecutivo->observaciones ?: '—' }}
                                </td>


                                <td>

                                    <div class="provider-table-actions">

                                        <a
                                            href="{{ route(
                                                'proveedores.ejecutivos.edit',
                                                [
                                                    'proveedor' => $proveedor,
                                                    'ejecutivo' => $ejecutivo
                                                ]
                                            ) }}"
                                            class="provider-table-action"
                                        >
                                            Editar
                                        </a>


                                        <form
                                            action="{{ route(
                                                'proveedores.ejecutivos.destroy',
                                                [
                                                    'proveedor' => $proveedor,
                                                    'ejecutivo' => $ejecutivo
                                                ]
                                            ) }}"
                                            method="POST"
                                            style="display: inline;"
                                            onsubmit="return confirm('¿Estás seguro de eliminar este ejecutivo? Esta acción no se puede deshacer.');"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="provider-table-action provider-table-action-danger"
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

        @else

            <div class="provider-section-empty">

                <h3 class="provider-section-empty-title">
                    No hay ejecutivos registrados
                </h3>

                <p class="provider-section-empty-text">
                    Registra el primer ejecutivo comercial asociado a este proveedor.
                </p>

            </div>

        @endif

    </section>


    {{-- =====================================================
         NOTAS DE CRÉDITO
    ====================================================== --}}

    <section class="provider-show-card">

        <div class="provider-show-card-header">

            <div>

                <h2 class="provider-show-card-title">
                    Notas de crédito pendientes de recuperar
                </h2>

                <p class="provider-show-card-description">
                    Notas asociadas al proveedor cuyo saldo aún debe ser recuperado.
                </p>

            </div>


            <a
                href="{{ route(
                    'notas-credito-proveedores.create',
                    ['proveedor_id' => $proveedor->id]
                ) }}"
                class="provider-show-action provider-show-action-primary"
            >
                + Nueva nota de crédito
            </a>

        </div>


        @if($proveedor->notasCredito->count())

            <div class="provider-show-table-wrapper">

                <table class="provider-show-table">

                    <thead>

                        <tr>

                            <th>
                                Nº nota
                            </th>

                            <th>
                                Fecha
                            </th>

                            <th>
                                Monto
                            </th>

                            <th>
                                Motivo
                            </th>

                            <th>
                                Estado
                            </th>

                            <th>
                                Observaciones
                            </th>

                            <th>
                                Acciones
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($proveedor->notasCredito as $nota)

                            <tr>

                                <td>

                                    <div class="provider-table-primary">
                                        {{ $nota->numero_nota }}
                                    </div>

                                </td>


                                <td>
                                    {{ $nota->fecha?->format('d/m/Y') ?: '—' }}
                                </td>


                                <td>
                                    ${{ number_format((float) $nota->monto, 0, ',', '.') }}
                                </td>


                                <td>
                                    {{ $nota->motivo ?: '—' }}
                                </td>


                                <td>

                                    @if($nota->estado === 'pendiente')

                                        <span class="provider-status provider-status-pending">
                                            Pendiente
                                        </span>

                                    @elseif($nota->estado === 'recuperada')

                                        <span class="provider-status provider-status-recovered">
                                            Recuperada
                                        </span>

                                    @else

                                        <span class="provider-status">
                                            {{ ucfirst($nota->estado) }}
                                        </span>

                                    @endif

                                </td>


                                <td>
                                    {{ $nota->observaciones ?: '—' }}
                                </td>


                                <td>

                                    <div class="provider-table-actions">

                                        <a
                                            href="{{ route(
                                                'notas-credito-proveedores.show',
                                                $nota
                                            ) }}"
                                            class="provider-table-action"
                                        >
                                            Ver
                                        </a>


                                        <a
                                            href="{{ route(
                                                'notas-credito-proveedores.edit',
                                                $nota
                                            ) }}"
                                            class="provider-table-action"
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


            <div class="provider-show-footer">

                <div class="provider-show-footer-text">

                    Total de notas:

                    <strong>
                        {{ $proveedor->notasCredito->count() }}
                    </strong>

                </div>


                <div class="provider-show-footer-text">

                    Pendientes:

                    <strong>
                        {{ $proveedor->notasCredito->where('estado', 'pendiente')->count() }}
                    </strong>

                </div>

            </div>

        @else

            <div class="provider-section-empty">

                <h3 class="provider-section-empty-title">
                    No hay notas de crédito registradas
                </h3>

                <p class="provider-section-empty-text">
                    Aquí aparecerán las notas de crédito pendientes de recuperar asociadas a este proveedor.
                </p>

            </div>

        @endif

    </section>

@endsection