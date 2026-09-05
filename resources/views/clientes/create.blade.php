@extends('layouts.app')

@section('title', 'Nuevo cliente')

@section('topbar_title', 'Gestión de clientes')

@push('styles')

<style>

    /* =========================================================
       BREADCRUMB
    ========================================================== */

    .client-create-breadcrumb {

        display: flex;

        align-items: center;

        gap: 8px;

        margin-bottom: 18px;

        color: #8a94a6;

        font-size: 12px;

    }


    .client-create-breadcrumb a {

        color: #667085;

        text-decoration: none;

    }


    .client-create-breadcrumb a:hover {

        color: #155a91;

    }


    .client-create-breadcrumb-current {

        color: #344054;

    }


    /* =========================================================
       HEADER
    ========================================================== */

    .client-create-header {

        display: flex;

        align-items: flex-start;

        justify-content: space-between;

        gap: 20px;

        margin-bottom: 25px;

    }


    .client-create-title {

        margin: 0;

        color: #172033;

        font-size: 27px;

        line-height: 1.2;

        font-weight: 700;

        letter-spacing: -.025em;

    }


    .client-create-subtitle {

        margin: 7px 0 0;

        color: #667085;

        font-size: 13px;

    }


    /* =========================================================
       CARD
    ========================================================== */

    .client-create-card {

        background: #ffffff;

        border:
            1px solid #e2e8f0;

        border-radius: 10px;

        box-shadow:
            0 2px 8px rgba(16,47,80,.05);

        margin-bottom: 20px;

        overflow: hidden;

    }


    .client-create-card-header {

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


    .client-create-card-title {

        margin: 0;

        color: #172033;

        font-size: 15px;

        font-weight: 700;

    }


    .client-create-card-description {

        margin: 4px 0 0;

        color: #98a2b3;

        font-size: 11px;

    }


    .client-create-card-body {

        padding: 22px;

    }


    /* =========================================================
       FORMULARIO
    ========================================================== */

    .client-form-grid {

        display: grid;

        grid-template-columns:
            repeat(2, 1fr);

        gap: 17px;

    }


    .client-form-group {

        min-width: 0;

    }


    .client-form-group-full {

        grid-column: 1 / -1;

    }


    .client-form-label {

        display: block;

        margin-bottom: 7px;

        color: #344054;

        font-size: 11px;

        font-weight: 600;

    }


    .client-form-required {

        color: #c0392b;

    }


    .client-form-control {

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


    .client-form-control::placeholder {

        color: #a1aab7;

    }


    .client-form-control:focus {

        border-color: #155a91;

        box-shadow:
            0 0 0 3px rgba(21,90,145,.08);

    }


    textarea.client-form-control {

        min-height: 110px;

        resize: vertical;

        line-height: 1.5;

    }


    .client-form-help {

        margin-top: 5px;

        color: #98a2b3;

        font-size: 10px;

        line-height: 1.4;

    }


    /* =========================================================
       RUT
    ========================================================== */

    .client-rut-wrapper {

        position: relative;

    }


    .client-rut-status {

        position: absolute;

        right: 11px;

        top: 50%;

        transform:
            translateY(-50%);

        color: #98a2b3;

        font-size: 10px;

        pointer-events: none;

    }


    /* =========================================================
       INFORMACIÓN
    ========================================================== */

    .client-info-box {

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


    .client-info-icon {

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


    .client-info-box strong {

        color: #155a91;

    }


    /* =========================================================
       FOOTER
    ========================================================== */

    .client-form-footer {

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


    .client-form-footer-note {

        color: #98a2b3;

        font-size: 10px;

    }


    .client-form-footer-actions {

        display: flex;

        gap: 9px;

    }


    /* =========================================================
       ERRORES
    ========================================================== */

    .client-validation-alert {

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


    .client-validation-alert strong {

        display: block;

        margin-bottom: 6px;

        font-size: 12px;

    }


    .client-validation-alert ul {

        margin: 0;

        padding-left: 18px;

    }


    .client-validation-alert li {

        margin-bottom: 3px;

    }


    /* =========================================================
       RESPONSIVE
    ========================================================== */

    @media (max-width: 900px) {

        .client-form-grid {

            grid-template-columns: 1fr;

        }


        .client-form-group-full {

            grid-column: auto;

        }

    }


    @media (max-width: 700px) {

        .client-create-header {

            flex-direction: column;

        }


        .client-create-header .btn {

            width: 100%;

        }


        .client-create-card-body {

            padding: 17px;

        }


        .client-form-footer {

            align-items: stretch;

            flex-direction: column;

        }


        .client-form-footer-actions {

            width: 100%;

        }


        .client-form-footer-actions .btn {

            flex: 1;

        }

    }

</style>

@endpush


@section('content')

    {{-- =====================================================
         BREADCRUMB
    ====================================================== --}}

    <div class="client-create-breadcrumb">

        <a href="{{ route('clientes.index') }}">
            Clientes
        </a>

        <span>›</span>

        <span class="client-create-breadcrumb-current">
            Nuevo cliente
        </span>

    </div>


    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="client-create-header">

        <div>

            <h1 class="client-create-title">
                Nuevo cliente
            </h1>

            <p class="client-create-subtitle">
                Registra los antecedentes principales del cliente.
            </p>

        </div>


        <a
            href="{{ route('clientes.index') }}"
            class="btn"
        >
            ← Volver a clientes
        </a>

    </div>


    {{-- =====================================================
         ERRORES
    ====================================================== --}}

    @if($errors->any())

        <div class="client-validation-alert">

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
        action="{{ route('clientes.store') }}"
        method="POST"
        id="clientCreateForm"
    >

        @csrf


        {{-- =================================================
             INFORMACIÓN GENERAL
        ================================================== --}}

        <section class="client-create-card">

            <div class="client-create-card-header">

                <div>

                    <h2 class="client-create-card-title">
                        Información general
                    </h2>

                    <p class="client-create-card-description">
                        Datos de identificación y contacto.
                    </p>

                </div>

            </div>


            <div class="client-create-card-body">

                <div class="client-info-box">

                    <div class="client-info-icon">
                        i
                    </div>

                    <div>

                        <strong>
                            Información del cliente
                        </strong>

                        <br>

                        El cliente podrá ser asociado posteriormente a operaciones, entregas y otros procesos del sistema.

                    </div>

                </div>


                <div class="client-form-grid">


                    {{-- RAZÓN SOCIAL --}}

                    <div class="client-form-group client-form-group-full">

                        <label
                            class="client-form-label"
                            for="razon_social"
                        >

                            Razón social

                            <span class="client-form-required">
                                *
                            </span>

                        </label>


                        <input
                            type="text"
                            id="razon_social"
                            name="razon_social"
                            class="client-form-control"
                            value="{{ old('razon_social') }}"
                            placeholder="Ej. Empresa de Servicios SpA"
                            maxlength="255"
                            required
                            autofocus
                        >

                        <div class="client-form-help">
                            Nombre legal o razón social del cliente.
                        </div>

                    </div>


                    {{-- RUT --}}

                    <div class="client-form-group">

                        <label
                            class="client-form-label"
                            for="rut"
                        >

                            RUT

                            <span class="client-form-required">
                                *
                            </span>

                        </label>


                        <div class="client-rut-wrapper">

                            <input
                                type="text"
                                id="rut"
                                name="rut"
                                class="client-form-control"
                                value="{{ old('rut') }}"
                                placeholder="Ej. 76.123.456-7"
                                maxlength="20"
                                required
                            >

                        </div>


                        <div class="client-form-help">
                            Identificador tributario del cliente.
                        </div>

                    </div>


                    {{-- COMUNA --}}

                    <div class="client-form-group">

                        <label
                            class="client-form-label"
                            for="comuna"
                        >
                            Comuna
                        </label>


                        <input
                            type="text"
                            id="comuna"
                            name="comuna"
                            class="client-form-control"
                            value="{{ old('comuna') }}"
                            placeholder="Ej. Concepción"
                            maxlength="255"
                        >

                    </div>


                    {{-- TELÉFONO --}}

                    <div class="client-form-group">

                        <label
                            class="client-form-label"
                            for="telefono"
                        >
                            Teléfono
                        </label>


                        <input
                            type="tel"
                            id="telefono"
                            name="telefono"
                            class="client-form-control"
                            value="{{ old('telefono') }}"
                            placeholder="Ej. +56 9 1234 5678"
                            maxlength="30"
                        >

                    </div>


                    {{-- CORREO --}}

                    <div class="client-form-group">

                        <label
                            class="client-form-label"
                            for="correo"
                        >
                            Correo electrónico
                        </label>


                        <input
                            type="email"
                            id="correo"
                            name="correo"
                            class="client-form-control"
                            value="{{ old('correo') }}"
                            placeholder="Ej. contacto@empresa.cl"
                            maxlength="255"
                        >

                    </div>


                    {{-- DIRECCIÓN --}}

                    <div class="client-form-group client-form-group-full">

                        <label
                            class="client-form-label"
                            for="direccion"
                        >
                            Dirección
                        </label>


                        <input
                            type="text"
                            id="direccion"
                            name="direccion"
                            class="client-form-control"
                            value="{{ old('direccion') }}"
                            placeholder="Ej. Avenida Principal 123"
                            maxlength="255"
                        >

                    </div>


                    {{-- OBSERVACIONES --}}

                    <div class="client-form-group client-form-group-full">

                        <label
                            class="client-form-label"
                            for="observaciones"
                        >
                            Observaciones
                        </label>


                        <textarea
                            id="observaciones"
                            name="observaciones"
                            class="client-form-control"
                            placeholder="Información adicional del cliente..."
                        >{{ old('observaciones') }}</textarea>

                    </div>

                </div>

            </div>

        </section>


        {{-- =================================================
             FOOTER
        ================================================== --}}

        <div class="client-create-card">

            <div class="client-form-footer">

                <div class="client-form-footer-note">

                    <span class="client-form-required">
                        *
                    </span>

                    Campos obligatorios.

                </div>


                <div class="client-form-footer-actions">

                    <a
                        href="{{ route('clientes.index') }}"
                        class="btn"
                    >
                        Cancelar
                    </a>


                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Guardar cliente
                    </button>

                </div>

            </div>

        </div>

    </form>

@endsection