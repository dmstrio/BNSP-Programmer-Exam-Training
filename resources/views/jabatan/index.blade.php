@extends('layouts.sbadmin')

@section('title', 'Data Jabatan - Pelatihan LSP')

@section('content')

<h1 class="mt-4">Data Jabatan</h1>

<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Data Jabatan</li>
</ol>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div>
            <i class="fas fa-briefcase me-1"></i>
            Tabel Jabatan
        </div>

        <a href="{{ route('jabatan.create') }}" class="btn btn-primary btn-sm">
            + Tambah Jabatan
        </a>
    </div>

    <div class="card-body">

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>Nama Jabatan</th>
                    <th>Gaji Pokok</th>
                    <th>Tunjangan Makan</th>
                    <th width="20%">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($jabatans as $jabatan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $jabatan->nama_jabatan }}</td>
                        <td>Rp {{ number_format($jabatan->gapok, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($jabatan->tunjangan_makan, 0, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('jabatan.edit', $jabatan->id_jabatan) }}" class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form action="{{ route('jabatan.destroy', $jabatan->id_jabatan) }}"
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
                        <td colspan="5" class="text-center">
                            Data jabatan belum tersedia.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</div>

@endsection