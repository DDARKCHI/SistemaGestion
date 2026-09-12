@extends('layouts.app')

@section('title', 'Subir documento')

@section('content')

@php

    $operacionesJson = $operaciones->map(

        fn ($operacion) => [

            'id' => $operacion->id,

            'numero' => $operacion->numero_operacion,

            'cliente' => $operacion->cliente?->razon_social ?? '',

        ]

    )->values()->toJson();

    $gastosJson = $gastos->map(

        fn ($gasto) => [

            'id' => $gasto->id,

            'fecha' => $gasto->fecha?->format('d/m/Y') ?? '',

            'tipo' => $gasto->tipo ?? '',

            'descripcion' => $gasto->descripcion ?? '',

            'monto' => number_format(

                (float) $gasto->monto,

                0,

                ',',

                '.'

            ),

            'operacion' => $gasto->operacion?->numero_operacion ?? '',

            'cliente' => $gasto->operacion?->cliente?->razon_social ?? '',

            'transportista' => $gasto->transportista?->nombre ?? '',

        ]

    )->values()->toJson();

@endphp





<div class="page-header">

    <div class="header-info">

        <span class="page-kicker">

            DOCUMENTOS

        </span>

        <h1>Subir documento</h1>

        <p>

            Registra un documento y asócialo directamente a un registro del sistema.

        </p>

    </div>





    <a

        href="{{ route('documentos.index') }}"

        class="btn btn-secondary"

    >

        <span class="btn-icon">←</span>

        Volver

    </a>

</div>





@if($errors->any())

    <div class="alert alert-error">

        <div class="alert-title">

            No se pudo subir el documento

        </div>

        <ul>

            @foreach($errors->all() as $error)

                <li>

                    {{ $error }}

                </li>

            @endforeach

        </ul>

    </div>

@endif





<form

    action="{{ route('documentos.store') }}"

    method="POST"

    enctype="multipart/form-data"

    id="documentForm"

