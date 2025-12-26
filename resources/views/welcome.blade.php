<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem EKSINTAS | PT PLN Indonesia Power</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('images/pln-logo.png') }}">

    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('admin_assets/img/icon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('admin_assets/img/icon.png') }}">
    <link rel="shortcut icon" href="{{ asset('admin_assets/img/icon.png') }}">

    <style>
        /* === GLOBAL STYLE === */
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            background: linear-gradient(135deg, #005b7f, #007fa3, #00b4d8);
            background-size: 400% 400%;
            animation: gradientMove 10s ease infinite;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            overflow: hidden;
            position: relative;
        }

        @keyframes gradientMove {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* === SOFT AURORA LIGHT EFFECT === */
        body::after {
            content: "";
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: radial-gradient(circle at 30% 30%, rgba(255,255,255,0.15), transparent 70%),
                        radial-gradient(circle at 70% 70%, rgba(255,255,255,0.1), transparent 60%);
            animation: aurora 8s infinite alternate ease-in-out;
            z-index: 0;
        }

        @keyframes aurora {
            0% { transform: translate(0,0); }
            100% { transform: translate(10px, -10px); }
        }

        /* === PLN HEADER STRIPE === */
        .header-stripe {
            position: fixed;
            top: 0;
            left: 0;
            height: 6px;
            width: 100%;
            background: linear-gradient(to right, #ffd700, #fff45f, #ffd700);
            z-index: 999;
        }

        /* === CARD === */
        .welcome-card {
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(10px);
            border-radius: 22px;
            padding: 60px 45px;
            text-align: center;
            box-shadow: 0 8px 30px rgba(0,0,0,0.25);
            width: 90%;
            max-width: 500px;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        /* === KILAU BERGERAK === */
        .welcome-card::before {
            content: "";
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(120deg, transparent, rgba(255,255,255,0.3), transparent);
            transform: rotate(25deg);
            animation: shine 5s infinite linear;
        }

        @keyframes shine {
            0% { transform: translateX(-100%) rotate(25deg); }
            100% { transform: translateX(100%) rotate(25deg); }
        }

        /* === GARIS ENERGI PLN === */
        .welcome-card::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, #00b4d8, #ffea00, #00b4d8);
            background-size: 400% 100%;
            animation: moveLine 3s infinite linear;
        }

        @keyframes moveLine {
            0% { background-position: 0 0; }
            100% { background-position: 400px 0; }
        }

        /* === LOGO PLN === */
        .welcome-card img {
            width: 180px;
            margin-bottom: 25px;
            animation: float 3s ease-in-out infinite, fadeZoom 1.2s ease-in-out;
            filter: drop-shadow(0 0 10px rgba(0,180,216,0.4)); /* efek cahaya lembut */
            transition: transform 0.3s ease;
        }

        .welcome-card img:hover {
        transform: scale(1.08);
        filter: drop-shadow(0 0 15px rgba(0,180,216,0.7)); /* glow pas hover */
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-8px); }
        }

        @keyframes fadeZoom {
            from { opacity: 0; transform: scale(0.8); }
            to { opacity: 1; transform: scale(1); }
        }

        /* === TEXT === */
        h1 {
            font-weight: 700;
            font-size: 1.9rem;
            margin-bottom: 8px;
        }

        .text-info {
            color: #00b4d8 !important;
        }

        p.lead {
            color: rgba(255,255,255,0.9);
            font-size: 0.95rem;
            margin-bottom: 35px;
        }

        /* === LOGIN BUTTON === */
        .btn-login {
            background-color: #00b4d8;
            border: none;
            color: #fff;
            font-weight: 600;
            border-radius: 30px;
            padding: 10px 35px;
            transition: all 0.3s ease;
            box-shadow: 0 0 12px rgba(0,180,216,0.4);
            animation: pulse 3s infinite;
        }

        .btn-login:hover {
            background-color: #0096c7;
            transform: scale(1.05);
            box-shadow: 0 0 18px rgba(0,180,216,0.7);
        }

        @keyframes pulse {
            0%, 100% { box-shadow: 0 0 8px rgba(0,180,216,0.4); }
            50% { box-shadow: 0 0 18px rgba(0,180,216,0.8); }
        }

        /* === SLOGAN === */
        .slogan {
            font-size: 0.85rem;
            color: #ffea00;
            font-weight: 500;
            margin-top: 20px;
            letter-spacing: 0.5px;
        }

        /* === FOOTER === */
        footer {
            position: fixed;
            bottom: 15px;
            width: 100%;
            text-align: center;
            font-size: 0.85rem;
            color: rgba(255,255,255,0.75);
            z-index: 2;
        }

        footer img {
            height: 20px;
            vertical-align: middle;
            margin-right: 6px;
        }
    </style>
</head>
<body>

    <div class="header-stripe"></div>

    <div class="welcome-card">
        {{-- LOGO PLN --}}
        <img src="{{ asset('admin_assets/img/adp.jpg') }}" alt="Logo PLN">

        {{-- TITLE --}}
        <h6>Welcome To System</h6>
        <h1>-- EKSINTAS --</h1>
        <p class="lead">Eksis System Inventaris</p>

        {{-- BUTTON --}}
        <a href="{{ route('register') }}" class="btn btn-login shadow-sm">
            <i class="fas fa-sign-in-alt me-2"></i> Masuk ke Sistem
        </a>

        {{-- SLOGAN PLN --}}
        <div class="slogan">“Listrik untuk Kehidupan yang Lebih Baik”</div>
    </div>

    <footer>
        <img src="{{ asset('admin_assets/img/icon.png') }}" alt="PLN Logo">
        Created © EKSIS 2025 | PT PLN Indonesia Power UBP Jawa Tengah 2 Adipala — All Rights Reserved.
    </footer>

    <script src="https://kit.fontawesome.com/a2e0bf0f3f.js" crossorigin="anonymous"></script>
</body>
</html>