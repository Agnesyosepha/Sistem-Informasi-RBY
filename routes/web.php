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
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\ProfileController;

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
Route::post('/superadmin/admin/superadmin-proposal/update-status/{id}', [App\Http\Controllers\AdminController::class, 'updateStatus']);
Route::delete('/superadmin/admin/proposal/{id}', [AdminController::class, 'destroy'])->name('superadmin.admin.SAproposal.destroy');

Route::get('/superadmin/admin/superadmin-adendum', [\App\Http\Controllers\AdminController::class, 'SAadendum'])->name('superadmin.admin.SAadendum');
Route::post('/superadmin/admin/superadmin-adendum/store', [\App\Http\Controllers\AdminController::class, 'storeAdendum'])->name('superadmin.admin.SAadendum.store');
Route::post('/superadmin/admin/superadmin-adendum/update-status/{id}', [App\Http\Controllers\AdminController::class, 'updateStatusAdendum'])->name('superadmin.admin.SAadendum.updateStatus');

Route::get('/superadmin/admin/surat-tugas', [AdminController::class, 'SAsuratTugas'])->name('superadmin.admin.SAsuratTugas');
Route::post('/superadmin/admin/surat-tugas/store', [AdminController::class, 'storeSuratTugas'])->name('superadmin.admin.SAsuratTugas.store');
Route::post('/superadmin/admin/surat-tugas/update-status/{id}', [App\Http\Controllers\AdminController::class, 'updateSuratTugas'])->name('superadmin.admin.SAsuratTugas.updateStatus');

Route::get('/superadmin/admin/superadmin-draftResume', [\App\Http\Controllers\AdminController::class, 'SAdraftResume'])->name('superadmin.admin.SAdraftResume');
Route::post('/superadmin/admin/superadmin-draftResume/store', [\App\Http\Controllers\AdminController::class, 'SAdraftResumeStore'])->name('superadmin.admin.SAdraftResume.store');
Route::post('/superadmin/admin/superadmin-draftResume/update-status/{id}', [App\Http\Controllers\AdminController::class, 'updateStatusDraftResume'])->name('superadmin.admin.SAdraftResume.updateStatus');

Route::get('/superadmin/admin/draftLaporan', [\App\Http\Controllers\AdminController::class, 'SAdraftLaporan'])->name('superadmin.admin.SAdraftLaporan');
Route::post('/superadmin/admin/draftLaporan/store',[AdminController::class, 'storeSAdraftLaporan'])->name('superadmin.admin.SAdraftLaporan.store');
Route::post('/superadmin/admin/draftlaporan/update-status/{id}',[AdminController::class, 'updateDraftStatus']);

Route::get('/superadmin/admin/laporan-final', [\App\Http\Controllers\AdminController::class, 'SAlaporanFinal'])->name('superadmin.admin.SAlaporanFinal');
Route::post('/superadmin/admin/laporan-final/store',[AdminController::class, 'storeSAlaporanFinal'])->name('superadmin.admin.SAlaporanFinal.store');
Route::post('/superadmin/admin/laporan-final/update/{id}',[AdminController::class, 'updateLaporanFinal'])->name('superadmin.admin.updateSAlaporanFinal');

Route::get('/superadmin/admin/tugas-harian', [\App\Http\Controllers\AdminController::class, 'SAtugasHarian'])->name('superadmin.admin.SAtugasHarian');
Route::post('/superadmin/admin/tugas-harian/store', [AdminController::class, 'storeSAtugasHarian'])->name('superadmin.admin.SAtugasHarian.store');
Route::post('/superadmin/admin/tugas-harian/update-status/{id}', [App\Http\Controllers\AdminController::class, 'updateStatusTugas'])->name('superadmin.admin.SAtugasHarian.updateStatusTugas');
Route::delete('/superadmin/admin/tugas-harian/{id}', [AdminController::class, 'destroyTugas'])->name('superadmin.admin.SAtugasHarian.destroyTugas');



