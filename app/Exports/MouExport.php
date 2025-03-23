<?php

namespace App\Exports;

use App\Models\Mou;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MouExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Mou::join('tahun_akademik', 'mou.tahun', '=', 'tahun_akademik.id_tahun_akademik')
            ->select(
                'mou.no_mou',
                'mou.pihak_1',
                'mou.pihak_2',
                'mou.tanggal_mulai',
                'mou.tanggal_berakhir',
                'tahun_akademik.tahun AS tahun_akademik', // Ambil dari tabel tahun_akademik
                'mou.jenis_kerjasama',
                'mou.kontak',
                \DB::raw("CONCAT('" . asset('storage/mou_files/') . "/', mou.file_mou) as file_mou")
            )->get();
    }

    public function headings(): array
    {
        return [
            'No MoU',
            'Pihak 1',
            'Pihak 2',
            'Tanggal Mulai',
            'Tanggal Berakhir',
            'Tahun Akademik', // Ubah label sesuai data yang diambil
            'Jenis Kerjasama',
            'Kontak',
            'Dokumen MoU',
        ];
    }
}
