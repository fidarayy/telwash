<!-- Modal Edit Voucher -->
<div class="modal fade" id="editVoucherModal" tabindex="-1" aria-labelledby="editVoucherModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('voucher.update') }}" id="updateVoucherForm" class="modal-content rounded-3 p-4">
            @csrf
            @method('PUT')

            <input type="hidden" value="{{ auth()->user()->id ?? 1 }}" name="user_id">
            <!-- Modal Header -->
            <div class="d-flex align-items-center mb-4">
                <button type="button" class="btn btn-close me-3" data-bs-dismiss="modal" aria-label="Close"></button>
                <h1 class="modal-title fs-1 fw-bold text-center w-100" id="editVoucherModalLabel">Edit Voucher</h1>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <span class="ps-2 fs-6">Voucher Code: <span id="voucher_code"></span></span>
                <!-- Code Field -->
                <div class="mb-3 align-items-center">
                    <input type="text" name="code" class="form-control rounded-pill" id="voucher_code_input" placeholder="Voucher Code" value="{{ old('code') }}">
                    @error('code')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Discount Field -->
                <div class="mb-3 align-items-center">
                    <input type="number" step="0.01" name="discount" class="form-control rounded-pill" id="discount" placeholder="Discount (%)" value="{{ old('discount') }}">
                    @error('discount')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Minimum Transaction Field -->
                <div class="mb-3 form-group align-items-center">
                    <input type="number" name="min_transaction" class="form-control rounded-pill" id="min_transaction" placeholder="Minimum Transaction" value="{{ old('min_transaction') }}">
                    @error('min_transaction')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Maximum Discount Field -->
                <div class="mb-3 align-items-center">
                    <input type="number" name="max_discount" class="form-control rounded-pill" id="max_discount" placeholder="Maximum Discount" value="{{ old('max_discount') }}">
                    @error('max_discount')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Usage Limit Field -->
                <div class="mb-3 align-items-center">
                    <input type="number" name="usage_limit" class="form-control rounded-pill" id="usage_limit" placeholder="Usage Limit" value="{{ old('usage_limit') }}">
                    @error('usage_limit')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Valid From Field -->
                <div class="mb-3 input-group flex-nowrap">
                    <span class="input-group-text" id="addon-wrapping">Valid From</span>
                    <input type="datetime-local" name="valid_from" class="form-control" id="valid_from" value="{{ old('valid_from') }}">
                    @error('valid_from')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Valid Until Field -->
                <div class="mb-3 input-group flex-nowrap">
                    <span class="input-group-text" id="addon-wrapping">Valid Until</span>
                    <input type="datetime-local" name="valid_until" class="form-control" id="valid_until" value="{{ old('valid_until') }}">
                    @error('valid_until')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Status Field -->
                <div class="mb-3 d-flex align-items-center input-group">
                    <span class="input-group-text" id="addon-wrapping">Status</span>
                    <select class="form-select" name="status" id="status">
                        <option value="" disabled selected>Select Status</option>
                        <option value="Active" {{ old('status') == 'Active' ? 'selected' : '' }}>Active</option>
                        <option value="Inactive" {{ old('status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer d-flex justify-content-center">
                <button type="submit" class="btn rounded-pill text-white w-100" style="background-color: #B5A27F;">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
