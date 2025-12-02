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
        Schema::table('tugas_harians', function (Blueprint $table) {
            $table->boolean('is_final_report')->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('tugas_harians', function (Blueprint $table) {
            $table->dropColumn('is_final_report');
        });
    }
};
