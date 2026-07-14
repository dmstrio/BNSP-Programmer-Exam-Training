<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Membuat tabel karyawan.
     * Tabel ini menyimpan identitas karyawan dan relasi ke jabatan.
     */
    public function up(): void
    {
        Schema::create('karyawan', function (Blueprint $table) {
            $table->integer('id_karyawan')->autoIncrement();

            // NIK harus unik agar tidak ada karyawan ganda
            $table->string('nik', 20)->unique();

            // Nama lengkap karyawan
            $table->string('nama_karyawan', 100);

            // Foreign key ke tabel jabatan
            $table->integer('id_jabatan');

            // Tanggal karyawan mulai bekerja
            $table->date('tgl_masuk');

            $table->foreign('id_jabatan')
                ->references('id_jabatan')
                ->on('jabatan')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('karyawan');
    }
};