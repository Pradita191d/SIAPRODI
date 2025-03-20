<?php

namespace App\Exports;

use App\Models\TugasAkhir;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class TugasAkhirExport implements FromCollection, WithHeadings, WithMapping
{
    private $nomor = 0; // Untuk nomor urut

    public function collection()
    {
        return TugasAkhir::with('mahasiswa', 'tahunAkademik')->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'NIM',
            'Nama Mahasiswa',
            'Tahun Akademik',
            'Judul TA',
            'Nilai TA',
            'Grade',
        ];
    }

    public function map($tugasAkhir): array
    {
        return [
            ++$this->nomor, // Nomor urut otomatis
            $tugasAkhir->nim,
            $tugasAkhir->mahasiswa->nama_mahasiswa ?? '-',
            $tugasAkhir->tahunAkademik->tahun ?? '-',
            $tugasAkhir->judul_ta,
            $tugasAkhir->nilai_ta,
            $tugasAkhir->getGrade($tugasAkhir->nilai_ta),
        ];
    }
}