>

    @csrf





    {{-- =====================================================

         INFORMACIÓN PRINCIPAL

    ====================================================== --}}

    <div class="main-grid">





        {{-- =================================================

             REGISTRO ASOCIADO

        ================================================== --}}

        <section class="panel association-panel">

            <div class="panel-header">

                <div>

                    <span class="panel-kicker">

                        ASOCIACIÓN

                    </span>

                    <h2>Registro asociado</h2>

                </div>

            </div>





            {{-- TIPO DE REGISTRO --}}

            <div class="field">

                <label for="registro_tipo">

                    Tipo de registro

                    <span class="required">*</span>

                </label>





                <select

                    name="registro_tipo"

                    id="registro_tipo"

                    class="form-control"

                    required

                >

                    <option value="">

                        Seleccionar registro

                    </option>

                    <option

                        value="operacion"

                        {{ old('registro_tipo', request('registro_tipo')) === 'operacion' ? 'selected' : '' }}

                    >

                        Operación

                    </option>

                    <option

                        value="gasto"

                        {{ old('registro_tipo', request('registro_tipo')) === 'gasto' ? 'selected' : '' }}

                    >

                        Gasto

                    </option>

                </select>





                @error('registro_tipo')

                    <div class="field-error">

                        {{ $message }}

                    </div>

                @enderror

            </div>





            {{-- BUSCADOR --}}

            <div class="field">

                <label for="registro_busqueda">

                    <span id="label_busqueda">

                        Buscar operación

                    </span>

                    <span class="required">*</span>

                </label>





                <div class="search-select">

                    <div class="input-wrapper">

                        <input

                            type="text"

                            id="registro_busqueda"

                            class="form-control"

                            placeholder="Primero selecciona el tipo de registro..."

                            autocomplete="off"

                            disabled

                        >

                        <span class="search-icon">

                            ⌕

                        </span>

                    </div>





                    <input

                        type="hidden"

                        name="registro_id"

                        id="registro_id"

                        value="{{ old('registro_id', request('registro_id')) }}"

                    >





                    <div

                        id="registros_resultados"

                        class="search-results"

                    ></div>

                </div>





                @error('registro_id')

                    <div class="field-error">

                        {{ $message }}

                    </div>

                @enderror

            </div>





            {{-- REGISTRO SELECCIONADO --}}

            <div

                id="registro_seleccionado"

                class="selected-operation"

                style="display :none;"

            >

                <div

                    id="seleccionado_icono"

                    class="selected-icon"

                >

                    OP

                </div>





                <div class="selected-info">

                    <span

                        id="seleccionado_label"

                        class="selected-label"

                    >

                        REGISTRO SELECCIONADO

                    </span>

                    <strong

                        id="seleccionado_titulo"

                    ></strong>

                    <span

                        id="seleccionado_secundario"

                        class="selected-client"

                    ></span>

                </div>

            </div>





            {{-- ESTADO INICIAL --}}

            <div

                id="sin_registro"

                class="no-operation"

            >

                <span class="no-operation-icon">

                    !

                </span>

                <div>

                    <strong>

                        Selecciona un tipo de registro

                    </strong>

                    <span>

                        Puedes asociar el documento a una operación o a un gasto.

                    </span>

                </div>

            </div>

        </section>





        {{-- =================================================

             INFORMACIÓN DEL DOCUMENTO

        ================================================== --}}

        <section class="panel information-panel">

            <div class="panel-header">

                <div>

                    <span class="panel-kicker">

                        INFORMACIÓN

                    </span>

                    <h2>Datos del documento</h2>

                </div>

            </div>





            {{-- TIPO --}}

            <div class="field">

                <label for="tipo">

                    Tipo de documento

                </label>





                <select

                    name="tipo"

                    id="tipo"

                    class="form-control"

                >

                    <option value="">

                        Seleccionar tipo

                    </option>

                    <option

                        value="factura"

                        {{ old('tipo') === 'factura' ? 'selected' : '' }}

                    >

                        Factura

                    </option>

                    <option

                        value="guia_despacho"

                        {{ old('tipo') === 'guia_despacho' ? 'selected' : '' }}

                    >

                        Guía de despacho

                    </option>

                    <option

                        value="contrato"

                        {{ old('tipo') === 'contrato' ? 'selected' : '' }}

                    >

                        Contrato

                    </option>

                    <option

                        value="orden_compra"

                        {{ old('tipo') === 'orden_compra' ? 'selected' : '' }}

                    >

                        Orden de compra

                    </option>

                    <option

                        value="boleta"

                        {{ old('tipo') === 'boleta' ? 'selected' : '' }}

                    >

                        Boleta

                    </option>

                    <option

                        value="comprobante"

                        {{ old('tipo') === 'comprobante' ? 'selected' : '' }}

                    >

                        Comprobante

                    </option>

                    <option

                        value="respaldo"

                        {{ old('tipo') === 'respaldo' ? 'selected' : '' }}

                    >

                        Respaldo

                    </option>

                    <option

                        value="otro"

                        {{ old('tipo') === 'otro' ? 'selected' : '' }}

                    >

                        Otro

                    </option>

                </select>





                @error('tipo')

                    <div class="field-error">

                        {{ $message }}

                    </div>

                @enderror

            </div>





            {{-- DESCRIPCIÓN --}}

            <div class="field">

                <label for="descripcion">

                    Descripción

                </label>





                <textarea

                    name="descripcion"

                    id="descripcion"

                    class="form-control textarea"

                    rows="3"

                    maxlength="2000"

                    placeholder="Describe brevemente el documento..."

                >{{ old('descripcion') }}</textarea>





                @error('descripcion')

                    <div class="field-error">

                        {{ $message }}

                    </div>

                @enderror

            </div>





            {{-- OBSERVACIONES --}}

            <div class="field field-last">

                <label for="observaciones">

                    Observaciones

                </label>





                <textarea

                    name="observaciones"

                    id="observaciones"

                    class="form-control textarea"

                    rows="3"

                    maxlength="2000"

                    placeholder="Observaciones adicionales..."

                >{{ old('observaciones') }}</textarea>





                @error('observaciones')

                    <div class="field-error">

                        {{ $message }}

                    </div>

                @enderror

            </div>

        </section>

    </div>





    {{-- =====================================================

         ARCHIVO

    ====================================================== --}}

    <section class="panel file-panel">

        <div class="panel-header file-header">

            <div>

                <span class="panel-kicker">

                    ARCHIVO

                </span>

                <h2>Archivo a almacenar</h2>

            </div>

        </div>





        <div class="file-upload-area">

            <label for="archivo" class="file-upload-label">

                <span class="file-upload-icon">

                    FILE

                </span>





                <span class="file-upload-content">

                    <strong>

                        Seleccionar archivo

                    </strong>

                    <small>

                        PDF, imágenes, documentos u otros archivos. Máximo 10 MB.

                    </small>

                </span>

            </label>





            <input

                type="file"

                name="archivo"

                id="archivo"

                class="file-input"

                required

            >





            <div

                id="archivo_info"

                class="archivo-info"

            ></div>





            @error('archivo')

                <div class="field-error">

                    {{ $message }}

                </div>

            @enderror

        </div>

    </section>





    {{-- =====================================================

         ACCIONES

    ====================================================== --}}

    <div class="form-actions">

        <a

            href="{{ route('documentos.index') }}"

            class="btn btn-secondary"

        >

            Cancelar

        </a>





        <button

            type="submit"

            class="btn btn-primary"

        >

            Subir documento

        </button>

    </div>

