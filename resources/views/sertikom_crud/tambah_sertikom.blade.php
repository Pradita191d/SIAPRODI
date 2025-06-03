@extends('layouts.app')

@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h3 class="mb-4 text-center">Tambah Sertifikat Kompetensi</h3>
    </div>

    <section class="section">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-lg p-4">
                    <div class="card-body">
                        <h5 class="card-title d-block w-100">Form Tambah Sertifikat</h5>

                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('sertikom.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nidn" class="form-label fw-bold">NIDN</label>
                                        <select class="form-control @error('nidn') is-invalid @enderror" name="nidn" id="nidn" required>
                                            <option value="">Pilih Dosen</option>
                                            @foreach($dosen as $d)
                                                <option value="{{ $d->nidn }}" data-nama="{{ $d->nama_dosen }}">{{ $d->nidn }} - {{ $d->nama_dosen }}</option>
                                            @endforeach
                                        </select>
                                        @error('nidn')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="nama_dosen" class="form-label fw-bold">Nama Dosen</label>
                                        <input type="text" class="form-control" id="nama_dosen" disabled>
                                    </div>

                                    <div class="mb-3">
                                        <label for="nama_sertifikat" class="form-label fw-bold">Nama Sertifikat</label>
                                        <input type="text" class="form-control @error('nama_sertifikat') is-invalid @enderror" name="nama_sertifikat" id="nama_sertifikat" value="{{ old('nama_sertifikat') }}" required>
                                        @error('nama_sertifikat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="bidang_keahlian" class="form-label fw-bold">Bidang Keahlian</label>
                                        <input type="text" class="form-control @error('bidang_keahlian') is-invalid @enderror" name="bidang_keahlian" id="bidang_keahlian" value="{{ old('bidang_keahlian') }}" required>
                                        @error('bidang_keahlian')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nama_lembaga" class="form-label fw-bold">Nama Lembaga</label>
                                        <input type="text" class="form-control @error('nama_lembaga') is-invalid @enderror" name="nama_lembaga" id="nama_lembaga" value="{{ old('nama_lembaga') }}" required>
                                        @error('nama_lembaga')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="tanggal_terbit" class="form-label fw-bold">Tanggal Terbit</label>
                                        <input type="date" class="form-control @error('tanggal_terbit') is-invalid @enderror" name="tanggal_terbit" id="tanggal_terbit" value="{{ old('tanggal_terbit') }}" required>
                                        @error('tanggal_terbit')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="berlaku_sampai" class="form-label fw-bold">Berlaku Sampai</label>
                                        <input type="date" class="form-control @error('berlaku_sampai') is-invalid @enderror" name="berlaku_sampai" id="berlaku_sampai" value="{{ old('berlaku_sampai') }}" required>
                                        @error('berlaku_sampai')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="doc_sertifikat" class="form-label fw-bold">Dokumen Sertifikat</label>
                                        <input type="file" class="form-control @error('doc_sertifikat') is-invalid @enderror" name="doc_sertifikat" id="doc_sertifikat" required>
                                        @error('doc_sertifikat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ url('/sertikomcrud') }}" class="btn btn-secondary px-4"><i class="fas fa-arrow-left"></i> Kembali</a>
                                <button type="submit" class="btn btn-success px-4"><i class="fas fa-save"></i> Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const nidnSelect = document.getElementById("nidn");
        const namaDosenInput = document.getElementById("nama_dosen");

        nidnSelect.addEventListener("change", function () {
            const selectedOption = nidnSelect.options[nidnSelect.selectedIndex];
            const namaDosen = selectedOption.getAttribute("data-nama");
            namaDosenInput.value = namaDosen ? namaDosen : "";
        });
    });
</script>
@endsection
