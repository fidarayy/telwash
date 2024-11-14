<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top-Up Saldo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/topup.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body class="topup-page">
    <div class="topup-container">
        <div class="topup-card">
        <div class="topup-header">
    <form action="{{ route('user.dashboard') }}" method="GET">
        <button type="submit" class="topup-back-button">
            <i class="bi bi-arrow-left"></i> Back
        </button>
    </form>
    <h2>Top-Up Saldo</h2>
    <p>Isi saldo dengan mudah dan cepat</p>
</div>

            <div class="topup-body">
                @if (session('success'))
                    <div class="topup-alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{ route('user.balance.store') }}" method="POST">
                    @csrf
                    <!-- Nominal Top-Up -->
                    <div class="topup-field">
                        <label for="amount" class="topup-label">Nominal Top-Up</label>
                        <input type="number" name="amount" id="amount" class="topup-input" placeholder="Minimal Rp10.000" required>
                    </div>
                    <!-- Metode Pembayaran -->
                    <div class="topup-field">
                        <label for="payment_method" class="topup-label">Metode Pembayaran</label>
                        <select name="payment_method" id="payment_method" class="topup-select" required>
                            <option value="qris">QRIS</option>
                            <option value="bank_transfer">Transfer Bank</option>
                            <option value="e_wallet">E-Wallet</option>
                        </select>
                    </div>
                    <button type="submit" class="topup-button">Lanjutkan</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>