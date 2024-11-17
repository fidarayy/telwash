<!-- Modal Edit Data -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="" id="updateForm" class="modal-content rounded-3 p-4">
            @csrf

            <input type="hidden" value="{{ auth()->user()->id ?? 1 }}" name="user_id">
            <!-- Modal Header -->
            <div class="d-flex align-items-center mb-4">
                <button type="button" class="btn btn-close me-3" data-bs-dismiss="modal" aria-label="Close"></button>
                <h1 class="modal-title fs-1 fw-bold text-center w-100" id="editModalLabel">Edit Data</h1>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Customer ID Field -->
                <div class="mb-3 align-items-center">
                    <select name="customer_id" class="form-select rounded-pill select" id="customer_id">
                        <option value="" disabled selected>Pilih Nama Pelanggan</option>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->customer_id }}"
                                {{ old('customer_id') == $customer->customer_id ? 'selected' : '' }}>
                                {{ $customer->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('customer_id')
                        <div class="error-message">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                <!-- Weight Field -->
                <div class="mb-3 align-items-center">
                    <input type="number" step="0.01" name="weight"
                        class="form-control rounded-pill w-10 
                        @error('weight') is-invalid @enderror"
                        id="weight" placeholder="Berat (Kg)" value="{{ old('weight') }}">

                    @error('weight')
                        <div class="error-message">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Price Field -->
                <div class="mb-3 form-group  align-items-center">
                    <input type="text" name="price" class="form-control rounded-pill" id="price"
                        placeholder="Harga" value="{{ old('price') }}">
                    @error('price')
                        <div class="error-message">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                <!-- Finished At Field -->
                <div class="mb-3 input-group flex-nowrap">
                    <span class="input-group-text" id="addon-wrapping">Waktu Selesai</span>
                    <input type="datetime-local" name="finished_at" class="form-control" id="finished_at"
                        value="{{ old('finished_at') }}">
                    @error('finished_at')
                        <div class="error-message">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Received At Field -->
                <div class="mb-3 input-group flex-nowrap">
                    <span class="input-group-text" id="addon-wrapping">Diterima</span>
                    <input type="datetime-local" name="received_at" class="form-control" id="received_at"
                        value="{{ old('received_at') }}">
                    @error('received_at')
                        <div class="error-message">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                <!-- Service Type Field -->
                <div class="mb-3 d-flex align-items-center input-group">
                    <span class="input-group-text" id="addon-wrapping">Jenis Layanan</span>
                    <select class="form-select" name="service_type" id="service_type">
                        <option value="" disabled selected>Pilih Jenis Layanan</option>
                        <option value="Cuci Saja" {{ old('service_type') == 'Cuci Saja' ? 'selected' : '' }}>Cuci Saja
                        </option>
                        <option value="Cuci Dan Setrika"
                            {{ old('service_type') == 'Cuci Dan Setrika' ? 'selected' : '' }}>Cuci Dan Setrika</option>
                        <option value="Express" {{ old('service_type') == 'Express' ? 'selected' : '' }}>Express
                        </option>
                    </select>
                    @error('service_type')
                        <div class="error-message">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Payment Status Field -->
                <div class="mb-3 d-flex align-items-center input-group">
                    <span class="input-group-text" id="addon-wrapping">Payment Status</span>
                    <select class="form-select" name="payment_status" id="payment_status">
                        <option value="" disabled selected>Pilih Payment</option>
                        <option value="Lunas" {{ old('payment_status') == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                        <option value="Belum Dibayar" {{ old('payment_status') == 'Belum Dibayar' ? 'selected' : '' }}>
                            Belum</option>
                        <option value="DP" {{ old('payment_status') == 'DP' ? 'selected' : '' }}>DP</option>
                    </select>
                    @error('payment_status')
                        <div class="error-message">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Unit Type Field -->
                <div class="mb-3 d-flex align-items-center input-group">
                    <span class="input-group-text" id="addon-wrapping">Unit Type</span>
                    <select class="form-select" name="unit_type" id="unit_type">
                        <option value="" disabled selected>Pilih Unit Type</option>
                        <option value="Kilogram" {{ old('unit_type') == 'Kilogram' ? 'selected' : '' }}>Kilogram
                        </option>
                        <option value="Satuan" {{ old('unit_type') == 'Satuan' ? 'selected' : '' }}>Satuan</option>
                    </select>
                    @error('unit_type')
                        <div class="error-message">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Status Field -->
                <div class="mb-3 d-flex align-items-center input-group">
                    <span class="input-group-text" id="addon-wrapping">Status</span>
                    <select class="form-select" name="status" id="status">
                        <option value="" disabled selected>Pilih Status</option>
                        <option value="Diterima" {{ old('status') == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                        <option value="Diproses" {{ old('status') == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="Selesai" {{ old('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="Diambil" {{ old('status') == 'Diambil' ? 'selected' : '' }}>Diambil</option>
                    </select>
                    @error('status')
                        <div class="error-message">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3 d-flex align-items-center input-group">
                    <span class="input-group-text" id="addon-wrapping">Payment Method</span>
                    <select class="form-select" name="payment_method" id="payment_method">
                        <option value="" disabled selected>Pilih Status</option>
                        <option value="Cash" {{ old('payment_method') == 'Cash' ? 'selected' : '' }}>Cash</option>
                        <option value="Qris" {{ old('payment_method') == 'Qris' ? 'selected' : '' }}>Qris</option>
                        <option value="E_wallet" {{ old('payment_method') == 'E_wallet' ? 'selected' : '' }}>E Wallet
                        </option>
                    </select>
                    @error('payment_method')
                        <div class="error-message">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer d-flex justify-content-center">
                <button type="submit" class="btn rounded-pill text-white w-100" style="background-color: #B5A27F;">
                    Edit
                </button>
            </div>
        </form>
    </div>
</div>
