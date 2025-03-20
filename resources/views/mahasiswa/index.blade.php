@extends('layouts.app')

@section('content')
    <div>
        <div class="card shadow-sm">
            <div class="card-body">
                <h3 class="h5 font-weight-bold mb-3">Daftar Mahasiswa</h3>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th class="text-center">Nama Mahasiswa</th>
                                <th class="text-center">NIM</th>
                                <th class="text-center">Tahun Masuk</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mahasiswas as $mahasiswa)
                                <tr>
                                    <td class="text-center">{{ $mahasiswa->nama_mahasiswa }}</td>
                                    <td class="text-center">{{ $mahasiswa->nim }}</td>
                                    <td class="text-center">
                                        {{ $mahasiswa->tahunMasuk->tahun ?? '-' }}
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-sm btn-primary">Lihat</button>
                                            <button class="btn btn-sm btn-success">Edit</button>
                                            <button class="btn btn-sm btn-danger"
                                                onclick="confirmDelete('{{ $mahasiswa->id_mahasiswa }}', '{{ $mahasiswa->nama_mahasiswa }}')">
                                                Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
