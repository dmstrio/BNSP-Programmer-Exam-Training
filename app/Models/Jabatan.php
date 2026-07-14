<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $table = 'jabatan';

    protected $primaryKey = 'id_jabatan';

    public $timestamps = false;

    protected $fillable = [
        'nama_jabatan',
        'gapok',
        'tunjangan_makan',
    ];

    // Relasi: satu jabatan bisa dimiliki banyak karyawan
    public function karyawan()
    {
        return $this->hasMany(Karyawan::class, 'id_jabatan', 'id_jabatan');
    }
}