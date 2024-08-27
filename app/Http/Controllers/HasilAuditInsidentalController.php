<?php

namespace App\Http\Controllers;

use App\Models\AuditInsidental;
use App\Models\User;
use App\Models\KodeAudit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HasilAuditInsidentalController extends Controller
{
        public function index(){ $role = auth()->user()->role;

        if ($role == 'admin') {
        $view = 'admin.hasilinsidental.admin_hasilinsidental';
    } else if ($role == 'pimpinan') {
        $view = 'pimpinan.hasilinsidental.pimpinan_hasilinsidental';
    } else if ($role == 'unitkerja') {
        $view = 'unitkerja.hasilinsidental.unitkerja_hasilinsidental';

    } else if ($role == 'rektor') {
        $view = 'rektor.hasilinsidental.rektor_hasilinsidental';
    } else {
        $view = 'TimKeamananAudit.hasilinsidental.keamananaudit_hasilInsidental';
    }
        $laporan = KodeAudit::all();
        $unitkerja = User::where('role', 'unitkerja')->get();
        
        return view($view, [
            'laporan' => $laporan,
            'listunitkerja' => $unitkerja
        ]);
    }
    public function getData($id, $unitkerja){
        $role = auth()->user()->role;
        $userid = auth()->user()->id;
        $unitkerjaid = auth()->user()->unitkerja_id;

        if($role == "unitkerja"){
              $auditInsidental = DB::table('audit_insidentals')
    // ->join('kode_audits', 'audit_insidentals.kode_audit', '=', 'kode_audits.kode_audit_rutin')
    ->join('users as user_creator', 'audit_insidentals.user_id', '=', 'user_creator.id')
    ->join('users as unitkerja', 'audit_insidentals.unitkerja_id', '=', 'unitkerja.id')
    ->select('audit_insidentals.*', 'user_creator.username as creator_username', 'unitkerja.username as unitkerja_name')
    ->where('audit_insidentals.kode_audit', $id)
    ->where('audit_insidentals.unitkerja_id', $userid)->get();


}
    else if($role == "pimpinan"){
              $auditInsidental = DB::table('audit_insidentals')
    // ->join('kode_audits', 'audit_insidentals.kode_audit', '=', 'kode_audits.kode_audit_rutin')
    ->join('users as user_creator', 'audit_insidentals.user_id', '=', 'user_creator.id')
    ->join('users as unitkerja', 'audit_insidentals.unitkerja_id', '=', 'unitkerja.id')
    ->select('audit_insidentals.*', 'user_creator.username as creator_username', 'unitkerja.username as unitkerja_name')
    ->where('audit_insidentals.kode_audit', $id)
    ->where('audit_insidentals.unitkerja_id', $unitkerjaid)->get();


}

else{
              $auditInsidental = DB::table('audit_insidentals')
    // ->join('kode_audits', 'audit_insidentals.kode_audit', '=', 'kode_audits.kode_audit_rutin')
    ->join('users as user_creator', 'audit_insidentals.user_id', '=', 'user_creator.id')
    ->join('users as unitkerja', 'audit_insidentals.unitkerja_id', '=', 'unitkerja.id')
    ->select('audit_insidentals.*', 'user_creator.username as creator_username', 'unitkerja.username as unitkerja_name')
    ->where('audit_insidentals.kode_audit', $id)->where('audit_insidentals.unitkerja_id', $unitkerja)->get();
    }
    return response($auditInsidental);
    }
}
