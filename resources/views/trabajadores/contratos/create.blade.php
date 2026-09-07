@extends('layouts.app')

@section('title', 'Nuevo contrato')

@section('topbar_title', 'Nuevo contrato')

@push('styles')

<style>

    .contract-create-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 24px;
    }

    .contract-create-title {
        margin: 0;
        color: #172033;
        font-size: 27px;
        line-height: 1.2;
        font-weight: 700;
        letter-spacing: -.025em;
    }

    .contract-create-subtitle {
        margin: 7px 0 0;
        color: #667085;
        font-size: 13px;
    }

    .contract-create-actions {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-shrink: 0;
    }

    .contract-create-action {
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

    .contract-create-action:hover {
        background: #f5f8fb;
        border-color: #cbd7e3;
        color: #155a91;
    }

    .contract-create-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(16, 47, 80, .05);
        overflow: hidden;
    }

    .contract-create-card-header {
        padding: 18px 20px;
        border-bottom: 1px solid #edf1f5;
    }

    .contract-create-card-title {
        margin: 0;
        color: #172033;
        font-size: 14px;
        font-weight: 700;
    }

    .contract-create-card-description {
        margin: 4px 0 0;
        color: #98a2b3;
        font-size: 10px;
    }

    .contract-create-worker {
        margin-top: 12px;
        padding: 10px 12px;
        border: 1px solid #e2e8f0;
        border-radius: 7px;
        background: #f8fafc;
        color: #344054;
        font-size: 11px;
    }

    .contract-create-worker strong {
        color: #172033;
        font-weight: 700;
    }

    .contract-create-form {
        padding: 20px;
    }

    .contract-create-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
    }

    .contract-create-field {
        min-width: 0;
    }

    .contract-create-field-full {
        grid-column: 1 / -1;
    }

    .contract-create-label {
        display: block;
        margin-bottom: 6px;
        color: #344054;
        font-size: 10px;
        font-weight: 700;
    }

    .contract-create-required {
        color: #b9382e;
    }

    .contract-create-input,
    .contract-create-select,
    .contract-create-textarea {
        width: 100%;
        box-sizing: border-box;
        border: 1px solid #dce3eb;
        border-radius: 6px;
        background: #ffffff;
        color: #344054;
        font-family: inherit;
        font-size: 11px;
        outline: none;
        transition: border-color .15s ease, box-shadow .15s ease;
    }

    .contract-create-input,
    .contract-create-select {
        min-height: 38px;
        padding: 8px 10px;
    }

    .contract-create-textarea {
        min-height: 105px;
        padding: 10px;
        resize: vertical;
        line-height: 1.5;
    }

    .contract-create-input:focus,
    .contract-create-select:focus,
    .contract-create-textarea:focus {
        border-color: #8db5d2;
        box-shadow: 0 0 0 3px rgba(21, 90, 145, .08);
    }

    .contract-create-help {
        margin-top: 5px;
        color: #98a2b3;
        font-size: 9px;
        line-height: 1.4;
    }

    .contract-create-error {
        margin-top: 5px;
        color: #b9382e;
        font-size: 9px;
    }

    .contract-create-alert {
        margin-bottom: 18px;
        padding: 11px 14px;
        border: 1px solid #f0c8c3;
        border-radius: 7px;
        background: #fff5f3;
        color: #b9382e;
        font-size: 10px;
    }

    .contract-create-upload {
        padding: 15px;
        border: 1px dashed #cbd7e3;
        border-radius: 8px;
        background: #f8fafc;
    }

    .contract-create-upload-title {
        margin: 0;
        color: #344054;
        font-size: 11px;
        font-weight: 700;
    }

    .contract-create-upload-text {
        margin: 4px 0 12px;
        color: #98a2b3;
        font-size: 9px;
        line-height: 1.5;
    }

    .contract-create-file {
        width: 100%;
        box-sizing: border-box;
        padding: 8px;
        border: 1px solid #dce3eb;
        border-radius: 6px;
        background: #ffffff;
        color: #344054;
        font-family: inherit;
        font-size: 10px;
    }

    .contract-create-footer {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 8px;
        margin-top: 22px;
        padding-top: 18px;
        border-top: 1px solid #edf1f5;
    }

    .contract-create-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 36px;
        padding: 8px 15px;
        border: 1px solid #d4e5f2;
        border-radius: 6px;
        background: #155a91;
        color: #ffffff;
        font-family: inherit;
        font-size: 10px;
        font-weight: 600;
        cursor: pointer;
    }

    .contract-create-button:hover {
        background: #124d7d;
        border-color: #124d7d;
    }

    .contract-create-cancel {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 36px;
        padding: 8px 15px;
        border: 1px solid #dce3eb;
        border-radius: 6px;
        background: #ffffff;
        color: #344054;
        font-family: inherit;
        font-size: 10px;
        font-weight: 600;
        text-decoration: none;
    }

    .contract-create-cancel:hover {
        background: #f5f8fb;
        color: #155a91;
    }

    @media (max-width: 700px) {

        .contract-create-header {
            flex-direction: column;
        }

        .contract-create-actions {
            width: 100%;
        }

        .contract-create-actions .contract-create-action {
            flex: 1;
        }

        .contract-create-grid {
            grid-template-columns: 1fr;
        }

        .contract-create-field-full {
            grid-column: auto;
        }

        .contract-create-footer {
            flex-direction: column-reverse;
        }

        .contract-create-footer a,
        .contract-create-footer button {
            width: 100%;
        }

    }

