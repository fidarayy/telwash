<!-- Modal Tambah/Edit Pelanggan -->
<div class="modal fade" id="tambahPelangganModal" tabindex="-1" aria-labelledby="tambahPelangganModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-3 p-4">
            <!-- Modal Header -->
            <div class="d-flex align-items-center mb-2">
                <button type="button" class="btn btn-close me-3" data-bs-dismiss="modal" aria-label="Close"></button>
                <h1 class="modal-title fs-2 fw-bold text-center w-100" id="tambahPelangganModalLabel">
                    {{ isset($edit) ? 'Edit Pelanggan' : 'Tambah Pelanggan' }}
                </h1>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form action="{{ isset($edit) ? '' : route('admin.master_data.customer.store') }}" method="POST" id="customerUpdate">
                    @csrf                   
                    <!-- Nama Pelanggan Field with Icon -->
                    <div class="mb-3 input-group">
                        <span class="input-group-text rounded-pill bg-white border-0">
                            <i class="ti ti-user text-muted fs-2"></i>
                        </span>
                        <input type="text" name="name" id="name" class="form-control rounded-pill @error('name') is-invalid @enderror" 
                               placeholder="Nama Pelanggan" value="{{ old('name', $edit->name ?? '') }}">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Nomor Telepon Field with Icon -->
                    <div class="mb-3 input-group">
                        <span class="input-group-text rounded-pill bg-white border-0">
                            <i class="ti ti-address-book text-muted fs-2"></i>
                        </span>
                        <input type="text" name="phone_number" id="phone_number" class="form-control rounded-pill @error('phone_number') is-invalid @enderror" 
                               placeholder="Nomor Telepon" value="{{ old('phone_number', $edit->phone_number ?? '') }}">
                        @error('phone_number')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="submit" class="btn rounded-pill text-white w-100" style="background-color: #B5A27F;">
                            {{ isset($edit) ? 'Update' : 'Simpan' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
