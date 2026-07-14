@extends('layouts.sbadmin')

@section('title', 'Edit Jabatan - Pelatihan LSP')

@section('content')

<h1 class="mt-4">Edit Jabatan</h1>

<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('jabatan.index') }}">Data Jabatan</a>
    </li>
    <li class="breadcrumb-item active">Edit Jabatan</li>
</ol>

<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-edit me-1"></i>
        Form Edit Jabatan
    </div>

    <div class="card-body">

        <form action="{{ route('jabatan.update', $jabatan->id_jabatan) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nama Jabatan</label>
                <input type="text"
                       name="nama_jabatan"
                       class="form-control @error('nama_jabatan') is-invalid @enderror"
                       value="{{ old('nama_jabatan', $jabatan->nama_jabatan) }}">

                @error('nama_jabatan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Gaji Pokok</label>
                <input type="number"
                       name="gapok"
                       class="form-control @error('gapok') is-invalid @enderror"
                       value="{{ old('gapok', $jabatan->gapok) }}"
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
                       value="{{ old('tunjangan_makan', $jabatan->tunjangan_makan) }}"
                       min="0">

                @error('tunjangan_makan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">
                Update
            </button>

            <a href="{{ route('jabatan.index') }}" class="btn btn-secondary">
                Kembali
            </a>
        </form>

    </div>
</div>

@endsection