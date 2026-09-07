@extends('layouts.app')

@section('title', 'Nuevo horario')

@section('topbar_title', 'Nuevo horario')

@push('styles')
<style>
    .horario-create-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 24px;
    }

    .horario-create-title {
        margin: 0;
        color: #172033;
        font-size: 27px;
        line-height: 1.2;
        font-weight: 700;
        letter-spacing: -.025em;
    }

    .horario-create-subtitle {
        margin: 7px 0 0;
        color: #667085;
        font-size: 13px;
    }

    .horario-create-actions {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-shrink: 0;
    }

    .horario-create-action {
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

    .horario-create-action:hover {
        background: #f5f8fb;
        border-color: #cbd7e3;
        color: #155a91;
    }

    .horario-create-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(16, 47, 80, .05);
        overflow: hidden;
    }

    .horario-create-card-header {
        padding: 18px 20px;
        border-bottom: 1px solid #edf1f5;
    }

    .horario-create-card-title {
        margin: 0;
        color: #172033;
        font-size: 14px;
        font-weight: 700;
    }

    .horario-create-card-description {
        margin: 4px 0 0;
        color: #98a2b3;
        font-size: 10px;
    }

    .horario-create-worker {
        margin-top: 12px;
        padding: 10px 12px;
        border: 1px solid #e2e8f0;
        border-radius: 7px;
        background: #f8fafc;
        color: #344054;
        font-size: 11px;
    }

    .horario-create-worker strong {
        color: #172033;
        font-weight: 700;
    }

    .horario-create-form {
        padding: 20px;
    }

    .horario-create-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
    }

    .horario-create-field {
        min-width: 0;
    }

    .horario-create-field-full {
        grid-column: 1 / -1;
    }

    .horario-create-label {
        display: block;
        margin-bottom: 6px;
        color: #344054;
        font-size: 10px;
        font-weight: 700;
    }

    .horario-create-required {
        color: #b9382e;
    }

    .horario-create-input,
    .horario-create-select,
    .horario-create-textarea {
        width: 100%;
        box-sizing: border-box;
        border: 1px solid #dce3eb;
        border-radius: 6px;
        background: #ffffff;
        color: #344054;
        font-family: inherit;
        font-size: 11px;
        outline: none;
        transition:
            border-color .15s ease,
            box-shadow .15s ease;
    }

    .horario-create-input,
    .horario-create-select {
        min-height: 38px;
        padding: 8px 10px;
    }

    .horario-create-textarea {
        min-height: 105px;
        padding: 10px;
        resize: vertical;
        line-height: 1.5;
    }

    .horario-create-input:focus,
    .horario-create-select:focus,
    .horario-create-textarea:focus {
        border-color: #8db5d2;
        box-shadow: 0 0 0 3px rgba(21, 90, 145, .08);
    }

    .horario-create-input[readonly] {
        background: #f5f8fb;
        color: #155a91;
        font-weight: 700;
        cursor: not-allowed;
    }

    .horario-create-help {
        margin-top: 5px;
        color: #98a2b3;
        font-size: 9px;
        line-height: 1.4;
    }

    .horario-create-error {
        margin-top: 5px;
        color: #b9382e;
        font-size: 9px;
    }

    .horario-create-alert {
        margin-bottom: 18px;
        padding: 11px 14px;
        border: 1px solid #f0c8c3;
        border-radius: 7px;
        background: #fff5f3;
        color: #b9382e;
        font-size: 10px;
    }

    .horario-create-info {
        grid-column: 1 / -1;
        padding: 12px 14px;
        border: 1px solid #dce8f1;
        border-radius: 7px;
        background: #f5f9fc;
        color: #667085;
        font-size: 9px;
        line-height: 1.5;
    }

    .horario-create-info strong {
        color: #344054;
    }

    .horario-create-footer {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 8px;
        margin-top: 22px;
        padding-top: 18px;
        border-top: 1px solid #edf1f5;
    }

    .horario-create-button,
    .horario-create-cancel {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 36px;
        padding: 8px 15px;
        border-radius: 6px;
        font-family: inherit;
        font-size: 10px;
        font-weight: 600;
        text-decoration: none;
        box-sizing: border-box;
    }

    .horario-create-button {
        border: 1px solid #155a91;
        background: #155a91;
        color: #ffffff;
        cursor: pointer;
    }

    .horario-create-button:hover {
        background: #124d7d;
        border-color: #124d7d;
    }

    .horario-create-cancel {
        border: 1px solid #dce3eb;
        background: #ffffff;
        color: #344054;
    }

    .horario-create-cancel:hover {
        background: #f5f8fb;
        color: #155a91;
    }

    @media (max-width: 700px) {
        .horario-create-header {
            flex-direction: column;
        }

        .horario-create-actions {
            width: 100%;
        }

        .horario-create-actions .horario-create-action {
            flex: 1;
        }

        .horario-create-grid {
            grid-template-columns: 1fr;
        }

        .horario-create-field-full,
        .horario-create-info {
            grid-column: auto;
        }

        .horario-create-footer {
            flex-direction: column-reverse;
        }

        .horario-create-footer a,
        .horario-create-footer button {
            width: 100%;
        }
    }
