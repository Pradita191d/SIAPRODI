@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Data Yudisium</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

  <!-- Form Pencarian & Tombol Tambah Data -->
  <div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <a href="yudisium/create" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Tambah Data
        </a> 
        <a href="/yudisium/exportpdf" class="btn btn-success btn-sm ms-2" target="_blank">
            <i class="fas fa-print"></i> Cetak PDF
        </a>
    </div>

    <form action="yudisium/search" method="GET" class="d-flex">
        <div class="input-group">
            <input type="text" name="search" class="form-control form-control-sm w-auto" 
                   placeholder="Cari Semester..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="fas fa-search"></i> Cari
            </button>
        </div>
    </form>
</div>


<!-- Tabel Data Mahasiswa -->
<table class="table table-bordered text-center">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Nama Mahasiswa</th>
            <th>Semester</th>
            <th>Tanggal Yudisium</th>
            <th>Lokasi</th>
            <th>Masalah</th>
            <th>Solusi Prodi</th>
            <th>Solusi Jurusan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($yudisium as $ys)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $ys->mahasiswa?->nim }}</td>
            <td>{{ $ys->mahasiswa?->nama_mahasiswa }}</td>
            <td>{{ $ys->semester }}</td>
            <td>{{ $ys->tgl_yudisium }}</td>
            <td>{{ $ys->lokasi }}</td>
            <td>{{ $ys->masalah }}</td>
            <td>{{ $ys->solusi_prodi }}</td>
            <td>{{ $ys->solusi_jurusan }}</td>
            <td>
                <div class="d-flex justify-content-center gap-2">
                    <a href="{{ url('/yudisium/'.$ys->id_yudisium.'/edit') }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('yudisium.destroy', $ys->id_yudisium) }}" method="POST" 
                          onsubmit="return confirm('Apakah ingin dihapus?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash-alt"></i> Hapus
                        </button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

        <br>
</div>
@endsection('content')
