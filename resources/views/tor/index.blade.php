@extends('layouts.app')

@section('content')
    <div class="container">
        <div class=" bg-white shadow-sm p-4 rounded-lg">
            <div class=" flex justify-between items-center">
                <h3>Pengajuan TOR Prodi Teknik Informatika</h3>
            </div>
            <table class="table table-bordered" id="tortable">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Nama TOR</th>
                        <th class="text-center">RKA</th>
                        <th class="text-center">Deskripsi</th>
                        <th class="text-center">File Proposal</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tor as $index => $d)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $d->nama_tor }}</td>
                            <td>{{ $d->rka->judul }}</td>
                            <td>{{ $d->deskripsi }}</td>
                            <td><a href="{{ asset('storage/' . $d->proposal) }}" target="_blank">Download File</a></td>
                            <td>
                                <div class=" flex justify-center items-center space-x-2">
                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal"
                                        data-target="#editTORModal"
                                        onclick="setTORId('{{ $d->id_tor }}', '{{ $d->id_rka }}', '{{ $d->nama_tor }}', '{{ $d->deskripsi }}')">
                                        Edit
                                    </button>

                                    <form action="{{ route('tor.destroy', $d->id_tor) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah Kamu yakin Menghapus data {{ $d->nama_tor }}?');">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        <!-- Modal Tambah -->
        <div class="modal fade" id="editTORModal" tabindex="-1" aria-labelledby="editTORModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editTorModalLabel">Edit data TOR</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('tor.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" id="id_tor" name="id_tor" value="{{ old('id_tor') }}">
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
                                    placeholder="nama tor" value="{{ old('nama_tor') }}">
                                @error('nama_tor')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" aria-label="Deskripsi Kegiatan"
                                    placeholder="Deskripsi Kegiatan">{{ old('deskripsi') }}</textarea>
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

    </div>
    <script>
        $(document).ready(function() {
            $('#tortable').DataTable();
        });

        function setTORId(id_tor, id_rka, nama_tor, deskripsi) {

            let torElement = document.getElementById("id_tor");
            if (torElement) {
                torElement.value = id_tor;
            }
            let rkaElement = document.getElementById("id_rka");
            if (rkaElement) {
                rkaElement.value = id_rka;
            }
            let namaTorElement = document.getElementById("nama_tor");
            if (namaTorElement) {
                namaTorElement.value = nama_tor;
            }
            let deskripsiElement = document.getElementById("deskripsi");
            if (deskripsiElement) {
                deskripsiElement.value = deskripsi;
            }

        }
    </script>
@endsection
