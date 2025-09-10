@extends('layouts.main')

@section('content')
<div class="edit-profile-container">
    <div class="container-fluid">
        
        {{-- Success Alert --}}
        @if(session('success'))
            <div class="alert success-alert alert-dismissible fade show" role="alert">
                <div class="alert-content">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('success') }}</span>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Page Header --}}
        <div class="page-header-section">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-4 text-center mb-3 mb-md-0">
                    <div class="header-icon-section">
                        <div class="header-icon-circle">
                            <i class="fas fa-user-edit"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-6">
                    <div class="header-info">
                        <h1 class="page-title">Edit Profil</h1>
                        <p class="page-subtitle">Perbarui informasi akun Anda dengan mudah dan aman</p>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 text-end">
                    <div class="header-actions">
                        <a href="/hadirin/public/profile" class="back-btn">
                            <i class="fas fa-arrow-left"></i>
                            <span class="back-text">Kembali</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Main Content Area --}}
        <div class="edit-content-section">
            <div class="row justify-content-center">
                
                {{-- Edit Profile Form --}}
                <div class="col-lg-6 col-md-6 mb-4">
                    <div class="content-card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-user-cog"></i>
                                Informasi Akun
                            </h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('profile.update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                
                                <div class="form-group">
                                    <label for="name" class="form-label">
                                        <i class="fas fa-id-badge"></i>
                                        <span>Nama Lengkap</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           id="name" 
                                           name="name" 
                                           value="{{ old('name', $user->name) }}" 
                                           required>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-circle"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email" class="form-label">
                                        <i class="fas fa-envelope"></i>
                                        <span>Alamat Email</span>
                                    </label>
                                    <input type="email" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           id="email" 
                                           name="email" 
                                           value="{{ old('email', $user->email) }}" 
                                           required>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-circle"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-actions">
                                    <button type="submit" class="action-btn primary full-width">
                                        <i class="fas fa-save"></i>
                                        <div class="btn-content">
                                            <span class="btn-title">Simpan Perubahan</span>
                                            <span class="btn-subtitle">Update informasi profil</span>
                                        </div>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Change Password Form --}}
                <div class="col-lg-6 col-md-6 mb-4">
                    <div class="content-card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-shield-alt"></i>
                                Keamanan Akun
                            </h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('profile.password.update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                
                                <div class="form-group">
                                    <label for="current_password" class="form-label">
                                        <i class="fas fa-lock"></i>
                                        <span>Password Saat Ini</span>
                                    </label>
                                    <div class="input-group @error('current_password') is-invalid-group @enderror">
                                        <input type="password" 
                                               class="form-control" 
                                               id="current_password" 
                                               name="current_password" 
                                               required>
                                        <i class="fa fa-eye-slash toggle-password" onclick="togglePasswordVisibility('current_password', this)"></i>
                                    </div>
                                    @error('current_password')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-circle"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password" class="form-label">
                                        <i class="fas fa-key"></i>
                                        <span>Password Baru</span>
                                    </label>
                                    <div class="input-group @error('password') is-invalid-group @enderror">
                                        <input type="password" 
                                               class="form-control" 
                                               id="password" 
                                               name="password" 
                                               required>
                                        <i class="fa fa-eye-slash toggle-password" onclick="togglePasswordVisibility('password', this)"></i>
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-circle"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password_confirmation" class="form-label">
                                        <i class="fas fa-check-double"></i>
                                        <span>Konfirmasi Password Baru</span>
                                    </label>
                                    <div class="input-group">
                                        <input type="password" 
                                               class="form-control" 
                                               id="password_confirmation" 
                                               name="password_confirmation" 
                                               required>
                                        <i class="fa fa-eye-slash toggle-password" onclick="togglePasswordVisibility('password_confirmation', this)"></i>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <button type="submit" class="action-btn warning full-width">
                                        <i class="fas fa-shield-check"></i>
                                        <div class="btn-content">
                                            <span class="btn-title">Ganti Password</span>
                                            <span class="btn-subtitle">Perbarui keamanan akun</span>
                                        </div>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </div>
</div>

<style>
/* Global Styles */
body {
    margin: 0;
    padding: 0;
    background-color: #f8f9fa;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #2c3e50;
    line-height: 1.6;
}

.edit-profile-container {
    padding-top: 80px;
    min-height: 100vh;
}

.container-fluid {
    max-width: 1200px;
    margin: 0 auto;
    padding: 1.5rem;
}

/* Success Alert */
.success-alert {
    background: linear-gradient(135deg, rgba(40, 167, 69, 0.1), rgba(40, 167, 69, 0.05));
    border: 1px solid rgba(40, 167, 69, 0.3);
    border-radius: 10px;
    margin-bottom: 2rem;
    padding: 1rem 1.5rem;
    border-left: 4px solid #28a745;
}

.alert-content {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    color: #155724;
    font-weight: 500;
}

.alert-content i {
    font-size: 1.2rem;
    color: #28a745;
}

/* Page Header Section */
.page-header-section {
    background: linear-gradient(135deg, #0077b6 0%, #00b4d8 100%);
    color: white;
    padding: 2rem 1.5rem;
    border-radius: 10px;
    margin-bottom: 2rem;
    box-shadow: 0 4px 20px rgba(0, 119, 182, 0.2);
}

.header-icon-section {
    position: relative;
    display: inline-block;
}

.header-icon-circle {
    width: 100px;
    height: 100px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 3px solid rgba(255, 255, 255, 0.3);
    transition: all 0.3s ease;
    margin: 0 auto;
}

.header-icon-circle:hover {
    border-color: #ffd60a;
    transform: scale(1.05);
}

.header-icon-circle i {
    font-size: 3.5rem;
    color: white;
}

.header-info {
    padding-left: 1rem;
}

.header-actions {
    display: flex;
    justify-content: flex-end;
}

.back-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    color: white;
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 500;
    padding: 0.5rem 1rem;
    background: rgba(255, 255, 255, 0.15);
    border-radius: 25px;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.back-btn:hover {
    background: rgba(255, 255, 255, 0.25);
    transform: translateX(-3px);
    color: white;
    text-decoration: none;
}

.back-btn i {
    font-size: 0.85rem;
}

.page-title {
    font-size: 2.2rem;
    font-weight: 700;
    margin: 0 0 0.5rem;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.page-subtitle {
    font-size: 1.1rem;
    margin: 0;
    opacity: 0.9;
}

/* Content Cards */
.content-card {
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: 1px solid rgba(0, 0, 0, 0.05);
    height: 100%;
}

.content-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
}

.card-header {
    background: linear-gradient(135deg, #0077b6 0%, #00b4d8 100%);
    padding: 1.2rem 1.5rem;
    border-bottom: none;
}

.card-title {
    margin: 0;
    font-size: 1.2rem;
    font-weight: 600;
    color: white;
    display: flex;
    align-items: center;
    gap: 0.6rem;
}

.card-title i {
    font-size: 1.1rem;
}

.card-body {
    padding: 1.5rem;
}

/* Form Styles */
.form-group {
    margin-bottom: 1.5rem;
}

.form-label {
    display: flex;
    align-items: center;
    gap: 0.6rem;
    font-weight: 600;
    color: #495057;
    margin-bottom: 0.5rem;
    font-size: 0.95rem;
}

.form-label i {
    width: 18px;
    color: #0077b6;
    font-size: 1rem;
}

/* ========================================================== */
/* PERBAIKAN STYLING UNTUK BORDER RADIUS */
/* ========================================================== */

.input-group {
    position: relative;
    display: flex; /* Tambahkan ini agar input dan ikon berdampingan */
    align-items: center;
    border: 2px solid #e9ecef;
    border-radius: 8px; /* Pastikan border radius diterapkan pada div pembungkus */
    background-color: #f8f9fa;
    transition: all 0.3s ease;
}

.input-group:focus-within {
    border-color: #ffd60a;
    box-shadow: 0 0 0 0.25rem rgba(255, 214, 10, 0.25);
    background-color: white;
}

.input-group.is-invalid-group {
    border-color: #dc3545 !important;
    background-color: #fff5f5;
}

/* Atur input agar mengisi ruang dan memiliki border radius kiri */
.input-group .form-control {
    flex-grow: 1; /* Input mengambil sisa ruang */
    border: none;
    background-color: transparent;
    padding: 0.75rem 1rem;
    font-size: 0.95rem;
    border-top-left-radius: 8px; /* Pastikan hanya sisi kiri yang melengkung */
    border-bottom-left-radius: 8px;
    border-top-right-radius: 0; /* Hapus lengkungan di sisi kanan input */
    border-bottom-right-radius: 0;
    transition: all 0.3s ease;
}

/* Hilangkan box-shadow bawaan dari input saat fokus */
.input-group .form-control:focus {
    box-shadow: none;
    outline: none;
}

/* Atur posisi dan styling ikon toggle */
.toggle-password {
    padding: 0.75rem 1rem; /* Beri padding agar ukurannya pas */
    cursor: pointer;
    color: #999;
    transition: color 0.3s ease;
    z-index: 5;
    /* Pastikan ikon tidak memengaruhi border radius container */
    border-top-right-radius: 8px; 
    border-bottom-right-radius: 8px;
    background-color: transparent;
}

.toggle-password:hover {
    color: #0077b6;
}

/* ========================================================== */
/* AKHIR PERBAIKAN STYLING */
/* ========================================================== */


.form-control {
    border: 2px solid #e9ecef;
    border-radius: 8px;
    padding: 0.75rem 1rem;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    background-color: #f8f9fa;
}

.form-control:focus {
    border-color: #ffd60a;
    box-shadow: 0 0 0 0.25rem rgba(255, 214, 10, 0.25);
    background-color: white;
    outline: none;
}

.form-control.is-invalid {
    border-color: #dc3545;
    background-color: #fff5f5;
}

.invalid-feedback {
    display: block;
    color: #dc3545;
    font-size: 0.85rem;
    margin-top: 0.5rem;
    font-weight: 500;
}

.invalid-feedback i {
    margin-right: 0.25rem;
}

/* Form Actions */
.form-actions {
    margin-top: 2rem;
    padding-top: 1.5rem;
    border-top: 1px solid #e9ecef;
}

/* Action Buttons */
.action-btn {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem 1.5rem;
    border: none;
    border-radius: 8px;
    text-decoration: none;
    transition: all 0.3s ease;
    cursor: pointer;
    font-weight: 500;
    font-size: 0.95rem;
}

.action-btn.full-width {
    width: 100%;
    justify-content: center;
}

.action-btn.primary {
    background: linear-gradient(135deg, #ffd60a, #ffc400);
    color: #0077b6;
    box-shadow: 0 3px 12px rgba(255, 214, 10, 0.3);
}

.action-btn.primary:hover {
    background: linear-gradient(135deg, #ffc400, #ffb700);
    transform: translateY(-2px);
    box-shadow: 0 4px 16px rgba(255, 214, 10, 0.4);
    color: #0077b6;
    text-decoration: none;
}

.action-btn.warning {
    background: linear-gradient(135deg, #ff8c00, #ff7700);
    color: white;
    box-shadow: 0 3px 12px rgba(255, 140, 0, 0.3);
}

.action-btn.warning:hover {
    background: linear-gradient(135deg, #ff7700, #ff6600);
    transform: translateY(-2px);
    box-shadow: 0 4px 16px rgba(255, 140, 0, 0.4);
    color: white;
    text-decoration: none;
}

.action-btn.secondary {
    background: #f8f9fa;
    color: #495057;
    border: 2px solid #e9ecef;
    width: 100%;
    justify-content: center;
}

.action-btn.secondary:hover {
    background: #e3f2fd;
    border-color: #0077b6;
    color: #0077b6;
    text-decoration: none;
}

.action-btn i {
    font-size: 1.2rem;
    width: 22px;
    text-align: center;
}

.btn-content {
    display: flex;
    flex-direction: column;
}

.btn-title {
    font-weight: 600;
    font-size: 0.95rem;
}

.btn-subtitle {
    font-size: 0.8rem;
    opacity: 0.7;
    margin-top: 2px;
}



/* Responsive Design */
@media (max-width: 992px) {
    .header-info {
        padding-left: 0;
        text-align: center;
        margin-top: 1rem;
    }
    
    .header-actions {
        justify-content: center;
        margin-top: 1rem;
    }
    
    .page-title {
        font-size: 2rem;
    }
}

@media (max-width: 768px) {
    .container-fluid {
        padding: 1rem;
    }
    
    .edit-profile-container {
        padding-top: 60px;
    }
    
    .page-header-section {
        padding: 1.5rem 1.2rem;
        text-align: center;
    }
    
    .header-info {
        padding-left: 0;
        text-align: center;
        margin-top: 1rem;
    }
    
    .header-actions {
        justify-content: center;
        margin-top: 1rem;
    }
    
    .back-text {
        display: none; /* Hide text on mobile */
    }
    
    .back-btn {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        padding: 0;
        justify-content: center;
    }
    
    .page-title {
        font-size: 1.8rem;
    }
    
    .page-subtitle {
        font-size: 1rem;
    }
    
    .header-icon-circle {
        width: 80px;
        height: 80px;
    }
    
    .header-icon-circle i {
        font-size: 3rem;
    }
    
    .card-header, .card-body {
        padding: 1.2rem;
    }
    
    .form-group {
        margin-bottom: 1.2rem;
    }
    
    .action-btn {
        padding: 0.8rem 1.2rem;
    }
}

@media (max-width: 576px) {
    .page-header-section {
        padding: 1.2rem 0.8rem;
        margin-bottom: 1rem;
    }
    
    .header-info {
        padding-left: 0;
        text-align: center;
        margin-top: 1rem;
    }
    
    .header-actions {
        justify-content: center;
        margin-top: 1rem;
    }
    
    .page-title {
        font-size: 1.6rem;
    }
    
    .page-subtitle {
        font-size: 0.95rem;
    }
    
    .header-icon-circle {
        width: 70px;
        height: 70px;
    }
    
    .header-icon-circle i {
        font-size: 2.5rem;
    }
    
    .back-btn {
        width: 35px;
        height: 35px;
    }
    
    .card-header, .card-body {
        padding: 1rem;
    }
    
    .card-title {
        font-size: 1.1rem;
    }
    
    .form-group {
        margin-bottom: 1rem;
    }
    
    .action-btn {
        padding: 0.8rem;
    }
    
    .btn-content {
        text-align: center;
    }
}

/* Animation */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.content-card {
    animation: fadeInUp 0.6s ease forwards;
}

.content-card:nth-child(1) { animation-delay: 0.1s; }
.content-card:nth-child(2) { animation-delay: 0.2s; }
.content-card:nth-child(3) { animation-delay: 0.3s; }

/* Print Styles */
@media print {
    .action-btn, .content-card:hover {
        transform: none !important;
    }
    
    .page-header-section {
        background: #0077b6 !important;
        -webkit-print-color-adjust: exact;
    }
}
</style>

<script>
// Form validation and smooth animations
document.addEventListener('DOMContentLoaded', function() {
    // Smooth page load animation
    const cards = document.querySelectorAll('.content-card, .page-header-section, .success-alert');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            card.style.transition = 'all 0.6s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });

    // Enhanced form validation
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> <div class="btn-content"><span class="btn-title">Memproses...</span><span class="btn-subtitle">Harap tunggu</span></div>';
                submitBtn.disabled = true;
            }
        });
    });

    // Real-time form validation feedback
    const inputs = document.querySelectorAll('.form-control');
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            if (this.checkValidity()) {
                this.classList.remove('is-invalid');
                this.classList.add('is-valid');
            } else {
                this.classList.remove('is-valid');
            }
        });
    });

    // Password confirmation validation
    const password = document.getElementById('password');
    const passwordConfirm = document.getElementById('password_confirmation');
    
    if (password && passwordConfirm) {
        function validatePasswordMatch() {
            if (passwordConfirm.value && password.value !== passwordConfirm.value) {
                passwordConfirm.setCustomValidity('Password tidak cocok');
                // Tambahkan kelas invalid pada input-group, bukan inputnya langsung
                passwordConfirm.closest('.input-group').classList.add('is-invalid-group');
            } else {
                passwordConfirm.setCustomValidity('');
                passwordConfirm.closest('.input-group').classList.remove('is-invalid-group');
            }
        } 
        
        password.addEventListener('input', validatePasswordMatch);
        passwordConfirm.addEventListener('input', validatePasswordMatch);
    }
});

/**
 * Function to toggle password visibility
 * @param {string} inputId - The ID of the password input field.
 * @param {object} icon - The icon element that was clicked.
 */
function togglePasswordVisibility(inputId, icon) {
    const input = document.getElementById(inputId);
    const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
    input.setAttribute('type', type);
    icon.classList.toggle('fa-eye');
    icon.classList.toggle('fa-eye-slash');
}
</script>
@endsection