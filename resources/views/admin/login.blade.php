<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        body { background: #1f1f2d; }
        .login-container { min-height: 100vh; }
        .login-card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1);
        }
        .login-card .card-header {
            background-color: transparent;
            border-bottom: none;
            padding-top: 2rem;
        }
        .brand-icon { font-size: 3rem; color: #0d6efd; }
    </style>
</head>
<body>
<div class="container">
    {{-- Success Toast --}}
    @if(session('success'))
    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div class="toast show bg-success text-white">
            <div class="toast-body">
                {{ session('success') }}
            </div>
        </div>
    </div>
    @endif

    {{-- Error Toast --}}
    @if($errors->any())
    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div class="toast show bg-danger text-white">
            <div class="toast-body">
                {{ $errors->first() }}
            </div>
        </div>
    </div>
    @endif

    <div class="row justify-content-center align-items-center login-container">
        <div class="col-md-6 col-lg-4">
            <div class="card login-card">
                <div class="card-header text-center">
                    <i class="bi bi-shield-lock-fill brand-icon"></i>
                    <h3 class="mt-2 mb-0">Admin Access</h3>
                    <p class="text-muted">Please sign in to continue</p>
                </div>

                <div class="card-body px-4 py-3">
                    {{-- OTP Verification Form --}}
                    @if(session('otp_sent'))
                    <form action="{{ route('admin.verify.otp') }}" method="POST" id="otpForm">
                        @csrf
                        <input type="hidden" name="email" value="{{ session('email') }}">
                        <div class="form-floating mb-3">
                            <input type="text" name="otp" class="form-control" id="floatingOTP" placeholder="Enter OTP" required>
                            <label for="floatingOTP">Enter OTP</label>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <form method="POST" action="{{ route('admin.resend.otp') }}">
                                @csrf
                                <input type="hidden" name="email" value="{{ session('email') }}">
                                <button type="submit" class="btn btn-link p-0">Resend OTP</button>
                            </form>
                            <span class="text-muted small">OTP expires in 5 mins</span>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success btn-lg" id="verifyBtn">
                                <span id="spinner" class="spinner-border spinner-border-sm d-none"></span>
                                <span id="btnText">Verify OTP</span>
                            </button>
                        </div>
                    </form>

                    {{-- Email + Password Form --}}
                    @else
                    <form action="{{ route('admin.send.otp') }}" method="POST" id="loginForm">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="email" name="email" class="form-control" id="floatingEmail" placeholder="name@example.com" value="{{ old('email') }}" required autofocus>
                            <label for="floatingEmail">Email address</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                            <label for="floatingPassword">Password</label>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg" id="submitBtn">
                                <span id="spinner" class="spinner-border spinner-border-sm d-none"></span>
                                <span id="btnText">Submit</span>
                            </button>
                        </div>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const form = document.querySelector('form');
    const spinner = document.getElementById('spinner');
    const btnText = document.getElementById('btnText');

    form.addEventListener('submit', function () {
        spinner.classList.remove('d-none');
        btnText.textContent = 'Please wait...';
    });
</script>
</body>
</html>
