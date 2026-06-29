<footer class="footer-custom text-white py-4">
    <div class="container text-center">
        <!-- Logo dan Nama -->
        <div class="mb-3 d-flex flex-column align-items-center">
            <div>
            <img src="{{ asset('admin_assets/img/icon.png') }}" alt="Logo PLN" class="footer-logo">
                <strong>EKSIS 2025</strong> | PT PLN Indonesia Power <br>
                UBP Jawa Tengah 2 Adipala
            </div>
        </div>

        <!-- Sosial Media -->
        <div class="social-icons mb-3">
            <a href="https://youtube.com/@plnindonesiapoweradipalaom2886?si=-vk5t4rYvR2Hs-eN" target="_blank" class="icon youtube">
                <i class="fab fa-youtube"></i>
            </a>
            <a href="https://www.instagram.com/plnip.ubpadipala?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank" class="icon instagram">
                <i class="fab fa-instagram"></i>
            </a>
        </div>

        <small class="d-block mt-2 text-light-emphasis">
           Created © Politeknik Negeri Cilacap 2025 | Source by <strong>EKSIS</strong>
        </small>
    </div>
</footer>

<style>
    .footer-custom {
        background: linear-gradient(90deg, #005b7f 0%, #007fa3 100%);
        box-shadow: 0 -2px 8px rgba(0, 0, 0, 0.25);
        color: #fff;
        font-family: 'Poppins', sans-serif;
    }

    .footer-logo {
        width: 45px;
        height: 45px;
        border-radius: 8px;
        box-shadow: 0 0 6px rgba(255, 255, 255, 0.4);
        background-color: #fff;
        object-fit: contain;
    }

    .social-icons {
        display: flex;
        justify-content: center;
        gap: 15px;
    }

    .social-icons .icon {
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        color: #fff;
        font-size: 1.2rem;
        background: rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease-in-out;
    }

    .social-icons .icon:hover {
        transform: scale(1.2);
        background: rgba(255, 255, 255, 0.3);
    }

    .social-icons .youtube:hover {
        color: #FF0000;
    }

    .social-icons .instagram:hover {
        color: #feda75;
    }

    .text-light-emphasis {
        color: rgba(255, 255, 255, 0.85);
    }
</style>