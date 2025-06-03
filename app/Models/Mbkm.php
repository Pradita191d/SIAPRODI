<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mbkm extends Model
{
    use HasFactory;

    protected $table = 'mbkm';
    protected $primaryKey = 'id';
     protected $fillable = ['nim', 'namaMhs', 'nama_program', 'namaLembaga', 'lokasi', 'bidangProgram', 'durasi', 'program_studi', 
     'jurusan', 'semester', 'no_hp', 'email', 'deskripsi', 'namaMatkul', 'sks', 'keterangan', 'dospem', 'koor_mbkm', 'kaprodi', 'catatan_tambahan'];

     public function mahasiswa()
     {
         return $this->belongsTo(Mahasiswa::class, 'nim', 'NIM');
     }
    

}
