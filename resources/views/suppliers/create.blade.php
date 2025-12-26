@extends('layouts.app')

@section('title', 'Create Supplier')

@section('contents')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-user-plus text-warning"></i> Add New Supplier</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('suppliers.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-barcode text-primary me-1"></i> Kode Supplier</label>
                        <input type="text" name="kode_supplier" class="form-control" placeholder="Masukkan kode supplier" value="{{ $newKode }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-user text-success me-1"></i> Nama Supplier</label>
                        <input type="text" name="nama_supplier" class="form-control" placeholder="Masukkan nama supplier" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            <i class="fas fa-phone text-danger me-1"></i> No Telepon
                        </label>
                        <input type="text" 
                               name="telp_supplier" 
                               class="form-control" 
                               placeholder="Masukkan nomor telepon"
                               maxlength="13"
                               pattern="[0-9]{10,13}"
                               title="Nomor telepon harus 10–13 digit angka"
                               oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-map-marker-alt text-warning me-1"></i> Alamat</label>
                        <textarea name="alamat_supplier" class="form-control" rows="2" placeholder="Masukkan alamat" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-envelope text-info me-1"></i> Email</label>
                        <input type="email" name="email_supplier" class="form-control" placeholder="Masukkan email supplier" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-image text-primary me-1"></i> Foto Supplier</label>
                        <input type="file" name="foto_supplier" class="form-control" accept="image/*" onchange="previewImage(event)">
                        <small class="text-muted">Format: JPG, JPEG, PNG | Max: 2MB</small>

                        <!-- Preview Foto -->
                        <div class="mt-3 text-center" id="preview-container" style="display:none;">
                            <p class="mb-1 text-muted"><small>Preview Foto:</small></p>
                            <img id="preview-image" src="" alt="Preview" class="img-thumbnail shadow-sm"
                                 style="width:120px; height:120px; object-fit:cover;">
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-warning shadow-sm">
                            <i class="fas fa-save"></i> Save Supplier
                        </button>
                        <a href="{{ route('suppliers') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function previewImage(event) {
    const previewContainer = document.getElementById('preview-container');
    const previewImage = document.getElementById('preview-image');
    previewImage.src = URL.createObjectURL(event.target.files[0]);
    previewContainer.style.display = 'block';
}
</script>
@endsection