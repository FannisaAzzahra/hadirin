@extends('layouts.main')

@section('content')
    <div class="container my-4">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <h4 class="card-title">Detail Absen</h4>
                    </div>
                    <div class="col text-end">
                        <button type="button" id="showBarcodeBtn" class="btn btn-info" data-slug="{{ $presence->slug }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-qr-code-scan" viewBox="0 0 16 16">
                                <path d="M0 .5A.5.5 0 0 1 .5 0h3a.5.5 0 0 1 0 1H1v2.5a.5.5 0 0 1-1 0zm12 0a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0V1h-2.5a.5.5 0 0 1-.5-.5M.5 12a.5.5 0 0 1 .5.5V15h2.5a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5v-3a.5.5 0 0 1 .5-.5m15 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1 0-1H15v-2.5a.5.5 0 0 1 .5-.5M4 4h1v1H4z"/>
                                <path d="M7 2H2v5h5zM3 3v3h3V3zm4 0h1v1H7zM2 8h1v1H2z"/>
                                <path d="M7 9H2v5h5zm-4 1v3h3v-3zm4-1h1v1H7z"/>
                                <path d="M7 4h1v1H7zM6 9h1v1H6z"/>
                                <path d="M9 2h5v5H9zm1 1v3h3V3z"/>
                                <path d="M13 9h-1v1h1z"/>
                                <path d="M9 8h1v1H9zm-1 1H7v1h1zm1 1h1v1H9zm-1 1H7v1h1zm1 1h1v1H9zm1 1h1v1H9zm1 1h1v1h-1zm1-1h1v1h-1zm-1-1h1v1h-1zm-1-1h1v1h-1zm-1-1h1v1h-1z"/>
                                <path d="M13 8h1v1h-1z"/>
                            </svg>
                            Tampilkan Barcode
                        </button>
                        <button type="button" onclick="copyLink('{{ $presence->slug }}')" class="btn btn-warning">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard2-fill" viewBox="0 0 16 16">
                                <path d="M9.5 0a.5.5 0 0 1 .5.5.5.5 0 0 0 .5.5.5.5 0 0 1 .5.5V2a.5.5 0 0 1-.5.5h-5A.5.5 0 0 1 5 2v-.5a.5.5 0 0 1 .5-.5.5.5 0 0 0 .5-.5.5.5 0 0 1 .5-.5z"/>
                                <path d="M3.5 1h.585A1.5 1.5 0 0 0 4 1.5V2a1.5 1.5 0 0 0 1.5 1.5h5A1.5 1.5 0 0 0 12 2v-.5q-.001-.264-.085-.5h.585A1.5 1.5 0 0 1 14 2.5v12a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-12A1.5 1.5 0 0 1 3.5 1"/>
                            </svg>
                            Copy Link
                        </button>
                        <a href="{{ route('presence-detail.export-pdf', $presence->id) }}" target="_blank" class="btn btn-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-pdf-fill" viewBox="0 0 16 16">
                                <path d="M5.523 12.424q.21-.124.459-.238a8 8 0 0 1-.45.606c-.28.337-.498.516-.635.572l-.035.012a.3.3 0 0 1-.026-.044c-.056-.11-.054-.216.04-.36.106-.165.319-.354.647-.548m2.455-1.647q-.178.037-.356.078a21 21 0 0 0 .5-1.05 12 12 0 0 0 .51.858q-.326.048-.654.114m2.525.939a4 4 0 0 1-.435-.41q.344.007.612.054c.317.057.466.147.518.209a.1.1 0 0 1 .026.064.44.44 0 0 1-.06.2.3.3 0 0 1-.094.124.1.1 0 0 1-.069.015c-.09-.003-.258-.066-.498-.256M8.278 6.97c-.04.244-.108.524-.2.829a5 5 0 0 1-.089-.346c-.076-.353-.087-.63-.046-.822.038-.177.11-.248.196-.283a.5.5 0 0 1 .145-.04c.013.03.028.092.032.198q.008.183-.038.465z"/>
                                <path fill-rule="evenodd" d="M4 0h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2m5.5 1.5v2a1 1 0 0 0 1 1h2zM4.165 13.668c.09.18.23.343.438.419.207.075.412.04.58-.03.318-.13.635-.436.926-.786.333-.401.683-.927 1.021-1.51a11.7 11.7 0 0 1 1.997-.406c.3.383.61.713.91.95.28.22.603.403.934.417a.86.86 0 0 0 .51-.138c.155-.101.27-.247.354-.416.09-.181.145-.37.138-.563a.84.84 0 0 0-.2-.518c-.226-.27-.596-.4-.96-.465a5.8 5.8 0 0 0-1.335-.05 11 11 0 0 1-.98-1.686c.25-.66.437-1.284.52-1.794.036-.218.055-.426.048-.614a1.24 1.24 0 0 0-.127-.538.7.7 0 0 0-.477-.365c-.202-.043-.41 0-.601.077-.377.15-.576.47-.651.823-.073.34-.04.736.046 1.136.088.406.238.848.43 1.295a20 20 0 0 1-1.062 2.227 7.7 7.7 0 0 0-1.482.645c-.37.22-.699.48-.897.787-.21.326-.275.714-.08 1.103"/>
                            </svg>
                            Export to PDF
                        </a>
                        <a href="{{ route('presence-detail.export-excel', $presence->id) }}" class="btn btn-success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-excel-fill" viewBox="0 0 16 16">
                                <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1M5.884 6.68 8 9.219l2.116-2.54a.5.5 0 1 1 .768.641L8.651 10l2.233 2.68a.5.5 0 0 1-.768.64L8 10.781l-2.116 2.54a.5.5 0 0 1-.768-.641L7.349 10 5.116 7.32a.5.5 0 1 1 .768-.64"/>
                            </svg>
                            Export to Excel
                        </a>
                        <a href="{{ route('presence.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="detail-section">
                    <table class="table table-borderless detail-table">
                        <tr>
                            <td width="150">Nama Kegiatan</td>
                            <td width="20">:</td>
                            <td>{{ $presence->nama_kegiatan }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Kegiatan</td>
                            <td>:</td>
                            @php
                                \Carbon\Carbon::setLocale('id');
                                $tanggalKegiatan = \Carbon\Carbon::parse($presence->tgl_kegiatan)->translatedFormat('d F Y');
                            @endphp
                        <td>{{ $tanggalKegiatan }}</td>
                        </tr>
                        <tr>
                            <td>Waktu Mulai</td>
                            <td>:</td>
                            @php
                                $waktuMulai = \Carbon\Carbon::parse($presence->tgl_kegiatan)->translatedFormat('H:i');
                            @endphp
                            <td>{{ $waktuMulai }} WIB</td>
                        </tr>
                        <tr>
                            <td>Lokasi</td>
                            <td>:</td>
                            <td>{{ $presence->lokasi }}</td>
                        </tr>
                        <tr>
                            <td>Link Lokasi</td>
                            <td>:</td>
                            <td>
                                @if ($presence->link_lokasi)
                                    <a href="{{ $presence->link_lokasi }}" target="_blank" class="location-link">Klik di sini</a>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Batas Waktu</td>
                            <td>:</td>
                            <td>
                                @if ($presence->batas_waktu)
                                    @php
                                        \Carbon\Carbon::setLocale('id');
                                        $batasWaktuFormatted = \Carbon\Carbon::parse($presence->batas_waktu)->translatedFormat('d F Y H:i');
                                    @endphp
                                    {{ $batasWaktuFormatted }} WIB
                                @else
                                    Tidak Ada Batas Waktu
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="table-responsive">
                    {{ $dataTable->table(['class' => 'table table-bordered table-striped table-hover nowrap'], true) }}
                </div>
            </div>
        </div>
    </div>

    {{-- Custom Modal for Copy Link Confirmation --}}
    <div class="modal fade" id="copySuccessModal" tabindex="-1" aria-labelledby="copySuccessModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content pln-modal-content">
                <div class="modal-header pln-modal-header-success">
                    <h5 class="modal-title" id="copySuccessModalLabel">Link Berhasil Disalin!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pln-modal-body text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="#28a745" class="bi bi-check-circle-fill mb-3" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </svg>
                    <p class="mb-1">Link presensi kegiatan telah berhasil disalin ke clipboard Anda.</p>
                    <p class="text-muted small">Anda bisa membagikannya sekarang.</p>
                </div>
                <div class="modal-footer pln-modal-footer d-flex justify-content-end">
                    <button type="button" class="btn pln-btn-secondary-modal" data-bs-dismiss="modal">Oke</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Barcode Modal --}}
    <div class="modal fade" id="barcodeModal" tabindex="-1" aria-labelledby="barcodeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="barcodeModalLabel">Scan QR Code Presensi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <div id="qrcode-container" class="mb-3">
                        {{-- QR Code will be injected here --}}
                    </div>
                    <a href="#" id="downloadBarcodeBtn" class="btn btn-primary" download="qrcode.svg">Download QR Code</a>
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
            padding: 1rem 1.5rem;
        }

        .card-title {
            color: white;
            font-weight: 600;
            margin-bottom: 0;
        }

        .card-body {
            padding: 1.5rem;
        }

        /* Detail Section Styling */
        .detail-table td:first-child {
            font-weight: 600;
            color: #0077b6;
        }

        /* Location Link Styling */
        .location-link {
            color: #0077b6;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
        }

        .location-link:hover {
            color: #00b4d8;
            transform: translateX(3px);
        }

        .location-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(135deg, #ffd60a, #ffed4a);
            transition: width 0.3s ease;
        }

        .location-link:hover::after {
            width: 100%;
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

        /* Filter Styling */
        .bg-light {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%) !important;
        }

        /* Custom Modal CSS for Copy Link */
        .pln-modal-content {
            border-radius: 1rem;
            border: none;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .pln-modal-header-success {
            background-color: #28a745;
            color: white;
            border-bottom: none;
            padding: 1rem 1.5rem;
            position: relative;
        }
        .pln-modal-header-success .btn-close {
            color: white;
            opacity: 1;
            filter: invert(1) grayscale(100%) brightness(200%);
        }
        .pln-modal-body {
            padding: 2rem;
            text-align: center;
        }
        .pln-modal-body p {
            margin-bottom: 0.5rem;
        }
        .pln-modal-body .text-muted {
            font-size: 0.875rem;
        }
        .pln-modal-footer {
            border-top: none;
            padding: 1rem 2rem;
        }
        .pln-btn-secondary-modal {
            border-radius: 0.5rem;
            border: 2px solid #007bff;
            color: #007bff;
            background-color: transparent;
            font-weight: 600;
            padding: 0.5rem 2rem;
            transition: all 0.3s ease;
        }
        .pln-btn-secondary-modal:hover {
            background-color: #007bff;
            color: white;
        }

        /* Filter section styling */
        .filter-section .card {
            box-shadow: 0 2px 10px rgba(0, 119, 182, 0.05);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .card-header .col {
                margin-bottom: 0.5rem;
            }
            
            .btn {
                padding: 0.5rem 1rem;
                margin: 0.25rem;
                font-size: 0.875rem;
            }
            
            .detail-section {
                padding: 1rem;
            }
        }
    </style>

    <script>
        // Function to copy link
        function copyLink(presenceSlug) {
            const linkToCopy = `{{ url('/absen') }}/${presenceSlug}`;
            
            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(linkToCopy).then(() => {
                    var copySuccessModal = new bootstrap.Modal(document.getElementById('copySuccessModal'));
                    copySuccessModal.show();
                }).catch(err => {
                    console.error('Failed to copy text using Clipboard API: ', err);
                    fallbackCopyTextToClipboard(linkToCopy);
                });
            } else {
                fallbackCopyTextToClipboard(linkToCopy);
            }
        }


        // Handle barcode modal
        document.getElementById('showBarcodeBtn').addEventListener('click', function() {
            const slug = this.getAttribute('data-slug');
            const barcodeUrl = `{{ url('presence/barcode') }}/${slug}`;
            const qrCodeContainer = document.getElementById('qrcode-container');
            const downloadBtn = document.getElementById('downloadBarcodeBtn');

            // Clear previous QR code
            qrCodeContainer.innerHTML = '';

            // Create image element
            const img = document.createElement('img');
            img.src = barcodeUrl;
            img.style.maxWidth = '100%';
            qrCodeContainer.appendChild(img);

            // Set download button attributes
            downloadBtn.href = barcodeUrl;
            downloadBtn.download = `qrcode-${slug}.svg`;

            // Show the modal
            var barcodeModal = new bootstrap.Modal(document.getElementById('barcodeModal'));
            barcodeModal.show();
        });

        function fallbackCopyTextToClipboard(text) {
            const tempInput = document.createElement('input');
            document.body.appendChild(tempInput);
            tempInput.value = text;
            tempInput.select();
            document.execCommand('copy');
            document.body.removeChild(tempInput);
            var copySuccessModal = new bootstrap.Modal(document.getElementById('copySuccessModal'));
            copySuccessModal.show();
        }

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        // Handle delete button
        $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault();
            let url = $(this).attr('href');

            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                $.ajax({
                    type: 'DELETE',
                    url: url,
                    success: function(data) {
                        console.log('Delete successful:', data);
                        
                        // Reload DataTable
                        if (window.LaravelDataTables && window.LaravelDataTables['presencedetails-table']) {
                            window.LaravelDataTables['presencedetails-table'].draw(false);
                        } else if ($.fn.DataTable.isDataTable('#presencedetails-table')) {
                            $('#presencedetails-table').DataTable().draw(false);
                        } else {
                            window.location.reload();
                        }
                        
                        // Show success message
                        if (data.message) {
                            alert(data.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Delete error:', error);
                        alert('Terjadi kesalahan saat menghapus data');
                    }
                });
            }      
        });
    </script>

    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush