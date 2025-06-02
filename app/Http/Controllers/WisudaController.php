<?php

namespace App\Http\Controllers;

use App\Models\Wisuda;
use App\Models\WisudaModel;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
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
        $wisuda = Wisuda::with(['mahasiswa', 'sk'])->get();
        return view('admin.wissuda.index', compact('wisuda'));
    }

    public function preview()
    {
        session()->forget(['wisuda_data', 'rekapitulasi_data']); // Hapus session sebelumnya


        $wisuda = Wisuda::with(['mahasiswa', 'sk'])->get();
        $tahunWisuda = $wisuda->pluck('tahun_wisuda')->unique();
        $rekapitulasi = [];

        foreach ($tahunWisuda as $tahun) {
            $sudahWisuda = $wisuda->where('tahun_wisuda', $tahun)->where('status_wisuda', 'Sudah Wisuda')->count();
            $rekapitulasi[] = [
                'tahun_wisuda' => $tahun,
                'sudah_wisuda' => $sudahWisuda,
            ];
        }

        return view('laporan.cetak', compact('wisuda', 'rekapitulasi'));
        //$wisuda = Wisuda::all();
//     session()->forget(['wisuda_data', 'rekapitulasi_data']); // Hapus session pencarian
//     $wisuda = Wisuda::all();
//     // Rekapitulasi untuk semua tahun
//     $tahunWisuda = $wisuda->pluck('tahun_wisuda')->unique();
//     $rekapitulasi = [];

        //     foreach ($tahunWisuda as $tahun) {
//         $sudahWisuda = $wisuda->where('tahun_wisuda', $tahun)->where('status_wisuda', 'Sudah Wisuda')->count();
//         $rekapitulasi[] = [
//             'tahun_wisuda' => $tahun,
//             'sudah_wisuda' => $sudahWisuda,
//         ];
//     }

        //     return view('laporan.cetak', compact('wisuda', 'rekapitulasi'));
//    // return view('laporan.cetak', ['wisuda'=> $wisuda]);
    }

    // fungsi untuk cari
    public function searchPreview(Request $request)
    {
        $search = $request->input('search');


        if (!empty($search)) {
            $wisuda = Wisuda::when($search, function ($query) use ($search) {
                $query->whereHas('sk', function ($q) use ($search) {
                    $q->where('tahun_wisuda', 'LIKE', '%' . $search . '%');
                })->orWhereHas('mahasiswa', function ($q) use ($search) {
                    $q->where('nama_mahasiswa', 'LIKE', '%' . $search . '%');
                });
            })->paginate(10);
        } else {
            $wisuda = Wisuda::all();
        }

        // if ($request->has('search')) {
        //     $wisuda = Wisuda::where('tahun_wisuda_id', 'LIKE', '%' .$request->search. '%')->get();
        // } else {
        //     $wisuda = Wisuda::all();
        // }

        //$wisuda = $query->get();

        // Buat rekapitulasi berdasarkan hasil pencarian
        $tahunWisuda = $wisuda->pluck('tahun_wisuda')->unique();
        $rekapitulasi = [];

        foreach ($tahunWisuda as $tahun) {
            $sudahWisuda = $wisuda->where('tahun_wisuda', $tahun)->where('status_wisuda', 'Sudah Wisuda')->count();
            $rekapitulasi[] = [
                'tahun_wisuda' => $tahun,
                'sudah_wisuda' => $sudahWisuda,
            ];
        }
        // Simpan hasil pencarian di session agar bisa digunakan di preview
        session(['wisuda_data' => $wisuda, 'rekapitulasi_data' => $rekapitulasi]);

        return view('laporan.cetak', compact('wisuda', 'rekapitulasi'));

        //return view('laporan.cetak', ['wisuda'=>$wisuda]);
    }

    public function lihat()
    {
        // Ambil data dari session jika ada, jika tidak ambil semua data
        // $wisuda = session('wisuda_data', Wisuda::all());
        // $rekapitulasi = session('rekapitulasi_data', []);

        // return view('laporan.hasil', compact('wisuda', 'rekapitulasi'));
        $wisuda = session()->has('wisuda_data') ? session('wisuda_data') : Wisuda::all();
        $rekapitulasi = session()->has('rekapitulasi_data') ? session('rekapitulasi_data') : [];

        return view('laporan.hasil', compact('wisuda', 'rekapitulasi'));
    }

    //     public function search(Request $request) 