</form>





<script>

    document.addEventListener(

        'DOMContentLoaded',

        function () {

            /*

             * ============================================

             * DATOS

             * ============================================

             */

            const operaciones =

                {!! $operacionesJson !!};

            const gastos =

                {!! $gastosJson !!};





            /*

             * ============================================

             * ELEMENTOS

             * ============================================

             */

            const tipoRegistro =

                document.getElementById(

                    'registro_tipo'

                );

            const inputBusqueda =

                document.getElementById(

                    'registro_busqueda'

                );

            const inputRegistro =

                document.getElementById(

                    'registro_id'

                );

            const resultados =

                document.getElementById(

                    'registros_resultados'

                );

            const labelBusqueda =

                document.getElementById(

                    'label_busqueda'

                );

            const registroSeleccionado =

                document.getElementById(

                    'registro_seleccionado'

                );

            const seleccionadoIcono =

                document.getElementById(

                    'seleccionado_icono'

                );

            const seleccionadoLabel =

                document.getElementById(

                    'seleccionado_label'

                );

            const seleccionadoTitulo =

                document.getElementById(

                    'seleccionado_titulo'

                );

            const seleccionadoSecundario =

                document.getElementById(

                    'seleccionado_secundario'

                );

            const sinRegistro =

                document.getElementById(

                    'sin_registro'

                );

            const archivo =

                document.getElementById(

                    'archivo'

                );

            const archivoInfo =

                document.getElementById(

                    'archivo_info'

                );

            const formulario =

                document.getElementById(

                    'documentForm'

                );





            /*

             * ============================================

             * DATOS ACTUALES

             * ============================================

             */

            let registrosActuales = [];





            /*

             * ============================================

             * ESCAPAR HTML

             * ============================================

             */

            function escapeHtml(value) {

                return String(value)

                    .replaceAll('&', '&amp;')

                    .replaceAll('<', '&lt;')

                    .replaceAll('>', '&gt;')

                    .replaceAll('"', '&quot;')

                    .replaceAll("'", '&#039;');

            }





            /*

             * ============================================

             * FORMATO DE GASTO

             * ============================================

             */

            function textoGasto(gasto) {

                let texto =

                    'Gasto #' +

                    gasto.id;





                if (gasto.descripcion) {

                    texto +=

                        ' — ' +

                        gasto.descripcion;

                }





                return texto;

            }





            /*

             * ============================================

             * ACTUALIZAR TIPO DE REGISTRO

             * ============================================

             */

            function actualizarTipoRegistro() {

                const tipo =

                    tipoRegistro.value;





                inputBusqueda.value = '';

                inputRegistro.value = '';

                resultados.innerHTML = '';

                resultados.classList.remove(

                    'visible'

                );

                registroSeleccionado.style.display =

                    'none';





                if (!tipo) {

                    inputBusqueda.disabled =

                        true;

                    inputBusqueda.placeholder =

                        'Primero selecciona el tipo de registro...';

                    labelBusqueda.textContent =

                        'Buscar registro';

                    sinRegistro.style.display =

                        'flex';

                    return;

                }





                inputBusqueda.disabled =

                    false;





                sinRegistro.style.display =

                    'none';





                if (tipo === 'operacion') {

                    registrosActuales =

                        operaciones;

                    labelBusqueda.textContent =

                        'Buscar operación';

                    inputBusqueda.placeholder =

                        'Buscar por número de operación o cliente...';

                    seleccionadoIcono.textContent =

                        'OP';

                }





                if (tipo === 'gasto') {

                    registrosActuales =

                        gastos;

                    labelBusqueda.textContent =

                        'Buscar gasto';

                    inputBusqueda.placeholder =

                        'Buscar por concepto, operación o transportista...';

                    seleccionadoIcono.textContent =

                        'GST';

                }

            }





            /*

             * ============================================

             * MOSTRAR RESULTADOS

             * ============================================

             */

            function mostrarResultados() {

                const busqueda =

                    inputBusqueda.value

                        .trim()

                        .toLowerCase();





                const filtrados =

                    registrosActuales

                        .filter(function (registro) {

                            if (

                                tipoRegistro.value ===

                                'operacion'

                            ) {

                                const numero =

                                    String(

                                        registro.numero || ''

                                    ).toLowerCase();

                                const cliente =

                                    String(

                                        registro.cliente || ''

                                    ).toLowerCase();





                                return (

                                    numero.includes(busqueda) ||

                                    cliente.includes(busqueda)

                                );

                            }





                            if (

                                tipoRegistro.value ===

                                'gasto'

                            ) {

                                const contenido = [

                                    registro.id,

                                    registro.fecha,

                                    registro.tipo,

                                    registro.descripcion,

                                    registro.operacion,

                                    registro.cliente,

                                    registro.transportista,

                                    registro.monto,

                                ]

                                    .join(' ')

                                    .toLowerCase();





                                return contenido.includes(

                                    busqueda

                                );

                            }





                            return false;

                        })

                        .slice(0, 15);





                resultados.innerHTML = '';





                if (!filtrados.length) {

                    resultados.innerHTML = `

                        <div class="no-results">

                            No se encontraron registros.

                        </div>

                    `;

                    resultados.classList.add(

                        'visible'

                    );

                    return;

                }





                filtrados.forEach(

                    function (registro) {

                        const item =

                            document.createElement(

                                'button'

                            );





                        item.type = 'button';

                        item.className =

                            'search-result-item';





                        if (

                            tipoRegistro.value ===

                            'operacion'

                        ) {

                            item.innerHTML = `

                                <span class="result-number">

                                    ${escapeHtml(

                                        registro.numero || ''

                                    )}

                                </span>

                                <span class="result-client">

                                    ${escapeHtml(

                                        registro.cliente ||

                                        'Sin cliente'

                                    )}

                                </span>

                            `;

                        }





                        if (

                            tipoRegistro.value ===

                            'gasto'

                        ) {

                            item.innerHTML = `

                                <span class="result-number">

                                    ${escapeHtml(

                                        textoGasto(registro)

                                    )}

                                </span>

                                <span class="result-client">

                                    ${escapeHtml(

                                        registro.tipo ||

                                        'Sin tipo'

                                    )}

                                    ${registro.fecha

                                        ? ' · ' +

                                          escapeHtml(

                                              registro.fecha

                                          )

                                        : ''

                                    }

                                    ${registro.monto

                                        ? ' · $' +

                                          escapeHtml(

                                              registro.monto

                                          )

                                        : ''

                                    }

                                </span>

                                ${

                                    registro.operacion ||

                                    registro.transportista

                                        ? `

                                            <span class="result-client">

                                                ${

                                                    registro.operacion

                                                        ? 'Operación: ' +

                                                          escapeHtml(

                                                              registro.operacion

                                                          )

                                                        : ''

                                                }

                                                ${

                                                    registro.transportista

                                                        ? ' · Transportista: ' +

                                                          escapeHtml(

                                                              registro.transportista

                                                          )

                                                        : ''

                                                }

                                            </span>

                                        `

                                        : ''

                                }

                            `;

                        }





                        item.addEventListener(

                            'click',

                            function () {

                                seleccionarRegistro(

                                    registro

                                );

                            }

                        );





                        resultados.appendChild(

                            item

                        );

                    }

                );





                resultados.classList.add(

                    'visible'

                );

            }





            /*

             * ============================================

             * SELECCIONAR REGISTRO

             * ============================================

             */

            function seleccionarRegistro(

                registro

            ) {

                inputRegistro.value =

                    registro.id;





                if (

                    tipoRegistro.value ===

                    'operacion'

                ) {

                    inputBusqueda.value =

                        registro.numero +

                        ' — ' +

                        (

                            registro.cliente ||

                            'Sin cliente'

                        );





                    seleccionadoLabel.textContent =

                        'OPERACIÓN SELECCIONADA';





                    seleccionadoTitulo.textContent =

                        '#' +

                        registro.numero;





                    seleccionadoSecundario.textContent =

                        registro.cliente ||

                        'Sin cliente';

                }





                if (

                    tipoRegistro.value ===

                    'gasto'

                ) {

                    inputBusqueda.value =

                        textoGasto(

                            registro

                        );





                    seleccionadoLabel.textContent =

                        'GASTO SELECCIONADO';





                    seleccionadoTitulo.textContent =

                        textoGasto(

                            registro

                        );





                    let secundario = '';





                    if (registro.fecha) {

                        secundario +=

                            registro.fecha;

                    }





                    if (registro.monto) {

                        secundario +=

                            (

                                secundario

                                    ? ' · '

                                    : ''

                            ) +

                            '$' +

                            registro.monto;

                    }





                    if (registro.operacion) {

                        secundario +=

                            (

                                secundario

                                    ? ' · '

                                    : ''

                            ) +

                            'Operación ' +

                            registro.operacion;

                    }





                    if (registro.transportista) {

                        secundario +=

                            (

                                secundario

                                    ? ' · '

                                    : ''

                            ) +

                            registro.transportista;

                    }





                    seleccionadoSecundario.textContent =

                        secundario ||

                        'Gasto sin información adicional';

                }





                registroSeleccionado.style.display =

                    'flex';





                resultados.classList.remove(

                    'visible'

                );

            }





            /*

             * ============================================

             * EVENTOS DEL BUSCADOR

             * ============================================

             */

            tipoRegistro.addEventListener(

                'change',

                function () {

                    actualizarTipoRegistro();

                }

            );





            inputBusqueda.addEventListener(

                'focus',

                function () {

                    if (

                        !inputBusqueda.disabled

                    ) {

                        mostrarResultados();

                    }

                }

            );





            inputBusqueda.addEventListener(

                'input',

                function () {

                    inputRegistro.value =

                        '';





                    registroSeleccionado.style.display =

                        'none';





                    mostrarResultados();

                }

            );





            document.addEventListener(

                'click',

                function (event) {

                    if (

                        !event.target.closest(

                            '.search-select'

                        )

                    ) {

                        resultados.classList.remove(

                            'visible'

                        );

                    }

                }

            );





            /*

             * ============================================

             * ARCHIVO

             * ============================================

             */

            archivo.addEventListener(

                'change',

                function () {

                    if (

                        !archivo.files.length

                    ) {

                        archivoInfo.style.display =

                            'none';

                        archivoInfo.textContent =

                            '';

                        return;

                    }





                    const archivoSeleccionado =

                        archivo.files[0];





                    const nombre =

                        archivoSeleccionado.name;





                    const tamanoMB =

                        (

                            archivoSeleccionado.size /

                            (1024 * 1024)

                        ).toFixed(2);





                    archivoInfo.textContent =

                        'Archivo seleccionado: ' +

                        nombre +

                        ' · ' +

                        tamanoMB +

                        ' MB';





                    archivoInfo.style.display =

                        'block';

                }

            );





            /*

             * ============================================

             * VALIDACIÓN

             * ============================================

             */

            formulario.addEventListener(

                'submit',

                function (evento) {

                    if (

                        !tipoRegistro.value

                    ) {

                        evento.preventDefault();

                        alert(

                            'Debes seleccionar el tipo de registro.'

                        );

                        tipoRegistro.focus();

                        return;

                    }





                    if (

                        !inputRegistro.value

                    ) {

                        evento.preventDefault();

                        alert(

                            'Debes seleccionar un registro.'

                        );

                        inputBusqueda.focus();

                        return;

                    }





                    if (

                        !archivo.files.length

                    ) {

                        evento.preventDefault();

                        alert(

                            'Debes seleccionar un archivo.'

                        );

                        archivo.focus();

                    }

                }

            );





            /*

             * ============================================

             * RECUPERAR DATOS DESPUÉS DE ERROR

             * ============================================

             */

            const tipoAnterior =

                tipoRegistro.value;

            const idAnterior =

                inputRegistro.value;





            if (

                tipoAnterior &&

                idAnterior

            ) {

                actualizarTipoRegistro();





                const registroAnterior =

                    registrosActuales.find(

                        function (registro) {

                            return String(

                                registro.id

                            ) === String(

                                idAnterior

                            );

                        }

                    );





                if (registroAnterior) {

                    seleccionarRegistro(

                        registroAnterior

                    );

                }

            }

        }

    );

