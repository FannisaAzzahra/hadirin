<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi Berhasil - {{ $presence->nama_kegiatan }}</title>
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

        .success-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            max-width: 900px; /* Lebar maksimum untuk laptop */
            width: 100%;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            text-align: center;
        }

        .success-header {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            padding: 3rem 2rem;
            position: relative;
            overflow: hidden;
        }

        .success-header::before {
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

        .success-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
            position: relative;
            z-index: 1;
        }

        .success-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 1;
        }

        .success-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
            position: relative;
            z-index: 1;
        }

        @keyframes shimmer {
            0% { transform: translateX(-100%) translateY(-100%) rotate(-45deg); }
            100% { transform: translateX(100%) translateY(100%) rotate(-45deg); }
        }

        .success-body {
            padding: 2rem;
            max-height: 70vh; /* Batasi tinggi untuk scroll */
            overflow-y: auto; /* Scroll vertikal jika konten terlalu panjang */
        }

        .event-info {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border: 2px solid #28a745;
        }

        .event-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .event-details {
            color: #6c757d;
            font-size: 1rem;
        }

        .event-details i {
            margin-right: 0.5rem;
            color: #28a745;
        }

        .success-message {
            color: #28a745;
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            padding: 0.8rem 1.5rem;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            border: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 123, 255, 0.3);
            color: white;
            text-decoration: none;
        }

        .btn-secondary {
            background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
            color: white;
        }

        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(108, 117, 125, 0.3);
            color: white;
            text-decoration: none;
        }

        .confetti {
            position: fixed;
            width: 10px;
            height: 10px;
            background: #f39c12;
            animation: confetti-fall 3s linear infinite;
        }

        @keyframes confetti-fall {
            0% {
                transform: translateY(-100vh) rotate(0deg);
                opacity: 1;
            }
            100% {
                transform: translateY(100vh) rotate(360deg);
                opacity: 0;
            }
        }

        @media (max-width: 480px) {
            .success-card {
                margin: 10px;
            }

            .success-header {
                padding: 2rem 1.5rem;
            }

            .success-title {
                font-size: 1.6rem;
            }

            .success-body {
                padding: 1.5rem;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }
        }
        
        /* Card styling */
        .card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-top: 2rem;
            max-height: 400px; /* Batasi tinggi card */
        }
        
        .card-header {
            background: linear-gradient(135deg, #0077b6 0%, #00b4d8 100%);
            color: white;
            padding: 1.5rem;
            border: none;
        }
        
        .card-title {
            margin: 0;
            font-size: 1.2rem;
            font-weight: 600;
            display: flex;
            align-items: center;
        }
        
        .card-body {
            padding: 1.5rem;
            max-height: 300px; /* Batasi tinggi body card */
            overflow-y: auto; /* Scroll vertikal untuk daftar kehadiran */
        }
        
        /* Table styling */
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0;
        }
        
        .table th {
            background: #343a40;
            color: white;
            padding: 0.75rem;
            text-align: left;
            font-weight: 600;
            border: 1px solid #495057;
        }
        
        .table td {
            padding: 0.75rem;
            border: 1px solid #dee2e6;
            vertical-align: middle;
        }
        
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }
        
        .table-hover tbody tr:hover {
            background-color: rgba(0, 116, 182, 0.1);
        }
        
        .table-responsive {
            overflow-x: auto; /* Scroll horizontal */
            overflow-y: auto; /* Scroll vertikal */
            max-height: 250px; /* Batasi tinggi tabel */
        }
        
        .text-center {
            text-align: center;
        }
        
        .text-muted {
            color: #6c757d;
        }
        
        .text-center {
            text-align: center;
        }
        
        .badge {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
            font-weight: 600;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.375rem;
        }
        
        .bg-primary {
            background-color: #0077b6 !important;
            color: white;
        }
        
        /* Responsive design */
        @media (min-width: 1024px) {
            /* Desktop/Laptop */
            .success-card {
                max-width: 1000px;
            }
            
            .success-body {
                padding: 2.5rem;
            }
            
            .card-body {
                max-height: 350px;
            }
            
            .table-responsive {
                max-height: 300px;
            }
        }
        
        @media (max-width: 1023px) and (min-width: 768px) {
            /* Tablet */
            .success-card {
                max-width: 800px;
            }
        }
        
        @media (max-width: 767px) {
            /* Mobile */
            .success-card {
                max-width: 95%;
                margin: 10px;
            }
            
            .success-body {
                padding: 1.5rem;
                max-height: 60vh;
            }
            
            .card-body {
                max-height: 250px;
            }
            
            .table-responsive {
                max-height: 200px;
                font-size: 0.9rem;
            }
            
            .table th,
            .table td {
                padding: 0.5rem;
                font-size: 0.85rem;
            }
            
            .action-buttons {
                flex-direction: column;
                gap: 0.8rem;
            }
            
            .btn {
                width: 100%;
                padding: 0.8rem 1rem;
            }
        }
        
        /* Custom scrollbar styling */
        .success-body::-webkit-scrollbar,
        .card-body::-webkit-scrollbar,
        .table-responsive::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        
        .success-body::-webkit-scrollbar-track,
        .card-body::-webkit-scrollbar-track,
        .table-responsive::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.1);
            border-radius: 4px;
        }
        
        .success-body::-webkit-scrollbar-thumb,
        .card-body::-webkit-scrollbar-thumb,
        .table-responsive::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #0077b6 0%, #00b4d8 100%);
            border-radius: 4px;
        }
        
        .success-body::-webkit-scrollbar-thumb:hover,
        .card-body::-webkit-scrollbar-thumb:hover,
        .table-responsive::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #005577 0%, #0096c7 100%);
        }
    </style>
