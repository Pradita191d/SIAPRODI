<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\UndurDiriDo;
use Illuminate\Http\Request;
use App\Exports\UndurDiriExport;
use Maatwebsite\Excel\Facades\Excel;

class UndurDiriDoController extends Controller
{
    public function index()
    {
        $mahasiswas = Mahasiswa::all();
        $undur_diri_do = UndurDiriDo::all();
        return view('UndurDiriDo.index', compact('mahasiswas', 'undur_diri_do'));
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nim' => 'required',
            'tanggal_pengajuan' => 'required|date',
            'alasan' => 'required|string',
            'keterangan' => 'required|string',
            'status_pengajuan' => 'required|in:Menunggu Persetujuan,Disetujui,Ditolak',
            'tanggal_disetujui' => 'nullable|date',
        ]);

        UndurDiriDo::create([
            'nim' => $request->nim,
            'tanggal_pengajuan' => $request->tanggal_pengajuan,
            'alasan' => $request->alasan,
            'keterangan' => $request->keterangan,
            'status_pengajuan' => $request->status_pengajuan,
            'tanggal_disetujui' => $request->tanggal_disetujui ?? null,
        ]);

        if ($request->status_pengajuan === 'Disetujui') {
            $mahasiswa = Mahasiswa::where('nim', $request->nim)->first();
            $mahasiswa->status_aktif = $request->keterangan;
            $mahasiswa->save();
        }elseif($request->status_pengajuan === 'Ditolak'){
            $mahasiswa = Mahasiswa::where('nim', $request->nim)->first();
            $mahasiswa->status_aktif = 'Aktif';
            $mahasiswa->save();
        }
        
        return redirect()->back()->with('success', 'Data pengunduran diri berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal_pengajuan' => 'required|date',
            'keterangan' => 'required|string',
            'alasan' => 'required|string',
            'status_pengajuan' => 'required|in:Menunggu Persetujuan,Disetujui,Ditolak',
            'tanggal_disetujui' => 'nullable|date',
        ]);

        $undurDiri = UndurDiriDo::findOrFail($id);
        $undurDiri->update([
            'tanggal_pengajuan' => $request->tanggal_pengajuan,
            'keterangan' => $request->keterangan,
            'alasan' => $request->alasan,
            'status_pengajuan' => $request->status_pengajuan,
            'tanggal_disetujui' => $request->status_pengajuan === 'Disetujui' ? $request->tanggal_disetujui : null,
        ]);
        if ($request->status_pengajuan === 'Disetujui') {
            $mahasiswa = Mahasiswa::where('nim', $request->nim)->first();
            $mahasiswa->status_aktif = $request->keterangan;
            $mahasiswa->save();
        }elseif($request->status_pengajuan === 'Ditolak'){
            $mahasiswa = Mahasiswa::where('nim', $request->nim)->first();
            $mahasiswa->status_aktif = 'Aktif';
            $mahasiswa->save();
        }

        return redirect()->back()->with('success', 'Data pengunduran diri berhasil diperbarui.');

    }

    public function destroy($id)
    {
        $undurDiri = UndurDiriDo::findOrFail($id);
        $undurDiri->delete();

        return redirect()->back()->with('success', 'Data mahasiswa berhasil dihapus.');

    }

    public function exportUndurDiri()
{
    return Excel::download(new UndurDiriExport, 'undur_diri.xlsx');
}

}
