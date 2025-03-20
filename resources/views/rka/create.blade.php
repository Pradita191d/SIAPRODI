@extends('layouts.app')

@section('content')
    <div class="container">
        <div class=" bg-white shadow-md p-4 mb-4 rounded-lg">
            <h1>Tambah Data TOR & RKA</h1>
            <form action="{{ route('rka.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="id_tahun_akademik" class="form-label">Tahun Akademik</label>
                    <select class="form-control" id="id_tahun_akademik" name="id_tahun_akademik">
                        <option value="">Pilih Tahun Akademik</option>
                        @foreach ($tahunAkademik as $d)
                            <option value="{{ $d->id_tahun_akademik }}">{{ $d->tahun }}</option>
                        @endforeach

                    </select>
                    @error('id_tahun_akademik')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="judul" class="form-label">Nama RKA</label>
                    <input type="text" class="form-control" id="judul" name="judul" placeholder="nama rka">
                    @error('judul')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" aria-label="Deskripsi Kegiatan"
                        placeholder="Deskripsi Kegiatan"></textarea>
                    @error('deskripsi')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="file" class="form-label">Upload File</label>
                    <input type="file" class="form-control" id="file" name="file">
                    @error('file')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class=" flex justify-left items-center">
                    <a href="{{ route('rka.index') }}" class="btn btn-secondary  mr-2">Kembali</a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
