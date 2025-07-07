@extends('layouts.app')

@section('content')
<div class="container">
    <ol class="breadcrumb bg-light p-2 rounded">
        <li class="breadcrumb-item">
            <a href="{{ url('/') }}" class="text-info"><i class="fas fa-home"></i> Home</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ url('/data-pemanggilan') }}" class="text-info"><i class="fas fa-user"></i> Data Pemanggilan</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-plus"></i> Tambah Data</li>
    </ol>

    <div class="card card-default">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="card-title">Tambah Data Pemanggilan Orang Tua</h2>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
        </div>

        <form action="{{ url('/simpan-data') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    {{-- Kolom Kiri --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Orang Tua <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama_ortu" required>
                        </div>

                        <div class="form-group">
                            <label>No Telepon <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="no_telp_ortu" required>
                        </div>

                        <div class="form-group">
                            <label>Alamat <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="alamat" rows="3" required></textarea>
                        </div>

                        <div class="form-group">
                            <label> NIM & Nama Mahasiswa <span class="text-danger">*</span></label>
                            <select class="form-control select2" id="nim" name="nim" required>
                                <option value="">Pilih Mahasiswa</option>
                                @foreach ($mahasiswa as $mhs)
                                    <option value="{{ $mhs->nim }}" {{ old('nim') == $mhs->nim ? 'selected' : '' }}>
                                        {{ $mhs->nim }} - {{ $mhs->nama_mahasiswa }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                             <div class="form-group">
                            <label>Semester <span class="text-danger">*</span></label>
                            <select class="form-control" name="semester" required>
                                <option value="">-- Pilih Semester --</option>
                                @for ($i = 1; $i <= 8; $i++)
                                    <option value="{{ $i }}">Semester {{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Jurusan <span class="text-danger">*</span></label>
                            <select class="form-control" name="jurusan" required>
                                <option value="">-- Pilih Jurusan --</option>
                                <option value="JKB">JKB</option>
                                <option value="JRM & IP">JRM & IP</option>
                                <option value="JREM">JREM</option>
                            </select>
                        </div>
                    </div>

                    {{-- Kolom Kanan --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Prodi <span class="text-danger">*</span></label>
                            <select class="form-control" name="prodi" required>
                                <option value="">-- Pilih Prodi --</option>
                                @php
                                    $prodiList = [
                                        'D3 Teknik Informatika', 'D3 Teknik Mesin', 'D3 Teknik Elektronika',
                                        'D3 Teknik Listrik', 'D4 TPPL', 'D4 PPA', 'D4 TRET', 'D4 TTRKI',
                                        'D4 TRMK', 'D4 RKS', 'D4 TRM', 'D4 ALKS', 'D4 TRPL',
                                    ];
                                @endphp
                                @foreach ($prodiList as $prodi)
                                    <option value="{{ $prodi }}">{{ $prodi }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Tanggal Pemanggilan <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="tanggal_pemanggilan" required>
                        </div>

                        <div class="form-group">
                            <label>Alasan Pemanggilan <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="alasan_pemanggilan" rows="3" required></textarea>
                        </div>

                        <div class="form-group">
                            <label>Solusi <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="solusi" rows="3" required></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer text-right">
                <a href="{{ url('/data-pemanggilan') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn btn-success ml-2">
                    <i class="fas fa-save"></i> Simpan Data
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Pilih Data",
            allowClear: true,
            width: '100%',
            minimumInputLength: 1
        });
    });
</script>
@endsection
