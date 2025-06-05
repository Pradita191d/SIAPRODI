<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';

    protected $primaryKey = 'id_mahasiswa';

    protected $fillable = [
        'nim',
        'nama_mahasiswa',
        'no_hp',
        'no_ortu',
        'alamat',
        'tahun_masuk',
        'status_aktif',
    ];


    public function tahunAkademik()
    {
        return $this->belongsTo(TahunAkademik::class, 'tahun_masuk', 'id_tahun_akademik');
    }

    public function ipk()
    {
        return $this->hasOne(Ipk::class, 'nim', 'nim');
    }
}
