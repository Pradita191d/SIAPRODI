<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TugasAkhir extends Model
{
    use HasFactory;

    protected $table = 'tugas_akhir';
    protected $primaryKey = 'id_ta';

    protected $fillable = [
        'nim',
        'tahun_akademik',
        'judul_ta',
        'nilai_ta',
        'sk_penguji_proposal',
        'dosen_pengprop_1',
        'dosen_pengprop_2',
        'sk_pembimbing_ta',
        'dosen_pemta_1',
        'dosen_pemta_2',
        'sk_penguji_ta',
        'dosen_pengta_1',
        'dosen_pengta_2',
    ];

    public function tahunAkademik()
    {
        return $this->belongsTo(TahunAkademik::class, 'tahun_akademik');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
    }

    public function dosenPengprop1()
    {
        return $this->belongsTo(Dosen::class, 'dosen_pengprop_1', 'nidn');
    }

    public function dosenPengprop2()
    {
        return $this->belongsTo(Dosen::class, 'dosen_pengprop_2', 'nidn');
    }

    public function dosenPemta1()
    {
        return $this->belongsTo(Dosen::class, 'dosen_pemta_1', 'nidn');
    }

    public function dosenPemta2()
    {
        return $this->belongsTo(Dosen::class, 'dosen_pemta_2', 'nidn');
    }

    public function dosenPengta1()
    {
        return $this->belongsTo(Dosen::class, 'dosen_pengta_1', 'nidn');
    }

    public function dosenPengta2()
    {
        return $this->belongsTo(Dosen::class, 'dosen_pengta_2', 'nidn');
    }

    public $bobotNilai = [
        ['min' => 80, 'max' => 100, 'huruf' => 'A', 'angka' => 4],
        ['min' => 70, 'max' => 79, 'huruf' => 'B', 'angka' => 3],
        ['min' => 60, 'max' => 69, 'huruf' => 'C', 'angka' => 2],
        ['min' => 50, 'max' => 59, 'huruf' => 'D', 'angka' => 1],
        ['min' => 0, 'max' => 49, 'huruf' => 'E', 'angka' => 0],
    ];

    public function getGrade($nilai)
    {
        foreach ($this->bobotNilai as $bobot) {
            if ($nilai >= $bobot['min'] && $nilai <= $bobot['max']) {
                return $bobot['huruf'];
            }
        }

        return 'Error';
    }
}
