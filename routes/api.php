<?php

use App\Http\Controllers\Employee\LoginController;
use App\Http\Controllers\Employee\LogoutController;
use App\Http\Controllers\Employee\StoreController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;

Route::post('login', LoginController::class);
Route::post('store', StoreController::class);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', LogoutController::class);
    Route::get('cars', CarController::class);
    Route::prefix('reservations')->group(function () {
        Route::post('store', [ReservationController::class, 'store']);
        Route::delete('delete', [ReservationController::class, 'delete']);
    });
});
