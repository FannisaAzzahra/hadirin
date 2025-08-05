@extends('layouts.main')

@section('content')
<style>
    /* Global Styles (Disesuaikan dengan Hadirin aesthetic) */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Font konsisten dengan Hadirin */
        background-color: #f0f2f5; /* Latar belakang abu-abu muda, tetap clean */
    }

    /* Card Styling */
    .card {
        border: none;
        border-radius: 20px; /* Radius sudut kartu yang lebih besar, Hadirin style */
        box-shadow: 0 15px 45px rgba(0, 116, 182, 0.2); /* Bayangan soft biru */
        overflow: hidden;
        transition: all 0.3s ease; /* Transisi untuk hover */
    }

    .card:hover {
        box-shadow: 0 20px 55px rgba(0, 116, 182, 0.25);
        transform: translateY(-2px);
    }

    .card-header {
        background: linear-gradient(135deg, #0077b6 0%, #00b4d8 100%); /* Gradien biru Hadirin, default untuk card-header */
        color: white;
        padding: 1.5rem 2rem; /* Padding lebih besar */
        border-bottom: 3px solid #ffd60a; /* Aksen kuning */
        font-weight: 700; /* Lebih tebal */
        font-size: 1.5rem; /* Ukuran font lebih besar */
        display: flex;
        align-items: center;
        gap: 0.75rem;
        position: relative; /* Untuk shimmer */
        overflow: hidden;
    }

    /* Tambahan untuk shimmer pada card-header */
    .card-header::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(45deg, transparent, rgba(255, 214, 10, 0.15), transparent);
        transform: rotate(-45deg);
        animation: headerShimmer 4s infinite; /* Efek shimmer */
    }

    @keyframes headerShimmer {
        0% { transform: translateX(-100%) translateY(-100%) rotate(-45deg); }
        100% { transform: translateX(100%) translateY(100%) rotate(-45deg); }
    }

    /* Buttons */
    .btn {
        border-radius: 12px; /* Sudut tombol membulat, Hadirin style */
        font-weight: 600;
        padding: 0.9rem 2.2rem; /* Padding lebih besar */
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.6rem; /* Jarak ikon dengan teks */
        text-decoration: none;
    }

    .btn-primary {
        background: linear-gradient(135deg, #00b4d8 0%, #0077b6 100%); /* Gradien biru Hadirin */
        border: none;
        color: white;
        box-shadow: 0 6px 20px rgba(0, 180, 216, 0.3); /* Bayangan biru Hadirin */
        position: relative;
        overflow: hidden;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #008eb4 0%, #005a8b 100%); /* Gradien sedikit lebih gelap */
        box-shadow: 0 8px 25px rgba(0, 180, 216, 0.4);
        transform: translateY(-2px);
    }

    .btn-secondary {
        background: rgba(108, 117, 125, 0.1); /* Warna abu-abu transparan */
        border: 1px solid rgba(108, 117, 125, 0.3);
        color: #495057; /* Warna teks abu-abu gelap */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    }

    .btn-secondary:hover {
        background: rgba(108, 117, 125, 0.2);
        border-color: rgba(108, 117, 125, 0.4);
        transform: translateY(-1px);
    }

    /* Form Elements */
    .form-label {
        font-weight: 600;
        color: #1a1a1a; /* Warna teks gelap */
        margin-bottom: 0.8rem;
        font-size: 0.98rem;
    }

    .form-control, .form-select { /* Added form-select here */
        border: 2px solid #a8dadc; /* Border lebih tebal dan warna Hadirin */
        border-radius: 12px;
        padding: 0.9rem 1.1rem;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.95);
        color: #3c4043;
    }

    .form-control:focus, .form-select:focus { /* Added form-select here */
        outline: none;
        border-color: #00b4d8; /* Warna biru Hadirin saat fokus */
        box-shadow: 0 0 0 0.2rem rgba(0, 180, 216, 0.18);
        background: white;
        transform: translateY(-1px);
    }
    .form-control:hover, .form-select:hover { /* Added form-select here */
        border-color: #00b4d8;
        background: white;
    }

    .form-control.is-invalid, .form-select.is-invalid { /* Added form-select here */
        border-color: #dc3545 !important;
    }

    .invalid-feedback {
        color: #dc3545;
        font-size: 0.88rem;
        margin-top: 0.6rem;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }
    .invalid-feedback::before {
        content: '⚠️';
        font-size: 0.85rem;
    }

    .form-text {
        font-size: 0.875em;
        color: #6c757d;
        margin-top: 0.25rem;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    /* Switch toggle alignment */
    .form-check {
        display: flex;
        align-items: center; /* Vertically center items */
        min-height: 1.5rem; /* Ensure enough height for alignment */
    }
    .form-switch .form-check-input {
        width: 2.5em;
        height: 1.4em;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='rgba%280, 0, 0, 0.25%29'/%3e%3c/svg%3e");
        background-position: left center;
        border-radius: 2em;
        transition: background-position .15s ease-in-out;
        float: none; /* Remove float to prevent interference with flexbox */
        margin-right: 0.75rem; /* Add some space between toggle and text */
        margin-top: 0; /* Reset default top margin */
    }
    .form-switch .form-check-input:checked {
        background-position: right center;
        background-color: #0077b6;
        border-color: #0077b6;
    }
    .form-check-label {
        margin-bottom: 0; /* Remove default margin-bottom */
    }

    /* Header Section Text */
    .fw-bold.text-primary {
        color: #0077b6 !important;
    }

    /* Help Card Specific */
    .card.border-info {
        border: 1px solid #0dcaf0 !important;
    }

    .card-header.bg-info.bg-opacity-10 {
        background-color: rgba(13, 202, 240, 0.1) !important;
        /* Removed color: #0dcaf0 !important; to allow text-white to take effect */
    }

    .text-info {
        color: #0dcaf0 !important;
    }

    /* Icon spacing */
    .me-1 { margin-right: 0.25rem !important; }
    .me-2 { margin-right: 0.5rem !important; }
</style>

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
                <div class="card-header bg-primary text-white"> {{-- Tetap bg-primary text-white sesuai desain unit --}}
                    <h5 class="card-title mb-0">
                        <i class="fas fa-sitemap me-2"></i>Form Tambah Unit
                    </h5>
                </div>
                <div class="card-body p-5"> {{-- Tambahkan padding di card-body --}}
                    <form action="{{ route('company-units.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                {{-- Pilih Perusahaan --}}
                                <div class="mb-3">
                                    <label for="company_id" class="form-label"> {{-- Removed fw-semibold, applied globally --}}
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
                                    <label for="sort_order" class="form-label"> {{-- Removed fw-semibold, applied globally --}}
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
                            <label for="name" class="form-label"> {{-- Removed fw-semibold, applied globally --}}
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
                            <label for="description" class="form-label"> {{-- Removed fw-semibold, applied globally --}}
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
                                <label class="form-check-label"> {{-- Removed fw-semibold, applied globally --}}
                                    Status Aktif
                                </label>
                            </div>
                            <div class="form-text">
                                <i class="fas fa-toggle-on me-1"></i>
                                Unit aktif akan muncul di dropdown form absensi
                            </div>
                        </div>

                        {{-- Submit Buttons --}}
                        <div class="d-flex gap-2 justify-content-end pt-4 border-top border-light"> {{-- Added justify-content-end and pt-4 border-top border-light for consistency --}}
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
                    <h6 class="card-title mb-0 text-white"> {{-- Changed text-info to text-white --}}
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