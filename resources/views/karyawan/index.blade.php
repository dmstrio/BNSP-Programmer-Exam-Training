@extends('layouts.sbadmin')

@section('title', 'Data Karyawan - Pelatihan LSP')

@section('content')

<h1 class="mt-4">Data Karyawan</h1>

<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Data Karyawan</li>
</ol>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div>
            <i class="fas fa-users me-1"></i>
            Tabel Karyawan
        </div>

        <a href="{{ route('karyawan.create') }}" class="btn btn-primary btn-sm">
            + Tambah Karyawan
        </a>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>NIK</th>
                    <th>Nama Karyawan</th>
                    <th>Jabatan</th>
                    <th>Tanggal Masuk</th>
                    <th width="20%">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($karyawans as $karyawan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $karyawan->nik }}</td>
                        <td>{{ $karyawan->nama_karyawan }}</td>

                        <td>
                            {{ $karyawan->jabatan->nama_jabatan ?? '-' }}
                        </td>

                        <td>
                            {{ date('d-m-Y', strtotime($karyawan->tgl_masuk)) }}
                        </td>

                        <td>
                            <a href="{{ route('karyawan.edit', $karyawan->id_karyawan) }}" class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form action="{{ route('karyawan.destroy', $karyawan->id_karyawan) }}"
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
                        <td colspan="6" class="text-center">
                            Data karyawan belum tersedia.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection