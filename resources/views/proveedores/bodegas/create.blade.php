@extends('layouts.app')

@section('title', 'Nueva bodega')

@section('topbar_title', 'Gestión de proveedores')

@push('styles')

<style>

    /* =========================================================
       HEADER
    ========================================================== */

    .provider-form-header {

        display: flex;

        align-items: flex-start;

        justify-content: space-between;

        gap: 20px;

        margin-bottom: 24px;

    }


    .provider-form-title {

        margin: 0;

        color: #172033;

        font-size: 27px;

        line-height: 1.2;

        font-weight: 700;

        letter-spacing: -.025em;

    }


    .provider-form-subtitle {

        margin: 7px 0 0;

        color: #667085;

        font-size: 13px;

    }


    .provider-form-subtitle strong {

        color: #155a91;

    }


    .provider-form-back {

        display: inline-flex;

        align-items: center;

        justify-content: center;

        min-height: 36px;

        padding: 8px 13px;

        border: 1px solid #dce3eb;

        border-radius: 6px;

        background: #ffffff;

        color: #344054;

        font-size: 11px;

        font-weight: 600;

        text-decoration: none;

    }


    .provider-form-back:hover {

        background: #f7f9fb;

        color: #155a91;

        border-color: #cbd7e3;

    }


    /* =========================================================
       CONTENEDOR
    ========================================================== */

    .provider-form-card {

        width: 100%;

        background: #ffffff;

        border: 1px solid #e2e8f0;

        border-radius: 10px;

        box-shadow:
            0 2px 8px rgba(16,47,80,.05);

        overflow: hidden;

    }


    /* =========================================================
       SECCIONES
    ========================================================== */

    .provider-form-section {

        padding: 22px 24px;

        border-bottom: 1px solid #edf1f5;

    }


    .provider-form-section:last-child {

        border-bottom: none;

    }


    .provider-form-section-title {

        margin: 0;

        color: #172033;

        font-size: 14px;

        font-weight: 700;

    }


    .provider-form-section-description {

        margin: 5px 0 18px;

        color: #98a2b3;

        font-size: 10px;

        line-height: 1.5;

    }


    /* =========================================================
       IDENTIFICACIÓN DEL PROVEEDOR
    ========================================================== */

    .provider-context {

        display: flex;

        align-items: center;

        gap: 12px;

        margin-bottom: 20px;

        padding: 11px 13px;

        border: 1px solid #e4eaf0;

        border-radius: 7px;

        background: #f8fafc;

    }


    .provider-context-label {

        color: #98a2b3;

        font-size: 9px;

        font-weight: 600;

        text-transform: uppercase;

        letter-spacing: .04em;

    }


    .provider-context-name {

        color: #155a91;

        font-size: 12px;

        font-weight: 700;

    }


    .provider-context-rut {

        margin-left: auto;

        color: #667085;

        font-size: 10px;

    }


    /* =========================================================
       GRID
    ========================================================== */

    .provider-form-grid {

        display: grid;

        grid-template-columns:
            repeat(2, minmax(0, 1fr));

        gap: 17px 20px;

    }


    .provider-form-group {

        min-width: 0;

    }


    .provider-form-group-full {

        grid-column: 1 / -1;

    }


    /* =========================================================
       LABELS
    ========================================================== */

    .provider-form-label {

        display: block;

        margin-bottom: 6px;

        color: #344054;

        font-size: 10px;

        font-weight: 600;

    }


    .provider-form-required {

        color: #c0392b;

    }


    /* =========================================================
       INPUTS
    ========================================================== */

    .provider-form-input,
    .provider-form-textarea {

        display: block;

        width: 100%;

        box-sizing: border-box;

        border: 1px solid #d8e0e8;

        border-radius: 6px;

        background: #ffffff;

        color: #344054;

        font-family: inherit;

        font-size: 11px;

        outline: none;

        transition:
            border-color .12s ease,
            box-shadow .12s ease;

    }


    .provider-form-input {

        height: 38px;

        padding: 0 11px;

    }


    .provider-form-textarea {

        min-height: 90px;

        padding: 10px 11px;

        resize: vertical;

        line-height: 1.5;

    }


    .provider-form-input::placeholder,
    .provider-form-textarea::placeholder {

        color: #a1aab7;

    }


    .provider-form-input:focus,
    .provider-form-textarea:focus {

        border-color: #155a91;

        box-shadow:
            0 0 0 3px rgba(21,90,145,.08);

    }


    /* =========================================================
       AYUDAS
    ========================================================== */

    .provider-form-help {

        margin-top: 5px;

        color: #98a2b3;

        font-size: 9px;

        line-height: 1.4;

    }


    /* =========================================================
       ERRORES
    ========================================================== */

    .provider-form-error {

        margin-top: 5px;

        color: #b42318;

        font-size: 9px;

    }


    .provider-form-input.is-error,
    .provider-form-textarea.is-error {

        border-color: #d92d20;

    }


    /* =========================================================
       ALERTA
    ========================================================== */

    .provider-form-alert {

        margin-bottom: 18px;

        padding: 11px 14px;

        border: 1px solid #e9c1bc;

        border-radius: 7px;

        background: #fff5f3;

        color: #a52f26;

        font-size: 11px;

    }


    /* =========================================================
       PIE DEL FORMULARIO
    ========================================================== */

    .provider-form-footer {

        display: flex;

        align-items: center;

        justify-content: flex-end;

        gap: 9px;

        padding: 16px 24px;

        background: #fbfcfd;

        border-top: 1px solid #edf1f5;

    }


    .provider-form-button {

        display: inline-flex;

        align-items: center;

        justify-content: center;

        min-height: 36px;

        padding: 8px 15px;

        border-radius: 6px;

        font-family: inherit;

        font-size: 11px;

        font-weight: 600;

        text-decoration: none;

        cursor: pointer;

    }


    .provider-form-button-secondary {

        border: 1px solid #dce3eb;

        background: #ffffff;

        color: #344054;

    }


    .provider-form-button-secondary:hover {

        background: #f7f9fb;

        color: #155a91;

    }


    .provider-form-button-primary {

        border: 1px solid #155a91;

        background: #155a91;

        color: #ffffff;

    }


    .provider-form-button-primary:hover {

        border-color: #124d7d;

        background: #124d7d;

    }


    /* =========================================================
       RESPONSIVE
    ========================================================== */

    @media (max-width: 700px) {

        .provider-form-header {

            flex-direction: column;

        }


        .provider-form-grid {

            grid-template-columns: 1fr;

        }


        .provider-form-group-full {

            grid-column: auto;

        }


        .provider-context {

            align-items: flex-start;

            flex-direction: column;

        }


        .provider-context-rut {

            margin-left: 0;

        }


        .provider-form-footer {

            flex-direction: column-reverse;

            align-items: stretch;

        }


        .provider-form-button {

            width: 100%;

        }

    }

