@extends('layouts.app')

@section('title', 'Detalle del gasto')

@section('topbar_title', 'Gestión de gastos')

@push('styles')

<style>

    /* =========================================================
       BREADCRUMB
    ========================================================== */

    .gasto-show-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 18px;
        color: #8a94a6;
        font-size: 12px;
    }

    .gasto-show-breadcrumb a {
        color: #667085;
        text-decoration: none;
    }

    .gasto-show-breadcrumb a:hover {
        color: #155a91;
    }

    .gasto-show-breadcrumb-current {
        color: #344054;
    }


    /* =========================================================
       HEADER
    ========================================================== */

    .gasto-show-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 25px;
    }

    .gasto-show-title {
        margin: 0;
        color: #172033;
        font-size: 27px;
        line-height: 1.2;
        font-weight: 700;
        letter-spacing: -.025em;
    }

    .gasto-show-subtitle {
        margin: 7px 0 0;
        color: #667085;
        font-size: 13px;
    }

    .gasto-show-actions {
        display: flex;
        align-items: center;
        gap: 9px;
    }


    /* =========================================================
       ALERTAS
    ========================================================== */

    .gasto-show-alert {
        margin-bottom: 20px;
        padding: 13px 16px;
        border-radius: 7px;
        font-size: 11px;
    }

    .gasto-show-alert-success {
        border: 1px solid #cce7d4;
        background: #f3fbf5;
        color: #287a3d;
    }

    .gasto-show-alert-error {
        border: 1px solid #f1ceca;
        background: #fff5f3;
        color: #a63228;
    }


    /* =========================================================
       CARDS
    ========================================================== */

    .gasto-show-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(16,47,80,.05);
        margin-bottom: 20px;
        overflow: hidden;
    }

    .gasto-show-card-header {
        min-height: 67px;
        padding: 17px 21px;
        border-bottom: 1px solid #edf1f5;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
    }

    .gasto-show-card-title {
        margin: 0;
        color: #172033;
        font-size: 15px;
        font-weight: 700;
    }

    .gasto-show-card-description {
        margin: 4px 0 0;
        color: #98a2b3;
        font-size: 11px;
    }

    .gasto-show-card-body {
        padding: 22px;
    }


    /* =========================================================
       INFORMACIÓN
    ========================================================== */

    .gasto-detail-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 18px;
    }

    .gasto-detail-item {
        min-width: 0;
    }

    .gasto-detail-label {
        display: block;
        margin-bottom: 6px;
        color: #98a2b3;
        font-size: 10px;
        font-weight: 600;
    }

    .gasto-detail-value {
        color: #344054;
        font-size: 12px;
        font-weight: 600;
        word-break: break-word;
    }

    .gasto-detail-value-normal {
        font-weight: 400;
    }


    /* =========================================================
       MONTO
    ========================================================== */

    .gasto-amount-box {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 20px;
        padding: 17px 19px;
        border: 1px solid #dce9f3;
        border-radius: 8px;
        background: #f7fbff;
    }

    .gasto-amount-label {
        color: #526579;
        font-size: 11px;
        font-weight: 600;
    }

    .gasto-amount-value {
        color: #155a91;
        font-size: 23px;
        font-weight: 700;
        letter-spacing: -.02em;
    }


    /* =========================================================
       BADGES
    ========================================================== */

    .gasto-show-badge {
        display: inline-flex;
        align-items: center;
        min-height: 24px;
        padding: 0 9px;
        border-radius: 999px;
        background: #eef4f8;
        color: #155a91;
        font-size: 10px;
        font-weight: 700;
    }

    .gasto-show-badge-general {
        background: #f2f4f7;
        color: #667085;
    }


    /* =========================================================
       TRAZABILIDAD
    ========================================================== */

    .gasto-trace-box {
        padding: 16px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        background: #fafbfc;
    }

    .gasto-trace-title {
        margin: 0 0 5px;
        color: #344054;
        font-size: 12px;
        font-weight: 700;
    }

    .gasto-trace-description {
        margin: 0 0 14px;
        color: #98a2b3;
        font-size: 10px;
        line-height: 1.4;
    }

    .gasto-trace-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: #155a91;
        font-size: 11px;
        font-weight: 600;
        text-decoration: none;
    }

    .gasto-trace-link:hover {
        text-decoration: underline;
    }


    /* =========================================================
       OBSERVACIONES
    ========================================================== */

    .gasto-observaciones {
        padding: 14px 15px;
        border: 1px solid #e2e8f0;
        border-radius: 7px;
        background: #fafbfc;
        color: #526579;
        font-size: 11px;
        line-height: 1.6;
        white-space: pre-line;
    }


    /* =========================================================
       ACCIONES
    ========================================================== */

    .gasto-show-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        padding: 18px 22px;
        background: #f8fafc;
        border-top: 1px solid #edf1f5;
    }

    .gasto-show-footer-actions {
        display: flex;
        gap: 9px;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================== */

    @media (max-width: 900px) {

        .gasto-detail-grid {
            grid-template-columns: 1fr;
        }

    }


    @media (max-width: 700px) {

        .gasto-show-header {
            flex-direction: column;
        }

        .gasto-show-actions {
            width: 100%;
        }

        .gasto-show-actions .btn {
            flex: 1;
        }

        .gasto-show-card-body {
            padding: 17px;
        }

        .gasto-show-footer {
            align-items: stretch;
            flex-direction: column;
        }

        .gasto-show-footer-actions {
            width: 100%;
        }

        .gasto-show-footer-actions .btn {
            flex: 1;
        }

    }

</style>

@endpush


@section('content')

    {{-- =====================================================
         BREADCRUMB
    ====================================================== --}}

    <div class="gasto-show-breadcrumb">

        <a href="{{ route('gastos.index') }}">
            Gastos
        </a>

        <span>›</span>

        <span class="gasto-show-breadcrumb-current">
            Detalle del gasto
        </span>

    </div>


    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="gasto-show-header">

        <div>

            <h1 class="gasto-show-title">
                Detalle del gasto
            </h1>

            <p class="gasto-show-subtitle">
                Consulta la información y trazabilidad del gasto registrado.
            </p>

        </div>


        <div class="gasto-show-actions">

            <a
                href="{{ route('gastos.index') }}"
                class="btn"
            >
                ← Volver
            </a>

            <a
                href="{{ route('gastos.edit', $gasto) }}"
                class="btn btn-primary"
            >
                Editar gasto
            </a>

        </div>

    </div>


    {{-- =====================================================
         ALERTAS
    ====================================================== --}}

    @if(session('success'))

        <div class="gasto-show-alert gasto-show-alert-success">
            {{ session('success') }}
        </div>

    @endif


    @if(session('error'))

        <div class="gasto-show-alert gasto-show-alert-error">
            {{ session('error') }}
        </div>

    @endif


    {{-- =====================================================
         RESUMEN
    ====================================================== --}}

    <section class="gasto-show-card">

        <div class="gasto-show-card-header">

            <div>

                <h2 class="gasto-show-card-title">
                    Información del gasto
                </h2>

                <p class="gasto-show-card-description">
                    Datos principales del registro.
                </p>

            </div>

            @if($gasto->tipo === 'Egreso general')

                <span class="gasto-show-badge gasto-show-badge-general">
                    Egreso general
                </span>

            @else

                <span class="gasto-show-badge">
                    {{ $gasto->tipo ?: 'Sin tipo' }}
                </span>

            @endif

        </div>


        <div class="gasto-show-card-body">


            {{-- MONTO --}}

            <div class="gasto-amount-box">

                <span class="gasto-amount-label">
                    Monto total
                </span>

                <strong class="gasto-amount-value">
                    ${{ number_format((float) $gasto->monto, 0, ',', '.') }}
                </strong>

            </div>


            <div class="gasto-detail-grid">


                {{-- ID --}}

                <div class="gasto-detail-item">

                    <span class="gasto-detail-label">
                        ID del gasto
                    </span>

                    <span class="gasto-detail-value">
                        #{{ $gasto->id }}
                    </span>

                </div>


                {{-- FECHA --}}

                <div class="gasto-detail-item">

                    <span class="gasto-detail-label">
                        Fecha
                    </span>

                    <span class="gasto-detail-value">

                        @if($gasto->fecha)

                            {{ $gasto->fecha->format('d/m/Y') }}

                        @else

                            Sin fecha

                        @endif

                    </span>

                </div>


                {{-- TIPO --}}

                <div class="gasto-detail-item">

                    <span class="gasto-detail-label">
                        Tipo de gasto
                    </span>

                    <span class="gasto-detail-value">
                        {{ $gasto->tipo ?: 'Sin tipo' }}
                    </span>

                </div>


                {{-- CONCEPTO --}}

                <div class="gasto-detail-item">

                    <span class="gasto-detail-label">
                        Concepto
                    </span>

                    <span class="gasto-detail-value">
                        {{ $gasto->descripcion ?: 'Sin concepto' }}
                    </span>

                </div>


                {{-- OPERACIÓN --}}

                <div class="gasto-detail-item">

                    <span class="gasto-detail-label">
                        Operación
                    </span>

                    <span class="gasto-detail-value">

                        @if($gasto->operacion)

                            <a
                                href="{{ route('operaciones.show', $gasto->operacion) }}"
                                class="gasto-trace-link"
                            >

                                {{ $gasto->operacion->numero_operacion }}

                                @if($gasto->operacion->cliente)

                                    — {{ $gasto->operacion->cliente->nombre }}

                                @endif

                            </a>

                        @else

                            <span class="gasto-show-badge gasto-show-badge-general">
                                Sin operación
                            </span>

                        @endif

                    </span>

                </div>


                {{-- TRANSPORTISTA --}}

                <div class="gasto-detail-item">

                    <span class="gasto-detail-label">
                        Transportista
                    </span>

                    <span class="gasto-detail-value">

                        @if($gasto->transportista)

                            {{ $gasto->transportista->nombre }}

                            @if($gasto->transportista->rut)

                                <span class="gasto-detail-value-normal">
                                    — {{ $gasto->transportista->rut }}
                                </span>

                            @endif

                        @else

                            <span class="gasto-detail-value-normal">
                                Sin transportista
                            </span>

                        @endif

                    </span>

                </div>


                {{-- FECHA DE CREACIÓN --}}

                <div class="gasto-detail-item">

                    <span class="gasto-detail-label">
                        Registrado
                    </span>

                    <span class="gasto-detail-value">

                        @if($gasto->created_at)

                            {{ $gasto->created_at->format('d/m/Y H:i') }}

                        @else

                            —

                        @endif

                    </span>

                </div>


                {{-- ACTUALIZACIÓN --}}

                <div class="gasto-detail-item">

                    <span class="gasto-detail-label">
                        Última actualización
                    </span>

                    <span class="gasto-detail-value">

                        @if($gasto->updated_at)

                            {{ $gasto->updated_at->format('d/m/Y H:i') }}

                        @else

                            —

                        @endif

                    </span>

                </div>

            </div>

        </div>

    </section>


    {{-- =====================================================
         TRAZABILIDAD
    ====================================================== --}}

    <section class="gasto-show-card">

        <div class="gasto-show-card-header">

            <div>

                <h2 class="gasto-show-card-title">
                    Trazabilidad
                </h2>

                <p class="gasto-show-card-description">
                    Relaciones del gasto dentro del sistema.
                </p>

            </div>

        </div>


        <div class="gasto-show-card-body">


            @if($gasto->operacion)

                <div class="gasto-trace-box">

                    <h3 class="gasto-trace-title">
                        Operación asociada
                    </h3>

                    <p class="gasto-trace-description">
                        Este gasto forma parte de los gastos registrados para la operación.
                    </p>

                    <a
                        href="{{ route('operaciones.show', $gasto->operacion) }}"
                        class="gasto-trace-link"
                    >

                        Ver operación

                        →
                        
                    </a>

                </div>

            @else

                <div class="gasto-trace-box">

                    <h3 class="gasto-trace-title">
                        Egreso general
                    </h3>

                    <p class="gasto-trace-description">
                        Este registro no pertenece a una operación específica y se considera un egreso general.
                    </p>

                </div>

            @endif


            @if($gasto->transportista)

                <div
                    class="gasto-trace-box"
                    style="margin-top: 12px;"
                >

                    <h3 class="gasto-trace-title">
                        Transportista asociado
                    </h3>

                    <p class="gasto-trace-description">
                        El mismo gasto está asociado al transportista, sin crear un segundo registro.
                    </p>

                    <span class="gasto-detail-value">
                        {{ $gasto->transportista->nombre }}

                        @if($gasto->transportista->rut)

                            — {{ $gasto->transportista->rut }}

                        @endif

                    </span>

                </div>

            @endif

        </div>

    </section>


    {{-- =====================================================
         OBSERVACIONES
    ====================================================== --}}

    @if($gasto->observaciones)

        <section class="gasto-show-card">

            <div class="gasto-show-card-header">

                <div>

                    <h2 class="gasto-show-card-title">
                        Observaciones
                    </h2>

                    <p class="gasto-show-card-description">
                        Información adicional del registro.
                    </p>

                </div>

            </div>


            <div class="gasto-show-card-body">

                <div class="gasto-observaciones">
                    {{ $gasto->observaciones }}
                </div>

            </div>

        </section>

    @endif


    {{-- =====================================================
         FOOTER
    ====================================================== --}}

    <div class="gasto-show-card">

        <div class="gasto-show-footer">

            <div>

                <span class="gasto-show-subtitle">
                    Gasto #{{ $gasto->id }}
                </span>

            </div>


            <div class="gasto-show-footer-actions">

                <a
                    href="{{ route('gastos.index') }}"
                    class="btn"
                >
                    Volver
                </a>


                <a
                    href="{{ route('gastos.edit', $gasto) }}"
                    class="btn btn-primary"
                >
                    Editar gasto
                </a>


                <form
                    action="{{ route('gastos.destroy', $gasto) }}"
                    method="POST"
                    style="display:inline;"
                    onsubmit="return confirm('¿Estás seguro de que deseas eliminar este gasto?');"
                >

                    @csrf

                    @method('DELETE')

                    <button
                        type="submit"
                        class="btn"
                    >
                        Eliminar
                    </button>

                </form>

            </div>

        </div>

    </div>

@endsection