<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

/* @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', function () use ($router) {

    dump(app('router')->getRoutes());

    return $router->app->version();
});

$router->group([
    'middleware' => 'client'
], function (\Laravel\Lumen\Routing\Router $router) {
    $router->get('/test-client', function () {
        return 'it worked';
    });
});

$router->group([
    'middleware' => 'auth:api'
], function (\Laravel\Lumen\Routing\Router $router) {
    $router->get('/test-password', function () {
        return 'it worked';
    });
});