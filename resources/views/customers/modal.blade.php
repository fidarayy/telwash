<!-- Modal Tambah Pelanggan -->
<div class="modal fade" id="tambahPelangganModal" tabindex="-1" aria-labelledby="tambahPelangganModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-3 p-4">
            <!-- Modal Header -->
            <div class="d-flex align-items-center mb-2">
                <button type="button" class="btn btn-close me-3" data-bs-dismiss="modal" aria-label="Close"></button>
                {{-- <h1 class="modal-title fs-2 fw-bold text-center w-100" id="tambahPelangganModalLabel">Tambah Pelanggan</h1> --}}
                <h1 class="modal-title fs-2 fw-bold text-center w-100" id="tambahPelangganModalLabel">Edit Data</h1>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Nama Pelanggan Field with Icon -->
                <div class="mb-3 input-group">
                    <span class="input-group-text rounded-pill bg-white border-0">
                        <i class="ti ti-user text-muted fs-2"></i>
                    </span>
                    <input type="text" class="form-control rounded-pill" id="namaPelanggan" placeholder="Nama Pelanggan">
                </div>

                <!-- Nomor Telepon Field with Icon -->
                <div class="mb-3 input-group">
                    <span class="input-group-text rounded-pill bg-white border-0">
                        <i class="ti ti-address-book text-muted fs-2"></i>
                    </span>
                    <input type="text" class="form-control rounded-pill" id="nomorTelepon" placeholder="Nomor Telepon">
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn rounded-pill text-white w-100" style="background-color: #B5A27F;">
                    Simpan/Edit
                </button>
            </div>
        </div>
    </div>
</div>