</head>
<body>
    <div class="success-card">
        <div class="success-header">
            <div class="success-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <h1 class="success-title">Absensi Berhasil!</h1>
            <p class="success-subtitle">Terima kasih telah hadir</p>
        </div>

        <div class="success-body">
            <div class="event-info">
                <div class="event-title">{{ $presence->nama_kegiatan }}</div>
                <div class="event-details">
                    <div><i class="fas fa-calendar-alt"></i>{{ date('d F Y H:i', strtotime($presence->tgl_kegiatan)) }}</div>
                    <div><i class="fas fa-map-marker-alt"></i>{{ $presence->lokasi }}</div>
                </div>
            </div>

            <div class="success-message">
                <i class="fas fa-thumbs-up"></i>
                Absensi Anda telah berhasil dicatat dalam sistem. 
                Silakan simpan bukti ini sebagai konfirmasi kehadiran Anda.
            </div>

            <div class="action-buttons">
                <a href="{{ route('attendance.invitation', $presence->slug) }}" class="btn btn-secondary">
                    <i class="fas fa-home"></i>
                    Kembali ke Beranda
                </a>
                <button onclick="window.print()" class="btn btn-primary">
                    <i class="fas fa-print"></i>
                    Cetak Bukti
                </button>
            </div>
            
            @if(session('success'))
            <div class="alert alert-success mt-3">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
            @endif
            
            <!-- Daftar Kehadiran -->
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="card-title">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-people-fill me-2" viewBox="0 0 16 16">
                            <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
                        </svg>
                        Daftar Kehadiran ({{ $presenceDetails->count() }} Peserta)
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th style="min-width: 50px;">No</th>
                                    <th style="min-width: 150px;">Nama</th>
                                    <th style="min-width: 120px;">NIP</th>
                                    <th style="min-width: 200px;">Email</th>
                                    <th style="min-width: 150px;">Jabatan</th>
                                    <th style="min-width: 100px;">Unit</th>
                                    <th style="min-width: 120px;">No. HP</th>
                                    <th style="min-width: 120px;">Waktu Absen</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($presenceDetails as $index => $detail)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td><strong>{{ $detail->nama }}</strong></td>
                                    <td>{{ $detail->nip }}</td>
                                    <td>{{ $detail->email }}</td>
                                    <td>{{ $detail->jabatan }}</td>
                                    <td><span class="badge bg-primary">{{ $detail->unit }}</span></td>
                                    <td>{{ $detail->no_hp }}</td>
                                    <td class="text-center">
                                        <small>{{ $detail->created_at->format('d/m/Y') }}</small><br>
                                        <strong>{{ $detail->created_at->format('H:i') }}</strong>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted">
                                        <i class="fas fa-info-circle"></i>
                                        Belum ada data kehadiran
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Create confetti effect
        function createConfetti() {
            const colors = ['#f39c12', '#e74c3c', '#3498db', '#2ecc71', '#9b59b6'];
            
            for (let i = 0; i < 50; i++) {
                setTimeout(() => {
                    const confetti = document.createElement('div');
                    confetti.className = 'confetti';
                    confetti.style.left = Math.random() * 100 + 'vw';
                    confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                    confetti.style.animationDelay = Math.random() * 3 + 's';
                    confetti.style.animationDuration = (Math.random() * 3 + 2) + 's';
                    
                    document.body.appendChild(confetti);
                    
                    // Remove confetti after animation
                    setTimeout(() => {
                        confetti.remove();
                    }, 5000);
                }, i * 100);
            }
        }

        // Start confetti when page loads
        window.addEventListener('load', createConfetti);

        // Print functionality
        function printPage() {
            window.print();
        }
    </script>
</body>
</html> 