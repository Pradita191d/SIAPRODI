@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="{{ route('penelitian-dosen.index') }}">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h3 class="h5 font-weight-bold text-center flex-grow-1 m-2">Detail Penelitian Dosen</h3>
                <div style="width: 32px;"></div>
            </div>

            @if ($penelitian)
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th class="bg-light w-25">NIDN</th>
                                <td>{{ $penelitian->dosen->nidn ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">Nama Dosen</th>
                                <td>{{ $penelitian->dosen->nama_dosen ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">Judul Penelitian</th>
                                <td>{{ $penelitian->judul_penelitian }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">Tahun Penelitian</th>
                                <td>{{ $penelitian->tahun_penelitian }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">Skema Penelitian</th>
                                <td>{{ $penelitian->skema_penelitian }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">Sumber Dana</th>
                                <td>{{ $penelitian->sumber_dana }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">Dana Penelitian</th>
                                <td>{{ $penelitian->dana_penelitian }}</td>
                            </tr>
                            <tr>
                                <th class="bg-light">Anggota Penelitian</th>
                                <td>
                                    @if ($penelitian->anggota->isNotEmpty())
                                        <ul>
                                            @foreach ($penelitian->anggota as $anggota)
                                                <li>
                                                    {{ $anggota->nama_anggota}}
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        Tidak ada anggota penelitian.
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="bg-light">File Penelitian</th>
                                <td>
                                    @if ($penelitian->file_penelitian)
                                        <a href="{{ asset('storage/' . $penelitian->file_penelitian) }}" target="_blank" class="btn btn-sm btn-primary">
                                            <i class="fas fa-eye"></i> Lihat
                                        </a>
                                    @else
                                        <span class="text-muted">Tidak ada file</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="bg-light">Status Penelitian</th>
                                <td>
                                    <span class="badge 
                                        @if ($penelitian->status_penelitian == 'Dalam proses') bg-primary 
                                        @elseif ($penelitian->status_penelitian == 'Selesai') bg-success 
                                        @elseif ($penelitian->status_penelitian == 'Dibatalkan') bg-danger 
                                        @endif">
                                        {{ $penelitian->status_penelitian }}
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-danger text-center">
                    Data tidak ditemukan.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
