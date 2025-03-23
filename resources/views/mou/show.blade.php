@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-body">
            <h3 class="h5 font-weight-bold mb-3">Detail MoU</h3>

            <table class="table table-bordered">
                <tr>
                    <th>Nomor MoU</th>
                    <td>{{ $mou->no_mou }}</td>
                </tr>
                <tr>
                    <th>Pihak 1</th>
                    <td>{{ $mou->pihak_1 }}</td>
                </tr>
                <tr>
                    <th>Pihak 2</th>
                    <td>{{ $mou->pihak_2 }}</td>
                </tr>
                <tr>
                    <th>Tanggal Mulai</th>
                    <td>{{ $mou->tanggal_mulai }}</td>
                </tr>
                <tr>
                    <th>Tanggal Berakhir</th>
                    <td>{{ $mou->tanggal_berakhir }}</td>
                </tr>
                <tr>
                    <th>Tahun</th>
                    <td>{{ $mou->tahunAkademik->tahun ?? '-' }}</td>

                </tr>
                <tr>
                    <th>Jenis Kerjasama</th>
                    <td>{{ $mou->jenis_kerjasama }}</td>
                </tr>
                <tr>
                    <th>Contact Person</th>
                    <td>{{ $mou->kontak }}</td>
                </tr>
            </table>

            <a href="{{ route('mou.index') }}" class="btn btn-secondary mt-3">Kembali</a>
        </div>
    </div>
</div>
@endsection
