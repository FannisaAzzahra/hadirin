<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Formulir Daftar Hadir Rapat</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 1cm 1cm 2cm 1cm;
        }
        
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
            background: white;
            color: black;
        }
        
        /* Footer dengan nomor halaman */
        .footer {
            position: fixed;
            bottom: 10px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 11px;
            color: #333;
        }
        
        .footer .pagenum:before {
            content: counter(page);
        }
        
        .container {
            width: 100%;
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }
        
        /* Header dengan logo */
        .header-row {
            display: table;
            width: 100%;
            border-bottom: 1px solid #000;
        }
        
        .header-wrapper {
            border: 1px solid #000;
            border-collapse: collapse;
        }
        
        .logo-left {
            display: table-cell;
            width: 80px;
            vertical-align: middle;
            text-align: center;
            padding: 10px;
        }
        
        .logo-pln {
            width: 70px;
            height: 70px;
            background: #ffeb3b;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 20px;
            color: #1976d2;
            border: 1px solid #000;
        }
        
        .company-info {
            display: table-cell;
            vertical-align: middle;
            text-align: left;
            padding: 0;
            font-family: Arial, sans-serif;
            font-size: 16px;
            font-weight: bold;
            line-height: 1.3;
        }
        
        .company-name, .company-unit {
            display: block;
            font-size: 16px;
            font-weight: bold;
            line-height: 1.3;
        }
                
        .logos-right {
            display: table-cell;
            width: 120px;
            vertical-align: middle;
            text-align: center;
            padding: 10px;
        }
        
        .logo-smk3 {
            width: 50px;
            height: 40px;
            background: #4caf50;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 9px;
            margin-bottom: 5px;
        }
        
        .logo-iso {
            width: 50px;
            height: 30px;
            background: #2196f3;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 9px;
        }
        
        /* Baris formulir dan info dokumen */
        .form-info-row {
            display: table;
            width: 100%;
            border-bottom: 1px solid #000;
            border-collapse: collapse;
        }
        
        .form-title {
            display: table-cell;
            text-align: center;
            font-family: 'Arial Black', Arial, sans-serif;
            border-right: 1px solid #000;
            vertical-align: middle;
            font-weight: bold; 
            font-size: 20px; /* Lebih besar */
            letter-spacing: 1px; /* Biar lebih presisi */
        }
        
        .document-info {
            display: table-cell;
            width: 38%;
            padding: 0;
            vertical-align: top;
        }
        
        .doc-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
            border-spacing: 0;
            border: none; /* pastikan tidak ada border tambahan */
        }
        
        .doc-table td {
            font-size: 12px;
            padding: 5px;
            border: 1px solid #000;
        }
        
        .doc-table td:first-child {
            background: #f9f9f9;
            font-weight: bold;
            width: 45%;
        }
        
        /* Page numbering */
        .page-info {
            font-size: 12px;
        }
        
        /* Informasi rapat */
        .meeting-info {
            padding: 20px;
            background: white;
            border: none;
        }
        
        .meeting-info table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .meeting-info td {
            padding: 8px 0;
            font-size: 12px;
        }
        
        .meeting-info .label {
            width: 150px;
            font-weight: bold;
        }
        
        .meeting-info .separator {
            width: 20px;
            text-align: center;
        }
        
        /* Tabel daftar hadir */
        .attendance-table {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
            table-layout: fixed; /* DITAMBAHKAN: Fixed table layout */
        }
        
        .attendance-table th,
        .attendance-table td {
            border: 1px solid #000;
            padding: 8px 4px; /* DITAMBAHKAN: Padding yang lebih konsisten */
            vertical-align: top; /* DITAMBAHKAN: Align ke atas */
            word-wrap: break-word; /* DITAMBAHKAN: Word wrap */
            word-break: break-word; /* DITAMBAHKAN: Break word */
            overflow-wrap: break-word; /* DITAMBAHKAN: Overflow wrap */
            white-space: normal; /* DITAMBAHKAN: Normal white space */
        }
        
        .attendance-table th {
            background: #e0e0e0;
            font-weight: bold;
            text-align: center;
            font-size: 12px;
        }
        
        .attendance-table .text-center {
            text-align: center;
        }
        
        .attendance-table .no-data {
            text-align: center;
            font-style: italic;
            color: #666;
            padding: 20px;
        }
        
        /* DITAMBAHKAN: Spesifik width untuk setiap kolom */
        .attendance-table th:nth-child(1),
        .attendance-table td:nth-child(1) {
            width: 5%; /* NO */
        }
        
        .attendance-table th:nth-child(2),
        .attendance-table td:nth-child(2) {
            width: 27%; /* NAMA */
        }
        
        .attendance-table th:nth-child(3),
        .attendance-table td:nth-child(3) {
            width: 22%; /* UNIT */
        }
        
        .attendance-table th:nth-child(4),
        .attendance-table td:nth-child(4) {
            width: 26%; /* EMAIL / NO. HP */
        }
        
        .attendance-table th:nth-child(5),
        .attendance-table td:nth-child(5) {
            width: 20%; /* TANDA TANGAN */
        }
        
        .header-box {
            border: 1px solid #000;
            border-collapse: collapse;
            margin: 0;
            padding: 0;
        }

        /* Responsive untuk print */
        @media print {
            body {
                margin: 0;
                padding: 0;
            }
            
            .container {
                border: 1px solid #000;
                box-shadow: none;
                min-height: 100vh;
            }
            
            @page {
                size: A4 portrait;
                margin: 1cm;
            }
        }
    </style>
