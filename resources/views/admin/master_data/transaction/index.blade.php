<!DOCTYPE html>
<html lang="en">
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Laravel</title>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Mask js -->
    <script src="https://unpkg.com/imask"></script>

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @endif
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

        .main-title {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .dataTables_filter,
        .dataTables_length {
            display: none;
            /* Hide default search and length elements */
        }

        .table-controls {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .custom-length {
            margin-left: auto;
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

        .pagination {
            --bs-pagination-color: black !important;
        }

        .select2-container {
            z-index: 1055;
            /* Atur agar dropdown terlihat */
        }

        .invalid-feedback {
            display: block !important
        }

        .error-message {
            font-size: 0.875rem;
            color: red;
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

        <!-- Custom Controls for DataTable -->
        <div class="d-flex justify-content-between mb-3">
            <!-- Left Controls: Search, Payment, Status -->
            <div class="d-flex align-items-center gap-2">
                {{-- <button class="btn edit-btn"><i class="ti ti-arrow-left"></i></button> --}}
                <!-- Button Trigger for Modal -->
                <a href="{{ route('dashboard') }}">
                    <button class="btn edit-btn">
                        <i class="ti ti-arrow-left"></i>
                    </button>
                </a>

                <!-- Search Box -->
                <input type="text" id="customSearchBox" class="form-control form-control-sm" placeholder="Search...">

                <!-- Filter Payment Dropdown -->
                <select id="paymentFilter" class="form-select form-select-sm">
                    <option value="">Payment</option>
                    <option value="Lunas">Lunas</option>
                    <option value="Belum Dibayar">Belum</option>
                    <option value="DP">DP</option>
                </select>

                <!-- Filter Status Dropdown -->
                <select id="statusFilter" class="form-select form-select-sm">
                    <option value="">Status</option>
                    <option value="Diterima">Diterima</option>
                    <option value="Diproses">Diproses</option>
                    <option value="Selesai">Selesai</option>
                    <option value="Diambil">Diambil</option>
                </select>
            </div>

            <!-- Show Entries Dropdown (DataTable default length dropdown) -->
            <div class="custom-length d-flex align-items-center">
                <label class="me-2 mb-0">Show</label>
                <select id="customEntries" aria-controls="dataTable" class="form-select form-select-sm me-2">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                <span>entries</span>
            </div>
        </div>

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
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data will be populated via AJAX -->
                </tbody>
            </table>
        </div>
        @include('admin/master_data/transaction/modal')
    </main>

    <!-- jQuery, Bootstrap, DataTables, and Icons JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <!-- SweatAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- DataTables Initialization -->
    <script>
        function edit(button) {
            // Ambil data-id dari atribut tombol yang diklik
            const transactionId = button.getAttribute('data-id');

            // Panggil API untuk mengambil data transaksi berdasarkan ID
            fetch(`{{ route('admin.master_data.transaction.edit', ['id' => 'id']) }}`.replace('id', transactionId))
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Data not found');
                    }
                    return response.json();
                })
                .then(data => {
                    // Looping data untuk mengisi input form berdasarkan id
                    const form = document.getElementById('updateForm');
                    clearValidationErrors(form);
                    form.action = `{{ route('admin.master_data.transaction.update', ['id' => 'id']) }}`.replace('id',
                        transactionId);

                    Object.entries(data).forEach(([key, value]) => {
                        const inputElement = $('#' + key); // Cari elemen berdasarkan id
                        if (inputElement) {

                            if (inputElement.is('input') || inputElement.is('select')) {
                                // Jika elemen adalah input, select, atau textarea
                                inputElement.val(value).change();
                            } else {
                                // Jika elemen bukan input, isi menggunakan .html()
                                inputElement.html(value);
                            }
                        }
                    });

                    const priceInput = document.getElementById('price');
                    if (priceInput) {
                        IMask(priceInput, {
                            mask: 'Rp. num',
                            blocks: {
                                num: {
                                    mask: Number,
                                    thousandsSeparator: '.', // Separator ribuan
                                    scale: 0, // Tidak ada desimal
                                    signed: false, // Tidak ada tanda minus
                                },
                            },
                            prefix: 'Rp. ', // Tambahkan prefix "Rp. "
                            lazy: false, // Menampilkan prefix meskipun input kosong
                        });
                    }

                    // Buka modal
                    const editModal = new bootstrap.Modal(document.getElementById('editModal'));
                    editModal.show();
                })
                .catch(error => {
                    alert('Error: ' + error.message);
                });
        }

        function clearValidationErrors(form) {
            $(form).find('.is-invalid').removeClass('is-invalid');
            $(form).find('.invalid-feedback').remove();
        }

        document.addEventListener("DOMContentLoaded", function() {
            @if (session('showModal'))
                const modal = new bootstrap.Modal(document.getElementById('editModal'));
                modal.show();

                const form = document.getElementById('updateForm');
                form.action =
                    `{{ route('admin.master_data.transaction.update', ['id' => session('previousId')]) }}`;
            @endif

            // Initialize DataTable with server-side processing
            var table = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('admin.master_data.transaction.show') }}',
                    type: 'GET'
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
                    }
                ],
                paging: true,
                searching: true,
                ordering: true
            });

            // Clear the modal fields when it is closed
            $('#editModal').on('hidden.bs.modal', function() {
                $('#customerName').val('');
                $('#phoneNumber').val('');
                $('#weight').val('');
                $('#price').val('');
                $('#finishedAt').val('');
                $('#receivedAt').val('');
                $('#jenisLayanan').val('');
                $('#paymentStatus').val('');
                $('#status').val('');
            });

            // Custom Search Box
            $('#customSearchBox').on('keyup', function() {
                table.search(this.value).draw();
            });

            // Filter by Payment
            $('#paymentFilter').on('change', function() {
                var selectedPayment = $(this).val();
                table.column(8).search(selectedPayment).draw();
            });

            // Filter by Status
            $('#statusFilter').on('change', function() {
                var selectedStatus = $(this).val();
                table.column(0).search(selectedStatus).draw();
            });

            // Custom Show Entries
            $('#customEntries').on('change', function() {
                table.page.len(this.value).draw();
            });
        });
    </script>

    <!-- SweatAlert JS -->
    @if (session('success'))
        <script>
            const ToastSuccess = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            ToastSuccess.fire({
                icon: 'success',
                title: '{{ session('success') }}'
            })
        </script>
    @endif
    @if (session('error'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'error',
                title: '{{ session('error') }}'
            })
        </script>
    @endif
</body>

</html>