</style>

@endpush


@section('content')

    <div class="contract-create-header">

        <div>

            <h1 class="contract-create-title">
                Nuevo contrato
            </h1>

            <p class="contract-create-subtitle">
                Registra las condiciones laborales del contrato del trabajador.
            </p>

        </div>

        <div class="contract-create-actions">

            <a
                href="{{ route('trabajadores.show', $trabajador) }}"
                class="contract-create-action"
            >
                ← Volver a la ficha
            </a>

        </div>

    </div>


    @if($errors->any())

        <div class="contract-create-alert">

            <strong>
                No se pudo guardar el contrato.
            </strong>

            Revisa los campos marcados e inténtalo nuevamente.

        </div>

    @endif


    <section class="contract-create-card">

        <div class="contract-create-card-header">

            <h2 class="contract-create-card-title">
                Datos del contrato
            </h2>

            <p class="contract-create-card-description">
                Información principal, vigencia, remuneración y jornada laboral.
            </p>

            <div class="contract-create-worker">

                Trabajador:

                <strong>
                    {{ $trabajador->nombre }}
                </strong>

                · RUT {{ $trabajador->rut }}

            </div>

        </div>


        <form
            action="{{ route('trabajadores.contratos.store', $trabajador) }}"
            method="POST"
            enctype="multipart/form-data"
            class="contract-create-form"
        >

            @csrf


            <div class="contract-create-grid">

                <div class="contract-create-field">

                    <label
                        for="tipo"
                        class="contract-create-label"
                    >
                        Tipo de contrato
                        <span class="contract-create-required">*</span>
                    </label>

                    <input
                        type="text"
                        id="tipo"
                        name="tipo"
                        class="contract-create-input"
                        value="{{ old('tipo') }}"
                        placeholder="Ej. Indefinido"
                        required
                    >

                    @error('tipo')
                        <div class="contract-create-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="contract-create-field">

                    <label
                        for="estado"
                        class="contract-create-label"
                    >
                        Estado
                        <span class="contract-create-required">*</span>
                    </label>

                    <select
                        id="estado"
                        name="estado"
                        class="contract-create-select"
                        required
                    >

                        <option value="">
                            Seleccionar estado
                        </option>

                        <option
                            value="vigente"
                            {{ old('estado') === 'vigente' ? 'selected' : '' }}
                        >
                            Vigente
                        </option>

                        <option
                            value="finalizado"
                            {{ old('estado') === 'finalizado' ? 'selected' : '' }}
                        >
                            Finalizado
                        </option>

                        <option
                            value="suspendido"
                            {{ old('estado') === 'suspendido' ? 'selected' : '' }}
                        >
                            Suspendido
                        </option>

                    </select>

                    @error('estado')
                        <div class="contract-create-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="contract-create-field">

                    <label
                        for="fecha_inicio"
                        class="contract-create-label"
                    >
                        Fecha de inicio
                        <span class="contract-create-required">*</span>
                    </label>

                    <input
                        type="date"
                        id="fecha_inicio"
                        name="fecha_inicio"
                        class="contract-create-input"
                        value="{{ old('fecha_inicio') }}"
                        required
                    >

                    @error('fecha_inicio')
                        <div class="contract-create-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="contract-create-field">

                    <label
                        for="fecha_termino"
                        class="contract-create-label"
                    >
                        Fecha de término
                    </label>

                    <input
                        type="date"
                        id="fecha_termino"
                        name="fecha_termino"
                        class="contract-create-input"
                        value="{{ old('fecha_termino') }}"
                    >

                    <div class="contract-create-help">
                        Déjalo vacío si el contrato es indefinido.
                    </div>

                    @error('fecha_termino')
                        <div class="contract-create-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="contract-create-field">

                    <label
                        for="remuneracion"
                        class="contract-create-label"
                    >
                        Remuneración
                    </label>

                    <input
                        type="number"
                        id="remuneracion"
                        name="remuneracion"
                        class="contract-create-input"
                        value="{{ old('remuneracion') }}"
                        min="0"
                        step="0.01"
                        placeholder="0"
                    >

                    @error('remuneracion')
                        <div class="contract-create-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="contract-create-field">

                    <label
                        for="horas_semanales"
                        class="contract-create-label"
                    >
                        Horas semanales
                    </label>

                    <input
                        type="number"
                        id="horas_semanales"
                        name="horas_semanales"
                        class="contract-create-input"
                        value="{{ old('horas_semanales') }}"
                        min="0"
                        step="0.01"
                        placeholder="Ej. 44"
                    >

                    @error('horas_semanales')
                        <div class="contract-create-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="contract-create-field">

                    <label
                        for="horas_mensuales"
                        class="contract-create-label"
                    >
                        Horas mensuales
                    </label>

                    <input
                        type="number"
                        id="horas_mensuales"
                        name="horas_mensuales"
                        class="contract-create-input"
                        value="{{ old('horas_mensuales') }}"
                        min="0"
                        step="0.01"
                        placeholder="Ej. 176"
                    >

                    @error('horas_mensuales')
                        <div class="contract-create-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- =================================================
                     CONTRATO ADJUNTO
                ================================================== --}}

                <div class="contract-create-field contract-create-field-full">

                    <div class="contract-create-upload">

                        <h3 class="contract-create-upload-title">
                            Contrato adjunto
                        </h3>

                        <p class="contract-create-upload-text">
                            Puedes adjuntar el contrato firmado o documento contractual correspondiente.
                            El archivo quedará asociado directamente a este contrato.
                            Máximo 20 MB.
                        </p>

                        <input
                            type="file"
                            id="contrato_archivo"
                            name="contrato_archivo"
                            class="contract-create-file"
                            accept=".pdf,.jpg,.jpeg,.png,.doc,.docx,.xls,.xlsx"
                        >

                        @error('contrato_archivo')

                            <div class="contract-create-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                </div>


                <div class="contract-create-field contract-create-field-full">

                    <label
                        for="observaciones"
                        class="contract-create-label"
                    >
                        Observaciones
                    </label>

                    <textarea
                        id="observaciones"
                        name="observaciones"
                        class="contract-create-textarea"
                        placeholder="Información adicional relacionada con el contrato..."
                    >{{ old('observaciones') }}</textarea>

                    @error('observaciones')

                        <div class="contract-create-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>

            </div>


            <div class="contract-create-footer">

                <a
                    href="{{ route('trabajadores.show', $trabajador) }}"
                    class="contract-create-cancel"
                >
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="contract-create-button"
                >
                    Guardar contrato
                </button>

            </div>

        </form>

    </section>

@endsection