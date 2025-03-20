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
        Schema::create('magang', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('nama_perusahaan'); // varchar equivalent
            $table->string('jenis_perusahaan'); // varchar equivalent
            $table->text('alamat_perusahaan'); // text equivalent
            $table->string('pembimbing_lapangan'); // varchar equivalent
            $table->integer('no_perusahaan'); // int equivalent (for telephone number)
            $table->timestamps(); // created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('magang');
    }
};
