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
            'unitkerja' => 'int|nullable',
            'status' => 'required'
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
        $user->is_active = $request->status;
        // if($request->status == "true"){
        //     $user->is_active = true;
        // }else{
        //     $user->is_active = false;
        // }
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
           $user->pelaporan_rutin()->delete();
    $user->pelaporan_insidental()->delete();
    $user->audit_rutin()->delete();
    $user->audit_insidental()->delete();
    $user->unit_kerja()->delete();
    $user->auditsRutin()->delete();
        $user->delete();
        return redirect()->back()->with('success', 'Akun berhasil dihapus');
    }

    public function activate($id){
        $user = User::findOrFail($id);
        $user->is_active = true;
        $user->save();

        return redirect()->back()->with('success', 'User telah berhasil diaktifkan');

    }

    public function deactivate($id){
        $user = User::findOrFail($id);
        $user->is_active = false;
        $user->save();
        return redirect()->back()->with('success', 'User telah berhasil dinonaktifkan');


    }
    
    public function changeStatus(Request $request, $id){
        $user = User::findOrFail($id);
      
        if($user){
            $user->is_active = $request->status;
            if($request->alasan){
                $user->is_ditolak = $request->alasan;
                $user->save();
                return response('Berhasil Menolak Akun User');
            }else{
                $user->save();
                $user->is_ditolak = null;
                return response('Berhasil Mengubah Status Akun');
            }
        }
    }
}
