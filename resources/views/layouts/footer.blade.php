<!-- PLN-inspired Footer -->
<footer class="footer-pln mt-5">
    <div class="container">
        <!-- Main Footer Content -->
        <div class="row py-5">
            <!-- Company Info -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="footer-brand mb-3">
                    <img src="{{ asset('images/logo_saja.png') }}" alt="Logo PLN" class="footer-logo me-2">
                    <h5 class="footer-title">{{ config('app.name', 'Aplikasi') }}</h5>
                </div>
                <p class="footer-description">
                    Sistem presensi digital untuk mendukung pencatatan kehadiran, manajemen acara, dan pelayanan 
                    terbaik pada setiap kegiatan secara efisien dan berkelanjutan.
                </p>
                <div class="social-links">
                    {{-- <a href="#" class="social-link" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-link" title="Twitter"><i class="fab fa-twitter"></i></a> --}}
                    {{-- <a href="#" class="social-link" title="Instagram"><i class="fab fa-instagram"></i></a> --}}
                    {{-- <a href="#" class="social-link" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="social-link" title="YouTube"><i class="fab fa-youtube"></i></a> --}}
                    <a href="https://www.instagram.com/eltrafo/" target="_blank" class="social-link" title="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-2 col-md-6 mb-4">
                <h6 class="footer-heading">Menu Utama</h6>
                <ul class="footer-links">
                    <li><a href="{{ route('home') }}" class="footer-link">
                        <i class="fas fa-home me-2"></i>Home
                    </a></li>
                    <li><a href="{{ route('presence.index') }}" class="footer-link">
                        <i class="fas fa-calendar-check me-2"></i>Daftar Kegiatan
                    </a></li>
                    <li><a href="{{ route('users.index') }}" class="footer-link">
                        <i class="fas fa-user-cog me-2"></i>Data User
                    </a></li>
                    <li><a href="{{ route('profile') }}" class="footer-link">
                        <i class="fas fa-user me-2"></i>Profile
                    </a></li>
                </ul>
            </div>

            <!-- Master Data Links -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h6 class="footer-heading">Master Data</h6>
                <ul class="footer-links">
                    <li><a href="{{ route('companies.index') }}" class="footer-link">
                        <i class="fas fa-building me-2"></i>Data Perusahaan
                    </a></li>
                    <li><a href="{{ route('company-units.index') }}" class="footer-link">
                        <i class="fas fa-sitemap me-2"></i>Data Unit
                    </a></li>
                    <li><a href="{{ route('pln-members.index') }}" class="footer-link">
                        <i class="fas fa-users me-2"></i>Daftar Anggota PLN
                    </a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h6 class="footer-heading">Kontak Kami</h6>
                <div class="contact-info">
                    <div class="contact-item">
                        <i class="fas fa-map-marker-alt contact-icon"></i>
                        <div class="contact-details">
                            <span class="contact-label">Alamat:</span>
                            <span class="contact-value">Jl. Raya Karanglo No.90<br>Kabupaten Malang, Jawa Timur 65153</span>
                        </div>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-phone contact-icon"></i>
                        <div class="contact-details">
                            <span class="contact-label">Telepon:</span>
                            <span class="contact-value">(0341) 478030</span>
                        </div>
                    </div>
                    {{-- <div class="contact-item">
                        <i class="fas fa-envelope contact-icon"></i>
                        <div class="contact-details">
                            <span class="contact-label">Email:</span>
                            <span class="contact-value">info@pln.co.id</span>
                        </div>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-globe contact-icon"></i>
                        <div class="contact-details">
                            <span class="contact-label">Website:</span>
                            <span class="contact-value">www.pln.co.id</span>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="row align-items-center">
                <div class="col-12 text-center">
                    <p class="copyright-text">
                        © 2025 Hadirin. All rights reserved.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Decorative Elements -->
    <div class="footer-decoration">
        <div class="decoration-circle circle-1"></div>
        <div class="decoration-circle circle-2"></div>
        <div class="decoration-circle circle-3"></div>
    </div>
</footer>

<style>
/* PLN-inspired Footer Styling */
.footer-pln {
    background: linear-gradient(135deg, #0077b6 0%, #00b4d8 50%, #0099d4 100%);
    color: #ffffff;
    position: relative;
    overflow: hidden;
    margin: 0;
    padding: 0;
    width: 100%;
}

.footer-pln::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #ffd60a 0%, #ffed4a 50%, #ffd60a 100%);
    animation: shimmer 3s ease-in-out infinite;
}

@keyframes shimmer {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.7; }
}

.footer-brand {
    display: flex;
    align-items: center;
    margin-bottom: 1rem;
}

.footer-logo {
    height: 40px;
    transition: all 0.3s ease;
}

.footer-title {
    color: #ffffff;
    font-weight: 700;
    margin: 0;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.footer-brand:hover .footer-logo {
    transform: scale(1.1) rotate(5deg);
}

.footer-brand:hover .footer-title {
    color: #ffd60a;
}

.footer-description {
    color: #e6f3ff;
    line-height: 1.6;
    margin-bottom: 1.5rem;
    font-size: 0.95rem;
}

.footer-heading {
    color: #ffd60a;
    font-weight: 600;
    margin-bottom: 1.5rem;
    position: relative;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.footer-heading::after {
    content: '';
    position: absolute;
    bottom: -8px;
    left: 0;
    width: 30px;
    height: 2px;
    background: linear-gradient(90deg, #ffd60a, #ffed4a);
    border-radius: 1px;
    transition: width 0.3s ease;
}

.footer-heading:hover::after {
    width: 50px;
}

.footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-links li {
    margin-bottom: 0.8rem;
    transform: translateX(0);
    transition: all 0.3s ease;
}

.footer-link {
    color: #e6f3ff;
    text-decoration: none;
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    transition: all 0.3s ease;
    position: relative;
}

.footer-link:hover {
    color: #ffd60a;
    text-decoration: none;
    transform: translateX(5px);
}

.footer-link i {
    font-size: 0.8rem;
    width: 16px;
    opacity: 0.7;
    transition: all 0.3s ease;
}

.footer-link:hover i {
    opacity: 1;
    transform: scale(1.2);
}

/* Social Links */
.social-links {
    display: flex;
    gap: 1rem;
    margin-top: 1rem;
}

.social-link {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    background: rgba(255, 255, 255, 0.1);
    color: #ffffff;
    text-decoration: none;
    border-radius: 50%;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 214, 10, 0.2);
}

.social-link:hover {
    background: #ffd60a;
    color: #0077b6;
    transform: translateY(-3px) scale(1.1);
    box-shadow: 0 5px 15px rgba(255, 214, 10, 0.4);
}

/* Contact Info */
.contact-info {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.contact-item {
    display: flex;
    align-items: flex-start;
    gap: 0.8rem;
}

.contact-icon {
    color: #ffd60a;
    font-size: 1rem;
    margin-top: 0.2rem;
    min-width: 20px;
}

.contact-details {
    display: flex;
    flex-direction: column;
    flex: 1;
}

.contact-label {
    color: #b3d9ff;
    font-size: 0.85rem;
    font-weight: 500;
    margin-bottom: 0.2rem;
}

.contact-value {
    color: #ffffff;
    font-size: 0.9rem;
    line-height: 1.4;
}

/* Footer Bottom - Jarak dipersempit */
.footer-bottom {
    border-top: 1px solid rgba(255, 214, 10, 0.2);
    padding: 1rem 0;  /* Dikurangi dari 1.5rem menjadi 1rem */
    margin-top: 1rem; /* Dikurangi dari 2rem menjadi 1rem */
    background: rgba(0, 0, 0, 0.1);
    backdrop-filter: blur(5px);
}

.copyright-text {
    margin: 0;
    color: #ffffff;
    font-size: 0.9rem;
}

.text-highlight {
    color: #ffd60a;
    font-weight: 500;
}

.footer-bottom-links {
    display: flex;
    gap: 1.5rem;
    justify-content: flex-end;
    align-items: center;
}

.footer-bottom-link {
    color: #e6f3ff;
    text-decoration: none;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    position: relative;
}

.footer-bottom-link:hover {
    color: #ffd60a;
    text-decoration: none;
}

.footer-bottom-link::after {
    content: '';
    position: absolute;
    bottom: -3px;
    left: 0;
    width: 0;
    height: 1px;
    background: #ffd60a;
    transition: width 0.3s ease;
}

.footer-bottom-link:hover::after {
    width: 100%;
}

/* Decorative Elements */
.footer-decoration {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    z-index: 1;
}

.decoration-circle {
    position: absolute;
    border-radius: 50%;
    background: rgba(255, 214, 10, 0.1);
    animation: float 6s ease-in-out infinite;
}

.circle-1 {
    width: 100px;
    height: 100px;
    top: 10%;
    right: 5%;
    animation-delay: 0s;
}

.circle-2 {
    width: 60px;
    height: 60px;
    top: 60%;
    right: 15%;
    animation-delay: 2s;
}

.circle-3 {
    width: 80px;
    height: 80px;
    bottom: 10%;
    left: 10%;
    animation-delay: 4s;
}

@keyframes float {
    0%, 100% {
        transform: translateY(0) rotate(0deg);
        opacity: 0.3;
    }
    50% {
        transform: translateY(-20px) rotate(180deg);
        opacity: 0.6;
    }
}

/* Responsive Design */
@media (max-width: 768px) {
    .social-links {
        justify-content: center;
    }
    
    .contact-item {
        align-items: center;
    }
    
    .footer-decoration {
        display: none; /* Hide decorations on mobile for performance */
    }

    /* Jarak mobile juga dipersempit */
    .footer-bottom {
        padding: 0.8rem 0;
        margin-top: 0.8rem;
    }
}

@media (max-width: 576px) {
    .footer-brand {
        justify-content: center;
        text-align: center;
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .footer-heading {
        text-align: center;
    }
    
    .footer-links {
        text-align: center;
    }
    
    .contact-info {
        text-align: center;
    }
    
    .contact-item {
        justify-content: center;
    }

    /* Jarak mobile small dipersempit lagi */
    .footer-bottom {
        padding: 0.6rem 0;
        margin-top: 0.6rem;
    }
}

/* Smooth transitions for all elements */
.footer-pln * {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Ensure footer content is above decorative elements */
.footer-pln .container {
    position: relative;
    z-index: 2;
}
</style>