<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SurveyorController;
use App\Http\Controllers\ReviewerController;
use App\Http\Controllers\EdpController;
use App\Http\Controllers\ITController;
use App\Http\Controllers\AdminController;


// Login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/', function () {
    return redirect()->route('login.form');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');

Route::post('/login', [AuthController::class, 'login'])->name('login');


// Register
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');

Route::post('/register', [AuthController::class, 'register'])->name('register.store');


// Dashboard (hanya bisa diakses setelah login)
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth');


// Profile
Route::get('/profile', function () {
    return view('/profile/profile');
})->name('profile')->middleware('auth');



// ------------------------------------------------------------------------------------------------------------------------- //

// ingat nama 'admin' itu divisi

// Superadmin

Route::get('/superadmin/dashboard', function () {
    return view('superadmin.dashboard');
})->name('superadmin.dashboard')->middleware('auth');


// Divisi Admin di Superadmin

Route::get('/superadmin/admin', function () {
    $jumlahProposal = \App\Models\Proposal::count();
    return view('superadmin.divisiAdmin', compact('jumlahProposal'));
})->name('superadmin.admin')->middleware('auth');

Route::get('/superadmin/admin/superadmin-proposal', [\App\Http\Controllers\AdminController::class, 'SAproposal'])->name('superadmin.admin.SAproposal');
Route::post('/superadmin/admin/superadmin-proposal/store', [AdminController::class, 'storeProposal'])->name('superadmin.admin.SAproposal.store');
Route::post('/superadmin/admin/superadmin-proposal/update-status/{id}', 
    [App\Http\Controllers\AdminController::class, 'updateStatus']
);

Route::get('/superadmin/admin/superadmin-adendum', [\App\Http\Controllers\AdminController::class, 'SAadendum'])->name('superadmin.admin.SAadendum');
Route::post('/superadmin/admin/superadmin-adendum/store', [\App\Http\Controllers\AdminController::class, 'storeAdendum'])->name('superadmin.admin.SAadendum.store');
Route::post('/superadmin/admin/superadmin-adendum/update-status/{id}', 
    [App\Http\Controllers\AdminController::class, 'updateStatus']
);

Route::get('/superadmin/admin/surat-tugas', [AdminController::class, 'SAsuratTugas'])->name('superadmin.admin.SAsuratTugas');
Route::post('/superadmin/admin/surat-tugas/store', [AdminController::class, 'storeSuratTugas'])->name('superadmin.admin.SAsuratTugas.store');

Route::get('/superadmin/admin/superadmin-draftResume', [\App\Http\Controllers\AdminController::class, 'SAdraftResume'])->name('superadmin.admin.SAdraftResume');
Route::post('/superadmin/admin/superadmin-draftResume/store', [\App\Http\Controllers\AdminController::class, 'SAdraftResumeStore'])->name('superadmin.admin.SAdraftResume.store');
Route::post('/superadmin/admin/superadmin-draftResume/update-status/{id}', 
    [AdminController::class, 'updateStatusSAdraftResume']
)->name('superadmin.admin.SAdraftResume.updateStatus');

Route::get('/superadmin/admin/draftLaporan', [\App\Http\Controllers\AdminController::class, 'SAdraftLaporan'])->name('superadmin.admin.SAdraftLaporan');
Route::post('/superadmin/admin/draftLaporan/store',[AdminController::class, 'storeSAdraftLaporan'])->name('superadmin.admin.SAdraftLaporan.store');
Route::post('/superadmin/admin/draftlaporan/update-status/{id}',[AdminController::class, 'updateDraftStatus']);

Route::get('/superadmin/admin/laporan-final', [\App\Http\Controllers\AdminController::class, 'SAlaporanFinal'])->name('superadmin.admin.SAlaporanFinal');
Route::post('/superadmin/admin/laporan-final/store',[AdminController::class, 'storeSAlaporanFinal'])->name('superadmin.admin.SAlaporanFinal.store');



// Surveyor di Superadmin

