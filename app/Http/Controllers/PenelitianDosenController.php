<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\PenelitianDosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PenelitianDosenController extends Controller
{
    // Menampilkan daftar penelitian
    public function index(Request $request)
    {
        // Ambil input pencarian
        $search = $request->input('search');

        // Query dengan filter jika ada pencarian
        $penelitian = PenelitianDosen::with('dosen')
        ->when($search, function ($query) use ($search) {
            return $query->whereHas('dosen', function ($q) use ($search) {
                $q->where('nama_dosen', 'like', "%{$search}%")
                    ->orwhere('tahun_penelitian', 'like', "%{$search}%");
            });
        })
        ->get();

        // $penelitian = PenelitianDosen::with('dosen')->get();
        return view('penelitian_dosen.index', compact('penelitian', 'search'));
    }

    // Tampilkan form input penelitian baru
    public function create()
    {
        $dosen = Dosen::all(); // Ambil daftar dosen untuk dropdown
        return view('penelitian_dosen.create', compact('dosen'));
    }

    // Fungsi store
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'judul_penelitian'          => 'required|string|max:255',
            'id_dosen'                  => 'required|exists:dosen,id_dosen',
            'tahun_penelitian'          => 'required|digits:4|integer|min:2000|max:' . date('Y'),
            'skema_penelitian'          => 'required|string|max:100',
            'sumber_dana'               => 'required|string|max:100',
            'dana_penelitian'           => 'required|numeric|min:0',
            'status_penelitian'         => 'required|in:Dalam Proses,Selesai,Dibatalkan',
            'file_penelitian'           => 'nullable|mimes:pdf|max:2048', // Max 2MB, hanya PDF
            'nama_anggota'              => 'nullable|string|max:255',
        ]);

        // Simpan file penelitian jika ada
        $filePath = null;
        if ($request->hasFile('file_penelitian')) {
            $file = $request->file('file_penelitian');
            $originalFileName = time() . '_' . $file->getClientOriginalName(); // Menambahkan timestamp agar unik
            $filePath = $file->storeAs('file_penelitian', $originalFileName, 'public');
        }

        // Simpan data penelitian
        $penelitian = PenelitianDosen::create([
            'judul_penelitian'      => $request->judul_penelitian,
            'id_dosen'              => $request->id_dosen,
            'tahun_penelitian'      => $request->tahun_penelitian,
            'skema_penelitian'      => $request->skema_penelitian,
            'sumber_dana'           => $request->sumber_dana,
            'dana_penelitian'       => $request->dana_penelitian,
            'status_penelitian'     => $request->status_penelitian,
            'file_penelitian'       => $filePath,
        ]);

        // Simpan anggota jika ada
        if ($request->filled('nama_anggota')) {
            // Pisahkan berdasarkan koma atau baris baru
            $daftarAnggota = preg_split('/[\r\n,]+/', $request->nama_anggota, -1, PREG_SPLIT_NO_EMPTY);

            foreach ($daftarAnggota as $nama) {
                Anggota::create([
                    'id_penelitian' => $penelitian->id_penelitian,
                    'nama_anggota'  => trim($nama),
                ]);
            }
        }

        return redirect()->route('penelitian-dosen.index')->with('success', 'Penelitian berhasil ditambahkan!');
    }

    // Tampilkan form edit penelitian
    public function edit($id_penelitian)
    {
        $penelitian = PenelitianDosen::with('dosen')->findOrFail($id_penelitian);
        $dosen = Dosen::all(); // Ambil daftar dosen untuk dropdown

        return view('penelitian_dosen.edit', compact('penelitian', 'dosen'));
    }

    // Fungsi update
    public function update(Request $request, $id_penelitian)
    {
        // dd($request->all());

        // Validasi input
        $request->validate([
            'judul_penelitian'      => 'required|string|max:255',
            'id_dosen'              => 'required|exists:dosen,id_dosen',
            'tahun_penelitian'      => 'required|digits:4|integer|min:2000|max:' . date('Y'),
            'skema_penelitian'      => 'required|string|max:100',
            'sumber_dana'           => 'required|string|max:100',
            'dana_penelitian'       => 'required|numeric|min:0',
            'status_penelitian'     => 'required|in:Dalam proses,Selesai,Dibatalkan',
            'file_penelitian'       => 'nullable|mimes:pdf|max:2048', // Max 2MB, hanya PDF
            'nama_anggota'          => 'nullable|string|max:255',
        ]);

        // Cari data penelitian berdasarkan ID
        $penelitian = PenelitianDosen::findOrFail($id_penelitian);

        // Periksa dan hapus file lama jika ada file baru
        if ($request->hasFile('file_penelitian')) {
            if ($penelitian->file_penelitian && Storage::disk('public')->exists($penelitian->file_penelitian)) {
                Storage::disk('public')->delete($penelitian->file_penelitian);
            }
            $filePath = $request->file('file_penelitian')->store('file_penelitian', 'public');
        } else {
            $filePath = $penelitian->file_penelitian;
        }

        // Perbarui data penelitian
        $penelitian->update([
            'judul_penelitian'  => $request->judul_penelitian,
            'id_dosen'          => $request->id_dosen,
            'tahun_penelitian'  => $request->tahun_penelitian,
            'skema_penelitian'  => $request->skema_penelitian,
            'sumber_dana'       => $request->sumber_dana,
            'dana_penelitian'   => $request->dana_penelitian,
            'status_penelitian' => $request->status_penelitian,
            'file_penelitian'   => $filePath,
        ]);

        // Hapus anggota lama
        $penelitian->anggota()->delete();

        // Simpan ulang anggota jika ada
        if ($request->filled('nama_anggota')) {
            $daftarAnggota = preg_split('/[\r\n,]+/', $request->nama_anggota, -1, PREG_SPLIT_NO_EMPTY);

            foreach ($daftarAnggota as $nama) {
                Anggota::create([
                    'id_penelitian' => $penelitian->id_penelitian,
                    'nama_anggota'  => trim($nama),
                ]);
            }
        }

        return redirect()->route('penelitian-dosen.index')->with('success', 'Penelitian berhasil diperbarui!');
    }


    // Menampilkan detail penelitian
    public function detail($id_penelitian)
    {
        $penelitian = PenelitianDosen::with(['dosen'])->find($id_penelitian);

        if (!$penelitian) {
            return abort(404, 'Data tidak ditemukan');
        }
        return view('penelitian_dosen.detail', compact('penelitian'));
    }

    // Fungsi hapus
    public function destroy($id_penelitian)
    {
        // Cari data penelitian berdasarkan ID
        $penelitian = PenelitianDosen::with('anggota')->findOrFail($id_penelitian); // Ambil anggota terkait

       // Hapus file PDF jika ada
        if (!empty($penelitian->file_penelitian) && Storage::disk('public')->exists($penelitian->file_penelitian)) {
            Storage::disk('public')->delete($penelitian->file_penelitian);
        }

        // Hapus semua anggota penelitian terkait (langsung dari relasi)
        $penelitian->anggota()->delete();

        // Hapus data penelitian
        $penelitian->delete();

        return redirect()->route('penelitian-dosen.index')->with('success', 'Penelitian dan anggotanya berhasil dihapus!');
    }
}
