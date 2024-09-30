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

    Route::post('/logout', 'logout')->name('logout');
});
// ========================================================================================


// ========================================================================================
// BEASISWA ROUTES ========================================================================
Route::middleware('auth')->group(function () {
    Route::resource('beasiswa', BeasiswaController::class);
    Route::get('/detail-beasiswa', function () {
        return view('pages.Beasiswa.detail-beasiswa');
    });
    Route::get('/form-beasiswa', function () {
        return view('pages.Beasiswa.form-beasiswa');
    });
});
// ========================================================================================