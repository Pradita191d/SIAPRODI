<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index()
    {
        $dosen = Dosen::all(); // Ambil semua data dosen tanpa relasi
        return view('dosen.index', compact('dosen'));
    }

    public function create()
    {
        return view('dosen.tambah_dosen');
    }

    // Menyimpan data mahasiswa
    public function store(Request $request)
    {

        // Validasi input
        $request->validate([
            'nidn' => 'required|numeric',
            'nip' => 'required|numeric',
            'nama_dosen' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_telp' => 'required|numeric',
            'jabatan_fungsional' => 'required|string|max:255',
            'no_serdos' => 'required|numeric',
            'status_dosen' => 'required|string|max:255',
        ]);

        // Simpan data dosen ke dalam database
        Dosen::create([
            'nidn' => $request->nidn,
            'nip' => $request->nip,
            'nama_dosen' => $request->nama_dosen,
            'alamat' => $request->alamat, // Diperbaiki
            'no_telp' => $request->no_telp, // Diperbaiki
            'jabatan_fungsional' => $request->jabatan_fungsional,
            'no_serdos' => $request->no_serdos,
            'status_dosen' => $request->status_dosen,
        ]);

        // Redirect ke halaman daftar dosen dengan pesan sukses
        return redirect()->route('dosen.index')->with('success', 'Data Dosen berhasil ditambahkan!');
    }

    public function edit($id_dosen)
    {
        $dosen = Dosen::findOrFail($id_dosen);
        return view('dosen.edit', compact('dosen'));
    }

    public function update(Request $request, $id_dosen)
    {
        $dosen = Dosen::findOrFail($id_dosen);

        $validatedData = $request->validate([
            'nidn' => 'required|string|max:20',
            'nip' => 'nullable|string|max:20',
            'nama_dosen' => 'required|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'no_telp' => 'nullable|string|max:15',
            'jabatan_fungsional' => 'nullable|string|max:100',
            'no_serdos' => 'nullable|string|max:50',
            'status_dosen' => 'required|string|max:50',
        ]);

        $dosen->update($validatedData);

        return redirect()->route('dosen.index')->with('success', 'Data Dosen berhasil diperbarui!');
    }

    public function destroy($id_dosen)
    {
        $dosen = Dosen::find($id_dosen);
        if ($dosen) {
            $dosen->delete();

            return redirect()->route('dosen.index')->with('success', 'Data Dosen berhasil dihapus!');
        }
    }

    public function cari(Request $request)
    {
        $query = Dosen::query();
    
        if ($request->has('search')) {
            $search = $request->search;
            $query->where('nip', 'LIKE', "%$search%")  // Pastikan 'nip' sesuai dengan nama kolom di database
                  ->orWhere('nama_dosen', 'LIKE', "%$search%")
                  ->orWhere('status_dosen', 'LIKE', "%$search%");
        }
    
        $dosen = $query->get(); // Ambil hasil query
    
        return view('dosen.index', compact('dosen'));
    }    
    // public function show($id)
    // {
    //     $dosen = Dosen::findOrFail($id);
    //     return view('dosen.detail_dosen', compact('dosen'));
    // }


}
