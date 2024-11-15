<!-- Modal Edit Data -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded-3 p-4">
            <!-- Modal Header -->
            <div class="d-flex align-items-center mb-4">
                <button type="button" class="btn btn-close me-3" data-bs-dismiss="modal" aria-label="Close"></button>
                <h1 class="modal-title fs-1 fw-bold text-center w-100" id="editModalLabel">Edit Data</h1>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <span class="ps-2 fs-6">Id Transaksi : 0190918409</span>
                <!-- Form Input Fields -->
                <div class="mb-3 d-flex align-items-center">
                    <input type="text" class="form-control rounded-pill" id="customerName" placeholder="Nama Pelanggan">
                </div>

                <div class="mb-3 d-flex align-items-center">
                    <input type="text" class="form-control rounded-pill" id="phoneNumber" placeholder="No Telepon">
                </div>

                <div class="mb-3 d-flex align-items-center">
                    <input type="number" step="0.01" class="form-control rounded-pill" id="weight" placeholder="Berat (Kg)">
                </div>

                <div class="mb-3 d-flex align-items-center">
                    <input type="text" class="form-control rounded-pill" id="price" placeholder="Harga">
                </div>

                <!-- Waktu Selesai dengan Input Group -->
                <div class="mb-3 input-group flex-nowrap">
                    <span class="input-group-text" id="addon-wrapping">Waktu Selesai</span>
                    <input type="datetime-local" class="form-control">
                </div>

                <!-- Diterima dengan Input Group -->
                <div class="mb-3 input-group flex-nowrap">
                    <span class="input-group-text" id="addon-wrapping">Diterima</span>
                    <input type="datetime-local" class="form-control">
                </div>

                <!-- Dropdown Payment Status -->
                <div class="mb-3 d-flex align-items-center input-group">
                    <span class="input-group-text" id="addon-wrapping">Jenis Layanan</span>
                    <select class="form-select" id="jenisLayanan">
                        <option value="" disabled selected>Pilih Jenis Layanan</option>
                        <option value="Cuci Saja">Cuci Saja</option>
                        <option value="Cuci Dan Setrika">Cuci Dan Setrika</option>
                        <option value="Express">Express</option>
                    </select>
                </div>

                <!-- Dropdown Payment Status -->
                <div class="mb-3 d-flex align-items-center input-group">
                    <span class="input-group-text" id="addon-wrapping">Payment Status</span>
                    <select class="form-select" id="paymentStatus">
                        <option value="" disabled selected>Pilih Payment</option>
                        <option value="Lunas">Lunas</option>
                        <option value="Belum Dibayar">Belum</option>
                        <option value="DP">DP</option>
                    </select>
                </div>

                <!-- Dropdown Status -->
                <div class="mb-3 d-flex align-items-center input-group">
                    <span class="input-group-text" id="addon-wrapping">Status</span>
                    <select class="form-select" id="status">
                        <option value="" disabled selected>Pilih Status</option>
                        <option value="Diterima">Diterima</option>
                        <option value="Diproses">Diproses</option>
                        <option value="Selesai">Selesai</option>
                        <option value="Diambil">Diambil</option>
                    </select>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn rounded-pill text-white w-100" style="background-color: #B5A27F;">
                    Edit
                </button>
            </div>
        </div>
    </div>
</div>
