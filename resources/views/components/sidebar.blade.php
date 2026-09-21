<aside class="sidebar" id="sidebar">

    {{-- =====================================================
         BRAND
    ====================================================== --}}

    <div class="sidebar-brand">

        <div class="sidebar-logo">
            SG
        </div>

        <div class="sidebar-brand-text">

            <strong>
                Sistema Gestión
            </strong>

            <span>
                Gestión empresarial
            </span>

        </div>

    </div>


    {{-- =====================================================
         BOTÓN CONTRAER / EXPANDIR
    ====================================================== --}}

    <button
        type="button"
        class="sidebar-toggle"
        id="sidebarToggle"
        aria-label="Contraer menú"
        title="Contraer menú"
    >
        ‹
    </button>


    {{-- =====================================================
         MENÚ
    ====================================================== --}}

    <nav class="sidebar-menu">


        {{-- =================================================
             PRINCIPAL
        ================================================== --}}

        <div class="sidebar-section-title">
            Principal
        </div>


        {{-- INICIO --}}

<a
    href="{{ route('inicio') }}"
    class="sidebar-item {{ request()->routeIs('inicio') ? 'active' : '' }}"
    title="Inicio"
>

    <span class="sidebar-icon">
        ⌂
    </span>

    <span class="sidebar-label">
        Inicio
    </span>

