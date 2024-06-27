<?php

namespace App\Providers;

use GoCardlessPro\Client;
use Illuminate\Support\ServiceProvider;

class GoCardlessServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Client::class, function ($app) {
            return new Client([
                'access_token' => env('GOCARDLESS_ACCESS_TOKEN'),
                'environment' => env('GOCARDLESS_ENVIRONMENT'),
            ]);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