</style>
@endpush

@section('content')

    <div class="horario-create-header">
        <div>
            <h1 class="horario-create-title">
                Nuevo horario
            </h1>

            <p class="horario-create-subtitle">
                Registra el horario laboral correspondiente al trabajador.
            </p>
        </div>

        <div class="horario-create-actions">
            <a
                href="{{ route('trabajadores.show', $trabajador) }}"
                class="horario-create-action"
            >
                ← Volver a la ficha
            </a>
        </div>
    </div>

    @if($errors->any())
        <div class="horario-create-alert">
            <strong>
                No se pudo guardar el horario.
            </strong>

            Revisa los campos marcados e inténtalo nuevamente.
        </div>
    @endif

    <section class="horario-create-card">

        <div class="horario-create-card-header">

            <h2 class="horario-create-card-title">
                Datos del horario
            </h2>

            <p class="horario-create-card-description">
                Define el tipo de jornada, días, horas y estado del horario.
            </p>

            <div class="horario-create-worker">
                Trabajador:

                <strong>
                    {{ $trabajador->nombre }}
                </strong>

                · RUT {{ $trabajador->rut }}
            </div>

        </div>

        <form
            action="{{ route('trabajadores.horarios.store', $trabajador) }}"
            method="POST"
            class="horario-create-form"
            id="horario-create-form"
        >

            @csrf

            <div class="horario-create-grid">

                {{-- TIPO --}}
                <div class="horario-create-field">

                    <label
                        for="tipo"
                        class="horario-create-label"
                    >
                        Tipo de horario
                        <span class="horario-create-required">*</span>
                    </label>

                    <select
                        id="tipo"
                        name="tipo"
                        class="horario-create-select"
                        required
                    >
                        <option value="">
                            Seleccionar tipo
                        </option>

                        @foreach([
                            'Jornada completa',
                            'Jornada parcial',
                            'Turno',
                            'Flexible',
                            'Otro'
                        ] as $tipo)
                            <option
                                value="{{ $tipo }}"
                                {{ old('tipo') === $tipo ? 'selected' : '' }}
                            >
                                {{ $tipo }}
                            </option>
                        @endforeach

                    </select>

                    @error('tipo')
                        <div class="horario-create-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                {{-- DÍA --}}
                <div class="horario-create-field">

                    <label
                        for="dia"
                        class="horario-create-label"
                    >
                        Día
                        <span class="horario-create-required">*</span>
                    </label>

                    <select
                        id="dia"
                        name="dia"
                        class="horario-create-select"
                        required
                    >
                        <option value="">
                            Seleccionar día
                        </option>

                        @foreach([
                            'Lunes',
                            'Martes',
                            'Miércoles',
                            'Jueves',
                            'Viernes',
                            'Sábado',
                            'Domingo',
                            'Lunes a viernes',
                            'Lunes a sábado'
                        ] as $dia)
                            <option
                                value="{{ $dia }}"
                                {{ old('dia') === $dia ? 'selected' : '' }}
                            >
                                {{ $dia }}
                            </option>
                        @endforeach

                    </select>

                    @error('dia')
                        <div class="horario-create-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                {{-- HORA INICIO --}}
                <div class="horario-create-field">

                    <label
                        for="hora_inicio"
                        class="horario-create-label"
                    >
                        Hora de inicio
                    </label>

                    <input
                        type="time"
                        id="hora_inicio"
                        name="hora_inicio"
                        class="horario-create-input"
                        value="{{ old('hora_inicio') }}"
                    >

                    @error('hora_inicio')
                        <div class="horario-create-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                {{-- HORA TÉRMINO --}}
                <div class="horario-create-field">

                    <label
                        for="hora_termino"
                        class="horario-create-label"
                    >
                        Hora de término
                    </label>

                    <input
                        type="time"
                        id="hora_termino"
                        name="hora_termino"
                        class="horario-create-input"
                        value="{{ old('hora_termino') }}"
                    >

                    @error('hora_termino')
                        <div class="horario-create-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                {{-- HORAS DIARIAS --}}
                <div class="horario-create-field">

                    <label
                        for="horas_diarias"
                        class="horario-create-label"
                    >
                        Horas diarias
                    </label>

                    <input
                        type="number"
                        id="horas_diarias"
                        name="horas_diarias"
                        class="horario-create-input"
                        value="{{ old('horas_diarias') }}"
                        min="0"
                        max="24"
                        step="0.1"
                        placeholder="Ej. 8,0"
                    >

                    <div class="horario-create-help">
                        Se calculan automáticamente cuando se ingresan hora de inicio y término.
                    </div>

                    @error('horas_diarias')
                        <div class="horario-create-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                {{-- HORAS SEMANALES --}}
                <div class="horario-create-field">

                    <label
                        for="horas_semanales"
                        class="horario-create-label"
                    >
                        Horas semanales
                    </label>

                    <input
                        type="number"
                        id="horas_semanales"
                        name="horas_semanales"
                        class="horario-create-input"
                        value="{{ old('horas_semanales') }}"
                        min="0"
                        max="168"
                        step="0.1"
                        placeholder="Ej. 40,0"
                    >

                    <div class="horario-create-help">
                        Se calculan automáticamente para lunes a viernes o lunes a sábado.
                    </div>

                    @error('horas_semanales')
                        <div class="horario-create-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                {{-- HORAS MENSUALES --}}
                <div class="horario-create-field">

                    <label
                        for="horas_mensuales"
                        class="horario-create-label"
                    >
                        Horas mensuales
                    </label>

                    <input
                        type="number"
                        id="horas_mensuales"
                        name="horas_mensuales"
                        class="horario-create-input"
                        value="{{ old('horas_mensuales') }}"
                        min="0"
                        max="744"
                        step="0.1"
                        placeholder="Ej. 173,3"
                    >

                    <div class="horario-create-help">
                        Promedio mensual calculado según las horas semanales.
                    </div>

                    @error('horas_mensuales')
                        <div class="horario-create-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                {{-- ESTADO --}}
                <div class="horario-create-field">

                    <label
                        for="estado"
                        class="horario-create-label"
                    >
                        Estado
                        <span class="horario-create-required">*</span>
                    </label>

                    <select
                        id="estado"
                        name="estado"
                        class="horario-create-select"
                        required
                    >
                        <option
                            value="vigente"
                            {{ old('estado', 'vigente') === 'vigente' ? 'selected' : '' }}
                        >
                            Vigente
                        </option>

                        <option
                            value="inactivo"
                            {{ old('estado') === 'inactivo' ? 'selected' : '' }}
                        >
                            Inactivo
                        </option>

                        <option
                            value="histórico"
                            {{ old('estado') === 'histórico' ? 'selected' : '' }}
                        >
                            Histórico
                        </option>
                    </select>

                    @error('estado')
                        <div class="horario-create-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                {{-- INFORMACIÓN --}}
                <div class="horario-create-info">

                    <strong>
                        Cálculo automático:
                    </strong>

                    Para
                    <strong>Lunes a viernes</strong>
                    se consideran 5 días.

                    Para
                    <strong>Lunes a sábado</strong>
                    se consideran 6 días.

                    Si se selecciona un día individual,
                    las horas semanales y mensuales pueden
                    registrarse manualmente.

                </div>

                {{-- OBSERVACIONES --}}
                <div class="horario-create-field horario-create-field-full">

                    <label
                        for="observaciones"
                        class="horario-create-label"
                    >
                        Observaciones
                    </label>

                    <textarea
                        id="observaciones"
                        name="observaciones"
                        class="horario-create-textarea"
                        placeholder="Información adicional sobre el horario..."
                    >{{ old('observaciones') }}</textarea>

                    @error('observaciones')
                        <div class="horario-create-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

            </div>

            <div class="horario-create-footer">

                <a
                    href="{{ route('trabajadores.show', $trabajador) }}"
                    class="horario-create-cancel"
                >
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="horario-create-button"
                >
                    Guardar horario
                </button>

            </div>

        </form>

    </section>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const dia = document.getElementById('dia');
    const horaInicio = document.getElementById('hora_inicio');
    const horaTermino = document.getElementById('hora_termino');

    const horasDiarias = document.getElementById('horas_diarias');
    const horasSemanales = document.getElementById('horas_semanales');
    const horasMensuales = document.getElementById('horas_mensuales');

    const diasAutomaticos = {
        'Lunes a viernes': 5,
        'Lunes a sábado': 6
    };

    function calcularHorasDiarias() {

        if (!horaInicio.value || !horaTermino.value) {
            return null;
        }

        const inicio = horaInicio.value.split(':');
        const termino = horaTermino.value.split(':');

        const inicioMinutos =
            parseInt(inicio[0], 10) * 60 +
            parseInt(inicio[1], 10);

        const terminoMinutos =
            parseInt(termino[0], 10) * 60 +
            parseInt(termino[1], 10);

        if (terminoMinutos <= inicioMinutos) {
            return null;
        }

        return (terminoMinutos - inicioMinutos) / 60;
    }

    function actualizarCalculos() {

        const horasCalculadas = calcularHorasDiarias();

        if (horasCalculadas !== null) {
            horasDiarias.value = horasCalculadas.toFixed(1);
        }

        const cantidadDias = diasAutomaticos[dia.value] ?? null;

        if (cantidadDias === null) {

            horasSemanales.readOnly = false;
            horasMensuales.readOnly = false;

            horasSemanales.style.backgroundColor = '';
            horasMensuales.style.backgroundColor = '';

            return;
        }

        horasSemanales.readOnly = true;
        horasMensuales.readOnly = true;

        const horasDiariasNumero =
            parseFloat(horasDiarias.value) || 0;

        const semanal =
            horasDiariasNumero * cantidadDias;

        const mensual =
            semanal * 52 / 12;

        horasSemanales.value =
            semanal.toFixed(1);

        horasMensuales.value =
            mensual.toFixed(1);
    }

    horasDiarias.addEventListener('input', function () {

        if (diasAutomaticos[dia.value] !== undefined) {
            actualizarCalculos();
        }

    });

    horasSemanales.addEventListener('input', function () {

        if (diasAutomaticos[dia.value] === undefined) {
            const valor = parseFloat(horasSemanales.value);

            if (!isNaN(valor)) {
                horasSemanales.value = valor.toFixed(1);
            }
        }

    });

    horasMensuales.addEventListener('input', function () {

        if (diasAutomaticos[dia.value] === undefined) {
            const valor = parseFloat(horasMensuales.value);

            if (!isNaN(valor)) {
                horasMensuales.value = valor.toFixed(1);
            }
        }

    });

    dia.addEventListener('change', actualizarCalculos);
    horaInicio.addEventListener('change', actualizarCalculos);
    horaTermino.addEventListener('change', actualizarCalculos);

    actualizarCalculos();
});
</script>
@endpush