<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TOR extends Model
{
    protected $table = 'tor';
    protected $primaryKey = 'id_tor';
    protected $fillable = [
        'nama_tor',
        'deskripsi',
        'proposal',
        'id_rka',
    ];

    public function rka()
    {
        return $this->belongsTo(RKA::class, 'id_rka', 'id_rka');
    }
}
