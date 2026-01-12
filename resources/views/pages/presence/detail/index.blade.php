@extends('layouts.main')

@section('content')
    <div class="container my-4">
        <div class="hadirin-main-card">
            <div class="hadirin-main-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h4 class="hadirin-main-title">
                            <i class="fas fa-list-check me-2"></i>
                            Detail Absen
                        </h4>
                        <p class="hadirin-main-subtitle">Kelola dan pantau data presensi kegiatan</p>
                    </div>
                    <div class="col text-end">
                        <div class="hadirin-action-buttons">
                            <button type="button" id="showBarcodeBtn" class="hadirin-btn hadirin-btn-info" data-slug="{{ $presence->slug }}">
                                <i class="fas fa-qrcode me-1"></i>
                                Tampilkan Barcode
                            </button>
                            <button type="button" onclick="copyLink('{{ $presence->slug }}')" class="hadirin-btn hadirin-btn-warning">
                                <i class="fas fa-link me-1"></i>
                                Copy Link
                            </button>
                            <a href="{{ route('presence-detail.export-pdf', $presence->id) }}" target="_blank" class="hadirin-btn hadirin-btn-danger">
                                <i class="fas fa-file-pdf me-1"></i>
                                Export PDF
                            </a>
                            <a href="{{ route('presence-detail.export-excel', $presence->id) }}" class="hadirin-btn hadirin-btn-success">
                                <i class="fas fa-file-excel me-1"></i>
                                Export Excel
                            </a>
                            <a href="{{ route('presence-detail.export-word', $presence->id) }}" class="hadirin-btn hadirin-btn-primary">
                                <i class="fas fa-file-word me-1"></i>
                                Export Word
                            </a>
                            <a href="{{ route('presence.index') }}" class="hadirin-btn hadirin-btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i>
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hadirin-main-body">
                <div class="hadirin-detail-section">
                    <div class="hadirin-section-header mb-4">
                        <div class="hadirin-section-icon">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <h5 class="hadirin-section-title">Informasi Kegiatan</h5>
                    </div>
                    
                    <div class="hadirin-detail-grid">
                        <div class="hadirin-detail-item">
                            <div class="hadirin-detail-icon">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                            <div class="hadirin-detail-content">
                                <label>Nama Kegiatan</label>
                                <span>{{ $presence->nama_kegiatan }}</span>
                            </div>
                        </div>
                        
                        <div class="hadirin-detail-item">
                            <div class="hadirin-detail-icon">
                                <i class="fas fa-calendar"></i>
                            </div>
                            <div class="hadirin-detail-content">
                                <label>Tanggal Kegiatan</label>
                                @php
                                    \Carbon\Carbon::setLocale('id');
                                    $tanggalKegiatan = \Carbon\Carbon::parse($presence->tgl_kegiatan)->translatedFormat('d F Y');
                                @endphp
                                <span>{{ $tanggalKegiatan }}</span>
                            </div>
                        </div>
                        
                        <div class="hadirin-detail-item">
                            <div class="hadirin-detail-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="hadirin-detail-content">
                                <label>Waktu Mulai</label>
                                @php
                                    $waktuMulai = \Carbon\Carbon::parse($presence->tgl_kegiatan)->translatedFormat('H:i');
                                @endphp
                                <span>{{ $waktuMulai }} WIB</span>
                            </div>
                        </div>
                        
                        <div class="hadirin-detail-item">
                            <div class="hadirin-detail-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="hadirin-detail-content">
                                <label>Lokasi</label>
                                <span>{{ $presence->lokasi }}</span>
                            </div>
                        </div>
                        
                        <div class="hadirin-detail-item">
                            <div class="hadirin-detail-icon">
                                <i class="fas fa-external-link-alt"></i>
                            </div>
                            <div class="hadirin-detail-content">
                                <label>Link Zoom</label>
                                <span>
                                    @if ($presence->link_lokasi)
                                        <a href="{{ $presence->link_lokasi }}" target="_blank" class="hadirin-location-link">Klik di sini</a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </span>
                            </div>
                        </div>
                        
                        <div class="hadirin-detail-item">
                            <div class="hadirin-detail-icon">
                                <i class="fas fa-hourglass-end"></i>
                            </div>
                            <div class="hadirin-detail-content">
                                <label>Batas Waktu</label>
                                <span>
                                    @if ($presence->batas_waktu)
                                        @php
                                            \Carbon\Carbon::setLocale('id');
                                            $batasWaktuFormatted = \Carbon\Carbon::parse($presence->batas_waktu)->translatedFormat('d F Y H:i');
                                        @endphp
                                        {{ $batasWaktuFormatted }} WIB
                                    @else
                                        <span class="text-muted">Tidak Ada Batas Waktu</span>
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="hadirin-table-section">
                    <div class="hadirin-section-header mb-4">
                        <div class="hadirin-section-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h5 class="hadirin-section-title">Data Presensi</h5>
                    </div>
                    
                    <div class="table-responsive">
                        {{ $dataTable->table(['class' => 'table hadirin-table nowrap'], true) }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Hadirin Style Copy Link Success Modal --}}
    <div class="modal fade" id="copySuccessModal" tabindex="-1" aria-labelledby="copySuccessModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content hadirin-modal-content">
                <div class="modal-header hadirin-modal-header-success">
                    <h5 class="modal-title hadirin-modal-title" id="copySuccessModalLabel">
                        <i class="fas fa-check-circle me-2"></i>
                        Link Berhasil Disalin!
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body hadirin-modal-body text-center">
                    <div class="hadirin-success-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <p class="hadirin-modal-text mb-2">Link presensi kegiatan telah berhasil disalin ke clipboard Anda.</p>
                    <p class="hadirin-modal-subtext">Anda bisa membagikannya sekarang.</p>
                </div>
                <div class="modal-footer hadirin-modal-footer">
                    <button type="button" class="hadirin-btn hadirin-btn-primary" data-bs-dismiss="modal">
                        <i class="fas fa-thumbs-up me-1"></i>
                        Oke, Siap!
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Enhanced Hadirin Style Barcode Modal --}}
    <div class="modal fade" id="barcodeModal" tabindex="-1" aria-labelledby="barcodeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content hadirin-barcode-modal">
                <div class="modal-header hadirin-barcode-header">
                    <div class="hadirin-barcode-header-content">
                        <div class="hadirin-barcode-header-icon">
                            <i class="fas fa-qrcode"></i>
                        </div>
                        <div class="hadirin-barcode-header-text">
                            <h5 class="modal-title hadirin-barcode-title" id="barcodeModalLabel">
                                QR Code Presensi Kegiatan
                            </h5>
                            <p class="hadirin-barcode-subtitle">Sistem Presensi Digital Hadirin</p>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body hadirin-barcode-body">
                    <div class="row g-4">
                        <!-- Event Details Section -->
                        <div class="col-lg-7">
                            <div class="hadirin-event-card">
                                <div class="hadirin-event-header">
                                    <div class="hadirin-event-icon">
                                        <i class="fas fa-calendar-check"></i>
                                    </div>
                                    <div class="hadirin-event-title">
                                        <h4 id="eventName" class="mb-1">-</h4>
                                        <p class="hadirin-event-subtitle mb-0">Detail Kegiatan Presensi</p>
                                    </div>
                                </div>
                                
                                <div class="hadirin-event-grid">
                                    <div class="hadirin-info-item">
                                        <div class="hadirin-info-icon">
                                            <i class="fas fa-calendar"></i>
                                        </div>
                                        <div class="hadirin-info-content">
                                            <label>Tanggal Kegiatan</label>
                                            <span id="eventDate">-</span>
                                        </div>
                                    </div>
                                    
                                    <div class="hadirin-info-item">
                                        <div class="hadirin-info-icon">
                                            <i class="fas fa-clock"></i>
                                        </div>
                                        <div class="hadirin-info-content">
                                            <label>Waktu Mulai</label>
                                            <span id="eventTime">-</span>
                                        </div>
                                    </div>
                                    
                                    <div class="hadirin-info-item">
                                        <div class="hadirin-info-icon">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                        <div class="hadirin-info-content">
                                            <label>Lokasi</label>
                                            <span id="eventLocation">-</span>
                                        </div>
                                    </div>
                                    
                                    <div class="hadirin-info-item">
                                        <div class="hadirin-info-icon">
                                            <i class="fas fa-hourglass-end"></i>
                                        </div>
                                        <div class="hadirin-info-content">
                                            <label>Batas Waktu</label>
                                            <span id="eventDeadline">-</span>
                                        </div>
                                    </div>
                                    
                                    <div class="hadirin-info-item hadirin-info-full">
                                        <div class="hadirin-info-icon">
                                            <i class="fas fa-link"></i>
                                        </div>
                                        <div class="hadirin-info-content">
                                            <label>Link Presensi</label>
                                            <div class="hadirin-link-container">
                                                <input type="text" id="attendanceLink" class="hadirin-link-input" readonly>
                                                <button type="button" class="hadirin-btn hadirin-btn-primary hadirin-btn-sm" onclick="copyAttendanceLink()">
                                                    <i class="fas fa-copy"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- QR Code Section -->
                        <div class="col-lg-5">
                            <div class="hadirin-qr-section">
                                <div class="hadirin-qr-header">
                                    <h5 class="hadirin-qr-title">
                                        <i class="fas fa-mobile-alt me-2"></i>
                                        Scan untuk Presensi
                                    </h5>
                                    <p class="hadirin-qr-instruction">
                                        Arahkan kamera smartphone ke QR Code di bawah ini untuk melakukan presensi
                                    </p>
                                </div>
                                
                                <div class="hadirin-qr-container">
                                    <div class="hadirin-qr-frame">
                                        <div id="qrcode-container" class="hadirin-qr-wrapper">
                                            <div class="hadirin-qr-loading">
                                                <div class="hadirin-spinner">
                                                    <div class="hadirin-spinner-ring"></div>
                                                </div>
                                                <p class="mt-3">Memuat QR Code...</p>
                                            </div>
                                        </div>
                                        <div class="hadirin-qr-corners">
                                            <div class="hadirin-corner hadirin-corner-tl"></div>
                                            <div class="hadirin-corner hadirin-corner-tr"></div>
                                            <div class="hadirin-corner hadirin-corner-bl"></div>
                                            <div class="hadirin-corner hadirin-corner-br"></div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="hadirin-qr-actions">
                                    <button type="button" id="downloadQRBtn" class="hadirin-btn hadirin-btn-success">
                                        <i class="fas fa-download me-2"></i>
                                        Download QR Code
                                    </button>
                                    <button type="button" id="downloadEventCardBtn" class="hadirin-btn hadirin-btn-primary">
                                        <i class="fas fa-file-image me-2"></i>
                                        Download Event Card
                                    </button>
                                </div>
                            </div>
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
        /* Hadirin Main Card Styles */
        .hadirin-main-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 15px 45px rgba(0, 116, 182, 0.2);
            backdrop-filter: blur(15px);
            background: rgba(255, 255, 255, 0.95);
            overflow: hidden;
            animation: slideInUp 0.8s ease-out forwards;
            border: 1px solid rgba(0, 180, 216, 0.1);
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hadirin-main-card:hover {
            box-shadow: 0 20px 55px rgba(0, 116, 182, 0.25);
            transform: translateY(-2px);
        }

        .hadirin-main-header {
            background: linear-gradient(135deg, #0077b6 0%, #00b4d8 100%);
            color: white;
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }

        .hadirin-main-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 214, 10, 0.15), transparent);
            transform: rotate(-45deg);
            animation: headerShimmer 4s infinite;
        }

        @keyframes headerShimmer {
            0% { transform: translateX(-100%) translateY(-100%) rotate(-45deg); }
            100% { transform: translateX(100%) translateY(100%) rotate(-45deg); }
        }

        .hadirin-main-title {
            color: white;
            font-weight: 700;
            font-size: 1.8rem;
            margin: 0;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            position: relative;
            z-index: 1;
        }

        .hadirin-main-subtitle {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1rem;
            margin: 0.5rem 0 0 0;
            font-weight: 400;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 1;
        }

        .hadirin-main-body {
            padding: 2.5rem;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(248, 249, 255, 0.98) 100%);
        }

        /* Action Buttons */
        .hadirin-action-buttons {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
            justify-content: flex-end;
            position: relative;
            z-index: 1;
        }

        .hadirin-btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 12px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            text-decoration: none;
            font-family: inherit;
            position: relative;
            overflow: hidden;
        }

        .hadirin-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.6s ease;
        }

        .hadirin-btn:hover::before {
            left: 100%;
        }

        .hadirin-btn:hover {
            transform: translateY(-2px);
        }

        .hadirin-btn-info {
            background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
            color: white;
            box-shadow: 0 6px 20px rgba(23, 162, 184, 0.3);
        }

        .hadirin-btn-warning {
            background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);
            color: #212529;
            box-shadow: 0 6px 20px rgba(255, 193, 7, 0.3);
        }

        .hadirin-btn-danger {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: white;
            box-shadow: 0 6px 20px rgba(220, 53, 69, 0.3);
        }

        .hadirin-btn-success {
            background: linear-gradient(135deg, #28a745 0%, #218838 100%);
            color: white;
            box-shadow: 0 6px 20px rgba(40, 167, 69, 0.3);
        }

        .hadirin-btn-secondary {
            background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%);
            color: white;
            box-shadow: 0 6px 20px rgba(108, 117, 125, 0.3);
        }

        .hadirin-btn-primary {
            background: linear-gradient(135deg, #00b4d8 0%, #0077b6 100%);
            color: white;
            box-shadow: 0 6px 20px rgba(0, 180, 216, 0.3);
        }

        .hadirin-btn:hover {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        /* Section Headers */
        .hadirin-section-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
            padding-bottom: 0.8rem;
            border-bottom: 2px solid rgba(0, 180, 216, 0.1);
        }

        .hadirin-section-icon {
            width: 42px;
            height: 42px;
            background: linear-gradient(135deg, #00b4d8, #0077b6);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
            box-shadow: 0 4px 10px rgba(0, 116, 182, 0.2);
        }

        .hadirin-section-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: #0077b6;
            margin: 0;
        }

        /* Detail Grid */
        .hadirin-detail-section {
            margin-bottom: 3rem;
        }

        .hadirin-detail-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .hadirin-detail-item {
            display: flex;
            align-items: flex-start;
            padding: 1.5rem;
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 116, 182, 0.08);
            border: 1px solid rgba(0, 180, 216, 0.1);
            transition: all 0.3s ease;
        }

        .hadirin-detail-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 116, 182, 0.15);
        }

        .hadirin-detail-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            font-size: 1rem;
            color: white;
            flex-shrink: 0;
        }

        .hadirin-detail-content {
            flex: 1;
        }

        .hadirin-detail-content label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: #718096;
            margin-bottom: 0.25rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .hadirin-detail-content span {
            display: block;
            font-size: 1rem;
            font-weight: 500;
            color: #2d3748;
            line-height: 1.4;
        }

        .hadirin-location-link {
            color: #00b4d8;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
        }

        .hadirin-location-link:hover {
            color: #0077b6;
            transform: translateX(3px);
        }

        .hadirin-location-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(135deg, #ffd60a, #ffed4a);
            transition: width 0.3s ease;
        }

        .hadirin-location-link:hover::after {
            width: 100%;
        }

        /* Table Section */
        .hadirin-table-section {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 4px 15px rgba(0, 116, 182, 0.08);
            border: 1px solid rgba(0, 180, 216, 0.1);
        }

        .hadirin-table {
            margin-bottom: 0;
        }

        .hadirin-table thead th {
            background: linear-gradient(135deg, #0077b6 0%, #188ecd 100%);
            color: white;
            border: none;
            font-weight: 600;
            text-align: center;
            vertical-align: middle;
            padding: 1rem;
        }

        .hadirin-table tbody td {
            padding: 0.8rem;
            vertical-align: middle;
            border-color: rgba(0, 180, 216, 0.1);
        }

        /* Copy Success Modal */
        .hadirin-modal-content {
            border-radius: 20px;
            border: none;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }

        .hadirin-modal-header-success {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            border-bottom: none;
            padding: 1.5rem 2rem;
            position: relative;
        }

        .hadirin-modal-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin: 0;
        }

        .hadirin-modal-body {
            padding: 2.5rem;
            text-align: center;
            background: linear-gradient(135deg, #f8f9fd 0%, #f1f3f8 100%);
        }

        .hadirin-success-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            color: white;
            animation: successPulse 1s ease-out;
        }

        @keyframes successPulse {
            0% {
                transform: scale(0);
                opacity: 0;
            }
            50% {
                transform: scale(1.1);
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .hadirin-modal-text {
            font-size: 1.1rem;
            font-weight: 500;
            color: #2d3748;
            margin-bottom: 0.5rem;
        }

        .hadirin-modal-subtext {
            color: #718096;
            font-size: 0.95rem;
        }

        .hadirin-modal-footer {
            border-top: none;
            padding: 1rem 2rem 2rem;
            background: linear-gradient(135deg, #f8f9fd 0%, #f1f3f8 100%);
            text-align: center;
        }

        /* Barcode Modal */
        .hadirin-barcode-modal {
            border: none;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }

        .hadirin-barcode-header {
            background: linear-gradient(135deg, #00b4d8 0%, #0077b6 100%);
            color: white;
            border-bottom: none;
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }

        .hadirin-barcode-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 214, 10, 0.15), transparent);
            transform: rotate(-45deg);
            animation: headerShimmer 4s infinite;
        }

        .hadirin-barcode-header-content {
            display: flex;
            align-items: center;
            position: relative;
            z-index: 1;
        }

        .hadirin-barcode-header-icon {
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1.5rem;
            font-size: 1.8rem;
            color: white;
            backdrop-filter: blur(10px);
        }

        .hadirin-barcode-title {
            font-size: 1.6rem;
            font-weight: 700;
            margin: 0;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .hadirin-barcode-subtitle {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1rem;
            margin: 0.5rem 0 0 0;
            font-weight: 400;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .hadirin-barcode-body {
            padding: 2.5rem;
            background: linear-gradient(135deg, #f8f9fd 0%, #f1f3f8 100%);
        }

        /* Event Card */
        .hadirin-event-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 15px 45px rgba(0, 116, 182, 0.15);
            height: 100%;
            border: 1px solid rgba(0, 180, 216, 0.1);
            position: relative;
            overflow: hidden;
        }

        .hadirin-event-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, #00b4d8 0%, #0077b6 100%);
        }

        .hadirin-event-header {
            display: flex;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 2px solid rgba(0, 180, 216, 0.1);
        }

        .hadirin-event-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #00b4d8, #0077b6);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1.5rem;
            font-size: 1.8rem;
            color: white;
            box-shadow: 0 6px 20px rgba(0, 180, 216, 0.3);
        }

        .hadirin-event-title h4 {
            color: #0077b6;
            font-weight: 700;
            margin-bottom: 0;
            font-size: 1.5rem;
        }

        .hadirin-event-subtitle {
            color: #718096;
            font-size: 0.95rem;
            font-weight: 500;
        }

        .hadirin-event-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }

        .hadirin-info-item {
            display: flex;
            align-items: flex-start;
            padding: 1.2rem;
            background: rgba(0, 180, 216, 0.02);
            border-radius: 12px;
            border: 1px solid rgba(0, 180, 216, 0.08);
            transition: all 0.3s ease;
        }

        .hadirin-info-item:hover {
            background: rgba(0, 180, 216, 0.05);
            transform: translateY(-1px);
        }

        .hadirin-info-full {
            grid-column: 1 / -1;
        }

        .hadirin-info-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            font-size: 1rem;
            color: white;
            flex-shrink: 0;
            box-shadow: 0 4px 10px rgba(79, 172, 254, 0.3);
        }

        .hadirin-info-content {
            flex: 1;
        }

        .hadirin-info-content label {
            display: block;
            font-size: 0.8rem;
            font-weight: 600;
            color: #718096;
            margin-bottom: 0.25rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .hadirin-info-content span {
            display: block;
            font-size: 1rem;
            font-weight: 600;
            color: #2d3748;
            line-height: 1.4;
        }

        .hadirin-link-container {
            display: flex;
            gap: 0.5rem;
            margin-top: 0.5rem;
        }

        .hadirin-link-input {
            flex: 1;
            padding: 0.6rem 1rem;
            border: 2px solid rgba(0, 180, 216, 0.2);
            border-radius: 8px;
            font-size: 0.85rem;
            background: rgba(255, 255, 255, 0.8);
            color: #2d3748;
            font-weight: 500;
        }

        .hadirin-btn-sm {
            padding: 0.6rem 1rem;
            font-size: 0.85rem;
        }

        /* QR Section */
        .hadirin-qr-section {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 15px 45px rgba(0, 116, 182, 0.15);
            text-align: center;
            height: 100%;
            border: 1px solid rgba(0, 180, 216, 0.1);
            position: relative;
            overflow: hidden;
        }

        .hadirin-qr-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, #00b4d8 0%, #0077b6 100%);
        }

        .hadirin-qr-header {
            margin-bottom: 2rem;
        }

        .hadirin-qr-title {
            color: #0077b6;
            font-weight: 700;
            font-size: 1.3rem;
            margin-bottom: 1rem;
        }

        .hadirin-qr-instruction {
            color: #718096;
            font-size: 0.95rem;
            line-height: 1.6;
            font-weight: 500;
        }

        .hadirin-qr-container {
            margin: 2rem 0;
        }

        .hadirin-qr-frame {
            position: relative;
            display: inline-block;
            padding: 25px;
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fd 100%);
            border-radius: 25px;
            box-shadow: 0 15px 40px rgba(0, 116, 182, 0.15);
            border: 2px solid rgba(0, 180, 216, 0.1);
        }

        .hadirin-qr-wrapper {
            width: 280px;
            height: 280px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 15px;
            overflow: hidden;
            background: white;
            border: 1px solid rgba(0, 180, 216, 0.1);
        }

        .hadirin-qr-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .hadirin-qr-loading {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            color: #718096;
        }

        .hadirin-spinner {
            position: relative;
            width: 50px;
            height: 50px;
        }

        .hadirin-spinner-ring {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 4px solid rgba(0, 180, 216, 0.2);
            border-top: 4px solid #00b4d8;
            border-radius: 50%;
            animation: hadirin-spin 1s linear infinite;
        }

        @keyframes hadirin-spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .hadirin-qr-corners {
            position: absolute;
            top: 15px;
            left: 15px;
            right: 15px;
            bottom: 15px;
            pointer-events: none;
        }

        .hadirin-corner {
            position: absolute;
            width: 35px;
            height: 35px;
            border: 4px solid #00b4d8;
            opacity: 0.8;
        }

        .hadirin-corner-tl {
            top: 0;
            left: 0;
            border-right: none;
            border-bottom: none;
            border-top-left-radius: 8px;
        }

        .hadirin-corner-tr {
            top: 0;
            right: 0;
            border-left: none;
            border-bottom: none;
            border-top-right-radius: 8px;
        }

        .hadirin-corner-bl {
            bottom: 0;
            left: 0;
            border-right: none;
            border-top: none;
            border-bottom-left-radius: 8px;
        }

        .hadirin-corner-br {
            bottom: 0;
            right: 0;
            border-left: none;
            border-top: none;
            border-bottom-right-radius: 8px;
        }

        .hadirin-qr-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 2rem;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .hadirin-action-buttons {
                justify-content: center;
            }
            
            .hadirin-btn {
                font-size: 0.85rem;
                padding: 0.65rem 1.3rem;
            }
        }

        @media (max-width: 992px) {
            .hadirin-main-header {
                padding: 1.5rem;
            }
            
            .hadirin-main-body {
                padding: 2rem;
            }
            
            .hadirin-detail-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
            
            .hadirin-event-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
            
            .hadirin-qr-wrapper {
                width: 220px;
                height: 220px;
            }
            
            .hadirin-corner {
                width: 30px;
                height: 30px;
            }
        }

        @media (max-width: 768px) {
            .hadirin-main-header .row {
                flex-direction: column;
                gap: 1rem;
            }
            
            .hadirin-action-buttons {
                justify-content: center;
                gap: 0.5rem;
            }
            
            .hadirin-btn {
                padding: 0.6rem 1rem;
                font-size: 0.8rem;
                flex: 1;
                min-width: 120px;
            }
            
            .hadirin-detail-item,
            .hadirin-info-item {
                padding: 1rem;
            }
            
            .hadirin-barcode-body {
                padding: 1.5rem;
            }
            
            .hadirin-event-card,
            .hadirin-qr-section {
                padding: 1.5rem;
            }
            
            .hadirin-qr-actions {
                flex-direction: column;
                align-items: center;
            }
            
            .hadirin-qr-actions .hadirin-btn {
                width: 200px;
                min-width: 200px;
            }
        }

        @media (max-width: 480px) {
            .hadirin-main-title {
                font-size: 1.5rem;
            }
            
            .hadirin-main-subtitle {
                font-size: 0.9rem;
            }
            
            .hadirin-section-title {
                font-size: 1.2rem;
            }
            
            .hadirin-detail-item {
                flex-direction: column;
                text-align: center;
            }
            
            .hadirin-detail-icon {
                margin: 0 auto 1rem auto;
            }
            
            .hadirin-qr-wrapper {
                width: 200px;
                height: 200px;
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

        // Function to copy attendance link from modal
        function copyAttendanceLink() {
            const linkInput = document.getElementById('attendanceLink');
            linkInput.select();
            linkInput.setSelectionRange(0, 99999); // For mobile devices
            
            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(linkInput.value).then(() => {
                    showCopyFeedback();
                }).catch(err => {
                    console.error('Failed to copy text using Clipboard API: ', err);
                    document.execCommand('copy');
                    showCopyFeedback();
                });
            } else {
                document.execCommand('copy');
                showCopyFeedback();
            }
        }

        function showCopyFeedback() {
            const button = document.querySelector('.hadirin-link-container .hadirin-btn');
            const originalHTML = button.innerHTML;
            button.innerHTML = '<i class="fas fa-check"></i>';
            button.style.background = 'linear-gradient(135deg, #28a745 0%, #20c997 100%)';
            
            setTimeout(() => {
                button.innerHTML = originalHTML;
                button.style.background = 'linear-gradient(135deg, #00b4d8 0%, #0077b6 100%)';
            }, 2000);
        }

        // Enhanced barcode modal handler
        document.getElementById('showBarcodeBtn').addEventListener('click', function() {
            const slug = this.getAttribute('data-slug');
            const modal = new bootstrap.Modal(document.getElementById('barcodeModal'));
            const qrCodeContainer = document.getElementById('qrcode-container');
            
            // Show modal immediately
            modal.show();
            
            // Show loading state
            qrCodeContainer.innerHTML = `
                <div class="hadirin-qr-loading">
                    <div class="hadirin-spinner">
                        <div class="hadirin-spinner-ring"></div>
                    </div>
                    <p class="mt-3">Memuat QR Code...</p>
                </div>
            `;
            
            // Fetch event details
            fetch(`{{ url('presence/barcode-details') }}/${slug}`)
                .then(response => response.json())
                .then(data => {
                    // Update event details
                    document.getElementById('eventName').textContent = data.presence.nama_kegiatan;
                    document.getElementById('eventDate').textContent = data.formatted_date;
                    document.getElementById('eventTime').textContent = data.formatted_time + ' WIB';
                    document.getElementById('eventLocation').textContent = data.presence.lokasi;
                    document.getElementById('eventDeadline').textContent = data.formatted_deadline ? data.formatted_deadline + ' WIB' : 'Tidak Ada Batas Waktu';
                    document.getElementById('attendanceLink').value = data.attendance_url;
                    
                    // Load QR Code
                    const img = document.createElement('img');
                    // Try PNG first, fall back to SVG if needed
                    const primaryQrUrl = data.qr_url_png || data.qr_url;
                    const fallbackQrUrl = data.qr_url_svg || data.qr_url;
                    let triedFallback = false;
                    img.src = primaryQrUrl;
                    img.alt = 'QR Code Presensi';
                    img.onload = function() {
                        qrCodeContainer.innerHTML = '';
                        qrCodeContainer.appendChild(img);
                    };
                    img.onerror = function() {
                        if (!triedFallback) {
                            triedFallback = true;
                            // Try SVG fallback
                            fetch(fallbackQrUrl)
                                .then(r => r.ok ? r.text() : Promise.reject(new Error('SVG fetch failed')))
                                .then(svgText => {
                                    const blob = new Blob([svgText], { type: 'image/svg+xml' });
                                    const url = URL.createObjectURL(blob);
                                    img.src = url;
                                })
                                .catch(() => {
                                    qrCodeContainer.innerHTML = `
                                        <div class="hadirin-qr-loading">
                                            <i class="fas fa-exclamation-triangle text-warning" style="font-size: 2rem;"></i>
                                            <p class="mt-2">Gagal memuat QR Code</p>
                                        </div>
                                    `;
                                });
                        } else {
                            qrCodeContainer.innerHTML = `
                                <div class="hadirin-qr-loading">
                                    <i class="fas fa-exclamation-triangle text-warning" style="font-size: 2rem;"></i>
                                    <p class="mt-2">Gagal memuat QR Code</p>
                                </div>
                            `;
                        }
                    };
                    
                    // Setup download buttons
                    setupDownloadButtons(primaryQrUrl, fallbackQrUrl, slug, data.presence);
                })
                .catch(error => {
                    console.error('Error fetching barcode details:', error);
                    qrCodeContainer.innerHTML = `
                        <div class="hadirin-qr-loading">
                            <i class="fas fa-exclamation-triangle text-danger" style="font-size: 2rem;"></i>
                            <p class="mt-2">Gagal memuat data kegiatan</p>
                        </div>
                    `;
                });
        });

        function setupDownloadButtons(qrPngUrl, qrSvgUrl, slug, presenceData) {
            // QR Code download
            const downloadQRBtn = document.getElementById('downloadQRBtn');
            downloadQRBtn.onclick = function() {
                // Prefer downloading PNG directly; if not available, convert SVG to PNG on the fly
                attemptPngDownload(qrPngUrl, qrSvgUrl, slug);
            };
            
            // Event card download
            const downloadEventCardBtn = document.getElementById('downloadEventCardBtn');
            downloadEventCardBtn.onclick = function() {
                // Use whichever URL works; event card renderer will handle SVG/PNG
                generateHadirinEventCard(presenceData, qrPngUrl || qrSvgUrl, slug);
            };
        }

        async function attemptPngDownload(pngUrl, svgUrl, slug) {
            try {
                if (pngUrl) {
                    const res = await fetch(pngUrl);
                    if (res.ok && res.headers.get('Content-Type')?.includes('image/png')) {
                        const blob = await res.blob();
                        const url = URL.createObjectURL(blob);
                        const a = document.createElement('a');
                        a.href = url;
                        a.download = `qr-code-${slug}.png`;
                        document.body.appendChild(a);
                        a.click();
                        a.remove();
                        URL.revokeObjectURL(url);
                        return;
                    }
                }
            } catch (_) { /* fall through to SVG conversion */ }

            // Fallback: fetch SVG, render to canvas, download as PNG
            try {
                const res = await fetch(svgUrl);
                const svgText = await res.text();
                const svgBlob = new Blob([svgText], { type: 'image/svg+xml' });
                const svgUrlObj = URL.createObjectURL(svgBlob);
                const img = new Image();
                img.onload = function() {
                    const canvas = document.createElement('canvas');
                    canvas.width = 300; canvas.height = 300;
                    const ctx = canvas.getContext('2d');
                    ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
                    canvas.toBlob(function(blob) {
                        const url = URL.createObjectURL(blob);
                        const a = document.createElement('a');
                        a.href = url;
                        a.download = `qr-code-${slug}.png`;
                        document.body.appendChild(a);
                        a.click();
                        a.remove();
                        URL.revokeObjectURL(url);
                        URL.revokeObjectURL(svgUrlObj);
                    }, 'image/png');
                };
                img.onerror = function() {
                    URL.revokeObjectURL(svgUrlObj);
                    alert('Gagal mengunduh QR. Coba lagi.');
                };
                img.src = svgUrlObj;
            } catch (e) {
                alert('Gagal mengunduh QR.');
            }
        }
// QR Event Card Generator - Footer Sejajar dengan Header Alignment yang Diperbaiki
function generateHadirinEventCard(presenceData, qrUrl, slug) {
    const canvas = document.createElement('canvas');
    const ctx = canvas.getContext('2d');
    
    // Canvas size dengan proporsi yang tepat
    canvas.width = 600;
    canvas.height = 720;
    
    // Enable high-quality rendering
    ctx.imageSmoothingEnabled = true;
    ctx.imageSmoothingQuality = 'high';
    
    // Background putih bersih tanpa gradasi
    ctx.fillStyle = '#ffffff';
    ctx.fillRect(0, 0, canvas.width, canvas.height);
    
    // Header section biru - warna disesuaikan dengan gambar
    const headerHeight = 90;
    const headerGradient = ctx.createLinearGradient(0, 0, canvas.width, headerHeight);
    headerGradient.addColorStop(0, '#1e3a8a');   // Light blue sesuai gambar
    headerGradient.addColorStop(0.5, '#1e3a8a'); // Royal blue
    headerGradient.addColorStop(1, '#4f81ff');   // Dark blue
    ctx.fillStyle = headerGradient;
    roundRect(ctx, 0, 0, canvas.width, headerHeight, 0);
    ctx.fill();
    
    // Load PLN Logo
    const logoImg = new Image();
    logoImg.crossOrigin = 'anonymous';
    
    function drawHeaderContent() {
        const logoSize = 50; // Diperbesar sedikit dari 45 ke 50
        const logoX = 30;
        const logoY = (headerHeight - logoSize) / 2; // Center vertikal sempurna
        
        // Draw PLN logo atau fallback
        if (logoImg.complete && logoImg.naturalWidth > 0) {
            ctx.drawImage(logoImg, logoX, logoY, logoSize, logoSize);
        } else {
            // PLN logo placeholder dengan background kuning
            ctx.fillStyle = '#fbbf24'; // Yellow 400
            roundRect(ctx, logoX, logoY, logoSize, logoSize, 8);
            ctx.fill();
            
            // Lightning bolt icon placeholder - BENAR-BENAR TENGAH
            ctx.save(); // Save current context state
            ctx.fillStyle = '#1e40af';
            ctx.font = 'bold 28px "Arial", sans-serif';
            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';
            
            // Hitung titik tengah logo dengan tepat
            const logoCenterX = logoX + (logoSize / 2);
            const logoCenterY = logoY + (logoSize / 2);
            
            ctx.fillText('⚡', logoCenterX, logoCenterY);
            ctx.restore(); // Restore context state
        }
        
        // Header text dengan positioning yang BENAR-BENAR SEJAJAR dengan logo
        const logoCenterY = logoY + (logoSize / 2); // Titik tengah logo secara vertikal
        
        // Text positioning
        const textStartX = logoX + logoSize + 25; // Jarak dari logo ke teks
        
        // Hitung tinggi total kedua baris teks untuk center alignment yang sempurna
        const line1FontSize = 22;
        const line2FontSize = 15;
        const lineSpacing = 18; // Sedikit dikurangi untuk lebih rapat
        
        // Total height kedua baris teks (tinggi font + spacing)
        const totalTextHeight = line1FontSize + lineSpacing + line2FontSize;
        
        // Posisi Y untuk baris pertama - turunkan sedikit ke bawah
        const textVerticalOffset = 8; // Tambahkan offset ke bawah
        const textStartY = logoCenterY - (totalTextHeight / 2) + (line1FontSize / 2) + textVerticalOffset;
        
        // Reset text properties
        ctx.textAlign = 'left';
        ctx.textBaseline = 'alphabetic';
        
        // Baris pertama - "Sistem Presensi Digital"
        ctx.fillStyle = '#ffffff';
        ctx.font = `bold ${line1FontSize}px "Inter", sans-serif`;
        ctx.fillText('Sistem Presensi Digital', textStartX, textStartY);
        
        // Baris kedua - "PT PLN (Persero) UPT Malang"
        ctx.fillStyle = 'rgba(255, 255, 255, 0.9)';
        ctx.font = `${line2FontSize}px "Inter", sans-serif`;
        ctx.fillText('PT PLN (Persero) UPT Malang', textStartX, textStartY + lineSpacing + (line2FontSize / 2));
        
        // Garis orange di bawah header - rata penuh dan lebih tebal
        const lineY = headerHeight - 5;
        ctx.fillStyle = '#f97316'; // Orange solid tanpa gradient
        ctx.fillRect(0, lineY, canvas.width, 5);
    }
    
    // Load logo
    logoImg.onload = function() {
        drawHeaderContent();
        drawMainContent();
    };
    
    logoImg.onerror = function() {
        drawHeaderContent();
        drawMainContent();
    };
    
    logoImg.src = '/images/logo_saja.png';
    
    function drawMainContent() {
        const centerX = canvas.width / 2;
        const eventHeaderY = 130;
        const eventName = presenceData.nama_kegiatan;
        
        // Event name dengan shadow - BIRU GELAP untuk kontras di background putih
        ctx.fillStyle = '#1e40af'; // Blue 700
        ctx.font = 'bold 24px "Inter", sans-serif';
        ctx.textAlign = 'center';
        
        ctx.shadowColor = 'rgba(0, 0, 0, 0.2)';
        ctx.shadowBlur = 4;
        ctx.shadowOffsetY = 1;
        
        const maxEventWidth = canvas.width - 80;
        const eventLines = wrapText(ctx, eventName, maxEventWidth);
        
        eventLines.forEach((line, index) => {
            ctx.fillText(line, centerX, eventHeaderY + (index * 28));
        });
        
        ctx.shadowColor = 'transparent';
        ctx.shadowBlur = 0;
        ctx.shadowOffsetY = 0;
        
        const lastLineY = eventHeaderY + ((eventLines.length - 1) * 28);
        
        // QR Code section dengan shadow - posisi diturunkan sedikit
        const qrSize = 220;
        const qrX = centerX - qrSize / 2;
        const qrY = lastLineY + 45; // Dinaikkan dari 35 ke 45
        
        // Shadow untuk QR frame
        ctx.shadowColor = 'rgba(0, 0, 0, 0.15)';
        ctx.shadowBlur = 8;
        ctx.shadowOffsetX = 0;
        ctx.shadowOffsetY = 4;
        
        // QR frame putih
        const frameSize = qrSize + 24;
        const frameX = qrX - 12;
        const frameY = qrY - 12;
        
        ctx.fillStyle = '#ffffff';
        roundRect(ctx, frameX, frameY, frameSize, frameSize, 12);
        ctx.fill();
        
        // Reset shadow
        ctx.shadowColor = 'transparent';
        ctx.shadowBlur = 0;
        ctx.shadowOffsetX = 0;
        ctx.shadowOffsetY = 0;
        
        // QR border accent orange
        ctx.strokeStyle = '#f97316'; // Orange 500
        ctx.lineWidth = 3;
        roundRect(ctx, frameX, frameY, frameSize, frameSize, 12);
        ctx.stroke();
        
        // QR background
        ctx.fillStyle = '#f8fafc';
        roundRect(ctx, qrX, qrY, qrSize, qrSize, 8);
        ctx.fill();
        
        // Corner indicators
        const cornerSize = 24;
        const corners = [
            { x: frameX + 8, y: frameY + 8 },
            { x: frameX + frameSize - cornerSize - 8, y: frameY + 8 },
            { x: frameX + 8, y: frameY + frameSize - cornerSize - 8 },
            { x: frameX + frameSize - cornerSize - 8, y: frameY + frameSize - cornerSize - 8 }
        ];
        
        ctx.strokeStyle = '#3b82f6';
        ctx.lineWidth = 2.5;
        ctx.lineCap = 'round';
        
        corners.forEach((corner, index) => {
            ctx.beginPath();
            if (index === 0) { // top-left
                ctx.moveTo(corner.x, corner.y + 18);
                ctx.lineTo(corner.x, corner.y + 4);
                ctx.quadraticCurveTo(corner.x, corner.y, corner.x + 4, corner.y);
                ctx.lineTo(corner.x + 18, corner.y);
            } else if (index === 1) { // top-right
                ctx.moveTo(corner.x + 6, corner.y);
                ctx.lineTo(corner.x + cornerSize - 4, corner.y);
                ctx.quadraticCurveTo(corner.x + cornerSize, corner.y, corner.x + cornerSize, corner.y + 4);
                ctx.lineTo(corner.x + cornerSize, corner.y + 18);
            } else if (index === 2) { // bottom-left
                ctx.moveTo(corner.x, corner.y + 6);
                ctx.lineTo(corner.x, corner.y + cornerSize - 4);
                ctx.quadraticCurveTo(corner.x, corner.y + cornerSize, corner.x + 4, corner.y + cornerSize);
                ctx.lineTo(corner.x + 18, corner.y + cornerSize);
            } else { // bottom-right
                ctx.moveTo(corner.x + 6, corner.y + cornerSize);
                ctx.lineTo(corner.x + cornerSize - 4, corner.y + cornerSize);
                ctx.quadraticCurveTo(corner.x + cornerSize, corner.y + cornerSize, corner.x + cornerSize, corner.y + cornerSize - 4);
                ctx.lineTo(corner.x + cornerSize, corner.y + 6);
            }
            ctx.stroke();
        });
        
        // Instruksi QR - Font dan ketebalan yang sama untuk kedua baris dengan jarak yang seimbang
        const instructionY = qrY + qrSize + 45; // Jarak dari QR ke instruksi
        
        ctx.fillStyle = '#1e40af'; // BIRU GELAP
        ctx.font = '14px "Inter", sans-serif'; // Font sama untuk baris pertama
        ctx.textAlign = 'center';
        ctx.fillText('Silakan pindai kode QR menggunakan aplikasi', centerX, instructionY);
        
        ctx.fillStyle = '#1e40af'; // BIRU GELAP
        ctx.font = '14px "Inter", sans-serif'; // Font sama untuk baris kedua
        ctx.fillText('kamera atau pemindai QR pada perangkat Anda', centerX, instructionY + 18);
        
        // Detail kegiatan - jarak yang sama dari instruksi kamera ke detail
        const detailsStartY = instructionY + 63; // Jarak yang sama seperti dari nama ke QR
        
        // Header detail - BIRU GELAP
        ctx.fillStyle = '#1e40af'; // BIRU GELAP
        ctx.font = 'bold 18px "Inter", sans-serif';
        ctx.textAlign = 'center';
        ctx.fillText('DETAIL KEGIATAN', centerX, detailsStartY);
        
        // Container untuk detail - dibuat lebih kecil karena layout 2 baris
        const detailContainerY = detailsStartY + 20;
        const detailContainerHeight = 60; // Dikurangi dari 90 ke 60
        const detailPadding = 30;
        
        // Background container putih bersih
        ctx.fillStyle = '#ffffff';
        roundRect(ctx, detailPadding, detailContainerY, canvas.width - (detailPadding * 2), detailContainerHeight, 10);
        ctx.fill();
        
        // Border container biru
        ctx.strokeStyle = '#3b82f6';
        ctx.lineWidth = 2;
        roundRect(ctx, detailPadding, detailContainerY, canvas.width - (detailPadding * 2), detailContainerHeight, 10);
        ctx.stroke();
        
        // Detail items - layout 2 baris (Tanggal & Waktu di baris 1, Lokasi di baris 2)
        const details = [
            { 
                label: 'Tanggal', 
                value: document.getElementById('eventDate') ? document.getElementById('eventDate').textContent : '15 Agustus 2025',
                icon: '📅',
                row: 0,
                col: 0
            },
            { 
                label: 'Waktu', 
                value: document.getElementById('eventTime') ? document.getElementById('eventTime').textContent : '08:00 WIB',
                icon: '🕐',
                row: 0,
                col: 1
            },
            { 
                label: 'Lokasi', 
                value: presenceData.lokasi || 'Zoom Meeting',
                icon: '📍',
                row: 1,
                col: 0
            }
        ];
        
        const rowHeight = 26;
        const itemStartY = detailContainerY + 15;
        const leftColumnX = detailPadding + 15;
        const rightColumnX = canvas.width / 2 + 10;
        
        details.forEach((detail) => {
            const currentY = itemStartY + (detail.row * rowHeight);
            const startX = detail.col === 0 ? leftColumnX : rightColumnX;
            
            // Icon
            ctx.fillStyle = '#1e40af';
            ctx.font = '14px "Segoe UI", sans-serif';
            ctx.textAlign = 'left';
            ctx.fillText(detail.icon, startX, currentY + 6);
            
            // Label
            ctx.fillStyle = '#1e40af';
            ctx.font = 'bold 14px "Inter", sans-serif';
            ctx.fillText(detail.label, startX + 25, currentY + 6);
            
            // Colon
            ctx.fillStyle = '#1e40af';
            ctx.fillText(':', startX + 80, currentY + 6);
            
            // Value
            ctx.fillStyle = '#1e40af';
            ctx.font = '14px "Inter", sans-serif';
            
            const valueX = startX + 95;
            const maxValueWidth = (detail.col === 0 ? rightColumnX - 20 : canvas.width - detailPadding) - valueX;
            const valueText = detail.value;
            
            if (ctx.measureText(valueText).width > maxValueWidth) {
                let truncatedText = valueText;
                while (ctx.measureText(truncatedText + '...').width > maxValueWidth && truncatedText.length > 0) {
                    truncatedText = truncatedText.slice(0, -1);
                }
                ctx.fillText(truncatedText + '...', valueX, currentY + 6);
            } else {
                ctx.fillText(valueText, valueX, currentY + 6);
            }
        });
        
        // Load QR code
        loadAndDrawQR(qrUrl, qrX, qrY, qrSize);
    }
    
    function loadAndDrawQR(qrUrl, qrX, qrY, qrSize) {
        const qrImage = new Image();
        qrImage.crossOrigin = 'anonymous';
        
        qrImage.onload = function() {
            ctx.drawImage(qrImage, qrX + 8, qrY + 8, qrSize - 16, qrSize - 16);
            drawFooter();
        };
        
        qrImage.onerror = function() {
            console.error('Failed to load QR code image');
            
            // QR placeholder
            ctx.fillStyle = '#ffffff';
            ctx.fillRect(qrX + 8, qrY + 8, qrSize - 16, qrSize - 16);
            
            // QR pattern
            const patternSize = 14;
            ctx.fillStyle = '#000000';
            for (let i = 0; i < 14; i++) {
                for (let j = 0; j < 14; j++) {
                    if ((i + j) % 2 === 0 || (i % 3 === 0 && j % 3 === 0)) {
                        ctx.fillRect(qrX + 8 + (i * patternSize), qrY + 8 + (j * patternSize), patternSize - 1, patternSize - 1);
                    }
                }
            }
            
            // Corner squares
            const cornerSquareSize = 42;
            const corners = [
                { x: qrX + 8, y: qrY + 8 },
                { x: qrX + qrSize - 8 - cornerSquareSize, y: qrY + 8 },
                { x: qrX + 8, y: qrY + qrSize - 8 - cornerSquareSize }
            ];
            
            corners.forEach(corner => {
                ctx.fillStyle = '#000000';
                ctx.fillRect(corner.x, corner.y, cornerSquareSize, cornerSquareSize);
                ctx.fillStyle = '#ffffff';
                ctx.fillRect(corner.x + 6, corner.y + 6, cornerSquareSize - 12, cornerSquareSize - 12);
                ctx.fillStyle = '#000000';
                ctx.fillRect(corner.x + 12, corner.y + 12, cornerSquareSize - 24, cornerSquareSize - 24);
            });
            
            drawFooter();
        };
        
        if (qrUrl && (qrUrl.includes('format=svg') || qrUrl.endsWith('.svg'))) {
            fetch(qrUrl)
                .then(response => response.text())
                .then(svgText => {
                    const svgBlob = new Blob([svgText], { type: 'image/svg+xml' });
                    const url = URL.createObjectURL(svgBlob);
                    qrImage.src = url;
                })
                .catch(error => {
                    console.error('Error loading SVG QR code:', error);
                    qrImage.onerror();
                });
        } else if (qrUrl) {
            qrImage.src = qrUrl;
        } else {
            qrImage.onerror();
        }
    }
    
    function drawFooter() {
        // Footer dengan background biru gelap - warna disesuaikan dengan gambar
        const footerHeight = 50; // Dikurangi karena hanya 1 baris
        const footerY = canvas.height - footerHeight;
        
        // Footer background biru gelap sesuai gambar
        const footerBg = ctx.createLinearGradient(0, footerY - 10, canvas.width, canvas.height);
        footerBg.addColorStop(0, '#1e3a8a'); // Blue 800
        footerBg.addColorStop(1, '#4169e1'); // Royal blue sesuai gambar
        ctx.fillStyle = footerBg;
        ctx.fillRect(0, footerY - 10, canvas.width, footerHeight + 10);
        
        // Separator line orange - rata penuh dan lebih tebal
        ctx.fillStyle = '#f97316'; // Orange solid
        ctx.fillRect(0, footerY - 15, canvas.width, 4);
        
        // Footer text dalam satu baris - sejajar dan tidak ramai
        ctx.fillStyle = '#ffffff';
        ctx.font = 'bold 12px "Inter", sans-serif';
        ctx.textAlign = 'center';
        ctx.fillText('PT PLN (Persero) UPT Malang - Hadirin Digital Attendance System', canvas.width / 2, footerY + 15);
        
        // Timestamp di bawah - lebih kecil
        ctx.fillStyle = 'rgba(255, 255, 255, 0.6)';
        ctx.font = '10px "Inter", sans-serif';
        const now = new Date();
        const timestamp = now.toLocaleDateString('id-ID', { 
            day: 'numeric', 
            month: 'long', 
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
        ctx.fillText(`Dibuat pada: ${timestamp}`, canvas.width / 2, footerY + 32);
        
        downloadCanvas();
    }
    
    function downloadCanvas() {
        canvas.toBlob(function(blob) {
            const link = document.createElement('a');
            link.href = URL.createObjectURL(blob);
            link.download = `qr-event-card-${slug || 'professional'}-${Date.now()}.png`;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            URL.revokeObjectURL(link.href);
        }, 'image/png', 1.0);
    }
    
    // Start process
    setTimeout(() => {
        if (!logoImg.complete) {
            drawHeaderContent();
            drawMainContent();
        }
    }, 2000);
}

// Helper functions
function roundRect(ctx, x, y, width, height, radius) {
    if (width < 2 * radius) radius = width / 2;
    if (height < 2 * radius) radius = height / 2;
    
    ctx.beginPath();
    ctx.moveTo(x + radius, y);
    ctx.arcTo(x + width, y, x + width, y + height, radius);
    ctx.arcTo(x + width, y + height, x, y + height, radius);
    ctx.arcTo(x, y + height, x, y, radius);
    ctx.arcTo(x, y, x + width, y, radius);
    ctx.closePath();
}

function wrapText(ctx, text, maxWidth) {
    const words = text.split(' ');
    const lines = [];
    let currentLine = '';
    
    for (let i = 0; i < words.length; i++) {
        const testLine = currentLine + (currentLine ? ' ' : '') + words[i];
        const metrics = ctx.measureText(testLine);
        
        if (metrics.width > maxWidth && currentLine) {
            lines.push(currentLine);
            currentLine = words[i];
        } else {
            currentLine = testLine;
        }
    }
    
    if (currentLine) {
        lines.push(currentLine);
    }
    
    return lines;
}

// Browser compatibility
if (!CanvasRenderingContext2D.prototype.roundRect) {
    CanvasRenderingContext2D.prototype.roundRect = function(x, y, width, height, radius) {
        this.beginPath();
        this.moveTo(x + radius, y);
        this.lineTo(x + width - radius, y);
        this.quadraticCurveTo(x + width, y, x + width, y + radius);
        this.lineTo(x + width, y + height - radius);
        this.quadraticCurveTo(x + width, y + height, x + width - radius, y + height);
        this.lineTo(x + radius, y + height);
        this.quadraticCurveTo(x, y + height, x, y + height - radius);
        this.lineTo(x, y + radius);
        this.quadraticCurveTo(x, y, x + radius, y);
        this.closePath();
    };
}

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