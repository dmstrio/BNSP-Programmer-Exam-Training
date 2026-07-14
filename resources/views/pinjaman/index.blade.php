@extends('layouts.sbadmin')

@section('title', 'Data Pinjaman - Pelatihan LSP')

@section('content')

<div class="container-fluid px-4">

    <h1 class="mt-4">Data Pinjaman</h1>

    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">
            Data Pinjaman
        </li>
    </ol>

    {{-- Flash Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>
        </div>
    @endif

    <div class="card mb-4">

        <div class="card-header d-flex justify-content-between align-items-center">

            <div>
                <i class="fas fa-hand-holding-usd me-1"></i>
                Data Pinjaman Karyawan
            </div>

            <a
                href="{{ route('pinjaman.create') }}"
                class="btn btn-primary btn-sm">

                <i class="fas fa-plus"></i>
                Tambah Pinjaman

            </a>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-striped table-hover">

                    <thead class="table-dark">

                        <tr>

                            <th width="5%">No</th>

                            <th>NIK</th>

                            <th>Nama Karyawan</th>

                            <th>Tanggal Pengajuan</th>

                            <th>Jumlah Pinjaman</th>

                            <th>Tenor</th>

                            <th>Cicilan / Bulan</th>

                            <th>Status</th>

                            <th width="15%">Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($pinjamans as $pinjaman)

                            <tr>

                                <td class="text-center">
                                    {{ $loop->iteration }}
                                </td>

                                <td>
                                    {{ $pinjaman->karyawan->nik }}
                                </td>

                                <td>
                                    {{ $pinjaman->karyawan->nama_karyawan }}
                                </td>

                                <td class="text-center">

                                    @if(!empty($pinjaman->tanggal_pengajuan))
                                        {{ \Carbon\Carbon::parse($pinjaman->tanggal_pengajuan)->format('d-m-Y') }}
                                    @else
                                        -
                                    @endif

                                </td>

                                <td class="text-end">
                                    Rp {{ number_format($pinjaman->jumlah_pinjaman,0,',','.') }}
                                </td>

                                <td class="text-center">
                                    {{ $pinjaman->tenor }} Bulan
                                </td>

                                <td class="text-end">
                                    Rp {{ number_format($pinjaman->cicilan_per_bulan,0,',','.') }}
                                </td>

                                <td class="text-center">

                                    @if($pinjaman->status=='Aktif')

                                        <span class="badge bg-success">
                                            Aktif
                                        </span>

                                    @else

                                        <span class="badge bg-secondary">
                                            Lunas
                                        </span>

                                    @endif

                                </td>

                                <td class="text-center">

                                    <a
                                        href="{{ route('pinjaman.edit',$pinjaman->id_pinjaman) }}"
                                        class="btn btn-warning btn-sm">

                                        <i class="fas fa-edit"></i>

                                    </a>

                                    <form
                                        action="{{ route('pinjaman.destroy',$pinjaman->id_pinjaman) }}"
                                        method="POST"
                                        class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            onclick="return confirm('Yakin ingin menghapus data ini?')"
                                            class="btn btn-danger btn-sm">

                                            <i class="fas fa-trash"></i>

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="9" class="text-center">

                                    Belum ada data pinjaman.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection