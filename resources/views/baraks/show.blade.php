@extends('layouts.app')

@section('title', 'Detail Transaksi Barang Keluar')

@section('contents')
<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="mb-0">
        <i class="fas fa-file-alt text-danger me-2"></i> Detail Transaksi Barang Keluar
    </h1>
</div>
<hr />

<!-- Card Informasi Transaksi -->
<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0"><i class="fas fa-file-invoice"></i> Informasi Transaksi</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">
                    <i class="fas fa-hashtag text-primary me-1"></i> No. Transaksi
                </label>
                <input type="text" class="form-control" value="{{ $barak->no_transaksi }}" readonly>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">
                    <i class="fas fa-calendar-day text-success me-1"></i> Tanggal Keluar
                </label>
                <input type="text" class="form-control"
                       value="{{ \Carbon\Carbon::parse($barak->tgl_keluar)->format('d F Y') }}" readonly>
            </div>
        </div>
    </div>
</div>

<!-- Card Informasi POD -->
<div class="card mb-4">
    <div class="card-header bg-info text-white">
        <h5 class="mb-0"><i class="fas fa-clipboard-list"></i> Informasi POD</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">
                    <i class="fas fa-barcode text-primary me-1"></i> Nomor POD
                </label>
                <input type="text" class="form-control" value="{{ $barak->pod->nomor_pod ?? '-' }}" readonly>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">
                    <i class="fas fa-layer-group text-success me-1"></i> Jenis POD
                </label>
                <input type="text" class="form-control" value="{{ $barak->pod->jenis_pod ?? '-' }}" readonly>
            </div>
        </div>
    </div>
</div>

<!-- Card Informasi Barang -->
<div class="card mb-4">
    <div class="card-header bg-success text-white">
        <h5 class="mb-0"><i class="fas fa-box"></i> Informasi Barang</h5>
    </div>
    <div class="card-body">
        <label class="form-label fw-bold">
            <i class="fas fa-box-open text-info me-1"></i> Nama Barang
        </label>
        <input type="text" class="form-control" value="{{ $barak->dabrang->nama_barang ?? '-' }}" readonly>
    </div>
</div>

<!-- Card Informasi Jumlah -->
<div class="card mb-4">
    <div class="card-header bg-warning text-white">
        <h5 class="mb-0"><i class="fas fa-calculator"></i> Jumlah & Stok</h5>
    </div>
    <div class="card-body">
        <label class="form-label fw-bold">
            <i class="fas fa-minus-square text-danger me-1"></i> Jumlah Keluar
        </label>
        <div class="input-group mb-3">
            <input type="text" class="form-control" value="{{ $barak->jumlah_keluar }}" readonly>
            <span class="input-group-text">
                <span class="badge bg-danger text-white">-{{ $barak->jumlah_keluar }}</span>
            </span>
        </div>

        <div class="alert alert-info text-center">
            <h4 class="text-danger mb-0">
                <i class="fas fa-cubes me-1"></i>{{ $barak->jumlah_keluar }}
            </h4>
            <small>Unit Keluar</small>
        </div>
    </div>
</div>

<!-- Card Informasi Sistem -->
<div class="card mb-4">
    <div class="card-header bg-secondary text-white">
        <h5 class="mb-0"><i class="fas fa-clock"></i> Informasi Sistem</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">
                    <i class="fas fa-calendar-plus text-primary me-1"></i> Dibuat Pada
                </label>
                <input type="text" class="form-control"
                       value="{{ $barak->created_at ? $barak->created_at->format('d F Y - H:i:s') : '-' }}" readonly>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">
                    <i class="fas fa-calendar-check text-success me-1"></i> Terakhir Diupdate
                </label>
                <input type="text" class="form-control"
                       value="{{ $barak->updated_at ? $barak->updated_at->format('d F Y - H:i:s') : '-' }}" readonly>
            </div>
        </div>
    </div>
</div>

<!-- Tombol Aksi -->
<div class="text-center mt-4">
    <a href="{{ route('baraks.edit', $barak->id) }}" class="btn btn-warning me-2">
        <i class="fas fa-edit"></i> Edit
    </a>
    <form action="{{ route('baraks.destroy', $barak->id) }}" method="POST" class="d-inline"
          onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?');">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger me-2">
            <i class="fas fa-trash"></i> Hapus
        </button>
    </form>
    <a href="{{ route('baraks') }}" class="btn btn-secondary">
        <i class="fas fa-list"></i> Semua Transaksi
    </a>
</div>

<style>
.card {
    box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
    border: none;
}
.form-control[readonly] {
    background-color: #f8f9fc;
    border-color: #d1d3e2;
}
.fw-bold { font-weight: 600; }
.alert-info {
    background-color: #e7f3ff;
    border-color: #b8daff;
}
.badge { font-size: 0.8rem; }
</style>
@endsection