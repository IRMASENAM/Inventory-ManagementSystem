@extends('layouts.app')

@section('title', 'Edit Data Barang')

@section('contents')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">
                    <i class="fas fa-edit text-white me-1"></i> Edit Data Barang
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('dabrangs.update', $dabrang->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Kode Barang --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            <i class="fas fa-barcode me-1 text-primary"></i> Kode Barang
                        </label>
                        <input type="text" name="kode_barang" class="form-control" 
                               placeholder="Kode Barang" value="{{ old('kode_barang', $dabrang->kode_barang) }}" required>
                    </div>

                    {{-- Foto Barang --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            <i class="fas fa-image me-1 text-success"></i> Foto Barang
                        </label>
                        <input type="file" name="foto" class="form-control">
                        <small class="text-muted">Kosongkan jika tidak ingin mengganti foto</small>
                        @if ($dabrang->foto)
                            <div class="mt-2">
                                <p class="mb-1"><small class="text-muted">Foto Saat Ini:</small></p>
                                <img src="{{ asset('storage/foto_barang/' . $dabrang->foto) }}" 
                                     alt="Foto {{ $dabrang->nama_barang }}" 
                                     class="img-thumbnail shadow-sm" 
                                     style="width: 120px; height: 120px; object-fit: cover;">
                            </div>
                        @endif
                    </div>

                    {{-- Nama Barang --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            <i class="fas fa-box me-1 text-info"></i> Nama Barang
                        </label>
                        <input type="text" name="nama_barang" class="form-control" 
                               placeholder="Nama Barang" value="{{ old('nama_barang', $dabrang->nama_barang) }}" required>
                    </div>

                    {{-- Jenis Barang --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            <i class="fas fa-tags me-1 text-warning"></i> Jenis Barang
                        </label>
                        <select name="jebrang_id" class="form-control" required>
                            <option value="">-- Pilih Jenis Barang --</option>
                            @foreach($jebrangs as $jbr)
                                <option value="{{ $jbr->id }}" 
                                    {{ old('jebrang_id', $dabrang->jebrang_id) == $jbr->id ? 'selected' : '' }}>
                                    {{ $jbr->nama_jenis }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('dabrangs') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-warning text-white shadow-sm">
                            <i class="fas fa-save me-1"></i> Update Data Barang
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection