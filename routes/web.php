<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeasiswaController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\PengajuanBeasiswaController;
use App\Http\Controllers\PengaturanController;

// ========================================================================================
// AUTHENTICATION ROUTES ==================================================================
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'login')->name('login.submit');

    // Forgot password process
    Route::post('/forgot-password', 'forgotPassword')->name('password.forgot');
    Route::post('/verify-code', 'verifyCode')->name('password.verifyCode');
    Route::get('/reset-password', 'showResetPasswordForm')->name('password.reset');
    Route::post('/reset-password', 'resetPassword')->name('password.update');

    // Logout route should be outside the '/home' route
    Route::post('/logout', 'logout')->name('logout');
});

// ========================================================================================
// BEASISWA ROUTES ========================================================================
Route::post('/form-beasiswa', [BeasiswaController::class, 'store'])->name('beasiswa.store');
Route::get('/list-beasiswa-staff', [BeasiswaController::class, 'getListBeasiswaForStaff'])->name('beasiswa.list-beasiswa-staff');
Route::get('/pengumuman-beasiswa', [BeasiswaController::class, 'getPengumumanBeasiswa'])->name('beasiswa.pengumuman-beasiswa');

Route::get('/dashboard', function () {
    return view('index');
});

Route::controller(PengajuanBeasiswaController::class)->group(function () {
    Route::get('/pengajuan/create',[PengajuanBeasiswaController::class, 'create'])->name('pengajuan.create');
    Route::post('/pengajuan/store', [PengajuanBeasiswaController::class, 'store'])->name('pengajuan.store');
});

Route::post('/upload',[FileController::class,'uploadFile'])->name('upload.uploadFile');

Route::middleware('auth')->group(function () {
    Route::resource('beasiswa', BeasiswaController::class);
    Route::get('/detail-beasiswa', function () {
        return view('pages.Beasiswa.detail-beasiswa');
    });
    Route::get('/form-beasiswa', function () {
        return view('pages.Beasiswa.form-beasiswa');
    });
});

Route::get('/pengajuan',function(){
    return view('pages.Beasiswa.pengajuan');
});








// ========================================================================================
// PENGAJUAN ROUTES =======================================================================
Route::middleware('auth')->group(function () {
    Route::resource('tracking-pengajuan', PengajuanBeasiswaController::class);
});

// ========================================================================================
// PENGATURAN ROUTES ======================================================================
Route::middleware('auth')->group(function () {
    Route::resource('pengaturan', PengaturanController::class);
});
