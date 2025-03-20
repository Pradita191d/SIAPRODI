@extends('layouts.app')

@section('content')
<div>
        <div class="shadow-sm card">
            <div class="card-body">
                <h3 class="mb-3 h5 font-weight-bold">Daftar Mahasiswa</h3>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="text-white bg-primary">
                            <tr>
                                <th class="text-center">Nama Mahasiswa</th>
                                <th class="text-center">NIM</th>
                                <th class="text-center">Tahun Masuk</th>
                                <th class="text-center">No Hp</th>
                                <th class="text-center">No Hp Orang Tua</th>
                                <th class="text-center">Alamat</th>
                                <th class="text-center">Status Mahasiswa</th>
                            </tr>
                        </thead>
                        <tbody>

                                <tr>
                                    <td class="text-center">{{ $mahasiswa->nama_mahasiswa }}</td>
                                    <td class="text-center">{{ $mahasiswa->nim }}</td>
                                    <td class="text-center">{{ $mahasiswa->tahunMasuk->tahun ?? '-' }}</td>
                                    <td class="text-center">{{ $mahasiswa->no_hp }}</td>
                                    <td class="text-center">{{ $mahasiswa->no_ortu }}</td>
                                    <td class="text-center">{{ $mahasiswa->alamat }}</td>
                                    <td class="text-center">
                                        @if ($mahasiswa->status_aktif == 'Aktif')
                                            <span class="text-sm badge bg-success">Aktif</span>
                                        @elseif ($mahasiswa->status_aktif == 'Lulus')
                                            <span class="text-sm badge bg-primary">lulus</span>
                                        @elseif ($mahasiswa->status_aktif == 'DO')
                                            <span class="text-sm badge bg-danger">DO</span>
                                        @elseif ($mahasiswa->status_aktif == 'Undur Diri')
                                            <span class="text-sm badge bg-warning">Undur Diri</span>
                                        @endif
                                    </td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
