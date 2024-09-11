<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/{pathMatch}', function () {
    return view('welcome');
})->where('pathMatch', ".*");
