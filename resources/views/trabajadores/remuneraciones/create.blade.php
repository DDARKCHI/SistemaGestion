@extends('layouts.app')

@section('title', 'Nueva remuneración')

@section('topbar_title', 'Nueva remuneración')

@push('styles')
<style>
    .remuneracion-create-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 24px;
    }

    .remuneracion-create-title {
        margin: 0;
        color: #172033;
        font-size: 27px;
        line-height: 1.2;
        font-weight: 700;
        letter-spacing: -.025em;
    }

    .remuneracion-create-subtitle {
        margin: 7px 0 0;
        color: #667085;
        font-size: 13px;
    }

    .remuneracion-create-actions {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-shrink: 0;
    }

    .remuneracion-create-action {
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
    }

    .remuneracion-create-action:hover {
        background: #f5f8fb;
        border-color: #cbd7e3;
        color: #155a91;
    }

    .remuneracion-create-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(16, 47, 80, .05);
        overflow: hidden;
    }

    .remuneracion-create-card-header {
        padding: 18px 20px;
        border-bottom: 1px solid #edf1f5;
    }

    .remuneracion-create-card-title {
        margin: 0;
        color: #172033;
        font-size: 14px;
        font-weight: 700;
    }

    .remuneracion-create-card-description {
        margin: 4px 0 0;
        color: #98a2b3;
        font-size: 10px;
    }

    .remuneracion-create-worker {
        margin-top: 12px;
        padding: 10px 12px;
        border: 1px solid #e2e8f0;
        border-radius: 7px;
        background: #f8fafc;
        color: #344054;
        font-size: 11px;
    }

    .remuneracion-create-worker strong {
        color: #172033;
        font-weight: 700;
    }

    .remuneracion-create-form {
        padding: 20px;
    }

    .remuneracion-create-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
    }

    .remuneracion-create-field {
        min-width: 0;
    }

    .remuneracion-create-field-full {
        grid-column: 1 / -1;
    }

    .remuneracion-create-label {
        display: block;
        margin-bottom: 6px;
        color: #344054;
        font-size: 10px;
        font-weight: 700;
    }

    .remuneracion-create-required {
        color: #b9382e;
    }

    .remuneracion-create-input,
    .remuneracion-create-textarea {
        width: 100%;
        box-sizing: border-box;
        border: 1px solid #dce3eb;
        border-radius: 6px;
        background: #ffffff;
        color: #344054;
        font-family: inherit;
        font-size: 11px;
        outline: none;
        transition: border-color .15s ease, box-shadow .15s ease;
    }

    .remuneracion-create-input {
        min-height: 38px;
        padding: 8px 10px;
    }

    .remuneracion-create-input:focus,
    .remuneracion-create-textarea:focus {
        border-color: #8db5d2;
        box-shadow: 0 0 0 3px rgba(21, 90, 145, .08);
    }

    .remuneracion-create-calculated {
        background: #f8fafc;
        font-weight: 700;
        color: #172033;
        cursor: not-allowed;
    }

    .remuneracion-create-status {
        display: flex;
        align-items: center;
        min-height: 38px;
        padding: 8px 10px;
        box-sizing: border-box;
        border: 1px solid #dce3eb;
        border-radius: 6px;
        background: #f8fafc;
        color: #344054;
        font-size: 11px;
        font-weight: 700;
    }

    .remuneracion-create-help {
        margin-top: 5px;
        color: #98a2b3;
        font-size: 9px;
        line-height: 1.4;
    }

    .remuneracion-create-error {
        margin-top: 5px;
        color: #b9382e;
        font-size: 9px;
    }

    .remuneracion-create-alert {
        margin-bottom: 18px;
        padding: 11px 14px;
        border: 1px solid #f0c8c3;
        border-radius: 7px;
        background: #fff5f3;
        color: #b9382e;
        font-size: 10px;
    }

    .remuneracion-create-summary {
        padding: 16px;
        border: 1px solid #dce3eb;
        border-radius: 8px;
        background: #f8fafc;
    }

    .remuneracion-create-summary-title {
        margin: 0 0 14px;
        color: #344054;
        font-size: 11px;
        font-weight: 700;
    }

    .remuneracion-create-summary-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 18px;
    }

    .remuneracion-create-summary-item {
        min-width: 0;
    }

    .remuneracion-create-summary-label {
        margin-bottom: 4px;
        color: #98a2b3;
        font-size: 9px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .02em;
    }

    .remuneracion-create-summary-value {
        color: #172033;
        font-size: 14px;
        font-weight: 700;
    }

    .remuneracion-create-upload {
        padding: 15px;
        border: 1px dashed #cbd7e3;
        border-radius: 8px;
        background: #f8fafc;
    }

    .remuneracion-create-upload-title {
        margin: 0;
        color: #344054;
        font-size: 11px;
        font-weight: 700;
    }

    .remuneracion-create-upload-text {
        margin: 4px 0 12px;
        color: #98a2b3;
        font-size: 9px;
        line-height: 1.5;
    }

    .remuneracion-create-file {
        width: 100%;
        box-sizing: border-box;
        padding: 8px;
        border: 1px solid #dce3eb;
        border-radius: 6px;
        background: #ffffff;
        color: #344054;
        font-family: inherit;
        font-size: 10px;
    }

    .remuneracion-create-textarea {
        min-height: 105px;
        padding: 10px;
        resize: vertical;
        line-height: 1.5;
    }

    .remuneracion-create-footer {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 8px;
        margin-top: 22px;
        padding-top: 18px;
        border-top: 1px solid #edf1f5;
    }

    .remuneracion-create-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 36px;
        padding: 8px 15px;
        border: 1px solid #d4e5f2;
        border-radius: 6px;
        background: #155a91;
        color: #ffffff;
        font-family: inherit;
        font-size: 10px;
        font-weight: 600;
        cursor: pointer;
    }

    .remuneracion-create-button:hover {
        background: #124d7d;
        border-color: #124d7d;
    }

    .remuneracion-create-cancel {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 36px;
        padding: 8px 15px;
        border: 1px solid #dce3eb;
        border-radius: 6px;
        background: #ffffff;
        color: #344054;
        font-family: inherit;
        font-size: 10px;
        font-weight: 600;
        text-decoration: none;
    }

    .remuneracion-create-cancel:hover {
        background: #f5f8fb;
        color: #155a91;
    }

    @media (max-width: 700px) {
        .remuneracion-create-header {
            flex-direction: column;
        }

        .remuneracion-create-actions {
            width: 100%;
        }

        .remuneracion-create-actions .remuneracion-create-action {
            flex: 1;
        }

        .remuneracion-create-grid {
            grid-template-columns: 1fr;
        }

        .remuneracion-create-field-full {
            grid-column: auto;
        }

        .remuneracion-create-summary-grid {
            grid-template-columns: 1fr;
        }

        .remuneracion-create-footer {
            flex-direction: column-reverse;
        }

        .remuneracion-create-footer a,
        .remuneracion-create-footer button {
            width: 100%;
        }
    }
