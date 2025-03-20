<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tor', function (Blueprint $table) {
            $table->id('id_tor')->primary()->autoIncrement();
            $table->string('nama_tor');
            $table->string('deskripsi');
            $table->string('proposal');
            $table->integer('id_rka');
            $table->foreign('id_rka')->references('id_rka')->on('rka');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tor');
    }
};
