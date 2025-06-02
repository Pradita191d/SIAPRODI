
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header ">
        <div class="card-header d-flex justify-content-center" style="text-align: center;">
            <h1 class="card-title "><b>Laporan Data wisuda</b></h1>
        </div>
        {{-- <h2 class="card-title "><b>Laporan Data wisuda</b></h2> --}}
        
        
        <div style="text-align: center;">
            <label for="id" >Tahun Wisuda</label>
            <label for="id">2025</label>
        <div class="d-flex">
            <!-- Dropdown untuk filter tahun wisuda -->
            {{-- <form action="/wisuda/filter" method="GET" class="mr-2">
              <select name="tahun_wisuda" class="form-control">
                <option value="">-- Pilih Tahun --</option>
                <option value="2024">2024</option>
                <option value="2025">2025</option>
                <option value="2026">2026</option>
              </select>
            </form> --}}
             {{-- <a href="/cetak" class="btn btn-success" >Cetak</a> --}}
        </div>
        
            
        {{-- <br>
        <button type="submit" class="btn btn-info" onclick="window.location.href='/jurusan/create';">Tambah Jurusan</button>
        <br> --}}

        <div class="card-tools">
          {{-- <form action="/wisuda/search" class="form-inline" method="get">
            <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" name="search" class="form-control float-right" placeholder="cari dengan nama"> --}}
  
              {{-- <div class="input-group-append">
                <button type="submit" class="btn btn-default">
                  <i class="fas fa-search"></i>
                </button>
              </div> --}}
            </div>
          </form>
        </div>
        <br>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="static" align="center" rules="all" border="1px" style="width: 90%;">
          <thead >
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Status Wisuda</th>
                <th>Tahun Wisuda</th>
                {{-- <th>Aksi</th> --}}
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
    <div class="card-body">
        <!-- Rekapan Mahasiswa Per Tahun -->
        <div style="width: 50%; margin-left: 70px;" class="mb-4">
          <h4><b>Rekapitulasi Wisuda</b></h4>
          <table class="static" align="left" rules="all" border="1px" style="width: 50%;">
            <thead>
              <tr>
                <th>Tahun Wisuda</th>
                <th>Jumlah Mahasiswa</th>
                {{-- <th>Sudah Wisuda</th>
                <th>Belum Wisuda</th> --}}
              </tr>
            </thead>
            <tbody style="text-align: center; vertical-align: middle;">
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
    {{-- <div class="col-1 2">
    <div class="d-flex justify-content-start mt-3">
        <a href="/preview" class="btn btn-primary">Preview</a>
        <br>
    </div> --}}
    <!-- /.card -->
  </div>

</div>
