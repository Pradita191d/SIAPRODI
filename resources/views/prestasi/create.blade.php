@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-body" >
        <h3 class="h5 font-weight-bold mb-3">Tambah Prestasi Mahasiswa</h3>
        <div class="card">
            <div class="card-body">
    <form action="{{ url('/prestasi/store') }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field()}} <!-- utk keamanan form, untuk meminimalisir sql injeksi dll -->

      <div class="card-body">
      
        <div class="form-group">
        <label for="NIM">Mahasiswa</label>
        <select name="NIM" id="NIM" required class="form-control">
            <option value="">-- Pilih Mahasiswa --</option>
            @foreach($mahasiswa as $mhs)
                <option value="{{ $mhs->nim }}">{{ $mhs->nim }} - {{ $mhs->nama_mahasiswa }}
                </option>
            @endforeach
        </select>
      </div>
        
        <div class="form-group">
          <label for="jenis_pres">Jenis Prestasi</label>
          <input type="text" class="form-control" id="jenis_pres" name="jenis_pres" placeholder="Jenis Prestasi">
        </div>
        <div class="form-group">
          <label for="penyelenggara">Penyelenggara</label>
          <input type="text" class="form-control" id="penyelenggara" name="penyelenggara" placeholder="Jenis Prestasi">
        </div>
        <div class="form-group">
          <label for="tahun">Tahun</label>
          <input type="text" class="form-control" id="tahun" name="tahun" placeholder="Jenis Prestasi">
        </div>
        
        <div class="form-group">
          <label for="tingkat_pres">Tingkat Prestasi</label>
          <input type="text" class="form-control" id="tingkat_pres" name="tingkat_pres" placeholder="Tingkat Prestasi">
        </div>
        <div class="form-group">
          <label for="juara">Juara</label>
          <input type="text" class="form-control" id="juara" name="juara" placeholder="Juara">
        </div>
        <div class="form-group">
            <label for="file_sertif">File Sertif</label>
            <input type="file" class="form-control" id="file_sertif" name="file_sertif" placeholder="Upload File Sertif">
          </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
  @endsection