<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pemanggilan Orang Tua</title>
    <style>
        body {
            font-family: Arial, sans-serif;
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
            margin: 15px 0;
            font-weight: bold;
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
            text-align: left;
            font-size: 12px;
        }
        th {
            background-color: #f2f2f2;
            text-align: center;
        }
        .footer {
            margin-top: 50px;
            text-align: right;
            padding-right: 100px;
        }
        .footer div {
            margin-top: 60px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('images/logo_universitas.png') }}" alt="Logo">
        <div class="header-text">
            <h2>UNIVERSITAS EXAMPLE</h2>
            <h3>FAKULTAS EXAMPLE</h3>
            <p>Jl. Example No. 123, Kota Example</p>
            <p>Telp: (021) 1234567, Email: example@univ.ac.id</p>
        </div>
        <div style="clear: both;"></div>
    </div>

    <div class="date-range">
        Laporan Pemanggilan Orang Tua/Wali <br>
        Tanggal {{ \Carbon\Carbon::parse($start_date)->format('d/m/Y') }} s/d {{ \Carbon\Carbon::parse($end_date)->format('d/m/Y') }}
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

    <div class="footer">
        <div>
            Kota Example, {{ \Carbon\Carbon::now()->format('d F Y') }}<br>
            Dekan/Koordinator,<br><br><br><br>
            <u>Dr. Example Name</u><br>
            NIP. 1234567890
        </div>
    </div>
</body>
</html>
