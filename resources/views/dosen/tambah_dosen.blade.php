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
                        <option value="Asisten Ahli.">Asisten Ahli.</option>
                        <option value="Lektor.">Lektor.</option>
                        <option value="Lektor Kepala. ">Lektor Kepala. </option>
                        <option value="Guru Besar atau Profesor.">Guru Besar atau Profesor.</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="pangkat" class="form-label">Pangkat </label>
                    <select class="form-control" name="pangkat" id="pangkat" required>
                        <option value="">-- Pilih Pangkat --</option>
                        <option value="Penata Muda Tingkat I">Penata Muda Tingkat I</option>
                        <option value="Penata">Penata</option>
                        <option value="Penata Tingkat I ">Penata Tingkat I</option>
                        <option value="Pembina">Pembina</option>
                        <option value="Pembina Tingkat I">Pembina Tingkat I</option>
                        <option value="Pembina Utama Muda">Pembina Utama Muda</option>
                        <option value="Pembina Utama Madya">Pembina Utama Madya</option>
                        <option value="Pembina Utama">Pembina Utama</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="golongan" class="form-label">Golongan </label>
                    <select class="form-control" name="golongan" id="golongan" required>
                        <option value="">-- Pilih Golongan --</option>
                        <option value="III/b">III/b</option>
                        <option value="III/c">III/c</option>
                        <option value="III/d">III/d</option>
                        <option value="IV/a">IV/a</option>
                        <option value="IV/b,">IV/b</option>
                        <option value="IV/c">IV/c</option>
                        <option value="IV/d">IV/d</option>
                        <option value="IV/e">IV/e</option>
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
