<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ipk extends Model
{
    use HasFactory;

    protected $table = 'ipk'; // Nama tabel di database

    protected $primaryKey = 'id_ipk';
    
    protected $fillable = ['nim', 'ipk', 'keterangan'];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
    }
}
