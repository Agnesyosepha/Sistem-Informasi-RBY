<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('surat_tugas', function (Blueprint $table) {
            $table->id();
            $table->string('no_ppjp');
            $table->date('tanggal_survey');
            $table->string('lokasi'); 
            $table->string('objek_penilaian');
            $table->string('pemberi_tugas');
            $table->string('nama_penilai');
            $table->string('adendum')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surat_tugas');
    }
};