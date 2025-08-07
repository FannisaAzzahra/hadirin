@extends('layouts.main')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">

            {{-- Pesan Sukses --}}
            @if(session('success'))
                <div class="alert pln-alert-success alert-dismissible fade show shadow animate__animated animate__fadeInDown" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Card Edit Profil --}}
            <div class="card pln-card-profile shadow-lg border-0 mb-4 animate__animated animate__fadeIn">
                <div class="card-header text-white text-center py-4 pln-card-header">
                    <div class="profile-avatar-container mb-3">
                        <i class="fas fa-user-edit fa-5x"></i>
                    </div>
                    <h4 class="mb-0 fw-bold">Edit Profil</h4>
                    <p class="text-white-50 mb-0">Perbarui informasi akun Anda</p>
                </div>
                <div class="card-body p-5">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold pln-text">Nama Lengkap</label>
                            <input type="text" class="form-control pln-form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <div class="text-danger mt-2"><i class="fas fa-exclamation-circle me-1"></i> {{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold pln-text">Alamat Email</label>
                            <input type="email" class="form-control pln-form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="text-danger mt-2"><i class="fas fa-exclamation-circle me-1"></i> {{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary pln-btn-primary w-100 mt-3">
                            <i class="fas fa-save me-2"></i> Simpan Perubahan
                        </button>
                    </form>
                </div>
            </div>

            {{-- Card Ganti Password --}}
            <div class="card pln-card-profile shadow-lg border-0 animate__animated animate__fadeIn">
                <div class="card-header text-white text-center py-4 pln-card-header">
                    <div class="profile-avatar-container mb-3">
                        <i class="fas fa-lock fa-5x"></i>
                    </div>
                    <h4 class="mb-0 fw-bold">Ganti Password</h4>
                    <p class="text-white-50 mb-0">Pastikan password Anda aman dan kuat</p>
                </div>
                <div class="card-body p-5">
                    <form action="{{ route('profile.password.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="current_password" class="form-label fw-bold pln-text">Password Saat Ini</label>
                            <input type="password" class="form-control pln-form-control" id="current_password" name="current_password" required>
                            @error('current_password')
                                <div class="text-danger mt-2"><i class="fas fa-exclamation-circle me-1"></i> {{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold pln-text">Password Baru</label>
                            <input type="password" class="form-control pln-form-control" id="password" name="password" required>
                            @error('password')
                                <div class="text-danger mt-2"><i class="fas fa-exclamation-circle me-1"></i> {{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label fw-bold pln-text">Konfirmasi Password Baru</label>
                            <input type="password" class="form-control pln-form-control" id="password_confirmation" name="password_confirmation" required>
                        </div>
                        <button type="submit" class="btn btn-warning pln-btn-accent w-100 mt-3">
                            <i class="fas fa-key me-2"></i> Ganti Password
                        </button>
                    </form>
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
    
    /* Styling untuk form */
    .pln-text {
        color: #0077b6 !important;
    }
    .pln-form-control {
        border-radius: 0.5rem;
        border: 1px solid #ced4da;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }
    .pln-form-control:focus {
        border-color: #ffd60a;
        box-shadow: 0 0 0 0.25rem rgba(255, 214, 10, 0.25);
    }

    /* Styling tombol */
    .pln-btn-primary {
        background-color: #0077b6;
        border-color: #0077b6;
        color: #ffffff;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .pln-btn-primary:hover {
        background-color: #005f93;
        border-color: #005f93;
        transform: translateY(-2px);
    }
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
        color: #005f93;
        transform: translateY(-2px);
    }

    /* Styling alert */
    .pln-alert-success {
        background-color: rgba(0, 180, 216, 0.1);
        border-color: rgba(0, 119, 182, 0.5);
        color: #0077b6;
    }
    .pln-alert-success .btn-close {
        filter: invert(100%);
    }

</style>
@endsection