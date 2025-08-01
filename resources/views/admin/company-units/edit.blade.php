@extends('layouts.main')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            {{-- Header Section --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold text-primary mb-1">
                        <i class="fas fa-edit me-2"></i>Edit Unit
                    </h2>
                    <p class="text-muted mb-0">Edit unit: {{ $companyUnit->name }} ({{ $companyUnit->company->name }})</p>
                </div>
                <a href="{{ route('company-units.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>

            {{-- Form Card --}}
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-sitemap me-2"></i>Form Edit Unit
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('company-units.update', $companyUnit) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                {{-- Pilih Perusahaan --}}
                                <div class="mb-3">
                                    <label for="company_id" class="form-label fw-semibold">
                                        Perusahaan <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select @error('company_id') is-invalid @enderror" 
                                            id="company_id" 
                                            name="company_id" 
                                            required>
                                        <option value="">-- Pilih Perusahaan --</option>
                                        @foreach($companies as $company)
                                            <option value="{{ $company->id }}" 
                                                {{ old('company_id', $companyUnit->company_id) == $company->id ? 'selected' : '' }}>
                                                {{ $company->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('company_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                {{-- Sort Order --}}
                                <div class="mb-3">
                                    <label for="sort_order" class="form-label fw-semibold">
                                        Urutan Tampilan
                                    </label>
                                    <input type="number" 
                                           class="form-control @error('sort_order') is-invalid @enderror" 
                                           id="sort_order" 
                                           name="sort_order" 
                                           value="{{ old('sort_order', $companyUnit->sort_order) }}" 
                                           min="0">
                                    @error('sort_order')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">
                                        <i class="fas fa-sort me-1"></i>
                                        Angka kecil akan muncul lebih dulu
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Nama Unit --}}
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">
                                Nama Unit <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $companyUnit->name) }}" 
                                   placeholder="Contoh: KANTOR INDUK, UPT SURABAYA, dll"
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                Nama unit harus unik dalam satu perusahaan
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
                                      placeholder="Deskripsi singkat tentang unit ini">{{ old('description', $companyUnit->description) }}</textarea>
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
                                       {{ old('is_active', $companyUnit->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold" for="is_active">
                                    Status Aktif
                                </label>
                            </div>
                            <div class="form-text">
                                <i class="fas fa-toggle-on me-1"></i>
                                Unit aktif akan muncul di dropdown form absensi
                            </div>
                        </div>

                        {{-- Submit Buttons --}}
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Update Unit
                            </button>
                            <a href="{{ route('company-units.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times me-2"></i>Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Info Card --}}
            <div class="card mt-4 border-warning">
                <div class="card-header bg-warning bg-opacity-10 border-warning">
                    <h6 class="card-title mb-0 text-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>Perhatian
                    </h6>
                </div>
                <div class="card-body">
                    <p class="mb-0">
                        Jika Anda mengubah perusahaan unit ini, pastikan tidak ada data absensi yang sudah menggunakan 
                        kombinasi perusahaan dan unit lama. Perubahan ini dapat mempengaruhi laporan yang sudah ada.
                    </p>
                </div>
            </div>
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