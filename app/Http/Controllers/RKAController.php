<?php

namespace App\Http\Controllers;

use App\Models\TOR;
use Illuminate\Http\Request;
use App\Models\RKA;
use App\Models\Dosen;
use App\Models\TahunAkademik;

class RKAController extends Controller
{
    public function index()
    {
        $title = 'Halaman Pengajuan RKA | SiaPro';
        $rka = RKA::all();
        $tor = TOR::all();
        return view('rka.index', compact('rka', 'title', 'tor'));
    }

    public function create()
    {
        $title = 'Tambah RKA';
        $tahunAkademik = TahunAkademik::all();
        return view('rka.create', compact('title', 'tahunAkademik'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_tahun_akademik' => 'required',
            'judul' => 'required',
            'deskripsi' => 'required',
            'file' => 'required'
        ], [
            'id_tahun_akademik.required' => 'Tahun Akademik wajib diisi',
            'judul.required' => 'Judul wajib diisi',
            'deskripsi.required' => 'Deskripsi wajib diisi',
            'file.required' => 'File wajib diunggah'
        ]);

        do {
            $id_rka = rand();
        } while (RKA::where('id_rka', $id_rka)->exists());


        $rka = new RKA();
        $rka->id_rka = $id_rka;
        $rka->id_tahun_akademik = $request->id_tahun_akademik;
        $rka->judul = $request->judul;
        $rka->deskripsi = $request->deskripsi;
        $extension = $request->file('file')->getClientOriginalExtension();
        $filename = $request->judul . '-' . rand(1000, 9999) . '.' . $extension;
        $rka->file = $request->file('file')->storeAs('rka', $filename, 'public');
        $rka->save();
        return redirect()->route('rka.index')->with('success', 'RKA berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $rka = RKA::find($id);

        $tor = TOR::where('id_rka', $rka->id_rka)->first();
        if ($tor) {
            return redirect()->route('rka.index')->with('error', 'RKA tidak dapat dihapus karena sudah memiliki TOR terkait.');
        } else {
            $rka->delete();
            return redirect()->route('rka.index')->with('success', 'RKA berhasil dihapus');
        }
    }

    public function edit($id)
    {
        $title = 'Edit RKA';
        $rka = RKA::find($id);
        $tahunAkademik = TahunAkademik::all();
        return view('rka.edit', compact('title', 'rka', 'tahunAkademik'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_tahun_akademik' => 'required',
            'judul' => 'required',
            'deskripsi' => 'required',

        ], [
            'id_tahun_akademik.required' => 'Tahun Akademik wajib diisi',
            'judul.required' => 'Judul wajib diisi',
            'deskripsi.required' => 'Deskripsi wajib diisi',

        ]);

        $rka = RKA::find($id);
        if (!$rka) {
            return redirect()->route('rka.index')->with('error', 'RKA tidak ditemukan');
        }
        $rka->id_tahun_akademik = $request->id_tahun_akademik;
        $rka->judul = $request->judul;
        $rka->deskripsi = $request->deskripsi;

        if ($request->hasFile('file'))
            $rka->file = $request->file('file')->store('rka', 'public');

        $rka->save();

        return redirect()->route('rka.index')->with('success', 'RKA berhasil diubah');
    }
}
