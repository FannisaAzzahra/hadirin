@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="card pln-auth-card pln-dashboard-card"> {{-- Tambahkan kelas pln-dashboard-card --}}
                <div class="card-header pln-auth-header">
                    <div class="d-flex align-items-center justify-content-center gap-3 mb-3">
                        <img src="{{ asset('images/logo_saja.png') }}" alt="Logo PLN" style="height: 32px;">
                        <h4 class="mb-0">{{ __('Dashboard Pengguna') }}</h4> {{-- Ubah judul --}}
                    </div>
                </div>

                <div class="card-body pln-auth-body pln-dashboard-body"> {{-- Tambahkan kelas pln-dashboard-body --}}
                    @if (session('status'))
                        <div class="alert alert-success pln-alert-success" role="alert"> {{-- Tambahkan kelas kustom --}}
                            {{ session('status') }}
                        </div>
                    @endif

                    <h5 class="pln-welcome-text mb-4">Selamat datang, <span class="text-primary">{{ Auth::user()->name }}</span>! 👋</h5>
                    <p class="pln-dashboard-intro">Di sini Anda dapat melihat ringkasan aktivitas dan informasi penting terkait aplikasi. Jelajahi fitur-fitur kami melalui menu navigasi di atas.</p>

                    <hr class="pln-divider">

                    <div class="row mt-4">
                        <div class="col-md-6 mb-4">
                            <div class="pln-info-card">
                                <div class="card-body d-flex align-items-center justify-content-between">
                                    <div>
                                        <h6 class="card-title pln-card-title"><i class="fas fa-list-alt me-2"></i> Total Kegiatan Anda</h6>
                                        <p class="card-text pln-card-value">
                                            {{-- Contoh data placeholder, gantikan dengan data sebenarnya dari database --}}
                                            <strong>15</strong> Kegiatan
                                        </p>
                                    </div>
                                    <i class="fas fa-chart-line pln-card-icon"></i>
                                </div>
                                <div class="card-footer pln-card-footer">
                                    <a href="{{ route('presence.index') }}" class="pln-card-link">Lihat Detail <i class="fas fa-arrow-right ms-2"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="pln-info-card">
                                <div class="card-body d-flex align-items-center justify-content-between">
                                    <div>
                                        <h6 class="card-title pln-card-title"><i class="fas fa-users me-2"></i> Data Anggota PLN</h6>
                                        <p class="card-text pln-card-value">
                                            {{-- Contoh data placeholder --}}
                                            Kelola Anggota
                                        </p>
                                    </div>
                                    <i class="fas fa-user-friends pln-card-icon"></i>
                                </div>
                                <div class="card-footer pln-card-footer">
                                    <a href="{{ route('pln-members.index') }}" class="pln-card-link">Kelola Data <i class="fas fa-arrow-right ms-2"></i></a>
                                </div>
                            </div>
                        </div>
                        {{-- Tambahkan kartu lain jika diperlukan, misalnya untuk pengumuman, profil, dll. --}}
                    </div>

                    <div class="mt-4 text-center">
                        <a href="#" class="btn pln-btn-primary">
                            <i class="fas fa-cogs me-2"></i> Pengaturan Akun
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Re-use existing PLN styles for card and header */
.pln-dashboard-card {
    /* Optional: override min-height if dashboard content is shorter */
    min-height: auto; 
}

.pln-dashboard-body {
    padding: 2.5rem; /* Konsisten dengan form login/register */
}

.pln-welcome-text {
    font-weight: 700;
    color: #0077b6; /* Warna biru PLN */
    text-align: center;
    font-size: 1.75rem;
}

.pln-dashboard-intro {
    text-align: center;
    color: #333;
    font-size: 1.1rem;
    line-height: 1.6;
    margin-bottom: 2rem;
}

.pln-divider {
    border-top: 2px solid rgba(0, 116, 182, 0.1);
    margin-top: 2rem;
    margin-bottom: 2rem;
}

/* Info Card Styling */
.pln-info-card {
    border: none;
    border-radius: 16px;
    box-shadow: 0 8px 30px rgba(0, 116, 182, 0.1);
    background: rgba(255, 255, 255, 0.98);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    overflow: hidden;
    position: relative;
    z-index: 1;
}

.pln-info-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 5px; /* Garis tipis di atas */
    background: linear-gradient(90deg, #00b4d8, #0077b6);
    transition: all 0.3s ease;
}

.pln-info-card:hover {
    box-shadow: 0 12px 40px rgba(0, 116, 182, 0.2);
    transform: translateY(-5px);
}

.pln-info-card:hover::before {
    height: 10px; /* Garis lebih tebal saat hover */
}

.pln-card-title {
    font-weight: 600;
    color: #0077b6;
    font-size: 1.1rem;
    margin-bottom: 0.5rem;
}

.pln-card-value {
    font-size: 2rem;
    font-weight: 800;
    color: #00b4d8; /* Warna yang lebih cerah */
}

.pln-card-icon {
    font-size: 3.5rem;
    color: rgba(0, 116, 182, 0.1); /* Warna ikon buram sebagai background */
    margin-left: 1rem;
}

.pln-card-footer {
    background: rgba(0, 116, 182, 0.05); /* Latar belakang footer sedikit berbeda */
    padding: 1rem 1.5rem;
    border-top: 1px solid rgba(0, 116, 182, 0.1);
}

.pln-card-link {
    color: #0077b6;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.pln-card-link:hover {
    color: #ffd60a;
    text-decoration: underline;
}

/* Alert Styling (if needed for session status) */
.pln-alert-success {
    background-color: #e6ffed; /* Latar belakang hijau muda */
    border-color: #b3e6c7; /* Border hijau */
    color: #00873e; /* Teks hijau gelap */
    border-radius: 10px;
    padding: 1rem 1.5rem;
    margin-bottom: 1.5rem;
    font-weight: 500;
}

/* Responsive adjustments for dashboard */
@media (max-width: 768px) {
    .pln-dashboard-body {
        padding: 1.5rem;
    }
    .pln-welcome-text {
        font-size: 1.5rem;
    }
    .pln-dashboard-intro {
        font-size: 1rem;
    }
    .pln-card-value {
        font-size: 1.8rem;
    }
    .pln-card-icon {
        font-size: 3rem;
    }
}

/* Re-use card appearance animation from auth if desired */
.pln-dashboard-card {
    animation: slideInUp 0.6s ease-out;
}
</style>
@endsection