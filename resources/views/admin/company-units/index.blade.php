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

    /* Switch toggle alignment (not directly in index.blade.php but for consistency) */
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

    /* Icon spacing */
    .me-1 { margin-right: 0.25rem !important; }
    .me-2 { margin-right: 0.5rem !important; }

    /* Specific styles for table elements, keeping fw-semibold where appropriate (e.g., in table cells) */
    .table-responsive .fw-semibold {
        font-weight: 600 !important; /* Ensure fw-semibold explicitly applies when needed in table */
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

<div class="container-fluid py-4 centered-container"> {{-- Ditambahkan kelas centered-container di sini --}}
    <div class="row">
        <div class="col-12">
            {{-- Header Section --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold text-primary mb-1">
                        <i class="fas fa-sitemap me-2"></i>Manajemen Unit
                    </h2>
                    <p class="text-muted mb-0">Kelola unit detail untuk setiap perusahaan</p>
                </div>
                <a href="{{ route('company-units.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Tambah Unit
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

            {{-- Company Units Table --}}
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-list me-2"></i>Daftar Unit
                    </h5>
                </div>
                <div class="card-body p-4"> {{-- Added p-4 for consistent padding --}}
                    <div class="table-responsive">
                        <table class="table table-hover" id="unitsTable">
                            <thead class="table-light">
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="25%">Perusahaan</th>
                                    <th width="25%">Nama Unit</th>
                                    <th width="25%">Deskripsi</th>
                                    <th width="8%">Urutan</th>
                                    <th width="7%">Status</th>
                                    <th width="5%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($units as $unit)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="bg-primary bg-opacity-10 rounded-circle p-1 me-2">
                                                    <i class="fas fa-building text-primary"></i>
                                                </div>
                                                <span class="fw-semibold">{{ $unit->company->name }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="bg-info bg-opacity-10 rounded-circle p-1 me-2">
                                                    <i class="fas fa-layer-group text-info"></i>
                                                </div>
                                                <span class="fw-semibold">{{ $unit->name }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="text-muted">{{ $unit->description ?? '-' }}</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary">{{ $unit->sort_order }}</span>
                                        </td>
                                        <td>
                                            @if($unit->is_active)
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
                                                        <a class="dropdown-item" href="{{ route('company-units.edit', $unit) }}">
                                                            <i class="fas fa-edit me-2"></i>Edit
                                                        </a>
                                                    </li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li>
                                                        <form action="{{ route('company-units.toggle-status', $unit) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="dropdown-item text-{{ $unit->is_active ? 'warning' : 'success' }}">
                                                                <i class="fas fa-{{ $unit->is_active ? 'pause' : 'play' }} me-2"></i>
                                                                {{ $unit->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                                            </button>
                                                        </form>
                                                    </li>
                                                    <li>
                                                        <form action="{{ route('company-units.destroy', $unit) }}" method="POST" class="d-inline"
                                                              onsubmit="return confirm('Yakin ingin menghapus unit ini? Data yang terkait dengan unit ini mungkin akan terpengaruh.')">
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
                                                <p>Belum ada data unit</p>
                                                <a href="{{ route('company-units.create') }}" class="btn btn-primary">
                                                    <i class="fas fa-plus me-2"></i>Tambah Unit Pertama
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
            @if($units->count() > 0)
                <div class="row mt-4">
                    <div class="col-md-3">
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h6 class="card-title">Total Unit</h6>
                                        <h3 class="mb-0">{{ $units->count() }}</h3>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="fas fa-sitemap fa-2x"></i>
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
                                        <h6 class="card-title">Unit Aktif</h6>
                                        <h3 class="mb-0">{{ $units->where('is_active', true)->count() }}</h3>
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
                                        <h6 class="card-title">Perusahaan Terdaftar</h6>
                                        <h3 class="mb-0">{{ $units->groupBy('company_id')->count() }}</h3>
                                    </div>
                                    <div class="align-self-center">
                                        <i class="fas fa-building fa-2x"></i>
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
                                        <h6 class="card-title">Unit Nonaktif</h6>
                                        <h3 class="mb-0">{{ $units->where('is_active', false)->count() }}</h3>
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

            {{-- Filter by Company (Optional Enhancement) --}}
            @if($units->count() > 0 && $units->groupBy('company_id')->count() > 1)
                <div class="card mt-4 border-info">
                    <div class="card-header bg-info bg-opacity-10 border-info">
                        <h6 class="card-title mb-0 text-white"> {{-- Changed text-info to text-white --}}
                            <i class="fas fa-filter me-2"></i>Filter Unit
                        </h6>
                    </div>
                    <div class="card-body p-4"> {{-- Added p-4 for consistent padding --}}
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <label for="companyFilter" class="form-label">Filter berdasarkan Perusahaan:</label>
                                <select class="form-select" id="companyFilter">
                                    <option value="">-- Semua Perusahaan --</option>
                                    @foreach($units->groupBy('company.name') as $companyName => $companyUnits)
                                        <option value="{{ $companyName }}">{{ $companyName }} ({{ $companyUnits->count() }} unit)</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="statusFilter" class="form-label">Filter berdasarkan Status:</label>
                                <select class="form-select" id="statusFilter">
                                    <option value="">-- Semua Status --</option>
                                    <option value="active">Aktif</option>
                                    <option value="inactive">Nonaktif</option>
                                </select>
                            </div>
                            <div class="col-md-4 d-flex align-items-end">
                                <button type="button" class="btn btn-outline-secondary" id="clearFilter">
                                    <i class="fas fa-times me-2"></i>Clear Filter
                                </button>
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
    // Initialize DataTable
    var table = $('#unitsTable').DataTable({
        "order": [[ 4, "asc" ]], // Sort by sort_order (column index 4)
        "pageLength": 25,
        "responsive": true
    });

    // Company filter
    $('#companyFilter').on('change', function() {
        var selectedCompany = $(this).val();
        if (selectedCompany === '') {
            table.column(1).search('').draw(); // Column 1 is company name
        } else {
            table.column(1).search(selectedCompany).draw();
        }
    });

    // Status filter
    $('#statusFilter').on('change', function() {
        var selectedStatus = $(this).val();
        if (selectedStatus === '') {
            table.column(5).search('').draw(); // Column 5 is status
        } else if (selectedStatus === 'active') {
            table.column(5).search('Aktif').draw();
        } else if (selectedStatus === 'inactive') {
            table.column(5).search('Nonaktif').draw();
        }
    });

    // Clear all filters
    $('#clearFilter').on('click', function() {
        $('#companyFilter').val('');
        $('#statusFilter').val('');
        table.search('').columns().search('').draw();
    });

    // Confirmation for toggle status
    $('form[action*="toggle-status"]').on('submit', function(e) {
        var isActive = $(this).closest('tr').find('.badge').hasClass('bg-success');
        var action = isActive ? 'menonaktifkan' : 'mengaktifkan';
        var unitName = $(this).closest('tr').find('td:nth-child(3) span.fw-semibold').text();
        
        if (!confirm(`Yakin ingin ${action} unit "${unitName}"?`)) {
            e.preventDefault();
        }
    });
});
</script>
@endpush
@endsection