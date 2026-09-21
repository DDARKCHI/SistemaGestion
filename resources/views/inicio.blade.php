@extends('layouts.app')

@section('title', 'Inicio')

@section('topbar_title', 'Inicio')

@push('styles')

<style>

    .home-header {

        margin-bottom: 24px;

    }

    .home-title {

        margin: 0;

        color: #172033;

        font-size: 27px;

        line-height: 1.2;

        font-weight: 700;

        letter-spacing: -.025em;

    }

    .home-subtitle {

        margin: 7px 0 0;

        color: #667085;

        font-size: 13px;

    }

    .home-card {

        background: #ffffff;

        border: 1px solid #e2e8f0;

        border-radius: 10px;

        box-shadow:
            0 2px 8px rgba(16,47,80,.05);

        overflow: hidden;

    }

    .home-card-body {

        padding: 30px;

    }

    .home-placeholder {

        min-height: 220px;

        display: flex;

        align-items: center;

        justify-content: center;

        flex-direction: column;

        text-align: center;

    }

    .home-placeholder-icon {

        width: 52px;

        height: 52px;

        display: flex;

        align-items: center;

        justify-content: center;

        margin-bottom: 15px;

        border-radius: 10px;

        background: #eef4f8;

        color: #155a91;

        font-size: 21px;

    }

    .home-placeholder-title {

        margin: 0;

        color: #344054;

        font-size: 15px;

        font-weight: 700;

    }

    .home-placeholder-text {

        max-width: 480px;

        margin: 7px auto 0;

        color: #98a2b3;

        font-size: 11px;

        line-height: 1.6;

    }

</style>

@endpush


@section('content')

    <div class="home-header">

        <h1 class="home-title">
            Inicio
        </h1>

        <p class="home-subtitle">
            Vista principal del sistema de gestión.
        </p>

    </div>


    <section class="home-card">

        <div class="home-card-body">

            <div class="home-placeholder">

                <div class="home-placeholder-icon">
                    ⌂
                </div>

                <h2 class="home-placeholder-title">
                    Panel principal
                </h2>

                <p class="home-placeholder-text">
                    Esta sección será utilizada para el dashboard general del sistema,
                    donde se mostrarán los principales indicadores y accesos rápidos.
                </p>

            </div>

        </div>

    </section>

@endsection