<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DummyDataSeeder extends Seeder
{
    /**
     * Mengisi data dummy untuk testing fitur.
     */
    public function run(): void
    {
        // Menghapus data lama agar tidak dobel saat seeder dijalankan ulang
        DB::table('penggajian')->delete();
        DB::table('pinjaman')->delete();
        DB::table('karyawan')->delete();
        DB::table('jabatan')->delete();

        // =========================
        // DATA JABATAN
        // =========================
        $jabatans = [
            ['nama_jabatan' => 'Direktur', 'gapok' => 15000000, 'tunjangan_makan' => 3000000],
            ['nama_jabatan' => 'Manager', 'gapok' => 10000000, 'tunjangan_makan' => 2000000],
            ['nama_jabatan' => 'Supervisor', 'gapok' => 8000000, 'tunjangan_makan' => 1500000],
            ['nama_jabatan' => 'HRD', 'gapok' => 7000000, 'tunjangan_makan' => 1200000],
            ['nama_jabatan' => 'Finance', 'gapok' => 6500000, 'tunjangan_makan' => 1000000],
            ['nama_jabatan' => 'Staff Administrasi', 'gapok' => 5000000, 'tunjangan_makan' => 700000],
            ['nama_jabatan' => 'Staff Gudang', 'gapok' => 4800000, 'tunjangan_makan' => 600000],
            ['nama_jabatan' => 'Marketing', 'gapok' => 6000000, 'tunjangan_makan' => 900000],
            ['nama_jabatan' => 'Teknisi', 'gapok' => 5500000, 'tunjangan_makan' => 800000],
            ['nama_jabatan' => 'Office Boy', 'gapok' => 3500000, 'tunjangan_makan' => 500000],
        ];

        DB::table('jabatan')->insert($jabatans);

        // =========================
        // DATA KARYAWAN
        // =========================
        $namaKaryawan = [
            'Budi Santoso', 'Andi Saputra', 'Rizky Maulana', 'Agus Setiawan', 'Fajar Nugroho',
            'Dewi Lestari', 'Putri Ayu', 'Indah Permata', 'Siti Aminah', 'Rina Oktavia',
            'Ahmad Fauzi', 'Bayu Pratama', 'Dimas Satrio', 'Eko Prasetyo', 'Gilang Ramadhan',
            'Hendra Wijaya', 'Ilham Maulana', 'Joko Susilo', 'Kurniawan Adi', 'Lukman Hakim',
            'Maya Sari', 'Nadia Putri', 'Oktavia Rahma', 'Pandu Wirawan', 'Qori Ananda',
            'Rizka Amalia', 'Salsa Bila', 'Taufik Hidayat', 'Umar Bakri', 'Vina Marlina',
            'Wahyu Saputra', 'Yuli Astuti', 'Zainal Abidin', 'Alya Kirana', 'Bagas Pratama',
            'Citra Dewi', 'Doni Hermawan', 'Elsa Puspita', 'Farhan Akbar', 'Gita Anggraini',
            'Hani Safitri', 'Iqbal Ramadhan', 'Jihan Nabila', 'Kevin Putra', 'Laras Wati',
            'Miko Fernando', 'Nanda Saputra', 'Oki Firmansyah', 'Putra Mahendra', 'Rara Febriani',
        ];

        foreach ($namaKaryawan as $index => $nama) {
            DB::table('karyawan')->insert([
                'nik' => '10000000' . str_pad($index + 1, 2, '0', STR_PAD_LEFT),
                'nama_karyawan' => $nama,
                'id_jabatan' => rand(1, 10),
                'tgl_masuk' => now()->subDays(rand(100, 1500))->format('Y-m-d'),
            ]);
        }

        // =========================
        // DATA PINJAMAN
        // =========================
        for ($i = 1; $i <= 30; $i++) {
            $jumlah = collect([2000000, 3000000, 5000000, 7500000, 10000000])->random();
            $tenor = collect([6, 8, 10, 12, 18, 24])->random();

            DB::table('pinjaman')->insert([
                'id_karyawan' => rand(1, 50),
                'jumlah_pinjaman' => $jumlah,
                'tenor' => $tenor,
                'cicilan_per_bulan' => ceil($jumlah / $tenor),
                'status' => collect(['Aktif', 'Lunas'])->random(),
            ]);
        }

        // =========================
        // DATA PENGGAJIAN
        // =========================
        $bulanTahunList = [
            'Januari 2025',
            'Februari 2025',
            'Maret 2025',
            'April 2025',
            'Mei 2025',
            'Juni 2025',
            'Juli 2025',
            'Agustus 2025',
        ];

        foreach ($bulanTahunList as $bulanTahun) {
            for ($idKaryawan = 1; $idKaryawan <= 25; $idKaryawan++) {
                $karyawan = DB::table('karyawan')
                    ->join('jabatan', 'karyawan.id_jabatan', '=', 'jabatan.id_jabatan')
                    ->where('karyawan.id_karyawan', $idKaryawan)
                    ->first();

                if ($karyawan) {
                    $potongan = collect([0, 250000, 500000, 750000, 1000000])->random();

                    DB::table('penggajian')->insert([
                        'id_karyawan' => $idKaryawan,
                        'bulan_tahun' => $bulanTahun,
                        'potongan_pinjaman' => $potongan,
                        'gaji_bersih' => ($karyawan->gapok + $karyawan->tunjangan_makan) - $potongan,
                    ]);
                }
            }
        }
    }
}