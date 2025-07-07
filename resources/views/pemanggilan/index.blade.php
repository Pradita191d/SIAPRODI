@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Breadcrumb -->
    <ol class="breadcrumb bg-light p-2 rounded">
        <li class="breadcrumb-item">
            <a href="{{ url('/') }}" class="text-info">
                <i class="fas fa-home"></i> Home
            </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            <i class="fas fa-user-friends"></i> Data Pemanggilan
        </li>
    </ol>

    <!-- Card -->
    <div class="card shadow-sm">
        <div class="card-body">
            <!-- Header -->
            <div class="row mb-3">
                <div class="col-md-6 mb-2">
                    <h3 class="h5 font-weight mb-0">
                        <i class="fas fa-users text-primary mr-1"></i> Data Pemanggilan Orang Tua
                    </h3>
                </div>
            </div>

            <!-- Actions -->
            <div class="row mb-3">
                <!-- Kiri: Export & Date -->
                <div class="col-md-6 d-flex flex-wrap align-items-center gap-2">
                    <a href="{{ route('pemanggilan.exportExcel') }}" class="btn btn-success">
                        <i class="fas fa-file-excel"></i> Export Excel
                    </a>

                    <form action="{{ route('pemanggilan.cetakRangePDF') }}" method="POST" target="_blank" class="form-inline">
                        @csrf
                        <div class="input-group">
                            <input type="date" class="form-control" name="start_date" required>
                            <div class="input-group-prepend input-group-append">
                                <span class="input-group-text">s/d</span>
                            </div>
                            <input type="date" class="form-control" name="end_date" required>
                            <div class="input-group-append">
                                <button class="btn btn-danger" type="submit">
                                    <i class="fas fa-file-pdf"></i> Cetak PDF
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Kanan: Search & Tambah -->
                <div class="col-md-6 d-flex flex-wrap justify-content-md-end align-items-center gap-2">
                    <form action="{{ route('pemanggilan.index') }}" method="GET" class="form-inline">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search Name & NIM..." value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button class="btn btn-info" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <a href="{{ route('pemanggilan.tambah') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Data
                    </a>
                </div>
            </div>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover text-center align-middle">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th style="width: 5%;">No</th>
                            <th style="width: 12%;">Nama Ortu</th>
                            <th style="width: 10%;">No Telp</th>
                            <th style="width: 15%;">Alamat</th>
                            <th style="width: 12%;">Nama Mahasiswa</th>
                            <th style="width: 8%;">NIM</th>
                            <th style="width: 6%;">Semester</th>
                            <th style="width: 10%;">Jurusan</th>
                            <th style="width: 10%;">Prodi</th>
                            <th style="width: 10%;">Tanggal Pemanggilan</th>
                            <th style="width: 15%;">Alasan Pemanggilan</th>
                            <th style="width: 15%;">Solusi</th>
                            <th style="width: 10%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pemanggilans as $index => $pemanggilan)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="text-nowrap">{{ $pemanggilan->nama_ortu }}</td>
                            <td>{{ $pemanggilan->no_telp_ortu }}</td>
                            <td class="text-left">{{ $pemanggilan->alamat }}</td>
                            <td>{{ $pemanggilan->mahasiswa->nama_mahasiswa }}</td>
                            <td>{{ $pemanggilan->nim }}</td>
                            <td>{{ $pemanggilan->semester }}</td>
                            <td>{{ $pemanggilan->jurusan }}</td>
                            <td>{{ $pemanggilan->prodi }}</td>
                            <td>{{ $pemanggilan->tanggal_pemanggilan ?? '-' }}</td>
                            <td class="text-left" data-toggle="tooltip" title="{{ $pemanggilan->alasan_pemanggilan }}">
                                {{ Str::limit($pemanggilan->alasan_pemanggilan, 30, '...') }}
                            </td>
                            <td class="text-left" data-toggle="tooltip" title="{{ $pemanggilan->solusi }}">
                                {{ Str::limit($pemanggilan->solusi, 30, '...') }}
                            </td>
                            <td class="text-nowrap">
                                <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#detailModal{{ $pemanggilan->id }}">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <a href="{{ route('pemanggilan.edit', $pemanggilan->id) }}" class="btn btn-sm btn-success">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('pemanggilan.destroy', $pemanggilan->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal Detail -->
                        <div class="modal fade" id="detailModal{{ $pemanggilan->id }}" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel{{ $pemanggilan->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Detail Pemanggilan</h5>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Nama Orang Tua:</strong> {{ $pemanggilan->nama_ortu }}</p>
                                        <p><strong>No. Telp:</strong> {{ $pemanggilan->no_telp_ortu }}</p>
                                        <p><strong>Alamat:</strong> {{ $pemanggilan->alamat }}</p>
                                        <p><strong>Nama Mahasiswa:</strong> {{ $pemanggilan->mahasiswa->nama_mahasiswa }}</p>
                                        <p><strong>NIM:</strong> {{ $pemanggilan->nim }}</p>
                                        <p><strong>Semester:</strong> {{ $pemanggilan->semester }}</p>
                                        <p><strong>Jurusan:</strong> {{ $pemanggilan->jurusan }}</p>
                                        <p><strong>Prodi:</strong> {{ $pemanggilan->prodi }}</p>
                                        <p><strong>Tanggal Pemanggilan:</strong> {{ $pemanggilan->tanggal_pemanggilan }}</p>
                                        <p><strong>Alasan Pemanggilan:</strong> {{ $pemanggilan->alasan_pemanggilan }}</p>
                                        <p><strong>Solusi:</strong> {{ $pemanggilan->solusi }}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="{{ route('pemanggilan.pdf', $pemanggilan->id) }}" target="_blank" class="btn btn-primary">
                                            Cetak PDF
                                        </a>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr>
                            <td colspan="13">Tidak ada data ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Tooltip -->
<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
@endsection
