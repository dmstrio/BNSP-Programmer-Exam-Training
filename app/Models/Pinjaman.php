<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    protected $table = 'pinjaman';
    protected $primaryKey = 'id_pinjaman';
    public $timestamps = false;

    protected $fillable = [
        'id_karyawan',
        'jumlah_pinjaman',
        'tenor',
        'cicilan_per_bulan',
        'tanggal_pengajuan',
        'status',
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan', 'id_karyawan');
    }
}