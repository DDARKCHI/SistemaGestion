@extends('layouts.app')

@section('title', 'Editar ausencia')

@section('topbar_title', 'Ausencias')

@push('styles')

<style>

    .absence-form-header {
        margin-bottom: 24px;
    }

    .absence-form-title {
        margin: 0;
        color: #172033;
        font-size: 27px;
        line-height: 1.2;
        font-weight: 700;
        letter-spacing: -.025em;
    }

    .absence-form-subtitle {
        margin: 7px 0 0;
        color: #667085;
        font-size: 13px;
    }

    .absence-worker-card {
        margin-bottom: 18px;
        padding: 14px 16px;
        border: 1px solid #d4e5f2;
        border-radius: 8px;
        background: #f7fbfe;
    }

    .absence-worker-label {
        color: #98a2b3;
        font-size: 9px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .03em;
    }

    .absence-worker-name {
        margin-top: 4px;
        color: #155a91;
        font-size: 13px;
        font-weight: 700;
    }

    .absence-worker-rut {
        margin-top: 3px;
        color: #667085;
        font-size: 10px;
    }

    .absence-form-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(16,47,80,.05);
        overflow: hidden;
    }

    .absence-form-card-header {
        padding: 17px 20px;
        border-bottom: 1px solid #edf1f5;
    }

    .absence-form-card-title {
        margin: 0;
        color: #172033;
        font-size: 14px;
        font-weight: 700;
    }

    .absence-form-card-description {
        margin: 4px 0 0;
        color: #98a2b3;
        font-size: 10px;
    }

    .absence-form-body {
        padding: 22px 20px;
    }

    .absence-form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
    }

    .absence-form-group {
        min-width: 0;
    }

    .absence-form-group-full {
        grid-column: 1 / -1;
    }

    .absence-form-label {
        display: block;
        margin-bottom: 7px;
        color: #344054;
        font-size: 11px;
        font-weight: 600;
    }

    .absence-form-required {
        color: #b9382e;
    }

    .absence-form-input {
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

    .absence-form-input::placeholder {
        color: #a1aab7;
    }

    .absence-form-input:focus {
        border-color: #155a91;
        box-shadow: 0 0 0 3px rgba(21,90,145,.08);
    }

    textarea.absence-form-input {
        min-height: 105px;
        resize: vertical;
        line-height: 1.5;
    }

    .absence-form-help {
        margin-top: 5px;
        color: #98a2b3;
        font-size: 9px;
        line-height: 1.4;
    }

    .absence-form-error {
        margin-top: 5px;
        color: #b9382e;
        font-size: 9px;
    }

    .absence-form-alert {
        margin-bottom: 18px;
        padding: 11px 14px;
        border: 1px solid #f0d3cf;
        border-radius: 7px;
        background: #fff7f5;
        color: #a52f26;
        font-size: 11px;
    }

    .absence-form-info {
        margin-top: 18px;
        padding: 13px 15px;
        border: 1px solid #e2e8f0;
        border-radius: 7px;
        background: #fbfcfd;
        color: #667085;
        font-size: 10px;
        line-height: 1.5;
    }

    .absence-form-info strong {
        color: #344054;
    }

    .absence-form-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 15px 20px;
        border-top: 1px solid #edf1f5;
        background: #fbfcfd;
    }

    .absence-form-footer-actions {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .absence-form-cancel {
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
        transition:
            background .12s ease,
            border-color .12s ease;
    }

    .absence-form-cancel:hover {
        background: #f5f8fb;
        border-color: #cbd7e3;
    }

    @media (max-width: 700px) {

        .absence-form-grid {
            grid-template-columns: 1fr;
        }

        .absence-form-group-full {
            grid-column: auto;
        }

        .absence-form-footer {
            align-items: stretch;
            flex-direction: column;
        }

        .absence-form-footer-actions {
            width: 100%;
        }

        .absence-form-footer-actions .btn,
        .absence-form-footer-actions .absence-form-cancel {
            flex: 1;
        }

    }

</style>

@endpush


@section('content')

    <div class="absence-form-header">

        <h1 class="absence-form-title">
            Editar ausencia
        </h1>

        <p class="absence-form-subtitle">
            Modifica la información registrada para esta ausencia.
        </p>

    </div>


    <div class="absence-worker-card">

        <div class="absence-worker-label">
            Trabajador
        </div>

        <div class="absence-worker-name">
            {{ $trabajador->nombre }}
        </div>

        <div class="absence-worker-rut">
            RUT:
            {{ $trabajador->rut }}
        </div>

    </div>


    @if($errors->any())

        <div class="absence-form-alert">
            Revisa los datos ingresados. Hay campos que requieren corrección antes de guardar los cambios.
        </div>

    @endif


    <section class="absence-form-card">

        <div class="absence-form-card-header">

            <h2 class="absence-form-card-title">
                Información de la ausencia
            </h2>

            <p class="absence-form-card-description">
                Actualiza las fechas, cantidad de días y estado de la ausencia.
            </p>

        </div>


        <form
            action="{{ route(
                'trabajadores.ausencias.update',
                [
                    'trabajador' => $trabajador,
                    'ausencia' => $ausencia,
                ]
            ) }}"
            method="POST"
        >

            @csrf
            @method('PUT')


            <div class="absence-form-body">

                <div class="absence-form-grid">

                    <div class="absence-form-group">

                        <label
                            for="fecha_inicio"
                            class="absence-form-label"
                        >
                            Fecha de inicio
                            <span class="absence-form-required">*</span>
                        </label>

                        <input
                            type="date"
                            id="fecha_inicio"
                            name="fecha_inicio"
                            class="absence-form-input"
                            value="{{ old(
                                'fecha_inicio',
                                $ausencia->fecha_inicio
                                    ? $ausencia->fecha_inicio->format('Y-m-d')
                                    : ''
                            ) }}"
                            required
                            autofocus
                        >

                        @error('fecha_inicio')

                            <div class="absence-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <div class="absence-form-group">

                        <label
                            for="fecha_termino"
                            class="absence-form-label"
                        >
                            Fecha de término
                        </label>

                        <input
                            type="date"
                            id="fecha_termino"
                            name="fecha_termino"
                            class="absence-form-input"
                            value="{{ old(
                                'fecha_termino',
                                $ausencia->fecha_termino
                                    ? $ausencia->fecha_termino->format('Y-m-d')
                                    : ''
                            ) }}"
                        >

                        <div class="absence-form-help">
                            Puede quedar vacía si la ausencia corresponde a un solo día.
                        </div>

                        @error('fecha_termino')

                            <div class="absence-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <div class="absence-form-group">

                        <label
                            for="dias"
                            class="absence-form-label"
                        >
                            Cantidad de días
                            <span class="absence-form-required">*</span>
                        </label>

                        <input
                            type="number"
                            id="dias"
                            name="dias"
                            class="absence-form-input"
                            value="{{ old(
                                'dias',
                                rtrim(
                                    rtrim(
                                        number_format(
                                            (float) $ausencia->dias,
                                            2,
                                            '.',
                                            ''
                                        ),
                                        '0'
                                    ),
                                    '.'
                                )
                            ) }}"
                            min="0.5"
                            step="0.5"
                            required
                        >

                        <div class="absence-form-help">
                            Puedes registrar días completos o medios días.
                        </div>

                        @error('dias')

                            <div class="absence-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <div class="absence-form-group">

                        <label
                            for="estado"
                            class="absence-form-label"
                        >
                            Estado
                            <span class="absence-form-required">*</span>
                        </label>

                        <select
                            id="estado"
                            name="estado"
                            class="absence-form-input"
                            required
                        >

                            <option
                                value="pendiente"
                                {{ old('estado', $ausencia->estado) === 'pendiente' ? 'selected' : '' }}
                            >
                                Pendiente
                            </option>

                            <option
                                value="justificada"
                                {{ old('estado', $ausencia->estado) === 'justificada' ? 'selected' : '' }}
                            >
                                Justificada
                            </option>

                            <option
                                value="injustificada"
                                {{ old('estado', $ausencia->estado) === 'injustificada' ? 'selected' : '' }}
                            >
                                Injustificada
                            </option>

                        </select>

                        @error('estado')

                            <div class="absence-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <div class="absence-form-group absence-form-group-full">

                        <label
                            for="tipo"
                            class="absence-form-label"
                        >
                            Tipo de ausencia
                        </label>

                        <input
                            type="text"
                            id="tipo"
                            name="tipo"
                            class="absence-form-input"
                            value="{{ old('tipo', $ausencia->tipo) }}"
                            maxlength="255"
                            placeholder="Ej. enfermedad, trámite personal, inasistencia..."
                        >

                        <div class="absence-form-help">
                            Indica brevemente el motivo o tipo de ausencia.
                        </div>

                        @error('tipo')

                            <div class="absence-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <div class="absence-form-group absence-form-group-full">

                        <label
                            for="justificacion"
                            class="absence-form-label"
                        >
                            Justificación
                        </label>

                        <textarea
                            id="justificacion"
                            name="justificacion"
                            class="absence-form-input"
                            placeholder="Detalle de la justificación de la ausencia, si corresponde..."
                        >{{ old('justificacion', $ausencia->justificacion) }}</textarea>

                        @error('justificacion')

                            <div class="absence-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <div class="absence-form-group absence-form-group-full">

                        <label
                            for="observaciones"
                            class="absence-form-label"
                        >
                            Observaciones
                        </label>

                        <textarea
                            id="observaciones"
                            name="observaciones"
                            class="absence-form-input"
                            placeholder="Información adicional sobre esta ausencia..."
                        >{{ old('observaciones', $ausencia->observaciones) }}</textarea>

                        @error('observaciones')

                            <div class="absence-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                </div>


                <div class="absence-form-info">

                    <strong>Estado pendiente:</strong>
                    permite mantener la ausencia registrada hasta definir si corresponde como justificada o injustificada.

                </div>

            </div>


            <div class="absence-form-footer">

                <div>

                    <span class="absence-form-help">
                        Los campos marcados con * son obligatorios.
                    </span>

                </div>


                <div class="absence-form-footer-actions">

                    <a
                        href="{{ route('trabajadores.show', $trabajador) }}"
                        class="absence-form-cancel"
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