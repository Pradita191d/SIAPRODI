<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wisuda extends Model
{
    protected $table = 'wisuda';

    protected $fillable = ['nim', 'tahun_masuk', 'status_wisuda', 'tahun_wisuda','tahun_wisuda_id'];

    public function tampilMahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim'); // Pastikan foreign key benar
    }
    
    public function tahunWisuda()
    {
        return $this->belongsTo(TahunWisudaModel::class, 'tahun_wisuda_id', 'id');
    }
    public function mahasiswa()
    {
        return $this->belongsTo(MahasiswaModel::class, 'nim', 'nim');
    }

    public function sk()
    {
        return $this->belongsTo(TahunWisudaModel::class, 'tahun_wisuda_id', 'id');
    }
}
