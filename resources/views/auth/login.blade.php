<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hadirin - Autentikasi</title> {{-- Judul diubah ke Bahasa Indonesia --}}

    {{-- CSRF TOKEN --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    {{-- BOOTSTRAP --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    
    {{-- FONT AWESOME --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Favicon --}}
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo_saja.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo_saja.png') }}">
    <meta name="theme-color" content="#0077b6"> {{-- Warna tab Chrome di mobile --}}
    
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
        max-width: 900px;
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
        min-height: 480px;
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

      /* Logo Styling */
      .logo-container {
        position: relative;
      }

      .logo-image {
        height: 32px; /* Sesuaikan dengan tinggi logo yang diinginkan */
      }

      /* Header */
      .hadirin-auth-header {
        background: linear-gradient(135deg, #00b4d8 0%, #0077b6 100%);
        border-bottom: 3px solid #ffd60a;
        color: white;
        padding: 2rem;
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
        font-size: 2.2rem;
        margin-bottom: 1rem;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        position: relative;
        z-index: 1;
      }

      /* Toggle Container */
      .hadirin-toggle-container {
        position: relative;
        display: flex;
        background: rgba(255, 255, 255, 0.15);
        border-radius: 15px;
        padding: 6px;
        z-index: 2;
        margin-top: 1rem;
      }

      .hadirin-toggle-btn {
        flex: 1;
        padding: 0.8rem 1.5rem;
        background: transparent;
        border: none;
        color: rgba(255, 255, 255, 0.8);
        font-weight: 600;
        border-radius: 12px;
        transition: all 0.3s ease;
        position: relative;
        z-index: 3;
        cursor: pointer;
        font-size: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
      }

      .hadirin-toggle-btn i {
        margin-right: 0.5rem;
      }

      .hadirin-toggle-btn.active {
        color: #0077b6;
      }

      .hadirin-toggle-btn:hover {
        color: white;
        transform: translateY(-1px);
      }

      /* Toggle Slider */
      .hadirin-toggle-slider {
        position: absolute;
        top: 6px;
        left: 6px;
        width: calc(50% - 6px);
        height: calc(100% - 12px);
        background: linear-gradient(135deg, #ffd60a 0%, #ffed4e 100%);
        border-radius: 12px;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 15px rgba(255, 214, 10, 0.4);
        z-index: 1;
        border: 1px solid rgba(255, 214, 10, 0.3);
      }

      .hadirin-toggle-slider.register {
        left: calc(50% + 0px);
      }

      /* Form Container */
      .hadirin-auth-body {
        padding: 2.5rem;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(248, 249, 255, 0.98) 100%);
        position: relative;
        overflow: hidden;
        min-height: 380px;
      }

      .auth-form {
        position: absolute;
        top: 2.5rem;
        left: 2.5rem;
        right: 2.5rem;
        opacity: 0;
        transform: translateX(50px);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        pointer-events: none;
        width: calc(100% - 5rem);
      }

      .auth-form.active {
        opacity: 1;
        transform: translateX(0);
        pointer-events: all;
        position: relative;
        top: 0;
        left: 0;
        right: 0;
        width: 100%;
      }

      .auth-form.slide-out-left {
        opacity: 0;
        transform: translateX(-50px);
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

      /* ========================================================== */
      /* PERUBAHAN UTAMA UNTUK MENGGABUNGKAN INPUT DAN IKON */
      /* ========================================================== */

      /* Pindahkan styling border, radius, dan box-shadow ke .input-group */
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

      /* Buat input menjadi borderless dan transparan */
      .hadirin-input {
        border: none;
        border-radius: 12px;
        padding: 0.8rem 1rem;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: transparent;
        width: 100%;
        padding-right: 3rem; /* Sediakan ruang untuk ikon */
      }

      .hadirin-input:focus {
        outline: none; /* Hilangkan outline default pada input */
      }
      
      /* Pastikan input-group dan input tanpa toggle juga memiliki styling yang sama */
      .form-group .hadirin-input:not(.has-toggle) {
          border: 2px solid #a8dadc;
          border-radius: 12px;
          background: rgba(255, 255, 255, 0.9);
          padding: 0.8rem 1rem;
          transition: all 0.3s ease;
      }

      .form-group .hadirin-input:not(.has-toggle):hover {
          border-color: #00b4d8;
          background: white;
      }

      .form-group .hadirin-input:not(.has-toggle):focus {
          border-color: #00b4d8;
          box-shadow: 0 0 0 0.2rem rgba(0, 180, 216, 0.15);
          background: white;
          outline: none;
          transform: translateY(-1px);
      }
      
      /* Styling untuk error pada input tanpa toggle */
      .form-group .hadirin-input:not(.has-toggle).is-invalid {
          border-color: #dc3545 !important;
      }

      /* Custom styling for password toggle */
      .toggle-password {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #999;
        transition: color 0.3s ease;
        z-index: 5; /* Pastikan ikon berada di atas input */
      }

      .toggle-password:hover {
        color: #00b4d8;
      }
      
      /* Styling untuk error pada input-group */
      .input-group.is-invalid {
        border-color: #dc3545 !important;
      }
      /* Hapus border error pada input di dalam input-group */
      .input-group .hadirin-input.is-invalid {
        border-color: transparent !important;
      }
      
      /* ========================================================== */
      /* AKHIR PERUBAHAN UTAMA */
      /* ========================================================== */
      

      /* Checkbox Styling */
      .hadirin-checkbox {
        display: flex;
        align-items: center;
        margin-top: 1rem;
      }

      .hadirin-check-input {
        width: 1.2rem;
        height: 1.2rem;
        border: 2px solid #00b4d8;
        border-radius: 4px;
        cursor: pointer;
        accent-color: #00b4d8;
      }

      .hadirin-check-input:focus {
        box-shadow: 0 0 0 0.2rem rgba(0, 180, 216, 0.2);
      }

      .hadirin-check-label {
        font-weight: 500;
        color: #00b4d8;
        margin-left: 0.5rem;
        cursor: pointer;
        font-size: 0.9rem;
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

      .hadirin-forgot-link {
        color: #00b4d8;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        font-size: 0.9rem;
        margin-top: 1rem;
        display: block;
        text-align: center;
      }

      .hadirin-forgot-link:hover {
        color: #ffd60a;
        text-decoration: underline;
      }

      /* Error styling */
      .invalid-feedback {
        font-size: 0.85rem;
        margin-top: 0.25rem;
        color: #dc3545; /* Pastikan warna merah untuk error */
      }

      /* Responsive Design */
      @media (max-width: 768px) {
        body {
          padding: 10px;
        }
        
        .hadirin-auth-card {
          margin: 0;
          min-height: 450px;
        }
        
        .hadirin-auth-header {
          padding: 1.5rem;
        }
        
        .hadirin-auth-header h2 {
          font-size: 1.8rem;
        }
        
        .hadirin-auth-body {
          padding: 1.5rem;
          min-height: 350px;
        }
        
        .auth-form {
          top: 1.5rem;
          left: 1.5rem;
          right: 1.5rem;
          width: calc(100% - 3rem);
        }
        
        .hadirin-toggle-btn {
          padding: 0.7rem 1rem;
          font-size: 0.9rem;
        }
        
        .hadirin-btn-primary {
          padding: 0.8rem 1.5rem;
          font-size: 0.95rem;
        }
        
        .form-group {
          margin-bottom: 1.2rem;
        }
      }

      @media (max-width: 480px) {
        .hadirin-auth-header h2 {
          font-size: 1.6rem;
        }
        
        .hadirin-toggle-btn {
          font-size: 0.85rem;
          padding: 0.6rem 0.8rem;
        }
        
        .hadirin-toggle-btn i {
          margin-right: 0.3rem;
        }
      }
    </style>
  </head>
  <body>
    <div class="auth-container">
        <div class="card hadirin-auth-card">
            <div class="card-header hadirin-auth-header">
                <div class="d-flex align-items-center justify-content-center gap-3 mb-3">
                    <div class="logo-container">
                        <img src="{{ asset('images/logo_saja.png') }}" alt="Logo PLN" class="logo-image">
                    </div>
                    {{-- Ganti teks ini jika Anda ingin dinamis, atau biarkan statis "Hadirin" --}}
                    <h2 class="mb-0" id="form-title">Hadirin</h2>
                </div>
                
                <div class="hadirin-toggle-container" style="padding: 0;">
                    <button type="button" class="hadirin-toggle-btn active" id="login-tab" style="width: 100%; border-radius: 8px;">
                        <i class="fas fa-sign-in-alt"></i>Masuk
                    </button>
                </div>
            </div>

            <div class="card-body hadirin-auth-body">
                <div id="login-form" class="auth-form active">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <label for="login-email" class="hadirin-label">Alamat Email</label> {{-- Label Email --}}
                            {{-- Tambahkan kelas "has-toggle" jika Anda ingin membuat input tanpa ikon berbeda --}}
                            <input id="login-email" type="email" class="hadirin-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Masukkan alamat email Anda"> {{-- Placeholder Login Email --}}
                            @error('email')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="login-password" class="hadirin-label">Kata Sandi</label> {{-- Label Password --}}
                            {{-- Tambahkan is-invalid ke input-group jika ada error --}}
                            <div class="input-group @error('password') is-invalid @enderror">
                                <input id="login-password" type="password" class="hadirin-input has-toggle" name="password" required autocomplete="current-password" placeholder="Masukkan kata sandi Anda"> {{-- Placeholder Login Password --}}
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
                                Ingat Saya {{-- Label Remember Me --}}
                            </label>
                        </div>

                        <div class="form-group mt-4">
                            <button type="submit" class="hadirin-btn-primary" style="width: 100%;">
                                <i class="fas fa-sign-in-alt"></i>
                                Masuk {{-- Teks tombol Login --}}
                            </button>
                            
                            <a class="hadirin-forgot-link" href="{{ route('password.request') }}">
                            Lupa Kata Sandi?
                        </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- JS --}}
    <script>
        // Fungsi untuk toggle password
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
