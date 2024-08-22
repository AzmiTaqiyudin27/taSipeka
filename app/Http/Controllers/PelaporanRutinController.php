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
        // dd($request);
        $data = $request->except('_token');
        $user = auth()->user()->id;
        $data = $request->validate([
            'tanggal_lapor' => 'required',
            'nama_sistem' => 'required',
            'versi' => 'required',
            'deskripsi' => 'required',
            'dokumen*' => 'required|file|max:5120',
        ]);

        $data['user_id'] = $user;

        $files = [];
        $totalSize = 0;

        // Cek jika ada file yang diunggah
        if ($request->hasFile('dokumen')) {
            // Hitung total ukuran file
            foreach ($request->file('dokumen') as $file) {
                $totalSize += $file->getSize();
            }

            // Konversi 5 MB ke bytes
            $maxSize = 5 * 1024 * 1024;

            // Periksa apakah total ukuran melebihi 5 MB
            if ($totalSize > $maxSize) {
                return back()->withErrors(['dokumen' => 'Total ukuran semua file tidak boleh melebihi 5 MB.']);
            }

            // Jika ukuran file sudah sesuai, pindahkan file ke direktori yang diinginkan
            foreach ($request->file('dokumen') as $file) {
                if ($file->isValid()) {
                    $dokumen = $file->getClientOriginalName();
                    $file->move(public_path('dokumen'), $dokumen);
                    $files[] = $dokumen;
                }
            }
            $data['dokumen'] = implode(", ", $files); // Mengubah array menjadi string
            PelaporanRutin::create($data);
            return redirect()->route('pelaporan-rutin.index')->with('suksestambah', 'Data berhasil ditambah');
        }
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
        $pelaporanRutin = PelaporanRutin::findOrFail($id);

        // Validasi data
        $data = $request->validate([
            'tanggal_lapor' => 'required',
            'nama_sistem' => 'required',
            'versi' => 'required',
            'deskripsi' => 'required',
            'dokumen' => 'nullable|max:2048',
        ]);

        // Update data pelaporan
        $pelaporanRutin->update($data);

        // Handle file dokumen
           $totalSize = 0;

        // Cek jika ada file yang diunggah
        if ($request->hasFile('dokumen')) {
            // Hitung total ukuran file
            foreach ($request->file('dokumen') as $file) {
                $totalSize += $file->getSize();
            }

            // Konversi 5 MB ke bytes
            $maxSize = 5 * 1024 * 1024;

            // Periksa apakah total ukuran melebihi 5 MB
            if ($totalSize > $maxSize) {
                return back()->withErrors(['dokumen' => 'Total ukuran semua file tidak boleh melebihi 5 MB.']);
            }

            // Jika ukuran file sudah sesuai, pindahkan file ke direktori yang diinginkan
            foreach ($request->file('dokumen') as $file) {
                if ($file->isValid()) {
                    $dokumen = $file->getClientOriginalName();
                    $file->move(public_path('dokumen'), $dokumen);
                    $files[] = $dokumen;
                }
            }
            $pelaporanRutin->dokumen = implode(", ", $files);
            $pelaporanRutin->save();
        }

        return redirect()->route('pelaporan-rutin.index')->with('suksesubah', 'Data berhasil diubah');
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
