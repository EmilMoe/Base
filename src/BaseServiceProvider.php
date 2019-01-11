<?php

namespace EmilMoe\Base;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;

class BaseServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        view()->addNamespace('EmilMoe\Base', base_path('vendor/emilmoe/base/src/resources/views'));
    }
}
