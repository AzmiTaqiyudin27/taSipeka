<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PelaporanInsidental;
use App\Models\PelaporanRutin;

class KeamananAuditInsidental extends Controller
{
    public function dashboard()
    {
        return view('TimKeamananAudit.keamananaudit_dashboard', [
        ]);
    }

    public function index(){
        $data = PelaporanInsidental::all();
        //  dd($data);
        return view('TimKeamananAudit.penerimaaninsidental.penerimaan_pelaporanInsidental', [
            'laporan' => $data
        ]);
    }


    public function penindakan(){
        $data = PelaporanRutin::all();
        return view('TimKeamananAudit.penindakaninsidental.penindakan_pelaporanInsidental', [
            'laporan' => $data
        ]);
    }
}
