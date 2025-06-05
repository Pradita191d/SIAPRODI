@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="h5 font-weight-bold mb-0 mr-3">Daftar Tugas Akhir</h3>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('tugas_akhir.export') }}" class="btn btn-primary">Export Data</a>
                        <button class="btn btn-success ml-1" data-toggle="modal" data-target="#tambahTAModal">Tambah
                            Data</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="tugasAkhirTable">
                        <thead class="bg-primary text-white">
                            <tr class="text-center">
                                <th class="text-center">No</th>
                                <th class="text-center">NIM</th>
                                <th class="text-center">Nama Mahasiswa</th>
                                <th class="text-center">Tahun Akademik</th>
                                {{-- <th class="text-center">SK Penguji Proposal</th>
                                <th class="text-center">Penguji Proposal 1</th>
                                <th class="text-center">Penguji Proposal 2</th>
                                <th class="text-center">SK Pembimbing TA</th>
                                <th class="text-center">Pembimbing TA 1</th>
                                <th class="text-center">Pembimbing TA 2</th>
                                <th class="text-center">SK Penguji TA</th>
                                <th class="text-center">Penguji TA 1</th>
                                <th class="text-center">Penguji TA 2</th> --}}
                                <th class="text-center">Judul TA</th>
                                <th class="text-center">Nilai Angka</th>
                                <th class="text-center">Nilai Huruf</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tugas_akhirs as $index => $tugas_akhir)
                                <tr class="text-center">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $tugas_akhir->nim }}</td>
                                    <td>{{ $tugas_akhir->mahasiswa->nama_mahasiswa ?? '-' }}</td>
                                    <td>{{ $tugas_akhir->tahunAkademik->tahun ?? '-' }}</td>
                                    {{-- <td>{{ $tugas_akhir->sk_penguji_proposal ?? '-' }}</td>
                                    <td>{{ $tugas_akhir->dosen_pengprop_1 ?? '-' }}</td>
                                    <td>{{ $tugas_akhir->dosen_pengprop_2 ?? '-' }}</td>
                                    <td>{{ $tugas_akhir->sk_pembimbing_ta ?? '-' }}</td>
                                    <td>{{ $tugas_akhir->dosen_pemta_1 ?? '-' }}</td>
                                    <td>{{ $tugas_akhir->dosen_pemta_2 ?? '-' }}</td>
                                    <td>{{ $tugas_akhir->sk_penguji_ta ?? '-' }}</td>
                                    <td>{{ $tugas_akhir->dosen_pengta_1 ?? '-' }}</td>
                                    <td>{{ $tugas_akhir->dosen_pengta_2 ?? '-' }}</td> --}}
                                    <td>{{ $tugas_akhir->judul_ta }}</td>
                                    <td>{{ $tugas_akhir->nilai_ta }}</td>
                                    <td>{{ $tugas_akhir->getGrade($tugas_akhir->nilai_ta) }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-1">
                                            <button class="btn btn-sm btn-info text-white"
                                                onclick="showDetailTA({
                                                sk_penguji_proposal: '{{ $tugas_akhir->sk_penguji_proposal ?? '-' }}',
                                                dosen_pengprop_1: '{{ optional($tugas_akhir->dosenPengprop1)->nama_dosen ?? '-' }}',
                                                dosen_pengprop_2: '{{ optional($tugas_akhir->dosenPengprop2)->nama_dosen ?? '-' }}',

                                                sk_pembimbing_ta: '{{ $tugas_akhir->sk_pembimbing_ta ?? '-' }}',
                                                dosen_pemta_1: '{{ optional($tugas_akhir->dosenPemta1)->nama_dosen ?? '-' }}',
                                                dosen_pemta_2: '{{ optional($tugas_akhir->dosenPemta2)->nama_dosen ?? '-' }}',

                                                sk_penguji_ta: '{{ $tugas_akhir->sk_penguji_ta ?? '-' }}',
                                                dosen_pengta_1: '{{ optional($tugas_akhir->dosenPengta1)->nama_dosen ?? '-' }}',
                                                dosen_pengta_2: '{{ optional($tugas_akhir->dosenPengta2)->nama_dosen ?? '-' }}'})">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                                    <path
                                                        d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                                </svg>
                                            </button>

                                            <button class="btn btn-sm btn-warning text-white"
                                                onclick="editTugasAkhir(
                                                '{{ $tugas_akhir->id_ta }}',
                                                '{{ $tugas_akhir->nim }}',
                                                '{{ $tugas_akhir->judul_ta }}',
                                                '{{ $tugas_akhir->nilai_ta }}',
                                                '{{ $tugas_akhir->tahunAkademik->id_tahun_akademik ?? '' }}',
                                                '{{ $tugas_akhir->sk_penguji_proposal }}',
                                                '{{ $tugas_akhir->dosen_pengprop_1 }}',
                                                '{{ $tugas_akhir->dosen_pengprop_2 }}',
                                                '{{ $tugas_akhir->sk_pembimbing_ta }}',
                                                '{{ $tugas_akhir->dosen_pemta_1 }}',
                                                '{{ $tugas_akhir->dosen_pemta_2 }}',
                                                '{{ $tugas_akhir->sk_penguji_ta }}',
                                                '{{ $tugas_akhir->dosen_pengta_1 }}',
                                                '{{ $tugas_akhir->dosen_pengta_2 }}')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                                                </svg>
                                            </button>
                                            <button class="btn btn-sm btn-danger"
                                                onclick="confirmDelete('{{ $tugas_akhir->id_ta }}', '{{ $tugas_akhir->nim }}')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
                                                </svg>
                                                <form id="deleteForm" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
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

    @include('tugas_akhir.create')
    @include('tugas_akhir.edit')
    @include('tugas_akhir.show')
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            let table = $('#tugasAkhirTable').DataTable({
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

        function editTugasAkhir(
            id_ta, nim, judul, nilai_ta, id_tahun_akademik,
            sk_penguji_proposal, dosen_pengprop_1, dosen_pengprop_2,
            sk_pembimbing_ta, dosen_pemta_1, dosen_pemta_2,
            sk_penguji_ta, dosen_pengta_1, dosen_pengta_2
        ) {
            $('#edit_id_ta').val(id_ta);
            $('#edit_judul_ta').val(judul);
            $('#edit_nim').val(nim).trigger("change");
            $('#edit_nilai_ta').val(nilai_ta);

            if (id_tahun_akademik) {
                if ($("#edit_tahun_akademik option[value='" + id_tahun_akademik + "']").length > 0) {
                    $('#edit_tahun_akademik').val(id_tahun_akademik);
                } else {
                    $('#edit_tahun_akademik').val('');
                }
            } else {
                $('#edit_tahun_akademik').val('');
            }

            // Tambahan data baru
            $('#edit_sk_penguji_proposal').val(sk_penguji_proposal);
            $('#edit_dosen_pengprop_1').val(dosen_pengprop_1).trigger("change");
            $('#edit_dosen_pengprop_2').val(dosen_pengprop_2).trigger("change");

            $('#edit_sk_pembimbing_ta').val(sk_pembimbing_ta);
            $('#edit_dosen_pemta_1').val(dosen_pemta_1).trigger("change");
            $('#edit_dosen_pemta_2').val(dosen_pemta_2).trigger("change");

            $('#edit_sk_penguji_ta').val(sk_penguji_ta);
            $('#edit_dosen_pengta_1').val(dosen_pengta_1).trigger("change");
            $('#edit_dosen_pengta_2').val(dosen_pengta_2).trigger("change");

            $('#editTAForm').attr("action", `/tugas_akhir/${id_ta}`);
            $('#editTAModal').modal('show');
        }


        function showDetailTA(data) {
            $('#detail_sk_penguji_proposal').text(data.sk_penguji_proposal || '-');
            $('#detail_dosen_pengprop_1').text(data.dosen_pengprop_1 || '-');
            $('#detail_dosen_pengprop_2').text(data.dosen_pengprop_2 || '-');

            $('#detail_sk_pembimbing_ta').text(data.sk_pembimbing_ta || '-');
            $('#detail_dosen_pemta_1').text(data.dosen_pemta_1 || '-');
            $('#detail_dosen_pemta_2').text(data.dosen_pemta_2 || '-');

            $('#detail_sk_penguji_ta').text(data.sk_penguji_ta || '-');
            $('#detail_dosen_pengta_1').text(data.dosen_pengta_1 || '-');
            $('#detail_dosen_pengta_2').text(data.dosen_pengta_2 || '-');

            $('#detailTAModal').modal('show');
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function confirmDelete(id_ta, nim) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data Tugas Akhir dengan NIM " + nim + " akan dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    let form = document.getElementById('deleteForm');
                    form.action = "/tugas_akhir/" + id_ta;
                    form.submit();
                }
            });
        }
    </script>
@endpush
