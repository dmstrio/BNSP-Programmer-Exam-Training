<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Membuat tabel jabatan.
     * Tabel ini menyimpan master jabatan, gaji pokok, dan tunjangan makan.
     */
    public function up(): void
    {
        Schema::create('jabatan', function (Blueprint $table) {
            $table->integer('id_jabatan')->autoIncrement();

            // Nama jabatan, contoh: Manager, Staff, HRD
            $table->string('nama_jabatan', 50);

            // Gaji pokok jabatan
            $table->integer('gapok');

            // Tunjangan makan jabatan
            $table->integer('tunjangan_makan');
        });
    }

    /**
     * Menghapus tabel jabatan jika rollback.
     */
    public function down(): void
    {
        Schema::dropIfExists('jabatan');
    }
};