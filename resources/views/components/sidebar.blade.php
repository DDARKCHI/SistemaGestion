<aside class="sidebar" id="sidebar">

    {{-- =====================================================

         BRAND

    ====================================================== --}}

    <div class="sidebar-brand">

        <a

            href="{{ route('inicio') }}"

            class="sidebar-brand-link"

            aria-label="Inversiones Sur"

        >

            <img

                src="{{ asset('images/logo-inversiones-sur.png') }}"

                alt="Inversiones Sur Limitada"

                class="sidebar-logo-full"

            >

            <img

                src="{{ asset('images/icono-inversiones-sur.png') }}"

                alt="Inversiones Sur"

                class="sidebar-logo-icon"

            >

        </a>

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

    <nav class="sidebar-menu" id="sidebarMenu">

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

@can('ver notas credito proveedores')

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

@endcan

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

                {{-- =================================================

             CONFIGURACIÓN

        ================================================== --}}

        @role('Administrador')

            <div class="sidebar-section-title">

                Configuración

            </div>

            {{-- USUARIOS --}}

            <a

                href="{{ route('usuarios.index') }}"

                class="sidebar-item {{ request()->routeIs('usuarios.*') ? 'active' : '' }}"

                title="Usuarios"

            >

                <span class="sidebar-icon">

                    ♙

                </span>

                <span class="sidebar-label">

                    Usuarios

                </span>

            </a>

        @endrole

    </nav>
<div

        class="sidebar-flyout"

        id="sidebarFlyout"

        aria-hidden="true"

    >

        <div

            class="sidebar-flyout-title"

            id="sidebarFlyoutTitle"

        ></div>

        <div

            class="sidebar-flyout-actions"

            id="sidebarFlyoutActions"

        ></div>

    </div>

       {{-- =====================================================

         USUARIO

    ====================================================== --}}

    @auth

        @php

            $sidebarUsuario = auth()->user();

            $sidebarRol =

                $sidebarUsuario->getRoleNames()->first()

                ?? 'Sin rol';

            $sidebarPartesNombre =

                preg_split(

                    '/\s+/',

                    trim($sidebarUsuario->name)

                );

            if (count($sidebarPartesNombre) >= 2) {

                $sidebarIniciales =

                    mb_strtoupper(

                        mb_substr($sidebarPartesNombre[0], 0, 1) .

                        mb_substr($sidebarPartesNombre[1], 0, 1)

                    );

            } else {

                $sidebarIniciales =

                    mb_strtoupper(

                        mb_substr($sidebarUsuario->name, 0, 2)

                    );

            }

        @endphp

        <div class="sidebar-user">

            <div class="sidebar-user-avatar">

                {{ $sidebarIniciales }}

            </div>

            <div class="sidebar-user-info">

                <strong>

                    {{ $sidebarUsuario->name }}

                </strong>

                <span>

                    {{ $sidebarRol }}

                </span>

            </div>

        </div>

    @endauth

 </aside>   