Route::get('/superadmin/surveyor', function () {
    return view('superadmin.surveyorAdmin');
})->name('superadmin.surveyor')->middleware('auth');
Route::get(
    '/superadmin/admin/lokasi-survei',
    [SurveyorController::class, 'lokasiSurveiAdmin']
)->name('superadmin.admin.SAlokasiSurvei');
Route::post(
    '/superadmin/admin/lokasi-survei/store',
    [SurveyorController::class, 'storeLokasiSurveiAdmin']
)->name('superadmin.admin.SAlokasiSurvei.store');
Route::post(
    '/superadmin/admin/lokasi-survei/update-status/{id}',
    [SurveyorController::class, 'updateStatusAdmin']
)->name('superadmin.admin.SAlokasiSurvei.updateStatus');
Route::get('/surveyor/lokasisurvei', [SurveyorController::class, 'lokasiSurvei'])->name('surveyor.lokasisurvei');
Route::get('/superadmin/admin/update-proyek',
    [SurveyorController::class, 'updateProyekAdmin']
)->name('superadmin.admin.SAupdateProyek');
Route::post('/superadmin/admin/update-proyek/store',
    [SurveyorController::class, 'storeProyek']
)->name('superadmin.admin.SAupdateProyek.store');
// EDP di Superadmin

Route::get('/superadmin/edp', function () {
    return view('superadmin.edpAdmin');
})->name('superadmin.edp')->middleware('auth');

Route::get('/superadmin/edp/data-aktif', [\App\Http\Controllers\EdpController::class, 'SAdataAktif'])->name('superadmin.edp.SAdataAktif');
Route::post('/superadmin/edp/data-aktif/store', [\App\Http\Controllers\EdpController::class, 'storeDataAktif'])->name('superadmin.edp.storeDataAktif');


// Reviewer di Superadmin

Route::get('/superadmin/reviewer', function () {
    return view('superadmin.reviewerAdmin');
})->name('superadmin.reviewer')->middleware('auth');


// Finance di Superadmin

Route::get('/superadmin/finance', function () {
    return view('superadmin.financeAdmin');
})->name('superadmin.finance')->middleware('auth');


// IT di Superadmin

Route::get('/superadmin/it', function () {
    return view('superadmin.itAdmin');
})->name('superadmin.it')->middleware('auth');


// ------------------------------------------------------------------------------------------------------------------------- //


// Divisi Admin

Route::get('/admin', function () {
    $jumlahProposal = \App\Models\Proposal::count();
    return view('layouts.admin', compact('jumlahProposal'));
})->name('admin')->middleware('auth');

Route::get('/admin/surat-tugas', 
    [AdminController::class, 'suratTugasAdmin']
)->name('admin.suratTugas');

Route::get('/admin/proposal', [\App\Http\Controllers\AdminController::class, 'proposal'])->name('admin.proposal');
Route::post('/admin/proposal/store', [AdminController::class, 'storeProposal'])->name('admin.proposal.store');
Route::post('/admin/proposal/update-status/{id}', 
    [App\Http\Controllers\AdminController::class, 'updateStatus']
);

Route::get('/admin/adendum', [\App\Http\Controllers\AdminController::class, 'adendum'])->name('admin.adendum');

Route::get('/admin/draftResume', [\App\Http\Controllers\AdminController::class, 'draftResume'])->name('admin.draftResume');

Route::get('/admin/draftLaporan', [\App\Http\Controllers\AdminController::class, 'draftLaporan'])->name('admin.draftLaporan');

Route::get('/admin/laporan-final', [AdminController::class, 'laporanFinal'])->name('admin.laporanFinal');

Route::get('/admin/tim', [AdminController::class, 'tim'])->name('admin.tim');


// Surveyor
Route::get('/surveyor', function () {
    return view('layouts.surveyor');
})->name('surveyor');

Route::get('/surveyor/lokasisurvei', [\App\Http\Controllers\SurveyorController::class, 'lokasisurvei'])->name('surveyor.lokasisurvei');

Route::get('/surveyor/tim', [\App\Http\Controllers\SurveyorController::class, 'tim'])->name('surveyor.tim');

