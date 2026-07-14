<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Pinjaman;
use Illuminate\Http\Request;

class PinjamanController extends Controller
{
    public function index()
    {
        $pinjamans = Pinjaman::with('karyawan')
            ->orderBy('id_pinjaman', 'desc')
            ->get();

        return view('pinjaman.index', compact('pinjamans'));
    }

    public function create()
    {
        $karyawans = Karyawan::orderBy('nama_karyawan', 'asc')->get();

        return view('pinjaman.create', compact('karyawans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_karyawan' => 'required|exists:karyawan,id_karyawan',
            'jumlah_pinjaman' => 'required|integer|min:1',
            'tenor' => 'required|integer|min:1',
            'tanggal_pengajuan' => 'required|date',
        ]);

        $cicilanPerBulan = ceil($request->jumlah_pinjaman / $request->tenor);

        Pinjaman::create([
            'id_karyawan' => $request->id_karyawan,
            'jumlah_pinjaman' => $request->jumlah_pinjaman,
            'tenor' => $request->tenor,
            'cicilan_per_bulan' => $cicilanPerBulan,
            'tanggal_pengajuan' => $request->tanggal_pengajuan,
            'status' => 'Aktif',
        ]);

        return redirect()
            ->route('pinjaman.index')
            ->with('success', 'Data pinjaman berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pinjaman = Pinjaman::findOrFail($id);
        $karyawans = Karyawan::orderBy('nama_karyawan', 'asc')->get();

        return view('pinjaman.edit', compact('pinjaman', 'karyawans'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_karyawan' => 'required|exists:karyawan,id_karyawan',
            'jumlah_pinjaman' => 'required|integer|min:1',
            'tenor' => 'required|integer|min:1',
            'tanggal_pengajuan' => 'required|date',
        ]);

        $pinjaman = Pinjaman::findOrFail($id);

        $cicilanPerBulan = ceil($request->jumlah_pinjaman / $request->tenor);

        $pinjaman->update([
            'id_karyawan' => $request->id_karyawan,
            'jumlah_pinjaman' => $request->jumlah_pinjaman,
            'tenor' => $request->tenor,
            'cicilan_per_bulan' => $cicilanPerBulan,
            'tanggal_pengajuan' => $request->tanggal_pengajuan,
            'status' => 'Aktif',
        ]);

        return redirect()
            ->route('pinjaman.index')
            ->with('success', 'Data pinjaman berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pinjaman = Pinjaman::findOrFail($id);
        $pinjaman->delete();

        return redirect()
            ->route('pinjaman.index')
            ->with('success', 'Data pinjaman berhasil dihapus.');
    }
}