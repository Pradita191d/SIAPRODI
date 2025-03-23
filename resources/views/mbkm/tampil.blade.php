@extends('layouts.app')

@section('content')
<!-- Header dengan judul dan breadcrumb -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kegiatan MBKM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .custom-breadcrumb {
            max-width: 600px;
            /* Panjang kotak breadcrumb */
            margin-top: 0px;
            /* Menurunkan breadcrumb */
        }
    </style>
</head>

<body>
    <div class="d-flex justify-content-between align-items-center mb-4" style="margin-left: 15px;">
        <div>
            <h3 class="h4 font-weight-bold mb-2">Data Kegiatan MBKM</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb custom-breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tables</li>
                </ol>
            </nav>
        </div>
    </div>
</body>

</html>

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <a class="btn btn-primary" href="{{ route('mbkm.tambah') }}">
                    <i class="fas fa-plus"></i> Tambah Data</a>

                <!-- Form pencarian di sebelah kanan -->
                <form action="{{ route('mbkm.tampil') }}" method="GET" class="mb-4">
                    <div class="input-group" style="max-width: 500px;">
                        <input type="text" name="search" class="form-control" placeholder="Cari Nama Mahasiswa..." value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-secondary"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>


            <div class="table-responsive">
                <table class="table border-0">
                    <thead class="bg-primary text-white text-center">
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama Mahasiswa</th>
                            <th>Nama Program</th>
                            <th>Nama Lembaga</th>
                            <th>Lokasi</th>
                            <th>Bidang Program</th>
                            <th>Durasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mbkm as $no => $data)
                        <tr>
                            <td class="text-center">{{ $no+1 }}</td>
                            <td class="text-center">{{ $data->nim }}</td>
                            <td class="text-center">{{ $data->namaMhs }}</td>
                            <td class="text-center">{{ $data->nama_program }}</td>
                            <td class="text-center">{{ $data->namaLembaga }}</td>
                            <td class="text-center">{{ $data->lokasi }}</td>
                            <td class="text-center">{{ $data->bidangProgram }}</td>
                            <td class="text-center">{{ $data->durasi }}</td>

                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <!-- Tombol Detail -->
                                    <a href="{{ route('mbkm.detail', $data->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>

                                    <!-- Tombol Edit -->
                                    <a href="{{ route('mbkm.edit', $data->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>

                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('mbkm.delete', $data->id) }}" method="post" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
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