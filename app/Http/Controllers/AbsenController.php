<?php

namespace App\Http\Controllers;

use App\DataTables\AbsenDataTable;
use App\Models\Presence;
use App\Models\PresenceDetail;
use App\Models\AttendanceCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\PlnMember;

class AbsenController extends Controller
{
    public function index($slug, AbsenDataTable $dataTable, Request $request)
    {
        $presence = Presence::where('slug', $slug)->firstOrFail();
        $code = $request->query('code');

        // CEK NONAKTIF
        if (!$presence->is_active) {
            abort(403, 'Absensi ini sudah dinonaktifkan oleh admin.');
        }

        // CEK BATAS WAKTU
        if ($presence->batas_waktu && now()->greaterThan($presence->batas_waktu)) {
            abort(403, 'Absensi ini sudah ditutup (lewat batas waktu).');
        }

        // Validasi kode unik jika ada
        $attendanceCode = null;
        if ($code) {
            $attendanceCode = AttendanceCode::where('code', $code)
                ->where('presence_id', $presence->id)
                ->first();
                
            // Jika kode tidak ditemukan, abort
            if (!$attendanceCode) {
                abort(403, 'Kode unik tidak valid.');
            }
            
            // Jika kode sudah digunakan, tetap tampilkan form tapi dengan pesan
            if (!$attendanceCode->isValid()) {
                // Tidak abort, hanya set attendanceCode ke null agar form tetap bisa diakses
                $attendanceCode = null;
            }
        }

        $plnMembers = PlnMember::all();
        return $dataTable->render('pages.absen.index', compact('presence', 'plnMembers', 'code', 'attendanceCode'));
    }

    public function save(Request $request, string $id)
    {
        $presence = Presence::findOrFail($id);
        $uniqueCode = $request->unique_code;

        $request->validate([
            'nama'      => 'required|string',
            'nip'       => 'required|string',
            'email'     => 'required|email',
            'jabatan'   => 'required|string',
            'unit'      => 'required|in:PLN,PLN Group,Non PLN',
            'no_hp'     => 'required|string',
            'signature' => 'required',
            'unique_code' => 'required|string',
        ]);

        // Validasi kode unik
        if ($uniqueCode) {
            $attendanceCode = AttendanceCode::where('code', $uniqueCode)
                ->where('presence_id', $presence->id)
                ->first();

            if (!$attendanceCode) {
                return back()->withErrors(['unique_code' => 'Kode unik tidak valid.'])->withInput();
            }

            if (!$attendanceCode->isValid()) {
                return back()->withErrors(['unique_code' => 'Kode unik sudah digunakan atau sudah kadaluarsa.'])->withInput();
            }

            // Cek apakah sudah ada absensi dengan email yang sama
            $existingAttendance = PresenceDetail::where('presence_id', $presence->id)
                ->where('email', $request->email)
                ->first();

            if ($existingAttendance) {
                return back()->withErrors(['email' => 'Email ini sudah terdaftar untuk kegiatan ini.'])->withInput();
            }
        }

        // Mengambil data presence nya berdasarkan id
        $presenceDetail = new PresenceDetail();
        $presenceDetail->presence_id = $presence->id;
        $presenceDetail->nama = $request->nama;
        $presenceDetail->unit = $request->unit;
        $presenceDetail->no_hp = $request->no_hp;

        // Semua field diisi dari input, tidak ada yang dikosongkan
        $presenceDetail->nip = $request->nip;
        $presenceDetail->email = $request->email;
        $presenceDetail->jabatan = $request->jabatan;

        // Decode base64 image
        $base64_image = $request->signature;
        @list($type, $file_data) = explode(';', $base64_image);
        @list(, $file_data) = explode(',', $file_data);

        // Generate nama file
        $uniqChar = date('YmdHis').uniqid();
        $signature = "tanda-tangan/{$uniqChar}.png";

        // Simpan gambar ke public storage
        Storage::disk('public_uploads')->put($signature, base64_decode($file_data));

        $presenceDetail->signature = $signature;
        $presenceDetail->save();

        // Tandai kode sebagai sudah digunakan jika ada
        if ($attendanceCode) {
            $attendanceCode->markAsUsed();
            
            // Redirect ke halaman sukses jika ada kode unik
            return redirect()->route('attendance.success', $presence->slug)->with('success', 'Absensi berhasil dicatat!');
        }

        // Jika tidak ada kode unik, redirect back dengan pesan sukses
        return redirect()->back()->with('success', 'Absensi berhasil dicatat!');
    }
}
