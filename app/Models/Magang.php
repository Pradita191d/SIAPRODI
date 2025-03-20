<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Magang extends Model
{
    protected $table = 'magang';
    use HasFactory;

    protected $fillable = [
        'nama_perusahaan',
        'jenis_perusahaan',
        'alamat_perusahaan',
        'pembimbing_lapangan',
        'no_perusahaan',
    ];

    public function mahasiswaMagang()
    {
        return $this->hasMany(MahasiswaMagang::class, 'id_perusahaan');
    }
}
