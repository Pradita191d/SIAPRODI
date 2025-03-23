<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Pres_mhs;
use Illuminate\Http\Request;

use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class PresMhsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $pres_mhs = Pres_mhs::all();
        $pres_mhs = Pres_mhs::with('mahasiswa')->get();

        return view('prestasi.index', ['pres_mhs' => $pres_mhs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mahasiswa = Mahasiswa::all();
        $pres_mhs = Pres_mhs::all();
        return view('prestasi.create', compact('mahasiswa', 'pres_mhs'));

        //  return view('admin.barang.create', compact('kat_barang', 'barang'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'NIM' => 'required|exists:mahasiswa,NIM',
            'jenis_pres' => 'required',
            'penyelenggara' => 'required',
            'tahun' => 'required',
            'tingkat_pres' => 'required',
            'juara' => 'required',
            'file_sertif' => 'required|mimes:pdf|max:2048', // Hanya menerima PDF max 2MB
        ]);


        // Inisialisasi variabel untuk menyimpan nama file
        $fileName = null;

        // Jika ada file yang diunggah, simpan hanya file PDF
        if ($request->hasFile('file_sertif')) {
            $file = $request->file('file_sertif');
            if ($file->getClientOriginalExtension() === 'pdf') { // Hanya simpan jika file PDF
                $fileName = $file->getClientOriginalName();
                $file->move(public_path('sertifikat'), $fileName); // Simpan di public/sertifikat/
            }
        }

        // Simpan data ke database hanya sekali!
        Pres_mhs::create([
            'NIM' => $request->NIM,
            'jenis_pres' => $request->jenis_pres,
            'penyelenggara' => $request->penyelenggara,
            'tahun' => $request->tahun,
            'tingkat_pres' => $request->tingkat_pres,
            'juara' => $request->juara,
            'file_sertif' => $fileName, // Simpan hanya nama file PDF
        ]);

        return redirect('/prestasi');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $mahasiswa = Mahasiswa::all();
        $pres_mhs = Pres_mhs::find($id);
        return view('prestasi.edit', ['pres_mhs' => $pres_mhs], ['mahasiswa' => $mahasiswa]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'NIM' => 'required',
            'jenis_pres' => 'required|string',
            'penyelenggara' => 'required|string',
            'tahun' => 'required|digits:4',
            'tingkat_pres' => 'required|string',
            'juara' => 'required|string',
            'file_sertif' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $pres_mhs = Pres_mhs::find($id);
        $pres_mhs->NIM = $request->NIM;
        $pres_mhs->jenis_pres = $request->jenis_pres;
        $pres_mhs->penyelenggara = $request->penyelenggara;
        $pres_mhs->tahun = $request->tahun;
        $pres_mhs->tingkat_pres = $request->tingkat_pres;
        $pres_mhs->juara = $request->juara;

        // Handle upload foto
        if ($request->hasFile('file_sertif')) {
            $fotoName = $request->file('file_sertif')->getClientOriginalName(); // Gunakan nama asli

            // Hapus file foto lama jika ada
            if ($pres_mhs->file_sertif && file_exists(public_path('sertifikat/' . $pres_mhs->file_sertif))) {
                unlink(public_path('sertifikat/' . $pres_mhs->file_sertif));
            }

            // Simpan foto baru dengan nama aslinya
            $request->file('file_sertif')->move(public_path('sertifikat/'), $fotoName);
            $pres_mhs->file_sertif = $fotoName;
        }

        $pres_mhs->save();

        return redirect('/prestasi')->with('success', 'Prestasi mahasiswa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pres_mhs = Pres_mhs::find($id);
        $pres_mhs->delete();
        return redirect('/prestasi');
    }

    public function search(Request $request)
    {
        if ($request->has('search')) {
            $pres_mhs = Pres_mhs::where('tahun', 'LIKE', '%' . $request->search . '%')->get();
        } else {
            $pres_mhs = Pres_mhs::all();
        }
        return view(
            'prestasi.index',
            ['pres_mhs' => $pres_mhs]
        );
    }

    public function exportpdf(PDF $pdf)
    {
        $pres_mhs = Pres_mhs::all();

        $pdf = PDF::loadView('prestasi.cetak', ['pres_mhs' => $pres_mhs]);
        return $pdf->download('prestasi-' . Carbon::now()->timestamp . '.pdf');
    }


    public function cetakprestasi()
    {
        $pres_mhs = Pres_mhs::all();
        return view('prestasi.cetak', ['pres_mhs' => $pres_mhs]);
    }
}
