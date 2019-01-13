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
        
        $this->loadTranslationsFrom(__DIR__ .'/resources/lang', __NAMESPACE__);
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        view()->addNamespace(__NAMESPACE__, base_path(__DIR__ .'/resources/views'));
        $this->mergeConfigFrom(__DIR__ .'/config.php', 'base');
    }
}
