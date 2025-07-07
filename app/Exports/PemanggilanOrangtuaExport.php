<?php

namespace App\Exports;

use App\Models\PemanggilanOrangtua;
use App\Models\Mahasiswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PemanggilanOrangtuaExport implements FromCollection, WithHeadings
{
public function collection()
{
    return PemanggilanOrangtua::with('mahasiswa') // eager load relation
        ->get()
        ->map(function ($item) {
            return [
                'nama_ortu' => $item->nama_ortu,
                'no_telp_ortu' => $item->no_telp_ortu,
                'alamat' => $item->alamat,
                'nama_mhs' => $item->mahasiswa->nama_mahasiswa ?? '-', // via relation
                'nim' => $item->nim,
                'semester' => $item->semester,
                'jurusan' => $item->jurusan,
                'prodi' => $item->prodi,
                'tanggal_pemanggilan' => $item->tanggal_pemanggilan,
                'alasan_pemanggilan' => $item->alasan_pemanggilan,
                'solusi' => $item->solusi,
            ];
        });
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
