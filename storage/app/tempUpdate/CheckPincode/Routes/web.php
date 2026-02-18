<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('checkpincode')->group(function() {
    Route::get('/', 'CheckPincodeController@index')->name('checkpincode.list');
    Route::get('/checkpincode-get-pincodes', 'CheckPincodeController@getPincodesData')->name('checkpincode.checkpincode-get-pincodes');
    Route::get('/create', 'CheckPincodeController@create')->name('checkpincode.create');
    Route::get('/edit/{id?}', 'CheckPincodeController@edit')->name('checkpincode.edit');
    Route::post('/delete', 'CheckPincodeController@destroy')->name('checkpincode.destroy')->middleware('prohibited_demo_mode');
    Route::post('/store', 'CheckPincodeController@store')->name('checkpincode.store')->middleware('prohibited_demo_mode');
    Route::post('/update', 'CheckPincodeController@update')->name('checkpincode.update')->middleware('prohibited_demo_mode');
    Route::get('/check-pincode-config','CheckPincodeController@checkPincodeConfig')->name('checkpincode.system.config');
    Route::post('/update-check-pincode-system-config', 'CheckPincodeController@updateCheckpincodeSystemConfig')->name('checkpincode.update.checkpincode.system.config')->middleware(['prohibited_demo_mode']);
    Route::post('/update-check-pincode-delivery-config', 'CheckPincodeController@updateCheckpincodeDeliveryConfig')->name('checkpincode.update.delivery.status.config')->middleware(['prohibited_demo_mode']);
    Route::get('bulk-pincode-upload', 'CheckPincodeController@bulk_pincode_upload_page')->name('checkpincode.bulk_pincode_upload_page');
    Route::post('bulk-pincode-upload-store', 'CheckPincodeController@bulk_pincode_store')->name('checkpincode.bulk_pincode_store');
    Route::post('check-pincode-availablity', 'CheckPincodeController@checkPincodeAvailablity')->name('checkpincode.pin.code.availablity');
});
