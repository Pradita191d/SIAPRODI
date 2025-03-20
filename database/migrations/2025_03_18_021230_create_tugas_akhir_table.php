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
            $table->unsignedBigInteger('nim');
            $table->unsignedBigInteger('tahun_akademik'); // Sesuai dengan tabel tahun akademik
            $table->string('judul_ta');
            $table->integer('nilai_ta');
            $table->timestamps();

            // Foreign key
            $table->foreign('tahun_akademik')->references('id_tahun_akademik')->on('tahun_akademik')->onDelete('cascade');
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
