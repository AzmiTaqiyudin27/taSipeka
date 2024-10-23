<?php

namespace App\Http\Controllers;

use App\Models\AuditRutin;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Clegginabox\PDFMerger\PDFMerger;
use Illuminate\Database\Eloquent\Casts\Json;

class PDFController extends Controller
{
    public function generatePDF(Request $request)
    {

        $firstPagePath = storage_path('app/public/cover.pdf');
        $finalPdf = new PDFMerger();
        $finalPdf->addPDF($firstPagePath, 'all');
        $ids = $request->input('ids');
        if (empty($ids)) {
            return response()->json(['error' => 'Tidak ada data yang dipilih'], 400);
        }

        // Lanjutkan dengan proses penggabungan PDF menggunakan ID yang terpilih
        $urutan = 1;
        foreach ($ids as $id) {
            $audit = AuditRutin::find($id);
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
            $nextPagePath = storage_path('app/public/temp_next_page.pdf');
            $pdf->save($nextPagePath);

            $finalPdf->addPDF($nextPagePath, 'all');
            $lampiran = json_decode($audit->lampiran);
            foreach ($lampiran as $key => $value) {
                $finalPdf->addPDF("dokumen/$value", 'all');
            }
            $urutan++;
        }
        // Ambil halaman cover

        // Gabungkan halaman pertama dengan CV yang sudah diupload
        // $finalPdf->addPDF($secondPagePath, 'all');

        // Simpan file PDF hasil gabungan
        $outputPath = storage_path('app/public/combined.pdf');
        $finalPdf->merge('file', $outputPath);

        // Kembalikan PDF hasil gabungan sebagai response download
        return response()->download($outputPath);
    }
}