</a>


        {{-- OPERACIONES --}}

        <a
            href="{{ route('operaciones.index') }}"
            class="sidebar-item {{ request()->routeIs('operaciones.*') ? 'active' : '' }}"
            title="Operaciones"
        >

            <span class="sidebar-icon">
                ▣
            </span>

            <span class="sidebar-label">
                Operaciones
            </span>

        </a>


        {{-- CLIENTES --}}

        <a
            href="{{ route('clientes.index') }}"
            class="sidebar-item {{ request()->routeIs('clientes.*') ? 'active' : '' }}"
            title="Clientes"
        >

            <span class="sidebar-icon">
                ◉
            </span>

            <span class="sidebar-label">
                Clientes
            </span>

        </a>


        {{-- ENTREGAS --}}

        <a
            href="{{ route('entregas.index') }}"
            class="sidebar-item {{ request()->routeIs('entregas.*') ? 'active' : '' }}"
            title="Entregas"
        >

            <span class="sidebar-icon">
                ▤
            </span>

            <span class="sidebar-label">
                Entregas
            </span>

        </a>


        {{-- =================================================
             FINANZAS
        ================================================== --}}

        <div class="sidebar-section-title">
            Finanzas
        </div>


        {{-- FACTURAS --}}

        <a
            href="{{ route('facturas.index') }}"
            class="sidebar-item {{ request()->routeIs('facturas.*') ? 'active' : '' }}"
            title="Facturas"
        >

            <span class="sidebar-icon">
                ▥
            </span>

            <span class="sidebar-label">
                Facturas
            </span>

        </a>


        {{-- FACTORING --}}

        <a
            href="{{ route('factorings.index') }}"
            class="sidebar-item {{ request()->routeIs('factorings.*') ? 'active' : '' }}"
            title="Factoring"
        >

            <span class="sidebar-icon">
                ◇
            </span>

            <span class="sidebar-label">
                Factoring
            </span>

        </a>


        {{-- EMPRESAS DE FACTORING --}}

        <a
            href="{{ route('empresas-factoring.index') }}"
            class="sidebar-item {{ request()->routeIs('empresas-factoring.*') ? 'active' : '' }}"
            title="Empresas de factoring"
        >

            <span class="sidebar-icon">
                ◆
            </span>

            <span class="sidebar-label">
                Empresas factoring
            </span>

        </a>


        {{-- MORA --}}

        <a
            href="{{ route('moras.index') }}"
            class="sidebar-item {{ request()->routeIs('moras.*') ? 'active' : '' }}"
            title="Mora"
        >

            <span class="sidebar-icon">
                △
            </span>

            <span class="sidebar-label">
                Mora
            </span>

        </a>


        {{-- GASTOS --}}

        <a
            href="{{ route('gastos.index') }}"
            class="sidebar-item {{ request()->routeIs('gastos.*') ? 'active' : '' }}"
            title="Gastos"
        >

            <span class="sidebar-icon">
                ▤
            </span>

            <span class="sidebar-label">
                Gastos
            </span>

        </a>


        {{-- NOTAS DE CRÉDITO --}}

        <a
            href="{{ route('notas-credito-proveedores.index') }}"
            class="sidebar-item {{ request()->routeIs('notas-credito-proveedores.*') ? 'active' : '' }}"
            title="Notas de crédito de proveedores"
        >

            <span class="sidebar-icon">
                ◫
            </span>

            <span class="sidebar-label">
                Notas de crédito
            </span>

        </a>


        {{-- CUADRATURAS - PENDIENTE --}}

        <div
            class="sidebar-item sidebar-item-disabled"
            title="Módulo pendiente de implementación"
        >

            <span class="sidebar-icon">
                ≡
            </span>

            <span class="sidebar-label sidebar-label-with-badge">
                <span>
                    Cuadraturas
                </span>

                <span class="sidebar-pending-badge">
                    Pendiente
                </span>
            </span>

        </div>


        {{-- =================================================
             PERSONAL
        ================================================== --}}

        <div class="sidebar-section-title">
            Personal
        </div>


        {{-- TRABAJADORES --}}

        <a
            href="{{ route('trabajadores.index') }}"
            class="sidebar-item {{ request()->routeIs('trabajadores.*') ? 'active' : '' }}"
            title="Personal"
        >

            <span class="sidebar-icon">
                ♙
            </span>

            <span class="sidebar-label">
                Trabajadores
            </span>

        </a>


        {{-- CONTRATOS --}}

        <a
            href="{{ route('trabajadores.index') }}"
            class="sidebar-item
                {{
                    request()->routeIs('trabajadores.contratos.*') ||
                    request()->routeIs('trabajadores.contratos.modificaciones.*')
                        ? 'active'
                        : ''
                }}"
            title="Contratos"
        >

            <span class="sidebar-icon">
                ▧
            </span>

            <span class="sidebar-label">
                Contratos
            </span>

        </a>


        {{-- =================================================
             TRANSPORTE
        ================================================== --}}

        <div class="sidebar-section-title">
            Transporte
        </div>


        {{-- TRANSPORTISTAS --}}

        <a
            href="{{ route('transportistas.index') }}"
            class="sidebar-item {{ request()->routeIs('transportistas.*') ? 'active' : '' }}"
            title="Transportistas"
        >

            <span class="sidebar-icon">
                □
            </span>

            <span class="sidebar-label">
                Transportistas
            </span>

        </a>


        {{-- VEHÍCULOS --}}

        <a
            href="{{ route('vehiculos.index') }}"
            class="sidebar-item {{ request()->routeIs('vehiculos.*') ? 'active' : '' }}"
            title="Vehículos"
        >

            <span class="sidebar-icon">
                ▱
            </span>

            <span class="sidebar-label">
                Vehículos
            </span>

        </a>


        {{-- SERVICIOS DE TRANSPORTE --}}

        <a
            href="{{ route('servicios-transporte.index') }}"
            class="sidebar-item {{ request()->routeIs('servicios-transporte.*') ? 'active' : '' }}"
            title="Servicios de transporte"
        >

            <span class="sidebar-icon">
                ⇄
            </span>

            <span class="sidebar-label">
                Servicios transporte
            </span>

        </a>


        {{-- =================================================
             PROVEEDORES
        ================================================== --}}

        <div class="sidebar-section-title">
            Proveedores
        </div>


        {{-- PROVEEDORES --}}

        <a
            href="{{ route('proveedores.index') }}"
            class="sidebar-item {{ request()->routeIs('proveedores.*') ? 'active' : '' }}"
            title="Proveedores"
        >

            <span class="sidebar-icon">
                ◈
            </span>

            <span class="sidebar-label">
                Proveedores
            </span>

        </a>


        {{-- =================================================
             GESTIÓN
        ================================================== --}}

        <div class="sidebar-section-title">
            Gestión
        </div>


        {{-- RECLAMOS Y JUICIOS - PENDIENTE --}}

        <div
            class="sidebar-item sidebar-item-disabled"
            title="Módulo pendiente de implementación"
        >

            <span class="sidebar-icon">
                ◌
            </span>

            <span class="sidebar-label sidebar-label-with-badge">

                <span>
                    Reclamos y Juicios
                </span>

                <span class="sidebar-pending-badge">
                    Pendiente
                </span>

            </span>

        </div>


        {{-- =================================================
             DOCUMENTACIÓN
        ================================================== --}}

        <div class="sidebar-section-title">
            Documentación
        </div>


        {{-- DOCUMENTOS --}}

        <a
            href="{{ route('documentos.index') }}"
            class="sidebar-item {{ request()->routeIs('documentos.*') ? 'active' : '' }}"
            title="Documentos"
        >

            <span class="sidebar-icon">
                □
            </span>

            <span class="sidebar-label">
                Documentos
            </span>

        </a>


        {{-- REPORTES - PENDIENTE --}}

        <div
            class="sidebar-item sidebar-item-disabled"
            title="Módulo pendiente de implementación"
        >

            <span class="sidebar-icon">
                ▦
            </span>

            <span class="sidebar-label sidebar-label-with-badge">

                <span>
                    Reportes
                </span>

                <span class="sidebar-pending-badge">
                    Pendiente
                </span>

            </span>

        </div>

    </nav>


    {{-- =====================================================
         USUARIO
    ====================================================== --}}

    <div class="sidebar-user">

        <div class="sidebar-user-avatar">
            AD
        </div>

        <div class="sidebar-user-info">

            <strong>
                Administrador
            </strong>

            <span>
                Administración
            </span>

        </div>

    </div>

