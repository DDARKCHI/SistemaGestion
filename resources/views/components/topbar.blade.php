<header class="topbar">

    <div class="topbar-left">

        <button
            type="button"
            class="mobile-menu-button"
            id="mobileMenuButton"
            aria-label="Abrir menú"
            title="Abrir menú"
        >
            ☰
        </button>

        <div class="topbar-title">
            @yield(
                'topbar_title',
                'Sistema de Gestión'
            )
        </div>

    </div>

    <div class="topbar-right">

        <div class="topbar-search">

            <span class="topbar-search-icon">
                ⌕
            </span>

            <input
                type="text"
                placeholder="Buscar..."
            >

        </div>

        <button
            type="button"
            class="topbar-notification"
            title="Notificaciones"
        >
            ♧

            <span class="notification-dot"></span>
        </button>

        @auth

            @php
                $usuario = auth()->user();

                $nombre = $usuario->name;

                $rol = $usuario->getRoleNames()->first() ?? 'Sin rol';

                $partesNombre = preg_split('/\s+/', trim($nombre));

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
                            mb_substr($nombre, 0, 2)
                        );
                }
            @endphp

            <div class="topbar-user-wrapper">

                <button
                    type="button"
                    class="topbar-user"
                    id="userMenuButton"
                    aria-expanded="false"
                    aria-controls="userDropdown"
                >

                    <div class="topbar-user-avatar">
                        {{ $iniciales }}
                    </div>

                    <div class="topbar-user-info">

                        <strong>
                            {{ $nombre }}
                        </strong>

                        <span>
                            {{ $rol }}
                        </span>

                    </div>

                    <span class="topbar-user-arrow">
                        ▾
                    </span>

                </button>

                <div
                    class="topbar-user-dropdown"
                    id="userDropdown"
                >

                    <div class="topbar-dropdown-header">

                        <strong>
                            {{ $nombre }}
                        </strong>

                        <span>
                            {{ $usuario->email }}
                        </span>

                    </div>

                   <div class="topbar-dropdown-role">

    <span class="topbar-role-label">
        Rol de usuario
    </span>

    <strong class="topbar-role-value">
        {{ $rol }}
    </strong>

</div>

                    <form
                        method="POST"
                        action="{{ route('logout') }}"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="topbar-logout-button"
                        >
                            <span>
                                ↪
                            </span>

                            Cerrar sesión
                        </button>

                    </form>

                </div>

            </div>

        @endauth

    </div>

</header>


<style>

    .topbar {

        height: 76px;

        background: #ffffff;

        border-bottom:
            1px solid #e2e8f0;

        display: flex;

        align-items: center;

        justify-content: space-between;

        padding:
            0 32px;

        position: sticky;

        top: 0;

        z-index: 500;

    }


    .topbar-left {

        display: flex;

        align-items: center;

        gap: 13px;

        min-width: 0;

    }


    .topbar-title {

        color: #172033;

        font-size: 14px;

        font-weight: 600;

        white-space: nowrap;

        overflow: hidden;

        text-overflow: ellipsis;

    }


    .mobile-menu-button {

        display: none;

        width: 38px;

        height: 38px;

        padding: 0;

        border: 1px solid #dce3eb;

        border-radius: 7px;

        background: #ffffff;

        color: #155a91;

        font-size: 19px;

        cursor: pointer;

        align-items: center;

        justify-content: center;

    }


    .mobile-menu-button:hover {

        background: #eaf3fa;

        border-color: #c8d9e7;

    }


    .topbar-right {

        display: flex;

        align-items: center;

        gap: 18px;

    }


    .topbar-search {

        width: 250px;

        height: 37px;

        position: relative;

    }


    .topbar-search input {

        width: 100%;

        height: 100%;

        padding:
            0 12px 0 34px;

        border:
            1px solid #dce3eb;

        border-radius: 7px;

        background: #ffffff;

        color: #344054;

        font-size: 11px;

        outline: none;

    }


    .topbar-search input::placeholder {

        color: #98a2b3;

    }


    .topbar-search input:focus {

        border-color: #155a91;

        box-shadow:
            0 0 0 2px rgba(21,90,145,.08);

    }


    .topbar-search-icon {

        position: absolute;

        left: 11px;

        top: 50%;

        transform:
            translateY(-50%);

        color: #8a94a6;

        font-size: 14px;

        pointer-events: none;

        z-index: 2;

    }


    .topbar-notification {

        position: relative;

        width: 35px;

        height: 35px;

        border: none;

        background: transparent;

        color: #667085;

        font-size: 17px;

        cursor: pointer;

        border-radius: 7px;

    }


    .topbar-notification:hover {

        background: #f4f7fb;

        color: #155a91;

    }


    .notification-dot {

        position: absolute;

        top: 7px;

        right: 7px;

        width: 6px;

        height: 6px;

        border-radius: 50%;

        background: #c0392b;

        border: 1px solid #ffffff;

    }


    .topbar-user-wrapper {

        position: relative;

    }


    .topbar-user {

        display: flex;

        align-items: center;

        gap: 9px;

        padding:
            0 0 0 18px;

        border: none;

        border-left:
            1px solid #e2e8f0;

        background: transparent;

        cursor: pointer;

        text-align: left;

    }


    .topbar-user-avatar {

        width: 35px;

        height: 35px;

        border-radius: 50%;

        background: #eaf3fa;

        color: #155a91;

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 10px;

        font-weight: 700;

        flex-shrink: 0;

    }


    .topbar-user-info {

        white-space: nowrap;

    }


    .topbar-user-info strong {

        display: block;

        max-width: 160px;

        overflow: hidden;

        text-overflow: ellipsis;

        color: #344054;

        font-size: 11px;

        font-weight: 600;

    }


    .topbar-user-info span {

        display: block;

        margin-top: 2px;

        color: #98a2b3;

        font-size: 9px;

    }


    .topbar-user-arrow {

        margin-left: 2px;

        color: #98a2b3;

        font-size: 10px;

        transition:
            transform .15s ease;

    }


    .topbar-user.menu-open
    .topbar-user-arrow {

        transform:
            rotate(180deg);

    }


    .topbar-user-dropdown {

        display: none;

        position: absolute;

        top: calc(100% + 12px);

        right: 0;

        width: 235px;

        background: #ffffff;

        border:
            1px solid #e2e8f0;

        border-radius: 9px;

        box-shadow:
            0 10px 30px rgba(16, 47, 80, .12);

        overflow: hidden;

        z-index: 1000;

    }


    .topbar-user-dropdown.open {

        display: block;

    }


    .topbar-dropdown-header {

        padding:
            15px 16px 13px;

        border-bottom:
            1px solid #edf1f5;

    }


    .topbar-dropdown-header strong {

        display: block;

        color: #344054;

        font-size: 11px;

        font-weight: 600;

    }


    .topbar-dropdown-header span {

        display: block;

        margin-top: 4px;

        color: #98a2b3;

        font-size: 9px;

        word-break: break-word;

    }


    .topbar-dropdown-role {

    display: flex;

    flex-direction: column;

    align-items: flex-start;

    gap: 4px;

    padding:
        11px 16px 13px;

    border-bottom:
        1px solid #edf1f5;

}


