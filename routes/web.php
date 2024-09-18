<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/{pathMatch}', function () {
//     return view('index');
// })->where('pathMatch', ".*");

Route::get('/home', function () {
    return view('index');
});


Route::get('/tables', function () {
    return view('tables');
});
