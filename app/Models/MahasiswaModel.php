<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MahasiswaModel extends Model
{
    protected $table = 'mahasiswa';
    public function wisuda()
    {
        return $this->hasOne(WisudaModel::class, 'nim', 'nim');
    }
}
