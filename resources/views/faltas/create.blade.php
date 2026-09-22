@extends('layouts.app')

@section('title', 'Nueva falta')

@section('topbar_title', 'Faltas')

@push('styles')

<style>

    .fault-form-header {
        margin-bottom: 24px;
    }

    .fault-form-title {
        margin: 0;
        color: #172033;
        font-size: 27px;
        line-height: 1.2;
        font-weight: 700;
        letter-spacing: -.025em;
    }

    .fault-form-subtitle {
        margin: 7px 0 0;
        color: #667085;
        font-size: 13px;
    }

    .fault-worker-card {
        margin-bottom: 18px;
        padding: 14px 16px;
        border: 1px solid #d4e5f2;
        border-radius: 8px;
        background: #f7fbfe;
    }

    .fault-worker-label {
        color: #98a2b3;
        font-size: 9px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .03em;
    }

    .fault-worker-name {
        margin-top: 4px;
        color: #155a91;
        font-size: 13px;
        font-weight: 700;
    }

    .fault-worker-rut {
        margin-top: 3px;
        color: #667085;
        font-size: 10px;
    }

    .fault-form-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(16,47,80,.05);
        overflow: hidden;
    }

    .fault-form-card-header {
        padding: 17px 20px;
        border-bottom: 1px solid #edf1f5;
    }

    .fault-form-card-title {
        margin: 0;
        color: #172033;
        font-size: 14px;
        font-weight: 700;
    }

    .fault-form-card-description {
        margin: 4px 0 0;
        color: #98a2b3;
        font-size: 10px;
    }

    .fault-form-body {
        padding: 22px 20px;
    }

    .fault-form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
    }

    .fault-form-group {
        min-width: 0;
    }

    .fault-form-group-full {
        grid-column: 1 / -1;
    }

    .fault-form-label {
        display: block;
        margin-bottom: 7px;
        color: #344054;
        font-size: 11px;
        font-weight: 600;
    }

    .fault-form-required {
        color: #b9382e;
    }

    .fault-form-input {
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

    .fault-form-input::placeholder {
        color: #a1aab7;
    }

    .fault-form-input:focus {
        border-color: #155a91;
        box-shadow: 0 0 0 3px rgba(21,90,145,.08);
    }

    textarea.fault-form-input {
        min-height: 105px;
        resize: vertical;
        line-height: 1.5;
    }

    .fault-form-help {
        margin-top: 5px;
        color: #98a2b3;
        font-size: 9px;
        line-height: 1.4;
    }

    .fault-form-error {
        margin-top: 5px;
        color: #b9382e;
        font-size: 9px;
    }

    .fault-form-alert {
        margin-bottom: 18px;
        padding: 11px 14px;
        border: 1px solid #f0d3cf;
        border-radius: 7px;
        background: #fff7f5;
        color: #a52f26;
        font-size: 11px;
    }

    .fault-form-info {
        margin-top: 18px;
        padding: 13px 15px;
        border: 1px solid #e2e8f0;
        border-radius: 7px;
        background: #fbfcfd;
        color: #667085;
        font-size: 10px;
        line-height: 1.5;
    }

    .fault-form-info strong {
        color: #344054;
    }

    .fault-form-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 15px 20px;
        border-top: 1px solid #edf1f5;
        background: #fbfcfd;
    }

    .fault-form-footer-actions {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .fault-form-cancel {
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

    .fault-form-cancel:hover {
        background: #f5f8fb;
        border-color: #cbd7e3;
    }

    @media (max-width: 700px) {

        .fault-form-grid {
            grid-template-columns: 1fr;
        }

        .fault-form-group-full {
            grid-column: auto;
        }

        .fault-form-footer {
            align-items: stretch;
            flex-direction: column;
        }

        .fault-form-footer-actions {
            width: 100%;
        }

        .fault-form-footer-actions .btn,
        .fault-form-footer-actions .fault-form-cancel {
            flex: 1;
        }

    }

</style>

@endpush


@section('content')

    <div class="fault-form-header">

        <h1 class="fault-form-title">
            Nueva falta
        </h1>

        <p class="fault-form-subtitle">
            Registra una falta y sus antecedentes para el trabajador.
        </p>

    </div>


    <div class="fault-worker-card">

        <div class="fault-worker-label">
            Trabajador
        </div>

        <div class="fault-worker-name">
            {{ $trabajador->nombre }}
        </div>

        <div class="fault-worker-rut">
            RUT:
            {{ $trabajador->rut }}
        </div>

    </div>


    @if($errors->any())

        <div class="fault-form-alert">
            Revisa los datos ingresados. Hay campos que requieren corrección antes de guardar la falta.
        </div>

    @endif


    <section class="fault-form-card">

        <div class="fault-form-card-header">

            <h2 class="fault-form-card-title">
                Información de la falta
            </h2>

            <p class="fault-form-card-description">
                Define la fecha, tipo, estado y antecedentes relacionados con la falta.
            </p>

        </div>


        <form
            action="{{ route('trabajadores.faltas.store', $trabajador) }}"
            method="POST"
        >

            @csrf


            <div class="fault-form-body">

                <div class="fault-form-grid">

                    <div class="fault-form-group">

                        <label
                            for="fecha"
                            class="fault-form-label"
                        >
                            Fecha
                            <span class="fault-form-required">*</span>
                        </label>

                        <input
                            type="date"
                            id="fecha"
                            name="fecha"
                            class="fault-form-input"
                            value="{{ old('fecha') }}"
                            required
                            autofocus
                        >

                        @error('fecha')

                            <div class="fault-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <div class="fault-form-group">

                        <label
                            for="estado"
                            class="fault-form-label"
                        >
                            Estado
                            <span class="fault-form-required">*</span>
                        </label>

                        <select
                            id="estado"
                            name="estado"
                            class="fault-form-input"
                            required
                        >

                            <option
                                value="registrada"
                                {{ old('estado', 'registrada') === 'registrada' ? 'selected' : '' }}
                            >
                                Registrada
                            </option>

                            <option
                                value="pendiente"
                                {{ old('estado') === 'pendiente' ? 'selected' : '' }}
                            >
                                Pendiente
                            </option>

                            <option
                                value="sancionada"
                                {{ old('estado') === 'sancionada' ? 'selected' : '' }}
                            >
                                Sancionada
                            </option>

                            <option
                                value="cerrada"
                                {{ old('estado') === 'cerrada' ? 'selected' : '' }}
                            >
                                Cerrada
                            </option>

                        </select>

                        @error('estado')

                            <div class="fault-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <div class="fault-form-group fault-form-group-full">

                        <label
                            for="tipo"
                            class="fault-form-label"
                        >
                            Tipo de falta
                        </label>

                        <input
                            type="text"
                            id="tipo"
                            name="tipo"
                            class="fault-form-input"
                            value="{{ old('tipo') }}"
                            maxlength="255"
                            placeholder="Ej. atraso, incumplimiento, conducta..."
                        >

                        <div class="fault-form-help">
                            Indica brevemente la categoría o tipo de falta registrada.
                        </div>

                        @error('tipo')

                            <div class="fault-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <div class="fault-form-group fault-form-group-full">

                        <label
                            for="descripcion"
                            class="fault-form-label"
                        >
                            Descripción
                        </label>

                        <textarea
                            id="descripcion"
                            name="descripcion"
                            class="fault-form-input"
                            placeholder="Describe lo ocurrido..."
                        >{{ old('descripcion') }}</textarea>

                        @error('descripcion')

                            <div class="fault-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <div class="fault-form-group fault-form-group-full">

                        <label
                            for="sancion"
                            class="fault-form-label"
                        >
                            Sanción
                        </label>

                        <textarea
                            id="sancion"
                            name="sancion"
                            class="fault-form-input"
                            placeholder="Indica la medida o sanción aplicada, si corresponde..."
                        >{{ old('sancion') }}</textarea>

                        <div class="fault-form-help">
                            Puede quedar vacía si todavía no se ha definido una sanción.
                        </div>

                        @error('sancion')

                            <div class="fault-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <div class="fault-form-group fault-form-group-full">

                        <label
                            for="observaciones"
                            class="fault-form-label"
                        >
                            Observaciones
                        </label>

                        <textarea
                            id="observaciones"
                            name="observaciones"
                            class="fault-form-input"
                            placeholder="Información adicional sobre esta falta..."
                        >{{ old('observaciones') }}</textarea>

                        @error('observaciones')

                            <div class="fault-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                </div>


                <div class="fault-form-info">

                    <strong>Estado inicial:</strong>
                    por defecto la falta se registrará como
                    <strong>Registrada</strong>.

                    Posteriormente podrá cambiarse a pendiente, sancionada o cerrada según corresponda.

                </div>

            </div>


            <div class="fault-form-footer">

                <div>

                    <span class="fault-form-help">
                        Los campos marcados con * son obligatorios.
                    </span>

                </div>


                <div class="fault-form-footer-actions">

                    <a
                        href="{{ route('trabajadores.show', $trabajador) }}"
                        class="fault-form-cancel"
                    >
                        Cancelar
                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Guardar falta
                    </button>

                </div>

            </div>

        </form>

    </section>

@endsection