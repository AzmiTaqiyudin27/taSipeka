<?php

namespace App\Http\Controllers;
use Dompdf\Dompdf;
use ParaTest\Options;
use App\Models\AuditRutin;
use App\Models\KodeAudit;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PengajuanRutin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class AuditRutinController extends Controller
{
    public function index(){
        $data = PengajuanRutin::all();
        return view('TimKeamananAudit.penerimaanrutin.penerimaan_pengajuanRutin', [
            'laporan' => $data
        ]);
    }


    public function pelaporan(){
        $data = DB::table('audit_rutins')
        ->select('pelaporan_rutin_id', DB::raw('COUNT(*) as total'))
        ->groupBy('pelaporan_rutin_id')
        ->get();

           $sql = "SELECT * FROM audit_rutins GROUP BY pelaporan_rutin_id";

// Eksekusi query menggunakan Query Builder

        $user = auth()->user();

        return view('TimKeamananAudit.pelaporanrutin.pelaporan_pengajuanRutin', [
            'data' => $data,
            'role' => $user
        ]);

    }
public function create()
{
    $data = AuditRutin::all();
    $kodeAudit = KodeAudit::all();
    $unitkerja = User::where('role', 'unitkerja')->get();

    $role = auth()->user()->role;
    if ($role == 'admin') {
        $view = 'admin.pelaporanrutin.tambah_pelaporanRutin';
    }  else {
        $view = 'TimKeamananAudit.pelaporanrutin.tambah_pelaporanRutin';
    }

    return view($view, [
        'data' => $data,
        'kodeaudit' => $kodeAudit,
        'unitkerjas' => $unitkerja
    ]);
}
    public function getAuditDetail(Request $request)
    {
        $audit = AuditRutin::where('pelaporan_rutin_id', $request->pelaporan_rutin_id)->first();

        return response()->json($audit);
    }

    public function getDataAudit(Request $request){
        $audit = AuditRutin::where('pelaporan_rutin_id', $request->pelaporan_rutin_id)->get();
        return response()->json($audit);
    }
    public function getData($kode, $id){

    if (auth()->user()->role == "unitkerja") {
    $query = DB::table('audit_rutins')
               ->join('users', 'audit_rutins.unitkerja_id', '=', 'users.id')
               ->where('audit_rutins.kode_audit', $kode)->where('audit_rutins.unitkerja_id', auth()->user()->id)
               ->select('audit_rutins.*', 'users.username');
               $audit = $query->get();
                return response()->json($audit);
    }else if (auth()->user()->role == "pimpinan") {
        $query = DB::table('audit_rutins')
           ->join('users', 'audit_rutins.unitkerja_id', '=', 'users.unitkerja_id')
           ->where('audit_rutins.kode_audit', $kode)
           ->where('audit_rutins.unitkerja_id', auth()->user()->unitkerja_id)
           ->select('audit_rutins.*', 'users.username');

            $audit = $query->get();
            $user = User::where('id', auth()->user()->unitkerja_id)->get();
            return response()->json([
                'audit' => $audit,
                'user' => $user,
            ]);
    }else{
         $query = DB::table('audit_rutins')
               ->join('users', 'audit_rutins.unitkerja_id', '=', 'users.id')
               ->where('audit_rutins.kode_audit', $kode)->where('audit_rutins.unitkerja_id', $id)
               ->select('audit_rutins.*', 'users.username');
               $audit = $query->get();
                return response()->json($audit);
    }



    }

    public function getSistem($id){
        $sistem = $sistem = AuditRutin::with('kodeaudit')
    ->select('audit_rutins.kode_audit')
    ->where('unitkerja_id', $id)
    ->groupBy('kode_audit')
    ->get();

        return response($sistem);
    }


public function proses(Request $request, $pelaporan_rutin_id)
{
    try {
        // Ambil data dengan kode terbaru berdasarkan tanggal
        $penindakrutin = AuditRutin::where('pelaporan_rutin_id', $pelaporan_rutin_id)
                                    ->orderBy('created_at', 'desc') // Urutkan berdasarkan tanggal terbaru
                                    ->first();

        if (!$penindakrutin) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }
        $penindakrutin->update(['status' => 'terproses']);

        return response()->json(['success' => 'Data berhasil diproses']);
    } catch (\Exception $e) {
        Log::error("Error processing data: " . $e->getMessage());
        return response()->json(['error' => 'Terjadi kesalahan saat memproses data'], 500);
    }
}

    public function store(Request $request)
    {
        $user = auth()->user();

        $data = $request->validate([
            'tanggal_audit' => 'date',
            'nama_sistem' => 'string',
            'versi' => 'string',
            'bahasa_pemrograman' => 'string',
            'framework' => 'string',
            'maksimum_penyimpanan' => 'string',
            'maksimum_pengguna' => 'string',
            'keamanan_sistem' => 'string',
            'pengguna_sistem' => 'string',
        ]);


        $data['user_id'] = $user->id;
        $data['pelaporan_rutin_id'] = $this->generateUniqueId($user->role);

        // dd($data);

        AuditRutin::create($data);

        return redirect()->route('pelaporan-rutin.pelaporan')->with('suksestambah', 'Data berhasil ditambah');
    }

    public function storeProses(Request $request)
{
    $user = auth()->user();

        $data = $request->validate([
            'pelaporan_rutin_id' => '',
            'tanggal_audit' => 'date',
            'nama_sistem' => 'string',
            'versi' => 'string',
            'bahasa_pemrograman' => 'string',
            'framework' => 'string',
            'maksimum_penyimpanan' => 'string',
            'maksimum_pengguna' => 'string',
            'keamanan_sistem' => 'string',
            'pengguna_sistem' => 'string',
        ]);


        $data['user_id'] = $user->id;

        AuditRutin::create($data);

    return redirect()->route('pelaporan-rutin.pelaporan')->with('suksessimpan', 'Data berhasil disimpan!');
}

    public function update(Request $request, $pelaporan_rutin_id)
{
    $user = auth()->user();
    $penindakrutin = AuditRutin::where('pelaporan_rutin_id', $pelaporan_rutin_id)->first();

    // Jika data tidak ditemukan, berikan respons error atau handle sesuai kebutuhan aplikasi Anda
    if (!$penindakrutin) {
        return redirect()->route('pelaporan-rutin.pelaporan')->with('error', 'Data tidak ditemukan');
    }

    // Validasi data dari request
    $data = $request->validate([
        'tanggal_audit' => 'date',
        'nama_sistem' => 'string',
        'versi' => 'string',
        'bahasa_pemrograman' => 'string',
        'framework' => 'string',
        'maksimum_penyimpanan' => 'string',
        'maksimum_pengguna' => 'string',
        'keamanan_sistem' => 'string',
        'pengguna_sistem' => 'string',
    ]);

    // Tambahkan user_id ke data yang akan diupdate
    $data['user_id'] = $user->id;

    // Update data AuditRutin
    try {
        $penindakrutin->update($data);
    } catch (\Exception $e) {
        // Tangani jika terjadi kesalahan saat melakukan update
        return redirect()->route('pelaporan-rutin.pelaporan')->with('error', 'Gagal memperbarui data');
    }

    return redirect()->route('pelaporan-rutin.pelaporan')->with('suksesedit', 'Data berhasil diperbarui');
}

    private function generateUniqueId($role)
    {
        $prefix = strtoupper($role);
        $count = AuditRutin::where('pelaporan_rutin_id', 'like', "$prefix-%")->count() + 1;
        $letters = range('A', 'Z');
        $letterIndex = intdiv($count - 1, 99); // 99 because we're using 'A01' to 'A99'
        $number = ($count - 1) % 99 + 1;

        if ($letterIndex >= count($letters)) {
            throw new \Exception('Identifier space exhausted.'); // Handle this appropriately
        }

        $letter = $letters[$letterIndex];
        $uniqueId = $letter . str_pad($number, 2, '0', STR_PAD_LEFT); // E.g., A01, A02, ..., B01, B02, ..., Z99

        return $prefix . '-' . $uniqueId;
    }
}
