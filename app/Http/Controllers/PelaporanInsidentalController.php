<?php

namespace App\Http\Controllers;

use App\Models\PelaporanInsidental;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PelaporanInsidentalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){

           $role = auth()->user()->role;
           if($role == "pimpinan"){

            $view = 'pimpinan.pelaporan.pimpinan_insidental';
            $data = PelaporanInsidental::where('user_id', auth()->user()->unitkerja_id)->get();

           }
           else{

            $view = 'unitkerja.pelaporaninsidental.pelaporanInsidental';
               $data = PelaporanInsidental::where('user_id', auth()->user()->id)->get();

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

            $view = 'admin.auditinsidental.tambahPelaporanInsidental';

           }
           else{

            $view = 'unitkerja.pelaporaninsidental.tambahPelaporanInsidental';

           }
        return view($view,[]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $data = $request->except('_token');
        $user = auth()->user()->id;
        $data = $request->validate([
            'tanggal_lapor' => 'required',
            'nama_sistem' => 'required',
            'kendala' => 'required',
            'keterangan' => 'required',
            'foto*' => 'required|file',
        ]);

     $files = [];
$totalSize = 0;

// Cek jika ada file yang diunggah
        if ($request->hasFile('foto')) {
            // Hitung total ukuran file
            foreach ($request->file('foto') as $file) {
                $totalSize += $file->getSize();
            }

            // Konversi 5 MB ke bytes
            $maxSize = 5 * 1024 * 1024;

            // Periksa apakah total ukuran melebihi 5 MB
            if ($totalSize > $maxSize) {
                return back()->withErrors(['foto' => 'Total ukuran semua foto tidak boleh melebihi 5 MB.']);
            }

            // Jika ukuran file sudah sesuai, pindahkan file ke direktori yang diinginkan
            foreach ($request->file('foto') as $file) {
                if ($file->isValid()) {
                    $dokumen = $file->getClientOriginalName();
                    $file->move(public_path('foto'), $dokumen);
                    $files[] = $dokumen;
                }
            }
        }
        $data['foto'] = implode(", ", $files); // Mengubah array menjadi string
        $data['user_id'] = $user;
        // dd($data);
        PelaporanInsidental::create($data);
        return redirect()->route('unitkerja-auditinsidental')->with('suksestambah', 'Data berhasil ditambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(PelaporanInsidental $pelaporanInsidental)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PelaporanInsidental $pelaporanInsidental, $id)
    {
         $pelaporanInsidental = PelaporanInsidental::findOrFail($id);
        $pelaporanInsidental->tanggal_lapor = date('Y-m-d', strtotime($pelaporanInsidental->tanggal_lapor));
        return view('unitkerja.pelaporaninsidental.ubahPelaporanInsidental', [
            'laporan' => $pelaporanInsidental
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pelaporanInsidental = PelaporanInsidental::findOrFail($id);

        // Validasi data
        $data = $request->validate([
            'tanggal_lapor' => 'required',
            'nama_sistem' => 'required',
            'kendala' => 'required',
            'keterangan' => 'required',
            'foto' => 'nullable|max:2048',
        ]);

        // Update data pelaporan
        $pelaporanInsidental->update($data);

        // Handle file dokumen
        $files = [];
       $totalSize = 0;

// Cek jika ada file yang diunggah
        if ($request->hasFile('foto')) {
            // Hitung total ukuran file
            foreach ($request->file('foto') as $file) {
                $totalSize += $file->getSize();
            }

            // Konversi 5 MB ke bytes
            $maxSize = 5 * 1024 * 1024;

            // Periksa apakah total ukuran melebihi 5 MB
            if ($totalSize > $maxSize) {
                return back()->withErrors(['foto' => 'Total ukuran semua foto tidak boleh melebihi 5 MB.']);
            }

            // Jika ukuran file sudah sesuai, pindahkan file ke direktori yang diinginkan
            foreach ($request->file('foto') as $file) {
                if ($file->isValid()) {
                    $dokumen = $file->getClientOriginalName();
                    $file->move(public_path('foto'), $dokumen);
                    $files[] = $dokumen;
                }
            }
            $pelaporanInsidental->foto = implode(", ", $files);
            $pelaporanInsidental->save();
        }

        return redirect()->route('pelaporan-insidental.index')->with('suksesubah', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PelaporanInsidental $pelaporanInsidental)
    {
        $pelaporanInsidental::destroy($pelaporanInsidental->id);
        return back()->with('sukseshapus','data berhasil dihapus');
    }

    public function delete(Request $request, $id)
    {
        $pelaporan = PelaporanInsidental::findOrFail($id);

        if ($pelaporan) {
            $pelaporan->delete();
            return redirect()->route('pelaporan-insidental.index')->with('sukseshapus', 'Data berhasil dihapus');
        }

        return back()->with('gagalhapus', 'Data tidak ditemukan');
    }

    public function printPDF()
    {
        $data = PelaporanInsidental::all();

        $html = view('unitkerja.pelaporaninsidental.unitkerja_pdfisidental', compact('data'))->render();

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
        $item = PelaporanInsidental::find($validatedData['id']);
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

       $item = PelaporanInsidental::find($validatedData['id']);
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

       $item = PelaporanInsidental::find($validatedData['id']);
       return response($item->is_ditolak);
    }

}
