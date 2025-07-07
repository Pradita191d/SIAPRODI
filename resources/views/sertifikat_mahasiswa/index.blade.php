@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="h5 font-weight-bold mb-0 mr-3">Daftar Sertifikat Kompetensi Mahasiswa</h3>
                <div class="d-flex justify-content-between">
                    <button class="btn btn-success ml-1" data-toggle="modal" data-target="#addSertifikatModal">Tambah
                        Data</button>
                </div>
            </div>
            <form action="{{ route('sertifikat_mahasiswa.index') }}" method="GET" class="form-row align-items-center justify-content-end p-0 m-0">
                <div class="col-auto mb-2">
                    <label for="tahun_terbit" class="sr-only">Tahun Terbit</label>
                    <input type="number" name="tahun_terbit" id="tahun_terbit"
                        class="form-control form-control-sm" style="width: 136px;"
                        min="2015" max="{{ date('Y') }}" step="1"
                        value="{{ request('tahun_terbit') }}" placeholder="Tahun Terbit">
                </div>
                <div class="col-auto mb-2">
                    <label for="tahun_berlaku" class="sr-only">Tahun Kadaluarsa</label>
                    <input type="number" name="tahun_berlaku" id="tahun_berlaku"
                        class="form-control form-control-sm" style="width: 136px;"
                        min="{{ date('Y') }}" max="{{ date('Y') + 10 }}" step="1"
                        value="{{ request('tahun_berlaku') }}" placeholder="Tahun Kadaluarsa">
                </div>

                <div class="col-auto mb-2">
                    <button type="submit" class="btn btn-sm btn-primary">
                        <i class="fas fa-filter mr-1"></i> Filter
                    </button>
                    @if(request()->has('tahun_terbit') || request()->has('tahun_berlaku'))
                    <a href="{{ route('sertifikat_mahasiswa.index') }}" class="btn btn-sm btn-secondary ml-1">
                        <i class="fas fa-times mr-1"></i> Reset
                    </a>
                    @endif
                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-bordered" id="sertifikatTable">
                    <thead class="bg-primary text-white">
                        <tr class="text-center">
                            <th class="text-center">No</th>
                            <th class="text-center">NIM</th>
                            <th class="text-center">Nama Mahasiswa</th>
                            <th class="text-center">Nama Sertifikat</th>
                            <th class="text-center">Nama Lembaga</th>
                            <th class="text-center">Nomor Registrasi</th>
                            <th class="text-center">Tanggal Terbit</th>
                            <th class="text-center">Berlaku Sampai</th>
                            <th class="text-center">Dokumen</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sertikoma as $sertifikat)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $sertifikat->nim }}</td>
                            <td>{{ $sertifikat->mahasiswa->nama_mahasiswa ?? '-' }}</td>
                            <td>{{ $sertifikat->nm_sert }}</td>
                            <td>{{ $sertifikat->lembaga }}</td>
                            <td>{{ $sertifikat->no_reg }}</td>
                            <td>{{ $sertifikat->tanggal_sert_formatted }}</td>
                            <td>{{ $sertifikat->tanggal_expired }}</td>
                            <td>
                                @if($sertifikat->file)
                                <a href="{{ asset('storage/' . $sertifikat->file) }}" target="_blank" class="btn btn-sm btn-primary">
                                    Lihat Dokumen
                                </a>
                                @else
                                -
                                @endif
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-1">
                                    <button class="btn btn-sm btn-warning text-white" onclick="editSertifikat('{{ $sertifikat->id }}', '{{ $sertifikat->nim }}', '{{ $sertifikat->nm_sert }}', '{{ $sertifikat->lembaga }}', '{{ $sertifikat->tanggal_sert }}', '{{ $sertifikat->masa_berlaku }}')">
                                        <div class="d-flex align-items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                                            </svg>
                                            <span>Edit</span>
                                        </div>
                                    </button>
                                    <button class="btn btn-sm btn-danger" onclick="confirmDelete('{{ $sertifikat->id }}', '{{ $sertifikat->nim }}')">
                                        <div class="d-flex align-items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
                                            </svg>
                                            <span>Hapus</span>
                                        </div>
                                    </button>
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

