@extends('layouts.app')

@section('title', 'Home Satuan Barang')

@section('contents')

{{-- Header --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif" class="h3 text-gray-800">
            <i class="fas fa-box"></i> Data Satuan Barang
        </h1>
        <a href="{{ route('sabrangs.create') }}" class="btn btn-warning shadow-sm px-4 rounded-pill">
            <i class="fas fa-plus-circle"></i> Add Satuan Barang
        </a>
    </div>

{{-- Alert Success --}}
@if (Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
        <i class="fas fa-check-circle"></i> {{ Session::get('success') }}
    </div>
@endif

{{-- Card Table --}}
<div class="card shadow-sm border-0 rounded-3">
    <div class="card-header bg-info text-white fw-semibold">
        <i class="fas fa-box"></i> Daftar Satuan Barang
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-bordered table-striped align-middle mb-0">
                <thead class="bg-info text-white text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Satuan</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($sabrang->count() > 0)
                        @foreach ($sabrang as $sbr)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <span class="fw-bold text-dark">{{ $sbr->nama_satuan }}</span>
                                </td>
                                <td>{{ $sbr->keterangan }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('sabrangs.show', $sbr->id) }}" 
                                           class="btn btn-info btn-sm rounded-circle shadow-sm" title="Detail">
                                           <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('sabrangs.edit', $sbr->id) }}" 
                                           class="btn btn-warning btn-sm rounded-circle shadow-sm" title="Edit">
                                           <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('sabrangs.destroy', $sbr->id) }}" 
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
                        <td class="text-center" colspan="4">
                            <i class="fas fa-exclamation-circle text-danger"></i> Data Satuan Barang Tidak Tersedia.
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Script konfirmasi hapus --}}
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