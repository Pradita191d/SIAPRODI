@extends('layouts.app')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h3 class="mb-4 text-center">Edit Sertifikat Kompetensi</h3> <!-- Tambahkan text-center untuk merapikan judul -->
    </div>

    <section class="section">
        <div class="row justify-content-center"> <!-- Tambahkan justify-content-center agar lebih ke tengah -->
            <div class="col-lg-10"> <!-- Perbesar lebar agar tidak terlalu sempit -->
                <div class="card shadow-lg p-4"> <!-- Tambahkan shadow dan padding -->
                    <div class="card-body">
                        <h5 class="card-title d-block w-100     ">Form Edit Sertifikat</h5> <!-- Tambahkan warna agar lebih jelas -->

                        <div class="clearfix"></div> 

                        <form action="{{ route('sertikom.update', $sertifikat->id_sertikom) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="nidn" class="form-label fw-bold">NIDN</label> <!-- Tambahkan fw-bold untuk teks lebih tegas -->
                                <select name="nidn" class="form-control" disabled>
                                    @foreach($dosen as $d)
                                        <option value="{{ $d->nidn }}" {{ $d->nidn == $sertifikat->nidn ? 'selected' : '' }}>
                                            {{ $d->nidn }} - {{ $d->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="nidn" value="{{ $sertifikat->nidn }}">
                            </div>

                            <div class="mb-3">
                                <label for="nama_sertifikat" class="form-label fw-bold">Nama Sertifikat</label>
                                <input type="text" name="nama_sertifikat" class="form-control" value="{{ $sertifikat->nama_sertifikat }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="bidang_keahlian" class="form-label fw-bold">Bidang Keahlian</label>
                                <input type="text" name="bidang_keahlian" class="form-control" value="{{ $sertifikat->bidang_keahlian }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="nama_lembaga" class="form-label fw-bold">Nama Lembaga</label>
                                <input type="text" name="nama_lembaga" class="form-control" value="{{ $sertifikat->nama_lembaga }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="tanggal_terbit" class="form-label fw-bold">Tanggal Terbit</label>
                                <input type="date" name="tanggal_terbit" class="form-control" value="{{ $sertifikat->tanggal_terbit }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="berlaku_sampai" class="form-label fw-bold">Berlaku Sampai</label>
                                <input type="date" name="berlaku_sampai" class="form-control" value="{{ $sertifikat->berlaku_sampai }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="doc_sertifikat" class="form-label fw-bold">Dokumen Sertifikat</label>
                                <input type="file" name="doc_sertifikat" class="form-control">
                                @if($sertifikat->doc_sertifikat)
                                    <p><a href="{{ asset('sertifikat/' . $sertifikat->doc_sertifikat) }}" target="_blank" class="text-decoration-none">Lihat Dokumen</a></p>
                                @endif
                            </div>

                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-success px-4"><i class="fas fa-save"></i>  Simpan Perubahan</button>
                                <a href="{{ route('index') }}" class="btn btn-secondary px-4"><i class="fas fa-arrow-left"></i>  Kembali</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
