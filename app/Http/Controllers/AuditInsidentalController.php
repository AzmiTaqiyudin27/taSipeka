<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\KodeAudit;
use App\Models\AuditRutin;
use App\Models\User;
use Database\Seeders\AuditInsidentalSeeder;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\AuditInsidental;
use Illuminate\Support\Facades\DB;
use App\Models\PengajuanInsidental;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class AuditInsidentalController extends Controller
{
    public function index(){
        $role = auth()->user()->role;

        if ($role == 'admin') {
            $view = 'admin.penerimaanpengajuaninsidental.admin_pengajuaninsidental';
    } else if ($role == 'pimpinan') {
        $view = 'pimpinan.pengajuan.pimpinan_insidental';
    } else if ($role == 'unitkerja') {
        $view = 'unitkerja.pengajuaninsidental.pengajuanInsidental';
    } else {
        $view = 'TimKeamananAudit.penerimaaninsidental.penerimaan_pengajuanInsidental';
    }
    //    $laporan = DB::table('kode_audits')
    // ->select('kode_audits.*', DB::raw('
    //     (SELECT count(*)
    //      FROM audit_insidentals
    //      WHERE kode_audits.kode_audit = audit_insidentals.kode_audit
    //     ) as audit_insidental_count
    // '))->get();
    // return view($view, [
    //     "laporan" => $laporan
    // ]);
$data = PengajuanInsidental::all();
$user = Auth::user();
        //  dd($data);
        return view($view, [
            'laporan' => $data,
            'user' => $user
        ]);
    }


    public function pelaporan(){
         $role = auth()->user()->role;
         if ($role == 'admin') {
        $view = 'admin.pelaporaninsidental.pelaporanInsidental';
    } else if ($role == 'pimpinan') {
        $view = 'pimpinan.auditinsidental.pimpinan_insidental';
    } else if ($role == 'unitkerja') {
        $view = 'unitkerja.audit.unitkerja_insidental';
    } else {
        $view = 'TimKeamananAudit.pelaporaninsidental.pelaporanInsidental';
    }

// Eksekusi query menggunakan Query Builder

        $user = auth()->user();

        $data = DB::table('audit_insidentals')
    ->join('kode_audits', 'audit_insidentals.kode_audit', '=', 'kode_audits.kode_audit')
    ->join('users', 'audit_insidentals.unitkerja_id', '=', 'users.id')
    ->select('audit_insidentals.*','audit_insidentals.judul' ,'kode_audits.kode_audit', 'kode_audits.nama_sistem', 'users.username as unitkerja' )->get();

    return view($view,[
            'laporan' => $data,
            'role' => $user
        ]);
    }

    public function showdetailinsidental($id)
    {
        // Mengambil data audit berdasarkan ID
        $audit = AuditInsidental::findOrFail($id);

        // Mengirimkan data audit sebagai response JSON
        return response()->json($audit);
    }

public function create()
{
    $data = AuditInsidental::all();
    $kodeAudit = KodeAudit::all();
    $unitkerja = User::where('role', 'unitkerja')->get();

    $role = auth()->user()->role;
    if ($role == 'admin') {
        $view = 'admin.pelaporaninsidental.tambah_pelaporanInsidental';
    }  else {
        $view = 'TimKeamananAudit.pelaporaninsidental.tambah_pelaporanInsidental';
    }

    return view($view, [
        'data' => $data,
        'kodeaudit' => $kodeAudit,
        'unitkerjas' => $unitkerja
    ]);
}
public function edit($id)
{
    $auditInsidental = AuditInsidental::find($id);
    $kodeAudit = KodeAudit::where('kode_audit', $auditInsidental->kode_audit)->get();
    // $auditProses = AuditRutin::where("kode_audit", $kode)->where("status", "proses")->get();
    $auditDiedit = AuditInsidental::where("status", "draft")->get();
    $unitkerja = User::where('id', $auditInsidental->unitkerja_id)->get();
    $role = auth()->user()->role;

    return view('TimKeamananAudit.pelaporaninsidental.edit_pelaporanInsidental', [
        'auditInsidental' => $auditInsidental,
        // "auditDiedit" => $auditDiedit,
        "kodeAudit" => $kodeAudit,
        "userid" => $id,
        "unitKerja" => $unitkerja
    ]);
}


    public function getAuditDetail(Request $request)
    {
        $audit = AuditRutin::where('pelaporan_rutin_id', $request->pelaporan_rutin_id)->first();

        return response()->json($audit);
    }

    public function getDataAudit(Request $request){
        $audit = AuditRutin::where('pelaporan_rutin_id', $request->pelaporan_rutin_id)->get();
        return response()->json($audit);
    }

    public function getSistem($id){
        $sistem = $sistem = AuditInsidental::with('kodeaudit')
    ->select('audit_insidentals.kode_audit')
    ->where('unitkerja_id', $id)
    ->groupBy('kode_audit')
    ->get();

        return response($sistem);
    }

    public function getData($kode){

        $audit = DB::table('audit_insidentals')
    ->join('kode_audits', 'audit_insidentals.kode_audit', '=', 'kode_audits.kode_audit')
    ->join('users as user_creator', 'audit_insidentals.user_id', '=', 'user_creator.id')
    ->join('users as unitkerja', 'audit_insidentals.unitkerja_id', '=', 'unitkerja.id')
    ->select('audit_insidentals.*', 'kode_audits.*', 'user_creator.username as creator_username', 'unitkerja.username as unitkerja_name')
    ->where('audit_insidentals.id', $kode)
    ->first();
        return response()->json($audit);
    }

    public function ambil($kode, $unitkerja){

        $audit = DB::table('audit_insidentals')
    ->join('kode_audits', 'audit_insidentals.kode_audit', '=', 'kode_audits.kode_audit')
    ->join('users as user_creator', 'audit_insidentals.user_id', '=', 'user_creator.id')
    ->join('users as unitkerja', 'audit_insidentals.unitkerja_id', '=', 'unitkerja.id')
    ->select('audit_insidentals.*', 'kode_audits.*', 'user_creator.username as creator_username', 'unitkerja.username as unitkerja_name')
    ->where('audit_insidentals.id', $kode)
    ->first();
        return response()->json($audit);
    }

public function proses(Request $request, $id)
{
   

    $auditInsidental = AuditInsidental::findOrFail($id);
    $auditInsidental->tanggal_proses = date('Y-m-d'); // Format YYYY-MM-DD
    $auditInsidental->status = "proses";
    $auditInsidental->save();
    return redirect()->back()->with('message', 'Berhasil Memproses Laporan Audit!');
}



    public function storeProses(Request $request)
{
    $user = auth()->user();

        $data = $request->validate([
            'pelaporan_rutin_id' => 'required',
            'tanggal_audit' => 'required|date',
            'nama_sistem' => 'required|string',
            'versi' => 'required|string',
            'bahasa_pemrograman' => 'required|string',
            'framework' => 'required|string',
            'maksimum_penyimpanan' => 'required|string',
            'maksimum_pengguna' => 'required|string',
            'keamanan_sistem' => 'required|string',
            'pengguna_sistem' => 'required|string',
        ]);


        $data['user_id'] = $user->id;

        // dd($data);

        AuditRutin::create($data);

    return redirect()->route('pelaporan-rutin.pelaporan')->with('suksessimpan', 'Data berhasil disimpan!');
}

    public function update(Request $request, $id)
    {
        // Validasi request jika diperlukan
       $validatedData = $request->validate([
          'user_id' => 'required|int',
            'unitkerja_id' => 'required|int',
            'judul' => '',
            'tanggal_audit' => 'required|date',
            'kode_audit' => '',
            'versi' => '',
            'pendahuluan' => '',
            'cakupan_audit' => '',
            'tujuan_audit' => '',
            'metodologi_audit' => '',
            'hasil_audit' => '',
            'rekomendasi' => '',
            'kesimpulan_audit' => '',
        
    ]);

        try {
            // Ambil data yang diupdate
            $data = [
                'judul' => $request->pendahuluan_edit,
                'pendahuluan' => $request->pendahuluan_edit,
                'cakupan_audit' => $request->cakupan_audit_edit,
                'tujuan_audit' => $request->tujuan_audit_edit,
                'metodologi_audit' => $request->metodologi_audit_edit,
                'hasil_audit' => $request->hasil_audit_edit,
                'rekomendasi' => $request->rekomendasi_edit,
                'kesimpulan_audit' => $request->kesimpulan_audit_edit,
                // Tambahkan atribut lain sesuai kebutuhan
            ];

            // Update data sesuai dengan ID
            AuditInsidental::where('id', $id)->update($data);

            // Jika berhasil, redirect atau kirim response sesuai kebutuhan aplikasi
            return redirect()->back()->with('message', 'Data berhasil diupdate');

        } catch (\Exception $e) {
            // Jika terjadi error, tangani sesuai kebutuhan aplikasi
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


      public function show($kode){
        $kodeAudit = KodeAudit::where("kode_audit", $kode)->first();
        $auditInsidental = AuditInsidental::where("kode_audit", $kode)->get();
        $role = auth()->user()->role;

        if ($role == 'admin') {
        $view = 'admin.pelaporanrutin.tambah_pelaporanRutin';
    } else if ($role == 'pimpinan') {
        $view = 'pimpinan.pelaporanrutin.tambahPelaporanInsidental';
    } else {
        $view = 'unitkerja.audit.tambahPelaporanInsidental';
    }

        $id = Auth::id();

        return view($view, [
            "auditInsidental" => $auditInsidental,
            "kodeaudit" => $kodeAudit,
            "userid" => $id
        ]);


    }
      public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'user_id' => 'required|int',
            'unitkerja_id' => 'required|int',
            'judul' => '',
            'tanggal_audit' => 'required|date',
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
            'lampiran' => ''
        ]);


        // Create a new AuditInsidental instance and save the data
        $pelaporanInsidental = new AuditInsidental();
        $pelaporanInsidental->unitkerja_id = $request->unitkerja_id;
        $pelaporanInsidental->user_id = $request->user_id;
        $pelaporanInsidental->judul = $request->judul;
        $pelaporanInsidental->tanggal_audit = $request->tanggal_audit;
        $pelaporanInsidental->kode_audit = $request->kode_audit;
        $pelaporanInsidental->versi = $request->versi;
        $pelaporanInsidental->pendahuluan = $request->pendahuluan;
        $pelaporanInsidental->cakupan_audit = $request->cakupan_audit;
        $pelaporanInsidental->tujuan_audit = $request->tujuan_audit;
        $pelaporanInsidental->metodologi_audit = $request->metodologi_audit;
        $pelaporanInsidental->hasil_audit = $request->hasil_audit;
        $pelaporanInsidental->rekomendasi = $request->rekomendasi;
        $pelaporanInsidental->kesimpulan_audit = $request->kesimpulan_audit;
        $pelaporanInsidental->status = $request->status;
        
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
            $pelaporanInsidental['lampiran'] = json_encode($files); // Simpan sebagai JSON dalam kolom dokumen

        $pelaporanInsidental->save();

        // Redirect to a desired route with a success message
        // return redirect()->back()->with('suksessimpan', 'Data Audit insidental berhasil ditambahkan');


        return redirect()->route('pelaporan-insidental.pelaporan')->with('suksessimpan', 'Data berhasil disimpan!');

    }
}

   public function perbarui(Request $request, $id)
{
    // Validasi data

    $validatedData = $request->validate([
          'user_id' => 'required|int',
            'unitkerja_id' => 'required|int',
            'judul' => '',
            'tanggal_audit' => 'required|date',
            'kode_audit' => '',
            'versi' => '',
            'pendahuluan' => '',
            'cakupan_audit' => '',
            'tujuan_audit' => '',
            'metodologi_audit' => '',
            'hasil_audit' => '',
            'rekomendasi' => '',
            'kesimpulan_audit' => '',
           
    ]);

    // Cari instance dari model AuditRutin berdasarkan ID
    $auditRutin = AuditInsidental::findOrFail($id);
    $auditRutin->user_id = $validatedData['user_id'];
        $auditRutin->unitkerja_id = $validatedData['unitkerja_id'];
        $auditRutin->judul = $validatedData['judul'];
        $auditRutin->tanggal_audit = $validatedData['tanggal_audit'];
        $auditRutin->kode_audit = $validatedData['kode_audit'];
        $auditRutin->versi = $validatedData['versi'];
        $auditRutin->pendahuluan = $validatedData['pendahuluan'];
        $auditRutin->cakupan_audit = $validatedData['cakupan_audit'];
        $auditRutin->tujuan_audit = $validatedData['tujuan_audit'];
        $auditRutin->metodologi_audit = $validatedData['metodologi_audit'];
        $auditRutin->hasil_audit = $validatedData['hasil_audit'];
        $auditRutin->rekomendasi = $validatedData['rekomendasi'];
        $auditRutin->kesimpulan_audit = $validatedData['kesimpulan_audit'];

    // Simpan perubahan ke dalam database
    $auditRutin->save();

    return redirect()->back()->with('suksessimpan', 'Berhasil Memperbarui Laporan Audit!');

}
    public function destroy($id){
        $audit = AuditInsidental::findOrFail($id);
        $audit->delete();
        return redirect()->back()->with('message', 'Data Audit insidental berhasil dihapus');
    }

     public function getAudit($id){
        // $auditInsidental = AuditInsidental::where('kode_audit', $id)->where('status', 'draft')->get();
        $auditProses = AuditInsidental::where('kode_audit', $id)->where('status', 'proses')->latest()->first();
        $unitkerja = User::where('role', 'unitkerja')->get();
       $versi = AuditRutin::select('versi')
    ->where('kode_audit', $id)
    ->groupBy('versi')
    ->orderBy('versi', 'asc')
    ->get();
        return response()->json([
            // 'auditInsidental' => $auditInsidental,
            'unitKerja' => $unitkerja,
            'auditProses' => $auditProses,
            'versi' => $versi
        ]);
}

   public function getDataByFilter($id, $unitkerja ,$dari, $sampai){

            // Query untuk mendapatkan data antara dua tanggal berdasarkan id
            $auditInsidental = AuditInsidental::with('unitKerja')->where('kode_audit', $id)->where('unitkerja_id', $unitkerja)
                ->whereBetween('tanggal_audit', [$dari, $sampai])
                ->get();

            // Kembalikan hasil query dalam format JSON
            return response()->json($auditInsidental);


    }

    public function getAuditInsidentalGet(Request $request)
    {
        // Inisialisasi query dasar
        $query = AuditInsidental::with('unitKerja')->with('kodeaudit');
    
        // Cek apakah keempat request ada
        if ($request->sistem && $request->unitkerja && $request->tanggalaudit) {
            $query->where('kode_audit', $request->sistem)
                  ->where('unitkerja_id', $request->unitkerja)
                  ->where('tanggal_audit', $request->tanggalaudit);
        }
        // Cek apakah request unitkerja dan sistem ada
        elseif ($request->sistem && $request->unitkerja) {
            $query->where('kode_audit', $request->sistem)
                  ->where('unitkerja_id', $request->unitkerja);
        }
        // Cek apakah request sistem dan tanggalaudit ada
        elseif ($request->sistem && $request->tanggalaudit) {
            $query->where('kode_audit', $request->sistem)
                  ->where('tanggal_audit', $request->tanggalaudit);
        }
        // Cek apakah request unitkerja dan tanggalaudit ada
        elseif ($request->unitkerja && $request->tanggalaudit) {
            $query->where('unitkerja_id', $request->unitkerja)
                  ->where('tanggal_audit', $request->tanggalaudit);
        }
        // Cek request satu per satu untuk kombinasi lainnya
        else {
            if ($request->sistem) {
                $query->where('kode_audit', $request->sistem);
            }
            if ($request->unitkerja) {
                $query->where('unitkerja_id', $request->unitkerja);
            }
            if ($request->tanggalaudit) {
                $query->where('tanggal_audit', $request->tanggalaudit);
            }
        }
    
        // Jalankan query dan dapatkan hasilnya
        $auditInsidental = $query->orderBy('tanggal_audit', 'asc')->get();
    
        // Kembalikan hasil query dalam format JSON
        return response()->json($auditInsidental);
    }
    

}
