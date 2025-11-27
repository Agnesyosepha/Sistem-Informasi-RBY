<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('log_aktivitas', function (Blueprint $table) {
            $table->id();
            $table->string('no_laporan');
            $table->date('tanggal');
            $table->string('pemberi_tugas');
            $table->string('staff_edp');
            $table->string('objek_penilaian');
            $table->enum('status', ['On progress', 'selesai']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('log_aktivitas');
    }
};
