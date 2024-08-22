<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelaporanRutinController;
use App\Http\Controllers\PelaporanInsidentalController;
use App\Http\Controllers\HasilAuditRutinController;
use App\Http\Controllers\HasilAuditInsidentalController;
use App\Http\Controllers\AuditInsidentalController;
use App\Http\Controllers\AuditRutinController;
use App\Http\Controllers\AuditRutinPenindakanController;
use App\Http\Controllers\KodeAuditController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\ProfileController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
});

// Route::get('login', [AuthController::class,"index"])->name('login.index');

// Route::post('login', [AuthController::class,"authenticate"])->name('login.post');
// Route::post('logout', [AuthController::class,"logout"])->name('logout.post');

// Route::get('dashboard', [DashboardController::class,"index"])->name('dashboard.index');
// Route::get('audtRutin', [AuditRutinController::class,"index"])->name('auditRutin.index');
// Route::get('auditInsidental', [AuditInsidentalController::class,"index"])->name('auditInsidental.index');


// Route::resource('pelaporan-rutin', PelaporanRutinController::class);

// Route::resource('pelaporan-insidental', PelaporanInsidentalController::class);



Route::get('/', [AuthController::class, 'index'])->name('login');
Route::get('login', [AuthController::class, 'index'])->name('login');

Route::get('register', [AuthController::class, 'viewRegister'])->name('register.view');


