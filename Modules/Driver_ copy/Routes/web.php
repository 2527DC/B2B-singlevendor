<?php

use Illuminate\Support\Facades\Route;
use Modules\Driver\Http\Controllers\DriverController;

Route::prefix('drivers')->group(function () {
    Route::get('/', [DriverController::class, 'index'])->name('drivers.index');
    Route::post('/', [DriverController::class, 'store'])->name('drivers.store');
    Route::put('/{id}', [DriverController::class, 'update'])->name('drivers.update');
    Route::delete('/{id}', [DriverController::class, 'destroy'])->name('drivers.delete');
    Route::post('/{id}/reset-password', [DriverController::class, 'resetPassword'])->name('drivers.reset-password');
});