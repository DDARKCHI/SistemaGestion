@extends('layouts.app')

@section('title', 'Editar cuadratura')

@section('topbar_title', 'Cuadraturas')

@push('styles')

<style>

    .quadrature-form-header {
        margin-bottom: 24px;
    }

    .quadrature-form-title {
        margin: 0;
        color: #172033;
        font-size: 27px;
        line-height: 1.2;
        font-weight: 700;
        letter-spacing: -.025em;
    }

    .quadrature-form-subtitle {
        margin: 7px 0 0;
        color: #667085;
        font-size: 13px;
    }

    .quadrature-worker-card {
        margin-bottom: 18px;
        padding: 14px 16px;
        border: 1px solid #d4e5f2;
        border-radius: 8px;
        background: #f7fbfe;
    }

    .quadrature-worker-label {
        color: #98a2b3;
        font-size: 9px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .03em;
    }

    .quadrature-worker-name {
        margin-top: 4px;
        color: #155a91;
        font-size: 13px;
        font-weight: 700;
    }

    .quadrature-worker-rut {
        margin-top: 3px;
        color: #667085;
        font-size: 10px;
    }

    .quadrature-form-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(16,47,80,.05);
        overflow: hidden;
    }

    .quadrature-form-card-header {
        padding: 17px 20px;
        border-bottom: 1px solid #edf1f5;
    }

    .quadrature-form-card-title {
        margin: 0;
        color: #172033;
        font-size: 14px;
        font-weight: 700;
    }

    .quadrature-form-card-description {
        margin: 4px 0 0;
        color: #98a2b3;
        font-size: 10px;
    }

    .quadrature-form-body {
        padding: 22px 20px;
    }

    .quadrature-form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
    }

    .quadrature-form-group {
        min-width: 0;
    }

    .quadrature-form-group-full {
        grid-column: 1 / -1;
    }

    .quadrature-form-label {
        display: block;
        margin-bottom: 7px;
        color: #344054;
        font-size: 11px;
        font-weight: 600;
    }

    .quadrature-form-required {
        color: #b9382e;
    }

    .quadrature-form-input {
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

    .quadrature-form-input:focus {
        border-color: #155a91;
        box-shadow: 0 0 0 3px rgba(21,90,145,.08);
    }

    .quadrature-form-input[readonly] {
        background: #f8fafc;
        color: #667085;
    }

    textarea.quadrature-form-input {
        min-height: 105px;
        resize: vertical;
        line-height: 1.5;
    }

    .quadrature-form-help {
        margin-top: 5px;
        color: #98a2b3;
        font-size: 9px;
        line-height: 1.4;
    }

    .quadrature-form-error {
        margin-top: 5px;
        color: #b9382e;
        font-size: 9px;
    }

    .quadrature-form-alert {
        margin-bottom: 18px;
        padding: 11px 14px;
        border: 1px solid #f0d3cf;
        border-radius: 7px;
        background: #fff7f5;
        color: #a52f26;
        font-size: 11px;
    }

    .quadrature-form-info {
        margin-top: 18px;
        padding: 13px 15px;
        border: 1px solid #e2e8f0;
        border-radius: 7px;
        background: #fbfcfd;
        color: #667085;
        font-size: 10px;
        line-height: 1.5;
    }

    .quadrature-form-info strong {
        color: #344054;
    }

    .quadrature-form-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 15px 20px;
        border-top: 1px solid #edf1f5;
        background: #fbfcfd;
    }

    .quadrature-form-footer-actions {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .quadrature-form-cancel {
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

    .quadrature-form-cancel:hover {
        background: #f5f8fb;
        border-color: #cbd7e3;
    }

    @media (max-width: 700px) {

        .quadrature-form-grid {
            grid-template-columns: 1fr;
        }

        .quadrature-form-group-full {
            grid-column: auto;
        }

        .quadrature-form-footer {
            align-items: stretch;
            flex-direction: column;
        }

        .quadrature-form-footer-actions {
            width: 100%;
        }

        .quadrature-form-footer-actions .btn,
        .quadrature-form-footer-actions .quadrature-form-cancel {
            flex: 1;
        }

    }

</style>

@endpush


@section('content')

    <div class="quadrature-form-header">

        <h1 class="quadrature-form-title">
            Editar cuadratura
        </h1>

        <p class="quadrature-form-subtitle">
            Modifica los totales y antecedentes registrados en esta cuadratura.
        </p>

    </div>


    <div class="quadrature-worker-card">

        <div class="quadrature-worker-label">
            Trabajador
        </div>

        <div class="quadrature-worker-name">
            {{ $trabajador->nombre }}
        </div>

        <div class="quadrature-worker-rut">
            RUT:
            {{ $trabajador->rut }}
        </div>

    </div>


    @if($errors->any())

        <div class="quadrature-form-alert">
            Revisa los datos ingresados. Hay campos que requieren corrección antes de guardar los cambios.
        </div>

    @endif


    <section class="quadrature-form-card">

        <div class="quadrature-form-card-header">

            <h2 class="quadrature-form-card-title">
                Información de la cuadratura
            </h2>

            <p class="quadrature-form-card-description">
                Actualiza la operación, período y los totales correspondientes.
            </p>

        </div>


        <form
            action="{{ route('trabajadores.cuadraturas.update', ['trabajador' => $trabajador, 'cuadratura' => $cuadratura]) }}"
            method="POST"
        >

            @csrf
            @method('PUT')


            <div class="quadrature-form-body">

                <div class="quadrature-form-grid">

                    <div class="quadrature-form-group">

                        <label
                            for="operacion_id"
                            class="quadrature-form-label"
                        >
                            Operación
                            <span class="quadrature-form-required">*</span>
                        </label>

                        <select
                            id="operacion_id"
                            name="operacion_id"
                            class="quadrature-form-input"
                            required
                            autofocus
                        >

                            <option value="">
                                Seleccionar operación
                            </option>

                            @foreach($operaciones as $operacion)

                                <option
                                    value="{{ $operacion->id }}"
                                    {{ (string) old('operacion_id', $cuadratura->operacion_id) === (string) $operacion->id ? 'selected' : '' }}
                                >
                                    {{ $operacion->numero_operacion
                                        ?? 'Operación #' . $operacion->id
                                    }}
                                </option>

                            @endforeach

                        </select>

                        @error('operacion_id')
                            <div class="quadrature-form-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <div class="quadrature-form-group">

                        <label
                            for="periodo"
                            class="quadrature-form-label"
                        >
                            Período
                            <span class="quadrature-form-required">*</span>
                        </label>

                        <input
                            type="month"
                            id="periodo"
                            name="periodo"
                            class="quadrature-form-input"
                            value="{{ old('periodo', $cuadratura->periodo) }}"
                            required
                        >

                        @error('periodo')
                            <div class="quadrature-form-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <div class="quadrature-form-group">

                        <label
                            for="fecha"
                            class="quadrature-form-label"
                        >
                            Fecha
                        </label>

                        <input
                            type="date"
                            id="fecha"
                            name="fecha"
                            class="quadrature-form-input"
                            value="{{ old('fecha', $cuadratura->fecha ? $cuadratura->fecha->format('Y-m-d') : '') }}"
                        >

                        @error('fecha')
                            <div class="quadrature-form-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <div class="quadrature-form-group">

                        <label
                            for="total_horas"
                            class="quadrature-form-label"
                        >
                            Total de horas
                            <span class="quadrature-form-required">*</span>
                        </label>

                        <input
                            type="number"
                            id="total_horas"
                            name="total_horas"
                            class="quadrature-form-input"
                            value="{{ old('total_horas', rtrim(rtrim(number_format((float) $cuadratura->total_horas, 2, '.', ''), '0'), '.')) }}"
                            min="0"
                            step="0.01"
                            required
                        >

                        @error('total_horas')
                            <div class="quadrature-form-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <div class="quadrature-form-group">

                        <label
                            for="dinero_depositado"
                            class="quadrature-form-label"
                        >
                            Dinero depositado
                            <span class="quadrature-form-required">*</span>
                        </label>

                        <input
                            type="number"
                            id="dinero_depositado"
                            name="dinero_depositado"
                            class="quadrature-form-input quadrature-calculate"
                            value="{{ old('dinero_depositado', rtrim(rtrim(number_format((float) $cuadratura->dinero_depositado, 2, '.', ''), '0'), '.')) }}"
                            min="0"
                            step="0.01"
                            required
                        >

                        @error('dinero_depositado')
                            <div class="quadrature-form-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <div class="quadrature-form-group">

                        <label
                            for="gastos_facturados"
                            class="quadrature-form-label"
                        >
                            Gastos facturados
                            <span class="quadrature-form-required">*</span>
                        </label>

                        <input
                            type="number"
                            id="gastos_facturados"
                            name="gastos_facturados"
                            class="quadrature-form-input quadrature-calculate"
                            value="{{ old('gastos_facturados', rtrim(rtrim(number_format((float) $cuadratura->gastos_facturados, 2, '.', ''), '0'), '.')) }}"
                            min="0"
                            step="0.01"
                            required
                        >

                        @error('gastos_facturados')
                            <div class="quadrature-form-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <div class="quadrature-form-group">

                        <label
                            for="gastos_con_boleta"
                            class="quadrature-form-label"
                        >
                            Gastos con boleta
                            <span class="quadrature-form-required">*</span>
                        </label>

                        <input
                            type="number"
                            id="gastos_con_boleta"
                            name="gastos_con_boleta"
                            class="quadrature-form-input quadrature-calculate"
                            value="{{ old('gastos_con_boleta', rtrim(rtrim(number_format((float) $cuadratura->gastos_con_boleta, 2, '.', ''), '0'), '.')) }}"
                            min="0"
                            step="0.01"
                            required
                        >

                        @error('gastos_con_boleta')
                            <div class="quadrature-form-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <div class="quadrature-form-group">

                        <label
                            for="gastos_sin_comprobante"
                            class="quadrature-form-label"
                        >
                            Gastos sin comprobante
                            <span class="quadrature-form-required">*</span>
                        </label>

                        <input
                            type="number"
                            id="gastos_sin_comprobante"
                            name="gastos_sin_comprobante"
                            class="quadrature-form-input quadrature-calculate"
                            value="{{ old('gastos_sin_comprobante', rtrim(rtrim(number_format((float) $cuadratura->gastos_sin_comprobante, 2, '.', ''), '0'), '.')) }}"
                            min="0"
                            step="0.01"
                            required
                        >

                        @error('gastos_sin_comprobante')
                            <div class="quadrature-form-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <div class="quadrature-form-group">

                        <label
                            for="saldo_a_favor"
                            class="quadrature-form-label"
                        >
                            Saldo a favor
                        </label>

                        <input
                            type="number"
                            id="saldo_a_favor"
                            name="saldo_a_favor"
                            class="quadrature-form-input"
                            value="{{ old('saldo_a_favor', rtrim(rtrim(number_format((float) $cuadratura->saldo_a_favor, 2, '.', ''), '0'), '.')) }}"
                            min="0"
                            step="0.01"
                            readonly
                        >

                        <div class="quadrature-form-help">
                            Se calcula automáticamente según los totales ingresados.
                        </div>

                        @error('saldo_a_favor')
                            <div class="quadrature-form-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <div class="quadrature-form-group">

                        <label
                            for="saldo_en_contra"
                            class="quadrature-form-label"
                        >
                            Saldo en contra
                        </label>

                        <input
                            type="number"
                            id="saldo_en_contra"
                            name="saldo_en_contra"
                            class="quadrature-form-input"
                            value="{{ old('saldo_en_contra', rtrim(rtrim(number_format((float) $cuadratura->saldo_en_contra, 2, '.', ''), '0'), '.')) }}"
                            min="0"
                            step="0.01"
                            readonly
                        >

                        <div class="quadrature-form-help">
                            Se calcula automáticamente según los totales ingresados.
                        </div>

                        @error('saldo_en_contra')
                            <div class="quadrature-form-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <div class="quadrature-form-group quadrature-form-group-full">

                        <label
                            for="estado"
                            class="quadrature-form-label"
                        >
                            Estado
                            <span class="quadrature-form-required">*</span>
                        </label>

                        <select
                            id="estado"
                            name="estado"
                            class="quadrature-form-input"
                            required
                        >

                            <option
                                value="pendiente"
                                {{ old('estado', $cuadratura->estado) === 'pendiente' ? 'selected' : '' }}
                            >
                                Pendiente
                            </option>

                            <option
                                value="cuadrada"
                                {{ old('estado', $cuadratura->estado) === 'cuadrada' ? 'selected' : '' }}
                            >
                                Cuadrada
                            </option>

                            <option
                                value="cerrada"
                                {{ old('estado', $cuadratura->estado) === 'cerrada' ? 'selected' : '' }}
                            >
                                Cerrada
                            </option>

                        </select>

                        @error('estado')
                            <div class="quadrature-form-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <div class="quadrature-form-group quadrature-form-group-full">

                        <label
                            for="observaciones"
                            class="quadrature-form-label"
                        >
                            Observaciones
                        </label>

                        <textarea
                            id="observaciones"
                            name="observaciones"
                            class="quadrature-form-input"
                            placeholder="Información adicional sobre esta cuadratura..."
                        >{{ old('observaciones', $cuadratura->observaciones) }}</textarea>

                        @error('observaciones')
                            <div class="quadrature-form-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>


                <div class="quadrature-form-info">

                    <strong>Importante:</strong>
                    los saldos se recalculan automáticamente al modificar el dinero depositado o cualquiera de los gastos.

                </div>

            </div>


            <div class="quadrature-form-footer">

                <div>

                    <span class="quadrature-form-help">
                        Los campos marcados con * son obligatorios.
                    </span>

                </div>


                <div class="quadrature-form-footer-actions">

                    <a
                        href="{{ route('trabajadores.show', $trabajador) }}"
                        class="quadrature-form-cancel"
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


    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const dineroDepositado = document.getElementById('dinero_depositado');
            const gastosFacturados = document.getElementById('gastos_facturados');
            const gastosConBoleta = document.getElementById('gastos_con_boleta');
            const gastosSinComprobante = document.getElementById('gastos_sin_comprobante');
            const saldoAFavor = document.getElementById('saldo_a_favor');
            const saldoEnContra = document.getElementById('saldo_en_contra');

            function obtenerValor(campo) {
                return parseFloat(campo.value) || 0;
            }

            function calcularSaldo() {

                const depositado = obtenerValor(dineroDepositado);

                const gastos =
                    obtenerValor(gastosFacturados) +
                    obtenerValor(gastosConBoleta) +
                    obtenerValor(gastosSinComprobante);

                const diferencia = depositado - gastos;

                if (diferencia >= 0) {
                    saldoAFavor.value = diferencia;
                    saldoEnContra.value = 0;
                } else {
                    saldoAFavor.value = 0;
                    saldoEnContra.value = Math.abs(diferencia);
                }

            }

            document
                .querySelectorAll('.quadrature-calculate')
                .forEach(function (campo) {
                    campo.addEventListener('input', calcularSaldo);
                });

            calcularSaldo();

        });

    </script>

@endsection