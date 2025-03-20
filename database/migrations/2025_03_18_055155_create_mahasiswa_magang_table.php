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
        Schema::create('mahasiswa_magang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_perusahaan');
            $table->string('nim', 255); // Same as in the mahasiswa table
            $table->integer('durasi');
            $table->text('bukti_nilai'); // To store file URLs later
            $table->integer('nilai')->max(100); // Max value of 100
            $table->timestamps();
    
            // Foreign key to link the 'id_perusahaan' with 'magang' table
            $table->foreign('id_perusahaan')->references('id')->on('magang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa_magang');
    }
};
