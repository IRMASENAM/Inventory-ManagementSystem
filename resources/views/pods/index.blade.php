@extends('layouts.app')

@section('title', 'Daftar POD')

@section('contents')
<div class="container-fluid py-3">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-info mb-1">
                <i class="fas fa-clipboard-list me-2"></i> Form & Data POD
            </h3>
            <p class="text-muted mb-0">
                Kelola daftar <strong>Plan of Development</strong> dengan cepat dan efisien.
            </p>
        </div>
        <span class="badge bg-info-subtle text-info border shadow px-3 py-2 d-flex align-items-center">
            <i class="fas fa-database me-1"></i>
            Total : {{ $pods->total() }}
        </span>
    </div>

    {{-- FORM TAMBAH POD --}}
    <div class="card border-0 shadow-lg rounded-4 mb-5">
        <div class="card-header text-white fw-semibold py-3 d-flex align-items-center rounded-top-4"
            style="background: linear-gradient(90deg, #00b4d8, #0096c7);">
            <i class="fas fa-plus-circle me-2 fs-5"></i>
            <span>Tambah POD Baru</span>
        </div>

        <div class="card-body px-5 py-4 bg-light">
            <form class="needs-validation" action="{{ route('pods.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                @csrf

                {{-- ROW 1 --}}
                <div class="row g-4">
                    <div class="col-md-3">
                        <label class="form-label fw-semibold text-muted">Kode Otomatis</label>
                        <input type="text" name="kode_auto" class="form-control bg-info-subtle border-0 fw-semibold text-info" value="{{ $kodeAuto }}" readonly>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold text-muted">No. Helpdesk</label>
                        <input type="text" name="kode_manual" class="form-control border-info-subtle" placeholder="exm : 11274" required>
                        <div class="invalid-feedback">Silakan isi nomor Helpdesk.</div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold text-muted">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control border-info-subtle" required>
                        <div class="invalid-feedback">Silakan pilih tanggal POD.</div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold text-muted">Jenis POD</label>
                        <select name="jenis_pod" class="form-control border-info-subtle" required>
                            <option value="">-- Pilih Jenis --</option>
                            <option value="Rutin">Rutin</option>
                            <option value="Tambahan">Tambahan</option>
                            <option value="Helpdesk">Helpdesk</option>
                        </select>
                        <div class="invalid-feedback">Silakan pilih jenis POD.</div>
                    </div>
                </div>

                <hr class="my-4">

                {{-- ROW 2 --}}
                <div class="row g-4">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold text-muted">Kategori Perawatan</label>
                        <select name="kategori_perawatan" class="form-control border-info-subtle" required>
                            <option value="">-- Pilih Kategori --</option>
                            <option value="CCTV">CCTV</option>
                            <option value="PC / Komputer">PC / Komputer</option>
                            <option value="Router">Router</option>
                            <option value="Switch">Switch</option>
                            <option value="Server">Server</option>
                            <option value="Access Point (Wi-fi)">Access Point (Wi-fi)</option>
                            <option value="Kabel Ethernet / FO">Kabel Ethernet / FO</option>
                            <option value="IP Telepon / Paging / PABX">IP Telepon / Paging / PABX</option>
                            <option value="Box Panel / MCB / Terminasi Wiring">Box Panel / MCB / Terminasi Wiring</option>
                        </select>
                        <div class="invalid-feedback">Silakan pilih kategori perawatan.</div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold text-muted">Tipe POD</label>
                        <select name="tipe_pod" class="form-control border-info-subtle" required>
                            <option value="">-- Pilih Tipe --</option>
                            <option value="PM">Preventive Maintenance (PM)</option>
                            <option value="CD / CM">Repair / Corrective Maintenance (CM / CD)</option>
                            <option value="Breakdown (Replacement)">Breakdown / Replacement</option>
                            <option value="Proactive Maintenance">Proactive Maintenance</option>
                        </select>
                        <div class="invalid-feedback">Silakan pilih tipe POD.</div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-semibold text-muted">Divisi</label>
                        <input type="text" name="departemen" class="form-control border-info-subtle" placeholder="exm : Eksis" required>
                        <div class="invalid-feedback">Silakan isi nama divisi.</div>
                    </div>
                </div>

                <hr class="my-4">

                {{-- ROW 3 --}}
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold text-muted">Lokasi</label>
                        <input type="text" name="lokasi" class="form-control border-info-subtle" placeholder="exm : Lantai 4 Ruang Eksis" required>
                        <div class="invalid-feedback">Silakan isi lokasi pekerjaan.</div>
                    </div>
                </div>

                <hr class="my-4">

                {{-- ROW 4 --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold text-muted">Daftar Pekerjaan</label>
                    <textarea name="daftar_pekerjaan" class="form-control border-info-subtle" rows="4" placeholder="exm : Penyiapan kamera IHT" required></textarea>
                    <div class="invalid-feedback">Silakan isi daftar pekerjaan.</div>
                </div>

                {{-- LAMPIRAN --}}
                <hr class="my-4">
                <div class="mb-3">
                    <label class="form-label fw-semibold text-muted">Lampiran (Opsional)</label>
                    <input type="file" name="lampiran" class="form-control border-info-subtle" accept="image/*">
                    <small class="text-muted">Upload foto bukti pekerjaan (opsional, JPG/PNG, max 2MB)</small>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-info btn-sm px-4 fw-semibold shadow-sm rounded-pill text-white">
                        <i class="fas fa-save me-1"></i> Simpan POD
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- DATA POD --}}
    <div class="card border-0 shadow-lg rounded-4 overflow-hidden mb-5" style="background: #f9fcff;">
        <div class="card-header border-0 py-4 px-4 text-center text-white" style="background-color:#00b4d8;">
            <h5 class="fw-bold mb-0 d-flex align-items-center gap-2">
                <i class="fas fa-database fs-5"></i> Data POD Tersimpan
            </h5>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle mb-0 text-center">
                    <thead class="text-uppercase text-secondary fw-semibold" style="background: #e3f6ff;">
                        <tr>
                            <th width="60">No</th>
                            <th>Nomor POD</th>
                            <th>Tanggal</th>
                            <th>Jenis</th>
                            <th>Kategori</th>
                            <th>Tipe POD</th>
                            <th>Divisi</th>
                            <th>Dibuat Oleh</th>
                            <th width="210">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pods as $pod)
                            <tr class="table-hover-row">
                                <td>{{ ($pods->currentPage() - 1) * $pods->perPage() + $loop->iteration }}</td>
                                <td class="fw-semibold text-info">{{ $pod->nomor_pod }}</td>
                                <td>{{ \Carbon\Carbon::parse($pod->tanggal)->format('d M Y') }}</td>
                                <td><span class="badge bg-info-subtle text-info px-3 py-1 rounded-pill">{{ $pod->jenis_pod }}</span></td>
                                <td>{{ $pod->kategori_perawatan }}</td>
                                <td>{{ $pod->tipe_pod }}</td>
                                <td>{{ $pod->departemen }}</td>
                                <td>{{ $pod->dibuat_oleh }}</td>
                                <td>
                                    <a href="{{ route('pods.show', $pod->id) }}" class="btn btn-outline-info btn-sm rounded-pill shadow-sm me-1">
                                        <i class="fas fa-eye me-1"></i> Lihat
                                    </a>
                                    <a href="{{ route('pods.edit', $pod->id) }}" class="btn btn-outline-warning btn-sm rounded-pill shadow-sm me-1">
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </a>
                                    <form action="{{ route('pods.destroy', $pod->id) }}" method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-outline-danger btn-sm rounded-pill shadow-sm delete-btn">
                                            <i class="fas fa-trash-alt me-1"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-5 text-muted">
                                    <i class="fas fa-folder-open fa-2x mb-2"></i><br>Belum ada data POD yang tersimpan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- PAGINATION --}}
            @if ($pods->hasPages())
                <div class="d-flex justify-content-between align-items-center px-4 py-3 bg-light border-top">
                    <div class="text-muted small">
                        Menampilkan {{ $pods->firstItem() }}–{{ $pods->lastItem() }} dari {{ $pods->total() }} data
                    </div>
                    <div class="pagination-container">
                        {{ $pods->onEachSide(1)->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

{{-- STYLE --}}
<style>
.table-hover-row:hover { background-color: #eaf7ff !important; transition: 0.3s; }
.card:hover { transform: translateY(-2px); transition: 0.3s ease-in-out; }
.btn-outline-info:hover { background-color: #00b4d8 !important; color: #fff !important; }
.btn-outline-warning:hover { background-color: #f4a261 !important; color: #fff !important; }
.btn-outline-danger:hover { background-color: #e63946 !important; color: #fff !important; }
.pagination .page-item.active .page-link { background-color: #00b4d8; border-color: #00b4d8; }
.pagination .page-link:hover { background-color: #caf0f8; }
</style>

{{-- SWEETALERT --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.delete-btn');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const form = this.closest('.delete-form');
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: 'Data POD ini akan dihapus secara permanen!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    popup: 'rounded-4 shadow-lg',
                    confirmButton: 'rounded-pill fw-semibold px-4',
                    cancelButton: 'rounded-pill fw-semibold px-4'
                }
            }).then(result => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});

@if (session('success'))
Swal.fire({
    icon: 'success',
    title: 'Berhasil!',
    text: '{{ session('success') }}',
    showConfirmButton: false,
    timer: 1800,
    customClass: { popup: 'rounded-4 shadow-lg' }
});
@endif
</script>
@endsection