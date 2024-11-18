<!-- Modal Edit Voucher -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editVoucherModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="" id="updateVoucherForm" class="modal-content rounded-3 p-4">
            @csrf

            <input type="hidden" value="{{ auth()->user()->id ?? 1 }}" name="user_id">
            <!-- Modal Header -->
            <div class="d-flex align-items-center mb-4">
                <button type="button" class="btn btn-close me-3" data-bs-dismiss="modal" aria-label="Close"></button>
                <h1 class="modal-title fs-1 fw-bold text-center w-100" id="editVoucherModalLabel">Edit Voucher</h1>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">                                
                <!-- Code Field -->
                <div class="mb-3">
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="info-voucher-code">Kode</span>
                        <input type="text" name="code" class="form-control" id="code" placeholder="Kode Voucher" value="{{ old('code') }}">
                    </div>
                    @error('code')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Discount Field -->
                <div class="mb-3">
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="info-discount">Diskon</span>
                        <input type="number" step="0.01" name="discount" class="form-control" id="discount" placeholder="Diskon (%)" value="{{ old('discount') }}">
                    </div>
                    @error('discount')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Minimum Transaction Field -->
                <div class="mb-3">
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="info-min-transaction">Min Transaksi</span>
                        <input type="number" name="min_transaction" class="form-control" id="min_transaction" placeholder="Min Transaksi" value="{{ old('min_transaction') }}">
                    </div>
                    @error('min_transaction')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Maximum Discount Field -->
                <div class="mb-3">
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="info-max-discount">Max Diskon</span>
                        <input type="number" name="max_discount" class="form-control" id="max_discount" placeholder="Max Diskon" value="{{ old('max_discount') }}">
                    </div>
                    @error('max_discount')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Usage Limit Field -->
                <div class="mb-3">
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="info-usage-limit">Batas Pakai</span>
                        <input type="number" name="usage_limit" class="form-control" id="usage_limit" placeholder="Batas Pakai" value="{{ old('usage_limit') }}">
                    </div>
                    @error('usage_limit')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Valid From Field -->
                <div class="mb-3">
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="info-valid-from">Berlaku Dari</span>
                        <input type="datetime-local" name="valid_from" class="form-control" id="valid_from" value="{{ old('valid_from') }}">
                    </div>
                    @error('valid_from')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Valid Until Field -->
                <div class="mb-3">
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="info-valid-until">Berlaku Sampai</span>
                        <input type="datetime-local" name="valid_until" class="form-control" id="valid_until" value="{{ old('valid_until') }}">
                    </div>
                    @error('valid_until')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer d-flex justify-content-center">
                <button type="submit" class="btn text-white w-100" style="background-color: #B5A27F;">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
