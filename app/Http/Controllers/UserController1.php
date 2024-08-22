<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        $user = User::where('role', 'pimpinan')->orWhere('role', 'audit')->orWhere('role', 'unitkerja')->get();
        $unitkerja = User::where('role', 'unitkerja')->get();
        return view('admin.user', [
            'unitkerja' => $unitkerja,
            'user' => $user
        ]);

    }

    public function getdatauser($id){
        $detailuser = User::findOrFail($id);

        return response($detailuser);
    }


    public function store(Request $request){
         $request->validate([
        'username' => 'required|string|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => "required|string|min:8|confirmed",
            'role' => 'required|string',
            'unitkerja' => 'int|nullable'
            // Tambahkan validasi lain sesuai kebutuhan
        ]);

        // Buat password default (misalnya 'password')


        // Buat user baru dengan role pimpinan dan password default
        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->unitkerja_id = $request->unitkerja;
        // Sesuaikan dengan nilai role yang diinginkan
        // Tambahkan atribut lain jika perlu, misalnya nama lengkap, dll.

        // Simpan user ke database
        $user->save();

        // Redirect kembali ke halaman sebelumnya
        return redirect()->back()->with('success', 'Akun Telah berhasil ditambahkan');
    }
    public function changePassword(Request $request, $id){

        $request->validate([
            'passwordedit' => 'required|string|min:8|confirmed'
        ]);
        $user = User::findOrFail($id);
         $user->password = Hash::make($request->passwordedit);
        $user->save();
    return redirect()->back()->with('success', 'Password Akun berhasil diperbarui');
    }

    public function getdatauserupdate(Request $request, $id){
         $request->validate([
        'username_edit' => 'required|string',
            'email_edit' => 'required|email',

        ]);


        $user = User::findOrFail($id);

        $user->username = $request->username_edit;
        $user->email = $request->email_edit;
        $user->save();

        return redirect()->back()->with('success', 'Akun berhasil diupdate');
    }

    public function destroy($id){
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('success', 'Akun berhasil dihapus');
    }

}
