@extends('layouts.main')

@section('content')
    <div class="container my-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <div class="row align-items-center">
                    <div class="col">
                        <h4 class="card-title mb-0">
                            <i class="fas fa-edit me-2"></i>
                            Edit Kegiatan
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
                <form action="{{ route('presence.update', $presence->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    
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
                                name="nama_kegiatan" id="nama_kegiatan" 
                                value="{{ old('nama_kegiatan', $presence->nama_kegiatan) }}"
                                placeholder="Masukkan nama kegiatan">
                            @error('nama_kegiatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tgl_kegiatan" class="form-label fw-bold">Tanggal Kegiatan</label>
                            <input type="date" class="form-control @error('tgl_kegiatan') is-invalid @enderror" 
                                name="tgl_kegiatan" id="tgl_kegiatan" 
                                value="{{ old('tgl_kegiatan', date('Y-m-d', strtotime($presence->tgl_kegiatan))) }}">
                            @error('tgl_kegiatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="waktu_mulai" class="form-label fw-bold">Waktu Mulai</label>
                            <input type="time" class="form-control @error('waktu_mulai') is-invalid @enderror" 
                                name="waktu_mulai" id="waktu_mulai" 
                                value="{{ old('waktu_mulai', date('H:i', strtotime($presence->tgl_kegiatan))) }}">
                            @error('waktu_mulai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="batas_waktu" class="form-label fw-bold">Batas Waktu Absen <small class="text-muted">(opsional)</small></label>
                            <input type="datetime-local" class="form-control" name="batas_waktu" id="batas_waktu" 
                                value="{{ old('batas_waktu', $presence->batas_waktu ? date('Y-m-d\TH:i', strtotime($presence->batas_waktu)) : '') }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label for="lokasi" class="form-label fw-bold">Nama Lokasi</label>
                            <input type="text" class="form-control @error('lokasi') is-invalid @enderror" 
                                name="lokasi" id="lokasi" placeholder="Contoh: Zoom, Ruang Rapat" 
                                value="{{ old('lokasi', $presence->lokasi) }}">
                            @error('lokasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="is_active" class="form-label fw-bold">Status</label>
                            <div class="form-check form-switch mt-2">
                                <input type="checkbox" class="form-check-input" name="is_active" id="is_active" 
                                    {{ old('is_active', $presence->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Aktifkan Absen</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="link_lokasi" class="form-label fw-bold">Link Lokasi <small class="text-muted">(jika ada)</small></label>
                        <input type="url" class="form-control @error('link_lokasi') is-invalid @enderror" 
                            name="link_lokasi" id="link_lokasi" placeholder="https://..." 
                            value="{{ old('link_lokasi', $presence->link_lokasi) }}">
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
                            value="{{ old('judul_header', $presence->judul_header) }}" placeholder="Masukkan judul header">
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="logo_kiri" class="form-label fw-bold">Logo Kiri</label>
                            <input type="file" class="form-control" name="logo_kiri" id="logo_kiri" accept="image/*">
                            <small class="text-muted">Format: JPG, PNG, GIF</small>
                            @if ($presence->logo_kiri)
                                <div class="mt-2">
                                    <img src="{{ asset('uploads/' . $presence->logo_kiri) }}" height="50" class="rounded border">
                                    <small class="text-muted d-block">Logo saat ini</small>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="logo_kanan" class="form-label fw-bold">Logo Kanan</label>
                            <input type="file" class="form-control" name="logo_kanan" id="logo_kanan" accept="image/*">
                            <small class="text-muted">Format: JPG, PNG, GIF</small>
                            @if ($presence->logo_kanan)
                                <div class="mt-2">
                                    <img src="{{ asset('uploads/' . $presence->logo_kanan) }}" height="50" class="rounded border">
                                    <small class="text-muted d-block">Logo saat ini</small>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="logo_ig" class="form-label fw-bold">Logo Instagram</label>
                            <input type="file" class="form-control" name="logo_ig" id="logo_ig" accept="image/*">
                            <small class="text-muted">Format: JPG, PNG, GIF</small>
                            @if ($presence->logo_ig)
                                <div class="mt-2">
                                    <img src="{{ asset('uploads/' . $presence->logo_ig) }}" height="50" class="rounded border">
                                    <small class="text-muted d-block">Logo saat ini</small>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="link_ig" class="form-label fw-bold">Link Instagram</label>
                        <input type="url" class="form-control" name="link_ig" id="link_ig" 
                            placeholder="https://instagram.com/username" 
                            value="{{ old('link_ig', $presence->link_ig) }}">
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Foto Slide <small class="text-muted">(maksimal 5 foto)</small></label>
                        <input type="file" class="form-control" name="slide_images[]" multiple accept="image/*">
                        <small class="text-muted">Pilih maksimal 5 gambar (format JPG, PNG, atau GIF). Disarankan rasio landscape 16:9 untuk hasil terbaik.</small>
                        @if ($presence->slides && count($presence->slides) > 0)
                            <div class="mt-2">
                                <small class="text-muted d-block mb-2">Foto slide saat ini:</small>
                                <div class="row">
                                    @foreach ($presence->slides as $slide)
                                        <div class="col-md-2 mb-2">
                                            <img src="{{ asset('uploads/' . $slide->image_path) }}" class="img-fluid rounded border">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
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
                            Update Kegiatan
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

    .img-fluid {
        max-height: 80px;
        object-fit: cover;
    }
</style>
@endpush