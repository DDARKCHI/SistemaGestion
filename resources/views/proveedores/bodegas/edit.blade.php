@extends('layouts.app')

@section('title', 'Editar bodega')

@section('topbar_title', 'Gestión de proveedores')

@push('styles')

<style>

    /* =========================================================
       BREADCRUMB
    ========================================================== */

    .provider-edit-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 18px;
        color: #8a94a6;
        font-size: 12px;
    }

    .provider-edit-breadcrumb a {
        color: #667085;
        text-decoration: none;
    }

    .provider-edit-breadcrumb a:hover {
        color: #155a91;
    }

    .provider-edit-breadcrumb-current {
        color: #344054;
    }


    /* =========================================================
       HEADER
    ========================================================== */

    .provider-edit-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 25px;
    }

    .provider-edit-header-left {
        display: flex;
        align-items: center;
        gap: 13px;
        min-width: 0;
    }

    .provider-edit-avatar {
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

    .provider-edit-title {
        margin: 0;
        color: #172033;
        font-size: 26px;
        line-height: 1.2;
        font-weight: 700;
        letter-spacing: -.025em;
    }

    .provider-edit-subtitle {
        margin: 6px 0 0;
        color: #667085;
        font-size: 12px;
    }


    /* =========================================================
       CARD
    ========================================================== */

    .provider-edit-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(16,47,80,.05);
        margin-bottom: 20px;
        overflow: hidden;
    }

    .provider-edit-card-header {
        min-height: 67px;
        padding: 17px 21px;
        border-bottom: 1px solid #edf1f5;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
    }

    .provider-edit-card-title {
        margin: 0;
        color: #172033;
        font-size: 15px;
        font-weight: 700;
    }

    .provider-edit-card-description {
        margin: 4px 0 0;
        color: #98a2b3;
        font-size: 11px;
    }

    .provider-edit-card-body {
        padding: 22px;
    }


    /* =========================================================
       INFORMACIÓN DEL PROVEEDOR
    ========================================================== */

    .provider-info-box {
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

    .provider-info-icon {
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

    .provider-info-box strong {
        color: #155a91;
    }


    /* =========================================================
       FORMULARIO
    ========================================================== */

    .provider-form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 17px;
    }

    .provider-form-group {
        min-width: 0;
    }

    .provider-form-group-full {
        grid-column: 1 / -1;
    }

    .provider-form-label {
        display: block;
        margin-bottom: 7px;
        color: #344054;
        font-size: 11px;
        font-weight: 600;
    }

    .provider-form-required {
        color: #c0392b;
    }

    .provider-form-control {
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

    .provider-form-control::placeholder {
        color: #a1aab7;
    }

    .provider-form-control:focus {
        border-color: #155a91;
        box-shadow: 0 0 0 3px rgba(21,90,145,.08);
    }

    textarea.provider-form-control {
        min-height: 110px;
        resize: vertical;
        line-height: 1.5;
    }

    .provider-form-help {
        margin-top: 5px;
        color: #98a2b3;
        font-size: 10px;
        line-height: 1.4;
    }


    /* =========================================================
       FOOTER
    ========================================================== */

    .provider-form-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        padding: 18px 22px;
        background: #f8fafc;
        border-top: 1px solid #edf1f5;
    }

    .provider-form-footer-note {
        color: #98a2b3;
        font-size: 10px;
    }

    .provider-form-footer-actions {
        display: flex;
        gap: 9px;
    }


    /* =========================================================
       ALERTA
    ========================================================== */

    .provider-validation-alert {
        margin-bottom: 20px;
        padding: 13px 16px;
        border: 1px solid #f1ceca;
        border-radius: 7px;
        background: #fff5f3;
        color: #a63228;
        font-size: 11px;
    }

    .provider-validation-alert strong {
        display: block;
        margin-bottom: 6px;
        font-size: 12px;
    }

    .provider-validation-alert ul {
        margin: 0;
        padding-left: 18px;
    }

    .provider-validation-alert li {
        margin-bottom: 3px;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================== */

    @media (max-width: 700px) {

        .provider-edit-header {
            align-items: stretch;
            flex-direction: column;
        }

        .provider-edit-header .btn {
            width: 100%;
        }

        .provider-form-grid {
            grid-template-columns: 1fr;
        }

        .provider-form-group-full {
            grid-column: auto;
        }

        .provider-edit-card-body {
            padding: 17px;
        }

        .provider-form-footer {
            align-items: stretch;
            flex-direction: column;
        }

        .provider-form-footer-actions {
            width: 100%;
        }

        .provider-form-footer-actions .btn {
            flex: 1;
        }

    }

</style>

@endpush


@section('content')

    {{-- =====================================================
         BREADCRUMB
    ====================================================== --}}

    <div class="provider-edit-breadcrumb">

        <a href="{{ route('proveedores.index') }}">
            Proveedores
        </a>

        <span>›</span>

        <a href="{{ route('proveedores.show', $proveedor) }}">
            {{ $proveedor->nombre }}
        </a>

        <span>›</span>

        <span class="provider-edit-breadcrumb-current">
            Bodegas
        </span>

        <span>›</span>

        <span class="provider-edit-breadcrumb-current">
            Editar
        </span>

    </div>


    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="provider-edit-header">

        <div class="provider-edit-header-left">

            <div class="provider-edit-avatar">

                {{ strtoupper(
                    substr($bodega->nombre, 0, 2)
                ) }}

            </div>


            <div>

                <h1 class="provider-edit-title">
                    Editar bodega
                </h1>

                <p class="provider-edit-subtitle">
                    Actualiza los antecedentes de {{ $bodega->nombre }}.
                </p>

            </div>

        </div>


        <a
            href="{{ route('proveedores.show', $proveedor) }}"
            class="btn"
        >
            ← Volver a ficha
        </a>

    </div>


    {{-- =====================================================
         ERRORES
    ====================================================== --}}

    @if($errors->any())

        <div class="provider-validation-alert">

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
            'proveedores.bodegas.update',
            [
                'proveedor' => $proveedor,
                'bodega' => $bodega
            ]
        ) }}"
        method="POST"
        id="providerBodegaEditForm"
    >

        @csrf

        @method('PUT')


        <section class="provider-edit-card">

            <div class="provider-edit-card-header">

                <div>

                    <h2 class="provider-edit-card-title">
                        Información de la bodega
                    </h2>

                    <p class="provider-edit-card-description">
                        Modifica los datos de ubicación y antecedentes de la bodega.
                    </p>

                </div>

            </div>


            <div class="provider-edit-card-body">


                {{-- PROVEEDOR ASOCIADO --}}

                <div class="provider-info-box">

                    <div class="provider-info-icon">
                        i
                    </div>

                    <div>

                        <strong>
                            Proveedor asociado
                        </strong>

                        <br>

                        {{ $proveedor->nombre }}

                        <span style="margin-left: 8px;">
                            RUT {{ $proveedor->rut }}
                        </span>

                    </div>

                </div>


                <div class="provider-form-grid">


                    {{-- NOMBRE --}}

                    <div class="provider-form-group">

                        <label
                            class="provider-form-label"
                            for="nombre"
                        >

                            Nombre de la bodega

                            <span class="provider-form-required">
                                *
                            </span>

                        </label>


                        <input
                            type="text"
                            id="nombre"
                            name="nombre"
                            class="provider-form-control"
                            value="{{ old('nombre', $bodega->nombre) }}"
                            maxlength="150"
                            required
                            autofocus
                        >


                        @error('nombre')

                            <div class="provider-form-help" style="color: #b42318;">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- LOCALIDAD --}}

                    <div class="provider-form-group">

                        <label
                            class="provider-form-label"
                            for="localidad"
                        >
                            Localidad
                        </label>


                        <input
                            type="text"
                            id="localidad"
                            name="localidad"
                            class="provider-form-control"
                            value="{{ old('localidad', $bodega->localidad) }}"
                            maxlength="100"
                            placeholder="Ej. Concepción"
                        >


                        @error('localidad')

                            <div class="provider-form-help" style="color: #b42318;">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- DIRECCIÓN --}}

                    <div class="provider-form-group provider-form-group-full">

                        <label
                            class="provider-form-label"
                            for="direccion"
                        >

                            Dirección

                            <span class="provider-form-required">
                                *
                            </span>

                        </label>


                        <input
                            type="text"
                            id="direccion"
                            name="direccion"
                            class="provider-form-control"
                            value="{{ old('direccion', $bodega->direccion) }}"
                            maxlength="255"
                            required
                            placeholder="Dirección completa de la bodega"
                        >


                        @error('direccion')

                            <div class="provider-form-help" style="color: #b42318;">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- OBSERVACIONES --}}

                    <div class="provider-form-group provider-form-group-full">

                        <label
                            class="provider-form-label"
                            for="observaciones"
                        >
                            Observaciones
                        </label>


                        <textarea
                            id="observaciones"
                            name="observaciones"
                            class="provider-form-control"
                            placeholder="Información adicional de la bodega..."
                        >{{ old('observaciones', $bodega->observaciones) }}</textarea>


                        @error('observaciones')

                            <div class="provider-form-help" style="color: #b42318;">
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

        <div class="provider-edit-card">

            <div class="provider-form-footer">

                <div class="provider-form-footer-note">

                    <span class="provider-form-required">
                        *
                    </span>

                    Campos obligatorios.

                </div>


                <div class="provider-form-footer-actions">

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