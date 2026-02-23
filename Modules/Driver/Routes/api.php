<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Driver\Http\Controllers\API\DriverAuthController;
use Modules\Driver\Http\Controllers\API\DriverOrdersApiController;
use App\Http\Controllers\API\OrderController;
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
        Route::post('order-refund/store', [OrderController::class, 'driverRefundStore']);

        Route::get( 'photo-proof', [DriverOrdersApiController::class, 'getPhotoProof']);
        Route::get('orders-details/{id}', [DriverOrdersApiController::class, 'orderDetails']);
        Route::get('orders/{orderId}/generate-otp', [DriverOrdersApiController::class, 'generateAndSetOrderOtp']);
        Route::post('/order/{orderId}/verify-otp', [DriverOrdersApiController::class, 'verifyOrderOtp']);
        Route::post('orders/{id}/update-status', [DriverOrdersApiController::class, 'salesInfoUpdateApi']);
        Route::post('logout', [DriverAuthController::class, 'logout']);
        Route::get('validate-token', [DriverAuthController::class, 'validateToken']);
        Route::post('refresh-token', [DriverAuthController::class, 'refreshToken']); // Optional
        Route::get('orders', [DriverOrdersApiController::class, 'driverOrders']);
        Route::get('cancelled-orders', [DriverOrdersApiController::class, 'cancelledOrders']);

        // Return Requests
        Route::post('return-request/store', [\Modules\Refund\Http\Controllers\API\ReturnRequestApiController::class, 'store']);
        Route::get('return-requests', [\Modules\Refund\Http\Controllers\API\ReturnRequestApiController::class, 'index']);
        Route::post('return-request/{id}/update-status', [\Modules\Refund\Http\Controllers\API\ReturnRequestApiController::class, 'updateStatus']);
        Route::get('return-request/{id}', [\Modules\Refund\Http\Controllers\API\ReturnRequestApiController::class, 'show']);
    });
});