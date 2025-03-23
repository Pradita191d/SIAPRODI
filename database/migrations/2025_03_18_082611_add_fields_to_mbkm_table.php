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
        Schema::table('mbkm', function (Blueprint $table) {
            $table->string('program_studi')->nullable();
            $table->string('jurusan')->nullable();
            $table->integer('semester')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('email')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('namaMatkul')->nullable();
            $table->integer('sks')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('dospem')->nullable();
            $table->string('koor_mbkm')->nullable();
            $table->string('kaprodi')->nullable();
            $table->text('catatan_tambahan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mbkm', function (Blueprint $table) {
            //
        });
    }
};
