<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistem Manajemen Aset PLN">
    <meta name="author" content="">

    <title>Register - Eksintas</title>

    <!-- Custom fonts -->
    <link href="{{ asset('admin_assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,900" rel="stylesheet">

    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('admin_assets/img/icon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('admin_assets/img/icon.png') }}">
    <link rel="shortcut icon" href="{{ asset('admin_assets/img/icon.png') }}">

    <!-- Custom styles -->
    <link href="{{ asset('admin_assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

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

    <div style="font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif" class="container">

        <div class="card o-hidden border-0 shadow-lg my-5 rounded-4">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <img src="{{ asset('admin_assets/img/adp.jpg') }}" alt="PLN" class="logo-pln">
                                <h1 style="font-family:fantasy" class="h4 text-gray-900 mb-2 fw-bold">Register Akun Sistem Eksintas</h1>
                                <p class="mb-4 text-muted">Silahkan Isi Data Anda Dengan Benar</p>
                            </div>
                            <form action="{{ route('register.save') }}" autocomplete="off" method="POST" class="user">
                                @csrf
                                <div class="form-group">
                                    <input name="name" type="text"
                                           class="form-control form-control-user @error('name') is-invalid @enderror"
                                           placeholder="Nama Lengkap" value="{{ old('name') }}">
                                    @error('name')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input name="email" type="email"
                                           class="form-control form-control-user @error('email') is-invalid @enderror"
                                           placeholder="Alamat Email" value="{{ old('email') }}" autocomplete="off">
                                    @error('email')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input name="password" type="password"
                                               class="form-control form-control-user @error('password') is-invalid @enderror"
                                               placeholder="Kata Sandi" autocomplete="new-password">
                                        @error('password')
                                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <input name="password_confirmation" type="password"
                                               class="form-control form-control-user @error('password_confirmation') is-invalid @enderror"
                                               placeholder="Ulangi Kata Sandi">
                                        @error('password_confirmation')
                                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-pln btn-user btn-block text-white fw-bold">
                                    <i class="fas fa-user-plus me-1"></i> Daftar Akun
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="{{ route('login') }}">Sudah punya akun? Masuk!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- JS -->
    <script src="{{ asset('admin_assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin_assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin_assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/sb-admin-2.min.js') }}"></script>

</body>
</html>