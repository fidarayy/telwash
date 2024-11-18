@push('css')
    <style>
        body {
        font-family: "Poppins", sans-serif;
        font-weight: 400;
        font-style: normal;
    }

    .header {
        background-color: #C8B891;
        padding: 10px 20px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    }

    .logout-btn {
        background-color: black;
        color: white;
        border-radius: 20px;
        transition: background-color 0.3s ease;
    }

    .logout-btn:hover {
        background-color: rgb(54, 54, 54);
        color: white;
    }
    </style>
@endpush

<x-layout>
    <main class="container d-flex justify-content-center mt-5" style="min-height: 100vh;">
        <div class="row justify-content-center w-100">
            <div class="col-12 col-md-10 col-lg-10">
                <div class="card p-4" style="background-color: #F9F3E9; border: 2px solid #8A847A; border-radius: 8px;">
                <div>
                    <a href="{{ route('admin.master_data.voucher.index') }}">
                        <button class="btn btn-md">
                            <i class="ti ti-arrow-left fs-1"></i>
                        </button>
                    </a>
                    <h2 class="text-center mb-4 fw-bold" style="color: #705E46;">Buat Voucher</h2>
                </div>
                    <form action="{{ route('admin.master_data.voucher.store') }}" method="POST">
                        @csrf

                        <!-- Voucher Code -->
                        <div class="mb-3">
                            <label for="code" class="form-label fw-bold" style="color: #705E46;">Kode Voucher</label>
                            <input type="text" id="code" name="code" class="form-control @error('code') is-invalid @enderror" 
                                   style="background-color: #C8B891; border: none;" value="{{ old('code') }}">
                            @error('code')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Discount -->
                        <div class="mb-3">
                            <label for="discount" class="form-label fw-bold" style="color: #705E46;">Diskon (%)</label>
                            <input type="number" id="discount" name="discount" class="form-control @error('discount') is-invalid @enderror" 
                                   style="background-color: #C8B891; border: none;" step="0.01" min="0" max="100" value="{{ old('discount') }}">
                            @error('discount')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Minimum Transaction -->
                        <div class="mb-3">
                            <label for="min_transaction" class="form-label fw-bold" style="color: #705E46;">Transaksi Minimum</label>
                            <input type="number" id="min_transaction" name="min_transaction" class="form-control @error('min_transaction') is-invalid @enderror" 
                                   style="background-color: #C8B891; border: none;" step="0.01" min="0" value="{{ old('min_transaction') }}">
                            @error('min_transaction')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Maximum Discount -->
                        <div class="mb-3">
                            <label for="max_discount" class="form-label fw-bold" style="color: #705E46;">Maksimal Diskon</label>
                            <input type="number" id="max_discount" name="max_discount" class="form-control @error('max_discount') is-invalid @enderror" 
                                   style="background-color: #C8B891; border: none;" step="0.01" min="0" value="{{ old('max_discount') }}">
                            @error('max_discount')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Usage Limit -->
                        <div class="mb-3">
                            <label for="usage_limit" class="form-label fw-bold" style="color: #705E46;">Batas Penggunaan</label>
                            <input type="number" id="usage_limit" name="usage_limit" class="form-control @error('usage_limit') is-invalid @enderror" 
                                   style="background-color: #C8B891; border: none;" min="1" value="{{ old('usage_limit') }}">
                            @error('usage_limit')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Product -->
                        <div class="mb-3">
                            <label for="product" class="form-label fw-bold" style="color: #705E46;">Produk</label>
                            <input type="text" id="product" name="product" class="form-control @error('product') is-invalid @enderror" 
                                   style="background-color: #C8B891; border: none;" placeholder="Opsional" value="{{ old('product') }}">
                            @error('product')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Valid From -->
                        <div class="mb-3">
                            <label for="valid_from" class="form-label fw-bold" style="color: #705E46;">Berlaku Dari</label>
                            <input type="datetime-local" id="valid_from" name="valid_from" class="form-control @error('valid_from') is-invalid @enderror" 
                                   style="background-color: #C8B891; border: none;" value="{{ old('valid_from') }}">
                            @error('valid_from')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Valid Until -->
                        <div class="mb-3">
                            <label for="valid_until" class="form-label fw-bold" style="color: #705E46;">Berlaku Hingga</label>
                            <input type="datetime-local" id="valid_until" name="valid_until" class="form-control @error('valid_until') is-invalid @enderror" 
                                   style="background-color: #C8B891; border: none;" value="{{ old('valid_until') }}">
                            @error('valid_until')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn text-white fw-bold" style="background-color: #705E46;">Buat Voucher</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</x-layout>
