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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_pembuat');
            $table->string('no_invoice');
            $table->string('no_ppjp');
            $table->string('nama_klien');
            $table->string('pemberi_tugas');
            $table->string('pengguna_laporan'); // Tambahkan kolom ini
            $table->string('status');
            $table->boolean('checked')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
