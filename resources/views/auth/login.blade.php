<x-guest-layout>

    <style>
        .login-wrapper {
            width: 100%;
            max-width: 980px;
            margin: 0 auto;
        }

        .login-card {
            display: grid;
            grid-template-columns: 38% 62%;
            min-height: 610px;

            background: #ffffff;

            border:
                1px solid #dfe5ec;

            border-radius: 18px;

            overflow: hidden;

            box-shadow:
                0 22px 60px rgba(16, 47, 80, .11),
                0 4px 15px rgba(16, 47, 80, .04);
        }


        /* =====================================================
           PANEL IZQUIERDO
        ====================================================== */

        .login-brand {
            position: relative;

            min-height: 100%;

            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;

            padding: 50px 34px;

            background:
                linear-gradient(
                    150deg,
                    #123b67 0%,
                    #0c3158 48%,
                    #082642 100%
                );

            color: #ffffff;

            overflow: hidden;
        }

        .login-brand::before {
            content: '';

            position: absolute;

            width: 420px;
            height: 420px;

            right: -260px;
            bottom: -180px;

            border-radius: 50%;

            border:
                60px solid rgba(255,255,255,.025);
        }

        .login-brand::after {
            content: '';

            position: absolute;

            width: 310px;
            height: 600px;

            right: -190px;
            bottom: -150px;

            transform:
                rotate(36deg);

            background:
                linear-gradient(
                    rgba(255,255,255,.025),
                    transparent
                );
        }

        .login-brand-content {
            position: relative;
            z-index: 2;

            display: flex;
            flex-direction: column;
            align-items: center;

            text-align: center;
        }

        .login-logo {
            width: 96px;
            height: 96px;

            display: flex;
            align-items: center;
            justify-content: center;

            margin-bottom: 27px;
        }

        .login-logo svg {
            width: 100%;
            height: 100%;
        }

        .login-brand-title {
            margin: 0;

            font-size: 23px;
            font-weight: 700;

            letter-spacing: .015em;
        }

        .login-brand-subtitle {
            margin-top: 8px;

            color:
                rgba(255,255,255,.72);

            font-size: 12px;
            font-weight: 500;

            text-transform: uppercase;

            letter-spacing: .12em;
        }

        .login-brand-line {
            width: 42px;
            height: 3px;

            margin-top: 22px;

            border-radius: 999px;

            background: #14a0a5;
        }

        .login-brand-description {
            max-width: 260px;

            margin: 22px 0 0;

            color:
                rgba(255,255,255,.62);

            font-size: 11px;
            line-height: 1.6;
        }


        /* =====================================================
           PANEL DERECHO
        ====================================================== */

        .login-panel {
            display: flex;
            align-items: center;

            padding: 55px 74px;

            background: #ffffff;
        }

        .login-panel-inner {
            width: 100%;
            max-width: 430px;

            margin: 0 auto;
        }

        .login-kicker {
            margin-bottom: 8px;

            color: #155a91;

            font-size: 10px;
            font-weight: 700;

            text-transform: uppercase;

            letter-spacing: .09em;
        }

        .login-title {
            margin: 0;

            color: #13213a;

            font-size: 31px;
            font-weight: 700;

            letter-spacing: -.025em;
        }

        .login-subtitle {
            margin:
                9px 0 32px;

            color: #667085;

            font-size: 13px;

            line-height: 1.5;
        }


        /* =====================================================
           ESTADO DE SESIÓN
        ====================================================== */

        .login-status {
            margin-bottom: 22px;

            padding: 11px 13px;

            border:
                1px solid #bfe3ce;

            border-radius: 8px;

            background: #f2faf5;

            color: #287443;

            font-size: 11px;

            line-height: 1.45;
        }


        /* =====================================================
           FORMULARIO
        ====================================================== */

        .login-form-group {
            margin-bottom: 20px;
        }

        .login-label {
            display: block;

            margin-bottom: 8px;

            color: #26364d;

            font-size: 12px;
            font-weight: 600;
        }

        .login-input-wrapper {
            position: relative;
        }

        .login-input-icon {
            position: absolute;

            left: 14px;
            top: 50%;

            width: 19px;
            height: 19px;

            transform:
                translateY(-50%);

            color: #7b8797;

            pointer-events: none;
        }

        .login-input {
            width: 100%;
            height: 48px;

            padding:
                0 44px;

            border:
                1px solid #d6dee8;

            border-radius: 8px;

            background: #ffffff;

            color: #26364d;

            font-family: inherit;
            font-size: 12px;

            outline: none;

            transition:
                border-color .15s ease,
                box-shadow .15s ease,
                background .15s ease;
        }

        .login-input::placeholder {
            color: #9aa5b1;
        }

        .login-input:hover {
            border-color: #bac6d3;
        }

        .login-input:focus {
            border-color: #155a91;

            box-shadow:
                0 0 0 3px rgba(21, 90, 145, .09);
        }

        .login-password-toggle {
            position: absolute;

            right: 12px;
            top: 50%;

            width: 30px;
            height: 30px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            transform:
                translateY(-50%);

            padding: 0;

            border: none;

            border-radius: 6px;

            background: transparent;

            color: #7b8797;

            cursor: pointer;

            transition:
                background .12s ease,
                color .12s ease;
        }

        .login-password-toggle:hover {
            background: #f2f5f8;

            color: #155a91;
        }

        .login-password-toggle svg {
            width: 19px;
            height: 19px;
        }

        .login-error {
            margin-top: 7px;

            color: #b9382e;

            font-size: 10px;

            line-height: 1.4;
        }


        /* =====================================================
           OPCIONES
        ====================================================== */

        .login-options {
            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 18px;

            margin:
                4px 0 27px;
        }

        .login-remember {
            display: inline-flex;
            align-items: center;

            gap: 8px;

            color: #475467;

            font-size: 11px;

            cursor: pointer;

            user-select: none;
        }

        .login-remember input {
            width: 15px;
            height: 15px;

            margin: 0;

            accent-color: #155a91;

            cursor: pointer;
        }

        .login-forgot {
            color: #155a91;

            font-size: 11px;
            font-weight: 600;

            text-decoration: none;
        }

        .login-forgot:hover {
            text-decoration: underline;
        }


        /* =====================================================
           BOTÓN
        ====================================================== */

        .login-submit {
            width: 100%;
            height: 50px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            gap: 9px;

            border: none;

            border-radius: 8px;

            background:
                linear-gradient(
                    135deg,
                    #155a91,
                    #1766c8
                );

            color: #ffffff;

            font-family: inherit;
            font-size: 12px;
            font-weight: 700;

            cursor: pointer;

            box-shadow:
                0 6px 15px rgba(21, 90, 145, .18);

            transition:
                transform .12s ease,
                box-shadow .12s ease,
                filter .12s ease;
        }

        .login-submit:hover {
            transform:
                translateY(-1px);

            box-shadow:
                0 8px 20px rgba(21, 90, 145, .22);

            filter:
                brightness(1.03);
        }

        .login-submit:active {
            transform:
                translateY(0);
        }

        .login-submit:disabled {
            opacity: .72;

            cursor: wait;
        }

        .login-submit svg {
            width: 17px;
            height: 17px;
        }


        /* =====================================================
           PIE
        ====================================================== */

        .login-security {
            display: flex;
            align-items: center;
            justify-content: center;

            gap: 10px;

            margin-top: 30px;

            color: #667085;

            font-size: 10px;
        }

        .login-security::before,
        .login-security::after {
            content: '';

            flex: 1;

            height: 1px;

            background: #e1e6ec;
        }

        .login-security-content {
            display: inline-flex;
            align-items: center;

            gap: 7px;

            white-space: nowrap;
        }

        .login-security svg {
            width: 16px;
            height: 16px;

            color: #63758a;
        }

        .login-footer {
            margin-top: 20px;

            color: #98a2b3;

            text-align: center;

            font-size: 9px;
        }


        /* =====================================================
           RESPONSIVE
        ====================================================== */

        @media (max-width: 900px) {
            .login-wrapper {
                max-width: 700px;
            }

            .login-card {
                grid-template-columns: 34% 66%;
            }

            .login-panel {
                padding:
                    48px 44px;
            }

            .login-brand {
                padding:
                    45px 24px;
            }
        }

        @media (max-width: 700px) {
            .login-wrapper {
                max-width: 480px;
            }

            .login-card {
                grid-template-columns: 1fr;

                min-height: auto;
            }

            .login-brand {
                min-height: auto;

                padding:
                    30px 24px;
            }

            .login-logo {
                width: 64px;
                height: 64px;

                margin-bottom: 14px;
            }

            .login-brand-title {
                font-size: 17px;
            }

            .login-brand-subtitle {
                margin-top: 5px;

                font-size: 9px;
            }

            .login-brand-line,
            .login-brand-description {
                display: none;
            }

            .login-panel {
                padding:
                    38px 28px;
            }

            .login-title {
                font-size: 25px;
            }
        }

        @media (max-width: 420px) {
            .login-panel {
                padding:
                    32px 20px;
            }

            .login-options {
                align-items: flex-start;
                flex-direction: column;

                gap: 12px;
            }
        }
    </style>


    <div class="login-wrapper">

        <section class="login-card">

            {{-- =====================================================
                 IDENTIDAD
            ====================================================== --}}

            <aside class="login-brand">

                <div class="login-brand-content">

                    <div class="login-logo">

                        <svg
                            viewBox="0 0 100 100"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M50 8L82 27L69 35L50 24L31 35L18 27L50 8Z"
                                fill="white"
                            />

                            <path
                                d="M18 31L31 39V59L50 70L69 59V47L55 55V47L82 31V67L50 86L18 67V31Z"
                                fill="white"
                            />

                            <path
                                d="M31 39L50 50L61 44L48 36L31 46V39Z"
                                fill="#8FC5EA"
                                opacity=".85"
                            />
                        </svg>

                    </div>


                    <h1 class="login-brand-title">
                        SISTEMA DE GESTIÓN
                    </h1>

                    <div class="login-brand-subtitle">
                        Plataforma empresarial
                    </div>

                    <div class="login-brand-line"></div>

                    <p class="login-brand-description">
                        Operaciones, finanzas, personal y gestión
                        centralizados en una sola plataforma.
                    </p>

                </div>

            </aside>


            {{-- =====================================================
                 FORMULARIO
            ====================================================== --}}

            <div class="login-panel">

                <div class="login-panel-inner">

                    <div class="login-kicker">
                        Plataforma empresarial
                    </div>

                    <h2 class="login-title">
                        Acceso al sistema
                    </h2>

                    <p class="login-subtitle">
                        Ingresa tus credenciales para continuar.
                    </p>


                    @if(session('status'))

                        <div class="login-status">
                            {{ session('status') }}
                        </div>

                    @endif


                    <form
                        method="POST"
                        action="{{ route('login') }}"
                        id="loginForm"
                    >

                        @csrf


                        {{-- CORREO --}}

                        <div class="login-form-group">

                            <label
                                for="email"
                                class="login-label"
                            >
                                Correo electrónico
                            </label>

                            <div class="login-input-wrapper">

                                <svg
                                    class="login-input-icon"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <path
                                        d="M20 21a8 8 0 0 0-16 0"
                                    />

                                    <circle
                                        cx="12"
                                        cy="7"
                                        r="4"
                                    />
                                </svg>

                                <input
                                    id="email"
                                    class="login-input"
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    placeholder="Ingresa tu correo"
                                    required
                                    autofocus
                                    autocomplete="username"
                                >

                            </div>


                            @if($errors->has('email'))

                                <div class="login-error">
                                    {{ $errors->first('email') }}
                                </div>

                            @endif

                        </div>


                        {{-- CONTRASEÑA --}}

                        <div class="login-form-group">

                            <label
                                for="password"
                                class="login-label"
                            >
                                Contraseña
                            </label>

                            <div class="login-input-wrapper">

                                <svg
                                    class="login-input-icon"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <rect
                                        x="5"
                                        y="10"
                                        width="14"
                                        height="10"
                                        rx="2"
                                    />

                                    <path
                                        d="M8 10V7a4 4 0 0 1 8 0v3"
                                    />
                                </svg>

                                <input
                                    id="password"
                                    class="login-input"
                                    type="password"
                                    name="password"
                                    placeholder="Ingresa tu contraseña"
                                    required
                                    autocomplete="current-password"
                                >


                                <button
                                    type="button"
                                    class="login-password-toggle"
                                    id="togglePassword"
                                    aria-label="Mostrar contraseña"
                                    title="Mostrar contraseña"
                                >

                                    <svg
                                        id="eyeIcon"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >
                                        <path
                                            d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12Z"
                                        />

                                        <circle
                                            cx="12"
                                            cy="12"
                                            r="2.7"
                                        />
                                    </svg>

                                </button>

                            </div>


                            @if($errors->has('password'))

                                <div class="login-error">
                                    {{ $errors->first('password') }}
                                </div>

                            @endif

                        </div>


                        {{-- OPCIONES --}}

                        <div class="login-options">

                            <label class="login-remember">

                                <input
                                    id="remember_me"
                                    type="checkbox"
                                    name="remember"
                                >

                                <span>
                                    Recordarme
                                </span>

                            </label>


                            @if(Route::has('password.request'))

                                <a
                                    class="login-forgot"
                                    href="{{ route('password.request') }}"
                                >
                                    ¿Olvidaste tu contraseña?
                                </a>

                            @endif

                        </div>


                        {{-- ENTRAR --}}

                        <button
                            type="submit"
                            class="login-submit"
                            id="loginSubmit"
                        >

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <rect
                                    x="5"
                                    y="10"
                                    width="14"
                                    height="10"
                                    rx="2"
                                />

                                <path
                                    d="M8 10V7a4 4 0 0 1 8 0v3"
                                />
                            </svg>

                            <span id="loginButtonText">
                                Iniciar sesión
                            </span>

                        </button>

                    </form>


                    <div class="login-security">

                        <span class="login-security-content">

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path
                                    d="M12 3 19 6v5c0 5-3 8-7 10-4-2-7-5-7-10V6l7-3Z"
                                />

                                <path
                                    d="m9.5 12 1.7 1.7 3.5-3.8"
                                />
                            </svg>

                            Acceso privado y controlado

                        </span>

                    </div>


                    <div class="login-footer">
                        Sistema de gestión empresarial
                    </div>

                </div>

            </div>

        </section>

    </div>


    <script>
        document.addEventListener(
            'DOMContentLoaded',
            function () {

                const password =
                    document.getElementById(
                        'password'
                    );

                const togglePassword =
                    document.getElementById(
                        'togglePassword'
                    );

                const loginForm =
                    document.getElementById(
                        'loginForm'
                    );

                const loginSubmit =
                    document.getElementById(
                        'loginSubmit'
                    );

                const loginButtonText =
                    document.getElementById(
                        'loginButtonText'
                    );


                if (
                    password &&
                    togglePassword
                ) {

                    togglePassword.addEventListener(
                        'click',
                        function () {

                            const visible =
                                password.type === 'text';

                            password.type =
                                visible
                                    ? 'password'
                                    : 'text';

                            this.setAttribute(
                                'aria-label',
                                visible
                                    ? 'Mostrar contraseña'
                                    : 'Ocultar contraseña'
                            );

                            this.setAttribute(
                                'title',
                                visible
                                    ? 'Mostrar contraseña'
                                    : 'Ocultar contraseña'
                            );

                        }
                    );

                }


                if (
                    loginForm &&
                    loginSubmit &&
                    loginButtonText
                ) {

                    loginForm.addEventListener(
                        'submit',
                        function () {

                            loginSubmit.disabled = true;

                            loginButtonText.textContent =
                                'Ingresando...';

                        }
                    );

                }

            }
        );
    </script>

</x-guest-layout>