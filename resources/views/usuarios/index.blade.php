@extends('layouts.app')

@section('title', 'Usuarios')

@section('topbar_title', 'Gestión de usuarios')

@push('styles')

<style>

    /* =========================================================
       HEADER
    ========================================================== */

    .users-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 24px;
    }

    .users-title {
        margin: 0;
        color: #172033;
        font-size: 27px;
        line-height: 1.2;
        font-weight: 700;
        letter-spacing: -.025em;
    }

    .users-subtitle {
        margin: 7px 0 0;
        color: #667085;
        font-size: 13px;
    }

    .users-header-actions {
        display: flex;
        align-items: center;
        gap: 9px;
        flex-shrink: 0;
    }


    /* =========================================================
       RESUMEN
    ========================================================== */

    .users-summary {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 14px;
        margin-bottom: 20px;
    }

    .users-summary-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 9px;
        padding: 17px 19px;
        box-shadow: 0 2px 7px rgba(16,47,80,.04);
    }

    .users-summary-label {
        color: #667085;
        font-size: 10px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .03em;
    }

    .users-summary-value {
        margin-top: 7px;
        color: #172033;
        font-size: 23px;
        line-height: 1;
        font-weight: 700;
    }

    .users-summary-description {
        margin-top: 6px;
        color: #98a2b3;
        font-size: 9px;
    }


    /* =========================================================
       CARD
    ========================================================== */

    .users-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(16,47,80,.05);
        overflow: hidden;
    }

    .users-card-header {
        min-height: 66px;
        padding: 15px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        border-bottom: 1px solid #edf1f5;
    }

    .users-card-heading {
        min-width: 0;
    }

    .users-card-title {
        margin: 0;
        color: #172033;
        font-size: 14px;
        font-weight: 700;
    }

    .users-card-description {
        margin: 4px 0 0;
        color: #98a2b3;
        font-size: 10px;
    }


    /* =========================================================
       BUSCADOR
    ========================================================== */

    .users-search {
        position: relative;
        width: 270px;
        flex-shrink: 0;
    }

    .users-search input {
        width: 100%;
        height: 37px;
        padding: 0 11px 0 34px;
        box-sizing: border-box;
        border: 1px solid #d8e0e8;
        border-radius: 7px;
        background: #ffffff;
        color: #344054;
        font-family: inherit;
        font-size: 11px;
        outline: none;
    }

    .users-search input::placeholder {
        color: #a1aab7;
    }

    .users-search input:focus {
        border-color: #155a91;
        box-shadow: 0 0 0 3px rgba(21,90,145,.08);
    }

    .users-search-icon {
        position: absolute;
        left: 11px;
        top: 50%;
        transform: translateY(-50%);
        color: #98a2b3;
        font-size: 14px;
        pointer-events: none;
    }


    /* =========================================================
       TABLA
    ========================================================== */

    .users-table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    .users-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 800px;
    }

    .users-table th {
        padding: 12px 18px;
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
        color: #667085;
        text-align: left;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .035em;
        white-space: nowrap;
    }

    .users-table td {
        padding: 14px 18px;
        border-bottom: 1px solid #edf1f5;
        color: #344054;
        font-size: 11px;
        vertical-align: middle;
    }

    .users-table tbody tr {
        transition: background .12s ease;
    }

    .users-table tbody tr:hover {
        background: #fbfcfe;
    }

    .users-table tbody tr:last-child td {
        border-bottom: none;
    }


    /* =========================================================
       USUARIO
    ========================================================== */

    .user-main {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .user-avatar {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: #eaf3fa;
        color: #155a91;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 10px;
        font-weight: 700;
    }

    .user-name {
        color: #172033;
        font-size: 12px;
        font-weight: 600;
    }

    .user-id {
        margin-top: 2px;
        color: #98a2b3;
        font-size: 9px;
    }

    .user-email {
        color: #667085;
        font-size: 10px;
    }


    /* =========================================================
       ROL
    ========================================================== */

    .user-role {
        display: inline-flex;
        align-items: center;
        padding: 4px 8px;
        border-radius: 5px;
        background: #eef4f8;
        color: #155a91;
        font-size: 10px;
        font-weight: 600;
    }


    /* =========================================================
       ESTADO
    ========================================================== */

    .user-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 8px;
        border-radius: 5px;
        font-size: 10px;
        font-weight: 600;
    }

    .user-status::before {
        content: '';
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
    }

    .user-status-active {
        background: #edf8f2;
        color: #16804a;
    }

    .user-status-inactive {
        background: #f1f4f7;
        color: #667085;
    }


    /* =========================================================
       ACCIONES
    ========================================================== */

    .user-actions {
        display: flex;
        align-items: center;
        gap: 6px;
        white-space: nowrap;
    }

    .user-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 32px;
        padding: 6px 10px;
        border: 1px solid #dce3eb;
        border-radius: 6px;
        background: #ffffff;
        color: #344054;
        font-family: inherit;
        font-size: 10px;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        transition:
            background .12s ease,
            border-color .12s ease,
            color .12s ease;
    }

    .user-action:hover {
        background: #f5f8fb;
        border-color: #cbd7e3;
        color: #155a91;
    }

    .user-action-disable {
        color: #b9382e;
        border-color: #f0d3cf;
    }

    .user-action-disable:hover {
        background: #fff5f3;
        border-color: #e9c1bc;
        color: #a52f26;
    }

    .user-action-enable {
        color: #16804a;
        border-color: #cfe5d7;
    }

    .user-action-enable:hover {
        background: #f1faf4;
        border-color: #bcdcc7;
        color: #126c3e;
    }

    .user-current {
        color: #98a2b3;
        font-size: 9px;
        font-weight: 600;
    }


    /* =========================================================
       MENSAJES
    ========================================================== */

    .users-message {
        margin-bottom: 18px;
        padding: 11px 14px;
        border-radius: 7px;
        font-size: 11px;
    }

    .users-success {
        border: 1px solid #cfe5d7;
        background: #f1faf4;
        color: #287443;
    }

    .users-error {
        border: 1px solid #f0d3cf;
        background: #fff5f3;
        color: #b9382e;
    }


    /* =========================================================
       FOOTER
    ========================================================== */

    .users-card-footer {
        min-height: 48px;
        padding: 0 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-top: 1px solid #edf1f5;
        background: #fbfcfd;
    }

    .users-count {
        color: #98a2b3;
        font-size: 10px;
    }

    .users-count strong {
        color: #667085;
        font-weight: 600;
    }


    /* =========================================================
       EMPTY
    ========================================================== */

    .users-empty {
        padding: 55px 25px;
        text-align: center;
    }

    .users-empty-icon {
        width: 46px;
        height: 46px;
        margin: 0 auto 13px;
        border-radius: 10px;
        background: #eef4f8;
        color: #155a91;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 19px;
    }

    .users-empty-title {
        margin: 0;
        color: #344054;
        font-size: 14px;
        font-weight: 700;
    }

    .users-empty-text {
        max-width: 360px;
        margin: 6px auto 17px;
        color: #98a2b3;
        font-size: 11px;
        line-height: 1.5;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================== */

    @media (max-width: 900px) {

        .users-summary {
            grid-template-columns: repeat(2, 1fr);
        }

    }

    @media (max-width: 700px) {

        .users-header {
            flex-direction: column;
        }

        .users-header-actions {
            width: 100%;
        }

        .users-header-actions .btn {
            flex: 1;
        }

        .users-summary {
            grid-template-columns: 1fr;
        }

        .users-card-header {
            align-items: stretch;
            flex-direction: column;
        }

        .users-search {
            width: 100%;
        }

    }

</style>

@endpush


@section('content')

    <div class="users-header">

        <div>

            <h1 class="users-title">
                Usuarios
            </h1>

            <p class="users-subtitle">
                Administración de usuarios, roles y acceso al sistema.
            </p>

        </div>

        <div class="users-header-actions">

            <a
                href="{{ route('usuarios.create') }}"
                class="btn btn-primary"
            >
                + Nuevo usuario
            </a>

        </div>

    </div>


    @if(session('success'))

        <div class="users-message users-success">
            {{ session('success') }}
        </div>

    @endif


    @if(session('error'))

        <div class="users-message users-error">
            {{ session('error') }}
        </div>

    @endif


    <div class="users-summary">

        <div class="users-summary-card">

            <div class="users-summary-label">
                Total usuarios
            </div>

            <div class="users-summary-value">
                {{ $usuarios->count() }}
            </div>

            <div class="users-summary-description">
                Usuarios registrados en el sistema
            </div>

        </div>


        <div class="users-summary-card">

            <div class="users-summary-label">
                Usuarios activos
            </div>

            <div class="users-summary-value">
                {{ $usuarios->where('activo', true)->count() }}
            </div>

            <div class="users-summary-description">
                Con acceso habilitado
            </div>

        </div>


        <div class="users-summary-card">

            <div class="users-summary-label">
                Usuarios inactivos
            </div>

            <div class="users-summary-value">
                {{ $usuarios->where('activo', false)->count() }}
            </div>

            <div class="users-summary-description">
                Sin acceso al sistema
            </div>

        </div>

    </div>


    <section class="users-card">

        <div class="users-card-header">

            <div class="users-card-heading">

                <h2 class="users-card-title">
                    Registro de usuarios
                </h2>

                <p class="users-card-description">
                    Consulta y administra los usuarios registrados.
                </p>

            </div>


            <div class="users-search">

                <span class="users-search-icon">
                    ⌕
                </span>

                <input
                    type="text"
                    id="userTableSearch"
                    placeholder="Buscar usuario, correo o rol..."
                    autocomplete="off"
                >

            </div>

        </div>


        @if($usuarios->count())

            <div class="users-table-wrapper">

                <table
                    class="users-table"
                    id="usersTable"
                >

                    <thead>

                        <tr>

                            <th>
                                Usuario
                            </th>

                            <th>
                                Correo
                            </th>

                            <th>
                                Rol
                            </th>

                            <th>
                                Estado
                            </th>

                            <th>
                                Acciones
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($usuarios as $usuario)

                            @php
                                $partesNombre = preg_split(
                                    '/\s+/',
                                    trim($usuario->name)
                                );

                                $iniciales = '';

                                if (count($partesNombre) >= 2) {
                                    $iniciales =
                                        mb_strtoupper(
                                            mb_substr($partesNombre[0], 0, 1) .
                                            mb_substr($partesNombre[1], 0, 1)
                                        );
                                } else {
                                    $iniciales =
                                        mb_strtoupper(
                                            mb_substr($usuario->name, 0, 2)
                                        );
                                }

                                $rol =
                                    $usuario->roles->first()?->name
                                    ?? 'Sin rol';
                            @endphp

                            <tr
                                data-user-row
                                data-search="{{ strtolower(
                                    $usuario->name . ' ' .
                                    $usuario->email . ' ' .
                                    $rol . ' ' .
                                    ($usuario->activo ? 'activo' : 'inactivo')
                                ) }}"
                            >

                                <td>

                                    <div class="user-main">

                                        <div class="user-avatar">
                                            {{ $iniciales }}
                                        </div>

                                        <div>

                                            <div class="user-name">
                                                {{ $usuario->name }}
                                            </div>

                                            <div class="user-id">
                                                ID {{ $usuario->id }}
                                            </div>

                                        </div>

                                    </div>

                                </td>


                                <td>

                                    <span class="user-email">
                                        {{ $usuario->email }}
                                    </span>

                                </td>


                                <td>

                                    <span class="user-role">
                                        {{ $rol }}
                                    </span>

                                </td>


                                <td>

                                    @if($usuario->activo)

                                        <span class="user-status user-status-active">
                                            Activo
                                        </span>

                                    @else

                                        <span class="user-status user-status-inactive">
                                            Inactivo
                                        </span>

                                    @endif

                                </td>


                                <td>

                                    <div class="user-actions">

                                        <a
                                            href="{{ route('usuarios.edit', $usuario) }}"
                                            class="user-action"
                                        >
                                            Editar
                                        </a>


                                        @if(auth()->id() === $usuario->id)

                                            <span class="user-current">
                                                Sesión actual
                                            </span>

                                        @else

                                            <form
                                                action="{{ route('usuarios.estado', $usuario) }}"
                                                method="POST"
                                                style="display:inline;"
                                                onsubmit="return confirm('{{ $usuario->activo ? '¿Deseas desactivar este usuario?' : '¿Deseas activar este usuario?' }}');"
                                            >

                                                @csrf
                                                @method('PATCH')

                                                <button
                                                    type="submit"
                                                    class="user-action {{ $usuario->activo ? 'user-action-disable' : 'user-action-enable' }}"
                                                >
                                                    {{ $usuario->activo ? 'Desactivar' : 'Activar' }}
                                                </button>

                                            </form>

                                        @endif

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>


            <div class="users-card-footer">

                <div class="users-count">

                    Mostrando

                    <strong id="visibleUserCount">
                        {{ $usuarios->count() }}
                    </strong>

                    de

                    <strong>
                        {{ $usuarios->count() }}
                    </strong>

                    usuarios

                </div>

            </div>

        @else

            <div class="users-empty">

                <div class="users-empty-icon">
                    ◉
                </div>

                <h3 class="users-empty-title">
                    No hay usuarios registrados
                </h3>

                <p class="users-empty-text">
                    Crea el primer usuario para comenzar a administrar el acceso al sistema.
                </p>

                <a
                    href="{{ route('usuarios.create') }}"
                    class="btn btn-primary"
                >
                    + Crear primer usuario
                </a>

            </div>

        @endif

    </section>

@endsection


@push('scripts')

<script>

    document.addEventListener(
        'DOMContentLoaded',
        function () {

            const searchInput =
                document.getElementById(
                    'userTableSearch'
                );

            const rows =
                document.querySelectorAll(
                    '[data-user-row]'
                );

            const visibleCount =
                document.getElementById(
                    'visibleUserCount'
                );


            if (
                !searchInput ||
                !rows.length
            ) {
                return;
            }


            searchInput.addEventListener(
                'input',
                function () {

                    const search =
                        this.value
                            .toLowerCase()
                            .trim();

                    let visible = 0;


                    rows.forEach(
                        function (row) {

                            const content =
                                (
                                    row.dataset.search ||
                                    ''
                                ).toLowerCase();

                            const matches =
                                content.includes(
                                    search
                                );

                            row.style.display =
                                matches
                                    ? ''
                                    : 'none';

                            if (matches) {
                                visible++;
                            }

                        }
                    );


                    if (visibleCount) {
                        visibleCount.textContent =
                            visible;
                    }

                }
            );

        }
    );

</script>

@endpush