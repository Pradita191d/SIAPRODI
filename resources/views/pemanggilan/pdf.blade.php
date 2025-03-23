<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemanggilan Orang Tua</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid black;
            padding-bottom: 10px;
        }
        .kop-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .kop-container img {
            width: 100px;
            height: auto;
        }
        .kop-container .text {
            text-align: center;
            flex-grow: 1;
        }
        .kop-container h2, .kop-container h3 {
            margin: 5px 0;
        }
        .content {
            margin-top: 20px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .table, .table th, .table td {
            border: 1px solid black;
        }
        .table th, .table td {
            padding: 8px;
            text-align: left;
        }
        .signature {
    margin-top: 50px;
    text-align: right; /* Posisi teks di sebelah kanan */
    width: 50%; /* Atur agar posisinya tidak terlalu jauh */
    margin-left: auto; /* Mendorong ke kanan */
}
.garis {
    margin-top: 40px; /* Atur jarak agar lebih proporsional */
}
    </style>
</head>
<body>

    <!-- Header / Kop Surat -->
    <div class="header">
        <div class="kop-container">
            <img src="{{ public_path('assets/images/logo-pnc.png') }}" alt="Logo PNC">
            <div class="text">
                <h2>POLITEKNIK NEGERI CILACAP</h2>
                <h3>Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi</h3>
                <p>Jl. Dr. Soetomo No. 1, Sidakaya, Cilacap, Jawa Tengah</p>
            </div>
        </div>
    </div>

    <!-- Isi Surat -->
    <div class="content">
        <h3 style="text-align: center;">SURAT PEMANGGILAN ORANG TUA</h3>

        <p>Kepada Yth.:</p>
        <p><strong>{{ $pemanggilan->nama_ortu }}</strong></p>
        <p>Di tempat.</p>

        <p>Dengan hormat,</p>
        <p>Sehubungan dengan kondisi akademik dan perilaku mahasiswa berikut:</p>

        <table class="table">
            <tr>
                <th>Nama Mahasiswa</th>
                <td>{{ $pemanggilan->nama_mhs }}</td>
            </tr>
            <tr>
                <th>NIM</th>
                <td>{{ $pemanggilan->nim }}</td>
            </tr>
            <tr>
                <th>Semester</th>
                <td>{{ $pemanggilan->semester }}</td>
            </tr>
            <tr>
                <th>Jurusan</th>
                <td>{{ $pemanggilan->jurusan }}</td>
            </tr>
            <tr>
                <th>Prodi</th>
                <td>{{ $pemanggilan->prodi }}</td>
            </tr>
            <tr>
                <th>Alasan Pemanggilan</th>
                <td>{{ $pemanggilan->alasan_pemanggilan }}</td>
            </tr>
            <tr>
                <th>Solusi</th>
                <td>{{ $pemanggilan->solusi }}</td>
            </tr>
        </table>

        <p>Dimohon kepada orang tua/wali untuk hadir ke kampus pada:</p>

        <p><strong>Tanggal: {{ $pemanggilan->tanggal_pemanggilan }}</strong></p>

        <p>Untuk membahas permasalahan yang sedang dihadapi oleh mahasiswa dan mencari solusi terbaik. Atas perhatian dan kerjasama Bapak/Ibu, kami ucapkan terima kasih.</p>
    </div>

    <!-- Tanda Tangan -->
    <div class="signature">
        <p>Hormat kami,</p>
        <p><strong>Pihak Kampus</strong></p>
        <br>
        <br>
        <p>(.............................................)</p>
    </div>

</body>
</html>
