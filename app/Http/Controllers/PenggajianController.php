<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Penggajian;
use App\Models\Pinjaman;
use Illuminate\Http\Request;

class PenggajianController extends Controller
{
    public function index()
    {
        $penggajians = Penggajian::with('karyawan.jabatan')
            ->orderBy('id_penggajian', 'desc')
            ->get();

        return view('penggajian.index', compact('penggajians'));
    }

    public function create()
    {
        $karyawans = Karyawan::with('jabatan')
            ->orderBy('nama_karyawan', 'asc')
            ->get();

        return view('penggajian.create', compact('karyawans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_karyawan' => 'required|exists:karyawan,id_karyawan',
            'bulan' => 'required',
            'tahun' => 'required',
        ]);

        $bulanTahun = $request->bulan . ' ' . $request->tahun;

        // Mencegah data penggajian dobel untuk karyawan dan periode yang sama.
        $sudahAda = Penggajian::where('id_karyawan', $request->id_karyawan)
            ->where('bulan_tahun', $bulanTahun)
            ->exists();

        if ($sudahAda) {
            return redirect()
                ->route('penggajian.create')
                ->with('error', 'Penggajian karyawan pada periode ini sudah pernah diproses.');
        }

        // Mengambil data karyawan beserta jabatan.
        $karyawan = Karyawan::with('jabatan')->findOrFail($request->id_karyawan);

        // Mengambil gaji pokok dan tunjangan dari tabel jabatan.
        $gapok = $karyawan->jabatan->gapok ?? 0;
        $tunjangan = $karyawan->jabatan->tunjangan_makan ?? 0;

        /*
        |--------------------------------------------------------------------------
        | LOGIKA POTONGAN PINJAMAN TANPA UBAH DATABASE
        |--------------------------------------------------------------------------
        | Karena tabel pinjaman tidak memiliki tanggal pengajuan,
        | maka tenor dihitung berdasarkan jumlah data penggajian yang sudah pernah
        | memiliki potongan pinjaman untuk karyawan tersebut.
        |
        | Contoh:
        | tenor = 3
        | penggajian dengan potongan ke-1 = dipotong
        | penggajian dengan potongan ke-2 = dipotong
        | penggajian dengan potongan ke-3 = dipotong
        | penggajian berikutnya        = tidak dipotong dan status pinjaman Lunas
        |--------------------------------------------------------------------------
        */

        $potonganPinjaman = 0;

        $pinjamanAktif = Pinjaman::where('id_karyawan', $request->id_karyawan)
            ->where('status', 'Aktif')
            ->first();

        if ($pinjamanAktif) {
            $jumlahPotonganSebelumnya = Penggajian::where('id_karyawan', $request->id_karyawan)
                ->where('potongan_pinjaman', '>', 0)
                ->count();

            if ($jumlahPotonganSebelumnya < $pinjamanAktif->tenor) {
                $potonganPinjaman = $pinjamanAktif->cicilan_per_bulan;
            } else {
                $pinjamanAktif->update([
                    'status' => 'Lunas',
                ]);
            }
        }

        // Menghitung gaji bersih.
        $gajiBersih = ($gapok + $tunjangan) - $potonganPinjaman;

        // Menyimpan hasil penggajian ke tabel penggajian.
        Penggajian::create([
            'id_karyawan' => $request->id_karyawan,
            'bulan_tahun' => $bulanTahun,
            'potongan_pinjaman' => $potonganPinjaman,
            'gaji_bersih' => $gajiBersih,
        ]);

        return redirect()
            ->route('penggajian.index')
            ->with('success', 'Data penggajian berhasil diproses.');
    }

    public function destroy($id)
    {
        $penggajian = Penggajian::findOrFail($id);
        $penggajian->delete();

        return redirect()
            ->route('penggajian.index')
            ->with('success', 'Data penggajian berhasil dihapus.');
    }
}