<x-guest-layout>

    <style>
        .auth-wrapper {
            width: 100%;
            max-width: 980px;
            margin: 0 auto;
        }

        .auth-card {
            display: grid;
            grid-template-columns: 38% 62%;
            min-height: 650px;
            background: #ffffff;
            border: 1px solid #dfe5ec;
            border-radius: 18px;
            overflow: hidden;
            box-shadow:
                0 22px 60px rgba(16, 47, 80, .11),
                0 4px 15px rgba(16, 47, 80, .04);
        }

        .auth-brand {
            position: relative;
            display: flex;
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

        .auth-brand::before {
            content: '';
            position: absolute;
            width: 420px;
            height: 420px;
            right: -260px;
            bottom: -180px;
            border-radius: 50%;
            border: 60px solid rgba(255,255,255,.025);
        }

        .auth-brand::after {
            content: '';
            position: absolute;
            width: 310px;
            height: 600px;
            right: -190px;
            bottom: -150px;
            transform: rotate(36deg);
            background:
                linear-gradient(
                    rgba(255,255,255,.025),
                    transparent
                );
        }

        .auth-brand-content {
            position: relative;
            z-index: 2;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .auth-brand-header {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .auth-brand-heading {
            text-align: center;
        }

        .auth-logo {
            width: 270px;
            min-height: 112px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 31px;
            padding: 15px 22px;
            background: #ffffff;
            border: 1px solid rgba(255,255,255,.22);
            border-radius: 15px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, .14);
        }

        .auth-logo-full {
            display: block;
            width: 100%;
            height: auto;
            max-height: 86px;
            object-fit: contain;
        }

        .auth-logo-icon {
            display: none;
            width: 70px;
            height: 70px;
            object-fit: contain;
        }

        .auth-brand-title {
            margin: 0;
            font-size: 23px;
            font-weight: 700;
            letter-spacing: .015em;
        }

        .auth-brand-subtitle {
            margin-top: 8px;
            color: rgba(255,255,255,.72);
            font-size: 12px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: .12em;
        }

        .auth-brand-line {
            width: 42px;
            height: 3px;
            margin-top: 22px;
            border-radius: 999px;
            background: #2a7bc2;
        }

        .auth-brand-description {
            max-width: 260px;
            margin: 22px 0 0;
            color: rgba(255,255,255,.62);
            font-size: 11px;
            line-height: 1.6;
        }

        .auth-panel {
            display: flex;
            align-items: center;
            padding: 48px 74px;
            background: #ffffff;
        }

        .auth-panel-inner {
            width: 100%;
            max-width: 430px;
            margin: 0 auto;
        }

        .auth-kicker {
            margin-bottom: 8px;
            color: #155a91;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .09em;
        }

        .auth-title {
            margin: 0;
            color: #13213a;
            font-size: 31px;
            font-weight: 700;
            letter-spacing: -.025em;
        }

        .auth-subtitle {
            margin: 9px 0 28px;
            color: #667085;
            font-size: 13px;
            line-height: 1.6;
        }

        .auth-form-group {
            margin-bottom: 18px;
        }

        .auth-label {
            display: block;
            margin-bottom: 8px;
            color: #26364d;
            font-size: 12px;
            font-weight: 600;
        }

        .auth-input-wrapper {
            position: relative;
        }

        .auth-input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            width: 19px;
            height: 19px;
            transform: translateY(-50%);
            color: #7b8797;
            pointer-events: none;
        }

        .auth-input {
            width: 100%;
            height: 48px;
            padding: 0 44px;
            border: 1px solid #d6dee8;
            border-radius: 8px;
            background: #ffffff;
            color: #26364d;
            font-family: inherit;
            font-size: 12px;
            outline: none;
            transition:
                border-color .15s ease,
                box-shadow .15s ease;
        }

        .auth-input::placeholder {
            color: #9aa5b1;
        }

        .auth-input:hover {
            border-color: #bac6d3;
        }

        .auth-input:focus {
            border-color: #155a91;
            box-shadow: 0 0 0 3px rgba(21,90,145,.09);
        }

        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            width: 30px;
            height: 30px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transform: translateY(-50%);
            padding: 0;
            border: none;
            border-radius: 6px;
            background: transparent;
            color: #7b8797;
            cursor: pointer;
        }

        .password-toggle:hover {
            background: #f2f5f8;
            color: #155a91;
        }

        .password-toggle svg {
            width: 19px;
            height: 19px;
        }

        .auth-error {
            margin-top: 7px;
            color: #b9382e;
            font-size: 10px;
            line-height: 1.4;
        }

        .auth-submit {
            width: 100%;
            height: 50px;
            margin-top: 5px;
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
                0 6px 15px rgba(21,90,145,.18);
            transition:
                transform .12s ease,
                box-shadow .12s ease,
                filter .12s ease;
        }

        .auth-submit:hover {
            transform: translateY(-1px);
            box-shadow:
                0 8px 20px rgba(21,90,145,.22);
            filter: brightness(1.03);
        }

        .auth-submit:disabled {
            opacity: .72;
            cursor: wait;
        }

        .auth-submit svg {
            width: 17px;
            height: 17px;
        }

        .auth-security {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-top: 28px;
            color: #667085;
            font-size: 10px;
        }

        .auth-security::before,
        .auth-security::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e1e6ec;
        }

        .auth-security span {
            white-space: nowrap;
        }

        @media (max-width: 900px) {
            .auth-card {
                grid-template-columns: 34% 66%;
            }

            .auth-panel {
                padding: 44px;
            }
        }

        @media (max-width: 700px) {
            .auth-wrapper {
                max-width: 480px;
            }

            .auth-card {
                grid-template-columns: 1fr;
                min-height: auto;
            }

            .auth-brand {
                padding: 30px 24px;
            }

            .auth-brand-header {
                width: 100%;
                display: flex;
                flex-direction: row;
                align-items: center;
                justify-content: center;
                gap: 16px;
            }

            .auth-logo {
                width: 82px;
                min-width: 82px;
                min-height: 82px;
                height: 82px;
                margin-bottom: 0;
                padding: 10px;
                background: #ffffff;
                border-radius: 14px;
                box-shadow: 0 8px 22px rgba(0, 0, 0, .12);
            }

            .auth-logo-full {
                display: none;
            }

            .auth-logo-icon {
                display: block;
                width: 60px;
                height: 60px;
            }

            .auth-brand-heading {
                text-align: left;
            }

            .auth-brand-title {
                font-size: 17px;
                line-height: 1.2;
            }

            .auth-brand-subtitle {
                margin-top: 6px;
                font-size: 9px;
                line-height: 1.35;
            }

            .auth-brand-line,
            .auth-brand-description {
                display: none;
            }

            .auth-panel {
                padding: 38px 28px;
            }

            .auth-title {
                font-size: 25px;
            }
        }

        @media (max-width: 420px) {
            .auth-brand {
                padding: 26px 18px;
            }

            .auth-brand-header {
                gap: 13px;
            }

            .auth-logo {
                width: 74px;
                min-width: 74px;
                min-height: 74px;
                height: 74px;
                padding: 9px;
            }

            .auth-logo-icon {
                width: 54px;
                height: 54px;
            }

            .auth-brand-title {
                font-size: 15px;
            }

            .auth-brand-subtitle {
                font-size: 8px;
            }

            .auth-panel {
                padding: 32px 20px;
            }
        }
    </style>


    <div class="auth-wrapper">

        <section class="auth-card">

            <aside class="auth-brand">

                <div class="auth-brand-content">

                    <div class="auth-brand-header">

                        <div class="auth-logo">

                            <img
                                src="{{ asset('images/logo-inversiones-sur.png') }}"
                                alt="Inversiones Sur Limitada"
                                class="auth-logo-full"
                            >

                            <img
                                src="{{ asset('images/icono-inversiones-sur.png') }}"
                                alt="Inversiones Sur"
                                class="auth-logo-icon"
                            >

                        </div>

                        <div class="auth-brand-heading">

                            <h1 class="auth-brand-title">
                                SISTEMA DE GESTIÓN
                            </h1>

                            <div class="auth-brand-subtitle">
                                Inversiones Sur Limitada
                            </div>

                        </div>

                    </div>

                    <div class="auth-brand-line"></div>

                    <p class="auth-brand-description">
                        Define una nueva contraseña segura
                        para recuperar el acceso a tu cuenta.
                    </p>

                </div>

            </aside>


            <div class="auth-panel">

                <div class="auth-panel-inner">

                    <div class="auth-kicker">
                        Seguridad de cuenta
                    </div>

                    <h2 class="auth-title">
                        Nueva contraseña
                    </h2>

                    <p class="auth-subtitle">
                        Ingresa y confirma la nueva contraseña
                        que utilizarás para acceder al sistema.
                    </p>


                    <form
                        method="POST"
                        action="{{ route('password.store') }}"
                        id="resetPasswordForm"
                    >

                        @csrf

                        <input
                            type="hidden"
                            name="token"
                            value="{{ $request->route('token') }}"
                        >


                        {{-- CORREO --}}

                        <div class="auth-form-group">

                            <label
                                for="email"
                                class="auth-label"
                            >
                                Correo electrónico
                            </label>

                            <div class="auth-input-wrapper">

                                <svg
                                    class="auth-input-icon"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <path
                                        d="M4 6h16v12H4z"
                                    />

                                    <path
                                        d="m4 7 8 6 8-6"
                                    />
                                </svg>

                                <input
                                    id="email"
                                    class="auth-input"
                                    type="email"
                                    name="email"
                                    value="{{ old('email', $request->email) }}"
                                    required
                                    autofocus
                                    autocomplete="username"
                                >

                            </div>


                            @if($errors->has('email'))

                                <div class="auth-error">
                                    {{ $errors->first('email') }}
                                </div>

                            @endif

                        </div>


                        {{-- NUEVA CONTRASEÑA --}}

                        <div class="auth-form-group">

                            <label
                                for="password"
                                class="auth-label"
                            >
                                Nueva contraseña
                            </label>

                            <div class="auth-input-wrapper">

                                <svg
                                    class="auth-input-icon"
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
                                    class="auth-input"
                                    type="password"
                                    name="password"
                                    placeholder="Ingresa la nueva contraseña"
                                    required
                                    autocomplete="new-password"
                                >

                                <button
                                    type="button"
                                    class="password-toggle"
                                    data-password-toggle="password"
                                    aria-label="Mostrar contraseña"
                                >
                                    <svg
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

                                <div class="auth-error">
                                    {{ $errors->first('password') }}
                                </div>

                            @endif

                        </div>


                        {{-- CONFIRMACIÓN --}}

                        <div class="auth-form-group">

                            <label
                                for="password_confirmation"
                                class="auth-label"
                            >
                                Confirmar contraseña
                            </label>

                            <div class="auth-input-wrapper">

                                <svg
                                    class="auth-input-icon"
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
                                    id="password_confirmation"
                                    class="auth-input"
                                    type="password"
                                    name="password_confirmation"
                                    placeholder="Repite la nueva contraseña"
                                    required
                                    autocomplete="new-password"
                                >

                                <button
                                    type="button"
                                    class="password-toggle"
                                    data-password-toggle="password_confirmation"
                                    aria-label="Mostrar contraseña"
                                >
                                    <svg
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


                            @if($errors->has('password_confirmation'))

                                <div class="auth-error">
                                    {{ $errors->first('password_confirmation') }}
                                </div>

                            @endif

                        </div>


                        <button
                            type="submit"
                            class="auth-submit"
                            id="resetPasswordSubmit"
                        >

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

                            <span id="resetPasswordButtonText">
                                Guardar nueva contraseña
                            </span>

                        </button>

                    </form>


                    <div class="auth-security">
                        <span>
                            Cambio de contraseña protegido
                        </span>
                    </div>

                </div>

            </div>

        </section>

    </div>


    <script>
        document.addEventListener(
            'DOMContentLoaded',
            function () {

                const toggles =
                    document.querySelectorAll(
                        '[data-password-toggle]'
                    );

                toggles.forEach(
                    function (toggle) {

                        toggle.addEventListener(
                            'click',
                            function () {

                                const inputId =
                                    this.getAttribute(
                                        'data-password-toggle'
                                    );

                                const input =
                                    document.getElementById(
                                        inputId
                                    );

                                if (!input) {
                                    return;
                                }

                                const visible =
                                    input.type === 'text';

                                input.type =
                                    visible
                                        ? 'password'
                                        : 'text';

                                this.setAttribute(
                                    'aria-label',
                                    visible
                                        ? 'Mostrar contraseña'
                                        : 'Ocultar contraseña'
                                );

                            }
                        );

                    }
                );


                const form =
                    document.getElementById(
                        'resetPasswordForm'
                    );

                const button =
                    document.getElementById(
                        'resetPasswordSubmit'
                    );

                const buttonText =
                    document.getElementById(
                        'resetPasswordButtonText'
                    );

                if (
                    form &&
                    button &&
                    buttonText
                ) {
                    form.addEventListener(
                        'submit',
                        function () {

                            button.disabled = true;

                            buttonText.textContent =
                                'Guardando contraseña...';

                        }
                    );
                }

            }
        );
    </script>

</x-guest-layout>