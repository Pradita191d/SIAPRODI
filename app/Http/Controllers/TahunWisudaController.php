<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TahunWisudaModel;

class TahunWisudaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tahun_wisuda = TahunWisudaModel::all();
        return view('admin.sk.index', compact('tahun_wisuda'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tahun_wisuda = TahunWisudaModel::all();
        return view('admin.sk.create', compact('tahun_wisuda'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tahun_wisuda' => 'required',
            'sk_wisuda' => 'required|file|mimes:pdf|max:2048'
        ]);

        // Simpan file SK jika ada
        $filePath = null;
        if ($request->hasFile('sk_wisuda')) {
            $file = $request->file('sk_wisuda');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('sk_wisuda', $fileName, 'public'); // Simpan di storage/app/public/sk_wisuda
        }

       // Buat entri baru di database
        TahunWisudaModel::create([
            'tahun_wisuda' => $request->tahun_wisuda,
            'sk_wisuda' => $filePath
        ]);
        session()->flash('success', 'Data SK berhasil ditambahkan.');
        return redirect('/sk');
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
        $tahun_wisuda = TahunWisudaModel::findOrFail($id);

        return view('admin.sk.edit', compact('tahun_wisuda'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'tahun_wisuda' => 'required',
            'sk_wisuda' => 'nullable|file|mimes:pdf|max:2048'
        ]);
        
        //cari data yang akan diupdate
        $tahun_wisuda = TahunwisudaModel::findOrFail($id);

        //simpan perubahan data
        $tahun_wisuda->tahun_wisuda = $request->tahun_wisuda;

        if ($request->hasFile('sk_wisuda')) {
            // Hapus file lama jika ada
            if ($tahun_wisuda->sk_wisuda && $tahun_wisuda->sk_wisuda !== '-') {
                $fileLama = storage_path('app/public/' . $tahun_wisuda->sk_wisuda);
                if (file_exists($fileLama)) {
                    unlink($fileLama);
                }
            }
        
            // Simpan file SK Wisuda baru
            $file = $request->file('sk_wisuda');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = 'sk_wisuda/' . $fileName;
        
            // Pindahkan file ke storage
            $file->move(storage_path('app/public/sk_wisuda'), $fileName);
        
            // Update path SK Wisuda di database
            $tahun_wisuda->sk_wisuda = $filePath;
        }
        
        //simpan perubahan
        $tahun_wisuda->save();
        session()->flash('success', 'Data SK berhasil diubah.');
        return redirect('/sk');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tahun_wisuda = TahunWisudaModel::find($id);
    
        if (!$tahun_wisuda) {
            return redirect('/sk')->with('error', 'Data tidak ditemukan.');
        }
    
        // Hapus file SK Wisuda jika ada
        if ($tahun_wisuda->sk_wisuda && $tahun_wisuda->sk_wisuda !== '-') {
            $filePath = storage_path('app/public/' . $tahun_wisuda->sk_wisuda);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        // Hapus data tahun atau sk
        $tahun_wisuda->delete();
        session()->flash('success', 'Data SK berhasil dihapus.');
        return redirect('/sk');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        

        if (!empty($search)) {
            $tahun_wisuda = TahunWisudaModel::where('tahun_wisuda', 'LIKE', '%'. $search . '%')->get();
        } else {
            $tahun_wisuda = TahunWisudaModel::all();
        }

        return view('admin.sk.index', compact('tahun_wisuda'));
    }
    
}
