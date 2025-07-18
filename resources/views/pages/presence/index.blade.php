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

            

        })
    </script>
@endpush