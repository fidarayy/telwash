<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include Custom Styles for User Dashboard -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>

<body class="user-dashboard">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg user-dashboard">
        <div class="container">
            <a class="navbar-brand user-dashboard" href="#">TELWASH</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="nav-link custom-logout user-dashboard">
                                <i class="ph ph-sign-out"></i> Log Out
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h4 class="user-dashboard-title">Selamat Datang, {{ Auth::user()->name }}</h4>

        <!-- Summary Cards -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card user-dashboard">
                    <div class="card-body">
                        <h3><i class="ph ph-shopping-cart"></i> Pesanan Aktif</h3>
                        <p>{{ $activeOrders }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card user-dashboard">
                    <div class="card-body">
                        <h3><i class="ph ph-check-circle"></i> Pesanan Selesai</h3>
                        <p>{{ $completedOrders }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
    <div class="card user-dashboard">
        <div class="card-body d-flex align-items-center justify-content-between">
            <div>
                <h3><i class="ph ph-wallet"></i> Saldo</h3>
                <p>Rp {{ number_format($balance, 0, ',', '.') }}</p>
            </div>
            <a href="{{ route('balance.topup') }}" class="btn btn-secondary user-dashboard">Isi Saldo</a>
        </div>
    </div>
</div>

 <!-- Quick Actions -->
 <div class="mt-4">
            <a href="{{ route('user.orders.create') }}" class="btn btn-primary user-dashboard">Pesan Baru</a>
            
        </div>
        <!-- Order History Table -->
        <div class="card user-dashboard">
            <div class="card-body">
                <h4 class="card-title user-dashboard">Riwayat Pesanan</h4>
                <table class="table user-dashboard">
                    <thead>
                        <tr>
                            <th>ID Pesanan</th>
                            <th>Status</th>
                            <th>Berat (kg)</th>
                            <th>Total Harga</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td>{{ $order->transaction_id }}</td>
                                <td>{{ ucfirst($order->status) }}</td>
                                <td>{{ $order->weight }}</td>
                                <td>Rp {{ number_format($order->price, 0, ',', '.') }}</td>
                                <td>{{ $order->created_at->format('d M Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">Tidak ada riwayat pesanan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

       
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/phosphor-icons"></script>
</body>

</html>
