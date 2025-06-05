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
        Schema::create('tugas_akhir', function (Blueprint $table) {
            $table->id('id_ta');
            $table->string('nim');
            $table->unsignedBigInteger('tahun_akademik');
            $table->string('sk_penguji_proposal');
            $table->string('dosen_pengprop_1');
            $table->string('dosen_pengprop_2');
            $table->string('sk_pembimbing_ta');
            $table->string('dosen_pemta_1');
            $table->string('dosen_pemta_2');
            $table->string('sk_penguji_ta');
            $table->string('dosen_pengta_1');
            $table->string('dosen_pengta_2');
            $table->string('judul_ta');
            $table->integer('nilai_ta');
            $table->timestamps();

            // Foreign key
            $table->foreign('nim')->references('nim')->on('mahasiswa')->onDelete('cascade');
            $table->foreign('tahun_akademik')->references('id_tahun_akademik')->on('tahun_akademik')->onDelete('cascade');
            $table->foreign('dosen_pengprop_1')->references('nidn')->on('dosen')->onDelete('cascade');
            $table->foreign('dosen_pengprop_2')->references('nidn')->on('dosen')->onDelete('cascade');
            $table->foreign('dosen_pemta_1')->references('nidn')->on('dosen')->onDelete('cascade');
            $table->foreign('dosen_pemta_2')->references('nidn')->on('dosen')->onDelete('cascade');
            $table->foreign('dosen_pengta_1')->references('nidn')->on('dosen')->onDelete('cascade');
            $table->foreign('dosen_pengta_2')->references('nidn')->on('dosen')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tugas_akhir');
    }
};
