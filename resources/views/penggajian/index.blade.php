@extends('layouts.sbadmin')

@section('title', 'Data Penggajian - Pelatihan LSP')

@section('content')

<h1 class="mt-4">Data Penggajian</h1>

<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Data Penggajian</li>
</ol>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div>
            <i class="fas fa-money-bill-wave me-1"></i>
            Tabel Penggajian
        </div>

        <a href="{{ route('penggajian.create') }}" class="btn btn-primary btn-sm">
            + Input Gaji
        </a>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Nama Karyawan</th>
                    <th>Jabatan</th>
                    <th>Bulan/Tahun</th>
                    <th>Potongan Pinjaman</th>
                    <th>Gaji Bersih</th>
                    <th width="22%">Aksi</th>
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
                            Rp {{ number_format($penggajian->potongan_pinjaman, 0, ',', '.') }}
                        </td>

                        <td>
                            Rp {{ number_format($penggajian->gaji_bersih, 0, ',', '.') }}
                        </td>

                        <td>
                            <a href="{{ route('laporan.slip', $penggajian->id_penggajian) }}"
                               class="btn btn-success btn-sm"
                               target="_blank">
                                Cetak Slip
                            </a>

                            <form action="{{ route('penggajian.destroy', $penggajian->id_penggajian) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Yakin ingin menghapus data ini?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger btn-sm">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">
                            Data penggajian belum tersedia.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection