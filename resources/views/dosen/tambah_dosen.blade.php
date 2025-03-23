@extends('layouts.app')
@section('content')

<div class="container">
    <h3 class="mb-3">Tambah Data Dosen</h3>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('dosen.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="nidn" class="form-label">NIDN</label>
                    <input type="text" class="form-control" name="nidn" id="nidn" required>
                </div>

                <div class="mb-3">
                    <label for="nip" class="form-label">NIP</label>
                    <input type="number" class="form-control" name="nip" id="nip" required>
                </div>

                <div class="mb-3">
                    <label for="nama_dosen" class="form-label">Nama Dosen</label>
                    <input type="text" class="form-control" name="nama_dosen" id="nama_dosen" required>
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control" name="alamat" id="alamat" required>
                </div>

                <div class="mb-3">
                    <label for="no_telp" class="form-label">No Telepon</label>
                    <input type="text" class="form-control" name="no_telp" id="no_telp" required>
                </div>

                <div class="mb-3">
                    <label for="jabatan_fungsional" class="form-label">Jabatan Fungsional </label>
                    <select class="form-control" name="jabatan_fungsional" id="jabatan_fungsional" required>
                        <option value="">-- Pilih Jabatan Fungsional --</option>
                        <option value="Direktur">Direktur</option>
                        <option value="Wakil Direktur 1">Wakil Direktur 1</option>
                        <option value="Wakil Direktur 2">Wakil Direktur 2</option>
                        <option value="Wakil Direktur 3">Wakil Direktur 3</option>
                        <option value="Kepala Jurusan">Kepala Jurusan</option>
                        <option value="Kepala Program Studi">Kepala Program Studi</option>
                        <option value="Dosen">Dosen</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="no_serdos" class="form-label">No Sertifikat Dosen</label>
                    <input type="text" class="form-control" name="no_serdos" id="no_serdos" required>
                </div>

                <div class="mb-3">
                    <label for="status_dosen" class="form-label">Status Dosen</label>
                    <select class="form-control" name="status_dosen" id="status_dosen" required>
                        <option value="">-- Pilih Status Dosen --</option>
                        <option value="Dosen Tetap">Dosen Tetap</option>
                        <option value="Dosen Praktisi">Dosen Praktisi</option>
                        <option value="Dosen Tidak Tetap">Dosen Tidak Tetap</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ url('/dosen') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>

@endsection
