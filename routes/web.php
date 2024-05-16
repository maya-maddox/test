<?php

use App\Http\Controllers\Auth\GoogleSheetsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\XeroController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'auth'], function()
{
    Route::get('/', 'DashboardController@dashboard')->name('dashboard');
    Route::get('/services', 'DashboardController@services')->name('services');



    //tools
    Route::name('tools.')->namespace('Tools')->prefix('tools')->group(function() {
        Route::name('servicecenter.')->namespace('ServiceCenter')->prefix('servicecenter')->group(function() {
            Route::get('index/{service_center?}', 'ServiceCenterController@index')->name('index');
            Route::get('create', 'ServiceCenterController@create')->name('create');
            Route::post('/', 'ServiceCenterController@store')->name('store');
            Route::post('{service_center}/select', 'ServiceCenterController@select')->name('select');
            Route::get('returnsLog', 'ServiceCenterController@returnsLog')->name('returnslog');

            Route::name('returnslog.')->namespace('ReturnsLog')->prefix('{service_center}/returnslog')->group(function() {
                Route::get('index', 'ReturnsLogController@index')->name('index');
                Route::post('file-upload', 'ReturnsLogController@fileUpload')->name('file-upload');
                Route::get('{return}/edit', 'ReturnsLogController@edit')->name('edit');
                Route::resource('checkin', 'CheckInController')->only(['create', 'store']);
            });
        });
    });

    //ingestors
    Route::name('ingestors.')->namespace('Ingestors')->prefix('ingestors')->group(function() {
        Route::resource('tracker', 'TrackerController')->only(['index', 'show']);
    });


    //stores
    Route::name('stores.')->namespace('Stores')->prefix('stores')->group(function() {

        //CrowdOx
        Route::name('crowdox.')->namespace('CrowdOx')->prefix('crowdox')->group(function() {
            Route::resource('customers', 'CrowdOxCustomerController')->only(['index', 'show']);
            Route::post('customers/import/dispatch', 'CrowdOxCustomerController@importDispatch')->name('customers.import.dispatch');
            Route::post('customers/import', 'CrowdOxCustomerController@import')->name('customers.import');

            Route::resource('countries', 'CrowdOxCountryController')->only(['index', 'show']);
            Route::post('countries/import', 'CrowdOxCountryController@import')->name('countries.import');

            Route::resource('states', 'CrowdOxStateController')->only(['index', 'show']);
            Route::post('states/import', 'CrowdOxStateController@import')->name('states.import');

            Route::get('orders/download/custom', 'CrowdOxOrderController@downloadCustom')->name('orders.download.custom')->withoutMiddleware(["auth"]);
            Route::get('orders/download', 'CrowdOxOrderController@download')->name('orders.download');
            Route::post('orders/import/dispatch', 'CrowdOxOrderController@importDispatch')->name('orders.import.dispatch');
            Route::post('orders/importrelations', 'CrowdOxOrderController@importWithRelations')->name('orders.import.relations');
            Route::post('orders/import', 'CrowdOxOrderController@import')->name('orders.import');
            Route::post('orders/{order}/orderlines/import', 'CrowdOxOrderController@importOrderLines')->name('orders.orderlines.import');
            Route::post('orders/{order}/orderselections/import', 'CrowdOxOrderController@importOrderSelections')->name('orders.orderselections.import');
            Route::post('orders/{order}/clean', 'CrowdOxOrderController@clean')->name('orders.clean');
            Route::post('orders/{order}/link', 'CrowdOxOrderController@link')->name('orders.link');
            Route::resource('orders', 'CrowdOxOrderController')->only(['index', 'show']);

            Route::resource('orderaddresses', 'CrowdOxOrderAddressController')->only(['index', 'show']);
            Route::post('orderaddresses/import/dispatch', 'CrowdOxOrderAddressController@importDispatch')->name('orderaddresses.import.dispatch');
            Route::post('orderaddresses/import', 'CrowdOxOrderAddressController@import')->name('orderaddresses.import');

            Route::resource('ordertags', 'CrowdOxOrderTagController')->only(['index', 'show']);
            Route::post('ordertags/import', 'CrowdOxOrderTagController@import')->name('ordertags.import');

            Route::resource('orderlines', 'CrowdOxOrderLineController')->only(['index', 'show']);
            Route::post('orderlines/import/dispatch', 'CrowdOxOrderLineController@importDispatch')->name('orderlines.import.dispatch');
            Route::post('orderlines/import', 'CrowdOxOrderLineController@import')->name('orderlines.import');


            Route::resource('ordertransactions', 'CrowdOxOrderTransactionController')->only(['index']);
            Route::post('ordertransactions/import', 'CrowdOxOrderTransactionController@import')->name('ordertransactions.import');

            Route::resource('orderselections', 'CrowdOxOrderSelectionController')->only(['index', 'show']);
            Route::post('orderselections/import/dispatch', 'CrowdOxOrderSelectionController@importDispatch')->name('orderselections.import.dispatch');
            Route::post('orderselections/import', 'CrowdOxOrderSelectionController@import')->name('orderselections.import');

            Route::resource('products', 'CrowdOxProductController')->only(['index', 'show']);
            Route::post('products/import', 'CrowdOxProductController@import')->name('products.import');

            Route::resource('productvariations', 'CrowdOxProductVariationController')->only(['index', 'show']);
            Route::post('productvariations/import', 'CrowdOxProductVariationController@import')->name('productvariations.import');

            Route::resource('projectcustomfields', 'CrowdOxProjectCustomFieldController')->only(['index']);

            Route::resource('projects', 'CrowdOxProjectController')->only(['index', 'show']);
            Route::post('projects/import', 'CrowdOxProjectController@import')->name('projects.import');
            Route::post('projects/{project}/customfields/import', 'CrowdOxProjectController@importCustomFields')->name('projects.customfields.import');
        });


        //Swytch
        Route::name('swytch.')->namespace('Swytch')->prefix('swytch')->group(function() {
            Route::resource('skus', 'SkusController')->only('index');
            Route::post('skus/import', 'SkusController@import')->name('skus.import');

            Route::resource('sku-type', 'SkuTypeController')->only('index', 'store', 'show');
            Route::post('sku-type/update-assignments', 'SkuTypeController@updateAssignments')->name('sku-type.update-assignments');


            Route::name('sku-type.')->prefix('sku-type/{skuType}')->group(function() {
                Route::resource('diagnosis', 'SkuTypeDiagnosisController')->only('store');
            });
        });
    });
});


//AUTHENTICATION ROUTES
Route::group(['namespace' => 'Auth',
    'prefix' => 'auth',
    'as' => 'auth.'], function() {

    Route::group(['middleware' => 'guest'], function() {
        Route::get('login', 'LoginController@login')->name('login');
        Route::post('login', 'LoginController@loginSubmit')->name('login');
    });


    Route::group(['middleware' => 'auth'], function() {
        Route::post('logout', 'LoginController@logout')->name('logout');
    });

});