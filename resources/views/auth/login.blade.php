<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }} - Authentication</title> {{-- Ubah judul untuk halaman otentikasi --}}

    {{-- CSRF TOKEN --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    {{-- BOOTSTRAP --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    
    {{-- FONT AWESOME (Pastikan ini ada jika kamu menggunakan ikon fas) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
      body {
          /* Background yang menarik untuk halaman otentikasi */
          background: linear-gradient(135deg, #e0f2f7 0%, #bbdefb 100%);
          display: flex;
          justify-content: center;
          align-items: center;
          min-height: 100vh;
          margin: 0;
          font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
          overflow: hidden; /* Mencegah scroll saat animasi background */
          position: relative;
      }

      /* Animasi gelembung/partikel di background */
      body::before {
          content: '';
          position: absolute;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%2390caf9' fill-opacity='0.2' fill-rule='evenodd'%3E%3Ccircle cx='30' cy='30' r='10'%3E%3Canimate attributeName='r' values='10;20;10' dur='5s' repeatCount='indefinite' calcMode='spline' keyTimes='0;0.5;1' keySplines='0.42 0 0.58 1;0.42 0 0.58 1'/%3E%3Canimate attributeName='opacity' values='0.2;0.5;0.2' dur='5s' repeatCount='indefinite' calcMode='spline' keyTimes='0;0.5;1' keySplines='0.42 0 0.58 1;0.42 0 0.58 1'/%3E%3C/circle%3E%3C/g%3E%3C/svg%3E") repeat;
          animation: moveBackground 20s linear infinite;
          opacity: 0.5;
          z-index: -1;
      }

      @keyframes moveBackground {
          0% { background-position: 0 0; }
          100% { background-position: 600px 600px; }
      }

      /* PLN Authentication Styling */
      .pln-auth-card {
          border: none;
          border-radius: 20px; /* Lebih bulat */
          box-shadow: 0 15px 50px rgba(0, 116, 182, 0.25); /* Bayangan lebih kuat */
          backdrop-filter: blur(15px); /* Efek blur lebih kuat */
          background: rgba(255, 255, 255, 0.9); /* Sedikit lebih transparan */
          overflow: hidden;
          transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
          min-height: 600px; /* Pertahankan tinggi agar transisi form smooth */
          position: relative; /* Penting untuk animasi form */
          border: 1px solid rgba(0, 180, 216, 0.1); /* Border halus */
      }

      .pln-auth-card:hover {
          box-shadow: 0 20px 60px rgba(0, 116, 182, 0.35);
          transform: translateY(-5px);
      }

      .pln-auth-header {
          background: linear-gradient(135deg, #00b4d8 0%, #0077b6 100%);
          border-bottom: 4px solid #ffd60a; /* Border lebih tebal */
          color: white;
          padding: 2rem; /* Padding lebih besar */
          text-align: center;
          position: relative;
          overflow: hidden;
          border-top-left-radius: 20px;
          border-top-right-radius: 20px;
      }

      .pln-auth-header::before {
          content: '';
          position: absolute;
          top: -50%;
          left: -50%;
          width: 200%;
          height: 200%;
          background: linear-gradient(45deg, transparent, rgba(255, 214, 10, 0.15), transparent); /* Shimmer lebih jelas */
          transform: rotate(-45deg);
          animation: shimmer 3s infinite;
      }

      @keyframes shimmer {
          0% { transform: translateX(-100%) translateY(-100%) rotate(-45deg); }
          100% { transform: translateX(100%) translateY(100%) rotate(-45deg); }
      }

      .pln-auth-header h4 {
          font-weight: 800; /* Lebih tebal */
          font-size: 2rem; /* Lebih besar */
          text-shadow: 0 3px 5px rgba(0, 0, 0, 0.2);
          position: relative;
          z-index: 1;
          transition: all 0.3s ease;
      }

      /* Toggle Container */
      .pln-toggle-container {
          position: relative;
          display: flex;
          background: rgba(255, 255, 255, 0.2); /* Latar belakang toggle lebih transparan */
          border-radius: 16px; /* Lebih bulat */
          padding: 6px; /* Padding lebih besar */
          z-index: 2;
          margin-top: 1.5rem; /* Jarak dari judul */
      }

      .pln-toggle-btn {
          flex: 1;
          padding: 0.9rem 1.8rem; /* Ukuran tombol lebih besar */
          background: transparent;
          border: none;
          color: rgba(255, 255, 255, 0.8);
          font-weight: 700; /* Lebih tebal */
          border-radius: 12px; /* Lebih bulat */
          transition: all 0.3s ease;
          position: relative;
          z-index: 3;
          cursor: pointer;
          font-size: 1.05rem;
          display: flex;
          align-items: center;
          justify-content: center;
      }

      .pln-toggle-btn i {
          margin-right: 0.75rem;
      }

      .pln-toggle-btn.active {
          color: #0077b6; /* Warna aktif tetap biru PLN */
      }

      .pln-toggle-btn:hover {
          color: white;
          transform: translateY(-2px);
      }

      /* Toggle Slider */
      .pln-toggle-slider {
          position: absolute;
          top: 6px; /* Sesuai padding container */
          left: 6px;
          width: calc(50% - 6px); /* Sesuai padding container */
          height: calc(100% - 12px); /* Sesuai padding container */
          background: linear-gradient(135deg, #ffd60a 0%, #ffed4e 100%);
          border-radius: 12px; /* Lebih bulat */
          transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
          box-shadow: 0 4px 15px rgba(255, 214, 10, 0.4); /* Bayangan lebih kuat */
          z-index: 1;
      }

      .pln-toggle-slider.register {
          left: calc(50% + 0px); /* Posisi kanan */
      }

      /* Form Container */
      .pln-auth-body {
          padding: 3rem; /* Padding lebih besar */
          background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(240, 248, 255, 0.95) 100%);
          position: relative;
          overflow: hidden;
          min-height: 450px; /* Memastikan ada ruang untuk form */
      }

      .auth-form {
          position: absolute;
          top: 3rem; /* Sesuai padding body */
          left: 3rem;
          right: 3rem;
          opacity: 0;
          transform: translateX(100px);
          transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
          pointer-events: none;
          width: calc(100% - 6rem); /* Lebar sesuai padding */
      }

      .auth-form.active {
          opacity: 1;
          transform: translateX(0);
          pointer-events: all;
          position: relative; /* Kembali ke aliran dokumen saat aktif */
          top: 0;
          left: 0;
          right: 0;
      }

      .auth-form.slide-out-left {
          opacity: 0;
          transform: translateX(-100px);
      }

      .auth-form.slide-in-right {
          opacity: 1;
          transform: translateX(0);
      }

      /* Input Styling */
      .pln-label {
          font-weight: 700; /* Lebih tebal */
          color: #0077b6;
          margin-bottom: 0.75rem; /* Jarak lebih besar */
          font-size: 1rem;
      }

      .pln-input {
          border: 2px solid #a8dadc; /* Warna border lebih soft */
          border-radius: 14px; /* Lebih bulat */
          padding: 0.9rem 1.2rem; /* Padding lebih besar */
          font-size: 1.05rem;
          transition: all 0.3s ease;
          background: rgba(255, 255, 255, 0.95);
      }

      .pln-input:focus {
          border-color: #00b4d8;
          box-shadow: 0 0 0 0.3rem rgba(0, 180, 216, 0.2); /* Shadow lebih lembut */
          background: white;
          transform: translateY(-2px);
      }

      .pln-input:hover {
          border-color: #00b4d8;
          background: white;
      }

      /* Checkbox Styling */
      .pln-checkbox {
          margin-top: 1rem;
          display: flex; /* Untuk aligment lebih baik */
          align-items: center;
      }

      .pln-check-input {
          width: 1.3rem; /* Ukuran lebih besar */
          height: 1.3rem;
          border: 2px solid #00b4d8;
          border-radius: 6px; /* Lebih bulat */
          cursor: pointer;
      }

      .pln-check-input:checked {
          background-color: #00b4d8;
          border-color: #00b4d8;
      }

      .pln-check-input:focus {
          box-shadow: 0 0 0 0.3rem rgba(0, 180, 216, 0.3);
      }

      .pln-check-label {
          font-weight: 600;
          color: #0077b6;
          margin-left: 0.75rem; /* Jarak lebih besar */
          cursor: pointer;
      }

      /* Button Styling */
      .pln-btn-primary {
          background: linear-gradient(135deg, #00b4d8 0%, #0077b6 100%);
          border: none;
          color: white;
          padding: 1rem 2.5rem; /* Padding lebih besar */
          border-radius: 14px; /* Lebih bulat */
          font-weight: 700; /* Lebih tebal */
          transition: all 0.3s ease;
          box-shadow: 0 6px 20px rgba(0, 116, 182, 0.4); /* Bayangan lebih kuat */
          position: relative;
          overflow: hidden;
          width: 100%;
          font-size: 1.1rem;
          display: flex;
          align-items: center;
          justify-content: center;
      }

      .pln-btn-primary i {
          margin-right: 0.75rem;
      }

      .pln-btn-primary::before {
          content: '';
          position: absolute;
          top: 0;
          left: -100%;
          width: 100%;
          height: 100%;
          background: linear-gradient(90deg, transparent, rgba(255, 214, 10, 0.3), transparent); /* Shimmer lebih kuat */
          transition: left 0.6s ease;
      }

      .pln-btn-primary:hover::before {
          left: 100%;
      }

      .pln-btn-primary:hover {
          background: linear-gradient(135deg, #0096c7 0%, #005577 100%);
          transform: translateY(-3px);
          box-shadow: 0 8px 25px rgba(0, 116, 182, 0.5);
          color: white;
      }

      .pln-btn-primary:active {
          transform: translateY(0);
          box-shadow: 0 4px 15px rgba(0, 116, 182, 0.3);
      }

      .pln-forgot-link {
          color: #0077b6;
          text-decoration: none;
          font-weight: 600;
          transition: all 0.3s ease;
          font-size: 0.95rem;
          margin-top: 1rem; /* Jarak dari tombol */
          display: block; /* Agar bisa di tengah */
      }

      .pln-forgot-link:hover {
          color: #ffd60a;
          text-decoration: underline;
      }

      /* Responsive Design */
      @media (max-width: 768px) {
          .pln-auth-card {
              margin: 1rem; /* Sedikit margin di mobile */
              min-height: 500px;
          }
          .pln-auth-body {
              padding: 2rem;
          }
          .auth-form {
              top: 2rem;
              left: 2rem;
              right: 2rem;
              width: calc(100% - 4rem);
          }
          .pln-toggle-btn {
              padding: 0.7rem 1.2rem;
              font-size: 0.9rem;
          }
          .pln-auth-header h4 {
              font-size: 1.6rem;
          }
          .pln-btn-primary {
              padding: 0.8rem 2rem;
              font-size: 1rem;
          }
          .pln-label {
              text-align: left !important; /* Untuk label di mobile */
          }
      }

      /* Animation for card appearance */
      .pln-auth-card {
          animation: slideInUp 0.8s ease-out forwards;
      }

      @keyframes slideInUp {
          from {
              opacity: 0;
              transform: translateY(50px);
          }
          to {
              opacity: 1;
              transform: translateY(0);
          }
      }

    </style>
  </head>
  <body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card pln-auth-card">
                    <div class="card-header pln-auth-header">
                        <div class="d-flex align-items-center justify-content-center gap-3 mb-3">
                            <img src="{{ asset('images/logo_saja.png') }}" alt="Logo PLN" style="height: 32px;">
                            <h4 class="mb-0" id="form-title">{{ __('Login') }}</h4>
                        </div>
                        
                        <div class="pln-toggle-container">
                            <button type="button" class="pln-toggle-btn active" id="login-tab" onclick="switchToLogin()">
                                <i class="fas fa-sign-in-alt me-2"></i>Login
                            </button>
                            <button type="button" class="pln-toggle-btn" id="register-tab" onclick="switchToRegister()">
                                <i class="fas fa-user-plus me-2"></i>Register
                            </button>
                            <div class="pln-toggle-slider" id="toggle-slider"></div>
                        </div>
                    </div>

                    <div class="card-body pln-auth-body">
                        <div id="login-form" class="auth-form active">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="row mb-4">
                                    <label for="login-email" class="col-md-4 col-form-label text-md-end pln-label">{{ __('Email Address') }}</label>
                                    <div class="col-md-8">
                                        <input id="login-email" type="email" class="form-control pln-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="login-password" class="col-md-4 col-form-label text-md-end pln-label">{{ __('Password') }}</label>
                                    <div class="col-md-8">
                                        <input id="login-password" type="password" class="form-control pln-input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-8 offset-md-4">
                                        <div class="form-check pln-checkbox">
                                            <input class="form-check-input pln-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label pln-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn pln-btn-primary mb-3">
                                            <i class="fas fa-sign-in-alt me-2"></i>
                                            {{ __('Login') }}
                                        </button>
                                        
                                        @if (Route::has('password.request'))
                                            <div class="text-center">
                                                <a class="pln-forgot-link" href="{{ route('password.request') }}">
                                                    {{ __('Forgot Your Password?') }}
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div id="register-form" class="auth-form">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="row mb-4">
                                    <label for="register-name" class="col-md-4 col-form-label text-md-end pln-label">{{ __('Name') }}</label>
                                    <div class="col-md-8">
                                        <input id="register-name" type="text" class="form-control pln-input @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="register-email" class="col-md-4 col-form-label text-md-end pln-label">{{ __('Email Address') }}</label>
                                    <div class="col-md-8">
                                        <input id="register-email" type="email" class="form-control pln-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="register-password" class="col-md-4 col-form-label text-md-end pln-label">{{ __('Password') }}</label>
                                    <div class="col-md-8">
                                        <input id="register-password" type="password" class="form-control pln-input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="register-password-confirm" class="col-md-4 col-form-label text-md-end pln-label">{{ __('Confirm Password') }}</label>
                                    <div class="col-md-8">
                                        <input id="register-password-confirm" type="password" class="form-control pln-input" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn pln-btn-primary">
                                            <i class="fas fa-user-plus me-2"></i>
                                            {{ __('Register') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

    <script>
    function switchToLogin() {
        const loginTab = document.getElementById('login-tab');
        const registerTab = document.getElementById('register-tab');
        const loginForm = document.getElementById('login-form');
        const registerForm = document.getElementById('register-form');
        const formTitle = document.getElementById('form-title');
        const toggleSlider = document.getElementById('toggle-slider');
        
        // Update tab states
        loginTab.classList.add('active');
        registerTab.classList.remove('active');
        
        // Move slider
        toggleSlider.classList.remove('register');
        
        // Update title with animation
        formTitle.style.opacity = '0';
        setTimeout(() => {
            formTitle.textContent = 'Login';
            formTitle.style.opacity = '1';
        }, 150);
        
        // Switch forms with animation
        registerForm.classList.remove('active');
        registerForm.classList.add('slide-out-left');
        
        setTimeout(() => {
            loginForm.classList.add('active');
            loginForm.classList.remove('slide-out-left');
            registerForm.classList.remove('slide-out-left');
        }, 250);
    }

    function switchToRegister() {
        const loginTab = document.getElementById('login-tab');
        const registerTab = document.getElementById('register-tab');
        const loginForm = document.getElementById('login-form');
        const registerForm = document.getElementById('register-form');
        const formTitle = document.getElementById('form-title');
        const toggleSlider = document.getElementById('toggle-slider');
        
        // Update tab states
        registerTab.classList.add('active');
        loginTab.classList.remove('active');
        
        // Move slider
        toggleSlider.classList.add('register');
        
        // Update title with animation
        formTitle.style.opacity = '0';
        setTimeout(() => {
            formTitle.textContent = 'Register';
            formTitle.style.opacity = '1';
        }, 150);
        
        // Switch forms with animation
        loginForm.classList.remove('active');
        loginForm.classList.add('slide-out-left');
        
        setTimeout(() => {
            registerForm.classList.add('active');
            registerForm.classList.remove('slide-out-left');
            loginForm.classList.remove('slide-out-left');
        }, 250);
    }

    // Initialize form state on page load
    document.addEventListener('DOMContentLoaded', function() {
        // Check for old input errors to determine which form to show
        const hasRegisterErrors = {{ $errors->has('name') || $errors->has('email') && old('name') || $errors->has('password') && old('name') ? 'true' : 'false' }};
        
        if (hasRegisterErrors) {
            switchToRegister();
        }
    });
    </script>
  </body>
</html>