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
    Route::post('/vehicles', [VechileController::class, 'store']); // Create a new vehicle
    Route::put('/vehicles/{id}', [VechileController::class, 'update']); // Update a vehicle by ID
    Route::delete('/vehicles/{id}', [VechileController::class, 'destroy']); // Delete a vehicle by ID
});

// Routes accessible to 'driver'
Route::middleware(['auth:sanctum', 'role:driver'])->group(function () {
    Route::get('/vehicles', [VechileController::class, 'index']); // List all vehicles
    Route::get('/vehicles/{id}', [VechileController::class, 'show']); // Get a single vehicle by ID
});

// Routes accessible to 'admin' and 'driver'
Route::middleware(['auth:sanctum', 'role:admin,driver'])->group(function () {
    Route::get('/vehicles', [VechileController::class, 'index']); // List all vehicles
    Route::get('/vehicles/{id}', [VechileController::class, 'show']); // Get a single vehicle by ID
});




Route::post('/login', [AuthController::class, 'login']);
