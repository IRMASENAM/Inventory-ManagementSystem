@extends('layouts.app')

@section('title', 'Create Data Barang')

@section('contents')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">
                    <i class="fas fa-plus-circle text-white me-1"></i> Tambah Data Barang
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('dabrangs.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Foto Barang --}}
                    <div class="mb-3">
                        <label for="foto" class="form-label fw-bold">
                            <i class="fas fa-image me-1 text-success"></i> Foto Barang
                        </label>
                        <input type="file" name="foto" id="foto" class="form-control">
                    </div>

                    {{-- Nama Barang --}}
                    <div class="mb-3">
                        <label for="nama_barang" class="form-label fw-bold">
                            <i class="fas fa-box me-1 text-info"></i> Nama Barang
                        </label>
                        <input type="text" name="nama_barang" id="nama_barang" 
                               class="form-control" placeholder="Masukkan nama barang" required>
                    </div>

                    {{-- Jenis Barang --}}
                    <div class="mb-3">
                        <label for="jebrang_id" class="form-label fw-bold">
                            <i class="fas fa-tags me-1 text-warning"></i> Jenis Barang
                        </label>
                        <select name="jebrang_id" id="jebrang_id" class="form-control" required>
                            <option value="">-- Pilih Jenis Barang --</option>
                            @foreach($jebrangs as $jbr)
                                <option value="{{ $jbr->id }}" {{ old('jebrang_id') == $jbr->id ? 'selected' : '' }}>
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
                        <button type="submit" class="btn btn-warning shadow-sm">
                            <i class="fas fa-save me-1"></i> Simpan Data
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection