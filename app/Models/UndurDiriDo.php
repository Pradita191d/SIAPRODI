<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UndurDiriDo extends Model
{
    use HasFactory;

    protected $table = 'undur_diri_do';

    protected $primaryKey = 'id_undur_diri_do';

    protected $fillable = [
        'nim',                
        'tanggal_pengajuan',  
        'tanggal_disetujui',  
        'alasan',             
        'status_pengajuan',   // Status: 'Diajukan', 'Disetujui', 'Ditolak'
        'keterangan',         
    ];
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim','nim');
    }
}

