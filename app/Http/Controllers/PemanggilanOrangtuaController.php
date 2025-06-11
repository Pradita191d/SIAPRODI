<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\PemanggilanOrangtua;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\PemanggilanOrangtuaExport;
use Maatwebsite\Excel\Facades\Excel;


class PemanggilanOrangtuaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $pemanggilans = PemanggilanOrangtua::query()
            ->when($search, function ($query) use ($search) {
                return $query->where('nim', 'LIKE', "%{$search}%")
                    ->orWhere('jurusan', 'LIKE', "%{$search}%")
                    ->orWhere('prodi', 'LIKE', "%{$search}%");
            })
            ->when($start_date && $end_date, function ($query) use ($start_date, $end_date) {
                return $query->whereBetween('tanggal_pemanggilan', [$start_date, $end_date]);
            })
            ->get();

        return view('pemanggilan.index', compact('pemanggilans'));
    }

    public function tambah()
    {
        $mahasiswa = Mahasiswa::all();

        return view('pemanggilan.tambah',compact('mahasiswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_ortu' => 'required|string|max:255',
            'no_telp_ortu' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'nim' => 'required|string|max:10',
            'semester' => 'required|integer|min:1|max:8',
            'jurusan' => 'required|string|max:255',
            'prodi' => 'required|string|max:255',
            'tanggal_pemanggilan' => 'nullable|date',
            'alasan_pemanggilan' => 'required|string|max:500',
            'solusi' => 'required|string|max:500',
        ]);

        PemanggilanOrangtua::create($request->all());

        return redirect()->route('pemanggilan.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pemanggilan = PemanggilanOrangtua::findOrFail($id);
        $mahasiswa = Mahasiswa::all();
        return view('pemanggilan.edit', compact('pemanggilan','mahasiswa'));
    }

    public function update(Request $request, $id)
    {
        $pemanggilan = PemanggilanOrangtua::findOrFail($id);
        $pemanggilan->update($request->all());

        return redirect()->route('pemanggilan.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $pemanggilan = PemanggilanOrangtua::findOrFail($id);
        $pemanggilan->delete();

        return redirect()->route('pemanggilan.index')->with('success', 'Data berhasil dihapus');
    }

    // Fungsi untuk cetak PDF
    public function cetakPDF($id)
    {
        $pemanggilan = PemanggilanOrangtua::findOrFail($id);
        $pdf = PDF::loadView('pemanggilan.pdf', compact('pemanggilan'));
        return $pdf->stream('Surat_Pemanggilan_' . $pemanggilan->mahasiswa->nama_mhs . '.pdf');
    }

    // Fungsi untuk export Excel
    public function exportExcel()
    {
        return Excel::download(new PemanggilanOrangtuaExport, 'Data_Pemanggilan.xlsx');
    }

public function cetakRangePDF(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $pemanggilans = PemanggilanOrangtua::whereBetween('tanggal_pemanggilan', [
            $request->start_date,
            $request->end_date
        ])->get();

        $pdf = PDF::loadView('pemanggilan.cetak_range', [
            'pemanggilans' => $pemanggilans,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date
        ]);

        return $pdf->stream('Berita Acara Pemanggilan Orang Tua'.$request->start_date.'_to_'.$request->end_date.'.pdf');
    }



}
