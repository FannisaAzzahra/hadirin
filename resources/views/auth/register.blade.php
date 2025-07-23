@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card pln-auth-card">
                <div class="card-header pln-auth-header">
                    <div class="d-flex align-items-center justify-content-center gap-3">
                        <img src="{{ asset('images/logo_saja.png') }}" alt="Logo PLN" style="height: 32px;">
                        <h4 class="mb-0">{{ __('Register') }}</h4>
                    </div>
                </div>

                <div class="card-body pln-auth-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-4">
                            <label for="name" class="col-md-4 col-form-label text-md-end pln-label">{{ __('Name') }}</label>

                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control pln-input @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="email" class="col-md-4 col-form-label text-md-end pln-label">{{ __('Email Address') }}</label>

                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control pln-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="password" class="col-md-4 col-form-label text-md-end pln-label">{{ __('Password') }}</label>

                            <div class="col-md-8">
                                <input id="password" type="password" class="form-control pln-input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end pln-label">{{ __('Confirm Password') }}</label>

                            <div class="col-md-8">
                                <input id="password-confirm" type="password" class="form-control pln-input" name="password_confirmation" required autocomplete="new-password">
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

<style>
/* PLN Authentication Styling */
.pln-auth-card {
    border: none;
    border-radius: 16px;
    box-shadow: 0 10px 40px rgba(0, 116, 182, 0.15);
    backdrop-filter: blur(10px);
    background: rgba(255, 255, 255, 0.95);
    overflow: hidden;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.pln-auth-card:hover {
    box-shadow: 0 15px 50px rgba(0, 116, 182, 0.2);
    transform: translateY(-2px);
}

.pln-auth-header {
    background: linear-gradient(135deg, #00b4d8 0%, #0077b6 100%);
    border-bottom: 3px solid #ffd60a;
    color: white;
    padding: 1.5rem;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.pln-auth-header::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: linear-gradient(45deg, transparent, rgba(255, 214, 10, 0.1), transparent);
    transform: rotate(-45deg);
    animation: shimmer 3s infinite;
}

@keyframes shimmer {
    0% { transform: translateX(-100%) translateY(-100%) rotate(-45deg); }
    100% { transform: translateX(100%) translateY(100%) rotate(-45deg); }
}

.pln-auth-header h4 {
    font-weight: 700;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    position: relative;
    z-index: 1;
}

.pln-auth-body {
    padding: 2.5rem;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.9) 0%, rgba(240, 248, 255, 0.9) 100%);
}

.pln-label {
    font-weight: 600;
    color: #0077b6;
    margin-bottom: 0.5rem;
}

.pln-input {
    border: 2px solid #e1f5fe;
    border-radius: 12px;
    padding: 0.75rem 1rem;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: rgba(255, 255, 255, 0.9);
}

.pln-input:focus {
    border-color: #00b4d8;
    box-shadow: 0 0 0 0.25rem rgba(0, 180, 216, 0.15);
    background: white;
    transform: translateY(-1px);
}

.pln-input:hover {
    border-color: #00b4d8;
    background: white;
}

.pln-btn-primary {
    background: linear-gradient(135deg, #00b4d8 0%, #0077b6 100%);
    border: none;
    color: white;
    padding: 0.75rem 2rem;
    border-radius: 12px;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0, 116, 182, 0.3);
    position: relative;
    overflow: hidden;
    width: 100%;
}

.pln-btn-primary::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 214, 10, 0.2), transparent);
    transition: left 0.5s ease;
}

.pln-btn-primary:hover::before {
    left: 100%;
}

.pln-btn-primary:hover {
    background: linear-gradient(135deg, #0096c7 0%, #005577 100%);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 116, 182, 0.4);
    color: white;
}

.pln-btn-primary:active {
    transform: translateY(0);
}

/* Responsive Design */
@media (max-width: 768px) {
    .pln-auth-body {
        padding: 1.5rem;
    }
}

/* Animation for form appearance */
.pln-auth-card {
    animation: slideInUp 0.6s ease-out;
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
</style>
@endsection