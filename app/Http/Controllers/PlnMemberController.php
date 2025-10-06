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

    public function exportExcel()
    {
        $plnMembers = PlnMember::all();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set Header
        $sheet->setCellValue('A1', 'Nama');
        $sheet->setCellValue('B1', 'NIP');
        $sheet->setCellValue('C1', 'Email');
        $sheet->setCellValue('D1', 'Jabatan');
        $sheet->setCellValue('E1', 'No. HP');

        // Set Data
        $row = 2;
        foreach ($plnMembers as $member) {
            $sheet->setCellValue('A' . $row, $member->nama);
            $sheet->setCellValue('B' . $row, $member->nip);
            $sheet->setCellValue('C' . $row, $member->email);
            $sheet->setCellValue('D' . $row, $member->jabatan);
            $sheet->setCellValue('E' . $row, $member->no_hp);
            $row++;
        }

        // Auto size columns
        foreach (range('A', 'E') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'daftar-anggota-pln-' . date('d-m-Y') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
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

        // ** Tambahkan ini untuk format kolom NIP dan No HP sebagai teks **
        // Set format kolom B (NIP) ke teks
        $sheet->getStyle('B')->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);
        // Set format kolom E (No HP) ke teks
        $sheet->getStyle('E')->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);

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

            $nama = $row[0];
            // Pastikan NIP dan No HP dibaca sebagai string
            $nip = (string) $row[1]; 
            $email = $row[2];
            $jabatan = $row[3];
            $no_hp = (string) $row[4];

            // Cek duplikat NIP
            if (in_array($nip, $nipList) || PlnMember::where('nip', $nip)->exists()) {
                $errors[] = "Baris " . ($i + 1) . " gagal: NIP '{$nip}' duplikat.";
                $gagal++;
                continue;
            }

            // Cek duplikat Email
            if (in_array($email, $emailList) || PlnMember::where('email', $email)->exists()) {
                $errors[] = "Baris " . ($i + 1) . " gagal: Email '{$email}' duplikat.";
                $gagal++;
                continue;
            }

            // Validasi struktur
            $validator = Validator::make([
                'nama' => $nama,
                'nip' => $nip,
                'email' => $email,
                'jabatan' => $jabatan,
                'no_hp' => $no_hp,
            ], [
                'nama' => 'required',
                'nip' => 'required',
                'email' => 'required|email',
                'jabatan' => 'required',
                'no_hp' => 'required',
            ]);

            if ($validator->fails()) {
                $gagal++;
                $errors[] = "Baris " . ($i + 1) . " gagal. NIP: '{$nip}'. Kesalahan: " . implode(", ", $validator->errors()->all());
                continue;
            }

            // Insert ke database
            PlnMember::create([
                'nama' => $nama,
                'nip' => $nip,
                'email' => $email,
                'jabatan' => $jabatan,
                'no_hp' => $no_hp,
            ]);

            // Tambahkan ke list yang sudah dicek
            $nipList[] = $nip;
            $emailList[] = $email;
            $berhasil++;
        }

        // Perubahan di sini: Menggunakan logika if-else yang jelas
        if ($gagal > 0) {
            return response()->json([
                'success' => false,
                'message' => "Import selesai. Berhasil: $berhasil data, Gagal: $gagal data.",
                'errors' => $errors
            ]);
        } else {
            return response()->json([
                'success' => true,
                'message' => "Import selesai. Berhasil: $berhasil data, Gagal: $gagal data."
            ]);
        }
    }
}