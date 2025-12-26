@extends('layouts.app')

@section('title', 'Edit Pegawai')

@section('contents')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow border-0">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0"><i class="fas fa-user-edit"></i> Form Edit Pegawai</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('employees.update', $employee->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-id-card text-primary me-1"></i> Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" 
                               value="{{ old('nama', $employee->nama) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-calendar-alt text-success me-1"></i> Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" 
                               value="{{ old('tanggal_lahir', $employee->tanggal_lahir) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-venus-mars text-danger me-1"></i> Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control" required>
                            <option value="">-- Pilih --</option>
                            <option value="Laki-laki" {{ $employee->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ $employee->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-briefcase text-info me-1"></i> Jabatan</label>
                        <input type="text" name="jabatan" class="form-control" 
                               value="{{ old('jabatan', $employee->jabatan) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-building text-secondary me-1"></i> Divisi</label>
                        <input type="text" name="divisi" class="form-control" 
                               value="{{ old('divisi', $employee->divisi) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-phone text-success me-1"></i> No Telepon</label>
                        <input type="text" name="telp" class="form-control" value="{{ old('telp', $employee->telp) }}" maxlength="13" pattern="[0-9]{10,13}" title="Nomor telepon harus 10-13 digit angka" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-map-marker-alt text-warning me-1"></i> Alamat</label>
                        <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat', $employee->alamat) }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-save text-light me-1"></i> Update Employee
                    </button>
                    <a href="{{ route('employees') }}" class="btn btn-secondary">
                        <i class="fas fa-times text-light me-1"></i> Cancel
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection