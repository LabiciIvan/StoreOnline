<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\Models\Reviews' => 'App\Policies\ReviewsPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

 

        // Gate::define('user.update', 'App\Policies\UserPolicy@update');
        // Gate::define('user.update', 'App\Policies\UserPolicy@update');

        // Gate::define('reviews.delete', 'App\Policies\ReviewsPolicy@delete');
        Gate::resource('reviews', 'App\Policies\ReviewsPolicy');
    }
}
