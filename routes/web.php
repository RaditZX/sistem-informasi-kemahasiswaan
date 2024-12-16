<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeasiswaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PenerimaBeasiswaController;
use App\Http\Controllers\PengajuanBeasiswaController;
use App\Http\Controllers\PengajuanDokumenController;
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

Route::middleware(['auth', 'check.role:mahasiswa'])->group(function () {
    Route::controller(PengajuanBeasiswaController::class)->group(function () {
        Route::get('/pengajuan-beasiswa/{id}',[PengajuanBeasiswaController::class, 'create'])->name('pengajuan.create');
        Route::get('/pengajuan-beasiswa/edit/{id}',[PengajuanBeasiswaController::class, 'show'])->name('pengajuan.show');
        Route::post('/pengajuan/store/{id}', [PengajuanBeasiswaController::class, 'store'])->name('pengajuan.store');
        Route::patch('/pengajuan/edit/{id}',[PengajuanBeasiswaController::class, 'edit'])->name('pengajuan.edit');

    });
    Route::get('/beasiswa', [BeasiswaController::class, 'index'])->name('beasiswa.index');
});

Route::middleware(['auth', 'check.role:reviewer'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/import-data-beasiswa', [BeasiswaController::class, 'getImportDataBeasiswa'])->name('beasiswa.import-data-beasiswa');

    Route::get('/list-pengaju-beasiswa', [BeasiswaController::class,'getListPengajuBeasiswa'])->name('beasiswa.list-pengaju-beasiswa');
    Route::post('/form-beasiswa', [BeasiswaController::class, 'store'])->name('beasiswa.store');
    Route::post('/beasiswa/edit/{id}', [BeasiswaController::class, 'edit'])->name('beasiswa.edit');
    Route::get('/list-beasiswa-staff', [BeasiswaController::class, 'getListBeasiswaForStaff'])->name('beasiswa.list-beasiswa-staff');
    Route::get('/import-data-penerima', [PenerimaBeasiswaController::class, 'create'])->name('beasiswa.import-data-beasiswa');
    Route::post('/import-data-penerima', [PenerimaBeasiswaController::class, 'store'])->name('penerimabeasiswa.import-data-beasiswa');
    Route::get('/beasiswa/search-syarat', [BeasiswaController::class, 'search_syarat'])->name('Beasiswa.search_syarat');
    Route::get('/beasiswa/search-dokumen', [BeasiswaController::class, 'search_dokumen'])->name('Beasiswa.search_dokumen');
    Route::get('/beasiswa/search-benefit', [BeasiswaController::class, 'search_benefit'])->name('Beasiswa.search_benefit');
    Route::get('/beasiswa/search-jenjang', [BeasiswaController::class, 'search_jenjang'])->name('Beasiswa.search_jenjang');

});


Route::controller(PengajuanBeasiswaController::class)->group(function () {
    Route::get('pengajuan/list-pengajuan',[PengajuanBeasiswaController::class, 'listPengajuanStaff'])->name('pengajuan.list-pengajuan');
    Route::get('/tracking-pengajuan/{id}', [PengajuanBeasiswaController::class, 'showTracking'])->name('pengajuan.tracking');
    Route::patch('/pengajuan/progress/{id}', [PengajuanBeasiswaController::class, 'progressPengajuan'])->name('pengajuan.update-progress');
    Route::delete('/tracking-pengajuan/{id}', [PengajuanBeasiswaController::class, 'batalkanPengajuan'])->name('pengajuan.batalkan-pengajuan');
});


Route::post('/upload',[FileController::class,'uploadFile'])->name('upload.uploadFile');

// Route::middleware('auth')->group(function () {
// PENGAJUAN ROUTES =======================================================================
Route::middleware('auth')->group(function () {
    Route::get('/beasiswa/search-syarat', [BeasiswaController::class, 'search_syarat'])->name('Beasiswa.search_syarat');
    Route::resource('tracking-pengajuan', PengajuanBeasiswaController::class);
    Route::get('/pengumuman-beasiswa/{id}', [PenerimaBeasiswaController::class, 'show'])->name('beasiswa.pengumuman-beasiswa');
    Route::get('/pengumuman-beasiswa', [PenerimaBeasiswaController::class, 'index'])->name('pengumuman-beasiswa.index');
    Route::get('/get-notif-data', [NotificationController::class, 'getNotifData'])->name('notifications');
    Route::get('/detail-beasiswa-kipk/{id}', [BeasiswaController::class, 'getDetailBeasiswaKipk'])->name('beasiswa.detail-beasiswa-kipk');
    Route::get('/detail-beasiswa-eksternal/{id}', [BeasiswaController::class, 'getDetailBeasiswaEksternal'])->name('beasiswa.detail-beasiswa-eksternal');
    Route::resource('beasiswa', BeasiswaController::class);
    Route::get('/detail-beasiswa', function () {
        return view('pages.Beasiswa.detail-beasiswa');
    });
    Route::get('/form-beasiswa', function () {
        return view('pages.Beasiswa.form-beasiswa');
    });
    Route::resource('pengaturan', PengaturanController::class);
    Route::patch('/pengaturan/{id}', [PengaturanController::class, 'update'])->name('pengaturan.update');
    Route::get('/pengajuan/list-pengajuan',[PengajuanBeasiswaController::class, 'listPengajuanStaff'])->name('pengajuan.list-pengajuan');
    Route::post('/notify-reviewer', [MailController::class, 'notifyReviewer']);

});

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



