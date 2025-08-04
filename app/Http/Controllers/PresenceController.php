<?php

namespace App\Http\Controllers;

use App\DataTables\PresenceDataTable;
use App\DataTables\PresenceDetailsDataTable;
use App\Models\Presence;
use App\Models\PresenceDetail;
use App\Models\PresenceSlide;
use App\Models\Company; // Tambahkan import Company model
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PresenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PresenceDataTable $dataTable, Request $request)
    {

        // Ambil tanggal dari request, jika ada
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Lewatkan tanggal ke DataTables
        return $dataTable->with([
            'startDate' => $startDate,
            'endDate' => $endDate
        ])->render('pages.presence.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get previous presences that have slides for the dropdown
        $previousSlides = Presence::whereHas('slides')
            ->select('id', 'nama_kegiatan', 'tgl_kegiatan', 'judul_header_atas', 'judul_header_bawah', 'logo_kiri', 'logo_kanan', 'logo_ig', 'link_ig')
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
        // Debug: Log incoming request data
        Log::info('Store request data:', [
            'slide_option' => $request->input('slide_option'),
            'has_slide_images' => $request->hasFile('slide_images'),
            'slide_images_count' => $request->hasFile('slide_images') ? count($request->file('slide_images')) : 0,
            'all_files' => $request->allFiles()
        ]);

        $validated = $request->validate([
            'nama_kegiatan'          => 'required',
            'tgl_kegiatan'           => 'required',
            'waktu_mulai'            => 'required',
            'lokasi'                 => 'required',
            'link_lokasi'            => 'nullable|url',
            'batas_waktu'            => 'nullable|date',
            'is_active'              => 'nullable',
            'judul_header'           => 'nullable|string|max:255',
            'judul_header_atas'      => 'nullable|string|max:255',
            'judul_header_bawah'     => 'nullable|string|max:255',
            'logo_kiri'              => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'logo_kanan'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'slide_option'           => 'required|in:previous,new,none',
            'previous_presence_id'   => 'nullable|exists:presences,id',
            'slide_images'           => 'nullable|array|max:5',
            'slide_images.*'         => 'image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'logo_ig'                => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'link_ig'                => 'nullable|string|max:255',
            'display_option'         => 'required|in:previous,manual',
            'previous_display_id'    => 'nullable|exists:presences,id',
        ]);

        Log::info('Validation passed for store');

        $presence = new Presence();
        $presence->nama_kegiatan = $validated['nama_kegiatan'];
        $presence->slug = Str::slug($validated['nama_kegiatan']);
        $presence->tgl_kegiatan = $validated['tgl_kegiatan'] . ' ' . $validated['waktu_mulai'];
        $presence->lokasi = $validated['lokasi'];
        $presence->link_lokasi = $validated['link_lokasi'] ?? null;
        $presence->batas_waktu = $validated['batas_waktu'] ?? null;
        $presence->is_active = $request->has('is_active');
        $presence->judul_header = $validated['judul_header'] ?? null;
        $presence->display_option_type = $validated['display_option'];
        $presence->slide_option_type = $validated['slide_option'];

        // Handle display options
        $this->handleDisplayOptions($request, $presence, $validated);

        foreach (['logo_kiri', 'logo_kanan'] as $field) {
            if ($request->hasFile($field)) {
                $presence->$field = $request->file($field)->store("presence_logos", 'public_uploads');
            }
        }

        if ($request->hasFile('logo_ig')) {
            $presence->logo_ig = $request->file('logo_ig')->store("ig_logos", 'public_uploads');
        }

        $presence->link_ig = $validated['link_ig']
            ? 'https://instagram.com/' . ltrim($validated['link_ig'], '@/')
            : null;

        $presence->save();
        Log::info('Presence saved with ID: ' . $presence->id);

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
            ->select('id', 'nama_kegiatan', 'tgl_kegiatan', 'judul_header_atas', 'judul_header_bawah', 'logo_kiri', 'logo_kanan', 'logo_ig', 'link_ig')
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
        // Debug: Log incoming request data
        Log::info('Update request data:', [
            'presence_id' => $id,
            'slide_option' => $request->input('slide_option'),
            'has_slide_images' => $request->hasFile('slide_images'),
            'slide_images_count' => $request->hasFile('slide_images') ? count($request->file('slide_images')) : 0,
        ]);

        $validated = $request->validate([
            'nama_kegiatan'          => 'required',
            'tgl_kegiatan'           => 'required',
            'waktu_mulai'            => 'required',
            'lokasi'                 => 'required',
            'link_lokasi'            => 'nullable|url',
            'batas_waktu'            => 'nullable|date',
            'is_active'              => 'nullable',
            'judul_header'           => 'nullable|string|max:255',
            'judul_header_atas'      => 'nullable|string|max:255',
            'judul_header_bawah'     => 'nullable|string|max:255',
            'logo_kiri'              => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'logo_kanan'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'slide_option'           => 'required|in:keep,previous,new,none',
            'previous_presence_id'   => 'nullable|exists:presences,id',
            'slide_images'           => 'nullable|array|max:5',
            'slide_images.*'         => 'image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'logo_ig'                => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'link_ig'                => 'nullable|string|max:255',
            'display_option'         => 'required|in:keep,previous,manual',
            'previous_display_id'    => 'nullable|exists:presences,id',
        ]);

        Log::info('Validation passed for update');

        $presence = Presence::findOrFail($id);
        $presence->nama_kegiatan = $validated['nama_kegiatan'];
        $presence->slug = Str::slug($validated['nama_kegiatan']);
        $presence->tgl_kegiatan = $validated['tgl_kegiatan'] . ' ' . $validated['waktu_mulai'];
        $presence->lokasi = $validated['lokasi'];
        $presence->link_lokasi = $validated['link_lokasi'] ?? null;
        $presence->batas_waktu = $validated['batas_waktu'] ?? null;
        $presence->is_active = $request->has('is_active');
        $presence->judul_header = $validated['judul_header'] ?? null;
        $presence->display_option_type = $validated['display_option'];
        $presence->slide_option_type = $validated['slide_option'];

        // Handle display options for update
        $this->handleDisplayOptionsForUpdate($request, $presence, $validated);

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

        $presence->link_ig = $validated['link_ig']
            ? 'https://instagram.com/' . ltrim($validated['link_ig'], '@/')
            : null;

        $presence->save();
        Log::info('Presence updated with ID: ' . $presence->id);

        // Handle slide options for update
        $this->handleSlideOptionsForUpdate($request, $presence, $validated);

        return redirect()->route('presence.index')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function barcode(string $slug)
    {
        $presence = Presence::where('slug', $slug)->firstOrFail();
        $url = route('absen.index', $presence->slug);

        // Generate QR code as SVG to avoid GD library dependency issues
        $qrCode = QrCode::format('svg')->size(300)->generate($url);

        // Return the QR code as an SVG image response
        return response($qrCode)->header('Content-Type', 'image/svg+xml');
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

    // Private methods remain the same...
    private function handleSlideOptions(Request $request, Presence $presence, array $validated)
    {
        $slideOption = $validated['slide_option'];
        Log::info('Handling slide options for create:', ['option' => $slideOption]);

        switch ($slideOption) {
            case 'previous':
                if (!empty($validated['previous_presence_id'])) {
                    Log::info('Copying slides from presence ID: ' . $validated['previous_presence_id']);
                    $this->copySlides($validated['previous_presence_id'], $presence->id);
                }
                break;

            case 'new':
                if ($request->hasFile('slide_images')) {
                    $files = $request->file('slide_images');
                    Log::info('Uploading new slides:', ['count' => count($files)]);
                    $this->uploadNewSlides($files, $presence);
                } else {
                    Log::warning('No slide images found in request for new slide option');
                }
                break;

            case 'none':
                Log::info('No slides to handle - option is none');
                break;
        }
    }

    private function handleSlideOptionsForUpdate(Request $request, Presence $presence, array $validated)
    {
        $slideOption = $validated['slide_option'];
        Log::info('Handling slide options for update:', ['option' => $slideOption, 'presence_id' => $presence->id]);

        switch ($slideOption) {
            case 'keep':
                Log::info('Keeping existing slides');
                break;

            case 'previous':
                if (!empty($validated['previous_presence_id'])) {
                    Log::info('Replacing with slides from presence ID: ' . $validated['previous_presence_id']);
                    $this->deleteExistingSlides($presence);
                    $this->copySlides($validated['previous_presence_id'], $presence->id);
                }
                break;

            case 'new':
                if ($request->hasFile('slide_images')) {
                    $files = $request->file('slide_images');
                    Log::info('Replacing with new slides:', ['count' => count($files)]);
                    $this->deleteExistingSlides($presence);
                    $this->uploadNewSlides($files, $presence);
                } else {
                    Log::warning('No slide images found in request for new slide option');
                }
                break;

            case 'none':
                Log::info('Deleting all existing slides');
                $this->deleteExistingSlides($presence);
                break;
        }
    }

    private function copySlides($fromPresenceId, $toPresenceId)
    {
        Log::info('Copying slides:', ['from' => $fromPresenceId, 'to' => $toPresenceId]);
        
        $sourceSlides = PresenceSlide::where('presence_id', $fromPresenceId)->get();
        $copiedCount = 0;
        
        // Ensure slides directory exists
        $slideDir = public_path('uploads/slides');
        if (!file_exists($slideDir)) {
            mkdir($slideDir, 0755, true);
        }
        
        foreach ($sourceSlides as $sourceSlide) {
            try {
                $sourcePath = public_path('uploads/' . $sourceSlide->image_path);
                
                if (!file_exists($sourcePath)) {
                    Log::warning('Source slide file not found:', ['path' => $sourcePath]);
                    continue;
                }
                
                $extension = pathinfo($sourceSlide->image_path, PATHINFO_EXTENSION);
                $newFileName = 'slides/' . Str::random(40) . '.' . $extension;
                $destinationPath = public_path('uploads/' . $newFileName);
                
                if (copy($sourcePath, $destinationPath)) {
                    PresenceSlide::create([
                        'presence_id' => $toPresenceId,
                        'image_path' => $newFileName,
                    ]);
                    $copiedCount++;
                    
                    Log::info('Slide copied successfully:', [
                        'source' => $sourceSlide->image_path,
                        'destination' => $newFileName
                    ]);
                } else {
                    Log::error('Failed to copy slide file:', [
                        'source' => $sourcePath,
                        'destination' => $destinationPath
                    ]);
                }
                
            } catch (\Exception $e) {
                Log::error('Error copying slide:', [
                    'source_slide_id' => $sourceSlide->id,
                    'error' => $e->getMessage()
                ]);
            }
        }
        
        Log::info('Slide copying completed:', [
            'copied_count' => $copiedCount,
            'total_source_slides' => $sourceSlides->count()
        ]);
    }

    private function uploadNewSlides(array $files, Presence $presence)
    {
        Log::info('Starting slide upload for presence ID: ' . $presence->id);
        
        $uploadedCount = 0;
        $maxFiles = 5;
        
        // Ensure slides directory exists
        $slideDir = public_path('uploads/slides');
        if (!file_exists($slideDir)) {
            mkdir($slideDir, 0755, true);
            Log::info('Created slides directory: ' . $slideDir);
        }
        
        foreach (array_slice($files, 0, $maxFiles) as $index => $file) {
            try {
                Log::info('Processing slide file:', [
                    'index' => $index,
                    'original_name' => $file->getClientOriginalName(),
                    'size' => $file->getSize(),
                    'mime_type' => $file->getMimeType()
                ]);
                
                // Validate file
                $allowedMimes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
                if (!in_array($file->getMimeType(), $allowedMimes)) {
                    Log::warning('Invalid file type:', ['file' => $file->getClientOriginalName(), 'type' => $file->getMimeType()]);
                    continue;
                }
                
                if ($file->getSize() > 2 * 1024 * 1024) { // 2MB
                    Log::warning('File too large:', ['file' => $file->getClientOriginalName(), 'size' => $file->getSize()]);
                    continue;
                }
                
                // Store file
                $path = $file->store("slides", 'public_uploads');
                
                if ($path) {
                    // Create slide record
                    $slide = $presence->slides()->create(['image_path' => $path]);
                    $uploadedCount++;
                    
                    Log::info('Slide uploaded successfully:', [
                        'slide_id' => $slide->id,
                        'path' => $path,
                        'file_name' => $file->getClientOriginalName()
                    ]);
                } else {
                    Log::error('Failed to store slide file:', ['file' => $file->getClientOriginalName()]);
                }
                
            } catch (\Exception $e) {
                Log::error('Error uploading slide:', [
                    'file' => $file->getClientOriginalName(),
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
            }
        }
        
        Log::info('Slide upload completed:', [
            'presence_id' => $presence->id,
            'uploaded_count' => $uploadedCount,
            'total_files' => count($files)
        ]);
    }

    private function deleteExistingSlides(Presence $presence)
    {
        Log::info('Deleting existing slides for presence ID: ' . $presence->id);
        
        $deletedCount = 0;
        
        foreach ($presence->slides as $slide) {
            try {
                if ($slide->image_path) {
                    $filePath = public_path('uploads/' . $slide->image_path);
                    if (file_exists($filePath)) {
                        if (unlink($filePath)) {
                            Log::info('Slide file deleted:', ['path' => $filePath]);
                        } else {
                            Log::warning('Failed to delete slide file:', ['path' => $filePath]);
                        }
                    } else {
                        Log::warning('Slide file not found for deletion:', ['path' => $filePath]);
                    }
                }
                
                $slide->delete();
                $deletedCount++;
                
            } catch (\Exception $e) {
                Log::error('Error deleting slide:', [
                    'slide_id' => $slide->id,
                    'error' => $e->getMessage()
                ]);
            }
        }
        
        // Refresh the relationship
        $presence->load('slides');
        
        Log::info('Slide deletion completed:', [
            'presence_id' => $presence->id,
            'deleted_count' => $deletedCount
        ]);
    }

    private function handleDisplayOptions(Request $request, Presence $presence, array $validated)
    {
        $displayOption = $validated['display_option'];

        switch ($displayOption) {
            case 'previous':
                if (!empty($validated['previous_display_id'])) {
                    $this->copyDisplaySettings($validated['previous_display_id'], $presence);
                }
                break;

            case 'manual':
                // Set display settings dari form input
                $presence->judul_header_atas = $validated['judul_header_atas'] ?? null;
                $presence->judul_header_bawah = $validated['judul_header_bawah'] ?? null;
                break;
        }
    }

    private function handleDisplayOptionsForUpdate(Request $request, Presence $presence, array $validated)
    {
        $displayOption = $validated['display_option'];

        switch ($displayOption) {
            case 'keep':
                // Keep existing display settings, do nothing
                break;

            case 'previous':
                if (!empty($validated['previous_display_id'])) {
                    $this->copyDisplaySettings($validated['previous_display_id'], $presence);
                }
                break;

            case 'manual':
                // Set display settings dari form input
                $presence->judul_header_atas = $validated['judul_header_atas'] ?? null;
                $presence->judul_header_bawah = $validated['judul_header_bawah'] ?? null;
                break;
        }
    }

    private function copyDisplaySettings($fromPresenceId, Presence $toPresence)
    {
        $sourcePresence = Presence::findOrFail($fromPresenceId);
        
        // Copy text fields
        $toPresence->judul_header_atas = $sourcePresence->judul_header_atas;
        $toPresence->judul_header_bawah = $sourcePresence->judul_header_bawah;
        $toPresence->link_ig = $sourcePresence->link_ig;
        
        // Copy logo files
        foreach (['logo_kiri', 'logo_kanan', 'logo_ig'] as $logoField) {
            if ($sourcePresence->$logoField) {
                $sourcePath = public_path('uploads/' . $sourcePresence->$logoField);
                if (file_exists($sourcePath)) {
                    $extension = pathinfo($sourcePresence->$logoField, PATHINFO_EXTENSION);
                    $newFileName = $logoField . '/' . Str::random(40) . '.' . $extension;
                    $destinationPath = public_path('uploads/' . $newFileName);
                    
                    // Ensure logo directory exists
                    $logoDir = public_path('uploads/' . dirname($newFileName));
                    if (!file_exists($logoDir)) {
                        mkdir($logoDir, 0755, true);
                    }
                    
                    if (copy($sourcePath, $destinationPath)) {
                        $toPresence->$logoField = $newFileName;
                    }
                }
            }
        }
    }

    /**
     * Handle AJAX request for presence details with filtering
     */
    public function showData(string $id, Request $request)
    {
        if ($request->ajax()) {
            $query = PresenceDetail::where('presence_id', $id);

            // Apply filters
            if ($request->filled('unit')) {
                $query->where('unit', $request->unit);
                Log::info('AJAX - Filtering by unit: ' . $request->unit);
            }

            if ($request->filled('unit_dtl')) {
                $query->where('unit_dtl', $request->unit_dtl);
                Log::info('AJAX - Filtering by unit_dtl: ' . $request->unit_dtl);
            }

            Log::info('AJAX - Final query: ' . $query->toSql());
            Log::info('AJAX - Query bindings: ', $query->getBindings());

            return datatables()
                ->eloquent($query)
                ->addIndexColumn()
                ->editColumn('created_at', function ($data) {
                    return date('d-m-Y H:i:s', strtotime($data->created_at));
                })
                ->addColumn('signature', function ($data) {
                    return $data->signature
                        ? "<img width='100' src='" . asset('uploads/' . $data->signature) . "'>"
                        : '-';
                })
                ->addColumn('action', function ($data) {
                    return "<a href='" . route('presence-detail.destroy', $data->id) . "' class='btn btn-delete btn-danger btn-sm'>Hapus</a>";
                })
                ->rawColumns(['signature', 'action'])
                ->make(true);
        }

        return response()->json(['error' => 'Invalid request'], 400);
    }
}