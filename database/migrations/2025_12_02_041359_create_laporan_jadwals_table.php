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
        Schema::create('laporan_jadwals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jadwal_id')->nullable();
            $table->string('nama_surveyor');
            $table->date('tanggal');
            $table->string('lokasi');
            $table->string('deskripsi');
            $table->string('status');
            $table->timestamps();
            
            // Menambahkan foreign key constraint
            $table->foreign('jadwal_id')->references('id')->on('jadwal_surveyors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_jadwals');
    }
};