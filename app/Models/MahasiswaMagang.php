<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaMagang extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa_magang'; // Define the table explicitly

    protected $fillable = [
        'id_perusahaan',
        'nim',
        'durasi',
        'bukti_nilai',
        'nilai',
        'tahun_ajaran',
    ];
    
    // Define relationship to Magang model
    public function magang()
    {
        return $this->belongsTo(Magang::class, 'id_perusahaan');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
    }

}