{{-- =========================================================

     OVERLAY PARA MÓVIL

\\\\\\\\========================================================== --}}

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

        height: 110px;

        display: flex;

        align-items: center;

        padding:

            10px 58px 10px 12px;

        background: #ffffff;

        border:

            1px solid rgba(21, 90, 145, .55);

        border-bottom:

            2px solid #155a91;

        box-shadow:

            0 3px 12px rgba(16, 47, 80, .08);

        flex-shrink: 0;

    }

    .sidebar-brand-link {

        width: 100%;

        height: 82px;

        display: flex;

        align-items: center;

        justify-content: center;

        padding:

            8px 10px;

        overflow: hidden;

        background: transparent;

        border: none;

        border-radius: 9px;

        box-shadow: none;

    }

    .sidebar-logo-full {

        display: block;

        width: 100%;

        height: 100%;

        max-width: 160px;

        max-height: 64px;

        object-fit: contain;

    }

    .sidebar-logo-icon {

        display: none;

        width: 38px;

        height: 38px;

        object-fit: contain;

    }

    /* =========================================================

       BOTÓN CONTRAER

    ========================================================== */

    .sidebar-toggle {

        position: absolute;

        right: 13px;

        top: 36px;

        width: 38px;

        height: 38px;

        padding: 0;

        border:

            1px solid #155a91;

        border-radius: 9px;

        background: #155a91;

        color: #ffffff;

        display: flex;

        align-items: center;

        justify-content: center;

        font-size: 22px;

        line-height: 1;

        cursor: pointer;

        z-index: 30;

        box-shadow:

            0 4px 10px rgba(21, 90, 145, .20);

        transition:

            background .15s ease,

            border-color .15s ease,

            box-shadow .15s ease,

            transform .22s ease;

    }

    .sidebar-toggle:hover {

        background: #124d7c;

        border-color: #124d7c;

        box-shadow:

            0 5px 12px rgba(18, 77, 124, .24);

    }

    /* =========================================================

       MENÚ

    ========================================================== */

    .sidebar-menu {

        flex: 1;

        padding:

            10px 12px 19px;

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

        height: 76px;

        justify-content: center;

        padding: 8px;

        background: #ffffff;

        border:

            1px solid rgba(21, 90, 145, .55);

        border-bottom:

            2px solid #155a91;

        box-shadow:

            0 3px 12px rgba(16, 47, 80, .08);

    }

    body.sidebar-collapsed .sidebar-brand-link {

        width: 48px;

        height: 48px;

        justify-content: center;

        padding: 6px;

        background: transparent;

        border-radius: 9px;

        box-shadow: none;

    }

    body.sidebar-collapsed .sidebar-logo-full {

        display: none;

    }

    body.sidebar-collapsed .sidebar-logo-icon {

        display: block;

        width: 36px;

        height: 36px;

    }

    body.sidebar-collapsed .sidebar-toggle {

        right: -18px;

        top: 19px;

        transform:

            rotate(180deg);

        background: #155a91;

        border-color: #155a91;

        box-shadow:

            0 4px 12px rgba(0,0,0,.16);

    }

    body.sidebar-collapsed .sidebar-section-title {

        height: 10px;

        margin:

            9px 0;

        padding: 0;

        opacity: 0;

    }

    body.sidebar-collapsed .sidebar-menu > .sidebar-section-title:first-child {

        height: 0;

        margin: 0;

    }

    body.sidebar-collapsed .sidebar-menu::-webkit-scrollbar {

        width: 7px;

    }

    body.sidebar-collapsed .sidebar-menu::-webkit-scrollbar-track {

        background:
            rgba(255,255,255,.035);

        border-radius: 10px;

    }

    body.sidebar-collapsed .sidebar-menu::-webkit-scrollbar-thumb {

        background:
            rgba(255,255,255,.28);

        border-radius: 10px;

        border:
            1px solid rgba(16,47,80,.20);

    }

    body.sidebar-collapsed .sidebar-menu::-webkit-scrollbar-thumb:hover {

        background:
            rgba(255,255,255,.42);

    }

    body.sidebar-collapsed .sidebar-menu::-webkit-scrollbar-button {

        display: none;

        width: 0;
        height: 0;

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

       SCROLLBAR SIDEBAR CONTRAÍDO

       Mantiene el mismo estilo del sidebar normal

    ========================================================== */

    body.sidebar-collapsed .sidebar-menu {

        overflow-y: scroll !important;

        overflow-x: hidden !important;

        scrollbar-width: thin;

        scrollbar-color:

            rgba(255,255,255,.35)

            rgba(255,255,255,.05);

        scrollbar-gutter: stable;

    }

    body.sidebar-collapsed .sidebar-menu::-webkit-scrollbar {

        width: 7px;

    }

    body.sidebar-collapsed .sidebar-menu::-webkit-scrollbar-track {

        background:

            rgba(255,255,255,.045);

        border-radius: 10px;

    }

    body.sidebar-collapsed .sidebar-menu::-webkit-scrollbar-thumb {

        background:

            rgba(255,255,255,.35);

        border-radius: 10px;

        border:

            1px solid rgba(16,47,80,.20);

    }

    body.sidebar-collapsed .sidebar-menu::-webkit-scrollbar-thumb:hover {

        background:

            rgba(255,255,255,.50);

    }

    body.sidebar-collapsed .sidebar-menu::-webkit-scrollbar-button {

        display: none;

        width: 0;

        height: 0;

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

        .sidebar-brand {

            padding:

                10px 55px 10px 10px;

        }

        .sidebar-brand-link {

            width: 100%;

            padding:

                8px;

        }

        .sidebar-logo-full {

            max-width: 138px;

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

        .sidebar-brand {

            padding:

                10px 58px 10px 12px;

        }

        .sidebar-brand-link {

            width: 100%;

            padding:

                8px 10px;

        }

        .sidebar-logo-full {

            max-width: 160px;

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

    /* =========================================================

       MENÚ FLOTANTE DEL SIDEBAR CONTRAÍDO

    ========================================================== */

    body.sidebar-collapsed .sidebar-menu {

        padding-left: 0;
        padding-right: 0;

        overflow-y: auto;
        overflow-x: hidden;

        scrollbar-width: thin;

        scrollbar-color:
            rgba(255,255,255,.28)
            rgba(255,255,255,.04);

    }

    body.sidebar-collapsed .sidebar-item {

        width: 48px;

        min-height: 48px;

        margin:

            0 auto 5px;

        padding: 0;

        justify-content: center;

        border-radius: 9px;

    }

    body.sidebar-collapsed .sidebar-icon {

        width: 48px;

        min-width: 48px;

        height: 48px;

        display: flex;

        align-items: center;

        justify-content: center;

        text-align: center;

        line-height: 1;

        transform:

            translateX(4px);

    }

    .sidebar-flyout {

        position: fixed;

        z-index: 1500;

        display: none;

        width: 224px;

        padding: 9px;

        background: #ffffff;

        border:

            1px solid rgba(21, 90, 145, .25);

        border-radius: 10px;

        box-shadow:

            0 14px 34px rgba(16, 47, 80, .20);

        color: #172033;

    }

    .sidebar-flyout.show {

        display: block;

    }

    .sidebar-flyout::before {

        content: '';

        position: absolute;

        left: -7px;

        top: 18px;

        width: 12px;

        height: 12px;

        background: #ffffff;

        border-left:

            1px solid rgba(21, 90, 145, .25);

        border-bottom:

            1px solid rgba(21, 90, 145, .25);

        transform:

            rotate(45deg);

    }

    .sidebar-flyout-title {

        padding:

            8px 10px 9px;

        color: #102f50;

        font-size: 11px;

        font-weight: 700;

        text-transform: uppercase;

        letter-spacing: .04em;

        border-bottom:

            1px solid #edf1f5;

    }

    .sidebar-flyout-actions {

        padding-top: 6px;

    }

    .sidebar-flyout-link {

        width: 100%;

        min-height: 38px;

        display: flex;

        align-items: center;

        gap: 9px;

        padding:

            8px 10px;

        border-radius: 7px;

        color: #344054;

        font-size: 12px;

        font-weight: 600;

        transition:

            *background* .15s ease,

            color .15s ease;

    }

    .sidebar-flyout-link:hover {

        background: #eef5fb;

        color: #155a91;

    }

    .sidebar-flyout-link-icon {

        width: 18px;

        min-width: 18px;

        display: inline-flex;

        align-items: center;

        justify-content: center;

        color: #155a91;

    }

    @media (max-width: 800px) {

        .sidebar-flyout {

            display: none !important;

        }

    }

    /* =========================================================

       SCROLLBAR VISUAL SIEMPRE VISIBLE EN SIDEBAR CONTRAÍDO

    ========================================================== */

    .sidebar-collapsed-scrollbar {

        display: none;

        position: absolute;

        right: 2px;

        width: 10px;

        z-index: 40;

        pointer-events: auto;

        cursor: pointer;

        background:

            rgba(255,255,255,.045);

        border-radius: 10px;

    }

    .sidebar-collapsed-scrollbar-thumb {

        position: absolute;

        left: 1px;

        top: 0;

        width: 8px;

        min-height: 34px;

        background:

            rgba(255,255,255,.42);

        border:

            1px solid rgba(16,47,80,.20);

        border-radius: 10px;

        box-sizing: border-box;

        cursor: grab;

    }

    .sidebar-collapsed-scrollbar-thumb:active {

        cursor: grabbing;

        background:

            rgba(255,255,255,.58);

    }

    body.sidebar-collapsed .sidebar-collapsed-scrollbar {

        display: block;

    }

    
    body.sidebar-collapsed .sidebar-menu {
        overflow-y: auto;
        overflow-x: hidden;
        scrollbar-width: thin;
        scrollbar-color:
            rgba(255,255,255,.28)
            rgba(255,255,255,.04);
    }

    body.sidebar-collapsed .sidebar-menu::-webkit-scrollbar {
        width: 7px;
    }

    body.sidebar-collapsed .sidebar-menu::-webkit-scrollbar-track {
        background:
            rgba(255,255,255,.035);
        border-radius: 10px;
    }

    body.sidebar-collapsed .sidebar-menu::-webkit-scrollbar-thumb {
        background:
            rgba(255,255,255,.28);
        border-radius: 10px;
        border:
            1px solid rgba(16,47,80,.20);
    }

    body.sidebar-collapsed .sidebar-menu::-webkit-scrollbar-thumb:hover {
        background:
            rgba(255,255,255,.42);
    }

    body.sidebar-collapsed .sidebar-menu::-webkit-scrollbar-button {
        display: none;
        width: 0;
        height: 0;
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

            const sidebarFlyout =

                document.getElementById(

                    'sidebarFlyout'

                );

            const sidebarFlyoutTitle =

                document.getElementById(

                    'sidebarFlyoutTitle'

                );

            const sidebarFlyoutActions =

                document.getElementById(

                    'sidebarFlyoutActions'

                );

            const sidebarMenu =

                document.getElementById(

                    'sidebarMenu'

                );

            const sidebar =

                document.getElementById(

                    'sidebar'

                );
const sidebarLinks =

                document.querySelectorAll(

                    '.sidebar-item[href]'

                );

            const flyoutSections = {

                'Inicio': [

                    {

                        label: 'Ir al inicio',

                        href: "{{ route('inicio') }}",

                        icon: '⌂'

                    }

                ],

                'Operaciones': [

                    {

                        label: 'Ver operaciones',

                        href: "{{ route('operaciones.index') }}",

                        icon: '▣'

                    }

                ],

                'Clientes': [

                    {

                        label: 'Ver clientes',

                        href: "{{ route('clientes.index') }}",

                        icon: '◉'

                    }

                ],

                'Entregas': [

                    {

                        label: 'Ver entregas',

                        href: "{{ route('entregas.index') }}",

                        icon: '▤'

                    }

                ],

                'Facturas': [

                    {

                        label: 'Ver facturas',

                        href: "{{ route('facturas.index') }}",

                        icon: '▥'

                    }

                ],

                'Factoring': [

                    {

                        label: 'Ver factoring',

                        href: "{{ route('factorings.index') }}",

                        icon: '◇'

                    }

                ],

                'Empresas de factoring': [

                    {

                        label: 'Ver empresas de factoring',

                        href: "{{ route('empresas-factoring.index') }}",

                        icon: '◆'

                    }

                ],

                'Mora': [

                    {

                        label: 'Ver mora',

                        href: "{{ route('moras.index') }}",

                        icon: '△'

                    }

                ],

                'Gastos': [

                    {

                        label: 'Ver gastos',

                        href: "{{ route('gastos.index') }}",

                        icon: '▤'

                    }

                ],

                'Notas de crédito de proveedores': [

                    {

                        label: 'Ver notas de crédito',

                        href: "{{ route('notas-credito-proveedores.index') }}",

                        icon: '◫'

                    }

                ],

                'Personal': [

                    {

                        label: 'Ver trabajadores',

                        href: "{{ route('trabajadores.index') }}",

                        icon: '♙'

                    },

                    {

                        label: 'Ver contratos',

                        href: "{{ route('trabajadores.index') }}",

                        icon: '▧'

                    }

                ],

                'Contratos': [

                    {

                        label: 'Ver contratos',

                        href: "{{ route('trabajadores.index') }}",

                        icon: '▧'

                    }

                ],

                'Transportistas': [

                    {

                        label: 'Ver transportistas',

                        href: "{{ route('transportistas.index') }}",

                        icon: '□'

                    }

                ],

                'Vehículos': [

                    {

                        label: 'Ver vehículos',

                        href: "{{ route('vehiculos.index') }}",

                        icon: '▱'

                    }

                ],

                'Servicios de transporte': [

                    {

                        label: 'Ver servicios de transporte',

                        href: "{{ route('servicios-transporte.index') }}",

                        icon: '⇄'

                    }

                ],

                'Proveedores': [

                    {

                        label: 'Ver proveedores',

                        href: "{{ route('proveedores.index') }}",

                        icon: '◈'

                    }

                ],

                'Documentos': [

                    {

                        label: 'Ver documentos',

                        href: "{{ route('documentos.index') }}",

                        icon: '□'

                    }

                ],

                'Usuarios': [

                    {

                        label: 'Gestionar usuarios',

                        href: "{{ route('usuarios.index') }}",

                        icon: '♙'

                    }

                ]

            };

            function closeSidebarFlyout() {

                if (!sidebarFlyout) {

                    return;

                }

                sidebarFlyout.classList.remove(

                    'show'

                );

                sidebarFlyout.setAttribute(

                    'aria-hidden',

                    'true'

                );

                sidebarFlyout.removeAttribute(

                    'data-source'

                );

            }

            function openSidebarFlyout(link) {

                if (

                    !sidebarFlyout ||

                    !sidebarFlyoutTitle ||

                    !sidebarFlyoutActions

                ) {

                    return;

                }

                const title =

                    link.getAttribute(

                        'title'

                    ) || 'Menú';

                const actions =

                    flyoutSections[title] || [

                        {

                            label: 'Abrir módulo',

                            href: link.getAttribute('href'),

                            icon: '›'

                        }

                    ];

                sidebarFlyoutTitle.textContent =

                    title;

                sidebarFlyoutActions.innerHTML =

                    '';

                actions.forEach(

                    function (action) {

                        const actionLink =

                            document.createElement(

                                'a'

                            );

                        actionLink.className =

                            'sidebar-flyout-link';

                        actionLink.href =

                            action.href;

                        const icon =

                            document.createElement(

                                'span'

                            );

                        icon.className =

                            'sidebar-flyout-link-icon';

                        icon.textContent =

                            action.icon || '•';

                        const label =

                            document.createElement(

                                'span'

                            );

                        label.textContent =

                            action.label;

                        actionLink.appendChild(

                            icon

                        );

                        actionLink.appendChild(

                            label

                        );

                        sidebarFlyoutActions.appendChild(

                            actionLink

                        );

                    }

                );

                const rect =

                    link.getBoundingClientRect();

                sidebarFlyout.style.left =

                    (rect.right + 10) + 'px';

                sidebarFlyout.classList.add(

                    'show'

                );

                sidebarFlyout.setAttribute(

                    'aria-hidden',

                    'false'

                );

                const flyoutHeight =

                    sidebarFlyout.offsetHeight;

                let top =

                    rect.top +

                    (rect.height / 2) -

                    26;

                const maxTop =

                    window.innerHeight -

                    flyoutHeight -

                    12;

                if (top > maxTop) {

                    top = maxTop;

                }

                if (top < 12) {

                    top = 12;

                }

                sidebarFlyout.style.top =

                    top + 'px';

            }
/*

             * Recuperar estado del sidebar.

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

                        closeSidebarFlyout();

                    }

                );

            }

            /*

             * Links del sidebar.

             */

            sidebarLinks.forEach(

                function (link) {

                    link.addEventListener(

                        'click',

                        function (event) {

                            if (

                                window.innerWidth <= 800

                            ) {

                                document.body.classList.remove(

                                    'sidebar-mobile-open'

                                );

                                return;

                            }

                            if (

                                document.body.classList.contains(

                                    'sidebar-collapsed'

                                )

                            ) {

                                event.preventDefault();

                                const source =

                                    link.getAttribute(

                                        'href'

                                    ) +

                                    '|' +

                                    link.getAttribute(

                                        'title'

                                    );

                                const alreadyOpen =

                                    sidebarFlyout &&

                                    sidebarFlyout.classList.contains(

                                        'show'

                                    ) &&

                                    sidebarFlyout.getAttribute(

                                        'data-source'

                                    ) === source;

                                if (alreadyOpen) {

                                    closeSidebarFlyout();

                                    return;

                                }

                                sidebarFlyout.setAttribute(

                                    'data-source',

                                    source

                                );

                                openSidebarFlyout(

                                    link

                                );

                            }

                        }

                    );

                }

            );

            /*

             * Cerrar menú móvil al tocar el fondo.

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

             * Cerrar el flotante al hacer clic fuera.

             */

            document.addEventListener(

                'click',

                function (event) {

                    if (

                        !sidebarFlyout ||

                        !sidebarFlyout.classList.contains(

                            'show'

                        )

                    ) {

                        return;

                    }

                    const clickedSidebarItem =

                        event.target.closest(

                            '.sidebar-item[href]'

                        );

                    const clickedFlyout =

                        event.target.closest(

                            '#sidebarFlyout'

                        );

                    if (

                        !clickedSidebarItem &&

                        !clickedFlyout

                    ) {

                        closeSidebarFlyout();

                    }

                }

            );

            /*

             * ESC cierra el menú móvil y el flotante.

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

                        closeSidebarFlyout();

                    }

                }

            );

            /*

             * Al cambiar el tamaño de la ventana.

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

                    closeSidebarFlyout();

                }

            );

        }

    );

</script>