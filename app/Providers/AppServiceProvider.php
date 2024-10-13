<?php

namespace App\Providers;

use App\Models\Stage;
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
        //share with all views
        view()->composer('layouts.sidebar', function ($view) {
            $stages = Stage::all();
           $view->with([
                'stages'=> $stages,
            ]);
        });

    }
}
