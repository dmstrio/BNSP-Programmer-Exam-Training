@extends('layouts.sbadmin')

@section('title', 'Edit Karyawan - Pelatihan LSP')

@section('content')

<h1 class="mt-4">Edit Karyawan</h1>

<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('karyawan.index') }}">Data Karyawan</a>
    </li>
    <li class="breadcrumb-item active">Edit Karyawan</li>
</ol>

<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-edit me-1"></i>
        Form Edit Karyawan
    </div>

    <div class="card-body">

        <form action="{{ route('karyawan.update', $karyawan->id_karyawan) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">NIK</label>
                <input type="text"
                       name="nik"
                       class="form-control @error('nik') is-invalid @enderror"
                       value="{{ old('nik', $karyawan->nik) }}">

                @error('nik')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Karyawan</label>
                <input type="text"
                       name="nama_karyawan"
                       class="form-control @error('nama_karyawan') is-invalid @enderror"
                       value="{{ old('nama_karyawan', $karyawan->nama_karyawan) }}">

                @error('nama_karyawan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Jabatan</label>
                <select name="id_jabatan"
                        class="form-control @error('id_jabatan') is-invalid @enderror">
                    <option value="">-- Pilih Jabatan --</option>

                    @foreach ($jabatans as $jabatan)
                        <option value="{{ $jabatan->id_jabatan }}"
                            {{ old('id_jabatan', $karyawan->id_jabatan) == $jabatan->id_jabatan ? 'selected' : '' }}>
                            {{ $jabatan->nama_jabatan }}
                        </option>
                    @endforeach
                </select>

                @error('id_jabatan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Masuk</label>
                <input type="date"
                       name="tgl_masuk"
                       class="form-control @error('tgl_masuk') is-invalid @enderror"
                       value="{{ old('tgl_masuk', $karyawan->tgl_masuk) }}">

                @error('tgl_masuk')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">
                Update
            </button>

            <a href="{{ route('karyawan.index') }}" class="btn btn-secondary">
                Kembali
            </a>
        </form>

    </div>
</div>

@endsection