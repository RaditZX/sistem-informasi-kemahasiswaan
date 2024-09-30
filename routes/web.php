<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeasiswaController;

// ========================================================================================
// AUTHENTICATION ROUTES ==================================================================
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'index')->name('login'); // Login page
    Route::post('/login', 'login')->name('login.submit'); // Handle login form submission
    
    // Redirect GET /logout to a proper page to prevent method error
    Route::get('/logout', function () {
        return redirect()->route('login');
    });
    
    Route::post('/logout', 'logout')->name('logout'); // Handle logout via POST request
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