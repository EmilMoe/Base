<?php

Route::resource('base/menu', 'EmilMoe\Base\Http\Controllers\MenuController', ['as' => 'base'])
    ->middleware(['web', 'auth'])
    ->only(['index']);