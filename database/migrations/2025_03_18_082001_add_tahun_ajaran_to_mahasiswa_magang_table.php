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
        Schema::table('mahasiswa_magang', function (Blueprint $table) {
            $table->string('tahun_ajaran')->nullable()->after('nilai');
        });
    }
    
    public function down()
    {
        Schema::table('mahasiswa_magang', function (Blueprint $table) {
            $table->dropColumn('tahun_ajaran');
        });
    }
    
};
