<?php

namespace App\Providers;

use App\Routing\ExtendedResourceRegistrar;
use Illuminate\Support\ServiceProvider;
use Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        Route::macro('extendedResource', function ($name, $controller, array $options = []) {
            $registrar = new ExtendedResourceRegistrar(app('router'));
            return $registrar->register($name, $controller, $options);
        });
    }
}
