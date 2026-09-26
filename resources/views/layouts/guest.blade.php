<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <title>
        {{ config('app.name', 'Sistema de Gestión') }}
    </title>

    <link
        rel="preconnect"
        href="https://fonts.bunny.net"
    >

    <link
        href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap"
        rel="stylesheet"
    />

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    <style>
        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            min-height: 100%;
        }

        body {
            font-family: 'Figtree', sans-serif;
            background:
                radial-gradient(
                    circle at top right,
                    rgba(21, 90, 145, .06),
                    transparent 30%
                ),
                #f7f9fc;
            color: #172033;
            -webkit-font-smoothing: antialiased;
        }

        .guest-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px;
        }

        .guest-page::before {
            content: '';
            position: fixed;
            inset: 0;
            pointer-events: none;
            background-image:
                linear-gradient(
                    rgba(15, 43, 75, .018) 1px,
                    transparent 1px
                ),
                linear-gradient(
                    90deg,
                    rgba(15, 43, 75, .018) 1px,
                    transparent 1px
                );
            background-size: 36px 36px;
            mask-image:
                linear-gradient(
                    to bottom,
                    rgba(0,0,0,.35),
                    transparent 75%
                );
        }

        .guest-content {
            width: 100%;
            position: relative;
            z-index: 1;
        }

        @media (max-width: 700px) {
            .guest-page {
                padding: 18px;
                align-items: flex-start;
            }
        }
    </style>
</head>

<body>

    <main class="guest-page">

        <div class="guest-content">
            {{ $slot }}
        </div>

    </main>

</body>
</html>