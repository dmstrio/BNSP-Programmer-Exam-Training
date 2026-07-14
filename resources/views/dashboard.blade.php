@extends('layouts.sbadmin')

@section('title', 'Dashboard - Pelatihan LSP')

@section('content')

<h1 class="mt-4">Dashboard</h1>

<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">
        Ringkasan Sistem Penggajian dan Pinjaman Karyawan
    </li>
</ol>

<div class="row">

    <div class="col-xl-4 col-md-6">
        <div class="card bg-primary text-white mb-4">
            <div class="card-body">
                <h5>Total Karyawan</h5>
                <h2>{{ $totalKaryawan }}</h2>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <span class="small text-white">Data dari tabel karyawan</span>
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6">
        <div class="card bg-success text-white mb-4">
            <div class="card-body">
                <h5>Total Jabatan</h5>
                <h2>{{ $totalJabatan }}</h2>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <span class="small text-white">Data dari tabel jabatan</span>
                <i class="fas fa-briefcase"></i>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6">
        <div class="card bg-warning text-white mb-4">
            <div class="card-body">
                <h5>Pinjaman Aktif</h5>
                <h2>{{ $totalPinjamanAktif }}</h2>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <span class="small text-white">Status Aktif</span>
                <i class="fas fa-hand-holding-usd"></i>
            </div>
        </div>
    </div>

</div>

@endsection