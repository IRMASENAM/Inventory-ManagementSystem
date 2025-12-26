@extends('layouts.app')

@section('title', 'Detail Satuan Barang')

@section('contents')
<div class="container">
    <div class="card shadow border-0 rounded-3">
        <div class="card-header bg-info text-white">
            <h4 class="mb-0"><i class="fas fa-list bg-info me-1"></i> Detail Satuan Barang</h4>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label class="fw-semibold text-primary">
                    <i class="fas fa-box me-1"></i> Nama Satuan
                </label>
                <div class="form-control bg-light">{{ $sabrang->nama_satuan }}</div>
            </div>
            <div class="mb-3">
                <label class="fw-semibold text-success">
                    <i class="fas fa-info-circle me-1"></i> Keterangan
                </label>
                <div class="form-control bg-light">{{ $sabrang->keterangan }}</div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="fw-semibold text-secondary">
                        <i class="fas fa-calendar-plus me-1"></i> Dibuat
                    </label>
                    <div class="form-control bg-light">{{ $sabrang->created_at }}</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="fw-semibold text-secondary">
                        <i class="fas fa-calendar-check me-1"></i> Diperbarui
                    </label>
                    <div class="form-control bg-light">{{ $sabrang->updated_at }}</div>
                </div>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('sabrangs') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
            <a href="{{ route('sabrangs.edit', $sabrang->id) }}" class="btn btn-warning text-white">
                <i class="fas fa-pen me-1"></i> Edit
            </a>
        </div>
    </div>
</div>
@endsection