Route::get('/surveyor/update-proyek', [\App\Http\Controllers\SurveyorController::class, 'updateProyekUser'])->name('surveyor.updateProyek');

Route::get('/surveyor/workingpaper', [\App\Http\Controllers\SurveyorController::class, 'workingPaper'])->name('surveyor.workingpaper');

Route::get('/surveyor/laporan-penilaian', [SurveyorController::class, 'laporanPenilaian'])->name('surveyor.laporanPenilaian');

Route::get('/surveyor/working-paper', [SurveyorController::class, 'workingPaper'])->name('surveyor.workingpaper');


// EDP
Route::get('/edp', function () {
    return view('layouts.edp');
})->name('edp');

Route::get('/edp/staff', [EdpController::class, 'staff'])->name('edp.staff');

    //seharusnya data mentah ini diganti jadi dokumen final, tapi jadi kubuat rute baru untuk dokuem final ehe, ini disini untuk jaga2 aja
Route::get('/edp/datamentah', [\App\Http\Controllers\EDPController::class, 'dataMentah'])->name('edp.dataMentah');

Route::post('/edp/datamentah/upload', [\App\Http\Controllers\EDPController::class, 'uploadData'])->name('edp.uploadData');

Route::get('/edp/data-aktif', [\App\Http\Controllers\EdpController::class, 'dataAktif'])->name('edp.dataAktif');

Route::get('/edp/dokumen-final', [\App\Http\Controllers\EdpController::class, 'dokumenFinal'])->name('edp.dokumenFinal');

Route::post('/edp/dokumen-final/upload', [\App\Http\Controllers\EdpController::class, 'uploadDokumenFinal'])->name('edp.uploadDokumenFinal');

Route::delete('/edp/dokumen-final/delete/{filename}', [\App\Http\Controllers\EdpController::class, 'deleteDokumenFinal'])->name('edp.deleteDokumenFinal');


// Reviewer
Route::get('/reviewer', function () {
    return view('layouts.reviewer');
})->name('reviewer');

Route::get('/reviewer/tim', [\App\Http\Controllers\ReviewerController::class, 'tim'])->name('reviewer.tim');

Route::get('/reviewer/dokumen-revisi', [\App\Http\Controllers\ReviewerController::class, 'dokumenRevisi'])->name('reviewer.dokumenRevisi');

Route::get('/reviewer/dokumen-final', [\App\Http\Controllers\ReviewerController::class, 'dokumenFinal'])->name('reviewer.dokumenFinal');


// Finance
Route::get('/finance', function () {
    return view('layouts.finance');
})->name('finance');


// IT
Route::get('/it', function () {
    return view('layouts.it');
})->name('it');

Route::get('/it/form-peminjaman', [ITController::class, 'formPeminjaman'])
     ->name('it.formpeminjaman');

Route::get('/it/laporan-penilaian', [ITController::class,'laporanpenilaian'])
     ->name('it.laporanpenilaian');

Route::get('/it/aset', [\App\Http\Controllers\ITController::class, 'aset'])->name('it.aset');

Route::get('/it/server', [\App\Http\Controllers\ITController::class, 'server'])->name('it.server');

Route::get('/it/formpeminjaman', [\App\Http\Controllers\ITController::class, 'formPeminjaman'])->name('it.formpeminjaman');

Route::get('/it/total-komputer', [\App\Http\Controllers\ItController::class, 'totalKomputer'])->name('it.totalKomputer');

Route::get('/it/total-laptop', [\App\Http\Controllers\ItController::class, 'totalLaptop'])->name('it.totalLaptop');

Route::get('/it/laporan-penilaian', [\App\Http\Controllers\ItController::class, 'laporanPenilaian'])->name('it.laporanPenilaian');

Route::get('/it/upload-form', [ITController::class, 'uploadFormPage'])->name('it.uploadForm');

Route::post('/it/upload-form', [ITController::class, 'uploadFormStore'])->name('it.uploadForm.store');

Route::get('/it/tim', [App\Http\Controllers\ITController::class, 'tim'])->name('it.tim');






// Logout
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('login.form');
})->name('logout');