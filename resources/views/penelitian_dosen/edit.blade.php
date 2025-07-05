@extends('layouts.app') {{-- Change this to match your actual layout file name --}}

<style>
  .radio-group {
      display: flex;
      gap: 20px; /* Jarak antar radio button */
      align-items: center;
  }
  .button-container {
      display: flex;
      justify-content: center;
      margin-top: 20px;
  }
</style>

@section('content')

<div class="card card-primary">
    <div class="card-header d-flex justify-content-between">
      <a href="{{ route('penelitian-dosen.index') }}">
        <i class="fas fa-arrow-left"></i>
      </a>
      <h3 class="card-title">Form Edit Penelitian Dosen</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <form action="{{ route('penelitian-dosen.update', $penelitian->id_penelitian) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
          <div class="col-sm-12">
            <!-- textarea -->
            <div class="form-group">
              <label>Judul Penelitian</label>
              <textarea name="judul_penelitian" class="form-control" rows="2" placeholder="Masukkan Judul Penelitian...">{{ $penelitian->judul_penelitian }}</textarea>
              @error('judul_penelitian')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
                <label>Nama Dosen</label>
                  <select name="id_dosen" class="form-control id_dosen">
                    <option value="">Pilih Dosen</option>
                    @foreach($dosen as $dsn)
                        <option value="{{ $dsn->id_dosen }}" {{ $penelitian->id_dosen == $dsn->id_dosen ? 'selected' : '' }}>
                            {{ $dsn->nama_dosen }}
                        </option>
                    @endforeach
                  </select>
                  @error('nama_dosen')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
            </div>
          </div>
              
            <div class="col-sm-6">
              <div class="form-group">
                <label>Tahun Penelitian</label>
                <input name="tahun_penelitian" type="text" class="form-control" value="{{ $penelitian->tahun_penelitian }}">
                @error('tahun_penelitian')
                  <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                <label>Skema Penelitian</label>
                <input name="skema_penelitian" type="text" class="form-control" value="{{ $penelitian->skema_penelitian }}">
                @error('skema_penelitian')
                  <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                <label>Sumber Dana</label>
                <input name="sumber_dana" type="text" class="form-control" value="{{ $penelitian->sumber_dana }}">
                @error('sumber_dana')
                  <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                <label>Dana Penelitian</label>
                <input name="dana_penelitian" type="number" class="form-control" value="{{ $penelitian->dana_penelitian }}">
                @error('dana_penelitian')
                  <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                <label>Pilih File</label>
                <div class="custom-file">
                  <input name="file_penelitian" type="file" class="custom-file-input" id="customFile">
                    <label class="custom-file-label" for="customFile" 
                      data-default="{{ $penelitian->file_penelitian ?? 'Cari file' }}">
                        {{ $penelitian->file_penelitian ?? 'Cari file' }}
                    </label>
                </div>
                @error('file_penelitian')
                  <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Status Penelitian</label>
                  <div class="radio-group">
                    @foreach(['Dalam proses', 'Selesai', 'Dibatalkan'] as $status)
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="status_penelitian" value="{{ $status }}" {{ $penelitian->status_penelitian == $status ? 'checked' : '' }}>
                        <label class="form-check-label">{{ $status }}</label>
                      </div>
                    @endforeach
                  </div>
                  @error('status_penelitian')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <div class="col-sm-6">
                <div class="form-group">
                  <label>Nama Anggota</label>
                  <textarea name="nama_anggota" class="form-control" rows="4" placeholder="Pisahkan dengan baris baru">{{ old('nama_anggota', $penelitian->anggota->pluck('nama_anggota')->implode("\n")) }}</textarea>
                  @error('nama_anggota')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>

            <div class="button-container">
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
      </form>
    </div>
  <script>
    // script untuk melihat dan upload file agar namanya tersimpan di form create
    document.addEventListener("DOMContentLoaded", function() {
          var fileInput = document.getElementById("customFile");
          var fileLabel = document.querySelector(".custom-file-label");

          var fileLama = fileLabel.getAttribute("data-default"); // Ambil nama asli dari atribut

          fileInput.addEventListener("change", function() {
              var fileName = this.files.length > 0 ? this.files[0].name : fileLama;
              fileLabel.innerText = fileName;
          });
      });

    $(document).ready(function () {
      $('.id_dosen').select2({
        placeholder: 'Pilih Dosen',
        width: '100%'
      });
    });
    
  </script>
@endsection