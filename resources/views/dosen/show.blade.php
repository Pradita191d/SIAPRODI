<!-- @extends('layouts.app')
@section('content')

<main id="main" class="main">
    <div class="pagetitle">
        <h3>Detail Dosen</h3>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dosen.index') }}">Data Dosen</a></li>
                <li class="breadcrumb-item active">Detail</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Informasi Dosen</h5>
                        <table class="table">
                            <tr>
                                <th>NIDN</th>
                                <td>{{ $dosen->nidn }}</td>
                            </tr>
                            <tr>
                                <th>NIP</th>
                                <td>{{ $dosen->nip }}</td>
                            </tr>
                            <tr>
                                <th>Nama Dosen</th>
                                <td>{{ $dosen->nama_dosen }}</td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>{{ $dosen->alamat }}</td>
                            </tr>
                            <tr>
                                <th>No Telepon</th>
                                <td>{{ $dosen->no_telp }}</td>
                            </tr>
                            <tr>
                                <th>Jabatan Fungsional</th>
                                <td>{{ $dosen->jabatan_fungsional }}</td>
                            </tr>
                            <tr>
                                <th>No Sertifikat Dosen</th>
                                <td>{{ $dosen->no_serdos }}</td>
                            </tr>
                            <tr>
                                <th>Status Dosen</th>
                                <td>{{ $dosen->status_dosen }}</td>
                            </tr>
                        </table>
                        <a href="{{ route('dosen.index') }}" class="btn btn-secondary mt-3">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection -->