</style>
@endpush

@section('content')

    <div class="remuneracion-create-header">
        <div>
            <h1 class="remuneracion-create-title">
                Nueva remuneración
            </h1>

            <p class="remuneracion-create-subtitle">
                Registra la remuneración correspondiente al período seleccionado.
            </p>
        </div>

        <div class="remuneracion-create-actions">
            <a
                href="{{ route('trabajadores.show', $trabajador) }}"
                class="remuneracion-create-action"
            >
                ← Volver a la ficha
            </a>
        </div>
    </div>

    @if($errors->any())
        <div class="remuneracion-create-alert">
            <strong>
                No se pudo guardar la remuneración.
            </strong>
            Revisa los campos marcados e inténtalo nuevamente.
        </div>
    @endif

    <section class="remuneracion-create-card">

        <div class="remuneracion-create-card-header">

            <h2 class="remuneracion-create-card-title">
                Datos de la remuneración
            </h2>

            <p class="remuneracion-create-card-description">
                Información mensual, montos de pago y estado de la remuneración.
            </p>

            <div class="remuneracion-create-worker">
                Trabajador:
                <strong>
                    {{ $trabajador->nombre }}
                </strong>
                · RUT {{ $trabajador->rut }}
            </div>

        </div>

        <form
            action="{{ route(
                'trabajadores.remuneraciones.store',
                $trabajador
            ) }}"
            method="POST"
            enctype="multipart/form-data"
            class="remuneracion-create-form"
        >

            @csrf

            <div class="remuneracion-create-grid">

                {{-- PERÍODO --}}
                <div class="remuneracion-create-field">

                    <label
                        for="periodo"
                        class="remuneracion-create-label"
                    >
                        Período
                        <span class="remuneracion-create-required">*</span>
                    </label>

                    <input
                        type="text"
                        id="periodo"
                        name="periodo"
                        class="remuneracion-create-input"
                        value="{{ old('periodo') }}"
                        placeholder="Ej. Septiembre 2026"
                        required
                    >

                    <div class="remuneracion-create-help">
                        Identifica el mes al que corresponde la remuneración.
                    </div>

                    @error('periodo')
                        <div class="remuneracion-create-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                {{-- SUELDO BASE --}}
                <div class="remuneracion-create-field">

                    <label
                        for="sueldo_base"
                        class="remuneracion-create-label"
                    >
                        Sueldo base
                        <span class="remuneracion-create-required">*</span>
                    </label>

                    <input
                        type="number"
                        id="sueldo_base"
                        name="sueldo_base"
                        class="remuneracion-create-input"
                        value="{{ old(
                            'sueldo_base',
                            $trabajador->remuneracion_acordada !== null
                                ? number_format(
                                    (float) $trabajador->remuneracion_acordada,
                                    0,
                                    '.',
                                    ''
                                )
                                : ''
                        ) }}"
                        min="0"
                        step="1"
                        required
                    >

                    <div class="remuneracion-create-help">
                        Se carga automáticamente con la remuneración vigente del trabajador.
                    </div>

                    @error('sueldo_base')
                        <div class="remuneracion-create-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                {{-- BONIFICACIONES --}}
                <div class="remuneracion-create-field">

                    <label
                        for="bonificaciones"
                        class="remuneracion-create-label"
                    >
                        Bonificaciones
                    </label>

                    <input
                        type="number"
                        id="bonificaciones"
                        name="bonificaciones"
                        class="remuneracion-create-input"
                        value="{{ old('bonificaciones', 0) }}"
                        min="0"
                        step="1"
                    >

                    @error('bonificaciones')
                        <div class="remuneracion-create-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                {{-- DESCUENTOS --}}
                <div class="remuneracion-create-field">

                    <label
                        for="descuentos"
                        class="remuneracion-create-label"
                    >
                        Descuentos
                    </label>

                    <input
                        type="number"
                        id="descuentos"
                        name="descuentos"
                        class="remuneracion-create-input"
                        value="{{ old('descuentos', 0) }}"
                        min="0"
                        step="1"
                    >

                    @error('descuentos')
                        <div class="remuneracion-create-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                {{-- TOTAL LÍQUIDO CALCULADO --}}
                <div class="remuneracion-create-field">

                    <label
                        for="total_liquido"
                        class="remuneracion-create-label"
                    >
                        Total líquido
                    </label>

                    <input
                        type="text"
                        id="total_liquido"
                        class="remuneracion-create-input remuneracion-create-calculated"
                        value="$0"
                        readonly
                    >

                    <div class="remuneracion-create-help">
                        Calculado automáticamente: sueldo base + bonificaciones − descuentos.
                    </div>

                    @error('total_liquido')
                        <div class="remuneracion-create-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                {{-- MONTO PAGADO --}}
                <div class="remuneracion-create-field">

                    <label
                        for="monto_pagado"
                        class="remuneracion-create-label"
                    >
                        Monto efectivamente pagado
                    </label>

                    <input
                        type="number"
                        id="monto_pagado"
                        name="monto_pagado"
                        class="remuneracion-create-input"
                        value="{{ old('monto_pagado', 0) }}"
                        min="0"
                        step="1"
                    >

                    <div class="remuneracion-create-help">
                        Permite registrar pagos parciales o el pago completo.
                    </div>

                    @error('monto_pagado')
                        <div class="remuneracion-create-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                {{-- FECHA DE PAGO --}}
                <div class="remuneracion-create-field">

                    <label
                        for="fecha_pago"
                        class="remuneracion-create-label"
                    >
                        Fecha real de pago
                    </label>

                    <input
                        type="date"
                        id="fecha_pago"
                        name="fecha_pago"
                        class="remuneracion-create-input"
                        value="{{ old('fecha_pago') }}"
                    >

                    <div class="remuneracion-create-help">
                        Registra la fecha en que realmente se efectuó el pago.
                    </div>

                    @error('fecha_pago')
                        <div class="remuneracion-create-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                {{-- ESTADO AUTOMÁTICO --}}
                <div class="remuneracion-create-field">

                    <label
                        class="remuneracion-create-label"
                    >
                        Estado de pago
                    </label>

                    <div
                        id="estado"
                        class="remuneracion-create-status"
                    >
                        Pendiente
                    </div>

                    <div class="remuneracion-create-help">
                        El estado se determina automáticamente según el monto efectivamente pagado.
                    </div>

                </div>

                {{-- RESUMEN --}}
                <div class="remuneracion-create-field remuneracion-create-field-full">

                    <div class="remuneracion-create-summary">

                        <h3 class="remuneracion-create-summary-title">
                            Resumen del pago
                        </h3>

                        <div class="remuneracion-create-summary-grid">

                            <div class="remuneracion-create-summary-item">

                                <div class="remuneracion-create-summary-label">
                                    Total líquido
                                </div>

                                <div
                                    id="resumen-total"
                                    class="remuneracion-create-summary-value"
                                >
                                    $0
                                </div>

                            </div>

                            <div class="remuneracion-create-summary-item">

                                <div class="remuneracion-create-summary-label">
                                    Pagado
                                </div>

                                <div
                                    id="resumen-pagado"
                                    class="remuneracion-create-summary-value"
                                >
                                    $0
                                </div>

                            </div>

                            <div class="remuneracion-create-summary-item">

                                <div class="remuneracion-create-summary-label">
                                    Saldo a pagar
                                </div>

                                <div
                                    id="resumen-saldo"
                                    class="remuneracion-create-summary-value"
                                >
                                    $0
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                {{-- DOCUMENTO --}}
                <div class="remuneracion-create-field remuneracion-create-field-full">

                    <div class="remuneracion-create-upload">

                        <h3 class="remuneracion-create-upload-title">
                            Liquidación y documentos asociados
                        </h3>

                        <p class="remuneracion-create-upload-text">
                            Puedes adjuntar la liquidación de sueldo firmada u otro
                            documento relacionado con esta remuneración.
                            El documento quedará asociado directamente a este registro.
                            Máximo 20 MB.
                        </p>

                        <input
                            type="file"
                            id="documento"
                            name="documento"
                            class="remuneracion-create-file"
                            accept=".pdf,.jpg,.jpeg,.png,.doc,.docx,.xls,.xlsx"
                        >

                        @error('documento')
                            <div class="remuneracion-create-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>

                {{-- OBSERVACIONES --}}
                <div class="remuneracion-create-field remuneracion-create-field-full">

                    <label
                        for="observaciones"
                        class="remuneracion-create-label"
                    >
                        Observaciones
                    </label>

                    <textarea
                        id="observaciones"
                        name="observaciones"
                        class="remuneracion-create-textarea"
                        placeholder="Información adicional relacionada con la remuneración..."
                    >{{ old('observaciones') }}</textarea>

                    @error('observaciones')
                        <div class="remuneracion-create-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

            </div>

            <div class="remuneracion-create-footer">

                <a
                    href="{{ route('trabajadores.show', $trabajador) }}"
                    class="remuneracion-create-cancel"
                >
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="remuneracion-create-button"
                >
                    Guardar remuneración
                </button>

            </div>

        </form>

    </section>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const sueldoBaseInput =
            document.getElementById('sueldo_base');

        const bonificacionesInput =
            document.getElementById('bonificaciones');

        const descuentosInput =
            document.getElementById('descuentos');

        const pagadoInput =
            document.getElementById('monto_pagado');

        const totalInput =
            document.getElementById('total_liquido');

        const estadoElement =
            document.getElementById('estado');

        const resumenTotal =
            document.getElementById('resumen-total');

        const resumenPagado =
            document.getElementById('resumen-pagado');

        const resumenSaldo =
            document.getElementById('resumen-saldo');

        function numero(valor) {
            return parseFloat(valor) || 0;
        }

        function formatoMoneda(valor) {
            return new Intl.NumberFormat('es-CL', {
                style: 'currency',
                currency: 'CLP',
                maximumFractionDigits: 0
            }).format(Math.max(0, valor));
        }

        function actualizarCalculos() {

            const sueldoBase =
                numero(sueldoBaseInput.value);

            const bonificaciones =
                numero(bonificacionesInput.value);

            const descuentos =
                numero(descuentosInput.value);

            const montoPagado =
                numero(pagadoInput.value);

            const totalLiquido =
                Math.max(
                    0,
                    sueldoBase
                    + bonificaciones
                    - descuentos
                );

            const saldo =
                Math.max(
                    0,
                    totalLiquido
                    - montoPagado
                );

            totalInput.value =
                formatoMoneda(totalLiquido);

            resumenTotal.textContent =
                formatoMoneda(totalLiquido);

            resumenPagado.textContent =
                formatoMoneda(montoPagado);

            resumenSaldo.textContent =
                formatoMoneda(saldo);

            if (montoPagado <= 0) {

                estadoElement.textContent =
                    'Pendiente';

            } else if (montoPagado < totalLiquido) {

                estadoElement.textContent =
                    'Parcialmente pagada';

            } else if (montoPagado === totalLiquido) {

                estadoElement.textContent =
                    'Pagada';

            } else {

                estadoElement.textContent =
                    'Monto superior al total';
            }
        }

        sueldoBaseInput.addEventListener(
            'input',
            actualizarCalculos
        );

        bonificacionesInput.addEventListener(
            'input',
            actualizarCalculos
        );

        descuentosInput.addEventListener(
            'input',
            actualizarCalculos
        );

        pagadoInput.addEventListener(
            'input',
            actualizarCalculos
        );

        actualizarCalculos();
    });
</script>
@endpush