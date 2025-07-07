<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaMagang extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa_magang'; // Define the table explicitly

    protected $fillable = [
        'id_perusahaan',
        'nim',
        'durasi',
        'bukti_nilai',
        'nilai',
        'tahun_ajaran',
        'nilai_dosen',
        'no_surat',
        'dosen_id',
    ];
    
    // Define relationship to Magang model
    public function magang()
    {
        return $this->belongsTo(Magang::class, 'id_perusahaan');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
    }

    public function dosen()
    {
            return $this->belongsTo(Dosen::class, 'dosen_id', 'id_dosen');
    }

    // In your MahasiswaMagang model
    public function getTotalNilaiAttribute()
    {
        if (is_null($this->nilai) || is_null($this->nilai_dosen)) {
            return null;
        }
        
        return ($this->nilai * 0.6) + ($this->nilai_dosen * 0.4);
    }

    public function getHurufNilaiAttribute()
    {
        $total = $this->total_nilai;
        
        if (is_null($total)) return 'N/A';
        
        if ($total >= 80) return 'A';
        if ($total >= 70) return 'B';
        if ($total >= 60) return 'C';
        if ($total >= 50) return 'D';
        return 'E';
    }
}
