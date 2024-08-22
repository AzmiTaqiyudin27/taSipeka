<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
            $role = auth()->user()->role;

        if ($role == 'admin') {
        $view = 'admin.admin_profil';
    } else if ($role == 'pimpinan') {
        $view = 'pimpinan.pimpinan_profil';
    } else if ($role == 'unitkerja'){
        $view = 'unitkerja.unitkerja_profil';
    }else if($role == 'rektor'){
        $view = 'rektor.rektor_profil';
    }
    else{
        $view = 'TimKeamananAudit.audit_profil';
    }


        return view($view, [
            'user' => $user
        ]);
    }

}
