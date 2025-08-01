<?php

namespace App\Http\Controllers;

use App\DataTables\AbsenDataTable;
use App\Models\Presence;
use App\Models\PresenceDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\PlnMember;

class AbsenController extends Controller
{
    public function index($slug, AbsenDataTable $dataTable)
    {
        $presence = Presence::where('slug', $slug)->firstOrFail();

        // CEK NONAKTIF
        if (!$presence->is_active) {
            abort(403, 'Absensi ini sudah dinonaktifkan oleh admin.');
        }

        // CEK BATAS WAKTU
        if ($presence->batas_waktu && now()->greaterThan($presence->batas_waktu)) {
            abort(403, 'Absensi ini sudah ditutup (lewat batas waktu).');
        }

        $plnMembers = PlnMember::all();
        return $dataTable->render('pages.absen.index', compact('presence', 'plnMembers'));
    }

    public function save(Request $request, string $id)
    {
        $presence = Presence::findOrFail($id);

        $rules = [
            'nama'      => 'required|string',
            'nip'       => 'nullable|string', // Changed to nullable as per migration
            'email'     => 'nullable|email', // Changed to nullable as per migration
            'jabatan'   => 'nullable|string', // Changed to nullable as per migration
            'unit'      => 'required|in:PLN UIT JBM,PLN Lainnya,Non PLN', // Updated options
            'no_hp'     => 'required|string',
            'signature' => 'required',
        ];

        // Conditional validation for unit_dtl
        if ($request->unit === 'PLN UIT JBM') {
            $rules['unit_dtl'] = 'required|in:KANTOR INDUK,UPT SURABAYA,UPT MALANG,UPT GRESIK,UPT MADIUN,UPT PROBOLINGGO,UPT BALI';
        } else {
            $rules['unit_dtl'] = 'required|string'; // For PLN Lainnya or Non PLN, it's a string input
        }

        $request->validate($rules);


        // Mengambil data presence nya berdasarkan id
        $presenceDetail = new PresenceDetail();
        $presenceDetail->presence_id = $presence->id;
        $presenceDetail->nama = $request->nama;
        $presenceDetail->unit = $request->unit;
        $presenceDetail->unit_dtl = $request->unit_dtl; // Save unit_dtl
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

        return redirect()->back()->with('success', 'Absensi berhasil disimpan!'); // Added success message
    }
}