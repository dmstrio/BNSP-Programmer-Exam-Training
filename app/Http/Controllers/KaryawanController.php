<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    // Menampilkan semua data karyawan
    public function index()
    {
        // with('jabatan') digunakan agar data jabatan ikut diambil
        $karyawans = Karyawan::with('jabatan')
            ->orderBy('id_karyawan', 'desc')
            ->get();

        return view('karyawan.index', compact('karyawans'));
    }

    // Menampilkan form tambah karyawan
    public function create()
    {
        // Mengambil semua data jabatan untuk dropdown
        $jabatans = Jabatan::orderBy('nama_jabatan', 'asc')->get();

        return view('karyawan.create', compact('jabatans'));
    }

    // Menyimpan data karyawan baru
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'nik' => 'required|max:20|unique:karyawan,nik',
            'nama_karyawan' => 'required|max:100',
            'id_jabatan' => 'required|exists:jabatan,id_jabatan',
            'tgl_masuk' => 'required|date',
        ]);

        // Simpan data ke tabel karyawan
        Karyawan::create([
            'nik' => $request->nik,
            'nama_karyawan' => $request->nama_karyawan,
            'id_jabatan' => $request->id_jabatan,
            'tgl_masuk' => $request->tgl_masuk,
        ]);

        return redirect()
            ->route('karyawan.index')
            ->with('success', 'Data karyawan berhasil ditambahkan.');
    }

    // Menampilkan form edit karyawan
    public function edit($id)
    {
        $karyawan = Karyawan::findOrFail($id);

        // Data jabatan tetap diambil untuk dropdown edit
        $jabatans = Jabatan::orderBy('nama_jabatan', 'asc')->get();

        return view('karyawan.edit', compact('karyawan', 'jabatans'));
    }

    // Memproses update data karyawan
    public function update(Request $request, $id)
    {
        $karyawan = Karyawan::findOrFail($id);

        // Unique NIK harus mengabaikan data milik karyawan yang sedang diedit
        $request->validate([
            'nik' => 'required|max:20|unique:karyawan,nik,' . $id . ',id_karyawan',
            'nama_karyawan' => 'required|max:100',
            'id_jabatan' => 'required|exists:jabatan,id_jabatan',
            'tgl_masuk' => 'required|date',
        ]);

        $karyawan->update([
            'nik' => $request->nik,
            'nama_karyawan' => $request->nama_karyawan,
            'id_jabatan' => $request->id_jabatan,
            'tgl_masuk' => $request->tgl_masuk,
        ]);

        return redirect()
            ->route('karyawan.index')
            ->with('success', 'Data karyawan berhasil diperbarui.');
    }

    // Menghapus data karyawan
    public function destroy($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $karyawan->delete();

        return redirect()
            ->route('karyawan.index')
            ->with('success', 'Data karyawan berhasil dihapus.');
    }
}