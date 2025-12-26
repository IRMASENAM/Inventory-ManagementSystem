@extends('layouts.app')

@section('title', 'Detail Jenis Barang')

@section('contents')
<div class="card shadow border-0 rounded-3">
    <div class="card-header bg-info text-white">
        <h5 class="mb-0"><i class="fas fa-list bg-info me-1"></i> Detail Jenis Barang</h5>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <label class="form-label fw-semibold text-primary">
                <i class="fas fa-tag me-1"></i> Nama Jenis
            </label>
            <input type="text" class="form-control bg-light" value="{{ $jebrang->nama_jenis }}" readonly>
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold text-success">
                <i class="fas fa-info-circle me-1"></i> Keterangan
            </label>
            <input type="text" class="form-control bg-light" value="{{ $jebrang->keterangan }}" readonly>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold text-secondary">
                    <i class="fas fa-calendar-plus me-1"></i> Created At
                </label>
                <input type="text" class="form-control bg-light" value="{{ $jebrang->created_at }}" readonly>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold text-secondary">
                    <i class="fas fa-calendar-check me-1"></i> Updated At
                </label>
                <input type="text" class="form-control bg-light" value="{{ $jebrang->updated_at }}" readonly>
            </div>
        </div>
    </div>
    <div class="card-footer d-flex justify-content-between">
        <a href="{{ route('jebrangs') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Back
        </a>
        <a href="{{ route('jebrangs.edit', $jebrang->id) }}" class="btn btn-warning text-white">
            <i class="fas fa-pen me-1"></i> Edit
        </a>
    </div>
</div>
@endsection