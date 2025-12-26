@extends('layouts.app')

@section('title', 'Home Laporan Barang Masuk')

@section('contents')
    {{-- Header Page --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-gray-800" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
            <i class="fas fa-file-invoice me-2"></i> Laporan Barang Masuk
        </h1>
    </div>

    {{-- Alert Success --}}
    @if (Session::has('success'))
        <div class="alert alert-success mb-3" role="alert">
            <i class="fas fa-check-circle me-1"></i> {{ Session::get('success') }}
        </div>
    @endif

    {{-- Card Table --}}
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-header bg-info text-white fw-semibold">
            <i class="fas fa-file-invoice me-1"></i> Data Laporan Barang Masuk
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tanggal Masuk</th>
                            <th>No. Transaksi</th>
                            <th>Supplier</th>
                            <th>Barang</th>
                            <th>Jenis Barang</th>
                            <th>Jumlah Masuk</th>
                            <th>Harga Beli</th>
                            <th>Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
    @forelse($lapom as $lpm)
        <tr>
            <td>{{ $lpm->id }}</td>
            <td>{{ $lpm->tgl_masuk }}</td>
            <td>{{ $lpm->no_transaksi }}</td>
            <td>{{ $lpm->supplier->nama_supplier ?? '-' }}</td>
            <td>{{ $lpm->dabrang->nama_barang ?? '-' }}</td>
            <td>{{ $lpm->dabrang->jebrang->nama_jenis ?? '-' }}</td>
            <td>{{ $lpm->jumlah_masuk }}</td>
            <td>{{ number_format($lpm->harga_beli, 0, ',', '.') }}</td>
            <td>{{ number_format($lpm->total_harga, 0, ',', '.') }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="9" class="text-center">
                Data Laporan Barang Masuk Tidak Ada
            </td>
        </tr>
    @endforelse
</tbody>
                </table>
            </div>
        </div>
    </div>
@endsection