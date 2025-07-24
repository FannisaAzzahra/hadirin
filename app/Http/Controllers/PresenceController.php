<?php

namespace App\Http\Controllers;

use App\DataTables\PresenceDataTable;
use App\DataTables\PresenceDetailsDataTable;
use App\Models\Presence;
use App\Models\PresenceDetail;
use App\Models\PresenceSlide;
use Illuminate\Http\Request; // Pastikan ini sudah ada
use Illuminate\Support\Str;

class PresenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PresenceDataTable $dataTable, Request $request) // Tambahkan Request $request
    {

        // Ambil tanggal dari request, jika ada
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Lewatkan tanggal ke DataTables
        return $dataTable->with([
            'startDate' => $startDate,
            'endDate' => $endDate
        ])->render('pages.presence.index'); // Sesuaikan dengan nama view Anda
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get previous presences that have slides for the dropdown
        $previousSlides = Presence::whereHas('slides')
            ->select('id', 'nama_kegiatan', 'tgl_kegiatan')
            ->with(['slides:id,presence_id,image_path'])
            ->orderBy('tgl_kegiatan', 'desc')
            ->get();

        return view('pages.presence.create', compact('previousSlides'));
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
            'slide_option'   => 'required|in:previous,new,none',
            'previous_presence_id' => 'nullable|exists:presences,id',
            'slide_images' => 'nullable|array|max:5',
            'slide_images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
            'logo_ig'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'link_ig' => 'nullable|string|max:255',
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

        // Tambahkan prefix instagram
        $presence->link_ig = $validated['link_ig']
            ? 'https://instagram.com/' . ltrim($validated['link_ig'], '@/')
            : null;

        $presence->save();

        // Handle slide options
        $this->handleSlideOptions($request, $presence, $validated);

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
        
        // Get previous presences that have slides for the dropdown (excluding current presence)
        $previousSlides = Presence::whereHas('slides')
            ->where('id', '!=', $id)
            ->select('id', 'nama_kegiatan', 'tgl_kegiatan')
            ->with(['slides:id,presence_id,image_path'])
            ->orderBy('tgl_kegiatan', 'desc')
            ->get();

        $isEdit = true;

        return view('pages.presence.edit', compact('presence', 'previousSlides', 'isEdit'));
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
            'slide_option'   => 'required|in:keep,previous,new,none',
            'previous_presence_id' => 'nullable|exists:presences,id',
            'slide_images' => 'nullable|array|max:5',
            'slide_images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
            'logo_ig'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'link_ig' => 'nullable|string|max:255',
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

        // Tambahkan prefix instagram
        $presence->link_ig = $validated['link_ig']
            ? 'https://instagram.com/' . ltrim($validated['link_ig'], '@/')
            : null;

        $presence->save();

        // Handle slide options for update
        $this->handleSlideOptionsForUpdate($request, $presence, $validated);

        return redirect()->route('presence.index')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $presence = Presence::findOrFail($id);

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

        // Delete logos
        foreach (['logo_kiri', 'logo_kanan', 'logo_ig'] as $field) {
            if ($presence->$field && file_exists(public_path('uploads/' . $presence->$field))) {
                unlink(public_path('uploads/' . $presence->$field));
            }
        }

        // Delete main presence
        $presence->delete();

        return response()->json(['status' => 'success', 'message' => 'Data berhasil dihapus']);
    }

    /**
     * Handle slide options for create
     */
    private function handleSlideOptions(Request $request, Presence $presence, array $validated)
    {
        $slideOption = $validated['slide_option'];

        switch ($slideOption) {
            case 'previous':
                if (!empty($validated['previous_presence_id'])) {
                    $this->copySlides($validated['previous_presence_id'], $presence->id);
                }
                break;

            case 'new':
                if ($request->hasFile('slide_images')) {
                    $this->uploadNewSlides($request->file('slide_images'), $presence);
                }
                break;

            case 'none':
                // No slides to handle
                break;
        }
    }

    /**
     * Handle slide options for update
     */
    private function handleSlideOptionsForUpdate(Request $request, Presence $presence, array $validated)
    {
        $slideOption = $validated['slide_option'];

        switch ($slideOption) {
            case 'keep':
                // Keep existing slides, do nothing
                break;

            case 'previous':
                if (!empty($validated['previous_presence_id'])) {
                    // Delete current slides first
                    $this->deleteExistingSlides($presence);
                    // Copy from previous
                    $this->copySlides($validated['previous_presence_id'], $presence->id);
                }
                break;

            case 'new':
                if ($request->hasFile('slide_images')) {
                    // Delete current slides first
                    $this->deleteExistingSlides($presence);
                    // Upload new slides
                    $this->uploadNewSlides($request->file('slide_images'), $presence);
                }
                break;

            case 'none':
                // Delete all existing slides
                $this->deleteExistingSlides($presence);
                break;
        }
    }

    /**
     * Copy slides from previous presence
     */
    private function copySlides($fromPresenceId, $toPresenceId)
    {
        $sourceSlides = PresenceSlide::where('presence_id', $fromPresenceId)->get();
        
        foreach ($sourceSlides as $sourceSlide) {
            // Copy the actual file
            $sourcePath = public_path('uploads/' . $sourceSlide->image_path);
            if (file_exists($sourcePath)) {
                $extension = pathinfo($sourceSlide->image_path, PATHINFO_EXTENSION);
                $newFileName = 'slides/' . Str::random(40) . '.' . $extension;
                $destinationPath = public_path('uploads/' . $newFileName);
                
                // Ensure slides directory exists
                $slideDir = public_path('uploads/slides');
                if (!file_exists($slideDir)) {
                    mkdir($slideDir, 0755, true);
                }
                
                if (copy($sourcePath, $destinationPath)) {
                    // Create new slide record
                    PresenceSlide::create([
                        'presence_id' => $toPresenceId,
                        'image_path' => $newFileName,
                    ]);
                }
            }
        }
    }

    /**
     * Upload new slides
     */
    private function uploadNewSlides(array $files, Presence $presence)
    {
        foreach (array_slice($files, 0, 5) as $file) {
            $path = $file->store("slides", 'public_uploads');
            $presence->slides()->create(['image_path' => $path]);
        }
    }

    /**
     * Delete existing slides
     */
    private function deleteExistingSlides(Presence $presence)
    {
        foreach ($presence->slides as $slide) {
            if ($slide->image_path && file_exists(public_path('uploads/' . $slide->image_path))) {
                unlink(public_path('uploads/' . $slide->image_path));
            }
            $slide->delete();
        }
        
        // Refresh the relationship
        $presence->load('slides');
    }
}