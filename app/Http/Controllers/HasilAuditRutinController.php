<?php

namespace App\Http\Controllers;
use App\Models\KodeAudit;
use App\Models\AuditRutin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Auth;


class HasilAuditRutinController extends Controller
{
        public function showDashboard()
    {
        $user = Auth::user(); // Ambil pengguna yang sedang masuk
        return view('pimpinan.pimpinan_layout', compact('user'));
    }
    public function index(){
        $user = Auth::user();
        $id = $user->id;
        $unitkerjaid = auth()->user()->unitkerja_id;
        $role = auth()->user()->role;
        $listUnitkerja = User::where('role', 'unitkerja')->get();

        if ($role == 'admin') {
        $view = 'admin.hasilaudit.hasilRutin';
    } else if ($role == 'pimpinan') {
        $view = 'pimpinan.hasilaudit.hasilRutin';
    } else if ($role == 'unitkerja') {
        $view = 'unitkerja.hasilaudit.hasilRutin';

    } else if ($role == 'rektor') {
        $view = 'rektor.hasilaudit.hasilRutin';
    }

    else {
        $view = 'TimKeamananAudit.hasilaudit.keamananaudit_hasilRutin';
    }

    // $laporan = DB::table('kode_audits')
    //     ->select('kode_audits.*', DB::raw('
    //         (SELECT count(*)
    //          FROM audit_rutins
    //          WHERE kode_audits.kode_audit = audit_rutins.kode_audit
    //         ) as audit_rutin_count
    //     '))
    //     ->get();

    $laporan = KodeAudit::All();

    return view($view, [
        'user' => $user,
        'laporan' => $laporan,
        'listunitkerja' => $listUnitkerja
    ]);
    }

    public function show($kode){
        $kodeAudit = KodeAudit::where("kode_audit", $kode)->first();
        $auditProses = AuditRutin::where("kode_audit", $kode)->where("status", "proses")->get();
        $auditDiedit = AuditRutin::where("kode_audit", $kode)->where("status", "diedit")->get();

        $id = Auth::id();

        return view('unitkerja.audit.tambahPelaporanRutin', [
            "auditProses" => $auditProses,
            "auditDiedit" => $auditDiedit,
            "kodeaudit" => $kodeAudit,
            "userid" => $id
        ]);


    }

    public function store(Request $request){
       // Validasi data
        $validatedData = $request->validate([
            'tanggal_audit' => 'required|max:255',
            'user_id' => 'required',
            'kode_audit' => 'required|max:255',
            'versi' => 'required',
            'status' => 'required',
        ]);

        // Buat instance baru dari model AuditRutin
        $auditRutin = new AuditRutin();
        $auditRutin->tanggal_audit = $validatedData['tanggal_audit'];
        $auditRutin->user_id = $validatedData['user_id'];
        $auditRutin->kode_audit = $validatedData['kode_audit'];
        $auditRutin->versi = $validatedData['versi'];
        $auditRutin->status = $validatedData['status'];

        // Simpan ke dalam database
        $auditRutin->save();

       return redirect()->back()->with('message', 'Berhasil Menambah Laporan Audit!');
    }
    public function update(Request $request, $id)
{
    // Validasi data
    $validatedData = $request->validate([
        'tanggal_audit' => 'required|max:255',
        'user_id' => 'required',
        'kode_audit' => 'required|max:255',
        'versi' => 'required',
        'status' => 'required',
    ]);

    // Cari instance dari model AuditRutin berdasarkan ID
    $auditRutin = AuditRutin::findOrFail($id);
    $auditRutin->tanggal_audit = $validatedData['tanggal_audit'];
    $auditRutin->user_id = $validatedData['user_id'];
    $auditRutin->kode_audit = $validatedData['kode_audit'];
    $auditRutin->versi = $validatedData['versi'];
    $auditRutin->status = $validatedData['status'];

    // Simpan perubahan ke dalam database
    $auditRutin->save();

    return redirect()->back()->with('message', 'Berhasil Memperbarui Laporan Audit!');
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
    public function getData($id){

        $auditRutin = AuditRutin::where("id", $id)->first();

        return response($auditRutin);
    }

    public function getDataByFilter($id, $unitkerja, $dari, $sampai){
            // Query untuk mendapatkan data antara dua tanggal berdasarkan id
            $auditRutin = AuditRutin::with('unitKerja')->where('kode_audit', $id)->where('unitkerja_id', $unitkerja )
                ->whereBetween('tanggal_proses', [$dari, $sampai])
                ->get();

            // Kembalikan hasil query dalam format JSON
            return response()->json($auditRutin);


    }
    public function getAuditByUnitkerja($unitkerja){

        $auditRutin = AuditRutin::with('unitKerja')->with('kodeAudit')->where('unitkerja_id', $unitkerja)->get();

        return response($auditRutin);
    }

    public function getAuditRutinGet(Request $request)
{
    // Initialize the base query
    $query = AuditRutin::with('unitKerja', 'kodeaudit');

    // Check if all three request parameters exist: sistem, unitkerja, and tanggalaudit
    if ($request->sistem && $request->unitkerja && $request->tanggalaudit) {
        $query->where('kode_audit', $request->sistem)
              ->where('unitkerja_id', $request->unitkerja)
              ->where('tanggal_audit', $request->tanggalaudit);
    }
    // Check if the sistem and unitkerja parameters exist
    elseif ($request->sistem && $request->unitkerja) {
        $query->where('kode_audit', $request->sistem)
              ->where('unitkerja_id', $request->unitkerja);
    }
    // Check if the sistem and tanggalaudit parameters exist
    elseif ($request->sistem && $request->tanggalaudit) {
        $query->where('kode_audit', $request->sistem)
              ->where('tanggal_audit', $request->tanggalaudit);
    }
    // Check if the unitkerja and tanggalaudit parameters exist
    elseif ($request->unitkerja && $request->tanggalaudit) {
        $query->where('unitkerja_id', $request->unitkerja)
              ->where('tanggal_audit', $request->tanggalaudit);
    }
    // Handle other individual conditions
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

    // Execute the query and get the results
    $auditRutin = $query->orderBy('tanggal_audit', 'asc')->get();

    // Return the query results as JSON
    return response()->json($auditRutin);
}
}
