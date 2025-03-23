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
        Schema::create('sertikom', function (Blueprint $table) {
            $table->id('id_sertikom'); 
            $table->string('nidn'); 
            $table->string('nama_sertifikat'); 
            $table->string('bidang_keahlian');
            $table->string('nama_lembaga');
            $table->date('tanggal_terbit');
            $table->date('berlaku_sampai');
            $table->foreign('nidn')->references('nidn')->on('dosen');
            $table->string('doc_sertifikat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sertikom');
    }
};
