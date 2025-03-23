<?php

namespace App\Exports;

use App\Models\PemanggilanOrangtua;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PemanggilanOrangtuaExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return PemanggilanOrangtua::select(
            'nama_ortu', 'no_telp_ortu', 'alamat', 'nama_mhs',
            'nim', 'semester', 'jurusan', 'prodi',
            'tanggal_pemanggilan', 'alasan_pemanggilan', 'solusi'
        )->get();
    }

    public function headings(): array
    {
        return [
            'Nama Orang Tua', 'No. Telp Orang Tua', 'Alamat', 'Nama Mahasiswa',
            'NIM', 'Semester', 'Jurusan', 'Prodi',
            'Tanggal Pemanggilan', 'Alasan Pemanggilan', 'Solusi'
        ];
    }
}
