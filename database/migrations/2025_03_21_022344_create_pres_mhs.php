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
        Schema::create('pres_mhs', function (Blueprint $table) {
            $table->id();
            $table->integer('NIM');
            $table->string('jenis_pres', 255);
            $table->string('penyelenggara', 100);
            $table->integer('tahun');
            $table->string('tingkat_pres', 50);
            $table->string('juara', 100);
            $table->string('file_sertif', 100);
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pres_mhs');
    }
};
