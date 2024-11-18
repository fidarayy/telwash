@push('css')
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

        .delete-btn,
        .status-btn {
            display: inline-block;
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
@endpush

@push('js')
    <script>
        function edit(button) {
            // Ambil data-id dari atribut tombol yang diklik
            const voucherId = button.getAttribute('data-id');

            // Panggil API untuk mengambil data transaksi berdasarkan ID
            fetch(`{{ route('admin.master_data.voucher.edit', ['id' => 'id']) }}`.replace('id', voucherId))
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Data not found');
                    }
                    return response.json();
                })
                .then(data => {
                    // Looping data untuk mengisi input form berdasarkan id
                    const form = document.getElementById('updateVoucherForm');
                    clearValidationErrors(form);
                    form.action = `{{ route('admin.master_data.voucher.update', ['id' => 'id']) }}`.replace('id',
                        voucherId);

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

                const form = document.getElementById('updateVoucherForm');
                form.action =
                    `{{ route('admin.master_data.voucher.update', ['id' => session('previousId')]) }}`;
            @endif

            // Initialize DataTable with server-side processing
            var table = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('admin.master_data.voucher.show') }}', // Update this to your route
                    type: 'GET'
                },
                columns: [{
                        data: 'code',
                        name: 'code',
                        title: 'Kode Voucher'
                    },
                    {
                        data: 'discount',
                        name: 'discount',
                        title: 'Diskon'
                    },
                    {
                        data: 'min_transaction',
                        name: 'min_transaction',
                        title: 'Min Transaksi'
                    },
                    {
                        data: 'max_discount',
                        name: 'max_discount',
                        title: 'Max Potongan'
                    },
                    {
                        data: 'usage_limit',
                        name: 'usage_limit',
                        title: 'Limit Digunakan'
                    },
                    {
                        data: 'product',
                        name: 'product',
                        title: 'Produk'
                    },
                    {
                        data: 'valid_from',
                        name: 'valid_from',
                        title: 'Valid From'
                    },
                    {
                        data: 'valid_until',
                        name: 'valid_until',
                        title: 'Valid Until'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        title: 'Status'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false,
                    }
                ],
                paging: true,
                searching: true,
                ordering: true,
                drawCallback: function(settings) {
                    // Handle the delete button with confirmation on each draw
                    document.querySelectorAll('.delete-btn').forEach(button => {
                        button.removeEventListener('click',
                        handleDeleteClick); // Remove previous event listeners to avoid duplicates
                        button.addEventListener('click', handleDeleteClick);
                    });
                }
            });

            // Custom Search Box
            $('#customSearchBox').on('keyup', function() {
                table.search(this.value).draw();
            });

            // Filter by Status or other fields if needed
            $('#statusFilter').on('change', function() {
                var selectedStatus = $(this).val();
                table.column(8).search(selectedStatus).draw(); // Assuming status is in column 8
            });

            // Custom Show Entries
            $('#customEntries').on('change', function() {
                table.page.len(this.value).draw();
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
        });
    </script>
@endpush

<x-layout>
    <main class="container-fluid mt-4 main-content">
        <h1 class="main-title fs-1 fw-bold">Dashboard Voucher</h1>

        <!-- Custom Controls for DataTable -->
        <div class="d-flex justify-content-between mb-3">
            <!-- Left Controls: Back Button and Search -->
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('dashboard') }}">
                    <button class="btn edit-btn">
                        <i class="ti ti-arrow-left"></i>
                    </button>
                </a>
                <!-- Search Box -->
                <input type="text" id="customSearchBox" class="form-control form-control-sm" placeholder="Search...">
            </div>

            <!-- Right Controls: Create Voucher Button and Show Entries -->
            <div class="d-flex align-items-center gap-3">               
                <a href="{{ route('admin.master_data.voucher.create') }}" class="edit-user">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createVoucherModal">
                        Buat Voucher
                    </button>
                </a>
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
        </div>

        <!-- Data Table -->
        <div class="data-table-container">
            <table id="dataTable" class="table table-striped table-bordered mb-0">
                <thead>
                    <tr>
                        <th>Kode Voucher</th>
                        <th>Diskon</th>
                        <th>Min Transaksi</th>
                        <th>Max Potongan</th>
                        <th>Limit Digunakan</th>
                        <th>Produk</th>
                        <th>Valid From</th>
                        <th>Valid Until</th>
                        <th>Status</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data will be populated via AJAX -->
                </tbody>
            </table>
        </div>
        @include('admin.master_data.voucher.modal')
    </main>
</x-layout>
