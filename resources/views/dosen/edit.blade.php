@extends('layouts.app')
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
                        <option value="">-- Pilih Jabatan Fungsional --</option>
                        <option value="Asisten Ahli" {{ $dosen->jabatan_fungsional == 'Asisten Ahli' ? 'selected' : '' }}>Asisten Ahli</option>
                        <option value="Lektor" {{ $dosen->jabatan_fungsional == 'Lektor' ? 'selected' : '' }}>Lektor</option>
                        <option value="Lektor Kepala" {{ $dosen->jabatan_fungsional == 'Lektor Kepala' ? 'selected' : '' }}>Lektor Kepala</option>
                        <option value="Guru Besar/Profesor" {{ $dosen->jabatan_fungsional == 'Guru Besar/Profesor' ? 'selected' : '' }}>Guru Besar/Profesor</option>

                    </select>
                </div>
                <div class="mb-3">
                    <label for="pangkat" class="form-label">Pangkat</label>
                    <select class="form-control" name="pangkat" id="pangkat" required>
                        <option value="">-- Pilih Pangkat --</option>
                        <option value="Penata Muda Tingkat I" {{ $dosen->pangkat == 'Penata Muda Tingkat I' ? 'selected' : '' }}>Penata Muda Tingkat I</option>
                        <option value="Penata" {{ $dosen->pangkat == 'Penata' ? 'selected' : '' }}>Penata</option>
                        <option value="Penata Tingkat I" {{ $dosen->pangkat == 'Penata Tingkat I' ? 'selected' : '' }}>Penata Tingkat I</option>
                        <option value="Pembina" {{ $dosen->pangkat == 'Pembina' ? 'selected' : '' }}>Pembina</option>
                        <option value="Pembina Tingkat I" {{ $dosen->pangkat == 'Pembina Tingkat I' ? 'selected' : '' }}>Pembina Tingkat I</option>
                        <option value="Pembina Utama Muda" {{ $dosen->pangkat == 'Pembina Utama Muda' ? 'selected' : '' }}>Pembina Utama Muda</option>
                        <option value="Pembina Utama Madya" {{ $dosen->pangkat == 'Pembina Utama Madya' ? 'selected' : '' }}>Pembina Utama Madya</option>
                        <option value="Pembina Utama" {{ $dosen->pangkat == 'Pembina Utama' ? 'selected' : '' }}>Pembina Utama</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="golongan" class="form-label">Golongan</label>
                    <select class="form-control" name="golongan" id="golongan" required>
                        <option value="">-- Pilih Golongan --</option>
                        <option value="III/b" {{ $dosen->golongan == 'III/b' ? 'selected' : '' }}>III/b</option>
                        <option value="III/c" {{ $dosen->golongan == 'III/c' ? 'selected' : '' }}>III/c</option>
                        <option value="III/d" {{ $dosen->golongan == 'III/d' ? 'selected' : '' }}>III/d</option>
                        <option value="IV/a" {{ $dosen->golongan == 'IV/a' ? 'selected' : '' }}>IV/a</option>
                        <option value="IV/b" {{ $dosen->golongan == 'IV/b' ? 'selected' : '' }}>IV/b</option>
                        <option value="IV/c" {{ $dosen->golongan == 'IV/c' ? 'selected' : '' }}>IV/c</option>
                        <option value="IV/d" {{ $dosen->golongan == 'IV/d' ? 'selected' : '' }}>IV/d</option>
                        <option value="IV/e" {{ $dosen->golongan == 'IV/d' ? 'selected' : '' }}>IV/e</option>
                       
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
