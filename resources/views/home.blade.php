@extends('layouts.main')

@section('content')
<div class="container my-5">
    <div class="card pln-auth-card pln-dashboard-card">
        <div class="card-body pln-auth-body pln-dashboard-body">
            @if (session('status'))
            <div class="alert alert-success pln-alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

            {{-- Hero Section --}}
            <div class="pln-hero-section text-center mb-5">
                <img src="{{ asset('images/logo_saja.png') }}" alt="Logo PLN" class="pln-hero-logo mb-4">
                <h1 class="pln-hero-title mb-3 animate__animated animate__fadeInDown">Selamat Datang di HADIRIN</h1>
                <p class="pln-hero-subtitle mb-4 animate__animated animate__fadeInUp" style="max-width: 700px; margin: 0 auto 2rem;">Sistem Informasi Absensi Online PLN UPT Malang untuk pengelolaan kegiatan dan data anggota.</p>
                <a href="{{ route('presence.index') }}" class="btn pln-btn-hero animate__animated animate__zoomIn">
                    <i class="fas fa-play-circle me-2"></i> Tambah Agenda
                </a>
            </div>

            <hr class="pln-divider my-5">

            {{-- Dashboard Sections --}}
            <h3 class="pln-section-title text-center mb-4 animate__animated animate__fadeIn">Ringkasan Cepat</h3>
            <div class="row text-center mb-5">
                <div class="col-md-4 mb-4 animate__animated animate__fadeInUp">
                    <div class="pln-stat-card">
                        <i class="fas fa-calendar-check pln-stat-icon mb-3"></i>
                        <div class="pln-stat-value">
                            <span class="count-up" data-target="{{ $totalKegiatan }}">0</span>
                        </div>
                        <div class="pln-stat-label">Total Kegiatan</div>
                    </div>
                </div>
                <div class="col-md-4 mb-4 animate__animated animate__fadeInUp animate__delay-1s">
                    <div class="pln-stat-card">
                        <i class="fas fa-users pln-stat-icon mb-3"></i>
                        <div class="pln-stat-value">
                            <span class="count-up" data-target="{{ $totalAnggota }}">0</span>
                        </div>
                        <div class="pln-stat-label">Total Anggota Terdaftar</div>
                    </div>
                </div>
                <div class="col-md-4 mb-4 animate__animated animate__fadeInUp animate__delay-2s">
                    <div class="pln-stat-card">
                        <i class="fas fa-check-circle pln-stat-icon mb-3"></i>
                        <div class="pln-stat-value">
                            <span class="count-up" data-target="{{ $persentaseKehadiran }}">0</span>%
                        </div>
                        <div class="pln-stat-label">Tingkat Kehadiran</div>
                    </div>
                </div>
            </div>

            <hr class="pln-divider my-5">

            <h3 class="pln-section-title text-center mb-4 animate__animated animate__fadeIn">Jadwal & Notifikasi</h3>
            <div class="row">
                <div class="col-lg-6 mb-4 animate__animated animate__fadeInLeft">
                    <div class="card h-100 pln-notification-card">
                        <div class="card-body">
                            <h5 class="card-title pln-action-title notification-title"><i class="fas fa-bell me-2"></i> Notifikasi Real-time</h5>
                            <div id="notifications" class="notification-list">
                                {{-- Notifikasi akan dimuat di sini oleh JavaScript --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4 animate__animated animate__fadeInRight">
                    <div class="card h-100 pln-calendar-card">
                        <div class="card-body">
                            <h5 class="card-title pln-action-title calendar-title"><i class="fas fa-calendar-alt me-2"></i> Jadwal Kegiatan</h5>
                            <div id='calendar'></div>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="pln-divider my-5">

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
                <p class="pln-cta-text">Atur profil dan data akun Anda di sini</p>
                <a href="{{ route('profile') }}" class="btn pln-btn-secondary pln-btn-full">
                    <i class="fas fa-user-cog me-2"></i> Pengaturan Akun
                </a>
            </div>
        </div>
    </div>
</div>

{{-- Modal untuk detail kegiatan --}}
<div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content pln-modal-content">
            <div class="modal-header pln-modal-header">
                <h5 class="modal-title" id="eventModalLabel">Detail Kegiatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pln-modal-body">
                <p><strong>Nama Kegiatan:</strong> <span id="modalEventTitle"></span></p>
                <p><strong>Tanggal:</strong> <span id="modalEventDate"></span></p>
                <p><strong>Waktu Mulai:</strong> <span id="modalEventTime"></span></p>
                {{-- Tambahkan baris ini untuk Batas Waktu --}}
                <p><strong>Batas Waktu:</strong> <span id="modalEventDeadline"></span></p>
                <p><strong>Lokasi:</strong> <span id="modalEventLocation"></span></p>
                <p><strong>Link Lokasi:</strong> <span id="modalEventLink"></span></p>
            </div>
            <div class="modal-footer pln-modal-footer">
                <button type="button" class="btn btn-secondary pln-btn-secondary-modal" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
{{-- CSS untuk Bootstrap 5 dan Font Awesome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/main.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

{{-- JS untuk Bootstrap, FullCalendar, dan Count-up --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/index.global.min.js"></script>
<script>
    // JavaScript for Count-Up Animation
    document.addEventListener('DOMContentLoaded', function() {
        const countUpElements = document.querySelectorAll('.count-up');
        countUpElements.forEach(element => {
            const target = parseFloat(element.getAttribute('data-target'));
            let current = 0;
            const increment = target / 100;
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
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.5
            });
            observer.observe(element);
        });

        // FullCalendar Initialization
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: '/calendar-data', // Mengambil data dari rute calendar-data
            displayEventTime: false, // <-- Baris ini untuk menyembunyikan waktu di tampilan grid
            // ... kode sebelumnya ...

            eventClick: function(info) {
                // Mengambil detail event dari objek info.event
                let eventTitle = info.event.title;
                let eventStart = info.event.start; // Ini akan menjadi objek Date
                let eventExtendedProps = info.event.extendedProps; // Properti tambahan yang kita kirim dari backend

                // Format tanggal dan waktu
                let eventDate = eventStart.toLocaleDateString('id-ID', {
                    day: '2-digit',
                    month: 'long',
                    year: 'numeric'
                });
                let eventTime = eventStart.toLocaleTimeString('id-ID', {
                    hour: '2-digit',
                    minute: '2-digit'
                });

                // Mengisi data ke modal
                document.getElementById('modalEventTitle').textContent = eventTitle;
                document.getElementById('modalEventDate').textContent = eventDate;
                document.getElementById('modalEventTime').textContent = eventTime + ' WIB'; // Tambahkan WIB

                // Menambahkan batas waktu
                let batasWaktuRaw = eventExtendedProps.batas_waktu;
                let formattedBatasWaktu = 'Tidak ada'; // Default value

                if (batasWaktuRaw) {
                    // Coba parse sebagai tanggal dan waktu lengkap
                    let dateObjBatasWaktu = new Date(batasWaktuRaw);

                    // Periksa apakah parsing berhasil (valid date)
                    if (!isNaN(dateObjBatasWaktu.getTime())) {
                        formattedBatasWaktu = dateObjBatasWaktu.toLocaleDateString('id-ID', {
                            day: '2-digit',
                            month: 'long',
                            year: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit'
                        }) + ' WIB';
                    } else {
                        // Jika parsing sebagai tanggal gagal, mungkin itu hanya string waktu atau format lain
                        formattedBatasWaktu = batasWaktuRaw + ' WIB';
                    }
                }
                document.getElementById('modalEventDeadline').textContent = formattedBatasWaktu; // Memperbarui elemen modal

                // Mengambil lokasi dari extendedProps
                document.getElementById('modalEventLocation').textContent = eventExtendedProps.lokasi || 'Tidak ada';
                
                // Mengambil link lokasi dari extendedProps
                let linkLokasiElement = document.getElementById('modalEventLink');
                if (eventExtendedProps.link_lokasi) {
                    linkLokasiElement.innerHTML = `<a href="${eventExtendedProps.link_lokasi}" target="_blank" class="pln-link-location">Klik di sini</a>`;
                } else {
                    linkLokasiElement.textContent = 'Tidak ada';
                }

                // Menampilkan modal
                var eventModal = new bootstrap.Modal(document.getElementById('eventModal'));
                eventModal.show();
            }
        });

        calendar.render();

        // Real-time Notifications
        function fetchNotifications() {
            fetch('/api/notifications')
                .then(response => response.json())
                .then(data => {
                    let notificationsDiv = document.getElementById('notifications');
                    notificationsDiv.innerHTML = ''; // Clear previous notifications
                    if (data.length === 0) {
                        notificationsDiv.innerHTML = '<p class="text-muted text-center">Tidak ada notifikasi baru.</p>';
                        return;
                    }
                    data.forEach(notification => {
                        let notificationCard = document.createElement('div');
                        notificationCard.classList.add('pln-notification-item');

                        let namaAnggota = notification.pln_member ? notification.pln_member.nama : (notification.nama || 'Anggota Tidak Dikenal');
                        let namaKegiatan = notification.presence ? notification.presence.nama_kegiatan : 'Kegiatan Tidak Dikenal';
                        let absenTime = new Date(notification.created_at).toLocaleTimeString('id-ID', {
                            hour: '2-digit',
                            minute: '2-digit',
                            second: '2-digit'
                        });
                        let absenDate = new Date(notification.created_at).toLocaleDateString('id-ID', {
                            day: '2-digit',
                            month: 'short',
                            year: 'numeric'
                        });

                        notificationCard.innerHTML = `
                            <div class="notification-icon"><i class="fas fa-user-check"></i></div>
                            <div class="notification-content">
                                <p class="notification-text"><strong>${namaAnggota}</strong> telah absen di <strong>${namaKegiatan}</strong>.</p>
                                <span class="notification-time"><i class="far fa-clock me-1"></i> ${absenTime} WIB pada ${absenDate}</span>
                            </div>
                        `;
                        notificationsDiv.appendChild(notificationCard);
                    });
                })
                .catch(error => console.error('Error fetching notifications:', error));
        }

        // Fetch notifications initially and then every 5 seconds
        fetchNotifications();
        setInterval(fetchNotifications, 5000);
    });
</script>

<style>
    /* Global Styles */
    body {
        background-color: #f0f8ff;
        /* Light blue background for the whole page */
        font-family: 'Inter', sans-serif; /* Menggunakan font Inter */
    }

    /* Main Card Styling */
    .pln-dashboard-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0, 116, 182, 0.1);
        backdrop-filter: blur(5px);
        animation: fadeInScale 0.8s ease-out;
        /* Custom animation for card appearance */
        overflow: hidden;
        /* To contain any inner elements' overflow */
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
        height: 60px;
        /* Larger logo for hero */
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
        height: 100%;
        /* Ensure cards are same height */
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
        height: 6px;
        /* Garis tebal di atas */
        background: linear-gradient(90deg, #00b4d8, #0077b6);
        transition: all 0.3s ease;
        transform: scaleX(0);
        transform-origin: left;
    }

    .pln-action-card:hover::before {
        transform: scaleX(1);
        /* Garis meluas saat hover */
    }

    .pln-action-card:hover {
        box-shadow: 0 15px 45px rgba(0, 116, 182, 0.2);
        transform: translateY(-7px);
    }

    .pln-action-card .card-body {
        padding: 2.5rem;
        display: flex;
        align-items: center;
        flex-grow: 1;
        /* Allows content to expand */
    }

    .pln-action-icon {
        font-size: 4rem;
        color: #00b4d8;
        /* Warna ikon yang lebih cerah */
        opacity: 0.7;
        margin-right: 1.5rem;
        min-width: 4rem;
        /* Ensure consistent spacing */
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

    /* New styles for dashboard cards */
    .card .card-title {
        color: #495057;
        font-weight: bold;
        font-size: 1.25rem;
    }

    /* FullCalendar styling */
    #calendar {
        max-width: 100%;
        margin: 0 auto;
        padding: 15px; /* Add some padding inside the calendar card */
        border-radius: 15px; /* Match card border-radius */
        background-color: #fdfdfd; /* Slightly off-white background for calendar */
        box-shadow: inset 0 0 10px rgba(0, 180, 216, 0.05); /* Soft inner shadow */
    }

    .fc .fc-toolbar-title {
        font-size: 1.5rem;
        color: #0077b6;
        font-weight: 700;
    }

    .fc .fc-button-primary {
        background-color: #00b4d8;
        border-color: #00b4d8;
        color: white;
        border-radius: 8px;
        transition: all 0.2s ease;
    }

    .fc .fc-button-primary:hover {
        background-color: #0077b6;
        border-color: #0077b6;
        box-shadow: 0 2px 8px rgba(0, 116, 182, 0.2);
    }

    .fc .fc-button-primary:not(:disabled).fc-button-active {
        background-color: #0077b6;
        border-color: #0077b6;
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.2);
    }

    .fc-daygrid-day-number {
        font-weight: 600;
        color: #333;
    }

    .fc-day-other .fc-daygrid-day-number {
        color: #ccc;
    }

    .fc-event {
        background-color: #00b4d8; /* Warna event yang lebih cerah */
        border-color: #00b4d8;
        color: white;
        padding: 4px 8px;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 500;
        margin-bottom: 2px;
        transition: all 0.2s ease;
    }

    .fc-event:hover {
        background-color: #0077b6;
        border-color: #0077b6;
        transform: translateY(-1px);
        box-shadow: 0 2px 5px rgba(0, 116, 182, 0.2);
    }

    /* Custom styles for Notification and Calendar cards */

    .pln-notification-card .card-body {
        display: flex;
        flex-direction: column;
    }

    .pln-notification-card,
    .pln-calendar-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 8px 30px rgba(0, 116, 182, 0.08);
        background: #ffffff;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
        position: relative;
    }

    .pln-notification-card:hover,
    .pln-calendar-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 45px rgba(0, 116, 182, 0.15);
    }

    .notification-title, .calendar-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: #0077b6;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        border-bottom: 1px solid rgba(0, 180, 216, 0.1);
        padding-bottom: 10px;
    }

    .notification-list {
        flex-grow: 1; /* Biarkan elemen ini mengisi sisa ruang yang tersedia */
        /* max-height: 400px; Tambahkan baris ini untuk membatasi tinggi wadah */
        overflow-y: auto; /* Aktifkan scrollbar jika konten melebihi tinggi */
        padding-right: 10px; /* Beri ruang untuk scrollbar */
    }

    /* Custom Scrollbar for notification-list */
    .notification-list::-webkit-scrollbar {
        width: 8px;
    }

    .notification-list::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .notification-list::-webkit-scrollbar-thumb {
        background: #00b4d8;
        border-radius: 10px;
    }

    .notification-list::-webkit-scrollbar-thumb:hover {
        background: #0077b6;
    }

    .pln-notification-item {
        display: flex;
        align-items: flex-start;
        padding: 15px;
        margin-bottom: 10px;
        background-color: #f8faff; /* Latar belakang item notifikasi */
        border-radius: 10px;
        border: 1px solid rgba(0, 180, 216, 0.08);
        box-shadow: 0 2px 10px rgba(0, 116, 182, 0.05);
        transition: all 0.2s ease;
    }

    .pln-notification-item:hover {
        background-color: #e6f7ff; /* Warna latar saat hover */
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0, 116, 182, 0.1);
    }

    .notification-icon {
        font-size: 1.5rem;
        color: #00b4d8;
        margin-right: 15px;
        flex-shrink: 0; /* Pastikan ikon tidak menyusut */
        padding-top: 3px; /* Penyesuaian vertikal ikon */
    }

    .notification-content {
        flex-grow: 1;
    }

    .notification-text {
        margin-bottom: 5px;
        font-size: 1rem;
        color: #333;
        line-height: 1.4;
    }

    .notification-text strong {
        color: #0077b6;
    }

    .notification-time {
        font-size: 0.85rem;
        color: #777;
        display: flex;
        align-items: center;
    }

    .notification-time .far {
        font-size: 0.75rem; /* Ukuran ikon jam */
    }

    /* Modal Styling for Event Details */
    .pln-modal-content {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 116, 182, 0.2);
        animation: fadeInScale 0.3s ease-out;
    }

    .pln-modal-header {
        background: linear-gradient(135deg, #00b4d8 0%, #0077b6 100%);
        color: white;
        border-bottom: none;
        padding: 1.5rem;
        font-weight: 600;
    }

    .pln-modal-body {
        padding: 1.5rem;
        font-size: 1rem;
        color: #444;
    }

    .pln-modal-body strong {
        color: #0077b6;
    }

    .pln-modal-footer {
        border-top: 1px solid rgba(0, 180, 216, 0.1);
        padding: 1rem 1.5rem;
    }

    .pln-btn-secondary-modal {
        background: none;
        border: 2px solid #00b4d8;
        color: #00b4d8;
        padding: 0.6rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .pln-btn-secondary-modal:hover {
        background: #e0f2f7;
        border-color: #0077b6;
        color: #0077b6;
    }

    .pln-link-location {
        color: #0077b6;
        text-decoration: underline;
        font-weight: 500;
        transition: color 0.2s ease;
    }

    .pln-link-location:hover {
        color: #00b4d8;
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
        0%,
        20%,
        40%,
        60%,
        80%,
        100% {
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
        .pln-notification-item {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        .notification-icon {
            margin-right: 0;
            margin-bottom: 10px;
        }
    }
</style>
@endpush