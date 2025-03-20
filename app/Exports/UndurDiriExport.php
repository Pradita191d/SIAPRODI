<?php

namespace App\Exports;

use App\Models\UndurDiriDo;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UndurDiriExport implements FromQuery, WithHeadings, WithMapping, WithStyles
{
    public function query()
    {
        return UndurDiriDo::query()->select(
            'undur_diri_do.nim',
            'mahasiswa.nama_mahasiswa',
            'undur_diri_do.tanggal_pengajuan',
            'undur_diri_do.tanggal_disetujui',
            'undur_diri_do.alasan',
            'undur_diri_do.status_pengajuan',
            'undur_diri_do.keterangan'
        )->leftJoin('mahasiswa', 'undur_diri_do.nim', '=', 'mahasiswa.nim');
    }

    public function headings(): array
    {
        return [
            'NIM',
            'Nama Mahasiswa',
            'Tanggal Pengajuan',
            'Tanggal Disetujui',
            'Alasan',
            'Status Pengajuan',
            'Keterangan'
        ];
    }

    public function map($undurDiri): array
    {
        return [
            $undurDiri->nim ?? '-',
            $undurDiri->nama_mahasiswa ?? '-',
            $undurDiri->tanggal_pengajuan ?? '-',
            $undurDiri->tanggal_disetujui ?? '-',
            $undurDiri->alasan ?? '-',
            $undurDiri->status_pengajuan ?? '-',
            $undurDiri->keterangan ?? '-'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Apply green background to the header row
        $sheet->getStyle('A1:G1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF']
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '00A86B'] // Green color
            ],
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                    'color' => ['rgb' => 'FFFFFF'] // White border color
                ],
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => 'FFFFFF'] // White border color
                ]
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ]);
        
    }
}
