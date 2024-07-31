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

Route::get('/', [FormController::class, 'index'])->name('simple_form');

Route::post('/package-details', [PackageDetailsController::class, 'index']);

// ----------- CARGUS -----------

Route::get('/login', [ApiController::class, 'login']);

Route::get('/login-user', [ApiController::class, 'loginUser']);

// ----------- DHL-----------

Route::get('/dhl', [ApiDHLController::class, 'index'])->name('dhl_select_location');

Route::get('/dhl-locations', [ApiDHLController::class, 'locations'])->name('dhl_locations');

Route::get('/dhl-tracking', [ApiDHLController::class, 'shipmentTracking'])->name('shipmentTracking');

Route::get('/calculate-landed-cost', [ApiDHLController::class, 'calculateLandedCost'])->name('calculateLandedCost');

Route::get('/landed-cost-calculated', [ApiDHLController::class, 'verifyPostalCode'])->name('verifyPostalCode');

Route::post('/get-cities', [ApiDHLController::class, 'getCities'])->name('get-cities');
