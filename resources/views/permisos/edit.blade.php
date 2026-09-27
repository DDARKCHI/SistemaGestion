@extends('layouts.app')

@section('title', 'Editar permiso')

@section('topbar_title', 'Permisos')

@push('styles')

<style>
    .permission-form-header {
        margin-bottom: 24px;
    }

    .permission-form-title {
        margin: 0;
        color: #172033;
        font-size: 27px;
        line-height: 1.2;
        font-weight: 700;
        letter-spacing: -.025em;
    }

    .permission-form-subtitle {
        margin: 7px 0 0;
        color: #667085;
        font-size: 13px;
    }

    .permission-worker-card {
        margin-bottom: 18px;
        padding: 14px 16px;
        border: 1px solid #d4e5f2;
        border-radius: 8px;
        background: #f7fbfe;
    }

    .permission-worker-label {
        color: #98a2b3;
        font-size: 9px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .permission-worker-name {
        margin-top: 4px;
        color: #155a91;
        font-size: 13px;
        font-weight: 700;
    }

    .permission-worker-rut {
        margin-top: 3px;
        color: #667085;
        font-size: 10px;
    }

    .permission-form-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(16,47,80,.05);
        overflow: hidden;
    }

    .permission-form-card-header {
        padding: 17px 20px;
        border-bottom: 1px solid #edf1f5;
    }

    .permission-form-card-title {
        margin: 0;
        color: #172033;
        font-size: 14px;
        font-weight: 700;
    }

    .permission-form-card-description {
        margin: 4px 0 0;
        color: #98a2b3;
        font-size: 10px;
    }

    .permission-form-body {
        padding: 22px 20px;
    }

    .permission-form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
    }

    .permission-form-group-full {
        grid-column: 1 / -1;
    }

    .permission-form-label {
        display: block;
        margin-bottom: 7px;
        color: #344054;
        font-size: 11px;
        font-weight: 600;
    }

    .permission-form-required {
        color: #b9382e;
    }

    .permission-form-input {
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
    }

    .permission-form-input[readonly] {
        background: #f8fafc;
        color: #155a91;
        font-weight: 700;
    }

    textarea.permission-form-input {
        min-height: 105px;
        resize: vertical;
    }

    .permission-form-help {
        margin-top: 5px;
        color: #98a2b3;
        font-size: 9px;
    }

    .permission-form-error {
        margin-top: 5px;
        color: #b9382e;
        font-size: 9px;
    }

    .permission-form-alert {
        margin-bottom: 18px;
        padding: 11px 14px;
        border: 1px solid #f0d3cf;
        border-radius: 7px;
        background: #fff7f5;
        color: #a52f26;
        font-size: 11px;
    }

    .permission-form-info {
        margin-top: 18px;
        padding: 13px 15px;
        border: 1px solid #e2e8f0;
        border-radius: 7px;
        background: #fbfcfd;
        color: #667085;
        font-size: 10px;
    }

    .permission-form-footer {
        display: flex;
        justify-content: space-between;
        padding: 15px 20px;
        border-top: 1px solid #edf1f5;
        background: #fbfcfd;
    }

    .permission-form-footer-actions {
        display: flex;
        gap: 8px;
    }

    .permission-form-cancel {
        display: inline-flex;
        align-items: center;
        padding: 7px 13px;
        border: 1px solid #dce3eb;
        border-radius: 6px;
        color: #344054;
        font-size: 10px;
        font-weight: 600;
        text-decoration: none;
    }

    .permission-hour-fields {
        display: contents;
    }

    .permission-hour-fields.is-hidden {
        display: none;
    }

    @media (max-width: 700px) {
        .permission-form-grid {
            grid-template-columns: 1fr;
        }

        .permission-form-group-full {
            grid-column: auto;
        }

        .permission-form-footer {
            flex-direction: column;
            gap: 12px;
        }
    }
</style>

@endpush


@section('content')

<div class="permission-form-header">

    <h1 class="permission-form-title">
        Editar permiso
    </h1>

    <p class="permission-form-subtitle">
        Modifica la información registrada para este permiso.
    </p>

</div>


<div class="permission-worker-card">

    <div class="permission-worker-label">
        Trabajador
    </div>

    <div class="permission-worker-name">
        {{ $trabajador->nombre }}
    </div>

    <div class="permission-worker-rut">
        RUT: {{ $trabajador->rut }}
    </div>

</div>


@if($errors->any())

    <div class="permission-form-alert">
        Revisa los datos ingresados. Hay campos que requieren corrección antes de guardar los cambios.
    </div>

