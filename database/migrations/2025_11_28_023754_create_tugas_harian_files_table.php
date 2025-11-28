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
    Schema::create('tugas_harian_files', function (Blueprint $table) {
        $table->id();
        $table->foreignId('tugas_harian_id')->constrained()->onDelete('cascade');
        $table->integer('tahapan_id'); // 1, 2, 3, ..., 12
        $table->string('filename');
        $table->string('path');
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('tugas_harian_files');
}
};
