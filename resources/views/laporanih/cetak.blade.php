@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header ">
        <div class="card-header d-flex justify-content-center">
            <h1 class="card-title "><b>Laporan Data wisuda</b></h1>
        </div>
        
        <br>
        <div >
            <label for="id">Cetak berdasarkan tahun wisuda</label>
        <div class="d-flex">
            <!-- Dropdown untuk filter tahun wisuda -->
            <form action="/wisuda/filter" method="GET" class="mr-2">
              <select name="tahun_wisuda" class="form-control">
                <option value="">-- Pilih Tahun --</option>
                <option value="2024">2024</option>
                <option value="2025">2025</option>
                {{-- <option value="2026">2026</option> --}}
                <option value="semua">Semua tahun</option>
              </select>
            </form>
            <a href="/wisuda/preview/hasil" class="btn btn-success" >Cetak</a>
        </div>
        
          

        <div class="card-tools">

            </div>
          </form>
        </div>
        <br>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
          <thead>
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Status Wisuda</th>
                <th>Tahun Wisuda</th>
            </tr>
            <tr>
                <td>1</td>
                <td>220302078</td>
                <td>Astrid Nadia</td>
                <td>Akan Wisuda</td>
                <td>2025</td>
                {{-- <td>
                    <a href="#" class="btn btn-info">Lihat</a>
                    <a href="#" class="btn btn-warning">Edit</a>
                    <a href="#" class="btn btn-danger">Hapus</a>
                </td> --}}
            </tr>
            <tr>
                <td>2</td>
                <td>220302092</td>
                <td>Pradita Ruri</td>
                <td>Akan Wisuda</td>
                <td>2025</td>
                {{-- <td>
                    <a href="#" class="btn btn-info">Lihat</a>
                    <a href="#" class="btn btn-warning">Edit</a>
                    <a href="#" class="btn btn-danger">Hapus</a>
                </td> --}}
            </tr>
            <tr>
                <td>3</td>
                <td>210202001</td>
                <td>Na Jaemin</td>
                <td>Sudah Wisuda</td>
                <td>2024</td>
                {{-- <td>
                    <a href="#" class="btn btn-info">Lihat</a>
                    <a href="#" class="btn btn-warning">Edit</a>
                    <a href="#" class="btn btn-danger">Hapus</a>
                </td> --}}
            </tr>
            <tr>
                <td>4</td>
                <td>220301010</td>
                <td>Park Jeongwoo</td>
                <td>Akan Wisuda</td>
                <td>2025</td>
                {{-- <td>
                    <a href="#" class="btn btn-info">Lihat</a>
                    <a href="#" class="btn btn-warning">Edit</a>
                    <a href="#" class="btn btn-danger">Hapus</a>
                </td> --}}
            </tr>
            <tr>
                <td>5</td>
                <td>210302017</td>
                <td>Park Jisung</td>
                <td>Sudah Wisuda</td>
                <td>2024</td>
                {{-- <td>
                    <a href="#" class="btn btn-info">Lihat</a>
                    <a href="#" class="btn btn-warning">Edit</a>
                    <a href="#" class="btn btn-danger">Hapus</a>
                </td> --}}
            </tr>
          </thead>
          <tbody>
        

            {{-- @foreach($wisuda as $wis)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $wis->nim }}</td>
              <td>{{ $wis->nim }}</td>
              <td>{{ $wis->nim }}</td>
              <td>{{ $wis->nim }}</td>
              <td>{{ $wis->nim }}</td>
              <td>
                <a href="/jurusan/{{ $jur->id }}/delete" class="btn btn-danger" onclick="return confirm('Apakah yakin menghapus data {{ $jur->nama_jurusan}} ??')">Hapus</a>
                <a href="/jurusan/{{ $jur->id }}/edit" class="btn btn-warning">Edit</a>
              </td>
            </tr>
            @endforeach --}}
          </tbody>
        </table>
      </div>
      
      <!-- /.card-body -->
    </div>
    {{-- <div class="col-1 2">
    <div class="d-flex justify-content-start mt-3">
        <a href="/preview" class="btn btn-primary">Preview</a>
        <br>
    </div> --}}
    <!-- /.card -->
  </div>
  <div>
    <div class="card-body">
        <!-- Rekapan Mahasiswa Per Tahun -->
        <div class="mb-4">
          <h4><b>Rekapitulasi Wisuda</b></h4>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Tahun Wisuda</th>
                <th>Jumlah Mahasiswa</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>2024</td>
                <td>2 </td>
              </tr>
              <tr>
                <td>2025</td>
                <td>3 </td>
              </tr>
            </tbody>
          </table>
        </div>
  </div>
  </div>
</div>
@endsection
