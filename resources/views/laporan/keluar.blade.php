@extends('layouts.app')

@section('title', 'Laporan Barang Keluar')

@section('contents')
<div class="card shadow-lg border-0 rounded-4 overflow-hidden">

    {{-- Header --}}
    <div class="card-header bg-info text-white fw-semibold d-flex justify-content-between align-items-center py-3 px-4">
        <h5 class="mb-0 d-flex align-items-center gap-2">
            <i class="fas fa-upload"></i> Laporan Barang Keluar
        </h5>
        <div class="d-flex gap-2">
            <a href="{{ route('laporan.pdf_keluar', ['bulan' => request('bulan'), 'tahun' => request('tahun')]) }}" 
               class="btn btn-light btn-sm rounded-pill px-3 shadow-sm d-flex align-items-center">
                <i class="fas fa-file-pdf text-danger me-2"></i> PDF
            </a>
            <a href="{{ route('laporan.excel_keluar', ['bulan' => request('bulan'), 'tahun' => request('tahun')]) }}" 
               class="btn btn-light btn-sm rounded-pill px-3 shadow-sm d-flex align-items-center">
                <i class="fas fa-file-excel text-success me-2"></i> Excel
            </a>
        </div>
    </div>

    {{-- Body --}}
    <div class="card-body bg-light">

        {{-- 🔍 Filter --}}
        <form method="GET" action="{{ route('laporan.keluar') }}" 
              class="p-4 bg-white rounded-4 shadow-sm mb-4 border-start border-4 border-info">
            <div class="row align-items-end gy-3">
                <div class="col-md-3">
                    <label class="form-label fw-semibold text-secondary">
                        <i class="fas fa-calendar-alt me-1 text-info"></i> Bulan
                    </label>
                    <select name="bulan" class="form-select border-info shadow-sm">
                        <option value="">-- Semua Bulan --</option>
                        @foreach(range(1, 12) as $b)
                            <option value="{{ $b }}" {{ request('bulan') == $b ? 'selected' : '' }}>
                                {{ DateTime::createFromFormat('!m', $b)->format('F') }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-semibold text-secondary">
                        <i class="fas fa-clock me-1 text-info"></i> Tahun
                    </label>
                    <select name="tahun" class="form-select border-info shadow-sm">
                        <option value="">-- Semua Tahun --</option>
                        @foreach(range(date('Y') - 3, date('Y')) as $t)
                            <option value="{{ $t }}" {{ request('tahun') == $t ? 'selected' : '' }}>
                                {{ $t }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 d-flex justify-content-end gap-2">
                    <button type="submit" class="btn btn-info text-white fw-semibold shadow-sm px-4 rounded-pill">
                        <i class="fas fa-search me-2"></i> Filter
                    </button>
                    <a href="{{ route('laporan.keluar') }}" 
                       class="btn btn-outline-secondary fw-semibold shadow-sm px-4 rounded-pill">
                        <i class="fas fa-undo me-2"></i> Reset
                    </a>
                </div>
            </div>
        </form>

        {{-- 📊 Tabel Data --}}
        <div class="table-wrapper bg-white rounded-4 shadow-sm border">
            <div class="table-responsive" style="max-height: 450px; overflow-y: auto;">
                <table class="table table-hover table-striped table-bordered align-middle mb-0 text-center">
                    <thead class="bg-info text-white sticky-top">
                        <tr>
                            <th style="width: 60px;">No</th>
                            <th>No. Transaksi</th>
                            <th>
                                <i class="fas fa-calendar-alt me-1"></i> Tanggal Keluar
                            </th>
                            <th>Nama Barang</th>
                            <th>Jumlah Keluar</th>
                            <th>
                                <i class="fas fa-clipboard-list me-1"></i> Nomor POD (Tujuan)
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($LaporanKeluar as $index => $row)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="fw-semibold">{{ $row->no_transaksi }}</td>
                                <td>{{ \Carbon\Carbon::parse($row->tgl_keluar)->format('d M Y') }}</td>
                                <td>{{ $row->nama_barang }}</td>
                                <td>
                                    <span class="badge bg-danger text-white px-3 py-2">
                                        -{{ $row->jumlah_keluar }}
                                    </span>
                                </td>
                                <td class="fw-semibold text-info">{{ $row->nomor_pod ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-3">
                                    <i class="fas fa-box-open me-2"></i> Tidak ada data barang keluar
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Footer --}}
    <div class="card-footer bg-white border-0 d-flex justify-content-between align-items-center py-3 px-4 sticky-bottom">
        <span class="fw-semibold text-secondary">
            <i class="fas fa-database me-2 text-info"></i>
            Total Transaksi: <span class="text-dark">{{ count($LaporanKeluar) }} data</span>
        </span>

        @if(request('bulan') || request('tahun'))
            <small class="text-muted fst-italic">
                <i class="fas fa-filter me-1"></i>
                Ditampilkan untuk 
                {{ request('bulan') ? DateTime::createFromFormat('!m', request('bulan'))->format('F') : '' }}
                {{ request('tahun') ?? '' }}
            </small>
        @endif
    </div>
</div>

<style>
.table td, .table th {
    vertical-align: middle;
}
.badge {
    font-size: 0.85rem;
}
.table-hover tbody tr:hover {
    background-color: #e8f8ff;
    transition: background-color 0.2s ease;
}
.table-responsive {
    scrollbar-width: thin;
    scrollbar-color: #00b4d8 #f1f1f1;
}
.table-responsive::-webkit-scrollbar {
    width: 8px;
}
.table-responsive::-webkit-scrollbar-thumb {
    background-color: #00b4d8;
    border-radius: 4px;
}
.table-responsive::-webkit-scrollbar-thumb:hover {
    background-color: #0090b8;
}
</style>
@endsection
