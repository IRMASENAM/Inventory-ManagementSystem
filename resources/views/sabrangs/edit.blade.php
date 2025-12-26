@extends('layouts.app')

@section('title', 'Edit Satuan Barang')

@section('contents')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow border-0 rounded-3">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0"><i class="fas fa-pen me-1 text-white"></i> Edit Satuan Barang</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('sabrangs.update', $sabrang->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-primary">
                            <i class="fas fa-box me-1"></i> Nama Satuan
                        </label>
                        <input type="text" name="nama_satuan" class="form-control" value="{{ $sabrang->nama_satuan }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-success">
                            <i class="fas fa-info-circle me-1"></i> Keterangan
                        </label>
                        <input type="text" name="keterangan" class="form-control" value="{{ $sabrang->keterangan }}">
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('sabrangs') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-warning text-white">
                            <i class="fas fa-save me-1"></i> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection