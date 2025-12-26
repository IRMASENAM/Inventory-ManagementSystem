@extends('layouts.app')

@section('title', 'Profil Pegawai - PLN System')

@section('contents')
<div style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif" class="row justify-content-center">
    <div class="col-md-10">
        <div class="card shadow-sm border-0 rounded-3">

            {{-- header --}}
            <div class="card-header bg-warning text-white fw-semibold">
                <i class="fas fa-user-circle me-5"></i> Profil Pegawai
            </div>
            <div class="card-body">
                {{-- Alert sukses --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    </div>
                @endif

                <form method="POST" enctype="multipart/form-data" 
                      id="profile_setup_frm" 
                      action="{{ route('profile.update') }}">
                    @csrf
                    
                    <div class="row g-3">
                        {{-- Foto Profil --}}
                        <div class="col-md-12 text-center mb-3">
                            <div class="profile-picture">
                                @if(auth()->user()->foto)
                                    <img src="{{ asset('storage/' . auth()->user()->foto) }}" 
                                         class="rounded-circle shadow-sm mb-2" 
                                         width="120" height="120" alt="Foto Profil">
                                @else
                                    <img src="{{ asset('images/default-user.png') }}" 
                                         class="rounded-circle shadow-sm mb-2" 
                                         width="120" height="120" alt="Default Foto">
                                @endif
                                <div>
                                    <input type="file" name="foto" class="form-control mt-2" accept="image/*">
                                    <small class="text-muted">Format: JPG/PNG, maks 2MB</small>
                                </div>
                            </div>
                        </div>

                        {{-- Data pegawai --}}
                        <div class="col-md-6">
                            <label class="form-label fw-bold">
                                <i class="fas fa-id-card me-1 text-danger"></i> Nama Lengkap
                            </label>
                            <input type="text" name="name" class="form-control" 
                                   value="{{ old('name', auth()->user()->name) }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">
                                <i class="fas fa-envelope me-1 text-danger"></i> Email
                            </label>
                            <input type="email" name="email" class="form-control" 
                                   value="{{ old('email', auth()->user()->email) }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">
                                <i class="fas fa-phone-alt me-1 text-danger"></i> Nomor Telepon
                            </label>
                            <input type="text" name="no_telepon" class="form-control" 
                                   value="{{ old('no_telepon', auth()->user()->no_telepon) }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">
                                <i class="fas fa-briefcase me-1 text-danger"></i> Jabatan
                            </label>
                            <input type="text" name="jabatan" class="form-control" 
                                   value="{{ old('jabatan', auth()->user()->jabatan ?? '') }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">
                                <i class="fas fa-building me-1 text-danger"></i> Divisi
                            </label>
                            <input type="text" name="divisi" class="form-control" 
                                   value="{{ old('divisi', auth()->user()->divisi ?? '') }}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">
                                <i class="fas fa-map-marker-alt me-1 text-danger"></i> Alamat
                            </label>
                            <input type="text" name="alamat" class="form-control" 
                                   value="{{ old('alamat', auth()->user()->alamat ?? '') }}">
                        </div>
                    </div>

                    <div class="text-end mt-4">
                        <button class="btn btn-warning text-white shadow-sm" type="submit">
                            <i class="fas fa-save me-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection