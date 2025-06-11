<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosen';

    protected $primaryKey = 'id_dosen';

    protected $fillable = [
        'nidn',
        'nip',
        'nama_dosen',
        'alamat',
        'no_telp',
        'jabatan_fungsional',
        'pangkat',
        'golongan',
        'no_serdos',
        'status_dosen',
    ];
}