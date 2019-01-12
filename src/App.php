<?php

namespace EmilMoe\Base;

class App
{
    /**
     * App instance
     *
     * @var App
     */
    private static $instance;

    /**
     * Application logo
     *
     * @var String
     */
    private $logo;

    /**
     * Instantiate App object.
     */
    private function __construct()
    {
        $this->logo = config('base.logo');
    }

    /**
     * Get App singleton instance.
     *
     * @return App
     */
    public static function getInstance(): App
    {
        if (! isset(self::$instance)) {
            self::$instance = new App();
        }

        return self::$instance;
    }

    /**
     * Set default logo for application.
     * By default the logo from the config
     * base.logo will be used.
     *
     * @param String $path
     */
    public function setLogo($path): void
    {
        $this->logo = $path;
    }

    /**
     * Get URL for the current set logo.
     *
     * @return String
     */
    public function getLogo(): String
    {
        return $this->logo;
    }
}