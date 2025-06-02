<?php

namespace App\Http\Controllers;

use App\Models\WisudaModel;
use Shuchkin\SimpleXLSXGen;
use Illuminate\Http\Request;
use App\Models\MahasiswaModel;
use App\Models\TahunWisudaModel;
use Illuminate\Support\Facades\DB;

class WisudaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wisuda = WisudaModel::with(['mahasiswa', 'sk'])->get();
        return view('admin.wissuda.index', compact('wisuda'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil semua NIM yang sudah ada di tabel wisuda
         $nimTerdaftar = WisudaModel::pluck('nim')->toArray();

        // Ambil mahasiswa yang belum ada di tabel wisuda
        $mahasiswa = MahasiswaModel::whereNotIn('nim', $nimTerdaftar)->get();

        // Ambil data tahun wisuda
        $tahun_wisuda = TahunWisudaModel::all(); 

        return view('admin.wissuda.create', compact('mahasiswa', 'tahun_wisuda'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $isSudahWisuda = $request->status_wisuda === 'Sudah Wisuda';

        $request->validate([
            'nim' => 'required|exists:mahasiswa,nim',
            'status_wisuda' => 'required|string|max:50',
            'tahun_wisuda_id' => $isSudahWisuda ? 'required|exists:tahun_wisuda,id' : 'nullable'
        ], [
            'nim.required' => 'Mahasiswa tidak boleh kosong.',
            'status_wisuda.required' => 'Status wisuda tidak boleh kosong.',
            'tahun_wisuda_id.required' => 'Tahun Wisuda tidak boleh kosong jika sudah wisuda.',
            'tahun_wisuda_id.exists' => 'Tahun Wisuda yang dipilih tidak valid.'
        ]);

        WisudaModel::create([
            'nim' => $request->nim,
            'status_wisuda' => $request->status_wisuda,
            'tahun_wisuda_id' => $isSudahWisuda ? $request->tahun_wisuda_id : null,
        ]);

        DB::table('mahasiswa')->where('nim', $request->nim)->update([
            'status_aktif' => $isSudahWisuda ? 'Lulus' : 'Aktif'
        ]);

        session()->flash('success', 'Data wisuda berhasil ditambahkan.');
        return redirect('/wissuda');
    }

    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Cari data wisuda berdasarkan id_wisuda
        $wisuda = WisudaModel::findOrFail($id);

        // Cari data mahasiswa berdasarkan nim di tabel wisuda
        $mahasiswa = MahasiswaModel::where('nim', $wisuda->nim)->firstOrFail();

        

        return view('admin.wissuda.detail', compact('wisuda', 'mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $wisuda = WisudaModel::findOrFail($id);
        $tahun_wisuda = TahunWisudaModel::orderBy('tahun_wisuda', 'desc')->get();

        return view('admin.wissuda.edit', compact('wisuda', 'tahun_wisuda'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $wisuda = WisudaModel::findOrFail($id);
        $isSudahWisuda = $request->status_wisuda === 'Sudah Wisuda';

        $request->validate([
            'status_wisuda' => 'required|string|max:50',
            'tahun_wisuda_id' => $isSudahWisuda ? 'required|exists:tahun_wisuda,id' : 'nullable'],
            [
            'status_wisuda.required' => 'Status wisuda tidak boleh kosong.',
            'tahun_wisuda_id.required' => 'Tahun Wisuda tidak boleh kosong jika sudah wisuda.',
            'tahun_wisuda_id.exists' => 'Tahun Wisuda yang dipilih tidak valid.'
        ]);

       // Menentukan nilai tahun_wisuda_id
        $tahunWisudaId = $isSudahWisuda ? $request->tahun_wisuda_id : 0;

        // Update Data Wisuda
        $wisuda->update([
            'status_wisuda' => $request->status_wisuda,
            'tahun_wisuda_id' => $tahunWisudaId,
        ]);

        // Update Status Mahasiswa di Tabel `mahasiswa`
        DB::table('mahasiswa')->where('nim', $wisuda->nim)->update([
            'status_aktif' => $isSudahWisuda ? 'Lulus' : 'Aktif'
        ]);

        return redirect('/wissuda')->with('success', 'Data wisuda berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $wisuda = WisudaModel::find($id);

        if (!$wisuda) {
            return redirect('/wissuda')->with('error', 'Data tidak ditemukan.');
        }

        DB::table('mahasiswa')->where('nim', $wisuda->nim)->update([
            'status_aktif' => 'Aktif'
        ]);

        $wisuda->delete();
        return redirect('/wissuda')->with('success', 'Data wisuda berhasil dihapus.');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        

        if (!empty($search)) {
            $wisuda = WisudaModel::when($search, function ($query) use ($search) {
                $query->whereHas('sk', function ($q) use ($search) {
                    $q->where('tahun_wisuda', 'LIKE', '%' . $search . '%');
                })->orWhereHas('mahasiswa', function ($q) use ($search) {
                    $q->where('nama_mahasiswa', 'LIKE',  '%' . $search . '%');
                });
            })->paginate(10);
        } else {
            $wisuda = WisudaModel::all();
        }

        return view('admin.wissuda.index', compact('wisuda'));
    }

    public function export()
    {
        $wisuda = WisudaModel::with('mahasiswa', 'sk')->get();

        // Data header
        $data = [
            ["No", "NIM", "Nama", "Status Wisuda", "Tahun Wisuda"]
        ];

        // Isi data dari database
        foreach ($wisuda as $index => $wsd) {
            $data[] = [
                $index + 1,
                $wsd->mahasiswa->nim,
                $wsd->mahasiswa->nama_mahasiswa,
                $wsd->status_wisuda,
                $wsd->sk ? $wsd->sk->tahun_wisuda : '-',
            ];
        }

        // Generate file Excel
        $xlsx = SimpleXLSXGen::fromArray($data);
        return $xlsx->downloadAs('data-wisuda.xlsx');
    }
    
}
