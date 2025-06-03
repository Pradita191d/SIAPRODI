<!-- Modal Edit -->
<div class="modal fade" id="editMoUModal" tabindex="-1" aria-labelledby="tambahMouModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editMouModalLabel">Edit Data MoU</h5>
                <button type="button" class="close" onclick="$('#editMoUModal').modal('hide')" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @isset($mou)

                <form id="editMouForm" action="{{ route('mou.update', $mou->id_mou) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" id="edit_id_mou" name="id_mou">

                        <div class="form-group">
                            <label for="edit_no_mou">Nomor MoU</label>
                            <input type="text" class="form-control" id="edit_no_mou" name="no_mou" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_pihak_1">Pihak 1</label>
                            <input type="text" class="form-control" id="edit_pihak_1" name="pihak_1" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_pihak_2">Pihak 2</label>
                            <input type="text" class="form-control" id="edit_pihak_2" name="pihak_2" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_tanggal_mulai">Tanggal Mulai</label>
                            <input type="date" class="form-control" id="edit_tanggal_mulai" name="tanggal_mulai"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="edit_tanggal_berakhir">Tanggal Berakhir</label>
                            <input type="date" class="form-control" id="edit_tanggal_berakhir" name="tanggal_berakhir"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="edit_tahun">Tahun Akademik</label>
                            <select id="edit_tahun" name="tahun" class="form-control" required>
                                <option value="">Pilih Tahun Akademik</option>
                                @foreach (\App\Models\TahunAkademik::orderBy('tahun', 'desc')->get() as $tahun)
                                    <option value="{{ $tahun->id_tahun_akademik }}">{{ $tahun->tahun }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_jenis_kerjasama">Jenis Kerjasama</label>
                            <input type="text" class="form-control" id="edit_jenis_kerjasama" name="jenis_kerjasama"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="edit_kontak">Contact Person</label>
                            <input type="text" class="form-control" id="edit_kontak" name="kontak" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_file_mou" class="fw-bold">Upload File MoU (PDF)</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="edit_file_mou" name="file_mou"
                                    accept=".pdf">

                                <label class="custom-file-label" for="file_mou">Pilih file...</label>
                            </div>

                            @if ($mou->file_mou)
                                <a id="edit_file_mou_link" href="{{ asset('storage/' . $mou->file_mou) }}" target="_blank">
                                    Lihat Dokumen
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            @endisset

        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            // Ubah label saat file diunggah
            $("#file_mou").on("change", function() {
                let fileName = $(this).val().split("\\").pop();
                $(this).next("small").text(fileName);
            });
        });
    </script>
@endpush
