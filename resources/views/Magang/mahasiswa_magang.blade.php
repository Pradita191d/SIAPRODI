@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Data Mahasiswa Magang</h1>

        <div class="d-flex justify-content-end mb-3">
            <!-- Search Bar -->
            <div class="form-group" style="width: 250px;">
                <input type="text" id="searchInput" class="form-control" placeholder="Search by NIM, Nama Mahasiswa, Nama Perusahaan, Tahun Ajaran or Jenis Perusahaan">
            </div>
        </div>


        @if($mahasiswaMagang->isEmpty())
            <p>No data available.</p>
        @else
            <table class="table table-bordered" id="magangTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NIM (Nama Mahasiswa)</th>
                        <th>Tahun Ajaran</th>
                        <th>Nama Perusahaan</th>
                        <th>Jenis Perusahaan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mahasiswaMagang as $magang)
                        <tr>
                            <td>{{ $magang->id }}</td>
                            <td>{{ $magang->nim }} ({{ $magang->mahasiswa->nama_mahasiswa }})</td>
                            <td>{{$magang->tahun_ajaran}}</td>
                            <td>{{ $magang->magang->nama_perusahaan }}</td>
                            <td>{{ $magang->magang->jenis_perusahaan }}</td>
                            <td>
                                <a href="{{ route('magang.edit', $magang->id_perusahaan) }}" class="btn btn-primary">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

    </div>
@endsection

@push('scripts')

    <!-- Script to enable search functionality -->
    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let input = this.value.toLowerCase();
            let tableRows = document.querySelectorAll('#magangTable tbody tr');

            tableRows.forEach(function(row) {
                let nim = row.cells[1].innerText.toLowerCase(); // Column 1 for NIM
                let namaMahasiswa = row.cells[1].innerText.toLowerCase(); // Column 1 for Nama Mahasiswa
                let namaPerusahaan = row.cells[3].innerText.toLowerCase(); // Column 3 for Nama Perusahaan
                let jenisPerusahaan = row.cells[4].innerText.toLowerCase(); // Column 4 for Jenis Perusahaan
                let tahunAjaran = row.cells[2].innerText.toLowerCase(); // Column 4 for Jenis Perusahaan

                if (nim.includes(input) || namaMahasiswa.includes(input) || namaPerusahaan.includes(input) || jenisPerusahaan.includes(input)|| tahunAjaran.includes(input)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
@endpush