@endif


<section class="permission-form-card">

    <div class="permission-form-card-header">

        <h2 class="permission-form-card-title">
            Información del permiso
        </h2>

        <p class="permission-form-card-description">
            Actualiza el tipo de permiso, fechas, horarios y antecedentes registrados.
        </p>

    </div>


    <form
        action="{{ route(
            'trabajadores.permisos.update',
            [
                'trabajador' => $trabajador,
                'permiso' => $permiso,
            ]
        ) }}"
        method="POST"
    >

        @csrf
        @method('PUT')


        <div class="permission-form-body">

            <div class="permission-form-grid">

                <div>

                    <label
                        for="tipo"
                        class="permission-form-label"
                    >
                        Tipo
                        <span class="permission-form-required">*</span>
                    </label>

                    <select
                        id="tipo"
                        name="tipo"
                        class="permission-form-input"
                        required
                    >

                        <option
                            value="dia_completo"
                            {{ old('tipo', $permiso->tipo) === 'dia_completo' ? 'selected' : '' }}
                        >
                            Día completo
                        </option>

                        <option
                            value="horas"
                            {{ old('tipo', $permiso->tipo) === 'horas' ? 'selected' : '' }}
                        >
                            Por horas
                        </option>

                    </select>

                </div>


                <div>

                    <label
                        for="estado"
                        class="permission-form-label"
                    >
                        Estado
                        <span class="permission-form-required">*</span>
                    </label>

                    <select
                        id="estado"
                        name="estado"
                        class="permission-form-input"
                        required
                    >

                        <option
                            value="pendiente"
                            {{ old('estado', $permiso->estado) === 'pendiente' ? 'selected' : '' }}
                        >
                            Pendiente
                        </option>

                        <option
                            value="justificado"
                            {{ old('estado', $permiso->estado) === 'justificado' ? 'selected' : '' }}
                        >
                            Justificado
                        </option>

                        <option
                            value="injustificado"
                            {{ old('estado', $permiso->estado) === 'injustificado' ? 'selected' : '' }}
                        >
                            Injustificado
                        </option>

                    </select>

                </div>


                <div>

                    <label
                        for="fecha_inicio"
                        class="permission-form-label"
                    >
                        Fecha de inicio
                        <span class="permission-form-required">*</span>
                    </label>

                    <input
                        type="date"
                        id="fecha_inicio"
                        name="fecha_inicio"
                        class="permission-form-input"
                        value="{{ old(
                            'fecha_inicio',
                            $permiso->fecha_inicio
                                ? $permiso->fecha_inicio->format('Y-m-d')
                                : ''
                        ) }}"
                        required
                    >

                </div>


                <div>

                    <label
                        for="fecha_termino"
                        class="permission-form-label"
                    >
                        Fecha de término
                    </label>

                    <input
                        type="date"
                        id="fecha_termino"
                        name="fecha_termino"
                        class="permission-form-input"
                        value="{{ old(
                            'fecha_termino',
                            $permiso->fecha_termino
                                ? $permiso->fecha_termino->format('Y-m-d')
                                : ''
                        ) }}"
                    >

                    <div class="permission-form-help">
                        Si queda vacía, se considera la misma fecha de inicio.
                    </div>

                </div>


                <div
                    id="permission-hour-fields"
                    class="permission-hour-fields {{ old('tipo', $permiso->tipo) === 'horas' ? '' : 'is-hidden' }}"
                >

                    <div>

                        <label
                            for="hora_inicio"
                            class="permission-form-label"
                        >
                            Hora de inicio
                            <span class="permission-form-required">*</span>
                        </label>

                        <input
                            type="time"
                            id="hora_inicio"
                            name="hora_inicio"
                            class="permission-form-input"
                            value="{{ old(
                                'hora_inicio',
                                $permiso->hora_inicio
                                    ? substr($permiso->hora_inicio, 0, 5)
                                    : ''
                            ) }}"
                        >

                    </div>


                    <div>

                        <label
                            for="hora_termino"
                            class="permission-form-label"
                        >
                            Hora de término
                            <span class="permission-form-required">*</span>
                        </label>

                        <input
                            type="time"
                            id="hora_termino"
                            name="hora_termino"
                            class="permission-form-input"
                            value="{{ old(
                                'hora_termino',
                                $permiso->hora_termino
                                    ? substr($permiso->hora_termino, 0, 5)
                                    : ''
                            ) }}"
                        >

                        @error('hora_termino')
                            <div class="permission-form-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <div>

                        <label
                            for="cantidad_horas"
                            class="permission-form-label"
                        >
                            Cantidad de horas
                        </label>

                        <input
                            type="number"
                            id="cantidad_horas"
                            name="cantidad_horas"
                            class="permission-form-input"
                            value="{{ old(
                                'cantidad_horas',
                                $permiso->cantidad_horas
                            ) }}"
                            step="0.01"
                            readonly
                        >

                        <div class="permission-form-help">
                            Se calcula automáticamente considerando fechas y horas.
                        </div>

                    </div>

                </div>


                <div class="permission-form-group-full">

                    <label
                        for="motivo"
                        class="permission-form-label"
                    >
                        Motivo
                    </label>

                    <textarea
                        id="motivo"
                        name="motivo"
                        class="permission-form-input"
                    >{{ old('motivo', $permiso->motivo) }}</textarea>

                </div>


                <div class="permission-form-group-full">

                    <label
                        for="justificacion"
                        class="permission-form-label"
                    >
                        Justificación
                    </label>

                    <textarea
                        id="justificacion"
                        name="justificacion"
                        class="permission-form-input"
                    >{{ old('justificacion', $permiso->justificacion) }}</textarea>

                </div>


                <div class="permission-form-group-full">

                    <label
                        for="observaciones"
                        class="permission-form-label"
                    >
                        Observaciones
                    </label>

                    <textarea
                        id="observaciones"
                        name="observaciones"
                        class="permission-form-input"
                    >{{ old('observaciones', $permiso->observaciones) }}</textarea>

                </div>

            </div>


            <div class="permission-form-info">

                <strong>Día completo:</strong>
                no requiere horas.

                <br>

                <strong>Por horas:</strong>
                las horas se calculan automáticamente considerando la fecha y hora de inicio y término.

            </div>

        </div>


        <div class="permission-form-footer">

            <div>
                <span class="permission-form-help">
                    Los campos marcados con * son obligatorios.
                </span>
            </div>

            <div class="permission-form-footer-actions">

                <a
                    href="{{ route('trabajadores.show', $trabajador) }}"
                    class="permission-form-cancel"
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