</script>





<style>

    .page-header {

        display: flex;

        justify-content: space-between;

        align-items: flex-end;

        gap: 20px;

        margin-bottom: 24px;

    }





    .header-info {

        min-width: 0;

    }





    .page-kicker,

    .panel-kicker {

        display: block;

        color: #55718c;

        font-size: 10px;

        font-weight: 800;

        letter-spacing: .09em;

    }





    .page-header h1 {

        margin: 4px 0 4px;

        color: #172033;

        font-size: 25px;

        font-weight: 700;

        line-height: 1.2;

    }





    .page-header p {

        margin: 0;

        color: #64748b;

        font-size: 13px;

    }





    .main-grid {

        display: grid;

        grid-template-columns:

            minmax(300px, .82fr)

            minmax(0, 1.18fr);

        gap: 18px;

        align-items: start;

    }





    .panel {

        background: #ffffff;

        border: 1px solid #dfe6ed;

        border-radius: 9px;

        padding: 20px;

        box-shadow:

            0 2px 9px rgba(15, 23, 42, .035);

    }





    .panel-header {

        display: flex;

        align-items: center;

        padding-bottom: 13px;

        margin-bottom: 16px;

        border-bottom: 1px solid #e8edf2;

    }





    .panel-header h2 {

        margin: 3px 0 0;

        color: #172033;

        font-size: 16px;

        font-weight: 700;

    }





    .field {

        margin-bottom: 15px;

    }





    .field-last {

        margin-bottom: 0;

    }





    .field label {

        display: block;

        margin-bottom: 6px;

        color: #334155;

        font-size: 12px;

        font-weight: 700;

    }





    .required {

        color: #dc2626;

    }





    .form-control {

        width: 100%;

        box-sizing: border-box;

        border: 1px solid #d5dee7;

        border-radius: 7px;

        padding: 10px 11px;

        background: #ffffff;

        color: #273449;

        font-family: inherit;

        font-size: 13px;

        outline: none;

        transition:

            border-color .18s ease,

            box-shadow .18s ease;

    }





    .form-control::placeholder {

        color: #9aa8b7;

    }





    .form-control :focus {

        border-color: #4d82a7;

        box-shadow:

            0 0 0 3px rgba(21, 90, 145, .07);

    }





    .form-control :disabled {

        background: #f7f9fb;

        color: #9aa8b7;

        cursor: not-allowed;

    }





    .textarea {

        min-height: 76px;

        resize: vertical;

        line-height: 1.45;

    }





    .search-select {

        position: relative;

    }





    .input-wrapper {

        position: relative;

    }





    .input-wrapper .form-control {

        padding-right: 38px;

    }





    .search-icon {

        position: absolute;

        top: 50%;

        right: 12px;

        transform: translateY(-50%);

        color: #8293a4;

        font-size: 19px;

        pointer-events: none;

    }





    .search-results {

        display: none;

        position: absolute;

        z-index: 50;

        top: calc(100% + 5px);

        left: 0;

        right: 0;

        max-height: 250px;

        overflow-y: auto;

        background: #ffffff;

        border: 1px solid #d8e0e8;

        border-radius: 7px;

        box-shadow:

            0 8px 22px rgba(15, 23, 42, .12);

    }





    .search-results.visible {

        display: block;

    }





    .search-result-item {

        width: 100%;

        display: flex;

        flex-direction: column;

        gap: 3px;

        padding: 10px 12px;

        border: 0;

        border-bottom: 1px solid #edf1f4;

        background: #ffffff;

        text-align: left;

        cursor: pointer;

        font-family: inherit;

    }





    .search-result-item :last-child {

        border-bottom: 0;

    }





    .search-result-item :hover {

        background: #f5f8fb;

    }





    .result-number {

        color: #172033;

        font-size: 12px;

        font-weight: 700;

    }





    .result-client {

        color: #718096;

        font-size: 11px;

        line-height: 1.35;

    }





    .no-results {

        padding: 14px;

        color: #94a3b8;

        font-size: 12px;

        text-align: center;

    }





    .selected-operation {

        display: flex;

        align-items: center;

        gap: 12px;

        margin-top: 17px;

        padding: 12px;

        background: #f5f8fb;

        border: 1px solid #e2e9ef;

        border-radius: 7px;

    }





    .selected-icon {

        width: 38px;

        height: 38px;

        flex: 0 0 38px;

        display: flex;

        align-items: center;

        justify-content: center;

        border-radius: 7px;

        background: #e5eef5;

        color: #155a91;

        font-size: 8px;

        font-weight: 800;

        letter-spacing: .04em;

    }





    .selected-info {

        display: flex;

        flex-direction: column;

        gap: 2px;

        min-width: 0;

    }





    .selected-label {

        color: #91a1b1;

        font-size: 8px;

        font-weight: 800;

        letter-spacing: .07em;

    }





    .selected-info strong {

        color: #1f3045;

        font-size: 13px;

        word-break: break-word;

    }





    .selected-client {

        color: #718096;

        font-size: 11px;

        line-height: 1.4;

    }





    .no-operation {

        display: flex;

        align-items: center;

        gap: 10px;

        margin-top: 17px;

        padding: 11px;

        background: #fafbfc;

        border: 1px solid #e5eaf0;

        border-radius: 7px;

    }





    .no-operation-icon {

        width: 30px;

        height: 30px;

        flex: 0 0 30px;

        display: flex;

        align-items: center;

        justify-content: center;

        border-radius: 50%;

        background: #fff4e8;

        color: #c26a20;

        font-size: 11px;

        font-weight: 800;

    }





    .no-operation div {

        display: flex;

        flex-direction: column;

        gap: 2px;

    }





    .no-operation strong {

        color: #475569;

        font-size: 12px;

    }





    .no-operation span :not(.no-operation-icon) {

        color: #94a3b8;

        font-size: 10px;

        line-height: 1.4;

    }





    .field-error {

        margin-top: 5px;

        color: #dc2626;

        font-size: 11px;

    }





    .file-panel {

        margin-top: 18px;

    }





    .file-upload-area {

        padding: 15px;

        border: 1px dashed #cbd5e1;

        border-radius: 8px;

        background: #fafbfc;

    }





    .file-upload-label {

        display: flex;

        align-items: center;

        gap: 13px;

        cursor: pointer;

    }





    .file-upload-icon {

        width: 42px;

        height: 42px;

        flex: 0 0 42px;

        display: flex;

        align-items: center;

        justify-content: center;

        border-radius: 8px;

        background: #e8f1f8;

        color: #155a91;

        font-size: 9px;

        font-weight: 800;

        letter-spacing: .04em;

    }





    .file-upload-content {

        display: flex;

        flex-direction: column;

        gap: 3px;

    }





    .file-upload-content strong {

        color: #273449;

        font-size: 12px;

    }





    .file-upload-content small {

        color: #94a3b8;

        font-size: 10px;

        line-height: 1.4;

    }





    .file-input {

        display: block;

        width: 100%;

        margin-top: 13px;

        box-sizing: border-box;

        padding: 8px;

        border: 1px solid #d5dee7;

        border-radius: 6px;

        background: #ffffff;

        color: #475569;

        font-family: inherit;

        font-size: 11px;

    }





    .archivo-info {

        display: none;

        margin-top: 8px;

        padding: 9px 11px;

        border-radius: 6px;

        background: #f1f6fa;

        border: 1px solid #dce8f0;

        color: #55718c;

        font-size: 10px;

        word-break: break-word;

    }





    .alert {

        margin-bottom: 18px;

        padding: 12px 14px;

        border-radius: 7px;

        font-size: 12px;

    }





    .alert-error {

        background: #fef2f2;

        border: 1px solid #fecaca;

        color: #991b1b;

    }





    .alert-title {

        margin-bottom: 4px;

        font-weight: 700;

    }





    .alert ul {

        margin: 4px 0 0;

        padding-left: 17px;

    }





    .form-actions {

        display: flex;

        justify-content: flex-end;

        gap: 9px;

        margin-top: 17px;

    }





    .btn {

        display: inline-flex;

        align-items: center;

        justify-content: center;

        gap: 6px;

        min-height: 39px;

        padding: 0 15px;

        border-radius: 7px;

        border: 1px solid transparent;

        font-family: inherit;

        font-size: 12px;

        font-weight: 700;

        text-decoration: none;

        cursor: pointer;

        transition: .18s ease;

    }





    .btn-icon {

        font-size: 14px;

        line-height: 1;

    }





    .btn-primary {

        background: #155a91;

        color: #ffffff;

    }





    .btn-primary :hover {

        background: #104b79;

    }





    .btn-secondary {

        background: #ffffff;

        border-color: #d7e0e8;

        color: #334155;

    }





    .btn-secondary :hover {

        background: #f5f7f9;

        border-color: #cbd5df;

    }





    @media (max-width: 850px) {

        .main-grid {

            grid-template-columns: 1fr;

        }

    }





    @media (max-width: 600px) {

        .page-header {

            align-items: flex-start;

            flex-direction: column;

        }





        .page-header > .btn {

            width: 100%;

        }





        .panel {

            padding: 17px;

        }





        .form-actions {

            flex-direction: column-reverse;

        }





        .form-actions .btn {

            width: 100%;

        }

    }

</style>

@endsection