@extends('layouts.app')

@section('title', 'Edit POD')

@section('contents')
<div class="container-fluid py-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-info mb-1">
                <i class="fas fa-edit me-2"></i> Edit Data POD
            </h3>
            <p class="text-muted mb-0">Perbarui informasi <strong>Plan of Development</strong> sesuai kebutuhan.</p>
        </div>
        <a href="{{ route('pods') }}" class="btn btn-outline-info btn-sm rounded-pill shadow-sm">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    {{-- ALERT --}}
    @if (session('success'))
        <div class="alert alert-info alert-dismissible fade show shadow-sm" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- FORM EDIT POD --}}
    <div class="card border-0 shadow-lg rounded-4">
        <div class="card-header text-white fw-semibold py-3 d-flex align-items-center rounded-top-4"
            style="background: linear-gradient(90deg, #00b4d8, #0096c7);">
            <i class="fas fa-pen-square me-2 fs-5"></i>
            <span>Form Edit POD</span>
        </div>

        <div class="card-body px-5 py-4 bg-light">
            <form class="needs-validation" action="{{ route('pods.update', $pod->id) }}" method="POST" enctype="multipart/form-data" novalidate>
                @csrf
                @method('PUT')

                {{-- ROW 1 --}}
                <div class="row g-4">
                    <div class="col-md-3">
                        <label class="form-label fw-semibold text-muted">Nomor POD</label>
                        <input type="text" name="nomor_pod" class="form-control bg-info-subtle border-0 fw-semibold text-info"
                            value="{{ $pod->nomor_pod }}" readonly>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold text-muted">Tanggal</label>
                    
                        <!-- Hidden untuk backend -->
                        <input type="hidden" name="tanggal" 
                               value="{{ \Carbon\Carbon::parse($pod->tanggal)->format('Y-m-d') }}">
                    
                        <!-- Ditampilkan ke user -->
                        <input type="date" class="form-control border-info-subtle"
                               value="{{ \Carbon\Carbon::parse($pod->tanggal)->format('Y-m-d') }}" disabled>
                    
                        <div class="invalid-feedback">Silakan pilih tanggal POD.</div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold text-muted">Jenis POD</label>
                        <select name="jenis_pod" class="form-control border-info-subtle" required>
                            <option value="Rutin" {{ $pod->jenis_pod == 'Rutin' ? 'selected' : '' }}>Rutin</option>
                            <option value="Tambahan" {{ $pod->jenis_pod == 'Tambahan' ? 'selected' : '' }}>Tambahan</option>
                            <option value="Helpdesk" {{ $pod->jenis_pod == 'Helpdesk' ? 'selected' : '' }}>Helpdesk</option>
                        </select>
                        <div class="invalid-feedback">Silakan pilih jenis POD.</div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold text-muted">Divisi</label>
                        <input type="text" name="departemen" class="form-control border-info-subtle"
                            value="{{ $pod->departemen }}" required>
                        <div class="invalid-feedback">Silakan isi nama divisi.</div>
                    </div>
                </div>

                <hr class="my-4">

                {{-- ROW 2 --}}
                <div class="row g-4">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold text-muted">Kategori Perawatan</label>
                        <select name="kategori_perawatan" class="form-control border-info-subtle" required>
                            @php
                                $kategori = ['CCTV', 'PC / Komputer', 'Router', 'Switch', 'Server', 'Access Point (Wi-fi)', 'Kabel Ethernet / FO', 'IP Telepon / Paging / PABX', 'Box Panel / MCB / Terminasi Wiring'];
                            @endphp
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($kategori as $item)
                                <option value="{{ $item }}" {{ $pod->kategori_perawatan == $item ? 'selected' : '' }}>{{ $item }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Silakan pilih kategori perawatan.</div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold text-muted">Tipe POD</label>
                        <select name="tipe_pod" class="form-control border-info-subtle" required>
                            @php
                                $tipe = ['PM', 'CD / CM', 'Breakdown (Replacement)', 'Proactive Maintenance'];
                            @endphp
                            <option value="">-- Pilih Tipe --</option>
                            @foreach ($tipe as $item)
                                <option value="{{ $item }}" {{ $pod->tipe_pod == $item ? 'selected' : '' }}>{{ $item }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Silakan pilih tipe POD.</div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold text-muted">Lokasi</label>
                        <input type="text" name="lokasi" class="form-control border-info-subtle"
                            value="{{ $pod->lokasi }}" required>
                        <div class="invalid-feedback">Silakan isi lokasi pekerjaan.</div>
                    </div>
                </div>

                <hr class="my-4">

                {{-- ROW 3 --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold text-muted">Daftar Pekerjaan</label>
                    <textarea name="daftar_pekerjaan" class="form-control border-info-subtle" rows="4" required>{{ $pod->daftar_pekerjaan }}</textarea>
                    <div class="invalid-feedback">Silakan isi daftar pekerjaan.</div>
                </div>

                {{-- LAMPIRAN --}}
                <hr class="my-4">
                <div class="mb-3">
                    <label class="form-label fw-semibold text-muted">Lampiran (Opsional)</label>
                    <input type="file" name="lampiran" class="form-control border-info-subtle" accept="image/*">
                    <small class="text-muted d-block">Biarkan kosong jika tidak ingin mengganti lampiran.</small>

                    @if ($pod->lampiran)
                        <div class="mt-3">
                        <p class="text-muted small mb-2">Lampiran saat ini:</p>
                        <img src="{{ asset('uploads/pods/' . $pod->lampiran) }}" 
                            alt="Lampiran POD" 
                            class="img-thumbnail rounded-3 shadow-sm" width="200">
                        </div>
                    @endif
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-warning btn-sm px-4 fw-semibold shadow-sm rounded-pill text-white">
                        <i class="fas fa-save me-1"></i> Update POD
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- STYLE --}}
<style>
.card:hover { transform: translateY(-2px); transition: 0.3s; }
input:focus, select:focus, textarea:focus, button:focus { box-shadow: 0 0 0 0.15rem rgba(0,150,199,0.4); }
.btn-warning { background-color: #f4a261; border: none; }
.btn-warning:hover { background-color: #e76f51; }
</style>

{{-- VALIDASI FRONTEND --}}
<script>
(() => {
    'use strict'
    const forms = document.querySelectorAll('.needs-validation')
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }
            form.classList.add('was-validated')
        }, false)
    })
})()
</script>
@endsection