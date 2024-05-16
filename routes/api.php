<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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

Route::middleware('auth:api')->namespace('Api')->group(function () {
    Route::resource('sku', 'SkuController')->only(['index']);
    Route::resource('sku-type', 'SkuTypeController')->only(['index']);

    Route::name('tools.')->namespace('Tools')->prefix('tools')->group(function() {
        Route::name('servicecenter.')->namespace('ServiceCenter')->prefix('servicecenter')->group(function() {
            Route::get('users', 'ServiceCenterController@users')->name('users');
            Route::name('returnslog.')->namespace('ReturnsLog')->prefix('{service_center}/returnslog')->group(function() {
                Route::get('{return}', 'ReturnsLogController@show')->name('show');
                Route::put('{return}', 'ReturnsLogController@update')->name('update');
                Route::delete('{return}', 'ReturnsLogController@destroy')->name('destroy');
                Route::get('{return}/suggestedSkus', 'ReturnsLogController@suggestedSkus')->name('suggestedSkus');

                Route::resource('{return}/returnitem', 'ReturnItemController')->only(['index', 'store', 'destroy', 'update']);
            });
        });
    });
});
