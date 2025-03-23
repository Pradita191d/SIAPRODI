<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pres_mhs extends Model
{
    protected $table = 'pres_mhs';
    protected $fillable = ['id', 'NIM', 'jenis_pres', 'penyelenggara', 'tahun', 'tingkat_pres', 'juara', 'file_sertif'];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'NIM', 'NIM');
    }
}
