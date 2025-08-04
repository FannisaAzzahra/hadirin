@extends('layouts.main')

@section('content')
    <div class="container my-4">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h4 class="card-title">
                            Daftar Kegiatan
                        </h4>
                    </div>
                    <div class="col-md-6 text-end">
                        <a href="{{ route('presence.create') }}" class="btn btn-primary">
                            Tambah Kegiatan
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body px-3 pb-3">
                {{-- Form Filter Tanggal --}}
                <div class="mb-4">
                    <form action="{{ route('presence.index') }}" method="GET" id="filterForm">
                        <div class="d-flex flex-wrap align-items-center justify-content-start">
                            <div class="input-group flex-grow-1 me-2 mb-2" style="max-width: 250px;">
                                <input type="text" class="form-control datepicker-input" id="start_date" name="start_date" placeholder="Tanggal Mulai" value="{{ request('start_date') }}">
                            </div>
                            <span class="text-muted mx-2 mb-2">sampai</span>
                            <div class="input-group flex-grow-1 me-2 mb-2" style="max-width: 250px;">
                                <input type="text" class="form-control datepicker-input" id="end_date" name="end_date" placeholder="Tanggal Akhir" value="{{ request('end_date') }}">
                            </div>
                            <button type="submit" class="btn btn-filter-primary ms-2 mb-2"><i class="fas fa-filter me-2"></i> Filter</button>
                            <button type="button" class="btn btn-filter-secondary ms-2 mb-2" id="resetFilter"><i class="fas fa-undo me-2"></i> Reset</button>
                        </div>
                    </form>
                </div>
                {{-- Akhir Form Filter Tanggal --}}

                <div class="table-responsive">
                    {{ $dataTable->table(['class' => 'table table-bordered table-striped table-hover nowrap'], true) }}
                </div>
            </div>
        </div>
    </div>

    {{-- Custom Confirmation Modal --}}
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header modal-header-gradient text-white">
                    <h5 class="modal-title" id="confirmationModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus data ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Custom Error Modal --}}
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="errorModalLabel">Terjadi Kesalahan</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="errorMessage">
                    Terjadi kesalahan saat melakukan operasi.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    {{-- CSS untuk Bootstrap Datepicker --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

    <style>
        /* Card Styling */
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 119, 182, 0.1);
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(135deg, #0077b6 0%, #00b4d8 100%);
            color: white;
            border-bottom: 3px solid #ffd60a;
            padding: 1rem 1.5rem;
        }

        .card-title {
            color: white;
            font-weight: 600;
            margin-bottom: 0;
        }

        /* Button Styling - Tambah Kegiatan */
        .btn-primary {
            background: linear-gradient(135deg, #ffd60a 0%, #ffed4a 100%);
            border: none;
            color: #333;
            font-weight: 600;
            border-radius: 10px;
            padding: 0.75rem 1.5rem;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #e6c200 0%, #f5d316 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(255, 214, 10, 0.3);
            color: #333;
        }

        /* Filter button - Green */
        .btn-filter-primary {
            background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
            border: none;
            color: white;
            font-weight: 600;
            border-radius: 10px;
            padding: 0.75rem 1.5rem;
            transition: all 0.3s ease;
        }

        .btn-filter-primary:hover {
            background: linear-gradient(135deg, #1e7e34 0%, #155724 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
            color: white;
        }

        /* Reset button - Blue */
        .btn-filter-secondary {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            border: none;
            color: white;
            font-weight: 600;
            border-radius: 10px;
            padding: 0.75rem 1.5rem;
            transition: all 0.3s ease;
        }

        .btn-filter-secondary:hover {
            background: linear-gradient(135deg, #0056b3 0%, #004085 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
            color: white;
        }

        /* Action Buttons in DataTable */
        .table .btn-sm { 
            border-radius: 6px;
            margin: 0 2px;
            transition: all 0.3s ease;
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }

        /* Detail button */
        .table .btn-secondary {
            background: linear-gradient(135deg, #343a40 0%, #495057 100%); 
            border: none;
            color: white;
        }
        .table .btn-secondary:hover {
            background: linear-gradient(135deg, #495057 0%, #343a40 100%);
            transform: translateY(-1px);
            color: white;
        }

        /* Edit button */
        .table .btn-warning {
            background: linear-gradient(135deg, #ffd60a, #ffed4a);
            border: none;
            color: #333;
        }

        .table .btn-warning:hover {
            background: linear-gradient(135deg, #e6c200, #f5d316);
            transform: translateY(-1px);
            color: #333;
        }

        /* Delete button */
        .table .btn-danger {
            background: linear-gradient(135deg, #dc2626, #ef4444);
            border: none;
        }

        .table .btn-danger:hover {
            background: linear-gradient(135deg, #b91c1c, #dc2626);
            transform: translateY(-1px);
        }

        /* Table Styling */
        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background: linear-gradient(135deg, #0077b6 0%, #188ecd 100%);
            color: white;
            border: none;
            font-weight: 600;
            text-align: center;
            vertical-align: middle;
            padding: 1rem;
        }

        table.dataTable th,
        table.dataTable td {
            white-space: normal !important;
            word-wrap: break-word;
            overflow-wrap: break-word;
            max-width: 200px;
        }

        table.dataTable thead th {
            text-align: center;
            vertical-align: middle;
        }

        /* Datepicker Inputs */
        .datepicker-input {
            border-radius: 10px !important;
            padding: 0.75rem 1.5rem !important;
        }

        /* Modal Styling */
        .modal-content {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
        }

        .modal-header-gradient {
            background: linear-gradient(135deg, #00b4d8 0%, #0077b6 100%);
            color: white;
            border-bottom: none;
            padding: 1rem 1.5rem;
        }

        .modal-title {
            font-weight: 600;
        }

        .btn-close-white {
            filter: brightness(0) invert(1);
        }

        .modal-body {
            padding: 1.5rem;
            font-size: 1.1rem;
            color: #333;
        }

        .modal-footer {
            border-top: none;
            padding: 1rem 1.5rem;
            justify-content: flex-end;
        }
    </style>

    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    {{-- JS untuk Bootstrap Datepicker - LOAD AFTER MAIN JS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <script>
        $(document).ready(function() {
            // CSRF Setup
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Inisialisasi Datepicker
            $('.datepicker-input').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true
            });

            // Handle Reset filter
            $('#resetFilter').on('click', function() {
                $('#start_date').val('');
                $('#end_date').val('');
                $('#filterForm').submit();
            });

            // Delete functionality
            let deleteUrl = '';

            // Use event delegation for dynamically added buttons
            $(document).on('click', '.btn-delete', function(e) {
                e.preventDefault();
                deleteUrl = $(this).attr('href');
                
                // Use Bootstrap 5 modal API
                const confirmModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
                confirmModal.show();
            });

            $('#confirmDeleteBtn').on('click', function() {
                const confirmModal = bootstrap.Modal.getInstance(document.getElementById('confirmationModal'));
                confirmModal.hide();

                $.ajax({
                    type: 'DELETE',
                    url: deleteUrl,
                    success: function(data) {
                        window.location.reload(); 
                    },
                    error: function(xhr, status, error) {
                        console.error("Error deleting data:", error);
                        let errorMessage = 'Terjadi kesalahan saat menghapus data.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        $('#errorMessage').text(errorMessage);
                        
                        // Use Bootstrap 5 modal API
                        const errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                        errorModal.show();
                    }
                });
            });
        });
    </script>
@endpush