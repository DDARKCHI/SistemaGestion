<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'Sistema de Gestión')
    </title>

    <style>

        /* =========================================================
           RESET
        ========================================================== */

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            min-height: 100%;
        }

        body {
            background: #f4f7fb;
            color: #172033;

            font-family:
                Inter,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                Roboto,
                Arial,
                sans-serif;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button,
        input,
        select,
        textarea {
            font: inherit;
        }

        /* =========================================================
           VARIABLES VISUALES
           Basadas en la propuesta gráfica
        ========================================================== */

        :root {

            --blue-dark: #102f50;

            --blue-primary: #155a91;

            --blue-hover: #124d7c;

            --blue-light: #eaf3fa;

            --blue-soft: #f3f8fc;

            --white: #ffffff;

            --background: #f4f7fb;

            --text-primary: #172033;

            --text-secondary: #475467;

            --text-muted: #8a94a6;

            --border: #e2e8f0;

            --border-light: #edf1f5;

            --success: #16804a;

            --success-light: #edf8f2;

            --warning: #b7791f;

            --warning-light: #fff8e8;

            --danger: #c0392b;

            --danger-light: #fff1ef;

            --purple: #6841a5;

            --purple-light: #f4effb;

            --shadow: 0 2px 8px rgba(16, 47, 80, .06);

            --radius: 10px;
        }

        /* =========================================================
           APP
        ========================================================== */

        .app {
            min-height: 100vh;
        }

        .main-layout {
            min-height: 100vh;
        }

        .main-content {
            margin-left: 250px;
            min-height: 100vh;
        }

        /* =========================================================
           CONTENIDO
        ========================================================== */

        .page-content {
            padding: 30px 34px 50px;
        }

        .page-container {
            max-width: 1450px;
            margin: 0 auto;
        }

        /* =========================================================
           COMPONENTES GENERALES
        ========================================================== */

        .card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;

            min-height: 38px;

            padding: 8px 14px;

            border: 1px solid var(--border);

            border-radius: 7px;

            background: var(--white);

            color: var(--text-secondary);

            font-size: 12px;
            font-weight: 600;

            cursor: pointer;

            transition:
                background .15s ease,
                border-color .15s ease,
                color .15s ease;
        }

        .btn:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
        }

        .btn-primary {
            background: var(--blue-primary);
            border-color: var(--blue-primary);
            color: var(--white);
        }

        .btn-primary:hover {
            background: var(--blue-hover);
            border-color: var(--blue-hover);
        }

        .btn-success {
            background: var(--success);
            border-color: var(--success);
            color: var(--white);
        }

        .btn-warning {
            background: var(--warning);
            border-color: var(--warning);
            color: var(--white);
        }

        .btn-danger {
            background: var(--white);
            border-color: #f1c8c4;
            color: var(--danger);
        }

        .btn-danger:hover {
            background: var(--danger-light);
        }

        /* =========================================================
           ESTADOS
        ========================================================== */

        .status {
            display: inline-flex;
            align-items: center;
            gap: 6px;

            padding: 5px 9px;

            border-radius: 5px;

            font-size: 11px;
            font-weight: 600;
        }

        .status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
        }

        .status-neutral {
            background: #f1f4f7;
            color: #475467;
        }

        .status-success {
            background: var(--success-light);
            color: var(--success);
        }

        .status-warning {
            background: var(--warning-light);
            color: var(--warning);
        }

        .status-danger {
            background: var(--danger-light);
            color: var(--danger);
        }

        .status-purple {
            background: var(--purple-light);
            color: var(--purple);
        }

        /* =========================================================
           RESPONSIVE
        ========================================================== */

        @media (max-width: 1000px) {

            .main-content {
                margin-left: 220px;
            }

            .page-content {
                padding: 24px;
            }

        }

        @media (max-width: 800px) {

            .main-content {
                margin-left: 0;
            }

            .page-content {
                padding: 20px 16px 40px;
            }

        }

    </style>

    @stack('styles')

</head>


<body>

<div class="app">

    <div class="main-layout">

        @include('components.sidebar')

        <div class="main-content">

            @include('components.topbar')

            <main class="page-content">

                <div class="page-container">

                    @yield('content')

                </div>

            </main>

        </div>

    </div>

</div>

@stack('scripts')

</body>

</html>