// Surveyor di Superadmin

Route::get('/superadmin/surveyor', function () {
    return view('superadmin.surveyorAdmin');})->name('superadmin.surveyor')->middleware('auth');
Route::get('/superadmin/admin/lokasi-survei',[SurveyorController::class, 'lokasiSurveiAdmin'])->name('superadmin.admin.SAlokasiSurvei');
Route::post('/superadmin/admin/lokasi-survei/store',[SurveyorController::class, 'storeLokasiSurveiAdmin'])->name('superadmin.admin.SAlokasiSurvei.store');
Route::post('/superadmin/admin/lokasi-survei/update-status/{id}',[SurveyorController::class, 'updateStatusAdmin'])->name('superadmin.admin.SAlokasiSurvei.updateStatus');
Route::get('/surveyor/lokasisurvei', [SurveyorController::class, 'lokasiSurvei'])->name('surveyor.lokasisurvei');

Route::get('/superadmin/admin/update-proyek',[SurveyorController::class, 'updateProyekAdmin'])->name('superadmin.admin.SAupdateProyek');
Route::post('/superadmin/admin/update-proyek/store',[SurveyorController::class, 'storeProyek'])->name('superadmin.admin.SAupdateProyek.store');

Route::get('/superadmin/laporan-penilaian', [SurveyorController::class, 'laporanPenilaianAdmin'])->name('superadmin.admin.SAlaporanpenilaianfinal');
Route::post('/superadmin/laporan-penilaian/store', [SurveyorController::class, 'storeLaporanPenilaian'])->name('superadmin.admin.SAlaporanpenilaianfinal.store');

Route::get('/superadmin/jadwal-surveyor', [SurveyorController::class, 'jadwalAdmin'])->name('superadmin.jadwal.index');
Route::post('/superadmin/jadwal-surveyor/store',[SurveyorController::class, 'storeJadwal'])->name('superadmin.jadwal.store');
Route::put('/superadmin/jadwal-surveyor/update/{id}',[SurveyorController::class, 'updateJadwal'])->name('superadmin.jadwal.update');
Route::delete('/superadmin/jadwal-surveyor/delete/{id}',[SurveyorController::class, 'deleteJadwal'])->name('superadmin.jadwal.delete');


// EDP di Superadmin

Route::get('/superadmin/edp', function () {
    return view('superadmin.edpAdmin');
})->name('superadmin.edp')->middleware('auth');

Route::get('/superadmin/edp/data-aktif', [\App\Http\Controllers\EdpController::class, 'SAdataAktif'])->name('superadmin.edp.SAdataAktif');
Route::post('/superadmin/edp/data-aktif/store', [\App\Http\Controllers\EdpController::class, 'storeDataAktif'])->name('superadmin.edp.storeDataAktif');

Route::get('/superadmin/edp/log-aktivitas', [\App\Http\Controllers\EdpController::class, 'SAlogEDP'])->name('superadmin.edp.SAlogEDP');
Route::post('/superadmin/edp/log-aktivitas/store', [\App\Http\Controllers\EdpController::class, 'storeLogEDP'])->name('superadmin.edp.storeLogEDP');
Route::put('/superadmin/edp/log-aktivitas/update/{id}',[EdpController::class, 'updateLogEDP'])->name('superadmin.edp.SAlogEDP.update');


// Reviewer di Superadmin

Route::get('/superadmin/reviewer', function () {
    return view('superadmin.reviewerAdmin');
})->name('superadmin.reviewer')->middleware('auth');

Route::get('/superadmin/reviewer/dokumen-revisi', [\App\Http\Controllers\ReviewerController::class, 'SAdokumenRevisi'])->name('superadmin.reviewer.SAdokumenRevisi');
Route::post('/superadmin/reviewer/dokumen-revisi/store', [\App\Http\Controllers\ReviewerController::class, 'storeDokumenRevisi'])->name('superadmin.reviewer.storeDokumenRevisi');

