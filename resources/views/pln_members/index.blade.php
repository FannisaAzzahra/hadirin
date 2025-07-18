@extends('layouts.main')

@section('content')
<div class="container my-4">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h4 class="card-title">Daftar Anggota PLN</h4>
                </div>
                <div class="col text-end">
                    <!-- Tombol Tambah Data -->
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

<!-- Modal Import -->
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
                
                <!-- Tombol Download Template -->
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
                        <!-- Ikon upload -->
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
                <button type="button" id="btnImport" class="btn btn-primary">Import Data</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')

    <style>
        .table-responsive {
            overflow-x: auto;
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
        });

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
                url: "{{ route('pln-members.import-ajax') }}",
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
                    $('#pln-members-table').DataTable().ajax.reload();
                },
                error: function (xhr) {
                    alert('Gagal import: ' + (xhr.responseJSON?.message || 'Terjadi kesalahan'));
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
