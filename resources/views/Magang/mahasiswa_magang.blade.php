@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Data Mahasiswa Magang</h1>

        <div class="d-flex justify-content-between mb-3">
            <button id="exportBtn" class="btn btn-danger">Export to PDF</button>
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
                        <th>Nilai</th>
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
                            <td>{{$magang->nilai}}</td>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.14/jspdf.plugin.autotable.min.js"></script>

<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        let input = this.value.toLowerCase();
        let tableRows = document.querySelectorAll('#magangTable tbody tr');

        tableRows.forEach(function(row) {
            let nim = row.cells[1].innerText.toLowerCase();
            let namaMahasiswa = row.cells[1].innerText.toLowerCase();
            let namaPerusahaan = row.cells[3].innerText.toLowerCase();
            let jenisPerusahaan = row.cells[4].innerText.toLowerCase();
            let tahunAjaran = row.cells[2].innerText.toLowerCase();

            if (nim.includes(input) || namaMahasiswa.includes(input) || namaPerusahaan.includes(input) || jenisPerusahaan.includes(input)|| tahunAjaran.includes(input)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    // Export table to PDF
    document.getElementById('exportBtn').addEventListener('click', function () {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();
        
        doc.text("Data Mahasiswa Magang", 14, 16);
        doc.autoTable({
            startY: 20,
            head: [['ID', 'NIM (Nama Mahasiswa)', 'Tahun Ajaran', 'Nama Perusahaan', 'Jenis Perusahaan', 'Nilai']],
            body: Array.from(document.querySelectorAll("#magangTable tbody tr")).map(row => 
                Array.from(row.cells).map(cell => cell.innerText)
            ),
        });
        doc.save('data_mahasiswa_magang.pdf');
    });
</script>
@endpush
