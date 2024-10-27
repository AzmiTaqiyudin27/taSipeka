<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\KodeAudit;
use App\Models\AuditRutin;
use Illuminate\Http\Request;
use App\Http\Controllers\Carbon;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AuditRutinPelaporanController extends Controller
{
    public function index()
    {
        $laporan = AuditRutin::with('kodeAudit')->get();
        $role = auth()->user()->role;
        if ($role == 'admin') {
            $view = 'admin.pelaporanrutin.pelaporanRutin';
        } else {
            $view = 'timkeamananaudit.pelaporanrutin.pelaporanRutin';
        }
        return view($view, [
            'laporan' => $laporan
        ]);
    }

    public function show()
    {
        $kodeAudit = KodeAudit::all();
        // $auditProses = AuditRutin::where("kode_audit", $kode)->where("status", "proses")->get();
        $auditDiedit = AuditRutin::where("status", "diedit")->get();
        $unitkerja = User::where('role', 'unitkerja')->get();
        $role = auth()->user()->role;

        if ($role == 'admin') {
            $view = 'admin.pelaporanrutin.tambah_pelaporanRutin';
        } else if ($role == 'pimpinan') {
            $view = 'pimpinan.pelaporanrutin.tambah_pelaporanRutin';
        } else {
            $view = 'timkeamananaudit.pelaporanrutin.tambah_pelaporanRutin';
        }

        $id = Auth::id();

        return view($view, [

            "auditDiedit" => $auditDiedit,
            "kodeaudit" => $kodeAudit,
            "userid" => $id,
            "unitkerja" => $unitkerja
        ]);
    }

    public function store(Request $request)
    {
        // Validasi data

        $validatedData = $request->validate([
            'user_id' => 'required|int',
            'unitkerja_id' => 'int',
            'judul' => '',
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date',
            'kode_audit' => '',
            'versi' => '',
            'pendahuluan' => '',
            'cakupan_audit' => '',
            'tujuan_audit' => '',
            'metodologi_audit' => '',
            'hasil_audit' => '',
            'rekomendasi' => '',
            'kesimpulan_audit' => '',
            'status' => '',
            'lampiran' => '',
            'tanggal_proses' => '',
        ]);

        // Buat instance baru dari model AuditRutin
        $auditRutin = new AuditRutin();
        //new AuditRutin 
        $auditRutin->user_id = $validatedData['user_id'];
        $auditRutin->unitkerja_id = $validatedData['unitkerja_id'];
        $auditRutin->judul = $validatedData['judul'];
        $auditRutin->tanggal_awal = $validatedData['tanggal_awal'];
        $auditRutin->tanggal_akhir = $validatedData['tanggal_akhir'];
        $auditRutin->kode_audit = $validatedData['kode_audit'];
        $auditRutin->versi = $validatedData['versi'];
        $auditRutin->pendahuluan = $validatedData['pendahuluan'];
        $auditRutin->cakupan_audit = $validatedData['cakupan_audit'];
        $auditRutin->tujuan_audit = $validatedData['tujuan_audit'];
        $auditRutin->metodologi_audit = $validatedData['metodologi_audit'];
        $auditRutin->hasil_audit = $validatedData['hasil_audit'];
        $auditRutin->rekomendasi = $validatedData['rekomendasi'];
        $auditRutin->kesimpulan_audit = $validatedData['kesimpulan_audit'];
        $auditRutin->status ="draft";
        // $auditRutin->tanggal_proses = $validatedData['tanggal_proses'];

        // Array untuk menyimpan nama file yang di-upload
        $files = [];
        $totalSize = 0;

        // Cek apakah ada file yang diunggah
        if ($request->hasFile('lampiran')) {
            // Hitung total ukuran file
            foreach ($request->file('lampiran') as $file) {
                $totalSize += $file->getSize();
            }

            // Batas total ukuran file adalah 5MB
            $maxSize = 5 * 1024 * 1024;

            // Jika total ukuran melebihi 5MB, kembalikan dengan error
            if ($totalSize > $maxSize) {
                return back()->withErrors(['lampiran' => 'Total ukuran semua file tidak boleh melebihi 5 MB.']);
            }

            // Jika file sesuai dengan aturan, simpan setiap file di direktori yang diinginkan
            foreach ($request->file('lampiran') as $file) {
                if ($file->isValid()) {
                    $lampiran = $file->getClientOriginalName();
                    // $lampiran = time() . '-' . $file->getClientOriginalName(); // Buat nama unik dengan timestamp
                    $file->move(public_path('lampiran'), $lampiran); // Pindahkan file ke folder publik
                    $files[] = $lampiran; // Tambahkan nama file ke array
                }
            }

            // Simpan file dalam format array (misalnya JSON)
            $auditRutin['lampiran'] = json_encode($files); // Simpan sebagai JSON dalam kolom dokumen
        }
        // Simpan ke dalam database
        $auditRutin->save();

        return redirect()->back()->with('message', 'Berhasil Menambah Laporan Audit!');
    }

    public function proses(Request $request, $id)
    {
        // Validasi data

        $validatedData = $request->validate([
            'user_id' => 'required|int',
            'unitkerja_id' => 'int',
            'judul' => '',
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date',
            'kode_audit' => '',
            'versi' => '',
            'pendahuluan' => '',
            'cakupan_audit' => '',
            'tujuan_audit' => '',
            'metodologi_audit' => '',
            'hasil_audit' => '',
            'rekomendasi' => '',
            'kesimpulan_audit' => '',
            'status' => '',
            'lampiran' => '',
            'tanggal_proses' => '',
        ]);

        // Buat instance baru dari model AuditRutin
if($id)
        $auditRutin = AuditRutin::findOrFail($id);
else
        $auditRutin = new AuditRutin();
        //new AuditRutin 
        $auditRutin->user_id = $validatedData['user_id'];
        $auditRutin->unitkerja_id = $validatedData['unitkerja_id'];
        $auditRutin->judul = $validatedData['judul'];
        $auditRutin->tanggal_awal = $validatedData['tanggal_awal'];
        $auditRutin->tanggal_akhir = $validatedData['tanggal_akhir'];
        $auditRutin->kode_audit = $validatedData['kode_audit'];
        $auditRutin->versi = $validatedData['versi'];
        $auditRutin->pendahuluan = $validatedData['pendahuluan'];
        $auditRutin->cakupan_audit = $validatedData['cakupan_audit'];
        $auditRutin->tujuan_audit = $validatedData['tujuan_audit'];
        $auditRutin->metodologi_audit = $validatedData['metodologi_audit'];
        $auditRutin->hasil_audit = $validatedData['hasil_audit'];
        $auditRutin->rekomendasi = $validatedData['rekomendasi'];
        $auditRutin->kesimpulan_audit = $validatedData['kesimpulan_audit'];
        $auditRutin->status = "proses";
        // Mengisi tanggal_proses dengan tanggal saat ini tanpa waktu
        $auditRutin->tanggal_proses = date('Y-m-d'); // Format YYYY-MM-DD

        // Array untuk menyimpan nama file yang di-upload
        $files = [];
        $totalSize = 0;

        // Cek apakah ada file yang diunggah
        if ($request->hasFile('lampiran')) {
            // Hitung total ukuran file
            foreach ($request->file('lampiran') as $file) {
                $totalSize += $file->getSize();
            }

            // Batas total ukuran file adalah 5MB
            $maxSize = 5 * 1024 * 1024;

            // Jika total ukuran melebihi 5MB, kembalikan dengan error
            if ($totalSize > $maxSize) {
                return back()->withErrors(['lampiran' => 'Total ukuran semua file tidak boleh melebihi 5 MB.']);
            }

            // Jika file sesuai dengan aturan, simpan setiap file di direktori yang diinginkan
            foreach ($request->file('lampiran') as $file) {
                if ($file->isValid()) {
                    $lampiran = $file->getClientOriginalName();
                    // $lampiran = time() . '-' . $file->getClientOriginalName(); // Buat nama unik dengan timestamp
                    $file->move(public_path('lampiran'), $lampiran); // Pindahkan file ke folder publik
                    $files[] = $lampiran; // Tambahkan nama file ke array
                }
            }

            // Simpan file dalam format array (misalnya JSON)
            $auditRutin['lampiran'] = json_encode($files); // Simpan sebagai JSON dalam kolom dokumen
        }
        // Simpan ke dalam database
        $auditRutin->save();

        return redirect()->back()->with('message', 'Berhasil Menambah Laporan Audit!');
    }
    public function prosess(Request $request)
    {
        // Validasi data

        $validatedData = $request->validate([
            'user_id' => 'required|int',
            'unitkerja_id' => 'int',
            'judul' => '',
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date',
            'kode_audit' => '',
            'versi' => '',
            'pendahuluan' => '',
            'cakupan_audit' => '',
            'tujuan_audit' => '',
            'metodologi_audit' => '',
            'hasil_audit' => '',
            'rekomendasi' => '',
            'kesimpulan_audit' => '',
            'status' => '',
            'lampiran' => '',
            'tanggal_proses' => '',
        ]);

        $auditRutin = new AuditRutin();
        //new AuditRutin 
        $auditRutin->user_id = $validatedData['user_id'];
        $auditRutin->unitkerja_id = $validatedData['unitkerja_id'];
        $auditRutin->judul = $validatedData['judul'];
        $auditRutin->tanggal_awal = $validatedData['tanggal_awal'];
        $auditRutin->tanggal_akhir = $validatedData['tanggal_akhir'];
        $auditRutin->kode_audit = $validatedData['kode_audit'];
        $auditRutin->versi = $validatedData['versi'];
        $auditRutin->pendahuluan = $validatedData['pendahuluan'];
        $auditRutin->cakupan_audit = $validatedData['cakupan_audit'];
        $auditRutin->tujuan_audit = $validatedData['tujuan_audit'];
        $auditRutin->metodologi_audit = $validatedData['metodologi_audit'];
        $auditRutin->hasil_audit = $validatedData['hasil_audit'];
        $auditRutin->rekomendasi = $validatedData['rekomendasi'];
        $auditRutin->kesimpulan_audit = $validatedData['kesimpulan_audit'];
        $auditRutin->status = "proses";
        // Mengisi tanggal_proses dengan tanggal saat ini tanpa waktu
        $auditRutin->tanggal_proses = date('Y-m-d'); // Format YYYY-MM-DD

        // Array untuk menyimpan nama file yang di-upload
        $files = [];
        $totalSize = 0;

        // Cek apakah ada file yang diunggah
        if ($request->hasFile('lampiran')) {
            // Hitung total ukuran file
            foreach ($request->file('lampiran') as $file) {
                $totalSize += $file->getSize();
            }

            // Batas total ukuran file adalah 5MB
            $maxSize = 5 * 1024 * 1024;

            // Jika total ukuran melebihi 5MB, kembalikan dengan error
            if ($totalSize > $maxSize) {
                return back()->withErrors(['lampiran' => 'Total ukuran semua file tidak boleh melebihi 5 MB.']);
            }

            // Jika file sesuai dengan aturan, simpan setiap file di direktori yang diinginkan
            foreach ($request->file('lampiran') as $file) {
                if ($file->isValid()) {
                    $lampiran = $file->getClientOriginalName();
                    // $lampiran = time() . '-' . $file->getClientOriginalName(); // Buat nama unik dengan timestamp
                    $file->move(public_path('lampiran'), $lampiran); // Pindahkan file ke folder publik
                    $files[] = $lampiran; // Tambahkan nama file ke array
                }
            }

            // Simpan file dalam format array (misalnya JSON)
            $auditRutin['lampiran'] = json_encode($files); // Simpan sebagai JSON dalam kolom dokumen
        }
        // Simpan ke dalam database
        $auditRutin->save();

        return redirect()->back()->with('message', 'Berhasil Menambah Laporan Audit!');
    }

    public function edit($id)
    {
        $auditRutin = AuditRutin::find($id);
        $kodeAudit = KodeAudit::where('kode_audit', $auditRutin->kode_audit)->get();
        // $auditProses = AuditRutin::where("kode_audit", $kode)->where("status", "proses")->get();
        $auditDiedit = AuditRutin::where("status", "diedit")->get();
        $unitkerja = User::where('id', $auditRutin->unitkerja_id)->get();
        $role = auth()->user()->role;

        return view('TimKeamananAudit.pelaporanrutin.edit_pelaporanRutin', [
            'auditRutin' => $auditRutin,
            // "auditDiedit" => $auditDiedit,
            "kodeAudit" => $kodeAudit,
            "userid" => $id,
            "unitKerja" => $unitkerja
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validasi data

        $validatedData = $request->validate([
            'user_id' => 'required|int',
            'unitkerja_id' => 'required|int',
            'judul' => '',
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date',
            'kode_audit' => '',
            'versi' => '',
            'pendahuluan' => '',
            'cakupan_audit' => '',
            'tujuan_audit' => '',
            'metodologi_audit' => '',
            'hasil_audit' => '',
            'rekomendasi' => '',
            'kesimpulan_audit' => '',
            'status' => '',
            'lampiran' => '',
            'tanggal_proses' => '',
        ]);

        // Cari instance dari model AuditRutin berdasarkan ID
        $auditRutin = AuditRutin::findOrFail($id);
        $auditRutin->user_id = $validatedData['user_id'];
        $auditRutin->unitkerja_id = $validatedData['unitkerja_id'];
        $auditRutin->judul = $validatedData['judul'];
        $auditRutin->tanggal_awal = $validatedData['tanggal_awal'];
        $auditRutin->tanggal_akhir = $validatedData['tanggal_akhir'];
        $auditRutin->kode_audit = $validatedData['kode_audit'];
        $auditRutin->versi = $validatedData['versi'];
        $auditRutin->pendahuluan = $validatedData['pendahuluan'];
        $auditRutin->cakupan_audit = $validatedData['cakupan_audit'];
        $auditRutin->tujuan_audit = $validatedData['tujuan_audit'];
        $auditRutin->metodologi_audit = $validatedData['metodologi_audit'];
        $auditRutin->hasil_audit = $validatedData['hasil_audit'];
        $auditRutin->rekomendasi = $validatedData['rekomendasi'];
        $auditRutin->kesimpulan_audit = $validatedData['kesimpulan_audit'];
        $auditRutin->status = $validatedData['status'];
        $auditRutin->tanggal_proses = $validatedData['tanggal_proses'];
        $auditRutin->status = "draft";

// Array untuk menyimpan nama file yang di-upload
$files = [];
$totalSize = 0;

// Cek apakah ada file yang diunggah
if ($request->hasFile('lampiran')) {
    // Hitung total ukuran file
    foreach ($request->file('lampiran') as $file) {
        $totalSize += $file->getSize();
    }

    // Batas total ukuran file adalah 5MB
    $maxSize = 5 * 1024 * 1024;

    // Jika total ukuran melebihi 5MB, kembalikan dengan error
    if ($totalSize > $maxSize) {
        return back()->withErrors(['lampiran' => 'Total ukuran semua file tidak boleh melebihi 5 MB.']);
    }

    // Jika file sesuai dengan aturan, simpan setiap file di direktori yang diinginkan
    foreach ($request->file('lampiran') as $file) {
        if ($file->isValid()) {
            $lampiran = $file->getClientOriginalName();
            // $lampiran = time() . '-' . $file->getClientOriginalName(); // Buat nama unik dengan timestamp
            $file->move(public_path('lampiran'), $lampiran); // Pindahkan file ke folder publik
            $files[] = $lampiran; // Tambahkan nama file ke array
        }
    }

    // Simpan file dalam format array (misalnya JSON)
    $auditRutin['lampiran'] = json_encode($files); // Simpan sebagai JSON dalam kolom dokumen
}
// Simpan ke dalam database
$auditRutin->save();

return redirect()->back()->with('message', 'Berhasil Menambah Laporan Audit!');
}


    public function destroy($id)
    {
        // Cari instance dari model AuditRutin berdasarkan ID
        $auditRutin = AuditRutin::findOrFail($id);

        // Hapus data dari database
        $auditRutin->delete();

        return redirect()->back()->with('message', 'Berhasil Menghapus Laporan Audit!');
    }

    //ajax
    public function getData($id)
    {

        $auditRutin = AuditRutin::with('unitKerja')->with('kodeaudit')->where("id", $id)->first();

        return response($auditRutin);
    }



    public function getAudit($id)
    {
        $auditRutin = AuditRutin::where('kode_audit', $id)->where('status', 'draft')->get();
        $auditProses = AuditRutin::where('kode_audit', $id)->where('status', 'proses')->latest()->first();
        $unitkerja = User::where('role', 'unitkerja')->get();
        $versi = AuditRutin::select('versi')
            ->where('kode_audit', $id)
            ->groupBy('versi')
            ->orderBy('versi', 'asc')
            ->get();
        return response()->json([
            'auditRutin' => $auditRutin,
            'auditProses' => $auditProses,
            'unitKerja' => $unitkerja,
            'versi' => $versi
        ]);
    }
}
