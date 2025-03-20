@extends('layouts.app')

@section('content')
<div class="container">
    <h2>List of Magang Entries</h2>

    <!-- Button to trigger modal -->
    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addMagangModal">
        Tambah Tempat Magang
    </button>

    <div class="d-flex justify-content-end mb-3">
        <!-- Search Bar -->
        <div class="form-group">
            <input type="text" id="searchInput" class="form-control" placeholder="Search by Nama Perusahaan or Jenis Perusahaan or Alamat Perusahaan">
        </div>
    </div>

<!-- Table for displaying magang data -->
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Perusahaan</th>
            <th>Jenis Perusahaan</th>
            <th>Alamat Perusahaan</th>
            <th>Pembimbing Lapangan</th>
            <th>No Perusahaan</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody id="magangTable">
        @foreach ($magang as $entry)
        <tr>
            <td>{{ $entry->id }}</td>
            <td>{{ $entry->nama_perusahaan }}</td>
            <td>{{ $entry->jenis_perusahaan }}</td>
            <td>{{ $entry->alamat_perusahaan }}</td>
            <td>{{ $entry->pembimbing_lapangan }}</td>
            <td>{{ $entry->no_perusahaan }}</td>
            <td>
                <!-- Edit Button with Eye Icon -->
                <a href="{{ route('magang.edit', $entry->id) }}" class="btn btn-primary">
                    <i class="fas fa-eye"></i> Edit
                </a>

                <!-- Trigger Delete Modal -->
                <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $entry->id }}">
                    <i class="fas fa-trash-alt"></i> Delete
                </button>




                <!-- Delete Modal -->
                <div class="modal fade" id="deleteModal{{ $entry->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $entry->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel{{ $entry->id }}">Confirm Deletion</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this entry: <strong>{{ $entry->nama_perusahaan }}</strong>?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <form action="{{ route('magang.destroy', $entry->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
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

<!-- Modal for adding new Magang entry -->
<div class="modal fade" id="addMagangModal" tabindex="-1" aria-labelledby="addMagangModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMagangModalLabel">Add New Magang Entry</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addMagangForm" method="POST" action="{{ route('magang.store') }}">
                    @csrf
                    <!-- Nama Perusahaan -->
                    <div class="form-group">
                        <label for="nama_perusahaan">Nama Perusahaan</label>
                        <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" required>
                    </div>

                    <!-- Jenis Perusahaan -->
                    <div class="form-group">
                        <label for="jenis_perusahaan">Jenis Perusahaan</label>
                        <select class="form-control" id="jenis_perusahaan" name="jenis_perusahaan" required>
                            <option value="">Select Jenis Perusahaan</option>
                            <option value="UI/UX">UI/UX</option>
                            <option value="Programming">Programming</option>
                            <option value="Mobile / Android Programming">Mobile / Android Programming</option>
                        </select>
                    </div>


                    <!-- Alamat Perusahaan -->
                    <div class="form-group">
                        <label for="alamat_perusahaan">Alamat Perusahaan</label>
                        <textarea class="form-control" id="alamat_perusahaan" name="alamat_perusahaan" rows="3" required></textarea>
                    </div>

                    <!-- Pembimbing Lapangan -->
                    <div class="form-group">
                        <label for="pembimbing_lapangan">Pembimbing Lapangan</label>
                        <input type="text" class="form-control" id="pembimbing_lapangan" name="pembimbing_lapangan" required>
                    </div>

                    <!-- No Perusahaan -->
                    <div class="form-group">
                        <label for="no_perusahaan">No Perusahaan (Telephone)</label>
                        <input type="number" class="form-control" id="no_perusahaan" name="no_perusahaan" required>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        var searchValue = this.value.toLowerCase();
        var rows = document.querySelectorAll('#magangTable tr');

        rows.forEach(function(row) {
            var namaPerusahaan = row.cells[1].textContent.toLowerCase();
            var jenisPerusahaan = row.cells[2].textContent.toLowerCase();
            var alamatPerusahaan = row.cells[3].textContent.toLowerCase();

            if (namaPerusahaan.includes(searchValue) || jenisPerusahaan.includes(searchValue) || alamatPerusahaan.includes(searchValue)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>
@endpush