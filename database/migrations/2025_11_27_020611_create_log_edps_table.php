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
        Schema::create('log_edps', function (Blueprint $table) {
            $table->id();
            $table->string('no_laporan');
            $table->date('tanggal');
            $table->string('pemberi_tugas');
            $table->string('penilai');
            $table->string('staff');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_edps');
    }
};
