@extends('layouts.app')

@section('title', 'Ficha del cliente')

@section('topbar_title', 'Gestión de clientes')

@push('styles')

<style>

    /* =========================================================
       BREADCRUMB
    ========================================================== */

    .client-detail-breadcrumb {

        display: flex;

        align-items: center;

        gap: 8px;

        margin-bottom: 18px;

        color: #8a94a6;

        font-size: 12px;

    }


    .client-detail-breadcrumb a {

        color: #667085;

        text-decoration: none;

    }


    .client-detail-breadcrumb a:hover {

        color: #155a91;

    }


    .client-detail-breadcrumb-current {

        color: #344054;

    }


    /* =========================================================
       HEADER
    ========================================================== */

    .client-detail-header {

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 20px;

        margin-bottom: 22px;

    }


    .client-detail-header-left {

        display: flex;

        align-items: center;

        gap: 14px;

        min-width: 0;

    }


    .client-detail-avatar {

        width: 52px;

        height: 52px;

        min-width: 52px;

        border-radius: 10px;

        background: #155a91;

        color: #ffffff;

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 17px;

        font-weight: 700;

        box-shadow:
            0 4px 10px rgba(21,90,145,.16);

    }


    .client-detail-title {

        margin: 0;

        color: #172033;

        font-size: 25px;

        line-height: 1.2;

        font-weight: 700;

        letter-spacing: -.025em;

    }


    .client-detail-subtitle {

        margin: 5px 0 0;

        color: #667085;

        font-size: 12px;

    }


    .client-detail-actions {

        display: flex;

        align-items: center;

        gap: 8px;

        flex-shrink: 0;

    }


    /* =========================================================
       INFORMACIÓN PRINCIPAL
    ========================================================== */

    .client-detail-main {

        display: grid;

        grid-template-columns:
            minmax(0, 1.7fr)
            minmax(240px, .8fr);

        gap: 18px;

        margin-bottom: 18px;

    }


    .client-detail-card {

        background: #ffffff;

        border:
            1px solid #e2e8f0;

        border-radius: 10px;

        box-shadow:
            0 2px 8px rgba(16,47,80,.05);

        overflow: hidden;

    }


    .client-detail-card-header {

        min-height: 62px;

        padding:
            15px 20px;

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 15px;

        border-bottom:
            1px solid #edf1f5;

    }


    .client-detail-card-title {

        margin: 0;

        color: #172033;

        font-size: 14px;

        font-weight: 700;

    }


    .client-detail-card-description {

        margin: 4px 0 0;

        color: #98a2b3;

        font-size: 10px;

    }


    .client-detail-card-body {

        padding: 20px;

    }


    /* =========================================================
       DATOS
    ========================================================== */

    .client-data-grid {

        display: grid;

        grid-template-columns:
            repeat(2, 1fr);

        gap: 0;

    }


    .client-data-item {

        padding:
            15px 17px;

        border-bottom:
            1px solid #edf1f5;

    }


    .client-data-item:nth-child(odd) {

        border-right:
            1px solid #edf1f5;

    }


    .client-data-item:nth-last-child(-n+2) {

        border-bottom: none;

    }


    .client-data-label {

        margin-bottom: 6px;

        color: #8a94a6;

        font-size: 9px;

        font-weight: 700;

        text-transform: uppercase;

        letter-spacing: .04em;

    }


    .client-data-value {

        color: #344054;

        font-size: 12px;

        font-weight: 500;

        word-break: break-word;

    }


    .client-data-value-primary {

        color: #172033;

        font-weight: 600;

    }


    .client-rut-badge {

        display: inline-flex;

        align-items: center;

        padding:
            5px 8px;

        border-radius: 5px;

        background: #f1f4f7;

        color: #667085;

        font-size: 10px;

        font-weight: 600;

    }


    .client-empty-value {

        color: #a1aab7;

        font-size: 11px;

    }


    /* =========================================================
       RESUMEN RELACIONES
    ========================================================== */

    .client-relations-grid {

        display: grid;

        grid-template-columns:
            repeat(2, 1fr);

        gap: 10px;

    }


    .client-relation {

        min-height: 80px;

        padding:
            13px;

        border:
            1px solid #e3e9ef;

        border-radius: 8px;

        background: #fbfcfd;

    }


    .client-relation-label {

        color: #667085;

        font-size: 9px;

        font-weight: 600;

    }


    .client-relation-value {

        margin-top: 7px;

        color: #172033;

        font-size: 21px;

        line-height: 1;

        font-weight: 700;

    }


    .client-relation-description {

        margin-top: 5px;

        color: #98a2b3;

        font-size: 9px;

    }


    /* =========================================================
       SECCIONES RELACIONADAS
    ========================================================== */

    .client-section {

        margin-bottom: 18px;

    }


    .client-section:last-child {

        margin-bottom: 0;

    }


    .client-section-header {

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 15px;

        margin-bottom: 10px;

    }


    .client-section-title {

        margin: 0;

        color: #172033;

        font-size: 15px;

        font-weight: 700;

    }


    .client-section-description {

        margin: 4px 0 0;

        color: #98a2b3;

        font-size: 10px;

    }


    /* =========================================================
       OPERACIONES
    ========================================================== */

    .client-related-card {

        background: #ffffff;

        border:
            1px solid #e2e8f0;

        border-radius: 10px;

        box-shadow:
            0 2px 8px rgba(16,47,80,.05);

        overflow: hidden;

    }


    .client-related-table-wrapper {

        width: 100%;

        overflow-x: auto;

    }


    .client-related-table {

        width: 100%;

        min-width: 650px;

        border-collapse: collapse;

    }


    .client-related-table th {

        padding:
            11px 17px;

        background: #f8fafc;

        border-bottom:
            1px solid #e2e8f0;

        color: #667085;

        text-align: left;

        font-size: 9px;

        font-weight: 700;

        text-transform: uppercase;

        letter-spacing: .035em;

        white-space: nowrap;

    }


    .client-related-table td {

        padding:
            13px 17px;

        border-bottom:
            1px solid #edf1f5;

        color: #344054;

        font-size: 10px;

        vertical-align: middle;

    }


    .client-related-table tbody tr:last-child td {

        border-bottom: none;

    }


    .client-related-table tbody tr:hover {

        background: #fbfcfe;

    }


    .operation-number {

        color: #155a91;

        font-weight: 700;

    }


    .operation-status {

        display: inline-flex;

        align-items: center;

        padding:
            4px 8px;

        border-radius: 20px;

        background: #f1f4f7;

        color: #667085;

        font-size: 9px;

        font-weight: 600;

    }


    .operation-status-dot {

        width: 5px;

        height: 5px;

        margin-right: 5px;

        border-radius: 50%;

        background: #98a2b3;

    }


    .related-action {

        display: inline-flex;

        align-items: center;

        justify-content: center;

        min-height: 29px;

        padding:
            5px 9px;

        border:
            1px solid #dce3eb;

        border-radius: 6px;

        background: #ffffff;

        color: #344054;

        text-decoration: none;

        font-size: 9px;

        font-weight: 600;

        transition:
            background .12s ease,
            color .12s ease;

    }


    .related-action:hover {

        background: #eaf3fa;

        color: #155a91;

    }


    /* =========================================================
       EMPTY STATE
    ========================================================== */

    .client-related-empty {

        padding:
            35px 20px;

        text-align: center;

    }


    .client-related-empty-icon {

        width: 38px;

        height: 38px;

        margin:
            0 auto 10px;

        border-radius: 8px;

        background: #eef4f8;

        color: #155a91;

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 15px;

    }


    .client-related-empty-title {

        margin: 0;

        color: #344054;

        font-size: 12px;

        font-weight: 700;

    }


    .client-related-empty-text {

        margin:
            5px auto 0;

        max-width: 350px;

        color: #98a2b3;

        font-size: 10px;

        line-height: 1.5;

    }


    /* =========================================================
       PRÓXIMOS MÓDULOS
    ========================================================== */

    .client-module-grid {

        display: grid;

        grid-template-columns:
            repeat(3, 1fr);

        gap: 12px;

    }


    .client-module-card {

        min-height: 105px;

        padding: 15px;

        border:
            1px solid #e3e9ef;

        border-radius: 8px;

        background: #ffffff;

    }


    .client-module-icon {

        width: 29px;

        height: 29px;

        margin-bottom: 9px;

        border-radius: 7px;

        background: #eef4f8;

        color: #155a91;

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 12px;

    }


    .client-module-title {

        color: #344054;

        font-size: 11px;

        font-weight: 700;

    }


    .client-module-text {

        margin-top: 4px;

        color: #98a2b3;

        font-size: 9px;

        line-height: 1.4;

    }


    .client-module-status {

        display: inline-block;

        margin-top: 7px;

        padding:
            3px 6px;

        border-radius: 4px;

        background: #f3f5f7;

        color: #98a2b3;

        font-size: 8px;

        font-weight: 600;

    }


    /* =========================================================
       RESPONSIVE
    ========================================================== */

    @media (max-width: 950px) {

        .client-detail-main {

            grid-template-columns: 1fr;

        }


        .client-module-grid {

            grid-template-columns:
                repeat(2, 1fr);

        }

    }


    @media (max-width: 700px) {

        .client-detail-header {

            align-items: stretch;

            flex-direction: column;

        }


        .client-detail-actions {

            width: 100%;

        }


        .client-detail-actions .btn {

            flex: 1;

        }


        .client-data-grid {

            grid-template-columns: 1fr;

        }


        .client-data-item:nth-child(odd) {

            border-right: none;

        }


        .client-data-item:nth-last-child(-n+2) {

            border-bottom:
                1px solid #edf1f5;

        }


        .client-data-item:last-child {

            border-bottom: none;

        }


        .client-relations-grid {

            grid-template-columns: 1fr 1fr;

        }


        .client-module-grid {

            grid-template-columns: 1fr;

        }

    }

