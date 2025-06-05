<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Prestasi Mahasiswa</title>
</head>
<body>
    <h1>Data Prestasi Mahasiswa</h1>
   <table class="static" align="center" rules="all" border="1px" style="width: 95%;">
        <tr>
            <th>No</th>
            <th >Nama Mahasiswa</th>
            <th >NIM</th>
            <th >Jenis Prestasi</th>
            <th >Penyelenggara</th>
            <th >Tahun</th>
            <th >Tingkat Prestasi</th>
            <th >Juara</th>
            <th >File</th>
        </tr>
        @foreach($pres_mhs as $p_mhs)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td class="text-center">{{ $p_mhs->mahasiswa?->nama_mahasiswa }}</td>
            <td class="text-center"> {{ $p_mhs->mahasiswa?->nim }} </td>
            <td class="text-center">{{ $p_mhs->jenis_pres }}</td>
            <td class="text-center">{{ $p_mhs->penyelenggara }}</td>
            <td class="text-center">{{ $p_mhs->tahun }}</td>
            <td class="text-center">{{ $p_mhs->tingkat_pres }}</td>
            <td class="text-center">{{ $p_mhs->juara }}</td>
            <td class="text-center">{{ $p_mhs->file_sertif }}</td>
                                    

        </tr>
        @endforeach

   </table>
</body>
</html>