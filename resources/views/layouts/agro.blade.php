@extends('layouts.base')

@section('navbar')
    <!-- Main Header -->

    <!-- Left navbar links -->
    <nav class="main-header navbar navbar-expand navbar-dark navbar-warning">

        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>

        </ul>
        <h4><i class="fa fas fa-carrot"></i> Agricultura</h4>
        @include('partes.navbar')
    </nav>
@endsection

@section('sidebar')
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="{{ route('home') }}" class="brand-link">
            <img src="/img/logo_pequena.png"
                 alt="AdminLTE Logo"
                 class="brand-image img-circle elevation-3">
            <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
        </a>

        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ route('agro') }}" class="nav-link {{  $active === "home" ? "active":"" }}">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Home</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('agro.pessoas') }}" class="nav-link {{  $active === "pessoa" ? "active":"" }}">
                            <i class="nav-icon fas fa-male"></i>
                            <p>Pessoas</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('agro.agricultor') }}" class="nav-link {{  $active === "agricultor" ? "active":"" }}">
                            <i class="nav-icon fas fa-person-booth"></i>
                            <p>Agricultor</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('agro.os_tipos') }}" class="nav-link {{  $active === "os_tipos" ? "active":"" }}">
                            <i class="nav-icon fas fa-tractor"></i>
                            <p>Tipos OS</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('agro.veiculo') }}" class="nav-link {{  $active === "veiculo" ? "active":"" }}">
                            <i class="nav-icon fas fa-car"></i>
                            <p>Veículos</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

    </aside>
@endsection

@section('content_header')
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Profile</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active">User Profile</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
@endsection
