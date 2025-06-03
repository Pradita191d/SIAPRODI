@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <div class="card shadow-sm">

        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Edit MBKM</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('mbkm.update', $mbkm->id) }}" method="post">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nim">Pilih Mahasiswa</label>
                    <select class="form-control" id="nim" name="nim" required>
                        <option value="">Pilih NIM Mahasiswa</option>
                        @foreach($mahasiswa as $mhs)
                        <option value="{{ $mhs->nim }}" {{ $mbkm->nim == $mhs->nim ? 'selected' : '' }}>{{ $mhs->nama_mahasiswa }} ({{ $mhs->nim }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Program</label>
                        <input type="text" name="nama_program" value="{{ $mbkm->nama_program }}" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Lembaga</label>
                        <input type="text" name="namaLembaga" value="{{ $mbkm->namaLembaga }}" class="form-control" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Lokasi</label>
                        <input type="text" name="lokasi" value="{{ $mbkm->lokasi }}" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Bidang Program</label>
                        <input type="text" name="bidangProgram" value="{{ $mbkm->bidangProgram }}" class="form-control" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Durasi</label>
                        <input type="text" name="durasi" value="{{ $mbkm->durasi }}" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Program Studi</label>
                        <input type="text" name="program_studi" value="{{ $mbkm->program_studi }}" class="form-control" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Jurusan</label>
                        <input type="text" name="jurusan" value="{{ $mbkm->jurusan }}" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Semester</label>
                        <input type="number" name="semester" value="{{ $mbkm->semester }}" class="form-control" required>
                    </div>
                </div>

                <div class="row">
                <div class="col-md-6 mb-3">
                        <label class="form-label">Nomor HP</label>
                        <input type="number" name="no_hp" value="{{ $mbkm->no_hp }}" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email</label>
                        <input type="text" name="email" value="{{ $mbkm->email }}" class="form-control" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Deskripsi</label>
                        <input type="text" name="deskripsi" value="{{ $mbkm->deskripsi }}" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Mata kuliah</label>
                        <input type="text" name="namaMatkul" value="{{ $mbkm->namaMatkul }}" class="form-control" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">SKS</label>
                        <input type="number" name="sks" value="{{ $mbkm->sks }}" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Keterangan Pengganti</label>
                        <input type="text" name="keterangan" value="{{ $mbkm->keterangan }}" class="form-control" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Dosen Pembimbing</label>
                        <input type="text" name="dospem" value="{{ $mbkm->dospem }}" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Koordinator MBKM</label>
                        <input type="text" name="koor_mbkm" value="{{ $mbkm->koor_mbkm }}" class="form-control" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Ketua Program Studi</label>
                        <input type="text" name="kaprodi" value="{{ $mbkm->kaprodi }}" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Catatan Tambahan</label>
                        <input type="text" name="catatan_tambahan" value="{{ $mbkm->catatan_tambahan }}" class="form-control" required>
                    </div>
                </div>


                <div class="text-end">
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                    <a href="{{ route('mbkm.tampil') }}" class="btn btn-secondary">Kembali</a>
                </div>
                

            </form>
        </div>
    </div>
</div>

@endsection
