@extends('layouts.main')

@section('content')
<style>
    /* Global Styles (Disesuaikan dengan Hadirin aesthetic) */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Font konsisten dengan Hadirin */
        background-color: #f0f8ff; 
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

    .btn-success { /* Untuk tombol Import/Download Excel, jika nanti ada */
        background: linear-gradient(135deg, #28a745 0%, #218838 100%); /* Hijau sedikit lebih solid */
        border: none;
        color: white;
        box-shadow: 0 4px 10px rgba(40, 167, 69, 0.2);
    }
    .btn-success:hover {
        background: linear-gradient(135deg, #218838 0%, #1e7e34 100%);
        box-shadow: 0 6px 15px rgba(40, 167, 69, 0.3);
        transform: translateY(-1px);
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

    /* Alert Messages */
    .alert {
        border-radius: 8px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border-color: #c3e6cb;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border-color: #f5c6cb;
    }

    .alert-info {
        background-color: #dbeeff; /* Warna info sedikit lebih terang */
        color: #0d6efd;
        border-color: #b9d7fd;
    }

    /* Form Elements */
    .form-label {
        font-weight: 600;
        color: #1a1a1a; /* Warna teks gelap */
        margin-bottom: 0.8rem;
        font-size: 0.98rem;
    }

    .form-control, .form-select {
        border: 2px solid #a8dadc; /* Border lebih tebal dan warna Hadirin */
        border-radius: 12px;
        padding: 0.9rem 1.1rem;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.95);
        color: #3c4043;
    }

    .form-control:focus, .form-select:focus {
        outline: none;
        border-color: #00b4d8; /* Warna biru Hadirin saat fokus */
        box-shadow: 0 0 0 0.2rem rgba(0, 180, 216, 0.18);
        background: white;
        transform: translateY(-1px);
    }
    .form-control:hover, .form-select:hover {
        border-color: #00b4d8;
        background: white;
    }

    .form-control.is-invalid, .form-select.is-invalid {
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

    /* Info Card Specific */
    .card.border-info {
        border: 1px solid #0dcaf0 !important;
    }

    .card-header.bg-info.bg-opacity-10 {
        background-color: rgba(13, 202, 240, 0.1) !important;
    }

    .text-info {
        color: #0dcaf0 !important;
    }

    /* Table Styling */
    .table {
        margin-bottom: 0;
    }

    .table thead th {
        background-color: #e9ecef;
        color: #495057;
        font-weight: 600;
        border-bottom: 2px solid #dee2e6;
        padding: 1rem;
    }

    .table tbody tr {
        transition: background-color 0.2s ease;
    }

    .table tbody tr:hover {
        background-color: #f5f5f5;
    }

    .table td, .table th {
        vertical-align: middle;
        padding: 1rem;
    }

    .badge {
        font-size: 0.85em;
        font-weight: 600;
        padding: 0.5em 0.8em;
        border-radius: 0.375rem;
    }

    .bg-primary.bg-opacity-10 {
        background-color: rgba(0, 119, 182, 0.1) !important; /* Warna biru Hadirin transparan */
    }

    /* Dropdown Actions */
    .dropdown-menu {
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        border: none;
    }

    .dropdown-item {
        padding: 0.75rem 1.25rem;
        transition: background-color 0.2s ease, color 0.2s ease;
    }

    .dropdown-item:hover {
        background-color: #e9ecef;
        color: #0077b6;
    }

    .dropdown-item.text-warning:hover {
        background-color: #ffc107;
        color: white;
    }

    .dropdown-item.text-success:hover {
        background-color: #198754;
        color: white;
    }

    .dropdown-item.text-danger:hover {
        background-color: #dc3545;
        color: white;
    }

    .dropdown-divider {
        margin: 0.5rem 0;
    }

    /* Quick Stats Cards */
    .card.bg-primary,
    .card.bg-success,
    .card.bg-info,
    .card.bg-warning {
        color: white;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        border-radius: 15px; /* Sesuaikan dengan kartu utama */
    }

    .card.bg-primary {
        background-color: #0077b6 !important; /* Biru Hadirin gelap */
    }
    .card.bg-success {
        background-color: #198754 !important;
    }
    .card.bg-info {
        background-color: #0dcaf0 !important;
    }
    .card.bg-warning {
        background-color: #ffd60a !important; /* Kuning Hadirin */
        color: #212529 !important; /* Teks gelap untuk kartu kuning */
    }

    /* Empty State */
    .text-muted {
        color: #6c757d !important;
    }
    .fa-3x {
        font-size: 3em;
    }

    /* Icon spacing */
    .me-1 { margin-right: 0.25rem !important; }
    .me-2 { margin-right: 0.5rem !important; }

    /* DataTable Adjustments (opsional, tergantung integrasi DataTables) */
    #companiesTable_wrapper .dataTables_paginate .paginate_button.current,
    #companiesTable_wrapper .dataTables_paginate .paginate_button.current:hover {
        background-color: #0077b6 !important;
        border-color: #0077b6 !important;
        color: white !important;
    }
    #companiesTable_wrapper .dataTables_paginate .paginate_button:hover {
        background-color: #e9ecef !important;
        border-color: #dee2e6 !important;
    }

    /* Modal Styling (if any modals are added later) */
    .modal-content {
        border-radius: 20px;
        box-shadow: 0 15px 45px rgba(0, 116, 182, 0.2);
    }
    .modal-header {
        background: linear-gradient(135deg, #00b4d8 0%, #0077b6 100%);
        color: white;
        border-top-left-radius: 18px;
        border-top-right-radius: 18px;
        border-bottom: 3px solid #ffd60a;
    }
    .modal-title {
        font-weight: 600;
        font-size: 1.25rem;
    }
    .modal-footer {
        border-top: 1px solid #e9ecef;
    }

    /* Custom styles for centering and responsiveness */
    .container-fluid.centered-container {
        max-width: 1200px; /* Adjust this value as needed to control the width */
        margin: 0 auto; /* This centers the container */
    }

    /* Ensure the responsiveness of the table within the constrained container */
    @media (max-width: 992px) {
        .container-fluid.centered-container {
            max-width: 90%; /* Adjust for smaller screens */
        }
    }

    @media (max-width: 768px) {
        .container-fluid.centered-container {
            max-width: 95%; /* Even smaller screens */
        }
        .table-responsive {
            overflow-x: auto; /* Ensure table is scrollable on very small screens */
        }
    }

</style>

<div class="container-fluid py-4 centered-container"> {{-- Added centered-container class here --}}
    <div class="row">
        <div class="col-12">
            {{-- Header Section --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold text-primary mb-1">
                        <i class="fas fa-building me-2"></i>Manajemen Perusahaan
                    </h2>
                    <p class="text-muted mb-0">Kelola data perusahaan dan kategori peserta</p>
                </div>
                <a href="{{ route('companies.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Tambah Perusahaan
                </a>
            </div>

            {{-- Success Message --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Error Message --}}
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Companies Table --}}
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-list me-2"></i>Daftar Perusahaan
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-hover" id="companiesTable">
                            <thead class="table-light">
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="25%">Nama Perusahaan</th>
                                    <th width="30%">Deskripsi</th>
                                    <th width="10%">Urutan</th>
                                    <th width="10%">Unit</th>
                                    <th width="10%">Status</th>
                                    <th width="10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($companies as $company)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-2">
                                                    <i class="fas fa-building text-primary"></i>
                                                </div>
                                                <div>
                                                    <span class="fw-semibold">{{ $company->name }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="text-muted">{{ $company->description ?? '-' }}</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary">{{ $company->sort_order }}</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-info">{{ $company->units->count() }} unit</span>
                                        </td>
                                        <td>
                                            @if($company->is_active)
                                                <span class="badge bg-success">
                                                    <i class="fas fa-check-circle me-1"></i>Aktif
                                                </span>
                                            @else
                                                <span class="badge bg-danger">
                                                    <i class="fas fa-times-circle me-1"></i>Nonaktif
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown">
                                                    <i class="fas fa-cog"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('companies.edit', $company) }}">
                                                            <i class="fas fa-edit me-2"></i>Edit
                                                        </a>
                                                    </li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li>
                                                        <form action="{{ route('companies.toggle-status', $company) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="dropdown-item text-{{ $company->is_active ? 'warning' : 'success' }}">
                                                                <i class="fas fa-{{ $company->is_active ? 'pause' : 'play' }} me-2"></i>
                                                                {{ $company->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                                            </button>
                                                        </form>
                                                    </li>
                                                    <li>
                                                        <form action="{{ route('companies.destroy', $company) }}" method="POST" class="d-inline"
                                                              onsubmit="return confirm('Yakin ingin menghapus perusahaan ini? Semua unit terkait akan ikut terhapus.')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item text-danger">
                                                                <i class="fas fa-trash me-2"></i>Hapus
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="fas fa-inbox fa-3x mb-3"></i>
                                                <p>Belum ada data perusahaan</p>
                                                <a href="{{ route('companies.create') }}" class="btn btn-primary">
                                                    <i class="fas fa-plus me-2"></i>Tambah Perusahaan Pertama
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Quick Stats --}}
            @if($companies->count() > 0)
                <div class="row mt-4">
                    <div class="col-md-3">
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h6 class="card-title">Total Perusahaan</h6>
                                        <h3 class="mb-0">{{ $companies->count() }}</h3>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="fas fa-building fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-success text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h6 class="card-title">Perusahaan Aktif</h6>
                                        <h3 class="mb-0">{{ $companies->where('is_active', true)->count() }}</h3>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="fas fa-check-circle fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-info text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h6 class="card-title">Total Unit</h6>
                                        <h3 class="mb-0">{{ $companies->sum(function($company) { return $company->units->count(); }) }}</h3>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="fas fa-sitemap fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-warning text-dark">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h6 class="card-title">Perusahaan Nonaktif</h6>
                                        <h3 class="mb-0">{{ $companies->where('is_active', false)->count() }}</h3>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="fas fa-times-circle fa-2x"></i>
                                    </div>
                                </div>
                            </div>
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
    $('#companiesTable').DataTable({
        "order": [[ 3, "asc" ]] // Sort by sort_order
    });

    // Confirmation for toggle status
    $('form[action*="toggle-status"]').on('submit', function(e) {
        var isActive = $(this).closest('tr').find('.badge').hasClass('bg-success');
        var action = isActive ? 'menonaktifkan' : 'mengaktifkan';
        var companyName = $(this).closest('tr').find('td:nth-child(2) span.fw-semibold').text();

        if (!confirm(`Yakin ingin ${action} perusahaan "${companyName}"?`)) {
            e.preventDefault();
        }
    });
});
</script>
@endpush
@endsection