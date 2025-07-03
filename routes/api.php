<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

use App\Http\Controllers\AlertController;
use App\Http\Controllers\EmergencyContactController;
use Illuminate\Http\Request;


// Route::post('emergency-contacts', [EmergencyContactController::class, 'store']);
// Route::middleware('auth:sanctum')->group(function () {
    
//     Route::get('alert', [AlertController::class, 'index']);
// });

Route::post('register',[UserController::class, 'register'])->name('register');
Route::post('login',[UserController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('emergency-contacts', [EmergencyContactController::class, 'store']);
    Route::get('emergency-contacts', [EmergencyContactController::class, 'index']);
    Route::post('alert', [AlertController::class, 'store']);
     Route::get('alert', [AlertController::class, 'index']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user(); 
});