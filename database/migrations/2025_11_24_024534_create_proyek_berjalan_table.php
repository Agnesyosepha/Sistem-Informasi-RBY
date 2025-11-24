<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('proyek_berjalan', function (Blueprint $table) {
        $table->id();
        $table->string('noppjp');
        $table->string('debitur');
        $table->string('lokasi');
        $table->string('surveyor');
        $table->date('tgl_inspeksi');
        $table->string('progres');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyek_berjalan');
    }
};
