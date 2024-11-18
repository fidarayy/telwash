@push('css')
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

        .dataTables_filter,
        .dataTables_length {
            display: none;
            /* Hide default search and length elements */
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
        .table-container,
        .table-responsive {
            width: 100%;
            margin: auto;
        }

        .table-striped {
            width: 100%;
            max-width: 100%;
        }

        .page-link.active,
        .active>.page-link {
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
@endpush

@push('js')
    <script>
        function edit(button) {
            const customerId = button.getAttribute('data-id');

            fetch(`{{ route('admin.master_data.customer.edit', ['id' => 'id']) }}`.replace('id', customerId))
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Customer not found');
                    }
                    return response.json();
                })
                .then(data => {
                    // Clear validation errors
                    const form = document.getElementById('customerUpdate');
                    clearValidationErrors(form);

                    form.action = `{{ route('admin.master_data.customer.update', ['id' => 'id']) }}`
                        .replace('id', customerId);

                    // Populate the modal fields with customer data
                    document.getElementById('name').value = data.name;
                    document.getElementById('phone_number').value = data.phone_number;

                    // Show the modal
                    const modal = new bootstrap.Modal(document.getElementById('tambahPelangganModal'));
                    modal.show();
                })
                .catch(error => {
                    alert('Error: ' + error.message);
                });
        };

        // Clear validation errors in the form
        function clearValidationErrors(form) {
            $(form).find('.is-invalid').removeClass('is-invalid');
            $(form).find('.invalid-feedback').remove();
        }

        document.addEventListener("DOMContentLoaded", function() {
            @if (session('showModal'))
                const modal = new bootstrap.Modal(document.getElementById('tambahPelangganModal'));
                modal.show();

                const form = document.getElementById('customerUpdate');
                form.action =
                    `{{ route('admin.master_data.customer.update', ['id' => session('previousId')]) }}`;
            @endif
            // Initialize DataTable
            var table = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('admin.master_data.customer.show') }}',
                    type: 'GET'
                },
                columns: [{
                        data: 'name',
                        name: 'name',
                        title: 'Nama Pelanggan'
                    },
                    {
                        data: 'phone_number',
                        name: 'phone_number',
                        title: 'No Telepon'
                    },
                    {
                        data: 'edit',
                        name: 'edit',
                        orderable: false,
                        searchable: false
                    }
                ],
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
@endpush

<x-layout>
    <!-- Main Content -->
    <main class="main-container d-flex align-items-center justify-content-center">
        <div class="content-wrapper w-100" style="max-width: 60%;">
            <h1 class="main-title">Data Pelanggan</h1>

            <!-- Custom Controls for DataTable -->
            <div class="table-controls">
                <a href="{{ route('admin.master_data.customer.index') }}">
                    <button class="btn edit-btn me-2">
                        <i class="ti ti-arrow-left"></i>
                    </button>
                </a>
                <!-- Left Control: Search Box -->
                <input type="text" id="customSearchBox" class="form-control form-control-sm w-25"
                    placeholder="Search...">

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
                </table>
            </div>
        </div>
        @include('admin.master_data.customers.modal')
    </main>
</x-layout>
