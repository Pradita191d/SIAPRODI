<?php

namespace App\Http\Controllers;

use App\Models\TugasAkhir;
use App\Models\TahunAkademik;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TugasAkhirExport;

class TaController extends Controller
{
    public function index()
    {
        $tugas_akhirs = TugasAkhir::with('tahunAkademik')->get();
        $tahunAkademik = TahunAkademik::all();

        return view('tugas_akhir.index', compact('tugas_akhirs', 'tahunAkademik'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|exists:mahasiswa,nim',
            'judul_ta' => 'required|string|max:255',
            'nilai_ta' => 'required|integer',
            'tahun_akademik' => 'required|exists:tahun_akademik,id_tahun_akademik',
        ]);


        TugasAkhir::create([
            'nim' => $request->nim,
            'judul_ta' => $request->judul_ta,
            'nilai_ta' => $request->nilai_ta,
            'tahun_akademik' => $request->tahun_akademik,
        ]);

        return redirect()->route('tugas_akhir.index')->with('success', 'Tugas Akhir berhasil ditambahkan!');
    }

    public function update(Request $request, $id_ta)
    {
        $request->validate([
            'nim' => 'required|exists:mahasiswa,nim',
            'judul_ta' => 'required|string|max:255',
            'nilai_ta' => 'required|integer',
            'tahun_akademik' => 'required|exists:tahun_akademik,id_tahun_akademik',
        ]);

        $tugasAkhir = TugasAkhir::findOrFail($id_ta);
        $tugasAkhir->nim = $request->nim;
        $tugasAkhir->judul_ta = $request->judul_ta;
        $tugasAkhir->nilai_ta = $request->nilai_ta;
        $tugasAkhir->tahun_akademik = $request->tahun_akademik;

        $tugasAkhir->save();

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
