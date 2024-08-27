<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\KodeAudit;
use App\Models\AuditRutin;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AuditRutinPenindakanController extends Controller
{
      public function index(){
         $laporan = AuditRutin::with('kodeAudit')->get();
$role = auth()->user()->role;
    if ($role == 'admin') {
        $view = 'admin.penindakanrutin.penindakan_pelaporanRutin';
    } else {
        $view = 'timkeamananaudit.penindakanrutin.penindakan_pelaporanRutin';
    }
        return view($view, [
            'laporan' => $laporan
        ]);
    }

    public function show(){
        $kodeAudit = KodeAudit::all();
        // $auditProses = AuditRutin::where("kode_audit", $kode)->where("status", "proses")->get();
        $auditDiedit = AuditRutin::where("status", "diedit")->get();
        $unitkerja = User::where('role', 'unitkerja')->get();
        $role = auth()->user()->role;

        if ($role == 'admin') {
        $view = 'admin.penindakanrutin.tambah_penindakanRutin';
    } else if ($role == 'pimpinan') {
        $view = 'pimpinan.penindakanrutin.tambah_penindakanRutin';
    } else {
        $view = 'timkeamananaudit.penindakanrutin.tambah_penindakanRutin';
    }

        $id = Auth::id();

        return view($view, [

            "auditDiedit" => $auditDiedit,
            "kodeaudit" => $kodeAudit,
            "userid" => $id,
            "unitkerja" => $unitkerja
        ]);


    }

    public function store(Request $request){
       // Validasi data

        $validatedData = $request->validate([
           'user_id' => 'required|int',
            'unitkerja_id' => 'int',
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
        ]);

        // Buat instance baru dari model AuditRutin
        $auditRutin = new AuditRutin();
        //new AuditRutin 
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
        $auditRutin->status = $validatedData['status'];

        // Simpan ke dalam database
        $auditRutin->save();

       return redirect()->back()->with('message', 'Berhasil Menambah Laporan Audit!');
    }


    public function update(Request $request, $id)
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
            'status' => '',
    ]);

    // Cari instance dari model AuditRutin berdasarkan ID
    $auditRutin = AuditRutin::findOrFail($id);
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

        $auditRutin = AuditRutin::with('unitKerja')->with('kodeaudit')->where("id", $id)->first();

        return response($auditRutin);
    }

    

    public function getAudit($id){
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
