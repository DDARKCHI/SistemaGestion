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
        Seguridad de cuenta
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
        Restablecer contraseña
    </h1>


    <p
        style="
            margin: 0 0 22px;
            color: #475467;
            font-size: 14px;
            line-height: 1.7;
        "
    >
        Hola <strong>{{ $nombre }}</strong>,
    </p>


    <p
        style="
            margin: 0 0 24px;
            color: #475467;
            font-size: 13px;
            line-height: 1.7;
        "
    >
        Recibimos una solicitud para restablecer la contraseña
        asociada a tu cuenta en el Sistema de Gestión.
    </p>


    {{-- BOTÓN --}}

    <table
        role="presentation"
        cellspacing="0"
        cellpadding="0"
        border="0"
        width="100%"
        style="
            margin: 28px 0;
        "
    >
        <tr>
            <td align="center">

                <a
                    href="{{ $url }}"
                    style="
                        display: inline-block;
                        padding: 14px 28px;
                        background: #155a91;
                        border-radius: 7px;
                        color: #ffffff;
                        font-size: 13px;
                        font-weight: 700;
                        text-decoration: none;
                    "
                >
                    Restablecer contraseña
                </a>

            </td>
        </tr>
    </table>


    {{-- INFORMACIÓN --}}

    <div
        style="
            margin: 25px 0;
            padding: 16px 18px;
            background: #f5f8fb;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
        "
    >

        <div
            style="
                color: #344054;
                font-size: 12px;
                font-weight: 700;
                margin-bottom: 6px;
            "
        >
            Información de seguridad
        </div>

        <div
            style="
                color: #667085;
                font-size: 11px;
                line-height: 1.6;
            "
        >
            Este enlace estará disponible durante
            <strong>{{ $expire }} minutos</strong>.
        </div>

    </div>


    <p
        style="
            margin: 0 0 15px;
            color: #667085;
            font-size: 12px;
            line-height: 1.7;
        "
    >
        Si no solicitaste este cambio, puedes ignorar este correo.
        Tu contraseña actual seguirá funcionando normalmente.
    </p>


    <p
        style="
            margin: 25px 0 0;
            color: #475467;
            font-size: 12px;
            line-height: 1.6;
        "
    >
        Saludos,<br>

        <strong style="color: #172033;">
            Sistema de Gestión
        </strong>
    </p>

@endsection