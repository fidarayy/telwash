<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Link ke Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Link ke custom CSS -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css"
        rel="stylesheet">
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
                        <a class="nav-link custom-login" href="#" data-bs-toggle="modal"
                            data-bs-target="#loginModal">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link custom-register" href="#" data-bs-toggle="modal"
                            data-bs-target="#registerModal">Register</a>

                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="container text-center my-5 costume-section">
        <h1 class="display-4">I'm Ready To Go To</h1>
        <h1 class="display-4">Your <span class="display-5">Wardrobe!</span></h1>
        <section class="loginp">
            <a href="#" class="btn btn-dark mt-4 custom-login-btn" data-bs-toggle="modal"
                data-bs-target="#loginModal">LOG IN -></a>
        </section>
    </section>

    <!-- Section with Bootstrap Cards -->
    <section class="container d-flex justify-content-around">
        <div class="card bg-dark text-white text-center custome-shape1" style="width: 18rem;">
            <i class="ph-handshake ph1"></i>
            <div class="card-body">
                <h5 class="card-title">Pakaian Diterima</h5>
            </div>
        </div>

        <!-- Panah antara Pakaian Diterima dan Pakaian Diproses -->
        <div class="d-flex align-items-center">
            <i class="ph-arrow-fat-line-right ph-arrow"></i>
        </div>

        <div class="card bg-dark text-white text-center custome-shape1" style="width: 18rem;">
            <i class="ph-hourglass ph1"></i>
            <div class="card-body">
                <h5 class="card-title">Pakaian Diproses</h5>
            </div>
        </div>

        <!-- Panah antara Pakaian Diproses dan Pakaian Selesai -->
        <div class="d-flex align-items-center">
            <i class="ph-arrow-fat-line-right ph-arrow"></i>
        </div>

        <div class="card bg-dark text-white text-center custome-shape1" style="width: 18rem;">
            <i class="ph-t-shirt ph1"></i>
            <div class="card-body">
                <h5 class="card-title">Pakaian Selesai</h5>
            </div>
        </div>
    </section>

    <!-- Section with Bootstrap Cards -->
    <section class="container d-flex justify-content-around">
        <!-- Card elements here as per your current structure -->
    </section>

    <!-- Modal for Login -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom-0 position-relative">

                    <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="account-teks text-center mb-4">Account Log In</div>
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Username/Email" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Log In</button>
                    </form>

                    <div class="mt-3 text-center">
                        <a href="#" class="text-secondary">Having Problems?</a>
                        <span> | </span>
                        <a href="#" class="text-secondary" data-bs-toggle="modal" data-bs-target="#registerModal"
                            data-bs-dismiss="modal">Register Now</a>
                    </div>

                </div>
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="d-block mx-auto" style="max-height: 50px;">
            </div>
        </div>
    </div>

    <!-- Modal for Register -->
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom-0 position-relative">
                    <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="account-teks text-center mb-4">Create Account</div>
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Full Name"
                                required>
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                                required>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="phone_number" name="phone_number"
                                placeholder="Phone Number" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Password" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" placeholder="Confirm Password" required>
                                <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                                    <i class="bi bi-eye-slash"></i>
                                </span>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Register</button>
                    </form>

                    <!-- Teks untuk login jika sudah punya akun -->
                    <div class="mt-3 text-center">
                        <span>Sudah punya akun?</span>
                        <a href="#" class="text-secondary" data-bs-toggle="modal" data-bs-target="#loginModal"
                            data-bs-dismiss="modal">Login sini</a>
                    </div>
                </div>
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="d-block mx-auto" style="max-height: 50px;">
            </div>
        </div>
    </div>

    <!-- Modal Alert -->
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">Error</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul id="errorList">
                        <!-- Error messages will be injected here -->
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/phosphor-icons"></script>
    <script>

        const togglePassword = document.querySelector('#togglePassword');
        const passwordField = document.querySelector('#password_confirmation');

        togglePassword.addEventListener('click', function (e) {
            // Toggle the type attribute
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);

            // Toggle the eye icon
            this.querySelector('i').classList.toggle('bi-eye');
            this.querySelector('i').classList.toggle('bi-eye-slash');
        });
    </script>
    <script>
        @if ($errors->any())
            var errorMessages = "";
            @foreach ($errors->all() as $error)
                errorMessages += "<li>{{ $error }}</li>";
            @endforeach
            document.getElementById("errorList").innerHTML = errorMessages;
            var errorModal = new bootstrap.Modal(document.getElementById('errorModal'), {
                keyboard: false
            });
            errorModal.show();
        @endif
    </script>



</body>

</html>