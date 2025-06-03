@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Data Yudisium</h2>
    <form action="{{ route('yudisium.update', $yudisium->id_yudisium) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Pilihan Mahasiswa berdasarkan NIM -->
        <div class="mb-3">
            <label for="NIM">Mahasiswa (NIM - Nama)</label>
            <select name="NIM" class="form-control" required>
                @foreach($mahasiswa as $mhs)
                    <option value="{{ $mhs->NIM }}" 
                        {{ $yudisium->NIM == $mhs->NIM ? 'selected' : '' }}>
                        {{ $mhs->NIM }} - {{ $mhs->nama_mahasiswa }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Masalah</label>
            <input type="text" name="masalah" class="form-control" value="{{ $yudisium->masalah }}">
        </div>
        <div class="mb-3">
            <label>Solusi Prodi</label>
            <input type="text" name="solusi_prodi" class="form-control" value="{{ $yudisium->solusi_prodi }}">
        </div>
        <div class="mb-3">
            <label>Solusi Jurusan</label>
            <input type="text" name="solusi_jurusan" class="form-control" value="{{ $yudisium->solusi_jurusan }}">
        </div>
        <div class="mb-3">
            <label>Tanggal Yudisium</label>
            <input type="date" name="tgl_yudisium" class="form-control" value="{{ $yudisium->tgl_yudisium }}">
        </div>
        <div class="mb-3">
            <label>Lokasi</label>
            <input type="text" name="lokasi" class="form-control" value="{{ $yudisium->lokasi }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
