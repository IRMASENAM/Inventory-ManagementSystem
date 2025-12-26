@extends('layouts.app')

@section('title', 'Edit Supplier')

@section('contents')
@push('styles')

<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-header bg-info text-white py-3">
                <h5 class="mb-0">
                    <i class="fas fa-edit text-warning me-2"></i>
                    Edit Supplier
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">
                                <i class="fas fa-barcode text-primary me-1"></i> Kode Supplier
                            </label>
                            <input type="text" name="kode_supplier" class="form-control"
                                   value="{{ $supplier->kode_supplier }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">
                                <i class="fas fa-user-tag text-success me-1"></i> Nama Supplier
                            </label>
                            <input type="text" name="nama_supplier" class="form-control"
                                   value="{{ $supplier->nama_supplier }}" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">
                                <i class="fas fa-phone text-success me-1"></i> No Telepon
                            </label>
                            <input type="text" name="telp_supplier" class="form-control"
                                   value="{{ $supplier->telp_supplier }}" maxlength="13" pattern="[0-9]{10,13}"
                                   title="Nomor telepon harus 10–13 digit angka" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">
                                <i class="fas fa-envelope text-danger me-1"></i> Email
                            </label>
                            <input type="email" name="email_supplier" class="form-control"
                                   value="{{ $supplier->email_supplier }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            <i class="fas fa-map-marker-alt text-warning me-1"></i> Alamat Supplier
                        </label>
                        <textarea name="alamat_supplier" class="form-control" rows="3">{{ $supplier->alamat_supplier }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            <i class="fas fa-image text-info me-1"></i> Foto Supplier
                        </label>
                        <input type="file" name="foto_supplier"
                               class="form-control @error('foto_supplier') is-invalid @enderror"
                               accept="image/*" onchange="previewImage(this)">
                        @error('foto_supplier')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah foto (Max 2MB, JPG/PNG).</small>

                        <div class="mt-3 d-flex gap-4 align-items-start">
                            <div>
                                <p class="mb-1"><small class="text-muted">Foto Saat Ini:</small></p>
                                @if($supplier->foto_supplier && file_exists(public_path('storage/foto_supplier/' . $supplier->foto_supplier)))
                                    <img src="{{ asset('storage/foto_supplier/' . $supplier->foto_supplier) }}"
                                         class="img-thumbnail rounded shadow-sm"
                                         style="width: 120px; height: 120px; object-fit: cover;">
                                @else
                                    <div class="border rounded d-flex align-items-center justify-content-center bg-light"
                                         style="width: 120px; height: 120px;">
                                        <span class="text-muted small">Tidak ada foto</span>
                                    </div>
                                @endif
                            </div>

                            <div id="preview-container" style="display:none;">
                                <p class="mb-1"><small class="text-muted">Preview Foto Baru:</small></p>
                                <img id="preview-image" src="" alt="Preview"
                                     class="img-thumbnail rounded shadow-sm"
                                     style="width: 120px; height: 120px; object-fit: cover;">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mt-2">
                        <a href="{{ route('suppliers') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left text-light me-1"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-warning text-white fw-bold">
                            <i class="fas fa-save text-white me-1"></i> Update Supplier
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function previewImage(input) {
    const previewContainer = document.getElementById('preview-container');
    const previewImage = document.getElementById('preview-image');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImage.src = e.target.result;
            previewContainer.style.display = 'block';
        }
        reader.readAsDataURL(input.files[0]);
    } else {
        previewContainer.style.display = 'none';
    }
}
</script>
@endsection