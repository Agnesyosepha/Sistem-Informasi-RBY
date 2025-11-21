<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lokasi_survei', function (Blueprint $table) {
            $table->id();
            $table->string('surveyor');       
            $table->date('tanggal');          
            $table->string('lokasi');         
            $table->string('nama_objek');     
            $table->string('status')->default('Belum Survei'); 

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lokasi_survei');
    }
};
