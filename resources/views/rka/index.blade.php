@extends('layouts.app')

@section('content')
    <div class="container">
        <div class=" bg-white shadow-sm p-4  rounded-lg">
            <div class=" flex justify-between items-center">
                <h3>Pengajuan RKA Prodi Teknik Informatika</h3>
                <a href="{{ route('rka.create') }}" class="btn btn-primary">Tambah</a>
            </div>
            <table class="table table-bordered" id="datatable">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Tahun Akademik</th>
                        <th class="text-center">Nama RKA</th>
                        <th class="text-center">Deskripsi</th>
                        <th class="text-center">File Pengajuan</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rka as $index => $d)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $d->tahun_akademik->tahun }}</td>
                            <td>{{ $d->judul }}</td>
                            <td>{{ $d->deskripsi }}</td>
                            <td><a href="{{ asset('storage/' . $d->file) }}" target="_blank">Download File</a></td>
                            <td>
                                <div class=" flex justify-center items-center space-x-2">
                                    <!-- Button to trigger modal -->
                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                        data-target="#tambahTORModal" onclick="setRkaId({{ $d->id_rka }})">
                                        Ajukan TOR
                                    </button>
                                    <a href="{{ route('rka.edit', $d->id_rka) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('rka.destroy', $d->id_rka) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah Kamu yakin Menghapus data {{ $d->judul }}?');">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Modal Tambah -->
        <div class="modal fade" id="tambahTORModal" tabindex="-1" aria-labelledby="tambahTORModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahTAModalLabel">Ajukan TOR</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('tor.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="id_rka" class="form-label">RKA</label>
                                <select class="form-control" id="id_rka" name="id_rka">
                                    @foreach ($rka as $d)
                                        <option value="{{ $d->id_rka }}"
                                            {{ old('id_rka') == $d->id_rka ? 'selected' : '' }}>
                                            {{ $d->judul }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_rka')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="nama_tor" class="form-label">Nama TOR</label>
                                <input type="text" class="form-control" id="nama_tor" name="nama_tor"
                                    placeholder="nama tor">
                                @error('nama_tor')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" aria-label="Deskripsi Kegiatan"
                                    placeholder="Deskripsi Kegiatan"></textarea>
                                @error('deskripsi')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="proposal" class="form-label">Upload File</label>
                                <input type="file" class="form-control" id="proposal" name="proposal">
                                @error('proposal')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $('#datatable').DataTable();
            });

            function setRkaId(id) {
                let selectElement = document.getElementById("id_rka");
                selectElement.value = id;

            }
        </script>
    @endsection
