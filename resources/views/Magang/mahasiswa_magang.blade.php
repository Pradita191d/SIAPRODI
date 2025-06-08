@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Data Mahasiswa Magang</h1>

        <div class="d-flex justify-content-between mb-3">
            <button id="exportBtn" class="btn btn-danger">Export to PDF</button>
        </div>

        @if($mahasiswaMagang->isEmpty())
            <p>No data available.</p>
        @else
            <table class="table table-bordered table-striped" id="dataMahasiswaMagangTable">
            <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>NIM (Nama Mahasiswa)</th>
                        <th>Dosen Lapangan</th>
                        <th>Tahun Ajaran</th>
                        <th>Nama Perusahaan</th>
                        <th>Jenis Perusahaan</th>
                        <th>Nilai Dosen</th>
                        <th>Nilai</th>
                        <th>Total Nilai</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mahasiswaMagang as $magang)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $magang->nim }} ({{ $magang->mahasiswa->nama_mahasiswa }})</td>
                            <td>{{ $magang->dosen->nama_dosen ?? 'N/A' }}</td>
                            <td>{{$magang->tahun_ajaran}}</td>
                            <td>{{ $magang->magang->nama_perusahaan }}</td>
                            <td>{{ $magang->magang->jenis_perusahaan }}</td>
                            <td>{{$magang->nilai_dosen}}</td>
                            <td>{{$magang->nilai}}</td>
                            <td>
                                @if($magang->total_nilai !== null)
                                    {{ $magang->huruf_nilai }}
                                @else
                                    N/A
                                @endif
                            </td>
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
    $(document).ready(function () {
        let table = $('#dataMahasiswaMagangTable');
        if (table.length && !$.fn.DataTable.isDataTable(table)) {
            table.DataTable({
                order: [],
                responsive: true
            });
        }
    });
</script>
<script>
document.getElementById('exportBtn').addEventListener('click', function () {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();
    
    // Title
    doc.text("Data Mahasiswa Magang", 14, 16);
    
    // Prepare headers (exactly matching your table)
    const headers = [
        'No',
        'NIM (Nama Mahasiswa)',
        'Dosen Pembimbing',
        'Tahun Ajaran',
        'Nama Perusahaan',
        'Jenis Perusahaan',
        'Nilai Dosen',
        'Nilai',
        'Total Nilai'
    ];
    
    // Prepare data rows
    const rows = [];
    document.querySelectorAll("#dataMahasiswaMagangTable tbody tr").forEach(row => {
        const rowData = [
            row.cells[0].innerText, // No
            row.cells[1].innerText, // NIM (Nama Mahasiswa)
            row.cells[2].innerText, // Dosen Pembimbing
            row.cells[3].innerText, // Tahun Ajaran
            row.cells[4].innerText, // Nama Perusahaan
            row.cells[5].innerText, // Jenis Perusahaan
            row.cells[6].innerText, // Nilai Dosen
            row.cells[7].innerText,  // Nilai
            row.cells[8].innerText   // Total Nilai
        ];
        rows.push(rowData);
    });
    
    // Generate PDF
    doc.autoTable({
        startY: 20,
        head: [headers],
        body: rows,
        styles: {
            fontSize: 8,
            cellPadding: 2
        },
        headStyles: {
            fillColor: [41, 128, 185], // Blue header
            textColor: 255,            // White text
            fontStyle: 'bold'
        },
        columnStyles: {
            0: {cellWidth: 10}, // No column width
            8: {cellWidth: 20}  // Wider column for Total Nilai
        }
    });
    
    doc.save('data_mahasiswa_magang.pdf');
});
</script>
@endpush