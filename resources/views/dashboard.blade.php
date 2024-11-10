<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Laundry Service</title>
    <!-- Link ke Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light custom-navbar">
        <div class="container">
            <a class="navbar-brand" href="#">TELWASH</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link custom-logout text-white" href="#" data-bs-toggle="modal"
                            data-bs-target="#logoutModal">
                            <i class="ph ph-sign-out"></i> Log Out
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid mt-0">
        <div class="row">
            <!-- Main Content -->
            <div class="col-md-9">
            <div class="d-flex justify-content-between align-items-center mb-3">
    <!-- Ringkasan Pesanan -->
    <div class="card mb-0 custom-card-width custom-card-radius">
        <div class="card-body">
            <h5 class="card-title">Ringkasan Pesanan</h5>
            <p>Pesanan Diterima: {{ $pesananDiterima }}</p>
            <p>Pesanan Diproses: {{ $pesananDiproses }}</p>
            <p>Pesanan Selesai: {{ $pesananSelesai }}</p>
        </div>
    </div>

    <!-- Form Pencarian -->
    <form action="{{ route('orders.index') }}" method="GET" class="d-flex align-items-center ms-3 search-form">
    <input type="text" name="search" class="form-control custom-search" placeholder="Cari Berdasarkan Transaction ID..."
           value="{{ request('search') }}">
    
    <!-- Dropdown Filter Status -->
    <select name="status" class="form-select ms-2" style="width: 150px;">
        <option value="">Semua Status</option>
        <option value="diterima" {{ request('status') == 'diterima' ? 'selected' : '' }}>Diterima</option>
        <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
        <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
        <option value="diambil" {{ request('status') == 'diambil' ? 'selected' : '' }}>Diambil</option>
    </select>

    <button class="btn btn-primary ms-2" type="submit">Cari</button>
</form>

</div>

                <!-- Tabel Daftar Pesanan dengan Pembungkus -->
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
                            @forelse ($orders as $order)
                                <tr>
                                    <td>{{ $order->status }}</td>
                                    <td>{{ $order->customer->name }}</td>
                                    <td>{{ $order->customer->phone_number }}</td>
                                    <td>{{ $order->weight }}</td>
                                    <td>{{ $order->price }}</td>
                                    <td>{{ $order->finished_at }}</td>
                                    <td>{{ $order->received_at }}</td>
                                </tr>
                            @empty
                                <!-- Menampilkan 14 baris kosong jika tidak ada data -->
                                @for ($i = 0; $i < 14; $i++)
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                @endfor
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>

         <!-- Sidebar -->
<div class="col-md-2 sidebar">
    <div class="icon-container">
        <i class="ph ph-user-circle"></i>
        <div class="username-container">
            {{ Auth::user()->name }}
        </div>
    </div>
    <h3>Admin Panel</h3>
    <p>Perlu Dikirim Hari Ini: {{ $pesananPerluDikirim }}</p>
    <nav class="nav flex-column">
    <a href="{{ route('orders.create') }}" class="nav-link">Transaksi Baru</a>
        <a class="nav-link" href="{{ route('customers.index') }}">Data Pelanggan</a>
        <a class="nav-link" href="{{ route('orders.history') }}">History Transaksi</a>
        <a class="nav-link" href="{{ route('pickup.index') }}">Pesanan Pickup</a>
        <a class="nav-link" href="{{ route('vouchers.index') }}">Kelola Voucher</a>
    </nav>
</div>

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/phosphor-icons"></script>
</body>

</html>