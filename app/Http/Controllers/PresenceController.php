<?php

namespace App\Http\Controllers;

use App\DataTables\PresenceDataTable;
use App\DataTables\PresenceDetailsDataTable;
use App\Models\Presence;
use App\Models\PresenceDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PresenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PresenceDataTable $dataTable)
    {
        // $presences = Presence::all();
        return $dataTable->render('pages.presence.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.presence.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kegiatan' => 'required',
            'tgl_kegiatan' => 'required',
            'waktu_mulai' => 'required',
            'lokasi' => 'required',
            'link_lokasi' => 'nullable|url',
            'batas_waktu' => 'nullable|date',
            'is_active' => 'nullable',
            'judul_header' => 'nullable|string|max:255',
            'logo_kiri' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'logo_kanan' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
        
        $presence = new Presence(); 
        $presence->nama_kegiatan = $request->nama_kegiatan;
        $presence->slug = Str::slug($request->nama_kegiatan);
        $presence->tgl_kegiatan = $request->tgl_kegiatan. ' ' .$request->waktu_mulai;
        $presence->lokasi = $request->lokasi;
        $presence->link_lokasi = $request->link_lokasi;
        $presence->batas_waktu = $request->batas_waktu;
        $presence->is_active = $request->has('is_active');
        $presence->judul_header = $request->input('judul_header');
            if ($request->hasFile('logo_kiri')) {
                $presence->logo_kiri = $request->file('logo_kiri')->store('', 'public_uploads');
            }
            if ($request->hasFile('logo_kanan')) {
                $presence->logo_kanan = $request->file('logo_kanan')->store('', 'public_uploads');
            }
        $presence->save();

        return redirect()->route('presence.index')->with('success', 'Data berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, PresenceDetailsDataTable $dataTable)
    {
        $presence = Presence::findOrFail($id);
        return $dataTable->render('pages.presence.detail.index', compact('presence'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $presence = Presence::findOrFail($id);
        return view('pages.presence.edit', compact('presence'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_kegiatan' => 'required',
            'tgl_kegiatan' => 'required',
            'waktu_mulai' => 'required',
            'lokasi' => 'required',
            'link_lokasi' => 'nullable|url',
            'batas_waktu' => 'nullable|date',
            'is_active' => 'nullable',
            'judul_header' => 'nullable|string|max:255',
            'logo_kiri' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'logo_kanan' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $presence = Presence::findOrFail($id); 
        $presence->nama_kegiatan = $request->nama_kegiatan;
        $presence->slug = Str::slug($request->nama_kegiatan);
        $presence->tgl_kegiatan = $request->tgl_kegiatan. ' ' .$request->waktu_mulai;
        $presence->lokasi = $request->lokasi;
        $presence->link_lokasi = $request->link_lokasi;
        $presence->batas_waktu = $request->batas_waktu;
        $presence->is_active = $request->has('is_active');
        $presence->judul_header = $request->input('judul_header');
        
        if ($request->hasFile('logo_kiri')) {
            if ($presence->logo_kiri && file_exists(public_path('uploads/' . $presence->logo_kiri))) {
                unlink(public_path('uploads/' . $presence->logo_kiri));
            }
            $presence->logo_kiri = $request->file('logo_kiri')->store('', 'public_uploads');
        }

        if ($request->hasFile('logo_kanan')) {
            if ($presence->logo_kanan && file_exists(public_path('uploads/' . $presence->logo_kanan))) {
                unlink(public_path('uploads/' . $presence->logo_kanan));
            }
            $presence->logo_kanan = $request->file('logo_kanan')->store('', 'public_uploads');
        }

        $presence->save();

        return redirect()->route('presence.index')->with('success', 'Data berhasil diupdate');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Delete data detail absen
        $presenceDetail = PresenceDetail::where('presence_id', $id)->get();
        foreach ($presenceDetail as $pd) {
            if ($pd->signature) {
                $filePath = public_path('uploads/' . $pd->signature);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
            $pd->delete();
        }

        //Delete kegiatan
        Presence::destroy($id);

        return response()->json(['status' => 'success', 'message' => 'Data berhasil dihapus']);

    }
}