</aside>


{{-- =========================================================
     OVERLAY PARA MÓVIL
========================================================== --}}

<div
    class="sidebar-overlay"
    id="sidebarOverlay"
></div>


<style>

    /* =========================================================
       SIDEBAR PRINCIPAL
    ========================================================== */

    .sidebar {

        width: 250px;

        height: 100vh;

        position: fixed;

        left: 0;

        top: 0;

        bottom: 0;

        z-index: 1000;

        display: flex;

        flex-direction: column;

        background: #102f50;

        color: #ffffff;

        transition:
            width .22s ease,
            transform .22s ease;

        box-shadow:
            2px 0 10px rgba(16,47,80,.10);

    }


    /* =========================================================
       CABECERA
    ========================================================== */

    .sidebar-brand {

        height: 76px;

        display: flex;

        align-items: center;

        padding: 0 20px;

        border-bottom:
            1px solid rgba(255,255,255,.10);

        flex-shrink: 0;

    }

    .sidebar-logo {

        width: 40px;

        height: 40px;

        min-width: 40px;

        border-radius: 9px;

        background: #155a91;

        display: flex;

        align-items: center;

        justify-content: center;

        color: #ffffff;

        font-size: 14px;

        font-weight: 700;

    }

    .sidebar-brand-text {

        margin-left: 11px;

        overflow: hidden;

        white-space: nowrap;

        transition:
            opacity .18s ease,
            width .22s ease;

    }

    .sidebar-brand-text strong {

        display: block;

        color: #ffffff;

        font-size: 14px;

        font-weight: 700;

    }

    .sidebar-brand-text span {

        display: block;

        margin-top: 3px;

        color:
            rgba(255,255,255,.62);

        font-size: 9px;

    }


    /* =========================================================
       BOTÓN CONTRAER
    ========================================================== */

    .sidebar-toggle {

        position: absolute;

        right: 14px;

        top: 21px;

        width: 34px;

        height: 34px;

        padding: 0;

        border:
            1px solid rgba(255,255,255,.20);

        border-radius: 8px;

        background:
            rgba(255,255,255,.08);

        color: #ffffff;

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 21px;

        line-height: 1;

        cursor: pointer;

        z-index: 20;

        transition:
            background .15s ease,
            border-color .15s ease,
            transform .22s ease;

    }

    .sidebar-toggle:hover {

        background:
            rgba(255,255,255,.16);

        border-color:
            rgba(255,255,255,.32);

    }


    /* =========================================================
       MENÚ
    ========================================================== */

    .sidebar-menu {

        flex: 1;

        padding:
            19px 12px;

        overflow-y: auto;

        overflow-x: hidden;

        scrollbar-width: thin;

        scrollbar-color:
            rgba(255,255,255,.28)
            rgba(255,255,255,.04);

    }


    /* =========================================================
       SCROLLBAR
    ========================================================== */

    .sidebar-menu::-webkit-scrollbar {

        width: 7px;

    }

    .sidebar-menu::-webkit-scrollbar-track {

        background:
            rgba(255,255,255,.035);

        border-radius: 10px;

    }

    .sidebar-menu::-webkit-scrollbar-thumb {

        background:
            rgba(255,255,255,.28);

        border-radius: 10px;

        border:
            1px solid rgba(16,47,80,.20);

    }

    .sidebar-menu::-webkit-scrollbar-thumb:hover {

        background:
            rgba(255,255,255,.42);

    }

    .sidebar-menu::-webkit-scrollbar-button {

        display: none;

        width: 0;

        height: 0;

    }


    /* =========================================================
       SECCIONES
    ========================================================== */

    .sidebar-section-title {

        padding:
            13px 11px 8px;

        color:
            rgba(255,255,255,.68);

        font-size: 9px;

        text-transform: uppercase;

        letter-spacing: .09em;

        font-weight: 700;

        white-space: nowrap;

        overflow: hidden;

        transition:
            opacity .15s ease;

    }


    /* =========================================================
       ITEMS
    ========================================================== */

    .sidebar-item {

        min-height: 40px;

        display: flex;

        align-items: center;

        gap: 10px;

        padding:
            9px 11px;

        margin-bottom: 3px;

        border-radius: 7px;

        color: #ffffff;

        font-size: 12px;

        font-weight: 500;

        transition:
            background .15s ease,
            color .15s ease;

        white-space: nowrap;

        overflow: hidden;

    }

    .sidebar-item:hover {

        background:
            rgba(255,255,255,.09);

        color: #ffffff;

    }

    .sidebar-item.active {

        background: #155a91;

        color: #ffffff;

        font-weight: 600;

    }

    .sidebar-icon {

        width: 21px;

        min-width: 21px;

        text-align: center;

        color: #ffffff;

        font-size: 14px;

        opacity: 1;

    }

    .sidebar-label {

        flex: 1;

        min-width: 0;

        overflow: hidden;

        text-overflow: ellipsis;

        transition:
            opacity .15s ease,
            width .22s ease;

    }


    /* =========================================================
       ITEMS PENDIENTES
    ========================================================== */

    .sidebar-item-disabled {

        cursor: default;

        color:
            rgba(255,255,255,.58);

    }

    .sidebar-item-disabled:hover {

        background:
            rgba(255,255,255,.035);

        color:
            rgba(255,255,255,.58);

    }

    .sidebar-item-disabled .sidebar-icon {

        opacity: .58;

    }

    .sidebar-label-with-badge {

        display: flex;

        align-items: center;

        justify-content: space-between;

        gap: 8px;

    }

    .sidebar-pending-badge {

        padding: 2px 5px;

        border-radius: 4px;

        background:
            rgba(255,255,255,.10);

        color:
            rgba(255,255,255,.62);

        font-size: 7px;

        font-weight: 600;

        text-transform: uppercase;

        letter-spacing: .03em;

        flex-shrink: 0;

    }


    /* =========================================================
       USUARIO
    ========================================================== */

    .sidebar-user {

        min-height: 68px;

        padding:
            14px 15px;

        border-top:
            1px solid rgba(255,255,255,.10);

        display: flex;

        align-items: center;

        gap: 10px;

        flex-shrink: 0;

        overflow: hidden;

    }

    .sidebar-user-avatar {

        width: 35px;

        height: 35px;

        min-width: 35px;

        border-radius: 50%;

        background:
            rgba(255,255,255,.13);

        color: #ffffff;

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 10px;

        font-weight: 700;

    }

    .sidebar-user-info {

        overflow: hidden;

        white-space: nowrap;

        transition:
            opacity .15s ease;

    }

    .sidebar-user-info strong {

        display: block;

        color: #ffffff;

        font-size: 11px;

        font-weight: 600;

    }

    .sidebar-user-info span {

        display: block;

        margin-top: 3px;

        color:
            rgba(255,255,255,.55);

        font-size: 9px;

    }


    /* =========================================================
       SIDEBAR CONTRAÍDO
    ========================================================== */

    body.sidebar-collapsed .sidebar {

        width: 72px;

    }

    body.sidebar-collapsed .main-content {

        margin-left: 72px;

    }

    body.sidebar-collapsed .sidebar-brand {

        justify-content: center;

        padding: 0;

    }

    body.sidebar-collapsed .sidebar-brand-text {

        width: 0;

        margin-left: 0;

        opacity: 0;

    }

    body.sidebar-collapsed .sidebar-toggle {

        right: 19px;

        transform:
            rotate(180deg);

    }

    body.sidebar-collapsed .sidebar-section-title {

        height: 10px;

        margin:
            9px 0;

        padding: 0;

        opacity: 0;

    }

    body.sidebar-collapsed .sidebar-item {

        justify-content: center;

        padding:
            9px 0;

    }

    body.sidebar-collapsed .sidebar-label {

        width: 0;

        opacity: 0;

        flex: 0;

    }

    body.sidebar-collapsed .sidebar-pending-badge {

        display: none;

    }

    body.sidebar-collapsed .sidebar-user {

        justify-content: center;

        padding:
            14px 0;

    }

    body.sidebar-collapsed .sidebar-user-info {

        width: 0;

        opacity: 0;

    }


    /* =========================================================
       OVERLAY MOBILE
    ========================================================== */

    .sidebar-overlay {

        display: none;

        position: fixed;

        inset: 0;

        z-index: 900;

        background:
            rgba(0,0,0,.38);

        opacity: 0;

        transition:
            opacity .22s ease;

    }


    /* =========================================================
       TABLET
    ========================================================== */

    @media (max-width: 1000px) {

        .sidebar {

            width: 220px;

        }

        .main-content {

            margin-left: 220px;

        }

        body.sidebar-collapsed .main-content {

            margin-left: 72px;

        }

    }


    /* =========================================================
       MÓVIL
    ========================================================== */

    @media (max-width: 800px) {

        .sidebar {

            width: 250px;

            transform:
                translateX(-100%);

            box-shadow:
                5px 0 20px rgba(0,0,0,.20);

        }

        .main-content {

            margin-left: 0 !important;

        }

        body.sidebar-mobile-open .sidebar {

            transform:
                translateX(0);

        }

        .sidebar-overlay {

            display: block;

            pointer-events: none;

        }

        body.sidebar-mobile-open .sidebar-overlay {

            opacity: 1;

            pointer-events: auto;

        }

        .sidebar-toggle {

            display: none;

        }

    }

