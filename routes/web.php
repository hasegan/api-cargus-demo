<?php

use App\Http\Controllers\FormController;
use App\Http\Controllers\PackageDetailsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\ApiDHLController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [FormController::class, 'index']);

Route::post('/package-details', [PackageDetailsController::class, 'index']);

Route::get('/login', [ApiController::class, 'login']);

Route::get('/login-user', [ApiController::class, 'loginUser']);

Route::get('/dhl', [ApiDHLController::class, 'index']);

Route::get('/dhl-locations', [ApiDHLController::class, 'locations']);
