<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Konversi SKS MBKM</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .header, .content {
            text-align: center;
            margin-bottom: 20px;
        }
        h1, h2, h3 {
            margin: 5px 0;
            color: #000;
            font-weight: bold;
        }
        p {
            font-size: 12px;
            margin: 5px 0;
            color: #000;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background: white;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color:rgb(255, 255, 255);
            color: black;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
        <!-- <img src="{{ asset('lte') }}/dist/img/Logo-PNC2.png" alt="pnc Logo" style="display: block; margin: 0 auto; width: 100px;"> -->
            <h2>KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN</h2>
            <h3>POLITEKNIK NEGERI CILACAP</h3>
            <p>Jl. Dr. Soetomo No.1, Karangcengis, Sidakaya, Kec. Cilacap Sel., Kabupaten Cilacap, Jawa Tengah 53212</p>
            <p>Telepon (0282) 533329 | Website: www.pnc.ac.id | Email: sekretariat@pnc.ac.id</p>
        </div>
        <hr>
        <h3 style="text-align: center;">Form Detail Konversi SKS Kegiatan MBKM</h3>
        
        <h4>Data Mahasiswa</h4>
        <table>
            <tr><th>Nama Mahasiswa</th><td>{{ $data->namaMhs }}</td></tr>
            <tr><th>NIM</th><td>{{ $data->nim }}</td></tr>
            <tr><th>Program Studi</th><td>{{ $data->program_studi }}</td></tr>
            <tr><th>Jurusan</th><td>{{ $data->jurusan }}</td></tr>
            <tr><th>Semester</th><td>{{ $data->semester }}</td></tr>
            <tr><th>Nomor HP</th><td>{{ $data->no_hp }}</td></tr>
            <tr><th>Email</th><td>{{ $data->email }}</td></tr>
        </table>
        
        <h4>Informasi Kegiatan MBKM</h4>
        <table>
            <tr><th>Nama Program</th><td>{{ $data->nama_program }}</td></tr>
            <tr><th>Durasi Kegiatan</th><td>{{ $data->durasi }}</td></tr>
            <tr><th>Lembaga / Perusahaan</th><td>{{ $data->namaLembaga }}</td></tr>
            <tr><th>Deskripsi Kegiatan</th><td>{{ $data->deskripsi }}</td></tr>
        </table>
        
        <h4>Mata Kuliah yang Dikonversi</h4>
        <table>
            <tr>
                <th>Nama Mata Kuliah</th>
                <th>SKS</th>
                <th>Keterangan Pengganti</th>
            </tr>
            <tr>
                <td>{{ $data->namaMatkul }}</td>
                <td>{{ $data->sks }}</td>
                <td>{{ $data->keterangan }}</td>
            </tr>
        </table>
        
        <h4>Penilaian dan Rekomendasi</h4>
        <table>
            <tr><th>Dosen Pembimbing Akademik</th><td>{{ $data->dospem }}</td></tr>
            <tr><th>Koordinator MBKM</th><td>{{ $data->koor_mbkm }}</td></tr>
            <tr><th>Kepala Program Studi</th><td>{{ $data->kaprodi }}</td></tr>
            <tr><th>Catatan Tambahan</th><td>{{ $data->catatan_tambahan }}</td></tr>
        </table>
    </div>
</body>
</html>
