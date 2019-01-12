<?php

namespace EmilMoe\Base;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use EmilMoe\Base\App;

class BaseServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen('Base::logo', function($logo) {
            App::getInstance()->setLogo($logo);
        });
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        view()->addNamespace('EmilMoe\Base', base_path('vendor/emilmoe/base/src/resources/views'));

        $this->mergeConfigFrom(
            __DIR__.'/config/navigation.php', 'navigation'
        );
    }
}
