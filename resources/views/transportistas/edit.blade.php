@extends('layouts.app')

@section('title', 'Editar transportista')

@section('topbar_title', 'Gestión de transportistas')

@push('styles')

<style>

    /* =========================================================
       BREADCRUMB
    ========================================================== */

    .carrier-edit-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 18px;
        color: #8a94a6;
        font-size: 12px;
    }

    .carrier-edit-breadcrumb a {
        color: #667085;
        text-decoration: none;
    }

    .carrier-edit-breadcrumb a:hover {
        color: #155a91;
    }

    .carrier-edit-breadcrumb-current {
        color: #344054;
    }


    /* =========================================================
       HEADER
    ========================================================== */

    .carrier-edit-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 25px;
    }

    .carrier-edit-header-left {
        display: flex;
        align-items: center;
        gap: 13px;
        min-width: 0;
    }

    .carrier-edit-avatar {
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

    .carrier-edit-title {
        margin: 0;
        color: #172033;
        font-size: 26px;
        line-height: 1.2;
        font-weight: 700;
        letter-spacing: -.025em;
    }

    .carrier-edit-subtitle {
        margin: 6px 0 0;
        color: #667085;
        font-size: 12px;
    }


    /* =========================================================
       CARD
    ========================================================== */

    .carrier-edit-card {
        width: 100%;
        max-width: none;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(16,47,80,.05);
        margin-bottom: 20px;
        overflow: hidden;
    }

    .carrier-edit-card-header {
        min-height: 67px;
        padding: 17px 21px;
        border-bottom: 1px solid #edf1f5;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
    }

    .carrier-edit-card-title {
        margin: 0;
        color: #172033;
        font-size: 15px;
        font-weight: 700;
    }

    .carrier-edit-card-description {
        margin: 4px 0 0;
        color: #98a2b3;
        font-size: 11px;
    }

    .carrier-edit-card-body {
        padding: 22px;
    }


    /* =========================================================
       INFORMACIÓN
    ========================================================== */

    .carrier-info-box {
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

    .carrier-info-icon {
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

    .carrier-info-box strong {
        color: #155a91;
    }


    /* =========================================================
       FORMULARIO
    ========================================================== */

    .carrier-form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 17px;
    }

    .carrier-form-group {
        min-width: 0;
    }

    .carrier-form-group-full {
        grid-column: 1 / -1;
    }

    .carrier-form-label {
        display: block;
        margin-bottom: 7px;
        color: #344054;
        font-size: 11px;
        font-weight: 600;
    }

    .carrier-form-required {
        color: #c0392b;
    }

    .carrier-form-control {
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

    .carrier-form-control::placeholder {
        color: #a1aab7;
    }

    .carrier-form-control:focus {
        border-color: #155a91;
        box-shadow: 0 0 0 3px rgba(21,90,145,.08);
    }

    textarea.carrier-form-control {
        min-height: 110px;
        resize: vertical;
        line-height: 1.5;
    }

    .carrier-form-help {
        margin-top: 5px;
        color: #98a2b3;
        font-size: 10px;
        line-height: 1.4;
    }


    /* =========================================================
       IDENTIFICADOR
    ========================================================== */

    .carrier-current-rut {
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

    .carrier-form-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        padding: 18px 22px;
        background: #f8fafc;
        border-top: 1px solid #edf1f5;
    }

    .carrier-form-footer-note {
        color: #98a2b3;
        font-size: 10px;
    }

    .carrier-form-footer-actions {
        display: flex;
        gap: 9px;
    }


    /* =========================================================
       ALERTA
    ========================================================== */

    .carrier-validation-alert {
        margin-bottom: 20px;
        padding: 13px 16px;
        border: 1px solid #f1ceca;
        border-radius: 7px;
        background: #fff5f3;
        color: #a63228;
        font-size: 11px;
    }

    .carrier-validation-alert strong {
        display: block;
        margin-bottom: 6px;
        font-size: 12px;
    }

    .carrier-validation-alert ul {
        margin: 0;
        padding-left: 18px;
    }

    .carrier-validation-alert li {
        margin-bottom: 3px;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================== */

    @media (max-width: 700px) {

        .carrier-edit-header {
            align-items: stretch;
            flex-direction: column;
        }

        .carrier-edit-header .btn {
            width: 100%;
        }

        .carrier-form-grid {
            grid-template-columns: 1fr;
        }

        .carrier-form-group-full {
            grid-column: auto;
        }

        .carrier-edit-card-body {
            padding: 17px;
        }

        .carrier-form-footer {
            align-items: stretch;
            flex-direction: column;
        }

        .carrier-form-footer-actions {
            width: 100%;
        }

        .carrier-form-footer-actions .btn {
            flex: 1;
        }

    }

</style>

@endpush


@section('content')

    {{-- =====================================================
         BREADCRUMB
    ====================================================== --}}

    <div class="carrier-edit-breadcrumb">

        <a href="{{ route('transportistas.index') }}">
            Transportistas
        </a>

        <span>›</span>

        <a href="{{ route('transportistas.show', $transportista) }}">
            Ficha del transportista
        </a>

        <span>›</span>

        <span class="carrier-edit-breadcrumb-current">
            Editar
        </span>

    </div>


    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="carrier-edit-header">

        <div class="carrier-edit-header-left">

            <div class="carrier-edit-avatar">

                {{ strtoupper(
                    substr($transportista->nombre, 0, 2)
                ) }}

            </div>


            <div>

                <h1 class="carrier-edit-title">
                    Editar transportista
                </h1>

                <p class="carrier-edit-subtitle">
                    Actualiza los antecedentes de {{ $transportista->nombre }}.
                </p>

            </div>

        </div>


        <a
            href="{{ route('transportistas.show', $transportista) }}"
            class="btn"
        >
            ← Volver a ficha
        </a>

    </div>


    {{-- =====================================================
         ERRORES
    ====================================================== --}}

    @if($errors->any())

        <div class="carrier-validation-alert">

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
        action="{{ route('transportistas.update', $transportista) }}"
        method="POST"
        id="carrierEditForm"
    >

        @csrf

        @method('PUT')


        <section class="carrier-edit-card">

            <div class="carrier-edit-card-header">

                <div>

                    <h2 class="carrier-edit-card-title">
                        Información general
                    </h2>

                    <p class="carrier-edit-card-description">
                        Modifica los datos de identificación, ubicación y contacto.
                    </p>

                </div>

            </div>


            <div class="carrier-edit-card-body">


                {{-- INFORMACIÓN DEL TRANSPORTISTA --}}

                <div class="carrier-info-box">

                    <div class="carrier-info-icon">
                        i
                    </div>

                    <div>

                        <strong>
                            Identificación del transportista
                        </strong>

                        <br>

                        El RUT debe mantenerse único dentro del sistema.

                    </div>

                </div>


                <div class="carrier-form-grid">


                    {{-- NOMBRE --}}

                    <div class="carrier-form-group carrier-form-group-full">

                        <label
                            class="carrier-form-label"
                            for="nombre"
                        >

                            Nombre del transportista

                            <span class="carrier-form-required">
                                *
                            </span>

                        </label>


                        <input
                            type="text"
                            id="nombre"
                            name="nombre"
                            class="carrier-form-control"
                            value="{{ old('nombre', $transportista->nombre) }}"
                            maxlength="255"
                            required
                            autofocus
                        >

                    </div>


                    {{-- RUT --}}

                    <div class="carrier-form-group">

                        <label
                            class="carrier-form-label"
                            for="rut"
                        >

                            RUT

                            <span class="carrier-form-required">
                                *
                            </span>

                        </label>


                        <input
                            type="text"
                            id="rut"
                            name="rut"
                            class="carrier-form-control"
                            value="{{ old('rut', $transportista->rut) }}"
                            maxlength="20"
                            required
                        >


                        <div class="carrier-form-help">
                            Identificador tributario único.
                        </div>

                    </div>


                    {{-- TELÉFONO --}}

                    <div class="carrier-form-group">

                        <label
                            class="carrier-form-label"
                            for="telefono"
                        >
                            Teléfono
                        </label>


                        <input
                            type="tel"
                            id="telefono"
                            name="telefono"
                            class="carrier-form-control"
                            value="{{ old('telefono', $transportista->telefono) }}"
                            maxlength="30"
                            placeholder="Ej. +56 9 1234 5678"
                        >

                    </div>


                    {{-- CORREO --}}

                    <div class="carrier-form-group">

                        <label
                            class="carrier-form-label"
                            for="correo"
                        >
                            Correo electrónico
                        </label>


                        <input
                            type="email"
                            id="correo"
                            name="correo"
                            class="carrier-form-control"
                            value="{{ old('correo', $transportista->correo) }}"
                            maxlength="255"
                            placeholder="Ej. contacto@empresa.cl"
                        >

                    </div>


                    {{-- DIRECCIÓN --}}

                    <div class="carrier-form-group">

                        <label
                            class="carrier-form-label"
                            for="direccion"
                        >
                            Dirección
                        </label>


                        <input
                            type="text"
                            id="direccion"
                            name="direccion"
                            class="carrier-form-control"
                            value="{{ old('direccion', $transportista->direccion) }}"
                            maxlength="255"
                            placeholder="Dirección principal del transportista"
                        >

                    </div>


                    {{-- OBSERVACIONES --}}

                    <div class="carrier-form-group carrier-form-group-full">

                        <label
                            class="carrier-form-label"
                            for="observaciones"
                        >
                            Observaciones
                        </label>


                        <textarea
                            id="observaciones"
                            name="observaciones"
                            class="carrier-form-control"
                            placeholder="Información adicional del transportista..."
                        >{{ old('observaciones', $transportista->observaciones) }}</textarea>

                    </div>

                </div>

            </div>

        </section>


        {{-- =====================================================
             FOOTER
        ====================================================== --}}

        <div class="carrier-edit-card">

            <div class="carrier-form-footer">

                <div class="carrier-form-footer-note">

                    <span class="carrier-form-required">
                        *
                    </span>

                    Campos obligatorios.

                </div>


                <div class="carrier-form-footer-actions">

                    <a
                        href="{{ route('transportistas.show', $transportista) }}"
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
