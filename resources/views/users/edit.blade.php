@extends('layouts.main')

@section('content')
<style>
    /* General styles for the app container */
    .app-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    /* Card styling */
    .hadirin-app-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 20px;
        box-shadow: 0 15px 45px rgba(0, 116, 182, 0.2);
        backdrop-filter: blur(15px); /* For a frosted glass effect */
        overflow: hidden; /* Ensures content respects border-radius */
        animation: slideInUp 0.8s ease-out forwards;
    }

    /* Card Header styling */
    .hadirin-app-header {
        background: linear-gradient(135deg, #00b4d8 0%, #0077b6 100%);
        padding: 25px 30px;
        color: white;
        text-align: center;
        position: relative;
        overflow: hidden;
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
    }

    .hadirin-app-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: -75%;
        width: 50%;
        height: 100%;
        background: rgba(255, 255, 255, 0.2);
        transform: skewX(-20deg);
        animation: headerShimmer 2s infinite;
    }

    .hadirin-header-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    /* Card Body styling */
    .hadirin-app-body {
        padding: 30px;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(248, 249, 255, 0.98) 100%);
    }

    /* Section Header styling */
    .hadirin-section-header {
        display: flex;
        align-items: center;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 1px solid #e0f2f7;
    }

    .hadirin-section-icon {
        font-size: 1.8rem;
        margin-right: 15px;
        color: #0077b6;
        text-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        background: -webkit-linear-gradient(45deg, #00b4d8, #0077b6);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .hadirin-section-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #333;
    }

    /* Form Grid and Row styling */
    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 25px;
    }

    .form-row {
        margin-bottom: 20px; /* Adjust mb-3 equivalent */
    }

    /* Input Field styling */
    .hadirin-input {
        width: 100%;
        padding: 12px 18px;
        border: 2px solid #a8dadc;
        border-radius: 12px;
        font-size: 1rem;
        color: #333;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
        background-color: #f8faff;
    }

    .hadirin-input:focus {
        border-color: #0077b6;
        box-shadow: 0 0 0 4px rgba(0, 119, 182, 0.2);
        outline: none;
        background-color: #ffffff;
    }

    .hadirin-input::placeholder {
        color: #999;
    }

    .hadirin-input.is-invalid {
        border-color: #dc3545; /* Bootstrap's invalid color */
    }

    /* Label styling */
    .hadirin-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #555;
        font-size: 0.95rem;
    }

    .required-star {
        color: #dc3545; /* Red color for asterisk */
        margin-left: 4px;
    }

    /* Invalid feedback styling */
    .invalid-feedback {
        color: #dc3545;
        font-size: 0.875em;
        margin-top: 0.25rem;
        display: block; /* Ensure it shows up properly */
    }

    /* Action Buttons styling */
    .action-buttons {
        padding-top: 25px;
        border-top: 1px solid rgba(0, 180, 216, 0.1);
        display: flex;
        justify-content: flex-end;
        gap: 15px;
        margin-top: 30px; /* Add some space above the buttons */
    }

    /* Primary Button styling */
    .hadirin-btn-primary {
        background: linear-gradient(45deg, #00b4d8 0%, #0077b6 100%);
        color: white;
        padding: 12px 25px;
        border: none;
        border-radius: 12px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 8px 15px rgba(0, 119, 182, 0.3);
        position: relative;
        overflow: hidden;
    }

    .hadirin-btn-primary:hover {
        background: linear-gradient(45deg, #0077b6 0%, #005f90 100%);
        box-shadow: 0 12px 20px rgba(0, 119, 182, 0.4);
        transform: translateY(-2px);
    }

    .hadirin-btn-primary::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 30%;
        height: 100%;
        background: rgba(255, 255, 255, 0.3);
        transform: skewX(-20deg);
        transition: all 0.7s ease;
    }

    .hadirin-btn-primary:hover::before {
        left: 100%;
    }

    /* Secondary Button styling */
    .hadirin-btn-secondary {
        background: none;
        color: #0077b6;
        padding: 12px 25px;
        border: 2px solid #a8dadc;
        border-radius: 12px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .hadirin-btn-secondary:hover {
        background-color: #e0f2f7;
        border-color: #0077b6;
        color: #005f90;
    }

    /* Animations */
    @keyframes slideInUp {
        from {
            transform: translateY(50px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    @keyframes headerShimmer {
        0% {
            left: -75%;
        }
        100% {
            left: 100%;
        }
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .hadirin-app-header {
            padding: 20px;
        }

        .hadirin-header-title {
            font-size: 1.6rem;
        }

        .hadirin-app-body {
            padding: 20px;
        }

        .hadirin-section-header {
            margin-bottom: 20px;
        }

        .hadirin-section-title {
            font-size: 1.3rem;
        }

        .action-buttons {
            flex-direction: column;
            gap: 10px;
        }

        .hadirin-btn-primary,
        .hadirin-btn-secondary {
            width: 100%;
        }
    }

    @media (max-width: 576px) {
        .hadirin-app-card {
            border-radius: 15px;
        }

        .hadirin-app-header {
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        .hadirin-header-title {
            font-size: 1.4rem;
        }

        .hadirin-app-body {
            padding: 15px;
        }

        .hadirin-section-icon {
            font-size: 1.5rem;
        }

        .hadirin-section-title {
            font-size: 1.2rem;
        }
        /* Make password fields stack on small screens */
        .password-fields {
            flex-direction: column;
        }
    }
</style>

<div class="container my-5 app-container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="hadirin-app-card">
                <div class="hadirin-app-header">
                    <h5 class="hadirin-header-title">Edit User: {{ $user->name }}</h5>
                </div>
                <div class="hadirin-app-body">
                    <div class="hadirin-section-header">
                        <i class="fas fa-user-edit hadirin-section-icon"></i>
                        <h6 class="hadirin-section-title">Informasi Akun</h6>
                    </div>
                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-row mb-3">
                            <label for="name" class="hadirin-label">Nama <span class="required-star">*</span></label>
                            <input type="text" class="hadirin-input @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" placeholder="Nama pengguna" required>
                            @error('name')
                                <div class="invalid-feedback">⚠️ {{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-row mb-3">
                            <label for="email" class="hadirin-label">Email <span class="required-star">*</span></label>
                            <input type="email" class="hadirin-input @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" placeholder="email@example.com" required>
                            @error('email')
                                <div class="invalid-feedback">⚠️ {{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-grid password-fields">
                            <div class="form-row mb-3">
                                <label for="password" class="hadirin-label">Password (isi jika ingin mengubah)</label>
                                <input type="password" class="hadirin-input @error('password') is-invalid @enderror" id="password" name="password" placeholder="Biarkan kosong jika tidak ingin mengubah">
                                @error('password')
                                    <div class="invalid-feedback">⚠️ {{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-row mb-3">
                                <label for="password_confirmation" class="hadirin-label">Konfirmasi Password</label>
                                <input type="password" class="hadirin-input" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi password baru">
                            </div>
                        </div>

                        <div class="action-buttons">
                            <a href="{{ route('users.index') }}" class="hadirin-btn-secondary">Batal</a>
                            <button type="submit" class="hadirin-btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection