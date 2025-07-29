<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Absensi - {{ $presence->nama_kegiatan }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .form-container {
            max-width: 600px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .header {
            background: linear-gradient(135deg, #00b4d8 0%, #0077b6 100%);
            color: white;
            padding: 2rem;
            text-align: center;
        }

        .event-title {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .event-info {
            font-size: 1rem;
            opacity: 0.9;
        }

        .form-body {
            padding: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem;
            font-size: 1rem;
        }

        .form-label.required::after {
            content: ' *';
            color: #dc3545;
        }

        .form-input {
            width: 100%;
            padding: 0.8rem 1rem;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
        }

        .form-input:focus {
            outline: none;
            border-color: #00b4d8;
            box-shadow: 0 0 0 0.2rem rgba(0, 180, 216, 0.25);
        }

        .form-input.error {
            border-color: #dc3545;
        }

        .error-message {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .code-display {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border: 2px solid #00b4d8;
            border-radius: 10px;
            padding: 1rem;
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .code-label {
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 0.5rem;
        }

        .code-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: #0077b6;
            font-family: 'Courier New', monospace;
            letter-spacing: 1px;
        }

        .submit-btn {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 15px;
            font-size: 1.2rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.8rem;
            width: 100%;
            margin-top: 1rem;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(40, 167, 69, 0.4);
        }

        .submit-btn:disabled {
            background: #6c757d;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .back-btn {
            background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            text-decoration: none;
            margin-bottom: 1rem;
        }

        .back-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(108, 117, 125, 0.3);
            color: white;
            text-decoration: none;
        }

        .alert {
            padding: 1rem;
            border-radius: 10px;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .alert-danger {
            background: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }

        @media (max-width: 480px) {
            .form-container {
                margin: 10px;
            }

            .header {
                padding: 1.5rem;
            }

            .event-title {
                font-size: 1.5rem;
            }

            .form-body {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <div class="header">
            <h1 class="event-title">{{ $presence->nama_kegiatan }}</h1>
            <div class="event-info">
                <i class="fas fa-calendar-alt"></i>
                {{ date('d F Y H:i', strtotime($presence->tgl_kegiatan)) }} | 
                <i class="fas fa-map-marker-alt"></i>
                {{ $presence->lokasi }}
            </div>
        </div>

        <div class="form-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle"></i>
                    <strong>Error:</strong> Mohon periksa kembali data yang Anda masukkan.
                </div>
            @endif

            <a href="{{ route('attendance.invitation', ['slug' => $presence->slug, 'code' => $attendanceCode->code]) }}" 
               class="back-btn">
                <i class="fas fa-arrow-left"></i>
                Kembali ke Undangan
            </a>

            <form action="{{ route('attendance.submit', $presence->slug) }}" method="POST">
                @csrf
                
                <div class="code-display">
                    <div class="code-label">
                        <i class="fas fa-key"></i>
                        Kode Unik Anda
                    </div>
                    <div class="code-value">{{ $attendanceCode->code }}</div>
                </div>

                <input type="hidden" name="code" value="{{ $attendanceCode->code }}">

                <div class="form-group">
                    <label for="nama" class="form-label required">Nama Lengkap</label>
                    <input type="text" 
                           id="nama" 
                           name="nama" 
                           class="form-input @error('nama') error @enderror"
                           value="{{ old('nama') }}"
                           placeholder="Masukkan nama lengkap Anda"
                           required>
                    @error('nama')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email" class="form-label required">Email</label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           class="form-input @error('email') error @enderror"
                           value="{{ old('email') }}"
                           placeholder="contoh@email.com"
                           required>
                    @error('email')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="nip" class="form-label">NIP (Opsional)</label>
                    <input type="text" 
                           id="nip" 
                           name="nip" 
                           class="form-input @error('nip') error @enderror"
                           value="{{ old('nip') }}"
                           placeholder="Masukkan NIP jika ada">
                    @error('nip')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="jabatan" class="form-label">Jabatan (Opsional)</label>
                    <input type="text" 
                           id="jabatan" 
                           name="jabatan" 
                           class="form-input @error('jabatan') error @enderror"
                           value="{{ old('jabatan') }}"
                           placeholder="Masukkan jabatan Anda">
                    @error('jabatan')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="unit" class="form-label">Unit/Bagian (Opsional)</label>
                    <input type="text" 
                           id="unit" 
                           name="unit" 
                           class="form-input @error('unit') error @enderror"
                           value="{{ old('unit') }}"
                           placeholder="Masukkan unit/bagian Anda">
                    @error('unit')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="no_hp" class="form-label">Nomor HP (Opsional)</label>
                    <input type="tel" 
                           id="no_hp" 
                           name="no_hp" 
                           class="form-input @error('no_hp') error @enderror"
                           value="{{ old('no_hp') }}"
                           placeholder="08xxxxxxxxxx">
                    @error('no_hp')
                        <div class="error-message">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="submit-btn">
                    <i class="fas fa-check-circle"></i>
                    Simpan Absensi
                </button>
            </form>
        </div>
    </div>

    <script>
        // Auto-focus pada input nama
        document.getElementById('nama').focus();

        // Form validation
        const form = document.querySelector('form');
        const submitBtn = document.querySelector('.submit-btn');

        form.addEventListener('submit', function(e) {
            const nama = document.getElementById('nama').value.trim();
            const email = document.getElementById('email').value.trim();

            if (!nama || !email) {
                e.preventDefault();
                alert('Mohon lengkapi data yang wajib diisi (Nama dan Email)');
                return;
            }

            // Disable button to prevent double submission
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>Menyimpan...';
        });
    </script>
</body>
</html> 