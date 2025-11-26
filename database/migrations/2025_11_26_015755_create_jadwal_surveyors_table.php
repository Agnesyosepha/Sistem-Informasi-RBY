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
            $table->string('nama_surveyor');
            $table->date('tanggal');
            $table->string('lokasi');
            $table->string('deskripsi');
            $table->string('status'); // Selesai / Proses
            $table->timestamps();
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
