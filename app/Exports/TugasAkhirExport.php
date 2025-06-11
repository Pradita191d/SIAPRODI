<?php

namespace App\Exports;

use App\Models\TugasAkhir;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TugasAkhirExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    private $nomor = 0;

    public function collection()
    {
        return TugasAkhir::with([
            'mahasiswa',
            'tahunAkademik',
            'dosenPengprop1',
            'dosenPengprop2',
            'dosenPemta1',
            'dosenPemta2',
            'dosenPengta1',
            'dosenPengta2',
        ])->get();
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
            'SK Penguji Proposal',
            'Penguji Proposal 1',
            'Penguji Proposal 2',
            'SK Pembimbing TA',
            'Pembimbing 1',
            'Pembimbing 2',
            'SK Penguji TA',
            'Penguji TA 1',
            'Penguji TA 2',
        ];
    }

    public function map($ta): array
    {
        return [
            ++$this->nomor,
            $ta->nim,
            $ta->mahasiswa->nama_mahasiswa ?? '-',
            $ta->tahunAkademik->tahun ?? '-',
            $ta->judul_ta,
            $ta->nilai_ta,
            $ta->getGrade($ta->nilai_ta),
            $ta->sk_penguji_proposal,
            $ta->dosenPengprop1->nama_dosen ?? '-',
            $ta->dosenPengprop2->nama_dosen ?? '-',
            $ta->sk_pembimbing_ta,
            $ta->dosenPemta1->nama_dosen ?? '-',
            $ta->dosenPemta2->nama_dosen ?? '-',
            $ta->sk_penguji_ta,
            $ta->dosenPengta1->nama_dosen ?? '-',
            $ta->dosenPengta2->nama_dosen ?? '-',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Menentukan jumlah kolom (A sampai P = 16 kolom)
        $lastColumn = 'P';

        // Rata tengah semua sel (termasuk data dan header)
        $sheet->getStyle("A1:{$lastColumn}" . ($sheet->getHighestRow()))
            ->getAlignment()
            ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Header tebal
        $sheet->getStyle("A1:{$lastColumn}1")->getFont()->setBold(true);

        return [];
    }
}
