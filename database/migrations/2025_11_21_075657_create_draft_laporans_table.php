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
        Schema::create('draft_laporans', function (Blueprint $table) {
        $table->id();
        $table->string('pemberi_tugas');
        $table->string('nomor_ppjp');
        $table->date('tgl_proposal');
        $table->date('tgl_pengiriman');
        $table->string('status');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('draft_laporans');
    }
};
