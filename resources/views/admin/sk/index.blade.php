@extends('layouts.app')

@section('content')
<div class="container">
  @if (session('success'))
    <div class="alert alert-success text-center">
     {{ session('success') }}
    </div>
  @endif
</div>

<!-- Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Data SK Wisuda</h3>
      </div>
      <!-- /.card-header -->

      <div class="card-body">
        <div class="d-flex justify-content-between mb-3">
            <!-- Tombol kiri -->
            <div>
                <a href="/wissuda" class="btn btn-secondary btn-sm me-2">
                  Kembali
                </a>
                <a href="/sk/create" class="btn btn-success btn-sm">
                  <i class="fas fa-plus"></i> Tambah Data
                </a>
            </div>
          <!-- Kotak Pencarian -->
          <form action="/sk/search" method="GET" class="form-inline">
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
                <th>Tahun Wisuda</th>
                <th>SK Wisuda</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($tahun_wisuda as $tw)
              <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $tw->tahun_wisuda }}</td>
                  <td>
                        @if($tw->sk_wisuda !== '-' && $tw->sk_wisuda !== null) 
                            <a href="{{ asset('storage/' . $tw->sk_wisuda) }}" target="_blank" class="btn btn-primary btn-sm">
                                Lihat SK
                            </a>
                        @else
                            <span class="text-danger">Belum ada SK</span>
                        @endif
                  </td>
                  <td>
                      <a href="{{ url('/sk/' . $tw->id . '/edit') }}" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                      <a href="{{ url('/sk/' . $tw->id . '/delete') }}" class="btn btn-danger btn-sm" onclick="return confirm('Apakah yakin ingin menghapus data tahun {{ $tw->tahun_wisuda }}?')"><i class="fas fa-trash-alt"></i></a>
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
