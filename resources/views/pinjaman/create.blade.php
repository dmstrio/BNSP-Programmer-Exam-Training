@extends('layouts.sbadmin')

@section('title', 'Tambah Pinjaman - Pelatihan LSP')

@section('content')

<h1 class="mt-4">Tambah Pinjaman</h1>

<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('pinjaman.index') }}">Data Pinjaman</a>
    </li>
    <li class="breadcrumb-item active">Tambah Pinjaman</li>
</ol>

<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-plus me-1"></i>
        Form Tambah Pinjaman
    </div>

    <div class="card-body">

        <form action="{{ route('pinjaman.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Karyawan</label>

                <select name="id_karyawan"
                        class="form-control @error('id_karyawan') is-invalid @enderror">
                    <option value="">-- Pilih Karyawan --</option>

                    @foreach ($karyawans as $karyawan)
                        <option value="{{ $karyawan->id_karyawan }}"
                            {{ old('id_karyawan') == $karyawan->id_karyawan ? 'selected' : '' }}>
                            {{ $karyawan->nama_karyawan }}
                        </option>
                    @endforeach
                </select>

                @error('id_karyawan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Jumlah Pinjaman</label>

                <input type="number"
                       name="jumlah_pinjaman"
                       id="jumlah_pinjaman"
                       class="form-control @error('jumlah_pinjaman') is-invalid @enderror"
                       value="{{ old('jumlah_pinjaman') }}"
                       min="0">

                @error('jumlah_pinjaman')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Tenor / Lama Cicilan</label>

                <input type="number"
                       name="tenor"
                       id="tenor"
                       class="form-control @error('tenor') is-invalid @enderror"
                       value="{{ old('tenor') }}"
                       min="1">

                @error('tenor')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                <small class="text-muted">
                    Contoh: 5 artinya cicilan selama 5 bulan.
                </small>
            </div>

            <div class="mb-3">
                <label class="form-label">Preview Cicilan Per Bulan</label>

                <input type="text"
                       id="preview_cicilan"
                       class="form-control"
                       readonly>

                <small class="text-muted">
                    Nilai ini akan dihitung otomatis dari jumlah pinjaman dibagi tenor.
                </small>
            </div>

                        <div class="mb-3">
                <label class="form-label">Tanggal Pengajuan</label>

                <input type="date"
                    name="tanggal_pengajuan"
                    class="form-control @error('tanggal_pengajuan') is-invalid @enderror"
                    value="{{ old('tanggal_pengajuan') }}">

                @error('tanggal_pengajuan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                <small class="text-muted">
                    Tanggal ini menjadi awal perhitungan tenor pinjaman.
                </small>
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>

                <select name="status"
                        class="form-control @error('status') is-invalid @enderror">
                    <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="Lunas" {{ old('status') == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                </select>

                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">
                Simpan
            </button>

            <a href="{{ route('pinjaman.index') }}" class="btn btn-secondary">
                Kembali
            </a>
        </form>

    </div>
</div>

<script>
    // Mengambil input jumlah pinjaman
    const inputJumlah = document.getElementById('jumlah_pinjaman');

    // Mengambil input tenor
    const inputTenor = document.getElementById('tenor');

    // Mengambil input preview cicilan
    const previewCicilan = document.getElementById('preview_cicilan');

    // Fungsi format angka menjadi format Indonesia
    function formatRupiah(angka) {
        return new Intl.NumberFormat('id-ID').format(angka);
    }

    // Fungsi menghitung cicilan per bulan
    function hitungCicilan() {
        const jumlah = parseInt(inputJumlah.value) || 0;
        const tenor = parseInt(inputTenor.value) || 0;

        if (jumlah > 0 && tenor > 0) {
            const cicilan = Math.ceil(jumlah / tenor);
            previewCicilan.value = 'Rp ' + formatRupiah(cicilan);
        } else {
            previewCicilan.value = '';
        }
    }

    inputJumlah.addEventListener('input', hitungCicilan);
    inputTenor.addEventListener('input', hitungCicilan);
</script>

@endsection