@extends('layouts.app')

@section('title', 'Nuevo transportista')

@section('topbar_title', 'Gestión de transportistas')

@push('styles')

<style>

    /* =========================================================
       HEADER
    ========================================================== */

    .carrier-form-header {

        display: flex;

        align-items: flex-start;

        justify-content: space-between;

        gap: 20px;

        margin-bottom: 24px;

    }


    .carrier-form-title {

        margin: 0;

        color: #172033;

        font-size: 27px;

        line-height: 1.2;

        font-weight: 700;

        letter-spacing: -.025em;

    }


    .carrier-form-subtitle {

        margin: 7px 0 0;

        color: #667085;

        font-size: 13px;

    }


    .carrier-form-back {

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


    .carrier-form-back:hover {

        background: #f7f9fb;

        color: #155a91;

        border-color: #cbd7e3;

    }


    /* =========================================================
       CONTENEDOR
    ========================================================== */

    .carrier-form-card {

        width: 100%;

        max-width: none;

        background: #ffffff;

        border: 1px solid #e2e8f0;

        border-radius: 10px;

        box-shadow:
            0 2px 8px rgba(16,47,80,.05);

        overflow: hidden;

    }


    .carrier-form-section {

        padding: 22px 24px;

        border-bottom: 1px solid #edf1f5;

    }


    .carrier-form-section:last-child {

        border-bottom: none;

    }


    .carrier-form-section-title {

        margin: 0;

        color: #172033;

        font-size: 14px;

        font-weight: 700;

    }


    .carrier-form-section-description {

        margin: 5px 0 18px;

        color: #98a2b3;

        font-size: 10px;

        line-height: 1.5;

    }


    /* =========================================================
       GRID
    ========================================================== */

    .carrier-form-grid {

        display: grid;

        grid-template-columns:
            repeat(2, minmax(0, 1fr));

        gap: 17px 20px;

    }


    .carrier-form-group {

        min-width: 0;

    }


    .carrier-form-group-full {

        grid-column: 1 / -1;

    }


    /* =========================================================
       LABELS
    ========================================================== */

    .carrier-form-label {

        display: block;

        margin-bottom: 6px;

        color: #344054;

        font-size: 10px;

        font-weight: 600;

    }


    .carrier-form-required {

        color: #c0392b;

    }


    /* =========================================================
       INPUTS
    ========================================================== */

    .carrier-form-input,
    .carrier-form-textarea {

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


    .carrier-form-input {

        height: 38px;

        padding: 0 11px;

    }


    .carrier-form-textarea {

        min-height: 90px;

        padding: 10px 11px;

        resize: vertical;

        line-height: 1.5;

    }


    .carrier-form-input::placeholder,
    .carrier-form-textarea::placeholder {

        color: #a1aab7;

    }


    .carrier-form-input:focus,
    .carrier-form-textarea:focus {

        border-color: #155a91;

        box-shadow:
            0 0 0 3px rgba(21,90,145,.08);

    }


    /* =========================================================
       AYUDAS
    ========================================================== */

    .carrier-form-help {

        margin-top: 5px;

        color: #98a2b3;

        font-size: 9px;

        line-height: 1.4;

    }


    /* =========================================================
       ERRORES
    ========================================================== */

    .carrier-form-error {

        margin-top: 5px;

        color: #b42318;

        font-size: 9px;

    }


    .carrier-form-input.is-error,
    .carrier-form-textarea.is-error {

        border-color: #d92d20;

    }


    /* =========================================================
       ALERTA GENERAL
    ========================================================== */

    .carrier-form-alert {

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

    .carrier-form-footer {

        display: flex;

        align-items: center;

        justify-content: flex-end;

        gap: 9px;

        padding: 16px 24px;

        background: #fbfcfd;

        border-top: 1px solid #edf1f5;

    }


    .carrier-form-button {

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


    .carrier-form-button-secondary {

        border: 1px solid #dce3eb;

        background: #ffffff;

        color: #344054;

    }


    .carrier-form-button-secondary:hover {

        background: #f7f9fb;

        color: #155a91;

    }


    .carrier-form-button-primary {

        border: 1px solid #155a91;

        background: #155a91;

        color: #ffffff;

    }


    .carrier-form-button-primary:hover {

        border-color: #124d7d;

        background: #124d7d;

    }


    @media (max-width: 700px) {

        .carrier-form-header {

            flex-direction: column;

        }


        .carrier-form-grid {

            grid-template-columns: 1fr;

        }


        .carrier-form-group-full {

            grid-column: auto;

        }


        .carrier-form-footer {

            flex-direction: column-reverse;

            align-items: stretch;

        }


        .carrier-form-button {

            width: 100%;

        }

    }

</style>

@endpush


@section('content')

    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="carrier-form-header">

        <div>

            <h1 class="carrier-form-title">
                Nuevo transportista
            </h1>

            <p class="carrier-form-subtitle">
                Registra los antecedentes principales del transportista.
            </p>

        </div>


        <a
            href="{{ route('transportistas.index') }}"
            class="carrier-form-back"
        >
            ← Volver a transportistas
        </a>

    </div>


    {{-- =====================================================
         ERRORES
    ====================================================== --}}

    @if($errors->any())

        <div class="carrier-form-alert">

            <strong>
                No se pudo guardar el transportista.
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
        action="{{ route('transportistas.store') }}"
        method="POST"
    >

        @csrf


        <div class="carrier-form-card">


            {{-- =================================================
                 INFORMACIÓN GENERAL
            ================================================== --}}

            <section class="carrier-form-section">

                <h2 class="carrier-form-section-title">
                    Información general
                </h2>

                <p class="carrier-form-section-description">
                    Datos de identificación y ubicación del transportista.
                </p>


                <div class="carrier-form-grid">


                    {{-- NOMBRE --}}

                    <div class="carrier-form-group">

                        <label
                            for="nombre"
                            class="carrier-form-label"
                        >
                            Nombre del transportista
                            <span class="carrier-form-required">*</span>
                        </label>

                        <input
                            type="text"
                            id="nombre"
                            name="nombre"
                            class="carrier-form-input @error('nombre') is-error @enderror"
                            value="{{ old('nombre') }}"
                            maxlength="255"
                            required
                            autofocus
                            placeholder="Ej. Transportes del Sur"
                        >

                        @error('nombre')

                            <div class="carrier-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- RUT --}}

                    <div class="carrier-form-group">

                        <label
                            for="rut"
                            class="carrier-form-label"
                        >
                            RUT
                            <span class="carrier-form-required">*</span>
                        </label>

                        <input
                            type="text"
                            id="rut"
                            name="rut"
                            class="carrier-form-input @error('rut') is-error @enderror"
                            value="{{ old('rut') }}"
                            maxlength="20"
                            required
                            placeholder="Ej. 76.123.456-7"
                        >

                        <div class="carrier-form-help">
                            El RUT debe ser único dentro del registro de transportistas.
                        </div>

                        @error('rut')

                            <div class="carrier-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- TELÉFONO --}}

                    <div class="carrier-form-group">

                        <label
                            for="telefono"
                            class="carrier-form-label"
                        >
                            Teléfono
                        </label>

                        <input
                            type="text"
                            id="telefono"
                            name="telefono"
                            class="carrier-form-input @error('telefono') is-error @enderror"
                            value="{{ old('telefono') }}"
                            maxlength="30"
                            placeholder="+56 9 1234 5678"
                        >

                        @error('telefono')

                            <div class="carrier-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- CORREO --}}

                    <div class="carrier-form-group">

                        <label
                            for="correo"
                            class="carrier-form-label"
                        >
                            Correo electrónico
                        </label>

                        <input
                            type="email"
                            id="correo"
                            name="correo"
                            class="carrier-form-input @error('correo') is-error @enderror"
                            value="{{ old('correo') }}"
                            maxlength="255"
                            placeholder="correo@empresa.cl"
                        >

                        @error('correo')

                            <div class="carrier-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- DIRECCIÓN --}}

                    <div class="carrier-form-group carrier-form-group-full">

                        <label
                            for="direccion"
                            class="carrier-form-label"
                        >
                            Dirección
                        </label>

                        <input
                            type="text"
                            id="direccion"
                            name="direccion"
                            class="carrier-form-input @error('direccion') is-error @enderror"
                            value="{{ old('direccion') }}"
                            maxlength="255"
                            placeholder="Dirección del transportista"
                        >

                        @error('direccion')

                            <div class="carrier-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                </div>

            </section>


            {{-- =================================================
                 OBSERVACIONES
            ================================================== --}}

            <section class="carrier-form-section">

                <h2 class="carrier-form-section-title">
                    Observaciones
                </h2>

                <p class="carrier-form-section-description">
                    Información adicional que sea útil para la gestión del transportista.
                </p>


                <div class="carrier-form-group">

                    <label
                        for="observaciones"
                        class="carrier-form-label"
                    >
                        Observaciones
                    </label>

                    <textarea
                        id="observaciones"
                        name="observaciones"
                        class="carrier-form-textarea @error('observaciones') is-error @enderror"
                        placeholder="Ingresa información adicional del transportista..."
                    >{{ old('observaciones') }}</textarea>

                    @error('observaciones')

                        <div class="carrier-form-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>

            </section>


            {{-- =================================================
                 BOTONES
            ================================================== --}}

            <div class="carrier-form-footer">

                <a
                    href="{{ route('transportistas.index') }}"
                    class="carrier-form-button carrier-form-button-secondary"
                >
                    Cancelar
                </a>


                <button
                    type="submit"
                    class="carrier-form-button carrier-form-button-primary"
                >
                    Guardar transportista
                </button>

            </div>


        </div>

    </form>

@endsection