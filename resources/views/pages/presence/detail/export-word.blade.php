<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Formulir Daftar Hadir Rapat</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 1cm; /* Margin 1cm di semua sisi */
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .attendance-table {
            table-layout: fixed; /* Penting untuk memaksa Word menghormati lebar kolom */
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
        }
        .attendance-table th, .attendance-table td {
            border: 1px solid black;
            padding: 5px;
            word-wrap: break-word; /* Memastikan teks turun jika terlalu panjang */
        }
        .breakable {
            word-break: break-all; /* Memaksa teks untuk patah agar tidak meluap */
        }
    </style>
</head>
<body>
    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/header.png'))) }}" width="601" alt="Header">

    <div style="margin-top: 20px; margin-bottom: 20px;">
        <table border="0" cellspacing="0" cellpadding="2" style="font-size: 12px;">
            <tr>
                <td width="120">Nama Kegiatan</td>
                <td width="10">:</td>
                <td>{{ $presence->nama_kegiatan }}</td>
            </tr>
            @php
                \Carbon\Carbon::setLocale('id');
                $tanggalIndo = \Carbon\Carbon::parse($presence->tgl_kegiatan)->translatedFormat('l, d F Y');
            @endphp
            <tr>
                <td>Hari / Tanggal</td>
                <td>:</td>
                <td>{{ $tanggalIndo }}</td>
            </tr>
            <tr>
                <td>Waktu Mulai</td>
                <td>:</td>
                <td>{{ date('H:i', strtotime($presence->tgl_kegiatan)) }} WIB</td>
            </tr>
            <tr>
                <td>Lokasi</td>
                <td>:</td>
                <td>{{ $presence->lokasi }}</td>
            </tr>
        </table>
    </div>

    <table class="attendance-table">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th align="center" width="5%">NO</th>
                <th align="center" width="15%">WAKTU ABSENSI</th>
                <th align="center" width="20%">NAMA / NIP</th>
                <th align="center" width="20%">UNIT / JABATAN</th>
                <th align="center" width="25%">EMAIL / NO. HP</th>
                <th align="center" width="15%">TANDA TANGAN</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($presenceDetails as $index => $detail)
                <tr>
                    <td align="center">{{ $index + 1 }}</td>
                    <td align="center">
                        @php
                            \Carbon\Carbon::setLocale('id');
                            $waktuAbsen = \Carbon\Carbon::parse($detail->created_at)->translatedFormat('d/m/Y H:i');
                        @endphp
                        {{ $waktuAbsen }}
                    </td>
                    <td class="breakable">
                        {{ $detail->nama }} / <br>
                        {{ $detail->nip ?? '-' }}
                    </td>
                    <td class="breakable">
                        {{ $detail->unit }} / <br>
                        {{ $detail->jabatan ?? '-' }}
                    </td>
                    <td class="breakable">{{ $detail->email ?? '-' }} / <br> {{ $detail->no_hp }}</td>
                    <td align="center" valign="middle">
                        @if ($detail->signature)
                            @php
                                $img = null;
                                try {
                                    if (\Storage::disk('public')->exists($detail->signature)) {
                                        $path = \Storage::disk('public')->path($detail->signature);
                                    } else {
                                        $path = public_path('uploads/' . $detail->signature); // legacy fallback
                                    }
                                    if (file_exists($path)) {
                                        $type = pathinfo($path, PATHINFO_EXTENSION);
                                        $data = file_get_contents($path);
                                        $img = 'data:image/' . $type . ';base64,' . base64_encode($data);
                                    }
                                } catch (\Throwable $e) {
                                    $img = null;
                                }
                            @endphp
                            @if($img)
                                <img src="{{ $img }}" alt="Signature" width="100" style="width: 100px; max-height:40px;">
                            @endif
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" align="center" style="padding: 20px; font-style: italic;">Tidak ada data peserta</td></tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
