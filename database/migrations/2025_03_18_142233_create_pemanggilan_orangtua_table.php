<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemanggilanOrangtuaTable extends Migration
{
    public function up()
    {
        Schema::create('pemanggilan_orangtua', function (Blueprint $table) {
            $table->bigIncrements('id'); // Kolom auto increment primary key
            $table->string('nama_ortu');
            $table->string('no_telp_ortu');
            $table->string('alamat');
            $table->string('nama_mhs');
            $table->integer('nim'); // Hapus auto_increment dari sini
            $table->unsignedInteger('semester')->default(1);
            $table->string('jurusan');
            $table->string('prodi');
            $table->text('alasan_pemanggilan');
            $table->text('solusi');
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('pemanggilan_orangtua');
    }
}
