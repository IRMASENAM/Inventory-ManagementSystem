@extends('layouts.app')

@section('title', 'Home Employee')

@section('contents')

{{-- Header --}}
<div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 text-gray-800" style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
        <i class="fas fa-users"></i> Data Pegawai
    </h1>
    <a href="{{ route('employees.create') }}" class="btn btn-warning shadow-sm px-4 rounded-pill">
        <i class="fas fa-user-plus me-1"></i> Add Pegawai
    </a>
</div>

{{-- Alert --}}
@if (Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-3" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ Session::get('success') }}
    </div>
@endif

{{-- Card --}}
        <div class="card shadow-sm border-0 rounded-3 mb-5">
            <div class="card-header bg-info text-white fw-semibold">
                <i class="fas fa-users me-2"></i> Data Pegawai
            </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered align-middle mb-0">
                    <thead class="bg-info text-white text-center">
                        <tr>
                            <th>ID</th>
                                <th>Nama Lengkap</th>
                                <th>Tanggal Lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>Jabatan</th>
                                <th>Divisi</th>
                                <th>No Telepon</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($employee->count() > 0)
                                @foreach ($employee as $emp)
                                    <tr style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif">
                                        <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                                        <td class="text-center">{{ $emp->nama }}</td>
                                        <td class="text-center">{{ $emp->tanggal_lahir }}</td>
                                        <td class="text-center">{{ $emp->jenis_kelamin }}</td>
                                        <td class="text-center">{{ $emp->jabatan }}</td>
                                        <td class="text-center">{{ $emp->divisi }}</td>
                                        <td class="text-center">{{ $emp->telp }}</td>
                                        <td class="text-center">{{ $emp->alamat }}</td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="{{ route('employees.show', $emp->id) }}" 
                                                   class="btn btn-info btn-sm rounded-circle shadow-sm" title="Detail">
                                                   <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('employees.edit', $emp->id) }}" 
                                                   class="btn btn-warning btn-sm rounded-circle shadow-sm" title="Edit">
                                                   <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('employees.destroy', $emp->id) }}" 
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
                                <td class="text-center" colspan="9">
                                    <i class="fas fa-exclamation-circle text-danger"></i> Data Pegawai Tidak Tersedia.
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            
    <!-- Pagination -->
    @if(method_exists($employee, 'links'))
        <div class="card-footer bg-light border-0">
            <div class="d-flex justify-content-center">
                {{ $employee->links() }}
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