@extends('layouts.app')

@section('title', 'Home Data Barang')

@section('contents')

{{-- Header --}}
<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif" class="h3 text-gray-800">
        <i class="fas fa-table me-2"></i> Data Barang
    </h1>
    <a href="{{ route('dabrangs.create') }}" class="btn btn-warning shadow-sm px-4 rounded-pill">
        <i class="fas fa-plus-circle me-1"></i> Tambah Data Barang
    </a>
</div>

{{-- Alert --}}
@if (Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-3" role="alert">
        <i class="fas fa-check-circle me-2"></i> {{ Session::get('success') }}
    </div>
@endif

{{-- Card --}}
<div class="card shadow-lg border-0 rounded-3">
    <div class="card-header bg-info text-white fw-semibold">
        <i class="fas fa-table me-2"></i> Daftar Barang
    </div>
    <div class="card-body p-0">

        {{-- Scrollable Table --}}
        <div class="table-responsive scrollable-table" style="max-height: 550px; overflow-y: auto;">
            <table class="table table-hover table-striped table-bordered align-middle mb-0">
                <thead class="bg-info text-white text-center sticky-top" style="z-index: 10;">
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Jenis</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dabrang as $dbr)
                        <tr>
                            <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $dbr->kode_barang }}</td>

                            {{-- Foto --}}
                            <td class="text-center">
                                @if($dbr->foto && file_exists(public_path('storage/foto_barang/' . $dbr->foto)))
                                    <img src="{{ asset('storage/foto_barang/' . $dbr->foto) }}" 
                                         alt="Foto {{ $dbr->nama_barang }}" 
                                         class="img-thumbnail shadow-sm" 
                                         style="width: 70px; height: 70px; object-fit: cover;">
                                @else
                                    <i class="fas fa-image text-muted" style="font-size: 2rem;"></i>
                                @endif
                            </td>

                            <td class="text-center">{{ $dbr->nama_barang }}</td>

                            <td class="text-center">
                                <span class="badge bg-info text-dark px-3 py-2 shadow-sm">
                                    <i class="fas fa-tags me-1"></i>{{ $dbr->jebrang->nama_jenis ?? '-' }}
                                </span>
                            </td>
                            
                            <td class="text-center">
                                <div class="btn-group">
                                    {{-- Detail --}}
                                    <a href="{{ route('dabrangs.show', $dbr->kode_barang) }}" 
                                       class="btn btn-info btn-sm rounded-circle shadow-sm" 
                                       title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    {{-- Edit --}}
                                    <a href="{{ route('dabrangs.edit', $dbr->id) }}" 
                                       class="btn btn-warning btn-sm rounded-circle shadow-sm" 
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    {{-- Hapus --}}
                                    <form action="{{ route('dabrangs.destroy', $dbr->id) }}" 
                                          method="POST" 
                                          class="d-inline form-delete">
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
                            <td class="text-center" colspan="7">
                                <i class="fas fa-exclamation-circle text-danger"></i> Data Barang Tidak Tersedia.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    @if(method_exists($dabrang, 'links'))
        <div class="card-footer bg-light border-0">
            <div class="d-flex justify-content-center">
                {{ $dabrang->links() }}
            </div>
        </div>
    @endif
</div>

{{-- SweetAlert Delete --}}
<script>
document.querySelectorAll('.form-delete').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Yakin hapus data?',
            text: "Data barang akan dihapus permanen!",
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