<!-- Modal Tambah Sertifikat -->
<div class="modal fade" id="addSertifikatModal" tabindex="-1" aria-labelledby="addSertifikatModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSertifikatModalLabel">Tambah Sertifikat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('sertifikat_mahasiswa.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="nim" class="form-label fw-bold">Nama Mahasiswa / NIM</label>
                        <select class="form-control select2" id="nim" name="nim" required>
                            <option value="" selected>-- Pilih Mahasiswa --</option>
                            @foreach($mahasiswa as $yuhu)
                            <option value="{{ $yuhu->nim }}">
                                {{ $yuhu->nama_mahasiswa }} ({{ $yuhu->nim }})
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="nm_sert">Nama Sertifikat</label>
                        <input type="text" class="form-control" id="nm_sert" name="nm_sert" placeholder="Masukkan Nama Sertifikat" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="lembaga">Nama Lembaga</label>
                        <input type="text" class="form-control" id="lembaga" name="lembaga" placeholder="Masukkan Nama Lembaga" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="no_reg">Nomor Registrasi</label>
                        <input type="text" class="form-control" id="no_reg" name="no_reg" placeholder="Masukkan Nomor Registrasi" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="tanggal_sert">Tanggal Terbit</label>
                        <input type="date" class="form-control" id="tanggal_sert" name="tanggal_sert" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="masa_berlaku">Masa Berlaku (Tahun)</label>
                        <input type="number" class="form-control" id="masa_berlaku" name="masa_berlaku" placeholder="Masukkan Masa Berlaku" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="file">Upload File <small class="text-danger">(Maks. 2MB)</small></label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="file" name="file" style="cursor: pointer;" accept=".jpg,.jpeg,.png,.pdf" required>
                            <label class="custom-file-label" for="file">Pilih file...</label>
                        </div>
                        <small id="fileError" class="text-danger d-none">Ukuran file maksimal 2MB!</small>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Sertifikat -->
<div class="modal fade" id="editSertifikatModal" tabindex="-1" aria-labelledby="editSertifikatModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSertifikatModalLabel">Edit Sertifikat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editSertifikatForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_id" name="id">
                    <div class="form-group mb-3">
                        <label for="edit_nim" class="form-label fw-bold">Nama Mahasiswa / NIM</label>
                        <select class="form-control select2" id="edit_nim" name="nim" required>
                            <option value="">-- Pilih Mahasiswa --</option>
                            @foreach($mahasiswa as $yuhu)
                            <option value="{{ $yuhu->nim }}"
                                @if(isset($sertikoMa) && $yuhu->nim == $sertikoMa->nim) selected @endif>
                                {{ $yuhu->nama_mahasiswa }} ({{ $yuhu->nim }})
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="edit_nm_sert">Nama Sertifikat</label>
                        <input type="text" class="form-control" id="edit_nm_sert" name="nm_sert" placeholder="Masukkan Nama Sertifikat" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="edit_lembaga">Nama Lembaga</label>
                        <input type="text" class="form-control" id="edit_lembaga" name="lembaga" placeholder="Masukkan Nama Lembaga" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="edit_noreg">Nomor Registrasi</label>
                        <input type="text" class="form-control" id="no_reg" name="no_reg" placeholder="Masukkan Nomor Registrasi" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="edit_tanggal_sert">Tanggal Terbit</label>
                        <input type="date" class="form-control" id="edit_tanggal_sert" name="tanggal_sert" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="edit_masa_berlaku">Masa Berlaku (Tahun)</label>
                        <input type="number" class="form-control" id="edit_masa_berlaku" name="masa_berlaku" placeholder="Masukkan Masa Berlaku" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="edit_file">Upload File <small class="text-danger">(Maks. 2MB)</small></label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="edit_file" name="file" style="cursor: pointer;" accept=".jpg,.jpeg,.png,.pdf">
                            <label class="custom-file-label" for="edit_file" id="edit_file_label">Ubah file...</label>
                        </div>
                        <small id="editFileError" class="text-danger d-none">Ukuran file maksimal 2MB!</small>
                        <div id="current_file" class="mt-2"></div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary mr-2" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Hapus -->
<div class="modal fade" id="deleteSertifikatModal" tabindex="-1" aria-labelledby="deleteSertifikatModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteSertifikatModalLabel">Hapus Sertifikat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus sertifikat ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <form id="deleteSertifikatForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        let table = $('#sertifikatTable').DataTable({
            "searching": true,
            "lengthChange": true,
            "pageLength": 10,
            "language": {
                "zeroRecords": "Data tidak ditemukan",
                "infoEmpty": "Tidak ada data",
            }
        });

        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });

        $('#file, #edit_file').on('change', function() {
            const file = this.files[0];
            const maxSize = 2 * 1024 * 1024; // 2MB
            const errorElement = $(this).attr('id') === 'file' ? $('#fileError') : $('#editFileError');

            if (file && file.size > maxSize) {
                errorElement.removeClass('d-none');
                $(this).val('');
                $(this).next('.custom-file-label').html('Pilih file...');
            } else {
                errorElement.addClass('d-none');
            }
        });
    });

    function editSertifikat(id, nim, nm_sert, lembaga, tanggal_sert, masa_berlaku) {
        $('#edit_id').val(id);
        $('#edit_nim').val(nim).trigger('change');
        $('#edit_nm_sert').val(nm_sert);
        $('#edit_lembaga').val(lembaga);
        $('#edit_noreg').val(no_reg);
        $('#edit_tanggal_sert').val(tanggal_sert);
        $('#edit_masa_berlaku').val(masa_berlaku);

        $('#editSertifikatForm').attr('action', '/sertifikat_mahasiswa/' + id);
        $('#editSertifikatModal').modal('show');
    }

    function confirmDelete(id, nim) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data Sertifikat dengan NIM " + nim + " akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#deleteSertifikatForm').attr('action', '/sertifikat_mahasiswa/' + id);
                $('#deleteSertifikatForm').submit();
            }
        });
    }

    $('#addSertifikatModal').on('shown.bs.modal', function() {
        $('#nim').select2({
            dropdownParent: $('#addSertifikatModal'),
            placeholder: '-- Pilih Mahasiswa --',
            allowClear: true,
            width: '100%'
        });
    });

    $('#editSertifikatModal').on('shown.bs.modal', function() {
        $('#edit_nim').select2({
            dropdownParent: $('#editSertifikatModal'),
            placeholder: '-- Pilih Mahasiswa --',
            allowClear: true,
            width: '100%'
        });
    });
</script>
@endpush