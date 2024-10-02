<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeasiswaController;

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

Route::get('/home', function () {
    return view('index');
});

Route::get('/dashboard', function () {
    return view('index');
});

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

