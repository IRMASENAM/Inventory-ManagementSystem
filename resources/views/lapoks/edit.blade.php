@extends('layouts.app')

@section('title', 'Edit Laporan Barang Keluar')

@section('contents')
<div class="container-fluid">
    <div class="card shadow-lg border-0 rounded-3">
        <div class="card-header bg-warning fw-bold">
            <i class="fas fa-edit me-1"></i> Edit Laporan Barang Keluar
        </div>
        <div class="card-body">
            <form action="{{ route('lapoks.update', $lapok->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Tanggal Keluar</label>
                        <input type="date" name="tgl_keluar" class="form-control" value="{{ $lapok->tgl_keluar }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">No. Transaksi</label>
                        <input type="text" name="no_transaksi" class="form-control" value="{{ $lapok->no_transaksi }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Nama Barang</label>
                        <input type="text" name="nama_barang" class="form-control" value="{{ $lapok->nama_barang }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Jenis Barang</label>
                        <input type="text" name="jenis_barang" class="form-control" value="{{ $lapok->jenis_barang }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Jumlah Keluar</label>
                        <input type="text" name="jumlah_keluar" class="form-control" value="{{ $lapok->jumlah_keluar }}">
                    </div>
                </div>
                <div class="mt-4 d-flex justify-content-between">
                    <a href="{{ route('lapoks') }}" class="btn btn-secondary px-4">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-save me-1"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection