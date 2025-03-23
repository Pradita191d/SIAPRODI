<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenelitianDosen extends Model
{
    use HasFactory;

    protected $table = 'penelitian_dosen';

    protected $primaryKey = 'id_penelitian';

    protected $guarded = [
        'id_penelitain'
    ];

    // Relasi ke tabel dosen (Satu penelitian dimiliki oleh satu dosen)
    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen', 'id_dosen'); // 'id_dosen' di penelitian_dosen merujuk ke 'id_dosen' di dosen
    }

    // Relasi ke model AnggotaPenelitian
    public function anggota()
    {
        return $this->hasMany(Anggota::class, 'id_penelitian', 'id_penelitian');
    }
}
