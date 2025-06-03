<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\PemanggilanOrangtuaController;


class PemanggilanOrangtua extends Model
{
    use HasFactory;

    protected $table = 'pemanggilan_orangtua'; // Nama tabel
    protected $fillable = [
        'nama_ortu',
        'no_telp_ortu',
        'alamat',
        'nim',
        'semester',
        'jurusan',
        'prodi',
        'tanggal_pemanggilan',
        'alasan_pemanggilan',
        'solusi'
    ];
        public function mahasiswa()
    {
        return $this->belongsTo(MahasiswaModel::class, 'nim', 'nim');
    }

}
