@extends('layouts.app')

@section('content')
<div>
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="h5 font-weight-bold mb-0">Daftar Sertifikat Kopetensi Mahasiswa</h3>
                <button class="btn btn-primary" data-toggle="modal" data-target="#addSertifikatModal">
                    <i class="fas fa-plus"></i> Tambah
                </button>
            </div>
            <div class="table-responsive">
                <table id="sertifikat-table" class="table table-bordered table-striped">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th class="text-center">NIM</th>
                            <th class="text-center">Nama Mahasiswa</th>
                            <th class="text-center">Nama Sertifikat</th>
                            <th class="text-center">Nama Lembaga</th>
                            <th class="text-center">Tanggal Terbit</th>
                            <th class="text-center">Berlaku Sampai</th>
                            <th class="text-center">Dokumen</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

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
                        <label for="nim">NIM</label>
                        <select class="form-control select2" id="nim" name="nim" required></select>
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
                        <label for="tanggal_sert">Tanggal Terbit</label>
                        <input type="date" class="form-control" id="tanggal_sert" name="tanggal_sert" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="masa_berlaku">Masa Berlaku (Tahun)</label>
                        <input type="text" class="form-control" id="masa_berlaku" name="masa_berlaku" placeholder="Masukkan Masa Berlaku" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="file">Upload File <small class="text-danger">(Maks. 2MB)</small></label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="file" name="file" style="cursor: pointer;" accept=".jpg,.jpeg,.png,.pdf">
                            <label class="custom-file-label" for="file" required>Pilih file...</label>
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editSertifikatForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_id" name="id">

                    <div class="form-group mb-3">
                        <label for="edit_nim">NIM</label>
                        <select class="form-control select2" id="edit_nim" name="nim" required></select>
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
                        <label for="edit_tanggal_sert">Tanggal Terbit</label>
                        <input type="date" class="form-control" id="edit_tanggal_sert" name="tanggal_sert" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="edit_masa_berlaku">Masa Berlaku (Tahun)</label>
                        <input type="text" class="form-control" id="edit_masa_berlaku" name="masa_berlaku" placeholder="Masukkan Masa Berlaku" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="edit_file">Upload File <small class="text-danger">(Maks. 2MB)</small></label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="edit_file" name="file" style="cursor: pointer;" accept=".jpg,.jpeg,.png,.pdf">
                            <label class="custom-file-label" for="edit_file" id="edit_file_label" required>Pilih file...</label>
                        </div>
                        <small id="editFileError" class="text-danger d-none">Ukuran file maksimal 2MB!</small>
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
        $('#sertifikat-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('sertifikat_mahasiswa.index') }}",
            columns: [{
                    data: 'nim',
                    class: "text-center",
                    name: 'nim'
                },
                {
                    data: 'nama_mahasiswa',
                    name: 'nama_mahasiswa',
                    class: "text-center",
                    searchable: false
                },
                {
                    data: 'nm_sert',
                    name: 'nm_sert',
                    class: "text-center"
                },
                {
                    data: 'lembaga',
                    name: 'lembaga',
                    class: "text-center"
                },
                {
                    data: 'tanggal_sert',
                    name: 'tanggal_sert',
                    class: "text-center",
                    render: function(data) {
                        return moment(data).locale('id').format('D MMMM YYYY');
                    }
                },
                {
                    data: 'berlaku_sampai',
                    name: 'berlaku_sampai',
                    class: "text-center",
                    render: function(data) {
                        return moment(data).locale('id').format('D MMMM YYYY');
                    }
                },
                {
                    data: 'file',
                    name: 'file',
                    class: "text-center"
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    class: "text-center",
                    render: function(data, type, row) {
                        return `
                    <button class="btn btn-warning btn-sm edit-btn" data-id="${row.id}">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                    <button class="btn btn-danger btn-sm delete-btn" data-id="${row.id}">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                `;
                    }
                }
            ]
        });

        $('#nim').select2({
            dropdownParent: $('#addSertifikatModal'),
            allowClear: true,
            width: '100%',
            placeholder: "Masukan NIM",
            selectOnClose: true,
            ajax: {
                url: "{{ route('get_mahasiswa') }}",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        term: params.term
                    };
                },
                processResults: function(data) {
                    return {
                        results: data.map(item => ({
                            id: item.id,
                            text: item.text
                        }))
                    };
                },
                cache: true
            },
            minimumInputLength: 1
        });

        $('#edit_nim').select2({
            dropdownParent: $('#editSertifikatModal'),
            allowClear: true,
            width: '100%',
            selectOnClose: true,
            ajax: {
                url: "{{ route('get_mahasiswa') }}",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        term: params.term
                    };
                },
                processResults: function(data) {
                    return {
                        results: data.map(item => ({
                            id: item.id,
                            text: item.text
                        }))
                    };
                },
                cache: true
            },
            minimumInputLength: 1
        });

        $('.select2-selection--single').attr('style', 'height: 38px !important; padding: 6px 12px !important; border: 1px solid #ced4da !important; border-radius: 4px !important; line-height: 26px !important;');

        $('#nim, #edit_nim').on('select2:open', function() {
            document.querySelector('.select2-search__field').focus();
        });

        $(document).ready(function() {
            $(document).on('click', '.edit-btn', function() {
                var id = $(this).data('id');
                var url = "{{ route('sertifikat_mahasiswa.edit', ':id') }}".replace(':id', id);

                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {
                        $('#edit_id').val(response.id);
                        $('#edit_nim').html(`<option value="${response.nim}" selected>${response.nim}</option>`).trigger('change');
                        $('#edit_nm_sert').val(response.nm_sert);
                        $('#edit_lembaga').val(response.lembaga);
                        $('#edit_tanggal_sert').val(response.tanggal_sert);
                        $('#edit_masa_berlaku').val(response.masa_berlaku);

                        if (response.file) {
                            $('#edit_file_label').text(response.file);
                        } else {
                            $('#edit_file_label').text("Pilih file...");
                        }

                        $('#editSertifikatForm').attr('action', "{{ route('sertifikat_mahasiswa.update', ':id') }}".replace(':id', id));

                        $('#editSertifikatModal').modal('show');
                    }
                });
            });
        });

        $(document).ready(function() {
            $(document).on('click', '.delete-btn', function() {
                var id = $(this).data('id');
                var url = "{{ route('sertifikat_mahasiswa.destroy', ':id') }}";
                url = url.replace(':id', id);

                $('#deleteSertifikatForm').attr('action', url);

                $('#deleteSertifikatModal').modal('show');
            });
        });

        document.querySelectorAll('.custom-file-input').forEach(input => {
            input.addEventListener('change', function(e) {
                let fileInput = e.target;
                let file = fileInput.files[0];
                let maxSize = 2 * 1024 * 1024;
                let fileError = fileInput.id === 'file' ? document.getElementById('fileError') : document.getElementById('editFileError');
                let fileLabel = fileInput.nextElementSibling;

                if (file) {
                    if (file.size > maxSize) {
                        fileError.classList.remove('d-none');
                        fileInput.value = '';
                        fileLabel.innerText = "Pilih file...";
                    } else {
                        fileError.classList.add('d-none');
                        fileLabel.innerText = file.name;
                    }
                }
            });
        });

        $(document).ready(function() {
            $('#editSertifikatModal').on('hidden.bs.modal', function() {
                $(this).find('form')[0].reset();
                $('#edit_file_label').text('Pilih file...');
            });
            $('.btn-secondary, .close').click(function() {
                $('#editSertifikatModal').modal('hide');
                $('#deleteSertifikatModal').modal('hide');
            });
        });
    });
</script>
@endpush