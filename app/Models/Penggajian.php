<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penggajian extends Model
{
    // Nama tabel asli dari database Modul 1
    protected $table = 'penggajian';

    // Primary key tabel penggajian
    protected $primaryKey = 'id_penggajian';

    // Tabel tidak memiliki created_at dan updated_at
    public $timestamps = false;

    // Kolom yang boleh diisi
    protected $fillable = [
        'id_karyawan',
        'bulan_tahun',
        'potongan_pinjaman',
        'gaji_bersih',
    ];

    // Relasi penggajian ke karyawan
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan', 'id_karyawan');
    }
}