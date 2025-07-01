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
      <h3 class="card-title">Form Tambah Penelitian Dosen</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <form action="{{ route('penelitian-dosen.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-sm-12">
            <!-- textarea -->
            <div class="form-group">
              <label>Judul Penelitian</label>
              <textarea name="judul_penelitian" class="form-control" rows="2" placeholder="Masukkan Judul Penelitian...">{{ old('judul_penelitian') }}</textarea>
              @error('judul_penelitian')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
                <label>Ketua</label>
                <select name="id_dosen" class="form-control id_dosen">
                  <option value=""></option>
                    @foreach($dosen as $dsn)
                      <option value="{{ $dsn->id_dosen }}">
                        {{ $dsn->nama_dosen }}
                      </option>
                    @endforeach
                </select>
                @error('id_dosen')
                  <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
          </div>
              
            <div class="col-sm-6">
              <div class="form-group">
                <label>Tahun Penelitian</label>
                <input name="tahun_penelitian" type="text" class="form-control" placeholder="Tahun Penelitian" value="{{ old('tahun_penelitian') }}">
                @error('tahun_penelitian')
                  <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                <label>Skema Penelitian</label>
                <input name="skema_penelitian" type="text" class="form-control" placeholder="Skema Penelitian" value="{{ old('skema_penelitian') }}">
                @error('skema_penelitian')
                  <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>
            
            <div class="col-sm-6">
              <div class="form-group">
                <label>Sumber Dana</label>
                <input name="sumber_dana" type="text" class="form-control" placeholder="Sumber Dana" value="{{ old('sumber_dana') }}">
                @error('sumber_dana')
                  <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                <label>Dana Penelitian</label>
                <input name="dana_penelitian" type="number" class="form-control" placeholder="Dana Penelitian" value="{{ old('dana_penelitian') }}">
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
                  <label class="custom-file-label" for="customFile">Cari file</label>
                </div>
                @error('file_penelitian')
                  <div class="text-danger">{{ $message }}</div>
                @enderror
                <small class="form-text text-muted">Ukuran maksimal: 2MB, format: PDF</small>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Status Penelitian</label>
                  <div class="radio-group">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="status_penelitian" value="Dalam Proses"
                        {{ old('status_penelitian', 'Selesai') == 'Dalam Proses' ? 'checked' : '' }}>
                      <label class="form-check-label">Dalam Proses</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="status_penelitian" value="Selesai"
                        {{ old('status_penelitian', 'Selesai') == 'Selesai' ? 'checked' : '' }}>
                      <label class="form-check-label">Selesai</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="status_penelitian" value="Dibatalkan"
                        {{ old('status_penelitian', 'Selesai') == 'Dibatalkan' ? 'checked' : '' }}>
                      <label class="form-check-label">Dibatalkan</label>
                    </div>
                  </div>
                  @error('status_penelitian')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <div class="col-sm-6">
                <div class="form-group">
                  <label>Nama Anggota</label>
                  <textarea name="nama_anggota" class="form-control" rows="4" placeholder="Pisahkan dengan koma atau baris baru">{{ old('nama_anggota') }}</textarea>
                  @error('nama_anggota')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>
            
            <div class="button-container">
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          <!-- /.card-body -->
        </div>

  <script>
    // script untuk upload file agar namanya tersimpan di form create
    document.getElementById("customFile").addEventListener("change", function() {
      var fileName = this.files[0] ? this.files[0].name : "Cari file";
      this.nextElementSibling.innerText = fileName;
    });
    
    $(document).ready(function () {
      $('.id_dosen').select2({
        placeholder: 'Pilih Dosen',
        width: '100%'
      });
    });

  </script>
@endsection