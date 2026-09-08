@extends('layouts.app')

@section('title', 'Nuevo proveedor')

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

        max-width: 1050px;

        background: #ffffff;

        border: 1px solid #e2e8f0;

        border-radius: 10px;

        box-shadow:
            0 2px 8px rgba(16,47,80,.05);

        overflow: hidden;

    }


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
       ALERTA GENERAL
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
                Nuevo proveedor
            </h1>

            <p class="provider-form-subtitle">
                Registra los antecedentes principales del proveedor.
            </p>

        </div>


        <a
            href="{{ route('proveedores.index') }}"
            class="provider-form-back"
        >
            ← Volver a proveedores
        </a>

    </div>


    {{-- =====================================================
         ERRORES
    ====================================================== --}}

    @if($errors->any())

        <div class="provider-form-alert">

            <strong>
                No se pudo guardar el proveedor.
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
        action="{{ route('proveedores.store') }}"
        method="POST"
    >

        @csrf


        <div class="provider-form-card">


            {{-- =================================================
                 INFORMACIÓN GENERAL
            ================================================== --}}

            <section class="provider-form-section">

                <h2 class="provider-form-section-title">
                    Información general
                </h2>

                <p class="provider-form-section-description">
                    Datos de identificación y ubicación del proveedor.
                </p>


                <div class="provider-form-grid">


                    {{-- NOMBRE --}}

                    <div class="provider-form-group">

                        <label
                            for="nombre"
                            class="provider-form-label"
                        >
                            Nombre del proveedor
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
                            placeholder="Ej. Sodimac"
                        >

                        @error('nombre')

                            <div class="provider-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- RUT --}}

                    <div class="provider-form-group">

                        <label
                            for="rut"
                            class="provider-form-label"
                        >
                            RUT
                            <span class="provider-form-required">*</span>
                        </label>

                        <input
                            type="text"
                            id="rut"
                            name="rut"
                            class="provider-form-input @error('rut') is-error @enderror"
                            value="{{ old('rut') }}"
                            maxlength="20"
                            required
                            placeholder="Ej. 76.123.456-7"
                        >

                        <div class="provider-form-help">
                            El RUT debe ser único dentro del registro de proveedores.
                        </div>

                        @error('rut')

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


                    {{-- CUENTA --}}

                    <div class="provider-form-group">

                        <label
                            for="cuenta"
                            class="provider-form-label"
                        >
                            Cuenta
                        </label>

                        <input
                            type="text"
                            id="cuenta"
                            name="cuenta"
                            class="provider-form-input @error('cuenta') is-error @enderror"
                            value="{{ old('cuenta') }}"
                            maxlength="100"
                            placeholder="Cuenta o referencia interna"
                        >

                        @error('cuenta')

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
                        </label>

                        <input
                            type="text"
                            id="direccion"
                            name="direccion"
                            class="provider-form-input @error('direccion') is-error @enderror"
                            value="{{ old('direccion') }}"
                            maxlength="255"
                            placeholder="Dirección principal del proveedor"
                        >

                        @error('direccion')

                            <div class="provider-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                </div>

            </section>


            {{-- =================================================
                 CONTACTO
            ================================================== --}}

            <section class="provider-form-section">

                <h2 class="provider-form-section-title">
                    Datos de contacto
                </h2>

                <p class="provider-form-section-description">
                    Información utilizada para comunicarse con el proveedor.
                </p>


                <div class="provider-form-grid">


                    {{-- CORREO --}}

                    <div class="provider-form-group">

                        <label
                            for="correo"
                            class="provider-form-label"
                        >
                            Correo electrónico
                        </label>

                        <input
                            type="email"
                            id="correo"
                            name="correo"
                            class="provider-form-input @error('correo') is-error @enderror"
                            value="{{ old('correo') }}"
                            maxlength="150"
                            placeholder="correo@empresa.cl"
                        >

                        @error('correo')

                            <div class="provider-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- TELÉFONO --}}

                    <div class="provider-form-group">

                        <label
                            for="telefono"
                            class="provider-form-label"
                        >
                            Teléfono
                        </label>

                        <input
                            type="text"
                            id="telefono"
                            name="telefono"
                            class="provider-form-input @error('telefono') is-error @enderror"
                            value="{{ old('telefono') }}"
                            maxlength="50"
                            placeholder="+56 9 1234 5678"
                        >

                        @error('telefono')

                            <div class="provider-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                </div>

            </section>


            {{-- =================================================
                 OBSERVACIONES
            ================================================== --}}

            <section class="provider-form-section">

                <h2 class="provider-form-section-title">
                    Observaciones
                </h2>

                <p class="provider-form-section-description">
                    Información adicional que sea útil para la gestión del proveedor.
                </p>


                <div class="provider-form-group">

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
                        placeholder="Ingresa información adicional del proveedor..."
                    >{{ old('observaciones') }}</textarea>

                    @error('observaciones')

                        <div class="provider-form-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>

            </section>


            {{-- =================================================
                 BOTONES
            ================================================== --}}

            <div class="provider-form-footer">

                <a
                    href="{{ route('proveedores.index') }}"
                    class="provider-form-button provider-form-button-secondary"
                >
                    Cancelar
                </a>


                <button
                    type="submit"
                    class="provider-form-button provider-form-button-primary"
                >
                    Guardar proveedor
                </button>

            </div>


        </div>

    </form>

@endsection