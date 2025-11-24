<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('laporan_finals', function (Blueprint $table) {
            $table->id();
            $table->string('pemberi_tugas');
            $table->string('jenis_penilaian');
            $table->string('pengirim');
            $table->string('nomor_laporan');
            $table->string('status_pengiriman');
            $table->boolean('softcopy')->default(false);
            $table->boolean('hardcopy')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('laporan_finals');
    }
};
