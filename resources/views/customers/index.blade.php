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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* Custom styling */
        html, body {
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
    <main class="container-fluid card-center">
        <div class="card text-center">
            <!-- Title and Back Button -->
            <div class="title-container">
                <i class="ti ti-arrow-left fs-1"></i>
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
                <button class="btn btn-large">
                    <i class="ti ti-address-book"></i>
                    <span>Edit Pelanggan</span>
                </button>
            </div>
        </div>
        @include('customers.modal')
    </main>

    <!-- jQuery, Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
