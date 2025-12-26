@extends('layouts.app')

@section('title', 'Edit Transaksi Barang Keluar')

@section('contents')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card shadow-lg border-0 rounded-lg">
            <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-edit text-white me-2"></i> Edit Transaksi Barang Keluar
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('baraks.update', $barak->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">
                                <i class="fas fa-file-alt text-primary me-1"></i> Nomor Transaksi
                            </label>
                            <input type="text" name="no_transaksi" class="form-control" 
                                   value="{{ $barak->no_transaksi }}" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">
                                <i class="fas fa-calendar-day text-danger me-1"></i> Tanggal Keluar
                            </label>
                            <input type="date" name="tgl_keluar" class="form-control" 
                                   value="{{ $barak->tgl_keluar }}" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">
                                <i class="fas fa-clipboard-list text-info me-1"></i> Nomor POD (Tujuan)
                            </label>
                            <select name="pod_id" id="pod_id" class="form-control" required>
                                <option value="">-- Pilih Nomor POD --</option>
                                @foreach($pods as $pod)
                                    <option value="{{ $pod->id }}" 
                                        {{ $barak->pod_id == $pod->id ? 'selected' : '' }}>
                                        {{ $pod->nomor_pod }} - {{ $pod->jenis_pod }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="dabrang_id" class="form-label fw-bold">
                                <i class="fas fa-box-open text-info me-1"></i> Nama Barang
                            </label>
                            <select name="dabrang_id" id="dabrang_id" class="form-control" required>
                                <option value="">-- Pilih Barang --</option>
                                @foreach($dabrangs as $dbr)
                                    <option value="{{ $dbr->id }}" 
                                        {{ $barak->dabrang_id == $dbr->id ? 'selected' : '' }}>
                                        {{ $dbr->nama_barang }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">
                                <i class="fas fa-minus-square text-danger me-1"></i> Jumlah Keluar
                            </label>
                            <input type="number" name="jumlah_keluar" class="form-control" 
                                   value="{{ $barak->jumlah_keluar }}" min="1" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">
                                <i class="fas fa-file text-secondary me-1"></i> Keterangan (Opsional)
                            </label>
                            <input type="text" name="keterangan" class="form-control" 
                                   value="{{ $barak->keterangan }}">
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('baraks') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-warning text-white">
                            <i class="fas fa-save me-1"></i> Update Transaksi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection