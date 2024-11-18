@push('css')
    <style>
        /* Custom styling */
        html,
        body {
            height: 100%;
            overflow: hidden;
        }


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
            font-size: 2rem;
            font-weight: bold;
            text-align: center;
            flex-grow: 1;
            margin: 0;
        }

        .card-center {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .card {
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 80%;
            max-width: 600px;
        }

        .title-container {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 30px;
        }

        .back-btn {
            background-color: #B5A27F;
            color: white;
            border-radius: 50%;
            padding: 8px;
            margin-right: 15px;
            transition: background-color 0.3s ease;
        }

        .back-btn:hover {
            background-color: #9b8e73;
        }

        .btn-large {
            padding: 20px;
            font-size: 1.25rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border-radius: 20px;
            width: 100%;
            max-width: 250px;
            color: white;
            background-color: #B5A27F;
            transition: background-color 0.3s ease;
        }

        .btn-large i {
            font-size: 2.5rem;
            margin-bottom: 5px;
        }

        .btn-large:hover {
            background-color: #9b8e73;
            color: white;
        }

        .button-group {
            display: flex;
            gap: 20px;
            justify-content: center;
        }

        .edit-user {
            display: inline-block;
            width: 100%;
            text-decoration: none
        }
    </style>
@endpush

@push('js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @if (session('showModal'))
                const modal = new bootstrap.Modal(document.getElementById('tambahPelangganModal'));
                modal.show();
            @endif            
        })
    </script>
@endpush

<x-layout>
    <main class="container-fluid card-center">
        <div class="card text-center">
            <!-- Title and Back Button -->
            <div class="title-container">
                <a href="{{ route('dashboard') }}">
                    <button class="btn btn-md">
                        <i class="ti ti-arrow-left fs-1"></i>
                    </button>
                </a>
                <h1 class="main-title">Data Pelanggan</h1>
                <i class="ti ti-arrow-left fs-1 text-light"></i>
            </div>

            <!-- Button Group -->
            <div class="button-group">
                <!-- Tambah Pelanggan Button -->
                <button class="btn btn-large" data-bs-toggle="modal" data-bs-target="#tambahPelangganModal">
                    <i class="ti ti-user-plus"></i>
                    <span>Tambah Pelanggan</span>
                </button>

                <!-- Edit Pelanggan Button -->
                <a href="{{ route('admin.master_data.customer.management') }}" class="edit-user">
                    <button class="btn btn-large">
                        <i class="ti ti-address-book"></i>
                        <span>Edit Pelanggan</span>
                    </button>
                </a>
            </div>
        </div>
        @include('admin.master_data.customers.modal')
    </main>
</x-layout>
