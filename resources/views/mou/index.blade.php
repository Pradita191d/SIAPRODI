@extends('layouts.app')

@section('content')
    <div>
        <div class="card shadow-sm">
            <div class="card-body">
                <h3 class="h5 font-weight-bold mb-3">Daftar MoU</h3>


                <div class="d-flex justify-content-between mb-3">
                    <button class="btn btn-success ml-3" data-toggle="modal" data-target="#tambahMouModal">Tambah Data</button>
                    <a href="{{ route('mou.export') }}" class="btn btn-success">Export Excel</a>

                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="MouTable">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nomor MoU</th>
                                <th class="text-center">Pihak 1</th>
                                <th class="text-center">Pihak 2</th>
                                <th class="text-center">Tanggal Mulai</th>
                                <th class="text-center">Tanggal Berakhir</th>
                                <th class="text-center">Tahun</th>
                                <th class="text-center">Jenis Kerjasama</th>
                                <th class="text-center">File MoU</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mous as $index => $mou)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td class="text-center">{{ $mou->no_mou }}</td>
                                    <td class="text-center">{{ $mou->pihak_1 }}</td>
                                    <td class="text-center">{{ $mou->pihak_2 }}</td>
                                    <td class="text-center">{{ $mou->tanggal_mulai }}</td>
                                    <td class="text-center">{{ $mou->tanggal_berakhir }}</td>
                                    <td class="text-center">{{ $mou->tahunAkademik->tahun ?? '-' }}
                                        {{ $mou->tahunAkademik->ganjil_genap ?? '-' }}</td>
                                    <td class="text-center">{{ $mou->jenis_kerjasama }}</td>
                                    <td class="text-center">
                                        <a href="{{ asset('storage/' . $mou->file_mou) }}" target="_blank"
                                            class="btn btn-outline-info btn-sm">
                                            <i class="fas fa-file-alt"></i> Lihat File MoU
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-sm btn-outline-warning"
                                                onclick="editMou(`{{ $mou->id_mou }}`, `{{ $mou->no_mou }}`, `{{ $mou->pihak_1 }}`, `{{ $mou->pihak_2 }}`, `{{ $mou->tanggal_mulai }}`, `{{ $mou->tanggal_berakhir }}`, `{{ $mou->tahunAkademik->id_tahun_akademik ?? '' }}`, `{{ $mou->jenis_kerjasama }}`, `{{ $mou->kontak }}`, `{{ asset('storage/' . $mou->file_mou) }}`)">
                                                <i class="fas fa-edit"></i>
                                            </button>

                                            <button class="btn btn-outline-danger btn-sm"
                                                onclick="confirmDelete('{{ $mou->id_mou }}', '{{ $mou->no_mou }}')">
                                                <i class="fas fa-trash-alt"></i>
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
        <form id="deleteForm" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    </div>

    @include('mou.create')
    @include('mou.edit')
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            let table = $('#MouTable').DataTable({
                "searching": true,
                "lengthChange": true,
                "pageLength": 10,
                "language": {
                    "zeroRecords": "Data tidak ditemukan",
                    "infoEmpty": "Tidak ada data",
                }
            });

            $('#searchInput').on('keyup', function() {
                table.search(this.value).draw();
            });

            $('#entriesSelect').on('change', function() {
                table.page.len(this.value).draw();
            });
        });

        function editMou(id_mou, no_mou, pihak_1, pihak_2, tanggal_mulai, tanggal_berakhir, id_tahun_akademik,
            jenis_kerjasama, kontak, file_mou) {
            // Isi nilai ke input
            $('#edit_id_mou').val(id_mou);
            $('#edit_no_mou').val(no_mou);
            $('#edit_pihak_1').val(pihak_1);
            $('#edit_pihak_2').val(pihak_2);
            $('#edit_tanggal_mulai').val(tanggal_mulai);
            $('#edit_tanggal_berakhir').val(tanggal_berakhir);
            $('#edit_jenis_kerjasama').val(jenis_kerjasama);
            $('#edit_kontak').val(kontak);

            // Set dropdown tahun akademik
            const tahunDropdown = $('#edit_tahun');
            if (id_tahun_akademik && tahunDropdown.find(`option[value="${id_tahun_akademik}"]`).length > 0) {
                tahunDropdown.val(id_tahun_akademik);
            } else {
                tahunDropdown.val('');
            }

            // Tampilkan link file jika ada
            const dokLink = $('#edit_file_mou_link');
            if (file_mou) {
                dokLink.attr("href", file_mou).text("Lihat File MoU").show();
            } else {
                dokLink.text("Tidak ada dokumen").attr("href", "#").hide();
            }

            // Set action form dan reset file input
            $('#editMoUForm').attr("action", `/mou/${id_mou}`);
            $('#edit_file_mou').val('');

            // Tampilkan modal
            $('#editMoUModal').modal('show');
        }

        function confirmDelete(id_mou, no_mou) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data MoU dengan nomor " + no_mou + " akan dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    let form = document.getElementById('deleteForm');
                    form.action = "/mou/" + id_mou;
                    form.submit();
                }
            });
        }
    </script>
@endpush
