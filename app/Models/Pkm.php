<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pkm extends Model
{
    protected $table = 'pkm';
    protected $primaryKey = 'id_pkm';
    public $timestamps = false; // Tambahkan jika tidak menggunakan timestamps

    protected $fillable = [
        'nidn',
        'nim',
        'judul',
        'tahun',
        'lokasi',
        'anggaran',
        'status',
    ];

    // Relasi ke tabel Dosen
    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'nidn', 'nidn');
    }

    public function mahasiswa()
{
    return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
}
}
