@extends('layouts.main')
@section('content')

<div class="container">
    <h3 class="mb-3">Edit Data Dosen</h3>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('dosen.update', $dosen->id_dosen) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nidn" class="form-label">NIDN</label>
                    <input type="text" class="form-control" name="nidn" id="nidn" value="{{ $dosen->nidn }}" required>
                </div>

                <div class="mb-3">
                    <label for="nip" class="form-label">NIP</label>
                    <input type="number" class="form-control" name="nip" id="nip" value="{{ $dosen->nip }}" required>
                </div>

                <div class="mb-3">
                    <label for="nama_dosen" class="form-label">Nama Dosen</label>
                    <input type="text" class="form-control" name="nama_dosen" id="nama_dosen" value="{{ $dosen->nama_dosen }}" required>
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control" name="alamat" id="alamat" value="{{ $dosen->alamat }}" required>
                </div>

                <div class="mb-3">
                    <label for="no_telp" class="form-label">No Telepon</label>
                    <input type="text" class="form-control" name="no_telp" id="no_telp" value="{{ $dosen->no_telp }}" required>
                </div>

                <div class="mb-3">
                    <label for="jabatan_fungsional" class="form-label">Jabatan Fungsional</label>
                    <select class="form-control" name="jabatan_fungsional" id="jabatan_fungsional" required>
                        <option value="">-- Pilih Jabatan Fungsiona; --</option>
                        <option value="Direktur" {{ $dosen->status_dosen == 'Direktur' ? 'selected' : '' }}>Direktur</option>
                        <option value="Wakil Direktur 1" {{ $dosen->jabatan_fungsional == 'Wakil Direktur 1' ? 'selected' : '' }}>Wakil Direktur 1</option>
                        <option value="Wakil Direktur 2" {{ $dosen->jabatan_fungsional == 'Wakil Direktur 2' ? 'selected' : '' }}>Wakil Direktur 2</option>
                        <option value="Wakil Direktur 3" {{ $dosen->jabatan_fungsional == 'Wakil Direktur 3' ? 'selected' : '' }}>Wakil Direktur 3</option>
                        <option value="Kepala Jurusan" {{ $dosen->jabatan_fungsional == 'Kepala Jurusan' ? 'selected' : '' }}>Kepala Jurusan</option>
                        <option value="Kepala Program Studi" {{ $dosen->jabatan_fungsional == 'Kepala Program Studi' ? 'selected' : '' }}>Kepala Program Studi</option>
                        <option value="Dosen" {{ $dosen->jabatan_fungsional == 'Dosen' ? 'selected' : '' }}>Dosen</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="no_serdo" class="form-label">No Sertifikat Dosen</label>
                    <input type="text" class="form-control" name="no_serdos" id="no_serdos" value="{{ $dosen->no_serdos }}" required>
                </div>
                <div class="mb-3">
                    <label for="status_dosen" class="form-label">Status Dosen</label>
                    <select class="form-control" name="status_dosen" id="status_dosen" required>
                        <option value="">-- Pilih Status Dosen--</option>
                        <option value="Dosen Tetap" {{ $dosen->status_dosen == 'dosen tetap' ? 'selected' : '' }}>Dosen Tetap</option>
                        <option value="Dosen Praktisi" {{ $dosen->status_dosen == 'dosen praktisi' ? 'selected' : '' }}>Dosen Praktisi</option>
                        <option value="Dosen Tidak Tetap" {{ $dosen->status_dosen == 'dosen tidak tetap' ? 'selected' : '' }}>Dosen Tidak Tetap</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ url('/dosen') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>

@endsection
