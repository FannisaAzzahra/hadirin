@extends('layouts.main')

@section('content')
<div class="container-fluid py-4">
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
                <div class="card-body">
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
                        <h6 class="card-title mb-0 text-info">
                            <i class="fas fa-filter me-2"></i>Filter Unit
                        </h6>
                    </div>
                    <div class="card-body">
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