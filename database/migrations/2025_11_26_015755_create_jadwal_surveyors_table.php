<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('jadwal_surveyors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('surat_tugas_id')->nullable(); // Referensi ke tabel surat_tugas
            $table->string('no_ppjp');
            $table->date('tanggal_survey');
            $table->string('lokasi');
            $table->string('objek_penilaian');
            $table->string('pemberi_tugas');
            $table->string('nama_penilai');
            $table->string('adendum')->nullable();
            $table->string('status'); // Selesai / Survey
            $table->timestamps();
            
            // Menambahkan foreign key constraint
            $table->foreign('surat_tugas_id')->references('id')->on('surat_tugas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_surveyors');
    }
};