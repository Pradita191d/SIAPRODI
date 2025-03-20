<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\SertMah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DataTables;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;
use Illuminate\Support\Facades\DB;

class SertMahController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = SertMah::join('mahasiswa', 'sertifikat_mahasiswa.nim', '=', 'mahasiswa.nim')
                ->select([
                    'sertifikat_mahasiswa.id',
                    'sertifikat_mahasiswa.nim',
                    'mahasiswa.nama_mahasiswa',
                    'sertifikat_mahasiswa.nm_sert',
                    'sertifikat_mahasiswa.lembaga',
                    'sertifikat_mahasiswa.tanggal_sert',
                    'sertifikat_mahasiswa.masa_berlaku',
                    'sertifikat_mahasiswa.file',
                    DB::raw("DATE_ADD(sertifikat_mahasiswa.tanggal_sert, INTERVAL sertifikat_mahasiswa.masa_berlaku YEAR) as berlaku_sampai")
                ]);

            return FacadesDataTables::of($data)
                ->addColumn('file', function ($row) {
                    if ($row->file) {
                        return '<a href="' . asset('storage/' . $row->file) . '" target="_blank" class="btn btn-sm btn-primary">Lihat File</a>';
                    } else {
                        return '<span class="text-muted">Tidak ada file</span>';
                    }
                })
                ->rawColumns(['file'])
                ->make(true);
        }

        return view('sertifikat_mahasiswa.index');
    }


    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|exists:mahasiswa,nim',
            'nm_sert' => 'required|string|max:255',
            'lembaga' => 'required|string|max:255',
            'tanggal_sert' => 'required|date',
            'masa_berlaku' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $filePath = $file->storeAs('sertifikat', $filename, 'public');
            $filename = time() . '_' . $file->getClientOriginalName();
        }

        SertMah::create([
            'nim' => $request->nim,
            'nm_sert' => $request->nm_sert,
            'lembaga' => $request->lembaga,
            'tanggal_sert' => $request->tanggal_sert,
            'masa_berlaku' => $request->masa_berlaku,
            'file' => $filePath,
        ]);

        return redirect()->route('sertifikat_mahasiswa.index')->with('success', 'Sertifikat berhasil ditambahkan.');
    }

    public function getMahasiswa(Request $request)
    {
        $term = $request->input('term');

        $mahasiswa = Mahasiswa::where('nim', 'like', '%' . $term . '%')
            ->orWhere('nama_mahasiswa', 'like', '%' . $term . '%')
            ->get(['nim', 'nama_mahasiswa']);

        $results = [];
        foreach ($mahasiswa as $mhs) {
            $results[] = [
                'id' => $mhs->nim,
                'text' => $mhs->nim . ' - ' . $mhs->nama_mahasiswa
            ];
        }

        return response()->json($results);
    }

    public function destroy($id)
    {
        $sertMah = SertMah::findOrFail($id);

        // Hapus file jika ada
        if ($sertMah->file) {
            Storage::disk('public')->delete($sertMah->file);
        }

        $sertMah->delete();

        return redirect()->route('sertifikat_mahasiswa.index')->with('success', 'Sertifikat berhasil dihapus.');
    }

    public function edit($id)
    {
        $sertMah = SertMah::findOrFail($id);
        return response()->json($sertMah);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nim' => 'required|exists:mahasiswa,nim',
            'nm_sert' => 'required|string|max:255',
            'lembaga' => 'required|string|max:255',
            'tanggal_sert' => 'required|date',
            'masa_berlaku' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        ]);

        $sertMah = SertMah::findOrFail($id);

        if ($request->hasFile('file')) {
            if ($sertMah->file) {
                Storage::disk('public')->delete($sertMah->file);
            }
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $filePath = $file->storeAs('sertifikat', $filename, 'public');
            $filename = time() . '_' . $file->getClientOriginalName();
        } else {
            $filePath = $sertMah->file;
        }

        $sertMah->update([
            'nim' => $request->nim,
            'nm_sert' => $request->nm_sert,
            'lembaga' => $request->lembaga,
            'tanggal_sert' => $request->tanggal_sert,
            'masa_berlaku' => $request->masa_berlaku,
            'file' => $filePath,
        ]);

        return redirect()->route('sertifikat_mahasiswa.index')->with('success', 'Sertifikat berhasil diperbarui.');
    }
}
