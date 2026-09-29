<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>{{ $titulo ?? 'Sistema de Gestión' }}</title>
</head>

<body
    style="
        margin: 0;
        padding: 0;
        background: #f4f7fa;
        font-family: Arial, Helvetica, sans-serif;
        color: #344054;
    "
>

    <table
        role="presentation"
        width="100%"
        cellspacing="0"
        cellpadding="0"
        border="0"
        style="
            width: 100%;
            background: #f4f7fa;
            padding: 36px 16px;
        "
    >
        <tr>
            <td align="center">

                <table
                    role="presentation"
                    width="100%"
                    cellspacing="0"
                    cellpadding="0"
                    border="0"
                    style="
                        width: 100%;
                        max-width: 620px;
                        margin: 0 auto;
                    "
                >

                    {{-- ============================================
                         ENCABEZADO
                    ============================================= --}}

                    <tr>
                        <td
                            style="
                                background: #0c3158;
                                border-radius: 14px 14px 0 0;
                                padding: 30px 36px;
                                text-align: center;
                            "
                        >

                            <table
                                role="presentation"
                                cellspacing="0"
                                cellpadding="0"
                                border="0"
                                align="center"
                            >
                                <tr>

                                    <td
                                        style="
                                            padding: 10px 18px;
                                            background: #ffffff;
                                            border-radius: 10px;
                                            text-align: center;
                                            vertical-align: middle;
                                        "
                                    >

                                        <img
                                            src="{{ asset('images/logo-inversiones-sur.png') }}"
                                            alt="Inversiones Sur Limitada"
                                            width="210"
                                            style="
                                                display: block;
                                                width: 210px;
                                                max-width: 210px;
                                                height: auto;
                                                margin: 0 auto;
                                                border: 0;
                                            "
                                        >

                                    </td>

                                </tr>
                            </table>


                            <div
                                style="
                                    margin-top: 15px;
                                    color: #ffffff;
                                    font-size: 20px;
                                    font-weight: 700;
                                    letter-spacing: .3px;
                                "
                            >
                                SISTEMA DE GESTIÓN
                            </div>

                            <div
                                style="
                                    margin-top: 6px;
                                    color: #b9cada;
                                    font-size: 11px;
                                    letter-spacing: 1.3px;
                                    text-transform: uppercase;
                                "
                            >
                                Inversiones Sur Limitada
                            </div>


                            <div
                                style="
                                    width: 38px;
                                    height: 3px;
                                    margin: 17px auto 0;
                                    border-radius: 20px;
                                    background: #14a0a5;
                                "
                            ></div>

                        </td>
                    </tr>


                    {{-- ============================================
                         CONTENIDO
                    ============================================= --}}

                    <tr>

                        <td
                            style="
                                background: #ffffff;
                                padding: 38px 42px 34px;
                                border-left: 1px solid #e2e8f0;
                                border-right: 1px solid #e2e8f0;
                            "
                        >

                            @yield('contenido')

                        </td>

                    </tr>


                    {{-- ============================================
                         SEGURIDAD
                    ============================================= --}}

                    <tr>

                        <td
                            style="
                                background: #ffffff;
                                padding: 0 42px;
                                border-left: 1px solid #e2e8f0;
                                border-right: 1px solid #e2e8f0;
                            "
                        >

                            <div
                                style="
                                    border-top: 1px solid #edf1f5;
                                    padding: 22px 0;
                                    text-align: center;
                                    color: #667085;
                                    font-size: 11px;
                                    line-height: 1.6;
                                "
                            >
                                Este correo fue generado automáticamente
                                por el Sistema de Gestión.
                            </div>

                        </td>

                    </tr>


                    {{-- ============================================
                         PIE
                    ============================================= --}}

                    <tr>

                        <td
                            style="
                                padding: 20px 25px;
                                background: #f8fafc;
                                border: 1px solid #e2e8f0;
                                border-top: none;
                                border-radius: 0 0 14px 14px;
                                text-align: center;
                            "
                        >

                            <div
                                style="
                                    color: #98a2b3;
                                    font-size: 10px;
                                    line-height: 1.6;
                                "
                            >
                                Acceso privado y controlado
                            </div>

                            <div
                                style="
                                    margin-top: 3px;
                                    color: #b0b8c4;
                                    font-size: 9px;
                                "
                            >
                                Sistema de Gestión Empresarial
                            </div>

                        </td>

                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>
</html>