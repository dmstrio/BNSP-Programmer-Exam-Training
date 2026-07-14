<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Membuat tabel penggajian.
     * Tabel ini menyimpan hasil transaksi penggajian.
     */
    public function up(): void
    {
        Schema::create('penggajian', function (Blueprint $table) {
            $table->integer('id_penggajian')->autoIncrement();

            // Foreign key ke karyawan
            $table->integer('id_karyawan');

            // Contoh isi: Mei 2024
            $table->string('bulan_tahun', 20);

            // Potongan dari pinjaman
            $table->integer('potongan_pinjaman');

            // Hasil akhir gaji bersih
            $table->integer('gaji_bersih');

            $table->foreign('id_karyawan')
                ->references('id_karyawan')
                ->on('karyawan')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penggajian');
    }
};