<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Membuat tabel pinjaman.
     * Tabel ini mencatat pinjaman karyawan.
     */
    public function up(): void
    {
        Schema::create('pinjaman', function (Blueprint $table) {
            $table->integer('id_pinjaman')->autoIncrement();

            // Foreign key ke karyawan
            $table->integer('id_karyawan');

            // Total jumlah pinjaman
            $table->integer('jumlah_pinjaman');

            // Lama cicilan dalam bulan
            $table->integer('tenor');

            // Cicilan per bulan
            $table->integer('cicilan_per_bulan');

            // Status pinjaman
            $table->enum('status', ['Aktif', 'Lunas']);

            $table->foreign('id_karyawan')
                ->references('id_karyawan')
                ->on('karyawan')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pinjaman');
    }
};