<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SurveyorController;
use App\Http\Controllers\ReviewerController;
use App\Http\Controllers\EdpController;

Route::get('/edp/staff', [EdpController::class, 'staff'])->name('edp.staff');

Route::get('/surveyor/proyek-selesai', [SurveyorController::class, 'proyekSelesai'])->name('surveyor.proyekSelesai');
Route::get('/surveyor/tugas-tertunda', [SurveyorController::class, 'tugasTertunda'])->name('surveyor.tugastertunda');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');

Route::get('/', function () {
    return redirect()->route('login.form');
});

// Login routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Dashboard (hanya bisa diakses setelah login)
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth');

// Profile (contoh tambahan)
Route::get('/profile', function () {
    return view('profile');
})->name('profile')->middleware('auth');

// Admin
Route::get('/admin', function () {
    return view('layouts.admin');
})->name('admin');

// Surveyor
Route::get('/surveyor', function () {
    return view('layouts.surveyor');
})->name('surveyor');

Route::get('/surveyor/lokasisurvei', [\App\Http\Controllers\SurveyorController::class, 'lokasisurvei'])->name('surveyor.lokasisurvei');

Route::get('/surveyor/tim', [\App\Http\Controllers\SurveyorController::class, 'tim'])->name('surveyor.tim');

Route::get('/surveyor/proyekberjalan', [\App\Http\Controllers\SurveyorController::class, 'proyekberjalan'])->name('surveyor.proyekberjalan');

Route::get('/surveyor/workingpaper', [\App\Http\Controllers\SurveyorController::class, 'workingPaper'])->name('surveyor.workingpaper');


// EDP
Route::get('/edp', function () {
    return view('layouts.edp');
})->name('edp');

// Reviewer
Route::get('/reviewer', function () {
    return view('layouts.reviewer');
})->name('reviewer');

Route::get('/reviewer/tim', [\App\Http\Controllers\ReviewerController::class, 'tim'])->name('reviewer.tim');

// Finance
Route::get('/finance', function () {
    return view('layouts.finance');
})->name('finance');

// IT
Route::get('/it', function () {
    return view('layouts.it');
})->name('it');



// Logout
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('login.form');
})->name('logout');