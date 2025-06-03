@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Tambah Data MBKM</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('mbkm.submit') }}" method="post">
                @csrf
                
                <div class="form-group">
                    <label for="nim">Pilih Mahasiswa</label>
                    <select class="form-control" id="nim" name="nim" required>
                        <option value="">Pilih NIM Mahasiswa</option>
                        @foreach($mahasiswa as $mhs)
                        <option value="{{ $mhs->nim }}">{{ $mhs->nama_mahasiswa }} ({{ $mhs->nim }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Program</label>
                        <input type="text" name="nama_program" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Lembaga</label>
                        <input type="text" name="namaLembaga" class="form-control" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Lokasi</label>
                        <input type="text" name="lokasi" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Bidang Program</label>
                        <input type="text" name="bidangProgram" class="form-control" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Durasi</label>
                        <input type="text" name="durasi" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Program Studi</label>
                        <input type="text" name="program_studi" class="form-control" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Jurusan</label>
                        <input type="text" name="jurusan" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Semester</label>
                        <input type="number" name="semester" class="form-control" required>
                    </div>
                </div>

                <div class="row">
                <div class="col-md-6 mb-3">
                        <label class="form-label">Nomor HP</label>
                        <input type="number" name="no_hp" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email</label>
                        <input type="text" name="email" class="form-control" required>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Deskripsi</label>
                        <input type="text" name="deskripsi" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Mata kuliah</label>
                        <input type="text" name="namaMatkul" class="form-control" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">SKS</label>
                        <input type="number" name="sks" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Keterangan Pengganti</label>
                        <input type="text" name="keterangan" class="form-control" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Dosen Pembimbing</label>
                        <input type="text" name="dospem" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Koordinator MBKM</label>
                        <input type="text" name="koor_mbkm" class="form-control" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Ketua Program Studi</label>
                        <input type="text" name="kaprodi" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Catatan Tambahan</label>
                        <input type="text" name="catatan_tambahan" class="form-control" required>
                    </div>
                    
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-plus"></i> Tambah
                    </button>
                    <a href="{{ route('mbkm.tampil') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
