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
                <label>Nama Dosen</label>
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
            
            <div class="form-group">
              <label>Tambah Anggota</label>
                  <table class="table table-bordered" id="anggota-table">
                    <thead>
                      <tr>
                        <th>Aksi</th>
                        <th>Nama Anggota</th>
                      </tr>
                    </thead>
                    <tbody id="anggota-table-body">
                      <tr>
                        <td class="text-center">
                            <button type="button" class="add-row btn btn-success btn-sm">
                              <i class="fas fa-plus-circle"></i>
                            </button>
                        </td>
                        <td>
                          <select name="anggota[0][id_mahasiswa]" class="form-control id_mahasiswa">
                            <option value=""></option>
                              @foreach($mahasiswa as $mhs)
                                <option value="{{ $mhs->id_mahasiswa }}" {{ old('anggota.0.id_mahasiswa') == $mhs->id_mahasiswa ? 'selected' : '' }}>
                                  {{ $mhs->NIM }} - {{ $mhs->nama_mahasiswa }}
                                </option>
                              @endforeach
                          </select>
                            @error('anggota.0.id_mahasiswa')
                              <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </td>
                      </tr>
                    </tbody>
                  </table>
                <div class="button-container">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
              </form>
            </div>
          <!-- /.card-body -->
        </div>

  <script>
    // script untuk format rupiah
    function formatRupiah(input) {
        let angka = input.value.replace(/\D/g, ""); // Hanya ambil angka (hilangkan huruf/simbol lain)
        let rupiah = new Intl.NumberFormat("id-ID", { style: "currency", currency: "IDR" }).format(angka);
        input.value = rupiah.replace("Rp", "").trim(); // Menghapus 'Rp' agar input tetap angka
    }
    
    // script untuk upload file agar namanya tersimpan di form create
    document.getElementById("customFile").addEventListener("change", function() {
      var fileName = this.files[0] ? this.files[0].name : "Cari file";
      this.nextElementSibling.innerText = fileName;
    });

    $(document).on('click', '.add-row', function () {
      let index = $('#anggota-table-body tr').length; // Hitung jumlah baris yang ada
      const newRow = `
          <tr>
              <td class="p-1 text-center">
                  <button type="button" class="add-row btn btn-success btn-sm">
                      <i class="fas fa-plus-circle"></i>
                  </button>
                  <button type="button" class="remove-row btn btn-danger btn-sm">
                      <i class="fas fa-trash"></i>
                  </button>
              </td>
              <td>
                  <select name="anggota[${index}][id_mahasiswa]" class="form-control id_mahasiswa">
                      <option value=""></option>
                      @foreach($mahasiswa as $mhs)
                          <option value="{{ $mhs->id_mahasiswa }}">
                              {{ $mhs->NIM }} - {{ $mhs->nama_mahasiswa }}
                          </option>
                      @endforeach
                  </select>
              </td>
          </tr>`;

      $('#anggota-table-body').append(newRow);
      $('.id_mahasiswa').select2(); // Inisialisasi Select2 ulang
    });

    $(document).ready(function () {
      $('.id_dosen').select2();

      $('.id_mahasiswa').select2();
    });

    $(document).on('click', '.remove-row', function () {
      $(this).closest('tr').remove();
    });
  </script>
@endsection