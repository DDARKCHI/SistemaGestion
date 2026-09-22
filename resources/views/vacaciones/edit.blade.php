@extends('layouts.app')

@section('title', 'Editar período de vacaciones')

@section('topbar_title', 'Vacaciones')

@push('styles')

<style>

    .vacation-form-header {
        margin-bottom: 24px;
    }

    .vacation-form-title {
        margin: 0;
        color: #172033;
        font-size: 27px;
        line-height: 1.2;
        font-weight: 700;
        letter-spacing: -.025em;
    }

    .vacation-form-subtitle {
        margin: 7px 0 0;
        color: #667085;
        font-size: 13px;
    }

    .vacation-worker-card {
        margin-bottom: 18px;
        padding: 14px 16px;
        border: 1px solid #d4e5f2;
        border-radius: 8px;
        background: #f7fbfe;
    }

    .vacation-worker-label {
        color: #98a2b3;
        font-size: 9px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .03em;
    }

    .vacation-worker-name {
        margin-top: 4px;
        color: #155a91;
        font-size: 13px;
        font-weight: 700;
    }

    .vacation-worker-rut {
        margin-top: 3px;
        color: #667085;
        font-size: 10px;
    }

    .vacation-form-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(16,47,80,.05);
        overflow: hidden;
    }

    .vacation-form-card-header {
        padding: 17px 20px;
        border-bottom: 1px solid #edf1f5;
    }

    .vacation-form-card-title {
        margin: 0;
        color: #172033;
        font-size: 14px;
        font-weight: 700;
    }

    .vacation-form-card-description {
        margin: 4px 0 0;
        color: #98a2b3;
        font-size: 10px;
    }

    .vacation-form-body {
        padding: 22px 20px;
    }

    .vacation-summary {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
        margin-bottom: 20px;
    }

    .vacation-summary-item {
        padding: 13px 14px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        background: #fbfcfd;
    }

    .vacation-summary-label {
        color: #98a2b3;
        font-size: 9px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .vacation-summary-value {
        margin-top: 5px;
        color: #172033;
        font-size: 17px;
        font-weight: 700;
    }

    .vacation-form-grid {
        display: grid;
        grid-template-columns:
            repeat(2, minmax(0, 1fr));
        gap: 18px;
    }

    .vacation-form-group {
        min-width: 0;
    }

    .vacation-form-group-full {
        grid-column: 1 / -1;
    }

    .vacation-form-label {
        display: block;
        margin-bottom: 7px;
        color: #344054;
        font-size: 11px;
        font-weight: 600;
    }

    .vacation-form-required {
        color: #b9382e;
    }

    .vacation-form-input {
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

    .vacation-form-input:focus {
        border-color: #155a91;
        box-shadow:
            0 0 0 3px rgba(21,90,145,.08);
    }

    textarea.vacation-form-input {
        min-height: 105px;
        resize: vertical;
        line-height: 1.5;
    }

    .vacation-form-help {
        margin-top: 5px;
        color: #98a2b3;
        font-size: 9px;
        line-height: 1.4;
    }

    .vacation-form-error {
        margin-top: 5px;
        color: #b9382e;
        font-size: 9px;
    }

    .vacation-form-alert {
        margin-bottom: 18px;
        padding: 11px 14px;
        border: 1px solid #f0d3cf;
        border-radius: 7px;
        background: #fff7f5;
        color: #a52f26;
        font-size: 11px;
    }

    .vacation-form-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 15px 20px;
        border-top: 1px solid #edf1f5;
        background: #fbfcfd;
    }

    .vacation-form-footer-actions {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .vacation-form-cancel {
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

    .vacation-form-cancel:hover {
        background: #f5f8fb;
        border-color: #cbd7e3;
    }

    @media (max-width: 700px) {

        .vacation-summary,
        .vacation-form-grid {
            grid-template-columns: 1fr;
        }

        .vacation-form-group-full {
            grid-column: auto;
        }

        .vacation-form-footer {
            align-items: stretch;
            flex-direction: column;
        }

        .vacation-form-footer-actions {
            width: 100%;
        }

        .vacation-form-footer-actions .btn,
        .vacation-form-footer-actions .vacation-form-cancel {
            flex: 1;
        }

    }

</style>

@endpush


@section('content')

    <div class="vacation-form-header">

        <h1 class="vacation-form-title">
            Editar período de vacaciones
        </h1>

        <p class="vacation-form-subtitle">
            Modifica la información general del período de vacaciones.
        </p>

    </div>


    <div class="vacation-worker-card">

        <div class="vacation-worker-label">
            Trabajador
        </div>

        <div class="vacation-worker-name">
            {{ $trabajador->nombre }}
        </div>

        <div class="vacation-worker-rut">
            RUT: {{ $trabajador->rut }}
        </div>

    </div>


    @if($errors->any())

        <div class="vacation-form-alert">
            Revisa los datos ingresados. Hay campos que requieren corrección.
        </div>

    @endif


    <section class="vacation-form-card">

        <div class="vacation-form-card-header">

            <h2 class="vacation-form-card-title">
                Información del período
            </h2>

            <p class="vacation-form-card-description">
                Los días utilizados y reservados se mantienen asociados al período.
            </p>

        </div>


        <form
            action="{{ route('trabajadores.vacaciones.update', [$trabajador, $vacacion]) }}"
            method="POST"
        >

            @csrf
            @method('PUT')


            <div class="vacation-form-body">

                <div class="vacation-summary">

                    <div class="vacation-summary-item">

                        <div class="vacation-summary-label">
                            Días tomados
                        </div>

                        <div class="vacation-summary-value">
                            {{ rtrim(rtrim(number_format((float) $vacacion->dias_tomados, 2, '.', ''), '0'), '.') }}
                        </div>

                    </div>


                    <div class="vacation-summary-item">

                        <div class="vacation-summary-label">
                            Días reservados
                        </div>

                        <div class="vacation-summary-value">
                            {{ rtrim(rtrim(number_format((float) $vacacion->dias_reservados, 2, '.', ''), '0'), '.') }}
                        </div>

                    </div>


                    <div class="vacation-summary-item">

                        <div class="vacation-summary-label">
                            Días restantes
                        </div>

                        <div class="vacation-summary-value">
                            {{ rtrim(rtrim(number_format((float) $vacacion->dias_restantes, 2, '.', ''), '0'), '.') }}
                        </div>

                    </div>

                </div>


                <div class="vacation-form-grid">

                    <div class="vacation-form-group">

                        <label
                            for="periodo"
                            class="vacation-form-label"
                        >
                            Período
                            <span class="vacation-form-required">*</span>
                        </label>

                        <input
                            type="text"
                            id="periodo"
                            name="periodo"
                            class="vacation-form-input"
                            value="{{ old('periodo', $vacacion->periodo) }}"
                            maxlength="255"
                            required
                            autofocus
                        >

                        @error('periodo')

                            <div class="vacation-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <div class="vacation-form-group">

                        <label
                            for="dias_correspondientes"
                            class="vacation-form-label"
                        >
                            Días correspondientes
                            <span class="vacation-form-required">*</span>
                        </label>

                        <input
                            type="number"
                            id="dias_correspondientes"
                            name="dias_correspondientes"
                            class="vacation-form-input"
                            value="{{ old('dias_correspondientes', rtrim(rtrim(number_format((float) $vacacion->dias_correspondientes, 2, '.', ''), '0'), '.')) }}"
                            min="0"
                            step="0.5"
                            required
                        >

                        <div class="vacation-form-help">
                            Los días restantes se recalcularán automáticamente.
                        </div>

                        @error('dias_correspondientes')

                            <div class="vacation-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <div class="vacation-form-group vacation-form-group-full">

                        <label
                            for="observaciones"
                            class="vacation-form-label"
                        >
                            Observaciones
                        </label>

                        <textarea
                            id="observaciones"
                            name="observaciones"
                            class="vacation-form-input"
                            placeholder="Información adicional..."
                        >{{ old('observaciones', $vacacion->observaciones) }}</textarea>

                        @error('observaciones')

                            <div class="vacation-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                </div>

            </div>


            <div class="vacation-form-footer">

                <div>

                    <span class="vacation-form-help">
                        Los campos marcados con * son obligatorios.
                    </span>

                </div>


                <div class="vacation-form-footer-actions">

                    <a
                        href="{{ route('trabajadores.show', $trabajador) }}"
                        class="vacation-form-cancel"
                    >
                        Cancelar
                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Guardar cambios
                    </button>

                </div>

            </div>

        </form>

    </section>

@endsection