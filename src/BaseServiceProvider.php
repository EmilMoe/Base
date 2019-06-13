<?php

namespace EmilMoe\Base;

use Blade;
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
        view()->addNamespace(__NAMESPACE__, __DIR__ .'/resources/views');
        $this->mergeConfigFrom(__DIR__ .'/config.php', 'base');
        $this->loadMigrationsFrom(__DIR__ .'/database/migrations');

        Blade::directive('module', function ($modules) {
            return "<?php if(\EmilMoe\Base\Module::loaded($modules)): ?>";
        });

        Blade::directive('endmodule', function () {
            return '<?php endif; ?>';
        });
    }
}
