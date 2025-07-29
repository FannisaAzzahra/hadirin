<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undangan Absensi - {{ $presence->nama_kegiatan }}</title>
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
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .invitation-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            max-width: 500px;
            width: 100%;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .header {
            background: linear-gradient(135deg, #00b4d8 0%, #0077b6 100%);
            color: white;
            padding: 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transform: rotate(-45deg);
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer {
            0% { transform: translateX(-100%) translateY(-100%) rotate(-45deg); }
            100% { transform: translateX(100%) translateY(100%) rotate(-45deg); }
        }

        .header-content {
            position: relative;
            z-index: 1;
        }

        .event-title {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .event-date {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 1rem;
        }

        .event-location {
            font-size: 1rem;
            opacity: 0.8;
        }

        .body {
            padding: 2rem;
        }

        .unique-code-section {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border: 2px solid #00b4d8;
            position: relative;
        }

        .code-label {
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 0.5rem;
            text-align: center;
        }

        .unique-code {
            font-size: 2rem;
            font-weight: 700;
            color: #0077b6;
            text-align: center;
            letter-spacing: 2px;
            margin-bottom: 1rem;
            font-family: 'Courier New', monospace;
            background: white;
            padding: 1rem;
            border-radius: 10px;
            border: 2px dashed #00b4d8;
        }

        .copy-btn {
            background: linear-gradient(135deg, #00b4d8 0%, #0077b6 100%);
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
            width: 100%;
            margin-bottom: 1rem;
        }

        .copy-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 180, 216, 0.3);
        }

        .copy-btn.copied {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        }

        .attendance-btn {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);
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
            text-decoration: none;
        }

        .attendance-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(255, 107, 107, 0.4);
            color: white;
            text-decoration: none;
        }

        .warning {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            color: #856404;
            padding: 1rem;
            border-radius: 10px;
            margin-top: 1rem;
            font-size: 0.9rem;
            text-align: center;
        }

        .warning i {
            margin-right: 0.5rem;
        }

        @media (max-width: 480px) {
            .invitation-card {
                margin: 10px;
            }

            .header {
                padding: 1.5rem;
            }

            .event-title {
                font-size: 1.5rem;
            }

            .body {
                padding: 1.5rem;
            }

            .unique-code {
                font-size: 1.5rem;
                letter-spacing: 1px;
            }
        }
    </style>
</head>
<body>
    <div class="invitation-card">
        <div class="header">
            <div class="header-content">
                <h1 class="event-title">{{ $presence->nama_kegiatan }}</h1>
                <div class="event-date">
                    <i class="fas fa-calendar-alt"></i>
                    {{ date('d F Y', strtotime($presence->tgl_kegiatan)) }}
                </div>
                <div class="event-location">
                    <i class="fas fa-map-marker-alt"></i>
                    {{ $presence->lokasi }}
                </div>
            </div>
        </div>

        <div class="body">
            <div class="unique-code-section">
                <div class="code-label">
                    <i class="fas fa-key"></i>
                    Kode Unik Absensi Anda
                </div>
                <div class="unique-code" id="uniqueCode">{{ $attendanceCode->code }}</div>
                <button class="copy-btn" onclick="copyCode()" id="copyBtn">
                    <i class="fas fa-copy"></i>
                    Salin Kode
                </button>
            </div>

            <a href="{{ route('absen.index', ['slug' => $presence->slug, 'code' => $attendanceCode->code]) }}" 
               class="attendance-btn">
                <i class="fas fa-check-circle"></i>
                Klik untuk Absensi
            </a>

            <div class="warning">
                <i class="fas fa-exclamation-triangle"></i>
                <strong>Penting:</strong> Kode ini bersifat rahasia dan hanya dapat digunakan satu kali. 
                Jangan bagikan kepada siapapun!
            </div>
        </div>
    </div>

    <script>
        function copyCode() {
            const code = document.getElementById('uniqueCode').textContent;
            const copyBtn = document.getElementById('copyBtn');
            
            navigator.clipboard.writeText(code).then(function() {
                copyBtn.innerHTML = '<i class="fas fa-check"></i>Kode Disalin!';
                copyBtn.classList.add('copied');
                
                setTimeout(function() {
                    copyBtn.innerHTML = '<i class="fas fa-copy"></i>Salin Kode';
                    copyBtn.classList.remove('copied');
                }, 2000);
            }).catch(function(err) {
                console.error('Gagal menyalin kode: ', err);
                alert('Gagal menyalin kode. Silakan salin manual.');
            });
        }
    </script>
</body>
</html> 