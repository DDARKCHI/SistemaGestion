@extends('layouts.app')

@section('title', 'Editar trabajador')

@section('topbar_title', 'Editar trabajador')

@push('styles')

<style>

    /* =========================================================
       HEADER
    ========================================================== */

    .worker-form-header {

        margin-bottom: 24px;

    }


    .worker-form-title {

        margin: 0;

        color: #172033;

        font-size: 27px;

        line-height: 1.2;

        font-weight: 700;

        letter-spacing: -.025em;

    }


    .worker-form-subtitle {

        margin: 7px 0 0;

        color: #667085;

        font-size: 13px;

    }


    /* =========================================================
       CARD
    ========================================================== */

    .worker-form-card {

        background: #ffffff;

        border: 1px solid #e2e8f0;

        border-radius: 10px;

        box-shadow: 0 2px 8px rgba(16,47,80,.05);

        overflow: hidden;

    }


    .worker-form-card-header {

        padding: 17px 20px;

        border-bottom: 1px solid #edf1f5;

    }


    .worker-form-card-title {

        margin: 0;

        color: #172033;

        font-size: 14px;

        font-weight: 700;

    }


    .worker-form-card-description {

        margin: 4px 0 0;

        color: #98a2b3;

        font-size: 10px;

    }


    .worker-form-body {

        padding: 22px 20px;

    }


    /* =========================================================
       GRID
    ========================================================== */

    .worker-form-grid {

        display: grid;

        grid-template-columns:
            repeat(2, minmax(0, 1fr));

        gap: 18px;

    }


    .worker-form-group {

        min-width: 0;

    }


    .worker-form-group-full {

        grid-column: 1 / -1;

    }


    /* =========================================================
       LABELS
    ========================================================== */

    .worker-form-label {

        display: block;

        margin-bottom: 7px;

        color: #344054;

        font-size: 11px;

        font-weight: 600;

    }


    .worker-form-required {

        color: #b9382e;

    }


    /* =========================================================
       INPUTS
    ========================================================== */

    .worker-form-input {

        width: 100%;

        min-height: 39px;

        padding: 9px 11px;

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


    .worker-form-input::placeholder {

        color: #a1aab7;

    }


    .worker-form-input:focus {

        border-color: #155a91;

        box-shadow:
            0 0 0 3px rgba(21,90,145,.08);

    }


    textarea.worker-form-input {

        min-height: 105px;

        resize: vertical;

        line-height: 1.5;

    }


    /* =========================================================
       AYUDA
    ========================================================== */

    .worker-form-help {

        margin-top: 5px;

        color: #98a2b3;

        font-size: 9px;

        line-height: 1.4;

    }


    /* =========================================================
       ERRORES
    ========================================================== */

    .worker-form-error {

        margin-top: 5px;

        color: #b9382e;

        font-size: 9px;

    }


    .worker-form-alert {

        margin-bottom: 18px;

        padding: 11px 14px;

        border: 1px solid #f0d3cf;

        border-radius: 7px;

        background: #fff7f5;

        color: #a52f26;

        font-size: 11px;

    }


    /* =========================================================
       AVISO
    ========================================================== */

    .worker-form-notice {

        margin-bottom: 18px;

        padding: 11px 14px;

        border: 1px solid #dce8f1;

        border-radius: 7px;

        background: #f7fafc;

        color: #667085;

        font-size: 10px;

        line-height: 1.5;

    }


    /* =========================================================
       FOOTER
    ========================================================== */

    .worker-form-footer {

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 12px;

        padding: 15px 20px;

        border-top: 1px solid #edf1f5;

        background: #fbfcfd;

    }


    .worker-form-footer-actions {

        display: flex;

        align-items: center;

        gap: 8px;

    }


    .worker-form-cancel {

        display: inline-flex;

        align-items: center;

        justify-content: center;

        min-height: 35px;

        padding: 7px 13px;

        border: 1px solid #dce3eb;

        border-radius: 6px;

        background: #ffffff;

        color: #344054;

        font-family: inherit;

        font-size: 10px;

        font-weight: 600;

        text-decoration: none;

        transition:
            background .12s ease,
            border-color .12s ease;

    }


    .worker-form-cancel:hover {

        background: #f5f8fb;

        border-color: #cbd7e3;

    }


    /* =========================================================
       RESPONSIVE
    ========================================================== */

    @media (max-width: 700px) {

        .worker-form-grid {

            grid-template-columns: 1fr;

        }


        .worker-form-group-full {

            grid-column: auto;

        }


        .worker-form-footer {

            align-items: stretch;

            flex-direction: column;

        }


        .worker-form-footer-actions {

            width: 100%;

        }


        .worker-form-footer-actions .btn,
        .worker-form-footer-actions .worker-form-cancel {

            flex: 1;

        }

    }

</style>

@endpush


@section('content')

    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="worker-form-header">

        <h1 class="worker-form-title">
            Editar trabajador
        </h1>

        <p class="worker-form-subtitle">
            Actualiza los antecedentes básicos del trabajador.
        </p>

    </div>


    {{-- =====================================================
         ERRORES GENERALES
    ====================================================== --}}

    @if($errors->any())

        <div class="worker-form-alert">

            Revisa los datos ingresados. Hay campos que requieren
            corrección antes de guardar los cambios.

        </div>

    @endif


    {{-- =====================================================
         AVISO
    ====================================================== --}}

    <div class="worker-form-notice">

        <strong>Importante:</strong>
        esta pantalla modifica únicamente los antecedentes básicos
        del trabajador. Los contratos, anexos, remuneraciones,
        vacaciones, permisos y demás antecedentes laborales tendrán
        su propio historial y administración.

    </div>


    {{-- =====================================================
         FORMULARIO
    ====================================================== --}}

    <section class="worker-form-card">

        <div class="worker-form-card-header">

            <h2 class="worker-form-card-title">
                Antecedentes del trabajador
            </h2>

            <p class="worker-form-card-description">
                Modifica la información general del trabajador registrado.
            </p>

        </div>


        <form
            action="{{ route('trabajadores.update', $trabajador) }}"
            method="POST"
        >

            @csrf

            @method('PUT')


            <div class="worker-form-body">

                <div class="worker-form-grid">

                    {{-- =================================================
                         NOMBRE
                    ================================================== --}}

                    <div class="worker-form-group">

                        <label
                            for="nombre"
                            class="worker-form-label"
                        >
                            Nombre completo
                            <span class="worker-form-required">*</span>
                        </label>

                        <input
                            type="text"
                            id="nombre"
                            name="nombre"
                            class="worker-form-input"
                            value="{{ old('nombre', $trabajador->nombre) }}"
                            placeholder="Ej. Juan Pérez González"
                            maxlength="255"
                            required
                            autofocus
                        >

                        @error('nombre')

                            <div class="worker-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- =================================================
                         RUT
                    ================================================== --}}

                    <div class="worker-form-group">

                        <label
                            for="rut"
                            class="worker-form-label"
                        >
                            RUT
                            <span class="worker-form-required">*</span>
                        </label>

                        <input
                            type="text"
                            id="rut"
                            name="rut"
                            class="worker-form-input"
                            value="{{ old('rut', $trabajador->rut) }}"
                            placeholder="Ej. 12.345.678-9"
                            maxlength="20"
                            required
                        >

                        @error('rut')

                            <div class="worker-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- =================================================
                         DIRECCIÓN
                    ================================================== --}}

                    <div class="worker-form-group worker-form-group-full">

                        <label
                            for="direccion"
                            class="worker-form-label"
                        >
                            Dirección
                        </label>

                        <input
                            type="text"
                            id="direccion"
                            name="direccion"
                            class="worker-form-input"
                            value="{{ old('direccion', $trabajador->direccion) }}"
                            placeholder="Dirección del trabajador"
                            maxlength="255"
                        >

                        @error('direccion')

                            <div class="worker-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- =================================================
                         TELÉFONO
                    ================================================== --}}

                    <div class="worker-form-group">

                        <label
                            for="telefono"
                            class="worker-form-label"
                        >
                            Teléfono
                        </label>

                        <input
                            type="text"
                            id="telefono"
                            name="telefono"
                            class="worker-form-input"
                            value="{{ old('telefono', $trabajador->telefono) }}"
                            placeholder="Ej. +56 9 1234 5678"
                            maxlength="50"
                        >

                        @error('telefono')

                            <div class="worker-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- =================================================
                         CORREO
                    ================================================== --}}

                    <div class="worker-form-group">

                        <label
                            for="correo"
                            class="worker-form-label"
                        >
                            Correo electrónico
                        </label>

                        <input
                            type="email"
                            id="correo"
                            name="correo"
                            class="worker-form-input"
                            value="{{ old('correo', $trabajador->correo) }}"
                            placeholder="Ej. trabajador@empresa.cl"
                            maxlength="255"
                        >

                        @error('correo')

                            <div class="worker-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- =================================================
                         FECHA INGRESO
                    ================================================== --}}

                    <div class="worker-form-group">

                        <label
                            for="fecha_ingreso"
                            class="worker-form-label"
                        >
                            Fecha de ingreso
                        </label>

                        <input
                            type="date"
                            id="fecha_ingreso"
                            name="fecha_ingreso"
                            class="worker-form-input"
                            value="{{ old(
                                'fecha_ingreso',
                                $trabajador->fecha_ingreso
                                    ? $trabajador->fecha_ingreso->format('Y-m-d')
                                    : ''
                            ) }}"
                        >

                        @error('fecha_ingreso')

                            <div class="worker-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- =================================================
                         REMUNERACIÓN ACORDADA
                    ================================================== --}}

                    <div class="worker-form-group">

                        <label
                            for="remuneracion_acordada"
                            class="worker-form-label"
                        >
                            Remuneración acordada
                        </label>

                        <input
                            type="number"
                            id="remuneracion_acordada"
                            name="remuneracion_acordada"
                            class="worker-form-input"
                            value="{{ old(
                                'remuneracion_acordada',
                                $trabajador->remuneracion_acordada
                            ) }}"
                            placeholder="Ej. 600000"
                            min="0"
                            step="0.01"
                        >

                        <div class="worker-form-help">
                            Monto base acordado para el trabajador.
                        </div>

                        @error('remuneracion_acordada')

                            <div class="worker-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- =================================================
                         OBSERVACIONES
                    ================================================== --}}

                    <div class="worker-form-group worker-form-group-full">

                        <label
                            for="observaciones"
                            class="worker-form-label"
                        >
                            Observaciones
                        </label>

                        <textarea
                            id="observaciones"
                            name="observaciones"
                            class="worker-form-input"
                            placeholder="Información adicional del trabajador..."
                        >{{ old('observaciones', $trabajador->observaciones) }}</textarea>

                        @error('observaciones')

                            <div class="worker-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                </div>

            </div>


            {{-- =====================================================
                 FOOTER
            ====================================================== --}}

            <div class="worker-form-footer">

                <div>

                    <span class="worker-form-help">
                        RUT y nombre son obligatorios.
                    </span>

                </div>


                <div class="worker-form-footer-actions">

                    <a
                        href="{{ route('trabajadores.show', $trabajador) }}"
                        class="worker-form-cancel"
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

        </form>

    </section>

@endsection