<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Entregas - Sistema de Gestión</title>

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
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .encabezado {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .titulo {
            margin: 0;
            font-size: 30px;
        }

        .subtitulo {
            margin: 8px 0 0;
            color: #6b7280;
        }

        .botones {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
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

        .boton-ver {
            background-color: #e5e7eb;
            color: #1f2937;
        }

        .boton-editar {
            background-color: #f3f4f6;
            color: #374151;
        }

        .boton-eliminar {
            background-color: #fee2e2;
            color: #b91c1c;
        }

        .mensaje {
            padding: 14px 18px;
            margin-bottom: 20px;
            border-radius: 6px;
            background-color: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .tabla-contenedor {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background-color: #f9fafb;
        }

        th,
        td {
            padding: 15px 18px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        th {
            font-size: 13px;
            color: #6b7280;
            text-transform: uppercase;
        }

        td {
            font-size: 14px;
        }

        .numero-entrega {
            font-weight: bold;
        }

        .estado {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 999px;
            background-color: #f3f4f6;
            color: #374151;
            font-size: 12px;
            text-transform: capitalize;
        }

        .operacion {
            color: #2563eb;
            text-decoration: none;
            font-weight: bold;
        }

        .operacion:hover {
            text-decoration: underline;
        }

        .acciones {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .acciones form {
            margin: 0;
        }

        .sin-entregas {
            padding: 50px 20px;
            text-align: center;
            color: #6b7280;
        }

        .sin-entregas h3 {
            color: #374151;
        }

        .fecha {
            white-space: nowrap;
        }

        @media (max-width: 900px) {
            .encabezado {
                flex-direction: column;
                align-items: flex-start;
                gap: 20px;
            }

            .tabla-contenedor {
                overflow-x: auto;
            }

            table {
                min-width: 1000px;
            }
        }
    </style>
</head>

<body>

<div class="contenedor">

    <div class="encabezado">

        <div>
            <h1 class="titulo">
                Entregas
            </h1>

            <p class="subtitulo">
                Gestión de entregas asociadas a las operaciones
            </p>
        </div>

        <div class="botones">

            <a
                href="{{ route('operaciones.index') }}"
                class="boton boton-secundario"
            >
                Operaciones
            </a>

            <a
                href="{{ route('entregas.create') }}"
                class="boton boton-principal"
            >
                + Nueva entrega
            </a>

        </div>

    </div>

    @if (session('success'))
        <div class="mensaje">
            {{ session('success') }}
        </div>
    @endif

    <div class="tabla-contenedor">

        @if ($entregas->count() > 0)

            <table>

                <thead>
                    <tr>
                        <th>N.º entrega</th>
                        <th>Operación</th>
                        <th>Cliente</th>
                        <th>Fecha entrega</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($entregas as $entrega)

                        <tr>

                            <td>
                                <span class="numero-entrega">
                                    {{ $entrega->numero_entrega }}
                                </span>
                            </td>

                            <td>

                                <a
                                    href="{{ route('operaciones.show', $entrega->operacion) }}"
                                    class="operacion"
                                >
                                    {{ $entrega->operacion->numero_operacion }}
                                </a>

                            </td>

                            <td>
                                {{ $entrega->operacion->cliente->razon_social }}
                            </td>

                            <td class="fecha">

                                @if ($entrega->fecha_entrega)
                                    {{ $entrega->fecha_entrega->format('d/m/Y') }}
                                @else
                                    -
                                @endif

                            </td>

                            <td>
                                <span class="estado">
                                    {{ $entrega->estado }}
                                </span>
                            </td>

                            <td>

                                <div class="acciones">

                                    <a
                                        href="{{ route('entregas.show', $entrega) }}"
                                        class="boton boton-ver"
                                    >
                                        Ver
                                    </a>

                                    <a
                                        href="{{ route('entregas.edit', $entrega) }}"
                                        class="boton boton-editar"
                                    >
                                        Editar
                                    </a>

                                    <form
                                        action="{{ route('entregas.destroy', $entrega) }}"
                                        method="POST"
                                        onsubmit="return confirm('¿Está seguro de eliminar esta entrega?');"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="boton boton-eliminar"
                                        >
                                            Eliminar
                                        </button>
                                    </form>

                                </div>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        @else

            <div class="sin-entregas">

                <h3>
                    No hay entregas registradas
                </h3>

                <p>
                    Comienza registrando la primera entrega.
                </p>

                <a
                    href="{{ route('entregas.create') }}"
                    class="boton boton-principal"
                >
                    Registrar entrega
                </a>

            </div>

        @endif

    </div>

</div>

</body>
</html>