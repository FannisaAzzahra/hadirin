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

    /* Main Container - Adjusted to match modern-container */
    .modern-container {
        max-width: 1000px; /* Increased max-width for more width */
        margin: 20px auto; /* Slightly increased margin */
        padding: 0 20px; /* Slightly increased padding */
        font-family: -apple-system, BlinkMacMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    /* Header - Adjusted to match modern-header */
    .modern-header {
        background: linear-gradient(135deg, #4285f4, #34a853);
        border-radius: 20px 20px 0 0; /* Increased border-radius */
        padding: 30px; /* Increased padding */
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px; /* Increased gap */
    }

    .header-content {
        flex: 1;
    }

    .header-title {
        font-size: 28px; /* Increased font size */
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 12px; /* Increased gap */
    }

    .header-subtitle {
        font-size: 16px; /* Increased font size */
        opacity: 0.9;
        margin-top: 8px; /* Increased margin */
        font-weight: 400;
    }

    .header-back-btn {
        background: rgba(255, 255, 255, 0.2);
        border: none;
        color: white;
        padding: 12px 25px; /* Increased padding */
        border-radius: 12px; /* Increased border-radius */
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 8px; /* Increased gap */
        font-weight: 500;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }

    .header-back-btn:hover {
        background: rgba(255, 255, 255, 0.3);
        color: white;
        text-decoration: none;
        transform: translateY(-2px); /* Slightly increased lift */
    }

    /* Form Container - Adjusted to match modern-form-container */
    .modern-form-container {
        background: #ffffff;
        border-radius: 0 0 20px 20px; /* Increased border-radius */
        padding: 40px; /* Increased padding */
        box-shadow: 0 5px 30px rgba(0, 0, 0, 0.1); /* Slightly adjusted shadow */
        position: relative;
        top: -1px;
    }

    /* Section Header - Adjusted to match section-header in create page */
    .section-header-custom {
        display: flex;
        align-items: center;
        margin-bottom: 30px; /* Increased margin */
        gap: 15px; /* Increased gap */
        padding-bottom: 0;
        border-bottom: none;
    }

    .section-icon-custom {
        width: 45px; /* Slightly increased icon size */
        height: 45px; /* Slightly increased icon size */
        background: linear-gradient(135deg, #4285f4, #34a853);
        border-radius: 12px; /* Increased border-radius */
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 20px; /* Slightly increased icon font size */
    }

    .section-title-custom {
        font-size: 25px; /* Increased font size significantly for title */
        font-weight: 600;
        color: #1a1a1a;
        margin: 0;
    }

    /* Form Grid - Adjusted to match form-grid */
    .form-grid {
        display: grid;
        gap: 25px; /* Increased gap */
        margin-bottom: 30px; /* Increased margin */
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px; /* Increased gap */
    }

    .form-row.single {
        grid-template-columns: 1fr;
    }

    .form-group-custom { /* Custom class for form groups */
        display: flex;
        flex-direction: column;
    }

    .form-label-custom { /* Custom class for labels */
        font-size: 16px; /* Increased font size */
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 8px; /* Increased margin */
        display: flex;
        align-items: center;
        gap: 8px; /* Increased gap */
    }

    .form-control-custom { /* Custom class for inputs */
        padding: 14px; /* Increased padding */
        border: 1px solid #dadce0;
        border-radius: 10px; /* Increased border-radius */
        font-size: 16px; /* Increased font size */
        color: #3c4043;
        background: white;
        transition: all 0.3s ease;
        font-family: inherit;
    }

    .form-control-custom:focus {
        outline: none;
        border-color: #4285f4;
        box-shadow: 0 0 0 4px rgba(66, 133, 244, 0.15);
    }

    .invalid-feedback-custom { /* Custom class for invalid feedback */
        color: #ea4335;
        font-size: 14px; /* Increased font size */
        margin-top: 6px; /* Increased margin */
        display: flex;
        align-items: center;
        gap: 6px; /* Increased gap */
    }

    .invalid-feedback-custom::before {
        content: '⚠️';
        font-size: 13px; /* Increased font size */
    }

    /* Action Buttons - Adjusted to match action-buttons */
    .action-buttons {
        display: flex;
        justify-content: flex-end;
        gap: 15px; /* Increased gap */
        margin-top: 40px; /* Increased margin */
        padding-top: 25px; /* Increased padding */
        border-top: 1px solid #e8eaed;
    }

    .btn-modern {
        padding: 14px 28px; /* Increased padding */
        border: none;
        border-radius: 12px; /* Increased border-radius */
        font-size: 16px; /* Increased font size */
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px; /* Increased gap */
        text-decoration: none;
        font-family: inherit;
    }

    .btn-primary-modern { /* Custom primary button */
        background: linear-gradient(135deg, #4285f4, #34a853);
        color: white;
        box-shadow: 0 3px 12px rgba(66, 133, 244, 0.3);
    }

    .btn-primary-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 20px rgba(66, 133, 244, 0.4);
        color: white;
        text-decoration: none;
    }

    .btn-secondary-modern { /* Custom secondary button */
        background: white;
        color: #5f6368;
        border: 1px solid #dadce0;
    }

    .btn-secondary-modern:hover {
        background: #f1f3f4;
        border-color: #4285f4;
        color: #4285f4;
        text-decoration: none;
    }

    /* Responsive Design - Copied from the previous page */
    @media (max-width: 768px) {
        .modern-container {
            margin: 15px;
            padding: 0 15px;
        }

        .modern-header {
            padding: 25px 20px;
            flex-direction: column;
            align-items: stretch;
            gap: 15px;
        }

        .header-title {
            font-size: 24px;
        }

        .modern-form-container {
            padding: 25px 20px;
        }

        .form-row {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .action-buttons {
            flex-direction: column;
            gap: 15px;
        }

        .btn-modern {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="modern-container">
    <div class="modern-header">
        <div class="header-content">
            <h1 class="header-title">
                <i class="fas fa-user-plus"></i>
                Tambah Anggota PLN
            </h1>
            {{-- <p class="header-subtitle">Buat kegiatan dan atur sistem presensi</p> --}}
            {{-- Menghilangkan subtitle karena tidak relevan untuk halaman ini --}}
        </div>
        <a href="{{ route('pln-members.index') }}" class="header-back-btn">
            <i class="fas fa-arrow-left"></i>
            Kembali
        </a>
    </div>

    <div class="modern-form-container">
        <form action="{{ route('pln-members.store') }}" method="POST">
            @csrf

            <div class="section-header-custom">
                <div class="section-icon-custom">
                    <i class="fas fa-info-circle"></i>
                </div>
                <h3 class="section-title-custom">Informasi Anggota</h3>
            </div>

            <div class="form-grid">
                <div class="form-row">
                    <div class="form-group-custom">
                        <label for="nama" class="form-label-custom">Nama Lengkap <span style="color: #ea4335;">*</span></label>
                        <input type="text"
                               class="form-control-custom @error('nama') is-invalid @enderror"
                               name="nama"
                               id="nama"
                               value="{{ old('nama') }}"
                               placeholder="Masukkan nama lengkap">
                        @error('nama')
                            <div class="invalid-feedback-custom">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group-custom">
                        <label for="nip" class="form-label-custom">NIP <span style="color: #ea4335;">*</span></label>
                        <input type="text"
                               class="form-control-custom @error('nip') is-invalid @enderror"
                               name="nip"
                               id="nip"
                               value="{{ old('nip') }}"
                               placeholder="Masukkan NIP">
                        @error('nip')
                            <div class="invalid-feedback-custom">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group-custom">
                        <label for="email" class="form-label-custom">Email <span style="color: #ea4335;">*</span></label>
                        <input type="email"
                               class="form-control-custom @error('email') is-invalid @enderror"
                               name="email"
                               id="email"
                               value="{{ old('email') }}"
                               placeholder="Masukkan email">
                        @error('email')
                            <div class="invalid-feedback-custom">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group-custom">
                        <label for="no_hp" class="form-label-custom">No HP <span style="color: #ea4335;">*</span></label>
                        <input type="text"
                               class="form-control-custom @error('no_hp') is-invalid @enderror"
                               name="no_hp"
                               id="no_hp"
                               value="{{ old('no_hp') }}"
                               placeholder="Masukkan nomor HP">
                        @error('no_hp')
                            <div class="invalid-feedback-custom">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row single"> {{-- Menggunakan form-row single untuk satu kolom --}}
                    <div class="form-group-custom">
                        <label for="jabatan" class="form-label-custom">Jabatan <span style="color: #ea4335;">*</span></label>
                        <input type="text"
                               name="jabatan"
                               id="jabatan"
                               value="{{ old('jabatan') }}"
                               placeholder="Masukkan jabatan"
                               class="form-control-custom @error('jabatan') is-invalid @enderror">
                        @error('jabatan')
                            <div class="invalid-feedback-custom">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="action-buttons">
                <a href="{{ route('pln-members.index') }}" class="btn-modern btn-secondary-modern">
                    <i class="fas fa-times"></i>
                    Batal
                </a>
                <button type="submit" class="btn-modern btn-primary-modern">
                    <i class="fas fa-save"></i>
                    Simpan Anggota
                </button>
            </div>
        </form>
    </div>
</div>
@endsection