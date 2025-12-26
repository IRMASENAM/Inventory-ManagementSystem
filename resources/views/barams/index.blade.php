@extends('layouts.app')

@section('title', 'Home Transaksi Barang Masuk')

@section('contents')

<!-- Header -->
<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 text-gray-800" style="font-family:'Franklin Gothic Medium','Arial Narrow',Arial,sans-serif">
        <i class="fas fa-box-open me-2"></i> Transaksi Barang Masuk
    </h1>
    <a href="{{ route('barams.create') }}" class="btn btn-warning shadow-sm px-4 rounded-pill">
        <i class="fas fa-plus-circle me-1"></i> Tambah Transaksi
    </a>
</div>

<!-- Alert -->
@if (Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-3" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ Session::get('success') }}
    </div>
@endif

<!-- Card -->
<div class="card shadow-sm border-0 rounded-3">
    <div class="card-header bg-info text-white fw-semibold">
        <i class="fas fa-box-open me-2"></i> Data Transaksi Barang Masuk
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered align-middle mb-0">
                <thead class="bg-info text-white text-center">
                    <tr>
                        <th>ID</th>
                        <th>No. Transaksi</th>
                        <th>Tanggal Masuk</th>
                        <th>Supplier</th>
                        <th>Nama Barang</th>
                        <th>Jenis Barang</th>
                        <th>Jumlah Masuk</th>
                        <th>Harga Beli</th>
                        <th>Total Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($baram->count() > 0)
                        @foreach ($baram as $brm)
                            <tr>
                                <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $brm->no_transaksi }}</td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($brm->tgl_masuk)->format('d M Y') }}</td>
                                <td class="text-center">{{ $brm->supplier->nama_supplier ?? '-' }}</td>
                                <td class="text-center">{{ $brm->dabrang->nama_barang ?? '-' }}</td>
                                <td class="text-center">{{ $brm->dabrang->jebrang->nama_jenis ?? '-' }}</td>
                                <td class="text-center">
                                    <span class="badge bg-success text-white px-3 py-2 rounded-pill">+{{ $brm->jumlah_masuk }}</span>
                                </td>
                                <td class="text-end">Rp {{ number_format($brm->harga_beli, 0, ',', '.') }}</td>
                                <td class="text-end fw-bold">Rp {{ number_format($brm->total_harga, 2, ',', '.') }}</td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="{{ route('barams.show', $brm->id) }}" 
                                           class="btn btn-info btn-sm rounded-circle shadow-sm" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('barams.edit', $brm->id) }}" 
                                           class="btn btn-warning btn-sm rounded-circle shadow-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('barams.destroy', $brm->id) }}" 
                                              method="POST" class="d-inline form-delete">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm rounded-circle shadow-sm" title="Delete">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td class="text-center py-4" colspan="10">
                                <i class="fas fa-exclamation-circle text-danger"></i> 
                                Data Barang Masuk Tidak Tersedia.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if(method_exists($baram, 'links'))
        <div class="card-footer bg-light border-0">
            <div class="d-flex justify-content-center">
                {{ $baram->links() }}
            </div>
        </div>
    @endif
</div>

{{-- Script konfirmasi hapus --}}
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
                    let url = form.getAttribute('action');
                    let row = form.closest('tr');

                    fetch(url, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: data.message,
                                timer: 1500,
                                showConfirmButton: false
                            });
                            row.remove();
                        } else {
                            Swal.fire('Gagal!', data.message, 'error');
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        Swal.fire('Error!', 'Terjadi kesalahan server.', 'error');
                    });
                }
            });
        });
    });
</script>
@endsection