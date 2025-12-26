@extends('layouts.app')

@section('title', 'Edit Transaksi Barang Masuk')

@section('contents')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card shadow-lg border-0 rounded-lg">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">
                    <i class="fas fa-edit text-white me-2"></i> Edit Transaksi Barang Masuk
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('barams.update', $baram->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <!-- Nomor Transaksi -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">
                                <i class="fas fa-file-alt text-primary me-1"></i> Nomor Transaksi
                            </label>
                            <input type="text" name="no_transaksi" class="form-control" 
                                   value="{{ old('no_transaksi', $baram->no_transaksi) }}" required>
                        </div>

                        <!-- Tanggal Masuk -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">
                                <i class="fas fa-calendar-day text-success me-1"></i> Tanggal Masuk
                            </label>
                            <input type="date" name="tgl_masuk" class="form-control" 
                                   value="{{ old('tgl_masuk', $baram->tgl_masuk) }}" required>
                        </div>

                        <!-- Supplier -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">
                                <i class="fas fa-truck text-warning me-1"></i> Supplier
                            </label>
                            <select name="supplier_id" class="form-control" required>
                                <option value="">-- Pilih Supplier --</option>
                                @foreach($suppliers as $sup)
                                    <option value="{{ $sup->id }}" 
                                        {{ old('supplier_id', $baram->supplier_id) == $sup->id ? 'selected' : '' }}>
                                        {{ $sup->nama_supplier }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Barang -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">
                                <i class="fas fa-box-open text-info me-1"></i> Nama Barang
                            </label>
                            <select name="dabrang_id" id="dabrang_id" class="form-control" required>
                                <option value="">-- Pilih Barang --</option>
                                @foreach($dabrangs as $dbr)
                                    <option value="{{ $dbr->id }}" 
                                            data-jebrang-id="{{ $dbr->jebrang->id ?? '' }}"
                                            {{ old('dabrang_id', $baram->dabrang_id) == $dbr->id ? 'selected' : '' }}>
                                        {{ $dbr->nama_barang }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Jenis Barang -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">
                                <i class="fas fa-tags text-danger me-1"></i> Jenis Barang
                            </label>
                            <select name="jebrang_id" id="jebrang_id" class="form-control" required>
                                <option value="">-- Pilih Jenis Barang --</option>
                                @foreach($jebrangs as $jbr)
                                    <option value="{{ $jbr->id }}" 
                                        {{ old('jebrang_id', $baram->jebrang_id) == $jbr->id ? 'selected' : '' }}>
                                        {{ $jbr->nama_jenis }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Jumlah Masuk -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">
                                <i class="fas fa-plus-square text-success me-1"></i> Jumlah Masuk
                            </label>
                            <input type="number" name="jumlah_masuk" class="form-control" min="1"
                                   value="{{ old('jumlah_masuk', $baram->jumlah_masuk) }}" required>
                        </div>

                        <!-- Harga Beli -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">
                                <i class="fas fa-money-bill-wave text-primary me-1"></i> Harga Beli
                            </label>
                            <input type="number" name="harga_beli" class="form-control" min="0"
                                   value="{{ old('harga_beli', $baram->harga_beli) }}" required>
                        </div>

                        <!-- Total Harga -->
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">
                                <i class="fas fa-coins text-warning me-1"></i> Total Harga
                            </label>
                            <input type="text" id="total_harga" class="form-control fw-bold text-primary" 
                                   value="{{ number_format($baram->total_harga, 0, ',', '.') }}" readonly>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('barams') }}" class="btn btn-secondary">
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

{{-- Script Hitung Total & Auto Jenis Barang --}}
<script>
    function calculateTotal() {
        const jumlah = document.querySelector('input[name="jumlah_masuk"]').value || 0;
        const harga  = document.querySelector('input[name="harga_beli"]').value || 0;
        const total  = jumlah * harga;
        document.getElementById('total_harga').value =
            new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(total);
    }
    document.querySelector('input[name="jumlah_masuk"]').addEventListener('input', calculateTotal);
    document.querySelector('input[name="harga_beli"]').addEventListener('input', calculateTotal);

    // Auto set jenis barang sesuai barang
    document.getElementById('dabrang_id').addEventListener('change', function() {
        let jebrangId = this.options[this.selectedIndex].getAttribute('data-jebrang-id');
        if (jebrangId) {
            document.getElementById('jebrang_id').value = jebrangId;
        }
    });
</script>
@endsection