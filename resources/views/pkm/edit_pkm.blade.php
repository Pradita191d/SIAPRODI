@extends('layouts.app')
@section('content')

<div class="container">
    <h3 class="mb-3">Edit Data PKM</h3>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('pkm.update', $pkm->id_pkm) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nidn" class="form-label">NIDN</label>
                    <select class="form-control @error('nidn') is-invalid @enderror" disabled ="nidn" id="nidn" required>
                        <option value="">Pilih Dosen</option>
                        @foreach($dosen as $d)
                            <option value="{{ $d->nidn }}" data-nama="{{ $d->nama_dosen }}" {{ $pkm->nidn == $d->nidn ? 'selected' : '' }}>
                                {{ $d->nidn }} - {{ $d->nama_dosen }}
                            </option>
                        @endforeach
                    </select>
                    <input type="hidden" name="nidn" value="{{$pkm->nidn}}">
                    @error('nidn')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- <div class="mb-3">
                    <label for="nama_dosen" class="form-label">Nama Dosen</label>
                    <input type="text" class="form-control" id="nama_dosen" value="{{ $pkm->nama_dosen }}" disabled>
                </div> -->

                <div class="mb-3">
                    <label for="nim" class="form-label">NIM</label>
                    <select class="form-control @error('nim') is-invalid @enderror" disabled name="nim" id="nim" required>
                        <option value="">Pilih Mahasiswa</option>
                        @foreach($mahasiswa as $m)
                            <option value="{{ $m->nim }}" data-nama="{{ $m->nama_mahasiswa }}" {{ $pkm->nim == $m->nim ? 'selected' : '' }}>
                                {{ $m->nim }} - {{ $m->nama_mahasiswa }}
                            </option>
                        @endforeach
                    </select>
                    <input type="hidden" name="nim" value="{{$pkm->nim}}">
                    @error('nim')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
<!-- 
                <div class="mb-3">
                    <label for="nama_mahasiswa" class="form-label">Nama Mahasiswa</label>
                    <input type="text" class="form-control" id="nama_mahasiswa" value="{{ $pkm->nama_mahasiswa }}" readonly>
                </div> -->

                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" class="form-control" name="judul" id="judul" value="{{ $pkm->judul }}" required>
                </div>

                <div class="mb-3">
                    <label for="tahun" class="form-label">Tahun</label>
                    <input type="number" class="form-control" name="tahun" id="tahun" value="{{ $pkm->tahun }}" min="2000" max="{{ date('Y') }}" required>
                </div>

                <div class="mb-3">
                    <label for="lokasi" class="form-label">Lokasi</label>
                    <input type="text" class="form-control" name="lokasi" id="lokasi" value="{{ $pkm->lokasi }}" required>
                </div>

                <div class="mb-3">
                    <label for="anggaran" class="form-label">Anggaran</label>
                    <input type="number" class="form-control" name="anggaran" id="anggaran" value="{{ $pkm->anggaran }}" min="0" step="1000" required>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-control @error('status') is-invalid @enderror" name="status" id="status" required>
                        <option value="">Pilih Status</option>
                        <option value="Berjalan" {{ $pkm->status == 'Berjalan' ? 'selected' : '' }}>Berjalan</option>
                        <option value="Gagal" {{ $pkm->status == 'Gagal' ? 'selected' : '' }}>Gagal</option>
                        <option value="Sukses" {{ $pkm->status == 'Sukses' ? 'selected' : '' }}>Sukses</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <!-- <a href="{{ url('/pkm') }}" class="btn btn-secondary">Kembali</a> -->
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("nidn").addEventListener("change", function () {
        let selectedOption = this.options[this.selectedIndex];
        let namaDosen = selectedOption.getAttribute("data-nama") || "";
        document.getElementById("nama_dosen").value = namaDosen;
    });
    document.getElementById("nim").addEventListener("change", function () {
        let selectedOption = this.options[this.selectedIndex];
        let namaMahasiswa = selectedOption.getAttribute("data-nama") || "";
        document.getElementById("nama_mahasiswa").value = namaMahasiswa;
    });
});
</script>

@endsection
