<?php

namespace App\Models;

use Carbon\Carbon;
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
        'no_reg',
        'tanggal_sert',
        'masa_berlaku',
        'file',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
    }

    public function getTanggalSertFormattedAttribute()
    {
        Carbon::setLocale('id');
        return Carbon::parse($this->tanggal_sert)->translatedFormat('d F Y');
    }

    public function getTanggalExpiredAttribute()
    {
        if (!$this->tanggal_sert || !$this->masa_berlaku) {
            return null;
        }

        Carbon::setLocale('id');
        return Carbon::parse($this->tanggal_sert)
            ->addYears((int) $this->masa_berlaku)
            ->translatedFormat('d F Y');
    }
}
