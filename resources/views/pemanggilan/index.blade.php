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

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <h3 class="h5 font-weight mb-0">Data Pemanggilan Orang Tua</h3>

                <form action="{{ route('pemanggilan.index') }}" method="GET" class="ml-auto" style="max-width: 400px;">
                    <div class="input-group">
                    <a href="{{ route('pemanggilan.exportExcel') }}" class="btn btn-success mr-2">
            <i class="fas fa-file-excel"></i> Export to Excel
        </a>
                        <input type="text" class="form-control" name="search" placeholder="Search By Name & NIM..."
                               value="{{ request('search') }}" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-info" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <a href="{{ route('pemanggilan.tambah') }}" class="btn btn-primary ml-2">
                    <i class="fas fa-plus"></i> Tambah Data
                </a>
            </div>
        </div>

        <!-- Tabel -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover text-center align-middle">
            <thead class="bg-primary text-white text-center align-middle">
    <tr>
        <th class="align-middle" style="width: 5%;">No</th>
        <th class="align-middle" style="width: 12%;">Nama Ortu</th>
        <th class="align-middle" style="width: 10%;">No Telp</th>
        <th class="align-middle" style="width: 15%;">Alamat</th>
        <th class="align-middle" style="width: 12%;">Nama Mahasiswa</th>
        <th class="align-middle" style="width: 8%;">NIM</th>
        <th class="align-middle" style="width: 6%;">Semester</th>
        <th class="align-middle" style="width: 10%;">Jurusan</th>
        <th class="align-middle" style="width: 10%;">Prodi</th>
        <th class="align-middle" style="width: 10%;">Tanggal Pemanggilan</th>
        <th class="align-middle" style="width: 15%;">Alasan Pemanggilan</th>
        <th class="align-middle" style="width: 15%;">Solusi</th>
        <th class="align-middle" style="width: 10%;">Aksi</th>
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
                        <td colspan="12">Tidak ada data ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
@endsection
