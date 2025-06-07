@extends('layouts.app')
@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h3 style="margin-left: 15px;">Daftar Sertifikat Kompetensi Dosen</h3>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item">Tables</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <!-- Header Card -->
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-title mb-0">Daftar Sertifikat Kompetensi</h5>
                            <a href="{{ route('sertikom.create') }}" class="btn btn-success">
                                <i class="fas fa-plus"></i> Tambah Data
                            </a>
                        </div>

                        <!-- Pencarian dan Filter -->
                        <div class="row mb-3">
                            <div class="col-lg-6 col-md-12 mb-2">
                                <form action="{{ route('index') }}" method="GET" class="input-group">
                                    <input type="text" name="search" class="form-control" 
                                        placeholder="Cari sertifikat..." value="{{ request('search') }}">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-search"></i> Cari
                                    </button>
                                </form>
                            </div>

                            <div class="col-lg-6 col-md-12">
                                <form action="{{ route('index') }}" method="GET" class="input-group">
                                    <select name="tahun_terbit" class="form-control">
                                        <option value="">Tahun Terbit</option>
                                        @for ($year = date('Y'); $year >= 2015; $year--)
                                            <option value="{{ $year }}" {{ request('tahun_terbit') == $year ? 'selected' : '' }}>
                                                {{ $year }}
                                            </option>
                                        @endfor
                                    </select>
                                    
                                    <select name="tahun_berlaku" class="form-control">
                                        <option value="">Tahun Berlaku</option>
                                        @for ($year = date('Y')+10; $year >= 2015; $year--)
                                            <option value="{{ $year }}" {{ request('tahun_berlaku') == $year ? 'selected' : '' }}>
                                                {{ $year }}
                                            </option>
                                        @endfor
                                    </select>

                                    <button type="submit" class="btn btn-secondary">
                                        <i class="fas fa-filter"></i> Filter
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Tabel Responsif -->
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="table-dark text-light text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>NIDN</th>
                                        <th>Nama Dosen</th>
                                        <th>Nomor Sertifikat</th>
                                        <th>Nama Sertifikat</th>
                                        <th>Bidang Kompetensi</th>
                                        <th>Nama Lembaga</th>
                                        <th>Tanggal Terbit</th>
                                        <th>Berlaku Sampai</th>
                                        <th>Dokumen</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sertifikat as $s)
                                    <tr class="text-center">
                                        <td class="text-nowrap">{{ $loop->iteration }}</td>
                                        <td class="text-nowrap">{{ $s->nidn }}</td>
                                        <td class="text-nowrap">{{ $s->nama_dosen }}</td>
                                         <td class="text-nowrap">{{$s->no_sertikom }}</td>
                                        <td class="text-nowrap">{{ $s->nama_sertifikat }}</td>
                                        <td class="text-nowrap">{{ $s->bidang_keahlian }}</td>
                                        <td class="text-nowrap">{{ $s->nama_lembaga }}</td>
                                        <td class="text-nowrap">{{ date('d-m-Y', strtotime($s->tanggal_terbit)) }}</td>
                                        <td class="text-nowrap">{{ date('d-m-Y', strtotime($s->berlaku_sampai)) }}</td>
                                        <td>
                                            @if($s->doc_sertifikat)
                                                <a href="{{ asset('sertifikat/' . $s->doc_sertifikat) }}" target="_blank" class="btn btn-sm btn-info"><i class="fas fa-eye me-2"></i>  Lihat</a>
                                            @else
                                                <span class="text-danger">Tidak ada file</span>
                                            @endif
                                        </td>
                                        <td class="text-nowrap">
                                            <a href="{{ route('sertikom.edit', ['id_sertikom' => $s->id_sertikom]) }}" class="btn btn-warning btn-sm text-white btn-sm fas fa-edit"> Edit</a>
                                            <form action="{{ route('sertikom.destroy', $s->id_sertikom) }}" method="POST" class="d-inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm btn-delete fas fa-trash-alt"> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- End Table -->
                    </div>
                </div>
            </div>
        </div>
    </section>
     <!-- SweetAlert -->
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

     <script>
         document.addEventListener("DOMContentLoaded", function () {
             document.querySelectorAll(".btn-delete").forEach(button => {
                 button.addEventListener("click", function (e) {
                     e.preventDefault();
                     let form = this.closest("form");
 
                     Swal.fire({
                         title: "Apakah Anda yakin?",
                         text: "Data ini akan dihapus secara permanen!",
                         icon: "warning",
                         showCancelButton: true,
                         confirmButtonColor: "#d33",
                         cancelButtonColor: "#3085d6",
                         confirmButtonText: "Ya, Hapus!",
                         cancelButtonText: "Batal"
                     }).then((result) => {
                         if (result.isConfirmed) {
                             form.submit(); // Kirim formulir DELETE
                         }
                     });
                 });
             });
 
             // Notifikasi sukses jika ada session 'success'
             let successMessage = "{{ session('success') }}";
             if (successMessage) {
                 Swal.fire({
                     icon: "success",
                     title: "Berhasil!",
                     text: successMessage,
                     showConfirmButton: false,
                     timer: 2000
                 });
             }
         });
     </script>
</main>
@endsection
