@extends('layouts.app')

@section('title', 'Nueva modificación contractual')

@section('topbar_title', 'Nueva modificación contractual')

@push('styles')

<style>

    .modification-create-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 24px;
    }

    .modification-create-title {
        margin: 0;
        color: #172033;
        font-size: 27px;
        line-height: 1.2;
        font-weight: 700;
        letter-spacing: -.025em;
    }

    .modification-create-subtitle {
        margin: 7px 0 0;
        color: #667085;
        font-size: 13px;
    }

    .modification-create-actions {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-shrink: 0;
    }

    .modification-create-action {
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

    .modification-create-action:hover {
        background: #f5f8fb;
        border-color: #cbd7e3;
        color: #155a91;
    }

    .modification-create-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(16, 47, 80, .05);
        overflow: hidden;
    }

    .modification-create-card-header {
        padding: 18px 20px;
        border-bottom: 1px solid #edf1f5;
    }

    .modification-create-card-title {
        margin: 0;
        color: #172033;
        font-size: 14px;
        font-weight: 700;
    }

    .modification-create-card-description {
        margin: 4px 0 0;
        color: #98a2b3;
        font-size: 10px;
    }

    .modification-create-contract {
        margin-top: 12px;
        padding: 11px 13px;
        border: 1px solid #e2e8f0;
        border-radius: 7px;
        background: #f8fafc;
        color: #344054;
        font-size: 10px;
        line-height: 1.6;
    }

    .modification-create-contract strong {
        color: #172033;
        font-weight: 700;
    }

    .modification-create-form {
        padding: 20px;
    }

    .modification-create-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
    }

    .modification-create-field {
        min-width: 0;
    }

    .modification-create-field-full {
        grid-column: 1 / -1;
    }

    .modification-create-label {
        display: block;
        margin-bottom: 6px;
        color: #344054;
        font-size: 10px;
        font-weight: 700;
    }

    .modification-create-required {
        color: #b9382e;
    }

    .modification-create-input,
    .modification-create-select,
    .modification-create-textarea {
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

    .modification-create-input,
    .modification-create-select {
        min-height: 38px;
        padding: 8px 10px;
    }

    .modification-create-textarea {
        min-height: 120px;
        padding: 10px;
        resize: vertical;
        line-height: 1.5;
    }

    .modification-create-input:focus,
    .modification-create-select:focus,
    .modification-create-textarea:focus {
        border-color: #8db5d2;
        box-shadow: 0 0 0 3px rgba(21, 90, 145, .08);
    }

    .modification-create-help {
        margin-top: 5px;
        color: #98a2b3;
        font-size: 9px;
        line-height: 1.4;
    }

    .modification-create-error {
        margin-top: 5px;
        color: #b9382e;
        font-size: 9px;
    }

    .modification-create-alert {
        margin-bottom: 18px;
        padding: 11px 14px;
        border: 1px solid #f0c8c3;
        border-radius: 7px;
        background: #fff5f3;
        color: #b9382e;
        font-size: 10px;
    }

    .modification-create-upload {
        padding: 15px;
        border: 1px dashed #cbd7e3;
        border-radius: 8px;
        background: #f8fafc;
    }

    .modification-create-upload-title {
        margin: 0;
        color: #344054;
        font-size: 11px;
        font-weight: 700;
    }

    .modification-create-upload-text {
        margin: 4px 0 12px;
        color: #98a2b3;
        font-size: 9px;
        line-height: 1.5;
    }

    .modification-create-file {
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

    .modification-create-footer {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 8px;
        margin-top: 22px;
        padding-top: 18px;
        border-top: 1px solid #edf1f5;
    }

    .modification-create-button,
    .modification-create-cancel {
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
        cursor: pointer;
    }

    .modification-create-button {
        border: 1px solid #d4e5f2;
        background: #155a91;
        color: #ffffff;
    }

    .modification-create-button:hover {
        background: #124d7d;
        border-color: #124d7d;
    }

    .modification-create-cancel {
        border: 1px solid #dce3eb;
        background: #ffffff;
        color: #344054;
    }

    .modification-create-cancel:hover {
        background: #f5f8fb;
        color: #155a91;
    }

    @media (max-width: 700px) {

        .modification-create-header {
            flex-direction: column;
        }

        .modification-create-actions {
            width: 100%;
        }

        .modification-create-actions .modification-create-action {
            flex: 1;
        }

        .modification-create-grid {
            grid-template-columns: 1fr;
        }

        .modification-create-field-full {
            grid-column: auto;
        }

        .modification-create-footer {
            flex-direction: column-reverse;
        }

        .modification-create-footer a,
        .modification-create-footer button {
            width: 100%;
        }

    }

</style>

@endpush


@section('content')

    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="modification-create-header">

        <div>

            <h1 class="modification-create-title">
                Nueva modificación contractual
            </h1>

            <p class="modification-create-subtitle">
                Registra un cambio, anexo o actualización manteniendo el historial del contrato.
            </p>

        </div>


        <div class="modification-create-actions">

            <a
                href="{{ route('trabajadores.show', $trabajador) }}"
                class="modification-create-action"
            >
                ← Volver a la ficha
            </a>

        </div>

    </div>


    {{-- =====================================================
         ERRORES
    ====================================================== --}}

    @if($errors->any())

        <div class="modification-create-alert">

            <strong>
                No se pudo guardar la modificación.
            </strong>

            Revisa los campos marcados e inténtalo nuevamente.

        </div>

    @endif


    {{-- =====================================================
         FORMULARIO
    ====================================================== --}}

    <section class="modification-create-card">

        <div class="modification-create-card-header">

            <h2 class="modification-create-card-title">
                Datos de la modificación
            </h2>

            <p class="modification-create-card-description">
                Registra qué cambió, cuándo ocurrió y su documentación de respaldo.
            </p>


            <div class="modification-create-contract">

                <strong>
                    Trabajador:
                </strong>

                {{ $trabajador->nombre }}

                · RUT {{ $trabajador->rut }}

                <br>

                <strong>
                    Contrato:
                </strong>

                {{ $contrato->tipo }}

                · Inicio:
                {{ $contrato->fecha_inicio
                    ? $contrato->fecha_inicio->format('d/m/Y')
                    : '—'
                }}

                · Estado:
                {{ $contrato->estado }}

            </div>

        </div>


        <form
            action="{{ route(
                'trabajadores.contratos.modificaciones.store',
                [
                    'trabajador' => $trabajador,
                    'contrato' => $contrato,
                ]
            ) }}"
            method="POST"
            enctype="multipart/form-data"
            class="modification-create-form"
        >

            @csrf


            <div class="modification-create-grid">

                {{-- =================================================
                     TIPO
                ================================================== --}}

                <div class="modification-create-field">

                    <label
                        for="tipo"
                        class="modification-create-label"
                    >
                        Tipo de modificación
                        <span class="modification-create-required">*</span>
                    </label>

                    <select
                        id="tipo"
                        name="tipo"
                        class="modification-create-select"
                        required
                    >

                        <option value="">
                            Seleccionar tipo
                        </option>

                        <option
                            value="Anexo"
                            {{ old('tipo') === 'Anexo' ? 'selected' : '' }}
                        >
                            Anexo
                        </option>

                        <option
                            value="Cambio de remuneración"
                            {{ old('tipo') === 'Cambio de remuneración' ? 'selected' : '' }}
                        >
                            Cambio de remuneración
                        </option>

                        <option
                            value="Cambio de bono"
                            {{ old('tipo') === 'Cambio de bono' ? 'selected' : '' }}
                        >
                            Cambio de bono
                        </option>

                        <option
                            value="Cambio de jornada"
                            {{ old('tipo') === 'Cambio de jornada' ? 'selected' : '' }}
                        >
                            Cambio de jornada
                        </option>

                        <option
                            value="Cambio de condiciones"
                            {{ old('tipo') === 'Cambio de condiciones' ? 'selected' : '' }}
                        >
                            Cambio de condiciones
                        </option>

                        <option
                            value="Otro"
                            {{ old('tipo') === 'Otro' ? 'selected' : '' }}
                        >
                            Otro
                        </option>

                    </select>

                    @error('tipo')

                        <div class="modification-create-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- =================================================
                     FECHA
                ================================================== --}}

                <div class="modification-create-field">

                    <label
                        for="fecha"
                        class="modification-create-label"
                    >
                        Fecha de modificación
                        <span class="modification-create-required">*</span>
                    </label>

                    <input
                        type="date"
                        id="fecha"
                        name="fecha"
                        class="modification-create-input"
                        value="{{ old('fecha') }}"
                        required
                    >

                    @error('fecha')

                        <div class="modification-create-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- =================================================
                     NUEVA REMUNERACIÓN
                ================================================== --}}

                <div class="modification-create-field">

                    <label
                        for="nueva_remuneracion"
                        class="modification-create-label"
                    >
                        Nueva remuneración
                    </label>

                    <input
                        type="number"
                        id="nueva_remuneracion"
                        name="nueva_remuneracion"
                        class="modification-create-input"
                        value="{{ old('nueva_remuneracion') }}"
                        min="0"
                        step="0.01"
                        placeholder="Opcional"
                    >

                    <div class="modification-create-help">
                        Completa este campo solo si la modificación cambia la remuneración.
                    </div>

                    @error('nueva_remuneracion')

                        <div class="modification-create-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- =================================================
                     NUEVO BONO
                ================================================== --}}

                <div class="modification-create-field">

                    <label
                        for="nuevo_bono"
                        class="modification-create-label"
                    >
                        Nuevo bono
                    </label>

                    <input
                        type="number"
                        id="nuevo_bono"
                        name="nuevo_bono"
                        class="modification-create-input"
                        value="{{ old('nuevo_bono') }}"
                        min="0"
                        step="0.01"
                        placeholder="Opcional"
                    >

                    <div class="modification-create-help">
                        Completa este campo si se establece o modifica un bono.
                    </div>

                    @error('nuevo_bono')

                        <div class="modification-create-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- =================================================
                     DESCRIPCIÓN
                ================================================== --}}

                <div class="modification-create-field modification-create-field-full">

                    <label
                        for="descripcion"
                        class="modification-create-label"
                    >
                        Descripción
                        <span class="modification-create-required">*</span>
                    </label>

                    <textarea
                        id="descripcion"
                        name="descripcion"
                        class="modification-create-textarea"
                        placeholder="Describe detalladamente qué se modificó en el contrato..."
                        required
                    >{{ old('descripcion') }}</textarea>

                    @error('descripcion')

                        <div class="modification-create-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- =================================================
                     DOCUMENTO
                ================================================== --}}

                <div class="modification-create-field modification-create-field-full">

                    <div class="modification-create-upload">

                        <h3 class="modification-create-upload-title">
                            Documento de respaldo
                        </h3>

                        <p class="modification-create-upload-text">
                            Puedes adjuntar el anexo firmado o cualquier documento
                            que respalde esta modificación. El archivo quedará asociado
                            directamente a esta modificación contractual.
                            Máximo 20 MB.
                        </p>

                        <input
                            type="file"
                            id="documento"
                            name="documento"
                            class="modification-create-file"
                            accept=".pdf,.jpg,.jpeg,.png,.doc,.docx,.xls,.xlsx"
                        >

                        @error('documento')

                            <div class="modification-create-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                </div>


                {{-- =================================================
                     OBSERVACIONES
                ================================================== --}}

                <div class="modification-create-field modification-create-field-full">

                    <label
                        for="observaciones"
                        class="modification-create-label"
                    >
                        Observaciones
                    </label>

                    <textarea
                        id="observaciones"
                        name="observaciones"
                        class="modification-create-textarea"
                        placeholder="Información adicional..."
                    >{{ old('observaciones') }}</textarea>

                    @error('observaciones')

                        <div class="modification-create-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>

            </div>


            {{-- =================================================
                 ACCIONES
            ================================================== --}}

            <div class="modification-create-footer">

                <a
                    href="{{ route('trabajadores.show', $trabajador) }}"
                    class="modification-create-cancel"
                >
                    Cancelar
                </a>


                <button
                    type="submit"
                    class="modification-create-button"
                >
                    Guardar modificación
                </button>

            </div>

        </form>

    </section>

@endsection