@extends('layouts.main')

@section('content')
{{-- Link Font Awesome dihapus dari sini, seharusnya sudah ada di layouts.main --}}
<style>
    /* Reset and Box Sizing */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Main Container (pembungkus luar, Hadirin style) */
    .app-container { /* Mengubah modern-container menjadi app-container */
        width: 100%;
        max-width: 900px; /* Lebar maksimum disesuaikan untuk form yang luas, sama seperti Hadirin */
        margin: 20px auto; /* Margin atas/bawah otomatis untuk posisi tengah */
        padding: 0 20px; /* Padding samping untuk responsivitas */
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Font konsisten dengan Hadirin */
    }

    /* App Card (ini adalah wadah utama untuk header dan form, membuatnya terlihat sebagai satu kartu) */
    .hadirin-app-card { /* Mengubah modern-form-container menjadi hadirin-app-card */
        border: none;
        border-radius: 20px; /* Radius yang sama dengan Hadirin */
        box-shadow: 0 15px 45px rgba(0, 116, 182, 0.2); /* Bayangan sedang, nuansa biru Hadirin */
        backdrop-filter: blur(15px); /* Efek blur untuk menonjolkan form */
        background: rgba(255, 255, 255, 0.95); /* Latar putih semi-transparan */
        overflow: hidden;
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        min-height: 480px; /* Tinggi minimum agar terlihat solid */
        position: relative;
        animation: slideInUp 0.8s ease-out forwards; /* Animasi muncul */
        border: 1px solid rgba(0, 180, 216, 0.1); /* Border aksen sangat tipis */
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

    .hadirin-app-card:hover {
        box-shadow: 0 20px 55px rgba(0, 116, 182, 0.25);
        transform: translateY(-2px);
    }

    /* App Header (bagian atas kartu form) */
    .hadirin-app-header { /* Mengubah modern-header menjadi hadirin-app-header */
        background: linear-gradient(135deg, #00b4d8 0%, #0077b6 100%); /* Gradien biru Hadirin */
        color: white;
        padding: 2.2rem; /* Padding yang sama dengan Hadirin */
        text-align: center;
        position: relative;
        overflow: hidden;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1.5rem; /* Jarak antara judul dan tombol kembali */
    }

    .hadirin-app-header::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(45deg, transparent, rgba(255, 214, 10, 0.15), transparent); /* Efek shimmer kuning */
        transform: rotate(-45deg);
        animation: headerShimmer 4s infinite; /* Efek shimmer pada header */
    }

    @keyframes headerShimmer {
        0% { transform: translateX(-100%) translateY(-100%) rotate(-45deg); }
        100% { transform: translateX(100%) translateY(100%) rotate(-45deg); }
    }

    .hadirin-header-title { /* Mengubah header-title menjadi hadirin-header-title */
        font-weight: 700;
        font-size: 2rem; /* Ukuran font lebih besar */
        margin: 0;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        gap: 1rem;
        flex-grow: 1;
        justify-content: center; /* Pusatkan judul */
    }

    .header-subtitle { /* Gaya untuk sub judul di bawah header-title, jika ada */
        font-size: 0.95rem; /* Ukuran font yang disesuaikan */
        opacity: 0.9;
        margin-top: 0.5rem;
        font-weight: 400;
        text-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        position: relative;
        z-index: 1;
    }

    /* Tombol Kembali di Header */
    .hadirin-header-btn { /* Mengubah header-back-btn menjadi hadirin-header-btn */
        background: rgba(255, 255, 255, 0.25); /* Agak lebih solid */
        border: none;
        color: white;
        padding: 0.8rem 1.8rem; /* Padding lebih besar */
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        text-decoration: none;
        font-size: 0.95rem;
        backdrop-filter: blur(8px); /* Sedikit mengurangi blur */
        z-index: 1; /* Pastikan di atas shimmer */
    }

    .hadirin-header-btn:hover {
        background: rgba(255, 255, 255, 0.4); /* Lebih terang saat hover */
        color: white;
        text-decoration: none;
        transform: translateY(-2px);
    }

    /* App Body (bagian form itu sendiri) */
    .hadirin-app-body { /* Menambahkan ini untuk membungkus form */
        padding: 2.5rem;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(248, 249, 255, 0.98) 100%); /* Latar form yang sangat terang */
        position: relative;
        overflow: hidden;
    }

    /* Header Bagian (misalnya "Informasi Anggota") */
    .hadirin-section-header { /* Mengubah section-header dan slide-settings-header menjadi hadirin-section-header */
        display: flex;
        align-items: center;
        margin-bottom: 2rem; /* Jarak lebih besar */
        padding-bottom: 0.8rem; /* Padding bawah */
        border-bottom: 2px solid rgba(0, 180, 216, 0.1); /* Garis bawah yang lebih jelas tapi tidak terlalu tebal */
        gap: 1rem;
    }

    .hadirin-section-icon { /* Mengubah section-icon menjadi hadirin-section-icon */
        width: 42px; /* Ukuran ikon sedikit lebih besar */
        height: 42px;
        background: linear-gradient(135deg, #00b4d8, #0077b6); /* Gradien biru */
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 19px; /* Ukuran font ikon */
        box-shadow: 0 4px 10px rgba(0, 116, 182, 0.2); /* Bayangan untuk ikon */
    }

    .hadirin-section-title { /* Mengubah section-title dan slide-settings-title menjadi hadirin-section-title */
        font-size: 1.7rem; /* Ukuran font lebih besar */
        font-weight: 700;
        color: #0077b6; /* Warna biru gelap */
        margin: 0;
    }

    /* Grid Form */
    .form-grid {
        display: grid;
        gap: 1.8rem; /* Jarak antar grup form */
        margin-bottom: 2.5rem; /* Jarak bawah sebelum tombol */
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem; /* Jarak antar kolom dalam satu baris */
    }

    .form-row.single {
        grid-template-columns: 1fr;
    }

    .form-row.triple { /* Tambahan untuk layout 3 kolom */
        grid-template-columns: 1fr 1fr 1fr;
    }

    .form-row.split { /* Tambahan untuk layout split (2fr 1fr) */
        grid-template-columns: 2fr 1fr;
    }

    /* Grup Form (label dan input) */
    .form-group { /* Menggunakan nama umum agar lebih fleksibel */
        display: flex;
        flex-direction: column;
    }

    .hadirin-label { /* Mengubah form-label menjadi hadirin-label */
        font-weight: 600;
        color: #1a1a1a; /* Warna biru Hadirin */
        margin-bottom: 0.6rem; /* Jarak bawah label */
        font-size: 0.98rem; /* Ukuran font label */
        display: block;
    }

    .hadirin-label .optional {
        font-size: 0.85rem;
        color: #70757a;
        font-weight: 400;
        margin-left: 0.5rem;
    }

    .hadirin-input { /* Mengubah form-control menjadi hadirin-input */
        border: 2px solid #a8dadc; /* Border lebih tebal dan warna Hadirin */
        border-radius: 12px; /* Radius lebih besar */
        padding: 0.9rem 1.1rem; /* Padding lebih besar */
        font-size: 1rem;
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.95); /* Background input semi-transparan */
        width: 100%;
        color: #3c4043; /* Warna teks gelap */
    }

    .hadirin-input:focus {
        outline: none;
        border-color: #00b4d8; /* Warna biru Hadirin saat fokus */
        box-shadow: 0 0 0 0.2rem rgba(0, 180, 216, 0.18); /* Bayangan fokus lebih solid */
        background: white;
        transform: translateY(-1px);
    }

    .hadirin-input:hover {
        border-color: #00b4d8;
        background: white;
    }

    .hadirin-input::placeholder { /* Menyesuaikan placeholder */
        color: #9aa0a6;
    }

    /* Pesan Error */
    .invalid-feedback { /* Menggunakan nama umum */
        font-size: 0.88rem; /* Ukuran font pesan error */
        margin-top: 0.4rem; /* Jarak atas pesan error */
        color: #dc3545; /* Warna merah standard */
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }
    .invalid-feedback::before {
        content: '⚠️'; /* Tambahkan emoji peringatan */
        font-size: 0.85rem;
    }
    .is-invalid {
        border-color: #dc3545 !important;
    }
    .is-invalid:focus {
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.18); /* Bayangan fokus untuk error */
    }

    .form-helper {
        font-size: 0.85rem;
        color: #70757a;
        margin-top: 0.4rem;
    }

    /* Switch Component */
    .switch-container {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        margin-top: 0.5rem;
    }

    .switch {
        position: relative;
        display: inline-block;
        width: 45px;
        height: 25px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: #ccc;
        transition: 0.3s;
        border-radius: 25px;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 19px;
        width: 19px;
        left: 3px;
        bottom: 3px;
        background: white;
        transition: 0.3s;
        border-radius: 50%;
    }

    input:checked + .slider {
        background: #00b4d8; /* Warna Hadirin saat aktif */
    }

    input:checked + .slider:before {
        transform: translateX(20px);
    }

    .switch-label {
        font-size: 0.95rem;
        font-weight: 500;
        color: #3c4043;
    }

    /* File Upload */
    .file-upload-container {
        position: relative;
    }

    .file-upload {
        position: relative;
        display: inline-block;
        cursor: pointer;
        width: 100%;
    }

    .file-upload input[type="file"] {
        position: absolute;
        left: -9999px;
    }

    .file-upload-label {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0.9rem 1.1rem;
        border: 2px dashed #a8dadc; /* Border dashed Hadirin */
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.95);
        cursor: pointer;
        transition: all 0.3s ease;
        gap: 0.8rem;
        font-size: 1rem;
        color: #3c4043;
        font-weight: 500;
    }

    .file-upload-label:hover {
        border-color: #00b4d8; /* Border Hadirin saat hover */
        background: rgba(0, 180, 216, 0.05); /* Latar belakang Hadirin saat hover */
    }

    .file-upload-label i {
        color: #00b4d8; /* Warna ikon Hadirin */
        font-size: 1.1rem;
    }


    /* Action Buttons */
    .action-buttons {
        display: flex;
        justify-content: flex-end;
        gap: 1.2rem; /* Jarak antar tombol */
        margin-top: 3rem; /* Jarak atas dari form */
        padding-top: 1.8rem; /* Padding atas untuk garis pemisah */
        border-top: 1px solid rgba(0, 180, 216, 0.1); /* Garis pemisah Hadirin */
    }

    .hadirin-btn { /* Gaya dasar tombol, mengganti btn-modern */
        padding: 0.9rem 2.2rem; /* Padding lebih besar */
        border: none;
        border-radius: 12px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.6rem; /* Jarak ikon dengan teks */
        text-decoration: none;
        font-family: inherit;
    }

    .hadirin-btn-primary { /* Mengubah btn-primary menjadi hadirin-btn-primary */
        background: linear-gradient(135deg, #00b4d8 0%, #0077b6 100%); /* Gradien biru Hadirin */
        color: white;
        box-shadow: 0 6px 20px rgba(0, 180, 216, 0.3);
        position: relative;
        overflow: hidden;
    }

    .hadirin-btn-primary::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 214, 10, 0.3), transparent); /* Efek shimmer kuning */
        transition: left 0.6s ease;
    }

    .hadirin-btn-primary:hover::before {
        left: 100%;
    }

    .hadirin-btn-primary:hover {
        background: linear-gradient(135deg, #0096c7 0%, #005577 100%); /* Warna sedikit lebih gelap saat hover */
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 180, 216, 0.4);
    }

    .hadirin-btn-primary:active {
        transform: translateY(0);
        box-shadow: 0 4px 15px rgba(0, 180, 216, 0.2);
    }

    .hadirin-btn-secondary { /* Mengubah btn-secondary menjadi hadirin-btn-secondary */
        background: none;
        border: 2px solid #00b4d8; /* Border biru Hadirin */
        color: #00b4d8; /* Warna teks biru Hadirin */
    }

    .hadirin-btn-secondary:hover {
        background: #e0f2f7; /* Latar belakang sangat terang saat hover */
        border-color: #0077b6; /* Border lebih gelap saat hover */
        color: #0077b6; /* Teks lebih gelap saat hover */
        transform: translateY(-1px);
        box-shadow: 0 4px 10px rgba(0, 180, 216, 0.1);
    }

    /* Section spacing */
    .section-divider {
        height: 2rem; /* Menyesuaikan tinggi divider */
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .app-container {
            margin: 10px;
            padding: 0 10px;
        }

        .hadirin-app-card {
            min-height: auto; /* Biarkan tinggi menyesuaikan konten */
            border-radius: 15px; /* Radius sedikit lebih kecil */
        }

        .hadirin-app-header {
            padding: 1.8rem;
            flex-direction: column;
            align-items: stretch;
            gap: 1rem;
        }

        .hadirin-header-title {
            font-size: 1.6rem;
            text-align: center;
            justify-content: center;
            margin-bottom: 0.5rem;
        }

        .hadirin-header-btn {
            width: 100%;
        }

        .hadirin-app-body {
            padding: 1.8rem;
        }

        .form-row,
        .form-row.split,
        .form-row.triple { /* Tambahan untuk responsivitas grid */
            grid-template-columns: 1fr;
            gap: 1.2rem;
        }

        .hadirin-section-header {
            flex-direction: column;
            align-items: flex-start; /* Sejajarkan ke kiri di mobile */
            gap: 0.8rem;
            margin-bottom: 1.5rem;
        }

        .hadirin-section-title {
            font-size: 1.5rem;
        }

        .action-buttons {
            flex-direction: column;
            gap: 1rem;
        }

        .hadirin-btn {
            width: 100%;
            padding: 0.8rem 1.5rem;
            font-size: 0.95rem;
        }

        .section-divider {
            height: 1.5rem; /* Menyesuaikan tinggi divider di mobile */
        }
    }

    @media (max-width: 480px) {
        .hadirin-app-header h1 {
            font-size: 1.4rem;
        }

        .hadirin-header-btn,
        .hadirin-btn {
            font-size: 0.88rem;
        }

        .hadirin-section-title {
            font-size: 1.3rem;
        }

        .hadirin-input, .file-upload-label { /* Menyesuaikan input dan file upload label */
            padding: 0.7rem 0.9rem;
            font-size: 0.9rem;
        }

        .hadirin-label {
            font-size: 0.9rem;
        }

        .form-helper, .invalid-feedback {
            font-size: 0.8rem;
        }

        .switch-label {
            font-size: 0.85rem;
        }

        .slider:before {
            height: 17px;
            width: 17px;
            left: 2px;
            bottom: 2px;
        }

        input:checked + .slider:before {
            transform: translateX(23px); /* Menyesuaikan translasi slider */
        }
    }
