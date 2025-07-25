<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hadirin - Lupa Kata Sandi</title> {{-- Judul diubah ke Bahasa Indonesia --}}

    {{-- CSRF TOKEN --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- BOOTSTRAP --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">

    {{-- FONT AWESOME --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
      body {
        background: linear-gradient(135deg, #00b4d8 0%, #0077b6 100%);
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        margin: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        overflow-x: hidden;
        position: relative;
        padding: 20px;
      }

      /* Subtle shimmer background effect */
      body::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle at 20% 30%, rgba(255, 255, 255, 0.08) 0%, transparent 50%),
                    radial-gradient(circle at 80% 70%, rgba(255, 255, 255, 0.06) 0%, transparent 50%),
                    radial-gradient(circle at 40% 80%, rgba(255, 214, 10, 0.04) 0%, transparent 50%);
        animation: subtleShimmer 8s ease-in-out infinite;
        z-index: -1;
      }

      @keyframes subtleShimmer {
        0%, 100% {
          opacity: 0.3;
          transform: scale(1);
        }
        50% {
          opacity: 0.6;
          transform: scale(1.05);
        }
      }

      /* Additional floating light effects */
      body::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle at 60% 20%, rgba(255, 255, 255, 0.05) 0%, transparent 40%),
                    radial-gradient(circle at 30% 60%, rgba(255, 214, 10, 0.03) 0%, transparent 40%),
                    radial-gradient(circle at 70% 90%, rgba(255, 255, 255, 0.04) 0%, transparent 40%);
        animation: floatingLights 12s ease-in-out infinite reverse;
        z-index: -1;
      }

      @keyframes floatingLights {
        0%, 100% {
          opacity: 0.2;
          transform: translateY(0px) rotate(0deg);
        }
        33% {
          opacity: 0.4;
          transform: translateY(-10px) rotate(1deg);
        }
        66% {
          opacity: 0.3;
          transform: translateY(-5px) rotate(-1deg);
        }
      }

      /* Main container */
      .auth-container {
        width: 100%;
        max-width: 500px; /* Lebih kecil untuk reset password */
        margin: 0 auto;
      }

      /* Auth Card */
      .hadirin-auth-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0, 116, 182, 0.25);
        backdrop-filter: blur(20px);
        background: rgba(255, 255, 255, 0.95);
        overflow: hidden;
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        min-height: 280px; /* Disesuaikan untuk form reset password */
        position: relative;
        animation: slideInUp 0.8s ease-out forwards;
        border: 1px solid rgba(255, 214, 10, 0.1);
      }

      @keyframes slideInUp {
        from {
          opacity: 0;
          transform: translateY(30px);
        }
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }

      .hadirin-auth-card:hover {
        box-shadow: 0 25px 70px rgba(0, 116, 182, 0.35);
        transform: translateY(-3px);
      }

      /* Header */
      .hadirin-auth-header {
        background: linear-gradient(135deg, #00b4d8 0%, #0077b6 100%);
        border-bottom: 3px solid #ffd60a;
        color: white;
        padding: 1.5rem;
        text-align: center;
        position: relative;
        overflow: hidden;
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
      }

      .hadirin-auth-header::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(45deg, transparent, rgba(255, 214, 10, 0.15), transparent);
        transform: rotate(-45deg);
        animation: headerShimmer 4s infinite;
      }

      @keyframes headerShimmer {
        0% { transform: translateX(-100%) translateY(-100%) rotate(-45deg); }
        100% { transform: translateX(100%) translateY(100%) rotate(-45deg); }
      }

      .hadirin-auth-header h2 {
        font-weight: 800;
        font-size: 1.8rem; /* Disesuaikan untuk reset password */
        margin-bottom: 0;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        position: relative;
        z-index: 1;
      }

      /* Form Container */
      .hadirin-auth-body {
        padding: 2rem; /* Sedikit lebih kecil dari form login/register */
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(248, 249, 255, 0.98) 100%);
        position: relative;
        overflow: hidden;
        min-height: 180px; /* Disesuaikan untuk form reset password */
      }

      /* Form Styling */
      .form-group {
        margin-bottom: 1.5rem;
      }

      .hadirin-label {
        font-weight: 600;
        color: #00b4d8;
        margin-bottom: 0.5rem;
        font-size: 0.95rem;
        display: block;
      }

      .hadirin-input {
        border: 2px solid #a8dadc;
        border-radius: 12px;
        padding: 0.8rem 1rem;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.9);
        width: 100%;
      }

      .hadirin-input:focus {
        border-color: #00b4d8;
        box-shadow: 0 0 0 0.2rem rgba(0, 180, 216, 0.15);
        background: white;
        outline: none;
        transform: translateY(-1px);
      }

      .hadirin-input:hover {
        border-color: #00b4d8;
        background: white;
      }

      /* Button Styling */
      .hadirin-btn-primary {
        background: linear-gradient(135deg, #00b4d8 0%, #0077b6 100%);
        border: none;
        color: white;
        padding: 0.9rem 2rem;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 6px 20px rgba(0, 180, 216, 0.3);
        position: relative;
        overflow: hidden;
        width: 100%;
        font-size: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
      }

      .hadirin-btn-primary i {
        margin-right: 0.5rem;
      }

      .hadirin-btn-primary::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 214, 10, 0.3), transparent);
        transition: left 0.6s ease;
      }

      .hadirin-btn-primary:hover::before {
        left: 100%;
      }

      .hadirin-btn-primary:hover {
        background: linear-gradient(135deg, #0096c7 0%, #005577 100%);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 180, 216, 0.4);
      }

      .hadirin-btn-primary:active {
        transform: translateY(0);
        box-shadow: 0 4px 15px rgba(0, 180, 216, 0.2);
      }

      /* Secondary Button (for Back to Login) */
      .hadirin-btn-secondary {
        background: none;
        border: 2px solid #00b4d8;
        color: #00b4d8;
        padding: 0.8rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        width: 100%;
        font-size: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        text-decoration: none; /* Untuk anchor tag */
      }

      .hadirin-btn-secondary i {
        margin-right: 0.5rem;
      }

      .hadirin-btn-secondary:hover {
        background: #e0f2f7; /* Warna latar belakang saat hover */
        border-color: #0077b6;
        color: #0077b6;
        transform: translateY(-1px);
        box-shadow: 0 4px 10px rgba(0, 180, 216, 0.1);
      }

      /* Alerts */
      .hadirin-alert {
        padding: 1rem 1.25rem;
        margin-bottom: 1.5rem;
        border: 1px solid transparent;
        border-radius: 0.5rem;
        font-size: 0.95rem;
        line-height: 1.5;
        text-align: center; /* Tambahkan ini agar teks alert di tengah */
      }

      .hadirin-alert-success {
        color: #0f5132;
        background-color: #d1e7dd;
        border-color: #badbcc;
      }

      .hadirin-alert-danger {
        color: #842029;
        background-color: #f8d7da;
        border-color: #f5c2c7;
      }

      /* Error styling */
      .invalid-feedback {
        font-size: 0.85rem;
        margin-top: 0.25rem;
        color: #dc3545; /* Pastikan warna merah untuk error */
      }

      .is-invalid {
        border-color: #dc3545 !important;
      }

      /* Responsive Design */
      @media (max-width: 768px) {
        body {
          padding: 10px;
        }

        .hadirin-auth-card {
          margin: 0;
          min-height: auto; /* Biarkan tinggi menyesuaikan konten */
        }

        .hadirin-auth-header {
          padding: 1rem;
        }

        .hadirin-auth-header h2 {
          font-size: 1.6rem;
        }

        .hadirin-auth-body {
          padding: 1.5rem;
          min-height: auto;
        }

        .hadirin-btn-primary {
          padding: 0.8rem 1.5rem;
          font-size: 0.95rem;
        }

        .hadirin-btn-secondary {
            padding: 0.7rem 1.2rem;
            font-size: 0.9rem;
        }

        .form-group {
          margin-bottom: 1.2rem;
        }
      }

      @media (max-width: 480px) {
        .hadirin-auth-header h2 {
          font-size: 1.4rem;
        }

        .hadirin-btn-primary,
        .hadirin-btn-secondary {
          font-size: 0.9rem;
        }
      }
    </style>
  </head>
  <body>
    <div class="auth-container">
        <div class="card hadirin-auth-card">
            <div class="card-header hadirin-auth-header">
                {{-- Judul: Lupa Kata Sandi --}}
                <h2 class="mb-0">{{ __('Lupa Kata Sandi') }}</h2>
            </div>

            <div class="card-body hadirin-auth-body">
                @if (session('status'))
                    <div class="hadirin-alert hadirin-alert-success" role="alert">
                        {{-- Pesan status dari controller: Kami telah mengirimkan tautan reset kata sandi ke alamat email Anda. --}}
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="form-group">
                        {{-- Label: Alamat Email --}}
                        <label for="email" class="hadirin-label">{{ __('Alamat Email') }}</label>
                        {{-- Placeholder: Masukkan alamat email Anda --}}
                        <input id="email" type="email" class="hadirin-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Masukkan alamat email Anda">
                        @error('email')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <div class="form-group mt-4">
                        <button type="submit" class="hadirin-btn-primary mb-3">
                            <i class="fas fa-paper-plane"></i>
                            {{-- Teks Tombol: Kirim Tautan Reset Kata Sandi --}}
                            {{ __('Kirim Tautan Reset Kata Sandi') }}
                        </button>

                        {{-- Tombol Kembali ke Login --}}
                        <a href="{{ route('login') }}" class="hadirin-btn-secondary">
                            <i class="fas fa-arrow-left"></i>
                            {{-- Teks Tombol: Kembali ke Login --}}
                            {{ __('Kembali ke Login') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
  </body>
</html>