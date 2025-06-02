<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Dosen;
use App\Models\Pkm;
use App\Models\Mahasiswa;

use Illuminate\Http\Request;

class PkmController extends Controller
{
    // public function index()
    // {
    //     $pkm = Pkm::with('dosen')->get();
    //     return view('pkm.index', compact('pkm'));
    // }

    public function index(Request $request)
{
    $search = $request->input('search'); // Ambil input pencarian

    $pkm = DB::table('pkm')
        ->join('dosen', 'pkm.nidn', '=', 'dosen.nidn')
        ->join('mahasiswa', 'pkm.nim', '=', 'mahasiswa.nim')
        ->select(
            'pkm.*',
            'dosen.nama_dosen as nama_dosen',
            'mahasiswa.nama_mahasiswa as nama_mahasiswa'
        )
        ->when($search, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('mahasiswa.nama_mahasiswa', 'like', "%$search%")
                    ->orWhere('pkm.judul', 'like', "%$search%")
                    ->orWhere('pkm.tahun', 'like', "%$search%");
            });
        })
        ->paginate(10); // Gunakan paginate agar tidak terlalu banyak data

    return view('pkm.index', compact('pkm'));
}
    

public function edit($id)
{
    $pkm = Pkm::findOrFail($id);
    $dosen = Dosen::all();
    $mahasiswa = Mahasiswa::all();

    return view('pkm.edit_pkm', compact('pkm', 'dosen', 'mahasiswa'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'nidn' => 'required',
        'nim' => 'required',
        'judul' => 'required|string|max:255',
        'tahun' => 'required|integer|min:2000|max:' . date('Y'),
        'lokasi' => 'required|string|max:255',
        'anggaran' => 'required|numeric|min:0',
        'status' => 'required|in:Berjalan,Gagal,Sukses',
    ]);

    $pkm = Pkm::findOrFail($id);
    $pkm->update([
        'nidn' => $request->nidn,
        'nama_dosen' => Dosen::where('nidn', $request->nidn)->first()->nama_dosen,
        'nim' => $request->nim,
        'nama_mahasiswa' => Mahasiswa::where('nim', $request->nim)->first()->nama_mahasiswa,
        'judul' => $request->judul,
        'tahun' => $request->tahun,
        'lokasi' => $request->lokasi,
        'anggaran' => $request->anggaran,
        'status' => $request->status,
    ]);

    return redirect()->route('pkm.index')->with('success', 'Data PKM berhasil diperbarui.');
}

    public function create()
{
    $dosen = Dosen::all();
    $mahasiswa = Mahasiswa::all(); // Ambil data mahasiswa dari database
    return view('pkm.tambah_pkm', compact('dosen', 'mahasiswa'));
}


public function destroy($id)
{
    $pkm = Pkm::find($id);
    if($pkm){
        $pkm->delete();

        return redirect()->route('pkm.index')->with('success', 'Data berhasil dihapus');
    }
}

    // Menyimpan data mahasiswa
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nidn' => 'required|string|exists:dosen,nidn|max:20',
            'nim' => 'required|string|exists:mahasiswa,nim|max:20',
            'judul' => 'required|string|max:255',
            'tahun' => 'required|integer|min:2000|max:' . date('Y'),
            'lokasi' => 'required|string|max:255',
            'anggaran' => 'required|numeric|min:0',
            'status' => 'required|in:Berjalan,Gagal,Sukses',
        ]);

        $exists = Pkm::where('nim', $request->nim)
                        ->exists();

        if($exists){
            return redirect()->route('pkm.create')->with('success', 'PKM tidak berhasil ditambahkan!');
        }

        // Simpan data mahasiswa ke dalam database
        Pkm::create([
            'nidn' => $request->nidn,
            'nim' => $request->nim,
            'judul' => $request->judul,
            'tahun' => $request->tahun,
            'lokasi' => $request->lokasi,
            'anggaran' => $request->anggaran,
            'status' => $request->status, 
        ]);
        // Redirect ke form tambah mahasiswa dengan pesan sukses
        return redirect()->route('pkm.index')->with('success', 'PKM berhasil ditambahkan!');
    }
}
