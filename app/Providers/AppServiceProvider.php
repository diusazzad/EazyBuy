<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    // protected $namespace = 'App\Http\Controllers';
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
        // Route::middleware('web')
        //     ->namespace($this->namespace)
        //     ->group(base_path('routes/web.php'));
    }
}
