@extends('emails.layout')

@section('contenido')

    <div
        style="
            margin-bottom: 8px;
            color: #155a91;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
        "
    >
        Gestión de personal
    </div>

    <h1
        style="
            margin: 0 0 14px;
            color: #172033;
            font-size: 25px;
            line-height: 1.25;
            font-weight: 700;
        "
    >
        Ausencia {{ $accion }}
    </h1>

    <p
        style="
            margin: 0 0 22px;
            color: #475467;
            font-size: 14px;
            line-height: 1.7;
        "
    >
        Hola <strong>{{ $trabajador->nombre }}</strong>,
    </p>

    <p
        style="
            margin: 0 0 24px;
            color: #475467;
            font-size: 13px;
            line-height: 1.7;
        "
    >
        Se ha {{ $accionMensaje }} una ausencia asociada
        a tu registro en el Sistema de Gestión.
    </p>


    <div
        style="
            margin: 26px 0;
            border: 1px solid #e2e8f0;
            border-radius: 9px;
            overflow: hidden;
        "
    >

        <div
            style="
                padding: 13px 18px;
                background: #f7f9fc;
                border-bottom: 1px solid #e2e8f0;
                color: #344054;
                font-size: 12px;
                font-weight: 700;
            "
        >
            Detalle de la ausencia
        </div>

        <table
            role="presentation"
            width="100%"
            cellspacing="0"
            cellpadding="0"
            border="0"
            style="
                width: 100%;
                border-collapse: collapse;
            "
        >

            <tr>
                <td
                    style="
                        width: 38%;
                        padding: 12px 18px;
                        border-bottom: 1px solid #edf1f5;
                        color: #667085;
                        font-size: 11px;
                    "
                >
                    Fecha de inicio
                </td>

                <td
                    style="
                        padding: 12px 18px;
                        border-bottom: 1px solid #edf1f5;
                        color: #172033;
                        font-size: 12px;
                        font-weight: 600;
                    "
                >
                    {{ $fechaInicio }}
                </td>
            </tr>

            <tr>
                <td
                    style="
                        padding: 12px 18px;
                        border-bottom: 1px solid #edf1f5;
                        color: #667085;
                        font-size: 11px;
                    "
                >
                    Fecha de término
                </td>

                <td
                    style="
                        padding: 12px 18px;
                        border-bottom: 1px solid #edf1f5;
                        color: #172033;
                        font-size: 12px;
                        font-weight: 600;
                    "
                >
                    {{ $fechaTermino }}
                </td>
            </tr>

            <tr>
                <td
                    style="
                        padding: 12px 18px;
                        border-bottom: 1px solid #edf1f5;
                        color: #667085;
                        font-size: 11px;
                    "
                >
                    Días
                </td>

                <td
                    style="
                        padding: 12px 18px;
                        border-bottom: 1px solid #edf1f5;
                        color: #172033;
                        font-size: 12px;
                        font-weight: 600;
                    "
                >
                    {{ $ausencia->dias }}
                </td>
            </tr>

            <tr>
                <td
                    style="
                        padding: 12px 18px;
                        color: #667085;
                        font-size: 11px;
                    "
                >
                    Estado
                </td>

                <td
                    style="
                        padding: 12px 18px;
                        color: #172033;
                        font-size: 12px;
                        font-weight: 700;
                    "
                >
                    {{ $estado }}
                </td>
            </tr>

        </table>

    </div>


    @if($ausencia->tipo)

        <div
            style="
                margin-bottom: 16px;
            "
        >
            <div
                style="
                    margin-bottom: 5px;
                    color: #667085;
                    font-size: 10px;
                    font-weight: 700;
                    text-transform: uppercase;
                "
            >
                Tipo
            </div>

            <div
                style="
                    color: #344054;
                    font-size: 12px;
                    line-height: 1.6;
                "
            >
                {{ $ausencia->tipo }}
            </div>
        </div>

    @endif


    @if($ausencia->justificacion)

        <div
            style="
                margin-bottom: 16px;
                padding: 15px 17px;
                background: #f7f9fc;
                border-left: 3px solid #155a91;
                border-radius: 5px;
            "
        >
            <div
                style="
                    margin-bottom: 5px;
                    color: #667085;
                    font-size: 10px;
                    font-weight: 700;
                    text-transform: uppercase;
                "
            >
                Justificación
            </div>

            <div
                style="
                    color: #344054;
                    font-size: 12px;
                    line-height: 1.6;
                "
            >
                {{ $ausencia->justificacion }}
            </div>
        </div>

    @endif


    @if($ausencia->observaciones)

        <div
            style="
                margin-bottom: 16px;
                padding: 15px 17px;
                background: #f7f9fc;
                border-left: 3px solid #14a0a5;
                border-radius: 5px;
            "
        >
            <div
                style="
                    margin-bottom: 5px;
                    color: #667085;
                    font-size: 10px;
                    font-weight: 700;
                    text-transform: uppercase;
                "
            >
                Observaciones
            </div>

            <div
                style="
                    color: #344054;
                    font-size: 12px;
                    line-height: 1.6;
                "
            >
                {{ $ausencia->observaciones }}
            </div>
        </div>

    @endif


    <p
        style="
            margin: 26px 0 0;
            color: #475467;
            font-size: 12px;
            line-height: 1.6;
        "
    >
        Saludos,<br>

        <strong style="color: #172033;">
            Sistema de Gestión
        </strong><br>

        <span
            style="
                color: #667085;
                font-size: 11px;
            "
        >
            Inversiones Sur Limitada
        </span>
    </p>

@endsection