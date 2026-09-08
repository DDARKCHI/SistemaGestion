@extends('layouts.app')

@section('title', 'Nuevo ejecutivo')

@section('topbar_title', 'Gestión de proveedores')

@push('styles')

<style>

    /* =========================================================
       BREADCRUMB
    ========================================================== */

    .executive-create-breadcrumb {

        display: flex;

        align-items: center;

        gap: 8px;

        margin-bottom: 18px;

        color: #8a94a6;

        font-size: 12px;

    }


    .executive-create-breadcrumb a {

        color: #667085;

        text-decoration: none;

    }


    .executive-create-breadcrumb a:hover {

        color: #155a91;

    }


    .executive-create-breadcrumb-current {

        color: #344054;

    }


    /* =========================================================
       HEADER
    ========================================================== */

    .executive-create-header {

        display: flex;

        align-items: flex-start;

        justify-content: space-between;

        gap: 20px;

        margin-bottom: 25px;

    }


    .executive-create-title {

        margin: 0;

        color: #172033;

        font-size: 27px;

        line-height: 1.2;

        font-weight: 700;

        letter-spacing: -.025em;

    }


    .executive-create-subtitle {

        margin: 7px 0 0;

        color: #667085;

        font-size: 13px;

    }


    /* =========================================================
       CARD
    ========================================================== */

    .executive-create-card {

        background: #ffffff;

        border:
            1px solid #e2e8f0;

        border-radius: 10px;

        box-shadow:
            0 2px 8px rgba(16,47,80,.05);

        margin-bottom: 20px;

        overflow: hidden;

    }


    .executive-create-card-header {

        min-height: 67px;

        padding:
            17px 21px;

        border-bottom:
            1px solid #edf1f5;

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 15px;

    }


    .executive-create-card-title {

        margin: 0;

        color: #172033;

        font-size: 15px;

        font-weight: 700;

    }


    .executive-create-card-description {

        margin: 4px 0 0;

        color: #98a2b3;

        font-size: 11px;

    }


    .executive-create-card-body {

        padding: 22px;

    }


    /* =========================================================
       FORMULARIO
    ========================================================== */

    .executive-form-grid {

        display: grid;

        grid-template-columns:
            repeat(2, 1fr);

        gap: 17px;

    }


    .executive-form-group {

        min-width: 0;

    }


    .executive-form-group-full {

        grid-column: 1 / -1;

    }


    .executive-form-label {

        display: block;

        margin-bottom: 7px;

        color: #344054;

        font-size: 11px;

        font-weight: 600;

    }


    .executive-form-required {

        color: #c0392b;

    }


    .executive-form-control {

        width: 100%;

        min-height: 40px;

        padding:
            9px 11px;

        box-sizing: border-box;

        border:
            1px solid #d8e0e8;

        border-radius: 7px;

        background: #ffffff;

        color: #344054;

        font-family: inherit;

        font-size: 12px;

        outline: none;

        transition:
            border-color .15s ease,
            box-shadow .15s ease;

    }


    .executive-form-control::placeholder {

        color: #a1aab7;

    }


    .executive-form-control:focus {

        border-color: #155a91;

        box-shadow:
            0 0 0 3px rgba(21,90,145,.08);

    }


    textarea.executive-form-control {

        min-height: 110px;

        resize: vertical;

        line-height: 1.5;

    }


    .executive-form-help {

        margin-top: 5px;

        color: #98a2b3;

        font-size: 10px;

        line-height: 1.4;

    }


    /* =========================================================
       INFORMACIÓN
    ========================================================== */

    .executive-info-box {

        display: flex;

        align-items: flex-start;

        gap: 10px;

        margin-bottom: 20px;

        padding:
            13px 15px;

        border:
            1px solid #dce9f3;

        border-radius: 7px;

        background: #f4f8fb;

        color: #667085;

        font-size: 11px;

        line-height: 1.5;

    }


    .executive-info-icon {

        flex-shrink: 0;

        width: 22px;

        height: 22px;

        border-radius: 6px;

        background: #e2eef6;

        color: #155a91;

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 11px;

        font-weight: 700;

    }


    .executive-info-box strong {

        color: #155a91;

    }


    /* =========================================================
       FOOTER
    ========================================================== */

    .executive-form-footer {

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 15px;

        padding:
            18px 22px;

        background: #f8fafc;

        border-top:
            1px solid #edf1f5;

    }


    .executive-form-footer-note {

        color: #98a2b3;

        font-size: 10px;

    }


    .executive-form-footer-actions {

        display: flex;

        gap: 9px;

    }


    /* =========================================================
       ERRORES
    ========================================================== */

    .executive-validation-alert {

        margin-bottom: 20px;

        padding:
            13px 16px;

        border:
            1px solid #f1ceca;

        border-radius: 7px;

        background: #fff5f3;

        color: #a63228;

        font-size: 11px;

    }


    .executive-validation-alert strong {

        display: block;

        margin-bottom: 6px;

        font-size: 12px;

    }


    .executive-validation-alert ul {

        margin: 0;

        padding-left: 18px;

    }


    .executive-validation-alert li {

        margin-bottom: 3px;

    }


    .executive-form-control.is-error {

        border-color: #c0392b;

    }


    .executive-form-error {

        margin-top: 5px;

        color: #b9382e;

        font-size: 9px;

    }


    /* =========================================================
       RESPONSIVE
    ========================================================== */

    @media (max-width: 900px) {

        .executive-form-grid {

            grid-template-columns: 1fr;

        }


        .executive-form-group-full {

            grid-column: auto;

        }

    }


    @media (max-width: 700px) {

        .executive-create-header {

            flex-direction: column;

        }


        .executive-create-header .btn {

            width: 100%;

        }


        .executive-create-card-body {

            padding: 17px;

        }


        .executive-form-footer {

            align-items: stretch;

            flex-direction: column;

        }


        .executive-form-footer-actions {

            width: 100%;

        }


        .executive-form-footer-actions .btn {

            flex: 1;

        }

    }

