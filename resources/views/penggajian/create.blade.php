@extends('layouts.sbadmin')

@section('title', 'Input Penggajian - Pelatihan LSP')

@section('content')

<h1 class="mt-4">Input Penggajian</h1>

<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('penggajian.index') }}">Data Penggajian</a>
    </li>
    <li class="breadcrumb-item active">Input Penggajian</li>
</ol>

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-plus me-1"></i>
        Form Input Penggajian
    </div>

    <div class="card-body">

        <form action="{{ route('penggajian.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Karyawan</label>

                <select name="id_karyawan"
                        id="id_karyawan"
                        class="form-control @error('id_karyawan') is-invalid @enderror">

                    <option value="">-- Pilih Karyawan --</option>

                    @foreach ($karyawans as $karyawan)
                        <option value="{{ $karyawan->id_karyawan }}"
                                data-gapok="{{ $karyawan->jabatan->gapok ?? 0 }}"
                                data-tunjangan="{{ $karyawan->jabatan->tunjangan_makan ?? 0 }}">
                            {{ $karyawan->nama_karyawan }} - {{ $karyawan->jabatan->nama_jabatan ?? '-' }}
                        </option>
                    @endforeach
                </select>

                @error('id_karyawan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Bulan</label>

                    <select name="bulan" class="form-control @error('bulan') is-invalid @enderror">
                        <option value="">-- Pilih Bulan --</option>
                        @foreach (['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'] as $bulan)
                            <option value="{{ $bulan }}">{{ $bulan }}</option>
                        @endforeach
                    </select>

                    @error('bulan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Tahun</label>

                    <input type="number"
                           name="tahun"
                           class="form-control @error('tahun') is-invalid @enderror"
                           value="{{ date('Y') }}">

                    @error('tahun')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Gaji Pokok</label>
                <input type="text" id="gapok" class="form-control" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Tunjangan Makan</label>
                <input type="text" id="tunjangan_makan" class="form-control" readonly>
            </div>

            <div class="alert alert-info">
                Sistem akan otomatis menghitung potongan pinjaman berdasarkan tanggal pengajuan, tenor, dan status pinjaman aktif.
            </div>

            <button type="submit" class="btn btn-primary">
                Proses Gaji
            </button>

            <a href="{{ route('penggajian.index') }}" class="btn btn-secondary">
                Kembali
            </a>
        </form>

    </div>
</div>

<script>
    const selectKaryawan = document.getElementById('id_karyawan');
    const inputGapok = document.getElementById('gapok');
    const inputTunjangan = document.getElementById('tunjangan_makan');

    function formatRupiah(angka) {
        return new Intl.NumberFormat('id-ID').format(angka);
    }

    function tampilkanGaji() {
        const selectedOption = selectKaryawan.options[selectKaryawan.selectedIndex];

        const gapok = parseInt(selectedOption.getAttribute('data-gapok')) || 0;
        const tunjangan = parseInt(selectedOption.getAttribute('data-tunjangan')) || 0;

        inputGapok.value = 'Rp ' + formatRupiah(gapok);
        inputTunjangan.value = 'Rp ' + formatRupiah(tunjangan);
    }

    selectKaryawan.addEventListener('change', tampilkanGaji);
</script>

@endsection