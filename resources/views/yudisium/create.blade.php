@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Data Yudisium</h2>
    <form action="/yudisium/store" method="POST">
        @csrf
        <div class="mb-3">
        <label for="NIM">Mahasiswa</label>
        <select name="NIM" id="NIM" required class="form-control">
            <option value="">-- Pilih Mahasiswa --</option>
            @foreach($mahasiswa as $mhs)
                <option value="{{ $mhs->nim }}">{{ $mhs->nim }} - {{ $mhs->nama_mahasiswa }}
                </option>
            @endforeach
        </select>

        </div>

        <!-- <div class="mb-3">
    <label for="semester" class="form-label">Semester</label>
    <select name="semester" id="semester" class="form-control" required>
        <option value="">Pilih Semester</option>
        <option value="ganjil">Ganjil</option>
        <option value="genap">Genap</option>
    </select>
</div> -->

        <div class="mb-3">
            <label>Tanggal Yudisium</label>
            <input type="date" name="tgl_yudisium" class="form-control">
        </div>
        <div class="mb-3">
            <label>Lokasi</label>
            <input type="text" name="lokasi" class="form-control">
        </div>
        <div class="mb-3">
            <label>Semester</label>
            <input type="varchar" name="semester" class="form-control">
        </div>
        <div class="mb-3">
            <label>Masalah</label>
            <input type="text" name="masalah" class="form-control">
        </div>

        <div class="mb-3">
            <label>Solusi Prodi</label>
            <input type="text" name="solusi_prodi" class="form-control">
        </div>

        <div class="mb-3">
            <label>Solusi Jurusan</label>
            <input type="text" name="solusi_jurusan" class="form-control">
        </div>
        
       

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
