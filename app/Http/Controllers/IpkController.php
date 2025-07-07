<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ipk;
use App\Models\Mahasiswa;
use App\Models\TahunAkademik;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class IpkController extends Controller
{

    //Fungsi Index Halaman data IPK
    // public function index(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $query = Mahasiswa::leftJoin('ipk', 'mahasiswa.nim', '=', 'ipk.nim')
    //             ->leftJoin('tahun_akademik', 'mahasiswa.tahun_masuk', '=', 'tahun_akademik.id_tahun_akademik')
    //             ->select(
    //                 'mahasiswa.nim',
    //                 'mahasiswa.nama_mahasiswa',
    //                 DB::raw("CONCAT(tahun_akademik.tahun, '/', tahun_akademik.ganjil_genap) as tahun_masuk"),
    //                 'ipk.ipk',
    //                 'ipk.keterangan',
    //                 'ipk.id_ipk'
    //             );

    //         // Filter berdasarkan tahun akademik jika dipilih
    //         if ($request->has('tahun_masuk') && $request->tahun_masuk != '') {
    //             $query->where('mahasiswa.tahun_masuk', $request->tahun_masuk);
    //         }

    //         return DataTables::of($query)
    //             ->addIndexColumn()
    //             ->addColumn('keterangan_ipk', function ($row) {
    //                 if (is_null($row->ipk)) {
    //                     return '-';
    //                 } elseif ($row->ipk > 3.5) {
    //                     return '<span class="badge bg-success">Cumlaude</span>';
    //                 } elseif ($row->ipk >= 3.01 && $row->ipk <= 3.50) {
    //                     return '<span class="badge bg-primary">Sangat Memuaskan</span>';
    //                 } elseif ($row->ipk >= 2.76 && $row->ipk <= 3.00) {
    //                     return '<span class="badge bg-info">Memuaskan</span>';
    //                 } else {
    //                     return '<span class="badge bg-warning">Kurang</span>';
    //                 }
    //             })
    //             ->addColumn('aksi', function ($row) {
    //                 if (is_null($row->ipk)) {
    //                     return '<button onclick="openInputIpkModal(\'' . $row->nim . '\', \'' . $row->nama_mahasiswa . '\')" class="btn btn-sm btn-success">Input IPK</button>';
    //                 } else {
    //                     return '
    //                 <button onclick="editIpk(' . $row->id_ipk . ')" class="btn btn-sm btn-warning"><i class="fas fa-pen"></i></button>
    //                 <button onclick="deleteIpk(' . $row->id_ipk . ')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
    //             ';
    //                 }
    //             })
    //             ->rawColumns(['keterangan_ipk', 'aksi'])
    //             ->make(true);
    //     }

    //     // Ambil data tahun akademik untuk dropdown filter
    //     $tahun_akademik = DB::table('tahun_akademik')->select('id_tahun_akademik', 'tahun', 'ganjil_genap')->get();

    //     return view('ipk.index', compact('tahun_akademik'), ['title' => 'Data IPK Mahasiswa']);
    // }

    public function index(Request $request)
    {
        $query = Mahasiswa::with(['ipk', 'tahunAkademik']);

        if ($request->has('tahun_masuk') && $request->tahun_masuk != '') {
            $query->where('tahun_masuk', $request->tahun_masuk);
        }

        $mahasiswas = $query->get();
        $tahun_akademik = TahunAkademik::all();

        return view('ipk.index', compact('mahasiswas', 'tahun_akademik'), ['title' => 'Data IPK Mahasiswa']);
    }




    //Fungsi Tabel Rekap
    public function getRekapitulasi(Request $request)
    {
        $tahun_masuk = $request->input('tahun_masuk');

        $queryMahasiswa = Mahasiswa::query();
        if (!empty($tahun_masuk)) {
            $queryMahasiswa->where('tahun_masuk', $tahun_masuk);
        }
        $totalMahasiswa = $queryMahasiswa->count();

        if ($totalMahasiswa == 0) {
            return response()->json([
                'jumlahCumlaude' => 0,
                'persentaseCumlaude' => 0,
                'jumlahPerluPerbaikan' => 0,
                'persentasePerluPerbaikan' => 0,
            ]);
        }

        $queryCumlaude = Ipk::where('ipk', '>=', 3.5);
        if (!empty($tahun_masuk)) {
            $queryCumlaude->whereIn('nim', Mahasiswa::where('tahun_masuk', $tahun_masuk)->pluck('nim'));
        }
        $jumlahCumlaude = $queryCumlaude->count();

        $queryPerluPerbaikan = Ipk::where('ipk', '<', 3.0);
        if (!empty($tahun_masuk)) {
            $queryPerluPerbaikan->whereIn('nim', Mahasiswa::where('tahun_masuk', $tahun_masuk)->pluck('nim'));
        }
        $jumlahPerluPerbaikan = $queryPerluPerbaikan->count();

        $persentaseCumlaude = round(($jumlahCumlaude / $totalMahasiswa) * 100, 2);
        $persentasePerluPerbaikan = round(($jumlahPerluPerbaikan / $totalMahasiswa) * 100, 2);

        return response()->json([
            'jumlahCumlaude' => $jumlahCumlaude,
            'persentaseCumlaude' => $persentaseCumlaude,
            'jumlahPerluPerbaikan' => $jumlahPerluPerbaikan,
            'persentasePerluPerbaikan' => $persentasePerluPerbaikan,
        ]);
    }

    //Fungsi Input IPK
    public function inputIpk(Request $request)
    {
        $request->validate([
            'nim' => 'required|exists:mahasiswa,nim',
            'ipk' => 'required|numeric|min:0|max:4',
        ]);

        $keterangan = $this->getKeteranganIpk($request->ipk);

        $ipk = new Ipk();
        $ipk->nim = $request->nim;
        $ipk->ipk = $request->ipk;
        $ipk->keterangan = $keterangan;

        $ipk->save();
        session()->flash('success', 'Data IPK berhasil disimpan.');

        return redirect()->back()->with('success', 'Data IPK berhasil disimpan.');
    }

    //Fungsi Convert Keterangan
    private function getKeteranganIpk($ipk)
    {
        if ($ipk >= 3.5) {
            return 'Cumlaude';
        } elseif ($ipk >= 3.0) {
            return 'Baik';
        } else {
            return 'Perlu Perbaikan';
        }
    }

    //Fungsi Modal Edit
    public function editIpk($id)
    {
        // Ambil data IPK beserta data mahasiswa
        $ipk = Ipk::with('mahasiswa')->findOrFail($id);
        return response()->json([
            'id_ipk' => $ipk->id_ipk,
            'nim' => $ipk->nim,
            'nama_mahasiswa' => $ipk->mahasiswa->nama_mahasiswa,
            'ipk' => $ipk->ipk,
        ]);
    }

    //Fungsi Update IPK
    public function updateIpk(Request $request, $id)
    {
        $request->validate([
            'ipk' => 'required|numeric|min:0|max:4',
        ]);

        $keterangan = $this->getKeteranganIpk($request->ipk);

        $ipk = Ipk::findOrFail($id);
        $ipk->update([
            'ipk' => $request->ipk,
            'keterangan' => $keterangan,
        ]);

        return redirect()->back()->with('success', 'Data berhasil diperbarui.');
    }

    //Fungsi Hapus IPK
    public function deleteIpk($id)
    {
        $ipk = Ipk::findOrFail($id);
        $ipk->delete();

        return redirect()->back()->with('success', 'Data ipk berhasil dihapus.');
    }
}
