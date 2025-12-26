@extends('layouts.app')

@section('title', 'Edit Laporan Barang Masuk')

@section('contents')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow border-0 rounded-lg">
            <div class="card-header bg-warning text-dark">
                <h5 class="mb-0">
                    <i class="fas fa-edit me-1"></i> Edit Laporan Barang Masuk
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('lapoms.update', $lapom->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">
                                <i class="fas fa-calendar-day text-success me-1"></i> Tanggal Masuk
                            </label>
                            <input type="date" name="tgl_masuk" class="form-control" value="{{ $lapom->tgl_masuk }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">
                                <i class="fas fa-receipt text-primary me-1"></i> No. Transaksi
                            </label>
                            <input type="text" name="no_transaksi" class="form-control" value="{{ $lapom->no_transaksi }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">
                                <i class="fas fa-truck text-secondary me-1"></i> Supplier
                            </label>
                            <input type="text" name="nama_supplier" class="form-control" value="{{ $lapom->nama_supplier }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">
                                <i class="fas fa-box text-warning me-1"></i> Barang
                            </label>
                            <input type="text" name="nama_barang" class="form-control" value="{{ $lapom->nama_barang }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">
                                <i class="fas fa-tags text-danger me-1"></i> Jenis Barang
                            </label>
                            <input type="text" name="jenis_barang" class="form-control" value="{{ $lapom->jenis_barang }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">
                                <i class="fas fa-sort-numeric-up text-success me-1"></i> Jumlah Masuk
                            </label>
                            <input type="text" name="jumlah_masuk" class="form-control fw-bold text-danger" value="{{ $lapom->jumlah_masuk }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">
                                <i class="fas fa-dollar-sign text-primary me-1"></i> Harga Beli
                            </label>
                            <input type="text" name="harga_beli" class="form-control" value="{{ $lapom->harga_beli }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">
                                <i class="fas fa-coins text-warning me-1"></i> Total Harga
                            </label>
                            <input type="text" name="total_harga" class="form-control fw-bold text-success" value="{{ $lapom->total_harga }}">
                        </div>
                    </div>

                    <div class="mt-4 text-end">
                        <a href="{{ route('lapoms') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Update Laporan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection