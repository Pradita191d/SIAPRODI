@extends('layouts.app')

@section('content')
    <div>
        <div class="shadow-sm card">
            <div class="card-body">
                @if (!request()->routeIs('mahasiswa.index'))
                    <a href="{{ route('mahasiswa.index') }}" class="d-flex align-items-center text-decoration-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-arrow-left">
                            <line x1="19" y1="12" x2="5" y2="12"></line>
                            <polyline points="12 19 5 12 12 5"></polyline>
                        </svg>
                        <span class="ms-2">Kembali</span>
                    </a>
                @endif
                <h3 class="h-5 my-3 font-weight-bold">Daftar Mahasiswa</h3>
                <div class="mt-4 justify-content-between d-flex align-items-center">
                    <form action="{{ route('mahasiswa.filter') }}" method="GET" id="tahunForm">
                        <div>
                            <select class="pr-5 form-control" id="tahunInput" name="tahun_masuk" required
                                onchange="this.form.submit()">
                                <option value="" disabled selected>Pilih Tahun</option>
                                @foreach ($tahunAkademiks as $x)
                                    <option value="{{ $x->id_tahun_akademik }}"
                                        {{ request('tahun_masuk') == $x->id_tahun_akademik ? 'selected' : '' }}>
                                        {{ $x->tahun }} {{ $x->ganjil_genap }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </form>


                    <div class="d-flex align-items-center">
                        <!-- Button trigger modal -->
                        <button type="button" class="h-10 mr-2 btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            Tambah Mahasiswa
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Mahasiswa</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('mahasiswa.store') }}" method="post">
                                        @csrf <!-- Token untuk keamanan -->
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="namaInput" class="form-label">Nama Mahasiswa</label>
                                                <input type="text" class="form-control" id="namaInput"
                                                    name="nama_mahasiswa" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="nimInput" class="form-label">NIM Mahasiswa</label>
                                                <input type="text" class="form-control" id="nimInput" name="nim"
                                                    required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="noInput" class="form-label">Nomor Hp</label>
                                                <input type="text" class="form-control" id="noInput" name="no_hp"
                                                    required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="noOrtuInput" class="form-label">Nomor Hp Orang Tua</label>
                                                <input type="text" class="form-control" id="noOrtuInput" name="no_ortu"
                                                    required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="alamatInput" class="form-label">Alamat</label>
                                                <input type="text" class="form-control" id="alamatInput" name="alamat"
                                                    required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="tahunInput" class="form-label">Tahun Masuk Mahasiswa</label>
                                                <select class="form-control" id="tahunInput" name="tahun_masuk" required>
                                                    <option value="" selected disabled>Pilih Tahun</option>
                                                    @foreach ($tahunAkademiks as $x)
                                                        <option value="{{ $x->id_tahun_akademik }}">{{ $x->tahun }}
                                                            {{ $x->ganjil_genap }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <form action={{ route('mahasiswa.cari') }} method="GET"
                            class="flex items-center p-2 space-x-2 rounded-lg">
                            <input type="text" name="cari" placeholder="Cari mahasiswa..."
                                value="{{ old('cari') }}"
                                class="h-10 px-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <button type="submit"
                                class="h-10 px-4 font-semibold text-white transition duration-300 bg-blue-500 rounded-lg hover:bg-blue-600">
                                Cari
                            </button>
                        </form>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="text-white bg-primary">
                            <tr>
                                <th class="text-center">NIM</th>
                                <th class="text-center">Nama Mahasiswa</th>
                                <th class="text-center">Tahun Masuk</th>
                                <th class="text-center">Status Mahasiswa</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mahasiswas as $mahasiswa)
                                <tr>
                                    <td class="text-center">{{ $mahasiswa->nim }}</td>
                                    <td class="text-center">{{ $mahasiswa->nama_mahasiswa }}</td>
                                    <td class="text-center">
                                        {{ $mahasiswa->tahunMasuk->tahun ?? '-' }}
                                    </td>
                                    <td class="text-center">
                                        @if ($mahasiswa->status_aktif == 'Aktif')
                                            <span class="text-sm badge bg-success">Aktif</span>
                                        @elseif ($mahasiswa->status_aktif == 'Lulus')
                                            <span class="text-sm badge bg-primary">lulus</span>
                                        @elseif ($mahasiswa->status_aktif == 'DO')
                                            <span class="text-sm badge bg-danger">DO</span>
                                        @elseif ($mahasiswa->status_aktif == 'Undur Diri')
                                            <span class="text-sm badge bg-warning">Undur Diri</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="/lihat_mahasiswa/{{ $mahasiswa->id_mahasiswa }}"
                                                class="mr-2 btn btn-sm btn-primary">Lihat</a>
                                            <!-- Use a unique modal ID based on mahasiswa's ID -->
                                            <button type="button" class="mr-2 btn btn-sm btn-primary"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modal-{{ $mahasiswa->id_mahasiswa }}">
                                                Edit
                                            </button>

                                            <!-- Modal for each mahasiswa -->
                                            <div class="modal fade" id="modal-{{ $mahasiswa->id_mahasiswa }}"
                                                tabindex="-1"
                                                aria-labelledby="modalLabel-{{ $mahasiswa->id_mahasiswa }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="modalLabel-{{ $mahasiswa->id_mahasiswa }}">Edit Data
                                                                Mahasiswa</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form
                                                            action="{{ route('mahasiswa.edit', $mahasiswa->id_mahasiswa) }}"
                                                            method="POST">
                                                            @csrf
                                                            <div class="modal-body text-start">
                                                                <div class="mb-3">
                                                                    <label for="namaInput-{{ $mahasiswa->id_mahasiswa }}"
                                                                        class="form-label">Nama Mahasiswa</label>
                                                                    <input type="hidden" name="id_mahasiswa"
                                                                        value="{{ $mahasiswa->id_mahasiswa }}">
                                                                    <input type="text" class="form-control"
                                                                        id="namaInput-{{ $mahasiswa->id_mahasiswa }}"
                                                                        name="nama_mahasiswa"
                                                                        value="{{ $mahasiswa->nama_mahasiswa }}">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="noInput-{{ $mahasiswa->id_mahasiswa }}"
                                                                        class="form-label">Nomor Hp</label>
                                                                    <input type="text" class="form-control"
                                                                        id="noInput-{{ $mahasiswa->id_mahasiswa }}"
                                                                        name="no_hp" value="{{ $mahasiswa->no_hp }}">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label
                                                                        for="noOrtuInput-{{ $mahasiswa->id_mahasiswa }}"
                                                                        class="form-label">Nomor Hp Orang Tua</label>
                                                                    <input type="text" class="form-control"
                                                                        id="noOrtuInput-{{ $mahasiswa->id_mahasiswa }}"
                                                                        name="no_ortu" value="{{ $mahasiswa->no_ortu }}">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label
                                                                        for="alamatInput-{{ $mahasiswa->id_mahasiswa }}"
                                                                        class="form-label">Alamat</label>
                                                                    <input type="text" class="form-control"
                                                                        id="alamatInput-{{ $mahasiswa->id_mahasiswa }}"
                                                                        name="alamat" value="{{ $mahasiswa->alamat }}">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label
                                                                        for="statusInput-{{ $mahasiswa->id_mahasiswa }}"
                                                                        class="form-label">Status Mahasiswa</label>
                                                                    <select class="form-control"
                                                                        id="statusInput-{{ $mahasiswa->id_mahasiswa }}"
                                                                        name="status_aktif">
                                                                        <option value="" disabled>Pilih Status
                                                                        </option>
                                                                        <option value="Aktif"
                                                                            {{ $mahasiswa->status_aktif == 'Aktif' ? 'selected' : '' }}>
                                                                            Aktif</option>
                                                                        <option value="Lulus"
                                                                            {{ $mahasiswa->status_aktif == 'Lulus' ? 'selected' : '' }}>
                                                                            Lulus</option>
                                                                        <option value="DO"
                                                                            {{ $mahasiswa->status_aktif == 'DO' ? 'selected' : '' }}>
                                                                            DO</option>
                                                                        <option value="Undur Diri"
                                                                            {{ $mahasiswa->status_aktif == 'Undur Diri' ? 'selected' : '' }}>
                                                                            Undur Diri</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save
                                                                    changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Tombol Hapus -->
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#confirmDeleteModal"
                                                onclick="setDeleteData('{{ $mahasiswa->id_mahasiswa }}', '{{ $mahasiswa->nama_mahasiswa }}')">

                                                Hapus
                                            </button>

                                            <!-- Modal Konfirmasi Hapus -->
                                            <div class="modal fade" id="confirmDeleteModal" tabindex="-1"
                                                aria-labelledby="confirmDeleteLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="confirmDeleteLabel">Konfirmasi
                                                                Hapus</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Apakah Anda yakin ingin menghapus mahasiswa <b
                                                                    id="namaMahasiswa"></b>?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form id="deleteForm" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit"
                                                                    class="btn btn-danger">Hapus</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        function setDeleteData(id, name) {
            document.getElementById('namaMahasiswa').textContent = name;
            document.getElementById('deleteForm').action = `/mahasiswa/${id}`;
        }
    </script>
@endsection
