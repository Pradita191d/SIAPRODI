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
            <li class="breadcrumb-item active" aria-current="page">
                <i class="fas fa-edit"></i> Edit Data
            </li>
        </ol>

        <div class="card card-default">
            <div class="card-header">
                <h2 class="card-title">Edit Data Pemanggilan Orang Tua</h2>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
            </div>

            <form action="{{ route('pemanggilan.update', $pemanggilan->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card-body">
                    <div class="row">
                        {{-- Kolom Kiri: Data Orang Tua & Mahasiswa --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Orang Tua</label>
                                <input type="text" class="form-control" name="nama_ortu" value="{{ $pemanggilan->nama_ortu }}" required>
                            </div>
                            <div class="form-group">
                                <label>No Telepon</label>
                                <input type="text" class="form-control" name="no_telp_ortu" value="{{ $pemanggilan->no_telp_ortu }}" required>
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea class="form-control" name="alamat" rows="3" required>{{ $pemanggilan->alamat }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Mahasiswa <span class="text-danger">*</span></label>
                                <select class="form-control select2" id="nim" name="nim">
                                    <option value="">Pilih Mahasiswa</option>
                                    @foreach ($mahasiswa as $mhs)
                                        <option value="{{ $mhs->nim }}" {{ $pemanggilan->nim == $mhs->nim ? 'selected' : '' }}>
                                            {{ $mhs->nim }} - {{ $mhs->nama_mahasiswa }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Kolom Kanan: Data Akademik & Pemanggilan --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Semester</label>
                                <select class="form-control" name="semester" required>
                                    <option value="">-- Pilih Semester --</option>
                                    @for ($i = 1; $i <= 8; $i++)
                                        <option value="{{ $i }}" {{ $pemanggilan->semester == $i ? 'selected' : '' }}>Semester {{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Jurusan</label>
                                <select class="form-control" name="jurusan" required>
                                    <option value="">-- Pilih Jurusan --</option>
                                    <option value="JKB" {{ $pemanggilan->jurusan == 'JKB' ? 'selected' : '' }}>JKB</option>
                                    <option value="JRM & IP" {{ $pemanggilan->jurusan == 'JRM & IP' ? 'selected' : '' }}>JRM & IP</option>
                                    <option value="JREM" {{ $pemanggilan->jurusan == 'JREM' ? 'selected' : '' }}>JREM</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Prodi</label>
                                @php
                                    $prodiOptions = [
                                        'D3 Teknik Informatika',
                                        'D3 Teknik Mesin',
                                        'D3 Teknik Elektronika',
                                        'D3 Teknik Listrik',
                                        'D4 TPPL',
                                        'D4 PPA',
                                        'D4 TRET',
                                        'D4 TTRKI',
                                        'D4 TRMK',
                                        'D4 RKS',
                                        'D4 TRM',
                                        'D4 ALKS',
                                        'D4 TRPL',
                                    ];
                                @endphp
                                <select class="form-control" name="prodi" required>
                                    <option value="">-- Pilih Prodi --</option>
                                    @foreach ($prodiOptions as $prodi)
                                        <option value="{{ $prodi }}" {{ $pemanggilan->prodi == $prodi ? 'selected' : '' }}>{{ $prodi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Pemanggilan</label>
                                <input type="date" class="form-control" name="tanggal_pemanggilan"
                                    value="{{ $pemanggilan->tanggal_pemanggilan ? \Carbon\Carbon::parse($pemanggilan->tanggal_pemanggilan)->format('Y-m-d') : '' }}"
                                    required>
                            </div>
                            <div class="form-group">
                                <label>Alasan Pemanggilan</label>
                                <textarea class="form-control" name="alasan_pemanggilan" rows="2" required>{{ $pemanggilan->alasan_pemanggilan }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Solusi</label>
                                <textarea class="form-control" name="solusi" rows="2" required>{{ $pemanggilan->solusi }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer text-right">
                    <a href="{{ url('/data-pemanggilan') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-success ml-2">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
