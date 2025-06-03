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
        Schema::create('yudisium', function (Blueprint $table) {
            $table->id('id_yudisium');
            $table->integer('NIM')->unique();
            $table->string('masalah')->nullable();
            $table->string('solusi_prodi')->nullable();
            $table->string('solusi_jurusan')->nullable();
            $table->date('tgl_yudisium')->nullable();
            $table->string('lokasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('yudisium');
    }
};
