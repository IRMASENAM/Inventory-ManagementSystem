<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 shadow-sm border-bottom border-3" 
     style="border-color: #11aee2;">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop"
            class="btn btn-link d-md-none rounded-circle mr-3"
            style="color: #11aee2;">
        ☰
    </button>

    <!-- Welcome + Jam + Greeting -->
    <div class="d-flex align-items-center ml-auto">
        <span class="navbar-text fw-bold text-dark mr-3" id="greeting">
            👋 Selamat Datang, <span class="user-name">{{ auth()->user()->name }}</span>
        </span>
        <span id="clock" class="badge-clock"></span>
    </div>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav align-items-center">
        <!-- User Info -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="d-none d-lg-block text-end me-2">
                    <div class="fw-bold text-dark">{{ auth()->user()->name }}</div>
                    <small class="text-muted">{{ auth()->user()->email }}</small>
                </div>
                <img class="img-profile rounded-circle shadow border border-2"
                     style="border-color: #11aee2;"
                     src="{{ auth()->user()->foto ? asset('storage/' . auth()->user()->foto) : asset('admin_assets/img/undraw_profile.svg') }}"
                     alt="Foto Profil" width="42" height="42">
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow-lg border-0"
                 aria-labelledby="userDropdown">
                <a class="dropdown-item" href="/profile">👤 Profil</a>
                <a class="dropdown-item" href="/settings">ℹ️ Tentang Sistem</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-danger" href="{{ route('logout') }}" data-toggle="modal" data-target="#logoutModal">
                    🚪 Keluar
                </a>
            </div>
        </li>
    </ul>
</nav>

<style>
.user-name {
    background: linear-gradient(90deg, #11aee2, #007bff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    font-weight: bold;
}
.badge-clock {
    background: linear-gradient(135deg, #11aee2, #007bff);
    color: #fff;
    font-size: 13px;
    font-weight: bold;
    padding: 6px 14px;
    border-radius: 30px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.2);
    transition: all 0.3s ease;
}
.badge-clock:hover {
    transform: scale(1.05);
    box-shadow: 0 0 10px #11aee2;
}
.img-profile:hover {
    transform: scale(1.08);
    box-shadow: 0 0 12px #11aee2;
    transition: all 0.3s ease;
}
</style>

<script>
function updateClock() {
    const now = new Date();
    const options = { hour: '2-digit', minute: '2-digit', second: '2-digit' };
    const clock = document.getElementById('clock');
    const hour = now.getHours();
    let greetText = "Selamat Datang";

    if (hour >= 5 && hour < 12) {
        greetText = "☀️ Selamat Pagi";
    } else if (hour >= 12 && hour < 18) {
        greetText = "🌤️ Selamat Siang";
    } else {
        greetText = "🌙 Selamat Malam";
    }

    clock.textContent = now.toLocaleTimeString('id-ID', options);
    document.getElementById('greeting').innerHTML = 
        `${greetText}, <span class="user-name">{{ auth()->user()->name }}</span>`;
}
setInterval(updateClock, 1000);
updateClock();
</script>