@extends('layouts.app')

@section('title', 'Editar horario')

@section('topbar_title', 'Editar horario')

@push('styles')
<style>
    .horario-edit-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 24px;
    }

    .horario-edit-title {
        margin: 0;
        color: #172033;
        font-size: 27px;
        line-height: 1.2;
        font-weight: 700;
        letter-spacing: -.025em;
    }

    .horario-edit-subtitle {
        margin: 7px 0 0;
        color: #667085;
        font-size: 13px;
    }

    .horario-edit-actions {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-shrink: 0;
    }

    .horario-edit-action {
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

    .horario-edit-action:hover {
        background: #f5f8fb;
        border-color: #cbd7e3;
        color: #155a91;
    }

    .horario-edit-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(16, 47, 80, .05);
        overflow: hidden;
    }

    .horario-edit-card-header {
        padding: 18px 20px;
        border-bottom: 1px solid #edf1f5;
    }

    .horario-edit-card-title {
        margin: 0;
        color: #172033;
        font-size: 14px;
        font-weight: 700;
    }

    .horario-edit-card-description {
        margin: 4px 0 0;
        color: #98a2b3;
        font-size: 10px;
    }

    .horario-edit-worker {
        margin-top: 12px;
        padding: 10px 12px;
        border: 1px solid #e2e8f0;
        border-radius: 7px;
        background: #f8fafc;
        color: #344054;
        font-size: 11px;
    }

    .horario-edit-worker strong {
        color: #172033;
        font-weight: 700;
    }

    .horario-edit-form {
        padding: 20px;
    }

    .horario-edit-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
    }

    .horario-edit-field {
        min-width: 0;
    }

    .horario-edit-field-full {
        grid-column: 1 / -1;
    }

    .horario-edit-label {
        display: block;
        margin-bottom: 6px;
        color: #344054;
        font-size: 10px;
        font-weight: 700;
    }

    .horario-edit-required {
        color: #b9382e;
    }

    .horario-edit-input,
    .horario-edit-select,
    .horario-edit-textarea {
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

    .horario-edit-input,
    .horario-edit-select {
        min-height: 38px;
        padding: 8px 10px;
    }

    .horario-edit-textarea {
        min-height: 105px;
        padding: 10px;
        resize: vertical;
        line-height: 1.5;
    }

    .horario-edit-input:focus,
    .horario-edit-select:focus,
    .horario-edit-textarea:focus {
        border-color: #8db5d2;
        box-shadow: 0 0 0 3px rgba(21, 90, 145, .08);
    }

    .horario-edit-input[readonly] {
        background: #f5f8fb;
        color: #155a91;
        font-weight: 700;
        cursor: not-allowed;
    }

    .horario-edit-help {
        margin-top: 5px;
        color: #98a2b3;
        font-size: 9px;
        line-height: 1.4;
    }

    .horario-edit-error {
        margin-top: 5px;
        color: #b9382e;
        font-size: 9px;
    }

    .horario-edit-alert {
        margin-bottom: 18px;
        padding: 11px 14px;
        border: 1px solid #f0c8c3;
        border-radius: 7px;
        background: #fff5f3;
        color: #b9382e;
        font-size: 10px;
    }

    .horario-edit-info {
        grid-column: 1 / -1;
        padding: 12px 14px;
        border: 1px solid #dce8f1;
        border-radius: 7px;
        background: #f5f9fc;
        color: #667085;
        font-size: 9px;
        line-height: 1.5;
    }

    .horario-edit-info strong {
        color: #344054;
    }

    .horario-edit-footer {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 8px;
        margin-top: 22px;
        padding-top: 18px;
        border-top: 1px solid #edf1f5;
    }

    .horario-edit-button,
    .horario-edit-delete,
    .horario-edit-cancel {
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

    .horario-edit-button {
        border: 1px solid #155a91;
        background: #155a91;
        color: #ffffff;
        cursor: pointer;
    }

    .horario-edit-button:hover {
        background: #124d7d;
        border-color: #124d7d;
    }

    .horario-edit-cancel {
        border: 1px solid #dce3eb;
        background: #ffffff;
        color: #344054;
    }

    .horario-edit-cancel:hover {
        background: #f5f8fb;
        color: #155a91;
    }

    .horario-edit-delete {
        margin-right: auto;
        border: 1px solid #efc9c5;
        background: #fff5f3;
        color: #b9382e;
        cursor: pointer;
    }

    .horario-edit-delete:hover {
        background: #feecea;
        border-color: #eab8b2;
    }

    @media (max-width: 700px) {
        .horario-edit-header {
            flex-direction: column;
        }

        .horario-edit-actions {
            width: 100%;
        }

        .horario-edit-actions .horario-edit-action {
            flex: 1;
        }

        .horario-edit-grid {
            grid-template-columns: 1fr;
        }

        .horario-edit-field-full,
        .horario-edit-info {
            grid-column: auto;
        }

        .horario-edit-footer {
            flex-direction: column-reverse;
            align-items: stretch;
        }

        .horario-edit-footer button,
        .horario-edit-footer a {
            width: 100%;
            margin-right: 0;
        }
    }
</style>
@endpush

@section('content')

    <div class="horario-edit-header">

        <div>

            <h1 class="horario-edit-title">
                Editar horario
            </h1>

            <p class="horario-edit-subtitle">
                Modifica la información del horario registrado.
            </p>

        </div>

        <div class="horario-edit-actions">

            <a
                href="{{ route('trabajadores.show', $trabajador) }}"
                class="horario-edit-action"
            >
                ← Volver a la ficha
            </a>

        </div>

    </div>

    @if($errors->any())

        <div class="horario-edit-alert">

            <strong>
                No se pudo actualizar el horario.
            </strong>

            Revisa los campos marcados e inténtalo nuevamente.

        </div>

    @endif

    <section class="horario-edit-card">

        <div class="horario-edit-card-header">

            <h2 class="horario-edit-card-title">
                Datos del horario
            </h2>

            <p class="horario-edit-card-description">
                Actualiza la jornada, horas y estado del horario.
            </p>

            <div class="horario-edit-worker">

                Trabajador:

                <strong>
                    {{ $trabajador->nombre }}
                </strong>

                · RUT {{ $trabajador->rut }}

            </div>

        </div>

        <form
            id="horario-update-form"
            action="{{ route(
                'trabajadores.horarios.update',
                [
                    'trabajador' => $trabajador,
                    'horario' => $horario,
                ]
            ) }}"
            method="POST"
            class="horario-edit-form"
        >

            @csrf
            @method('PUT')

            <div class="horario-edit-grid">

                {{-- TIPO --}}
                <div class="horario-edit-field">

                    <label
                        for="tipo"
                        class="horario-edit-label"
                    >
                        Tipo de horario
                        <span class="horario-edit-required">*</span>
                    </label>

                    <select
                        id="tipo"
                        name="tipo"
                        class="horario-edit-select"
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
                                {{ old('tipo', $horario->tipo) === $tipo ? 'selected' : '' }}
                            >
                                {{ $tipo }}
                            </option>
                        @endforeach

                    </select>

                    @error('tipo')
                        <div class="horario-edit-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                {{-- DÍA --}}
                <div class="horario-edit-field">

                    <label
                        for="dia"
                        class="horario-edit-label"
                    >
                        Día
                        <span class="horario-edit-required">*</span>
                    </label>

                    <select
                        id="dia"
                        name="dia"
                        class="horario-edit-select"
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
                                {{ old('dia', $horario->dia) === $dia ? 'selected' : '' }}
                            >
                                {{ $dia }}
                            </option>
                        @endforeach

                    </select>

                    @error('dia')
                        <div class="horario-edit-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                {{-- HORA INICIO --}}
                <div class="horario-edit-field">

                    <label
                        for="hora_inicio"
                        class="horario-edit-label"
                    >
                        Hora de inicio
                    </label>

                    <input
                        type="time"
                        id="hora_inicio"
                        name="hora_inicio"
                        class="horario-edit-input"
                        value="{{ old(
                            'hora_inicio',
                            $horario->hora_inicio
                        ) }}"
                    >

                    @error('hora_inicio')
                        <div class="horario-edit-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                {{-- HORA TÉRMINO --}}
                <div class="horario-edit-field">

                    <label
                        for="hora_termino"
                        class="horario-edit-label"
                    >
                        Hora de término
                    </label>

                    <input
                        type="time"
                        id="hora_termino"
                        name="hora_termino"
                        class="horario-edit-input"
                        value="{{ old(
                            'hora_termino',
                            $horario->hora_termino
                        ) }}"
                    >

                    @error('hora_termino')
                        <div class="horario-edit-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                {{-- HORAS DIARIAS --}}
                <div class="horario-edit-field">

                    <label
                        for="horas_diarias"
                        class="horario-edit-label"
                    >
                        Horas diarias
                    </label>

                    <input
                        type="number"
                        id="horas_diarias"
                        name="horas_diarias"
                        class="horario-edit-input"
                        value="{{ old(
                            'horas_diarias',
                            $horario->horas_diarias
                        ) }}"
                        min="0"
                        max="24"
                        step="0.1"
                        placeholder="Ej. 8,0"
                    >

                    <div class="horario-edit-help">
                        Se calculan automáticamente cuando se ingresan hora de inicio y término.
                    </div>

                    @error('horas_diarias')
                        <div class="horario-edit-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                {{-- HORAS SEMANALES --}}
                <div class="horario-edit-field">

                    <label
                        for="horas_semanales"
                        class="horario-edit-label"
                    >
                        Horas semanales
                    </label>

                    <input
                        type="number"
                        id="horas_semanales"
                        name="horas_semanales"
                        class="horario-edit-input"
                        value="{{ old(
                            'horas_semanales',
                            $horario->horas_semanales
                        ) }}"
                        min="0"
                        max="168"
                        step="0.1"
                        placeholder="Ej. 40,0"
                    >

                    <div class="horario-edit-help">
                        Se calculan automáticamente para lunes a viernes o lunes a sábado.
                    </div>

                    @error('horas_semanales')
                        <div class="horario-edit-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                {{-- HORAS MENSUALES --}}
                <div class="horario-edit-field">

                    <label
                        for="horas_mensuales"
                        class="horario-edit-label"
                    >
                        Horas mensuales
                    </label>

                    <input
                        type="number"
                        id="horas_mensuales"
                        name="horas_mensuales"
                        class="horario-edit-input"
                        value="{{ old(
                            'horas_mensuales',
                            $horario->horas_mensuales
                        ) }}"
                        min="0"
                        max="744"
                        step="0.1"
                        placeholder="Ej. 173,3"
                    >

                    <div class="horario-edit-help">
                        Promedio mensual calculado según las horas semanales.
                    </div>

                    @error('horas_mensuales')
                        <div class="horario-edit-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                {{-- ESTADO --}}
                <div class="horario-edit-field">

                    <label
                        for="estado"
                        class="horario-edit-label"
                    >
                        Estado
                        <span class="horario-edit-required">*</span>
                    </label>

                    <select
                        id="estado"
                        name="estado"
                        class="horario-edit-select"
                        required
                    >
                        <option
                            value="vigente"
                            {{ old('estado', $horario->estado) === 'vigente' ? 'selected' : '' }}
                        >
                            Vigente
                        </option>

                        <option
                            value="inactivo"
                            {{ old('estado', $horario->estado) === 'inactivo' ? 'selected' : '' }}
                        >
                            Inactivo
                        </option>

                        <option
                            value="histórico"
                            {{ old('estado', $horario->estado) === 'histórico' ? 'selected' : '' }}
                        >
                            Histórico
                        </option>
                    </select>

                    @error('estado')
                        <div class="horario-edit-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                {{-- INFORMACIÓN --}}
                <div class="horario-edit-info">

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
                <div class="horario-edit-field horario-edit-field-full">

                    <label
                        for="observaciones"
                        class="horario-edit-label"
                    >
                        Observaciones
                    </label>

                    <textarea
                        id="observaciones"
                        name="observaciones"
                        class="horario-edit-textarea"
                        placeholder="Información adicional sobre el horario..."
                    >{{ old(
                        'observaciones',
                        $horario->observaciones
                    ) }}</textarea>

                    @error('observaciones')
                        <div class="horario-edit-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

            </div>

        </form>

        <div class="horario-edit-footer">

            <form
                action="{{ route(
                    'trabajadores.horarios.destroy',
                    [
                        'trabajador' => $trabajador,
                        'horario' => $horario,
                    ]
                ) }}"
                method="POST"
                onsubmit="return confirm('¿Estás seguro de eliminar este horario? Esta acción no se puede deshacer.');"
            >

                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="horario-edit-delete"
                >
                    Eliminar horario
                </button>

            </form>

            <a
                href="{{ route('trabajadores.show', $trabajador) }}"
                class="horario-edit-cancel"
            >
                Cancelar
            </a>

            <button
                type="submit"
                form="horario-update-form"
                class="horario-edit-button"
            >
                Guardar cambios
            </button>

        </div>

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

            const valor =
                parseFloat(horasSemanales.value);

            if (!isNaN(valor)) {
                horasSemanales.value =
                    valor.toFixed(1);
            }
        }

    });

    horasMensuales.addEventListener('input', function () {

        if (diasAutomaticos[dia.value] === undefined) {

            const valor =
                parseFloat(horasMensuales.value);

            if (!isNaN(valor)) {
                horasMensuales.value =
                    valor.toFixed(1);
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