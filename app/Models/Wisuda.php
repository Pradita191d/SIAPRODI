<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wisuda extends Model
{
    protected $table = 'wisuda';

    protected $fillable = ['nim', 'tahun_masuk', 'status_wisuda', 'tahun_wisuda'];

    public function tampilMahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim'); // Pastikan foreign key benar
    }
    
    public function tahunWisuda()
    {
        return $this->belongsTo(TahunWisudaModel::class, 'tahun_wisuda_id', 'id');
    }

}
