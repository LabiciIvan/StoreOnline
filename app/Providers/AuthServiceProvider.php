<?php

namespace App\Providers;

use App\Models\Replay;
use App\Models\User;
use App\Policies\ReplayPolicy;
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
        'App\Models\Replay' => 'App\Policies\ReplayPolicy',
   
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

        // Gate::define('delete', 'App\Policies\ReviewsPolicy@delete');

        Gate::define('isAdmin',function ($user) {

            return $user->role;
        });

        Gate::define('replay.delete', [ReplayPolicy::class, 'delete']);
        Gate::define('replay.store', [ReplayPolicy::class, 'store']);

        // Gate::before(function ($user) {

        //     if ($user->role) {
        //         return true;
        //     }
        // });

        Gate::resource('reviews', 'App\Policies\ReviewsPolicy');
    }
}
