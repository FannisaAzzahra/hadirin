@extends('layouts.main')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            {{-- Header Section --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold text-primary mb-1">
                        <i class="fas fa-plus-circle me-2"></i>Tambah Perusahaan
                    </h2>
                    <p class="text-muted mb-0">Tambah perusahaan atau kategori peserta baru</p>
                </div>
                <a href="{{ route('companies.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>

            {{-- Form Card --}}
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-building me-2"></i>Form Tambah Perusahaan
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('companies.store') }}" method="POST">
                        @csrf
                        
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
                                           value="{{ old('name') }}" 
                                           placeholder="Contoh: PLN UIT JBM, PLN Lainnya, Non PLN"
                                           required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Nama perusahaan harus unik dan akan muncul di dropdown form absensi
                                    </div>
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

                        {{-- Deskripsi --}}
                        <div class="mb-3">
                            <label for="description" class="form-label fw-semibold">
                                Deskripsi
                            </label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="3" 
                                      placeholder="Deskripsi singkat tentang perusahaan atau kategori ini">{{ old('description') }}</textarea>
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
                                Perusahaan aktif akan muncul di dropdown form absensi
                            </div>
                        </div>

                        {{-- Submit Buttons --}}
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Simpan Perusahaan
                            </button>
                            <a href="{{ route('companies.index') }}" class="btn btn-secondary">
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
                        <li><strong>Nama Perusahaan:</strong> Gunakan nama yang jelas dan mudah dipahami peserta</li>
                        <li><strong>Urutan Tampilan:</strong> Semakin kecil angka, semakin atas posisinya di dropdown</li>
                        <li><strong>Status Aktif:</strong> Hanya perusahaan aktif yang akan muncul di form absensi publik</li>
                        <li><strong>Unit:</strong> Setelah membuat perusahaan, Anda bisa menambahkan unit-unit di menu "Data Unit"</li>
                    </ul>
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
    
    // Auto generate slug (optional untuk future use)
    $('#name').on('input', function() {
        // Bisa ditambahkan logic untuk auto-generate slug jika diperlukan
    });
});
</script>
@endpush
@endsection