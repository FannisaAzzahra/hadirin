<?php

namespace App\Http\Controllers;

use App\Models\AttendanceCode;
use App\Models\Presence;
use App\Models\PresenceDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AttendanceController extends Controller
{
    /**
     * Tampilkan halaman undangan dengan kode unik
     */
    public function showInvitation($slug, Request $request)
    {
        $presence = Presence::with(['slides'])->where('slug', $slug)->firstOrFail();
        
        // Cek apakah ada parameter code
        $code = $request->query('code');
        
        if ($code) {
            // Jika ada code, cari kode tersebut
            $attendanceCode = AttendanceCode::where('code', $code)
                ->where('presence_id', $presence->id)
                ->first();
                
            if (!$attendanceCode) {
                return redirect()->route('attendance.invalid-code', $slug);
            }
            
            if (!$attendanceCode->isValid()) {
                return redirect()->route('attendance.code-used', $slug);
            }
            
            return view('pages.attendance.invitation', compact('presence', 'attendanceCode'));
        }
        
        // Jika tidak ada code, generate kode baru untuk pengunjung ini
        $attendanceCode = AttendanceCode::createForPresence($presence->id);
        
        // Redirect ke URL dengan code
        return redirect()->route('attendance.invitation', [
            'slug' => $slug,
            'code' => $attendanceCode->code
        ]);
    }

    /**
     * Generate link publik untuk admin (tanpa kode)
     */
    public function generatePublicLink($presenceId)
    {
        $presence = Presence::findOrFail($presenceId);
        
        $publicUrl = route('attendance.invitation', [
            'slug' => $presence->slug
        ]);
        
        return response()->json([
            'success' => true,
            'url' => $publicUrl
        ]);
    }

    /**
     * Tampilkan form absensi
     */
    public function showAttendanceForm($slug, Request $request)
    {
        $presence = Presence::with(['slides'])->where('slug', $slug)->firstOrFail();
        $code = $request->query('code');
        
        if (!$code) {
            return redirect()->route('attendance.invitation', $slug);
        }
        
        $attendanceCode = AttendanceCode::where('code', $code)
            ->where('presence_id', $presence->id)
            ->first();
            
        if (!$attendanceCode || !$attendanceCode->isValid()) {
            return redirect()->route('attendance.invalid-code', $slug);
        }
        
        return view('pages.attendance.form', compact('presence', 'attendanceCode'));
    }

    /**
     * Proses absensi
     */
    public function submitAttendance(Request $request, $slug)
    {
        $presence = Presence::where('slug', $slug)->firstOrFail();
        
        $request->validate([
            'code' => 'required|string|size:10',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'nip' => 'nullable|string|max:20',
            'jabatan' => 'nullable|string|max:255',
            'unit' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:15',
        ]);

        // Cari kode unik
        $attendanceCode = AttendanceCode::where('code', $request->code)
            ->where('presence_id', $presence->id)
            ->first();

        if (!$attendanceCode) {
            return back()->withErrors(['code' => 'Kode unik tidak valid.'])->withInput();
        }

        if (!$attendanceCode->isValid()) {
            return back()->withErrors(['code' => 'Kode unik sudah digunakan atau sudah kadaluarsa.'])->withInput();
        }

        // Cek apakah sudah ada absensi dengan email yang sama
        $existingAttendance = PresenceDetail::where('presence_id', $presence->id)
            ->where('email', $request->email)
            ->first();

        if ($existingAttendance) {
            return back()->withErrors(['email' => 'Email ini sudah terdaftar untuk kegiatan ini.'])->withInput();
        }

        // Simpan data absensi
        $presenceDetail = PresenceDetail::create([
            'presence_id' => $presence->id,
            'nama' => $request->nama,
            'email' => $request->email,
            'nip' => $request->nip,
            'jabatan' => $request->jabatan,
            'unit' => $request->unit,
            'no_hp' => $request->no_hp,
        ]);

        // Tandai kode sebagai sudah digunakan
        $attendanceCode->markAsUsed();

        return redirect()->route('attendance.success', $slug)->with('success', 'Absensi berhasil dicatat!');
    }

    /**
     * Halaman sukses absensi
     */
    public function success($slug)
    {
        $presence = Presence::where('slug', $slug)->firstOrFail();
        
        // Ambil data kehadiran untuk ditampilkan
        $presenceDetails = PresenceDetail::where('presence_id', $presence->id)
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('pages.attendance.success', compact('presence', 'presenceDetails'));
    }

    /**
     * Halaman kode tidak valid
     */
    public function invalidCode($slug)
    {
        $presence = Presence::where('slug', $slug)->firstOrFail();
        return view('pages.attendance.invalid-code', compact('presence'));
    }

    /**
     * Halaman kode sudah digunakan
     */
    public function codeUsed($slug)
    {
        $presence = Presence::where('slug', $slug)->firstOrFail();
        return view('pages.attendance.code-used', compact('presence'));
    }

    /**
     * Generate kode unik baru (untuk admin)
     */
    public function generateCode($presenceId)
    {
        $presence = Presence::findOrFail($presenceId);
        $attendanceCode = AttendanceCode::createForPresence($presence->id);
        
        $invitationUrl = route('attendance.invitation', [
            'slug' => $presence->slug,
            'code' => $attendanceCode->code
        ]);
        
        return response()->json([
            'success' => true,
            'code' => $attendanceCode->code,
            'url' => $invitationUrl
        ]);
    }
}
