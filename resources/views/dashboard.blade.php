<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Laundry Service</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light custom-navbar">
        <div class="container">
            <a class="navbar-brand" href="#">TELWASH</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar"
                aria-controls="offcanvasSidebar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="nav-link custom-logout text-white"
                                style="background-color: black; border: none; padding: 10px 20px; border-radius: 10px;">
                                <i class="ph ph-sign-out"></i> Log Out
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sidebar sebagai Offcanvas untuk Mobile dan Sidebar Biasa untuk Desktop -->
    <div class="offcanvas offcanvas-start d-md-none" tabindex="-1" id="offcanvasSidebar"
        aria-labelledby="offcanvasSidebarLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasSidebarLabel">Admin Panel</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="icon-container">
                <i class="ph ph-user-circle"></i>
                <div class="username-container">
                    {{ Auth::user()->name }}
                </div>
            </div>
            <p>Perlu Dikirim Hari Ini: {{ $pesananPerluDikirim }}</p>
            <nav class="nav flex-column">
                <a href="{{ route('transactions.create') }}" class="nav-link">Transaksi Baru</a>
                <a class="nav-link" href="{{ route('customers.index') }}">Data Pelanggan</a>
                <a class="nav-link" href="{{ route('transactions.history') }}">History Transaksi</a>
                <a class="nav-link" href="{{ route('pickup.index') }}">Pesanan Pickup</a>
                <a class="nav-link" href="{{ route('vouchers.index') }}">Kelola Voucher</a>
            </nav>

            <!-- Tombol Logout -->
            <form method="POST" action="{{ route('logout') }}" class="mt-4">
                @csrf
                <button type="submit" class="btn btn-dark w-100">Log Out</button>
            </form>
        </div>
    </div>


    <div class="container-fluid mt-">
        <div class="row flex-md-nowrap">
            <!-- Main Content -->
            <div class="col-md-9 order-md-1 order-2">
                <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                    <div class="card mb-10 custom-card-width custom-card-radius">
                        <div class="card-body">
                            <h5 class="card-title">Ringkasan Pesanan</h5>
                            <p><i class="ph ph-check-circle"></i> Pesanan Diterima: {{ $pesananDiterima }}</p>
                            <p><i class="ph ph-clock"></i> Pesanan Diproses: {{ $pesananDiproses }}</p>
                            <p><i class="ph ph-bell-simple-ringing"></i> Pesanan Selesai: {{ $pesananSelesai }}</p>

                        </div>
                    </div>

                    <!-- Form Pencarian -->
                    <form action="{{ route('dashboard') }}" method="GET" class="search-form">
    <div class="search-row d-flex align-items-center">
        <input type="text" name="search" class="form-control custom-search"
            placeholder="Cari Berdasarkan Transaction ID..." value="{{ request('search') }}">
        <select name="status" class="form-select ms-2" style="min-width: 150px;">
            <option value="">Semua Status</option>
            <option value="diterima" {{ request('status') == 'diterima' ? 'selected' : '' }}>Diterima</option>
            <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
            <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
            <option value="diambil" {{ request('status') == 'diambil' ? 'selected' : '' }}>Diambil</option>
        </select>
    </div>
    <button class="btn btn-primary mt-2" type="submit">Cari</button>
</form>



                </div>
                <div class="table-container">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Status</th>
                                <th>Nama Pelanggan</th>
                                <th>No Telepon</th>
                                <th>Berat</th>
                                <th>Harga</th>
                                <th>Waktu Selesai</th>
                                <th>Diterima</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($transactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->status }}</td>
                                    <td>{{ $transaction->customer->name }}</td>
                                    <td>{{ $transaction->customer->phone_number }}</td>
                                    <td>{{ $transaction->weight }}</td>
                                    <td>Rp {{ number_format($transaction->price, 0, ',', '.') }}</td>
                                    <td>{{ $transaction->finished_at }}</td>
                                    <td>{{ $transaction->received_at }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">Tidak ada data transaksi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>

            <!-- Sidebar (Fixed on Desktop, Offcanvas on Mobile) -->
            <div class="col-md-2 d-none d-md-block sidebar">
                <div class="icon-container">
                    <i class="ph ph-user-circle"></i>
                    <div class="username-container">
                        {{ Auth::user()->name }}
                    </div>
                </div>
                <h3>Admin Panel</h3>
                <p>Perlu Dikirim Hari Ini: {{ $pesananPerluDikirim }}</p>
                <nav class="nav flex-column">
                    <a href="{{ route('transactions.create') }}" class="nav-link">
                        <i class="ph ph-plus-circle"></i> Transaksi Baru
                        <i class="ph ph-caret-right ms-auto"></i>
                    </a>
                    <a class="nav-link" href="{{ route('customers.index') }}">
                        <i class="ph ph-user-list"></i> Data Pelanggan
                        <i class="ph ph-caret-right ms-auto"></i>
                    </a>
                    <a class="nav-link" href="{{ route('transactions.history') }}">
                        <i class="ph ph-clock"></i> History Transaksi
                        <i class="ph ph-caret-right ms-auto"></i>
                    </a>
                    <a class="nav-link" href="{{ route('pickup.index') }}">
                        <i class="ph ph-truck"></i> Pesanan Pickup
                        <i class="ph ph-caret-right ms-auto"></i>
                    </a>
                    <a class="nav-link" href="{{ route('vouchers.index') }}">
                        <i class="ph ph-ticket"></i> Kelola Voucher
                        <i class="ph ph-caret-right ms-auto"></i>
                    </a>
                </nav>

                <!-- Tambahkan logo di bagian bawah sidebar -->
                <div class="logo-container mt-3">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="sidebar-logo">
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/phosphor-icons"></script>
</body>

</html>