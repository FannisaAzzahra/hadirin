<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use App\Models\PresenceDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AbsenController extends Controller
{
    public function index($slug)
    {
        $presence = Presence::where('slug', $slug)->first();
        return view ('pages.absen.index', compact('presence'));
    }

    public function save(Request $request, string $id)
    {
        $presence = Presence::findOrFail($id);
        $request->validate([
            'nama' => 'required',
            'jabatan' => 'required',
            'unit' => 'required',
            'signature' => 'required',

        ]);

        // mengambil data presence nya berdasarkan id
        $presenceDetail = new PresenceDetail();
        $presenceDetail->presence_id = $presence->id;
        $presenceDetail->nama = $request->nama;
        $presenceDetail->jabatan = $request->jabatan;
        $presenceDetail->unit = $request->unit;

        // decode base64 image
        $base64_image = $request->signature;
        @list($type, $file_data) = explode(';', $base64_image);
        @list(, $file_data) = explode(',', $file_data);

        // generate nama file
        $uniqChar = date('YmdHis').uniqid();
        $signature = "tanda-tangan/{$uniqChar}.png";

        // simpan gambar ke public storage
        Storage::disk('public_uploads')->put($signature, base64_decode($file_data));

        $presenceDetail->signature = $signature;
        $presenceDetail->save();

        return redirect()->back();
    }

}
