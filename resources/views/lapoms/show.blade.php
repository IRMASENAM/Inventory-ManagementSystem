@extends('layouts.app')

@section('title', 'Detail Laporan Barang Masuk')

@section('contents')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow border-0 rounded-lg">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">
                    <i class="fas fa-file-alt text-warning me-1"></i>
                    Detail Laporan Barang Masuk
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">
                            <i class="fas fa-calendar-day text-success me-1"></i> Tanggal Masuk
                        </label>
                        <input type="text" class="form-control" value="{{ $lapom->tgl_masuk }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">
                            <i class="fas fa-receipt text-primary me-1"></i> No. Transaksi
                        </label>
                        <input type="text" class="form-control" value="{{ $lapom->no_transaksi }}" readonly>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">
                            <i class="fas fa-truck text-secondary me-1"></i> Supplier
                        </label>
                        <input type="text" class="form-control" value="{{ $lapom->nama_supplier }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">
                            <i class="fas fa-box text-warning me-1"></i> Barang
                        </label>
                        <input type="text" class="form-control" value="{{ $lapom->nama_barang }}" readonly>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">
                            <i class="fas fa-tags text-danger me-1"></i> Jenis Barang
                        </label>
                        <input type="text" class="form-control" value="{{ $lapom->jenis_barang }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">
                            <i class="fas fa-sort-numeric-up text-success me-1"></i> Jumlah Masuk
                        </label>
                        <input type="text" class="form-control fw-bold text-success" value="{{ $lapom->jumlah_masuk }}" readonly>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">
                            <i class="fas fa-dollar-sign text-primary me-1"></i> Harga Beli
                        </label>
                        <input type="text" class="form-control" value="{{ $lapom->harga_beli }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">
                            <i class="fas fa-coins text-warning me-1"></i> Total Harga
                        </label>
                        <input type="text" class="form-control fw-bold text-success" value="{{ $lapom->total_harga }}" readonly>
                    </div>
                </div>

                <hr>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">
                            <i class="fas fa-clock text-secondary me-1"></i> Created At
                        </label>
                        <input type="text" class="form-control" value="{{ $lapom->created_at }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">
                            <i class="fas fa-clock text-secondary me-1"></i> Updated At
                        </label>
                        <input type="text" class="form-control" value="{{ $lapom->updated_at }}" readonly>
                    </div>
                </div>

                <div class="mt-4 text-end">
                    <a href="{{ route('lapoms') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection