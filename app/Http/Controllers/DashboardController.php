<?php

namespace App\Http\Controllers;

use App\Models\KodeAudit;
use App\Models\AuditRutin;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PelaporanRutin;
use App\Models\AuditInsidental;
use App\Models\PelaporanInsidental;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
         $datainsidental = PelaporanInsidental::all();
        $datarutin = PelaporanRutin::all();
        $user = Auth::user();
        $auditRutin = AuditRutin::all();
        $auditInsidental = AuditInsidental::all();
        $jumlahaudit = AuditRutin::count();
        $jumlahsistem = KodeAudit::count();
        $jumlahinsidental = AuditInsidental::count();
        $jumlahpelaporanrutin = PelaporanRutin::count();
        $jumlahpelaporaninsidental = PelaporanInsidental::count();
        $userNonAktif = User::where('is_active', false)->get();
        return view('admin.dashboard',[
            'laporanrutin' => $datarutin,
            'laporaninsidental' => $datainsidental,
            'auditrutin' => $auditRutin,
            'auditinsidental' => $auditInsidental,
            'jumlahaudit' => $jumlahaudit,
            'jumlahsistem' => $jumlahsistem,
            'jumlahinsidental' => $jumlahinsidental,
            'jumlahpelaporanrutin' => $jumlahpelaporanrutin,
            'jumlahpelaporaninsidental' => $jumlahpelaporaninsidental,
            'user' => $user,
            'userNonAktif' => $userNonAktif
        ]);
    }
    public function pimpinan(){
        $user = Auth::user();
        $id = $user->id;
        $unitkerjaid = auth()->user()->unitkerja_id;
        $datainsidental = PelaporanInsidental::all();
        $datarutin = PelaporanRutin::all();
         $auditRutin = AuditRutin::all();
        $auditInsidental = AuditInsidental::all();
        $jumlahaudit = AuditRutin::count();
        $jumlahsistem = KodeAudit::count();
                $jumlahinsidental = AuditInsidental::count();
        $jumlahpelaporanrutin = PelaporanRutin::where('user_id', $unitkerjaid  )->count();
        $jumlahpelaporaninsidental = PelaporanInsidental::where('user_id', $unitkerjaid)->count();
        return view('pimpinan.dashboard',[
            'laporanrutin' => $datarutin,
            'laporaninsidental' => $datainsidental,
             'auditrutin' => $auditRutin,
             'jumlahaudit' => $jumlahaudit,
            'jumlahsistem' => $jumlahsistem,
            'auditinsidental' => $auditInsidental,
                        'jumlahinsidental' => $jumlahinsidental,
            'jumlahpelaporanrutin' => $jumlahpelaporanrutin,
            'jumlahpelaporaninsidental' => $jumlahpelaporaninsidental,
            'user' => $user
        ]);
    }

      public function rektor(){
        $user = Auth::user();
        $id = $user->id;
        $unitkerjaid = auth()->user()->unitkerja_id;
        $datainsidental = PelaporanInsidental::all();
        $datarutin = PelaporanRutin::all();
         $auditRutin = AuditRutin::all();
        $auditInsidental = AuditInsidental::all();
        $jumlahaudit = AuditRutin::count();
        $jumlahsistem = KodeAudit::count();
                $jumlahinsidental = AuditInsidental::count();
        $jumlahpelaporanrutin = PelaporanRutin::count();
        $jumlahpelaporaninsidental = PelaporanInsidental::count();
        return view('rektor.dashboard',[
            'laporanrutin' => $datarutin,
            'laporaninsidental' => $datainsidental,
             'auditrutin' => $auditRutin,
             'jumlahaudit' => $jumlahaudit,
            'jumlahsistem' => $jumlahsistem,
            'auditinsidental' => $auditInsidental,
                        'jumlahinsidental' => $jumlahinsidental,
            'jumlahpelaporanrutin' => $jumlahpelaporanrutin,
            'jumlahpelaporaninsidental' => $jumlahpelaporaninsidental,
            'user' => $user
        ]);
    }
    public function unitkerja(){

        $user = Auth::user();
        $id = $user->id;
        $datainsidental = PelaporanInsidental::where("user_id", $id)->get();
        $datarutin = PelaporanRutin::where("user_id",$id)->get();
        $auditRutin = AuditRutin::where('unitkerja_id', $id)->get();
        $auditInsidental = AuditInsidental::where('unitkerja_id', $id)->get();
        $jumlahaudit = AuditRutin::count();
        $jumlahsistem = KodeAudit::count();$jumlahinsidental = AuditInsidental::count();
        $jumlahpelaporanrutin = PelaporanRutin::where("user_id", $id)->count();
        $jumlahpelaporaninsidental = PelaporanInsidental::where("user_id", $id)->count();

        return view('unitkerja.unitkerja_dashboard', [
           'laporanrutin' => $datarutin,
            'laporaninsidental' => $datainsidental,
            'auditrutin' => $auditRutin,
            'auditinsidental' => $auditInsidental,
            'jumlahaudit' => $jumlahaudit,
            'jumlahsistem' => $jumlahsistem,
            'jumlahinsidental' => $jumlahinsidental,
            'jumlahpelaporanrutin' => $jumlahpelaporanrutin,
            'jumlahpelaporaninsidental' => $jumlahpelaporaninsidental,
            'user' => $user
        ]);
    }

    public function audit(){
       $datainsidental = PelaporanInsidental::where('status_approved', '1')->get();
        $datarutin = PelaporanRutin::where('status_approved', '1')->get();
        $user = Auth::user();
        $auditRutin = AuditRutin::with('unitkerja')->with('kodeaudit')->get();
        $auditInsidental = AuditInsidental::with('unitkerja')->with('kodeaudit')->get();
                $jumlahinsidental = AuditInsidental::count();
        $jumlahpelaporanrutin = PelaporanRutin::count();
        $jumlahpelaporaninsidental = PelaporanInsidental::count();
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
            'jumlahpelaporanrutin' => $jumlahpelaporanrutin,
            'jumlahpelaporaninsidental' => $jumlahpelaporaninsidental,
            'user' => $user
        ]);
    }
}
