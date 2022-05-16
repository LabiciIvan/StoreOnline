<?php

namespace App\Providers;

use App\Services\Cart;
use App\Services\Search;
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
        $this->app->bind(Cart::class, function ($app) {

            return new Cart();
        });

        $this->app->bind(Search::class, function($app) {
            
            return new Search();
        });
    }
}
