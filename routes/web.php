<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeasiswaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\PengajuanBeasiswaController;
use App\Http\Controllers\PengaturanController;
use Illuminate\Support\Facades\Route;


// ========================================================================================
// AUTHENTICATION ROUTES ==================================================================
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'login')->name('login.submit');
    Route::post('/register','register')->name('auth.register');

    // Forgot password process
    Route::post('/forgot-password', 'forgotPassword')->name('password.forgot');
    Route::post('/verify-code', 'verifyCode')->name('password.verifyCode');
    Route::get('/reset-password', 'showResetPasswordForm')->name('password.reset');
    Route::post('/reset-password', 'resetPassword')->name('password.update');
    Route::post('/logout', 'logout')->name('logout');
    Route::post('/mahasiswa/create/{id}','insertMahasiswaData')->name('mahasiswa.insert');

    // Register Information
    Route::get('/register-information/{id}', [AuthController::class, 'getRegisterInformation'])->name('auth.register-information');
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('auth.showregister');
});

// ========================================================================================
// BEASISWA ROUTES ========================================================================
Route::post('/form-beasiswa', [BeasiswaController::class, 'store'])->name('beasiswa.store');
Route::get('/list-beasiswa-staff', [BeasiswaController::class, 'getListBeasiswaForStaff'])->name('beasiswa.list-beasiswa-staff');
Route::get('/pengumuman-beasiswa', [BeasiswaController::class, 'getPengumumanBeasiswa'])->name('beasiswa.pengumuman-beasiswa');
Route::get('/beasiswa/search-syarat', [BeasiswaController::class, 'search_syarat'])->name('Beasiswa.search_syarat');


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
Route::get('/import-data-beasiswa', [BeasiswaController::class, 'getImportDataBeasiswa'])->name('beasiswa.import-data-beasiswa');
Route::get('/detail-beasiswa-kipk', [BeasiswaController::class, 'getDetailBeasiswaKipk'])->name('beasiswa.detail-beasiswa-kipk');
Route::get('/detail-beasiswa-eksternal', [BeasiswaController::class, 'getDetailBeasiswaEksternal'])->name('beasiswa.detail-beasiswa-eksternal');
Route::get('/list-pengaju-beasiswa', [BeasiswaController::class,'getListPengajuBeasiswa'])->name('beasiswa.list-pengaju-beasiswa');
Route::get('/beasiswa', [BeasiswaController::class, 'index'])->name('beasiswa.index');

Route::controller(PengajuanBeasiswaController::class)->group(function () {
    Route::get('/pengajuan-beasiswa/{id}',[PengajuanBeasiswaController::class, 'create'])->name('pengajuan.create');
    Route::post('/pengajuan/store/{id}', [PengajuanBeasiswaController::class, 'store'])->name('pengajuan.store');
    Route::patch('/pengajuan/edit/{id}',[PengajuanBeasiswaController::class, 'edit'])->name('pengajuan.edit');
    Route::get('pengajuan/list-pengajuan',[PengajuanBeasiswaController::class, 'listPengajuanStaff'])->name('pengajuan.list-pengajuan');
});

Route::post('/upload',[FileController::class,'uploadFile'])->name('upload.uploadFile');

// Route::middleware('auth')->group(function () {
    Route::resource('beasiswa', BeasiswaController::class);
    Route::get('/detail-beasiswa', function () {
        return view('pages.Beasiswa.detail-beasiswa');
    });
    Route::get('/form-beasiswa', function () {
        return view('pages.Beasiswa.form-beasiswa');
    });
// });




// ========================================================================================
// PENGAJUAN ROUTES =======================================================================
Route::middleware('auth')->group(function () {
    Route::resource('tracking-pengajuan', PengajuanBeasiswaController::class);
});

// ========================================================================================
// PENGATURAN ROUTES ======================================================================
Route::middleware('auth')->group(function () {
    Route::resource('pengaturan', PengaturanController::class);
    Route::patch('/pengaturan/{id}', [PengaturanController::class, 'update'])->name('pengaturan.update');
});
