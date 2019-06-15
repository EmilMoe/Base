<?php

namespace EmilMoe\Base;

use Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Event;
use EmilMoe\Base\App;
use Illuminate\Support\Facades\Schema;
use EmilMoe\Base\Console\Commands\Cleanup;

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
            App::getInstance()->setLogo($logo);
        });

        $this->loadTranslationsFrom(__DIR__ .'/resources/lang', __NAMESPACE__);

        Event::listen('base.menu.update', function($menu) {
            $menu::registerItem(
                1560461838,
                'Designer',
                '<i class="fas fa-drafting-compass"></i>',
                ['url', ['#']],
                []
            );
        });

        Blade::directive('module', function ($modules) {
            return "<?php if(\EmilMoe\Base\Module::loaded($modules)): ?>";
        });

        Blade::directive('endmodule', function () {
            return '<?php endif; ?>';
        });

        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);
            $schedule->command('base:cleanup')->hourly();
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
        $this->mergeConfigFrom(__DIR__ .'/config.php', 'base');
        $this->loadMigrationsFrom(__DIR__ .'/database/migrations');
        $this->loadRoutesFrom(__DIR__ .'/routes/web.php');
        $this->commands([
            Cleanup::class,
        ]);
    }
}
