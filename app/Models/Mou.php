<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mou extends Model
{
    use HasFactory;

    protected $table = 'mou';

    protected $primaryKey = 'id_mou';

    protected $fillable = [
        'no_mou',
        'pihak_1',
        'pihak_2',
        'tanggal_mulai',
        'tanggal_berakhir',
        'tahun',
        'jenis_kerjasama',
        'kontak',
        // 'status_mou',
        'file_mou',
    ];

    // public function tahunAkademik()
    // {
    //     return $this->belongsTo(TahunAkademik::class, 'tahun', 'id_tahun_akademik');
    // }
    public function tahunAkademik()
    {
        return $this->belongsTo(TahunAkademik::class, 'tahun', 'id_tahun_akademik');
    }
}
