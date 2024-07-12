<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DoctorController;


Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('appointments')->group(function () {
        Route::post('/', [AppointmentController::class, 'create']);
        Route::put('/{appointment}', [AppointmentController::class, 'updateStatus']);
        Route::get('/', [AppointmentController::class, 'index']);
    });

    Route::prefix('doctor')->group(function () {
        Route::get('/appointments', [DoctorController::class, 'index']);
        Route::put('/appointments/{appointment}', [DoctorController::class, 'updateStatus']);
    });
});
