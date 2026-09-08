@extends('layouts.app')

@section('title', 'Editar nota de crédito')

@section('topbar_title', 'Editar nota de crédito de proveedor')

@push('styles')

<style>

    /* =========================================================
       HEADER
    ========================================================== */

    .credit-note-form-header {

        display: flex;

        align-items: flex-start;

        justify-content: space-between;

        gap: 20px;

        margin-bottom: 24px;

    }



    .credit-note-form-title {

        margin: 0;

        color: #172033;

        font-size: 27px;

        line-height: 1.2;

        font-weight: 700;

        letter-spacing: -.025em;

    }



    .credit-note-form-subtitle {

        margin: 7px 0 0;

        color: #667085;

        font-size: 13px;

    }



    .credit-note-form-breadcrumb {

        display: flex;

        align-items: center;

        gap: 7px;

        margin-bottom: 14px;

        color: #98a2b3;

        font-size: 10px;

    }



    .credit-note-form-breadcrumb a {

        color: #155a91;

        text-decoration: none;

        font-weight: 600;

    }



    .credit-note-form-breadcrumb a:hover {

        color: #124d7d;

        text-decoration: underline;

    }



    /* =========================================================
       CARD
    ========================================================== */

    .credit-note-form-card {

        width: 100%;

        background: #ffffff;

        border: 1px solid #e2e8f0;

        border-radius: 10px;

        box-shadow:
            0 2px 8px rgba(16,47,80,.05);

        overflow: hidden;

    }



    .credit-note-form-card-header {

        min-height: 66px;

        padding: 15px 20px;

        display: flex;

        align-items: center;

        border-bottom: 1px solid #edf1f5;

    }



    .credit-note-form-card-title {

        margin: 0;

        color: #172033;

        font-size: 14px;

        font-weight: 700;

    }



    .credit-note-form-card-description {

        margin: 4px 0 0;

        color: #98a2b3;

        font-size: 10px;

    }



    .credit-note-form-body {

        padding: 22px 20px;

    }



    /* =========================================================
       INFORMACIÓN
    ========================================================== */

    .credit-note-form-info {

        margin-bottom: 22px;

        padding: 13px 15px;

        border: 1px solid #d4e5f2;

        border-radius: 7px;

        background: #f7fbfe;

    }



    .credit-note-form-info-title {

        margin: 0 0 4px;

        color: #155a91;

        font-size: 11px;

        font-weight: 700;

    }



    .credit-note-form-info-text {

        margin: 0;

        color: #667085;

        font-size: 10px;

        line-height: 1.5;

    }



    /* =========================================================
       FORMULARIO
    ========================================================== */

    .credit-note-form-grid {

        display: grid;

        grid-template-columns: repeat(2, minmax(0, 1fr));

        gap: 18px 20px;

    }



    .credit-note-form-group {

        min-width: 0;

    }



    .credit-note-form-group-full {

        grid-column: 1 / -1;

    }



    .credit-note-form-label {

        display: block;

        margin-bottom: 6px;

        color: #344054;

        font-size: 10px;

        font-weight: 600;

    }



    .credit-note-required {

        color: #a52f26;

    }



    .credit-note-form-control {

        width: 100%;

        min-height: 37px;

        padding: 8px 11px;

        box-sizing: border-box;

        border: 1px solid #d8e0e8;

        border-radius: 7px;

        background: #ffffff;

        color: #344054;

        font-family: inherit;

        font-size: 11px;

        outline: none;

        transition:
            border-color .12s ease,
            box-shadow .12s ease;

    }



    .credit-note-form-control:focus {

        border-color: #155a91;

        box-shadow:
            0 0 0 3px rgba(21,90,145,.08);

    }



    .credit-note-form-control::placeholder {

        color: #a1aab7;

    }



    .credit-note-form-control[readonly] {

        background: #f8fafc;

        color: #667085;

        cursor: not-allowed;

    }



    select.credit-note-form-control {

        cursor: pointer;

    }



    textarea.credit-note-form-control {

        min-height: 95px;

        resize: vertical;

        line-height: 1.5;

    }



    .credit-note-form-help {

        margin-top: 5px;

        color: #98a2b3;

        font-size: 9px;

        line-height: 1.4;

    }



    .credit-note-form-error {

        margin-top: 5px;

        color: #a52f26;

        font-size: 9px;

    }



    .credit-note-input-error {

        border-color: #e9c1bc;

        background: #fffaf9;

    }



    /* =========================================================
       PROVEEDOR
    ========================================================== */

    .credit-note-provider-rut-box {

        display: grid;

        grid-template-columns: minmax(0, 1fr) 180px;

        gap: 12px;

    }



    /* =========================================================
       PIE DEL FORMULARIO
    ========================================================== */

    .credit-note-form-footer {

        min-height: 65px;

        padding: 12px 20px;

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 15px;

        border-top: 1px solid #edf1f5;

        background: #fbfcfd;

    }



    .credit-note-form-footer-note {

        margin: 0;

        color: #98a2b3;

        font-size: 10px;

        line-height: 1.4;

    }



    .credit-note-form-actions {

        display: flex;

        align-items: center;

        gap: 8px;

        flex-shrink: 0;

    }



    .credit-note-form-button {

        display: inline-flex;

        align-items: center;

        justify-content: center;

        min-height: 37px;

        padding: 8px 14px;

        border-radius: 6px;

        font-family: inherit;

        font-size: 10px;

        font-weight: 600;

        text-decoration: none;

        cursor: pointer;

        transition:
            background .12s ease,
            border-color .12s ease,
            color .12s ease;

    }



    .credit-note-form-button-secondary {

        border: 1px solid #dce3eb;

        background: #ffffff;

        color: #344054;

    }



    .credit-note-form-button-secondary:hover {

        background: #f5f8fb;

        border-color: #cbd7e3;

        color: #155a91;

    }



    .credit-note-form-button-primary {

        border: 1px solid #155a91;

        background: #155a91;

        color: #ffffff;

    }



    .credit-note-form-button-primary:hover {

        background: #124d7d;

        border-color: #124d7d;

        color: #ffffff;

    }



    /* =========================================================
       ERRORES GENERALES
    ========================================================== */

    .credit-note-validation-alert {

        margin-bottom: 20px;

        padding: 12px 14px;

        border: 1px solid #e9c1bc;

        border-radius: 7px;

        background: #fff5f3;

        color: #a52f26;

        font-size: 10px;

    }



    .credit-note-validation-alert-title {

        margin: 0 0 6px;

        font-size: 11px;

        font-weight: 700;

    }



    .credit-note-validation-alert ul {

        margin: 0;

        padding-left: 18px;

    }



    .credit-note-validation-alert li {

        margin-bottom: 3px;

    }



    .credit-note-validation-alert li:last-child {

        margin-bottom: 0;

    }



    /* =========================================================
       RESPONSIVE
    ========================================================== */

    @media (max-width: 800px) {

        .credit-note-form-header {

            flex-direction: column;

        }



        .credit-note-form-grid {

            grid-template-columns: 1fr;

        }



        .credit-note-form-group-full {

            grid-column: auto;

        }



        .credit-note-provider-rut-box {

            grid-template-columns: 1fr;

        }



        .credit-note-form-footer {

            align-items: stretch;

            flex-direction: column;

        }



        .credit-note-form-actions {

            justify-content: flex-end;

        }

    }



    @media (max-width: 500px) {

        .credit-note-form-actions {

            flex-direction: column-reverse;

        }



        .credit-note-form-button {

            width: 100%;

        }

    }