Route::get('/superadmin/reviewer/dokumen-final', [\App\Http\Controllers\ReviewerController::class, 'SAdokumenFinal'])->name('superadmin.reviewer.SAdokumenFinal');
Route::post('/superadmin/reviewer/dokumen-final/store', [\App\Http\Controllers\ReviewerController::class, 'storeDokumenFinal'])->name('reviewer.storeDokumenFinal');

Route::get('/superadmin/reviewer/log-aktivitas', [ReviewerController::class, 'SAlog'])->name('superadmin.reviewer.SAlog');

Route::post('/superadmin/reviewer/log-aktivitas/store', [ReviewerController::class, 'storeSAlog'])->name('superadmin.reviewer.storeLog');


// Finance di Superadmin

Route::get('/superadmin/finance', function () {
    return view('superadmin.financeAdmin');
})->name('superadmin.finance')->middleware('auth');

Route::get('/superadmin/finance/invoice', [FinanceController::class, 'SAinvoice'])->name('superadmin.finance.SAinvoice');
Route::post('/superadmin/finance/invoice/store',[FinanceController::class, 'storeInvoice'])->name('superadmin.finance.storeInvoice');
Route::post('/superadmin/finance/invoice/update-status', [FinanceController::class, 'updateStatus'])->name('superadmin.finance.updateStatus');


Route::get('/finance', [FinanceController::class, 'dashboard'])->name('finance.dashboard');

Route::get('/finance/tim', [FinanceController::class, 'tim'])->name('finance.tim');

Route::get('/superadmin/rab', [FinanceController::class, 'rabIndex'])
    ->name('superadmin.rab')
    ->middleware('auth');

Route::post('/superadmin/rab/store', [FinanceController::class, 'rabStore'])
    ->name('superadmin.rab.store')
    ->middleware('auth');

Route::get('/superadmin/rab/create', [FinanceController::class, 'rabCreate'])
    ->name('superadmin.rab.create')
    ->middleware('auth');

Route::get('/superadmin/rab/{id}/edit', [FinanceController::class, 'rabEdit'])
    ->name('superadmin.rab.edit')
    ->middleware('auth');

Route::post('/superadmin/rab/{id}/update', [FinanceController::class, 'rabUpdate'])
    ->name('superadmin.rab.update')
    ->middleware('auth');

Route::delete('/superadmin/rab/{id}/delete', [FinanceController::class, 'rabDelete'])
    ->name('superadmin.rab.delete')
    ->middleware('auth');

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

Route::post('/admin/tugas-harian/update-tahapan/{id}', [AdminController::class, 'updateTahapan'])->name('admin.tugas-harian.updateTahapan')->middleware('auth');
Route::post('/admin/tugas-harian/upload-file/{tugasId}/{tahapanId}', [App\Http\Controllers\AdminController::class, 'uploadFile'])->name('admin.tugas-harian.uploadFile')->middleware('auth');
Route::get('/admin/tugas-harian/download-file/{fileId}', [App\Http\Controllers\AdminController::class, 'downloadFile'])->name('admin.tugas-harian.downloadFile')->middleware('auth');

Route::get('/admin/surat-tugas', [AdminController::class, 'suratTugasAdmin'])->name('admin.suratTugas');

Route::get('/admin/proposal', [\App\Http\Controllers\AdminController::class, 'proposal'])->name('admin.proposal');
Route::post('/admin/proposal/store', [AdminController::class, 'storeProposal'])->name('admin.proposal.store');
Route::post('/admin/proposal/update-status/{id}', [App\Http\Controllers\AdminController::class, 'updateStatus']);

Route::get('/admin/adendum', [\App\Http\Controllers\AdminController::class, 'adendum'])->name('admin.adendum');

Route::get('/admin/draftResume', [\App\Http\Controllers\AdminController::class, 'draftResume'])->name('admin.draftResume');

Route::get('/admin/draftLaporan', [\App\Http\Controllers\AdminController::class, 'draftLaporan'])->name('admin.draftLaporan');