</style>

@endpush


@section('content')

    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="provider-form-header">

        <div>

            <h1 class="provider-form-title">
                Nueva bodega
            </h1>

            <p class="provider-form-subtitle">
                Registra una nueva bodega para el proveedor
                <strong>{{ $proveedor->nombre }}</strong>.
            </p>

        </div>


        <a
            href="{{ route('proveedores.show', $proveedor) }}"
            class="provider-form-back"
        >
            ← Volver al proveedor
        </a>

    </div>


    {{-- =====================================================
         ERRORES
    ====================================================== --}}

    @if($errors->any())

        <div class="provider-form-alert">

            <strong>
                No se pudo guardar la bodega.
            </strong>

            <div style="margin-top: 5px;">
                Revisa los campos marcados antes de continuar.
            </div>

        </div>

    @endif


    {{-- =====================================================
         FORMULARIO
    ====================================================== --}}

    <form
        action="{{ route('proveedores.bodegas.store', $proveedor) }}"
        method="POST"
    >

        @csrf


        <div class="provider-form-card">


            {{-- =================================================
                 INFORMACIÓN DE LA BODEGA
            ================================================== --}}

            <section class="provider-form-section">

                <h2 class="provider-form-section-title">
                    Información de la bodega
                </h2>

                <p class="provider-form-section-description">
                    Registra la identificación y ubicación de la bodega.
                </p>


                {{-- PROVEEDOR ASOCIADO --}}

                <div class="provider-context">

                    <div>

                        <div class="provider-context-label">
                            Proveedor asociado
                        </div>

                        <div class="provider-context-name">
                            {{ $proveedor->nombre }}
                        </div>

                    </div>


                    <div class="provider-context-rut">

                        RUT:
                        <strong>
                            {{ $proveedor->rut }}
                        </strong>

                    </div>

                </div>


                <div class="provider-form-grid">


                    {{-- NOMBRE --}}

                    <div class="provider-form-group">

                        <label
                            for="nombre"
                            class="provider-form-label"
                        >
                            Nombre de la bodega
                            <span class="provider-form-required">*</span>
                        </label>

                        <input
                            type="text"
                            id="nombre"
                            name="nombre"
                            class="provider-form-input @error('nombre') is-error @enderror"
                            value="{{ old('nombre') }}"
                            maxlength="150"
                            required
                            autofocus
                            placeholder="Ej. Bodega Central"
                        >

                        @error('nombre')

                            <div class="provider-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- LOCALIDAD --}}

                    <div class="provider-form-group">

                        <label
                            for="localidad"
                            class="provider-form-label"
                        >
                            Localidad
                        </label>

                        <input
                            type="text"
                            id="localidad"
                            name="localidad"
                            class="provider-form-input @error('localidad') is-error @enderror"
                            value="{{ old('localidad') }}"
                            maxlength="100"
                            placeholder="Ej. Santiago"
                        >

                        @error('localidad')

                            <div class="provider-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- DIRECCIÓN --}}

                    <div class="provider-form-group provider-form-group-full">

                        <label
                            for="direccion"
                            class="provider-form-label"
                        >
                            Dirección
                            <span class="provider-form-required">*</span>
                        </label>

                        <input
                            type="text"
                            id="direccion"
                            name="direccion"
                            class="provider-form-input @error('direccion') is-error @enderror"
                            value="{{ old('direccion') }}"
                            maxlength="255"
                            required
                            placeholder="Dirección completa de la bodega"
                        >

                        @error('direccion')

                            <div class="provider-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- OBSERVACIONES --}}

                    <div class="provider-form-group provider-form-group-full">

                        <label
                            for="observaciones"
                            class="provider-form-label"
                        >
                            Observaciones
                        </label>

                        <textarea
                            id="observaciones"
                            name="observaciones"
                            class="provider-form-textarea @error('observaciones') is-error @enderror"
                            placeholder="Ingresa información adicional de la bodega..."
                        >{{ old('observaciones') }}</textarea>

                        <div class="provider-form-help">
                            Puedes registrar horarios de atención,
                            referencias de ubicación, restricciones u otros antecedentes.
                        </div>

                        @error('observaciones')

                            <div class="provider-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                </div>

            </section>


            {{-- =================================================
                 BOTONES
            ================================================== --}}

            <div class="provider-form-footer">

                <a
                    href="{{ route('proveedores.show', $proveedor) }}"
                    class="provider-form-button provider-form-button-secondary"
                >
                    Cancelar
                </a>


                <button
                    type="submit"
                    class="provider-form-button provider-form-button-primary"
                >
                    Guardar bodega
                </button>

            </div>


        </div>

    </form>

@endsection