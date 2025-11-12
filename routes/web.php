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


// Admin
Route::get('/admin', function () {
    return view('layouts.admin');
})->name('admin');

Route::get('/admin/surat-tugas', [\App\Http\Controllers\AdminController::class, 'suratTugas'])->name('admin.suratTugas');

Route::get('/admin/proposal', [\App\Http\Controllers\AdminController::class, 'proposal'])->name('admin.proposal');

Route::get('/admin/adendum', [\App\Http\Controllers\AdminController::class, 'adendum'])->name('admin.adendum');

Route::get('/admin/draftResume', [\App\Http\Controllers\AdminController::class, 'draftResume'])->name('admin.draftResume');

Route::get('/admin/draftLaporan', [\App\Http\Controllers\AdminController::class, 'draftLaporan'])->name('admin.draftLaporan');

Route::get('/admin/laporan-final', [AdminController::class, 'laporanFinal'])->name('admin.laporanFinal');

Route::get('/tim', [AdminController::class, 'tim'])->name('admin.tim');


// Surveyor
Route::get('/surveyor', function () {
    return view('layouts.surveyor');
})->name('surveyor');

Route::get('/surveyor/lokasisurvei', [\App\Http\Controllers\SurveyorController::class, 'lokasisurvei'])->name('surveyor.lokasisurvei');

Route::get('/surveyor/tim', [\App\Http\Controllers\SurveyorController::class, 'tim'])->name('surveyor.tim');

Route::get('/surveyor/update-proyek', [\App\Http\Controllers\SurveyorController::class, 'updateProyek'])->name('surveyor.updateProyek');

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


// Logout
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('login.form');
})->name('logout');