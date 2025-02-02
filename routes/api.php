<?php

use App\Http\Controllers\Api\KomisiController;
use App\Http\Controllers\Api\MarketingController;
use App\Http\Controllers\Api\PenjualanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\KreditController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::resource('/marketing',MarketingController::class);
Route::resource('/penjualan',PenjualanController::class);
Route::resource('/komisi',KomisiController::class);
Route::get('/kredit',[KreditController::class,'index']);
Route::post('/kredit',[KreditController::class,'store']);
