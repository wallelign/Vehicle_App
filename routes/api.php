<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VechileController;
use App\Http\Controllers\AuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// vechile 
// Route::apiResource('vehicles', VechileController::class);

// Routes accessible to 'admin'
Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::post('/vehicles', [VechileController::class, 'store']); 
    Route::put('/vehicles/{id}', [VechileController::class, 'update']); 
    Route::delete('/vehicles/{id}', [VechileController::class, 'destroy']); 
});

// Routes accessible to 'driver'
Route::middleware(['auth:sanctum', 'role:driver'])->group(function () {
    Route::get('/vehicles', [VechileController::class, 'index']); 
    Route::get('/vehicles/{id}', [VechileController::class, 'show']); 
});

// Routes accessible to 'admin' and 'driver'
Route::middleware(['auth:sanctum', 'role:admin,driver'])->group(function () {
    Route::get('/vehicles', [VechileController::class, 'index']); 
    Route::get('/vehicles/{id}', [VechileController::class, 'show']); 
});




Route::post('/login', [AuthController::class, 'login']);
