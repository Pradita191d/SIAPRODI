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
        Schema::create('yudisium_models', function (Blueprint $table) {
            $table->id();
            $table->integer('NIM');
            $table->date('tgl_yudisium');
            $table->text('lokasi');
            $table->text('nama_mhs')->nullable();
            $table->text('masalah')->nullable();
            $table->text('solusi_prodi')->nullable();
            $table->text('solusi_jurusan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('yudisium_models');
    }
};
