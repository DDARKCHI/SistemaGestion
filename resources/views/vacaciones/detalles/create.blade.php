@extends('layouts.app')

@section('title', 'Registrar vacaciones')

@section('topbar_title', 'Vacaciones')

@push('styles')

<style>

    .vacation-detail-header {
        margin-bottom: 24px;
    }

    .vacation-detail-title {
        margin: 0;
        color: #172033;
        font-size: 27px;
        line-height: 1.2;
        font-weight: 700;
        letter-spacing: -.025em;
    }

    .vacation-detail-subtitle {
        margin: 7px 0 0;
        color: #667085;
        font-size: 13px;
    }

    .vacation-detail-summary {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 12px;
        margin-bottom: 18px;
    }

    .vacation-detail-summary-item {
        padding: 13px 14px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        background: #fbfcfd;
    }

    .vacation-detail-summary-item:first-child {
        background: #f7fbfe;
        border-color: #d4e5f2;
    }

    .vacation-detail-summary-label {
        color: #98a2b3;
        font-size: 9px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .03em;
    }

    .vacation-detail-summary-value {
        margin-top: 5px;
        color: #172033;
        font-size: 15px;
        font-weight: 700;
    }

    .vacation-detail-summary-item:first-child
    .vacation-detail-summary-value {
        color: #155a91;
    }

    .vacation-detail-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(16,47,80,.05);
        overflow: hidden;
    }

    .vacation-detail-card-header {
        padding: 17px 20px;
        border-bottom: 1px solid #edf1f5;
    }

    .vacation-detail-card-title {
        margin: 0;
        color: #172033;
        font-size: 14px;
        font-weight: 700;
    }

    .vacation-detail-card-description {
        margin: 4px 0 0;
        color: #98a2b3;
        font-size: 10px;
    }

    .vacation-detail-body {
        padding: 22px 20px;
    }

    .vacation-detail-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
    }

    .vacation-detail-group {
        min-width: 0;
    }

    .vacation-detail-group-full {
        grid-column: 1 / -1;
    }

    .vacation-detail-label {
        display: block;
        margin-bottom: 7px;
        color: #344054;
        font-size: 11px;
        font-weight: 600;
    }

    .vacation-detail-required {
        color: #b9382e;
    }

    .vacation-detail-input {
        width: 100%;
        min-height: 39px;
        padding: 9px 11px;
        box-sizing: border-box;
        border: 1px solid #d8e0e8;
        border-radius: 7px;
        background: #ffffff;
        color: #344054;
        font-family: inherit;
        font-size: 11px;
        outline: none;
        transition:
            border-color .12s ease,
            box-shadow .12s ease;
    }

    .vacation-detail-input:focus {
        border-color: #155a91;
        box-shadow:
            0 0 0 3px rgba(21,90,145,.08);
    }

    textarea.vacation-detail-input {
        min-height: 105px;
        resize: vertical;
        line-height: 1.5;
    }

    .vacation-detail-help {
        margin-top: 5px;
        color: #98a2b3;
        font-size: 9px;
        line-height: 1.4;
    }

    .vacation-detail-error {
        margin-top: 5px;
        color: #b9382e;
        font-size: 9px;
    }

    .vacation-detail-alert {
        margin-bottom: 18px;
        padding: 11px 14px;
        border: 1px solid #f0d3cf;
        border-radius: 7px;
        background: #fff7f5;
        color: #a52f26;
        font-size: 11px;
    }

    .vacation-detail-info {
        margin-top: 18px;
        padding: 12px 14px;
        border: 1px solid #e2e8f0;
        border-radius: 7px;
        background: #fbfcfd;
        color: #667085;
        font-size: 10px;
        line-height: 1.5;
    }

    .vacation-detail-info strong {
        color: #344054;
    }

    .vacation-detail-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 15px 20px;
        border-top: 1px solid #edf1f5;
        background: #fbfcfd;
    }

    .vacation-detail-footer-actions {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .vacation-detail-cancel {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 35px;
        padding: 7px 13px;
        border: 1px solid #dce3eb;
        border-radius: 6px;
        background: #ffffff;
        color: #344054;
        font-family: inherit;
        font-size: 10px;
        font-weight: 600;
        text-decoration: none;
    }

    .vacation-detail-cancel:hover {
        background: #f5f8fb;
        border-color: #cbd7e3;
    }

    @media (max-width: 800px) {

        .vacation-detail-summary {
            grid-template-columns: repeat(2, 1fr);
        }

    }

    @media (max-width: 700px) {

        .vacation-detail-summary,
        .vacation-detail-grid {
            grid-template-columns: 1fr;
        }

        .vacation-detail-group-full {
            grid-column: auto;
        }

        .vacation-detail-footer {
            align-items: stretch;
            flex-direction: column;
        }

        .vacation-detail-footer-actions {
            width: 100%;
        }

        .vacation-detail-footer-actions .btn,
        .vacation-detail-footer-actions .vacation-detail-cancel {
            flex: 1;
        }

    }

</style>

@endpush


@section('content')

    <div class="vacation-detail-header">

        <h1 class="vacation-detail-title">
            Registrar días de vacaciones
        </h1>

        <p class="vacation-detail-subtitle">
            Registra días tomados o reservados dentro del período de vacaciones.
        </p>

    </div>


    <div class="vacation-detail-summary">

        <div class="vacation-detail-summary-item">

            <div class="vacation-detail-summary-label">
                Trabajador
            </div>

            <div class="vacation-detail-summary-value">
                {{ $trabajador->nombre }}
            </div>

        </div>


        <div class="vacation-detail-summary-item">

            <div class="vacation-detail-summary-label">
                Período
            </div>

            <div class="vacation-detail-summary-value">
                {{ $vacacion->periodo }}
            </div>

        </div>


        <div class="vacation-detail-summary-item">

            <div class="vacation-detail-summary-label">
                Días correspondientes
            </div>

            <div class="vacation-detail-summary-value">
                {{ rtrim(rtrim(number_format((float) $vacacion->dias_correspondientes, 2, '.', ''), '0'), '.') }}
            </div>

        </div>


        <div class="vacation-detail-summary-item">

            <div class="vacation-detail-summary-label">
                Días disponibles
            </div>

            <div class="vacation-detail-summary-value">
                {{ rtrim(rtrim(number_format((float) $vacacion->dias_restantes, 2, '.', ''), '0'), '.') }}
            </div>

        </div>

    </div>


    @if($errors->any())

        <div class="vacation-detail-alert">
            Revisa los datos ingresados. Hay campos que requieren corrección.
        </div>

    @endif


    <section class="vacation-detail-card">

        <div class="vacation-detail-card-header">

            <h2 class="vacation-detail-card-title">
                Detalle de vacaciones
            </h2>

            <p class="vacation-detail-card-description">
                Indica las fechas, cantidad de días y si corresponden a vacaciones tomadas o reservadas.
            </p>

        </div>


        <form
            action="{{ route(
                'trabajadores.vacaciones.detalles.store',
                [
                    'trabajador' => $trabajador,
                    'vacacion' => $vacacion,
                ]
            ) }}"
            method="POST"
        >

            @csrf


            <div class="vacation-detail-body">

                <div class="vacation-detail-grid">

                    <div class="vacation-detail-group">

                        <label
                            for="tipo"
                            class="vacation-detail-label"
                        >
                            Tipo
                            <span class="vacation-detail-required">*</span>
                        </label>

                        <select
                            id="tipo"
                            name="tipo"
                            class="vacation-detail-input"
                            required
                            autofocus
                        >

                            <option value="">
                                Seleccionar
                            </option>

                            <option
                                value="tomada"
                                {{ old('tipo') === 'tomada' ? 'selected' : '' }}
                            >
                                Vacaciones tomadas
                            </option>

                            <option
                                value="reservada"
                                {{ old('tipo') === 'reservada' ? 'selected' : '' }}
                            >
                                Vacaciones reservadas
                            </option>

                        </select>

                        @error('tipo')

                            <div class="vacation-detail-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <div class="vacation-detail-group">

                        <label
                            for="dias"
                            class="vacation-detail-label"
                        >
                            Cantidad de días
                            <span class="vacation-detail-required">*</span>
                        </label>

                        <input
                            type="number"
                            id="dias"
                            name="dias"
                            class="vacation-detail-input"
                            value="{{ old('dias') }}"
                            min="0.5"
                            step="0.5"
                            placeholder="Ej. 5"
                            required
                        >

                        <div class="vacation-detail-help">
                            No puede superar los días disponibles del período.
                        </div>

                        @error('dias')

                            <div class="vacation-detail-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <div class="vacation-detail-group">

                        <label
                            for="fecha_inicio"
                            class="vacation-detail-label"
                        >
                            Fecha de inicio
                            <span class="vacation-detail-required">*</span>
                        </label>

                        <input
                            type="date"
                            id="fecha_inicio"
                            name="fecha_inicio"
                            class="vacation-detail-input"
                            value="{{ old('fecha_inicio') }}"
                            required
                        >

                        @error('fecha_inicio')

                            <div class="vacation-detail-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <div class="vacation-detail-group">

                        <label
                            for="fecha_termino"
                            class="vacation-detail-label"
                        >
                            Fecha de término
                            <span class="vacation-detail-required">*</span>
                        </label>

                        <input
                            type="date"
                            id="fecha_termino"
                            name="fecha_termino"
                            class="vacation-detail-input"
                            value="{{ old('fecha_termino') }}"
                            required
                        >

                        @error('fecha_termino')

                            <div class="vacation-detail-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <div class="vacation-detail-group vacation-detail-group-full">

                        <label
                            for="observaciones"
                            class="vacation-detail-label"
                        >
                            Observaciones
                        </label>

                        <textarea
                            id="observaciones"
                            name="observaciones"
                            class="vacation-detail-input"
                            placeholder="Información adicional sobre estas vacaciones..."
                        >{{ old('observaciones') }}</textarea>

                        @error('observaciones')

                            <div class="vacation-detail-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                </div>


                <div class="vacation-detail-info">

                    <strong>Vacaciones tomadas:</strong>
                    los días se consideran utilizados y se descuentan del saldo disponible.

                    <br>

                    <strong>Vacaciones reservadas:</strong>
                    los días quedan comprometidos para una fecha futura y también se descuentan temporalmente del saldo disponible.

                </div>

            </div>


            <div class="vacation-detail-footer">

                <div>

                    <span class="vacation-detail-help">
                        Los campos marcados con * son obligatorios.
                    </span>

                </div>


                <div class="vacation-detail-footer-actions">

                    <a
                        href="{{ route('trabajadores.show', $trabajador) }}"
                        class="vacation-detail-cancel"
                    >
                        Cancelar
                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Guardar detalle
                    </button>

                </div>

            </div>

        </form>

    </section>

@endsection