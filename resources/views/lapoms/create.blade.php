@extends('layouts.app')

@section('title', 'Create Laporan Barang Masuk')

@section('contents')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow border-0 rounded-lg">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="fas fa-file-invoice text-warning me-1"></i>
                    Add Laporan Barang Masuk
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('lapoms.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            <i class="fas fa-calendar-alt text-success me-1"></i> Tanggal Masuk
                        </label>
                        <input type="date" name="tgl_masuk" class="form-control" value="{{ old('tgl_masuk') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            <i class="fas fa-receipt text-info me-1"></i> No. Transaksi
                        </label>
                        <input type="text" placeholder="Masukkan No. Transaksi" name="no_transaksi" class="form-control" value="{{ old('no_transaksi') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            <i class="fas fa-truck text-primary me-1"></i> Supplier
                        </label>
                        <input type="text" placeholder="Masukkan Nama Supplier" name="nama_supplier" class="form-control" value="{{ old('nama_supplier') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            <i class="fas fa-box text-secondary me-1"></i> Barang
                        </label>
                        <input type="text" placeholder="Masukkan Nama Barang" name="nama_barang" class="form-control" value="{{ old('nama_barang') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            <i class="fas fa-tags text-warning me-1"></i> Jenis Barang
                        </label>
                        <input type="text" placeholder="Masukkan Jenis Barang" name="jenis_barang" class="form-control" value="{{ old('jenis_barang') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            <i class="fas fa-sort-numeric-up text-success me-1"></i> Jumlah Masuk
                        </label>
                        <input type="number" placeholder="Masukkan Jumlah Masuk" name="jumlah_masuk" class="form-control" value="{{ old('jumlah_masuk') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            <i class="fas fa-dollar-sign text-info me-1"></i> Harga Beli
                        </label>
                        <input type="number" placeholder="Masukkan Harga Beli" name="harga_beli" class="form-control" value="{{ old('harga_beli') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            <i class="fas fa-coins text-success me-1"></i> Total
                        </label>
                        <input type="number" placeholder="Total Harga" name="total_harga" class="form-control fw-bold text-success" value="{{ old('total_harga') }}" required>
                    </div>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-1"></i> Save Laporan
                    </button>
                    <a href="{{ route('lapoms') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-1"></i> Cancel
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection