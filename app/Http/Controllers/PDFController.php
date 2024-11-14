<?php

namespace App\Http\Controllers;

use App\Models\AuditRutin;
use App\Models\AuditInsidental;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Clegginabox\PDFMerger\PDFMerger;
use setasign\Fpdi\TcpdfFpdi;
use setasign\Fpdi\PdfParser\PdfParserException;


class PDFController extends Controller
{

    public function generatePDF(Request $request)
    {
        $finalPdf = new PDFMerger();
        $ids = $request->input('ids');
        $coverPath = public_path('lampiran/cover.pdf');
       
      
        if (empty($ids)) {
            return response()->json(['error' => 'Tidak ada data yang dipilih'], 400);
        }
          $tempPdfDir = storage_path("app/public/temp_pdf");
    if (!is_dir($tempPdfDir)) {
        mkdir($tempPdfDir, 0777, true);
    }

        $introPdf = Pdf::loadView('intro_template', [
            // Add any data you need to pass to the intro view
            'title' => 'Introductory Page',
            'date' => now()->format('Y-m-d'),
        ]);
        $introPdf->setPaper('a4');
        $introPdfPath = "$tempPdfDir/intro_page.pdf";
        $introPdf->save($introPdfPath);
        $finalPdf->addPDF($introPdfPath, 'all');

        $urutan = 1;
        foreach ($ids as $id) {
            $audit = AuditRutin::find($id);

            if (!$audit) {
                return response()->json(['error' => "Data dengan ID $id tidak ditemukan"], 404);
            }

            // Pastikan direktori temp_pdf ada, jika belum, buat direktori tersebut
        $tempPdfDir = storage_path("app/public/temp_pdf");
        if (!is_dir($tempPdfDir)) {
            mkdir($tempPdfDir, 0777, true); // Buat direktori dengan izin penuh
        }

        $urutan = 1;
        foreach ($ids as $id) {
            $audit = AuditRutin::find($id);

            if (!$audit) {
                return response()->json(['error' => "Data dengan ID $id tidak ditemukan"], 404);
            }

            // Render halaman PDF dari view
            $pdf = Pdf::loadView('pdf_template', [
                'urutan' => $urutan,
                'tanggal' => $audit->tanggal_audit,
                'versi' => $audit->versi,
                'judul' => $audit->judul,
                'pendahuluan' => $audit->pendahuluan,
                'cakupanAudit' => $audit->cakupan_audit,
                'tujuanAudit' => $audit->tujuan_audit,
                'metodologiAudit' => $audit->metodologi_audit,
                'hasilAudit' => $audit->hasil_audit,
                'rekomendasi' => $audit->rekomendasi,
                'kesimpulanAudit' => $audit->kesimpulan_audit,
            ]);
            $pdf->setPaper('a4');

            // Simpan PDF sementara di storage
            $pdfPath = "$tempPdfDir/audit_{$id}_page.pdf";
            $pdf->save($pdfPath);

            // Tambahkan halaman PDF ke final PDF
            $finalPdf->addPDF($pdfPath, 'all');

            // Tambahkan setiap lampiran ke dalam final PDF jika ada
            $lampiran = json_decode($audit->lampiran);
            if (!empty($lampiran)) {
                foreach ($lampiran as $value) {
                    
                    // $lampiranPath = storage_path("app/public/lampiran/$value");
                    $lampiranPath = public_path("lampiran/$value");
                    // dd($lampiranPath);
                    // dd(file_exists($lampiranPath));
                    if (file_exists($lampiranPath)) {
                        $finalPdf->addPDF($lampiranPath, 'all');
                    }
                }
            }

            $urutan++;
        }

        // Ambil tanggal saat ini dalam format yang diinginkan (misalnya: Y-m-d)
$tanggal = date('Y-m-d');

// Gabungkan tanggal ke dalam nama output file
$outputPath = storage_path("app/public/Hasil-Audit-Rutin-$tanggal.pdf");
        $finalPdf->merge('file', $outputPath);

        // Kembalikan PDF hasil gabungan sebagai response download
        return response()->download($outputPath)->deleteFileAfterSend(true);
    }
}
    public function generatePDFInsidental(Request $request)
    {
        $finalPdf = new PDFMerger();
        $ids = $request->input('ids');

        if (empty($ids)) {
            return response()->json(['error' => 'Tidak ada data yang dipilih'], 400);
        }

        $urutan = 1;
        foreach ($ids as $id) {
            $audit = AuditInsidental::find($id);

            if (!$audit) {
                return response()->json(['error' => "Data dengan ID $id tidak ditemukan"], 404);
            }

            // Pastikan direktori temp_pdf ada, jika belum, buat direktori tersebut
        $tempPdfDir = storage_path("app/public/temp_pdf");
        if (!is_dir($tempPdfDir)) {
            mkdir($tempPdfDir, 0777, true); // Buat direktori dengan izin penuh
        }
        $introPdf = Pdf::loadView('intro_template', [
            // Add any data you need to pass to the intro view
            'title' => 'Introductory Page',
            'date' => now()->format('Y-m-d'),
        ]);
        $introPdf->setPaper('a4');
        $introPdfPath = "$tempPdfDir/intro_page.pdf";
        $introPdf->save($introPdfPath);
        $finalPdf->addPDF($introPdfPath, 'all');


        $urutan = 1;
        foreach ($ids as $id) {
            $audit = AuditInsidental::find($id);

            if (!$audit) {
                return response()->json(['error' => "Data dengan ID $id tidak ditemukan"], 404);
            }

            // Render halaman PDF dari view
            $pdf = Pdf::loadView('pdf_template', [
                'urutan' => $urutan,
                'tanggal' => $audit->tanggal_audit,
                'versi' => $audit->versi,
                'judul' => $audit->judul,
                'pendahuluan' => $audit->pendahuluan,
                'cakupanAudit' => $audit->cakupan_audit,
                'tujuanAudit' => $audit->tujuan_audit,
                'metodologiAudit' => $audit->metodologi_audit,
                'hasilAudit' => $audit->hasil_audit,
                'rekomendasi' => $audit->rekomendasi,
                'kesimpulanAudit' => $audit->kesimpulan_audit,
            ]);
            $pdf->setPaper('a4');

            // Simpan PDF sementara di storage
            $pdfPath = "$tempPdfDir/audit_{$id}_page.pdf";
            $pdf->save($pdfPath);

            // Tambahkan halaman PDF ke final PDF
            $finalPdf->addPDF($pdfPath, 'all');

            // Tambahkan setiap lampiran ke dalam final PDF jika ada
            $lampiran = json_decode($audit->lampiran);
            if (!empty($lampiran)) {
                foreach ($lampiran as $value) {
                    
                    // $lampiranPath = storage_path("app/public/lampiran/$value");
                    $lampiranPath = public_path("lampiran/$value");
                    // dd($lampiranPath);
                    // dd(file_exists($lampiranPath));
                    if (file_exists($lampiranPath)) {
                        $finalPdf->addPDF($lampiranPath, 'all');
                    }
                }
            }

            $urutan++;
        }

        // Ambil tanggal saat ini dalam format yang diinginkan (misalnya: Y-m-d)
$tanggal = date('Y-m-d');

// Gabungkan tanggal ke dalam nama output file
$outputPath = storage_path("app/public/Hasil-Audit-Insidental-$tanggal.pdf");
        $finalPdf->merge('file', $outputPath);

        // Kembalikan PDF hasil gabungan sebagai response download
        return response()->download($outputPath)->deleteFileAfterSend(true);
    }
}
}