<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar"
    style="background: linear-gradient(180deg, #005b7f 0%, #007fa3 100%); width: 240px;">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand sidebar-brand-top d-flex align-items-center justify-content-center">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('admin_assets/img/adp.jpg') }}" 
                 alt="Logo PLN" 
                 class="logo-animated"
                 style="height:70px; width:auto; object-fit:contain;">
        </div>
    </a>

    <hr class="sidebar-divider my-0">

    <!-- Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard') }}" title="Lihat Dashboard">
            <i class="fas fa-fw fa-desktop text-warning"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Profile -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('profile') }}" title="Lihat Profile">
            <i class="fas fa-fw fa-user text-warning"></i>
            <span>Profile</span>
        </a>
    </li>

    <!-- Employee -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('employees') }}" title="Lihat Employee">
            <i class="fas fa-fw fa-users text-warning"></i>
            <span>Employee</span>
        </a>
    </li>

    <!-- Pod -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('pods') }}" title="Lihat Plan Of Development">
            <i class="fas fa-fw fa-clipboard-list text-warning"></i>
            <span>Pod</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading text-light">
        Data Master
    </div>

    <!-- Supplier -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('suppliers') }}" title="Lihat Supplier">
            <i class="fas fa-fw fa-truck text-warning"></i>
            <span>Supplier</span>
        </a>
    </li>

    <!-- Master Barang -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsedatamaster"
            aria-expanded="false" aria-controls="collapsedatamaster">
            <i class="fas fa-fw fa-database text-warning"></i>
            <span>Master Barang</span>
        </a>
        <div id="collapsedatamaster" class="collapse" aria-labelledby="headingdatamaster"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header text-primary">Custom Master Barang:</h6>
                <a class="collapse-item" href="{{ route('sabrangs') }}" title="Lihat Satuan Barang">Satuan Barang</a>
                <a class="collapse-item" href="{{ route('jebrangs') }}" title="Lihat Jenis Barang">Jenis Barang</a>
                <a class="collapse-item" href="{{ route('dabrangs') }}" title="Lihat Data Barang">Data Barang</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading text-light">
        Transaksi
    </div>

    <!-- Transaksi -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsetransaksi"
            aria-expanded="false" aria-controls="collapsetransaksi">
            <i class="fas fa-fw fa-exchange-alt text-warning"></i>
            <span>Transaksi</span>
        </a>
        <div id="collapsetransaksi" class="collapse" aria-labelledby="headingtransaksi"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header text-primary">Custom Transaksi:</h6>
                <a class="collapse-item" href="{{ route('barams') }}" title="Lihat Transaksi Masuk">Transaksi Masuk</a>
                <a class="collapse-item" href="{{ route('baraks') }}" title="Lihat Transaksi Keluar">Transaksi Keluar</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading text-light">
        Laporan
    </div>

    <!-- Laporan -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapselaporan"
            aria-expanded="false" aria-controls="collapselaporan">
            <i class="fas fa-fw fa-file-alt text-warning"></i>
            <span>Laporan</span>
        </a>
        <div id="collapselaporan" class="collapse" aria-labelledby="headinglaporan"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header text-primary">Custom Laporan:</h6>
                <a class="collapse-item" href="{{ route('laporan.masuk') }}" title="Lihat Laporan Barang Masuk">Laporan Barang Masuk</a>
                <a class="collapse-item" href="{{ route('laporan.keluar') }}" title="Lihat Laporan Barang Keluar">Laporan Barang Keluar</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>

<style>
/* ==== SIDEBAR STYLE ==== */
.sidebar {
    background: linear-gradient(180deg, #005b7f 0%, #007fa3 100%);
    width: 240px !important;
    font-size: 15px;
}

/* Logo PLN */
.sidebar-brand-top {
    background-color: #ffffff;
    padding: 15px;
    border-bottom: 3px solid #007fa3;
}
.sidebar-brand-icon img {
    transition: transform 0.3s ease;
}
.sidebar-brand-icon img:hover {
    transform: scale(1.05);
}

/* Nav link */
.sidebar .nav-link {
    color: #ffffff;
    font-weight: 500;
    padding: 12px 20px;
    font-size: 15px;
    display: flex;
    align-items: center;
    gap: 12px;
    transition: all 0.25s ease;
}
.sidebar .nav-link i {
    font-size: 1.3rem;
    width: 25px;
}
.sidebar .nav-link:hover {
    background-color: rgba(255, 255, 255, 0.15);
    border-radius: 10px;
    transform: translateX(4px);
}

/* Heading text */
.sidebar-heading {
    font-size: 0.9rem;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    color: #e9f7fa !important;
    margin-left: 10px;
    margin-top: 10px;
}

/* Collapse menu */
.sidebar .collapse-inner .collapse-item {
    color: #333;
    font-weight: 500;
    font-size: 14px;
}
.sidebar .collapse-inner .collapse-item:hover {
    color: #007fa3 !important;
    font-weight: 600;
}
</style>