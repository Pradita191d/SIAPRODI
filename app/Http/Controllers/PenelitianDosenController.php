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
                $q->where('nama_dosen', 'like', "%{$search}%");
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
        $mahasiswa = Mahasiswa::all(); // Ambil daftar mahasiswa untuk dropdown
        return view('penelitian_dosen.create', compact('dosen', 'mahasiswa'));
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
            'anggota'                   => 'nullable|array',
            'anggota.*.id_mahasiswa'    => 'nullable|exists:mahasiswa,id_mahasiswa',
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

        // Simpan data anggota jika ada
        if ($request->has('anggota')) {
            foreach ($request->anggota as $anggota) {
                if (!empty($anggota['id_mahasiswa'])) {
                    Anggota::create([
                        'id_penelitian' => $penelitian->id_penelitian,
                        'NIM'           => Mahasiswa::where('id_mahasiswa', $anggota['id_mahasiswa'])->value('NIM'),
                    ]);
                }
            }
        }

        return redirect()->route('penelitian-dosen.index')->with('success', 'Penelitian berhasil ditambahkan!');
    }

    // Tampilkan form edit penelitian
    public function edit($id_penelitian)
    {
        $penelitian = PenelitianDosen::with('dosen', 'anggota.mahasiswa')->findOrFail($id_penelitian);
        $dosen = Dosen::all(); // Ambil daftar dosen untuk dropdown
        $mahasiswa = Mahasiswa::all(); // Ambil daftar mahasiswa untuk anggota

        return view('penelitian_dosen.edit', compact('penelitian', 'dosen', 'mahasiswa'));
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
            'anggota'               => 'nullable|array',
            'anggota.*.NIM'         => 'nullable|exists:mahasiswa,NIM',
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

        // Perbarui data anggota penelitian
        $anggotaLama = Anggota::where('id_penelitian', $penelitian->id_penelitian)
                ->pluck('NIM')
                ->toArray();

        if ($request->has('anggota')) {
            $anggotaBaru = collect($request->anggota) // Ambil hanya ID mahasiswa dari request
                ->pluck('NIM') // Hilangkan nilai null atau kosong
                ->filter()
                ->toArray();

            // Hapus anggota yang sudah tidak ada di daftar baru
            Anggota::where('id_penelitian', $penelitian->id_penelitian)
            ->WhereNotIn('NIM', $anggotaBaru)
            ->delete();

            // Tambah anggota baru yang belum ada
            foreach ($anggotaBaru as $NIM) {
                if (!in_array($NIM, $anggotaLama)) {
                    Anggota::create([
                        'id_penelitian' => $penelitian->id_penelitian,
                        'NIM'           => $NIM,
                    ]);
                }
            }
        } else {
            // Jika tidak ada anggota baru di request, hapus semua anggota penelitian ini
            Anggota::where('id_penelitian', $penelitian->id_penelitian)->delete();
        }

        return redirect()->route('penelitian-dosen.index')->with('success', 'Penelitian berhasil diperbarui!');
    }


    // Menampilkan detail penelitian
    public function detail($id_penelitian)
    {
        $penelitian = PenelitianDosen::with(['dosen', 'anggota.mahasiswa'])->find($id_penelitian);

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
