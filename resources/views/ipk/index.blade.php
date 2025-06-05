@extends('layouts.app')

@section('content')
    <div>
        <div class="card">
            <div class="card-header bg-white text-dark">
                <h5 class="mb-0"><b>Daftar IPK Mahasiswa</b></h5>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped w-100" id="ipk-table">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">NIM</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">
                                    <select id="filter-tahun" class="form-control">
                                        <option value="">Semua Tahun</option>
                                        @foreach ($tahun_akademik as $item)
                                            <option value="{{ $item->id_tahun_akademik }}">
                                                {{ $item->tahun }}/{{ $item->ganjil_genap }}
                                            </option>
                                        @endforeach
                                    </select>
                                </th>
                                <th class="text-center">IPK</th>
                                <th class="text-center">Keterangan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mahasiswas as $index => $mhs)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td class="text-center">{{ $mhs->nim }}</td>
                                    <td>{{ $mhs->nama_mahasiswa }}</td>
                                    <td class="text-center">
                                        {{ $mhs->tahunAkademik->tahun ?? '-' }}/{{ $mhs->tahunAkademik->ganjil_genap ?? '-' }}
                                    </td>
                                    <td class="text-center">{{ $mhs->ipk->ipk ?? '-' }}</td>
                                    <td class="text-center">
                                        @php
                                            $ipk = $mhs->ipk->ipk ?? null;
                                        @endphp
                                        @if (is_null($ipk))
                                            -
                                        @elseif ($ipk > 3.5)
                                            <span class="badge bg-success">Cumlaude</span>
                                        @elseif ($ipk >= 3.01 && $ipk <= 3.5)
                                            <span class="badge bg-primary">Sangat Memuaskan</span>
                                        @elseif ($ipk >= 2.76 && $ipk <= 3.0)
                                            <span class="badge bg-info">Memuaskan</span>
                                        @else
                                            <span class="badge bg-warning">Kurang</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if (is_null($mhs->ipk))
                                            <button
                                                onclick="openInputIpkModal('{{ $mhs->nim }}', '{{ $mhs->nama_mahasiswa }}')"
                                                class="btn btn-sm btn-success">Input IPK</button>
                                        @else
                                            <button onclick="editIpk({{ $mhs->ipk->id_ipk }})"
                                                class="btn btn-sm btn-warning"><i class="fas fa-pen"></i></button>
                                            <button onclick="deleteIpk({{ $mhs->ipk->id_ipk }})"
                                                class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>

            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header bg-white text-dark">
                <h5 class="mb-0">Rekapan IPK Mahasiswa</h5>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <!-- Keterangan IPK -->
                    <div class="col-md-4">
                        <div class="border rounded p-3 bg-light shadow-sm h-100">
                            <strong class="d-block mb-2">Keterangan IPK</strong>
                            <ul class="mb-0" style="list-style: none; padding-left: 0;">
                                <li><span class="badge bg-success me-2">&nbsp;</span> Cumlaude (&gt; 3.50)</li>
                                <li><span class="badge bg-primary me-2">&nbsp;</span> Sangat Memuaskan (3.01 - 3.50)</li>
                                <li><span class="badge bg-info text-dark me-2">&nbsp;</span> Memuaskan (2.76 - 3.00)</li>
                                <li><span class="badge bg-warning text-dark me-2">&nbsp;</span> Kurang (≤ 2.75)</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Tabel Rekap IPK -->
                    <div class="col-md-8">
                        <table class="table table-bordered table-striped w-100">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th class="text-center">Kategori</th>
                                    <th class="text-center">Jumlah Mahasiswa</th>
                                    <th class="text-center">Persentase</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">IPK ≥ 3.50</td>
                                    <td class="text-center" id="jumlahCumlaude">0</td>
                                    <td class="text-center" id="persentaseCumlaude">0 %</td>
                                </tr>
                                <tr>
                                    <td class="text-center">IPK &lt; 3.0</td>
                                    <td class="text-center" id="jumlahPerluPerbaikan">0</td>
                                    <td class="text-center" id="persentasePerluPerbaikan">0 %</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Modal Input IPK -->
    <div class="modal fade" id="inputIpkModal" tabindex="-1" aria-labelledby="inputIpkModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="inputIpkModalLabel">Input IPK</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="inputIpkForm" action="{{ route('ipk.input') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="nim" class="form-label">NIM</label>
                            <input type="text" class="form-control" id="nim" name="nim" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="nama_mahasiswa" class="form-label">Nama Mahasiswa</label>
                            <input type="text" class="form-control" id="nama_mahasiswa" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="ipk" class="form-label">IPK</label>
                            <input type="number" step="0.01" class="form-control" id="ipk" name="ipk"
                                required>
                            <div id="ipkError" class="invalid-feedback" style="display: none;">
                                IPK tidak boleh lebih dari 4.00
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" form="inputIpkForm" id="save-button"
                        disabled>Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit IPK -->
    <div class="modal fade" id="editIpkModal" tabindex="-1" aria-labelledby="editIpkModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editIpkModalLabel">Edit IPK</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editIpkForm" action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="edit_id_ipk" name="id_ipk">
                        <div class="mb-3">
                            <label for="edit_nim" class="form-label">NIM</label>
                            <input type="text" class="form-control" id="edit_nim" name="nim" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="edit_nama_mahasiswa" class="form-label">Nama Mahasiswa</label>
                            <input type="text" class="form-control" id="edit_nama_mahasiswa" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="edit_ipk" class="form-label">IPK</label>
                            <input type="number" step="0.01" class="form-control" id="edit_ipk" name="ipk"
                                required>
                            <div id="ipkErrore" class="invalid-feedback" style="display: none;">
                                IPK tidak boleh lebih dari 4.00
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" form="editIpkForm" id="update-button">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus data IPK ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form id="deleteForm" method="POST">
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
        // Buat mapping ID ke "tahun/ganjil_genap"
        var tahunAkademikMap = @json(
            $tahun_akademik->mapWithKeys(function ($item) {
                return [$item->id_tahun_akademik => $item->tahun . '/' . $item->ganjil_genap];
            }));
    </script>

    <script>
        $(document).ready(function() {
            var table = $('#ipk-table').DataTable({
                responsive: true,
                paging: true,
                ordering: true,
                info: true,
                lengthMenu: [10, 25, 50, 100],
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                    paginate: {
                        first: "Awal",
                        last: "Akhir",
                        next: "→",
                        previous: "←"
                    }
                },
                columnDefs: [{
                        orderable: false,
                        targets: 3 // kolom ke-4 tidak bisa diurutkan
                    },
                    {
                        searchable: true,
                        targets: [1, 2] // hanya kolom ke-2 dan ke-3 yang bisa dicari
                    },
                    {
                        searchable: false,
                        targets: "_all" // selain kolom 1 dan 2, nonaktifkan search
                    }
                ]
            });

                $('.dataTables_filter input[type="search"]').attr('placeholder', 'Cari nama atau nim');

            // Debug fungsi filter custom
            $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
                var selectedId = $('#filter-tahun').val();
                var tahunKolom = data[3]; // ganti 3 dengan index kolom tahun yang sesuai

                if (selectedId === "") {
                    return true;
                }


                if (tahunAkademikMap[selectedId] === tahunKolom) {
                    return true;
                }

                return false;
            });


            // Ketika filter tahun berubah, redraw table (tanpa reload page)
            $('#filter-tahun').on('change', function() {
                table.draw();
                updateRekapitulasi(); // kalau ada fungsi ini tetap panggil
            });
        });

        //DataTable


        function updateRekapitulasi() {
            $.ajax({
                url: "{{ route('ipk.rekapitulasi') }}",
                type: "GET",
                data: {
                    tahun_masuk: $('#filter-tahun').val()
                },
                success: function(response) {
                    $('#jumlahCumlaude').text(response.jumlahCumlaude);
                    $('#persentaseCumlaude').text(response.persentaseCumlaude + '%');
                    $('#jumlahPerluPerbaikan').text(response.jumlahPerluPerbaikan);
                    $('#persentasePerluPerbaikan').text(response.persentasePerluPerbaikan + '%');
                }
            });
        }

        updateRekapitulasi();

        //input modal trigger
        function openInputIpkModal(nim, nama) {
            document.getElementById('nim').value = nim;
            document.getElementById('nama_mahasiswa').value = nama;
            new bootstrap.Modal(document.getElementById('inputIpkModal')).show();
        }

        //edit modal trigger
        function editIpk(id) {
            fetch(`/ipk/${id}/edit`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('edit_id_ipk').value = data.id_ipk;
                    document.getElementById('edit_nim').value = data.nim;
                    document.getElementById('edit_nama_mahasiswa').value = data.nama_mahasiswa;
                    document.getElementById('edit_ipk').value = data.ipk;
                    document.getElementById('edit_ipk').classList.remove("is-invalid");

                    document.getElementById('editIpkForm').action = `/ipk/${data.id_ipk}`;

                    new bootstrap.Modal(document.getElementById('editIpkModal')).show();
                })
                .catch(error => console.error('Error:', error));
        }

        //input trigger
        document.addEventListener("DOMContentLoaded", function() {
            const ipkInput = document.getElementById("ipk");
            const saveButton = document.getElementById("save-button");
            const ipkError = document.getElementById('ipkError');

            let isInputTouched = false;

            ipkInput.addEventListener("input", function() {
                const ipkValue = ipkInput.value.trim();

                if (!isInputTouched) {
                    isInputTouched = true;
                }

                if (ipkValue === "") {
                    if (isInputTouched) {
                        saveButton.disabled = true;
                        ipkInput.classList.add("is-invalid");
                        ipkError.textContent = "Data tidak boleh kosong.";
                        ipkError.style.display = 'block';
                    }
                } else {
                    const numericValue = parseFloat(ipkValue);

                    if (isNaN(numericValue) || numericValue < 0 || numericValue > 4) {
                        saveButton.disabled = true;
                        ipkInput.classList.add("is-invalid");
                        ipkError.textContent = "IPK tidak boleh lebih dari 4.00";
                        ipkError.style.display = 'block';
                    } else {
                        saveButton.disabled = false;
                        ipkInput.classList.remove("is-invalid");
                        ipkError.style.display = 'none';
                    }
                }
            });

            // Reset state saat modal ditutup
            document.getElementById('inputIpkModal').addEventListener('hidden.bs.modal', function() {
                ipkInput.value = "";
                ipkInput.classList.remove("is-invalid");
                ipkError.style.display = 'none';
                saveButton.disabled = true;
                isInputTouched = false;
            });
        });

        //edit trigger
        document.addEventListener("DOMContentLoaded", function() {
            const ipkInput = document.getElementById("edit_ipk");
            const saveButton = document.getElementById("update-button");
            const ipkError = document.getElementById('ipkErrore');

            let isInputTouched = false;

            ipkInput.addEventListener("input", function() {
                const ipkValue = ipkInput.value.trim();

                if (!isInputTouched) {
                    isInputTouched = true;
                }

                if (ipkValue === "") {
                    if (isInputTouched) {
                        saveButton.disabled = true;
                        ipkInput.classList.add("is-invalid");
                        ipkError.textContent = "Data tidak boleh kosong.";
                        ipkError.style.display = 'block';
                    }
                } else {
                    const numericValue = parseFloat(ipkValue);

                    if (isNaN(numericValue) || numericValue < 0 || numericValue > 4) {
                        saveButton.disabled = true;
                        ipkInput.classList.add("is-invalid");
                        ipkError.textContent = "IPK tidak boleh lebih dari 4.00";
                        ipkError.style.display = 'block';
                    } else {
                        saveButton.disabled = false;
                        ipkInput.classList.remove("is-invalid");
                        ipkError.style.display = 'none';
                    }
                }
            });

            document.getElementById('inputIpkModal').addEventListener('hidden.bs.modal', function() {
                ipkInput.value = "";
                ipkInput.classList.remove("is-invalid");
                ipkError.style.display = 'none';
                saveButton.disabled = true;
                isInputTouched = false;
            });
        });

        //trigger delete
        function deleteIpk(id) {
            const deleteForm = document.getElementById('deleteForm');
            deleteForm.action = "{{ url('ipk') }}/" + id;
            const confirmDeleteModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
            confirmDeleteModal.show();
        }
    </script>
@endpush
