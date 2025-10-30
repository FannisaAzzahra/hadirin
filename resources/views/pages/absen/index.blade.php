<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }}</title>

    {{-- Favicon --}}
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo_saja.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo_saja.png') }}">
    <meta name="theme-color" content="#0077b6"> {{-- Warna tab Chrome di mobile --}}


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    
    <style>
        /* Body and Background */
        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
        }

        /* Header Card Styling */
        .header-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            border: none;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 119, 182, 0.1);
            overflow: hidden;
            border-bottom: 4px solid #ffd60a;
        }

        .header-card .card-body {
            padding: 2rem;
        }

        .header-logos {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .header-logos img {
            border-radius: 0;
            box-shadow: none;
            transition: transform 0.3s ease;
            background: transparent;
        }

        .header-logos img:hover {
            transform: scale(1.05);
        }

        .header-title {
            font-weight: 700;
            color: #0077b6;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
            margin: 0;
        }

        /* Detail Table Styling */
        .detail-table {
            background: linear-gradient(135deg, #ffffff 0%, #ffffff 100%);
            border-radius: 15px;
            padding: 1.5rem;
            border-left: 4px solid #ffd60a;
            border-right: 4px solid #ffd60a;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .detail-table table {
            width: 100%;
            table-layout: fixed;
        }

        .detail-table td {
            padding: 0.75rem 0;
            border: none;
            font-size: 1rem;
            vertical-align: top;
        }

        .detail-table td:first-child {
            font-weight: 600;
            color: #0077b6;
            min-width: 25px;
        }

        .detail-table td:nth-child(2) {
            width: 20px;
            text-align: center;
            padding-left: 0;
            padding-right: 0;
        }

        .detail-table td:last-child {
            color: #333;
            width: 75%;
        }

        .detail-table .location-link {
            color: #0077b6;
            text-decoration: none;
            font-weight: 500;
            position: relative;
            transition: all 0.3s ease;
        }

        .detail-table .location-link:hover {
            color: #00b4d8;
            transform: translateX(3px);
        }

        .detail-table .location-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(135deg, #ffd60a, #ffed4a);
            transition: width 0.3s ease;
        }

        .detail-table .location-link:hover::after {
            width: 100%;
        }

        /* Card Styling */
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 119, 182, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(0, 119, 182, 0.15);
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
            font-size: 1.1rem;
        }

        .card-body {
            padding: 1.5rem;
            background: white;
        }

        /* Form Styling */
        .form-label {
            font-weight: 600;
            color: #0077b6;
            margin-bottom: 0.5rem;
        }

        .form-control, .form-select {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 0.75rem;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .form-control:focus, .form-select:focus {
            border-color: #ffd60a;
            box-shadow: 0 0 0 0.2rem rgba(255, 214, 10, 0.25);
        }

        .form-control:disabled {
            background-color: #f8f9fa;
            border-color: #dee2e6;
            opacity: 0.7;
        }

        /* Select2 Custom Styling - PERBAIKAN WIDTH & WHITE TEXT */
        .select2-container--bootstrap-5 .select2-selection {
            border: 2px solid #e9ecef !important;
            border-radius: 10px !important;
            min-height: calc(3.375rem + 2px) !important;
            font-size: 0.95rem !important;
            display: flex !important;
            align-items: center !important;
            width: 100% !important;
        }

        .select2-container--bootstrap-5.select2-container--focus .select2-selection,
        .select2-container--bootstrap-5.select2-container--open .select2-selection {
            border-color: #ffd60a !important;
            box-shadow: 0 0 0 0.2rem rgba(255, 214, 10, 0.25) !important;
        }

        .select2-container--bootstrap-5 .select2-selection__rendered {
            color: #495057 !important;
            padding: 0.75rem !important;
            line-height: 1.5 !important;
            display: flex !important;
            align-items: center !important;
            width: calc(100% - 2.5rem) !important;
            overflow: hidden !important;
            text-overflow: ellipsis !important;
            white-space: nowrap !important;
        }

        .select2-container--bootstrap-5 .select2-selection__placeholder {
            color: #6c757d !important;
            text-align: left !important;
        }

        .select2-container--bootstrap-5 .select2-selection__arrow {
            height: 100% !important;
            right: 0.75rem !important;
            top: 0 !important;
            width: 20px !important;
        }

        /* Dropdown styling - PERBAIKAN UTAMA */
        .select2-dropdown {
            border: 2px solid #e9ecef !important;
            border-radius: 10px !important;
            box-shadow: 0 4px 20px rgba(0, 119, 182, 0.1) !important;
            margin-top: 4px !important;
            max-width: 100% !important;
            min-width: 0 !important;
            width: 100% !important;
        }

        .select2-results__option {
            padding: 0.75rem !important;
            font-size: 0.95rem !important;
            overflow: hidden !important;
            text-overflow: ellipsis !important;
            white-space: nowrap !important;
            color: #333 !important; /* Default text color for unselected items */
        }

        /* PERBAIKAN UTAMA: Warna putih untuk item yang di-highlight/dipilih */
        .select2-results__option--highlighted {
            background-color: #0077b6 !important;
            color: white !important; /* TEXT PUTIH UNTUK ITEM YANG DI-HIGHLIGHT */
        }

        /* TAMBAHAN: Untuk item yang selected di dropdown (jika ada) */
        .select2-results__option--selected {
            background-color: #0077b6 !important;
            color: white !important; /* TEXT PUTIH UNTUK ITEM YANG SELECTED */
        }

        /* Style untuk item yang selected DAN highlighted sekaligus */
        .select2-results__option--selected.select2-results__option--highlighted {
            background-color: #005577 !important; /* Warna lebih gelap */
            color: white !important; /* TEXT PUTIH */
        }

        .select2-search--dropdown {
            padding: 0.75rem !important;
            border-bottom: 1px solid #e9ecef !important;
        }

        .select2-search--dropdown .select2-search__field {
            border: 2px solid #e9ecef !important;
            border-radius: 8px !important;
            padding: 0.5rem 0.75rem !important;
            width: 100% !important;
            font-size: 0.9rem !important;
            box-sizing: border-box !important;
        }

        .select2-search--dropdown .select2-search__field:focus {
            border-color: #ffd60a !important;
            box-shadow: 0 0 0 0.2rem rgba(255, 214, 10, 0.25) !important;
            outline: none !important;
        }

        .select2-results__message {
            padding: 0.75rem !important;
            color: #6c757d !important;
            font-style: italic !important;
        }

        /* Ensure Select2 has proper width constraint */
        .select2-container {
            width: 100% !important;
            max-width: 100% !important;
            display: block !important;
        }

        /* Fix untuk container parent */
        #nama-field {
            position: relative;
            width: 100%;
        }

        #nama-field .select2-container {
            width: 100% !important;
            max-width: 100% !important;
        }

        /* Clear button styling */
        .select2-selection__clear {
            color: #6c757d !important;
            font-size: 1.2rem !important;
            line-height: 1 !important;
            padding-right: 0.5rem !important;
        }

        .select2-selection__clear:hover {
            color: #dc3545 !important;
        }

        /* Custom styling untuk result items */
        .select2-result-item {
            padding: 0.5rem 0;
        }

        .select2-result-item .fw-medium {
            font-weight: 500;
            color: #333;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* PERBAIKAN: Style untuk hasil pencarian yang di-highlight */
        .select2-results__option--highlighted .select2-result-item .fw-medium {
            color: white !important; /* TEXT PUTIH UNTUK ITEM HASIL PENCARIAN YANG DI-HIGHLIGHT */
        }

        /* Z-index fix */
        .select2-container--bootstrap-5.select2-container--open {
            z-index: 1056;
        }

        .select2-dropdown {
            z-index: 1056 !important;
        }

        /* Signature Pad Styling */
        .signature-container {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 1rem;
            background: white;
            position: relative;
        }

        .signature-pad {
            border: 2px dashed #dee2e6;
            border-radius: 8px;
            background: #fafbfc;
            cursor: crosshair;
        }

        /* Button Styling */
        .btn {
            border-radius: 10px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn-primary {
            background: linear-gradient(135deg, #0077b6 0%, #00b4d8 100%);
            color: white;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #005577 0%, #0099cc 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 119, 182, 0.3);
            color: white;
        }

        .btn-secondary {
            background: linear-gradient(135deg, #6b7280 0%, #9ca3af 100%);
            color: white;
        }

        .btn-secondary:hover {
            background: linear-gradient(135deg, #4b5563 0%, #6b7280 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(107, 114, 128, 0.3);
            color: white;
        }

        /* PERBAIKAN UTAMA: Carousel/Swiper Styling untuk Responsive Images - TANPA BAYANGAN */
        .mySwiper {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 119, 182, 0.1);
            background: #f8f9fa;
        }
        
        /* Container untuk slide yang fleksibel */
        .swiper-slide {
            display: flex !important;
            justify-content: center;
            align-items: center;
            background: #f8f9fa;
            position: relative;
            height: auto; /* Hapus min/max-height agar tinggi menyesuaikan konten */
            min-height: 200px;
        }
        
        /* PERBAIKAN: Image styling tanpa box-shadow */
        .swiper-slide img {
            max-width: 100%;
            max-height: 100%;
            width: auto;
            height: auto;
            object-fit: contain; /* PENTING: Gunakan contain agar seluruh gambar terlihat */
            display: block;
            margin: 0 auto;
            border-radius: 10px;
        }

        /* Swiper navigation buttons styling */
        .swiper-button-next,
        .swiper-button-prev {
            color: #0077b6 !important;
            background: rgba(255, 255, 255, 0.9);
            width: 44px;
            height: 44px;
            border-radius: 50%;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .swiper-button-next:hover,
        .swiper-button-prev:hover {
            background: rgba(255, 255, 255, 1);
            transform: scale(1.1);
            box-shadow: 0 4px 15px rgba(0, 119, 182, 0.2);
        }

        .swiper-button-next::after,
        .swiper-button-prev::after {
            font-size: 18px;
            font-weight: bold;
        }

        /* PERBAIKAN UTAMA: Pagination styling */
        .swiper-pagination {
            position: relative; /* Ganti absolute menjadi relative */
            top: auto; /* Hapus posisi absolut */
            bottom: -20px; /* Jarak dari bawah container */
            margin-top: 15px; /* Jarak dari gambar */
        }
        
        .swiper-pagination-bullet {
            width: 12px !important;
            height: 12px !important;
            background: rgba(255, 214, 10, 0.5) !important;
            border: 2px solid white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .swiper-pagination-bullet-active {
            background: #ffd60a !important;
            transform: scale(1.2);
        }

        /* Loading placeholder untuk gambar - hanya tampil saat loading */
        .swiper-slide.loading::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 40px;
            height: 40px;
            border: 3px solid #e9ecef;
            border-top: 3px solid #0077b6;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            z-index: 1;
        }

        /* Hide loading saat gambar sudah loaded */
        .swiper-slide img {
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .swiper-slide img.loaded {
            opacity: 1;
        }

        @keyframes spin {
            0% { transform: translate(-50%, -50%) rotate(0deg); }
            100% { transform: translate(-50%, -50%) rotate(360deg); }
        }

        /* Instagram Link Styling */
        .instagram-link {
            padding: 1rem;
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            border-radius: 10px;
            text-decoration: none;
            color: #0077b6;
            transition: all 0.3s ease;
            display: block;
        }

        .instagram-link:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 119, 182, 0.15);
            color: #00b4d8;
        }

        .instagram-link img {
            transition: transform 0.3s ease;
        }

        .instagram-link:hover img {
            transform: scale(1.1);
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
            font-size: 0.9rem;
        }

        /* Helper Text */
        .text-muted {
            font-size: 0.875rem;
            color: #6c757d !important;
        }

        /* Error Messages */
        .text-danger {
            font-size: 0.875rem;
            margin-top: 0.25rem;
            font-weight: 500;
        }

        /* Loading Animation */
        .btn:disabled {
            opacity: 0.8;
            cursor: not-allowed;
        }

        /* DataTables Clarity */
        .dataTables_wrapper .table {
            font-size: 0.95rem;
        }

        .dataTables_wrapper .table td,
        .dataTables_wrapper .table th {
            vertical-align: middle;
        }

        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .card {
            animation: fadeIn 0.5s ease-out;
        }

        /* Success Message Styling */
        .alert {
            border: none;
            border-radius: 10px;
            padding: 1rem 1.5rem;
            margin-bottom: 1rem;
        }

        .alert-success {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            color: #155724;
            border-left: 4px solid #28a745;
        }

        .alert-danger {
            background: linear-gradient(135deg, #f8d7da 0%, #f1b0b7 100%);
            color: #721c24;
            border-left: 4px solid #dc3545;
        }

        /* Search Helper Text */
        .search-helper {
            font-size: 0.75rem;
            color: #6c757d;
            margin-top: 0.25rem;
            font-style: italic;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            /* PERBAIKAN UTAMA: Mengatur header-logos agar tetap sejajar (row) */
            .header-logos {
                flex-direction: row; /* Ubah menjadi row */
                justify-content: space-between; /* Pastikan sejajar dan ada ruang di antaranya */
                gap: 0; /* Hapus gap yang mungkin ada */
                align-items: center; 
            }
            
            /* Agar logo dan judul tetap terpisah */
            .header-logos > div {
                flex-grow: 1;
                text-align: center;
            }

            .header-logos img {
                height: 80px; /* Kecilkan sedikit ukuran logo untuk mobile jika perlu */
            }

            .header-title {
                font-size: 1.2rem; /* Kecilkan judul */
                text-align: center;
            }

            .card-body {
                padding: 1rem;
            }

            .btn {
                padding: 0.5rem 1rem;
                font-size: 0.9rem;
            }

            .detail-table {
                padding: 1rem;
            }

            /* PERBAIKAN UTAMA: Tampilan detail-table di layar kecil */
            .detail-table table {
                display: block;
                width: 100%;
            }

            .detail-table thead, .detail-table tbody, .detail-table tr {
                display: block;
            }

            .detail-table tr {
                margin-bottom: 1rem;
            }

            .detail-table td {
                display: block;
                width: 100% !important;
                padding: 0 !important;
                text-align: left !important;
            }

            .detail-table td:first-child {
                font-weight: 700;
                color: #0077b6;
                padding-bottom: 0.25rem !important;
            }
            
            .detail-table td:nth-child(2) {
                display: none; /* Sembunyikan titik dua */
            }

            .detail-table td:last-child {
                padding-bottom: 0.75rem !important;
                color: #333;
            }

            .select2-container {
                width: 100% !important;
                max-width: 100% !important;
            }
            
            .select2-dropdown {
                max-width: calc(100vw - 2rem) !important;
                left: 1rem !important;
                right: 1rem !important;
            }
            
            .select2-results__option {
                padding: 0.5rem !important;
                font-size: 0.875rem !important;
            }

            /* Mobile responsive untuk swiper */
            .swiper-slide {
                height: auto; /* Biarkan tinggi menyesuaikan konten */
            }

            .swiper-slide img {
                width: 100%;
                height: auto;
                object-fit: contain; /* Menjaga proporsi asli gambar */
                max-height: 80vh; /* Mencegah gambar terlalu tinggi di layar HP */
            }

            .swiper-slide img[data-orientation="portrait"] {
                height: auto; /* Hapus aturan tinggi spesifik */
            }

            .swiper-button-next,
            .swiper-button-prev {
                width: 36px;
                height: 36px;
            }

            .swiper-button-next::after,
            .swiper-button-prev::after {
                font-size: 14px;
            }
        }
    </style>
  </head>
  <body>
    
    <div class="container my-5">

      <!-- Header -->
      <div class="card header-card mb-4">
        <div class="card-body">
          <div class="header-logos">
            @if($presence->logo_kiri && \Storage::disk('public')->exists($presence->logo_kiri))
                <img src="{{ route('public.storage-image', $presence->logo_kiri) }}" height="120" alt="Logo Kiri">
            @endif
              <div class="text-center">
                  <h2 class="header-title d-block fw-bold">{{ $presence->judul_header_atas ?? 'ABSENSI ONLINE' }}</h2>

                  <h3 class="d-block">{{ $presence->judul_header_bawah ?? '' }}</h3>
              </div>
            @if($presence->logo_kanan && \Storage::disk('public')->exists($presence->logo_kanan))
                <img src="{{ route('public.storage-image', $presence->logo_kanan) }}" height="120" alt="Logo Kanan">
            @endif
          </div>
          <div class="detail-table">
            <table class="table table-borderless">
              <tr>
                <td>Nama Kegiatan</td>
                <td>:</td>
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
            </table>
          </div>
        </div>
      </div>

      <!-- Success/Error Messages -->
      @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
              <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
      @endif

      @if($errors->any())
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <i class="fas fa-exclamation-circle me-2"></i>
              <ul class="mb-0">
                  @foreach($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>
      @endif

      <!-- Main Grid -->
      @if (session('error'))
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
          {{ session('error') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif

      <div class="row">
        <!-- Kiri: Form Absensi -->
        <div class="col-lg-5 col-md-12 mb-4 mb-lg-0">
          <div class="card h-100">
            <div class="card-header">
              <h5 class="card-title">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check-circle-fill me-2" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.061L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </svg>
                Form Absensi
              </h5>
            </div>
            <div class="card-body">
              <form id="form-absen" action="{{ route('absen.save', $presence->id) }}" method="post">
                @csrf

                <!-- Nama Perusahaan -->
                <div class="mb-3">
                  <label for="unit" class="form-label">Nama Perusahaan</label>
                  <select name="unit" id="unit" class="form-select" required>
                      <option value="">-- Pilih Kategori Peserta --</option>
                      @foreach($companies as $company)
                          <option value="{{ $company->name }}" {{ old('unit') == $company->name ? 'selected' : '' }}>
                              {{ $company->name }}
                          </option>
                      @endforeach
                  </select>
                    @error('unit')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3" id="unit-dtl-field">
                    <label for="unit_dtl" class="form-label">Unit Detail</label>
                    {{-- Dropdown for companies with predefined units --}}
                    <select name="unit_dtl" id="unit_dtl_select" class="form-select d-none">
                        <option value="">-- Pilih Unit --</option>
                    </select>
                    {{-- Input text for companies without predefined units --}}
                    <input type="text" class="form-control d-none" id="unit_dtl_input" name="unit_dtl" placeholder="Masukkan unit detail" value="{{ old('unit_dtl') }}">
                    @error('unit_dtl')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Nama -->
                <div class="mb-3" id="nama-field">
                  <label for="nama" class="form-label">Nama</label>
                  <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama lengkap" value="{{ old('nama') }}">
                  <select class="form-select d-none" id="nama-pln" name="nama" disabled>
                    <option value="">-- Pilih Anggota PLN --</option>
                    @foreach($plnMembers as $member)
                      <option value="{{ $member->nama }}" data-nip="{{ $member->nip }}" data-email="{{ $member->email }}">
                        {{ $member->nama }}
                      </option>
                    @endforeach
                  </select>
                  <small id="nama-helper" class="search-helper d-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-search me-1" viewBox="0 0 16 16">
                      <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                    </svg>
                    Dropdown dengan fitur pencarian - klik untuk memilih atau ketik untuk mencari
                  </small>
                    @error('nama')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- NIP -->
                <div class="mb-3">
                  <label for="nip" class="form-label">NIP</label>
                  <input type="text" class="form-control" id="nip" name="nip" placeholder="Masukkan NIP" value="{{ old('nip') }}">
                    @error('nip')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" value="{{ old('email') }}">
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Jabatan -->
                <div class="mb-3">
                  <label for="jabatan" class="form-label">Jabatan</label>
                  <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Masukkan jabatan" value="{{ old('jabatan') }}">
                    @error('jabatan')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- No HP -->
                <div class="mb-3">
                  <label for="no_hp" class="form-label">No HP</label>
                  <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="Masukkan nomor HP" value="{{ old('no_hp') }}">
                    @error('no_hp')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tanda Tangan -->
                <div class="mb-3">
                  <label for="signature64" class="form-label">Tanda Tangan</label>
                  <div class="signature-container">
                    <canvas id="signature-pad" class="signature-pad" width="300" height="150"></canvas>
                  </div>
                  <textarea name="signature" id="signature64" class="d-none"></textarea>
                    @error('signature')
                        <div class="text-danger">{{ $message }}</div>                                    
                    @enderror
                    <button type="button" id="clear" class="btn btn-secondary btn-sm mt-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                        </svg>
                        Clear
                    </button>
                </div>

                <!-- Submit -->
                <button type="submit" class="btn btn-primary w-100">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill me-2" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.061L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                  </svg>
                  Submit Absensi
                </button>
              </form>
            </div>
          </div>
        </div>

        <!-- Kanan: Slider + Daftar Kehadiran -->
        <div class="col-lg-7 col-md-12">
          <!-- Slider -->
          @if ($presence->slides->count() || ($presence->logo_ig && $presence->link_ig))
            <div class="card mb-4">
              <div class="card-header">
                <h5 class="card-title mb-0">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-info-circle-fill me-2" viewBox="0 0 16 16">
                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2"/>
                  </svg>
                  Informasi Tambahan
                </h5>
              </div>
              <div class="card-body">
                @if ($presence->slides->count())
                  <!-- Swiper -->
                  <div class="swiper mySwiper mb-3">
                    <div class="swiper-wrapper">
                                            @foreach ($presence->slides as $slide)
                                                <div class="swiper-slide">
                                                    @if(\Storage::disk('public')->exists($slide->image_path))
                                                        <img src="{{ route('public.storage-image', $slide->image_path) }}" class="d-block w-100" alt="Slide Image">
                                                    @endif
                                                </div>
                                            @endforeach
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
                  </div>
                @endif

                @if ($presence->logo_ig && $presence->link_ig)
                  <div class="text-center mt-3">
                    <a href="{{ $presence->link_ig }}" target="_blank" class="instagram-link">
                      @if(\Storage::disk('public')->exists($presence->logo_ig))
                          <img src="{{ route('public.storage-image', $presence->logo_ig) }}" height="50" alt="Instagram">
                      @endif
                      @php
                          $igUsername = str_replace('https://instagram.com/', '', $presence->link_ig);
                      @endphp
                      <p class="mt-2 mb-0">{{ '@' . $igUsername }}</p>
                    </a>
                  </div>
                @endif
              </div>
            </div>
          @endif

          <!-- Daftar Kehadiran -->
          <div class="card">
            <div class="card-header">
              <h5 class="card-title">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-people-fill me-2" viewBox="0 0 16 16">
                  <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
                </svg>
                Daftar Kehadiran
              </h5>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                {{ $dataTable->table(['class' => 'table table-bordered table-striped table-hover nowrap'], true) }}
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLlhNTkCfHzAVBReH9diLlvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script src="{{ asset('js/signature.min.js') }}"></script>

    <script>
      // Data companies dengan units (dari server)
      const companiesData = @json($companies);

      $(function() {
          // Initialize Swiper dengan pengaturan responsive image
          var swiper = new Swiper(".mySwiper", {
            spaceBetween: 30,
            centeredSlides: true,
            autoplay: {
              delay: 5000,
              disableOnInteraction: false,
            },
            pagination: {
              el: ".swiper-pagination",
              clickable: true,
            },
            navigation: {
              nextEl: ".swiper-button-next",
              prevEl: ".swiper-button-prev",
            },
            // PENTING: Hapus semua logika penyesuaian tinggi di JavaScript
            // karena sekarang tinggi dikelola oleh CSS 'height: auto' dan 'object-fit: contain'
          });

          // set signature pad width
          let sig = $("#signature-pad").parent().width();
          $('#signature-pad').attr('width', sig);

          // set canvas color
          let signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
              backgroundColor: 'rgb(255, 255, 255, 0)',
              penColor: 'rgb(0, 0, 0)',
          });

          // fill signature to textarea
          $('canvas').on('mouseup touchend', function() {
              $('#signature64').val(signaturePad.toDataURL());
          });

          // clear signature
          $('#clear').on('click', function(e) {
              e.preventDefault();
              signaturePad.clear();
              $('#signature64').val('');
          });

          // submit form
          $('#form-absen').on('submit', function() {
              $(this).find('button[type="submit"]').attr('disabled', 'disabled');
          });

          // Initialize Select2 for PLN nama dropdown - PERBAIKAN WIDTH
          function initializeSelect2() {
              $('#nama-pln').select2({
                  theme: 'bootstrap-5',
                  placeholder: 'Pilih atau ketik nama anggota PLN',
                  allowClear: true,
                  width: '100%', // Explicit width setting
                  dropdownAutoWidth: false, // Disable auto width - KEY FIX
                  dropdownParent: $('#nama-field'), // Set parent container - KEY FIX
                  language: {
                      noResults: function() {
                          return "Tidak ada hasil yang ditemukan";
                      },
                      searching: function() {
                          return "Mencari...";
                      },
                      inputTooShort: function() {
                          return "Ketik untuk mencari nama";
                      },
                      loadingMore: function() {
                          return "Memuat lebih banyak hasil...";
                      },
                      maximumSelected: function() {
                          return "Anda hanya dapat memilih satu item";
                      }
                  },
                  escapeMarkup: function (markup) {
                      return markup;
                  },
                  templateResult: function(data) {
                      if (data.loading) {
                          return 'Mencari...';
                      }
                      
                      if (!data.id) {
                          return data.text;
                      }
                      
                      // Custom template untuk hasil pencarian dengan width constraint
                      var $result = $(
                          '<div class="select2-result-item">' +
                              '<div class="fw-medium text-truncate">' + data.text + '</div>' +
                          '</div>'
                      );
                      
                      return $result;
                  },
                  templateSelection: function(data) {
                      return data.text || data.placeholder;
                  }
              });
              
              // Force width adjustment after initialization - KEY FIX
              setTimeout(function() {
                  $('#nama-pln').next('.select2-container').css({
                      'width': '100%',
                      'max-width': '100%'
                  });
              }, 100);
          }

          // Function to toggle nama field based on company selection
          function toggleNamaField() {
              let unit = $('#unit').val();
              if (unit === 'PLN UIT JBM') {
                  // Hide regular input, show Select2 dropdown
                  $('#nama').addClass('d-none').prop('disabled', true);
                  $('#nama-pln').removeClass('d-none').prop('disabled', false);
                  $('#nama-helper').removeClass('d-none');

                  // Initialize Select2 if not already initialized
                  if (!$('#nama-pln').data('select2')) {
                      initializeSelect2();
                  }
              } else {
                  // Show regular input, hide Select2 dropdown
                  $('#nama').removeClass('d-none').prop('disabled', false);
                  $('#nama-pln').addClass('d-none').prop('disabled', true);
                  $('#nama-helper').addClass('d-none');
                  
                  // Destroy Select2 if it exists
                  if ($('#nama-pln').data('select2')) {
                      $('#nama-pln').select2('destroy');
                  }
              }
          }

          // Function to populate unit detail dropdown
          function populateUnitDropdown(companyName) {
              const company = companiesData.find(c => c.name === companyName);
              const selectElement = $('#unit_dtl_select');
              const inputElement = $('#unit_dtl_input');
              
              // Clear existing options
              selectElement.empty().append('<option value="">-- Pilih Unit --</option>');
              
              if (company && company.active_units && company.active_units.length > 0) {
                  // Company has predefined units - show dropdown
                  company.active_units.forEach(unit => {
                      // Check if old value matches to re-select the correct unit
                      const isSelected = "{{ old('unit_dtl') }}" === unit.name ? 'selected' : '';
                      selectElement.append(`<option value="${unit.name}" ${isSelected}>${unit.name}</option>`);
                  });
                  
                  selectElement.removeClass('d-none').prop('disabled', false).attr('required', true);
                  inputElement.addClass('d-none').prop('disabled', true).removeAttr('required');
              } else {
                  // No predefined units - show text input
                  selectElement.addClass('d-none').prop('disabled', true).removeAttr('required');
                  inputElement.removeClass('d-none').prop('disabled', false).attr('required', true);
              }
          }

          // Handle company selection change
          $('#unit').on('change', function() {
              const selectedCompany = $(this).val();
              
              // Toggle nama field
              toggleNamaField();
              
              // Populate unit dropdown
              if (selectedCompany) {
                  populateUnitDropdown(selectedCompany);
              } else {
                  // Hide both unit detail fields if no company selected
                  $('#unit_dtl_select').addClass('d-none').prop('disabled', true).removeAttr('required');
                  $('#unit_dtl_input').addClass('d-none').prop('disabled', true).removeAttr('required');
              }
          });

          // Initial setup
          toggleNamaField();
          if ($('#unit').val()) {
              populateUnitDropdown($('#unit').val());
          }

          // Autofill NIP dan Email saat pilih nama anggota PLN (for Select2)
          $('#nama-pln').on('change', function() {
              let selectedOption = $(this).find(':selected');
              let nip = selectedOption.data('nip') || '';
              let email = selectedOption.data('email') || '';
              $('#nip').val(nip);
              $('#email').val(email);
          });

          // Handle Select2 events
          $('#nama-pln').on('select2:select', function (e) {
              let data = e.params.data;
              let selectedOption = $(this).find('option[value="' + data.id + '"]');
              let nip = selectedOption.data('nip') || '';
              let email = selectedOption.data('email') || '';
              $('#nip').val(nip);
              $('#email').val(email);
          });

          $('#nama-pln').on('select2:clear', function (e) {
              $('#nip').val('');
              $('#email').val('');
          });

          // Handle window resize untuk responsive behavior - KEY FIX
          $(window).on('resize', function() {
              if ($('#nama-pln').hasClass('select2-hidden-accessible')) {
                  // Force width recalculation on resize
                  setTimeout(function() {
                      $('#nama-pln').next('.select2-container').css({
                          'width': '100%',
                          'max-width': '100%'
                      });
                  }, 100);
              }
              
              // Update swiper slide heights saat resize
              if (swiper && swiper.slides) {
                  // TIDAK PERLU lagi mengubah tinggi slide secara manual
                  swiper.update();
              }
          });
          
          // Handle Select2 events dengan width constraint - KEY FIX
          $('#nama-pln').on('select2:open', function(e) {
              // Ensure dropdown width doesn't exceed container
              setTimeout(function() {
                  var containerWidth = $('#nama-field').width();
                  $('.select2-dropdown').css({
                      'max-width': containerWidth + 'px',
                      'width': containerWidth + 'px'
                  });
              }, 10);
          });

          // Tambahkan event listener untuk memuat ulang gambar jika ada error
          $('.swiper-slide img').on('error', function() {
              console.log('Image failed to load:', this.src);
              $(this).closest('.swiper-slide').removeClass('loading');
              // Optionally show placeholder or retry loading
              $(this).attr('alt', 'Gambar tidak dapat dimuat');
          });

          // Preload images untuk performa yang lebih baik dan handle loading state
          $('.swiper-slide img').each(function() {
              const $img = $(this);
              const $slide = $img.closest('.swiper-slide');
              
              // Set initial loading state
              $slide.addClass('loading');
              
              // Create new image for preloading
              const img = new Image();
              img.onload = function() {
                  $slide.removeClass('loading');
                  $img.addClass('loaded');
              };
              img.onerror = function() {
                  $slide.removeClass('loading');
                  console.log('Preload failed for:', img.src);
              };
              img.src = this.src;
              
              // If already loaded
              if (this.complete && this.naturalHeight !== 0) {
                  $slide.removeClass('loading');
                  $img.addClass('loaded');
              }
          });
      });
  </script>

    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
  </body>  
</html>

@include('layouts.footer2')