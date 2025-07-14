<?php

namespace App\Http\Controllers;

use App\DataTables\PlnMemberDataTable;
use App\Models\PlnMember;
use Illuminate\Http\Request;

class PlnMemberController extends Controller
{
    public function index(PlnMemberDataTable $dataTable)
    {
        return $dataTable->render('pln_members.index');
    }

    public function create()
    {
        return view('pln_members.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nip' => 'required|unique:pln_members',
            'email' => 'required|email|unique:pln_members',
            'jabatan' => 'required',
            'no_hp' => 'required',
        ]);

        PlnMember::create($request->all());

        return redirect()->route('pln-members.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $plnMember = PlnMember::findOrFail($id);
        return view('pln_members.edit', compact('plnMember'));
    }

    public function update(Request $request, $id)
    {
        $plnMember = PlnMember::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'nip' => 'required|unique:pln_members,nip,'.$id,
            'email' => 'required|email|unique:pln_members,email,'.$id,
            'jabatan' => 'required',
            'no_hp' => 'required',
        ]);

        $plnMember->update($request->all());

        return redirect()->route('pln-members.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        PlnMember::destroy($id);

        return response()->json(['status' => 'success', 'message' => 'Data berhasil dihapus']);
    }
}
