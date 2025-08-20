@extends('layouts.main')

@section('content')
<div class="container my-4">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h4 class="card-title">Daftar Anggota</h4>
                </div>
                <div class="col text-end">
                    <a href="{{ route('pln-members.create') }}" class="btn btn-primary me-2">
                        Tambah Data
                    </a>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#importModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-excel-fill me-1" viewBox="0 0 16 16">
                            <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1M5.884 6.68 8 9.219l2.116-2.54a.5.5 0 1 1 .768.641L8.651 10l2.233 2.68a.5.5 0 0 1-.768.64L8 10.781l-2.116 2.54a.5.5 0 0 1-.768-.641L7.349 10 5.116 7.32a.5.5 0 1 1 .768-.64"/>
                        </svg>
                        Import Data
                    </button>
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

<div class="modal fade" id="importModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Import Sertifikat dari Excel</h5>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">
                    <b>Panduan Import</b>
                    <ul>
                        <li>Download template Excel terlebih dahulu</li>
                        <li>Isi data sesuai format yang disediakan</li>
                        <li>Upload file Excel yang sudah diisi</li>
                    </ul>
                </div>
                
                <div class="mb-3">
                    <a href="{{ route('pln-members.template') }}" class="btn btn-success w-100">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download me-2" viewBox="0 0 16 16">
                            <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
                            <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z"/>
                        </svg>
                        Download Template
                    </a>
                </div>

                <form id="importFormAjax">
                    @csrf
                    <input type="file" name="file" id="fileExcel" accept=".xlsx,.xls" hidden>
                    <div id="drop-area" class="border rounded p-4 text-center" style="cursor: pointer; border: 2px dashed #6c757d !important;">
                        <svg class="text-muted bi bi-upload" xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
                            <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708z"/>
                        </svg>
                        <p id="drop-text" class="mt-3 mb-2">Drag & drop file Excel atau klik untuk browse</p>
                        <p class="small text-muted">Format yang didukung: .xlsx, .xls</p>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" id="btnImport" class="btn btn-success">Import Data</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="successModalLabel">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-check-circle-fill me-2" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </svg>
                    Import Berhasil
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-success" id="success-message">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="errorModalLabel">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill me-2" viewBox="0 0 16 16">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </svg>
                    Gagal Import Data
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Proses import selesai dengan beberapa kegagalan:</p>
                <div class="alert alert-danger" id="error-list">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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

        /* Gaya baru untuk modal error */
        .modal-header.bg-danger {
            background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);
        }

        .modal-header.bg-danger .btn-close-white {
            filter: invert(1);
        }

        .alert-danger {
            background: rgba(220, 38, 38, 0.1);
            border: 1px solid rgba(220, 38, 38, 0.2);
            border-radius: 10px;
            color: #b91c1c;
            padding: 1rem;
        }

        #error-list ul {
            list-style-type: none;
            padding-left: 0;
            margin-bottom: 0;
        }

        #error-list li {
            word-break: break-all;
            margin-bottom: 5px;
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

        /* CSS yang sudah ada, tambahkan penyesuaian untuk modal sukses */
        .modal-header.bg-success {
            background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
        }

        .modal-header.bg-success .btn-close-white {
            filter: invert(1);
        }

        .alert-success {
            background: rgba(40, 167, 69, 0.1);
            border: 1px solid rgba(40, 167, 69, 0.2);
            border-radius: 10px;
            color: #155724;
            padding: 1rem;
        }

        .alert-danger {
            background: rgba(220, 38, 38, 0.1);
            border: 1px solid rgba(220, 38, 38, 0.2);
            border-radius: 10px;
            color: #b91c1c;
            padding: 1rem;
        }

        #error-list ul {
            list-style-type: none;
            padding-left: 0;
            margin-bottom: 0;
        }

        #error-list li {
            word-break: break-all;
            margin-bottom: 5px;
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
        });

        $(document).on('click', '#btnImport', function () {
            let file = $('#fileExcel')[0].files[0];
            if (!file) {
                // Mengganti alert dengan modal
                $('#error-list').html('<h6>Gagal!</h6><p>Pilih file terlebih dahulu.</p>');
                $('#errorModal').modal('show');
                return;
            }

            let formData = new FormData();
            formData.append('file', file);
            formData.append('_token', '{{ csrf_token() }}');

            $.ajax({
                url: "{{ route('pln-members.import-ajax') }}",
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $('#btnImport').prop('disabled', true).text('Mengimport...');
                },
                success: function (res) {
                    $('#importModal').modal('hide');

                    // Menggunakan properti 'success' dari respons controller
                    if (res.success) {
                        // Tampilkan modal berhasil
                        $('#success-message').html(`
                            <h6>Import selesai!</h6>
                            <p>${res.message}</p>
                        `);
                        $('#successModal').modal('show');
                    } else {
                        // Tampilkan modal gagal
                        let errorMessage = `<h6>Import selesai.</h6><p>${res.message}</p><ul></ul>`;
                        let errorList = '';
                        $.each(res.errors, function(index, error) {
                            errorList += '<li>' + error + '</li>';
                        });
                        $('#error-list').html(errorMessage);
                        $('#error-list ul').html(errorList);
                        $('#errorModal').modal('show');
                    }

                    $('#btnImport').prop('disabled', false).text('Import Data');
                    $('#pln-members-table').DataTable().ajax.reload();
                },
                error: function (xhr) {
                    $('#importModal').modal('hide');
                    // Mengganti alert dengan modal
                    $('#error-list').html('<h6>Gagal!</h6><p>' + (xhr.responseJSON?.message || 'Terjadi kesalahan pada server.') + '</p>');
                    $('#errorModal').modal('show');
                    $('#btnImport').prop('disabled', false).text('Import Data');
                }
            });
        });

        // Optional: preview nama file saat dipilih
        $('#drop-area').on('click', function () {
            $('#fileExcel').click();
        });
        $('#fileExcel').on('change', function (e) {
            let fileName = e.target.files[0].name;
            $('#drop-text').text(fileName);
        });
    </script>
@endpush