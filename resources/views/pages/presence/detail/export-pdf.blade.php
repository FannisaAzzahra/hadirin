<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Formulir Daftar Hadir Rapat</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 1cm;
        }
        
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
            background: white;
            color: black;
            min-height: 100vh;
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
            width: 17%; /* Tanggal */
        }
        
        .attendance-table th:nth-child(3),
        .attendance-table td:nth-child(3) {
            width: 23%; /* NAMA */
        }
        
        .attendance-table th:nth-child(4),
        .attendance-table td:nth-child(4) {
            width: 12%; /* UNIT */
        }
        
        .attendance-table th:nth-child(5),
        .attendance-table td:nth-child(5) {
            width: 23%; /* EMAIL / NO. HP */
        }
        
        .attendance-table th:nth-child(6),
        .attendance-table td:nth-child(6) {
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
    <div class="container">
        <div class="header-box">
        <!-- Header dengan logo -->
            <div class="header-wrapper">
                <div class="header-row">
                    <div class="logo-left">
                        {{-- <img src="{{ public_path('images/logo_pln.png') }}" alt="PLN Logo" style="height: 60px;"> --}}
                        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/logo_pln.png'))) }}" style="height:60px;">
                    </div>
                    <div class="company-info">
                        <div class="company-name">PT PLN (PERSERO)</div>
                        <div class="company-unit">UNIT INDUK TRANSMISI JAWA BAGIAN TIMUR DAN BALI</div>
                    </div>
                    <div class="logos-right">
                        {{-- <img src="{{ public_path('images/logo_smk3.jpeg') }}" alt="SMK3 Logo" style="height: 45px; margin-right: 5px;">
                        <img src="{{ public_path('images/logo_iso.jpeg') }}" alt="ISO Logo" style="height: 60px;"> --}}

                        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/logo_smk3.png'))) }}" alt="SMK3 Logo" style="height: 60px; margin-right: 5px;">
                        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/logo_iso.png'))) }}" alt="ISO Logo" style="height: 60px;">
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
                                <td>01 JANUARI 2019</td>
                            </tr>
                            <tr>
                                <td>Halaman</td>
                                <td>1 dari 4</td>
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
                <tr>
                    <td class="label">Hari / Tanggal</td>
                    <td>:</td>
                    <td>{{ date('l, d F Y', strtotime($presence->tgl_kegiatan)) }}</td>
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
                    <th>Tanggal</th>
                    <th>NAMA</th>
                    <th>UNIT</th>
                    <th>EMAIL / NO. HP</th>
                    <th>TANDA TANGAN</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($presenceDetails as $index => $detail)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td class="text-center">{{ date('d/m/Y H:i', strtotime($detail->created_at)) }}</td>
                        <td class="text-center">{{ $detail->nama }}</td>
                        <td class="text-center">{{ $detail->unit }}</td>
                        <td class="text-center">{{ $detail->email ?? '-' }}/{{ $detail->no_hp }}</td>
                        <td class="text-center">
                            @if ($detail->signature)
                                @php
                                    $path = public_path('uploads/' . $detail->signature);
                                    $type = pathinfo($path, PATHINFO_EXTENSION);
                                    $data = file_get_contents($path);
                                    $img = 'data:image/' . $type . ';base64,' . base64_encode($data);
                                @endphp
                                <img src="{{ $img }}" alt="Signature" style="max-height:40px; max-width:100%;">
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="no-data">Tidak ada data peserta</td></tr>
                @endforelse
            </tbody>
        </table>

    </div>
</body>
</html>