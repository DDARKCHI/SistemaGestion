<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        {{ $entrega->numero_entrega }} - Sistema de Gestión
    </title>

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
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 20px;
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

        .acciones {
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

        .tarjeta {
            background-color: white;
            border-radius: 8px;
            padding: 30px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        }

        .tarjeta h2 {
            margin-top: 0;
            margin-bottom: 25px;
            font-size: 20px;
        }

        .datos {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .dato {
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 12px;
        }

        .dato-completo {
            grid-column: 1 / -1;
        }

        .etiqueta {
            display: block;
            margin-bottom: 6px;
            font-size: 12px;
            font-weight: bold;
            color: #6b7280;
            text-transform: uppercase;
        }

        .valor {
            font-size: 15px;
            color: #1f2937;
        }

        .vacio {
            color: #9ca3af;
        }

        .estado {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 999px;
            background-color: #f3f4f6;
            color: #374151;
            font-size: 12px;
            text-transform: capitalize;
        }

        .enlace {
            color: #2563eb;
            text-decoration: none;
            font-weight: bold;
        }

        .enlace:hover {
            text-decoration: underline;
        }

        .relacion {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .relacion-item {
            padding: 20px;
            background-color: #f9fafb;
            border-radius: 6px;
            border: 1px solid #e5e7eb;
        }

        .relacion-titulo {
            display: block;
            margin-bottom: 8px;
            font-size: 12px;
            font-weight: bold;
            color: #6b7280;
            text-transform: uppercase;
        }

        .relacion-valor {
            font-size: 15px;
        }

        @media (max-width: 700px) {
            .encabezado {
                flex-direction: column;
            }

            .datos,
            .relacion {
                grid-template-columns: 1fr;
            }

            .dato-completo {
                grid-column: auto;
            }

            .acciones {
                width: 100%;
            }

            .acciones .boton {
                flex: 1;
                text-align: center;
            }
        }
    </style>
</head>

<body>

<div class="contenedor">

    <div class="encabezado">

        <div>

            <h1 class="titulo">
                {{ $entrega->numero_entrega }}
            </h1>

            <p class="subtitulo">
                Detalle de la entrega
            </p>

        </div>

        <div class="acciones">

            <a
                href="{{ route('entregas.index') }}"
                class="boton boton-secundario"
            >
                Volver
            </a>

            <a
                href="{{ route('entregas.edit', $entrega) }}"
                class="boton boton-principal"
            >
                Editar entrega
            </a>

        </div>

    </div>

    <div class="tarjeta">

        <h2>Información de la entrega</h2>

        <div class="datos">

            <div class="dato">

                <span class="etiqueta">
                    Número de entrega
                </span>

                <span class="valor">
                    {{ $entrega->numero_entrega }}
                </span>

            </div>

            <div class="dato">

                <span class="etiqueta">
                    Estado
                </span>

                <span class="estado">
                    {{ $entrega->estado }}
                </span>

            </div>

            <div class="dato">

                <span class="etiqueta">
                    Fecha de entrega
                </span>

                <span class="valor">

                    @if ($entrega->fecha_entrega)
                        {{ $entrega->fecha_entrega->format('d/m/Y') }}
                    @else
                        <span class="vacio">
                            No registrada
                        </span>
                    @endif

                </span>

            </div>

        </div>

    </div>

    <div class="tarjeta">

        <h2>Operación asociada</h2>

        <div class="relacion">

            <div class="relacion-item">

                <span class="relacion-titulo">
                    Operación
                </span>

                <a
                    href="{{ route('operaciones.show', $entrega->operacion) }}"
                    class="enlace"
                >
                    {{ $entrega->operacion->numero_operacion }}
                </a>

            </div>

            <div class="relacion-item">

                <span class="relacion-titulo">
                    Cliente
                </span>

                <span class="relacion-valor">

                    {{ $entrega->operacion->cliente->razon_social }}

                </span>

            </div>

        </div>

    </div>

    <div class="tarjeta">

        <h2>Descripción y observaciones</h2>

        <div class="datos">

            <div class="dato dato-completo">

                <span class="etiqueta">
                    Descripción
                </span>

                <span class="valor">

                    @if ($entrega->descripcion)
                        {{ $entrega->descripcion }}
                    @else
                        <span class="vacio">
                            Sin descripción
                        </span>
                    @endif

                </span>

            </div>

            <div class="dato dato-completo">

                <span class="etiqueta">
                    Observaciones
                </span>

                <span class="valor">

                    @if ($entrega->observaciones)
                        {{ $entrega->observaciones }}
                    @else
                        <span class="vacio">
                            Sin observaciones
                        </span>
                    @endif

                </span>

            </div>

        </div>

    </div>

</div>

</body>
</html>