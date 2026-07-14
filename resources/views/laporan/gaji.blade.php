@extends('layouts.sbadmin')

@section('title', 'Laporan Gaji - Pelatihan LSP')

@section('content')

<h1 class="mt-4">Laporan Gaji</h1>

<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Laporan Gaji</li>
</ol>

<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-filter me-1"></i>
        Filter Laporan
    </div>

    <div class="card-body">
        <form action="{{ route('laporan.gaji') }}" method="GET">
            <div class="row">

                <div class="col-md-4 mb-3">
                    <label class="form-label">Bulan</label>

                    <select name="bulan" class="form-control">
                        <option value="">-- Pilih Bulan --</option>

                        @foreach (['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'] as $namaBulan)
                            <option value="{{ $namaBulan }}" {{ $bulan == $namaBulan ? 'selected' : '' }}>
                                {{ $namaBulan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Tahun</label>

                    <input type="number"
                           name="tahun"
                           class="form-control"
                           value="{{ $tahun ?? date('Y') }}">
                </div>

                <div class="col-md-4 mb-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">
                        Filter
                    </button>

                    <a href="{{ route('laporan.gaji') }}" class="btn btn-secondary me-2">
                        Reset
                    </a>

                    <a href="{{ route('laporan.gaji.cetak', ['bulan' => $bulan, 'tahun' => $tahun]) }}"
                       target="_blank"
                       class="btn btn-success">
                        Cetak Rekap
                    </a>
                </div>

            </div>
        </form>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-file-alt me-1"></i>
        Rekapitulasi Penggajian
    </div>

    <div class="card-body">

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Periode</th>
                    <th>Gapok</th>
                    <th>Tunjangan</th>
                    <th>Potongan</th>
                    <th>Gaji Bersih</th>
                    <th>Slip</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($penggajians as $penggajian)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $penggajian->karyawan->nik ?? '-' }}</td>
                        <td>{{ $penggajian->karyawan->nama_karyawan ?? '-' }}</td>
                        <td>{{ $penggajian->karyawan->jabatan->nama_jabatan ?? '-' }}</td>
                        <td>{{ $penggajian->bulan_tahun }}</td>

                        <td>
                            Rp {{ number_format($penggajian->karyawan->jabatan->gapok ?? 0, 0, ',', '.') }}
                        </td>

                        <td>
                            Rp {{ number_format($penggajian->karyawan->jabatan->tunjangan_makan ?? 0, 0, ',', '.') }}
                        </td>

                        <td>
                            Rp {{ number_format($penggajian->potongan_pinjaman, 0, ',', '.') }}
                        </td>

                        <td>
                            Rp {{ number_format($penggajian->gaji_bersih, 0, ',', '.') }}
                        </td>

                        <td>
                            <a href="{{ route('laporan.slip', $penggajian->id_penggajian) }}"
                               target="_blank"
                               class="btn btn-sm btn-success">
                                Cetak
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center">
                            Data laporan belum tersedia.
                        </td>
                    </tr>
                @endforelse
            </tbody>

            <tfoot>
                <tr>
                    <th colspan="7" class="text-end">Total Potongan</th>
                    <th>
                        Rp {{ number_format($totalPotongan, 0, ',', '.') }}
                    </th>
                    <th colspan="2"></th>
                </tr>

                <tr>
                    <th colspan="8" class="text-end">Total Gaji Bersih</th>
                    <th colspan="2">
                        Rp {{ number_format($totalGajiBersih, 0, ',', '.') }}
                    </th>
                </tr>
            </tfoot>
        </table>

    </div>
</div>

@endsection