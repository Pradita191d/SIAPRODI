<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Sertikom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SertikomController extends Controller
{
    
    
    public function index(Request $request)
    {
        $query = DB::table('sertikom')
            ->join('dosen', 'sertikom.nidn', '=', 'dosen.nidn')
            ->select('sertikom.*', 'dosen.nama_dosen as nama_dosen')
            ->orderBy('created_at', 'asc');
    
        // Cek apakah ada input pencarian
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('dosen.nama_dosen', 'LIKE', "%$search%")
                  ->orWhere('sertikom.nidn', 'LIKE', "%$search%")
                  ->orWhere('sertikom.nama_sertifikat', 'LIKE', "%$search%")
                  ->orWhere('sertikom.bidang_keahlian', 'LIKE', "%$search%");
            });
        }
    
        // Filter berdasarkan Tahun Terbit
        if ($request->has('tahun_terbit') && !empty($request->tahun_terbit)) {
            $query->whereYear('sertikom.tanggal_terbit', $request->tahun_terbit);
        }
    
        // Filter berdasarkan Tahun Masa Berlaku
        if ($request->has('tahun_berlaku') && !empty($request->tahun_berlaku)) {
            $query->whereYear('sertikom.berlaku_sampai', $request->tahun_berlaku);
        }
    
        $sertifikat = $query->paginate(10); // Pagination agar hasilnya tidak terlalu panjang
    
        return view('sertikom_crud.index', compact('sertifikat'));
    }
    

    // Menampilkan form tambah sertifikat
    public function create()
    {
        $dosen = Dosen::all(); // Ambil semua dosen untuk pilihan NIDN
        return view('sertikom_crud.tambah_sertikom', compact('dosen'));
    }



    public function edit($id_sertikom)
{
    $sertifikat = Sertikom::findOrFail($id_sertikom); // Ambil sertifikat berdasarkan ID
    $dosen = Dosen::all(); // Ambil daftar dosen untuk pilihan NIDN
    return view('sertikom_crud.edit_sertikom', compact('sertifikat', 'dosen'));
}
    public function update(Request $request, $id_sertikom){
        $sert = sertikom::findorfail($id_sertikom);

        if ($request->doc_sertifikat){
            $request->validate([
                'nidn'             => 'required|string|exists:dosen,nidn|max:20', // Pastikan NIDN ada di tabel dosen
                'no_sertikom'      => 'required|string|max:255',
                'nama_sertifikat'  => 'required|string|max:255',
                'bidang_keahlian'  => 'required|string|max:255',
                'nama_lembaga'     => 'required|string|max:255',
                'tanggal_terbit'   => 'required|date',
                'berlaku_sampai'   => 'required|date',
                'doc_sertifikat'   => 'required|file|mimes:pdf|max:2048'
            ]);

            $nama = $request->doc_sertifikat;
            $extension = $nama->getClientOriginalExtension();
            $nama_file = time().'.'.$extension;

            $nama->move(public_path().'/sertifikat', $nama_file);

            $sert->update([
                'nidn'             => $request->nidn,
                'no_sertikom'      => $request->no_sertikom,
                'nama_sertifikat'  => $request->nama_sertifikat,
                'bidang_keahlian'  => $request->bidang_keahlian,
                'nama_lembaga'     => $request->nama_lembaga,
                'tanggal_terbit'   => $request->tanggal_terbit,
                'berlaku_sampai'   => $request->berlaku_sampai,
                'doc_sertifikat'   => $nama_file,
            ]);
        }else{
            $request->validate([
                'nidn'             => 'required|string|exists:dosen,nidn|max:20', // Pastikan NIDN ada di tabel dosen
                'no_sertikom'      => 'required|string|max:255',
                'nama_sertifikat'  => 'required|string|max:255',
                'bidang_keahlian'  => 'required|string|max:255',
                'nama_lembaga'     => 'required|string|max:255',
                'tanggal_terbit'   => 'required|date',
                'berlaku_sampai'   => 'required|date',

            ]);

            $sert->update([
                'nidn'             => $request->nidn,
                'no_sertikom'      => $request->no_sertikom,
                'nama_sertifikat'  => $request->nama_sertifikat,
                'bidang_keahlian'  => $request->bidang_keahlian,
                'nama_lembaga'     => $request->nama_lembaga,
                'tanggal_terbit'   => $request->tanggal_terbit,
                'berlaku_sampai'   => $request->berlaku_sampai,
            ]);
        }
        return redirect()->route('index')->with('success', 'Data Sertifikat Berhasil Di edit');

    }
    // Menyimpan data sertifikat baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nidn'             => 'required|string|exists:dosen,nidn|max:20', // Pastikan NIDN ada di tabel dosen
            'no_sertikom'      => 'required|string|max:255',
            'nama_sertifikat'  => 'required|string|max:255',
            'bidang_keahlian'  => 'required|string|max:255',
            'nama_lembaga'     => 'required|string|max:255',
            'tanggal_terbit'   => 'required|date',
            'berlaku_sampai'   => 'required|date',
            'doc_sertifikat'   => 'required|file|mimes:pdf|max:2048', // Max 2MB PDF
        ]);

        

        $nama = $request->doc_sertifikat;
        $extension = $nama->getClientOriginalExtension();
        $nama_file = time().'.'.$extension;

        $nama->move(public_path().'/sertifikat', $nama_file);

        // Simpan data ke database
        Sertikom::create([
            'nidn'             => $request->nidn,
            'no_sertikom'      => $request->no_sertikom,
            'nama_sertifikat'  => $request->nama_sertifikat,
            'bidang_keahlian'  => $request->bidang_keahlian,
            'nama_lembaga'     => $request->nama_lembaga,
            'tanggal_terbit'   => $request->tanggal_terbit,
            'berlaku_sampai'   => $request->berlaku_sampai,
            'doc_sertifikat'   => $nama_file, // Menyimpan path file di database
        ]);

        // Redirect ke daftar sertifikat dengan pesan sukses
        return redirect()->route('index')->with('success', 'Sertifikat berhasil ditambahkan!');
    }
   
    public function destroy($id_sertikom){
        $sertikom = Sertikom::findorfail($id_sertikom);
        // dd($sertikom);
        if ($sertikom){
            $sertikom->delete();

            return redirect()->route('index')->with('success', 'Data Sertifikat Dosen berhasil dihapus!');
        }
    }
    
}
