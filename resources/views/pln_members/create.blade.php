@extends('layouts.main')

@section('content')
    <div class="container my-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <div class="row align-items-center">
                    <div class="col">
                        <h4 class="card-title mb-0">
                            <i class="fas fa-user-plus me-2"></i>
                            Tambah Anggota PLN
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a href="{{ route('pln-members.index') }}" class="btn btn-light">
                            <i class="fas fa-arrow-left me-1"></i>
                            Kembali
                        </a>
                    </div>
                </div>         
            </div>
            <div class="card-body">
                <form action="{{ route('pln-members.store') }}" method="POST">
                    @csrf
                    
                    <!-- Informasi Anggota -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="p-3 rounded mb-3" style="background-color: #EFEFEF;">
                                <h5 class="mb-0 text-primary">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Informasi Anggota
                                </h5>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nama" class="form-label fw-bold">Nama Lengkap</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                                name="nama" id="nama" value="{{ old('nama') }}"
                                placeholder="Masukkan nama lengkap">
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="nip" class="form-label fw-bold">NIP</label>
                            <input type="text" class="form-control @error('nip') is-invalid @enderror" 
                                name="nip" id="nip" value="{{ old('nip') }}"
                                placeholder="Masukkan NIP">
                            @error('nip')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label fw-bold">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                name="email" id="email" value="{{ old('email') }}"
                                placeholder="Masukkan email">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="no_hp" class="form-label fw-bold">No HP</label>
                            <input type="text" class="form-control @error('no_hp') is-invalid @enderror" 
                                name="no_hp" id="no_hp" value="{{ old('no_hp') }}"
                                placeholder="Masukkan nomor HP">
                            @error('no_hp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="jabatan" class="form-label fw-bold">Jabatan</label>
                        <input type="text" class="form-control @error('jabatan') is-invalid @enderror" 
                            name="jabatan" id="jabatan" value="{{ old('jabatan') }}"
                            placeholder="Masukkan jabatan">
                        @error('jabatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                        <a href="{{ route('pln-members.index') }}" class="btn btn-outline-secondary me-md-2">
                            <i class="fas fa-times me-1"></i>
                            Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>
                            Simpan Anggota
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .form-label {
        color: #495057;
        margin-bottom: 0.5rem;
    }
    
    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }
    
    .card {
        border: none;
        border-radius: 10px;
    }
    
    .card-header {
        border-radius: 10px 10px 0 0 !important;
    }
    
    .border-bottom {
        border-color: #dee2e6 !important;
    }
</style>
@endpush