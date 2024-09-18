<?php

namespace App\Http\Controllers;

use App\Models\KodeAudit;
use App\Models\AuditRutin;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PengajuanRutin;
use App\Models\AuditInsidental;
use App\Models\PengajuanInsidental;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
         $datainsidental = PengajuanInsidental::all();
        $datarutin = PengajuanRutin::all();
        $user = Auth::user();
        $auditRutin = AuditRutin::all();
        $auditInsidental = AuditInsidental::all();
        $jumlahaudit = AuditRutin::count();
        $jumlahsistem = KodeAudit::count();
        $jumlahinsidental = AuditInsidental::count();
        $jumlahpengajuanrutin = PengajuanRutin::count();
        $jumlahpengajuaninsidental = PengajuanInsidental::count();
        $userNonAktif = User::where('is_active', false)->get();
        return view('admin.dashboard',[
            'laporanrutin' => $datarutin,
            'laporaninsidental' => $datainsidental,
            'auditrutin' => $auditRutin,
            'auditinsidental' => $auditInsidental,
            'jumlahaudit' => $jumlahaudit,
            'jumlahsistem' => $jumlahsistem,
            'jumlahinsidental' => $jumlahinsidental,
            'jumlahpengajuanrutin' => $jumlahpengajuanrutin,
            'jumlahpengajuaninsidental' => $jumlahpengajuaninsidental,
            'user' => $user,
            'userNonAktif' => $userNonAktif
        ]);
    }
    public function pimpinan(){
        $user = Auth::user();
        $id = $user->id;
        $unitkerjaid = auth()->user()->unitkerja_id;
        $datainsidental = PengajuanInsidental::all();
        $datarutin = PengajuanRutin::all();
         $auditRutin = AuditRutin::all();
        $auditInsidental = AuditInsidental::all();
        $jumlahaudit = AuditRutin::count();
        $jumlahsistem = KodeAudit::count();
                $jumlahinsidental = AuditInsidental::count();
        $jumlahpengajuanrutin = PengajuanRutin::where('user_id', $unitkerjaid  )->count();
        $jumlahpengajuaninsidental = PengajuanInsidental::where('user_id', $unitkerjaid)->count();
        return view('pimpinan.dashboard',[
            'laporanrutin' => $datarutin,
            'laporaninsidental' => $datainsidental,
             'auditrutin' => $auditRutin,
             'jumlahaudit' => $jumlahaudit,
            'jumlahsistem' => $jumlahsistem,
            'auditinsidental' => $auditInsidental,
                        'jumlahinsidental' => $jumlahinsidental,
            'jumlahpengajuanrutin' => $jumlahpengajuanrutin,
            'jumlahpengajuaninsidental' => $jumlahpengajuaninsidental,
            'user' => $user
        ]);
    }

      public function rektor(){
        $user = Auth::user();
        $id = $user->id;
        $unitkerjaid = auth()->user()->unitkerja_id;
        $datainsidental = PengajuanInsidental::all();
        $datarutin = PengajuanRutin::all();
         $auditRutin = AuditRutin::all();
        $auditInsidental = AuditInsidental::all();
        $jumlahaudit = AuditRutin::count();
        $jumlahsistem = KodeAudit::count();
                $jumlahinsidental = AuditInsidental::count();
        $jumlahpengajuanrutin = PengajuanRutin::count();
        $jumlahpengajuaninsidental = PengajuanInsidental::count();
        return view('rektor.dashboard',[
            'laporanrutin' => $datarutin,
            'laporaninsidental' => $datainsidental,
             'auditrutin' => $auditRutin,
             'jumlahaudit' => $jumlahaudit,
            'jumlahsistem' => $jumlahsistem,
            'auditinsidental' => $auditInsidental,
                        'jumlahinsidental' => $jumlahinsidental,
            'jumlahpengajuanrutin' => $jumlahpengajuanrutin,
            'jumlahpengajuaninsidental' => $jumlahpengajuaninsidental,
            'user' => $user
        ]);
    }
    public function unitkerja(){

        $user = Auth::user();
        $id = $user->id;
        $datainsidental = PengajuanInsidental::where("user_id", $id)->get();
        $datarutin = PengajuanRutin::where("user_id",$id)->get();
        $auditRutin = AuditRutin::where('unitkerja_id', $id)->get();
        $auditInsidental = AuditInsidental::where('unitkerja_id', $id)->get();
        $jumlahaudit = AuditRutin::count();
        $jumlahsistem = KodeAudit::count();$jumlahinsidental = AuditInsidental::count();
        $jumlahpengajuanrutin = PengajuanRutin::where("user_id", $id)->count();
        $jumlahpengajuaninsidental = PengajuanInsidental::where("user_id", $id)->count();

        return view('unitkerja.unitkerja_dashboard', [
           'laporanrutin' => $datarutin,
            'laporaninsidental' => $datainsidental,
            'auditrutin' => $auditRutin,
            'auditinsidental' => $auditInsidental,
            'jumlahaudit' => $jumlahaudit,
            'jumlahsistem' => $jumlahsistem,
            'jumlahinsidental' => $jumlahinsidental,
            'jumlahpengajuanrutin' => $jumlahpengajuanrutin,
            'jumlahpengajuaninsidental' => $jumlahpengajuaninsidental,
            'user' => $user
        ]);
    }

    public function audit(){
       $datainsidental = PengajuanInsidental::where('status_approved', '1')->get();
        $datarutin = PengajuanRutin::where('status_approved', '1')->get();
        $user = Auth::user();
        $auditRutin = AuditRutin::with('unitkerja')->with('kodeaudit')->get();
        $auditInsidental = AuditInsidental::with('unitkerja')->with('kodeaudit')->get();
                $jumlahinsidental = AuditInsidental::count();
        $jumlahpengajuanrutin = PengajuanRutin::count();
        $jumlahpengajuaninsidental = PengajuanInsidental::count();
        $jumlahaudit = AuditRutin::count();
        $jumlahsistem = KodeAudit::count();

        return view('TimKeamananAudit.keamananaudit_dashboard', [
          'laporanrutin' => $datarutin,
            'laporaninsidental' => $datainsidental,
            'auditrutin' => $auditRutin,
            'auditinsidental' => $auditInsidental,
            'jumlahaudit' => $jumlahaudit,
            'jumlahsistem' => $jumlahsistem,
                        'jumlahinsidental' => $jumlahinsidental,
            'jumlahpengajuanrutin' => $jumlahpengajuanrutin,
            'jumlahpengajuaninsidental' => $jumlahpengajuaninsidental,
            'user' => $user
        ]);
    }
}
