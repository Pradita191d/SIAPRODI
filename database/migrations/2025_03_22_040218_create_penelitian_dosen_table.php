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
        Schema::create('penelitian_dosen', function (Blueprint $table) {
            $table->id('id_penelitian');
            $table->unsignedBigInteger('id_dosen');
            $table->foreign('id_dosen')->references('id_dosen')->on('dosen')->onDelete('cascade');
            $table->string('judul_penelitian');
            $table->year('tahun_penelitian');
            $table->string('skema_penelitian', 100);
            $table->string('sumber_dana', 100);
            $table->decimal('dana_penelitian', 15,2);
            $table->enum('status_penelitian', ['Dalam proses', 'Selesai', 'Dibatalkan']);
            $table->string('file_penelitian', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penelitian_dosen');
    }
};