</style>

<div class="app-container">
    <div class="hadirin-app-card"> {{-- Ini adalah satu kartu utama yang membungkus seluruh konten --}}
        <div class="hadirin-app-header">
            {{-- Konten header berada di dalam kartu yang sama --}}
            <div class="header-content">
                <h1 class="hadirin-header-title">
                    <i class="fas fa-plus-circle"></i>
                    Tambah Kegiatan Baru
                </h1>
                <p class="header-subtitle">Buat kegiatan dan atur sistem presensi</p>
            </div>
            <a href="{{ route('presence.index') }}" class="hadirin-header-btn">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>
        </div>

        <div class="hadirin-app-body"> {{-- Ini adalah bagian body kartu yang berisi form --}}
            <form action="{{ route('presence.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="hadirin-section-header">
                    <div class="hadirin-section-icon">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <h3 class="hadirin-section-title">Informasi Kegiatan</h3>
                </div>

                <div class="form-grid">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="nama_kegiatan" class="hadirin-label">
                                Nama Kegiatan <span style="color: #dc3545;">*</span>
                            </label>
                            <input type="text"
                                   class="hadirin-input @error('nama_kegiatan') is-invalid @enderror"
                                   name="nama_kegiatan"
                                   id="nama_kegiatan"
                                   value="{{ old('nama_kegiatan') }}"
                                   placeholder="Masukkan nama kegiatan">
                            @error('nama_kegiatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tgl_kegiatan" class="hadirin-label">
                                Tanggal Kegiatan <span style="color: #dc3545;">*</span>
                            </label>
                            <input type="date"
                                   class="hadirin-input @error('tgl_kegiatan') is-invalid @enderror"
                                   name="tgl_kegiatan"
                                   id="tgl_kegiatan"
                                   value="{{ old('tgl_kegiatan') }}">
                            @error('tgl_kegiatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="waktu_mulai" class="hadirin-label">
                                Waktu Mulai <span style="color: #dc3545;">*</span>
                            </label>
                            <input type="time"
                                   class="hadirin-input @error('waktu_mulai') is-invalid @enderror"
                                   name="waktu_mulai"
                                   id="waktu_mulai"
                                   value="{{ old('waktu_mulai') }}">
                            @error('waktu_mulai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="batas_waktu" class="hadirin-label">
                                Batas Waktu Absen <span class="optional">(opsional)</span>
                            </label>
                            <input type="datetime-local"
                                   class="hadirin-input"
                                   name="batas_waktu"
                                   id="batas_waktu"
                                   value="{{ old('batas_waktu') }}">
                        </div>
                    </div>

                    <div class="form-row split">
                        <div class="form-group">
                            <label for="lokasi" class="hadirin-label">
                                Lokasi <span style="color: #dc3545;">*</span>
                            </label>
                            <input type="text"
                                   class="hadirin-input @error('lokasi') is-invalid @enderror"
                                   name="lokasi"
                                   id="lokasi"
                                   placeholder="Contoh: Zoom Meeting, Auditorium Utama"
                                   value="{{ old('lokasi') }}">
                            @error('lokasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="hadirin-label">Status Kegiatan</label>
                            <div class="switch-container">
                                <label class="switch">
                                    <input type="checkbox" name="is_active" id="is_active" {{ old('is_active', true) ? 'checked' : '' }}>
                                    <span class="slider"></span>
                                </label>
                                <span class="switch-label">Aktifkan sistem presensi</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-row single">
                        <div class="form-group">
                            <label for="link_lokasi" class="hadirin-label">
                                Link Lokasi <span class="optional">(jika ada)</span>
                            </label>
                            <input type="url"
                                   class="hadirin-input @error('link_lokasi') is-invalid @enderror"
                                   name="link_lokasi"
                                   id="link_lokasi"
                                   placeholder="https://..."
                                   value="{{ old('link_lokasi') }}">
                            <div class="form-helper">Masukkan link Zoom, Google Meet, atau lokasi digital lainnya</div>
                            @error('link_lokasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="section-divider"></div>

                <div class="hadirin-section-header">
                    <div class="hadirin-section-icon">
                        <i class="fas fa-palette"></i>
                    </div>
                    <h3 class="hadirin-section-title">Pengaturan Tampilan</h3>
                </div>

                <div class="form-grid">
                    <div class="form-row single">
                        <div class="form-group">
                            <label for="judul_header" class="hadirin-label">Judul Header</label>
                            <input type="text"
                                   class="hadirin-input"
                                   name="judul_header"
                                   id="judul_header"
                                   value="{{ old('judul_header') }}"
                                   placeholder="Masukkan judul header">
                            <div class="form-helper">Judul ini akan tampil di bagian atas halaman presensi</div>
                        </div>
                    </div>

                    <div class="form-row triple">
                        <div class="form-group">
                            <label for="logo_kiri" class="hadirin-label">Logo Kiri</label>
                            <div class="file-upload">
                                <input type="file" name="logo_kiri" id="logo_kiri" accept="image/*">
                                <label for="logo_kiri" class="file-upload-label">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    Pilih File
                                </label>
                            </div>
                            <div class="form-helper">Format: JPG, PNG, GIF</div>
                        </div>

                        <div class="form-group">
                            <label for="logo_kanan" class="hadirin-label">Logo Kanan</label>
                            <div class="file-upload">
                                <input type="file" name="logo_kanan" id="logo_kanan" accept="image/*">
                                <label for="logo_kanan" class="file-upload-label">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    Pilih File
                                </label>
                            </div>
                            <div class="form-helper">Format: JPG, PNG, GIF</div>
                        </div>

                        <div class="form-group">
                            <label for="logo_ig" class="hadirin-label">Logo Instagram</label>
                            <div class="file-upload">
                                <input type="file" name="logo_ig" id="logo_ig" accept="image/*">
                                <label for="logo_ig" class="file-upload-label">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    Pilih File
                                </label>
                            </div>
                            <div class="form-helper">Format: JPG, PNG, GIF</div>
                        </div>
                    </div>

                    <div class="form-row single">
                        <div class="form-group">
                            <label for="link_ig" class="hadirin-label">Username Instagram</label>
                            <input type="text"
                                   class="hadirin-input"
                                   name="link_ig"
                                   id="link_ig"
                                   placeholder="misal: eltrafo"
                                   value="{{ old('link_ig') }}">
                            <div class="form-helper">Username Instagram tanpa tanda @</div>
                        </div>
                    </div>
                </div>

                <div class="section-divider"></div>

                @include('pages.presence.partials.slide-settings')

                <div class="action-buttons">
                    <a href="{{ route('presence.index') }}" class="hadirin-btn hadirin-btn-secondary">
                        <i class="fas fa-times"></i>
                        Batal
                    </a>
                    <button type="submit" class="hadirin-btn hadirin-btn-primary">
                        <i class="fas fa-save"></i>
                        Simpan Kegiatan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // File upload labels update
    const fileInputs = document.querySelectorAll('input[type="file"]');

    fileInputs.forEach(input => {
        input.addEventListener('change', function() {
            const label = this.nextElementSibling;
            const fileName = this.files[0]?.name;

            if (fileName) {
                label.innerHTML = `<i class="fas fa-check"></i>${fileName}`;
                // Mengubah warna border dan background sesuai tema Hadirin
                label.style.borderColor = '#00b4d8'; // Warna border Hadirin
                label.style.background = 'rgba(0, 180, 216, 0.1)'; // Latar belakang Hadirin
            } else {
                label.innerHTML = '<i class="fas fa-cloud-upload-alt"></i>Pilih File';
                label.style.borderColor = '#a8dadc'; // Warna border default Hadirin
                label.style.background = 'rgba(255, 255, 255, 0.95)'; // Background default Hadirin
            }
        });
    });
});
</script>
@endsection