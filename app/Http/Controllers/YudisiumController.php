<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Yudisium; // Gunakan model yang sesuai
use App\Models\Mahasiswa; // Gunakan model yang sesuai
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class YudisiumController extends Controller
{
    public function index()
    {
        $yudisium = Yudisium::with('mahasiswa')->get();
        
        return view('yudisium.index', ['yudisium' => $yudisium]);
    }
    public function search(Request $request)
    { 
        if ($request->has('search')) {
            $yudisium = Yudisium::where('NIM', 'LIKE', '%'.$request->search . '%')->get();
        } else {
            $yudisium = Yudisium::all();
        }
        
        return view('yudisium.index', ['yudisium' => $yudisium]);
    }
    

    public function create()
    {
        $mahasiswa = Mahasiswa::all();
        $yudisium = Yudisium::all();
        return view('yudisium.create', compact('mahasiswa', 'yudisium'));
    }

    public function store(Request $request)
    {
            $request->validate([
                'NIM' => 'required|exists:mahasiswa,NIM',
                'semester' => 'required',
                'tgl_yudisium' => 'required|date',
                'lokasi' => 'required',
                'masalah' => 'required',
                'solusi_prodi' => 'required',
                'solusi_jurusan' => 'required',
            ]);

            // Simpan data ke database
            Yudisium::create([
                'NIM' => $request->NIM,
                'nama_mhs' => $request->nama_mhs,
                'semester' => $request->semester,
                'tgl_yudisium' => $request->tgl_yudisium,
                'lokasi' => $request->lokasi,
                'masalah' => $request->masalah,
                'solusi_prodi' => $request->solusi_prodi,
                'solusi_jurusan' => $request->solusi_jurusan,
            ]);

            return redirect()->route('yudisium.index')->with('success', 'Data yudisium berhasil ditambahkan.');
    }



    public function edit(string $id)
    { // Ambil data yudisium beserta data mahasiswa yang terkait
        $yudisium = Yudisium::with('mahasiswa')->where('id_yudisium', $id)->firstOrFail();
        
        // Ambil daftar mahasiswa untuk dropdown
        $mahasiswa = Mahasiswa::all();
    
        return view('yudisium.edit', compact('yudisium', 'mahasiswa'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'NIM' => 'required',
            'masalah' => 'nullable|string',
            'solusi_prodi' => 'nullable|string',
            'solusi_jurusan' => 'nullable|string',
            'tgl_yudisium' => 'nullable|date',
            'lokasi' => 'nullable|string',
        ]);
    
        $yudisium = Yudisium::findOrFail($id);
        $yudisium->update([
            'NIM' => $request->NIM,
            'masalah' => $request->masalah,
            'solusi_prodi' => $request->solusi_prodi,
            'solusi_jurusan' => $request->solusi_jurusan,
            'tgl_yudisium' => $request->tgl_yudisium,
            'lokasi' => $request->lokasi,
        ]);

    
        return redirect()->route('yudisium.index')->with('success', 'Data yudisium berhasil diperbarui.');
    }
    
    public function destroy(string $id)
    {
        $yudisium = Yudisium::find($id);

    if (!$yudisium) {
        return redirect()->route('yudisium.index')->with('error', 'Data tidak ditemukan');
    }

    $yudisium->delete();

    return redirect()->route('yudisium.index')->with('success', 'Data berhasil dihapus');
    }

    public function exportpdf()
    {
        $yudisium = Yudisium::all();

        // Debugging untuk cek apakah data ada
    // if ($yudisium->isEmpty()) {
    //     dd("Tidak ada data yudisium.");
    // } else {
    //     dd($yudisium->toArray()); // Menampilkan data sebelum ke PDF
    // }
        // $pdf = PDF::loadView('yudisium.cetak', ['yudisium' => $yudisium]);
        $pdf = PDF::loadView('yudisium.cetak', compact('yudisium'));
        return $pdf->download('yudisium-' . Carbon::now()->timestamp . '.pdf');
    }

    public function cetakyudisium()
    {
        $yudisium = Yudisium::all();
        return view('yudisium.cetak', ['yudisium' => $yudisium]);
    }
}
