<div class="modal fade" id="tambahMouModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah MoU</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('mou.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="no_mou">Nomor MoU</label>
                        <input type="text" class="form-control" id="no_mou" name="no_mou" required>
                    </div>
                    <div class="form-group">
                        <label for="pihak_1">Pihak 1</label>
                        <input type="text" class="form-control" id="pihak_1" name="pihak_1" required>
                    </div>
                    <div class="form-group">
                        <label for="pihak_2">Pihak 2</label>
                        <input type="text" class="form-control" id="pihak_2" name="pihak_2" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_mulai">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_berakhir">Tanggal Berakhir</label>
                        <input type="date" class="form-control" id="tanggal_berakhir" name="tanggal_berakhir"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="tahun">Tahun Akademik</label>
                        <select name="tahun" class="form-control @error('tahun') is-invalid @enderror" required>
                            <option value="">Pilih Tahun</option>
                            @foreach ($tahunAkademik as $tahun)
                                <option value="{{ $tahun->id_tahun_akademik }}">{{ $tahun->tahun }}</option>
                            @endforeach
                        </select>
                        @error('tahun')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="jenis_kerjasama">Jenis Kerjasama</label>
                        <input type="text" class="form-control" id="jenis_kerjasama" name="jenis_kerjasama" required>
                    </div>
                    <div class="form-group">
                        <label for="kontak">Contact Person</label>
                        <input type="text" class="form-control" id="kontak" name="kontak" required>
                    </div>
                    <div class="form-group">
                        <label for="file_mou">Upload MoU (PDF)</label>
                        <input type="file" class="form-control-file" id="file_mou" name="file_mou" accept=".pdf">
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
