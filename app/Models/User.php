<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;


    protected $table = 'users';         // your table name
    protected $primaryKey = 'id_user';  // custom primary key
    public $incrementing = true;        // true if auto-increment
    protected $keyType = 'int';         

    protected $fillable = ['username', 'role', 'password'];

    // If you want to customize auth identifier:
    public function getAuthIdentifierName()
    {
        return 'id_user';
    }

    protected $hidden = [
        'password',
    ];
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin');
    }
}
