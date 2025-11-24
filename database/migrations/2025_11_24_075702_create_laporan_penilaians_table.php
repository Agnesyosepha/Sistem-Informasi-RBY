<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporan_penilaian', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_laporan');
            $table->string('klien');           // Nama Debitur
            $table->string('jenis_aset');      // Objek Penilaian
            $table->string('lokasi');          // Lokasi
            $table->date('tgl_laporan');       // Tanggal Laporan
            $table->string('softcopy')->nullable(); // File PDF
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporan_penilaian');
    }
};