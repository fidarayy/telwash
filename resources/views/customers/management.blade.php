<!DOCTYPE html>
<html lang="en">
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Pelanggan</title>

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @endif

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* Custom styling */
        body {
            font-family: "Poppins", sans-serif;
            font-weight: 400;
            font-style: normal;
            background: #F4E8D4;
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
        .main-title {
            font-size: 4rem;
            font-weight: bold;
            text-align: center;
            margin: 20px 0;
        }
        .edit-btn {
            background-color: #B5A27F;
            border-radius: 50%;
            padding: 5px 10px;
            color: white;
            transition: background-color 0.3s ease;
        }
        .edit-btn:hover {
            background-color: #9b8e73;
            color: rgb(230, 230, 230);
        }
        .dataTables_filter, .dataTables_length {
            display: none; /* Hide default search and length elements */
        }
        .table-controls {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 15px;
        }
        /* .table-container {
            border-radius: 20px;
            border: 5px #7a746a solid;
            width: 100%;
            overflow: hidden;
        } */
        .table-striped {
            border-radius: 20px;
            border: 5px #7a746a solid;
            width: 100%;
            overflow: hidden;
            border-right-width: 5px !important;
        }
        /* Tambahkan gaya untuk mengatur lebar penuh dan responsivitas */
        .table-container, .table-responsive {
            width: 100%;
            margin: auto;
        }

        .table-striped {
            width: 100%;
            max-width: 100%;
        }

        .page-link.active, .active > .page-link {
            z-index: 3;
            color: white;
            background-color: #B5A27F;
            border-color: #B5A27F;
        }
        .custom-length {
            margin-left: auto;
        }

        /* Memusatkan konten secara vertikal dan memberi margin 10% di kiri dan kanan */
        .main-container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 90vh;
        }

        .content-wrapper {
            max-width: 80%;
            margin: auto;
        }

        .table-responsive {
            width: 100%;
        }

        .pagination {
            --bs-pagination-color: black !important;
        }

    </style>
</head>
<body>

    <!-- Header -->
    <header class="header d-flex justify-content-between align-items-center">
        <img src="logo.png" alt="Logo" style="height: 40px;">
        <button class="btn logout-btn">
            <i class="ti ti-logout"></i> Logout
        </button>
    </header>

    <!-- Main Content -->
    <main class="main-container d-flex align-items-center justify-content-center">
        <div class="content-wrapper w-100" style="max-width: 60%;">
            <h1 class="main-title">Data Pelanggan</h1>

            <!-- Custom Controls for DataTable -->
            <div class="table-controls">
                <!-- Left Control: Search Box -->
                <input type="text" id="customSearchBox" class="form-control form-control-sm w-25" placeholder="Search...">

                <!-- Right Control: Show Entries Dropdown -->
                <div class="custom-length d-flex align-items-center">
                    <label class="me-2 mb-0">Show</label>
                    <select id="customEntries" aria-controls="dataTable" class="form-select form-select-sm">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span>entries</span>
                </div>
            </div>

            <!-- Data Table with Full Width -->
            <div class="table-responsive">
                <table id="dataTable" class="table table-striped table-bordered w-100 mb-0">
                    <thead>
                        <tr>
                            <th>Nama Pelanggan</th>
                            <th>No Telepon</th>
                            <th style="width: 10px !important;">Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data Dummy -->
                        <tr>
                            <td>John Doe</td>
                            <td>081234567890</td>
                            <td><button class="btn edit-btn"><i class="ti ti-pencil"></i></button></td>
                        </tr>
                        <tr>
                            <td>John Doe</td>
                            <td>081234567890</td>
                            <td><button class="btn edit-btn"><i class="ti ti-pencil"></i></button></td>
                        </tr>
                        <tr>
                            <td>John Doe</td>
                            <td>081234567890</td>
                            <td><button class="btn edit-btn"><i class="ti ti-pencil"></i></button></td>
                        </tr>
                        <tr>
                            <td>John Doe</td>
                            <td>081234567890</td>
                            <td><button class="btn edit-btn"><i class="ti ti-pencil"></i></button></td>
                        </tr>
                        <tr>
                            <td>John Doe</td>
                            <td>081234567890</td>
                            <td><button class="btn edit-btn"><i class="ti ti-pencil"></i></button></td>
                        </tr>
                        <tr>
                            <td>John Doe</td>
                            <td>081234567890</td>
                            <td><button class="btn edit-btn"><i class="ti ti-pencil"></i></button></td>
                        </tr>
                        <tr>
                            <td>John Doe</td>
                            <td>081234567890</td>
                            <td><button class="btn edit-btn"><i class="ti ti-pencil"></i></button></td>
                        </tr>
                        <tr>
                            <td>John Doe</td>
                            <td>081234567890</td>
                            <td><button class="btn edit-btn"><i class="ti ti-pencil"></i></button></td>
                        </tr>
                        <tr>
                            <td>John Doe</td>
                            <td>081234567890</td>
                            <td><button class="btn edit-btn"><i class="ti ti-pencil"></i></button></td>
                        </tr>
                        <tr>
                            <td>John Doe</td>
                            <td>081234567890</td>
                            <td><button class="btn edit-btn"><i class="ti ti-pencil"></i></button></td>
                        </tr>
                        <tr>
                            <td>John Doe</td>
                            <td>081234567890</td>
                            <td><button class="btn edit-btn"><i class="ti ti-pencil"></i></button></td>
                        </tr>
                        <tr>
                            <td>John Doe</td>
                            <td>081234567890</td>
                            <td><button class="btn edit-btn"><i class="ti ti-pencil"></i></button></td>
                        </tr>
                        <tr>
                            <td>John Doe</td>
                            <td>081234567890</td>
                            <td><button class="btn edit-btn"><i class="ti ti-pencil"></i></button></td>
                        </tr>
                        <tr>
                            <td>John Doe</td>
                            <td>081234567890</td>
                            <td><button class="btn edit-btn"><i class="ti ti-pencil"></i></button></td>
                        </tr>
                        <tr>
                            <td>Jane Smith</td>
                            <td>081234567891</td>
                            <td><button class="btn edit-btn"><i class="ti ti-pencil"></i></button></td>
                        </tr>
                        <tr>
                            <td>Robert Johnson</td>
                            <td>081234567892</td>
                            <td><button class="btn edit-btn"><i class="ti ti-pencil"></i></button></td>
                        </tr>
                        <tr>
                            <td>Emily Davis</td>
                            <td>081234567893</td>
                            <td><button class="btn edit-btn"><i class="ti ti-pencil"></i></button></td>
                        </tr>
                        <tr>
                            <td>Michael Brown</td>
                            <td>081234567894</td>
                            <td><button class="btn edit-btn"><i class="ti ti-pencil"></i></button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>



    <!-- jQuery, Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <!-- DataTables Initialization -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Initialize DataTable
            var table = $('#dataTable').DataTable({
                paging: true,
                searching: true,
                ordering: true
            });

            // Custom Search Box
            $('#customSearchBox').on('keyup', function() {
                table.search(this.value).draw();
            });

            // Custom Show Entries
            $('#customEntries').on('change', function() {
                table.page.len(this.value).draw();
            });
        });
    </script>
</body>
</html>
