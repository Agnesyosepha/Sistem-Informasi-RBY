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
            $table->string('termin')->default('DP'); // DP atau Pelunasan
            $table->decimal('biaya_jasa', 15, 2)->default(0); // Format untuk uang
            $table->string('bukti_dp')->nullable(); // Path ke file bukti DP
            $table->string('bukti_pelunasan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            // Hapus kolom jika rollback
            $table->dropColumn(['termin', 'biaya_jasa', 'bukti_dp', 'bukti_pelunasan']);
        });
    }
};
