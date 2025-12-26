@extends('layouts.app')

@section('title', 'Tambah Satuan Barang')

@section('contents')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow border-0 rounded-3">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0"><i class="fas fa-plus text-white me-1"></i> Tambah Satuan Barang</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('sabrangs.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-primary">
                            <i class="fas fa-box me-1"></i> Nama Satuan
                        </label>
                        <input type="text" name="nama_satuan" class="form-control" placeholder="Masukkan nama satuan" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-success">
                            <i class="fas fa-info-circle me-1"></i> Keterangan
                        </label>
                        <input type="text" name="keterangan" class="form-control" placeholder="Masukkan keterangan">
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('sabrangs') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-save me-1"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection