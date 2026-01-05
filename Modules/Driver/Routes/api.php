<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Driver\Http\Controllers\API\DriverAuthController;
use Modules\Driver\Http\Controllers\API\DriverOrdersApiController;
Route::prefix('drivers')->group(function () {
    // Public routes (no authentication required)
    Route::post('login', [DriverAuthController::class, 'login']);
    Route::get('check', function () {
        return response()->json([
            'status' => 'success',
            'message' => 'Route is working!'
        ]);
    });
    // Protected routes (require driver authentication with custom middleware)
    Route::middleware(['driver.auth'])->group(function () {
        Route::get('profile', [DriverAuthController::class, 'profile']);
        Route::post('upload-photo-proof', [DriverOrdersApiController::class, 'uploadPhotoProof']);
        Route::post('signature-proof', [DriverOrdersApiController::class, 'uploadSignatureProof']);
        Route::get( 'photo-proof', [DriverOrdersApiController::class, 'getPhotoProof']);
        
        Route::post('logout', [DriverAuthController::class, 'logout']);
        Route::get('validate-token', [DriverAuthController::class, 'validateToken']);
        Route::post('refresh-token', [DriverAuthController::class, 'refreshToken']); // Optional
        Route::get('orders', [DriverOrdersApiController::class, 'driverOrders']);
    });
});