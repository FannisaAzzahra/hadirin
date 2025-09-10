<?php

namespace App\Http\Controllers;

use App\DataTables\AbsenDataTable;
use App\Models\Presence;
use App\Models\PresenceDetail;
use App\Models\Company;
use App\Models\CompanyUnit;
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

        // Get data untuk dropdown
        $plnMembers = PlnMember::all();
        $companies = Company::getCompaniesWithUnits(); // Get companies with their units

        return $dataTable->render('pages.absen.index', compact('presence', 'plnMembers', 'companies'));
    }

        public function save(Request $request, string $id)
    {
        $existingPresence = \App\Models\PresenceDetail::where('presence_id', $id)
            ->where('email', $request->email)
            ->first();

        if ($existingPresence) {
            return redirect()->back()->with('error', 'Anda sudah melakukan absensi dengan email ini.');
        }

        $presence = Presence::findOrFail($id);

        // Basic validation rules
        $rules = [
            'nama'      => 'required|string',
            'nip'       => 'nullable|string',
            'email'     => 'required|email',
            'jabatan'   => 'required|string',
            'unit'      => 'required|exists:companies,name', // Validate against companies table
            'no_hp'     => 'required|string',
            'signature' => 'required',
        ];

        // Get the selected company
        $selectedCompany = Company::where('name', $request->unit)->first();
        
        if (!$selectedCompany) {
            return redirect()->back()->withErrors(['unit' => 'Perusahaan tidak valid.']);
        }

        // Dynamic validation for unit_dtl based on selected company
        if ($selectedCompany->activeUnits()->count() > 0) {
            // If company has predefined units, validate against them
            $validUnits = $selectedCompany->activeUnits()->pluck('name')->toArray();
            $rules['unit_dtl'] = 'required|in:' . implode(',', $validUnits);
        } else {
            // If no predefined units, allow free text input
            $rules['unit_dtl'] = 'required|string';
        }

        $request->validate($rules);

        // Create presence detail
        $presenceDetail = new PresenceDetail();
        $presenceDetail->presence_id = $presence->id;
        $presenceDetail->nama = $request->nama;
        $presenceDetail->unit = $request->unit;
        $presenceDetail->unit_dtl = $request->unit_dtl;
        $presenceDetail->no_hp = $request->no_hp;

        // Set optional fields
        $presenceDetail->nip = $request->nip;
        $presenceDetail->email = $request->email;
        $presenceDetail->jabatan = $request->jabatan;

        // Process signature
        $base64_image = $request->signature;
        @list($type, $file_data) = explode(';', $base64_image);
        @list(, $file_data) = explode(',', $file_data);

        // Generate unique filename
        $uniqChar = date('YmdHis').uniqid();
        $signature = "tanda-tangan/{$uniqChar}.png";

        // Save signature to storage
        Storage::disk('public_uploads')->put($signature, base64_decode($file_data));

        $presenceDetail->signature = $signature;
        $presenceDetail->save();

        return redirect()->back()->with('success', 'Absensi berhasil disimpan!');
    }

    /**
     * API endpoint untuk mendapatkan units berdasarkan company (untuk AJAX)
     */
    public function getUnitsByCompany(Request $request)
    {
        $companyName = $request->company_name;
        $company = Company::where('name', $companyName)->first();
        
        if (!$company) {
            return response()->json([]);
        }

        $units = $company->activeUnits;
        
        return response()->json($units);
    }
}
