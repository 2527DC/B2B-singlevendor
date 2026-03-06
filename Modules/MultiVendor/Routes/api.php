<?php

use Illuminate\Http\Request;

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



 Route::get('/customer/merchants', 'MerchantController@sellerlistapi')->name('customer.merchants_list');
Route::middleware('auth:api')->get('/multivendor', function (Request $request) {
    return $request->user();
});