Route::get('/admin/laporan-final', [AdminController::class, 'laporanFinal'])->name('admin.laporanFinal');

Route::get('/admin/tim', [AdminController::class, 'tim'])->name('admin.tim');

Route::get('/admin', [AdminController::class, 'index'])->name('admin')->middleware('auth');


// Surveyor
Route::get('/surveyor', [SurveyorController::class, 'dashboard'])
    ->name('surveyor');

Route::get('/surveyor/lokasisurvei', [\App\Http\Controllers\SurveyorController::class, 'lokasisurvei'])->name('surveyor.lokasisurvei');

Route::get('/surveyor/tim', [\App\Http\Controllers\SurveyorController::class, 'tim'])->name('surveyor.tim');

Route::get('/surveyor/update-proyek', [\App\Http\Controllers\SurveyorController::class, 'updateProyekUser'])->name('surveyor.updateProyek');

Route::get('/surveyor/workingpaper', [\App\Http\Controllers\SurveyorController::class, 'workingPaper'])->name('surveyor.workingpaper');

Route::get('/surveyor/laporan-penilaian', [SurveyorController::class, 'laporanPenilaianUser'])->name('surveyor.laporanPenilaian');

Route::get('/surveyor/working-paper', [SurveyorController::class, 'workingPaper'])->name('surveyor.workingpaper');
Route::get('/surveyor/jadwal', [SurveyorController::class, 'dashboard'])->name('surveyor.jadwal');

// EDP
Route::get('/edp', function () {
    return view('layouts.edp');
})->name('edp');

Route::get('/edp/tim', [EdpController::class, 'tim'])->name('edp.tim');

    //seharusnya data mentah ini diganti jadi dokumen final, tapi jadi kubuat rute baru untuk dokuem final ehe, ini disini untuk jaga2 aja
Route::get('/edp/datamentah', [\App\Http\Controllers\EDPController::class, 'dataMentah'])->name('edp.dataMentah');

Route::post('/edp/datamentah/upload', [\App\Http\Controllers\EDPController::class, 'uploadData'])->name('edp.uploadData');

Route::get('/edp/data-aktif', [\App\Http\Controllers\EdpController::class, 'dataAktif'])->name('edp.dataAktif');

Route::get('/edp/dokumen-final', [\App\Http\Controllers\EdpController::class, 'dokumenFinal'])->name('edp.dokumenFinal');

Route::post('/edp/dokumen-final/upload', [\App\Http\Controllers\EdpController::class, 'uploadDokumenFinal'])->name('edp.uploadDokumenFinal');

Route::delete('/edp/dokumen-final/delete/{filename}', [\App\Http\Controllers\EdpController::class, 'deleteDokumenFinal'])->name('edp.deleteDokumenFinal');

Route::get('/edp', [EdpController::class, 'index'])->name('edp');


// Reviewer
Route::get('/reviewer', function () {
    return view('layouts.reviewer');
})->name('reviewer');
Route::get('/reviewer', [ReviewerController::class, 'index'])->name('reviewer');
Route::get('/reviewer/tim', [\App\Http\Controllers\ReviewerController::class, 'tim'])->name('reviewer.tim');

Route::get('/reviewer/dokumen-revisi', [\App\Http\Controllers\ReviewerController::class, 'dokumenRevisi'])->name('reviewer.dokumenRevisi');

Route::get('/reviewer/dokumen-final', [\App\Http\Controllers\ReviewerController::class, 'dokumenFinal'])->name('reviewer.dokumenFinal');

Route::get('/log-aktivitas', [ReviewerController::class, 'logAktivitas'])->name('logAktivitas');

// Finance
Route::prefix('finance')->middleware('auth')->group(function () {

    // Dashboard Finance (route: finance)
    Route::get('/', [FinanceController::class, 'dashboard'])->name('finance');

    // Invoice
    Route::get('/invoice', [FinanceController::class, 'invoice'])->name('finance.invoice');

    // Tim Finance
    Route::get('/tim', [FinanceController::class, 'tim'])->name('finance.tim');

});


