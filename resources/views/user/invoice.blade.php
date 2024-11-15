<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body class="invoice-user-body">
    <div class="invoice-user-container">
        <div class="invoice-user-header">
            Invoice
        </div>
        <div class="invoice-user-body-content">
            <h5 class="invoice-user-title">Detail Transaksi</h5>
            
            <div class="invoice-user-info-row">
                <strong>Nama Pelanggan:</strong>
                <span>{{ $transaction->customer->name }}</span>
            </div>
            <div class="invoice-user-info-row">
                <strong>Nomor Transaksi:</strong>
                <span>{{ $transaction->transaction_id }}</span>
            </div>
            <div class="invoice-user-info-row">
                <strong>Jenis Layanan:</strong>
                <span>{{ $transaction->service_type }}</span>
            </div>
            <div class="invoice-user-info-row">
                <strong>Berat Laundry:</strong>
                <span>{{ $transaction->weight }} kg</span>
            </div>
            <div class="invoice-user-info-row">
                <strong>Total Harga:</strong>
                <span>Rp {{ number_format($transaction->price, 2, ',', '.') }}</span>
            </div>
            <div class="invoice-user-info-row">
                <strong>Metode Pembayaran:</strong>
                <span>{{ ucfirst($transaction->payment_method) }}</span>
            </div>
            <div class="invoice-user-info-row">
                <strong>Status Pembayaran:</strong>
                <span>{{ ucfirst($transaction->payment_status) }}</span>
            </div>
            <div class="invoice-user-info-row">
                <strong>Status Laundry:</strong>
                <span>{{ ucfirst($transaction->status) }}</span>
            </div>
            <div class="invoice-user-info-row">
                <strong>Tanggal Transaksi:</strong>
                <span>{{ $transaction->created_at->format('d M Y, H:i') }}</span>
            </div>
        </div>
        <div class="invoice-user-footer">
            <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">Kembali</a>
            <button onclick="window.print()" class="btn btn-primary">Cetak Invoice</button>
        </div>
    </div>
</body>
</html>
