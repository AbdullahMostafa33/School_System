<?php

namespace App\Providers;

use App\Models\Statge;
use Illuminate\Support\ServiceProvider;

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
        $stages=Statge::all();
        view()->share('stages', $stages);
    }
}