</style>

@endpush


@section('content')

    {{-- =====================================================
         MIGAS DE PAN
    ====================================================== --}}

    <div class="credit-note-form-breadcrumb">

        <a href="{{ route('proveedores.index') }}">
            Proveedores
        </a>

        <span>›</span>

        <a href="{{ route('notas-credito-proveedores.index') }}">
            Notas de crédito
        </a>

        <span>›</span>

        <a href="{{ route('notas-credito-proveedores.show', $notaCreditoProveedor) }}">
            {{ $notaCreditoProveedor->numero_nota }}
        </a>

        <span>›</span>

        <span>
            Editar
        </span>

    </div>


    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="credit-note-form-header">

        <div>

            <h1 class="credit-note-form-title">
                Editar nota de crédito
            </h1>

            <p class="credit-note-form-subtitle">
                Modifica los antecedentes registrados de la nota de crédito del proveedor.
            </p>

        </div>

    </div>


    {{-- =====================================================
         ERRORES DE VALIDACIÓN
    ====================================================== --}}

    @if($errors->any())

        <div class="credit-note-validation-alert">

            <p class="credit-note-validation-alert-title">
                No se pudo actualizar la nota de crédito
            </p>

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
         CARD
    ====================================================== --}}

    <section class="credit-note-form-card">

        <div class="credit-note-form-card-header">

            <div>

                <h2 class="credit-note-form-card-title">
                    Datos de la nota de crédito
                </h2>

                <p class="credit-note-form-card-description">
                    Actualiza la información manteniendo la asociación con el proveedor.
                </p>

            </div>

        </div>


        <form
            action="{{ route('notas-credito-proveedores.update', $notaCreditoProveedor) }}"
            method="POST"
        >

            @csrf

            @method('PUT')


            <div class="credit-note-form-body">

                {{-- =================================================
                     INFORMACIÓN
                ================================================== --}}

                <div class="credit-note-form-info">

                    <p class="credit-note-form-info-title">
                        Registro de nota de crédito
                    </p>

                    <p class="credit-note-form-info-text">
                        El RUT mostrado corresponde al proveedor seleccionado y se
                        obtiene automáticamente desde sus datos registrados.
                    </p>

                </div>


                {{-- =================================================
                     CAMPOS
                ================================================== --}}

                <div class="credit-note-form-grid">

                    {{-- PROVEEDOR --}}

                    <div class="credit-note-form-group">

                        <label
                            for="proveedor_id"
                            class="credit-note-form-label"
                        >
                            Proveedor
                            <span class="credit-note-required">*</span>
                        </label>


                        <div class="credit-note-provider-rut-box">

                            <select
                                id="proveedor_id"
                                name="proveedor_id"
                                class="credit-note-form-control @error('proveedor_id') credit-note-input-error @enderror"
                                required
                            >

                                <option value="">
                                    Seleccione un proveedor
                                </option>

                                @foreach($proveedores as $proveedor)

                                    <option
                                        value="{{ $proveedor->id }}"
                                        data-rut="{{ $proveedor->rut }}"
                                        {{ old('proveedor_id', $notaCreditoProveedor->proveedor_id) == $proveedor->id ? 'selected' : '' }}
                                    >
                                        {{ $proveedor->nombre }}
                                    </option>

                                @endforeach

                            </select>


                            <input
                                type="text"
                                id="proveedor_rut"
                                class="credit-note-form-control"
                                placeholder="RUT"
                                value=""
                                readonly
                            >

                        </div>


                        <div class="credit-note-form-help">
                            Al cambiar el proveedor, el RUT se actualizará automáticamente.
                        </div>


                        @error('proveedor_id')

                            <div class="credit-note-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- NÚMERO DE NOTA --}}

                    <div class="credit-note-form-group">

                        <label
                            for="numero_nota"
                            class="credit-note-form-label"
                        >
                            Número de nota de crédito
                            <span class="credit-note-required">*</span>
                        </label>


                        <input
                            type="text"
                            id="numero_nota"
                            name="numero_nota"
                            value="{{ old('numero_nota', $notaCreditoProveedor->numero_nota) }}"
                            class="credit-note-form-control @error('numero_nota') credit-note-input-error @enderror"
                            maxlength="50"
                            required
                        >


                        @error('numero_nota')

                            <div class="credit-note-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- FECHA --}}

                    <div class="credit-note-form-group">

                        <label
                            for="fecha"
                            class="credit-note-form-label"
                        >
                            Fecha
                            <span class="credit-note-required">*</span>
                        </label>


                        <input
                            type="date"
                            id="fecha"
                            name="fecha"
                            value="{{ old('fecha', $notaCreditoProveedor->fecha?->format('Y-m-d')) }}"
                            class="credit-note-form-control @error('fecha') credit-note-input-error @enderror"
                            required
                        >


                        @error('fecha')

                            <div class="credit-note-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- MONTO --}}

                    <div class="credit-note-form-group">

                        <label
                            for="monto"
                            class="credit-note-form-label"
                        >
                            Monto
                            <span class="credit-note-required">*</span>
                        </label>


                        <input
                            type="number"
                            id="monto"
                            name="monto"
                            value="{{ old('monto', $notaCreditoProveedor->monto) }}"
                            class="credit-note-form-control @error('monto') credit-note-input-error @enderror"
                            min="0"
                            step="0.01"
                            required
                        >


                        <div class="credit-note-form-help">
                            Monto total registrado para esta nota de crédito.
                        </div>


                        @error('monto')

                            <div class="credit-note-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- ESTADO --}}

                    <div class="credit-note-form-group">

                        <label
                            for="estado"
                            class="credit-note-form-label"
                        >
                            Estado
                            <span class="credit-note-required">*</span>
                        </label>


                        <select
                            id="estado"
                            name="estado"
                            class="credit-note-form-control @error('estado') credit-note-input-error @enderror"
                            required
                        >

                            <option
                                value="pendiente"
                                {{ old('estado', $notaCreditoProveedor->estado) === 'pendiente' ? 'selected' : '' }}
                            >
                                Pendiente de recuperar
                            </option>

                            <option
                                value="recuperada"
                                {{ old('estado', $notaCreditoProveedor->estado) === 'recuperada' ? 'selected' : '' }}
                            >
                                Recuperada
                            </option>

                        </select>


                        @error('estado')

                            <div class="credit-note-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- MOTIVO --}}

                    <div class="credit-note-form-group">

                        <label
                            for="motivo"
                            class="credit-note-form-label"
                        >
                            Motivo
                        </label>


                        <input
                            type="text"
                            id="motivo"
                            name="motivo"
                            value="{{ old('motivo', $notaCreditoProveedor->motivo) }}"
                            class="credit-note-form-control @error('motivo') credit-note-input-error @enderror"
                            maxlength="500"
                        >


                        @error('motivo')

                            <div class="credit-note-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- OBSERVACIONES --}}

                    <div class="credit-note-form-group credit-note-form-group-full">

                        <label
                            for="observaciones"
                            class="credit-note-form-label"
                        >
                            Observaciones
                        </label>


                        <textarea
                            id="observaciones"
                            name="observaciones"
                            class="credit-note-form-control @error('observaciones') credit-note-input-error @enderror"
                        >{{ old('observaciones', $notaCreditoProveedor->observaciones) }}</textarea>


                        @error('observaciones')

                            <div class="credit-note-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                </div>

            </div>


            {{-- =================================================
                 PIE
            ================================================== --}}

            <div class="credit-note-form-footer">

                <p class="credit-note-form-footer-note">
                    Los campos marcados con * son obligatorios.
                </p>


                <div class="credit-note-form-actions">

                    <a
                        href="{{ route('notas-credito-proveedores.show', $notaCreditoProveedor) }}"
                        class="credit-note-form-button credit-note-form-button-secondary"
                    >
                        Cancelar
                    </a>


                    <button
                        type="submit"
                        class="credit-note-form-button credit-note-form-button-primary"
                    >
                        Guardar cambios
                    </button>

                </div>

            </div>

        </form>

    </section>

@endsection


@push('scripts')

<script>

    document.addEventListener(
        'DOMContentLoaded',
        function () {

            const proveedorSelect =
                document.getElementById(
                    'proveedor_id'
                );

            const proveedorRut =
                document.getElementById(
                    'proveedor_rut'
                );


            function actualizarRut() {

                if (!proveedorSelect || !proveedorRut) {
                    return;
                }


                const option =
                    proveedorSelect.options[
                        proveedorSelect.selectedIndex
                    ];


                if (
                    option &&
                    option.value
                ) {

                    proveedorRut.value =
                        option.dataset.rut || '';

                } else {

                    proveedorRut.value = '';

                }

            }


            if (proveedorSelect) {

                proveedorSelect.addEventListener(
                    'change',
                    actualizarRut
                );

                actualizarRut();

            }

        }
    );

</script>

@endpush