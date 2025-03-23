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
        Schema::create('mou', function (Blueprint $table) {
            $table->id('id_mou');
            $table->string('no_mou');
            $table->string('pihak_1');
            $table->string('pihak_2');
            $table->date('tanggal_mulai');
            $table->date('tanggal_berakhir');
            $table->string('tahun');
            $table->string('jenis_kerjasama');
            $table->string('kontak');
            // $table->enum('status_mou', ['Aktif', 'Tidak Aktif']);
            $table->string('file_mou')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mou');
    }
};
