<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\TahunAkademik;

class mahasiswaController extends Controller
{
    public $search = '';

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'nama_mahasiswa' => 'required|string|max:255',
            'nim' => 'required|string|max:20|unique:mahasiswa,nim',
            'no_hp' => 'required|string|max:15',
            'no_ortu' => 'required|string|max:15',
            'alamat' => 'required|string',
            'tahun_masuk' => 'required|string',
        ]);

        Mahasiswa::create($validatedData);

        return redirect()->back()->with('success', 'Mahasiswa berhasil ditambahkan!');
    }

    public function edit(Request $request, $id)
    {
        try {
            // Validasi input
            $validatedData = $request->validate([
                'nama_mahasiswa' => 'required|string|max:255',
                'no_hp' => 'required|string|max:15',
                'no_ortu' => 'required|string|max:15',
                'alamat' => 'required|string',
                'status_aktif' => 'required',
            ]);

            // Cari mahasiswa berdasarkan ID
            $mahasiswa = Mahasiswa::findOrFail($id);

            // Update data mahasiswa
            $mahasiswa->update([
                'nama_mahasiswa' => $validatedData['nama_mahasiswa'],
                'no_hp' => $validatedData['no_hp'],
                'alamat' => $validatedData['alamat'],
                'status_aktif' => $validatedData['status_aktif'],
            ]);

            return redirect()->back()->with('success', 'Mahasiswa berhasil diperbarui!');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $mahasiswa = Mahasiswa::findOrFail($id);
            $mahasiswa->delete();

            return redirect()->back()->with('success', 'Mahasiswa berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function cari(Request $request)
    {
        // menangkap data pencarian
        $cari = $request->cari;
        $tahun = TahunAkademik::where ('tahun', 'like', "%" . $cari . "%")
            ->get();
        $tahunAkademiks = TahunAkademik::all();

        // mengambil data dari table mahasiswa sesuai pencarian data
        $mahasiswas = Mahasiswa::where('nama_mahasiswa', 'like', "%" . $cari . "%")
            ->orWhere('nim', 'like', "%" . $cari . "%")
            ->orWhere('tahun_masuk', 'like', "%" . $tahun . "%")
            ->orWhere('status_aktif', 'like', "%" . $cari . "%")
            ->paginate();

        // mengirim data mahasiswa ke view index
        return view('mahasiswa.index', ['mahasiswas' => $mahasiswas
            , 'tahunAkademiks' => $tahunAkademiks]);

    }

    public function filter(Request $request)
    {
        $tahun = $request->tahun_masuk;
        $tahunAkademiks = TahunAkademik::all();
        $mahasiswas = Mahasiswa::where('tahun_masuk', $tahun)->paginate();
        return view('mahasiswa.index', compact('mahasiswas', 'tahunAkademiks'));
    }

}
