<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Subir documento - Sistema de Gestión</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f4f6f8;
            color: #1f2937;
        }

        .contenedor {
            max-width: 1000px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .encabezado {
            margin-bottom: 25px;
        }

        .titulo {
            margin: 0;
            font-size: 30px;
        }

        .subtitulo {
            margin: 8px 0 0;
            color: #6b7280;
        }

        .tarjeta {
            background-color: white;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        }

        .formulario {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .campo {
            display: flex;
            flex-direction: column;
        }

        .campo-completo {
            grid-column: 1 / -1;
        }

        label {
            margin-bottom: 7px;
            font-size: 14px;
            font-weight: bold;
            color: #374151;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 11px 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 14px;
            font-family: Arial, Helvetica, sans-serif;
            background-color: white;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #2563eb;
        }

        textarea {
            min-height: 110px;
            resize: vertical;
        }

        .requerido {
            color: #dc2626;
        }

        .ayuda {
            margin-top: 6px;
            color: #6b7280;
            font-size: 12px;
        }

        .error {
            margin-top: 6px;
            color: #dc2626;
            font-size: 13px;
        }

        .resumen-errores {
            margin-bottom: 25px;
            padding: 15px 18px;
            border-radius: 6px;
            background-color: #fee2e2;
            border: 1px solid #fecaca;
            color: #991b1b;
        }

        .resumen-errores strong {
            display: block;
            margin-bottom: 8px;
        }

        .resumen-errores ul {
            margin: 0;
            padding-left: 20px;
        }

        .informacion {
            margin-bottom: 25px;
            padding: 15px 18px;
            border-radius: 6px;
            background-color: #eff6ff;
            border: 1px solid #dbeafe;
            color: #1e40af;
        }

        .informacion strong {
            display: block;
            margin-bottom: 5px;
        }

        .acciones {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
        }

        .boton {
            display: inline-block;
            padding: 11px 18px;
            border-radius: 6px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .boton-principal {
            background-color: #2563eb;
            color: white;
        }

        .boton-principal:hover {
            background-color: #1d4ed8;
        }

        .boton-secundario {
            background-color: #e5e7eb;
            color: #374151;
        }

        .boton-secundario:hover {
            background-color: #d1d5db;
        }

        /* BUSCADOR DE OPERACIONES */

        .buscador-operacion {
            position: relative;
        }

        .buscador-operacion input {
            padding-right: 40px;
        }

        .icono-busqueda {
            position: absolute;
            right: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: #6b7280;
            pointer-events: none;
            font-size: 17px;
        }

        .resultados-operaciones {
            position: absolute;
            z-index: 1000;
            top: calc(100% + 5px);
            left: 0;
            right: 0;
            background-color: white;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.10);
            max-height: 260px;
            overflow-y: auto;
            display: none;
        }

        .resultado-operacion {
            width: 100%;
            padding: 13px 15px;
            border: none;
            border-bottom: 1px solid #f0f0f0;
            background-color: white;
            text-align: left;
            cursor: pointer;
            font-family: Arial, Helvetica, sans-serif;
        }

        .resultado-operacion:last-child {
            border-bottom: none;
        }

        .resultado-operacion:hover {
            background-color: #f3f6fb;
        }

        .resultado-numero {
            display: block;
            font-size: 14px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 4px;
        }

        .resultado-cliente {
            display: block;
            font-size: 13px;
            color: #6b7280;
        }

        .sin-resultados {
            padding: 14px 15px;
            color: #6b7280;
            font-size: 13px;
        }

        .operacion-seleccionada {
            display: none;
            margin-top: 8px;
            padding: 10px 12px;
            border-radius: 6px;
            background-color: #eff6ff;
            border: 1px solid #bfdbfe;
            color: #1e40af;
            font-size: 13px;
        }

        .operacion-seleccionada strong {
            color: #1e3a8a;
        }

        /* ARCHIVO */

        .archivo-info {
            margin-top: 8px;
            padding: 10px 12px;
            border-radius: 6px;
            background-color: #f9fafb;
            border: 1px solid #e5e7eb;
            color: #4b5563;
            font-size: 13px;
            display: none;
        }

        @media (max-width: 700px) {

            .formulario {
                grid-template-columns: 1fr;
            }

            .campo-completo {
                grid-column: auto;
            }

            .tarjeta {
                padding: 20px;
            }

            .acciones {
                flex-direction: column-reverse;
            }

            .acciones .boton {
                width: 100%;
                text-align: center;
            }

        }

    </style>

</head>

<body>

<div class="contenedor">

    <div class="encabezado">

        <h1 class="titulo">
            Subir documento
        </h1>

        <p class="subtitulo">
            Registra un documento y asócialo directamente a una operación.
        </p>

    </div>


    <div class="tarjeta">

        <div class="informacion">

            <strong>
                Documentos asociados
            </strong>

            <span>
                Cada documento debe quedar relacionado con una operación.
                De esta forma podremos acceder a él desde la información
                de la operación correspondiente.
            </span>

        </div>


        @if ($errors->any())

            <div class="resumen-errores">

                <strong>
                    Se encontraron los siguientes errores:
                </strong>

                <ul>

                    @foreach ($errors->all() as $error)

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
        >

            @csrf


            <div class="formulario">


                {{-- OPERACIÓN --}}

                <div class="campo campo-completo">

                    <label for="busqueda_operacion">

                        Operación
                        <span class="requerido">*</span>

                    </label>


                    <div class="buscador-operacion">

                        <input
                            type="text"
                            id="busqueda_operacion"
                            placeholder="Buscar por número de operación o cliente..."
                            autocomplete="off"
                            value=""
                        >


                        <span class="icono-busqueda">
                            🔍
                        </span>


                        <div
                            id="resultados_operaciones"
                            class="resultados-operaciones"
                        >

                            @foreach ($operaciones as $operacion)

                                <button
                                    type="button"
                                    class="resultado-operacion"
                                    data-id="{{ $operacion->id }}"
                                    data-numero="{{ $operacion->numero_operacion }}"
                                    data-cliente="{{ $operacion->cliente->razon_social }}"
                                >

                                    <span class="resultado-numero">
                                        {{ $operacion->numero_operacion }}
                                    </span>

                                    <span class="resultado-cliente">

                                        {{ $operacion->cliente->razon_social }}

                                        @if ($operacion->fecha_curse)

                                            · Curse:
                                            {{ $operacion->fecha_curse->format('d/m/Y') }}

                                        @endif

                                    </span>

                                </button>

                            @endforeach

                        </div>

                    </div>


                    <input
                        type="hidden"
                        id="operacion_id"
                        name="operacion_id"
                        value="{{ old('operacion_id') }}"
                        required
                    >


                    <div
                        id="operacion_seleccionada"
                        class="operacion-seleccionada"
                    >

                        <strong>
                            Operación seleccionada:
                        </strong>

                        <span id="texto_operacion_seleccionada"></span>

                    </div>


                    <div class="ayuda">
                        Busca por número de operación o por nombre del cliente.
                    </div>


                    @error('operacion_id')

                        <div class="error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- ARCHIVO --}}

                <div class="campo campo-completo">

                    <label for="archivo">

                        Archivo
                        <span class="requerido">*</span>

                    </label>

                    <input
                        type="file"
                        id="archivo"
                        name="archivo"
                        required
                    >


                    <div
                        id="archivo_info"
                        class="archivo-info"
                    ></div>


                    <div class="ayuda">
                        Tamaño máximo: 10 MB.
                    </div>


                    @error('archivo')

                        <div class="error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- TIPO --}}

                <div class="campo">

                    <label for="tipo">
                        Tipo de documento
                    </label>

                    <select
                        id="tipo"
                        name="tipo"
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

                        <div class="error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- DESCRIPCIÓN --}}

                <div class="campo">

                    <label for="descripcion">
                        Descripción
                    </label>

                    <input
                        type="text"
                        id="descripcion"
                        name="descripcion"
                        value="{{ old('descripcion') }}"
                        maxlength="255"
                        placeholder="Descripción breve"
                    >

                    @error('descripcion')

                        <div class="error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- OBSERVACIONES --}}

                <div class="campo campo-completo">

                    <label for="observaciones">
                        Observaciones
                    </label>

                    <textarea
                        id="observaciones"
                        name="observaciones"
                        placeholder="Observaciones adicionales..."
                    >{{ old('observaciones') }}</textarea>

                    @error('observaciones')

                        <div class="error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>

            </div>


            <div class="acciones">

                <a
                    href="{{ route('documentos.index') }}"
                    class="boton boton-secundario"
                >
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="boton boton-principal"
                >
                    Subir documento
                </button>

            </div>

        </form>

    </div>

</div>


<script>

    document.addEventListener('DOMContentLoaded', function () {

        const buscador =
            document.getElementById('busqueda_operacion');

        const resultados =
            document.getElementById('resultados_operaciones');

        const operacionId =
            document.getElementById('operacion_id');

        const operacionSeleccionada =
            document.getElementById('operacion_seleccionada');

        const textoSeleccionada =
            document.getElementById('texto_operacion_seleccionada');

        const opciones =
            document.querySelectorAll('.resultado-operacion');

        const archivo =
            document.getElementById('archivo');

        const archivoInfo =
            document.getElementById('archivo_info');


        /*
         * ============================
         * BUSCADOR DE OPERACIONES
         * ============================
         */

        function mostrarResultados() {

            const texto =
                buscador.value.toLowerCase().trim();

            let cantidad = 0;


            opciones.forEach(function (opcion) {

                const numero =
                    opcion.dataset.numero.toLowerCase();

                const cliente =
                    opcion.dataset.cliente.toLowerCase();


                const coincide =
                    numero.includes(texto) ||
                    cliente.includes(texto);


                if (coincide) {

                    opcion.style.display =
                        'block';

                    cantidad++;

                } else {

                    opcion.style.display =
                        'none';

                }

            });


            let sinResultados =
                resultados.querySelector('.sin-resultados');


            if (sinResultados) {
                sinResultados.remove();
            }


            if (cantidad === 0) {

                sinResultados =
                    document.createElement('div');

                sinResultados.className =
                    'sin-resultados';

                sinResultados.textContent =
                    'No se encontraron operaciones.';

                resultados.appendChild(
                    sinResultados
                );

            }


            resultados.style.display =
                'block';

        }


        buscador.addEventListener(
            'focus',
            function () {

                mostrarResultados();

            }
        );


        buscador.addEventListener(
            'input',
            function () {

                operacionId.value = '';

                operacionSeleccionada.style.display =
                    'none';

                mostrarResultados();

            }
        );


        opciones.forEach(function (opcion) {

            opcion.addEventListener(
                'click',
                function () {

                    const id =
                        opcion.dataset.id;

                    const numero =
                        opcion.dataset.numero;

                    const cliente =
                        opcion.dataset.cliente;


                    operacionId.value =
                        id;

                    buscador.value =
                        numero + ' - ' + cliente;

                    textoSeleccionada.textContent =
                        numero + ' - ' + cliente;

                    operacionSeleccionada.style.display =
                        'block';

                    resultados.style.display =
                        'none';

                }
            );

        });


        document.addEventListener(
            'click',
            function (evento) {

                if (
                    !buscador.contains(evento.target) &&
                    !resultados.contains(evento.target)
                ) {

                    resultados.style.display =
                        'none';

                }

            }
        );


        /*
         * ============================
         * INFORMACIÓN DEL ARCHIVO
         * ============================
         */

        archivo.addEventListener(
            'change',
            function () {

                if (!archivo.files.length) {

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
         * ============================
         * VALIDACIÓN DEL FORMULARIO
         * ============================
         */

        const formulario =
            document.querySelector('form');


        formulario.addEventListener(
            'submit',
            function (evento) {

                if (!operacionId.value) {

                    evento.preventDefault();

                    alert(
                        'Debes seleccionar una operación.'
                    );

                    buscador.focus();

                    return;

                }


                if (!archivo.files.length) {

                    evento.preventDefault();

                    alert(
                        'Debes seleccionar un archivo.'
                    );

                    archivo.focus();

                }

            }
        );


        /*
         * ============================
         * RECUPERAR DATOS DESPUÉS
         * DE UNA VALIDACIÓN FALLIDA
         * ============================
         */

        const valorAnterior =
            operacionId.value;


        if (valorAnterior) {

            const opcionAnterior =
                document.querySelector(
                    '.resultado-operacion[data-id="' +
                    valorAnterior +
                    '"]'
                );


            if (opcionAnterior) {

                const numero =
                    opcionAnterior.dataset.numero;

                const cliente =
                    opcionAnterior.dataset.cliente;


                buscador.value =
                    numero + ' - ' + cliente;

                textoSeleccionada.textContent =
                    numero + ' - ' + cliente;

                operacionSeleccionada.style.display =
                    'block';

            }

        }

    });

</script>

</body>

</html>