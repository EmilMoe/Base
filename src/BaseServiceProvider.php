<?php

namespace EmilMoe\Base;

use EmilMoe\Base\Console\Commands\Cleanup;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
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
        Schema::defaultStringLength(191);

        Event::listen('Base::logo', function($logo) {
            return config('app.logo');
        });

        $this->loadTranslationsFrom(__DIR__ .'/resources/lang', __NAMESPACE__);

        Blade::directive('module', function ($modules) {
            return "<?php if(\EmilMoe\Base\Module::loaded($modules)): ?>";
        });

        Blade::directive('endmodule', function () {
            return '<?php endif; ?>';
        });

        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);
            $schedule->command('cleanup')->hourly();
        });
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        view()->addNamespace(__NAMESPACE__, __DIR__ .'/resources/views');
        $this->loadMigrationsFrom(__DIR__ .'/database/migrations');
        $this->loadRoutesFrom(__DIR__ .'/routes/web.php');
        $this->commands([
            Cleanup::class,
        ]);
        $this->mergeConfigFrom(__DIR__ .'/config.php', 'base');
        $this->publishes([
            __DIR__ .'/config.php' => config_path('base.php'),
        ]);
    }
}
