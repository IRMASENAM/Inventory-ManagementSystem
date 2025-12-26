@extends('layouts.app')

@section('title', 'Detail POD')

@section('contents')
<div class="container-fluid py-3">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-semibold text-info mb-0">
            <i class="fas fa-file-alt me-2"></i> Detail POD
        </h4>
        <a href="{{ route('pods') }}" class="btn btn-outline-info rounded-pill px-4 shadow-sm">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    {{-- CARD DETAIL POD --}}
    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
        <div class="card-header bg-info text-white fw-semibold py-3 d-flex align-items-center">
            <i class="fas fa-info-circle me-2 fs-5"></i> Informasi POD
        </div>

        <div class="card-body bg-white">
            {{-- INFORMASI UTAMA --}}
            <div class="table-responsive">
                <table class="table table-borderless align-middle">
                    <tbody>
                        <tr class="border-bottom">
                            <th class="text-info" width="200">Nomor POD</th>
                            <td>
                                <span class="badge bg-light text-info border border-info px-3 py-2 shadow-sm">
                                    {{ $pod->nomor_pod }}
                                </span>
                            </td>
                            <th class="text-info" width="200">Tanggal</th>
                            <td>{{ \Carbon\Carbon::parse($pod->tanggal)->translatedFormat('d F Y') }}</td>
                        </tr>
                        <tr class="border-bottom">
                            <th class="text-info">Jenis POD</th>
                            <td>
                                @if ($pod->jenis_pod === 'Rutin')
                                    <span class="badge bg-success-subtle text-success px-3 py-1 rounded-pill shadow-sm">Rutin</span>
                                @elseif ($pod->jenis_pod === 'Tambahan')
                                    <span class="badge bg-info-subtle text-info px-3 py-1 rounded-pill shadow-sm">Tambahan</span>
                                @else
                                    <span class="badge bg-warning-subtle text-warning px-3 py-1 rounded-pill shadow-sm">Helpdesk</span>
                                @endif
                            </td>
                            <th class="text-info">Kategori Perawatan</th>
                            <td>{{ $pod->kategori_perawatan ?? '-' }}</td>
                        </tr>
                        <tr class="border-bottom">
                            <th class="text-info">Tipe POD</th>
                            <td>{{ $pod->tipe_pod ?? '-' }}</td>
                            <th class="text-info">Departemen</th>
                            <td>{{ $pod->departemen }}</td>
                        </tr>
                        <tr class="border-bottom">
                            <th class="text-info">Lokasi</th>
                            <td>{{ $pod->lokasi }}</td>
                            <th class="text-info">Dibuat Oleh</th>
                            <td>{{ $pod->dibuat_oleh ?? '-' }}</td>
                        </tr>

                        {{-- ✅ LAMPIRAN OPSIONAL --}}
                        @if ($pod->lampiran)
                        <tr class="border-bottom">
                            <th class="text-info">Lampiran</th>
                            <td colspan="3">
                                <div class="d-flex flex-column flex-md-row align-items-start gap-3">
                                    @php
                                        $filePath = asset('uploads/pods/' . $pod->lampiran);
                                        $ext = pathinfo($pod->lampiran, PATHINFO_EXTENSION);
                                        $isImage = in_array(strtolower($ext), ['jpg', 'jpeg', 'png']);
                                    @endphp

                                    @if ($isImage)
                                        <img src="{{ $filePath }}" 
                                             alt="Lampiran POD" 
                                             class="img-thumbnail shadow-sm" 
                                             style="max-width: 280px; border-radius: 10px;">
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            {{-- DAFTAR PEKERJAAN --}}
            <div class="mt-4">
                <h6 class="fw-semibold text-info mb-2">
                    <i class="fas fa-tasks me-1"></i> Daftar Pekerjaan
                </h6>
                <div class="p-3 bg-light rounded-3 border shadow-sm">
                    {!! nl2br(e($pod->daftar_pekerjaan)) !!}
                </div>
            </div>
        </div>
    </div>
</div>

{{-- STYLING TAMBAHAN --}}
<style>
    th {
        font-weight: 600;
        font-size: 0.95rem;
        white-space: nowrap;
        vertical-align: top;
    }
    td {
        font-size: 0.95rem;
    }
    .table td, .table th {
        padding: 10px 12px;
    }
    .card:hover {
        transform: translateY(-3px);
        transition: 0.25s ease-in-out;
    }
</style>
@endsection