@extends('layouts.main')

@section('content')
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card"> {{-- Menghilangkan shadow-sm --}}
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">Data User</h4> {{-- Mengubah h5 menjadi h4 --}}
                        </div>
                        <div class="col text-end">
                            <a href="{{ route('users.create') }}" class="btn btn-primary me-2">
                                Tambah User Baru
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        {{-- Menambahkan kelas nowrap dan border --}}
                        {{ $dataTable->table(['class' => 'table table-bordered table-striped table-hover nowrap'], true) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <style>
        /* Page Background */
        body {
            background-color: #f0f8ff;
        }
        
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

        .btn-success {
            background: linear-gradient(135deg, #1e7e34 0%, #28a745 100%);
            border: none;
            color: white;
            font-weight: 600;
            border-radius: 10px;
            padding: 0.75rem 1.5rem;
            transition: all 0.3s ease;
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #155724 0%, #1e7e34 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(30, 126, 52, 0.3);
            color: white;
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

        /* Modal Styling */
        .modal-content {
            border-radius: 15px;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 119, 182, 0.15);
        }

        .modal-header {
            background: linear-gradient(135deg, #0077b6 0%, #00b4d8 100%);
            color: white;
            border-radius: 15px 15px 0 0;
            border-bottom: none;
        }

        .modal-title {
            font-weight: 600;
        }

        .modal-body {
            padding: 1.5rem;
        }

        .modal-footer {
            border-top: 1px solid rgba(0, 119, 182, 0.1);
            padding: 1rem 1.5rem;
        }

        /* Alert Styling */
        .alert-info {
            background: linear-gradient(135deg, rgba(0, 180, 216, 0.1) 0%, rgba(255, 214, 10, 0.1) 100%);
            border: 1px solid rgba(0, 119, 182, 0.2);
            border-radius: 10px;
            color: #0077b6;
        }

        /* Drop Area Styling */
        #drop-area {
            border: 2px dashed #0077b6 !important;
            border-radius: 10px;
            background: rgba(0, 119, 182, 0.02);
            transition: all 0.3s ease;
        }

        #drop-area:hover {
            border-color: #00b4d8 !important;
            background: rgba(0, 180, 216, 0.05);
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

        // The original PLN Member import JS is also included here,
        // but it will only be active if you implement the import functionality
        // for users and route it correctly. For now, it won't affect the user table.
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
        });

        // The following script block for import functionality is specific to pln-members.
        // If you intend to have import for users, you'll need to adapt it and
        // ensure corresponding routes and controller methods exist for users.
        $(document).on('click', '#btnImport', function () {
            let file = $('#fileExcel')[0].files[0];
            if (!file) {
                alert('Pilih file terlebih dahulu!');
                return;
            }

            let formData = new FormData();
            formData.append('file', file);
            formData.append('_token', '{{ csrf_token() }}');

            $.ajax({
                url: "{{ route('pln-members.import-ajax') }}", // <<< This route is for PLN members import
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $('#btnImport').prop('disabled', true).text('Mengimport...');
                },
                success: function (res) {
                    let message = res.message;
                    if (res.errors && res.errors.length > 0) {
                        message += `\n\nDetail Error:\n` + res.errors.join('\n');
                    }
                    alert(message);
                    $('#importModal').modal('hide');
                    $('#btnImport').prop('disabled', false).text('Import Data');
                    $('#pln-members-table').DataTable().ajax.reload(); // <<< This reloads PLN members table
                },
                error: function (xhr) {
                    alert('Gagal import: ' + (xhr.responseJSON?.message || 'Terjadi kesalahan'));
                    $('#btnImport').prop('disabled', false).text('Import Data');
                }
            });
        });

        $('#drop-area').on('click', function () {
            $('#fileExcel').click();
        });
        $('#fileExcel').on('change', function (e) {
            let fileName = e.target.files[0].name;
            $('#drop-text').text(fileName);
        });
    </script>
@endpush