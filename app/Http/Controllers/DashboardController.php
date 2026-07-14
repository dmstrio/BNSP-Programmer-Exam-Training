<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard utama.
     */
    public function index()
    {
        // Menghitung jumlah data karyawan
        $totalKaryawan = DB::table('karyawan')->count();

        // Menghitung jumlah data jabatan
        $totalJabatan = DB::table('jabatan')->count();

        // Menghitung jumlah pinjaman yang masih aktif
        $totalPinjamanAktif = DB::table('pinjaman')
            ->where('status', 'Aktif')
            ->count();

        // Mengirim data ke view dashboard
        return view('dashboard', compact(
            'totalKaryawan',
            'totalJabatan',
            'totalPinjamanAktif'
        ));
    }
}