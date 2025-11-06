<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CastController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/register', [AuthController::class, 'showRegisterForm']);
Route::post('/welcome', [AuthController::class, 'welcome']);

Route::get('/table', [HomeController::class, 'table']);
Route::get('/data-tables', [HomeController::class, 'dataTables']);

Route::resource('cast', CastController::class);

?>