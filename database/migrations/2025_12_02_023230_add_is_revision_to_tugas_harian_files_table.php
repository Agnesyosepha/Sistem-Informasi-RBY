<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsRevisionToTugasHarianFilesTable extends Migration
{
    public function up()
    {
        Schema::table('tugas_harian_files', function (Blueprint $table) {
            $table->boolean('is_revision')->default(false)->after('path');
        });
    }

    public function down()
    {
        Schema::table('tugas_harian_files', function (Blueprint $table) {
            $table->dropColumn('is_revision');
        });
    }
}