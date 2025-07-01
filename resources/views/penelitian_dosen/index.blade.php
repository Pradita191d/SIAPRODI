@extends('layouts.app') {{-- Change this to match your actual layout file name --}}

@section('content')
    <div>
        <div class="card shadow-sm">
            <div class="card-body">
                <h3 class="h5 font-weight-bold mb-3">Daftar Penelitian Dosen</h3>
                <div class="d-flex justify-content-between mb-3">
                    <a href="{{ route('penelitian-dosen.create') }}" class="btn btn-primary btn-sm">
                        + Tambah Penelitian
                    </a>
                    <form action="{{ route('penelitian-dosen.index') }}" method="GET">
                        <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari nama dosen, tahun" value="{{ request('search') }}">
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th class="text-center">NIDN</th>
                                <th class="text-center">Nama Dosen</th>
                                <th class="text-center">Judul Penelitian</th>
                                <th class="text-center">Tahun Penelitian</th>
                                <th class="text-center">Skema Penelitian</th>
                                <th class="text-center">Status Penelitian</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($penelitian as $p)
                                <tr>
                                    <td class="text-center">{{ $p->dosen->nidn ?? '-' }}</td>
                                    <td class="text-center">{{ $p->dosen->nama_dosen ?? '-'  }}</td>
                                    <td class="text-center">{{ $p->judul_penelitian }}</td>
                                    <td class="text-center">{{ $p->tahun_penelitian }}</td>
                                    <td class="text-center">{{ $p->skema_penelitian }}</td>
                                    <td class="text-center">
                                     <span class="badge 
                                        @if ($p->status_penelitian == 'Dalam proses') bg-primary 
                                        @elseif ($p->status_penelitian == 'Selesai') bg-success 
                                        @elseif ($p->status_penelitian == 'Dibatalkan') bg-danger 
                                        @endif">
                                        {{ $p->status_penelitian }}
                                    </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('penelitian.detail', ['id_penelitian' => $p->id_penelitian]) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i>
                                            </a>   
                                            <a href="{{ route('penelitian-dosen.edit', ['penelitian_dosen' => $p->id_penelitian]) }}" class="btn btn-sm btn-outline-warning">                                         
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <form action="{{ route('penelitian-dosen.destroy', $p->id_penelitian) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus penelitian ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    <i class="fas fa-trash"></i>
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
