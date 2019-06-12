<?php

namespace EmilMoe\Base;

use Illuminate\Support\Collection;

class Module
{
    private $navigation;
    private static $instance;

    public static function get()
    {
        if (! isset(self::$instance)) {
            self::$instance = new Module;
        }

        return self::$instance;
    }

    private function __construct()
    {

        $this->navigation = collect([]);
    }

    /**
     * Check if given module is loaded.
     *
     * @param array|string $module
     * @param ?string $namespace
     * @return bool
     */
    public static function loaded($module, string $namespace = 'EmilMoe'): bool
    {
        if (is_array($module)) {
            return collect($module)->filter(function ($module) use ($namespace) {
                return Module::loaded($module);
            });
        }

        return collect(app()->getLoadedProviders())->contains(function ($loaded, $provider) use ($module, $namespace) {
            $key = strtolower(substr($provider, 0, strlen($namespace .'\\'. $module)));

            if ($key === strtolower($namespace .'\\'. $module)) {
                return $loaded;
            }
        });
    }

    /**
     * List an array of all loaded modules.
     *
     * @param ?string $namespace
     * @return array
     */
    public static function list(string $namespace = 'EmilMoe'): array
    {
        return collect(app()->getLoadedProviders())->filter(function ($loaded, $provider) use ($namespace) {
            if (strtolower(substr($provider, 0, strlen($namespace .'\\'))) === strtolower($namespace .'\\')) {
                return true;
            }
        })->map(function ($loaded, $provider) use ($namespace) {
            return strtolower(explode('\\', $provider)[1]);
        })->unique()->sort()->flatten()->toArray();
    }

    public function addNavigation(array $args)
    {
        $this->navigation->push(new Navigation(
            $args['text'],
            $args['link'],
            $args['icon'],
            $args['backend'],
            $args['active']
        ));
    }

    public function getNavigation(): Collection
    {
        return $this->navigation;
    }
}