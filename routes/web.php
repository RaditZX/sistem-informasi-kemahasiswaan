<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/{pathMatch}', function () {
//     return view('index');
// })->where('pathMatch', ".*");

Route::get('/Dashboard', function () {
    return view('index');
});


Route::get('/tables', function () {
    return view('tables');
});

Route::get('/detail-beasiswa', function () {
    return view('pages.Beasiswa.detail-beasiswa');
});
