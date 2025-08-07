@extends('layouts.main')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card pln-card-profile shadow-lg border-0 animate__animated animate__fadeIn">
                <div class="card-header text-white text-center py-4 pln-card-header">
                    <div class="profile-avatar-container mb-3">
                        <i class="fas fa-user-circle fa-5x"></i>
                    </div>
                    <h4 class="mb-0 fw-bold">{{ $user->name }}</h4>
                    <p class="text-white-50 mb-0">{{ $user->email }}</p>
                </div>
                <div class="card-body p-5">
                    <h5 class="pln-card-title mb-4 pb-2">Informasi Akun</h5>
                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item d-flex align-items-center">
                            <i class="fas fa-id-badge fa-fw me-3 pln-card-icon"></i>
                            <div>
                                <small class="text-muted">Nama Lengkap</small>
                                <p class="mb-0 fw-bold">{{ $user->name }}</p>
                            </div>
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                            <i class="fas fa-envelope fa-fw me-3 pln-card-icon"></i>
                            <div>
                                <small class="text-muted">Email</small>
                                <p class="mb-0">{{ $user->email }}</p>
                            </div>
                        </li>
                        {{-- Contoh: Jika Anda memiliki kolom 'role' di tabel users --}}
                        {{-- @if(isset($user->role))
                        <li class="list-group-item d-flex align-items-center">
                            <i class="fas fa-user-tag fa-fw me-3 pln-card-icon"></i>
                            <div>
                                <small class="text-muted">Role</small>
                                <p class="mb-0 text-capitalize">{{ $user->role }}</p>
                            </div>
                        </li>
                        @endif --}}
                    </ul>
                    <a href="{{ route('profile.edit') }}" class="btn w-100 pln-btn-accent">
                        <i class="fas fa-user-edit me-2"></i> Edit Profil
                    </a>
                </div>
                <div class="card-footer text-muted text-center py-3">
                    Bergabung sejak {{ $user->created_at->format('d M Y') }}
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Latar belakang halaman kembali ke putih, padding tetap ada */
    body {
        padding-top: 70px;
        background-color: #f0f8ff; 
    }
    
    /* Styling card dengan latar belakang kuning muda */
    .pln-card-profile {
        border-radius: 1.2rem;
        overflow: hidden;
        background-color: #fffde7; /* Latar belakang card kuning muda pucat */
        border: 1px solid #e9ecef;
        box-shadow: 0 8px 25px rgba(0, 116, 182, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .pln-card-profile:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 30px rgba(0, 116, 182, 0.2);
    }
    
    /* Header card dengan gradien biru PLN */
    .pln-card-header {
        background: linear-gradient(135deg, #00b4d8 0%, #0077b6 100%);
        position: relative;
    }
    .profile-avatar-container {
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        width: 100px;
        height: 100px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        border: 4px solid #fff;
    }
    
    /* Styling untuk judul dan ikon */
    .pln-card-title {
        color: #0077b6;
        font-weight: 700;
        position: relative;
        padding-bottom: 10px;
    }
    .pln-card-title::after {
        content: '';
        display: block;
        width: 60px; 
        height: 3px;
        background-color: #ffd60a; 
        position: absolute;
        bottom: 0;
        left: 0;
    }
    .pln-card-icon {
        color: #0077b6;
        font-size: 1.4rem;
        transition: transform 0.3s ease, color 0.3s ease;
    }

    /* Styling untuk item list */
    .list-group-item {
        border-left: none;
        border-right: none;
        padding: 1rem;
        transition: background-color 0.3s ease, transform 0.3s ease;
        background-color: transparent;
    }
    .list-group-item:hover {
        background-color: rgba(0, 119, 182, 0.05);
    }
    .list-group-item:hover .pln-card-icon {
        color: #ffd60a; 
        transform: scale(1.2);
    }
    
    /* Tombol Edit Profil menjadi kuning penuh */
    .pln-btn-accent {
        background-color: #ffd60a;
        border-color: #ffd60a;
        color: #0077b6;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .pln-btn-accent:hover {
        background-color: #ffc400;
        border-color: #ffc400;
        transform: translateY(-2px);
    }
    
    /* Menyesuaikan ikon di dalam tombol */
    .pln-btn-accent .fas {
        color: #0077b6; /* Ikon di dalam tombol tetap biru */
    }
</style>
@endsection