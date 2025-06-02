@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en">

<body>
    <main id="main" class="main">
        <div class="pagetitle">
            <h3 style="margin-left: 15px;">Data Program Kreativitas Mahasiswa</h3>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item">Tables</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                        <a href="{{ route('pkm.create') }}" class="btn btn-primary mb-3">Tambah Data</a>
                        
                        <!-- Form Pencarian -->
<form action="{{ route('pkm.index') }}" method="GET" class="mb-3 d-flex justify-content-end">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Cari Tahun..." value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary btn-sm ms-2">Cari</button>
    </div>
</form>
                            <!-- Table with stripped rows -->
                            <table class="table table-bordered datatable">
                            <thead class="table-primary">
                                    <tr>
                                    <th>NO</th>
                                    <th>NIDN</th>
                                    <th>Nama Dosen Pembimbing</th>
                                    <th>NIM</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Judul</th>
                                    <th data-type="date" data-format="YYYY/DD/MM">Tahun</th>
                                    <th>Lokasi</th>
                                    <th>Anggaran</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pkm as $p_pkm)
                                    <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">{{ $p_pkm->nidn }}</td> 
                                        <td class="text-center">{{ $p_pkm->nama_dosen }}</td> 
                                        <td class="text-center">{{ $p_pkm->nim }}</td> 
                                        <td class="text-center">{{ $p_pkm->nama_mahasiswa }}</td> 
                                        <td class="text-center">{{ $p_pkm->judul }}</td> 
                                        <td class="text-center">{{ $p_pkm->tahun }}</td> 
                                        <td class="text-center">{{ $p_pkm->lokasi }}</td> 
                                        <td class="text-center">{{ $p_pkm->anggaran }}</td> 
                                        <td class="text-center">
                                    @if($p_pkm->status == 'Berjalan')
                                        <span class="badge bg-warning text-dark">{{ $p_pkm->status }}</span>
                                    @elseif($p_pkm->status == 'Sukses')
                                        <span class="badge bg-success">{{ $p_pkm->status }}</span>
                                    @elseif($p_pkm->status == 'Gagal')
                                        <span class="badge bg-danger">{{ $p_pkm->status }}</span>
                                    @else
                                        <span class="badge bg-secondary">{{ $p_pkm->status }}</span>
                                    @endif
                                    </td>


  <td class="d-flex align-items-center gap-2">
    <a href="{{ route('pkm.edit', ['id' => $p_pkm->id_pkm]) }}" class="btn btn-warning btn-sm">
        <i class="fas fa-edit"></i>
    </a>

    <form action="/pkm/{{ $p_pkm->id_pkm }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm" 
            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
            <i class="fas fa-trash"></i>
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