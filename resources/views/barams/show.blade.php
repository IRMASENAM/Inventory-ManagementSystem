@extends('layouts.app')

@section('title', 'Show Transaksi Barang Masuk')

@section('contents')
<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="mb-0">
        <i class="fas fa-file-alt text-primary me-2"></i> Detail Transaksi Barang Masuk
    </h1>
</div>
<hr />

<!-- Informasi Transaksi -->
<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0"><i class="fas fa-file-invoice"></i> Informasi Transaksi</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold">
                    <i class="fas fa-file-alt text-primary me-1"></i> No. Transaksi
                </label>
                <input type="text" class="form-control" value="{{ $baram->no_transaksi }}" readonly>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold">
                    <i class="fas fa-calendar-day text-success me-1"></i> Tanggal Masuk
                </label>
                <input type="text" class="form-control"
                       value="{{ \Carbon\Carbon::parse($baram->tgl_masuk)->format('d F Y') }}" readonly>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold">
                    <i class="fas fa-truck text-warning me-1"></i> Supplier
                </label>
                <input type="text" class="form-control" 
                       value="{{ $baram->supplier->nama_supplier ?? '-' }}" readonly>
            </div>
        </div>
    </div>
</div>

<!-- Informasi Barang -->
<div class="card mb-4">
    <div class="card-header bg-success text-white">
        <h5 class="mb-0"><i class="fas fa-box"></i> Informasi Barang</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">
                    <i class="fas fa-box-open text-info me-1"></i> Nama Barang
                </label>
                <input type="text" class="form-control" value="{{ $baram->dabrang->nama_barang ?? '-' }}" readonly>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">
                    <i class="fas fa-tags text-danger me-1"></i> Jenis Barang
                </label>
                <input type="text" class="form-control" value="{{ $baram->jebrang->nama_jenis ?? '-' }}" readonly>
            </div>
        </div>
    </div>
</div>

<!-- Informasi Harga & Jumlah -->
<div class="card mb-4">
    <div class="card-header bg-warning text-dark">
        <h5 class="mb-0"><i class="fas fa-calculator"></i> Informasi Harga & Stok</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold">
                    <i class="fas fa-plus-square text-success me-1"></i> Jumlah Masuk
                </label>
                <div class="input-group">
                    <input type="text" class="form-control" value="{{ $baram->jumlah_masuk }}" readonly>
                    <span class="input-group-text">
                        <span class="badge bg-success text-white">+{{ $baram->jumlah_masuk }}</span>
                    </span>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold">
                    <i class="fas fa-money-bill-wave text-primary me-1"></i> Harga Beli (per unit)
                </label>
                <div class="input-group">
                    <span class="input-group-text">Rp</span>
                    <input type="text" class="form-control"
                           value="{{ number_format($baram->harga_beli, 0, ',', '.') }}" readonly>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold">
                    <i class="fas fa-coins text-warning me-1"></i> Total Harga
                </label>
                <div class="input-group">
                    <span class="input-group-text">Rp</span>
                    <input type="text" class="form-control fw-bold"
                           value="{{ number_format($baram->total_harga, 2, ',', '.') }}"
                           readonly style="background-color: #fff3cd;">
                </div>
            </div>
        </div>

        <!-- Summary -->
        <div class="alert alert-info mt-3">
            <div class="row text-center">
                <div class="col-md-4">
                    <h4 class="text-primary">
                        <i class="fas fa-cubes me-1"></i>{{ $baram->jumlah_masuk }}
                    </h4>
                    <small>Unit Masuk</small>
                </div>
                <div class="col-md-4">
                    <h4 class="text-success">
                        <i class="fas fa-money-bill-wave me-1"></i>Rp {{ number_format($baram->harga_beli, 0, ',', '.') }}
                    </h4>
                    <small>Harga per Unit</small>
                </div>
                <div class="col-md-4">
                    <h4 class="text-warning">
                        <i class="fas fa-coins me-1"></i>Rp {{ number_format($baram->total_harga, 2, ',', '.') }}
                    </h4>
                    <small>Total Harga</small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Informasi Sistem -->
<div class="card">
    <div class="card-header bg-info text-white">
        <h5 class="mb-0"><i class="fas fa-clock"></i> Informasi Sistem</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">
                    <i class="fas fa-calendar-plus text-primary me-1"></i> Dibuat Pada
                </label>
                <input type="text" class="form-control"
                       value="{{ $baram->created_at ? $baram->created_at->format('d F Y - H:i:s') : '-' }}" readonly>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">
                    <i class="fas fa-calendar-check text-success me-1"></i> Terakhir Diupdate
                </label>
                <input type="text" class="form-control"
                       value="{{ $baram->updated_at ? $baram->updated_at->format('d F Y - H:i:s') : '-' }}" readonly>
            </div>
        </div>
    </div>
</div>

<!-- Action Buttons -->
<div class="row mt-4">
    <div class="col-md-12">
        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
            <a href="{{ route('barams.edit', $baram->id) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit Transaksi
            </a>
            <form action="{{ route('barams.destroy', $baram->id) }}" method="POST" style="display:inline;"
                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?');">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">
                    <i class="fas fa-trash"></i> Hapus Transaksi
                </button>
            </form>
            <a href="{{ route('barams') }}" class="btn btn-secondary">
                <i class="fas fa-list"></i> Lihat Semua Transaksi
            </a>
        </div>
    </div>
</div>

<style>
.card {
    box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
    border: none;
    margin-bottom: 1.5rem;
}
.form-control[readonly] {
    background-color: #f8f9fc;
    border-color: #d1d3e2;
}
.fw-bold {
    font-weight: 600;
}
.alert-info {
    background-color: #e7f3ff;
    border-color: #b8daff;
}
.badge {
    font-size: 0.8rem;
}
</style>
@endsection