<?php

namespace App\Http\Controllers;

use App\DataTables\PresenceDataTable;
use App\DataTables\PresenceDetailsDataTable;
use App\Models\Presence;
use App\Models\PresenceDetail;
use App\Models\PresenceSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PresenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PresenceDataTable $dataTable)
    {
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
        $validated = $request->validate([
            'nama_kegiatan'  => 'required',
            'tgl_kegiatan'   => 'required',
            'waktu_mulai'    => 'required',
            'lokasi'         => 'required',
            'link_lokasi'    => 'nullable|url',
            'batas_waktu'    => 'nullable|date',
            'is_active'      => 'nullable',
            'judul_header'   => 'nullable|string|max:255',
            'logo_kiri'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'logo_kanan'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'slide_images' => 'nullable|array|max:5',
            'slide_images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
            'logo_ig'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'link_ig'        => 'nullable|url',
        ]);

        $presence = new Presence();
        $presence->nama_kegiatan = $validated['nama_kegiatan'];
        $presence->slug = Str::slug($validated['nama_kegiatan']);
        $presence->tgl_kegiatan = $validated['tgl_kegiatan'] . ' ' . $validated['waktu_mulai'];
        $presence->lokasi = $validated['lokasi'];
        $presence->link_lokasi = $validated['link_lokasi'] ?? null;
        $presence->batas_waktu = $validated['batas_waktu'] ?? null;
        $presence->is_active = $request->has('is_active');
        $presence->judul_header = $validated['judul_header'] ?? null;

        foreach (['logo_kiri', 'logo_kanan'] as $field) {
            if ($request->hasFile($field)) {
                $presence->$field = $request->file($field)->store("presence_logos", 'public_uploads');
            }
        }

        if ($request->hasFile('logo_ig')) {
            $presence->logo_ig = $request->file('logo_ig')->store("ig_logos", 'public_uploads');
        }

        $presence->link_ig = $validated['link_ig'] ?? null;
        $presence->save();

        // Save up to 5 slide images
        if ($request->hasFile('slide_images')) {
            foreach (array_slice($request->file('slide_images'), 0, 5) as $file) {
                $path = $file->store("slides", 'public_uploads');
                $presence->slides()->create(['image_path' => $path]);
            }
        }

        return redirect()->route('presence.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, PresenceDetailsDataTable $dataTable)
    {
        $presence = Presence::with('slides')->findOrFail($id);
        return $dataTable->render('pages.presence.detail.index', compact('presence'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $presence = Presence::with('slides')->findOrFail($id);
        return view('pages.presence.edit', compact('presence'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama_kegiatan'  => 'required',
            'tgl_kegiatan'   => 'required',
            'waktu_mulai'    => 'required',
            'lokasi'         => 'required',
            'link_lokasi'    => 'nullable|url',
            'batas_waktu'    => 'nullable|date',
            'is_active'      => 'nullable',
            'judul_header'   => 'nullable|string|max:255',
            'logo_kiri'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'logo_kanan'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'slide_images' => 'nullable|array|max:5',
            'slide_images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
            'logo_ig'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'link_ig'        => 'nullable|url',
        ]);

        $presence = Presence::findOrFail($id);
        $presence->nama_kegiatan = $validated['nama_kegiatan'];
        $presence->slug = Str::slug($validated['nama_kegiatan']);
        $presence->tgl_kegiatan = $validated['tgl_kegiatan'] . ' ' . $validated['waktu_mulai'];
        $presence->lokasi = $validated['lokasi'];
        $presence->link_lokasi = $validated['link_lokasi'] ?? null;
        $presence->batas_waktu = $validated['batas_waktu'] ?? null;
        $presence->is_active = $request->has('is_active');
        $presence->judul_header = $validated['judul_header'] ?? null;

        foreach (['logo_kiri', 'logo_kanan'] as $field) {
            if ($request->hasFile($field)) {
                if ($presence->$field && file_exists(public_path('uploads/' . $presence->$field))) {
                    unlink(public_path('uploads/' . $presence->$field));
                }
                $presence->$field = $request->file($field)->store("presence_logos", 'public_uploads');
            }
        }

        if ($request->hasFile('logo_ig')) {
            if ($presence->logo_ig && file_exists(public_path('uploads/' . $presence->logo_ig))) {
                unlink(public_path('uploads/' . $presence->logo_ig));
            }
            $presence->logo_ig = $request->file('logo_ig')->store("ig_logos", 'public_uploads');
        }

        $presence->link_ig = $validated['link_ig'] ?? null;
        $presence->save();

        // Replace slide images
        if ($request->hasFile('slide_images')) {
            foreach ($presence->slides as $slide) {
                if ($slide->image_path && file_exists(public_path('uploads/' . $slide->image_path))) {
                    unlink(public_path('uploads/' . $slide->image_path));
                }
                $slide->delete();
            }

            foreach (array_slice($request->file('slide_images'), 0, 5) as $file) {
                $path = $file->store("slides", 'public_uploads');
                $presence->slides()->create(['image_path' => $path]);
            }
        }
        return redirect()->route('presence.index')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Delete presence details
        $presenceDetails = PresenceDetail::where('presence_id', $id)->get();
        foreach ($presenceDetails as $detail) {
            if ($detail->signature) {
                $filePath = public_path('uploads/' . $detail->signature);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
            $detail->delete();
        }

        // Delete slides
        $slides = PresenceSlide::where('presence_id', $id)->get();
        foreach ($slides as $slide) {
            if ($slide->image_path) {
                $filePath = public_path('uploads/' . $slide->image_path);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
            $slide->delete();
        }

        // Delete main presence
        Presence::destroy($id);

        return response()->json(['status' => 'success', 'message' => 'Data berhasil dihapus']);
    }
}
