@extends('layouts.main')

@section('content')
<div class="profile-container">
    <div class="container-fluid">
        <!-- Profile Header -->
        <div class="profile-header-section">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-4 text-center mb-3 mb-md-0">
                    <div class="profile-avatar-section">
                        <div class="avatar-circle">
                            <i class="fas fa-user-circle"></i>
                        </div>
                        <div class="status-indicator"></div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="profile-header-info">
                        <h1 class="profile-name">{{ $user->name }}</h1>
                        <p class="profile-email">{{ $user->email }}</p>
                        <div class="profile-meta">
                            <span class="meta-item">
                                <i class="fas fa-calendar-alt"></i>
                                Bergabung {{ $user->created_at->format('d M Y') }}
                            </span>
                            <span class="meta-item">
                                <i class="fas fa-shield-check"></i>
                                Account Verified
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="profile-content-section">
            <div class="row">
                <!-- Account Information -->
                <div class="col-lg-8 col-md-7 mb-4">
                    <div class="content-card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-user-cog"></i>
                                Informasi Akun
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="info-row-container">
                                <div class="info-row">
                                    <div class="info-label">
                                        <i class="fas fa-id-badge"></i>
                                        <span>Nama Lengkap</span>
                                    </div>
                                    <div class="info-value">{{ $user->name }}</div>
                                </div>
                                
                                <div class="info-row">
                                    <div class="info-label">
                                        <i class="fas fa-envelope"></i>
                                        <span>Email Address</span>
                                    </div>
                                    <div class="info-value">{{ $user->email }}</div>
                                </div>
                                
                                <div class="info-row">
                                    <div class="info-label">
                                        <i class="fas fa-calendar-plus"></i>
                                        <span>Tanggal Bergabung</span>
                                    </div>
                                    <div class="info-value">{{ $user->created_at->format('d F Y, H:i') }} WIB</div>
                                </div>
                                
                                <div class="info-row">
                                    <div class="info-label">
                                        <i class="fas fa-clock"></i>
                                        <span>Terakhir Diupdate</span>
                                    </div>
                                    <div class="info-value">{{ $user->updated_at->format('d F Y, H:i') }} WIB</div>
                                </div>

                                {{-- Uncomment if you have role field --}}
                                {{-- @if(isset($user->role))
                                <div class="info-row">
                                    <div class="info-label">
                                        <i class="fas fa-user-tag"></i>
                                        <span>Role</span>
                                    </div>
                                    <div class="info-value">
                                        <span class="role-badge">{{ ucfirst($user->role) }}</span>
                                    </div>
                                </div>
                                @endif --}}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Actions -->
                <div class="col-lg-4 col-md-5">
                    <!-- Action Panel -->
                    <div class="content-card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-tools"></i>
                                Aksi
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="action-buttons-vertical">
                                <a href="{{ route('profile.edit') }}" class="action-btn primary">
                                    <i class="fas fa-user-edit"></i>
                                    <div class="btn-content">
                                        <span class="btn-title">Edit Profil</span>
                                        <span class="btn-subtitle">Ubah informasi akun</span>
                                    </div>
                                </a>
                            </div>
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

.profile-container {
    padding-top: 80px;
    min-height: 100vh;
}

.container-fluid {
    max-width: 1200px; /* Reduced from 1400px */
    margin: 0 auto;
    padding: 1.5rem; /* Reduced from 2rem */
}

/* Profile Header Section */
.profile-header-section {
    background: linear-gradient(135deg, #0077b6 0%, #00b4d8 100%);
    color: white;
    padding: 2rem 1.5rem; /* Reduced from 2.5rem 2rem */
    border-radius: 10px; /* Reduced from 12px */
    margin-bottom: 1.5rem; /* Reduced from 2rem */
    box-shadow: 0 4px 20px rgba(0, 119, 182, 0.2);
}

.profile-avatar-section {
    position: relative;
    display: inline-block;
}

.avatar-circle {
    width: 100px; /* Reduced from 120px */
    height: 100px; /* Reduced from 120px */
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 3px solid rgba(255, 255, 255, 0.3); /* Reduced from 4px */
    transition: all 0.3s ease;
    margin: 0 auto;
}

.avatar-circle:hover {
    border-color: #ffd60a;
    transform: scale(1.05);
}

.avatar-circle i {
    font-size: 3.5rem; /* Reduced from 4rem */
    color: white;
}

.status-indicator {
    position: absolute;
    bottom: 5px;
    right: 15px;
    width: 20px; /* Reduced from 24px */
    height: 20px; /* Reduced from 24px */
    background: #28a745;
    border-radius: 50%;
    border: 3px solid white;
}

.status-indicator::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 6px; /* Reduced from 8px */
    height: 6px; /* Reduced from 8px */
    background: white;
    border-radius: 50%;
}