</style>

@endpush


@section('content')

    {{-- =====================================================
         BREADCRUMB
    ====================================================== --}}

    <div class="client-detail-breadcrumb">

        <a href="{{ route('clientes.index') }}">
            Clientes
        </a>

        <span>›</span>

        <span class="client-detail-breadcrumb-current">
            Ficha del cliente
        </span>

    </div>


    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="client-detail-header">

        <div class="client-detail-header-left">

            <div class="client-detail-avatar">

                {{ strtoupper(
                    substr($cliente->razon_social, 0, 2)
                ) }}

            </div>


            <div>

                <h1 class="client-detail-title">
                    {{ $cliente->razon_social }}
                </h1>

                <p class="client-detail-subtitle">
                    Ficha y antecedentes del cliente
                </p>

            </div>

        </div>


        <div class="client-detail-actions">

            <a
                href="{{ route('clientes.index') }}"
                class="btn"
            >
                ← Volver
            </a>


            <a
                href="{{ route('clientes.edit', $cliente) }}"
                class="btn btn-primary"
            >
                Editar cliente
            </a>

        </div>

    </div>


    {{-- =====================================================
         INFORMACIÓN + RESUMEN
    ====================================================== --}}

    <div class="client-detail-main">


        {{-- INFORMACIÓN --}}

        <section class="client-detail-card">

            <div class="client-detail-card-header">

                <div>

                    <h2 class="client-detail-card-title">
                        Información del cliente
                    </h2>

                    <p class="client-detail-card-description">
                        Antecedentes registrados.
                    </p>

                </div>

            </div>


            <div class="client-detail-card-body">

                <div class="client-data-grid">


                    {{-- RAZÓN SOCIAL --}}

                    <div class="client-data-item">

                        <div class="client-data-label">
                            Razón social
                        </div>

                        <div class="client-data-value client-data-value-primary">
                            {{ $cliente->razon_social }}
                        </div>

                    </div>


                    {{-- RUT --}}

                    <div class="client-data-item">

                        <div class="client-data-label">
                            RUT
                        </div>

                        <div class="client-data-value">

                            <span class="client-rut-badge">
                                {{ $cliente->rut }}
                            </span>

                        </div>

                    </div>


                    {{-- COMUNA --}}

                    <div class="client-data-item">

                        <div class="client-data-label">
                            Comuna
                        </div>

                        <div class="client-data-value">

                            @if($cliente->comuna)

                                {{ $cliente->comuna }}

                            @else

                                <span class="client-empty-value">
                                    No registrada
                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- TELÉFONO --}}

                    <div class="client-data-item">

                        <div class="client-data-label">
                            Teléfono
                        </div>

                        <div class="client-data-value">

                            @if($cliente->telefono)

                                {{ $cliente->telefono }}

                            @else

                                <span class="client-empty-value">
                                    No registrado
                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- CORREO --}}

                    <div class="client-data-item">

                        <div class="client-data-label">
                            Correo electrónico
                        </div>

                        <div class="client-data-value">

                            @if($cliente->correo)

                                {{ $cliente->correo }}

                            @else

                                <span class="client-empty-value">
                                    No registrado
                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- DIRECCIÓN --}}

                    <div class="client-data-item">

                        <div class="client-data-label">
                            Dirección
                        </div>

                        <div class="client-data-value">

                            @if($cliente->direccion)

                                {{ $cliente->direccion }}

                            @else

                                <span class="client-empty-value">
                                    No registrada
                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- OBSERVACIONES --}}

                    <div class="client-data-item client-data-item-full"
                         style="grid-column: 1 / -1;">

                        <div class="client-data-label">
                            Observaciones
                        </div>

                        <div class="client-data-value">

                            @if($cliente->observaciones)

                                {{ $cliente->observaciones }}

                            @else

                                <span class="client-empty-value">
                                    Sin observaciones
                                </span>

                            @endif

                        </div>

                    </div>

                </div>

            </div>

        </section>


        {{-- RESUMEN --}}

        <section class="client-detail-card">

            <div class="client-detail-card-header">

                <div>

                    <h2 class="client-detail-card-title">
                        Resumen
                    </h2>

                    <p class="client-detail-card-description">
                        Relaciones del cliente.
                    </p>

                </div>

            </div>


            <div class="client-detail-card-body">

                <div class="client-relations-grid">


                    <div class="client-relation">

                        <div class="client-relation-label">
                            Operaciones
                        </div>

                        <div class="client-relation-value">
                            {{ $cliente->operaciones->count() }}
                        </div>

                        <div class="client-relation-description">
                            Operaciones asociadas
                        </div>

                    </div>


                    <div class="client-relation">

                        <div class="client-relation-label">
                            Reclamos
                        </div>

                        <div class="client-relation-value">
                            {{ $cliente->reclamos->count() }}
                        </div>

                        <div class="client-relation-description">
                            Reclamos registrados
                        </div>

                    </div>


                    <div class="client-relation">

                        <div class="client-relation-label">
                            Juicios
                        </div>

                        <div class="client-relation-value">
                            {{ $cliente->juicios->count() }}
                        </div>

                        <div class="client-relation-description">
                            Procesos registrados
                        </div>

                    </div>


                    <div class="client-relation">

                        <div class="client-relation-label">
                            Contratos
                        </div>

                        <div class="client-relation-value">
                            {{ $cliente->contratosSuministro->count() }}
                        </div>

                        <div class="client-relation-description">
                            Contratos de suministro
                        </div>

                    </div>

                </div>

            </div>

        </section>

    </div>


    {{-- =====================================================
         OPERACIONES
    ====================================================== --}}

    <section class="client-section">

        <div class="client-section-header">

            <div>

                <h2 class="client-section-title">
                    Operaciones
                </h2>

                <p class="client-section-description">
                    Operaciones asociadas a este cliente.
                </p>

            </div>


            <a
                href="{{ route('operaciones.create') }}"
                class="btn btn-primary"
            >
                + Nueva operación
            </a>

        </div>


        <div class="client-related-card">

            @if($cliente->operaciones->count())

                <div class="client-related-table-wrapper">

                    <table class="client-related-table">

                        <thead>

                            <tr>

                                <th>
                                    N.º operación
                                </th>

                                <th>
                                    Tipo
                                </th>

                                <th>
                                    Fecha operación
                                </th>

                                <th>
                                    Fecha curse
                                </th>

                                <th>
                                    Estado
                                </th>

                                <th>
                                    Acción
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach(
                                $cliente->operaciones
                                ->sortByDesc('fecha_operacion')
                            as $operacion)

                                <tr>

                                    <td>

                                        <span class="operation-number">
                                            {{ $operacion->numero_operacion }}
                                        </span>

                                    </td>


                                    <td>

                                        {{ $operacion->tipo ?: '—' }}

                                    </td>


                                    <td>

                                        @if($operacion->fecha_operacion)

                                            {{ $operacion->fecha_operacion->format('d/m/Y') }}

                                        @else

                                            —

                                        @endif

                                    </td>


                                    <td>

                                        @if($operacion->fecha_curse)

                                            {{ $operacion->fecha_curse->format('d/m/Y') }}

                                        @else

                                            —

                                        @endif

                                    </td>


                                    <td>

                                        <span class="operation-status">

                                            <span class="operation-status-dot"></span>

                                            {{ ucfirst(
                                                str_replace(
                                                    '_',
                                                    ' ',
                                                    $operacion->estado
                                                )
                                            ) }}

                                        </span>

                                    </td>


                                    <td>

                                        <a
                                            href="{{ route('operaciones.show', $operacion) }}"
                                            class="related-action"
                                        >
                                            Ver operación
                                        </a>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>


            @else

                <div class="client-related-empty">

                    <div class="client-related-empty-icon">
                        ▣
                    </div>

                    <h3 class="client-related-empty-title">
                        No hay operaciones asociadas
                    </h3>

                    <p class="client-related-empty-text">
                        Este cliente todavía no tiene operaciones registradas.
                    </p>

                </div>

            @endif

        </div>

    </section>


    {{-- =====================================================
         OTROS MÓDULOS
    ====================================================== --}}

    <section class="client-section">

        <div class="client-section-header">

            <div>

                <h2 class="client-section-title">
                    Información relacionada
                </h2>

                <p class="client-section-description">
                    Módulos que estarán disponibles desde la ficha del cliente.
                </p>

            </div>

        </div>


        <div class="client-module-grid">


            {{-- RECLAMOS --}}

            <div class="client-module-card">

                <div class="client-module-icon">
                    !
                </div>

                <div class="client-module-title">
                    Reclamos
                </div>

                <div class="client-module-text">
                    Gestión y seguimiento de reclamos asociados al cliente.
                </div>

                <span class="client-module-status">
                    {{ $cliente->reclamos->count() }} registrados
                </span>

            </div>


            {{-- JUICIOS --}}

            <div class="client-module-card">

                <div class="client-module-icon">
                    ⚖
                </div>

                <div class="client-module-title">
                    Juicios
                </div>

                <div class="client-module-text">
                    Seguimiento de procesos judiciales relacionados.
                </div>

                <span class="client-module-status">
                    {{ $cliente->juicios->count() }} registrados
                </span>

            </div>


            {{-- CONTRATOS --}}

            <div class="client-module-card">

                <div class="client-module-icon">
                    ▧
                </div>

                <div class="client-module-title">
                    Contratos de suministro
                </div>

                <div class="client-module-text">
                    Contratos y condiciones comerciales asociadas.
                </div>

                <span class="client-module-status">
                    {{ $cliente->contratosSuministro->count() }} registrados
                </span>

            </div>

        </div>

    </section>

@endsection