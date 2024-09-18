<?php

namespace App\Http\Controllers;

use App\Models\PengajuanInsidental;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PengajuanInsidentalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){

           $role = auth()->user()->role;
           if($role == "pimpinan"){

            $view = 'pimpinan.pengajuan.pimpinan_insidental';
            $data = PengajuanInsidental::where('user_id', auth()->user()->unitkerja_id)->get();

           }
           else if($role == "admin"){
            $view = 'admin.penerimaanpengajuaninsidnetal.admin_pengajuaninsidental';
            $data = PengajuanInsidental::where('user_id', auth()->user()->unitkerja_id)->get();
           }
           else{

            $view = 'unitkerja.pengajuaninsidental.pengajuanInsidental';
               $data = PengajuanInsidental::where('user_id', auth()->user()->id)->get();

           }
        $user = Auth::user();


        return view($view, [
            'laporan' => $data,
            'user' => $user
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $role = auth()->user()->role;
           if($role == "admin"){

            $view = 'admin.auditinsidental.tambahPengajuanInsidental';

           }
           else{

            $view = 'unitkerja.pengajuaninsidental.tambahPengajuanInsidental';

           }
        return view($view,[]);
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    // Validasi input termasuk file
    $data = $request->validate([
        'tanggal_lapor' => 'required|date',
        'nama_sistem' => 'required|string|max:255',
        'kendala' => 'required|string|max:255',
        'keterangan' => 'required|string|max:255',
        'foto.*' => 'required|file|mimes:jpg,jpeg,png|max:5120', // Validasi untuk setiap file foto
    ]);

    // Ambil user id
    $user = auth()->user()->id;

    // Array untuk menyimpan nama file yang diunggah
    $files = [];
    $totalSize = 0;

    // Cek jika ada file yang diunggah
    if ($request->hasFile('foto')) {
        foreach ($request->file('foto') as $file) {
            if ($file->isValid()) {
                // Tambahkan ukuran file ke totalSize
                $totalSize += $file->getSize();

                // Konversi 5 MB ke bytes
                $maxSize = 5 * 1024 * 1024;

                // Periksa apakah total ukuran melebihi 5 MB
                if ($totalSize > $maxSize) {
                    return back()->withErrors(['foto' => 'Total ukuran semua foto tidak boleh melebihi 5 MB.']);
                }

                // Simpan file di direktori 'public/foto' dengan nama unik
                $filename =  $file->getClientOriginalName();
                // $filename = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path('foto'), $filename);

                // Tambahkan nama file ke array
                $files[] = $filename;
            }
        }
    }

    // Simpan array file sebagai JSON dalam database
    $data['foto'] = json_encode($files); // Simpan nama file sebagai JSON
    $data['user_id'] = $user;

    // Simpan data ke dalam database
    PengajuanInsidental::create($data);

    // Redirect dengan pesan sukses
    return redirect()->route('unitkerja-auditinsidental')->with('suksestambah', 'Data berhasil ditambah');
}

    /**
     * Display the specified resource.
     */
    public function show(PengajuanInsidental $pengajuanInsidental)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PengajuanInsidental $pengajuanInsidental, $id)
    {
         $pengajuanInsidental = PengajuanInsidental::findOrFail($id);
        $pengajuanInsidental->tanggal_lapor = date('Y-m-d', strtotime($pengajuanInsidental->tanggal_lapor));
        return view('unitkerja.pengajuaninsidental.ubahPengajuanInsidental', [
            'laporan' => $pengajuanInsidental
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    // Validasi input
    $data = $request->validate([
        'tanggal_lapor' => 'required|date',
        'nama_sistem' => 'required|string|max:255',
        'kendala' => 'required|string|max:255',
        'keterangan' => 'required|string|max:255',
        'foto_update.*' => 'nullable|file|mimes:jpg,jpeg,png|max:5120', // Validasi untuk file baru
        'foto.*' => 'nullable|file|mimes:jpg,jpeg,png|max:5120', // Validasi untuk foto tambahan
    ]);

    // Ambil data pengajuan yang ingin diupdate
    $pengajuanInsidental = PengajuanInsidental::findOrFail($id);

    // Ambil foto yang sudah ada dari database
    $fotoArray = json_decode($pengajuanInsidental->foto, true) ?? [];

    // Update foto yang sudah ada
    if ($request->has('foto_update')) {
        foreach ($request->file('foto_update') as $index => $file) {
            if ($file && isset($fotoArray[$index])) {
                // Hapus foto lama dari server
                if (file_exists(public_path('foto/' . $fotoArray[$index]))) {
                    unlink(public_path('foto/' . $fotoArray[$index]));
                }

                // Simpan foto baru
                // $newFilename = time() . '-' . $file->getClientOriginalName();
                $newFilename =  $file->getClientOriginalName();
                $file->move(public_path('foto'), $newFilename);
                $fotoArray[$index] = $newFilename;
            }
        }
    }

    // Tambah foto baru ke daftar yang ada
    if ($request->hasFile('foto')) {
        foreach ($request->file('foto') as $file) {
            if ($file->isValid()) {
                // $filename = time() . '-' . $file->getClientOriginalName();
                $filename =  $file->getClientOriginalName();
                $file->move(public_path('foto'), $filename);
                $fotoArray[] = $filename;
            }
        }
    }

    // Simpan kembali foto yang sudah diupdate dan baru ke database dalam bentuk JSON
    $pengajuanInsidental->foto = json_encode($fotoArray);

    // Simpan data non-foto
    $pengajuanInsidental->tanggal_lapor = $data['tanggal_lapor'];
    $pengajuanInsidental->nama_sistem = $data['nama_sistem'];
    $pengajuanInsidental->kendala = $data['kendala'];
    $pengajuanInsidental->keterangan = $data['keterangan'];

    // Simpan perubahan ke database
    $pengajuanInsidental->save();

    return redirect()->route('pengajuan-insidental.index')->with('suksestambah', 'Data berhasil diubah');
}




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PengajuanInsidental $pengajuanInsidental)
    {
        $pengajuanInsidental::destroy($pengajuanInsidental->id);
        return back()->with('sukseshapus','data berhasil dihapus');
    }

    public function delete(Request $request, $id)
    {
        $pengajuan = PengajuanInsidental::findOrFail($id);

        if ($pengajuan) {
            $pengajuan->delete();
            return redirect()->route('pengajuan-insidental.index')->with('sukseshapus', 'Data berhasil dihapus');
        }

        return back()->with('gagalhapus', 'Data tidak ditemukan');
    }

    public function printPDF()
    {
        $data = PengajuanInsidental::all();

        $html = view('unitkerja.pengajuaninsidental.unitkerja_pdfisidental', compact('data'))->render();

        // Initialize Dompdf with options
        $pdf = Pdf::loadHTML($html)->setPaper('A4', 'portrait');

        // Output PDF to browser
        return $pdf->stream('laporan_audit_sistem_informasi_rutin.pdf');
    }
     public function updateStatus(Request $request){
        $validatedData = $request->validate([
            'id' => 'required|integer',
            'status' => 'required|string'
        ]);
        $item = PengajuanInsidental::find($validatedData['id']);
        if ($item) {
            if($request->alasan){
                $item->status_approved = $validatedData['status'];
                $item->is_ditolak = $request->alasan;
                $item->save();
                return response()->json(['message' => 'Status berhasil diperbarui'], 200);
            }else{
                $item->status_approved = $validatedData['status'];
                $item->is_ditolak = null;
                $item->save();
                return response()->json(['message' => 'Status berhasil diperbarui'], 200);
            }

        }

        return response()->json(['message' => 'Item tidak ditemukan'], 404);

    }

    public function hapusPengajuan(Request $request){
       $validatedData = $request->validate([
        'id' => 'required|integer'
       ]);

       $item = PengajuanInsidental::find($validatedData['id']);
       if($item){
        $item->delete();
        return response()->json(['message' => "status berhasil diperbarui"]);

       }else{
         return response()->json(['message' => 'Data tidak ditemukan'], 404);
       }

    }


    public function alasanDitolak(Request $request){
         $validatedData = $request->validate([
        'id' => 'required|integer'
       ]);

       $item = PengajuanInsidental::find($validatedData['id']);
       return response($item->is_ditolak);
    }

}
