<!DOCTYPE html>
<html lang="en">
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Laravel</title>

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @endif

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <style>
        /* Custom styling */

        body {
            font-family: "Poppins", sans-serif;
            font-weight: 400;
            font-style: normal;
        }

        .header {
            background-color: #C8B891;
            padding: 10px 20px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            /* Shadow for header */
        }

        .logout-btn {
            background-color: black;
            color: white;
            border-radius: 20px;
            transition: background-color 0.3s ease;
            /* Smooth transition */
        }

        .logout-btn:hover {
            background-color: rgb(54, 54, 54);
            /* Faded black on hover */
            color: white;
        }

        .edit-btn {
            background-color: #B5A27F;
            border-radius: 50%;
            padding: 5px 10px;
            color: white;
            transition: background-color 0.3s ease;
            /* Smooth transition */
        }

        .edit-btn:hover {
            background-color: #9b8e73;
            /* Slightly darker on hover */
            color: rgb(230, 230, 230);
        }

        .main-title {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .table-striped {
            border-radius: 20px;
            border: 5px #7a746a solid;
            width: 100%;
            overflow: hidden;
            border-right-width: 5px !important;
        }

        .page-link.active,
        .active>.page-link {
            z-index: 3;
            color: white;
            background-color: #B5A27F;
            border-color: #B5A27F;
        }
    </style>
</head>

<body style="background: #F4E8D4;">

    <!-- Header -->
    <header class="header d-flex justify-content-between align-items-center">
        <img src="logo.png" alt="Logo" style="height: 40px;">
        <button class="btn logout-btn">
            <i class="ti ti-logout"></i> Logout
        </button>
    </header>

    <!-- Main Content -->
    <main class="container-fluid mt-4 main-content">
        <h1 class="main-title fs-1 fw-bold">History Transaksi</h1>

        <!-- Data Table -->
        <div class="data-table-container">
            <table id="dataTable" class="table table-striped table-bordered mb-0">
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>Nama Pelanggan</th>
                        <th>No Telepon</th>
                        <th>Berat (Kg)</th>
                        <th>Harga</th>
                        <th>Waktu Selesai</th>
                        <th>Diterima</th>
                        <th>Jenis Layanan</th>
                        <th>Payment</th>
                        <th style="width: 10px !important;">Edit</th>
                    </tr>
                </thead>                
            </table>
        </div>
    </main>

    <!-- jQuery, Bootstrap, DataTables, and Icons JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <!-- DataTables Initialization -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('admin.master_data.transaction.show') }}', 
                },
                columns: [{
                        data: 'status',
                        name: 'status',
                        title: 'Status'
                    },
                    {
                        data: 'nama_pelanggan',
                        name: 'nama_pelanggan',
                        title: 'Nama Pelanggan'
                    },
                    {
                        data: 'no_telepon',
                        name: 'no_telepon',
                        title: 'No Telepon'
                    },
                    {
                        data: 'weight',
                        name: 'weight',
                        title: 'Berat (Kg)'
                    },
                    {
                        data: 'price',
                        name: 'price',
                        title: 'Harga'
                    },
                    {
                        data: 'estimated_finish_at',
                        name: 'estimated_finish_at',
                        title: 'Waktu Selesai'
                    },
                    {
                        data: 'received_at',
                        name: 'received_at',
                        title: 'Diterima'
                    },
                    {
                        data: 'service_type',
                        name: 'service_type',
                        title: 'Jenis Layanan'
                    },
                    {
                        data: 'payment_status',
                        name: 'payment_status',
                        title: 'Payment'
                    },
                    {
                        data: 'edit',
                        name: 'edit',
                        orderable: false,
                        searchable: false,                       
                    },
                ],               
            });
        });
    </script>
</body>

</html>
