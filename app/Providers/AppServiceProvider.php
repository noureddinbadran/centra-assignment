<?php

namespace App\Providers;

use App\Modules\Clients\Github\Client;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use League\OAuth2\Client\Provider\Github;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Github::class, fn() => new Github([
            'clientId' => config('services.github.client_id'),
            'clientSecret' => config('services.github.client_secret'),
        ]));
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