</style>


<script>

    document.addEventListener(
        'DOMContentLoaded',
        function () {

            const sidebarToggle =
                document.getElementById(
                    'sidebarToggle'
                );


            const sidebarOverlay =
                document.getElementById(
                    'sidebarOverlay'
                );


            /*
             * Recuperar estado del sidebar
             * en escritorio.
             */

            if (
                window.innerWidth > 800 &&
                localStorage.getItem(
                    'sidebarCollapsed'
                ) === 'true'
            ) {

                document.body.classList.add(
                    'sidebar-collapsed'
                );

            }


            /*
             * Contraer / expandir.
             */

            if (sidebarToggle) {

                sidebarToggle.addEventListener(
                    'click',
                    function () {

                        document.body.classList.toggle(
                            'sidebar-collapsed'
                        );


                        const collapsed =
                            document.body.classList.contains(
                                'sidebar-collapsed'
                            );


                        localStorage.setItem(
                            'sidebarCollapsed',
                            collapsed
                        );

                    }
                );

            }


            /*
             * Cerrar menú móvil
             * al tocar el fondo.
             */

            if (sidebarOverlay) {

                sidebarOverlay.addEventListener(
                    'click',
                    function () {

                        document.body.classList.remove(
                            'sidebar-mobile-open'
                        );

                    }
                );

            }


            /*
             * Cerrar menú móvil
             * al seleccionar una opción real.
             */

            const sidebarLinks =
                document.querySelectorAll(
                    '.sidebar-item[href]'
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
             * ESC cierra el menú móvil.
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


            /*
             * Al volver a escritorio,
             * cerrar estado móvil.
             */

            window.addEventListener(
                'resize',
                function () {

                    if (
                        window.innerWidth > 800
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