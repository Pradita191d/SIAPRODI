<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RKA;
use App\Models\TOR;

class TorController extends Controller
{
    public function index()
    {
        $title = 'Halaman Pengajuan TOR | SiaPro';
        $tor = TOR::all();
        $rka = RKA::all();
        return view('tor.index', compact('tor', 'title', 'rka'));
    }
    public function store(Request $request)
    {

        $request->validate([
            'id_rka' => 'required',
            'deskripsi' => 'required',
            'proposal' => 'required|file'
        ], [
            'id_rka.required' => 'RKA wajib dipilih',
            'deskripsi.required' => 'Deskripsi wajib diisi',
            'proposal.required' => 'File wajib diunggah',
        ]);

        $tor = new TOR();

        $tor->id_rka = $request->id_rka;
        $tor->nama_tor = $request->nama_tor;
        $tor->deskripsi = $request->deskripsi;
        $extension = $request->file('proposal')->getClientOriginalExtension();
        $filename = $request->nama_tor . '-' . rand(1000, 9999) . '.' . $extension;
        $tor->proposal = $request->file('proposal')->storeAs('tor', $filename, 'public');
        $tor->save();

        return redirect()->route('rka.index')->with('success', 'TOR berhasil ditambahkan');
    }

    public function update(Request $request)
    {
        $tor = TOR::find($request->id_tor);

        $tor->id_rka = $request->id_rka;
        $tor->nama_tor = $request->nama_tor;
        $tor->deskripsi = $request->deskripsi;

        if ($request->hasFile('proposal')) {
            $tor->proposal = $request->file('proposal')->store('tor', 'public');
        }

        $tor->save();

        return redirect()->route('tor.index')->with('success', 'TOR berhasil diubah');
    }

    public function destroy($id)
    {
        $tor = TOR::find($id);

        $tor->delete();

        return redirect()->route('tor.index')->with('success', 'TOR berhasil dihapus');
    }

}
