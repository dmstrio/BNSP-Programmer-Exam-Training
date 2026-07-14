<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    // Nama tabel asli di database
    protected $table = 'karyawan';

    // Primary key tabel karyawan
    protected $primaryKey = 'id_karyawan';

    // Tabel dari Modul 1 tidak punya created_at dan updated_at
    public $timestamps = false;

    // Kolom yang boleh diisi melalui form
    protected $fillable = [
        'nik',
        'nama_karyawan',
        'id_jabatan',
        'tgl_masuk',
    ];
    // Relasi: satu karyawan bisa memiliki banyak pinjaman
    public function pinjaman()
    {
            return $this->hasMany(Pinjaman::class, 'id_karyawan', 'id_karyawan');
    }

    // Relasi: satu karyawan memiliki satu jabatan
    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan', 'id_jabatan');
    }
}

    