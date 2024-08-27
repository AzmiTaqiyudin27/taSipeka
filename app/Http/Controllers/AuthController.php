<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    public function index()
    {
        return view("auth.login");
    }

    public function viewRegister()
    {
        return view("auth.register");
    }

public function authenticate(Request $request): RedirectResponse
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $user = Auth::user();

         if ($user->is_active == '0') {
            Auth::logout();
            return back()->with('gagal', 'Login gagal, akun anda menunggu diapprove admin!');
        }else if($user->is_active == '2'){
             Auth::logout();
            return back()->with('gagal', 'Login gagal, akun anda ditolak admin dikarenakan ' . $user->is_ditolak);
        }

        switch ($user->role) {
            case 'admin':
                return redirect()->intended(route('dashboard-admin'));
                break;
            case 'pimpinan':
                return redirect()->intended(route('hasil-rutin.hasil'));
                break;
            case 'unitkerja':
                return redirect()->intended(route('dashboard-unitkerja'));
                break;
            case 'audit':
                return redirect()->intended(route('dashboard-audit'));
                break;
            case 'rektor' :
                return redirect()->intended(route('hasil-rutin.hasil'));
                break;
             default:
                return redirect()->intended(route('dashboard-admin'));
                break;
        }
    }

    return back()->with('gagal', 'Login gagal, periksa kembali email atau kata sandi yang anda masukkan.');
}


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
        // bisa ditulis pakai ini return redirect()->to("/login") ini pake nama url kalo atasnya nama route nya
    }

    public function register(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'role' => 'required|in:admin,pimpinan,unitkerja,audit',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'is_active' => false
        ]);

        return redirect('/login')->with('success', 'Registrasi Berhasil, Silahkan Login.');
    }
}
