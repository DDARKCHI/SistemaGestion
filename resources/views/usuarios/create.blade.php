@extends('layouts.app')

@section('title', 'Nuevo usuario')

@section('topbar_title', 'Gestión de usuarios')

@push('styles')

<style>

    /* =========================================================
       BREADCRUMB
    ========================================================== */

    .user-create-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 18px;
        color: #8a94a6;
        font-size: 12px;
    }

    .user-create-breadcrumb a {
        color: #667085;
        text-decoration: none;
    }

    .user-create-breadcrumb a:hover {
        color: #155a91;
    }

    .user-create-breadcrumb-current {
        color: #344054;
    }


    /* =========================================================
       HEADER
    ========================================================== */

    .user-create-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 25px;
    }

    .user-create-title {
        margin: 0;
        color: #172033;
        font-size: 27px;
        line-height: 1.2;
        font-weight: 700;
        letter-spacing: -.025em;
    }

    .user-create-subtitle {
        margin: 7px 0 0;
        color: #667085;
        font-size: 13px;
    }


    /* =========================================================
       CARD
    ========================================================== */

    .user-create-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(16,47,80,.05);
        margin-bottom: 20px;
        overflow: hidden;
    }

    .user-create-card-header {
        min-height: 67px;
        padding: 17px 21px;
        border-bottom: 1px solid #edf1f5;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
    }

    .user-create-card-title {
        margin: 0;
        color: #172033;
        font-size: 15px;
        font-weight: 700;
    }

    .user-create-card-description {
        margin: 4px 0 0;
        color: #98a2b3;
        font-size: 11px;
    }

    .user-create-card-body {
        padding: 22px;
    }


    /* =========================================================
       FORMULARIO
    ========================================================== */

    .user-form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 17px;
    }

    .user-form-group {
        min-width: 0;
    }

    .user-form-group-full {
        grid-column: 1 / -1;
    }

    .user-form-label {
        display: block;
        margin-bottom: 7px;
        color: #344054;
        font-size: 11px;
        font-weight: 600;
    }

    .user-form-required {
        color: #c0392b;
    }

    .user-form-control {
        width: 100%;
        min-height: 40px;
        padding: 9px 11px;
        box-sizing: border-box;
        border: 1px solid #d8e0e8;
        border-radius: 7px;
        background: #ffffff;
        color: #344054;
        font-family: inherit;
        font-size: 12px;
        outline: none;
        transition:
            border-color .15s ease,
            box-shadow .15s ease;
    }

    .user-form-control::placeholder {
        color: #a1aab7;
    }

    .user-form-control:focus {
        border-color: #155a91;
        box-shadow: 0 0 0 3px rgba(21,90,145,.08);
    }

    .user-form-help {
        margin-top: 5px;
        color: #98a2b3;
        font-size: 10px;
        line-height: 1.4;
    }


    /* =========================================================
       INFORMACIÓN
    ========================================================== */

    .user-info-box {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin-bottom: 20px;
        padding: 13px 15px;
        border: 1px solid #dce9f3;
        border-radius: 7px;
        background: #f4f8fb;
        color: #667085;
        font-size: 11px;
        line-height: 1.5;
    }

    .user-info-icon {
        flex-shrink: 0;
        width: 22px;
        height: 22px;
        border-radius: 6px;
        background: #e2eef6;
        color: #155a91;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 700;
    }

    .user-info-box strong {
        color: #155a91;
    }


    /* =========================================================
       ESTADO
    ========================================================== */

    .user-status-box {
        display: flex;
        align-items: center;
        gap: 10px;
        min-height: 40px;
        padding: 9px 11px;
        border: 1px solid #d8e0e8;
        border-radius: 7px;
        background: #ffffff;
    }

    .user-status-checkbox {
        width: 16px;
        height: 16px;
        margin: 0;
        accent-color: #155a91;
        cursor: pointer;
    }

    .user-status-text {
        color: #344054;
        font-size: 11px;
        font-weight: 600;
        cursor: pointer;
    }


    /* =========================================================
       FOOTER
    ========================================================== */

    .user-form-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        padding: 18px 22px;
        background: #f8fafc;
        border-top: 1px solid #edf1f5;
    }

    .user-form-footer-note {
        color: #98a2b3;
        font-size: 10px;
    }

    .user-form-footer-actions {
        display: flex;
        gap: 9px;
    }


    /* =========================================================
       ERRORES
    ========================================================== */

    .user-validation-alert {
        margin-bottom: 20px;
        padding: 13px 16px;
        border: 1px solid #f1ceca;
        border-radius: 7px;
        background: #fff5f3;
        color: #a63228;
        font-size: 11px;
    }

    .user-validation-alert strong {
        display: block;
        margin-bottom: 6px;
        font-size: 12px;
    }

    .user-validation-alert ul {
        margin: 0;
        padding-left: 18px;
    }

    .user-validation-alert li {
        margin-bottom: 3px;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================== */

    @media (max-width: 900px) {

        .user-form-grid {
            grid-template-columns: 1fr;
        }

        .user-form-group-full {
            grid-column: auto;
        }

    }

    @media (max-width: 700px) {

        .user-create-header {
            flex-direction: column;
        }

        .user-create-header .btn {
            width: 100%;
        }

        .user-create-card-body {
            padding: 17px;
        }

        .user-form-footer {
            align-items: stretch;
            flex-direction: column;
        }

        .user-form-footer-actions {
            width: 100%;
        }

        .user-form-footer-actions .btn {
            flex: 1;
        }

    }

</style>

@endpush


@section('content')

    <div class="user-create-breadcrumb">

        <a href="{{ route('usuarios.index') }}">
            Usuarios
        </a>

        <span>›</span>

        <span class="user-create-breadcrumb-current">
            Nuevo usuario
        </span>

    </div>


    <div class="user-create-header">

        <div>

            <h1 class="user-create-title">
                Nuevo usuario
            </h1>

            <p class="user-create-subtitle">
                Registra un nuevo usuario y define su nivel de acceso al sistema.
            </p>

        </div>

        <a
            href="{{ route('usuarios.index') }}"
            class="btn"
        >
            ← Volver a usuarios
        </a>

    </div>


    @if($errors->any())

        <div class="user-validation-alert">

            <strong>
                Revisa la información ingresada
            </strong>

            <ul>

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    <form
        action="{{ route('usuarios.store') }}"
        method="POST"
        id="userCreateForm"
    >

        @csrf


        <section class="user-create-card">

            <div class="user-create-card-header">

                <div>

                    <h2 class="user-create-card-title">
                        Información del usuario
                    </h2>

                    <p class="user-create-card-description">
                        Datos de acceso, rol y estado del usuario.
                    </p>

                </div>

            </div>


            <div class="user-create-card-body">

                <div class="user-info-box">

                    <div class="user-info-icon">
                        i
                    </div>

                    <div>

                        <strong>
                            Acceso al sistema
                        </strong>

                        <br>

                        El usuario podrá iniciar sesión con su correo y contraseña.
                        El rol determinará las acciones disponibles dentro del sistema.

                    </div>

                </div>


                <div class="user-form-grid">


                    {{-- NOMBRE --}}

                    <div class="user-form-group user-form-group-full">

                        <label
                            class="user-form-label"
                            for="name"
                        >
                            Nombre completo

                            <span class="user-form-required">
                                *
                            </span>
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="user-form-control"
                            value="{{ old('name') }}"
                            placeholder="Ej. Juan Pérez González"
                            maxlength="255"
                            required
                            autofocus
                        >

                        <div class="user-form-help">
                            Nombre que se mostrará dentro del sistema.
                        </div>

                    </div>


                    {{-- CORREO --}}

                    <div class="user-form-group">

                        <label
                            class="user-form-label"
                            for="email"
                        >
                            Correo electrónico

                            <span class="user-form-required">
                                *
                            </span>
                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="user-form-control"
                            value="{{ old('email') }}"
                            placeholder="Ej. usuario@empresa.cl"
                            maxlength="255"
                            required
                        >

                        <div class="user-form-help">
                            Este correo será utilizado para iniciar sesión.
                        </div>

                    </div>


                    {{-- ROL --}}

                    <div class="user-form-group">

                        <label
                            class="user-form-label"
                            for="rol"
                        >
                            Rol

                            <span class="user-form-required">
                                *
                            </span>
                        </label>

                        <select
                            id="rol"
                            name="rol"
                            class="user-form-control"
                            required
                        >

                            <option value="">
                                Seleccionar rol
                            </option>

                            @foreach($roles as $rol)

                                <option
                                    value="{{ $rol->name }}"
                                    @selected(old('rol') === $rol->name)
                                >
                                    {{ $rol->name }}
                                </option>

                            @endforeach

                        </select>

                        <div class="user-form-help">
                            Define el nivel de acceso del usuario.
                        </div>

                    </div>


                    {{-- CONTRASEÑA --}}

                    <div class="user-form-group">

                        <label
                            class="user-form-label"
                            for="password"
                        >
                            Contraseña

                            <span class="user-form-required">
                                *
                            </span>
                        </label>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="user-form-control"
                            placeholder="Mínimo 8 caracteres"
                            minlength="8"
                            required
                            autocomplete="new-password"
                        >

                        <div class="user-form-help">
                            La contraseña debe tener al menos 8 caracteres.
                        </div>

                    </div>


                    {{-- CONFIRMAR CONTRASEÑA --}}

                    <div class="user-form-group">

                        <label
                            class="user-form-label"
                            for="password_confirmation"
                        >
                            Confirmar contraseña

                            <span class="user-form-required">
                                *
                            </span>
                        </label>

                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            class="user-form-control"
                            placeholder="Repite la contraseña"
                            minlength="8"
                            required
                            autocomplete="new-password"
                        >

                    </div>


                    {{-- ESTADO --}}

                    <div class="user-form-group user-form-group-full">

                        <label class="user-form-label">
                            Estado de acceso
                        </label>

                        <div class="user-status-box">

                            <input
                                type="checkbox"
                                id="activo"
                                name="activo"
                                value="1"
                                class="user-status-checkbox"
                                @checked(old('activo', true))
                            >

                            <label
                                for="activo"
                                class="user-status-text"
                            >
                                Usuario activo
                            </label>

                        </div>

                        <div class="user-form-help">
                            Si está activo, podrá iniciar sesión inmediatamente.
                        </div>

                    </div>

                </div>

            </div>

        </section>


        <div class="user-create-card">

            <div class="user-form-footer">

                <div class="user-form-footer-note">

                    <span class="user-form-required">
                        *
                    </span>

                    Campos obligatorios.

                </div>


                <div class="user-form-footer-actions">

                    <a
                        href="{{ route('usuarios.index') }}"
                        class="btn"
                    >
                        Cancelar
                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Guardar usuario
                    </button>

                </div>

            </div>

        </div>

    </form>

@endsection