<?php

use EmilMoe\Base\Language;
use \Illuminate\Support\Facades\App;

/**
 * Web route configuration.
 */

// Localization
Route::get('/js/lang.js', function () {
    $paths = new Language();
    event('base.translation.update', $paths);

    if (env('APP_ENV','none') === 'local') {
        Cache::forget('lang-'. App::getLocale()  .'.js');
    }

    $strings = Cache::remember('lang-'. App::getLocale()  .'.js', 5, function() use($paths) {
        $lang = App::getLocale();

        $collections = [];

        foreach ($paths->toArray() as $namespace => $path) {
            foreach ($path as $p) {
                $collections[] = [
                    'file'      => glob($p .'/lang/' . $lang . '/*.php'),
                    'namespace' => $namespace,
                ];
            }
        }

        $strings = [];

        foreach ($collections as $collection) {
            $namespace = $collection['namespace'];

            foreach ($collection['file'] as $file) {
                $name                         = basename($file, '.php');
                $strings[$namespace][$name] = require $file;
            }
        }

        return $strings;
    });

    header('Content-Type: text/javascript');
    echo('window.i18n = ' . json_encode($strings) . ';');
    exit();
})->name('assets.lang');
