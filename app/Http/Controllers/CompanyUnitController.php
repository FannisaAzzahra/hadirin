<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyUnit;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CompanyUnitController extends Controller
{
    public function index()
    {
        $units = CompanyUnit::with('company')->ordered()->get();
        return view('admin.company-units.index', compact('units'));
    }

    public function create()
    {
        $companies = Company::active()->ordered()->get();
        return view('admin.company-units.create', compact('companies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_id' => 'required|exists:companies,id',
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('company_units')->where('company_id', $request->company_id)
            ],
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        CompanyUnit::create($request->all());

        return redirect()->route('company-units.index')->with('success', 'Unit berhasil ditambahkan!');
    }

    public function show(CompanyUnit $companyUnit)
    {
        $companyUnit->load('company');
        return view('admin.company-units.show', compact('companyUnit'));
    }

    public function edit(CompanyUnit $companyUnit)
    {
        $companies = Company::active()->ordered()->get();
        return view('admin.company-units.edit', compact('companyUnit', 'companies'));
    }

    public function update(Request $request, CompanyUnit $companyUnit)
    {
        $request->validate([
            'company_id' => 'required|exists:companies,id',
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('company_units')
                    ->where('company_id', $request->company_id)
                    ->ignore($companyUnit->id)
            ],
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        $companyUnit->update($request->all());

        return redirect()->route('company-units.index')->with('success', 'Unit berhasil diperbarui!');
    }

    public function destroy(CompanyUnit $companyUnit)
    {
        $companyUnit->delete();
        return redirect()->route('company-units.index')->with('success', 'Unit berhasil dihapus!');
    }

    /**
     * Toggle status aktif/nonaktif
     */
    public function toggleStatus(CompanyUnit $companyUnit)
    {
        $companyUnit->update(['is_active' => !$companyUnit->is_active]);
        
        $status = $companyUnit->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->back()->with('success', "Unit berhasil {$status}!");
    }

    /**
     * API endpoint untuk mendapatkan units berdasarkan company (untuk AJAX)
     */
    public function getUnitsByCompany(Request $request)
    {
        $units = CompanyUnit::getUnitsByCompany($request->company_id);
        return response()->json($units);
    }
}