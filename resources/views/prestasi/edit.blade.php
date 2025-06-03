@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <h3 class="h5 font-weight-bold mb-3">Edit Prestasi Mahasiswa</h3>
        <div class="card">
            <div class="card-body">
                <form action="/prestasi/{{ $pres_mhs->id }}/update" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @method('PUT')

                    <div class="card-body">
                        <div class="form-group">
                            <label for="NIM">Mahasiswa</label>
                            <select name="NIM" id="NIM" required class="form-control">
                                <option value="">-- Pilih Mahasiswa --</option>
                                @foreach($mahasiswa as $mhs)
                                <option value="{{ $mhs->nim }}" {{ $pres_mhs->NIM == $mhs->nim ? 'selected' : '' }}>
                                     {{ $mhs->nim }} - {{ $mhs->nama_mahasiswa }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        

                        <div class="form-group">
                            <label for="jenis_pres">Jenis Prestasi</label>
                            <input type="text" class="form-control" id="jenis_pres" name="jenis_pres" 
                                   value="{{ $pres_mhs->jenis_pres }}" placeholder="Jenis Prestasi">
                        </div>

                        <div class="form-group">
                            <label for="penyelenggara">Penyelenggara</label>
                            <input type="text" class="form-control" id="penyelenggara" name="penyelenggara" 
                                   value="{{ $pres_mhs->penyelenggara }}" placeholder="Penyelenggara">
                        </div>

                        <div class="form-group">
                            <label for="tahun">Tahun</label>
                            <input type="text" class="form-control" id="tahun" name="tahun" 
                                   value="{{ $pres_mhs->tahun }}" placeholder="Tahun">
                        </div>

                        <div class="form-group">
                            <label for="tingkat_pres">Tingkat Prestasi</label>
                            <input type="text" class="form-control" id="tingkat_pres" name="tingkat_pres" 
                                   value="{{ $pres_mhs->tingkat_pres }}" placeholder="Tingkat Prestasi">
                        </div>

                        <div class="form-group">
                            <label for="juara">Juara</label>
                            <input type="text" class="form-control" id="juara" name="juara" 
                                   value="{{ $pres_mhs->juara }}" placeholder="Juara">
                        </div>

                        <div class="form-group">
                            <label for="file_sertif">File Sertifikat</label>
                            <input type="file" class="form-control" id="file_sertif" name="file_sertif">
                            @if($pres_mhs->file_sertif)
                                <p class="mt-2">File saat ini: 
                                    <a href="{{ url('sertifikat/' . $pres_mhs->file_sertif) }}" target="_blank">
                                        {{ $pres_mhs->file_sertif }}
                                    </a>
                                </p>
                            @endif
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
