<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css">
    <style>
        /* Body and Background */
        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
        }

        /* Container Enhancement */
        /* .container {
            max-width: 1400px;
        } */

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
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
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
            width: 100%; /* Ensure the table itself takes full width */
            table-layout: fixed; /* Important for exact column widths */
        }

        .detail-table td {
            padding: 0.75rem 0;
            border: none;
            font-size: 1rem;
            vertical-align: top; /* Align content to the top */
        }

        .detail-table td:first-child {
            font-weight: 600;
            color: #0077b6;
            min-width: 25px;
        }

        .detail-table td:nth-child(2) {
            width: 20px; /* Adjust width of the colon column, make it slightly wider if needed */
            text-align: center; /* Center the colon */
            padding-left: 0; /* Remove extra padding */
            padding-right: 0; /* Remove extra padding */
        }

        .detail-table td:last-child {
            color: #333;
            width: 75%; /* The remaining width for the details */
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

        /* Carousel Styling */
        .carousel-item {
            position: relative;
            padding-top: 56.25%;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 10px;
            overflow: hidden;
        }

        .carousel-item img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 10px;
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 5%;
            opacity: 0.8;
        }

        .carousel-control-prev:hover,
        .carousel-control-next:hover {
            opacity: 1;
        }

        .carousel-indicators button {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: #ffd60a;
            border: 2px solid white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
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

        /* Table Responsive */

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

        /* Responsive Design */
        @media (max-width: 768px) {
            .header-logos {
                flex-direction: column;
                gap: 1rem;
            }

            .header-title {
                font-size: 1.5rem;
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
    </style>
  </head>
  <body>
    
    <div class="container my-5">

      <!-- Header -->
      <div class="card header-card mb-4">
        <div class="card-body">
          <div class="header-logos">
            <img src="{{ $presence->logo_kiri ? asset('uploads/' . $presence->logo_kiri) : asset('default-logo-kiri.png') }}" height="120" alt="Logo Kiri">
              <div class="text-center">
                  <h2 class="header-title d-block fw-bold">{{ $presence->judul_header_atas ?? 'ABSENSI ONLINE' }}</h2>
                  <h3 class="d-block">{{ $presence->judul_header_bawah ?? '' }}</h3>
              </div>
            <img src="{{ $presence->logo_kanan ? asset('uploads/' . $presence->logo_kanan) : asset('default-logo-kanan.png') }}" height="120" alt="Logo Kanan">
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
                {{-- <td>{{ date('d F Y', strtotime($presence->tgl_kegiatan)) }}</td> --}}
                @php
                  \Carbon\Carbon::setLocale('id');
                  $tanggalKegiatan = \Carbon\Carbon::parse($presence->tgl_kegiatan)->translatedFormat('d F Y');
              @endphp
              <td>{{ $tanggalKegiatan }}</td>
              </tr>
              <tr>
                <td>Waktu Mulai</td>
                <td>:</td>
                {{-- <td>{{ date('H:i', strtotime($presence->tgl_kegiatan)) }} WIB</td> --}}
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

      <!-- Main Grid -->
      <div class="row">
        <!-- Kiri: Form Absensi -->
        <div class="col-md-4 mb-4">
          <div class="card h-100">
            <div class="card-header">
              <h5 class="card-title">Form Absensi</h5>
            </div>
            <div class="card-body">
              <form id="form-absen" action="{{ route('absen.save', $presence->id) }}" method="post">
                @csrf
                <!-- Unit -->
                <div class="mb-3">
                  <label for="unit" class="form-label">Unit/Nama Perusahaan</label>
                  <select name="unit" id="unit" class="form-select" required>
                      <option value="">-- Pilih Kategori Peserta --</option>
                      <option value="PLN">PLN</option>
                      <option value="PLN Group">PLN Group</option>
                      <option value="Non PLN">Non PLN</option>
                  </select>
                    @error('unit')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Nama -->
                <div class="mb-3" id="nama-field">
                  <label for="nama" class="form-label">Nama</label>
                  <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama lengkap">
                  <select class="form-select d-none" id="nama-pln" name="nama" disabled>
                    <option value="">-- Pilih Anggota PLN --</option>
                    @foreach($plnMembers as $member)
                      <option value="{{ $member->nama }}" data-nip="{{ $member->nip }}" data-email="{{ $member->email }}">
                        {{ $member->nama }}
                      </option>
                    @endforeach
                  </select>
                  <small id="nama-helper" class="text-muted d-none">Pilih nama anggota PLN</small>
                    @error('nama')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- NIP -->
                <div class="mb-3">
                  <label for="nip" class="form-label">NIP</label>
                  <input type="text" class="form-control" id="nip" name="nip" placeholder="Masukkan NIP">
                    @error('nip')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email">
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Jabatan -->
                <div class="mb-3">
                  <label for="jabatan" class="form-label">Jabatan</label>
                  <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Masukkan jabatan">
                    @error('jabatan')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- No HP -->
                <div class="mb-3">
                  <label for="no_hp" class="form-label">No HP</label>
                  <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="Masukkan nomor HP">
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
        <div class="col-md-8">
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
                  <div id="slideCarousel-{{ $presence->id }}" class="carousel slide mb-3" data-bs-ride="carousel" data-bs-interval="8000">
                    <div class="carousel-indicators">
                      @foreach ($presence->slides as $key => $slide)
                        <button type="button" data-bs-target="#slideCarousel-{{ $presence->id }}" data-bs-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}" aria-current="{{ $key == 0 ? 'true' : 'false' }}" aria-label="Slide {{ $key+1 }}"></button>
                      @endforeach
                    </div>
                    <div class="carousel-inner">
                      @foreach ($presence->slides as $key => $slide)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                          <img src="{{ asset('uploads/' . $slide->image_path) }}" class="d-block w-100" alt="Slide {{ $key+1 }}">
                        </div>
                      @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#slideCarousel-{{ $presence->id }}" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#slideCarousel-{{ $presence->id }}" data-bs-slide="next">
                      <span class="carousel-control-next-icon"></span>
                    </button>
                  </div>
                @endif

                @if ($presence->logo_ig && $presence->link_ig)
                  <div class="text-center mt-3">
                    <a href="{{ $presence->link_ig }}" target="_blank" class="instagram-link">
                      <img src="{{ asset('uploads/' . $presence->logo_ig) }}" height="50" alt="Instagram">
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
      <!-- End row -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="{{ asset('js/signature.min.js') }}"></script>

    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.bootstrap5.js"></script>

    <script>
      $(function() {
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

        // Logika untuk PLN - autofill data anggota
        function toggleNamaField() {
            let unit = $('#unit').val();
            if (unit === 'PLN') {
                $('#nama').addClass('d-none').prop('disabled', true);
                $('#nama-pln').removeClass('d-none').prop('disabled', false);
                $('#nama-helper').removeClass('d-none');
            } else {
                $('#nama').removeClass('d-none').prop('disabled', false);
                $('#nama-pln').addClass('d-none').prop('disabled', true);
                $('#nama-helper').addClass('d-none');
            }
        }

        toggleNamaField();
        $('#unit').on('change', toggleNamaField);

        // Autofill NIP dan Email saat pilih nama anggota PLN
        $('#nama-pln').on('change', function() {
            let nip = $(this).find(':selected').data('nip') || '';
            let email = $(this).find(':selected').data('email') || '';
            $('#nip').val(nip);
            $('#email').val(email);
        });
      });
    </script>
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
  </body>  
</html>
