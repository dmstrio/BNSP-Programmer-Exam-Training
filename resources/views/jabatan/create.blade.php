@extends('layouts.sbadmin')

@section('title', 'Tambah Jabatan - Pelatihan LSP')

@section('content')

<h1 class="mt-4">Tambah Jabatan</h1>

<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('jabatan.index') }}">Data Jabatan</a>
    </li>
    <li class="breadcrumb-item active">Tambah Jabatan</li>
</ol>

<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-plus me-1"></i>
        Form Tambah Jabatan
    </div>

    <div class="card-body">

        <form action="{{ route('jabatan.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nama Jabatan</label>
                <input type="text"
                       name="nama_jabatan"
                       class="form-control @error('nama_jabatan') is-invalid @enderror"
                       value="{{ old('nama_jabatan') }}">

                @error('nama_jabatan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Gaji Pokok</label>
                <input type="number"
                       name="gapok"
                       class="form-control @error('gapok') is-invalid @enderror"
                       value="{{ old('gapok') }}"
                       min="0">

                @error('gapok')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Tunjangan Makan</label>
                <input type="number"
                       name="tunjangan_makan"
                       class="form-control @error('tunjangan_makan') is-invalid @enderror"
                       value="{{ old('tunjangan_makan') }}"
                       min="0">

                @error('tunjangan_makan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">
                Simpan
            </button>

            <a href="{{ route('jabatan.index') }}" class="btn btn-secondary">
                Kembali
            </a>
        </form>

    </div>
</div>

@endsection