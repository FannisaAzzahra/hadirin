@extends('layouts.main')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            {{-- Header Section --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold text-primary mb-1">
                        <i class="fas fa-edit me-2"></i>Edit Perusahaan
                    </h2>
                    <p class="text-muted mb-0">Edit data perusahaan: {{ $company->name }}</p>
                </div>
                <a href="{{ route('companies.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>

            {{-- Form Card --}}
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-building me-2"></i>Form Edit Perusahaan
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('companies.update', $company) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-8">
                                {{-- Nama Perusahaan --}}
                                <div class="mb-3">
                                    <label for="name" class="form-label fw-semibold">
                                        Nama Perusahaan <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           id="name" 
                                           name="name" 
                                           value="{{ old('name', $company->name) }}" 
                                           placeholder="Contoh: PLN UIT JBM, PLN Lainnya, Non PLN"
                                           required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                {{-- Sort Order --}}
                                <div class="mb-3">
                                    <label for="sort_order" class="form-label fw-semibold">
                                        Urutan Tampilan
                                    </label>
                                    <input type="number" 
                                           class="form-control @error('sort_order') is-invalid @enderror" 
                                           id="sort_order" 
                                           name="sort_order" 
                                           value="{{ old('sort_order', $company->sort_order) }}" 
                                           min="0">
                                    @error('sort_order')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Deskripsi --}}
                        <div class="mb-3">
                            <label for="description" class="form-label fw-semibold">
                                Deskripsi
                            </label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="3" 
                                      placeholder="Deskripsi singkat tentang perusahaan atau kategori ini">{{ old('description', $company->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Status Aktif --}}
                        <div class="mb-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" 
                                       type="checkbox" 
                                       id="is_active" 
                                       name="is_active" 
                                       value="1" 
                                       {{ old('is_active', $company->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold" for="is_active">
                                    Status Aktif
                                </label>
                            </div>
                            <div class="form-text">
                                <i class="fas fa-toggle-on me-1"></i>
                                Perusahaan aktif akan muncul di dropdown form absensi
                            </div>
                        </div>

                        {{-- Submit Buttons --}}
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Update Perusahaan
                            </button>
                            <a href="{{ route('companies.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times me-2"></i>Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Company Units Info --}}
            @if($company->units->count() > 0)
                <div class="card mt-4 border-info">
                    <div class="card-header bg-info bg-opacity-10 border-info">
                        <h6 class="card-title mb-0 text-info">
                            <i class="fas fa-sitemap me-2"></i>Unit yang Terkait ({{ $company->units->count() }} unit)
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($company->units as $unit)
                                <div class="col-md-6 mb-2">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-layer-group text-info me-2"></i>
                                        <span class="{{ $unit->is_active ? '' : 'text-muted' }}">
                                            {{ $unit->name }}
                                            @if(!$unit->is_active)
                                                <small class="text-danger">(Nonaktif)</small>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('company-units.index') }}" class="btn btn-sm btn-outline-info">
                                <i class="fas fa-cog me-1"></i>Kelola Unit
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@push('js')
<script>
$(document).ready(function() {
    // Auto focus pada field nama
    $('#name').focus();
});
</script>
@endpush
@endsection