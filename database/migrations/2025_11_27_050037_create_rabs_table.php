<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('rabs', function (Blueprint $table) {
            $table->id();
            $table->string('no_ppjp');
            $table->string('pemberi_tugas');
            $table->string('lokasi');
            $table->date('tanggal_survey'); // satu tanggal survey
            $table->string('pelaksana_inspeksi');
            $table->integer('total_biaya');
            $table->enum('status', ['Menunggu', 'Disetujui'])->default('Menunggu');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rabs');
    }
};
