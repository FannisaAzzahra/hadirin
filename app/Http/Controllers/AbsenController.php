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
        
        $request->validate([
            'nama'      => 'required|string',
            'nip'       => 'required|string',
            'email'     => 'required|email',
            'jabatan'   => 'required|string',
            'unit'      => 'required|in:PLN,PLN Group,Non PLN',
            'no_hp'     => 'required|string',
            'signature' => 'required',
        ]);

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

        return redirect()->back();
    }
}