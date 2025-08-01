<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::with('units')->ordered()->get();
        return view('admin.companies.index', compact('companies'));
    }

    public function create()
    {
        return view('admin.companies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:companies',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        Company::create($request->all());

        return redirect()->route('companies.index')->with('success', 'Perusahaan berhasil ditambahkan!');
    }

    public function show(Company $company)
    {
        $company->load('units');
        return view('admin.companies.show', compact('company'));
    }

    public function edit(Company $company)
    {
        return view('admin.companies.edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('companies')->ignore($company->id)
            ],
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        $company->update($request->all());

        return redirect()->route('companies.index')->with('success', 'Perusahaan berhasil diperbarui!');
    }

    public function destroy(Company $company)
    {
        try {
            $company->delete();
            return redirect()->route('companies.index')->with('success', 'Perusahaan berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('companies.index')->with('error', 'Gagal menghapus perusahaan. Pastikan tidak ada unit yang terkait.');
        }
    }

    /**
     * Toggle status aktif/nonaktif
     */
    public function toggleStatus(Company $company)
    {
        $company->update(['is_active' => !$company->is_active]);
        
        $status = $company->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->back()->with('success', "Perusahaan berhasil {$status}!");
    }

    /**
     * API endpoint untuk mendapatkan companies dengan units (untuk AJAX)
     */
    public function getCompaniesWithUnits()
    {
        $companies = Company::getCompaniesWithUnits();
        return response()->json($companies);
    }
}