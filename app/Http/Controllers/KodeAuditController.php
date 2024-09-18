<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KodeAudit;
use App\Models\AuditRutin;
use Illuminate\Support\Facades\DB;
class KodeAuditController extends Controller
{
    public function index()
    {
         $data = KodeAudit::all();
        return view('TimKeamananAudit.kodeaudit.kodeaudit', [
            'laporan' => $data
        ]);
    }

    public function create()
    {
        return view('TimKeamananAudit.kodeaudit.tambah_kodeaudit', [
        ]);
    }

    public function store(Request $request)
    {

         $validatedData = $request->validate([
        'kode_audit' => 'required|max:255',
        'nama_sistem' => 'required',
         ]);

         $kodeaudit = new KodeAudit();
         $kodeaudit->kode_audit = $validatedData['kode_audit'];
         $kodeaudit->nama_sistem = $validatedData['nama_sistem'];
        $kodeaudit->save();

       return redirect()->back()->with('message', 'Berhasil Menambah Sistem!');
    }

    public function update(Request $request, $id)
    {


        // Validasi data
         $validatedData = $request->validate([
        'kode_audit' => 'required|max:255',
        'nama_sistem' => 'required',
         ]);

        // Update data pelaporan
        $kodeaudit = KodeAudit::findOrFail($id);
    $kodeaudit->kode_audit = $validatedData['kode_audit'];
    $kodeaudit->nama_sistem = $validatedData['nama_sistem'];

    $kodeaudit->save();

    return redirect()->back()->with('message', 'Berhasil Memperbarui Data Sistem!');
    }

    public function destroy($id)
    {
         $kodeaudit = KodeAudit::findOrFail($id);

    // Hapus data dari database
    $kodeaudit->delete();

    return redirect()->back()->with('sukseshapus', 'Berhasil Menghapus Sistem!');
    }

    public function delete($id)
    {
        $pelaporan = KodeAudit::findOrFail($id);

        if ($pelaporan) {
            $pelaporan->delete();
            return redirect()->route('audit-code.index')->with('sukseshapus', 'Data berhasil dihapus');
        }

        return back()->with('agalhapus', 'Data tidak ditemukan');
    }

    public function edit($id)
    {
        $data = KodeAudit::findOrFail($id);
         return view('TimKeamananAudit.kodeaudit.update_kodeaudit', [
            'laporan' => $data
        ]);
    }

    public function auditRutin()
    {
        return $this->hasOne(AuditRutin::class, 'kode_audit_id');
    }

    public function getData($id){
        $kodeaudit = KodeAudit::findOrFail($id);

        return response($kodeaudit);
    }

    public function datasistem(){
        if(auth()->user()->role == "audit"){
            $view = "TimKeamananAudit.sistem.datasistem";
        }else{
            $view = "admin.sistem.datasistem";
        }
         $laporan = DB::table('kode_audits')
    ->select('kode_audits.*', DB::raw('
        (SELECT count(*)
         FROM audit_rutins
         WHERE kode_audits.kode_audit = audit_rutins.kode_audit
        ) as audit_rutin_count
    '))
    ->get();
        return view($view, [
            'laporan' => $laporan
        ]);
    }
}
