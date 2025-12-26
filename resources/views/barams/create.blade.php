@extends('layouts.app')

@section('title', 'Create Barang Masuk')

@section('contents')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-plus-circle me-2"></i> Tambah Transaksi Barang Masuk
                </h5>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('barams.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- No Transaksi --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            <i class="fas fa-file-alt text-primary me-1"></i> No. Transaksi
                        </label>
                        <input type="text" name="no_transaksi" class="form-control" placeholder="exm : BRG-M-001"
                               value="{{ old('no_transaksi') }}" required>
                    </div>

                    {{-- Tanggal Masuk --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            <i class="fas fa-calendar-day text-success me-1"></i> Tanggal Masuk
                        </label>
                        <input type="date" name="tgl_masuk" class="form-control"
                               value="{{ old('tgl_masuk') }}" required>
                    </div>

                    {{-- Supplier --}}
                    <div class="mb-3">
                        <label for="supplier_id" class="form-label fw-bold">
                            <i class="fas fa-truck text-warning me-1"></i> Supplier
                        </label>
                        <select name="supplier_id" id="supplier_id" class="form-control" required>
                            <option value="">-- Pilih Supplier --</option>
                            @foreach($suppliers as $sup)
                                <option value="{{ $sup->id }}" {{ old('supplier_id') == $sup->id ? 'selected' : '' }}>
                                    {{ $sup->nama_supplier }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Barang --}}
                    <div class="mb-3">
                        <label for="dabrang_id" class="form-label fw-bold">
                            <i class="fas fa-box text-info me-1"></i> Barang
                        </label>
                        <select name="dabrang_id" id="dabrang_id" class="form-control" required>
                            <option value="">-- Pilih Barang --</option>
                            @foreach($dabrangs as $dbr)
                                <option value="{{ $dbr->id }}"
                                        data-jebrang-id="{{ $dbr->jebrang->id ?? '' }}">
                                    {{ $dbr->nama_barang }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Jenis Barang --}}
                    <div class="mb-3">
                        <label for="jebrang_id" class="form-label fw-bold">
                            <i class="fas fa-tags me-1 text-warning"></i> Jenis Barang
                        </label>
                        <select name="jebrang_id" id="jebrang_id" class="form-control" required>
                            <option value="">-- Pilih Jenis Barang --</option>
                            @foreach($jebrangs as $jbr)
                                <option value="{{ $jbr->id }}" {{ old('jebrang_id') == $jbr->id ? 'selected' : '' }}>
                                    {{ $jbr->nama_jenis }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Jumlah & Harga --}}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">
                                <i class="fas fa-plus-square text-success me-1"></i> Jumlah Masuk
                            </label>
                            <input type="number" name="jumlah_masuk" class="form-control" placeholder="Jumlah barang masuk" 
                                   value="{{ old('jumlah_masuk') }}" min="1" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">
                                <i class="fas fa-money-bill-wave text-primary me-1"></i> Harga Beli (Rp)
                            </label>
                            <input type="number" name="harga_beli" class="form-control" placeholder="exm : 5000"
                                   value="{{ old('harga_beli') }}" min="0" required>
                        </div>
                    </div>

                    {{-- Total Harga --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            <i class="fas fa-calculator text-info me-1"></i> Total Harga
                        </label>
                        <input type="text" class="form-control fw-bold text-primary" id="total_harga" readonly>
                    </div>

                    {{-- Actions --}}
                    <div class="mb-3">
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-save me-1"></i> Save Barang Masuk
                        </button>
                        <a href="{{ route('barams') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Script --}}
<script>
    // Auto set jenis barang sesuai barang
    document.getElementById('dabrang_id').addEventListener('change', function() {
        let jebrangId = this.options[this.selectedIndex].getAttribute('data-jebrang-id');
        if (jebrangId) {
            document.getElementById('jebrang_id').value = jebrangId;
        }
    });

    // Hitung total harga
    function calculateTotal() {
        const jumlah = document.querySelector('input[name="jumlah_masuk"]').value || 0;
        const harga  = document.querySelector('input[name="harga_beli"]').value || 0;
        const total  = jumlah * harga;
        document.getElementById('total_harga').value =
            new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(total);
    }
    document.querySelector('input[name="jumlah_masuk"]').addEventListener('input', calculateTotal);
    document.querySelector('input[name="harga_beli"]').addEventListener('input', calculateTotal);
</script>
@endsection