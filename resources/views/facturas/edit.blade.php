@extends('layouts.app')

@section('title', 'Editar factura')

@section('content')

<style>

    .factura-form-page {
        width: 100%;
    }

    .factura-form-header {
        margin-bottom: 24px;
    }

    .factura-form-header h1 {
        margin: 0;
        color: #172033;
        font-size: 28px;
        font-weight: 700;
    }

    .factura-form-header p {
        margin: 6px 0 0;
        color: #667085;
        font-size: 14px;
    }

    .factura-form-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        margin-bottom: 18px;
        overflow: hidden;
    }

    .factura-form-card-header {
        padding: 16px 18px;
        border-bottom: 1px solid #e2e8f0;
    }

    .factura-form-card-header h2 {
        margin: 0;
        color: #172033;
        font-size: 15px;
        font-weight: 700;
    }

    .factura-form-card-header p {
        margin: 4px 0 0;
        color: #667085;
        font-size: 12px;
    }

    .factura-form-body {
        padding: 20px 18px;
    }

    .factura-form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
    }

    .factura-form-grid-3 {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 18px;
    }

    .factura-form-group {
        display: flex;
        flex-direction: column;
    }

    .factura-form-group.full {
        grid-column: 1 / -1;
    }

    .factura-form-label {
        margin-bottom: 6px;
        color: #344054;
        font-size: 12px;
        font-weight: 600;
    }

    .factura-form-label .required {
        color: #b42318;
    }

    .factura-form-control {
        width: 100%;
        min-height: 38px;
        padding: 8px 10px;
        border: 1px solid #dce3eb;
        border-radius: 6px;
        background: #ffffff;
        color: #172033;
        font-family: inherit;
        font-size: 13px;
        outline: none;
        box-sizing: border-box;
    }

    .factura-form-control:focus {
        border-color: #155a91;
        box-shadow: 0 0 0 2px rgba(21, 90, 145, .08);
    }

    textarea.factura-form-control {
        min-height: 95px;
        resize: vertical;
    }

    .factura-form-control[readonly] {
        background: #f8fafc;
        color: #475467;
    }

    .factura-form-help {
        margin-top: 5px;
        color: #667085;
        font-size: 11px;
        line-height: 1.4;
    }

    .factura-form-error {
        margin-top: 5px;
        color: #b42318;
        font-size: 11px;
    }

    .factura-total-box {
        background: #f8fafc;
        border: 1px solid #dce3eb;
        border-radius: 7px;
        padding: 15px 16px;
    }

    .factura-total-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        padding: 6px 0;
        color: #475467;
        font-size: 13px;
    }

    .factura-total-row + .factura-total-row {
        border-top: 1px solid #e2e8f0;
    }

    .factura-total-row strong {
        color: #172033;
    }

    .factura-total-final {
        margin-top: 4px;
        padding-top: 11px !important;
        font-size: 15px;
        font-weight: 700;
    }

    .factura-total-final strong {
        color: #155a91;
        font-size: 17px;
    }

    .factura-form-actions {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 8px;
        margin-top: 20px;
    }

    .btn-primary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 38px;
        padding: 0 15px;
        border-radius: 6px;
        background: #155a91;
        border: 1px solid #155a91;
        color: #ffffff;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        transition: .18s ease;
    }

    .btn-primary:hover {
        background: #124d7c;
        border-color: #124d7c;
        color: #ffffff;
    }

    .btn-secondary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 38px;
        padding: 0 15px;
        border-radius: 6px;
        background: #ffffff;
        border: 1px solid #dce3eb;
        color: #475467;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        transition: .18s ease;
    }

    .btn-secondary:hover {
        background: #f8fafc;
        border-color: #b9c3d0;
        color: #172033;
    }

    .factura-operacion-info {
        display: none;
        margin-top: 8px;
        padding: 9px 11px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        color: #475467;
        font-size: 11px;
    }

    .factura-operacion-info strong {
        color: #172033;
    }

    .factura-alerta {
        margin-bottom: 18px;
        padding: 11px 13px;
        border-radius: 6px;
        font-size: 12px;
    }

    .factura-alerta-error {
        background: #fdf3f3;
        border: 1px solid #f1c5c5;
        color: #9b2c2c;
    }

    .factura-actual {
        display: inline-flex;
        align-items: center;
        min-height: 23px;
        padding: 3px 8px;
        margin-top: 7px;
        border-radius: 5px;
        background: #eef5fb;
        color: #155a91;
        font-size: 10px;
        font-weight: 700;
    }

    @media (max-width: 850px) {

        .factura-form-grid,
        .factura-form-grid-3 {
            grid-template-columns: 1fr;
        }

        .factura-form-group.full {
            grid-column: auto;
        }
    }

