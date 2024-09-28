<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\BeasiswaController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/{pathMatch}', function () {
//     return view('index');
// })->where('pathMatch', ".*");


/*
===============================================================
> Authentication Routes
===============================================================
*/
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'index');
});


Route::get('/home', function () {
    return view('index');
});


Route::get('/tables', function () {
    return view('tables');
});

Route::resource('beasiswa', BeasiswaController::class);

Route::get('/detail-beasiswa', function () {
    return view('pages.Beasiswa.detail-beasiswa');
});

Route::get('/form-beasiswa', function () {
    return view('pages.Beasiswa.form-beasiswa');
});

Route::get('/pengaturan-profil', function () {
    return view('pages.Pengaturan.pengaturan');
});
