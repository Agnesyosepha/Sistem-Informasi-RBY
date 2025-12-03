<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('dokumen_finals', function (Blueprint $table) {
            $table->string('reviewer')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('dokumen_finals', function (Blueprint $table) {
            $table->string('reviewer')->nullable(false)->change();
        });
    }

};