.profile-header-info {
    padding-left: 1rem;
}

.profile-name {
    font-size: 2rem; /* Reduced from 2.5rem */
    font-weight: 700;
    margin: 0;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.profile-email {
    font-size: 1.1rem; /* Reduced from 1.2rem */
    margin: 0.5rem 0 1rem;
    opacity: 0.9;
}

.profile-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem; /* Reduced from 1.5rem */
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 0.4rem; /* Reduced from 0.5rem */
    font-size: 0.9rem; /* Reduced from 0.95rem */
    background: rgba(255, 255, 255, 0.15);
    padding: 0.4rem 0.8rem; /* Reduced from 0.5rem 1rem */
    border-radius: 20px; /* Reduced from 25px */
    backdrop-filter: blur(10px);
}

.meta-item i {
    font-size: 0.85rem; /* Reduced from 0.9rem */
}

/* Content Cards */
.content-card {
    background: white;
    border-radius: 10px; /* Reduced from 12px */
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08); /* Reduced shadow */
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.content-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12); /* Reduced shadow */
}

.card-header {
    background: linear-gradient(135deg, #0077b6 0%, #00b4d8 100%);
    padding: 1.2rem 1.5rem; /* Reduced from 1.5rem 2rem */
    border-bottom: none;
}

.card-title {
    margin: 0;
    font-size: 1.2rem; /* Reduced from 1.3rem */
    font-weight: 600;
    color: white;
    display: flex;
    align-items: center;
    gap: 0.6rem; /* Reduced from 0.75rem */
}

.card-title i {
    font-size: 1.1rem; /* Reduced from 1.2rem */
}

.card-body {
    padding: 1.5rem; /* Reduced from 2rem */
}

/* Information Rows */
.info-row-container {
    display: flex;
    flex-direction: column;
    gap: 1rem; /* Reduced from 1.5rem */
}

.info-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem; /* Reduced from 1.2rem */
    background: #f8f9fa;
    border-radius: 8px;
    border-left: 3px solid #ffd60a; /* Reduced from 4px */
    transition: all 0.3s ease;
}

.info-row:hover {
    background: #e3f2fd;
    border-left-color: #0077b6;
    transform: translateX(3px);
}

.info-label {
    display: flex;
    align-items: center;
    gap: 0.6rem; /* Reduced from 0.75rem */
    font-weight: 600;
    color: #495057;
    flex: 0 0 auto;
}

.info-label i {
    width: 18px; /* Reduced from 20px */
    color: #0077b6;
    font-size: 1rem; /* Reduced from 1.1rem */
}

.info-value {
    font-weight: 500;
    color: #2c3e50;
    text-align: right;
    flex: 1;
    font-size: 0.95rem; /* Added smaller font size */
}

