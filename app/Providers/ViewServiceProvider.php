<?php

namespace App\Providers;

use App\Http\View\Composers\Stores\BikeCompatibility\BikeCompatibilityBikeTypesComposer;
use App\Http\View\Composers\Stores\BikeCompatibility\BikeCompatibilityCompatibilityIncompatibilityReasons;
use App\Http\View\Composers\Stores\BikeCompatibility\BikeCompatibilityCompatibilityOptionsComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //generated the dashbaord views
        View::composer('dashboard', 'App\Http\View\Composers\DashboardComposer');

        // This passes user data into authenticated views
        View::composer('layouts.authenticated', 'App\Http\View\Composers\UserComposer');

        //Sku Types
        View::Composer('stores.swytch.sku-type.index', \App\Http\View\Composers\Stores\SkuType\SkuTypeOptionsComposer::class);

        //ServiceCenter
        View::composer('tools.service-center.returns-log.check-in', \App\Http\View\Composers\Tools\ServiceCenter\ServiceCenterUserOptionsComposer::class);
        View::composer('tools.service-center.returns-log.check-in', \App\Http\View\Composers\Tools\ServiceCenter\ReturnsLog\ReturnsLogSKUOptionsComposer::class);
        View::composer('tools.service-center.returns-log.index', \App\Http\View\Composers\Tools\ServiceCenter\ReturnsLog\ReturnsLogReturnsProcessingButtonsComposer::class);
    }
}