.topbar-role-label {

    color: #98a2b3;

    font-size: 9px;

}


.topbar-role-value {

    color: #344054;

    font-size: 11px;

    font-weight: 600;

}


    .topbar-user-dropdown form {

        margin: 0;

    }


    .topbar-logout-button {

        width: 100%;

        display: flex;

        align-items: center;

        gap: 8px;

        padding:
            12px 16px;

        border: none;

        background: #ffffff;

        color: #c0392b;

        font-size: 10px;

        font-weight: 600;

        text-align: left;

        cursor: pointer;

    }


    .topbar-logout-button:hover {

        background: #fff1ef;

    }


    @media (max-width: 800px) {

        .topbar {

            height: 64px;

            padding:
                0 15px;

        }


        .mobile-menu-button {

            display: flex;

        }


        .topbar-search {

            display: none;

        }


        .topbar-right {

            gap: 8px;

        }


        .topbar-notification {

            display: none;

        }


        .topbar-user {

            padding-left: 0;

            border-left: none;

        }


        .topbar-user-info,
        .topbar-user-arrow {

            display: none;

        }


        .topbar-user-avatar {

            width: 34px;

            height: 34px;

        }


        .topbar-title {

            font-size: 13px;

        }


        .topbar-user-dropdown {

            right: 0;

            width: 220px;

        }

    }


    @media (max-width: 420px) {

        .topbar-title {

            max-width: 180px;

        }

    }

</style>


<script>

    document.addEventListener(
        'DOMContentLoaded',
        function () {

            const mobileMenuButton =
                document.getElementById(
                    'mobileMenuButton'
                );

            const userMenuButton =
                document.getElementById(
                    'userMenuButton'
                );

            const userDropdown =
                document.getElementById(
                    'userDropdown'
                );


            if (mobileMenuButton) {

                mobileMenuButton.addEventListener(
                    'click',
                    function () {

                        document.body.classList.toggle(
                            'sidebar-mobile-open'
                        );

                    }
                );

            }


            if (
                userMenuButton &&
                userDropdown
            ) {

                userMenuButton.addEventListener(
                    'click',
                    function (event) {

                        event.stopPropagation();

                        const abierto =
                            userDropdown.classList.toggle(
                                'open'
                            );

                        userMenuButton.classList.toggle(
                            'menu-open',
                            abierto
                        );

                        userMenuButton.setAttribute(
                            'aria-expanded',
                            abierto
                                ? 'true'
                                : 'false'
                        );

                    }
                );


                document.addEventListener(
                    'click',
                    function (event) {

                        if (
                            !userDropdown.contains(event.target) &&
                            !userMenuButton.contains(event.target)
                        ) {

                            userDropdown.classList.remove(
                                'open'
                            );

                            userMenuButton.classList.remove(
                                'menu-open'
                            );

                            userMenuButton.setAttribute(
                                'aria-expanded',
                                'false'
                            );

                        }

                    }
                );

            }


            const sidebarLinks =
                document.querySelectorAll(
                    '.sidebar-item'
                );


            sidebarLinks.forEach(
                function (link) {

                    link.addEventListener(
                        'click',
                        function () {

                            if (
                                window.innerWidth <= 800
                            ) {

                                document.body.classList.remove(
                                    'sidebar-mobile-open'
                                );

                            }

                        }
                    );

                }
            );


            document.addEventListener(
                'keydown',
                function (event) {

                    if (
                        event.key === 'Escape'
                    ) {

                        document.body.classList.remove(
                            'sidebar-mobile-open'
                        );

                        if (userDropdown) {

                            userDropdown.classList.remove(
                                'open'
                            );

                        }

                        if (userMenuButton) {

                            userMenuButton.classList.remove(
                                'menu-open'
                            );

                            userMenuButton.setAttribute(
                                'aria-expanded',
                                'false'
                            );

                        }

                    }

                }
            );

        }
    );

</script>