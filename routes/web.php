<?php

use App\Http\Controllers\PumpCalibrationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::redirect('/', '/stanserv');
Route::redirect('login', '/stanserv');

Auth::routes(['register' => false, 'login' => false]);
Route::get('/pumpCalibrationCertificate/{record}', [PumpCalibrationController::class, 'generateCertificate'])->name('pumpCalibrationCertificate');
