<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Pelatihan LSP')</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    {{-- Font Awesome --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
          rel="stylesheet">

    {{-- SB Admin --}}
    <link href="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin@7.0.7/dist/css/styles.css"
          rel="stylesheet">

</head>

<body class="sb-nav-fixed">

{{-- =========================
     NAVBAR
========================== --}}

<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">

    <a class="navbar-brand ps-3"
       href="{{ route('dashboard') }}">

        Pelatihan LSP

    </a>

    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0"
            id="sidebarToggle">

        <i class="fas fa-bars"></i>

    </button>

    <ul class="navbar-nav ms-auto me-3">

        <li class="nav-item dropdown">

            <a class="nav-link dropdown-toggle"
               id="navbarDropdown"
               href="#"
               role="button"
               data-bs-toggle="dropdown">

                <i class="fas fa-user fa-fw"></i>

                {{ Auth::user()->name }}

            </a>

            <ul class="dropdown-menu dropdown-menu-end">

                <li>

                    <form method="POST"
                          action="{{ route('logout') }}">

                        @csrf

                        <button class="dropdown-item">

                            Logout

                        </button>

                    </form>

                </li>

            </ul>

        </li>

    </ul>

</nav>

{{-- =========================
      SIDEBAR
========================== --}}

<div id="layoutSidenav">

    <div id="layoutSidenav_nav">

        <nav class="sb-sidenav accordion sb-sidenav-dark">

            <div class="sb-sidenav-menu">

                <div class="nav">

                    <div class="sb-sidenav-menu-heading">

                        Dashboard

                    </div>

                    <a class="nav-link"
                       href="{{ route('dashboard') }}">

                        <div class="sb-nav-link-icon">

                            <i class="fas fa-home"></i>

                        </div>

                        Dashboard

                    </a>

                    <div class="sb-sidenav-menu-heading">

                        Master Data

                    </div>

                    <a class="nav-link"
                       href="{{ route('jabatan.index') }}">

                        <div class="sb-nav-link-icon">

                            <i class="fas fa-briefcase"></i>

                        </div>

                        Data Jabatan

                    </a>

                    <a class="nav-link"
                       href="{{ route('karyawan.index') }}">

                        <div class="sb-nav-link-icon">

                            <i class="fas fa-users"></i>

                        </div>

                        Data Karyawan

                    </a>

                    <div class="sb-sidenav-menu-heading">

                        Transaksi

                    </div>

                    <a class="nav-link"
                       href="{{ route('penggajian.index') }}">

                        <div class="sb-nav-link-icon">

                            <i class="fas fa-money-check-dollar"></i>

                        </div>

                        Penggajian

                    </a>

                    <a class="nav-link"
                       href="{{ route('pinjaman.index') }}">

                        <div class="sb-nav-link-icon">

                            <i class="fas fa-hand-holding-dollar"></i>

                        </div>

                        Pinjaman

                    </a>

                    <div class="sb-sidenav-menu-heading">

                        Laporan

                    </div>

                    <a class="nav-link"
                       href="{{ route('laporan.gaji') }}">

                        <div class="sb-nav-link-icon">

                            <i class="fas fa-file-lines"></i>

                        </div>

                        Laporan Gaji

                    </a>

                </div>

            </div>

            <div class="sb-sidenav-footer">

                <div class="small">

                    Login sebagai

                </div>

                {{ Auth::user()->name }}

            </div>

        </nav>

    </div>

{{-- =========================
       CONTENT
========================== --}}

<div id="layoutSidenav_content">

<main>

<div class="container-fluid px-4">

@yield('content')

</div>

</main>

<footer class="py-4 bg-light mt-auto">

<div class="container-fluid px-4">

<div class="d-flex justify-content-between">

<div>

Copyright © Pelatihan LSP {{ date('Y') }}

</div>

<div>

Laravel 13 • SB Admin

</div>

</div>

</div>

</footer>

</div>

</div>

{{-- Bootstrap --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

{{-- SB Admin --}}
<script src="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin@7.0.7/dist/js/scripts.js"></script>

@stack('scripts')

</body>

</html>