Route::group(['prefix' => 'auth'], function () {
    // Auth
    Route::post('login', [AuthController::class, 'authenticate'])->name('login.post');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout.post');
    Route::post('register', [AuthController::class, 'register'])->name('register.post');
    Route::get('user', [AuthController::class, 'me']);


    // admin
    Route::get('auditinsidental-admin', [AuditInsidentalController::class, 'index'])->name('admin-auditinsidental');
    Route::get('hasilauditinsidental-admin', [HasilAuditInsidentalController::class, 'index'])->name('admin-hasilauditinsidental');
    Route::get('hasilauditinsidental-admin-getData/{id}', [HasilAuditInsidentalController::class, 'getData'])->name('hasil-audit-insidental.getData');
    Route::get('dashboard', [DashboardController::class,"index"])->name('dashboard.index');
    Route::get('user', [UserController::class, 'index'])->name('user');
    Route::post('user', [UserController::class, 'store'])->name('tambah-user');
    Route::post('activateUser/{id}' , [UserController::class, 'activate'])->name('users.activate');
    Route::post('deactivateUser/{id}' , [UserController::class, 'deactivate'])->name('users.deactivate');
    Route::put('changeStatusUser/{id}', [UserController::class, 'changeStatus'])->name('users.changeStatus');
    // Route::get('edituser/{id}', [UserController::class, 'edit'])->name('edit-user');
    // Route::put('updateuser/{id}', [UserController::class, 'update'])->name('update-user');
    // Route::get('detailuser/{id}', [UserController::class, 'detail'])->name('detail-user');
    Route::get('getdatauser/{id}', [UserController::class, 'getdatauser'])->name('getdatauser');
    Route::put('getdatauser/update/{id}', [UserController::class, 'getdatauserupdate'])->name('getdatauser.update');
    Route::delete('hapususer/{id}', [UserController::class, 'destroy'])->name('hapus-user');
    Route::put('changePassword/{id}', [UserController::class, 'changePassword'])->name('ubahPassword');
    Route::get('dashboard-admin', [DashboardController::class, 'index'])->name('dashboard-admin');


    // pimpinan
    Route::get('dashboard-pimpinan', [DashboardController::class, "pimpinan"])->name('pimpinan.dashboard');
        Route::get('dashboard-rektor', [DashboardController::class, 'rektor'])->name('dashboard-rektor');
    Route::get('auditinsidental-pimpinan', [AuditInsidentalController::class, 'penindakan'])->name('pimpinan-auditinsidental');
    Route::get('hasilauditinsidental-pimpinan', [HasilAuditInsidentalController::class, 'index'])->name('pimpinan-hasilauditinsidental');
    Route::get('hasilauditinsidental-unitkerja', [HasilAuditInsidentalController::class, 'index'])->name('unitkerja-hasilauditinsidental');
    Route::get('pelaporan-rutin-pimpinan', [PelaporanRutinController::class,"index"])->name('pimpinan-pelaporanauditrutin');
    Route::get('pelaporan-insidental-pimpinan', [PelaporanInsidentalController::class,"index"])->name('pimpinan-pelaporanauditinsidental');
    Route::get('dashboard-user', [DashboardController::class, 'pimpinan'])->name('dashboard-pimpinan');


    // audit
    Route::get('audtRutin', [AuditRutinController::class,"index"])->name('auditRutin.index');
    Route::get('auth/dashboard-audit', [DashboardController::class, 'audit'])->name('dashboard-audit');
    Route::get('hasil-insidental', [HasilAuditInsidentalController::class,"index"])->name('hasil-insidental.index');
    Route::get('penerimaan-insidental', [AuditInsidentalController::class,"index"])->name('penerimaan-insidental.insidentalpenerimaan');
    Route::get('penindakan-insidental', [AuditInsidentalController::class,"penindakan"])->name('penindakan-insidental.penindakan');
    Route::get('audit-rutinhasil', [HasilAuditRutinController::class, "index"])->name("hasil-rutin.hasilrutin");
    Route::get('penindakan-insidental/create', [AuditInsidentalController::class,"create"])->name('penindakan-insidental.create');
    Route::post('ckeditor/upload', [ImageUploadController::class, 'upload'])->name('ckeditor.upload');
    Route::get('datasistem', [KodeAuditController::class, 'datasistem'])->name('datasistem');
    // penerimaan audit rutin
    Route::get('penerimaan-rutin', [AuditRutinController::class,"index"])->name('penerimaan-rutin.index');
    Route::get('auditinsidental-unitkerja', [PelaporanInsidentalController::class, 'index'])->name('unitkerja-auditinsidental');
    // penindakan audit rutin
    Route::get('penindakan-rutin', [AuditRutinPenindakanController::class,"index"])->name('penindakan-rutin.penindakan')->middleware('auth');
    Route::get('audit-rutin', [HasilAuditRutinController::class,"index"])->name('hasil-rutin.hasil')->middleware('auth');
    Route::get('tambah-penindakan-audit-rutin', [AuditRutinPenindakanController::class, "show"])->name("tambah-penindakan-rutin")->middleware('auth');
    Route::get('data-penindakan-audit-rutin/{id}', [AuditRutinPenindakanController::class, 'getAudit'])->name("getAudit");
    Route::get('penindakan-audit-rutin-get/{id}', [AuditRutinPenindakanController::class, "getData"])->name("penindakan-rutin.getData");
    Route::post('penindakan-audit-rutin/tambah', [AuditRutinPenindakanController::class, "store"])->name("tambahAuditRutin");
    Route::put('penidnakan-audit-rutin/update/{kode}', [AuditRutinPenindakanController::class, "update"])->name("penindakan-rutin.update");
    Route::delete('penindakan-audit-rutin/destroy/{kode}', [AuditRutinPenindakanController::class, "destroy"])->name("penindakan-rutin.destroy");
    Route::get('penindakan-rutin/create', [AuditRutinController::class,"create"])->name('penindakan-rutin.create');
    Route::get('penindakan-rutin/detail', [AuditRutinController::class,"getAuditDetail"])->name('penindakan-rutin.getAuditDetail');
    Route::get('penindakan-rutin/getDataAudit', [AuditRutinController::class,"getDataAudit"])->name('penindakan-rutin.getDataAudit');
    Route::post('penindakan-rutin/proses/{pelaporan_rutin_id}', [AuditRutinController::class, "proses"])->name('penindakan-rutin.proses');
    Route::post('/penindakan-rutin/storeProses', [AuditRutinController::class, 'storeProses'])->name('penindakan-rutin.storeProses');
    Route::post('penindakan-rutin/tambah-versi', [AuditRutinController::class, 'storeProses'])->name('penindakan-rutin.tambah-versi');
    Route::post('penindakan-rutin/printSelected', [AuditRutinController::class, 'printSelected'])->name('penindakan-rutin.printSelected');
    Route::get('penindakan-rutin/printPDF', [AuditRutinController::class, 'printPDF'])->name('penindakan-rutin.printPDF');
    // penindakan audit insidental
    Route::get('penindakan-audit-insidental/{kode}', [AuditInsidentalController::class, "show"])->name("penindakan-insidental.show")->middleware('auth');
    Route::get('data-penindakan-audit-insidental/{id}', [AuditInsidentalController::class, 'getAudit'])->name("getAuditInsidental");
        Route::put('penidnakan-audit-insidental/update/{kode}', [AuditInsidentalController::class, "perbarui"])->name("penindakan-insidental.update");
    Route::post('penindakan-audit-insidental', [AuditInsidentalController::class, "store"])->name("penindakan-insidental.store")->middleware('auth');
    // Update status pengajuan
    Route::put('pengajuan-rutin-updatestatus', [PelaporanRutinController::class, 'updateStatus'])->name('pengajuanRutin.updateStatus');
    Route::put('pengajuan-insidental-updatestatus', [PelaporanInsidentalController::class, 'updateStatus'])->name('pengajuanInsidental.updateStatus');
    // hapus pengajuan ditolak
    Route::get('pengajuan-rutin-ditolak', [PelaporanRutinController::class, 'alasanDitolak'])->name('pengajuanRutin.alasantolak');
    Route::delete('pengajuan-rutin-hapus', [PelaporanRutinController::class, 'hapusPengajuan'])->name('pengajuanRutin.hapus');
    Route::delete('pengajuan-insidental-hapus', [PelaporanInsidentalController::class, 'hapusPengajuan'])->name('pengajuanInsidental.hapus');
    Route::get('pengajuan-insidental-ditolak', [PelaporanInsidentalController::class, 'alasanDitolak'])->name('pengajuanInsidental.alasantolak');

    // Unitkerja
    Route::get('dashboard-unitkerja', [DashboardController::class, 'unitkerja'])->name('dashboard-unitkerja');

    // Pelaporan Unit Kerja
    Route::get('pelaporan-rutin', [PelaporanRutinController::class,"index"])->name('pelaporan-rutin.index');
    Route::post('pelaporan-rutin/store', [PelaporanRutinController::class,"store"])->name('pelaporan-rutin.store');
    Route::get('pelaporan-rutin/create', [PelaporanRutinController::class,"create"])->name('pelaporan-rutin.create');
    Route::get('/pelaporan-rutin/edit/{id}', [PelaporanRutinController::class,"edit"])->name('pelaporan-rutin.edit');
    Route::put('pelaporan-rutin/update/{id}', [PelaporanRutinController::class, 'update'])->name('pelaporan-rutin.update');
    Route::delete('pelaporan-rutin/delete/{id}', [PelaporanRutinController::class, "delete"])->name('pelaporan-rutin.delete');
    Route::get('pelaporan-rutin/profile', [ProfileController::class, "profile"])->name('pelaporan-rutin.profile');
    Route::get('pelaporan-insidental', [PelaporanInsidentalController::class,"index"])->name('pelaporan-insidental.index');
    Route::get('pelaporan-insidental/create', [PelaporanInsidentalController::class,"create"])->name('pelaporan-insidental.create');
    Route::post('pelaporan-insidental/store', [PelaporanInsidentalController::class,"store"])->name('pelaporan-insidental.store');
    Route::get('pelaporan-insidental/edit/{id}', [PelaporanInsidentalController::class,"edit"])->name('pelaporan-insidental.edit');
    Route::put('pelaporan-insidental/update/{id}', [PelaporanInsidentalController::class, 'update'])->name('pelaporan-insidental.update');
    Route::delete('pelaporan-insidental/delete/{id}', [PelaporanInsidentalController::class, "delete"])->name('pelaporan-insidental.delete');

    // rektor
    Route::get('rektor/profile', [ProfileController::class, "profile"])->name('rektor.profile');



    // kode Sistem Audit
    Route::get('audit-code', [KodeAuditController::class,"index"])->name('audit-code.index');
    Route::get('audit-code/create', [KodeAuditController::class,"create"])->name('audit-code.create');
    Route::get('audit-code/edit/{id}', [KodeAuditController::class,"edit"])->name('audit-code.edit');
    Route::post('audit-code/store', [KodeAuditController::class,"store"])->name('audit-code.store');
    Route::put('audit-code/update/{id}', [KodeAuditController::class, 'update'])->name('audit-code.update');
    Route::delete('audit-code/delete/{id}', [KodeAuditController::class, "delete"])->name('audit-code.delete');

    //hasil audit
    Route::put('audit-rutin/update/{kode}', [HasilAuditRutinController::class, "update"])->name("hasil-rutin.update");
    Route::delete('audit-rutin/destroy/{kode}', [HasilAuditRutinController::class, "destroy"])->name("audit-rutin.destroy");
    // ajax
    Route::get('hasil-rutin.hasil', [HasilAuditRutinController::class, "index"])->name("hasil-rutin.hasil");
    Route::get('audit-rutin-get/{id}', [HasilAuditRutinController::class, "getData"])->name("hasil-rutin.getData");
    Route::get('audit-rutin-get-byfilter/{id}/{unitkerja}/{dari}/{sampai}', [HasilAuditRutinController::class, "getDataByFilter"])->name("hasil-rutin.getByFilter");
    // sistem kode audit
    Route::get('audit-rutin-kode/{id}', [KodeAuditController::class, "getData"])->name("audit-rutin-kode.getData");
    Route::get('/hasil-rutin-sistem/{unitkerja}', [AuditRutinController::class, "getSistem"])->name("hasil-audit-rutin.getSistem");
    Route::get('hasil-rutin-kode/{id}/{unitkerja}', [AuditRutinController::class, "getData"])->name("hasil-audit-rutin.getData");
    Route::post('audit-rutin-kode/tambah', [KodeAuditController::class, "store"])->name("audit-rutin-kode.store");
    Route::put('audit-rutin-kode/update/{kode}', [KodeAuditController::class, "update"])->name("audit-rutin-kode.update");
    Route::delete('audit-rutin-kode/destroy/{kode}', [KodeAuditController::class, "destroy"])->name("audit-rutin-kode.destroy");
    Route::delete('audit-insidental/destroy/{kode}', [AuditInsidentalController::class, "destroy"])->name("audit-insidental.destroy");
    Route::put('audit-insidental/update/{kode}', [AuditInsidentalController::class, "update"])->name("audit-insidental.update");

    Route::get('/hasil-insidental-sistem/{unitkerja}', [AuditInsidentalController::class, "getSistem"])->name("hasil-audit-rutin.getSistem");
    Route::get('/audit-insidental-get/{id}', [AuditInsidentalController::class, "getData"])->name("audit-insidental.getData");
    Route::get('audit-insidental-ambil/{id}/{unitkerja}', [HasilAuditInsidentalController::class, "getData"])->name("audit-insidental.ambil");
    Route::get('audit-insidental-get-byfilter/{id}/{unitkerja}/{dari}/{sampai}', [AuditInsidentalController::class, "getDataByFilter"])->name("hasil-insidental.getByFilter");

    // Hasil audit
    Route::get('/hasil-audit-unitkerja/{unitkerja}', [HasilAuditRutinController::class, 'getAuditByUnitkerja'])->name('hasil-rutin-byUnitkerja');
    Route::get('/hasil-audit-insidental-unitkerja/{unitkerja}', [AuditInsidentalController::class, 'getAuditByUnitkerja'])->name('hasil-insidental-byUnitkerja');
    Route::get('/hasil-audit-insidental-get/', [AuditInsidentalController::class, 'getAuditInsidentalGet'])->name('hasil-insidental-get');
    Route::get('/hasil-audit-rutin-get/', [HasilAuditRutinController::class, 'getAuditInsidentalGet'])->name('hasil-insidental-get');
});