</head>
<body>
    <div class="footer">
        <div class="pagenum"></div>
    </div>
    
    <div class="container">
        <div class="header-box">
        <!-- Header dengan logo -->
            <div class="header-wrapper">
                <div class="header-row">
                    <div class="logo-left">
                        @php
                            $logoPln = null;
                            // Try storage/app/public first
                            if (\Storage::disk('public')->exists('logos/logo_pln.png')) {
                                try {
                                    $logoPln = base64_encode(\Storage::disk('public')->get('logos/logo_pln.png'));
                                } catch (\Exception $e) {
                                    \Log::warning('Failed to read PLN logo from storage: ' . $e->getMessage());
                                }
                            }
                            // Fallback to public/images
                            if (!$logoPln && file_exists(public_path('images/logo_pln.png'))) {
                                try {
                                    $logoPln = base64_encode(file_get_contents(public_path('images/logo_pln.png')));
                                } catch (\Exception $e) {
                                    \Log::warning('Failed to read PLN logo from public: ' . $e->getMessage());
                                }
                            }
                        @endphp
                        @if($logoPln)
                            <img src="data:image/png;base64,{{ $logoPln }}" style="height:70px;" alt="PLN Logo">
                        @else
                            <div style="width:70px;height:70px;background:#1976d2;color:white;display:flex;align-items:center;justify-content:center;font-weight:bold;">PLN</div>
                        @endif
                    </div>
                    <div class="company-info">
                        <div class="company-name">PT PLN (PERSERO)</div>
                        <div class="company-unit">UNIT INDUK TRANSMISI JAWA BAGIAN TIMUR DAN BALI</div>
                    </div>
                    <div class="logos-right">
                        @php
                            $logoSmk3 = null;
                            $logoIso = null;
                            
                            // Try SMK3 from storage first
                            if (\Storage::disk('public')->exists('logos/logo_smk3.png')) {
                                try {
                                    $logoSmk3 = base64_encode(\Storage::disk('public')->get('logos/logo_smk3.png'));
                                } catch (\Exception $e) {}
                            } elseif (file_exists(public_path('images/logo_smk3.png'))) {
                                try {
                                    $logoSmk3 = base64_encode(file_get_contents(public_path('images/logo_smk3.png')));
                                } catch (\Exception $e) {}
                            }
                            
                            // Try ISO from storage first
                            if (\Storage::disk('public')->exists('logos/logo_iso.png')) {
                                try {
                                    $logoIso = base64_encode(\Storage::disk('public')->get('logos/logo_iso.png'));
                                } catch (\Exception $e) {}
                            } elseif (file_exists(public_path('images/logo_iso.png'))) {
                                try {
                                    $logoIso = base64_encode(file_get_contents(public_path('images/logo_iso.png')));
                                } catch (\Exception $e) {}
                            }
                        @endphp
                        @if($logoSmk3)
                            <img src="data:image/png;base64,{{ $logoSmk3 }}" alt="SMK3 Logo" style="height: 55px; margin-right: 5px;">
                        @endif
                        @if($logoIso)
                            <img src="data:image/png;base64,{{ $logoIso }}" alt="ISO Logo" style="height: 55px;">
                        @endif
                    </div>
                </div>
                
                <!-- Baris formulir dan info dokumen -->
                <div class="form-info-row">
                    <div class="form-title">
                        FORMULIR DAFTAR HADIR RAPAT
                    </div>
                    <div class="document-info">
                        <table class="doc-table">
                            <tr>
                                <td>No. Dokumen</td>
                                <td>FK3.TJBTB.01.00.02</td>
                            </tr>
                            <tr>
                                <td>Edisi / Revisi</td>
                                <td>00 / 00</td>
                            </tr>
                            <tr>
                                <td>Berlaku Efektif</td>
                                <td>01 MARET 2023</td>
                            </tr>
                            <tr>
                                <td>Halaman</td>
                                <td class="page-info">
                                    @php
                                        // Hitung total halaman berdasarkan jumlah data
                                        // Asumsi: header + info rapat memakan ~1/3 halaman pertama
                                        // Setiap halaman bisa muat ~20 baris data
                                        $totalData = $presenceDetails->count();
                                        $rowsPerPage = 20; // Rows per page setelah halaman pertama
                                        $firstPageRows = 10; // Rows di halaman pertama (karena ada header)
                                        
                                        if ($totalData <= $firstPageRows) {
                                            $totalPages = 1;
                                        } else {
                                            $remainingRows = $totalData - $firstPageRows;
                                            $totalPages = 1 + ceil($remainingRows / $rowsPerPage);
                                        }
                                    @endphp
                                    1 dari {{ $totalPages }}
                                </td>
                            </tr>
                        </table>
                    </div> 
                </div>
            </div>
        </div>
        
        <!-- MEETING INFO -->
        <div class="meeting-info">
            <table>
                <tr>
                    <td class="label">Nama Kegiatan</td>
                    <td>:</td>
                    <td>{{ $presence->nama_kegiatan }}</td>
                </tr>
                @php
                    \Carbon\Carbon::setLocale('id');
                    $tanggalIndo = \Carbon\Carbon::parse($presence->tgl_kegiatan)->translatedFormat('l, d F Y');
                @endphp
                <tr>
                    <td class="label">Hari / Tanggal</td>
                    <td>:</td>
                    <td>{{ $tanggalIndo }}</td>
                </tr>
                <tr>
                    <td class="label">Waktu Mulai</td>
                    <td>:</td>
                    <td>{{ date('H:i', strtotime($presence->tgl_kegiatan)) }} WIB</td>
                </tr>
                <tr>
                    <td class="label">Lokasi</td>
                    <td>:</td>
                    <td>{{ $presence->lokasi }}</td>
                </tr>

            </table>
        </div>

        <!-- ATTENDANCE TABLE -->
        <table class="attendance-table">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>NAMA / NIP</th>
                    <th>UNIT / JABATAN</th>
                    <th>EMAIL / NO. HP</th>
                    <th>TANDA TANGAN</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($presenceDetails as $index => $detail)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td class="text-center">
                            {{ $detail->nama }} / <br>
                            <span style="font-size:11px;"> {{ $detail->nip ?? '-' }}</span>
                        </td>
                        <td class="text-center">
                            {{ $detail->unit }} / <br>
                            <span style="font-size:11px;">  {{ $detail->jabatan ?? '-' }}</span>
                        </td>
                        <td class="text-center">{{ $detail->email ?? '-' }} / <br> {{ $detail->no_hp }}</td>
                        <td class="text-center">
                            @if ($detail->signature)
                                @php
                                    $img = null;
                                    try {
                                        // Try storage disk first
                                        if (\Storage::disk('public')->exists($detail->signature)) {
                                            $data = \Storage::disk('public')->get($detail->signature);
                                            $type = pathinfo($detail->signature, PATHINFO_EXTENSION) ?: 'png';
                                            $img = 'data:image/' . $type . ';base64,' . base64_encode($data);
                                        } 
                                        // Fallback to legacy public/uploads path
                                        elseif (file_exists(public_path('uploads/' . $detail->signature))) {
                                            $data = file_get_contents(public_path('uploads/' . $detail->signature));
                                            $type = pathinfo($detail->signature, PATHINFO_EXTENSION) ?: 'png';
                                            $img = 'data:image/' . $type . ';base64,' . base64_encode($data);
                                        }
                                    } catch (\Throwable $e) {
                                        \Log::warning('Failed to load signature: ' . $e->getMessage());
                                    }
                                @endphp
                                @if(!empty($img))
                                    <img src="{{ $img }}" alt="Signature" style="max-height:40px; max-width:100%;">
                                @endif
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="no-data">Tidak ada data peserta</td></tr>
                @endforelse
            </tbody>
        </table>

    </div>
    
    {{-- Script dompdf untuk nomor halaman otomatis --}}
    <script type="text/php">
        if (isset($pdf)) {
            $text = "{PAGE_NUM}";
            $size = 11;
            $font = $fontMetrics->getFont("Arial");
            $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
            $x = ($pdf->get_width() - $width) / 2;
            $y = $pdf->get_height() - 30;
            $pdf->page_text($x, $y, $text, $font, $size, array(0.33, 0.33, 0.33));
        }
    </script>
</body>
</html>