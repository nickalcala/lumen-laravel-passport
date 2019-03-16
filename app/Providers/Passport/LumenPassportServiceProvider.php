<?php

namespace App\Providers\Passport;

use Laravel\Passport\PassportServiceProvider;

class LumenPassportServiceProvider extends PassportServiceProvider
{

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->app->singleton(\Illuminate\Database\Connection::class, function () {
            return $this->app['db.connection'];
        });

        $this->app->singleton(\Illuminate\Hashing\HashManager::class, function ($app) {
            return new \Illuminate\Hashing\HashManager($app);
        });

        if ($this->app->runningInConsole()) {

            $this->registerMigrations();

            $this->commands([
                \Laravel\Passport\Console\InstallCommand::class,
                \Laravel\Passport\Console\ClientCommand::class,
                \Laravel\Passport\Console\KeysCommand::class,
            ]);
        }
    }

    /**
     * Setup the resource publishing groups for Passport.
     *
     * @return void
     */
    protected function offerPublishing()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/passport.php' => app('config')->get('passport.php'),
            ], 'passport-config');
        }
    }

}