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
        Schema::create('draft_resumes', function (Blueprint $table) {
        $table->id();
        $table->string('pemberi_tugas');
        $table->string('objek_penilaian');
        $table->bigInteger('nilai_pasar');
        $table->bigInteger('nilai_wajar');
        $table->bigInteger('nilai_likuidasi');
        $table->date('tanggal');
        $table->date('tanggal_pengiriman');
        $table->string('status');
        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('draft_resumes');
    }
};
