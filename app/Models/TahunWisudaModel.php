<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TahunWisudaModel extends Model
{
    protected $table = 'tahun_wisuda';

    protected $fillable = ['tahun_wisuda','sk_wisuda']; 
    // public function tahun()
    // {
    //     return $this->hasOne(TahunWisudaModel::class, 'id', 'tahun_wisuda');
    // }
}