</style>

@endpush


@section('content')

    {{-- =====================================================
         BREADCRUMB
    ====================================================== --}}

    <div class="executive-create-breadcrumb">

        <a href="{{ route('proveedores.index') }}">
            Proveedores
        </a>

        <span>›</span>

        <a href="{{ route('proveedores.show', $proveedor) }}">
            {{ $proveedor->nombre }}
        </a>

        <span>›</span>

        <span class="executive-create-breadcrumb-current">
            Nuevo ejecutivo
        </span>

    </div>


    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="executive-create-header">

        <div>

            <h1 class="executive-create-title">
                Nuevo ejecutivo
            </h1>

            <p class="executive-create-subtitle">
                Registra los antecedentes principales del ejecutivo.
            </p>

        </div>


        <a
            href="{{ route('proveedores.show', $proveedor) }}"
            class="btn"
        >
            ← Volver a proveedor
        </a>

    </div>


    {{-- =====================================================
         ERRORES
    ====================================================== --}}

    @if($errors->any())

        <div class="executive-validation-alert">

            <strong>
                Revisa la información ingresada
            </strong>

            <ul>

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- =====================================================
         FORMULARIO
    ====================================================== --}}

    <form
        action="{{ route('proveedores.ejecutivos.store', $proveedor) }}"
        method="POST"
        id="executiveCreateForm"
    >

        @csrf


        {{-- =================================================
             INFORMACIÓN DEL EJECUTIVO
        ================================================== --}}

        <section class="executive-create-card">

            <div class="executive-create-card-header">

                <div>

                    <h2 class="executive-create-card-title">
                        Información del ejecutivo
                    </h2>

                    <p class="executive-create-card-description">
                        Datos de identificación y contacto.
                    </p>

                </div>

            </div>


            <div class="executive-create-card-body">


                {{-- INFORMACIÓN DEL PROVEEDOR --}}

                <div class="executive-info-box">

                    <div class="executive-info-icon">
                        i
                    </div>

                    <div>

                        <strong>
                            Proveedor asociado
                        </strong>

                        <br>

                        {{ $proveedor->nombre }}

                        <br>

                        RUT: {{ $proveedor->rut }}

                    </div>

                </div>


                <div class="executive-form-grid">


                    {{-- NOMBRE --}}

                    <div class="executive-form-group">

                        <label
                            class="executive-form-label"
                            for="nombre"
                        >

                            Nombre completo

                            <span class="executive-form-required">
                                *
                            </span>

                        </label>


                        <input
                            type="text"
                            id="nombre"
                            name="nombre"
                            class="executive-form-control @error('nombre') is-error @enderror"
                            value="{{ old('nombre') }}"
                            placeholder="Ej. Juan Pérez"
                            maxlength="150"
                            required
                            autofocus
                        >


                        <div class="executive-form-help">
                            Nombre y apellido del ejecutivo.
                        </div>


                        @error('nombre')

                            <div class="executive-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- CARGO --}}

                    <div class="executive-form-group">

                        <label
                            class="executive-form-label"
                            for="cargo"
                        >
                            Cargo
                        </label>


                        <input
                            type="text"
                            id="cargo"
                            name="cargo"
                            class="executive-form-control @error('cargo') is-error @enderror"
                            value="{{ old('cargo') }}"
                            placeholder="Ej. Ejecutivo comercial"
                            maxlength="100"
                        >


                        <div class="executive-form-help">
                            Cargo o función que desempeña dentro del proveedor.
                        </div>


                        @error('cargo')

                            <div class="executive-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- CORREO --}}

                    <div class="executive-form-group">

                        <label
                            class="executive-form-label"
                            for="correo"
                        >
                            Correo electrónico
                        </label>


                        <input
                            type="email"
                            id="correo"
                            name="correo"
                            class="executive-form-control @error('correo') is-error @enderror"
                            value="{{ old('correo') }}"
                            placeholder="Ej. ejecutivo@empresa.cl"
                            maxlength="150"
                        >


                        <div class="executive-form-help">
                            Correo utilizado para contacto con el proveedor.
                        </div>


                        @error('correo')

                            <div class="executive-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- TELÉFONO --}}

                    <div class="executive-form-group">

                        <label
                            class="executive-form-label"
                            for="telefono"
                        >
                            Teléfono
                        </label>


                        <input
                            type="tel"
                            id="telefono"
                            name="telefono"
                            class="executive-form-control @error('telefono') is-error @enderror"
                            value="{{ old('telefono') }}"
                            placeholder="Ej. +56 9 1234 5678"
                            maxlength="50"
                        >


                        <div class="executive-form-help">
                            Teléfono o número de contacto directo.
                        </div>


                        @error('telefono')

                            <div class="executive-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- OBSERVACIONES --}}

                    <div class="executive-form-group executive-form-group-full">

                        <label
                            class="executive-form-label"
                            for="observaciones"
                        >
                            Observaciones
                        </label>


                        <textarea
                            id="observaciones"
                            name="observaciones"
                            class="executive-form-control @error('observaciones') is-error @enderror"
                            placeholder="Información adicional del ejecutivo..."
                        >{{ old('observaciones') }}</textarea>


                        @error('observaciones')

                            <div class="executive-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                </div>

            </div>

        </section>


        {{-- =================================================
             FOOTER
        ================================================== --}}

        <div class="executive-create-card">

            <div class="executive-form-footer">

                <div class="executive-form-footer-note">

                    <span class="executive-form-required">
                        *
                    </span>

                    Campos obligatorios.

                </div>


                <div class="executive-form-footer-actions">

                    <a
                        href="{{ route('proveedores.show', $proveedor) }}"
                        class="btn"
                    >
                        Cancelar
                    </a>


                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Guardar ejecutivo
                    </button>

                </div>

            </div>

        </div>

    </form>

@endsection