@push('scripts')

<script>
document.addEventListener('DOMContentLoaded', function () {

    const tipo =
        document.getElementById('tipo');

    const fechaInicio =
        document.getElementById('fecha_inicio');

    const fechaTermino =
        document.getElementById('fecha_termino');

    const horaInicio =
        document.getElementById('hora_inicio');

    const horaTermino =
        document.getElementById('hora_termino');

    const cantidadHoras =
        document.getElementById('cantidad_horas');

    const hourFields =
        document.getElementById(
            'permission-hour-fields'
        );


    function calcularHoras() {

        if (
            tipo.value !== 'horas' ||
            !fechaInicio.value ||
            !horaInicio.value ||
            !horaTermino.value
        ) {
            cantidadHoras.value = '';
            return;
        }

        const fechaFin =
            fechaTermino.value ||
            fechaInicio.value;

        const inicio =
            new Date(
                fechaInicio.value +
                'T' +
                horaInicio.value +
                ':00'
            );

        const termino =
            new Date(
                fechaFin +
                'T' +
                horaTermino.value +
                ':00'
            );

        const diferencia =
            termino.getTime() -
            inicio.getTime();

        if (
            !Number.isFinite(diferencia) ||
            diferencia <= 0
        ) {
            cantidadHoras.value = '';
            return;
        }

        const horas =
            diferencia /
            (1000 * 60 * 60);

        cantidadHoras.value =
            Number(
                horas.toFixed(2)
            );
    }


    function actualizarCamposHoras() {

        const esPorHoras =
            tipo.value === 'horas';

        hourFields.classList.toggle(
            'is-hidden',
            !esPorHoras
        );

        horaInicio.required =
            esPorHoras;

        horaTermino.required =
            esPorHoras;

        if (!esPorHoras) {

            horaInicio.value = '';
            horaTermino.value = '';
            cantidadHoras.value = '';

            return;
        }

        calcularHoras();
    }


    tipo.addEventListener(
        'change',
        actualizarCamposHoras
    );

    fechaInicio.addEventListener(
        'change',
        calcularHoras
    );

    fechaTermino.addEventListener(
        'change',
        calcularHoras
    );

    horaInicio.addEventListener(
        'input',
        calcularHoras
    );

    horaTermino.addEventListener(
        'input',
        calcularHoras
    );

    actualizarCamposHoras();
});
</script>

@endpush