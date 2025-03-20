<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SertMah extends Model
{
    use HasFactory;

    protected $table = 'sertifikat_mahasiswa';

    protected $fillable = [
        'nim',
        'nm_sert',
        'lembaga',
        'tanggal_sert',
        'masa_berlaku',
        'file',
    ];
}