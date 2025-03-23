<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use League\CommonMark\Reference\Reference;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('anggota', function (Blueprint $table) {
            $table->id('id_anggota');
            $table->unsignedBigInteger('id_penelitian');
            $table->foreign('id_penelitian')->references('id_penelitian')->on('penelitian_dosen')->onDelete('cascade');
            $table->foreignId('NIM')->references('id_penelitian')->on('penelitian_dosen')->onDelete('cascade'); // Relasi ke tabel mahasiswa
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggota');
    }
};
