@extends('layouts.app')

@section('title', 'Transaksi Barang Keluar')

@section('contents')
<div class="container-fluid py-3">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-info mb-1">
                <i class="fas fa-dolly-flatbed me-2"></i> Transaksi Barang Keluar
            </h3>
            <p class="text-muted mb-0">
                Data keluar masuk barang dengan keterkaitan terhadap <strong>POD (Plan of Development)</strong>.
            </p>
        </div>
        <a href="{{ route('baraks.create') }}" class="btn btn-warning shadow-sm px-4 rounded-pill fw-semibold">
            <i class="fas fa-plus-circle me-1"></i> Tambah Transaksi
        </a>
    </div>

    {{-- ALERT --}}
    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-3 animate__animated animate__fadeInDown" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ Session::get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- DATA --}}
    <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
        <div class="card-header bg-info text-white fw-semibold d-flex align-items-center">
            <i class="fas fa-database me-2"></i> Data Transaksi Barang Keluar
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle mb-0 table-hover">
                    <thead class="bg-info text-white text-center text-uppercase small">
                        <tr>
                            <th width="60">No</th>
                            <th>No. Transaksi</th>
                            <th>Tanggal Keluar</th>
                            <th>Nama Barang</th>
                            <th>Jumlah Keluar</th>
                            <th>POD Terkait</th>
                            <th width="120">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @forelse ($barak as $brk)
                            <tr>
                                <td class="text-muted">{{ $loop->iteration }}</td>
                                <td class="fw-semibold">{{ $brk->no_transaksi }}</td>
                                <td>{{ \Carbon\Carbon::parse($brk->tgl_keluar)->format('d M Y') }}</td>
                                <td>{{ $brk->dabrang->nama_barang ?? '-' }}</td>
                                <td>
                                    <span class="badge bg-danger text-white px-3 py-2 fw-semibold">
                                        -{{ $brk->jumlah_keluar }}
                                    </span>
                                </td>
                                <td>
                                    @if($brk->pod)
                                        <span class="badge bg-info-subtle text-info px-3 py-1 rounded-pill shadow-sm">
                                            {{ $brk->pod->nomor_pod }}
                                        </span>
                                    @else
                                        <span class="text-muted fst-italic">Belum terkait POD</span>
                                    @endif
                                </td>

                                {{-- Aksi --}}
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('baraks.show', $brk->id) }}" 
                                           class="btn btn-outline-info btn-sm rounded-pill px-3 shadow-sm" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('baraks.edit', $brk->id) }}" 
                                           class="btn btn-outline-warning btn-sm rounded-pill px-3 shadow-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('baraks.destroy', $brk->id) }}" 
                                              method="POST" class="d-inline form-delete">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-outline-danger btn-sm rounded-pill px-3 shadow-sm" title="Hapus">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="fas fa-box-open fa-2x mb-2"></i><br>
                                    Tidak ada transaksi barang keluar.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- PAGINATION --}}
        @if(method_exists($barak, 'links'))
            <div class="card-footer bg-light border-0">
                <div class="d-flex justify-content-center">
                    {{ $barak->links() }}
                </div>
            </div>
        @endif
    </div>
</div>

{{-- STYLE --}}
<style>
.table-hover tr:hover {
    background-color: #eaf7ff !important;
    transition: all 0.25s ease-in-out;
}
.btn-outline-info:hover {
    background-color: #00b4d8 !important;
    color: #fff !important;
}
.btn-outline-warning:hover {
    background-color: #ffc107 !important;
    color: #fff !important;
}
.btn-outline-danger:hover {
    background-color: #e3342f !important;
    color: #fff !important;
}
</style>

{{-- SWEETALERT DELETE --}}
<script>
document.querySelectorAll('.form-delete').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Yakin hapus data?',
            text: "Data transaksi akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e3342f',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<i class="fas fa-trash-alt"></i> Ya, hapus!',
            cancelButtonText: '<i class="fas fa-times"></i> Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: new FormData(form)
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: data.message,
                            timer: 1600,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Terjadi kesalahan saat menghapus data.'
                        });
                    }
                })
                .catch(err => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'Tidak dapat terhubung ke server.'
                    });
                    console.error(err);
                });
            }
        });
    });
});
</script>
@endsection