<div class="modal fade" id="tambahTAModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
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
                    <div class="form-group">
                        <label for="nim" class="form-label fw-bold">Nama Mahasiswa / NIM</label>
                        <select class="form-control select2" id="nim" name="nim" required>
                            <option value="" disabled selected>Cari Mahasiswa...</option>
                            @foreach (\App\Models\Mahasiswa::orderBy('nim', 'asc')->get() as $mhs)
                                <option value="{{ $mhs->nim }}">
                                    {{ $mhs->nama_mahasiswa }} ({{ $mhs->nim }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="judul_ta">Judul TA</label>
                        <input type="text" class="form-control" id="judul_ta" name="judul_ta" required>
                    </div>

                    <div class="form-group">
                        <label for="nilai_ta">Nilai TA</label>
                        <input type="text" class="form-control" id="nilai_ta" name="nilai_ta" required>
                    </div>

                    <div class="form-group">
                        <label for="tahun_akademik" class="form-label">Tahun Akademik</label>
                        <select name="tahun_akademik" class="form-control @error('tahun_akademik') is-invalid @enderror"
                            required>
                            <option value="">Pilih Tahun Akademik</option>
                            @foreach ($tahunAkademik as $tahun)
                                <option value="{{ $tahun->id_tahun_akademik }}">{{ $tahun->tahun }}</option>
                            @endforeach
                        </select>
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
            $('.select2').select2({
                dropdownParent: $('#tambahTAModal'),
                placeholder: '-- Pilih Mahasiswa --',
                allowClear: true,
                width: '100%',
                heigh: '100%',
            });
        });
    </script>
@endpush

