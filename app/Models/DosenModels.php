<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DosenModels extends Model
{
    use HasFactory;

    protected $table = 'dosen';

    protected $fillable = [
        'id_dosen',
        'nama_dosen',
        'nidn',
        'jabatan_fung',
        'no_serdos',
        'email',
        'no_hp',
    ];
}
