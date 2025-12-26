@extends('layouts.app')

@section('title', 'Home Laporan Barang Keluar')

@section('contents')

{{-- Header --}}
<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif" class="h3 text-gray-800 fw-bold">
        <i class="fas fa-dolly me-1"></i> Laporan Barang Keluar
        </h1>
        <a href="{{ route('lapoks.create') }}" class="btn btn-warning shadow-sm px-4 rounded-pill">
            <i class="fas fa-plus-circle me-1"></i> Tambah Laporan
        </a>
    </div>

    {{-- Alert --}}
    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-3" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ Session::get('success') }}
        </div>
    @endif

    {{-- Card --}}
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-header bg-info text-white fw-semibold">
            <i class="fas fa-database me-2"></i> Data Laporan Barang Keluar
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered align-middle mb-0">
                    <thead class="bg-info text-white text-center">
                        <tr>
                            <th>ID</th>
                            <th>Tanggal Keluar</th>
                            <th>No. Transaksi</th>
                            <th>Nama Barang</th>
                            <th>Jenis Barang</th>
                            <th>Jumlah Keluar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($lapok as $lpk)
                            <tr>
                                <td class="text-center fw-semibold">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($lpk->tgl_keluar)->format('d M Y') }}</td>
                                <td class="text-center">{{ $lpk->no_transaksi }}</td>
                                <td class="text-center">{{ $lpk->dabrang_id }}</td>
                                <td class="text-center">
                                    <span class="badge bg-info text-dark px-3 py-2 rounded-pill">
                                        {{ $lpk->jebrang_id }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-danger px-3 py-2 rounded-pill">
                                        -{{ $lpk->jumlah_keluar }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="{{ route('lapoks.show', $lpk->id) }}" 
                                            class="btn btn-info btn-sm rounded-circle shadow-sm" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('lapoks.edit', $lpk->id) }}" 
                                            class="btn btn-warning btn-sm rounded-circle shadow-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('lapoks.destroy', $lpk->id) }}" method="POST" class="d-inline form-delete">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm rounded-circle shadow-sm" title="Hapus">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center text-muted" colspan="7">
                                    <i class="fas fa-exclamation-circle text-danger"></i>
                                    Data Laporan Barang Keluar Tidak Tersedia.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if(method_exists($lapok, 'links'))
                <div class="d-flex justify-content-center mt-3">
                    {{ $lapok->links() }}
                </div>
            @endif
        </div>
    </div>

    {{-- Pagination --}}
    @if(method_exists($lapok, 'links'))
        <div class="card-footer bg-light border-0">
            <div class="d-flex justify-content-center">
                {{ $lapok->links() }}
            </div>
        </div>
    @endif
    
{{-- SweetAlert for delete confirmation --}}
<script>
    document.querySelectorAll('.form-delete').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Yakin hapus data?',
                text: "Data pegawai akan dihapus permanen!",
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
                            row.remove(); // hapus baris tabel langsung
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