<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sertikom extends Model
{
    use HasFactory;

    protected $table = 'sertikom';
    protected $primaryKey = 'id_sertikom';
    public $timestamps = true; // Jika tabel tidak memiliki kolom created_at & updated_at

    protected $fillable = [
        'nidn',
        'nama_sertifikat',
        'bidang_keahlian',
        'nama_lembaga',
        'tanggal_terbit',
        'berlaku_sampai',
        'doc_sertifikat',
    ];

    // Relasi ke tabel dosen
    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'nidn', 'nidn'); // (Model, foreignKey, primaryKey)
    }
}
