<?php

namespace App\Http\Controllers;

use App\Models\Mbkm;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Carbon\Carbon;

class MbkmController extends Controller
{
    function tampil(Request $request)
    {
        $search = $request->input('search'); // Ambil input pencarian

        // Jika ada pencarian, filter berdasarkan nama mahasiswa
        $mbkm = Mbkm::with('mahasiswa')
            ->when($search, function ($query, $search) {
                return $query->where('namaMhs', 'LIKE', "%$search%");
            })
            ->get();

        return view('mbkm.tampil', compact('mbkm'));
    }


    public function detail($id)
    {
        $mbkm = Mbkm::with('mahasiswa')->findOrFail($id);

        // Pastikan kolom tidak null dengan explode()
        $mbkm->namaMatkul = $mbkm->namaMatkul ? explode(',', $mbkm->namaMatkul) : [];
        $mbkm->sks = $mbkm->sks ? explode(',', $mbkm->sks) : [];
        $mbkm->keterangan = $mbkm->keterangan ? explode(',', $mbkm->keterangan) : [];

        return view('mbkm.detail', compact('mbkm'));
    }

    function tambah()
    {
        $mahasiswa = Mahasiswa::all();
        return view('mbkm.tambah', compact('mahasiswa'));
    }

    function submit(Request $request)
    {
        // Ambil data mahasiswa berdasarkan NIM
        $mahasiswa = Mahasiswa::where('nim', $request->nim)->first();

        // Simpan data MBKM
        $mbkm = new Mbkm();
        $mbkm->nim = $request->nim;
        $mbkm->namaMhs = $mahasiswa ? $mahasiswa->nama_mahasiswa : $request->namaMhs; // Ambil nama dari tabel mahasiswa jika ada
        $mbkm->nama_program = $request->nama_program;
        $mbkm->namaLembaga = $request->namaLembaga;
        $mbkm->lokasi = $request->lokasi;
        $mbkm->bidangProgram = $request->bidangProgram;
        $mbkm->durasi = $request->durasi;
        $mbkm->program_studi = $request->program_studi;
        $mbkm->jurusan = $request->jurusan;
        $mbkm->semester = $request->semester;
        $mbkm->no_hp = $request->no_hp;
        $mbkm->email = $request->email;
        $mbkm->deskripsi = $request->deskripsi;
        $mbkm->namaMatkul = $request->namaMatkul;
        $mbkm->sks = $request->sks;
        $mbkm->keterangan = $request->keterangan;
        $mbkm->dospem = $request->dospem;
        $mbkm->koor_mbkm = $request->koor_mbkm;
        $mbkm->kaprodi = $request->kaprodi;
        $mbkm->catatan_tambahan = $request->catatan_tambahan;
        $mbkm->save();

        return redirect()->route('mbkm.tampil')->with('success', 'Data MBKM berhasil ditambahkan.');
    }

    function edit($id)
    {
        $mbkm = Mbkm::find($id);
        $mahasiswa = Mahasiswa::all();
        return view('mbkm.edit', compact('mbkm', 'mahasiswa'));
    }

    function update(Request $request, $id)
    {
        // Ambil data mahasiswa berdasarkan NIM
        $mahasiswa = Mahasiswa::where('nim', $request->nim)->first();

        // Update data MBKM
        $mbkm = Mbkm::find($id);
        $mbkm->nim = $request->nim;
        $mbkm->namaMhs = $mahasiswa ? $mahasiswa->nama_mahasiswa : $request->namaMhs; // Ambil nama dari tabel mahasiswa jika ada
        $mbkm->nama_program = $request->nama_program;
        $mbkm->namaLembaga = $request->namaLembaga;
        $mbkm->lokasi = $request->lokasi;
        $mbkm->bidangProgram = $request->bidangProgram;
        $mbkm->durasi = $request->durasi;
        $mbkm->program_studi = $request->program_studi;
        $mbkm->jurusan = $request->jurusan;
        $mbkm->semester = $request->semester;
        $mbkm->no_hp = $request->no_hp;
        $mbkm->email = $request->email;
        $mbkm->deskripsi = $request->deskripsi;
        $mbkm->namaMatkul = $request->namaMatkul;
        $mbkm->sks = $request->sks;
        $mbkm->keterangan = $request->keterangan;
        $mbkm->dospem = $request->dospem;
        $mbkm->koor_mbkm = $request->koor_mbkm;
        $mbkm->kaprodi = $request->kaprodi;
        $mbkm->catatan_tambahan = $request->catatan_tambahan;
        $mbkm->update();

        return redirect()->route('mbkm.tampil')->with('success', 'Data MBKM berhasil diperbarui.');
    }

    function delete($id)
    {
        $mbkm = Mbkm::find($id);
        $mbkm->delete();
        return redirect()->route('mbkm.tampil')->with('success', 'Data MBKM berhasil dihapus.');;
    }



    public function cetakmbkm($id)
    {
        // Ambil data berdasarkan ID
        $data = Mbkm::findOrFail($id);

        // Load view dan kirim data ke view
        $pdf = PDF::loadView('mbkm.cetak', ['data' => $data]);

        // Download PDF dengan nama file 'detail-konversi-sks.pdf'
        return $pdf->download('detail-konversi-sks' . Carbon::now()->timestamp . '.pdf');
    }
}
