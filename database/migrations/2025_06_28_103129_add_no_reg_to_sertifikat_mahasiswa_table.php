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
        Schema::table('sertifikat_mahasiswa', function (Blueprint $table) {
            $table->string('no_reg')->nullable()->after('lembaga');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sertifikat_mahasiswa', function (Blueprint $table) {
            $table->dropColumn('no_reg');
        });
    }
};
