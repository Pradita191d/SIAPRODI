<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $table = 'anggota';

    protected $primaryKey = 'id_anggota';

    protected $fillable = [
        'id_penelitian',
        'nama_anggota',
    ];

    public function penelitian() {
        return $this->belongsTo(PenelitianDosen::class, 'id_penelitian', 'id_penelitian');
    }
}
