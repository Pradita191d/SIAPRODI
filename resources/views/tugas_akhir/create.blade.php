<div class="modal fade" id="tambahTAModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Tugas Akhir</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('tugas_akhir.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nim" class="form-label fw-bold">Nama Mahasiswa / NIM</label>
                                <select class="form-control select2" id="nim" name="nim" required>
                                    <option value="" disabled selected>Cari Mahasiswa...</option>
                                    @foreach (\App\Models\Mahasiswa::orderBy('nim', 'asc')->get() as $mhs)
                                        <option value="{{ $mhs->nim }}">{{ $mhs->nama_mahasiswa }}
                                            ({{ $mhs->nim }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="judul_ta">Judul TA</label>
                                <input type="text" class="form-control" id="judul_ta" name="judul_ta" required>
                            </div>

                            <div class="form-group">
                                <label for="sk_penguji_proposal">SK Penguji Proposal</label>
                                <input type="text" class="form-control" id="sk_penguji_proposal"
                                    name="sk_penguji_proposal" required>
                            </div>

                            <div class="form-group">
                                <label for="dosen_pengprop_1" class="form-label fw-bold">Dosen Penguji Proposal
                                    1</label>
                                <select class="form-control select2" id="dosen_pengprop_1" name="dosen_pengprop_1"
                                    required>
                                    <option value="" disabled selected>Cari Dosen...</option>
                                    @foreach (\App\Models\Dosen::orderBy('nidn', 'asc')->get() as $dsn)
                                        <option value="{{ $dsn->nidn }}">{{ $dsn->nama_dosen }} ({{ $dsn->nidn }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="dosen_pengprop_2" class="form-label fw-bold">Dosen Penguji Proposal
                                    2</label>
                                <select class="form-control select2" id="dosen_pengprop_2" name="dosen_pengprop_2"
                                    required>
                                    <option value="" disabled selected>Cari Dosen...</option>
                                    @foreach (\App\Models\Dosen::orderBy('nidn', 'asc')->get() as $dsn)
                                        <option value="{{ $dsn->nidn }}">{{ $dsn->nama_dosen }} ({{ $dsn->nidn }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="sk_pembimbing_ta">SK Pembimbing TA</label>
                                <input type="text" class="form-control" id="sk_pembimbing_ta" name="sk_pembimbing_ta"
                                    required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="dosen_pemta_1" class="form-label fw-bold">Dosen Pembimbing TA 1</label>
                                <select class="form-control select2" id="dosen_pemta_1" name="dosen_pemta_1" required>
                                    <option value="" disabled selected>Cari Dosen...</option>
                                    @foreach (\App\Models\Dosen::orderBy('nidn', 'asc')->get() as $dsn)
                                        <option value="{{ $dsn->nidn }}">{{ $dsn->nama_dosen }}
                                            ({{ $dsn->nidn }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="dosen_pemta_2" class="form-label fw-bold">Dosen Pembimbing TA 2</label>
                                <select class="form-control select2" id="dosen_pemta_2" name="dosen_pemta_2" required>
                                    <option value="" disabled selected>Cari Dosen...</option>
                                    @foreach (\App\Models\Dosen::orderBy('nidn', 'asc')->get() as $dsn)
                                        <option value="{{ $dsn->nidn }}">{{ $dsn->nama_dosen }}
                                            ({{ $dsn->nidn }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="sk_penguji_ta">SK Penguji TA</label>
                                <input type="text" class="form-control" id="sk_penguji_ta" name="sk_penguji_ta"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="dosen_pengta_1" class="form-label fw-bold">Dosen Penguji TA 1</label>
                                <select class="form-control select2" id="dosen_pengta_1" name="dosen_pengta_1" required>
                                    <option value="" disabled selected>Cari Dosen...</option>
                                    @foreach (\App\Models\Dosen::orderBy('nidn', 'asc')->get() as $dsn)
                                        <option value="{{ $dsn->nidn }}">{{ $dsn->nama_dosen }}
                                            ({{ $dsn->nidn }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="dosen_pengta_2" class="form-label fw-bold">Dosen Penguji TA 2</label>
                                <select class="form-control select2" id="dosen_pengta_2" name="dosen_pengta_2" required>
                                    <option value="" disabled selected>Cari Dosen...</option>
                                    @foreach (\App\Models\Dosen::orderBy('nidn', 'asc')->get() as $dsn)
                                        <option value="{{ $dsn->nidn }}">{{ $dsn->nama_dosen }}
                                            ({{ $dsn->nidn }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="nilai_ta">Nilai TA</label>
                                <input type="text" class="form-control" id="nilai_ta" name="nilai_ta" required>
                            </div>

                            <div class="form-group">
                                <label for="tahun_akademik" class="form-label">Tahun Akademik</label>
                                <select name="tahun_akademik"
                                    class="form-control @error('tahun_akademik') is-invalid @enderror" required>
                                    <option value="">Pilih Tahun Akademik</option>
                                    @foreach ($tahunAkademik as $tahun)
                                        <option value="{{ $tahun->id_tahun_akademik }}">{{ $tahun->tahun }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
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


@push('scripts')
    <script>
        $(document).ready(function() {
            $('#tambahTAModal').on('shown.bs.modal', function() {
                $('.select2').select2({
                    dropdownParent: $('#tambahTAModal .modal-content'),
                    allowClear: true,
                    width: '100%'
                });
            });
        });
    </script>
@endpush
