<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PenggajianController;
use App\Http\Controllers\PinjamanController;
use App\Http\Controllers\LaporanController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('jabatan', JabatanController::class);
    Route::resource('karyawan', KaryawanController::class);
    Route::resource('penggajian', PenggajianController::class);
    Route::resource('pinjaman', PinjamanController::class);

    Route::get('/laporan-gaji', [LaporanController::class, 'gaji'])
    ->name('laporan.gaji');

    Route::get('/slip-gaji/{id}', [LaporanController::class, 'slip'])
    ->name('laporan.slip');

    Route::get('/laporan-gaji/cetak-rekap', [LaporanController::class, 'cetakRekap'])
    ->name('laporan.gaji.cetak');
});

require __DIR__.'/auth.php';