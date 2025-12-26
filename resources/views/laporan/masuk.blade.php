@extends('layouts.app')

@section('title', 'Laporan Barang Masuk')

@section('contents')
<div class="card shadow-lg border-0 rounded-4 overflow-hidden">
    {{-- Header --}}
    <div class="card-header bg-info text-white fw-semibold d-flex justify-content-between align-items-center py-3 px-4">
        <h5 class="mb-0">
            <i class="fas fa-download me-2"></i> Laporan Barang Masuk
        </h5>

        {{-- Tombol Export --}}
        <div class="d-flex gap-2">
            <a href="{{ route('laporan.pdf_masuk', ['bulan' => request('bulan'), 'tahun' => request('tahun')]) }}" 
               class="btn btn-light btn-sm rounded-pill px-3 shadow-sm d-flex align-items-center">
                <i class="fas fa-file-pdf text-danger me-2"></i> PDF
            </a>
            <a href="{{ route('laporan.excel_masuk', ['bulan' => request('bulan'), 'tahun' => request('tahun')]) }}" 
               class="btn btn-light btn-sm rounded-pill px-3 shadow-sm d-flex align-items-center">
                <i class="fas fa-file-excel text-info me-2"></i> Excel
            </a>
        </div>
    </div>

    {{-- Body --}}
    <div class="card-body bg-light">

        {{-- 🔍 Filter Bulan & Tahun --}}
        <form action="{{ route('laporan.masuk') }}" method="GET" class="p-4 bg-white rounded-4 shadow-sm mb-4 border-start border-4 border-info">
            <div class="row align-items-end gy-3">
                {{-- Bulan --}}
                <div class="col-md-4">
                    <label for="bulan" class="form-label fw-semibold text-secondary">
                        <i class="fas fa-calendar-alt me-1 text-info"></i> Bulan
                    </label>
                    <select name="bulan" id="bulan" class="form-select border-info shadow-sm">
                        <option value="">-- Semua Bulan --</option>
                        @for ($m = 1; $m <= 12; $m++)
                            <option value="{{ $m }}" {{ request('bulan') == $m ? 'selected' : '' }}>
                                {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                            </option>
                        @endfor
                    </select>
                </div>

                {{-- Tahun --}}
                <div class="col-md-4">
                    <label for="tahun" class="form-label fw-semibold text-secondary">
                        <i class="fas fa-clock me-1 text-info"></i> Tahun
                    </label>
                    <select name="tahun" id="tahun" class="form-select border-info shadow-sm">
                        <option value="">-- Semua Tahun --</option>
                        @for ($y = 2025; $y <= date('Y'); $y++)
                            <option value="{{ $y }}" {{ request('tahun') == $y ? 'selected' : '' }}>
                                {{ $y }}
                            </option>
                        @endfor
                    </select>
                </div>

                {{-- Tombol Aksi --}}
                <div class="col-md-4 d-flex justify-content-end gap-2">
                    <button type="submit" class="btn btn-info text-white fw-semibold shadow-sm px-4 rounded-pill">
                        <i class="fas fa-search me-2"></i> Filter
                    </button>
                    <a href="{{ route('laporan.masuk') }}" 
                       class="btn btn-outline-secondary fw-semibold shadow-sm px-4 rounded-pill">
                        <i class="fas fa-undo me-2"></i> Reset
                    </a>
                </div>
            </div>
        </form>

        {{-- 🧾 Info Filter Aktif --}}
        @if(request('bulan') || request('tahun'))
            <div class="alert alert-info d-flex align-items-center shadow-sm rounded-3 py-2 px-3 mb-4">
                <i class="fas fa-filter me-2"></i>
                <div>
                    Menampilkan laporan untuk 
                    @if(request('bulan'))
                        <b>{{ DateTime::createFromFormat('!m', request('bulan'))->format('F') }}</b>
                    @endif
                    @if(request('tahun'))
                        <b>{{ request('tahun') }}</b>
                    @endif
                </div>
            </div>
        @endif

        {{-- 📊 Tabel Data --}}
        <div class="table-responsive">
            <table id="laporanBarangMasuk" class="table table-hover table-striped table-bordered align-middle mb-0">
                <thead class="bg-info text-white text-center">
                    <tr>
                        <th>No Transaksi</th>
                        <th>Tanggal Masuk</th>
                        <th>Nama Barang</th>
                        <th>Jenis Barang</th>
                        <th>Supplier</th>
                        <th>Jumlah</th>
                        <th>Harga Beli</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @php $grandTotal = 0; @endphp
                    @forelse($LaporanMasuk as $row)
                        @php $grandTotal += $row->total_harga; @endphp
                        <tr class="text-center">
                            <td class="fw-semibold">{{ $row->no_transaksi }}</td>
                            <td>{{ \Carbon\Carbon::parse($row->tgl_masuk)->format('d-m-Y') }}</td>
                            <td>{{ $row->nama_barang }}</td>
                            <td>{{ $row->nama_jenis }}</td>
                            <td>{{ $row->nama_supplier }}</td>
                            <td><span class="badge bg-info-subtle text-dark px-3 py-2">{{ $row->jumlah_masuk }}</span></td>
                            <td>Rp {{ number_format($row->harga_beli, 0, ',', '.') }}</td>
                            <td class="fw-semibold text-info">Rp {{ number_format($row->total_harga, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-3">
                                <i class="fas fa-box-open me-2"></i> Tidak ada data barang masuk
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Footer --}}
    <div class="card-footer bg-white border-0 d-flex justify-content-between align-items-center py-3 px-4">
        <span class="fw-semibold text-secondary">
            <i class="fas fa-database me-2 text-info"></i>
            Total Transaksi: <span class="text-dark">{{ count($LaporanMasuk) }} data</span>
        </span>

        <span class="fw-bold text-info">
            <i class="fas fa-coins me-2"></i> 
            Grand Total: Rp {{ number_format($grandTotal, 0, ',', '.') }}
        </span>
    </div>
</div>
@endsection