@extends('layouts.app')

@section('title', 'Editar ejecutivo')

@section('topbar_title', 'Gestión de proveedores')

@push('styles')

<style>

    /* =========================================================
       BREADCRUMB
    ========================================================== */

    .executive-edit-breadcrumb {

        display: flex;

        align-items: center;

        gap: 8px;

        margin-bottom: 18px;

        color: #8a94a6;

        font-size: 12px;

    }


    .executive-edit-breadcrumb a {

        color: #667085;

        text-decoration: none;

    }


    .executive-edit-breadcrumb a:hover {

        color: #155a91;

    }


    .executive-edit-breadcrumb-current {

        color: #344054;

    }


    /* =========================================================
       HEADER
    ========================================================== */

    .executive-edit-header {

        display: flex;

        align-items: flex-start;

        justify-content: space-between;

        gap: 20px;

        margin-bottom: 25px;

    }


    .executive-edit-title {

        margin: 0;

        color: #172033;

        font-size: 27px;

        line-height: 1.2;

        font-weight: 700;

        letter-spacing: -.025em;

    }


    .executive-edit-subtitle {

        margin: 7px 0 0;

        color: #667085;

        font-size: 13px;

    }


    /* =========================================================
       CARD
    ========================================================== */

    .executive-edit-card {

        background: #ffffff;

        border: 1px solid #e2e8f0;

        border-radius: 10px;

        box-shadow: 0 2px 8px rgba(16,47,80,.05);

        margin-bottom: 20px;

        overflow: hidden;

    }


    .executive-edit-card-header {

        min-height: 67px;

        padding: 17px 21px;

        border-bottom: 1px solid #edf1f5;

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 15px;

    }


    .executive-edit-card-title {

        margin: 0;

        color: #172033;

        font-size: 15px;

        font-weight: 700;

    }


    .executive-edit-card-description {

        margin: 4px 0 0;

        color: #98a2b3;

        font-size: 11px;

    }


    .executive-edit-card-body {

        padding: 22px;

    }


    /* =========================================================
       INFORMACIÓN DEL PROVEEDOR
    ========================================================== */

    .executive-edit-info {

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


    .executive-edit-info-icon {

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


    .executive-edit-info strong {

        color: #155a91;

    }


    /* =========================================================
       FORMULARIO
    ========================================================== */

    .executive-edit-form-grid {

        display: grid;

        grid-template-columns: repeat(2, 1fr);

        gap: 17px;

    }


    .executive-edit-form-group {

        min-width: 0;

    }


    .executive-edit-form-group-full {

        grid-column: 1 / -1;

    }


    .executive-edit-form-label {

        display: block;

        margin-bottom: 7px;

        color: #344054;

        font-size: 11px;

        font-weight: 600;

    }


    .executive-edit-form-required {

        color: #c0392b;

    }


    .executive-edit-form-control {

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


    .executive-edit-form-control::placeholder {

        color: #a1aab7;

    }


    .executive-edit-form-control:focus {

        border-color: #155a91;

        box-shadow: 0 0 0 3px rgba(21,90,145,.08);

    }


    textarea.executive-edit-form-control {

        min-height: 110px;

        resize: vertical;

        line-height: 1.5;

    }


    .executive-edit-form-help {

        margin-top: 5px;

        color: #98a2b3;

        font-size: 10px;

        line-height: 1.4;

    }


    /* =========================================================
       ERRORES
    ========================================================== */

    .executive-edit-form-control.is-error {

        border-color: #c0392b;

    }


    .executive-edit-form-error {

        margin-top: 5px;

        color: #b9382e;

        font-size: 9px;

    }


    .executive-edit-validation-alert {

        margin-bottom: 20px;

        padding: 13px 16px;

        border: 1px solid #f1ceca;

        border-radius: 7px;

        background: #fff5f3;

        color: #a63228;

        font-size: 11px;

    }


    .executive-edit-validation-alert strong {

        display: block;

        margin-bottom: 6px;

        font-size: 12px;

    }


    .executive-edit-validation-alert ul {

        margin: 0;

        padding-left: 18px;

    }


    .executive-edit-validation-alert li {

        margin-bottom: 3px;

    }


    /* =========================================================
       FOOTER
    ========================================================== */

    .executive-edit-footer {

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 15px;

        padding: 18px 22px;

        background: #f8fafc;

        border-top: 1px solid #edf1f5;

    }


    .executive-edit-footer-note {

        color: #98a2b3;

        font-size: 10px;

    }


    .executive-edit-footer-actions {

        display: flex;

        gap: 9px;

    }


    /* =========================================================
       RESPONSIVE
    ========================================================== */

    @media (max-width: 900px) {

        .executive-edit-form-grid {

            grid-template-columns: 1fr;

        }


        .executive-edit-form-group-full {

            grid-column: auto;

        }

    }


    @media (max-width: 700px) {

        .executive-edit-header {

            flex-direction: column;

        }


        .executive-edit-header .btn {

            width: 100%;

        }


        .executive-edit-card-body {

            padding: 17px;

        }


        .executive-edit-footer {

            align-items: stretch;

            flex-direction: column;

        }


        .executive-edit-footer-actions {

            width: 100%;

        }


        .executive-edit-footer-actions .btn {

            flex: 1;

        }

    }

</style>

@endpush


@section('content')

    {{-- =====================================================
         BREADCRUMB
    ====================================================== --}}

    <div class="executive-edit-breadcrumb">

        <a href="{{ route('proveedores.index') }}">
            Proveedores
        </a>

        <span>›</span>

        <a href="{{ route('proveedores.show', $proveedor) }}">
            {{ $proveedor->nombre }}
        </a>

        <span>›</span>

        <span class="executive-edit-breadcrumb-current">
            Editar ejecutivo
        </span>

    </div>


    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="executive-edit-header">

        <div>

            <h1 class="executive-edit-title">
                Editar ejecutivo
            </h1>

            <p class="executive-edit-subtitle">
                Modifica los antecedentes y datos de contacto del ejecutivo.
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

        <div class="executive-edit-validation-alert">

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
        action="{{ route(
            'proveedores.ejecutivos.update',
            [
                'proveedor' => $proveedor,
                'ejecutivo' => $ejecutivo
            ]
        ) }}"
        method="POST"
    >

        @csrf

        @method('PUT')


        {{-- =================================================
             INFORMACIÓN DEL EJECUTIVO
        ================================================== --}}

        <section class="executive-edit-card">

            <div class="executive-edit-card-header">

                <div>

                    <h2 class="executive-edit-card-title">
                        Información del ejecutivo
                    </h2>

                    <p class="executive-edit-card-description">
                        Datos de identificación y contacto.
                    </p>

                </div>

            </div>


            <div class="executive-edit-card-body">


                {{-- PROVEEDOR --}}

                <div class="executive-edit-info">

                    <div class="executive-edit-info-icon">
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


                {{-- CAMPOS --}}

                <div class="executive-edit-form-grid">


                    {{-- NOMBRE --}}

                    <div class="executive-edit-form-group">

                        <label
                            class="executive-edit-form-label"
                            for="nombre"
                        >

                            Nombre completo

                            <span class="executive-edit-form-required">
                                *
                            </span>

                        </label>


                        <input
                            type="text"
                            id="nombre"
                            name="nombre"
                            class="executive-edit-form-control @error('nombre') is-error @enderror"
                            value="{{ old('nombre', $ejecutivo->nombre) }}"
                            placeholder="Ej. Juan Pérez"
                            maxlength="150"
                            required
                            autofocus
                        >


                        <div class="executive-edit-form-help">
                            Nombre y apellido del ejecutivo.
                        </div>


                        @error('nombre')

                            <div class="executive-edit-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- CARGO --}}

                    <div class="executive-edit-form-group">

                        <label
                            class="executive-edit-form-label"
                            for="cargo"
                        >
                            Cargo
                        </label>


                        <input
                            type="text"
                            id="cargo"
                            name="cargo"
                            class="executive-edit-form-control @error('cargo') is-error @enderror"
                            value="{{ old('cargo', $ejecutivo->cargo) }}"
                            placeholder="Ej. Ejecutivo comercial"
                            maxlength="100"
                        >


                        <div class="executive-edit-form-help">
                            Cargo o función que desempeña dentro del proveedor.
                        </div>


                        @error('cargo')

                            <div class="executive-edit-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- CORREO --}}

                    <div class="executive-edit-form-group">

                        <label
                            class="executive-edit-form-label"
                            for="correo"
                        >
                            Correo electrónico
                        </label>


                        <input
                            type="email"
                            id="correo"
                            name="correo"
                            class="executive-edit-form-control @error('correo') is-error @enderror"
                            value="{{ old('correo', $ejecutivo->correo) }}"
                            placeholder="Ej. ejecutivo@empresa.cl"
                            maxlength="150"
                        >


                        <div class="executive-edit-form-help">
                            Correo utilizado para contacto con el proveedor.
                        </div>


                        @error('correo')

                            <div class="executive-edit-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- TELÉFONO --}}

                    <div class="executive-edit-form-group">

                        <label
                            class="executive-edit-form-label"
                            for="telefono"
                        >
                            Teléfono
                        </label>


                        <input
                            type="tel"
                            id="telefono"
                            name="telefono"
                            class="executive-edit-form-control @error('telefono') is-error @enderror"
                            value="{{ old('telefono', $ejecutivo->telefono) }}"
                            placeholder="Ej. +56 9 1234 5678"
                            maxlength="50"
                        >


                        <div class="executive-edit-form-help">
                            Teléfono o número de contacto directo.
                        </div>


                        @error('telefono')

                            <div class="executive-edit-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- OBSERVACIONES --}}

                    <div class="executive-edit-form-group executive-edit-form-group-full">

                        <label
                            class="executive-edit-form-label"
                            for="observaciones"
                        >
                            Observaciones
                        </label>


                        <textarea
                            id="observaciones"
                            name="observaciones"
                            class="executive-edit-form-control @error('observaciones') is-error @enderror"
                            placeholder="Información adicional del ejecutivo..."
                        >{{ old('observaciones', $ejecutivo->observaciones) }}</textarea>


                        @error('observaciones')

                            <div class="executive-edit-form-error">
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

        <div class="executive-edit-card">

            <div class="executive-edit-footer">

                <div class="executive-edit-footer-note">

                    <span class="executive-edit-form-required">
                        *
                    </span>

                    Campos obligatorios.

                </div>


                <div class="executive-edit-footer-actions">

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
                        Guardar cambios
                    </button>

                </div>

            </div>

        </div>

    </form>

@endsection