<?php

namespace App\Http\Controllers;

use App\Models\TugasAkhir;
use App\Models\TahunAkademik;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TugasAkhirExport;

class TaController extends Controller
{
    public function index()
    {
        $tugas_akhirs = TugasAkhir::with([
            'tahunAkademik',
            'mahasiswa',
            'dosenPengprop1',
            'dosenPengprop2',
            'dosenPemta1',
            'dosenPemta2',
            'dosenPengta1',
            'dosenPengta2'
        ])->get();

        $tahunAkademik = TahunAkademik::all();
        $dosens = Dosen::all();

        return view('tugas_akhir.index', compact('tugas_akhirs', 'tahunAkademik', 'dosens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|exists:mahasiswa,nim',
            'judul_ta' => 'required|string|max:255',
            'nilai_ta' => 'required|integer',
            'tahun_akademik' => 'required|exists:tahun_akademik,id_tahun_akademik',
            'sk_penguji_proposal' => 'required|string|max:255',
            'dosen_pengprop_1' => 'required|exists:dosen,nidn',
            'dosen_pengprop_2' => 'required|exists:dosen,nidn',
            'sk_pembimbing_ta' => 'required|string|max:255',
            'dosen_pemta_1' => 'required|exists:dosen,nidn',
            'dosen_pemta_2' => 'required|exists:dosen,nidn',
            'sk_penguji_ta' => 'required|string|max:255',
            'dosen_pengta_1' => 'required|exists:dosen,nidn',
            'dosen_pengta_2' => 'required|exists:dosen,nidn',
        ]);

        TugasAkhir::create($request->all());

        return redirect()->route('tugas_akhir.index')->with('success', 'Tugas Akhir berhasil ditambahkan!');
    }

    public function update(Request $request, $id_ta)
    {
        $request->validate([
            'nim' => 'required|exists:mahasiswa,nim',
            'judul_ta' => 'required|string|max:255',
            'nilai_ta' => 'required|integer',
            'tahun_akademik' => 'required|exists:tahun_akademik,id_tahun_akademik',
            'sk_penguji_proposal' => 'required|string|max:255',
            'dosen_pengprop_1' => 'required|exists:dosen,nidn',
            'dosen_pengprop_2' => 'required|exists:dosen,nidn',
            'sk_pembimbing_ta' => 'required|string|max:255',
            'dosen_pemta_1' => 'required|exists:dosen,nidn',
            'dosen_pemta_2' => 'required|exists:dosen,nidn',
            'sk_penguji_ta' => 'required|string|max:255',
            'dosen_pengta_1' => 'required|exists:dosen,nidn',
            'dosen_pengta_2' => 'required|exists:dosen,nidn',
        ]);

        $tugasAkhir = TugasAkhir::findOrFail($id_ta);
        $tugasAkhir->update($request->all());

        return redirect()->route('tugas_akhir.index')->with('success', 'Tugas Akhir berhasil diperbarui!');
    }

    public function destroy($id_ta)
    {
        $tugasAkhir = TugasAkhir::findOrFail($id_ta);
        $tugasAkhir->delete();

        return redirect()->route('tugas_akhir.index')->with('success', 'Tugas Akhir berhasil dihapus!');
    }

    public function export()
    {
        return Excel::download(new TugasAkhirExport, 'tugas_akhir.xlsx');
    }
}
