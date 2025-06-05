<style>
    #detailTAModal table {
        width: 100%;
    }

    #detailTAModal th,
    #detailTAModal td {
        width: 50%;
        padding-top: 4px;
        padding-bottom: 4px;
        vertical-align: middle;
    }
</style>


<div class="modal fade" id="detailTAModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-bold">Detail Tugas Akhir</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Penguji Proposal -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="2" class="bg-secondary text-white text-center">
                                <span class="font-weight-bold mb-2">Penguji Proposal</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Nomor SK</th>
                            <td id="detail_sk_penguji_proposal"></td>
                        </tr>
                        <tr>
                            <th>Penguji Proposal 1</th>
                            <td id="detail_dosen_pengprop_1"></td>
                        </tr>
                        <tr>
                            <th>Penguji Proposal 2</th>
                            <td id="detail_dosen_pengprop_2"></td>
                        </tr>
                    </tbody>
                    {{-- </table>
                <table class="table table-bordered"> --}}
                    <thead>
                        <tr>
                            <th colspan="2" class="bg-secondary text-white text-center">
                                <span class="font-weight-bold mb-2">Pembimbing Tugas Akhir</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Nomor SK</th>
                            <td id="detail_sk_pembimbing_ta"></td>
                        </tr>
                        <tr>
                            <th>Pembimbing Tugas Akhir 1</th>
                            <td id="detail_dosen_pemta_1"></td>
                        </tr>
                        <tr>
                            <th>Pembimbing Tugas Akhir 2</th>
                            <td id="detail_dosen_pemta_2"></td>
                        </tr>
                    </tbody>
                    {{-- </table>
                <table class="table table-bordered"> --}}
                    <thead>
                        <tr>
                            <th colspan="2" class="bg-secondary text-white text-center">
                                <span class="font-weight-bold mb-2">Penguji Tugas Akhir</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Nomor SK</th>
                            <td id="detail_sk_penguji_ta"></td>
                        </tr>
                        <tr>
                            <th>Penguji Tugas Akhir 1</th>
                            <td id="detail_dosen_pengta_1"></td>
                        </tr>
                        <tr>
                            <th>Penguji Tugas Akhir 2</th>
                            <td id="detail_dosen_pengta_2"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
