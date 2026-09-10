@extends('layouts.app')

@section('title', 'Editar empresa de factoring')

@section('topbar_title', 'Gestión de empresas de factoring')

@push('styles')

<style>

    /* =========================================================
       BREADCRUMB
    ========================================================== */

    .factoring-edit-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 18px;
        color: #8a94a6;
        font-size: 12px;
    }

    .factoring-edit-breadcrumb a {
        color: #667085;
        text-decoration: none;
    }

    .factoring-edit-breadcrumb a:hover {
        color: #155a91;
    }

    .factoring-edit-breadcrumb-current {
        color: #344054;
    }


    /* =========================================================
       HEADER
    ========================================================== */

    .factoring-edit-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 25px;
    }

    .factoring-edit-header-left {
        display: flex;
        align-items: center;
        gap: 13px;
        min-width: 0;
    }

    .factoring-edit-avatar {
        width: 45px;
        height: 45px;
        min-width: 45px;
        border-radius: 9px;
        background: #155a91;
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: 700;
    }

    .factoring-edit-title {
        margin: 0;
        color: #172033;
        font-size: 26px;
        line-height: 1.2;
        font-weight: 700;
        letter-spacing: -.025em;
    }

    .factoring-edit-subtitle {
        margin: 6px 0 0;
        color: #667085;
        font-size: 12px;
    }


    /* =========================================================
       CARD
    ========================================================== */

    .factoring-edit-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(16,47,80,.05);
        margin-bottom: 20px;
        overflow: hidden;
    }

    .factoring-edit-card-header {
        min-height: 67px;
        padding: 17px 21px;
        border-bottom: 1px solid #edf1f5;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
    }

    .factoring-edit-card-title {
        margin: 0;
        color: #172033;
        font-size: 15px;
        font-weight: 700;
    }

    .factoring-edit-card-description {
        margin: 4px 0 0;
        color: #98a2b3;
        font-size: 11px;
    }

    .factoring-edit-card-body {
        padding: 22px;
    }


    /* =========================================================
       INFORMACIÓN
    ========================================================== */

    .factoring-info-box {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin-bottom: 20px;
        padding: 13px 15px;
        border: 1px solid #dce9f3;
        border-radius: 7px;
        background: #f4f8fb;
        color: #667085;
        font-size: 11px;
        line-height: 1.5;
    }

    .factoring-info-icon {
        width: 22px;
        height: 22px;
        min-width: 22px;
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
       FORMULARIO
    ========================================================== */

    .factoring-form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
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
        padding: 9px 11px;
        box-sizing: border-box;
        border: 1px solid #d8e0e8;
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
        box-shadow: 0 0 0 3px rgba(21,90,145,.08);
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
       ESTADO
    ========================================================== */

    .factoring-status-select {
        cursor: pointer;
    }


    /* =========================================================
       ALERTA
    ========================================================== */

    .factoring-validation-alert {
        margin-bottom: 20px;
        padding: 13px 16px;
        border: 1px solid #f1ceca;
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
       FOOTER
    ========================================================== */

    .factoring-form-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        padding: 18px 22px;
        background: #f8fafc;
        border-top: 1px solid #edf1f5;
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
       RESPONSIVE
    ========================================================== */

    @media (max-width: 700px) {

        .factoring-edit-header {
            align-items: stretch;
            flex-direction: column;
        }

        .factoring-edit-header .btn {
            width: 100%;
        }

        .factoring-form-grid {
            grid-template-columns: 1fr;
        }

        .factoring-form-group-full {
            grid-column: auto;
        }

        .factoring-edit-card-body {
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

    <div class="factoring-edit-breadcrumb">

        <a href="{{ route('empresas-factoring.index') }}">
            Empresas de Factoring
        </a>

        <span>›</span>

        <a href="{{ route('empresas-factoring.show', $empresaFactoring) }}">
            Ficha de la empresa
        </a>

        <span>›</span>

        <span class="factoring-edit-breadcrumb-current">
            Editar
        </span>

    </div>


    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="factoring-edit-header">

        <div class="factoring-edit-header-left">

            <div class="factoring-edit-avatar">

                {{ strtoupper(
                    substr($empresaFactoring->nombre, 0, 2)
                ) }}

            </div>


            <div>

                <h1 class="factoring-edit-title">
                    Editar empresa de factoring
                </h1>

                <p class="factoring-edit-subtitle">
                    Actualiza los antecedentes de {{ $empresaFactoring->nombre }}.
                </p>

            </div>

        </div>


        <a
            href="{{ route('empresas-factoring.show', $empresaFactoring) }}"
            class="btn"
        >
            ← Volver a ficha
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
        action="{{ route('empresas-factoring.update', $empresaFactoring) }}"
        method="POST"
        id="factoringEditForm"
    >

        @csrf

        @method('PUT')


        <section class="factoring-edit-card">

            <div class="factoring-edit-card-header">

                <div>

                    <h2 class="factoring-edit-card-title">
                        Información general
                    </h2>

                    <p class="factoring-edit-card-description">
                        Modifica los datos de identificación y contacto de la empresa.
                    </p>

                </div>

            </div>


            <div class="factoring-edit-card-body">

                <div class="factoring-info-box">

                    <div class="factoring-info-icon">
                        i
                    </div>

                    <div>

                        <strong>
                            Identificación de la empresa
                        </strong>

                        <br>

                        El RUT debe mantenerse único dentro del sistema.

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
                            value="{{ old('nombre', $empresaFactoring->nombre) }}"
                            maxlength="255"
                            required
                            autofocus
                        >

                        @error('nombre')

                            <div class="factoring-form-help" style="color:#c0392b;">
                                {{ $message }}
                            </div>

                        @enderror

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
                            value="{{ old('rut', $empresaFactoring->rut) }}"
                            maxlength="20"
                            required
                        >


                        <div class="factoring-form-help">
                            Identificador tributario único.
                        </div>

                        @error('rut')

                            <div class="factoring-form-help" style="color:#c0392b;">
                                {{ $message }}
                            </div>

                        @enderror

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
                            class="factoring-form-control factoring-status-select"
                            required
                        >

                            <option
                                value="activo"
                                @selected(
                                    old(
                                        'estado',
                                        $empresaFactoring->estado
                                    ) === 'activo'
                                )
                            >
                                Activo
                            </option>

                            <option
                                value="inactivo"
                                @selected(
                                    old(
                                        'estado',
                                        $empresaFactoring->estado
                                    ) === 'inactivo'
                                )
                            >
                                Inactivo
                            </option>

                        </select>

                        @error('estado')

                            <div class="factoring-form-help" style="color:#c0392b;">
                                {{ $message }}
                            </div>

                        @enderror

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
                            value="{{ old('telefono', $empresaFactoring->telefono) }}"
                            maxlength="50"
                            placeholder="Ej. +56 9 1234 5678"
                        >

                        @error('telefono')

                            <div class="factoring-form-help" style="color:#c0392b;">
                                {{ $message }}
                            </div>

                        @enderror

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
                            value="{{ old('correo', $empresaFactoring->correo) }}"
                            maxlength="255"
                            placeholder="Ej. contacto@empresa.cl"
                        >

                        @error('correo')

                            <div class="factoring-form-help" style="color:#c0392b;">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


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
                            value="{{ old('ejecutivo', $empresaFactoring->ejecutivo) }}"
                            maxlength="255"
                            placeholder="Nombre del ejecutivo"
                        >

                        @error('ejecutivo')

                            <div class="factoring-form-help" style="color:#c0392b;">
                                {{ $message }}
                            </div>

                        @enderror

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
                            value="{{ old('telefono_ejecutivo', $empresaFactoring->telefono_ejecutivo) }}"
                            maxlength="50"
                            placeholder="Ej. +56 9 1234 5678"
                        >

                        @error('telefono_ejecutivo')

                            <div class="factoring-form-help" style="color:#c0392b;">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- CUENTA BANCARIA --}}

                    <div class="factoring-form-group">

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
                            value="{{ old('cuenta_bancaria', $empresaFactoring->cuenta_bancaria) }}"
                            maxlength="255"
                            placeholder="Banco, tipo y número de cuenta"
                        >

                        @error('cuenta_bancaria')

                            <div class="factoring-form-help" style="color:#c0392b;">
                                {{ $message }}
                            </div>

                        @enderror

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
                            placeholder="Información adicional de la empresa..."
                        >{{ old('otros_datos', $empresaFactoring->otros_datos) }}</textarea>

                        @error('otros_datos')

                            <div class="factoring-form-help" style="color:#c0392b;">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                </div>

            </div>

        </section>


        {{-- =====================================================
             FOOTER
        ====================================================== --}}

        <div class="factoring-edit-card">

            <div class="factoring-form-footer">

                <div class="factoring-form-footer-note">

                    <span class="factoring-form-required">
                        *
                    </span>

                    Campos obligatorios.

                </div>


                <div class="factoring-form-footer-actions">

                    <a
                        href="{{ route('empresas-factoring.show', $empresaFactoring) }}"
                        class="btn"
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

        </div>

    </form>

@endsection