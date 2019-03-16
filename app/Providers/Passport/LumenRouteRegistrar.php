<?php

namespace App\Providers\Passport;

use Laravel\Lumen\Routing\Router;
use Laravel\Passport\RouteRegistrar;

class LumenRouteRegistrar extends RouteRegistrar
{
    /**
     * Create a new route registrar instance.
     *
     * @param  Router $router
     */
    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     * Register the routes for retrieving and issuing access tokens.
     *
     * @return void
     */
    public function forAccessTokens()
    {
        $this->router->post('/token', [
            'uses' => 'AccessTokenController@issueToken',
            'as' => 'passport.token',
        ]);

        $this->router->group(['middleware' => ['web', 'auth']], function ($router) {
            $router->get('/tokens', [
                'uses' => 'AuthorizedAccessTokenController@forUser',
                'as' => 'passport.tokens.index',
            ]);

            $router->delete('/tokens/{token_id}', [
                'uses' => 'AuthorizedAccessTokenController@destroy',
                'as' => 'passport.tokens.destroy',
            ]);
        });
    }

}