<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('ipk', function (Blueprint $table) {
            $table->id('id_ipk');
            $table->string('nim');
            $table->decimal('ipk', 3, 2);
            $table->string('keterangan')->nullable();
            $table->foreign('nim')->references('nim')->on('mahasiswa')->onDelete('cascade');
            $table->timestamps(); // Menambahkan created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('ipk');
    }
};