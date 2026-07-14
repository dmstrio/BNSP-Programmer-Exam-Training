<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    // Menampilkan semua data jabatan
    public function index()
    {
        $jabatans = Jabatan::orderBy('id_jabatan', 'desc')->get();

        return view('jabatan.index', compact('jabatans'));
    }

    // Menampilkan form tambah jabatan
    public function create()
    {
        return view('jabatan.create');
    }

    // Menyimpan data jabatan baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_jabatan' => 'required|max:50',
            'gapok' => 'required|integer|min:0',
            'tunjangan_makan' => 'required|integer|min:0',
        ]);

        Jabatan::create([
            'nama_jabatan' => $request->nama_jabatan,
            'gapok' => $request->gapok,
            'tunjangan_makan' => $request->tunjangan_makan,
        ]);

        return redirect()
            ->route('jabatan.index')
            ->with('success', 'Data jabatan berhasil ditambahkan.');
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $jabatan = Jabatan::findOrFail($id);

        return view('jabatan.edit', compact('jabatan'));
    }

    // Memproses update data
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_jabatan' => 'required|max:50',
            'gapok' => 'required|integer|min:0',
            'tunjangan_makan' => 'required|integer|min:0',
        ]);

        $jabatan = Jabatan::findOrFail($id);

        $jabatan->update([
            'nama_jabatan' => $request->nama_jabatan,
            'gapok' => $request->gapok,
            'tunjangan_makan' => $request->tunjangan_makan,
        ]);

        return redirect()
            ->route('jabatan.index')
            ->with('success', 'Data jabatan berhasil diperbarui.');
    }

    // Menghapus data jabatan
    public function destroy($id)
    {
        $jabatan = Jabatan::findOrFail($id);
        $jabatan->delete();

        return redirect()
            ->route('jabatan.index')
            ->with('success', 'Data jabatan berhasil dihapus.');
    }
}