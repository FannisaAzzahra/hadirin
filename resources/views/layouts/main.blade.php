<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Menggunakan config() lebih disarankan daripada env() langsung di Blade --}}
    <title>{{ config('app.name', 'Aplikasi') }}</title>

    {{-- CSRF TOKEN --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- BOOTSTRAP 5.3.3 - SINGLE VERSION --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    {{-- DATATABLES BOOTSTRAP5 --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css">

    {{-- FONT AWESOME - UPDATED VERSION --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        /* Custom PLN-inspired navbar styling */
        .navbar-pln {
            background: linear-gradient(135deg, #00b4d8 0%, #0077b6 100%);
            box-shadow: 0 4px 20px rgba(0, 116, 182, 0.15);
            border-bottom: 3px solid #ffd60a;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1050; /* Ensure navbar is above other content */
        }

        body {
            padding-top: 70px; /* beri padding agar konten tidak ketimpa navbar */
        }

        .navbar-pln:hover {
            box-shadow: 0 6px 25px rgba(0, 116, 182, 0.2);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.8rem;
            color: #ffffff !important;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            display: flex; /* Pastikan flex untuk align-items-center dan gap */
            align-items: center; /* Memastikan vertikal align */
            gap: 0.5rem; /* Menambah sedikit ruang antara logo dan teks */
        }

        .navbar-brand:hover {
            transform: translateY(-1px);
            color: #ffd60a !important;
        }

        .navbar-nav .nav-link {
            color: #ffffff !important;
            font-weight: 500;
            padding: 0.8rem 1.2rem !important;
            margin: 0 0.2rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .navbar-nav .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 214, 10, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .navbar-nav .nav-link:hover::before {
            left: 100%;
        }

        .navbar-nav .nav-link:hover {
            color: #ffd60a !important;
            background: rgba(255, 214, 10, 0.1);
            transform: translateY(-2px);
        }

        .navbar-nav .nav-link.active {
            background: rgba(255, 214, 10, 0.2);
            color: #ffd60a !important;
            border: 1px solid rgba(255, 214, 10, 0.3);
            box-shadow: 0 2px 8px rgba(255, 214, 10, 0.2);
        }

        .navbar-toggler {
            border: 2px solid #ffffff;
            padding: 0.5rem 0.8rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .navbar-toggler:hover {
            border-color: #ffd60a;
            background: rgba(255, 214, 10, 0.1);
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 1%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        .navbar-toggler:focus {
            box-shadow: 0 0 0 0.25rem rgba(255, 214, 10, 0.25);
        }

        /* Dropdown Menu Styling - CRITICAL FIX */
        .dropdown-menu {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            border: 2px solid rgba(255, 214, 10, 0.2);
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0, 119, 182, 0.15);
            padding: 0.5rem 0;
            margin-top: 0.5rem;
            z-index: 1060; /* Higher than navbar z-index */
            position: absolute; /* Ensure proper positioning */
        }

        .dropdown-item {
            color: #0077b6 !important;
            padding: 0.7rem 1.5rem;
            transition: all 0.3s ease;
            border-radius: 8px;
            margin: 0.2rem 0.5rem;
            font-weight: 500;
        }

        .dropdown-item:hover {
            background: linear-gradient(135deg, #ffd60a 0%, #ffed4a 100%);
            color: #0077b6 !important;
            transform: translateX(5px);
        }

        .dropdown-item.active {
            background: linear-gradient(135deg, #0077b6 0%, #00b4d8 100%);
            color: #ffffff !important;
        }

        .dropdown-divider {
            border-color: rgba(255, 214, 10, 0.3);
            margin: 0.5rem 0;
        }

        /* Ensure dropdown toggle works properly */
        .nav-item.dropdown {
            position: relative;
        }

        .nav-item.dropdown .dropdown-toggle::after {
            margin-left: 0.5rem;
            vertical-align: 0.1em;
        }

        /* Mobile responsiveness */
        @media (max-width: 991.98px) {
            .navbar-collapse {
                background: rgba(0, 180, 216, 0.95);
                margin-top: 1rem;
                border-radius: 12px;
                padding: 1rem;
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 214, 10, 0.2);
            }

            .navbar-nav .nav-link {
                margin: 0.2rem 0;
            }

            .dropdown-menu {
                background: rgba(0, 180, 216, 0.9);
                border: 1px solid rgba(255, 214, 10, 0.3);
                position: static; /* Different positioning for mobile */
                float: none;
                width: auto;
                margin-top: 0;
                background-clip: padding-box;
                border-radius: 8px;
            }

            .dropdown-item {
                color: #ffffff !important;
            }

            .dropdown-item:hover {
                background: rgba(255, 214, 10, 0.2);
                color: #ffffff !important;
            }
        }

        /* Smooth animations */
        * {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
    </style>

    {{-- Custom CSS dari halaman lain --}}
    @stack('css')
</head>
<body>
    {{-- Professional PLN-inspired navbar --}}
    <nav class="navbar navbar-pln shadow-sm navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                {{-- Pastikan path gambar benar, contoh: public/images/logo_saja.png --}}
                <img src="{{ asset('images/logo_saja.png') }}" alt="Logo PLN" style="height: 36px;">
                {{ config('app.name', 'Aplikasi') }} {{-- Menggunakan config() --}}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            <i class="fas fa-home me-1"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('presence.*') ? 'active' : '' }}" href="{{ route('presence.index') }}">
                            <i class="fas fa-calendar-check me-1"></i> Daftar Kegiatan
                        </a>
                    </li>

                    {{-- Master Data Dropdown --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs(['companies.*', 'company-units.*', 'pln-members.*']) ? 'active' : '' }}"
                           href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" id="masterDataDropdown">
                            <i class="fas fa-database me-1"></i> Master Data
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="masterDataDropdown">
                            <li>
                                <a class="dropdown-item {{ request()->routeIs('companies.*') ? 'active' : '' }}"
                                   href="{{ route('companies.index') }}">
                                    <i class="fas fa-building me-2"></i> Data Perusahaan
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item {{ request()->routeIs('company-units.*') ? 'active' : '' }}"
                                   href="{{ route('company-units.index') }}">
                                    <i class="fas fa-sitemap me-2"></i> Data Unit
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item {{ request()->routeIs('pln-members.*') ? 'active' : '' }}"
                                   href="{{ route('pln-members.index') }}">
                                    <i class="fas fa-users me-2"></i> Daftar Anggota PLN
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                            <i class="fas fa-user-cog me-1"></i> Data User
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto">
                    @guest
                        {{-- Guest user menu bisa ditambahkan di sini jika diperlukan --}}
                    @else
                        <li class="nav-item d-flex align-items-center me-2">
                            <a class="nav-link {{ request()->routeIs('profile') ? 'active' : '' }} text-white-50" href="{{ route('profile') }}">
                                <i class="fas fa-user me-1"></i> {{ Auth::user()->name }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-warning btn-sm" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt me-1"></i> {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    {{-- Main Page Content --}}
    @yield('content')

    {{-- JavaScript Libraries --}}
    {{-- jQuery FIRST --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    {{-- Bootstrap SECOND --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    {{-- DataTables --}}
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.bootstrap5.js"></script>

    {{-- Initialize Bootstrap components --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize all dropdowns
            var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
            var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
                return new bootstrap.Dropdown(dropdownToggleEl);
            });

            // Initialize all tooltips (if any)
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>

    {{-- Custom JavaScript dari halaman lain --}}
    @stack('js')
</body>
</html>