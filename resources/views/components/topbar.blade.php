<header class="topbar">

    {{-- =====================================================
         IZQUIERDA
    ====================================================== --}}

    <div class="topbar-left">

        {{-- BOTÓN MOBILE --}}

        <button
            type="button"
            class="mobile-menu-button"
            id="mobileMenuButton"
            aria-label="Abrir menú"
            title="Abrir menú"
        >
            ☰
        </button>


        {{-- TÍTULO --}}

        <div class="topbar-title">

            @yield(
                'topbar_title',
                'Sistema de Gestión'
            )

        </div>

    </div>


    {{-- =====================================================
         DERECHA
    ====================================================== --}}

    <div class="topbar-right">

        {{-- BUSCADOR --}}

        <div class="topbar-search">

            <span class="topbar-search-icon">
                ⌕
            </span>

            <input
                type="text"
                placeholder="Buscar..."
            >

        </div>


        {{-- NOTIFICACIONES --}}

        <button
            type="button"
            class="topbar-notification"
            title="Notificaciones"
        >
            ♧

            <span class="notification-dot"></span>

        </button>


        {{-- USUARIO --}}

        <div class="topbar-user">

            <div class="topbar-user-avatar">
                AD
            </div>

            <div class="topbar-user-info">

                <strong>
                    Administrador
                </strong>

                <span>
                    Administración
                </span>

            </div>

            <span class="topbar-user-arrow">
                ▾
            </span>

        </div>

    </div>

</header>


<style>

    /* =========================================================
       TOPBAR
    ========================================================== */

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


    /* =========================================================
       LEFT
    ========================================================== */

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


    /* =========================================================
       MOBILE BUTTON
    ========================================================== */

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


    /* =========================================================
       RIGHT
    ========================================================== */

    .topbar-right {

        display: flex;

        align-items: center;

        gap: 18px;

    }


    /* =========================================================
       SEARCH
    ========================================================== */

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


    /* =========================================================
       NOTIFICATION
    ========================================================== */

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


    /* =========================================================
       USER
    ========================================================== */

    .topbar-user {

        display: flex;

        align-items: center;

        gap: 9px;

        padding-left: 18px;

        border-left:
            1px solid #e2e8f0;

        cursor: pointer;

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

    }


    .topbar-user-info {

        white-space: nowrap;

    }


    .topbar-user-info strong {

        display: block;

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

    }


    /* =========================================================
       MOBILE
    ========================================================== */

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

    }


    /* =========================================================
       VERY SMALL MOBILE
    ========================================================== */

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


            /*
             * Cerrar menú móvil cuando se
             * selecciona una opción.
             */

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


            /*
             * Cerrar menú móvil con ESC.
             */

            document.addEventListener(
                'keydown',
                function (event) {

                    if (
                        event.key === 'Escape'
                    ) {

                        document.body.classList.remove(
                            'sidebar-mobile-open'
                        );

                    }

                }
            );

        }
    );

</script>