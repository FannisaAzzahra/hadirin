@extends('layouts.main')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<style>
    /* Reset and Box Sizing */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Main Container */
    .modern-container {
        max-width: 1000px; /* Meningkatkan max-width agar lebih lebar seperti halaman create */
        margin: 20px auto; /* Menyesuaikan margin */
        padding: 0 20px; /* Menyesuaikan padding */
        font-family: -apple-system, BlinkMacMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    /* Header */
    .modern-header {
        background: linear-gradient(135deg, #4285f4, #34a853);
        border-radius: 15px 15px 0 0;
        padding: 30px; /* Menyesuaikan padding */
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px; /* Menyesuaikan gap */
    }

    .header-content {
        flex: 1;
    }

    .header-title {
        font-size: 28px; /* Meningkatkan ukuran font */
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 12px; /* Menyesuaikan gap */
    }

    .header-subtitle {
        font-size: 16px; /* Meningkatkan ukuran font */
        opacity: 0.9;
        margin-top: 8px; /* Menyesuaikan margin */
        font-weight: 400;
    }

    .header-back-btn {
        background: rgba(255, 255, 255, 0.2);
        border: none;
        color: white;
        padding: 12px 25px; /* Menyesuaikan padding */
        border-radius: 10px;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 8px; /* Menyesuaikan gap */
        font-weight: 500;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }

    .header-back-btn:hover {
        background: rgba(255, 255, 255, 0.3);
        color: white;
        text-decoration: none;
        transform: translateY(-2px); /* Menyesuaikan efek hover */
    }

    /* Form Container */
    .modern-form-container {
        background: #ffffff;
        border-radius: 0 0 15px 15px;
        padding: 40px; /* Menyesuaikan padding */
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1); /* Menyesuaikan shadow */
        position: relative;
        top: -1px;
    }

    /* Section Header */
    .slide-settings-header {
        display: flex;
        align-items: center;
        margin-bottom: 30px; /* Menyesuaikan margin */
        gap: 15px; /* Menyesuaikan gap */
        padding: 12px 20px; /* Menyesuaikan padding */
        background-color: #e0f2f7;
        border-radius: 10px;
    }

    .section-icon {
        width: 45px; /* Menyesuaikan ukuran ikon */
        height: 45px; /* Menyesuaikan ukuran ikon */
        background: linear-gradient(135deg, #4285f4, #34a853);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 20px; /* Menyesuaikan ukuran ikon */
    }

    .slide-settings-title {
        font-size: 22px; /* Meningkatkan ukuran font */
        font-weight: 600;
        color: #1a1a1a;
        margin: 0;
    }

    /* Form Grid */
    .form-grid {
        display: grid;
        gap: 25px; /* Menyesuaikan gap */
        margin-bottom: 30px; /* Menyesuaikan margin */
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px; /* Menyesuaikan gap */
    }

    .form-row.single {
        grid-template-columns: 1fr;
    }

    .form-row.triple {
        grid-template-columns: 1fr 1fr 1fr;
    }

    .form-row.split {
        grid-template-columns: 2fr 1fr;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-label {
        font-size: 15px; /* Meningkatkan ukuran font */
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 8px; /* Menyesuaikan margin */
        display: flex;
        align-items: center;
        gap: 8px; /* Menyesuaikan gap */
    }

    .form-label .optional {
        font-size: 13px; /* Meningkatkan ukuran font */
        color: #70757a;
        font-weight: 400;
    }

    .form-control {
        padding: 14px; /* Menyesuaikan padding */
        border: 1px solid #dadce0;
        border-radius: 8px;
        font-size: 15px; /* Meningkatkan ukuran font */
        color: #3c4043;
        background: white;
        transition: all 0.3s ease;
        font-family: inherit;
    }

    .form-control:focus {
        outline: none;
        border-color: #4285f4;
        box-shadow: 0 0 0 4px rgba(66, 133, 244, 0.15); /* Menyesuaikan shadow */
    }

    .form-control.is-invalid {
        border-color: #ea4335;
    }

    .form-control.is-invalid:focus {
        box-shadow: 0 0 0 4px rgba(234, 67, 53, 0.15); /* Menyesuaikan shadow */
    }

    .form-control::placeholder {
        color: #9aa0a6;
    }

    .invalid-feedback {
        color: #ea4335;
        font-size: 13px; /* Meningkatkan ukuran font */
        margin-top: 6px; /* Menyesuaikan margin */
        display: flex;
        align-items: center;
        gap: 6px; /* Menyesuaikan gap */
    }

    .invalid-feedback::before {
        content: '⚠️';
        font-size: 12px; /* Meningkatkan ukuran font */
    }

    .form-helper {
        font-size: 13px; /* Meningkatkan ukuran font */
        color: #70757a;
        margin-top: 6px; /* Menyesuaikan margin */
    }

    /* Switch Component */
    .switch-container {
        display: flex;
        align-items: center;
        gap: 12px; /* Menyesuaikan gap */
        margin-top: 8px; /* Menyesuaikan margin */
    }

    .switch {
        position: relative;
        display: inline-block;
        width: 50px; /* Meningkatkan lebar */
        height: 28px; /* Meningkatkan tinggi */
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
        border-radius: 28px; /* Menyesuaikan border-radius */
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 20px; /* Meningkatkan ukuran */
        width: 20px; /* Meningkatkan ukuran */
        left: 4px; /* Menyesuaikan posisi */
        bottom: 4px; /* Menyesuaikan posisi */
        background: white;
        transition: 0.3s;
        border-radius: 50%;
    }

    input:checked + .slider {
        background: #4285f4;
    }

    input:checked + .slider:before {
        transform: translateX(22px); /* Menyesuaikan translasi */
    }

    .switch-label {
        font-size: 15px; /* Meningkatkan ukuran font */
        font-weight: 500;
        color: #1a1a1a;
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
        padding: 14px; /* Menyesuaikan padding */
        border: 1px dashed #dadce0;
        border-radius: 8px;
        background: #f8f9fa;
        cursor: pointer;
        transition: all 0.3s ease;
        gap: 8px; /* Menyesuaikan gap */
        font-size: 15px; /* Meningkatkan ukuran font */
        color: #3c4043;
        font-weight: 500;
    }

    .file-upload-label:hover {
        border-color: #4285f4;
        background: rgba(66, 133, 244, 0.05); /* Menyesuaikan background on hover */
    }

    .file-upload-label i {
        color: #4285f4;
        font-size: 18px; /* Meningkatkan ukuran font */
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        justify-content: flex-end;
        gap: 15px; /* Menyesuaikan gap */
        margin-top: 35px; /* Menyesuaikan margin */
        padding-top: 25px; /* Menyesuaikan padding */
        border-top: 1px solid #e8eaed;
    }

    .btn-modern {
        padding: 14px 28px; /* Menyesuaikan padding */
        border: none;
        border-radius: 10px;
        font-size: 15px; /* Meningkatkan ukuran font */
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px; /* Menyesuaikan gap */
        text-decoration: none;
        font-family: inherit;
    }

    .btn-primary {
        background: linear-gradient(135deg, #4285f4, #34a853);
        color: white;
        box-shadow: 0 3px 12px rgba(66, 133, 244, 0.3); /* Menyesuaikan shadow */
    }

    .btn-primary:hover {
        transform: translateY(-2px); /* Menyesuaikan lift */
        box-shadow: 0 4px 18px rgba(66, 133, 244, 0.4); /* Menyesuaikan shadow */
        color: white;
        text-decoration: none;
    }

    .btn-secondary {
        background: white;
        color: #5f6368;
        border: 1px solid #dadce0;
    }

    .btn-secondary:hover {
        background: #f8f9fa;
        border-color: #4285f4;
        color: #4285f4;
        text-decoration: none;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .modern-container {
            margin: 15px;
            padding: 0 15px;
        }

        .modern-header {
            padding: 25px 20px; /* Menyesuaikan padding */
            flex-direction: column;
            align-items: stretch;
            gap: 15px; /* Menyesuaikan gap */
        }

        .header-title {
            font-size: 24px; /* Menyesuaikan ukuran font */
        }

        .modern-form-container {
            padding: 25px 20px; /* Menyesuaikan padding */
        }

        .form-row,
        .form-row.split,
        .form-row.triple {
            grid-template-columns: 1fr;
            gap: 20px; /* Menyesuaikan gap */
        }

        .action-buttons {
            flex-direction: column;
            gap: 12px; /* Menyesuaikan gap */
        }

        .btn-modern {
            width: 100%;
            justify-content: center;
        }
    }

    /* Section spacing */
    .section-divider {
        height: 40px; /* Meningkatkan tinggi */
    }

    /* Existing image style, adjusted for consistency */
    .img-preview {
        max-height: 90px; /* Menyesuaikan ukuran gambar */
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid #dadce0;
        margin-top: 10px; /* Menyesuaikan margin */
    }
</style>

<div class="modern-container">
    <div class="modern-header">
        <div class="header-content">
            <h1 class="header-title">
                <i class="fas fa-edit"></i>
                Edit Kegiatan
            </h1>
            <p class="header-subtitle">Ubah detail kegiatan dan pengaturan presensi</p>
        </div>
        <a href="{{ route('presence.index') }}" class="header-back-btn">
            <i class="fas fa-arrow-left"></i>
            Kembali
        </a>
    </div>

    <div class="modern-form-container">
        <form action="{{ route('presence.update', $presence->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')

            {{-- Informasi Kegiatan Section Header --}}
            <div class="slide-settings-header">
                <div class="section-icon">
                    <i class="fas fa-info-circle"></i>
                </div>
                <h3 class="slide-settings-title">Informasi Kegiatan</h3>
            </div>

            <div class="form-grid">
                <div class="form-row">
                    <div class="form-group">
                        <label for="nama_kegiatan" class="form-label">
                            Nama Kegiatan <span style="color: #ea4335;">*</span>
                        </label>
                        <input type="text"
                               class="form-control @error('nama_kegiatan') is-invalid @enderror"
                               name="nama_kegiatan"
                               id="nama_kegiatan"
                               value="{{ old('nama_kegiatan', $presence->nama_kegiatan) }}"
                               placeholder="Masukkan nama kegiatan">
                        @error('nama_kegiatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tgl_kegiatan" class="form-label">
                            Tanggal Kegiatan <span style="color: #ea4335;">*</span>
                        </label>
                        <input type="date"
                               class="form-control @error('tgl_kegiatan') is-invalid @enderror"
                               name="tgl_kegiatan"
                               id="tgl_kegiatan"
                               value="{{ old('tgl_kegiatan', date('Y-m-d', strtotime($presence->tgl_kegiatan))) }}">
                        @error('tgl_kegiatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="waktu_mulai" class="form-label">
                            Waktu Mulai <span style="color: #ea4335;">*</span>
                        </label>
                        <input type="time"
                               class="form-control @error('waktu_mulai') is-invalid @enderror"
                               name="waktu_mulai"
                               id="waktu_mulai"
                               value="{{ old('waktu_mulai', date('H:i', strtotime($presence->tgl_kegiatan))) }}">
                        @error('waktu_mulai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="batas_waktu" class="form-label">
                            Batas Waktu Absen <span class="optional">(opsional)</span>
                        </label>
                        <input type="datetime-local"
                               class="form-control"
                               name="batas_waktu"
                               id="batas_waktu"
                               value="{{ old('batas_waktu', $presence->batas_waktu ? date('Y-m-d\TH:i', strtotime($presence->batas_waktu)) : '') }}">
                    </div>
                </div>

                <div class="form-row split">
                    <div class="form-group">
                        <label for="lokasi" class="form-label">
                            Lokasi <span style="color: #ea4335;">*</span>
                        </label>
                        <input type="text"
                               class="form-control @error('lokasi') is-invalid @enderror"
                               name="lokasi"
                               id="lokasi"
                               placeholder="Contoh: Zoom Meeting, Auditorium Utama"
                               value="{{ old('lokasi', $presence->lokasi) }}">
                        @error('lokasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Status Kegiatan</label>
                        <div class="switch-container">
                            <label class="switch">
                                <input type="checkbox" name="is_active" id="is_active" {{ old('is_active', $presence->is_active) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                            <span class="switch-label">Aktifkan sistem presensi</span>
                        </div>
                    </div>
                </div>

                <div class="form-row single">
                    <div class="form-group">
                        <label for="link_lokasi" class="form-label">
                            Link Lokasi <span class="optional">(jika ada)</span>
                        </label>
                        <input type="url"
                               class="form-control @error('link_lokasi') is-invalid @enderror"
                               name="link_lokasi"
                               id="link_lokasi"
                               placeholder="https://..."
                               value="{{ old('link_lokasi', $presence->link_lokasi) }}">
                        <div class="form-helper">Masukkan link Zoom, Google Meet, atau lokasi digital lainnya</div>
                        @error('link_lokasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="section-divider"></div>

            {{-- Pengaturan Tampilan Section Header --}}
            <div class="slide-settings-header">
                <div class="section-icon">
                    <i class="fas fa-palette"></i>
                </div>
                <h3 class="slide-settings-title">Pengaturan Tampilan</h3>
            </div>

            <div class="form-grid">
                <div class="form-row single">
                    <div class="form-group">
                        <label for="judul_header" class="form-label">Judul Header</label>
                        <input type="text"
                               class="form-control"
                               name="judul_header"
                               id="judul_header"
                               value="{{ old('judul_header', $presence->judul_header) }}"
                               placeholder="Masukkan judul header">
                        <div class="form-helper">Judul ini akan tampil di bagian atas halaman presensi</div>
                    </div>
                </div>

                <div class="form-row triple">
                    <div class="form-group">
                        <label for="logo_kiri" class="form-label">Logo Kiri</label>
                        <div class="file-upload">
                            <input type="file" name="logo_kiri" id="logo_kiri" accept="image/*">
                            <label for="logo_kiri" class="file-upload-label">
                                <i class="fas fa-cloud-upload-alt"></i>
                                Pilih File
                            </label>
                        </div>
                        <div class="form-helper">Format: JPG, PNG, GIF</div>
                        @if ($presence->logo_kiri)
                            <div class="mt-2">
                                <img src="{{ asset('uploads/' . $presence->logo_kiri) }}" class="img-preview">
                                <small class="text-muted d-block">Logo saat ini</small>
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="logo_kanan" class="form-label">Logo Kanan</label>
                        <div class="file-upload">
                            <input type="file" name="logo_kanan" id="logo_kanan" accept="image/*">
                            <label for="logo_kanan" class="file-upload-label">
                                <i class="fas fa-cloud-upload-alt"></i>
                                Pilih File
                            </label>
                        </div>
                        <div class="form-helper">Format: JPG, PNG, GIF</div>
                        @if ($presence->logo_kanan)
                            <div class="mt-2">
                                <img src="{{ asset('uploads/' . $presence->logo_kanan) }}" class="img-preview">
                                <small class="text-muted d-block">Logo saat ini</small>
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="logo_ig" class="form-label">Logo Instagram</label>
                        <div class="file-upload">
                            <input type="file" name="logo_ig" id="logo_ig" accept="image/*">
                            <label for="logo_ig" class="file-upload-label">
                                <i class="fas fa-cloud-upload-alt"></i>
                                Pilih File
                            </label>
                        </div>
                        <div class="form-helper">Format: JPG, PNG, GIF</div>
                        @if ($presence->logo_ig)
                            <div class="mt-2">
                                <img src="{{ asset('uploads/' . $presence->logo_ig) }}" class="img-preview">
                                <small class="text-muted d-block">Logo saat ini</small>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-row single">
                    <div class="form-group">
                        <label for="link_ig" class="form-label">Username Instagram</label>
                        <input type="text"
                               class="form-control"
                               name="link_ig"
                               id="link_ig"
                               placeholder="misal: eltrafo"
                               value="{{ old('link_ig', str_replace('https://instagram.com/', '', $presence->link_ig)) }}">
                        <div class="form-helper">Username Instagram tanpa tanda @</div>
                    </div>
                </div>
            </div>

            <div class="section-divider"></div>

            @include('pages.presence.partials.slide-settings')

            <div class="action-buttons">
                <a href="{{ route('presence.index') }}" class="btn-modern btn-secondary">
                    <i class="fas fa-times"></i>
                    Batal
                </a>
                <button type="submit" class="btn-modern btn-primary">
                    <i class="fas fa-save"></i>
                    Update Kegiatan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // File upload labels update
    const fileInputs = document.querySelectorAll('input[type="file"]');

    fileInputs.forEach(input => {
        input.addEventListener('change', function() {
            const label = this.nextElementSibling; // Get the label element
            // Check if the next sibling is actually a label and has the class 'file-upload-label'
            if (label && label.classList.contains('file-upload-label')) {
                const fileName = this.files[0]?.name;

                if (fileName) {
                    label.innerHTML = `<i class="fas fa-check"></i>${fileName}`;
                    label.style.borderColor = '#34a853';
                    label.style.background = 'rgba(52, 168, 83, 0.1)';
                } else {
                    label.innerHTML = '<i class="fas fa-cloud-upload-alt"></i>Pilih File';
                    label.style.borderColor = '#dadce0';
                    label.style.background = '#f8f9fa';
                }
            }
        });
    });
});
</script>
@endsection