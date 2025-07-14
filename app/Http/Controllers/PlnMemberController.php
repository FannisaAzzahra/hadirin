<?php

namespace App\Http\Controllers;

use App\Models\PlnMember;
use Illuminate\Http\Request;

class PlnMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = PlnMember::all();
        return view('pln_members.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pln_members.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    // validasi
    $validated = $request->validate([
        'nama' => 'required',
        'nip' => 'required',
        'email' => 'required|email',
        'jabatan' => 'required',
        'no_hp' => 'required',
    ]);

    // simpan
    PlnMember::create($validated);

    return redirect()->route('pln-members.index')->with('success', 'Berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PlnMember $plnMember)
    {
        return view('pln_members.edit', compact('plnMember'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PlnMember $plnMember)
    {
        $request->validate([
            'nama' => 'required|string',
            'nip' => 'nullable|string',
            'email' => 'nullable|email',
            'jabatan' => 'nullable|string',
            'no_hp' => 'nullable|string',
        ]);

        $plnMember->update($request->all());
        return redirect()->route('pln-members.index')->with('success', 'Anggota PLN diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PlnMember $plnMember)
    {
        $plnMember->delete();
        return back()->with('success', 'Anggota PLN dihapus.');
    }
}
