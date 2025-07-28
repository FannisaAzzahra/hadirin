<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presence;
use App\Models\PlnMember;
use App\Models\PresenceDetail;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $totalKegiatan = Presence::count();
        $totalAnggota = PlnMember::count();
        $totalKehadiran = PresenceDetail::count();

        $totalPresenceExpected = $totalAnggota * $totalKegiatan;
        $persentaseKehadiran = ($totalPresenceExpected > 0) ? ($totalKehadiran / $totalPresenceExpected) * 100 : 0;
        $persentaseKehadiran = number_format($persentaseKehadiran, 2);

        $notifikasiAbsensi = PresenceDetail::with(['pln_member', 'presence'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $activities = Presence::all();

        return view('home', compact('totalKegiatan', 'totalAnggota', 'persentaseKehadiran', 'notifikasiAbsensi', 'activities'));
    }

    public function notifications()
    {
        $notifications = \App\Models\PresenceDetail::with(['pln_member', 'presence'])
            ->latest()
            ->take(5)
            ->get();
        return response()->json($notifications);
    }

    public function calendarData()
    {
        // Set locale for Carbon to Indonesian for consistent formatting if needed elsewhere
        Carbon::setLocale('id');

        $events = \App\Models\Presence::all(); // Mengambil semua data kegiatan

        $formattedEvents = $events->map(function ($event) {
            // Pastikan menggunakan kolom 'tgl_kegiatan' yang menyimpan tanggal dan waktu
            // FullCalendar akan menggunakan 'start' untuk tanggal dan waktu event
            return [
                'title' => $event->nama_kegiatan,
                'start' => Carbon::parse($event->tgl_kegiatan)->toIso8601String(), // Format ISO 8601 untuk kompatibilitas FullCalendar
                // Menambahkan properti 'lokasi' dan 'link_lokasi' ke extendedProps
                'extendedProps' => [
                    'lokasi' => $event->lokasi,
                    'link_lokasi' => $event->link_lokasi,
                    // Waktu mulai sudah termasuk dalam 'start', tapi bisa ditambahkan jika perlu terpisah
                    // 'waktu_mulai' => Carbon::parse($event->tgl_kegiatan)->format('H:i'),
                ],
                'id' => $event->id, // Penting jika Anda ingin mengakses ID event
            ];
        });

        return response()->json($formattedEvents);
    }
}