@extends('layouts.app')

@section('title', 'Editar cliente')

@section('topbar_title', 'Gestión de clientes')

@push('styles')

<style>

    /* =========================================================
       BREADCRUMB
    ========================================================== */

    .client-edit-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 18px;
        color: #8a94a6;
        font-size: 12px;
    }

    .client-edit-breadcrumb a {
        color: #667085;
        text-decoration: none;
    }

    .client-edit-breadcrumb a:hover {
        color: #155a91;
    }

    .client-edit-breadcrumb-current {
        color: #344054;
    }


    /* =========================================================
       HEADER
    ========================================================== */

    .client-edit-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 25px;
    }

    .client-edit-header-left {
        display: flex;
        align-items: center;
        gap: 13px;
        min-width: 0;
    }

    .client-edit-avatar {
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

    .client-edit-title {
        margin: 0;
        color: #172033;
        font-size: 26px;
        line-height: 1.2;
        font-weight: 700;
        letter-spacing: -.025em;
    }

    .client-edit-subtitle {
        margin: 6px 0 0;
        color: #667085;
        font-size: 12px;
    }


    /* =========================================================
       CARD
    ========================================================== */

    .client-edit-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(16,47,80,.05);
        margin-bottom: 20px;
        overflow: hidden;
    }

    .client-edit-card-header {
        min-height: 67px;
        padding: 17px 21px;
        border-bottom: 1px solid #edf1f5;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
    }

    .client-edit-card-title {
        margin: 0;
        color: #172033;
        font-size: 15px;
        font-weight: 700;
    }

    .client-edit-card-description {
        margin: 4px 0 0;
        color: #98a2b3;
        font-size: 11px;
    }

    .client-edit-card-body {
        padding: 22px;
    }


    /* =========================================================
       INFORMACIÓN
    ========================================================== */

    .client-info-box {
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

    .client-info-icon {
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

    .client-info-box strong {
        color: #155a91;
    }


    /* =========================================================
       FORMULARIO
    ========================================================== */

    .client-form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
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

    .client-form-control::placeholder {
        color: #a1aab7;
    }

    .client-form-control:focus {
        border-color: #155a91;
        box-shadow: 0 0 0 3px rgba(21,90,145,.08);
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
       IDENTIFICADOR
    ========================================================== */

    .client-current-rut {
        display: inline-flex;
        align-items: center;
        margin-top: 7px;
        padding: 4px 7px;
        border-radius: 5px;
        background: #f1f4f7;
        color: #667085;
        font-size: 9px;
        font-weight: 600;
    }


    /* =========================================================
       FOOTER
    ========================================================== */

    .client-form-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        padding: 18px 22px;
        background: #f8fafc;
        border-top: 1px solid #edf1f5;
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
       ALERTA
    ========================================================== */

    .client-validation-alert {
        margin-bottom: 20px;
        padding: 13px 16px;
        border: 1px solid #f1ceca;
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

    @media (max-width: 700px) {

        .client-edit-header {
            align-items: stretch;
            flex-direction: column;
        }

        .client-edit-header .btn {
            width: 100%;
        }

        .client-form-grid {
            grid-template-columns: 1fr;
        }

        .client-form-group-full {
            grid-column: auto;
        }

        .client-edit-card-body {
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

    <div class="client-edit-breadcrumb">

        <a href="{{ route('clientes.index') }}">
            Clientes
        </a>

        <span>›</span>

        <a href="{{ route('clientes.show', $cliente) }}">
            Ficha del cliente
        </a>

        <span>›</span>

        <span class="client-edit-breadcrumb-current">
            Editar
        </span>

    </div>


    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="client-edit-header">

        <div class="client-edit-header-left">

            <div class="client-edit-avatar">

                {{ strtoupper(
                    substr($cliente->razon_social, 0, 2)
                ) }}

            </div>


            <div>

                <h1 class="client-edit-title">
                    Editar cliente
                </h1>

                <p class="client-edit-subtitle">
                    Actualiza los antecedentes de {{ $cliente->razon_social }}.
                </p>

            </div>

        </div>


        <a
            href="{{ route('clientes.show', $cliente) }}"
            class="btn"
        >
            ← Volver a ficha
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
        action="{{ route('clientes.update', $cliente) }}"
        method="POST"
        id="clientEditForm"
    >

        @csrf

        @method('PUT')


        <section class="client-edit-card">

            <div class="client-edit-card-header">

                <div>

                    <h2 class="client-edit-card-title">
                        Información general
                    </h2>

                    <p class="client-edit-card-description">
                        Modifica los datos de identificación y contacto.
                    </p>

                </div>

            </div>


            <div class="client-edit-card-body">

                <div class="client-info-box">

                    <div class="client-info-icon">
                        i
                    </div>

                    <div>

                        <strong>
                            Identificación del cliente
                        </strong>

                        <br>

                        El RUT debe mantenerse único dentro del sistema.

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
                            value="{{ old('razon_social', $cliente->razon_social) }}"
                            maxlength="255"
                            required
                            autofocus
                        >

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


                        <input
                            type="text"
                            id="rut"
                            name="rut"
                            class="client-form-control"
                            value="{{ old('rut', $cliente->rut) }}"
                            maxlength="20"
                            required
                        >


                        <div class="client-form-help">
                            Identificador tributario único.
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
                            value="{{ old('comuna', $cliente->comuna) }}"
                            maxlength="255"
                            placeholder="Ej. Concepción"
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
                            value="{{ old('telefono', $cliente->telefono) }}"
                            maxlength="30"
                            placeholder="Ej. +56 9 1234 5678"
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
                            value="{{ old('correo', $cliente->correo) }}"
                            maxlength="255"
                            placeholder="Ej. contacto@empresa.cl"
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
                            value="{{ old('direccion', $cliente->direccion) }}"
                            maxlength="255"
                            placeholder="Ej. Avenida Principal 123"
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
                        >{{ old('observaciones', $cliente->observaciones) }}</textarea>

                    </div>

                </div>

            </div>

        </section>


        {{-- =====================================================
             FOOTER
        ====================================================== --}}

        <div class="client-edit-card">

            <div class="client-form-footer">

                <div class="client-form-footer-note">

                    <span class="client-form-required">
                        *
                    </span>

                    Campos obligatorios.

                </div>


                <div class="client-form-footer-actions">

                    <a
                        href="{{ route('clientes.show', $cliente) }}"
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