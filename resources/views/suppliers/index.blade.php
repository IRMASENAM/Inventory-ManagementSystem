@extends('layouts.app')

@section('title', 'Home Supplier')

@section('contents')

{{-- Header --}}
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h1 style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif" class="h3 text-gray-800">
                <i class="fas fa-truck me-2"></i> Data Supplier
            </h1>
            <a href="{{ route('suppliers.create') }}" class="btn btn-warning shadow-sm px-4 rounded-pill">
                <i class="fas fa-user-plus me-1"></i> Add Supplier
            </a>
        </div>

        {{-- Alert Success --}}
        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i> {{ Session::get('success') }}
            </div>
        @endif

        {{-- Card Table --}}
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-header bg-info text-white fw-semibold">
                <i class="fas fa-truck me-1"></i> Supplier List
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered align-middle mb-0">
                        <thead class="bg-info text-white text-center">
                            <tr>
                                <th>ID</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Telepon</th>
                                <th>Alamat</th>
                                <th>Email</th>
                                <th>Foto</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($supplier->count() > 0)
                                @foreach ($supplier as $spr)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">
                                            <span class="badge bg-info text-dark">{{ $spr->kode_supplier }}</span>
                                        </td>
                                        <td class="text-center">{{ $spr->nama_supplier }}</td>
                                        <td class="text-center">{{ $spr->telp_supplier }}</td>
                                        <td class="text-center">{{ $spr->alamat_supplier }}</td>
                                        <td class="text-center">
                                            <span class="text-primary">{{ $spr->email_supplier }}</span>
                                        </td>
                                        <td class="text-center">
                                            @if ($spr->foto_supplier)
                                                <img src="{{ asset('storage/foto_supplier/' . $spr->foto_supplier) }}" 
                                                    alt="{{ $spr->nama_supplier }}" 
                                                    class="rounded-circle shadow-sm" 
                                                    width="60" height="60" 
                                                    style="object-fit: cover;">
                                            @else
                                                <span class="badge bg-secondary">No Image</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="{{ route('suppliers.show', $spr->id) }}" 
                                                    class="btn btn-info btn-sm rounded-circle shadow-sm" title="Detail">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('suppliers.edit', $spr->id) }}" 
                                                    class="btn btn-warning btn-sm rounded-circle shadow-sm" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('suppliers.destroy', $spr->id) }}" 
                                                    method="POST" class="d-inline form-delete">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm rounded-circle shadow-sm" title="Hapus">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="text-center" colspan="8">
                                        <i class="fas fa-exclamation-circle text-danger"></i>
                                        Data Supplier Tidak Tersedia.
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Pagination --}}
        @if(method_exists($supplier, 'links'))
            <div class="card-footer bg-light border-0">
                <div class="d-flex justify-content-center">
                    {{ $supplier->links() }}
                </div>
            </div>
        @endif

{{-- Script konfirmasi hapus --}}
<script>
    document.querySelectorAll('.form-delete').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Yakin hapus data?',
                text: "Data supplier akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e3342f',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="fas fa-trash-alt"></i> Ya, hapus!',
                cancelButtonText: '<i class="fas fa-times"></i> Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // ambil URL dari action form
                    let url = form.getAttribute('action');
                    let row = form.closest('tr');

                    fetch(url, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: data.message,
                                timer: 1500,
                                showConfirmButton: false
                            });

                            // hapus baris tabel tanpa reload
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
