@extends('layouts.app')

@section('title', 'Detail Supplier')

@section('contents')
<div class="container">
    <div class="card shadow-lg border-0 rounded-3">
        <div class="card-header bg-info text-white">
            <h4 class="mb-0">
                <i class="fas fa-truck text-warning me-2"></i> 
                Detail Supplier
            </h4>
        </div>
        <div class="card-body">

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="fw-bold">
                        <i class="fas fa-barcode text-success me-1"></i> Kode Supplier
                    </label>
                    <div class="form-control bg-light">{{ $supplier->kode_supplier }}</div>
                </div>
                <div class="col-md-6">
                    <label class="fw-bold">
                        <i class="fas fa-user text-primary me-1"></i> Nama Supplier
                    </label>
                    <div class="form-control bg-light">{{ $supplier->nama_supplier }}</div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="fw-bold">
                        <i class="fas fa-phone-alt text-info me-1"></i> No Telepon
                    </label>
                    <div class="form-control bg-light">{{ $supplier->telp_supplier }}</div>
                </div>
                <div class="col-md-6">
                    <label class="fw-bold">
                        <i class="fas fa-envelope text-danger me-1"></i> Email
                    </label>
                    <div class="form-control bg-light">{{ $supplier->email_supplier }}</div>
                </div>
            </div>

            <div class="mb-3">
                <label class="fw-bold">
                    <i class="fas fa-map-marker-alt text-warning me-1"></i> Alamat
                </label>
                <div class="form-control bg-light">{{ $supplier->alamat_supplier }}</div>
            </div>

            <div class="mb-3 text-center">
                <label class="fw-bold d-block">
                    <i class="fas fa-image text-success me-1"></i> Foto Supplier
                </label>
                @if($supplier->foto_supplier && file_exists(public_path('storage/foto_supplier/' . $supplier->foto_supplier)))
                    <img src="{{ asset('storage/foto_supplier/' . $supplier->foto_supplier) }}" 
                         alt="Foto Supplier" 
                         class="img-thumbnail rounded shadow-sm" 
                         style="max-width: 200px; object-fit:cover;">
                @else
                    <p class="text-muted">Tidak ada foto</p>
                @endif
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="fw-bold">
                        <i class="fas fa-calendar-plus text-success me-1"></i> Created At
                    </label>
                    <div class="form-control bg-light">{{ $supplier->created_at }}</div>
                </div>
                <div class="col-md-6">
                    <label class="fw-bold">
                        <i class="fas fa-calendar-check text-primary me-1"></i> Updated At
                    </label>
                    <div class="form-control bg-light">{{ $supplier->updated_at }}</div>
                </div>
            </div>

        </div>
        <div class="card-footer text-end">
            <a href="{{ route('suppliers') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
            <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-warning text-white">
                <i class="fas fa-edit me-1"></i> Edit
            </a>
        </div>
    </div>
</div>
@endsection