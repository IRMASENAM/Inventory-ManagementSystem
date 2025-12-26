@extends('layouts.app')

@section('title', 'Detail Pegawai')

@section('contents')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow border-0">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0"><i class="fas fa-id-badge"></i> Detail Pegawai</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <tr><th><i class="fas fa-user"></i> Nama</th><td>{{ $employee->nama }}</td></tr>
                    <tr><th><i class="fas fa-calendar-alt"></i> Tgl Lahir</th><td>{{ $employee->tanggal_lahir }}</td></tr>
                    <tr><th><i class="fas fa-venus-mars"></i> Gender</th><td>{{ $employee->jenis_kelamin }}</td></tr>
                    <tr><th><i class="fas fa-briefcase"></i> Jabatan</th><td>{{ $employee->jabatan }}</td></tr>
                    <tr><th><i class="fas fa-building"></i> Divisi</th><td>{{ $employee->divisi }}</td></tr>
                    <tr><th><i class="fas fa-phone"></i> Telepon</th><td>{{ $employee->telp }}</td></tr>
                    <tr><th><i class="fas fa-map-marker-alt"></i> Alamat</th><td>{{ $employee->alamat }}</td></tr>
                </table>
                <a href="{{ route('employees') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning text-white">
                    <i class="fas fa-edit"></i> Edit
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