</style>

<div class="factura-form-page">

    {{-- ENCABEZADO --}}

    <div class="factura-form-header">

        <h1>
            Editar factura {{ $factura->numero_factura }}
        </h1>

        <p>
            Modifica los datos registrados de la factura.
        </p>

    </div>

    {{-- ERRORES --}}

    @if($errors->any())

        <div class="factura-alerta factura-alerta-error">
            Revisa los datos ingresados. Hay campos que requieren corrección.
        </div>

    @endif

    <form
        action="{{ route('facturas.update', $factura) }}"
        method="POST"
    >

        @csrf
        @method('PUT')

        {{-- INFORMACIÓN DE LA FACTURA --}}

        <div class="factura-form-card">

            <div class="factura-form-card-header">

                <h2>
                    Información de la factura
                </h2>

                <p>
                    Datos principales y asociación con la operación.
                </p>

            </div>

            <div class="factura-form-body">

                <div class="factura-form-grid">

                    {{-- OPERACIÓN --}}

                    <div class="factura-form-group">

                        <label
                            for="operacion_id"
                            class="factura-form-label"
                        >
                            Operación <span class="required">*</span>
                        </label>

                        <select
                            name="operacion_id"
                            id="operacion_id"
                            class="factura-form-control"
                            required
                        >

                            <option value="">
                                Seleccionar operación
                            </option>

                            @foreach($operaciones as $operacion)

                                <option
                                    value="{{ $operacion->id }}"
                                    data-cliente="{{ $operacion->cliente?->nombre ?? '' }}"
                                    data-fecha="{{ $operacion->fecha_operacion?->format('d/m/Y') ?? '' }}"
                                    {{ old(
                                        'operacion_id',
                                        $factura->operacion_id
                                    ) == $operacion->id ? 'selected' : '' }}
                                >

                                    {{ $operacion->numero_operacion }}

                                    @if($operacion->cliente)
                                        — {{ $operacion->cliente->nombre }}
                                    @endif

                                </option>

                            @endforeach

                        </select>

                        <div
                            id="operacionInfo"
                            class="factura-operacion-info"
                        >

                            <strong>Cliente:</strong>

                            <span id="operacionCliente">
                                -
                            </span>

                            &nbsp;&nbsp;|&nbsp;&nbsp;

                            <strong>Fecha operación:</strong>

                            <span id="operacionFecha">
                                -
                            </span>

                        </div>

                        @error('operacion_id')

                            <div class="factura-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                    {{-- NÚMERO FACTURA --}}

                    <div class="factura-form-group">

                        <label
                            for="numero_factura"
                            class="factura-form-label"
                        >
                            Número de factura <span class="required">*</span>
                        </label>

                        <input
                            type="text"
                            name="numero_factura"
                            id="numero_factura"
                            class="factura-form-control"
                            value="{{ old(
                                'numero_factura',
                                $factura->numero_factura
                            ) }}"
                            maxlength="255"
                            required
                        >

                        @error('numero_factura')

                            <div class="factura-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                    {{-- FECHA EMISIÓN --}}

                    <div class="factura-form-group">

                        <label
                            for="fecha_emision"
                            class="factura-form-label"
                        >
                            Fecha de emisión
                        </label>

                        <input
                            type="date"
                            name="fecha_emision"
                            id="fecha_emision"
                            class="factura-form-control"
                            value="{{ old(
                                'fecha_emision',
                                $factura->fecha_emision?->format('Y-m-d')
                            ) }}"
                        >

                        @error('fecha_emision')

                            <div class="factura-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                    {{-- FECHA VENCIMIENTO --}}

                    <div class="factura-form-group">

                        <label
                            for="fecha_vencimiento"
                            class="factura-form-label"
                        >
                            Fecha de vencimiento
                        </label>

                        <input
                            type="date"
                            name="fecha_vencimiento"
                            id="fecha_vencimiento"
                            class="factura-form-control"
                            value="{{ old(
                                'fecha_vencimiento',
                                $factura->fecha_vencimiento?->format('Y-m-d')
                            ) }}"
                        >

                        @error('fecha_vencimiento')

                            <div class="factura-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                </div>

            </div>

        </div>

        {{-- ESTADO --}}

        <div class="factura-form-card">

            <div class="factura-form-card-header">

                <h2>
                    Estado y seguimiento
                </h2>

                <p>
                    Estado actual de la factura y control de mora.
                </p>

            </div>

            <div class="factura-form-body">

                <div class="factura-form-grid">

                    {{-- ESTADO --}}

                    <div class="factura-form-group">

                        <label
                            for="estado"
                            class="factura-form-label"
                        >
                            Estado de la factura <span class="required">*</span>
                        </label>

                        <select
                            name="estado"
                            id="estado"
                            class="factura-form-control"
                            required
                        >

                            <option
                                value="vigente"
                                {{ old(
                                    'estado',
                                    $factura->estado
                                ) === 'vigente' ? 'selected' : '' }}
                            >
                                Vigente
                            </option>

                            <option
                                value="anulada"
                                {{ old(
                                    'estado',
                                    $factura->estado
                                ) === 'anulada' ? 'selected' : '' }}
                            >
                                Anulada
                            </option>

                            <option
                                value="reemplazada"
                                {{ old(
                                    'estado',
                                    $factura->estado
                                ) === 'reemplazada' ? 'selected' : '' }}
                            >
                                Reemplazada
                            </option>

                        </select>

                        <span class="factura-actual">
                            Estado actual:
                            {{ ucfirst($factura->estado) }}
                        </span>

                        @error('estado')

                            <div class="factura-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                    {{-- MORA --}}

                    <div class="factura-form-group">

                        <label
                            for="estado_mora"
                            class="factura-form-label"
                        >
                            Estado de mora <span class="required">*</span>
                        </label>

                        <select
                            name="estado_mora"
                            id="estado_mora"
                            class="factura-form-control"
                            required
                        >

                            <option
                                value="sin_mora"
                                {{ old(
                                    'estado_mora',
                                    $factura->estado_mora
                                ) === 'sin_mora' ? 'selected' : '' }}
                            >
                                Sin mora
                            </option>

                            <option
                                value="con_mora"
                                {{ old(
                                    'estado_mora',
                                    $factura->estado_mora
                                ) === 'con_mora' ? 'selected' : '' }}
                            >
                                Con mora
                            </option>

                        </select>

                        <div class="factura-form-help">
                            El detalle de la mora se gestionará posteriormente
                            mediante su módulo correspondiente.
                        </div>

                        @error('estado_mora')

                            <div class="factura-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                    {{-- FACTURA REEMPLAZADA --}}

                    <div class="factura-form-group full">

                        <label
                            for="factura_reemplazada_id"
                            class="factura-form-label"
                        >
                            Factura reemplazada
                        </label>

                        <select
                            name="factura_reemplazada_id"
                            id="factura_reemplazada_id"
                            class="factura-form-control"
                        >

                            <option value="">
                                No corresponde
                            </option>

                            @foreach($facturas as $facturaAnterior)

                                <option
                                    value="{{ $facturaAnterior->id }}"
                                    {{ old(
                                        'factura_reemplazada_id',
                                        $factura->factura_reemplazada_id
                                    ) == $facturaAnterior->id ? 'selected' : '' }}
                                >

                                    {{ $facturaAnterior->numero_factura }}

                                    @if($facturaAnterior->operacion)

                                        — Operación
                                        {{ $facturaAnterior->operacion->numero_operacion }}

                                    @endif

                                </option>

                            @endforeach

                        </select>

                        <div class="factura-form-help">
                            Utiliza este campo cuando esta factura reemplaza
                            a una factura anterior.
                        </div>

                        @error('factura_reemplazada_id')

                            <div class="factura-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                </div>

            </div>

        </div>

        {{-- MONTOS --}}

        <div class="factura-form-card">

            <div class="factura-form-card-header">

                <h2>
                    Montos
                </h2>

                <p>
                    El IVA y el total se calculan automáticamente a partir del monto neto.
                </p>

            </div>

            <div class="factura-form-body">

                <div class="factura-form-grid-3">

                    {{-- NETO --}}

                    <div class="factura-form-group">

                        <label
                            for="neto"
                            class="factura-form-label"
                        >
                            Neto <span class="required">*</span>
                        </label>

                        <input
                            type="number"
                            name="neto"
                            id="neto"
                            class="factura-form-control"
                            value="{{ old(
                                'neto',
                                (int) $factura->neto
                            ) }}"
                            min="0"
                            step="1"
                            required
                        >

                        @error('neto')

                            <div class="factura-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                    {{-- IVA --}}

                    <div class="factura-form-group">

                        <label
                            for="iva"
                            class="factura-form-label"
                        >
                            IVA 19%
                        </label>

                        <input
                            type="text"
                            id="iva"
                            class="factura-form-control"
                            value="$0"
                            readonly
                        >

                    </div>

                    {{-- TOTAL --}}

                    <div class="factura-form-group">

                        <label
                            for="total"
                            class="factura-form-label"
                        >
                            Total
                        </label>

                        <input
                            type="text"
                            id="total"
                            class="factura-form-control"
                            value="$0"
                            readonly
                        >

                    </div>

                </div>

                <div class="factura-total-box">

                    <div class="factura-total-row">

                        <span>
                            Neto
                        </span>

                        <strong id="resumenNeto">
                            $0
                        </strong>

                    </div>

                    <div class="factura-total-row">

                        <span>
                            IVA 19%
                        </span>

                        <strong id="resumenIva">
                            $0
                        </strong>

                    </div>

                    <div class="factura-total-row factura-total-final">

                        <span>
                            Total factura
                        </span>

                        <strong id="resumenTotal">
                            $0
                        </strong>

                    </div>

                </div>

            </div>

        </div>

        {{-- PAGO --}}

        <div class="factura-form-card">

            <div class="factura-form-card-header">

                <h2>
                    Pago y cierre
                </h2>

                <p>
                    Información de pago y cierre de la factura.
                </p>

            </div>

            <div class="factura-form-body">

                <div class="factura-form-grid">

                    {{-- FECHA PAGO --}}

                    <div class="factura-form-group">

                        <label
                            for="fecha_pago"
                            class="factura-form-label"
                        >
                            Fecha de pago
                        </label>

                        <input
                            type="date"
                            name="fecha_pago"
                            id="fecha_pago"
                            class="factura-form-control"
                            value="{{ old(
                                'fecha_pago',
                                $factura->fecha_pago?->format('Y-m-d')
                            ) }}"
                        >

                        <div class="factura-form-help">
                            Fecha en que se recibió el pago de la factura.
                        </div>

                        @error('fecha_pago')

                            <div class="factura-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                    {{-- FECHA CIERRE --}}

                    <div class="factura-form-group">

                        <label
                            for="fecha_cierre"
                            class="factura-form-label"
                        >
                            Fecha de cierre
                        </label>

                        <input
                            type="date"
                            name="fecha_cierre"
                            id="fecha_cierre"
                            class="factura-form-control"
                            value="{{ old(
                                'fecha_cierre',
                                $factura->fecha_cierre?->format('Y-m-d')
                            ) }}"
                        >

                        <div class="factura-form-help">
                            Fecha en que la factura quedó completamente cerrada.
                        </div>

                        @error('fecha_cierre')

                            <div class="factura-form-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                </div>

            </div>

        </div>

        {{-- OBSERVACIONES --}}

        <div class="factura-form-card">

            <div class="factura-form-card-header">

                <h2>
                    Observaciones
                </h2>

                <p>
                    Información adicional relacionada con la factura.
                </p>

            </div>

            <div class="factura-form-body">

                <div class="factura-form-group">

                    <label
                        for="observaciones"
                        class="factura-form-label"
                    >
                        Observaciones
                    </label>

                    <textarea
                        name="observaciones"
                        id="observaciones"
                        class="factura-form-control"
                        placeholder="Ingresa observaciones si corresponde..."
                    >{{ old(
                        'observaciones',
                        $factura->observaciones
                    ) }}</textarea>

                    @error('observaciones')

                        <div class="factura-form-error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>

            </div>

        </div>

        {{-- ACCIONES --}}

        <div class="factura-form-actions">

            <a
                href="{{ route('facturas.show', $factura) }}"
                class="btn-secondary"
            >
                Cancelar
            </a>

            <button
                type="submit"
                class="btn-primary"
            >
                Guardar cambios
            </button>

        </div>

    </form>

</div>

<script>

    document.addEventListener('DOMContentLoaded', function () {

        const operacionSelect =
            document.getElementById('operacion_id');

        const operacionInfo =
            document.getElementById('operacionInfo');

        const operacionCliente =
            document.getElementById('operacionCliente');

        const operacionFecha =
            document.getElementById('operacionFecha');

        const netoInput =
            document.getElementById('neto');

        const ivaInput =
            document.getElementById('iva');

        const totalInput =
            document.getElementById('total');

        const resumenNeto =
            document.getElementById('resumenNeto');

        const resumenIva =
            document.getElementById('resumenIva');

        const resumenTotal =
            document.getElementById('resumenTotal');


        function formatearMonto(valor) {

            return '$' + Number(valor).toLocaleString(
                'es-CL',
                {
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0
                }
            );

        }


        function calcularMontos() {

            const neto =
                Math.max(
                    0,
                    Math.trunc(
                        Number(netoInput.value) || 0
                    )
                );


            const iva =
                Math.round(
                    neto * 0.19
                );


            const total =
                neto + iva;


            const netoFormateado =
                formatearMonto(neto);

            const ivaFormateado =
                formatearMonto(iva);

            const totalFormateado =
                formatearMonto(total);


            ivaInput.value =
                ivaFormateado;

            totalInput.value =
                totalFormateado;


            resumenNeto.textContent =
                netoFormateado;

            resumenIva.textContent =
                ivaFormateado;

            resumenTotal.textContent =
                totalFormateado;

        }


        function mostrarOperacion() {

            const opcion =
                operacionSelect.options[
                    operacionSelect.selectedIndex
                ];


            if (
                !opcion ||
                !opcion.value
            ) {

                operacionInfo.style.display =
                    'none';

                operacionCliente.textContent =
                    '-';

                operacionFecha.textContent =
                    '-';

                return;

            }


            operacionCliente.textContent =
                opcion.dataset.cliente || '-';

            operacionFecha.textContent =
                opcion.dataset.fecha || '-';


            operacionInfo.style.display =
                'block';

        }


        netoInput.addEventListener(
            'input',
            calcularMontos
        );


        operacionSelect.addEventListener(
            'change',
            mostrarOperacion
        );


        calcularMontos();

        mostrarOperacion();

    });

</script>

@endsection