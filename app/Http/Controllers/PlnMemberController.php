<?php

namespace App\Http\Controllers;

use App\DataTables\PlnMemberDataTable;
use App\Models\PlnMember;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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

        return redirect()->route('pln-members.index')->with('success', 'Data berhasil dihapus');
    }

    public function show($id)
    {
        return redirect()->route('pln-members.index');
    }

    public function downloadTemplate()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Template Data Pegawai');

        // Header kolom
        $sheet->setCellValue('A1', 'Nama');
        $sheet->setCellValue('B1', 'NIP');
        $sheet->setCellValue('C1', 'Email');
        $sheet->setCellValue('D1', 'Jabatan');
        $sheet->setCellValue('E1', 'No HP');

        $writer = new Xlsx($spreadsheet);
        $filename = 'template_pegawai_pln.xlsx';

        // Set response
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$filename\"");
        $writer->save('php://output');
        exit;
    }

    public function importAjax(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        $file = $request->file('file');
        $spreadsheet = IOFactory::load($file->getRealPath());
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        $berhasil = 0;
        $gagal = 0;
        $errors = [];

        // Tambahkan untuk tracking duplikat dalam file
        $nipList = [];
        $emailList = [];

        for ($i = 1; $i < count($rows); $i++) {
            $row = $rows[$i];

            // Skip baris kosong
            if (empty(array_filter($row))) continue;

            // Cek duplikat NIP
            if (in_array($row[1], $nipList) || PlnMember::where('nip', $row[1])->exists()) {
                $errors[] = "Baris " . ($i + 1) . " gagal: NIP duplikat";
                $gagal++;
                continue;
            }

            // Cek duplikat Email
            if (in_array($row[2], $emailList) || PlnMember::where('email', $row[2])->exists()) {
                $errors[] = "Baris " . ($i + 1) . " gagal: Email duplikat";
                $gagal++;
                continue;
            }

            // Validasi struktur
            $validator = Validator::make([
                'nama' => $row[0],
                'nip' => $row[1],
                'email' => $row[2],
                'jabatan' => $row[3],
                'no_hp' => $row[4],
            ], [
                'nama' => 'required',
                'nip' => 'required',
                'email' => 'required|email',
                'jabatan' => 'required',
                'no_hp' => 'required',
            ]);

            if ($validator->fails()) {
                $gagal++;
                $errors[] = "Baris " . ($i + 1) . " gagal: " . implode(", ", $validator->errors()->all());
                continue;
            }

            // Insert ke database
            PlnMember::create([
                'nama' => $row[0],
                'nip' => $row[1],
                'email' => $row[2],
                'jabatan' => $row[3],
                'no_hp' => $row[4],
            ]);

            // Tambahkan ke list yang sudah dicek
            $nipList[] = $row[1];
            $emailList[] = $row[2];
            $berhasil++;
        }

        return response()->json([
            'message' => "Import selesai. Berhasil: $berhasil, Gagal: $gagal",
            'errors' => $errors
        ]);
    }

}