// IT
Route::get('/it', function () {
    return view('layouts.it');
})->name('it');

Route::get('/it/form-peminjaman', [ITController::class, 'formPeminjaman'])->name('it.formpeminjaman');

Route::get('/it/laporan-penilaian', [ITController::class,'laporanpenilaian'])->name('it.laporanpenilaian');

Route::get('/it/aset', [\App\Http\Controllers\ITController::class, 'aset'])->name('it.aset');

Route::get('/it/server', [\App\Http\Controllers\ITController::class, 'server'])->name('it.server');

Route::get('/it/formpeminjaman', [\App\Http\Controllers\ITController::class, 'formPeminjaman'])->name('it.formpeminjaman');

Route::get('/it/total-komputer', [\App\Http\Controllers\ItController::class, 'totalKomputer'])->name('it.totalKomputer');

Route::get('/it/total-laptop', [\App\Http\Controllers\ItController::class, 'totalLaptop'])->name('it.totalLaptop');

Route::get('/it/laporan-penilaian', [\App\Http\Controllers\ItController::class, 'laporanPenilaian'])->name('it.laporanPenilaian');

Route::get('/it/upload-form', [ITController::class, 'uploadFormPage'])->name('it.uploadForm');

Route::post('/it/upload-form', [ITController::class, 'uploadFormStore'])->name('it.uploadForm.store');

Route::get('/it/tim', [App\Http\Controllers\ITController::class, 'tim'])->name('it.tim');


//MIDDLEWARE
// ADMIN
Route::get('/admin', [AdminController::class, 'index'])
    ->name('admin')
    ->middleware('auth'); 
    Route::middleware(['auth', 'division:Admin'])->group(function () {

    // Proposal
    Route::get('/admin/proposal', [AdminController::class, 'proposal'])->name('admin.proposal');
    Route::post('/admin/proposal/store', [AdminController::class, 'storeProposal'])->name('admin.proposal.store');
    Route::post('/admin/proposal/update-status/{id}', [AdminController::class, 'updateStatus']);
    Route::delete('/admin/proposal/{id}', [AdminController::class, 'destroy'])->name('admin.proposal.destroy');

    // Adendum
    Route::get('/admin/adendum', [AdminController::class, 'adendum'])->name('admin.adendum');
    Route::post('/admin/adendum/store', [AdminController::class, 'storeAdendum'])->name('admin.adendum.store');
    Route::post('/admin/adendum/update-status/{id}', [AdminController::class, 'updateStatusAdendum']);

    // Surat Tugas
    Route::get('/admin/surat-tugas', [AdminController::class, 'suratTugasAdmin'])->name('admin.suratTugas');
    Route::post('/admin/surat-tugas/store', [AdminController::class, 'storeSuratTugas'])->name('admin.suratTugas.store');
    Route::post('/admin/surat-tugas/update-status/{id}', [AdminController::class, 'updateSuratTugas']);

    // Draft Resume
    Route::get('/admin/draftResume', [AdminController::class, 'draftResume'])->name('admin.draftResume');
    Route::post('/admin/draftResume/store', [AdminController::class, 'SAdraftResumeStore'])->name('admin.draftResume.store');
    Route::post('/admin/draftResume/update-status/{id}', [AdminController::class, 'updateStatusDraftResume']);

    // Draft Laporan
    Route::get('/admin/draftLaporan', [AdminController::class, 'draftLaporan'])->name('admin.draftLaporan');
    Route::post('/admin/draftLaporan/store', [AdminController::class, 'storeSAdraftLaporan'])->name('admin.draftLaporan.store');
    Route::post('/admin/draftLaporan/update-status/{id}', [AdminController::class, 'updateDraftStatus']);

    // Laporan Final
    Route::get('/admin/laporan-final', [AdminController::class, 'laporanFinal'])->name('admin.laporanFinal');
    Route::post('/admin/laporan-final/store', [AdminController::class, 'storeSAlaporanFinal'])->name('admin.laporanFinal.store');
    Route::post('/admin/laporan-final/update/{id}', [AdminController::class, 'updateLaporanFinal'])->name('admin.laporanFinal.update');

});

