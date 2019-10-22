<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Global admins
    |--------------------------------------------------------------------------
    |
    | Define a boolean attribute on \Auth::user() that identifies a
    | user as an admin.
    |
    | For instance `is_admin` an admin user will be true if
    | \Auth::user()->is_admin === true.
    |
    */

    'admin_attribute' => null,

    /*
    |--------------------------------------------------------------------------
    | Get permission key
    |--------------------------------------------------------------------------
    |
    | A closure for returning all users permission keys.
    |
    | For instance:
    |    permission_keys_callback' => function($user) {
    |       return $user->permissions();
    |    },
    |
    */

    'permission_keys_callback' => null,
];