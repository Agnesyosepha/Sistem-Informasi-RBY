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
        Schema::create('tugas_harians', function (Blueprint $table) {
            $table->id();
            $table->string('pemberi_tugas');
            $table->string('debitur');
            $table->string('no_ppjp');
            $table->date('tanggal_survei');
            $table->string('tim_lapangan');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tugas_harians');
    }
};
