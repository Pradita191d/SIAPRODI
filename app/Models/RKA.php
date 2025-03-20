<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RKA extends Model
{
    protected $table = 'rka';
    protected $primaryKey = 'id_rka';
    protected $fillable = [
        'judul',
        'deskripsi',
        'id_tahun_akademik',
        'file',
    ];

    public function tahun_akademik()
    {
        return $this->belongsTo(TahunAkademik::class, 'id_tahun_akademik');
    }
}
