<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }}</title>

    {{-- CSRF TOKEN --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    {{-- BOOTSTRAP --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    
    {{-- DATATABLES BOOTSTRAP5 --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

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
        z-index: 1030;
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
      }

      /* Smooth animations */
      * {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      }
    </style>
  </head>
  <body>
    {{-- Professional PLN-inspired navbar --}}
    <nav class="navbar navbar-pln shadow-sm navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
                <img src="{{ asset('images/logo_saja.png') }}" alt="Logo PLN" style="height: 36px;">
                {{ env('APP_NAME') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('presence.*') ? 'active' : '' }}" href="{{ route('presence.index') }}">Daftar Kegiatan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('pln-members.*') ? 'active' : '' }}" href="{{ route('pln-members.index') }}">Daftar Anggota</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">Data User</a>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto">
                    @guest
                        {{-- Ini adalah blok yang sebelumnya berisi tombol Login/Register.
                                Sekarang, blok ini dikosongkan karena tombol sudah ada di halaman otentikasi.
                                Jika kamu ingin tetap ada tautan ke halaman login, bisa seperti ini: --}}
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li> --}}
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
                                {{ __('Logout') }}
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

    {{-- JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

    {{-- DATATABLES CORE + BOOTSTRAP5 --}}
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.bootstrap5.js"></script>

    @stack('js')
  </body>
</html>