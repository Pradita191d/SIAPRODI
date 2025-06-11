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
        }

        .footer .ttd {
            float: right;
            text-align: left;
            margin-right: 80px;
        }

        .footer .ttd div {
            margin-top: 60px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('dist/img/logo_pnc.png') }}" alt="Logo">
        <div class="header-text">
            <h2>POLITEKNIK NEGERI CILACAP</h2>
            <h3>Kementerian Pendidikan, Kebudayaan, Riset, Teknologi</h3>
            <p>Jl. Dr. Soetomo No. 1, Sidakaya, Cilacap, Jawa Tengah</p>
            <p>Telp: (021) 1234567, Email: pnc.ac.id</p>
        </div>
        <div style="clear: both;"></div>
    </div>

    <div class="date-range">
        BERITA ACARA PEMANGGILAN ORANG TUA <br>
        Nomor: {{ $no_surat }} <br>
        Tanggal: {{ \Carbon\Carbon::parse($start_date)->format('d/m/Y') }} s/d {{ \Carbon\Carbon::parse($end_date)->format('d/m/Y') }}
    </div>

    <div class="content">
        Pada tanggal tersebut di atas, telah dilakukan pemanggilan orang tua/wali mahasiswa oleh pihak Politeknik Negeri Cilacap melalui Bagian Akademik dan Kemahasiswaan (BAAK). Kegiatan ini dilaksanakan sebagai tindak lanjut dari permasalahan akademik atau non-akademik yang melibatkan mahasiswa, yang memerlukan keterlibatan orang tua/wali untuk mendapatkan solusi terbaik.

        Adapun daftar mahasiswa dan orang tua yang telah dipanggil beserta alasan pemanggilan terlampir pada tabel berikut:
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Ortu</th>
                <th>No Telp</th>
                <th>Nama Mahasiswa</th>
                <th>NIM</th>
                <th>Jurusan/Prodi</th>
                <th>Tanggal</th>
                <th>Alasan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pemanggilans as $index => $pemanggilan)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                <td>{{ $pemanggilan->nama_ortu }}</td>
                <td>{{ $pemanggilan->no_telp_ortu }}</td>
                <td>{{ $pemanggilan->mahasiswa->nama_mahasiswa }}</td>
                <td>{{ $pemanggilan->nim }}</td>
                <td>{{ $pemanggilan->jurusan }} / {{ $pemanggilan->prodi }}</td>
                <td>{{ \Carbon\Carbon::parse($pemanggilan->tanggal_pemanggilan)->format('d/m/Y') }}</td>
                <td>{{ $pemanggilan->alasan_pemanggilan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="content">
        Demikian berita acara ini dibuat sebagai dokumentasi resmi kegiatan pemanggilan orang tua/wali mahasiswa. Diharapkan dengan adanya pemanggilan ini, mahasiswa yang bersangkutan dapat memperoleh perhatian dan bimbingan yang lebih intensif dari pihak keluarga sehingga mampu memperbaiki prestasi dan sikap selama menempuh pendidikan di Politeknik Negeri Cilacap.
    </div>

    <div class="footer">
        <div class="ttd">
            Cilacap, {{ \Carbon\Carbon::now()->format('d F Y') }}<br>
            Mengetahui,<br>
            Koordinator Sub BAAK<br><br><br><br>
            <u>Endang Werdiningsih, S.E</u><br>
            NIP. 197104112021212007
        </div>
    </div>
</body>
</html>
