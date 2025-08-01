@extends('layouts.main')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            {{-- Header Section --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold text-primary mb-1">
                        <i class="fas fa-plus-circle me-2"></i>Tambah Unit
                    </h2>
                    <p class="text-muted mb-0">Tambah unit detail untuk perusahaan</p>
                </div>
                <a href="{{ route('company-units.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>

            {{-- Form Card --}}
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-sitemap me-2"></i>Form Tambah Unit
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('company-units.store') }}" method="POST">
                        @csrf
                        
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
                                            <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
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
                                           value="{{ old('sort_order', 0) }}" 
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
                                   value="{{ old('name') }}" 
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
                                      placeholder="Deskripsi singkat tentang unit ini">{{ old('description') }}</textarea>
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
                                       {{ old('is_active', true) ? 'checked' : '' }}>
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
                                <i class="fas fa-save me-2"></i>Simpan Unit
                            </button>
                            <a href="{{ route('company-units.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times me-2"></i>Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Help Card --}}
            <div class="card mt-4 border-info">
                <div class="card-header bg-info bg-opacity-10 border-info">
                    <h6 class="card-title mb-0 text-info">
                        <i class="fas fa-lightbulb me-2"></i>Tips Penggunaan
                    </h6>
                </div>
                <div class="card-body">
                    <ul class="mb-0">
                        <li><strong>Perusahaan:</strong> Pilih perusahaan yang akan memiliki unit ini</li>
                        <li><strong>Nama Unit:</strong> Gunakan nama yang jelas dan mudah dipahami</li>
                        <li><strong>Urutan Tampilan:</strong> Semakin kecil angka, semakin atas posisinya di dropdown</li>
                        <li><strong>Status Aktif:</strong> Hanya unit aktif yang akan muncul di form absensi publik</li>
                        <li><strong>Duplikasi:</strong> Nama unit tidak boleh sama dalam satu perusahaan yang sama</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
<script>
$(document).ready(function() {
    // Auto focus pada field perusahaan
    $('#company_id').focus();
    
    // Optional: Auto generate some suggestions based on company selection
    $('#company_id').on('change', function() {
        let companyName = $(this).find(':selected').text();
        let nameField = $('#name');
        
        // Clear current value
        if (!nameField.val()) {
            // Optional: Auto-suggest based on company type
            if (companyName.includes('PLN UIT JBM')) {
                // User can manually add suggestions here
            }
        }
    });
});
</script>
@endpush
@endsection