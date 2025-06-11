<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\SertMah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SertMahController extends Controller
{
    public function index(Request $request)
    {
        $query = SertMah::with('mahasiswa');

        if ($request->has('tahun_terbit') && $request->tahun_terbit != '') {
            $query->whereYear('tanggal_sert', $request->tahun_terbit);
        }

        if ($request->has('tahun_berlaku') && $request->tahun_berlaku != '') {
            // Filter berdasarkan tahun expired (tanggal_sert + masa_berlaku tahun)
            $query->whereRaw(
                "YEAR(DATE_ADD(tanggal_sert, INTERVAL masa_berlaku YEAR)) = ?",
                [$request->tahun_berlaku]
            );
        }

        $sertikoma = $query->get();
        $mahasiswa = Mahasiswa::all();

        return view('sertifikat_mahasiswa.index', [
            'sertikoma' => $sertikoma,
            'mahasiswa' => $mahasiswa
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|exists:mahasiswa,nim',
            'nm_sert' => 'required|string|max:255',
            'lembaga' => 'required|string|max:255',
            'tanggal_sert' => 'required',
            'masa_berlaku' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $path = $request->file('file')->store('sertifikat', 'public');
        SertMah::create([
            'nim' => $request->nim,
            'nm_sert' => $request->nm_sert,
            'lembaga' => $request->lembaga,
            'tanggal_sert' => $request->tanggal_sert,
            'masa_berlaku' => $request->masa_berlaku,
            'file' => $path,
        ]);

        return redirect()->route('sertifikat_mahasiswa.index')->with('success', 'Sertifikat Kopetensi Mahasiswa berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $sertikoMa = SertMah::findOrFail($id);
        $mahasiswa = Mahasiswa::all();

        return view('sertifikat_mahasiswa.index', [
            'sertikoMa' => $sertikoMa,
            'mahasiswa' => $mahasiswa
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nim' => 'required|exists:mahasiswa,nim',
            'nm_sert' => 'required|string|max:255',
            'lembaga' => 'required|string|max:255',
            'tanggal_sert' => 'required',
            'masa_berlaku' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $sertikoMa = SertMah::findOrFail($id);
        $sertikoMa->nim = $request->nim;
        $sertikoMa->nm_sert = $request->nm_sert;
        $sertikoMa->lembaga = $request->lembaga;
        $sertikoMa->tanggal_sert = $request->tanggal_sert;
        $sertikoMa->masa_berlaku = $request->masa_berlaku;
        if ($request->hasFile('file')) {
            if ($sertikoMa->file && Storage::disk('public')->exists($sertikoMa->file)) {
                Storage::disk('public')->delete($sertikoMa->file);
            }
            $path = $request->file('file')->store('sertifikat', 'public');
            $sertikoMa->file = $path;
        }

        $sertikoMa->save();

        return redirect()->route('sertifikat_mahasiswa.index')->with('success', 'Sertifikat Kopetensi Mahasiswa berhasil diperbarui!');
    }


    public function destroy($id)
    {
        $sertikoMa = SertMah::findOrFail($id);
        if ($sertikoMa->file && Storage::disk('public')->exists($sertikoMa->file)) {
            Storage::disk('public')->delete($sertikoMa->file);
        }
        $sertikoMa->delete();

        return redirect()->route('sertifikat_mahasiswa.index')->with('success', 'Sertifikat Kopetensi Mahasiswa berhasil dihapus!');
    }
}
