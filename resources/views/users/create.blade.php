@extends('layouts.main')

@section('content')
{{-- Link Font Awesome seharusnya sudah ada di layouts.main --}}
<style>
/* Reset and Box Sizing */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Main Container (pembungkus luar, Hadirin style) */
.app-container {
    width: 100%;
    max-width: 900px; /* Lebar maksimum disesuaikan untuk form yang luas */
    margin: 20px auto; /* Margin atas/bawah otomatis untuk posisi tengah */
    padding: 0 20px; /* Padding samping untuk responsivitas */
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Font konsisten dengan Hadirin */
}

/* App Card (ini adalah wadah utama untuk header dan form, membuatnya terlihat sebagai satu kartu) */
.hadirin-app-card {
    border: none;
    border-radius: 20px;
    box-shadow: 0 15px 45px rgba(0, 116, 182, 0.2); /* Bayangan sedang */
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
.hadirin-app-header {
    background: linear-gradient(135deg, #00b4d8 0%, #0077b6 100%); /* Gradien biru Hadirin */
    color: white;
    padding: 2.2rem;
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
    background: linear-gradient(45deg, transparent, rgba(255, 214, 10, 0.15), transparent);
    transform: rotate(-45deg);
    animation: headerShimmer 4s infinite; /* Efek shimmer pada header */
}

@keyframes headerShimmer {
    0% { transform: translateX(-100%) translateY(-100%) rotate(-45deg); }
    100% { transform: translateX(100%) translateY(100%) rotate(-45deg); }
}

.hadirin-header-title {
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

/* Tombol Kembali di Header */
.hadirin-header-btn {
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
}

.hadirin-header-btn:hover {
    background: rgba(255, 255, 255, 0.4); /* Lebih terang saat hover */
    color: white;
    text-decoration: none;
    transform: translateY(-2px);
}

/* App Body (bagian form itu sendiri) */
.hadirin-app-body {
    padding: 2.5rem;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(248, 249, 255, 0.98) 100%); /* Latar form yang sangat terang */
    position: relative;
    overflow: hidden;
}

/* Header Bagian (misalnya "Informasi Anggota") */
.hadirin-section-header {
    display: flex;
    align-items: center;
    margin-bottom: 2rem; /* Jarak lebih besar */
    padding-bottom: 0.8rem; /* Padding bawah */
    border-bottom: 2px solid rgba(0, 180, 216, 0.1); /* Garis bawah yang lebih jelas tapi tidak terlalu tebal */
    gap: 1rem;
}

.hadirin-section-icon {
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

.hadirin-section-title {
    font-size: 1.7rem; /* Ukuran font lebih besar */
    font-weight: 700;
    color: #0077b6; /* Warna biru gelap */
    margin: 0;
}

/* Grid Form */
.form-grid {
    display: grid;
    gap: 2.5rem; /* Meningkatkan jarak antar grup form */
    margin-bottom: 2.5rem; /* Jarak bawah sebelum tombol */
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem; /* Meningkatkan jarak antar kolom dalam satu baris */
}

.form-row.single {
    grid-template-columns: 1fr;
}

/* Grup Form (label dan input) */
.form-group { /* Menggunakan nama umum agar lebih fleksibel */
    display: flex;
    flex-direction: column;
}

.hadirin-label {
    font-weight: 600;
    color: #1a1a1a;
    margin-bottom: 0.8rem; /* Meningkatkan jarak bawah label */
    font-size: 0.98rem; /* Ukuran font label */
    display: block;
}

/* Container untuk input dan ikon */
.input-with-icon-wrapper {
    position: relative;
    width: 100%;
}

.hadirin-input {
    border: 2px solid #a8dadc; /* Border lebih tebal dan warna Hadirin */
    border-radius: 12px; /* Radius lebih besar */
    padding: 0.9rem 1.1rem; /* Padding lebih besar */
    font-size: 1rem;
    transition: all 0.3s ease;
    background: rgba(255, 255, 255, 0.95); /* Background input semi-transparan */
    width: 100%;
    color: #3c4043; /* Warna teks gelap */
    padding-right: 3rem; /* Tambahkan padding agar ikon tidak menutupi teks */
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

/* Tombol toggle password */
.password-toggle-btn {
    position: absolute;
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: #0077b6; /* Warna ikon biru gelap */
    cursor: pointer;
    font-size: 1.1rem;
    transition: color 0.3s ease;
}

.password-toggle-btn:hover {
    color: #00b4d8; /* Warna ikon lebih terang saat hover */
}

/* Pesan Error */
.invalid-feedback { /* Menggunakan nama umum */
    font-size: 0.88rem; /* Ukuran font pesan error */
    margin-top: 0.6rem; /* Meningkatkan jarak atas pesan error */
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

/* Tanda bintang merah untuk field wajib */
.required-star {
    color: #dc3545;
}

/* Tombol Aksi */
.action-buttons {
    display: flex;
    justify-content: flex-end;
    gap: 1.2rem; /* Jarak antar tombol */
    margin-top: 3rem; /* Jarak atas dari form */
    padding-top: 1.8rem; /* Padding atas untuk garis pemisah */
    border-top: 1px solid rgba(0, 180, 216, 0.1); /* Garis pemisah Hadirin */
}

.hadirin-btn { /* Gaya dasar tombol */
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

.hadirin-btn-primary {
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

.hadirin-btn-secondary {
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

    .form-row {
        grid-template-columns: 1fr;
        gap: 1.5rem; /* Meningkatkan jarak di mobile */
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

    .hadirin-input {
        padding: 0.7rem 0.9rem;
        font-size: 0.9rem;
    }
}
</style>

<div class="app-container">
    <div class="hadirin-app-card">
        <div class="hadirin-app-header">
            <h1 class="hadirin-header-title">
                <i class="fas fa-user-plus"></i>
                Tambah User Baru
            </h1>
            <a href="{{ route('users.index') }}" class="hadirin-header-btn">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>
        </div>

        <div class="hadirin-app-body">
            <div class="hadirin-section-header">
                <div class="hadirin-section-icon">
                    <i class="fas fa-info-circle"></i>
                </div>
                <h3 class="hadirin-section-title">Informasi Akun Baru</h3>
            </div>

            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="form-grid">
                    <div class="form-row single"> {{-- Nama --}}
                        <div class="form-group">
                            <label for="name" class="hadirin-label">Nama <span style="color: #dc3545;">*</span></label>
                            <input type="text"
                                class="hadirin-input @error('name') is-invalid @enderror"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="Masukkan nama lengkap"
                                required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row single"> {{-- Email --}}
                        <div class="form-group">
                            <label for="email" class="hadirin-label">Email <span style="color: #dc3545;">*</span></label>
                            <input type="email"
                                class="hadirin-input @error('email') is-invalid @enderror"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="user@example.com"
                                required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row"> {{-- Password dan Konfirmasi Password --}}
                        <div class="form-group">
                            <label for="password" class="hadirin-label">Password <span style="color: #dc3545;">*</span></label>
                            <div class="input-with-icon-wrapper">
                                <input type="password"
                                    class="hadirin-input @error('password') is-invalid @enderror"
                                    id="password"
                                    name="password"
                                    placeholder="Minimal 8 karakter"
                                    required>
                                <button type="button" class="password-toggle-btn" onclick="togglePassword('password')">
                                    <i id="togglePasswordIcon" class="fas fa-eye-slash"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation" class="hadirin-label">Konfirmasi Password <span style="color: #dc3545;">*</span></label>
                            <div class="input-with-icon-wrapper">
                                <input type="password"
                                    class="hadirin-input"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    placeholder="Konfirmasi password baru"
                                    required>
                                <button type="button" class="password-toggle-btn" onclick="togglePassword('password_confirmation')">
                                    <i id="togglePasswordConfirmationIcon" class="fas fa-eye-slash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="action-buttons">
                    <a href="{{ route('users.index') }}" class="hadirin-btn hadirin-btn-secondary">
                        <i class="fas fa-times"></i>
                        Batal
                    </a>
                    <button type="submit" class="hadirin-btn hadirin-btn-primary">
                        <i class="fas fa-save"></i>
                        Simpan User
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function togglePassword(fieldId) {
        const passwordInput = document.getElementById(fieldId);
        const toggleIcon = document.getElementById('toggle' + fieldId.charAt(0).toUpperCase() + fieldId.slice(1) + 'Icon');
        
        // Cek tipe input
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        
        // Ganti ikon
        if (type === 'password') {
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    }
</script>
@endsection
