@extends('layouts.app') {{-- Change this to match your actual layout file name --}}

@section('content')
    <div >
        <div class="card shadow-sm">
            <div class="card-body" >
                <h3 class="h5 font-weight-bold mb-3">Daftar Prestasi Mahasiswa</h3>
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <!-- Tombol Tambah Data -->
                            <div class="d-flex gap-2">
                            <a href="prestasi/create" class="btn btn-primary mb-3">Tambah Data</a>
                            <a href="/prestasi/exportpdf" class="btn btn-success mb-3" target="_blank">Cetak</a>    
                            </div>
                            <!-- Form Pencarian -->
                            <form action="/prestasi/search" method="GET" class="d-flex">
                                <input type="text" name="search" class="form-control me-2" placeholder="Cari Berdasarkan Tahun" />
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                      <i class="fas fa-search"></i>
                                    </button>
                                  </div>
                            </form>
                        </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class=" text-black">
                            <tr>
                                <th class="text-center">NO</th>
                                <th class="text-center">Nama Mahasiswa</th>
                                <th class="text-center">NIM</th>
                                <th class="text-center">Jenis Prestasi</th>
                                <th class="text-center">Penyelenggara</th>
                                <th class="text-center">Tahun</th>
                                <th class="text-center">Tingkat Prestasi</th>
                                <th class="text-center">Juara</th>
                                <th class="text-center">File</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pres_mhs as $p_mhs)
                                <tr>
                                    <td >{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $p_mhs->mahasiswa?->nama_mahasiswa }}</td>
                                    <td class="text-center"> {{ $p_mhs->mahasiswa?->NIM }} </td>
                                    <td class="text-center">{{ $p_mhs->jenis_pres }}</td>
                                    <td class="text-center">{{ $p_mhs->penyelenggara }}</td>
                                    <td class="text-center">{{ $p_mhs->tahun }}</td>
                                    <td class="text-center">{{ $p_mhs->tingkat_pres }}</td>
                                    <td class="text-center">{{ $p_mhs->juara }}</td>
                                    {{-- <td class="text-center">{{ $p_mhs->file_sertif }}</td> --}}
                                    <td class="text-center">
                                        @if($p_mhs->file_sertif)
                                            <a href="{{ url('sertifikat/' . $p_mhs->file_sertif) }}" target="_blank">
                                                {{ $p_mhs->file_sertif }}
                                            </a>
                                        @else
                                            Tidak ada file
                                        @endif
                                    </td>
                                    
                                    <td><a href="/prestasi/{{ $p_mhs->id }}/delete" class="btn btn-danger" onclick="return confirm('Apakah yakin dihapus?{{ $p_mhs->nama_mahasiswa }}')">Hapus</a>
                                        <a href="/prestasi/{{ $p_mhs->id }}/edit" class="btn btn-warning">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    @endsection('content')