<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
        font-size: 12px;
    }
    
    .header-container {
        border: 2px solid black;
        padding: 10px;
        margin-bottom: 0px;
    }
    
    .header-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 15px;
    }
    
    .logo-left {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, #FFD700, #FFA500);
        border-radius: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        color: #0066CC;
        font-size: 14px;
        border: 1px solid #ccc;
    }
    
    .company-info {
        flex: 1;
        text-align: left;
        margin-left: 20px;
        margin-right: 20px;
    }
    
    .company-name {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 8px;
        color: #000;
    }
    
    .unit-name {
        font-size: 16px;
        font-weight: bold;
        color: #000;
    }
    
    .logo-right {
        display: flex;
        gap: 15px;
        align-items: center;
    }
    
    .smk3-logo {
        width: 50px;
        height: 50px;
        background: #FFD700;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 8px;
        font-weight: bold;
        text-align: center;
        color: #000;
    }
    
    .iso-logo {
        width: 50px;
        height: 50px;
        background: #E6E6FA;
        border: 2px solid #4169E1;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 7px;
        font-weight: bold;
        text-align: center;
        color: #4169E1;
    }
    
    .doc-info-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 1px solid black;
        padding-top: 10px;
    }
    
    .form-title {
        font-size: 18px;
        font-weight: bold;
        text-align: center;
        flex: 1;
    }
    
    .doc-info-table {
        border-collapse: collapse;
        font-size: 10px;
        margin-left: 20px;
    }
    
    .doc-info-table td {
        border: 1px solid black;
        padding: 2px 8px;
        white-space: nowrap;
    }
    
    .doc-info-table td:first-child {
        background-color: #f0f0f0;
        font-weight: bold;
    }
    
    .meeting-info {
        margin: 20px 0;
    }
    
    .meeting-info table {
        width: 100%;
        margin-bottom: 20px;
    }
    
    .meeting-info td {
        padding: 5px 0;
        vertical-align: top;
    }
    
    .meeting-info td:first-child {
        width: 120px;
    }
    
    .meeting-info td:nth-child(2) {
        width: 20px;
    }
    
    .attendance-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    
    .attendance-table th,
    .attendance-table td {
        border: 1px solid black;
        padding: 8px 4px;
        text-align: center;
    }
    
    .attendance-table th {
        background-color: #f0f0f0;
        font-weight: bold;
    }
    
    .attendance-table td:nth-child(3),
    .attendance-table td:nth-child(4) {
        text-align: left;
    }
    
    .text-center {
        text-align: center;
    }
</style>
<body>
    <div class="header-container">
        <!-- Header Top Section -->
        <div class="header-top">
            <div class="logo-left">
                PLN
            </div>
            <div class="company-info">
                <div class="company-name">PT PLN (PERSERO)</div>
                <div class="unit-name">UNIT INDUK TRANSMISI JAWA BAGIAN TIMUR DAN BALI</div>
            </div>
            <div class="logo-right">
                <div class="smk3-logo">SMK3</div>
                <div class="iso-logo">ISO<br>9001</div>
            </div>
        </div>
        
        <!-- Document Title and Info -->
        <div class="doc-info-container">
            <div class="form-title">FORMULIR DAFTAR HADIR RAPAT</div>
            <table class="doc-info-table">
                <tr>
                    <td><strong>No. Dokumen</strong></td>
                    <td>FK3.TJBTB.01.00.02</td>
                </tr>
                <tr>
                    <td><strong>Edisi / Revisi</strong></td>
                    <td>00 / 00</td>
                </tr>
                <tr>
                    <td><strong>Berlaku Efektif</strong></td>
                    <td>01 JANUARI 2019</td>
                </tr>
                <tr>
                    <td><strong>Halaman</strong></td>
                    <td>1 dari 4</td>
                </tr>
            </table>
        </div>
    </div>
    
    <!-- Meeting Information -->
    <div class="meeting-info">
        <table>
            <tr>
                <td><strong>Hari / Tanggal</strong></td>
                <td>:</td>
                <td>{{ date('l, d F Y', strtotime($presence->tgl_kegiatan)) }}</td>
            </tr>
            <tr>
                <td><strong>Waktu</strong></td>
                <td>:</td>
                <td>{{ date('H:i', strtotime($presence->tgl_kegiatan)) }} WIB</td>
            </tr>
            <tr>
                <td><strong>Tempat</strong></td>
                <td>:</td>
                <td>{{ $presence->tempat ?? 'Ruang Rapat' }}</td>
            </tr>
            <tr>
                <td><strong>Jenis Rapat</strong></td>
                <td>:</td>
                <td>{{ $presence->nama_kegiatan }}</td>
            </tr>
        </table>
    </div>
    
    <!-- Attendance Table -->
    <table class="attendance-table">
        <thead>
            <tr>
                <th width="40">NO</th>
                <th width="200">NAMA / NIP</th>
                <th width="150">JABATAN / BIDANG</th>
                <th width="120">EMAIL / NO. HP</th>
                <th width="100">TANDA TANGAN</th>
            </tr>
        </thead>
        <tbody>
            @if ($presenceDetails->isEmpty())
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data peserta</td>
                </tr>
            @else
                @foreach ($presenceDetails as $detail)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>
                            <strong>{{ $detail->nama }}</strong><br>
                            <small>{{ $detail->nip ?? 'NIP: -' }}</small>
                        </td>
                        <td>
                            <strong>{{ $detail->jabatan }}</strong><br>
                            <small>{{ $detail->unit }}</small>
                        </td>
                        <td>
                            {{ $detail->email ?? '-' }}<br>
                            <small>{{ $detail->no_hp ?? '-' }}</small>
                        </td>
                        <td class="text-center">
                            @if ($detail->signature)
                                @php
                                    $path = public_path('uploads/' . $detail->signature);
                                    $type = pathinfo($path, PATHINFO_EXTENSION);
                                    $data = file_get_contents($path);
                                    $img = 'data:image/' . $type . ';base64,' . base64_encode($data);
                                @endphp
                                <img src="{{ $img }}" alt="Tanda Tangan" style="max-width: 80px; max-height: 40px;">
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                @endforeach
                
                <!-- Add empty rows to match original format -->
                @for ($i = count($presenceDetails); $i < 10; $i++)
                    <tr>
                        <td class="text-center">{{ $i + 1 }}</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                @endfor
            @endif
        </tbody>
    </table>
</body>
</html>