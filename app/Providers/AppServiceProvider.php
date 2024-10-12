<?php

namespace App\Providers;

use App\Models\Classroom;
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
        //share with all views
        view()->composer('layouts.sidebar', function ($view) {
            $stages = Statge::all();
           $view->with([
                'stages'=> $stages,
            ]);
        });

    }
}