// SURVEYOR
Route::get('/surveyor', [SurveyorController::class, 'dashboard'])
    ->middleware('auth')
    ->name('surveyor');

Route::middleware(['auth', 'division:Surveyor,EDP,Reviewer'])->group(function () {

    Route::get('/surveyor/lokasi-survei', [SurveyorController::class, 'lokasiSurvei'])
        ->name('surveyor.lokasiSurvei');

    Route::get('/surveyor/laporan-penilaian', [SurveyorController::class, 'laporanPenilaianUser'])
        ->name('surveyor.laporanPenilaian');

    Route::get('/surveyor/update-proyek', [SurveyorController::class, 'updateProyekUser'])
        ->name('surveyor.updateProyek');

    Route::get('/surveyor/working-paper', [SurveyorController::class, 'workingPaper'])
        ->name('surveyor.workingpaper');
});


// EDP
Route::get('/edp', [EdpController::class, 'index'])
    ->middleware('auth')
    ->name('edp');

Route::middleware(['auth', 'division:EDP,Reviewer'])->group(function () {
    Route::get('/edp/datamentah', [EdpController::class, 'dataMentah'])->name('edp.dataMentah');
    Route::post('/edp/datamentah/upload', [EdpController::class, 'uploadData'])->name('edp.uploadData');

    Route::get('/edp/data-aktif', [EdpController::class, 'dataAktif'])->name('edp.dataAktif');
    Route::post('/edp/data-aktif/store', [EdpController::class, 'storeDataAktif'])->name('edp.dataAktif.store');

    Route::get('/edp/log-aktivitas', [EdpController::class, 'index'])->name('edp.logAktivitas');
});


Route::middleware(['auth', 'division:EDP,Surveyor,Reviewer'])->group(function () {
    Route::get('/edp/dokumen-final', [EdpController::class, 'dokumenFinal'])->name('edp.dokumenFinal');
    Route::post('/edp/dokumen-final/upload', [EdpController::class, 'uploadDokumenFinal'])->name('edp.uploadDokumenFinal');
    Route::delete('/edp/dokumen-final/delete/{filename}', [EdpController::class, 'deleteDokumenFinal'])->name('edp.deleteDokumenFinal');
});

//REVIEWER
Route::get('/reviewer', [ReviewerController::class, 'index'])
    ->middleware('auth')
    ->name('reviewer');
Route::middleware(['auth', 'division:Reviewer,Surveyor,EDP'])->group(function () {

    Route::get('/reviewer/dokumen-revisi', [ReviewerController::class, 'dokumenRevisi'])
        ->name('reviewer.dokumenRevisi');

    Route::get('/reviewer/dokumen-final', [ReviewerController::class, 'dokumenFinal'])
        ->name('reviewer.dokumenFinal');
});


// FINANCE
Route::middleware(['auth', 'division:Finance'])->group(function () {

    // Dashboard Finance
    Route::get('/finance', [FinanceController::class, 'dashboard'])
        ->name('finance');

    // Tim Finance
    Route::get('/finance/tim', [FinanceController::class, 'tim'])
        ->name('finance.tim');

    // Invoice
    Route::get('/finance/invoice', [FinanceController::class, 'invoice'])
        ->name('finance.invoice');

    Route::post('/finance/invoice/store', [FinanceController::class, 'storeInvoice'])
        ->name('finance.invoice.store');

    Route::post('/finance/invoice/update-status', [FinanceController::class, 'updateStatus'])
        ->name('finance.invoice.updateStatus');
});

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');


// Logout
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('login.form');
})->name('logout');