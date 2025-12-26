@extends('layouts.app')

@section('title', 'Edit Jenis Barang')

@section('contents')
<div class="card shadow border-0 rounded-3">
    <div class="card-header bg-info text-white">
        <h5 class="mb-0"><i class="fas fa-pen text-white me-1"></i> Edit Jenis Barang</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('jebrangs.update', $jebrang->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label fw-semibold text-primary">
                    <i class="fas fa-tag me-1"></i> Nama Jenis
                </label>
                <input 
                    type="text" 
                    name="nama_jenis" 
                    class="form-control" 
                    placeholder="Masukkan Nama Jenis" 
                    value="{{ $jebrang->nama_jenis }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold text-success">
                    <i class="fas fa-info-circle me-1"></i> Keterangan
                </label>
                <input 
                    type="text" 
                    name="keterangan" 
                    class="form-control" 
                    placeholder="Masukkan Keterangan" 
                    value="{{ $jebrang->keterangan }}">
            </div>
            <div class="d-flex justify-content-between">
                <a href="{{ route('jebrangs') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Back
                </a>
                <button type="submit" class="btn btn-warning text-white">
                    <i class="fas fa-save me-1"></i> Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection