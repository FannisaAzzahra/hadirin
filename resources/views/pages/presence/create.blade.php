@extends('layouts.main')

@section('content')
    <div class="container my-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <div class="row align-items-center">
                    <div class="col">
                        <h4 class="card-title mb-0">
                            <i class="fas fa-plus-circle me-2"></i>
                            Tambah Kegiatan
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a href="{{ route('presence.index') }}" class="btn btn-light">
                            <i class="fas fa-arrow-left me-1"></i>
                            Kembali
                        </a>
                    </div>
                </div>         
            </div>
            <div class="card-body">
                <form action="{{ route('presence.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Informasi Kegiatan -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="p-3 rounded mb-3" style="background-color: #EFEFEF;">
                                <h5 class="mb-0 text-primary">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Informasi Kegiatan
                                </h5>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nama_kegiatan" class="form-label fw-bold">Nama Kegiatan</label>
                            <input type="text" class="form-control @error('nama_kegiatan') is-invalid @enderror" 
                                name="nama_kegiatan" id="nama_kegiatan" value="{{ old('nama_kegiatan') }}"
                                placeholder="Masukkan nama kegiatan">
                            @error('nama_kegiatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tgl_kegiatan" class="form-label fw-bold">Tanggal Kegiatan</label>
                            <input type="date" class="form-control @error('tgl_kegiatan') is-invalid @enderror" 
                                name="tgl_kegiatan" id="tgl_kegiatan" value="{{ old('tgl_kegiatan') }}">
                            @error('tgl_kegiatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="waktu_mulai" class="form-label fw-bold">Waktu Mulai</label>
                            <input type="time" class="form-control @error('waktu_mulai') is-invalid @enderror" 
                                name="waktu_mulai" id="waktu_mulai" value="{{ old('waktu_mulai') }}">
                            @error('waktu_mulai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="batas_waktu" class="form-label fw-bold">Batas Waktu Absen <small class="text-muted">(opsional)</small></label>
                            <input type="datetime-local" class="form-control" name="batas_waktu" id="batas_waktu" 
                                value="{{ old('batas_waktu') }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label for="lokasi" class="form-label fw-bold">Nama Lokasi</label>
                            <input type="text" class="form-control @error('lokasi') is-invalid @enderror" 
                                name="lokasi" id="lokasi" placeholder="Contoh: Zoom, Ruang Rapat" 
                                value="{{ old('lokasi') }}">
                            @error('lokasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="is_active" class="form-label fw-bold">Status</label>
                            <div class="form-check form-switch mt-2">
                                <input type="checkbox" class="form-check-input" name="is_active" id="is_active" 
                                    {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Aktifkan Absen</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="link_lokasi" class="form-label fw-bold">Link Lokasi <small class="text-muted">(jika ada)</small></label>
                        <input type="url" class="form-control @error('link_lokasi') is-invalid @enderror" 
                            name="link_lokasi" id="link_lokasi" placeholder="https://..." 
                            value="{{ old('link_lokasi') }}">
                        @error('link_lokasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Pengaturan Tampilan -->
                    <div class="row mb-4 mt-5">
                        <div class="col-12">
                            <div class="p-3 rounded mb-3" style="background-color: #EFEFEF;">
                                <h5 class="mb-0 text-primary">
                                    <i class="fas fa-palette me-2"></i>
                                    Pengaturan Tampilan
                                </h5>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="judul_header" class="form-label fw-bold">Judul Header</label>
                        <input type="text" class="form-control" name="judul_header" id="judul_header" 
                            value="{{ old('judul_header') }}" placeholder="Masukkan judul header">
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="logo_kiri" class="form-label fw-bold">Logo Kiri</label>
                            <input type="file" class="form-control" name="logo_kiri" id="logo_kiri" accept="image/*">
                            <small class="text-muted">Format: JPG, PNG, GIF</small>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="logo_kanan" class="form-label fw-bold">Logo Kanan</label>
                            <input type="file" class="form-control" name="logo_kanan" id="logo_kanan" accept="image/*">
                            <small class="text-muted">Format: JPG, PNG, GIF</small>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="logo_ig" class="form-label fw-bold">Logo Instagram</label>
                            <input type="file" class="form-control" name="logo_ig" id="logo_ig" accept="image/*">
                            <small class="text-muted">Format: JPG, PNG, GIF</small>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="link_ig" class="form-label fw-bold">Username Instagram</label>
                        <input type="text" class="form-control" name="link_ig" id="link_ig" 
                            placeholder="misal: fannisa.azzahra" value="{{ old('link_ig') }}">
                    </div>

                    @include('pages.presence.partials.slide-settings')

                    <!-- Tombol Aksi -->
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                        <a href="{{ route('presence.index') }}" class="btn btn-outline-secondary me-md-2">
                            <i class="fas fa-times me-1"></i>
                            Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>
                            Simpan Kegiatan
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
    
    .form-switch .form-check-input:checked {
        background-color: #198754;
        border-color: #198754;
    }
</style>
@endpush