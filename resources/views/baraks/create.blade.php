@extends('layouts.app')

@section('title', 'Create Barang Keluar')

@section('contents')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-plus-circle me-2"></i> Tambah Transaksi Barang Keluar
                </h5>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('baraks.store') }}" method="POST">
                    @csrf

                    <!-- No Transaksi -->
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="fas fa-file-invoice me-1 text-primary"></i> No. Transaksi
                        </label>
                        <input type="text" name="no_transaksi" class="form-control" placeholder="BRG-K-001"
                               value="{{ old('no_transaksi') }}" required>
                    </div>

                    <!-- Tanggal Keluar -->
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="fas fa-calendar-day me-1 text-success"></i> Tanggal Keluar
                        </label>
                        <input type="date" name="tgl_keluar" class="form-control"
                               value="{{ old('tgl_keluar') }}" required>
                    </div>

                    <!-- Pilih Barang -->
                    <div class="mb-3">
                        <label for="dabrang_id" class="form-label">
                            <i class="fas fa-box me-1 text-info"></i> Pilih Barang
                        </label>
                        <select name="dabrang_id" id="dabrang_id" class="form-control" required>
                            <option value="">-- Pilih Barang --</option>
                            @foreach($dabrangs as $dbr)
                                <option value="{{ $dbr->id }}" {{ old('dabrang_id') == $dbr->id ? 'selected' : '' }}>
                                    {{ $dbr->nama_barang }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Pilih POD Tujuan -->
                    <div class="mb-3">
                        <label for="pod_id" class="form-label">
                            <i class="fas fa-clipboard-list me-1 text-warning"></i> POD Tujuan
                        </label>
                        <select name="pod_id" id="pod_id" class="form-control" required>
                            <option value="">-- Pilih Nomor POD --</option>
                            @foreach($pods as $pod)
                                <option value="{{ $pod->id }}" {{ old('pod_id') == $pod->id ? 'selected' : '' }}>
                                    {{ $pod->nomor_pod }} — {{ $pod->departemen }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Jumlah Keluar -->
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="fas fa-minus-circle me-1 text-danger"></i> Jumlah Keluar
                        </label>
                        <input type="number" name="jumlah_keluar" class="form-control" placeholder="exm : 5"
                               value="{{ old('jumlah_keluar') }}" min="1" required>
                    </div>

                    <!-- Tombol -->
                    <div class="text-end">
                        <button type="submit" class="btn btn-warning px-4 me-2">
                            <i class="fas fa-save me-1"></i> Simpan
                        </button>
                        <a href="{{ route('baraks') }}" class="btn btn-secondary px-4">
                            <i class="fas fa-times me-1"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection