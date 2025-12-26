<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Reset Password - Eksintas</title>

    <!-- Fonts & CSS -->
    <link href="{{ asset('admin_assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,900" rel="stylesheet">
    <link href="{{ asset('admin_assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('admin_assets/img/icon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('admin_assets/img/icon.png') }}">
    <link rel="shortcut icon" href="{{ asset('admin_assets/img/icon.png') }}">

    <style>
        body.bg-pln {
            background: linear-gradient(135deg, #005b7f, #007fa3);
        }
        .logo-pln {
            height: 80px;
            margin-bottom: 15px;
        }
        .btn-pln {
            background-color: #0097C2;
            border-color: #0097C2;
        }
        .btn-pln:hover {
            background-color: #007A9A;
            border-color: #007A9A;
        }
    </style>
</head>

<body class="bg-pln">
<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5 rounded-4">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center">
                            <img src="{{ asset('admin_assets/img/adp.jpg') }}" alt="PLN" class="logo-pln">
                            <h1 class="h4 text-gray-900 mb-2 fw-bold" style="font-family: fantasy">Reset Password</h1>
                            <p class="mb-4 text-muted">Masukkan email dan password baru anda.</p>
                        </div>

                        @if (session('success'))
                            <div class="alert alert-success text-center">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('password.reset') }}" autocomplete="off" method="POST" class="user">
                            @csrf

                            <div class="form-group">
                                <input name="email" type="email"
                                       class="form-control form-control-user @error('email') is-invalid @enderror"
                                       placeholder="Alamat Email" value="{{ old('email') }}" autocomplete="off" required>
                                @error('email')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input name="password" type="password"
                                       class="form-control form-control-user @error('password') is-invalid @enderror"
                                       placeholder="Password Baru" autocomplete="new-password" required>
                                @error('password')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input name="password_confirmation" type="password"
                                       class="form-control form-control-user @error('password_confirmation') is-invalid @enderror"
                                       placeholder="Ulangi Password Baru" required>
                                @error('password_confirmation')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-pln btn-user btn-block text-white fw-bold">
                                <i class="fas fa-lock me-1"></i> Reset Password
                            </button>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="{{ route('login') }}">Kembali ke halaman login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('admin_assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('admin_assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('admin_assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/sb-admin-2.min.js') }}"></script>
</body>
</html>