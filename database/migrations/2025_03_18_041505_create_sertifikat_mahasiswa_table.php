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
        Schema::create('sertifikat_mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->string('nim');
            $table->string('nm_sert', 255);
            $table->string('lembaga', 255);
            $table->date('tanggal_sert');
            $table->string('masa_berlaku', 255);
            $table->string('file');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sertifikat_mahasiswa');
    }
};