// {
//     $query = Wisuda::query();

    //     if ($request->has('search') && !empty($request->search)) {
//         $query->where('tahun_wisuda', 'LIKE', '%' . $request->search . '%');
//     }

    //     $wisuda = $query->get();

    //     // Rekapitulasi berdasarkan hasil pencarian
//     $tahunWisuda = $wisuda->pluck('tahun_wisuda')->unique();
//     $rekapitulasi = [];

    //     foreach ($tahunWisuda as $tahun) {
//         $sudahWisuda = $wisuda->where('tahun_wisuda', $tahun)->where('status_wisuda', 'Sudah Wisuda')->count();
//         $belumWisuda = $wisuda->where('tahun_wisuda', $tahun)->where('status_wisuda', 'Belum Wisuda')->count();
//         $totalMahasiswa = $sudahWisuda + $belumWisuda;

    //         $rekapitulasi[] = [
//             'tahun_wisuda' => $tahun,
//             'sudah_wisuda' => $sudahWisuda,
//             'belum_wisuda' => $belumWisuda,
//             'jumlah_mahasiswa' => $totalMahasiswa,
//         ];
//     }

    //     return view('laporan.index', compact('wisuda', 'rekapitulasi'));
// }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil semua NIM yang sudah ada di tabel wisuda
        $nimTerdaftar = Wisuda::pluck('nim')->toArray();

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

        Wisuda::create([
            'nim' => $request->nim,
            'status_wisuda' => $request->status_wisuda,
            'tahun_wisuda_id' => $isSudahWisuda ? $request->tahun_wisuda_id : null,
        ]);

        DB::table('mahasiswa')->where('nim', $request->nim)->update([
            'status_aktif' => $isSudahWisuda ? 'Lulus' : 'Aktif',
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
        $wisuda = Wisuda::findOrFail($id);

        // Cari data mahasiswa berdasarkan nim di tabel wisuda
        $mahasiswa = MahasiswaModel::where('nim', $wisuda->nim)->firstOrFail();



        return view('admin.wissuda.detail', compact('wisuda', 'mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $wisuda = Wisuda::findOrFail($id);
        $tahun_wisuda = TahunWisudaModel::orderBy('tahun_wisuda', 'desc')->get();

        return view('admin.wissuda.edit', compact('wisuda', 'tahun_wisuda'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $wisuda = Wisuda::findOrFail($id);
        $isSudahWisuda = $request->status_wisuda === 'Sudah Wisuda';

        $request->validate(
            [
                'status_wisuda' => 'required|string|max:50',
                'tahun_wisuda_id' => $isSudahWisuda ? 'required|exists:tahun_wisuda,id' : 'nullable'
            ],
            [
                'status_wisuda.required' => 'Status wisuda tidak boleh kosong.',
                'tahun_wisuda_id.required' => 'Tahun Wisuda tidak boleh kosong jika sudah wisuda.',
                'tahun_wisuda_id.exists' => 'Tahun Wisuda yang dipilih tidak valid.'
            ]
        );

        // Menentukan nilai tahun_wisuda_id
        $tahunWisudaId = $isSudahWisuda ? $request->tahun_wisuda_id : 0;

        // Update Data Wisuda
        $wisuda->update([
            'status_wisuda' => $request->status_wisuda,
            'tahun_wisuda_id' => $tahunWisudaId,
        ]);
        
        // Update Status Mahasiswa di Tabel `mahasiswa`
        DB::table('mahasiswa')->where('nim', $wisuda->nim)->update([
            'status_aktif' => $isSudahWisuda ? 'Lulus' : 'Aktif',
        ]);

        return redirect('/wissuda')->with('success', 'Data wisuda berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $wisuda = Wisuda::find($id);

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
            $wisuda = Wisuda::when($search, function ($query) use ($search) {
                $query->whereHas('sk', function ($q) use ($search) {
                    $q->where('tahun_wisuda', 'LIKE', '%' . $search . '%');
                })->orWhereHas('mahasiswa', function ($q) use ($search) {
                    $q->where('nama_mahasiswa', 'LIKE', '%' . $search . '%');
                });
            })->paginate(10);
        } else {
            $wisuda = Wisuda::all();
        }

        return view('admin.wissuda.index', compact('wisuda'));
    }

    public function export()
    {
        $wisuda = Wisuda::with('mahasiswa', 'sk')->get();

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
    //fungsi cetak wisuda
    public function cetakWisuda()
    {
       
        $wisuda = session()->get('wisuda_data', Wisuda::all());
        $rekapitulasi = session()->get('rekapitulasi_data', []);

        // Jika session tidak ada, hitung rekapitulasi ulang
        if (empty($rekapitulasi)) {
            $tahunWisuda = $wisuda->pluck('tahun_wisuda')->unique();
            foreach ($tahunWisuda as $tahun) {
                $sudahWisuda = $wisuda->where('tahun_wisuda', $tahun)->where('status_wisuda', 'Sudah Wisuda')->count();
                $rekapitulasi[] = [
                    'tahun_wisuda' => $tahun,
                    'sudah_wisuda' => $sudahWisuda,
                ];
            }
        }
        dd($tahunWisuda);


        return view('laporan.hasil', compact('wisuda', 'rekapitulasi'));
        //return view('laporan.hasil', ['wisuda' => $wisuda]);
        // return view('laporan.hasil', ['wisuda' => $wisuda]);
    }
    //fungsi untuk export pdf
    // public function exportpdf(PDF $pdf)
    // {
    //     $wisuda = session()->has('wisuda_data') ? session('wisuda_data') : Wisuda::all();
    // $rekapitulasi = session()->has('rekapitulasi_data') ? session('rekapitulasi_data') : [];

    // $pdf = PDF::loadView('laporan.hasil', compact('wisuda', 'rekapitulasi'));
    // return $pdf->download('wisuda-' . Carbon::now()->timestamp . '.pdf');
    // //     $wisuda = session('wisuda_data', null);
    // // if (!$wisuda) {
    // //     $wisuda = Wisuda::all();
    // // }
    // //
    //     //$wisuda = Wisuda::all();

    //     // $wisuda = session('wisuda_data', Wisuda::all()); // Ambil dari session jika ada, kalau tidak ambil semua
    //     // $pdf = PDF::loadView('laporan.hasil', ['wisuda' => $wisuda]);


    //     // $pdf = PDF::loadView('laporan.hasil', ['wisuda' => $wisuda]);
    //     // return $pdf->download('wisuda-' . Carbon::now()->timestamp . '.pdf');
    // }

    public function exportpdf()
    {
        // Ambil data dari session atau ambil semua jika tidak ada di session
        $wisuda = session()->get('wisuda_data', Wisuda::all());
        $rekapitulasi = session()->get('rekapitulasi_data', []);

        // Periksa apakah session kosong
        if (empty($rekapitulasi)) {
            // Buat rekapitulasi ulang jika tidak ada di session
            $tahunWisuda = $wisuda->pluck('tahun_wisuda')->unique();
            foreach ($tahunWisuda as $tahun) {
                $sudahWisuda = $wisuda->where('tahun_wisuda', $tahun)->where('status_wisuda', 'Sudah Wisuda')->count();
                $rekapitulasi[] = [
                    'tahun_wisuda' => $tahun,
                    'sudah_wisuda' => $sudahWisuda,
                ];
            }
        }

        // Load view dan generate PDF
        $pdf = PDF::loadView('laporan.hasil', compact('wisuda', 'rekapitulasi'));
        return $pdf->download('wisuda-' . Carbon::now()->timestamp . '.pdf');
    }

}
