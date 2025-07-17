<?php

namespace App\Http\Controllers;

use App\Models\PresenceDetail;
use App\Models\Presence;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;

class PresenceDetailController extends Controller
{
    public function exportPdf(string $id)
    {
        $presence = Presence::findOrFail($id);
        $presenceDetails = PresenceDetail::where('presence_id', $id)->get();

        // load view to pdf
        $pdf = Pdf::setOptions(['isRemoteEnabled' => true])
            ->loadView('pages.presence.detail.export-pdf', compact('presence', 'presenceDetails'))
            ->setPaper('a4', 'potrait');

        return $pdf->stream("{$presence->nama_kegiatan}.pdf", ['Attachment' => 0]);

        exit();

    }
 
    public function destroy($id)
    {
        $presenceDetail = PresenceDetail::findOrFail($id);

        if ($presenceDetail->tanda_tangan) {
            Storage::disk('public_uploads')->delete($presenceDetail->signature);
        }

        $presenceDetail->delete();

        return response()->json(['status' => 'success', 'message' => 'Data berhasil dihapus']);
    }

    public function exportExcel($id)
    {
        $presence = Presence::findOrFail($id);
        $presenceDetails = PresenceDetail::where('presence_id', $id)->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set Judul Dokumen
        $sheet->setCellValue('A1', 'FORMULIR DAFTAR HADIR RAPAT');
        $sheet->mergeCells('A1:F1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Info Kegiatan
        $sheet->setCellValue('A3', 'Nama Kegiatan');
        $sheet->setCellValue('B3', ': ' . $presence->nama_kegiatan);

        $sheet->setCellValue('A4', 'Hari / Tanggal');
        $tanggalIndo = Carbon::parse($presence->tgl_kegiatan)->translatedFormat('l, d F Y');
        $sheet->setCellValue('B4', ': ' . $tanggalIndo);

        $sheet->setCellValue('A5', 'Waktu Mulai');
        $sheet->setCellValue('B5', ': ' . date('H:i', strtotime($presence->tgl_kegiatan)) . ' WIB');

        $sheet->setCellValue('A6', 'Lokasi');
        $sheet->setCellValue('B6', ': ' . $presence->lokasi);

        // Header Tabel
        $header = ['NO', 'Waktu Absensi', 'NAMA / NIP', 'UNIT / Jabatan', 'EMAIL / NO. HP', 'TANDA TANGAN'];
        $sheet->fromArray($header, null, 'A8');

        $sheet->getStyle('A8:F8')->getFont()->setBold(true);
        $sheet->getStyle('A8:F8')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A8:F8')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        // Data Peserta
        $row = 9;
        foreach ($presenceDetails as $index => $detail) {
            $sheet->setCellValue("A{$row}", $index + 1);
            $sheet->setCellValue("B{$row}", Carbon::parse($detail->created_at)->format('d/m/Y H:i'));
            $sheet->setCellValue("C{$row}", $detail->nama . ' / ' . ($detail->nip ?? '-'));
            $sheet->setCellValue("D{$row}", $detail->unit . ' / ' . ($detail->jabatan ?? '-'));
            $sheet->setCellValue("E{$row}", ($detail->email ?? '-') . ' / ' . $detail->no_hp);

            if ($detail->signature && file_exists(public_path('uploads/' . $detail->signature))) {
                $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                $drawing->setPath(public_path('uploads/' . $detail->signature));
                $drawing->setHeight(40);
                $drawing->setCoordinates("F{$row}");
                $drawing->setWorksheet($sheet);
            }

            // Border
            $sheet->getStyle("A{$row}:F{$row}")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            $sheet->getStyle("A{$row}:F{$row}")->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

            $row++;
        }

        // Auto Width
        foreach (range('A', 'F') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // File Export
        $filename = 'Daftar-Hadir-' . now()->format('Ymd_His') . '.xlsx';
        $writer = new Xlsx($spreadsheet);

        // Output ke browser
        $tempFile = tempnam(sys_get_temp_dir(), $filename);
        $writer->save($tempFile);

        return response()->download($tempFile, $filename)->deleteFileAfterSend(true);
    }
}
