@extends('layouts.main')

@section('content')
    <div class="container my-4">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <h4 class="card-title">
                            Daftar Kegiatan
                        </h4>
                    </div>
                    <div class="col text-end">
                        <a href="{{ route('presence.create') }}" class="btn btn-primary">
                            Tambah Kegiatan
                        </a>
                    </div>
                </div>
                    
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    {{ $dataTable->table(['class' => 'table table-bordered table-striped table-hover nowrap'], true) }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
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
            padding: 1rem 1.5rem
        }

        .card-title {
            color: white;
            font-weight: 600;
            margin-bottom: 0;
        }

        .card-body {
            padding: 0;
        }

        /* Button Styling */
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

        /* Table Responsive */
        
        /* DataTable Controls */

        /* Action Buttons */
        .btn-sm {
            border-radius: 6px;
            margin: 0 2px;
            transition: all 0.3s ease;
        }

        .btn-warning {
            background: linear-gradient(135deg, #ffd60a, #ffed4a);
            border: none;
            color: #333;
        }

        .btn-warning:hover {
            background: linear-gradient(135deg, #e6c200, #f5d316);
            transform: translateY(-1px);
            color: #333;
        }

        .btn-danger {
            background: linear-gradient(135deg, #dc2626, #ef4444);
            border: none;
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #b91c1c, #dc2626);
            transform: translateY(-1px);
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
    </style>

    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault();
            let url = $(this).attr('href');

            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            $.ajax({
                type: 'DELETE',
                url: url,
                success: function(data) {
                    window.location.reload();
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
            }

            

        })
    </script>
@endpush