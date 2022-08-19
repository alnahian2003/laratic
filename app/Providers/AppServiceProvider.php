<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::share([
            'siteAuthor' => 'Abdullah Al Nahian',
            'thisYear' => date("Y"),
            'testArr' => [
                1,
                2,
                3,
                4,
                5,
            ]
        ]);
    }
}
