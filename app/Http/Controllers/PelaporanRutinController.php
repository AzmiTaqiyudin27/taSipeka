<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\PelaporanRutin;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Models\PelaporanInsidental;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class PelaporanRutinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
         $role = auth()->user()->role;

        if ($role == 'admin') {
        $view = 'admin.audit.admin_pelaporanRutin';
    } else if ($role == 'pimpinan') {
        $view = 'pimpinan.pelaporan.pimpinan_pelaporanRutin';
    } else {
        $view = 'unitkerja.audit.unitkerja_pelaporanRutin';
    }

    if($role == "pimpinan"){
        $data = PelaporanRutin::where('user_id',auth()->user()->unitkerja_id)->get();


    }else if($role == "unitkerja"){
        $id = auth()->user()->id;
         $data = PelaporanRutin::where('user_id',$id)->get();
    }
    else{


          $data = PelaporanRutin::all();

        }
      $laporan = DB::table('kode_audits')
        ->select('kode_audits.*', DB::raw('
        (SELECT count(*)
        FROM audit_rutins
        WHERE kode_audits.kode_audit_rutin = audit_rutins.kode_audit
        ) as audit_rutin_count
        '))
        ->get();


        return view($view, [
            'laporan' => $laporan,
            'datarutin' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $role = auth()->user()->role;

        if ($role == 'admin') {
        $view = 'admin.audit.tambahPelaporanRutin';
        }  else {
            $view = 'unitkerja.audit.tambahPelaporanRutin';
        }

        return view($view, []);
    }


    public function dashboard()
    {
        $datainsidental = PelaporanInsidental::all();
        $datarutin = PelaporanRutin::all();

        return view('unitkerja.unitkerja_dashboard', [
            'laporanrutin' => $datarutin,
            'laporaninsidental' => $datainsidental
        ]);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Ambil user id dari user yang sedang login
    $user = auth()->user()->id;

    // Validasi input termasuk multiple dokumen
    $data = $request->validate([
        'tanggal_lapor' => 'required',
        'nama_sistem' => 'required',
        'versi' => 'required',
        'deskripsi' => 'required',
        'dokumen.*' => 'required|file|max:5120', // Validasi untuk setiap file
    ]);

    // Tambahkan user_id ke data yang akan disimpan
    $data['user_id'] = $user;

    // Array untuk menyimpan nama file yang di-upload
    $files = [];
    $totalSize = 0;

    // Cek apakah ada file yang diunggah
    if ($request->hasFile('dokumen')) {
        // Hitung total ukuran file
        foreach ($request->file('dokumen') as $file) {
            $totalSize += $file->getSize();
        }

        // Batas total ukuran file adalah 5MB
        $maxSize = 5 * 1024 * 1024;

        // Jika total ukuran melebihi 5MB, kembalikan dengan error
        if ($totalSize > $maxSize) {
            return back()->withErrors(['dokumen' => 'Total ukuran semua file tidak boleh melebihi 5 MB.']);
        }

        // Jika file sesuai dengan aturan, simpan setiap file di direktori yang diinginkan
        foreach ($request->file('dokumen') as $file) {
            if ($file->isValid()) {
                $dokumen = time() . '-' . $file->getClientOriginalName(); // Buat nama unik dengan timestamp
                $file->move(public_path('dokumen'), $dokumen); // Pindahkan file ke folder publik
                $files[] = $dokumen; // Tambahkan nama file ke array
            }
        }

        // Simpan file dalam format array (misalnya JSON)
        $data['dokumen'] = json_encode($files); // Simpan sebagai JSON dalam kolom dokumen
    }

    // Simpan data ke database
    PelaporanRutin::create($data);

    // Redirect ke halaman index dengan pesan sukses
    return redirect()->route('pelaporan-rutin.index')->with('suksestambah', 'Data berhasil ditambah');
}

    /**
     * Display the specified resource.
     */
    public function show(PelaporanRutin $pelaporanRutin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PelaporanRutin $pelaporanRutin,  $id)
    {
        $pelaporanRutin = PelaporanRutin::findOrFail($id);
        $pelaporanRutin->tanggal_lapor = date('Y-m-d', strtotime($pelaporanRutin->tanggal_lapor));
        // dd($pelaporanRutin);
        return view('unitkerja.audit.ubahPelaporanRutin', [
            'laporan' => $pelaporanRutin
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, $id)
{
    $data = $request->validate([
        'tanggal_lapor' => 'required|date',
        'nama_sistem' => 'required|string',
        'versi' => 'required|string',
        'deskripsi' => 'required|string',
        'dokumen_update.*' => 'file|mimes:pdf,docx,doc,xls,xlsx,jpg,jpeg,png|max:5120',
        'dokumen.*' => 'file|mimes:pdf,docx,doc,xls,xlsx,jpg,jpeg,png|max:5120',
    ]);

    $laporan = PelaporanRutin::findOrFail($id);

    // Ambil dokumen yang sudah ada
    $dokumenArray = json_decode($laporan->dokumen, true) ?? [];

    // Update dokumen yang sudah ada
    if ($request->has('dokumen_update')) {
        foreach ($request->file('dokumen_update') as $index => $file) {
            if ($file) {
                // Hapus dokumen lama jika diganti
                if (isset($dokumenArray[$index])) {
                    // Hapus file lama dari sistem jika diinginkan
                    unlink(public_path('dokumen/' . $dokumenArray[$index]));
                }

                // Simpan file baru
                $newFilename = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path('dokumen'), $newFilename);
                $dokumenArray[$index] = $newFilename;
            }
        }
    }

    // Tambah dokumen baru
    if ($request->hasFile('dokumen')) {
        foreach ($request->file('dokumen') as $file) {
            if ($file->isValid()) {
                $filename = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path('dokumen'), $filename);
                $dokumenArray[] = $filename;
            }
        }
    }

    // Simpan dokumen yang sudah diupdate dan baru
    $laporan->dokumen = json_encode($dokumenArray);
    $laporan->tanggal_lapor = $data['tanggal_lapor'];
    $laporan->nama_sistem = $data['nama_sistem'];
    $laporan->versi = $data['versi'];
    $laporan->deskripsi = $data['deskripsi'];
    $laporan->save();

    return redirect()->route('pelaporan-rutin.index')->with('success', 'Data berhasil diubah');
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PelaporanRutin $pelaporanRutin)
    {
        Log::info('Destroy method called with ID: ' . $pelaporanRutin->id);
        $pelaporanRutin->delete();
        return back()->with('sukseshapus', 'Data berhasil dihapus');
    }

    public function delete(Request $request, $id)
    {
        $pelaporan = PelaporanRutin::findOrFail($id);

        if ($pelaporan) {
            $pelaporan->delete();
            return redirect()->route('pelaporan-rutin.index')->with('sukseshapus', 'Data berhasil dihapus');
        }

        return back()->with('gagalhapus', 'Data tidak ditemukan');
    }


    public function printPDF()
    {
        $data = PelaporanRutin::all();

        $html = view('unitkerja.audit.unitkerja_pdf', compact('data'))->render();

        // Initialize Dompdf with options
        $pdf = Pdf::loadHTML($html)->setPaper('A4', 'portrait');

        // Output PDF to browser
        return $pdf->stream('laporan_audit_sistem_informasi_rutin.pdf');
    }

    public function updateStatus(Request $request){
         $validatedData = $request->validate([
            'id' => 'required|integer',
            'status' => 'required|string',

        ]);

        $item = PelaporanRutin::find($validatedData['id']);
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

       $item = PelaporanRutin::find($validatedData['id']);
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

       $item = PelaporanRutin::find($validatedData['id']);
       return response($item->is_ditolak);
    }
}
