<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mou;
use App\Models\TahunAkademik;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Exports\MouExport;
use Maatwebsite\Excel\Facades\Excel;

class MouController extends Controller
{
    public function index(Request $request)
    {
        $mous = Mou::all();

        // Ambil daftar tahun untuk dropdown
        $tahunList = Mou::select('tahun')->distinct()->orderBy('tahun', 'desc')->pluck('tahun');

        // Ambil data tahun akademik
        $tahunAkademik = TahunAkademik::all();

        return view('mou.index', compact('mous', 'tahunList', 'tahunAkademik'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'no_mou' => 'required|string|max:255',
            'pihak_1' => 'required|string|max:255',
            'pihak_2' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_berakhir' => 'required|date',
            'tahun' => 'required|exists:tahun_akademik,id_tahun_akademik',
            'jenis_kerjasama' => 'required|string|max:255',
            'kontak' => 'required|string|max:255',
            'file_mou' => 'nullable|mimes:pdf|max:2048',
        ]);

        // **Cek apakah nomor MoU sudah ada di database**
        if (Mou::where('no_mou', $request->no_mou)->exists()) {
            return back()->with('error', 'Nomor MoU sudah ada dalam sistem. Silakan gunakan nomor lain.');
        }

        $dokumenPath = null;
        if ($request->hasFile('file_mou')) {
            $dokumenPath = $request->file('file_mou')->store('mou_files', 'public');
        }

        try {
            Mou::create([
                'no_mou' => $request->no_mou,
                'pihak_1' => $request->pihak_1,
                'pihak_2' => $request->pihak_2,
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_berakhir' => $request->tanggal_berakhir,
                'tahun' => $request->tahun,
                'jenis_kerjasama' => $request->jenis_kerjasama,
                'kontak' => $request->kontak,
                'file_mou' => $dokumenPath,
            ]);

            return redirect()->route('mou.index')->with('success', 'MoU berhasil ditambahkan!');
        } catch (\Exception $e) {
            Log::error('Gagal menyimpan MoU: ' . $e->getMessage());
            return back()->with('error', 'Gagal menyimpan MoU. Silakan coba lagi.');
        }
    }

    public function update(Request $request, $id_mou)
    {
        // Validasi input tanpa mewajibkan file baru
        $request->validate([
            'no_mou' => 'required|string|max:255',
            'pihak_1' => 'required|string|max:255',
            'pihak_2' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_berakhir' => 'required|date',
            'tahun' => 'required|exists:tahun_akademik,id_tahun_akademik',
            'jenis_kerjasama' => 'required|string|max:255',
            'kontak' => 'required|string|max:255',
            'file_mou' => 'nullable|mimes:pdf|max:2048', // Tidak required
        ]);

        // Ambil data MoU berdasarkan ID
        $mou = Mou::findOrFail($id_mou);

        // Update data MoU tanpa file
        $mou->update([
            'no_mou' => $request->no_mou,
            'pihak_1' => $request->pihak_1,
            'pihak_2' => $request->pihak_2,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_berakhir' => $request->tanggal_berakhir,
            'tahun' => $request->tahun,
            'jenis_kerjasama' => $request->jenis_kerjasama,
            'kontak' => $request->kontak,
        ]);

        // Jika ada file baru diunggah, update file
        if ($request->hasFile('file_mou')) {
            // Hapus file lama jika ada
            if ($mou->file_mou) {
                Storage::disk('public')->delete($mou->file_mou);
            }

            // Simpan file baru dengan nama unik
            $filename = 'mou_' . time() . '.' . $request->file('file_mou')->getClientOriginalExtension();
            $dokumenPath = $request->file('file_mou')->storeAs('mou_files', $filename, 'public');

            // Update nama file di database
            $mou->update(['file_mou' => $dokumenPath]);
        }

        return redirect()->route('mou.index')->with('success', 'Data MoU berhasil diperbarui!');
    }


    public function destroy($id_mou)
    {
        $mou = Mou::findOrFail($id_mou);

        // Hapus file jika ada
        if ($mou->file_mou) {
            // Hilangkan "storage/" agar sesuai dengan path di Storage::disk('public')
            $filePath = str_replace('storage/', '', $mou->file_mou);

            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }
        }

        $mou->delete();

        return redirect()->route('mou.index')->with('success', 'MoUberhasil dihapus!');
    }

    public function show($id)
    {
        $mou = Mou::findOrFail($id);
        return view('mou.show', compact('mou'));
    }

    public function exportExcel()
    {
        return Excel::download(new MouExport, 'data_mou.xlsx');
    }
}
