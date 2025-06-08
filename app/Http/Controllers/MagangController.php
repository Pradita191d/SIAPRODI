<?php

namespace App\Http\Controllers;
use App\Models\Magang;
use App\Models\MahasiswaMagang;
use App\Models\Mahasiswa;
use App\Models\Dosen;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MagangController extends Controller
{
    public function index(Request $request)
    {
        $magang = Magang::all(); // Fetch all magang entries
        return view('Magang.magang', compact('magang')); // Pass $magang to the view
    }


        // Method to store a new magang entry from the modal
        public function store(Request $request)
        {
            // Validate the form data
            $request->validate([
                'nama_perusahaan' => 'required|string|max:255',
                'jenis_perusahaan' => 'required|string|max:255',
                'alamat_perusahaan' => 'required|string',
                'pembimbing_lapangan' => 'required|string|max:255',
                'no_perusahaan' => 'required|numeric',
            ]);

            // Create a new Magang entry
            Magang::create([
                'nama_perusahaan' => $request->input('nama_perusahaan'),
                'jenis_perusahaan' => $request->input('jenis_perusahaan'),
                'alamat_perusahaan' => $request->input('alamat_perusahaan'),
                'pembimbing_lapangan' => $request->input('pembimbing_lapangan'),
                'no_perusahaan' => $request->input('no_perusahaan'),
            ]);

            // Redirect back to the index page with a success message
            return redirect()->route('magang.index')->with('success', 'Magang entry created successfully!');
        }
        public function destroy($id)
        {
            // Find the entry by ID and delete it
            $magang = Magang::findOrFail($id);
            $magang->delete();

            // Redirect back with a success message
            return redirect()->route('magang.index')->with('success', 'Magang entry deleted successfully!');
        }

        public function edit($id)
        {
            $mahasiswaList = Mahasiswa::all();
            $magang = Magang::find($id);
            $dosenList = Dosen::all();
            $mahasiswaMagang = MahasiswaMagang::join('mahasiswa', 'mahasiswa_magang.nim', '=', 'mahasiswa.nim')
                ->where('id_perusahaan', $id)
                ->orderBy('tahun_ajaran', 'desc') // Order by tahun_ajaran (newest first)
                ->orderBy('mahasiswa.nama_mahasiswa', 'asc') // Then order by mahasiswa name alphabetically
                ->select('mahasiswa_magang.*', 'mahasiswa.nama_mahasiswa') // Select relevant columns
                ->get();

            return view('Magang.edit', compact('magang', 'mahasiswaMagang','mahasiswaList','dosenList'));
        }


        public function update(Request $request, $id)
        {
            // Validate the form data
            $request->validate([
                'nama_perusahaan' => 'required|string|max:255',
                'jenis_perusahaan' => 'required|string|max:255',
                'alamat_perusahaan' => 'required|string',
                'pembimbing_lapangan' => 'required|string|max:255',
                'no_perusahaan' => 'required|numeric',
            ]);

            // Find the existing Magang entry by ID
            $magang = Magang::findOrFail($id);

            // Update the magang entry with the new form data
            $magang->update([
                'nama_perusahaan' => $request->nama_perusahaan,
                'jenis_perusahaan' => $request->jenis_perusahaan,
                'alamat_perusahaan' => $request->alamat_perusahaan,
                'pembimbing_lapangan' => $request->pembimbing_lapangan,
                'no_perusahaan' => $request->no_perusahaan,
            ]);

            // Redirect back to the index page with a success message
            return redirect()->route('magang.index')->with('success', 'Magang entry updated successfully!');
        }

        public function storeMahasiswaMagang(Request $request)
        {
            $request->validate([
                'no_surat'=> 'required|string',
                'nim' => 'required|string',
                'dosen_id'=> 'required|string',
                'durasi' => 'required|integer',
                'nilai_dosen' => 'nullable|integer|max:100',
                'bukti_nilai' => 'nullable|file|mimes:jpg,pdf|max:2048', // Limit size to 2MB
                'nilai' => 'nullable|integer|max:100',
                'tahun_ajaran' => 'required|string|max:10', // New validation for tahun_ajaran
            ]);

            // Handle file upload
            $filePath = null;
            if ($request->hasFile('bukti_nilai')) {
                $filePath = $request->file('bukti_nilai')->store('uploads', 'public');
            }

            // Create MahasiswaMagang entry
            MahasiswaMagang::create([
                'id_perusahaan' => $request->id_perusahaan, // Make sure id_perusahaan is passed
                'no_surat'=>$request->no_surat,
                'dosen_id'=>$request->dosen_id,
                'nim' => $request->nim,
                'durasi' => $request->durasi,
                'nilai_dosen' =>$request->nilai_dosen,
                'bukti_nilai' => $filePath,
                'nilai' => $request->nilai,
                'tahun_ajaran' => $request->tahun_ajaran, // New column to store tahun_ajaran
            ]);

            return redirect()->route('magang.edit', $request->id_perusahaan)
                            ->with('success', 'Mahasiswa Magang added successfully.');
        }



        public function updateMahasiswaMagang(Request $request, $magang_id, $mahasiswa_id)
        {
            $mahasiswaMagang = MahasiswaMagang::findOrFail($mahasiswa_id);

            // Validate request
            $request->validate([
                'no_surat'=> 'required|string',
                'nim' => 'required|string|max:255',
                'dosen_id'=> 'required|string',
                'durasi' => 'required|integer',
                'nilai_dosen' => 'nullable|integer|max:100',
                'bukti_nilai' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
                'nilai' => 'nullable|integer|max:100',
                'tahun_ajaran' => 'required|string|max:10', // New validation for tahun_ajaran
            ]);

            // Update fields
            $mahasiswaMagang->no_surat = $request->no_surat;
            $mahasiswaMagang->nim = $request->nim;
            $mahasiswaMagang->dosen_id = $request->dosen_id;
            $mahasiswaMagang->durasi = $request->durasi;
            $mahasiswaMagang->nilai_dosen = $request->nilai_dosen;
            $mahasiswaMagang->nilai = $request->nilai;
            $mahasiswaMagang->tahun_ajaran = $request->tahun_ajaran; // New column for tahun_ajaran

            // Handle file upload if there's a new file
            if ($request->hasFile('bukti_nilai')) {
                // Delete the previous file if it exists
                if ($mahasiswaMagang->bukti_nilai) {
                    Storage::disk('public')->delete($mahasiswaMagang->bukti_nilai);
                }

                // Store the new file and update the path
                $filePath = $request->file('bukti_nilai')->store('uploads', 'public');
                $mahasiswaMagang->bukti_nilai = $filePath;
            }

            $mahasiswaMagang->save();

            return redirect()->back()->with('success', 'Mahasiswa Magang updated successfully.');
        }



        public function deleteMahasiswaMagang($magang_id, $mahasiswa_id)
        {
            $mahasiswaMagang = MahasiswaMagang::findOrFail($mahasiswa_id);

            // Check if the student has a file stored, and delete it if it exists
            if ($mahasiswaMagang->bukti_nilai) {
                Storage::disk('public')->delete($mahasiswaMagang->bukti_nilai);
            }

            // Delete the mahasiswa magang record
            $mahasiswaMagang->delete();

            return redirect()->back()->with('success', 'Mahasiswa Magang deleted successfully.');
        }

        public function searchMahasiswaMagang(Request $request, $id)
        {
            $search = $request->input('search');

            $mahasiswaMagang = MahasiswaMagang::join('mahasiswa', 'mahasiswa_magang.nim', '=', 'mahasiswa.nim')
                ->where('id_perusahaan', $id)
                ->when($search, function ($query, $search) {
                    return $query->where(function ($q) use ($search) {
                        $q->where('mahasiswa.nim', 'LIKE', "%{$search}%")
                        ->orWhere('mahasiswa.nama_mahasiswa', 'LIKE', "%{$search}%")
                        ->orWhere('mahasiswa_magang.durasi', 'LIKE', "%{$search}%")
                        ->orWhere('mahasiswa_magang.tahun_ajaran', 'LIKE', "%{$search}%")
                        ->orWhere('mahasiswa_magang.nilai', 'LIKE', "%{$search}%");
                    });
                })
                ->orderBy('tahun_ajaran', 'desc')
                ->orderBy('mahasiswa.nama_mahasiswa', 'asc')
                ->select('mahasiswa_magang.*', 'mahasiswa.nama_mahasiswa')
                ->get();

            return response()->json([
                'html' => view('partials.magang_table', compact('mahasiswaMagang'))->render()
            ]);
        }

        public function show()
        {
            $mahasiswaMagang = MahasiswaMagang::with(['magang', 'mahasiswa'])
                ->join('mahasiswa', 'mahasiswa_magang.nim', '=', 'mahasiswa.nim') // Join with mahasiswa using nim
                ->select('mahasiswa_magang.*', 'mahasiswa.nama_mahasiswa') // Select relevant fields
                ->orderBy('tahun_ajaran', 'desc') // Order by tahun_ajaran (newest first)
                ->orderBy('mahasiswa.nama_mahasiswa', 'asc') // Then order alphabetically by name
                ->get();

            return view('Magang.mahasiswa_magang', compact('mahasiswaMagang'));
        }





}
