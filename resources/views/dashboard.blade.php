@extends('layouts.app')

@section('title', 'Dashboard')

@section('contents')
<div class="container dashboard-container">

    <!-- Judul -->
    <h1 class="dashboard-title mb-4 text-center" style="font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif">
        <i class="fas fa-tachometer-alt text-info me-2"></i> 
        Dashboard Eksintas
        <br>
        <i> - Eksis Inventaris System - </i>
        <small class="text-muted d-block">Efisiensi • Kinerja • Sistem Informasi</small>
    </h1>

    <!-- Statistik Cards -->
    <div class="row g-3">
        {{-- Contoh Card Template (ulangin untuk semua) --}}
        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-4 stat-card bg-gradient-blue text-white">
                <div class="card-body text-center">
                    <div class="icon-circle mb-2">
                        <i class="fas fa-users fa-lg"></i>
                    </div>
                    <h6 class="card-title">Data Pegawai</h6>
                    <h2 class="fw-bold">{{ $totalPegawai }}</h2>
                    <a href="{{ route('employees') }}" class="stretched-link text-link-light">Lihat Detail</a>
                </div>
            </div>
        </div>

        {{-- Supplier --}}
        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-4 stat-card bg-gradient-orange text-white">
                <div class="card-body text-center">
                    <div class="icon-circle mb-2">
                        <i class="fas fa-truck fa-lg"></i>
                    </div>
                    <h6 class="card-title">Data Supplier</h6>
                    <h2 class="fw-bold">{{ $totalSupplier }}</h2>
                    <a href="{{ route('suppliers') }}" class="stretched-link text-link-light">Lihat Detail</a>
                </div>
            </div>
        </div>

        {{-- Satuan Barang --}}
        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-4 stat-card bg-gradient-green text-white">
                <div class="card-body text-center">
                    <div class="icon-circle mb-2">
                        <i class="fas fa-balance-scale fa-lg"></i>
                    </div>
                    <h6 class="card-title">Data Satuan Barang</h6>
                    <h2 class="fw-bold">{{ $totalSatuan }}</h2>
                    <a href="{{ route('sabrangs') }}" class="stretched-link text-link-light">Lihat Detail</a>
                </div>
            </div>
        </div>

        {{-- Jenis Barang --}}
        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-4 stat-card bg-gradient-red text-white">
                <div class="card-body text-center">
                    <div class="icon-circle mb-2">
                        <i class="fas fa-box-open fa-lg"></i>
                    </div>
                    <h6 class="card-title">Data Jenis Barang</h6>
                    <h2 class="fw-bold">{{ $totalJenis }}</h2>
                    <a href="{{ route('jebrangs') }}" class="stretched-link text-link-light">Lihat Detail</a>
                </div>
            </div>
        </div>

        {{-- Data Barang --}}
        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-4 stat-card bg-gradient-red text-white">
                <div class="card-body text-center">
                    <div class="icon-circle mb-2">
                        <i class="fas fa-box-open fa-lg"></i>
                    </div>
                    <h6 class="card-title">Data Barang - Barang</h6>
                    <h2 class="fw-bold">{{ $totalBarang }}</h2>
                    <a href="{{ route('dabrangs') }}" class="stretched-link text-link-light">Lihat Detail</a>
                </div>
            </div>
        </div>

        {{-- Barang Masuk --}}
        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-4 stat-card bg-gradient-green text-white">
                <div class="card-body text-center">
                    <div class="icon-circle mb-2">
                        <i class="fas fa-box-open fa-lg"></i>
                    </div>
                    <h6 class="card-title">Data Barang Masuk</h6>
                    <h2 class="fw-bold">{{ $totalBarangMasuk }}</h2>
                    <a href="{{ route('barams') }}" class="stretched-link text-link-light">Lihat Detail</a>
                </div>
            </div>
        </div>

        {{-- Barang Keluar --}}
        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-4 stat-card bg-gradient-orange text-white">
                <div class="card-body text-center">
                    <div class="icon-circle mb-2">
                        <i class="fas fa-arrow-up fa-lg"></i>
                    </div>
                    <h6 class="card-title">Data Barang Keluar</h6>
                    <h2 class="fw-bold">{{ $totalBarangKeluar }}</h2>
                    <a href="{{ route('baraks') }}" class="stretched-link text-link-light">Lihat Detail</a>
                </div>
            </div>
        </div>

        {{-- Pengaturan --}}
        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-4 stat-card bg-gradient-blue text-white">
                <div class="card-body text-center">
                    <div class="icon-circle mb-2">
                        <i class="fas fa-cog fa-lg"></i>
                    </div>
                    <h6 class="card-title">Tentang Sistem</h6>
                    <br>
                    <br>
                    <a href="{{ route('settings') }}" class="stretched-link text-link-light">Lihat Detail</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik -->
    <div class="row mt-4">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-4 chart-card">
                <div class="card-header bg-gradient-blue text-white fw-bold">
                    <i class="fas fa-chart-bar me-2"></i> Grafik Barang Masuk & Keluar per Bulan
                </div>
                <div class="card-body">
                    <canvas id="chartBar"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-lg border-0 rounded-4 chart-card">
                <div class="card-header bg-gradient-blue text-white fw-bold">
                    <i class="fas fa-chart-pie me-2"></i> Perbandingan Masuk vs Keluar
                </div>
                <div class="card-body">
                    <canvas id="chartPie"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Judul */
