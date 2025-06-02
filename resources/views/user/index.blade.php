@extends('layouts.app')

@section('title', 'Data User')

@section('content')
<div class="card shadow-lg">
    <div class="card-header bg-primary text-white">
        <h3 class="card-title"><i class="fas fa-users"></i> Data User</h3>
    </div>
    
    <div class="card-body">
        <!-- Form Pencarian -->
        <form action="{{ route('user.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari username atau role..." value="{{ request('search') }}">
                <div class="input-group-append">
                    <button class="btn btn-secondary" type="submit"><i class="fas fa-search"></i> Cari</button>
                </div>
            </div>
        </form>

        <!-- Tombol Tambah Data -->
        <a href="{{ route('user.create') }}" class="btn btn-success mb-3">
            <i class="fas fa-plus"></i> Tambah Data
        </a>

        <!-- Tabel Data -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="bg-secondary text-white">
                    <tr class="text-center">
                        <th style="width: 5%;">No.</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th style="width: 20%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @forelse($users as $user)
                        <tr class="text-center">
                            <td>{{ $no++ }}.</td>
                            <td class="text-left">{{ $user->username }}</td>
                            <td>
                                <span class="badge 
                                    @if($user->role == 'admin') badge-danger 
                                    @elseif($user->role == 'dosen') badge-info 
                                    @elseif($user->role == 'mahasiswa') badge-success 
                                    @endif">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('user.edit', $user->id_user) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('user.destroy', $user->id_user) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?');">
                                        <i class="fas fa-trash-alt"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Tidak ada data ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Paginasi -->
        <div class="d-flex justify-content-center mt-3">
            {{ $users->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
@endsection
