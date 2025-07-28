@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-9">
            <div class="card pln-auth-card pln-dashboard-card mb-5">
                <div class="card-body pln-auth-body pln-dashboard-body">
                    @if (session('status'))
                        <div class="alert alert-success pln-alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- Hero Section --}}
                    <div class="pln-hero-section text-center mb-5">
                        <img src="{{ asset('images/logo_saja.png') }}" alt="Logo PLN" class="pln-hero-logo mb-4">
                        <h1 class="pln-hero-title mb-3 animate__animated animate__fadeInDown">Selamat Datang di Sistem Informasi PLN!</h1>
                        <p class="pln-hero-subtitle mb-4 animate__animated animate__fadeInUp">Kelola kegiatan dan data anggota dengan mudah dan efisien.</p>
                        <a href="{{ route('presence.index') }}" class="btn pln-btn-hero animate__animated animate__zoomIn">
                            <i class="fas fa-play-circle me-2"></i> Mulai Sekarang
                        </a>
                    </div>

                    <hr class="pln-divider">

                    {{-- Quick Stats Section --}}
                    <h3 class="pln-section-title text-center mb-4 animate__animated animate__fadeIn">Ringkasan Cepat</h3>
                    <div class="row text-center mb-5">
                        <div class="col-md-4 mb-4 animate__animated animate__fadeInUp">
                            <div class="pln-stat-card">
                                <i class="fas fa-calendar-check pln-stat-icon mb-3"></i>
                                <div class="pln-stat-value">
                                    {{-- Contoh data placeholder, gantikan dengan data sebenarnya dari database --}}
                                    <span class="count-up" data-target="15">0</span>
                                </div>
                                <div class="pln-stat-label">Kegiatan Aktif</div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4 animate__animated animate__fadeInUp animate__delay-1s">
                            <div class="pln-stat-card">
                                <i class="fas fa-users pln-stat-icon mb-3"></i>
                                <div class="pln-stat-value">
                                    {{-- Contoh data placeholder --}}
                                    <span class="count-up" data-target="120">0</span>
                                </div>
                                <div class="pln-stat-label">Total Anggota</div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4 animate__animated animate__fadeInUp animate__delay-2s">
                            <div class="pln-stat-card">
                                <i class="fas fa-check-circle pln-stat-icon mb-3"></i>
                                <div class="pln-stat-value">
                                    {{-- Contoh data placeholder --}}
                                    <span class="count-up" data-target="85">0</span>%
                                </div>
                                <div class="pln-stat-label">Tingkat Kehadiran</div>
                            </div>
                        </div>
                    </div>

                    <hr class="pln-divider">

                    {{-- Action Cards --}}
                    <h3 class="pln-section-title text-center mb-4 animate__animated animate__fadeIn">Aksi Cepat</h3>
                    <div class="row mt-4">
                        <div class="col-md-6 mb-4 animate__animated animate__fadeInLeft">
                            <div class="pln-action-card">
                                <div class="card-body d-flex align-items-center">
                                    <i class="fas fa-clipboard-list pln-action-icon me-4"></i>
                                    <div>
                                        <h5 class="card-title pln-action-title">Daftar Kegiatan</h5>
                                        <p class="card-text pln-action-description">Lihat, tambahkan, dan kelola semua kegiatan yang tercatat.</p>
                                    </div>
                                </div>
                                <div class="card-footer pln-action-footer">
                                    <a href="{{ route('presence.index') }}" class="pln-action-link">Masuk ke Daftar Kegiatan <i class="fas fa-arrow-right ms-2"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4 animate__animated animate__fadeInRight">
                            <div class="pln-action-card">
                                <div class="card-body d-flex align-items-center">
                                    <i class="fas fa-address-book pln-action-icon me-4"></i>
                                    <div>
                                        <h5 class="card-title pln-action-title">Data Anggota PLN</h5>
                                        <p class="card-text pln-action-description">Akses dan kelola informasi detail anggota PLN.</p>
                                    </div>
                                </div>
                                <div class="card-footer pln-action-footer">
                                    <a href="{{ route('pln-members.index') }}" class="pln-action-link">Kelola Data Anggota <i class="fas fa-arrow-right ms-2"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-5 mb-3 animate__animated animate__fadeInUp">
                        <p class="pln-cta-text">Butuh bantuan atau ingin mengatur profil Anda?</p>
                        <a href="#" class="btn pln-btn-secondary">
                            <i class="fas fa-user-cog me-2"></i> Pengaturan Akun
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
{{-- Animate.css for subtle animations --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<script>
    // JavaScript for Count-Up Animation
    document.addEventListener('DOMContentLoaded', function() {
        const countUpElements = document.querySelectorAll('.count-up');

        countUpElements.forEach(element => {
            const target = parseInt(element.getAttribute('data-target'));
            let current = 0;
            const increment = target / 100; // Adjust for smoother animation

            const updateCount = () => {
                if (current < target) {
                    current += increment;
                    element.textContent = Math.ceil(current);
                    requestAnimationFrame(updateCount);
                } else {
                    element.textContent = target;
                }
            };

            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        updateCount();
                        observer.unobserve(entry.target); // Stop observing once animated
                    }
                });
            }, { threshold: 0.5 }); // Trigger when 50% of element is visible

            observer.observe(element);
        });
    });
