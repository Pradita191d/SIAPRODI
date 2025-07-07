<div class="modal fade" id="editTAModal" tabindex="-1" aria-labelledby="editTAModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Tugas Akhir</h5>
                <button type="button" class="close" onclick="$('#editTAModal').modal('hide')" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editTAForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" id="edit_id_ta" name="id_ta">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_nim" class="fw-bold">Nama Mahasiswa / NIM</label>
                                <select class="form-control select3" id="edit_nim" name="nim" required>
                                    <option value="">-- Pilih Mahasiswa --</option>
                                    @foreach (\App\Models\Mahasiswa::orderBy('nim', 'asc')->get() as $mhs)
                                        <option value="{{ $mhs->nim }}">{{ $mhs->nama_mahasiswa }} ({{ $mhs->nim }})</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="edit_judul_ta">Judul TA</label>
                                <input type="text" class="form-control" id="edit_judul_ta" name="judul_ta" required>
                            </div>

                            <div class="form-group">
                                <label for="edit_sk_penguji_proposal">SK Penguji Proposal</label>
                                <input type="text" class="form-control" id="edit_sk_penguji_proposal" name="sk_penguji_proposal" required>
                            </div>

                            <div class="form-group">
                                <label for="edit_dosen_pengprop_1">Dosen Penguji Proposal 1</label>
                                <select class="form-control select3" id="edit_dosen_pengprop_1" name="dosen_pengprop_1" required>
                                    <option value="">-- Pilih Dosen --</option>
                                    @foreach (\App\Models\Dosen::orderBy('nidn', 'asc')->get() as $dsn)
                                        <option value="{{ $dsn->nidn }}">{{ $dsn->nama_dosen }} ({{ $dsn->nidn }})</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="edit_dosen_pengprop_2">Dosen Penguji Proposal 2</label>
                                <select class="form-control select3" id="edit_dosen_pengprop_2" name="dosen_pengprop_2" required>
                                    <option value="">-- Pilih Dosen --</option>
                                    @foreach (\App\Models\Dosen::orderBy('nidn', 'asc')->get() as $dsn)
                                        <option value="{{ $dsn->nidn }}">{{ $dsn->nama_dosen }} ({{ $dsn->nidn }})</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="edit_sk_pembimbing_ta">SK Pembimbing TA</label>
                                <input type="text" class="form-control" id="edit_sk_pembimbing_ta" name="sk_pembimbing_ta" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_dosen_pemta_1">Dosen Pembimbing TA 1</label>
                                <select class="form-control select3" id="edit_dosen_pemta_1" name="dosen_pemta_1" required>
                                    <option value="">-- Pilih Dosen --</option>
                                    @foreach (\App\Models\Dosen::orderBy('nidn', 'asc')->get() as $dsn)
                                        <option value="{{ $dsn->nidn }}">{{ $dsn->nama_dosen }} ({{ $dsn->nidn }})</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="edit_dosen_pemta_2">Dosen Pembimbing TA 2</label>
                                <select class="form-control select3" id="edit_dosen_pemta_2" name="dosen_pemta_2" required>
                                    <option value="">-- Pilih Dosen --</option>
                                    @foreach (\App\Models\Dosen::orderBy('nidn', 'asc')->get() as $dsn)
                                        <option value="{{ $dsn->nidn }}">{{ $dsn->nama_dosen }} ({{ $dsn->nidn }})</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="edit_sk_penguji_ta">SK Penguji TA</label>
                                <input type="text" class="form-control" id="edit_sk_penguji_ta" name="sk_penguji_ta" required>
                            </div>

                            <div class="form-group">
                                <label for="edit_dosen_pengta_1">Dosen Penguji TA 1</label>
                                <select class="form-control select3" id="edit_dosen_pengta_1" name="dosen_pengta_1" required>
                                    <option value="">-- Pilih Dosen --</option>
                                    @foreach (\App\Models\Dosen::orderBy('nidn', 'asc')->get() as $dsn)
                                        <option value="{{ $dsn->nidn }}">{{ $dsn->nama_dosen }} ({{ $dsn->nidn }})</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="edit_dosen_pengta_2">Dosen Penguji TA 2</label>
                                <select class="form-control select3" id="edit_dosen_pengta_2" name="dosen_pengta_2" required>
                                    <option value="">-- Pilih Dosen --</option>
                                    @foreach (\App\Models\Dosen::orderBy('nidn', 'asc')->get() as $dsn)
                                        <option value="{{ $dsn->nidn }}">{{ $dsn->nama_dosen }} ({{ $dsn->nidn }})</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="edit_nilai_ta">Nilai TA</label>
                                <input type="text" class="form-control" id="edit_nilai_ta" name="nilai_ta" required>
                            </div>

                            <div class="form-group">
                                <label for="edit_tahun_akademik">Tahun Akademik</label>
                                <select id="edit_tahun_akademik" name="tahun_akademik" class="form-control" required>
                                    <option value="">Pilih Tahun Akademik</option>
                                    @foreach (\App\Models\TahunAkademik::orderBy('tahun', 'desc')->get() as $tahun)
                                        <option value="{{ $tahun->id_tahun_akademik }}">{{ $tahun->tahun }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="$('#editTAModal').modal('hide')">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>


@push('scripts')
    <script>
        $(document).ready(function () {
            $('.select3').select2({
                dropdownParent: $('#editTAModal'),
                width: '100%',
                allowClear: true,
            });
        });
    </script>
@endpush
