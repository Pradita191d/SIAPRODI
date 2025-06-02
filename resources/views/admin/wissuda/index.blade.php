@extends('layouts.app')

@section('content')
<div class="container">
  @if (session('success'))
    <div class="alert alert-success text-center">
     {{ session('success') }}
    </div>
  @endif
</div>
<!-- Select 2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Data Wisuda Mahasiswa</h3>
      </div>
      <!-- /.card-header -->

      <div class="card-body">
        <div class="d-flex justify-content-between mb-3">
            <!-- Tombol kiri -->
            <div>
                <a href="/sk" class="btn btn-primary btn-sm me-2">
                    <i class="fas fa-upload"></i> SK Wisuda
                </a>
                <a href="/wissuda/create" class="btn btn-success btn-sm">
                  <i class="fas fa-plus"></i> Tambah Data
                </a>
                <a href="/wissuda/export" class="btn btn-secondary btn-sm">
                  <i class="fas fa-file-excel"></i> Export Excel
                </a>
              
            </div>
    
            <!-- Kolom pencarian kanan -->
            <form action="/wissuda/search" method="GET" class="form-inline">
              <div class="input-group input-group-sm" style="width: 200px;">
                  <input type="text" name="search" class="form-control float-right" 
                         placeholder="Cari Nama atau Tahun" value="{{ request('search') }}">
                  <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                          <i class="fas fa-search"></i>
                      </button>
                  </div>
              </div>
          </form>
        </div>

        <!-- Tabel Data -->
        <div class="table-responsive">
          <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Status Wisuda</th>
                <th>Tahun Wisuda</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($wisuda as $wsd)
              <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $wsd->mahasiswa->nim }}</td>
                  <td>{{ $wsd->mahasiswa->nama_mahasiswa }}</td>
                  <td>{{ $wsd->status_wisuda }}</td>
                  <td>{{ $wsd->sk ? $wsd->sk->tahun_wisuda : '-' }}</td>
                  <td>
                      <a href="{{ url('/wissuda/' . $wsd->id . '/detail') }}" class="btn btn-info btn-sm"><i class="fas fa-info-circle"></i></a>
                      <a href="{{ url('/wissuda/' . $wsd->id . '/edit') }}" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                      <a href="{{ url('/wissuda/' . $wsd->id . '/delete') }}" class="btn btn-danger btn-sm" onclick="return confirm('Apakah yakin ingin menghapus {{ $wsd->mahasiswa->nama_mahasiswa }} ?')"><i class="fas fa-trash-alt"></i></a>
                  </td>
              </tr>
              @endforeach
          </tbody>          
          </table>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>
<script>
  setTimeout(function() {
    document.querySelector('.alert-success')?.remove();
      }, 3000); // Hilang setelah 3 detik
</script>
@endsection