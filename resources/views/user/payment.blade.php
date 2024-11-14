<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>

<body class="user-payment-body">
    <div class="container mt-5">
        <div class="card mx-auto user-payment-card" style="max-width: 500px;">
            <div class="card-body">
                <h4 class="text-center">Pembayaran</h4>
                <p>Transaksi ID: {{ $transaction->transaction_id }}</p>
                <p>Total Harga: Rp {{ number_format($transaction->price, 0, ',', '.') }}</p>

                <!-- Form Pembayaran -->
                <form action="{{ route('user.payment.process', $transaction->transaction_id) }}" method="POST">
                    @csrf
                    <!-- Pilih Metode Pembayaran -->
                    <div class="mb-3">
                        <label for="payment_method" class="form-label">Metode Pembayaran</label>
                        <select name="payment_method" id="payment_method" class="form-select" required>
                            <option value="">Pilih Metode</option>
                            <option value="qris">QRIS</option>
                            <option value="bank_transfer">Bank Transfer</option>
                            <option value="e_wallet">E-Wallet</option>
                        </select>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="btn btn-primary w-100">Bayar Sekarang</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
