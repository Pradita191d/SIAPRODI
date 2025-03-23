@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <!-- Tombol Cetak PDF -->
            @php
            @endphp
            <a href="{{route('mbkm.cetak', $mbkm->id)}}" class="btn btn-success">
                <i class="fas fa-print"></i> Cetak PDF</a>
            <h3 class="h5 font-weight-bold mb-0 text-center">FORM DETAIL KONVERSI SKS KEGIATAN MBKM</h3>
        </div>
        <div class="card-body">
            <!-- Data Mahasiswa -->
            <h5 class="fw-bold text-primary">Data Mahasiswa</h5>
            <table class="table table-bordered table-striped">
                <tr>
                    <th>Nama Mahasiswa</th>
                    <td>{{ $mbkm->namaMhs }}</td>
                </tr>
                <tr>
                    <th>NIM</th>
                    <td>{{ $mbkm->nim }}</td>
                </tr>
                <tr>
                    <th>Program Studi</th>
                    <td>{{ $mbkm->program_studi }}</td>
                </tr>
                <tr>
                    <th>Jurusan</th>
                    <td>{{ $mbkm->jurusan }}</td>
                </tr>
                <tr>
                    <th>Semester</th>
                    <td>{{ $mbkm->semester }}</td>
                </tr>
                <tr>
                    <th>Nomor HP</th>
                    <td>{{ $mbkm->no_hp }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $mbkm->email }}</td>
                </tr>
            </table>

            <!-- Informasi Kegiatan MBKM -->
            <h5 class="fw-bold mt-4 text-primary">Informasi Kegiatan MBKM</h5>
            <table class="table table-bordered table-striped">
                <tr>
                    <th>Nama Program</th>
                    <td>{{ $mbkm->nama_program }}</td>
                </tr>
                <tr>
                    <th>Durasi Kegiatan</th>
                    <td>{{ $mbkm->durasi }}</td>
                </tr>
                <tr>
                    <th>Lembaga / Perusahaan</th>
                    <td>{{ $mbkm->namaLembaga }}</td>
                </tr>
                <tr>
                    <th>Deskripsi Kegiatan</th>
                    <td>{{ $mbkm->deskripsi }}</td>
                </tr>
            </table>

            <!-- Mata Kuliah yang Dikonversi -->
            <h5 class="fw-bold mt-4 text-primary">Mata Kuliah yang Dikonversi</h5>

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>

                        <th>Nama Mata Kuliah</th>
                        <th>SKS</th>
                        <th>Keterangan Pengganti</th>
                    </tr>
                </thead>
                <tbody>
                    @if (is_object($mbkm) && isset($mbkm->namaMatkul) && is_iterable($mbkm->namaMatkul))
                    @foreach($mbkm->namaMatkul as $index => $namaMatkul)
                    <tr>

                        <td>{{ $namaMatkul }}</td>
                        <td>{{ $mbkm->sks[$index] ?? '-' }}</td>
                        <td>{{ $mbkm->keterangan[$index] ?? '-' }}</td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada mata kuliah yang dikonversi</td>
                    </tr>
                    @endif
                </tbody>
            </table>

            <!-- Penilaian dan Rekomendasi -->
            <h5 class="fw-bold mt-4 text-primary">Penilaian dan Rekomendasi</h5>
            <table class="table table-bordered table-striped">
                <tr>
                    <th>Dosen Pembimbing Akademik</th>
                    <td>{{ $mbkm->dospem }}</td>
                </tr>
                <tr>
                    <th>Koordinator MBKM</th>
                    <td>{{ $mbkm->koor_mbkm }}</td>
                </tr>
                <tr>
                    <th>Ketua Program Studi</th>
                    <td>{{ $mbkm->kaprodi }}</td>
                </tr>
            </table>

            <!-- Catatan Tambahan -->
            <h5 class="fw-bold mt-4 text-primary">Catatan Tambahan</h5>
            <div class="card">
                <div class="card-body">
                    <p class="mb-0">{{ $mbkm->catatan_tambahan }}</p>
                </div>
            </div>

            <a href="{{ route('mbkm.tampil') }}" class="btn btn-secondary mt-3">Kembali</a>
        </div>
    </div>
</div>
@endsection