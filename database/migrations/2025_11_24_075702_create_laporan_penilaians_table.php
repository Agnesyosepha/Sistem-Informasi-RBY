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
            $table->date('tanggal');
            $table->string('jenis');
            $table->string('pemberi');
            $table->string('pengguna');
            $table->string('surveyor');
            $table->string('lokasi');
            $table->string('objek');
            $table->string('reviewer')->nullable();
            $table->string('status');
            $table->string('softcopy')->nullable(); // File PDF
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporan_penilaian');
    }
};
