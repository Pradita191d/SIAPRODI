@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Magang Entry</h2>

    <!-- Display validation errors if any -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Edit form for Magang entry -->
    <form action="{{ route('magang.update', $magang->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- This is required to specify an update request -->

        <div class="row">
            <!-- Left Column -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nama_perusahaan">Nama Perusahaan</label>
                    <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" value="{{ $magang->nama_perusahaan }}" required>
                </div>

                <div class="form-group">
                    <label for="alamat_perusahaan">Alamat Perusahaan</label>
                    <textarea class="form-control" id="alamat_perusahaan" name="alamat_perusahaan" rows="3" required>{{ $magang->alamat_perusahaan }}</textarea>
                </div>

                <div class="form-group">
                    <label for="jenis_perusahaan">Jenis Perusahaan</label>
                    <select class="form-control" id="jenis_perusahaan" name="jenis_perusahaan" required>
                        <option value="UI/UX" {{ $magang->jenis_perusahaan == 'UI/UX' ? 'selected' : '' }}>UI/UX</option>
                        <option value="Programming" {{ $magang->jenis_perusahaan == 'Programming' ? 'selected' : '' }}>Programming</option>
                        <option value="Mobile / Android Programming" {{ $magang->jenis_perusahaan == 'Mobile / Android Programming' ? 'selected' : '' }}>Mobile / Android Programming</option>
                    </select>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="pembimbing_lapangan">Pembimbing Lapangan</label>
                    <input type="text" class="form-control" id="pembimbing_lapangan" name="pembimbing_lapangan" value="{{ $magang->pembimbing_lapangan }}" required>
                </div>

                <div class="form-group">
                    <label for="no_perusahaan">No. Perusahaan</label>
                    <input type="text" class="form-control" id="no_perusahaan" name="no_perusahaan" value="{{ $magang->no_perusahaan }}" required>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('magang.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<!-- Tabel Magang -->
<h3>Mahasiswa Magang</h3>

<!-- Button to Open the Modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addMahasiswaMagangModal">
    Tambah Mahasiswa Magang
</button>

<div class="d-flex justify-content-end mb-3">
    <!-- Search Form -->
    <input type="text" id="searchBar" class="form-control" style="width: 250px;" placeholder="Search by NIM, Durasi, Tahun Ajaran, Nilai, etc.">
</div>


<!-- Table displaying Mahasiswa Magang -->
<table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>NIM</th>
            <th>Durasi (months)</th>
            <th>Tahun Ajaran</th>
            <th>Bukti Nilai (File)</th>
            <th>Nilai</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody id="mahasiswaMagangTableBody">
        @foreach($mahasiswaMagang as $mahasiswa)
        <tr>
            <td>{{ $mahasiswa->nama_mahasiswa }} ({{ $mahasiswa->nim }})</td>
            <td>{{ $mahasiswa->durasi }}</td>
            <td>{{ $mahasiswa->tahun_ajaran }}</td>
            <td>
                @if ($mahasiswa->bukti_nilai)
                <a href="{{ asset('storage/' . $mahasiswa->bukti_nilai) }}" target="_blank">View File</a>
                @else
                No file uploaded
                @endif
            </td>
            <td>{{ $mahasiswa->nilai }}</td>
            <td>
                <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editMahasiswaMagangModal{{ $mahasiswa->id }}">Edit</button>
                <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteMahasiswaMagangModal{{ $mahasiswa->id }}">Delete</button>
            </td>
        </tr>

        <!-- Edit Mahasiswa Modal -->
        <div class="modal fade" id="editMahasiswaMagangModal{{ $mahasiswa->id }}" tabindex="-1" role="dialog" aria-labelledby="editMahasiswaMagangModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Mahasiswa Magang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('magang.updateMahasiswaMagang', [$magang->id, $mahasiswa->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                          <div class="form-group">
                                <label for="nim">Mahasiswa (NIM)</label>
                                <select class="form-control select2 nim-select" name="nim" required>

                                    <option value="">Select Mahasiswa</option>
                                    @foreach($mahasiswaList as $mahasiswaItem)
                                        <option value="{{ $mahasiswaItem->nim }}" 
                                            {{ isset($mahasiswa) && $mahasiswa->nim == $mahasiswaItem->nim ? 'selected' : '' }}>
                                            {{ $mahasiswaItem->nama_mahasiswa }} ({{ $mahasiswaItem->nim }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="durasi">Durasi (months)</label>
                                <input type="number" class="form-control" id="durasi" name="durasi" value="{{ $mahasiswa->durasi }}" required>
                            </div>
                            <div class="form-group">
                                <label for="tahun_ajaran">Tahun Ajaran</label> <!-- New Field -->
                                <input type="text" class="form-control" id="tahun_ajaran" name="tahun_ajaran" value="{{ $mahasiswa->tahun_ajaran }}" required>
                            </div>
                            <div class="form-group">
                                <label for="bukti_nilai">Bukti Nilai (File)</label>
                                <input type="file" class="form-control" id="bukti_nilai" name="bukti_nilai" accept=".png,.jpg,.jpeg,.pdf">
                                @if ($mahasiswa->bukti_nilai)
                                <p>Current file: <a href="{{ asset('storage/' . $mahasiswa->bukti_nilai) }}" target="_blank">View</a></p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="nilai">Nilai (Max 100)</label>
                                <input type="number" class="form-control" id="nilai" name="nilai" max="100" value="{{ $mahasiswa->nilai }}" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Delete Mahasiswa Modal -->
        <div class="modal fade" id="deleteMahasiswaMagangModal{{ $mahasiswa->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteMahasiswaMagangModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Mahasiswa Magang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('magang.deleteMahasiswaMagang', [$magang->id, $mahasiswa->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            <p>Are you sure you want to delete {{ $mahasiswa->mahasiswa->nama_mahasiswa }} ({{ $mahasiswa->nim }})?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </tbody>
</table>


<!-- Add Mahasiswa Modal -->
<div class="modal fade" id="addMahasiswaMagangModal" tabindex="-1" role="dialog" aria-labelledby="addMahasiswaMagangModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMahasiswaMagangModalLabel">Add Mahasiswa Magang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addMahasiswaMagangForm" action="{{ route('magang.storeMahasiswaMagang', $magang->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nim">Mahasiswa</label>
                        <select class="form-control select2 nim-select" name="nim" required>

                            <option value="">Select Mahasiswa</option>
                            @foreach($mahasiswaList as $mahasiswa)
                                <option value="{{ $mahasiswa->nim }}">
                                    {{ $mahasiswa->nama_mahasiswa ? $mahasiswa->nama_mahasiswa : 'Nama not found' }} ({{ $mahasiswa->nim }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="durasi">Durasi (months)</label>
                        <input type="number" class="form-control" id="durasi" name="durasi" placeholder="Enter Duration" required>
                    </div>
                    <div class="form-group">
                        <label for="tahun_ajaran">Tahun Ajaran</label> <!-- New Field -->
                        <input type="text" class="form-control" id="tahun_ajaran" name="tahun_ajaran" placeholder="Enter Tahun Ajaran" required>
                    </div>
                    <div class="form-group">
                        <label for="bukti_nilai">Bukti Nilai (File)</label>
                        <input type="file" class="form-control" id="bukti_nilai" name="bukti_nilai" accept=".png,.jpg,.jpeg,.pdf">
                    </div>
                    <div class="form-group">
                        <label for="nilai">Nilai (Max 100)</label>
                        <input type="number" class="form-control" id="nilai" name="nilai" max="100" placeholder="Enter Nilai" required>
                    </div>
                    <input type="hidden" name="id_perusahaan" value="{{ $magang->id }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
$(document).ready(function () {
    // Initialize Select2 globally for all nim-select elements inside modals
    $('.nim-select').select2({
        dropdownParent: $('#addMahasiswaMagangModal').length ? $('#addMahasiswaMagangModal') : $(document.body),
        width: '100%',
        placeholder: 'Select Mahasiswa',
        allowClear: true,
        minimumInputLength: 1
    });

    // Re-initialize for dynamically added modals (edit modals)
    $('.modal').on('shown.bs.modal', function () {
        $(this).find('.nim-select').select2({
            dropdownParent: $(this),
            width: '100%',
            placeholder: 'Select Mahasiswa',
            allowClear: true,
            minimumInputLength: 1
        });
    });

    // Clear on close
    $('.modal').on('hidden.bs.modal', function () {
        $(this).find('form')[0].reset();
        $(this).find('.nim-select').val(null).trigger('change');
    });
});

</script>
    
<script>
    document.getElementById('searchBar').addEventListener('keyup', function() {
        let input = this.value.toLowerCase();
        let tableBody = document.getElementById('mahasiswaMagangTableBody');
        let rows = tableBody.getElementsByTagName('tr');

        for (let i = 0; i < rows.length; i++) {
            let rowData = rows[i].textContent.toLowerCase();
            rows[i].style.display = rowData.includes(input) ? '' : 'none';
        }
    });
</script>

@endpush
