<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mahasiswa;

class Yudisium extends Model
{
    use HasFactory;
    protected $table = 'yudisium'; 
    protected $primaryKey = 'id_yudisium';
    protected $fillable = [ 'id_yudisium', 'NIM','masalah', 'solusi_prodi', 'solusi_jurusan', 'tgl_yudisium', 'lokasi', 'semester'];
    // public $timestamps = false;

 public function mahasiswa()
 {
    return $this->belongsTo(Mahasiswa::class, 'NIM', 'nim');
 }
    
}
