<?php

namespace EmilMoe\Base;

use Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use EmilMoe\Base\App;
use Illuminate\Support\Facades\Schema;

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

        Menu::registerItem(
            1560461837,
            'Menu',
            '<i class="material-icons">sort</i>',
            ['route', ['base.menu.index']],
            ['base.menu.index']
        );

        Menu::registerItem(
            1560461838,
            'Designer',
            '<i class="fas fa-drafting-compass"></i>',
            ['url', ['#']],
            []
        );

        Blade::directive('module', function ($modules) {
            return "<?php if(\EmilMoe\Base\Module::loaded($modules)): ?>";
        });

        Blade::directive('endmodule', function () {
            return '<?php endif; ?>';
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
    }
}
