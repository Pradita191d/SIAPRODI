<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pemanggilan Orang Tua</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 14px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 3px double #333;
            padding-bottom: 10px;
        }

        .header img {
            height: 80px;
            float: left;
        }

        .header-text {
            margin: 0 auto;
            width: 70%;
        }

        .header-text h2, .header-text h3, .header-text p {
            margin: 0;
            padding: 0;
        }

        .header-text h2 {
            font-size: 18px;
            font-weight: bold;
        }

        .header-text h3 {
            font-size: 16px;
            font-weight: bold;
        }

        .header-text p {
            font-size: 14px;
        }

        .date-range {
            text-align: center;
            margin: 20px 0;
            font-weight: bold;
            line-height: 1.5;
        }

        .content {
            font-size: 14px;
            text-align: justify;
            margin-top: 25px;
            text-indent: 40px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #000;
        }

        th, td {
            padding: 8px;
            font-size: 12px;
        }

        th {
            background-color: #f2f2f2;
            text-align: center;
        }

        .footer {
            margin-top: 60px;
            width: 100%;
            display: flex;
            justify-content: space-between;
        }

        .footer .ttd {
            text-align: center;
            width: 45%;
        }

        .footer .ttd div {
            margin-top: 60px;
        }
    </style>
</head>
<body>
    <div class="date-range">
        BERITA ACARA <br>
        RAPAT YUDISIUM PROGRAM STUDI D3 TEKNIK INFORMATIKA  <br>
        SEMESTER GANJIL TAHUN AKADEMIK 2024/2025  <br>
    </div>
@php
    \Carbon\Carbon::setLocale('id');
@endphp
    <div class="content">
Pada hari ini {{ \Carbon\Carbon::now()->isoFormat('dddd') }} tanggal {{ \Carbon\Carbon::now()->format('d') }} bulan {{ \Carbon\Carbon::now()->isoFormat('MMMM') }} tahun {{ \Carbon\Carbon::now()->format('Y') }}, bertempat di Ruang Jurusan Komputer dan Bisnis telah dilaksanakan pemanggilan orang tua wali mahasiswa Tahun Akademik 2024 - 2025 untuk program studi D3 Teknik Informatika, Politeknik Negeri Cilacap dengan hasil sebagai berikut:    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Mahasiswa</th>
                <th>Permasalahan</th>
                <th>Hasil</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pemanggilans as $index => $pemanggilan)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                <td>{{ $pemanggilan->mahasiswa->nama_mahasiswa }}</td>
                <td>{{ $pemanggilan->alasan_pemanggilan }}</td>
                <td>{{ $pemanggilan->solusi }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="content">
Demikian Berita Acara ini dibuat untuk dapat dipergunakan sebagaimana mestinya.    </div>

    <div class="footer">
        <div class="ttd">
            Mengetahui,<br>
            Jurusan Komputer dan Bisnis<br><br><br><br>
            Ketua<br><br><br><br>
            <u>Dwi Novia Prasetyanti, S.Kom, M.Cs</u><br>
            NIP. 197911192021212009
        </div>
        <div class="ttd">
           Program Studi D3 Teknik Informatika<br>
           Koordinator<br><br><br><br>
            <u>Cahya Vikasari, ST.M.Eng</u><br>
            NIP.198412012018032001
        </div>
    </div>
</body>
</html>
