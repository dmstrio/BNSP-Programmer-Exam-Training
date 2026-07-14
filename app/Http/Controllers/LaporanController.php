<?php

namespace App\Http\Controllers;

use App\Models\Penggajian;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function gaji(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        $query = Penggajian::with('karyawan.jabatan')
            ->orderBy('id_penggajian', 'desc');

        if ($bulan && $tahun) {
            $query->where('bulan_tahun', $bulan . ' ' . $tahun);
        }

        $penggajians = $query->get();

        $totalGajiBersih = $penggajians->sum('gaji_bersih');
        $totalPotongan = $penggajians->sum('potongan_pinjaman');

        return view('laporan.gaji', compact(
            'penggajians',
            'totalGajiBersih',
            'totalPotongan',
            'bulan',
            'tahun'
        ));
    }

    public function slip($id)
    {
        $penggajian = Penggajian::with('karyawan.jabatan')
            ->findOrFail($id);

        return view('laporan.slip', compact('penggajian'));
    }

    public function cetakRekap(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        $query = Penggajian::with('karyawan.jabatan')
            ->orderBy('id_penggajian', 'asc');

        if ($bulan && $tahun) {
            $query->where('bulan_tahun', $bulan . ' ' . $tahun);
        }

        $penggajians = $query->get();

        $totalGapok = $penggajians->sum(function ($item) {
            return $item->karyawan->jabatan->gapok ?? 0;
        });

        $totalTunjangan = $penggajians->sum(function ($item) {
            return $item->karyawan->jabatan->tunjangan_makan ?? 0;
        });

        $totalPotongan = $penggajians->sum('potongan_pinjaman');
        $totalGajiBersih = $penggajians->sum('gaji_bersih');

        return view('laporan.rekap_cetak', compact(
            'penggajians',
            'bulan',
            'tahun',
            'totalGapok',
            'totalTunjangan',
            'totalPotongan',
            'totalGajiBersih'
        ));
    }
}