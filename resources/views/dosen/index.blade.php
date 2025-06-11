@extends('layouts.app')
@section('content')

<!DOCTYPE html>
<html lang="en">

<body>
            <main id="main" class="main">
            <div class="pagetitle" style="margin-bottom: 10px;">
            <h3 style="margin-left: 15px;">Data Dosen</h3>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item">Tables</li>
                </ol>
            </nav>
        </div>
        <!-- section card  -->
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                        <div class="d-flex justify-content-between mb-3 align-items-center">
                        <div class="d-flex justify-content-between mb-3">
                        <!-- Form Pencarian di Kiri -->
                        <form action="{{ route('dosen.index') }}" method="GET">
                            <div class="input-group" style="width: 250px;"> 
                                <input type="text" name="search" class="form-control" 
                                    placeholder="Cari Nama, NIP, Status ..." 
                                    value="{{ request('search') }}">
                                <button type="submit" class="btn btn-info">Cari</button>
                            </div>
                        </form>

                        <!-- Tombol Tambah Data di Kanan -->
                        <a href="{{ route('dosen.create') }}" class="btn btn-primary"
                        style="margin-left: 10px;">Tambah Data</a>
                    </div>
                        </div>
                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                <thead class="bg-secondary text-white">
                                    <tr>
                                        <th>No </th>
                                        <th>NIDN </th>
                                        <th>NIP </th>
                                        <th>Nama Dosen</th>
                                        <th>Alamat</th>
                                        <th>No Telepon</th>
                                        <th>Jabatan Fungsional</th>
                                        <th>Pangkat</th>
                                        <th>Golongan</th>
                                        <th> No Sertifikat Dosen</th>
                                        <th> Status Dosen</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dosen as $dsn)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">{{ $dsn->nidn }}</td>
                                        <td class="text-center">{{ $dsn->nip }}</td>
                                        <td class="text-center">{{ $dsn->nama_dosen }}</td>
                                        <td class="text-center">{{ $dsn->alamat }}</td>
                                        <td class="text-center">{{ $dsn->no_telp }}</td>
                                        <td class="text-center">{{ $dsn->jabatan_fungsional }}</td>
                                        <td class="text-center">{{ $dsn->pangkat }}</td>
                                        <td class="text-center">{{ $dsn->golongan }}</td>
                                        <td class="text-center">{{ $dsn->no_serdos }}</td>
                                        <td class="text-center">{{ $dsn->status_dosen }}</td>
                                        <!-- <a href="lihat_dosen.php?id=1" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> </a> -->
                                        <td>
                                            <a href="{{ route('dosen.edit', ['id_dosen' => $dsn->id_dosen]) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                            <form action="/dosen/{{ $dsn->id_dosen }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" 
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main><!-- End #main -->
</body>

</html>
@endsection('content')