</script>
<style>
    /* Global Styles */
    body {
        background-color: #f0f8ff; /* Light blue background for the whole page */
    }

    /* Main Card Styling */
    .pln-dashboard-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0, 116, 182, 0.1);
        backdrop-filter: blur(5px);
        animation: fadeInScale 0.8s ease-out; /* Custom animation for card appearance */
        overflow: hidden; /* To contain any inner elements' overflow */
    }

    .pln-dashboard-body {
        padding: 3rem;
    }

    /* Hero Section */
    .pln-hero-section {
        padding: 4rem 0 2rem;
        background: linear-gradient(135deg, #e0f2f7 0%, #ffffff 100%);
        border-radius: 15px;
        margin-bottom: 3rem;
        box-shadow: inset 0 0 20px rgba(0, 180, 216, 0.05);
        position: relative;
        overflow: hidden;
    }

    .pln-hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%2300b4d8' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zm0 15v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zM12 34v-4H10v4H6v2h4v4h2v-4h4v-2h-4zm0-30V0H10v4H6v2h4v4h2V6h4V4h-4zm0 15v-4H10v4H6v2h4v4h2v-4h4v-2h-4z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        opacity: 0.2;
        z-index: 0;
    }

    .pln-hero-logo {
        height: 60px; /* Larger logo for hero */
        animation: bounceIn 1s ease-out;
        position: relative;
        z-index: 1;
    }

    .pln-hero-title {
        font-size: 2.8rem;
        font-weight: 800;
        color: #0077b6;
        line-height: 1.2;
        position: relative;
        z-index: 1;
    }

    .pln-hero-subtitle {
        font-size: 1.3rem;
        color: #333;
        max-width: 600px;
        margin: 0 auto 2rem;
        position: relative;
        z-index: 1;
    }

    .pln-btn-hero {
        background: linear-gradient(45deg, #00b4d8 0%, #0077b6 100%);
        color: #fff;
        font-weight: 600;
        padding: 0.9rem 2.5rem;
        border-radius: 50px;
        font-size: 1.1rem;
        border: none;
        box-shadow: 0 8px 20px rgba(0, 116, 182, 0.3);
        transition: all 0.3s ease;
        position: relative;
        z-index: 1;
        overflow: hidden;
    }

    .pln-btn-hero:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(0, 116, 182, 0.4);
        background: linear-gradient(45deg, #0077b6 0%, #00b4d8 100%);
    }

    .pln-btn-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.2);
        transform: skewX(-30deg);
        transition: all 0.7s ease;
    }

    .pln-btn-hero:hover::before {
        left: 100%;
    }

    /* Section Titles */
    .pln-section-title {
        font-size: 2.2rem;
        font-weight: 700;
        color: #0077b6;
        margin-bottom: 2rem;
        position: relative;
    }

    .pln-section-title::after {
        content: '';
        display: block;
        width: 80px;
        height: 4px;
        background: linear-gradient(90deg, #ffd60a, #0077b6);
        margin: 10px auto 0;
        border-radius: 2px;
    }

    /* Quick Stats Cards */
    .pln-stat-card {
        background: #fff;
        border-radius: 15px;
        padding: 2.5rem 1.5rem;
        box-shadow: 0 6px 20px rgba(0, 116, 182, 0.08);
        transition: all 0.3s ease;
        height: 100%; /* Ensure cards are same height */
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .pln-stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 116, 182, 0.15);
    }

    .pln-stat-icon {
        font-size: 3.5rem;
        color: #00b4d8;
    }

    .pln-stat-value {
        font-size: 3.5rem;
        font-weight: 900;
        color: #0077b6;
        line-height: 1;
        margin-bottom: 0.5rem;
    }

    .pln-stat-label {
        font-size: 1.1rem;
        color: #555;
        font-weight: 500;
    }

    /* Action Cards (Improved Info Card) */
    .pln-action-card {
        border: none;
        border-radius: 18px;
        box-shadow: 0 8px 30px rgba(0, 116, 182, 0.08);
        background: #ffffff;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
        position: relative;
        z-index: 1;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .pln-action-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 6px; /* Garis tebal di atas */
        background: linear-gradient(90deg, #00b4d8, #0077b6);
        transition: all 0.3s ease;
        transform: scaleX(0);
        transform-origin: left;
    }

    .pln-action-card:hover::before {
        transform: scaleX(1); /* Garis meluas saat hover */
    }

    .pln-action-card:hover {
        box-shadow: 0 15px 45px rgba(0, 116, 182, 0.2);
        transform: translateY(-7px);
    }

    .pln-action-card .card-body {
        padding: 2.5rem;
        display: flex;
        align-items: center;
        flex-grow: 1; /* Allows content to expand */
    }

    .pln-action-icon {
        font-size: 4rem;
        color: #00b4d8; /* Warna ikon yang lebih cerah */
        opacity: 0.7;
        margin-right: 1.5rem;
        min-width: 4rem; /* Ensure consistent spacing */
    }

    .pln-action-title {
        font-weight: 700;
        color: #0077b6;
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
    }

    .pln-action-description {
        font-size: 1rem;
        color: #666;
    }

    .pln-action-footer {
        background: rgba(0, 116, 182, 0.03);
        padding: 1.2rem 2.5rem;
        border-top: 1px solid rgba(0, 116, 182, 0.08);
        text-align: right;
    }

    .pln-action-link {
        color: #0077b6;
        text-decoration: none;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .pln-action-link:hover {
        color: #ffd60a;
        transform: translateX(5px);
    }

    /* General Button Styling */
    .pln-btn-primary {
        background: linear-gradient(45deg, #00b4d8 0%, #0077b6 100%);
        color: #fff;
        font-weight: 600;
        padding: 0.8rem 2rem;
        border-radius: 30px;
        border: none;
        box-shadow: 0 5px 15px rgba(0, 116, 182, 0.2);
        transition: all 0.3s ease;
    }

    .pln-btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 116, 182, 0.3);
        background: linear-gradient(45deg, #0077b6 0%, #00b4d8 100%);
    }

    .pln-btn-secondary {
        background: linear-gradient(45deg, #ffd60a 0%, #ffc107 100%);
        color: #333;
        font-weight: 600;
        padding: 0.8rem 2rem;
        border-radius: 30px;
        border: none;
        box-shadow: 0 5px 15px rgba(255, 214, 10, 0.2);
        transition: all 0.3s ease;
    }

    .pln-btn-secondary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(255, 214, 10, 0.3);
        background: linear-gradient(45deg, #ffc107 0%, #ffd60a 100%);
        color: #000;
    }

    /* Alert Styling */
    .pln-alert-success {
        background-color: #e6ffed;
        border-color: #b3e6c7;
        color: #00873e;
        border-radius: 10px;
        padding: 1.2rem 1.8rem;
        margin-bottom: 2rem;
        font-weight: 500;
        box-shadow: 0 2px 10px rgba(0, 135, 62, 0.1);
    }

    .pln-cta-text {
        font-size: 1.15rem;
        color: #555;
        font-weight: 500;
        margin-bottom: 1.5rem;
    }

    /* Animations */
    @keyframes fadeInScale {
        from {
            opacity: 0;
            transform: scale(0.98) translateY(20px);
        }
        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }

    @keyframes bounceIn {
        0%, 20%, 40%, 60%, 80%, 100% {
            -webkit-animation-timing-function: cubic-bezier(0.215, .61, .355, 1);
            animation-timing-function: cubic-bezier(0.215, .61, .355, 1)
        }
        0% {
            opacity: 0;
            -webkit-transform: scale3d(.3, .3, .3);
            transform: scale3d(.3, .3, .3)
        }
        20% {
            -webkit-transform: scale3d(1.1, 1.1, 1.1);
            transform: scale3d(1.1, 1.1, 1.1)
        }
        40% {
            -webkit-transform: scale3d(.9, .9, .9);
            transform: scale3d(.9, .9, .9)
        }
        60% {
            opacity: 1;
            -webkit-transform: scale3d(1.03, 1.03, 1.03);
            transform: scale3d(1.03, 1.03, 1.03)
        }
        80% {
            -webkit-transform: scale3d(.97, .97, .97);
            transform: scale3d(.97, .97, .97)
        }
        100% {
            opacity: 1;
            -webkit-transform: scale3d(1, 1, 1);
            transform: scale3d(1, 1, 1)
        }
    }

    /* Responsive Adjustments */
    @media (max-width: 991.98px) {
        .pln-dashboard-body {
            padding: 2rem;
        }
        .pln-hero-title {
            font-size: 2.2rem;
        }
        .pln-hero-subtitle {
            font-size: 1.1rem;
        }
        .pln-section-title {
            font-size: 1.8rem;
        }
        .pln-stat-value {
            font-size: 2.8rem;
        }
        .pln-stat-icon {
            font-size: 3rem;
        }
        .pln-action-icon {
            font-size: 3.5rem;
        }
        .pln-action-card .card-body {
            flex-direction: column;
            text-align: center;
        }
        .pln-action-icon {
            margin-bottom: 1rem;
            margin-right: 0;
        }
        .pln-action-footer {
            text-align: center;
        }
    }

    @media (max-width: 767.98px) {
        .pln-dashboard-body {
            padding: 1.5rem;
        }
        .pln-hero-section {
            padding: 3rem 0 1.5rem;
        }
        .pln-hero-title {
            font-size: 1.8rem;
        }
        .pln-hero-subtitle {
            font-size: 1rem;
        }
        .pln-btn-hero {
            padding: 0.7rem 2rem;
            font-size: 1rem;
        }
        .pln-stat-value {
            font-size: 2.5rem;
        }
    }
</style>
@endpush