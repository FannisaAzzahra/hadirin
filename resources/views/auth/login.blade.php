<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hadirin - Autentikasi</title>

    {{-- CSRF TOKEN --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    {{-- BOOTSTRAP --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    
    {{-- FONT AWESOME --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Favicon --}}
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo_saja.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo_saja.png') }}">
    <meta name="theme-color" content="#0077b6">
    
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

      /* Pattern background dengan tanda + */
      body::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url("data:image/svg+xml,%3Csvg width='80' height='80' viewBox='0 0 80 80' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zm0 15v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zM12 34v-4H10v4H6v2h4v4h2v-4h4v-2h-4zm0-30V0H10v4H6v2h4v4h2V6h4V4h-4zm0 15v-4H10v4H6v2h4v4h2v-4h4v-2h-4z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3e");
        opacity: 1;
        z-index: -1;
        animation: patternMove 20s linear infinite;
      }

      @keyframes patternMove {
        0% { transform: translate(0, 0); }
        100% { transform: translate(80px, 80px); }
      }

      /* Floating particles effect */
      body::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: 
          radial-gradient(circle at 15% 20%, rgba(255, 214, 10, 0.2) 0%, transparent 30%),
          radial-gradient(circle at 85% 80%, rgba(255, 214, 10, 0.15) 0%, transparent 35%),
          radial-gradient(circle at 50% 50%, rgba(255, 255, 255, 0.08) 0%, transparent 40%);
        animation: floatingParticles 10s ease-in-out infinite;
        z-index: -1;
      }

      @keyframes floatingParticles {
        0%, 100% { 
          opacity: 0.6;
          transform: scale(1) translateY(0);
        }
        50% { 
          opacity: 1;
          transform: scale(1.2) translateY(-20px);
        }
      }

      /* Main container */
      .auth-container {
        width: 100%;
        max-width: 520px;
        margin: 0 auto;
      }

      /* Auth Card - sama dengan reset.blade */
      .hadirin-auth-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0, 116, 182, 0.25);
        backdrop-filter: blur(20px);
        background: rgba(255, 255, 255, 0.95);
        overflow: hidden;
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
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

      /* Header - sama dengan reset.blade */
      .hadirin-auth-header {
        background: linear-gradient(135deg, #00b4d8 0%, #0077b6 100%);
        border-bottom: 3px solid #ffd60a;
        color: white;
        padding: 1.8rem 2rem;
        display: flex;
        align-items: center;
        justify-content: flex-start;
        gap: 1.2rem;
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

      .logo-container {
        position: relative;
        z-index: 1;
        flex-shrink: 0;
      }

      .logo-image {
        height: 48px;
        filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.2));
      }

      .hadirin-auth-header h2 {
        font-weight: 800;
        font-size: 1.6rem;
        margin-bottom: 0.2rem;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        position: relative;
        z-index: 1;
        color: white;
      }

      .header-content {
        flex: 1;
        text-align: left;
        position: relative;
        z-index: 1;
      }

      .hadirin-auth-subtitle {
        font-size: 0.85rem;
        color: rgba(255, 255, 255, 1);
        font-weight: 600;
        margin-bottom: 0;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        letter-spacing: 0.3px;
      }

      /* Form Container - sama dengan reset.blade */
      .hadirin-auth-body {
        padding: 2rem 2.5rem;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(248, 249, 255, 0.98) 100%);
        position: relative;
        overflow: hidden;
      }

      /* Form Styling */
      .form-group {
        margin-bottom: 1.2rem;
      }

      .hadirin-label {
        font-weight: 600;
        color: #00b4d8;
        margin-bottom: 0.5rem;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        gap: 0.4rem;
      }

      .hadirin-label i {
        font-size: 0.85rem;
        opacity: 0.8;
      }

      /* Input Group Styling - sama dengan reset.blade */
      .input-group {
        position: relative;
        border: 2px solid #a8dadc;
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.9);
        transition: all 0.3s ease;
      }

      .input-group:focus-within {
        border-color: #00b4d8;
        box-shadow: 0 0 0 0.2rem rgba(0, 180, 216, 0.15);
        background: white;
        transform: translateY(-1px);
      }

      .input-group:hover {
        border-color: #00b4d8;
        background: white;
      }

      /* Input field utama */
      .hadirin-input {
        border: none;
        border-radius: 12px;
        padding: 0.8rem 1rem;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: transparent;
        width: 100%;
        padding-right: 3rem;
        color: #333;
      }

      .hadirin-input::placeholder {
        color: #999;
      }

      .hadirin-input:focus {
        outline: none;
      }

      /* Input tanpa toggle (email) */
      .hadirin-input:not(.has-toggle) {
        border: 2px solid #a8dadc;
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.9);
        padding: 0.8rem 1rem;
      }

      .hadirin-input:not(.has-toggle):focus {
        border-color: #00b4d8;
        box-shadow: 0 0 0 0.2rem rgba(0, 180, 216, 0.15);
        background: white;
        outline: none;
        transform: translateY(-1px);
      }

      .hadirin-input:not(.has-toggle):hover {
        border-color: #00b4d8;
        background: white;
      }

      /* Password toggle icon */
      .toggle-password {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #999;
        transition: color 0.3s ease;
        z-index: 5;
      }

      .toggle-password:hover {
        color: #00b4d8;
      }

      /* Error styling - sama dengan reset.blade */
      .input-group.is-invalid {
        border-color: #dc3545 !important;
      }

      .input-group .hadirin-input.is-invalid {
        border-color: transparent !important;
      }

      .hadirin-input:not(.has-toggle).is-invalid {
        border-color: #dc3545 !important;
      }

      .invalid-feedback {
        font-size: 0.85rem;
        margin-top: 0.25rem;
        color: #dc3545;
      }

      /* Checkbox Styling - disesuaikan dengan warna baru */
      .hadirin-checkbox {
        display: flex;
        align-items: center;
        margin-top: 1rem;
        padding: 0.6rem 0.8rem;
        background: rgba(0, 180, 216, 0.05);
        border-radius: 10px;
        transition: all 0.3s ease;
      }

      .hadirin-checkbox:hover {
        background: rgba(0, 180, 216, 0.08);
      }

      .hadirin-check-input {
        width: 1.1rem;
        height: 1.1rem;
        border: 2px solid #00b4d8;
        border-radius: 5px;
        cursor: pointer;
        accent-color: #00b4d8;
        transition: all 0.2s ease;
      }

      .hadirin-check-input:hover {
        transform: scale(1.05);
        box-shadow: 0 0 0 3px rgba(0, 180, 216, 0.1);
      }

      .hadirin-check-input:focus {
        box-shadow: 0 0 0 4px rgba(0, 180, 216, 0.2);
      }

      .hadirin-check-label {
        font-weight: 500;
        color: #00b4d8;
        margin-left: 0.5rem;
        cursor: pointer;
        font-size: 0.85rem;
      }

      /* Button Styling - sama dengan reset.blade */
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

      /* Forgot password link - disesuaikan warna */
      .hadirin-forgot-link {
        color: #00b4d8;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        font-size: 0.85rem;
        margin-top: 1.2rem;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        padding: 0.4rem;
        border-radius: 8px;
      }

      .hadirin-forgot-link:hover {
        color: #0077b6;
        background: rgba(0, 180, 216, 0.08);
        transform: translateX(3px);
      }

      .hadirin-forgot-link i {
        font-size: 0.75rem;
        transition: transform 0.3s ease;
      }

      .hadirin-forgot-link:hover i {
        transform: translateX(3px);
      }

      /* Footer text */
      .auth-footer-text {
        text-align: center;
        margin-top: 1.5rem;
        padding-top: 1.2rem;
        border-top: 1px solid rgba(0, 180, 216, 0.1);
        color: #666;
        font-size: 0.8rem;
      }

      .auth-footer-text strong {
        color: #0077b6;
        font-weight: 700;
      }

      /* Responsive Design */
      @media (max-width: 768px) {
        body {
          padding: 15px;
        }

        .auth-container {
          max-width: 100%;
        }
        
        .hadirin-auth-card {
          margin: 0;
        }
        
        .hadirin-auth-header {
          padding: 1.5rem 1.5rem;
          flex-direction: row;
          justify-content: flex-start;
        }

        .header-content {
          text-align: left;
        }
        
        .hadirin-auth-header h2 {
          font-size: 1.4rem;
        }

        .hadirin-auth-subtitle {
          font-size: 0.75rem;
        }

        .logo-image {
          height: 42px;
        }
        
        .hadirin-auth-body {
          padding: 1.8rem 1.5rem;
        }
        
        .hadirin-btn-primary {
          padding: 0.8rem 1.5rem;
          font-size: 0.95rem;
        }
        
        .form-group {
          margin-bottom: 1.1rem;
        }
      }

      @media (max-width: 480px) {
        .hadirin-auth-header h2 {
          font-size: 1.3rem;
        }

        .logo-image {
          height: 38px;
        }

        .hadirin-auth-subtitle {
          font-size: 0.7rem;
        }
        
        .hadirin-auth-body {
          padding: 1.5rem 1.2rem;
        }

        .hadirin-input {
          padding: 0.75rem 0.9rem;
          font-size: 0.95rem;
        }

        .hadirin-input:not(.has-toggle) {
          padding: 0.75rem 0.9rem;
        }

        .hadirin-btn-primary {
          font-size: 0.9rem;
        }
      }
    </style>
  </head>
  <body>
    <div class="auth-container">
        <div class="card hadirin-auth-card">
            <div class="card-header hadirin-auth-header">
                <div class="logo-container">
                    <img src="{{ asset('images/logo_saja.png') }}" alt="Logo PLN" class="logo-image">
                </div>
                <div class="header-content">
                    <h2>HADIRIN</h2>
                    <p class="hadirin-auth-subtitle">Sistem Informasi Absensi Online PLN UPT Malang</p>
                </div>
            </div>

            <div class="card-body hadirin-auth-body">
                <div id="login-form" class="auth-form">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <label for="login-email" class="hadirin-label">
                                <i class="fas fa-envelope"></i>
                                Alamat Email
                            </label>
                            <input id="login-email" type="email" class="hadirin-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="nama@email.com">
                            @error('email')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="login-password" class="hadirin-label">
                                <i class="fas fa-lock"></i>
                                Kata Sandi
                            </label>
                            <div class="input-group @error('password') is-invalid @enderror">
                                <input id="login-password" type="password" class="hadirin-input has-toggle" name="password" required autocomplete="current-password" placeholder="Masukkan kata sandi Anda">
                                <i class="fa fa-eye-slash toggle-password" onclick="togglePasswordVisibility('login-password', this)"></i>
                            </div>
                            @error('password')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="hadirin-checkbox">
                            <input class="hadirin-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="hadirin-check-label" for="remember">
                                Ingat Saya
                            </label>
                        </div>

                        <div class="form-group mt-4">
                            <button type="submit" class="hadirin-btn-primary">
                                <i class="fas fa-sign-in-alt"></i>
                                Masuk {{-- Teks tombol Login --}}
                            </button>
                            
                            <div class="text-center">
                                <a class="hadirin-forgot-link" href="{{ route('password.request') }}">
                                    <i class="fas fa-key"></i>
                                    Lupa Kata Sandi?
                                </a>
                            </div>
                        </div>

                        <div class="auth-footer-text">
                            Sistem Absensi <strong>PLN UPT Malang</strong>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    {{-- Custom JS --}}
    <script>
        // Fungsi untuk toggle password visibility
        function togglePasswordVisibility(inputId, icon) {
            const input = document.getElementById(inputId);
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        }
    </script>
  </body>
</html>