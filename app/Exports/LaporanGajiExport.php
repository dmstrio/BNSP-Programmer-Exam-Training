<?php

namespace App\Exports;

use App\Models\Penggajian;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanGajiExport implements FromCollection, WithHeadings
{
    protected $bulanTahun;

    public function __construct($bulanTahun = null)
    {
        $this->bulanTahun = $bulanTahun;
    }

    public function collection()
    {
        $query = Penggajian::with('karyawan.jabatan');

        if ($this->bulanTahun) {
            $query->where('bulan_tahun', $this->bulanTahun);
        }

        return $query->get()->map(function ($item) {
            return [
                'nama_karyawan' => $item->karyawan->nama_karyawan ?? '-',
                'jabatan' => $item->karyawan->jabatan->nama_jabatan ?? '-',
                'bulan_tahun' => $item->bulan_tahun,
                'potongan_pinjaman' => $item->potongan_pinjaman,
                'gaji_bersih' => $item->gaji_bersih,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nama Karyawan',
            'Jabatan',
            'Bulan/Tahun',
            'Potongan Pinjaman',
            'Gaji Bersih',
        ];
    }
}