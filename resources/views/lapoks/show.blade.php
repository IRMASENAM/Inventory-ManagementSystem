@extends('layouts.app')

@section('title', 'Detail Laporan Barang Keluar')

@section('contents')
<div class="container-fluid">
    <div class="card shadow-lg border-0 rounded-3">
        <div class="card-header bg-secondary text-white fw-bold">
            <i class="fas fa-eye me-1"></i> Detail Laporan Barang Keluar
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Tanggal Keluar</label>
                    <input type="text" class="form-control" value="{{ $lapok->tgl_keluar }}" readonly>
                </div>
                <div class="col-md-4">
                    <label class="form-label">No. Transaksi</label>
                    <input type="text" class="form-control" value="{{ $lapok->no_transaksi }}" readonly>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Nama Barang</label>
                    <input type="text" class="form-control" value="{{ $lapok->nama_barang }}" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Jenis Barang</label>
                    <input type="text" class="form-control" value="{{ $lapok->jenis_barang }}" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Jumlah Keluar</label>
                    <input type="text" class="form-control" value="{{ $lapok->jumlah_keluar }}" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Dibuat</label>
                    <input type="text" class="form-control" value="{{ $lapok->created_at }}" readonly>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Diperbarui</label>
                    <input type="text" class="form-control" value="{{ $lapok->updated_at }}" readonly>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('lapoks') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
