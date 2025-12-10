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
        Schema::table('proposals', function (Blueprint $table) {
            // Tambahkan kolom 'no_ppjp' setelah kolom 'id'
            $table->string('no_ppjp')->nullable()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('proposals', function (Blueprint $table) {
            // Hapus kolom 'no_ppjp' jika migration di-rollback
            $table->dropColumn('no_ppjp');
        });
    }
};