.dashboard-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
    position: relative;
}

.dashboard-title {
    font-family: 'Segoe UI', Roboto, sans-serif;
    font-weight: 700;
    color: #333;
    text-shadow: 1px 1px 3px rgba(0,0,0,0.1);
}

/* Icon lingkaran */
.icon-circle {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: rgba(255,255,255,0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
}

/* Card Gradient */
.bg-gradient-blue {
    background: linear-gradient(135deg, #36d1dc, #5b86e5);
}
.bg-gradient-orange {
    background: linear-gradient(135deg, #f7971e, #ffd200);
}
.bg-gradient-green {
    background: linear-gradient(135deg, #56ab2f, #a8e063);
}
.bg-gradient-red {
    background: linear-gradient(135deg, #e53935, #e35d5b);
}

/* Chart card */
.chart-card {
    overflow: hidden;
}
.chart-card .card-body {
    background: #fafafa;
    border-radius: 0 0 1rem 1rem;
}

/* Link */
.text-link-light {
    font-size: 0.85rem;
    font-weight: 500;
    color: #fff;
    opacity: 0.9;
}
.text-link-light:hover {
    text-decoration: underline;
    opacity: 1;
}
</style>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

<script>
// ------------------------
// DEFAULT STYLE GLOBAL
// ------------------------
Chart.defaults.font.family = "'Poppins', 'Segoe UI', sans-serif";
Chart.defaults.font.size = 13;
Chart.defaults.color = '#2f2f2f';

// ------------------------
// BAR CHART : Barang Masuk & Keluar
// ------------------------
const ctxBar = document.getElementById('chartBar').getContext('2d');
const gradientMasuk = ctxBar.createLinearGradient(0, 0, 0, 400);
gradientMasuk.addColorStop(0, '#00bcd4');
gradientMasuk.addColorStop(1, '#0097a7');

const gradientKeluar = ctxBar.createLinearGradient(0, 0, 0, 400);
gradientKeluar.addColorStop(0, '#ff9800');
gradientKeluar.addColorStop(1, '#f57c00');

new Chart(ctxBar, {
    type: 'bar',
    data: {
        labels: @json($labels),
        datasets: [
            {
                label: 'Barang Masuk',
                data: @json($jumlahMasuk),
                backgroundColor: gradientMasuk,
                borderColor: '#00acc1',
                borderWidth: 2,
                borderRadius: 8,
                barPercentage: 0.6
            },
            {
                label: 'Barang Keluar',
                data: @json($jumlahKeluar),
                backgroundColor: gradientKeluar,
                borderColor: '#ef6c00',
                borderWidth: 2,
                borderRadius: 8,
                barPercentage: 0.6
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'top',
                labels: {
                    color: '#004b63',
                    font: { weight: '600' }
                }
            },
            datalabels: {
                anchor: 'end',
                align: 'top',
                color: '#004b63',
                font: { weight: '600' },
                formatter: value => value > 0 ? value : ''
            },
            tooltip: {
                backgroundColor: '#004b63',
                titleColor: '#fff',
                bodyColor: '#fff',
                padding: 10,
                cornerRadius: 8
            }
        },
        scales: {
            x: {
                grid: { display: false },
                ticks: { color: '#333' }
            },
            y: {
                beginAtZero: true,
                grid: { color: 'rgba(0,0,0,0.05)' },
                ticks: { color: '#333' },
            }
        },
        animation: {
            duration: 1200,
            easing: 'easeOutCubic'
        }
    },
    plugins: [ChartDataLabels]
});
const ctxPie = document.getElementById('chartPie').getContext('2d');

new Chart(ctxPie, {
    type: 'doughnut',
    data: {
        labels: ['Barang Masuk', 'Barang Keluar'],
        datasets: [{
            data: [@json(array_sum($jumlahMasuk)), @json(array_sum($jumlahKeluar))],
            backgroundColor: [
                'rgba(0, 188, 212, 0.9)', // biru PLN
                'rgba(255, 202, 40, 0.9)' // kuning PLN
            ],
            borderWidth: 3,
            borderColor: '#fff',
            hoverOffset: 10,
            cutout: '68%'
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    color: '#004b63',
                    font: { weight: '600' },
                    boxWidth: 20
                }
            },
            datalabels: {
                color: '#fff',
                font: { weight: 'bold', size: 14 },
                formatter: (value, ctx) => {
                    let total = ctx.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                    let percentage = (value / total * 100).toFixed(1) + '%';
                    return percentage;
                }
            },
            tooltip: {
                backgroundColor: '#004b63',
                titleColor: '#fff',
                bodyColor: '#fff',
                callbacks: {
                    label: function(context) {
                        let label = context.label || '';
                        let value = context.raw;
                        return label + ': ' + value + ' unit';
                    }
                }
            }
        },
        animation: {
            animateRotate: true,
            animateScale: true,
            duration: 1300
        }
    },
    plugins: [ChartDataLabels]
});
</script>

<style>
.chart-card .card-body {
    background: linear-gradient(to bottom right, #f9fcff, #ecf7ff);
    border-radius: 0 0 1rem 1rem;
    transition: all 0.3s ease;
}
.chart-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 18px rgba(0, 0, 0, 0.12);
}
#chartBar, #chartPie {
    min-height: 300px;
    transition: transform 0.3s ease;
}
#chartBar:hover, #chartPie:hover {
    transform: scale(1.01);
}
</style>
@endsection