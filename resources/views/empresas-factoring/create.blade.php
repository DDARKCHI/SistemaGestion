@extends('layouts.app')

@section('title', 'Nueva empresa de factoring')

@section('topbar_title', 'Gestión de empresas de factoring')

@push('styles')

<style>

    /* =========================================================
       BREADCRUMB
    ========================================================== */

    .factoring-create-breadcrumb {

        display: flex;

        align-items: center;

        gap: 8px;

        margin-bottom: 18px;

        color: #8a94a6;

        font-size: 12px;

    }


    .factoring-create-breadcrumb a {

        color: #667085;

        text-decoration: none;

    }


    .factoring-create-breadcrumb a:hover {

        color: #155a91;

    }


    .factoring-create-breadcrumb-current {

        color: #344054;

    }


    /* =========================================================
       HEADER
    ========================================================== */

    .factoring-create-header {

        display: flex;

        align-items: flex-start;

        justify-content: space-between;

        gap: 20px;

        margin-bottom: 25px;

    }


    .factoring-create-title {

        margin: 0;

        color: #172033;

        font-size: 27px;

        line-height: 1.2;

        font-weight: 700;

        letter-spacing: -.025em;

    }


    .factoring-create-subtitle {

        margin: 7px 0 0;

        color: #667085;

        font-size: 13px;

    }


    /* =========================================================
       CARD
    ========================================================== */

    .factoring-create-card {

        background: #ffffff;

        border:
            1px solid #e2e8f0;

        border-radius: 10px;

        box-shadow:
            0 2px 8px rgba(16,47,80,.05);

        margin-bottom: 20px;

        overflow: hidden;

    }


    .factoring-create-card-header {

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


    .factoring-create-card-title {

        margin: 0;

        color: #172033;

        font-size: 15px;

        font-weight: 700;

    }


    .factoring-create-card-description {

        margin: 4px 0 0;

        color: #98a2b3;

        font-size: 11px;

    }


    .factoring-create-card-body {

        padding: 22px;

    }


    /* =========================================================
       FORMULARIO
    ========================================================== */

    .factoring-form-grid {

        display: grid;

        grid-template-columns:
            repeat(2, 1fr);

        gap: 17px;

    }


    .factoring-form-group {

        min-width: 0;

    }


    .factoring-form-group-full {

        grid-column: 1 / -1;

    }


    .factoring-form-label {

        display: block;

        margin-bottom: 7px;

        color: #344054;

        font-size: 11px;

        font-weight: 600;

    }


    .factoring-form-required {

        color: #c0392b;

    }


    .factoring-form-control {

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


    .factoring-form-control::placeholder {

        color: #a1aab7;

    }


    .factoring-form-control:focus {

        border-color: #155a91;

        box-shadow:
            0 0 0 3px rgba(21,90,145,.08);

    }


    textarea.factoring-form-control {

        min-height: 110px;

        resize: vertical;

        line-height: 1.5;

    }


    .factoring-form-help {

        margin-top: 5px;

        color: #98a2b3;

        font-size: 10px;

        line-height: 1.4;

    }


    /* =========================================================
       SELECT
    ========================================================== */

    select.factoring-form-control {

        cursor: pointer;

    }


    /* =========================================================
       INFORMACIÓN
    ========================================================== */

    .factoring-info-box {

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


    .factoring-info-icon {

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


    .factoring-info-box strong {

        color: #155a91;

    }


    /* =========================================================
       FOOTER
    ========================================================== */

    .factoring-form-footer {

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


    .factoring-form-footer-note {

        color: #98a2b3;

        font-size: 10px;

    }


    .factoring-form-footer-actions {

        display: flex;

        gap: 9px;

    }


    /* =========================================================
       ERRORES
    ========================================================== */

    .factoring-validation-alert {

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


    .factoring-validation-alert strong {

        display: block;

        margin-bottom: 6px;

        font-size: 12px;

    }


    .factoring-validation-alert ul {

        margin: 0;

        padding-left: 18px;

    }


    .factoring-validation-alert li {

        margin-bottom: 3px;

    }


    /* =========================================================
       RESPONSIVE
    ========================================================== */

    @media (max-width: 900px) {

        .factoring-form-grid {

            grid-template-columns: 1fr;

        }


        .factoring-form-group-full {

            grid-column: auto;

        }

    }


    @media (max-width: 700px) {

        .factoring-create-header {

            flex-direction: column;

        }


        .factoring-create-header .btn {

            width: 100%;

        }


        .factoring-create-card-body {

            padding: 17px;

        }


        .factoring-form-footer {

            align-items: stretch;

            flex-direction: column;

        }


        .factoring-form-footer-actions {

            width: 100%;

        }


        .factoring-form-footer-actions .btn {

            flex: 1;

        }

    }

</style>

@endpush


@section('content')

    {{-- =====================================================
         BREADCRUMB
    ====================================================== --}}

    <div class="factoring-create-breadcrumb">

        <a href="{{ route('empresas-factoring.index') }}">
            Empresas de Factoring
        </a>

        <span>›</span>

        <span class="factoring-create-breadcrumb-current">
            Nueva empresa
        </span>

    </div>


    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="factoring-create-header">

        <div>

            <h1 class="factoring-create-title">
                Nueva empresa de factoring
            </h1>

            <p class="factoring-create-subtitle">
                Registra los antecedentes de la empresa de factoring.
            </p>

        </div>


        <a
            href="{{ route('empresas-factoring.index') }}"
            class="btn"
        >
            ← Volver a empresas
        </a>

    </div>


    {{-- =====================================================
         ERRORES
    ====================================================== --}}

    @if($errors->any())

        <div class="factoring-validation-alert">

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
        action="{{ route('empresas-factoring.store') }}"
        method="POST"
        id="factoringCreateForm"
    >

        @csrf


        {{-- =================================================
             INFORMACIÓN GENERAL
        ================================================== --}}

        <section class="factoring-create-card">

            <div class="factoring-create-card-header">

                <div>

                    <h2 class="factoring-create-card-title">
                        Información general
                    </h2>

                    <p class="factoring-create-card-description">
                        Datos de identificación y contacto de la empresa.
                    </p>

                </div>

            </div>


            <div class="factoring-create-card-body">

                <div class="factoring-info-box">

                    <div class="factoring-info-icon">
                        i
                    </div>

                    <div>

                        <strong>
                            Empresa de factoring
                        </strong>

                        <br>

                        Esta información identifica a la empresa que posteriormente podrá asociarse a operaciones de factoring y sus respectivos curses.

                    </div>

                </div>


                <div class="factoring-form-grid">


                    {{-- NOMBRE --}}

                    <div class="factoring-form-group factoring-form-group-full">

                        <label
                            class="factoring-form-label"
                            for="nombre"
                        >

                            Nombre / razón social

                            <span class="factoring-form-required">
                                *
                            </span>

                        </label>


                        <input
                            type="text"
                            id="nombre"
                            name="nombre"
                            class="factoring-form-control"
                            value="{{ old('nombre') }}"
                            placeholder="Ej. Factoring Financiero SpA"
                            maxlength="255"
                            required
                            autofocus
                        >


                        <div class="factoring-form-help">
                            Nombre legal o razón social de la empresa de factoring.
                        </div>

                    </div>


                    {{-- RUT --}}

                    <div class="factoring-form-group">

                        <label
                            class="factoring-form-label"
                            for="rut"
                        >

                            RUT

                            <span class="factoring-form-required">
                                *
                            </span>

                        </label>


                        <input
                            type="text"
                            id="rut"
                            name="rut"
                            class="factoring-form-control"
                            value="{{ old('rut') }}"
                            placeholder="Ej. 76.123.456-7"
                            maxlength="20"
                            required
                        >


                        <div class="factoring-form-help">
                            RUT de la empresa de factoring.
                        </div>

                    </div>


                    {{-- ESTADO --}}

                    <div class="factoring-form-group">

                        <label
                            class="factoring-form-label"
                            for="estado"
                        >

                            Estado

                            <span class="factoring-form-required">
                                *
                            </span>

                        </label>


                        <select
                            id="estado"
                            name="estado"
                            class="factoring-form-control"
                            required
                        >

                            <option
                                value="activo"
                                {{ old('estado', 'activo') === 'activo' ? 'selected' : '' }}
                            >
                                Activo
                            </option>

                            <option
                                value="inactivo"
                                {{ old('estado') === 'inactivo' ? 'selected' : '' }}
                            >
                                Inactivo
                            </option>

                        </select>


                        <div class="factoring-form-help">
                            Las empresas inactivas podrán conservar su historial.
                        </div>

                    </div>


                    {{-- CORREO --}}

                    <div class="factoring-form-group">

                        <label
                            class="factoring-form-label"
                            for="correo"
                        >
                            Correo electrónico
                        </label>


                        <input
                            type="email"
                            id="correo"
                            name="correo"
                            class="factoring-form-control"
                            value="{{ old('correo') }}"
                            placeholder="Ej. contacto@factoring.cl"
                            maxlength="255"
                        >

                    </div>


                    {{-- TELÉFONO --}}

                    <div class="factoring-form-group">

                        <label
                            class="factoring-form-label"
                            for="telefono"
                        >
                            Teléfono
                        </label>


                        <input
                            type="tel"
                            id="telefono"
                            name="telefono"
                            class="factoring-form-control"
                            value="{{ old('telefono') }}"
                            placeholder="Ej. +56 9 1234 5678"
                            maxlength="50"
                        >

                    </div>

                </div>

            </div>

        </section>


        {{-- =================================================
             EJECUTIVO
        ================================================== --}}

        <section class="factoring-create-card">

            <div class="factoring-create-card-header">

                <div>

                    <h2 class="factoring-create-card-title">
                        Ejecutivo de contacto
                    </h2>

                    <p class="factoring-create-card-description">
                        Información del ejecutivo responsable de la relación con la empresa.
                    </p>

                </div>

            </div>


            <div class="factoring-create-card-body">

                <div class="factoring-form-grid">


                    {{-- EJECUTIVO --}}

                    <div class="factoring-form-group">

                        <label
                            class="factoring-form-label"
                            for="ejecutivo"
                        >
                            Ejecutivo
                        </label>


                        <input
                            type="text"
                            id="ejecutivo"
                            name="ejecutivo"
                            class="factoring-form-control"
                            value="{{ old('ejecutivo') }}"
                            placeholder="Ej. Juan Pérez"
                            maxlength="255"
                        >

                    </div>


                    {{-- TELÉFONO EJECUTIVO --}}

                    <div class="factoring-form-group">

                        <label
                            class="factoring-form-label"
                            for="telefono_ejecutivo"
                        >
                            Teléfono del ejecutivo
                        </label>


                        <input
                            type="tel"
                            id="telefono_ejecutivo"
                            name="telefono_ejecutivo"
                            class="factoring-form-control"
                            value="{{ old('telefono_ejecutivo') }}"
                            placeholder="Ej. +56 9 8765 4321"
                            maxlength="50"
                        >

                    </div>

                </div>

            </div>

        </section>


        {{-- =================================================
             DATOS BANCARIOS Y ADICIONALES
        ================================================== --}}

        <section class="factoring-create-card">

            <div class="factoring-create-card-header">

                <div>

                    <h2 class="factoring-create-card-title">
                        Datos bancarios y adicionales
                    </h2>

                    <p class="factoring-create-card-description">
                        Información complementaria para la gestión de la empresa.
                    </p>

                </div>

            </div>


            <div class="factoring-create-card-body">

                <div class="factoring-form-grid">


                    {{-- CUENTA BANCARIA --}}

                    <div class="factoring-form-group factoring-form-group-full">

                        <label
                            class="factoring-form-label"
                            for="cuenta_bancaria"
                        >
                            Cuenta bancaria
                        </label>


                        <input
                            type="text"
                            id="cuenta_bancaria"
                            name="cuenta_bancaria"
                            class="factoring-form-control"
                            value="{{ old('cuenta_bancaria') }}"
                            placeholder="Ej. Banco / tipo de cuenta / número"
                            maxlength="255"
                        >


                        <div class="factoring-form-help">
                            Campo opcional para registrar los antecedentes bancarios utilizados para la gestión.
                        </div>

                    </div>


                    {{-- OTROS DATOS --}}

                    <div class="factoring-form-group factoring-form-group-full">

                        <label
                            class="factoring-form-label"
                            for="otros_datos"
                        >
                            Otros datos
                        </label>


                        <textarea
                            id="otros_datos"
                            name="otros_datos"
                            class="factoring-form-control"
                            placeholder="Información adicional de la empresa de factoring..."
                        >{{ old('otros_datos') }}</textarea>

                    </div>

                </div>

            </div>

        </section>


        {{-- =================================================
             FOOTER
        ================================================== --}}

        <div class="factoring-create-card">

            <div class="factoring-form-footer">

                <div class="factoring-form-footer-note">

                    <span class="factoring-form-required">
                        *
                    </span>

                    Campos obligatorios.

                </div>


                <div class="factoring-form-footer-actions">

                    <a
                        href="{{ route('empresas-factoring.index') }}"
                        class="btn"
                    >
                        Cancelar
                    </a>


                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Guardar empresa
                    </button>

                </div>

            </div>

        </div>

    </form>

@endsection