.role-badge {
    background: linear-gradient(135deg, #ffd60a, #ffc400);
    color: #0077b6;
    padding: 0.3rem 0.8rem; /* Reduced from 0.4rem 1rem */
    border-radius: 18px; /* Reduced from 20px */
    font-size: 0.8rem; /* Reduced from 0.85rem */
    font-weight: 600;
}

/* Action Buttons */
.action-buttons-vertical {
    display: flex;
    flex-direction: column;
    gap: 0.8rem; /* Reduced from 1rem */
}

.action-btn {
    display: flex;
    align-items: center;
    gap: 0.8rem; /* Reduced from 1rem */
    padding: 1rem 1.2rem; /* Reduced from 1.2rem 1.5rem */
    border: none;
    border-radius: 8px;
    text-decoration: none;
    transition: all 0.3s ease;
    cursor: pointer;
    width: 100%;
    text-align: left;
}

.action-btn.primary {
    background: linear-gradient(135deg, #ffd60a, #ffc400);
    color: #0077b6;
    box-shadow: 0 3px 12px rgba(255, 214, 10, 0.3); /* Reduced shadow */
}

.action-btn.primary:hover {
    background: linear-gradient(135deg, #ffc400, #ffb700);
    transform: translateY(-2px);
    box-shadow: 0 4px 16px rgba(255, 214, 10, 0.4); /* Reduced shadow */
    color: #0077b6;
    text-decoration: none;
}

.action-btn.secondary {
    background: #f8f9fa;
    color: #495057;
    border: 2px solid #e9ecef;
}

.action-btn.secondary:hover {
    background: #e3f2fd;
    border-color: #0077b6;
    color: #0077b6;
}

.action-btn i {
    font-size: 1.2rem; /* Reduced from 1.3rem */
    width: 22px; /* Reduced from 24px */
    text-align: center;
}

.btn-content {
    display: flex;
    flex-direction: column;
}

.btn-title {
    font-weight: 600;
    font-size: 0.95rem; /* Reduced from 1rem */
}

.btn-subtitle {
    font-size: 0.8rem; /* Reduced from 0.85rem */
    opacity: 0.7;
    margin-top: 2px;
}

/* Responsive Design */
@media (max-width: 992px) {
    .profile-header-info {
        padding-left: 0;
        text-align: center;
        margin-top: 1rem;
    }
    
    .profile-meta {
        justify-content: center;
    }
}

@media (max-width: 768px) {
    .container-fluid {
        padding: 1rem;
    }
    
    .profile-container {
        padding-top: 60px;
    }
    
    .profile-header-section {
        padding: 1.5rem 1.2rem; /* Reduced */
        text-align: center;
    }
    
    .profile-name {
        font-size: 1.8rem; /* Reduced from 2rem */
    }
    
    .profile-email {
        font-size: 1rem; /* Reduced from 1.1rem */
    }
    
    .avatar-circle {
        width: 80px; /* Reduced from 100px */
        height: 80px; /* Reduced from 100px */
    }
    
    .avatar-circle i {
        font-size: 3rem; /* Reduced from 3.5rem */
    }
    
    .card-header, .card-body {
        padding: 1.2rem; /* Reduced from 1.5rem */
    }
    
    .info-row {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
        padding: 0.8rem; /* Reduced */
    }
    
    .info-value {
        text-align: left;
    }
    
    .meta-item {
        font-size: 0.85rem; /* Reduced from 0.9rem */
        padding: 0.3rem 0.6rem; /* Reduced from 0.4rem 0.8rem */
    }
}

@media (max-width: 576px) {
    .profile-header-section {
        padding: 1.2rem 0.8rem; /* Reduced */
        margin-bottom: 1rem;
    }
    
    .profile-name {
        font-size: 1.6rem; /* Reduced from 1.75rem */
    }
    
    .profile-email {
        font-size: 0.95rem; /* Reduced from 1rem */
    }
    
    .avatar-circle {
        width: 70px; /* Reduced from 80px */
        height: 70px; /* Reduced from 80px */
    }
    
    .avatar-circle i {
        font-size: 2.5rem; /* Reduced from 3rem */
    }
    
    .card-header, .card-body {
        padding: 1rem; /* Reduced */
    }
    
    .card-title {
        font-size: 1.1rem;
    }
    
    .info-row {
        padding: 0.8rem; /* Reduced from 1rem */
    }
    
    .action-btn {
        padding: 0.8rem; /* Reduced from 1rem */
    }
    
    .meta-item {
        flex: 1;
        justify-content: center;
        min-width: 0;
    }
    
    .profile-meta {
        flex-direction: column;
        gap: 0.6rem; /* Reduced from 0.75rem */
    }
}

/* Print Styles */
@media print {
    .action-btn, .stat-item:hover, .info-row:hover {
        transform: none !important;
    }
    
    .profile-header-section {
        background: #0077b6 !important;
        -webkit-print-color-adjust: exact;
    }
}
</style>

<script>
// Smooth page load animation
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.content-card, .profile-header-section');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            card.style.transition = 'all 0.6s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });
});
</script>
@endsection