<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use App\Models\MahasiswaSemesterPerpanjangan;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use Dompdf\Dompdf;

class MahasiswaSemesterPerpanjanganController extends Controller
{
    /**
     * Menampilkan daftar mahasiswa yang mengajukan perpanjangan semester.
     */
    public function tampil_mahasiswa_perpanjangan()
    {
        // Mengambil data mahasiswa semester perpanjangan beserta data mahasiswa terkait
        $mahasiswaSemesterPerpanjangan = MahasiswaSemesterPerpanjangan::with('mahasiswa')->get();

        return view('maspan.index', compact('mahasiswaSemesterPerpanjangan'));
    }

    /**
     * Menyimpan data mahasiswa perpanjangan baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|exists:mahasiswa,nim',
            'alasan' => 'required|string',
            'solusi' => 'required|string',
            'batas_waktu' => 'required|string',
        ]);

        MahasiswaSemesterPerpanjangan::create($request->all());

        return redirect()->route('maspan.index')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Mencari mahasiswa perpanjangan berdasarkan NIM atau Nama Mahasiswa.
     */
    public function search(Request $request)
    {
        $keyword = $request->input('search');

        $mahasiswaSemesterPerpanjangan = MahasiswaSemesterPerpanjangan::whereHas('mahasiswa', function ($query) use ($keyword) {
            $query->where('nim', 'LIKE', "%$keyword%")
                  ->orWhere('nama_mahasiswa', 'LIKE', "%$keyword%");
        })->with('mahasiswa')->get();

        return view('maspan.index', compact('mahasiswaSemesterPerpanjangan'));
    }

 
    public function edit($id)
    {
    // Ambil data mahasiswa perpanjangan dengan relasi ke tabel mahasiswa
    $mahasiswaPerpanjangan = MahasiswaSemesterPerpanjangan::with('mahasiswa')->find($id);

    // Periksa apakah data ditemukan
    if (!$mahasiswaPerpanjangan) {
        return redirect()->route('maspan.index')->with('error', 'Data tidak ditemukan.');
    }

    return view('maspan.edit', compact('mahasiswaPerpanjangan'));
    }


    /**
     * Memproses update data mahasiswa perpanjangan.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nim' => 'required|exists:mahasiswa,nim',
            'alasan' => 'required|string',
            'solusi' => 'required|string',
            'batas_waktu' => 'required|string',
        ]);

        // Ambil data berdasarkan ID
        $mahasiswaPerpanjangan = MahasiswaSemesterPerpanjangan::findOrFail($id);
        $mahasiswaPerpanjangan->update($request->only(['nim', 'alasan', 'solusi', 'batas_waktu']));

        return redirect()->route('maspan.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Menghapus data mahasiswa perpanjangan berdasarkan ID.
     */
    public function destroy($id)
    {
        $mahasiswaPerpanjangan = MahasiswaSemesterPerpanjangan::findOrFail($id);
        $mahasiswaPerpanjangan->delete();

        return redirect()->route('maspan.index')->with('success', 'Data berhasil dihapus.');
    }

    public function exportpdf()
    {
        $MahasiswaSemesterPerpanjangan = MahasiswaSemesterPerpanjangan::all();
    
        $pdf = Pdf::loadView('maspan.cetak', ['mhs_smstr_perpanjangan' => $MahasiswaSemesterPerpanjangan]);
    
        return $pdf->download('cetakdata' . Carbon::now()->timestamp . '.pdf');
    }
    


    public function cetakdata()
    {
        $MahasiswaSemesterPerpanjangan = MahasiswaSemesterPerpanjangan::all();
        return view('maspan.cetak', ['mhs_smstr_perpanjangan' => $MahasiswaSemesterPerpanjangan]);
    }
}
