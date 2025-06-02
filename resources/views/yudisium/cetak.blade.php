<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Yudisium</title>
</head>
<body>
    <h1>Data Mahasiswa Yudisium</h1>
   <table class="static" align="center" rules="all" border="1px" style="width: 95%;">
        <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Nama Mahasiswa</th>
            <th>Semester</th>
            <th>Tanggal Yudisium</th>
            <th>Lokasi</th>
            <th>Masalah</th>
            <th>Solusi Prodi</th>
            <th>Solusi Jurusan</th>
        </tr>
        @foreach($yudisium as $ys)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $ys->mahasiswa?->NIM }}</td>
                    <td>{{ $ys->mahasiswa?->nama_mahasiswa }}</td>
                    <td>{{ $ys->semester }}</td>
                    <td>{{ $ys->tgl_yudisium }}</td>
                    <td>{{ $ys->lokasi }}</td>
                    <td>{{ $ys->masalah }}</td>
                    <td>{{ $ys->solusi_prodi }}</td>
                    <td>{{ $ys->solusi_jurusan }}</td>

                                    

        </tr>
        @endforeach

   </table>
</body>
</html>