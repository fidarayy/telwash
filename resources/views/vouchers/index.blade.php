<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Voucher</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Dashboard Voucher</h2>

        <!-- Tombol Tambah Voucher -->
        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('vouchers.create') }}" class="btn btn-primary">Tambah Voucher</a>
        </div>

        <!-- Tabel Daftar Voucher -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Kode Voucher</th>
                    <th>Diskon (%)</th>
                    <th>Berlaku Dari</th>
                    <th>Berlaku Sampai</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                @forelse($vouchers as $voucher)
                    <tr>
                        <td>{{ $voucher->code }}</td>
                        <td>{{ $voucher->discount }}</td>
                        <td>{{ $voucher->valid_from }}</td>
                        <td>{{ $voucher->valid_until }}</td>
                        <td>
                            <a href="{{ route('vouchers.edit', $voucher->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('vouchers.destroy', $voucher->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus voucher ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada voucher tersedia</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
