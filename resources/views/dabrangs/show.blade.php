@extends('layouts.app')

@section('title', 'Detail Barang')

@section('contents')
<div class="card shadow-lg border-0 rounded-4">
    <div class="card-header bg-info text-white fw-semibold d-flex justify-content-between align-items-center">
        <span><i class="fas fa-box me-2"></i> Detail Barang</span>
        <a href="{{ route('dabrangs') }}" class="btn btn-light btn-sm rounded-pill shadow-sm">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="card-body bg-light">
        <div class="row align-items-start">
            {{-- Foto Barang --}}
            <div class="col-md-4 text-center">
                @if($dabrang->foto && file_exists(public_path('storage/foto_barang/' . $dabrang->foto)))
                    <img src="{{ asset('storage/foto_barang/' . $dabrang->foto) }}" 
                         class="img-thumbnail shadow-sm rounded-3 mb-3"
                         style="width: 200px; height: 200px; object-fit: cover;"
                         alt="{{ $dabrang->nama_barang }}">
                @else
                    <i class="fas fa-image text-muted" style="font-size: 5rem;"></i>
                @endif
            </div>

            {{-- Detail Barang --}}
            <div class="col-md-8">
                <table class="table table-borderless">
                    <tr>
                        <th style="width: 30%">Kode Barang</th>
                        <td>: {{ $dabrang->kode_barang }}</td>
                    </tr>
                    <tr>
                        <th>Nama Barang</th>
                        <td>: {{ $dabrang->nama_barang }}</td>
                    </tr>
                    <tr>
                        <th>Jenis Barang</th>
                        <td>: {{ $dabrang->jebrang->nama_jenis ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Stok</th>
                        <td>: {{ $dabrang->stok ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Keterangan</th>
                        <td>: {{ $dabrang->keterangan ?? '-' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
