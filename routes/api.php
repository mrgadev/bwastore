<?php

use App\Http\Controllers\API\LocationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::middleware('auth:api')->get('/user', function(Request $request) {
    return $request->user();
});

Route::get('register/check', [RegisterController::class,'check'])->name('api-register-check');
Route::get('provinces', [LocationController::class,'provinces'])->name('api-provinces');
Route::get('regencies/{provinces_id}', [LocationController::class,'regencies'])->name('api-regencies');