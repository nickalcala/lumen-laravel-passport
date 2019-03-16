<?php

namespace App\Providers\Passport;

use Laravel\Passport\Passport;

class LumenPassport extends Passport
{
    /**
     * Binds the Passport routes into the controller.
     *
     * @param  callable|null  $callback
     * @param  array  $options
     * @return void
     */
    public static function routes($callback = null, array $options = [])
    {
        $callback = $callback ?: function ($router) {
            $router->all();
        };

        $defaultOptions = [
            'prefix' => 'oauth',
            'namespace' => '\Laravel\Passport\Http\Controllers',
        ];

        $options = array_merge($defaultOptions, $options);

        app('router')->group($options, function ($router) use ($callback) {
            $callback(new LumenRouteRegistrar($router));
        });
    }
}